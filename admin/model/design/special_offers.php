<?php
class ModelDesignspecialoffers extends Model {

	public function addspecial_offers($data) {
		$this->event->trigger('pre.admin.special_offers.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "special_offers SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");
//        var_dump("INSERT INTO " . DB_PREFIX . "special_offers SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");
		$special_offers_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "special_offers SET image = '" . $this->db->escape($data['image']) . "' WHERE special_offers_id = '" . (int)$special_offers_id . "'");
		}

		foreach ($data['special_offers_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "special_offers_description SET special_offers_id = '" . (int)$special_offers_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) ."'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
//		$level = 0;
//
//		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "special_offers_path` WHERE special_offers_id = '0' ORDER BY `level` ASC");
//        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "special_offers_path` WHERE special_offers_id = '0' ORDER BY `level` ASC");
//
//		foreach ($query->rows as $result) {
//			$this->db->query("INSERT INTO `" . DB_PREFIX . "special_offers_path` SET `special_offers_id` = '" . (int)$special_offers_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");
//
//			$level++;
//		}

		//$this->db->query("INSERT INTO `" . DB_PREFIX . "special_offers_path` SET `special_offers_id` = '" . (int)$special_offers_id . "', `path_id` = '" . (int)$special_offers_id . "', `level` = '" . (int)$level . "'");
//
        if (isset($data['special_offers_image'])) {
            foreach ($data['special_offers_image'] as $image) {
    //        var_dump($image);
    //                var_dump("INSERT INTO " . DB_PREFIX . "special_offers_images SET id_special_offers = '" . (int)$special_offers_id . "', image = '" . $this->db->escape($image['image']) . "', sort_order = '" . (int)$image['sort_order'] . "'");
                if ($image['image']){
                    $this->db->query("INSERT INTO " . DB_PREFIX . "special_offers_images SET id_special_offers = '" . (int)$special_offers_id . "', image = '" . $this->db->escape($image['image']) . "', sort_order = '" . (int)$image['sort_order'] . "'");
                }
            }
        }
//        
		$this->cache->delete('special_offers');

		$this->event->trigger('post.admin.special_offers.add', $special_offers_id);

		return $special_offers_id;
	}

	public function editspecial_offers($special_offers_id, $data) {
//        var_dump($data);
		$this->event->trigger('pre.admin.special_offers.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "special_offers SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE special_offers_id = '" . (int)$special_offers_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "special_offers SET image = '" . $this->db->escape($data['image']) . "' WHERE special_offers_id = '" . (int)$special_offers_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "special_offers_description WHERE special_offers_id = '" . (int)$special_offers_id . "'");

		foreach ($data['special_offers_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "special_offers_description SET special_offers_id = '" . (int)$special_offers_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
        
        $this->db->query("DELETE FROM " . DB_PREFIX . "special_offers_images WHERE id_special_offers = '" . (int)$special_offers_id . "'");
        
        if (isset($data['special_offers_image'])) {
            foreach ($data['special_offers_image'] as $image) {
    //        var_dump($image);
    //                var_dump("INSERT INTO " . DB_PREFIX . "special_offers_images SET id_special_offers = '" . (int)$special_offers_id . "', image = '" . $this->db->escape($image['image']) . "', sort_order = '" . (int)$image['sort_order'] . "'");
                if ($image['image']){
                    $this->db->query("INSERT INTO " . DB_PREFIX . "special_offers_images SET id_special_offers = '" . (int)$special_offers_id . "', image = '" . $this->db->escape($image['image']) . "', sort_order = '" . (int)$image['sort_order'] . "'");
                }
            }
        }
        

		// MySQL Hierarchical Data Closure Table Pattern
//		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "special_offers_path` WHERE path_id = '" . (int)$special_offers_id . "' ORDER BY level ASC");
//
//		if ($query->rows) {
//			foreach ($query->rows as $special_offers_path) {
//				// Delete the path below the current one
//				$this->db->query("DELETE FROM `" . DB_PREFIX . "special_offers_path` WHERE special_offers_id = '" . (int)$special_offers_path['special_offers_id'] . "' AND level < '" . (int)$special_offers_path['level'] . "'");
//
//				$path = array();
//
//				// Get the nodes new parents
//				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "special_offers_path` WHERE special_offers_id = '0' ORDER BY level ASC");
//
//				foreach ($query->rows as $result) {
//					$path[] = $result['path_id'];
//				}
//
//				// Get whats left of the nodes current path
//				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "special_offers_path` WHERE special_offers_id = '" . (int)$special_offers_path['special_offers_id'] . "' ORDER BY level ASC");
//
//				foreach ($query->rows as $result) {
//					$path[] = $result['path_id'];
//				}
//
//				// Combine the paths with a new level
//				$level = 0;
//
//				foreach ($path as $path_id) {
//					$this->db->query("REPLACE INTO `" . DB_PREFIX . "special_offers_path` SET special_offers_id = '" . (int)$special_offers_path['special_offers_id'] . "', `path_id` = '" . (int)$path_id . "', level = '" . (int)$level . "'");
//
//					$level++;
//				}
//			}
//		} else {
//			// Delete the path below the current one
//			$this->db->query("DELETE FROM `" . DB_PREFIX . "special_offers_path` WHERE special_offers_id = '" . (int)$special_offers_id . "'");
//
//			// Fix for records with no paths
//			$level = 0;
//
//			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "special_offers_path` WHERE special_offers_id = '0' ORDER BY level ASC");
//
//			foreach ($query->rows as $result) {
//				$this->db->query("INSERT INTO `" . DB_PREFIX . "special_offers_path` SET special_offers_id = '" . (int)$special_offers_id . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");
//
//				$level++;
//			}
//
//			$this->db->query("REPLACE INTO `" . DB_PREFIX . "special_offers_path` SET special_offers_id = '" . (int)$special_offers_id . "', `path_id` = '" . (int)$special_offers_id . "', level = '" . (int)$level . "'");
//		}


		$this->cache->delete('special_offers');

		$this->event->trigger('post.admin.special_offers.edit', $special_offers_id);
	}

	public function deletespecial_offers($special_offers_id) {
		$this->event->trigger('pre.admin.special_offers.delete', $special_offers_id);

//		$this->db->query("DELETE FROM " . DB_PREFIX . "special_offers_path WHERE special_offers_id = '" . (int)$special_offers_id . "'");
//
//		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "special_offers_path WHERE path_id = '" . (int)$special_offers_id . "'");
//
//		foreach ($query->rows as $result) {
//			$this->deletespecial_offers($result['special_offers_id']);
//		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "special_offers WHERE special_offers_id = '" . (int)$special_offers_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "special_offers_description WHERE special_offers_id = '" . (int)$special_offers_id . "'");
        
//        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "special_offers_images WHERE id_special_offers = '" . (int)$special_offers_id . "'");
//        var_dump($query->rows);
//        die();
//        foreach ($query->rows as $result) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "special_offers_images WHERE id_special_offers = '" . (int)$special_offers_id . "'");
//		}
        
		$this->cache->delete('special_offers');

		$this->event->trigger('post.admin.special_offers.delete', $special_offers_id);
	}

	public function repairCategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "special_offers WHERE parent_id = '" . (int)$parent_id . "'");

//		foreach ($query->rows as $special_offers) {
//			// Delete the path below the current one
//			$this->db->query("DELETE FROM `" . DB_PREFIX . "special_offers_path` WHERE special_offers_id = '" . (int)$special_offers['special_offers_id'] . "'");
//
//			// Fix for records with no paths
//			$level = 0;
//
//			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "special_offers_path` WHERE special_offers_id = '" . (int)$parent_id . "' ORDER BY level ASC");
//
//			foreach ($query->rows as $result) {
//				$this->db->query("INSERT INTO `" . DB_PREFIX . "special_offers_path` SET special_offers_id = '" . (int)$special_offers['special_offers_id'] . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");
//
//				$level++;
//			}
//
//			$this->db->query("REPLACE INTO `" . DB_PREFIX . "special_offers_path` SET special_offers_id = '" . (int)$special_offers['special_offers_id'] . "', `path_id` = '" . (int)$special_offers['special_offers_id'] . "', level = '" . (int)$level . "'");
//
//			$this->repairCategories($special_offers['special_offers_id']);
//		}
	}

	public function getspecial_offers($special_offers_id) {
		//$query = $this->db->query("SELECT DISTINCT *, (SELECT cd1.name AS name FROM " . DB_PREFIX . "special_offers_path cp LEFT JOIN " . DB_PREFIX . "special_offers_description cd1 ON (cp.path_id = cd1.special_offers_id AND cp.special_offers_id != cp.path_id) WHERE cp.special_offers_id = c.special_offers_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.special_offers_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'special_offers_id=" . (int)$special_offers_id . "') AS keyword FROM " . DB_PREFIX . "special_offers c LEFT JOIN " . DB_PREFIX . "special_offers_description cd2 ON (c.special_offers_id = cd2.special_offers_id) WHERE c.special_offers_id = '" . (int)$special_offers_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");
        
        $query = $this->db->query("SELECT DISTINCT *, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'special_offers_id=" . (int)$special_offers_id . "') AS keyword FROM " . DB_PREFIX . "special_offers c LEFT JOIN " . DB_PREFIX . "special_offers_description cd2 ON (c.special_offers_id = cd2.special_offers_id) WHERE c.special_offers_id = '" . (int)$special_offers_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");
        
//        var_dump("SELECT DISTINCT *, (SELECT cd1.name AS name FROM " . DB_PREFIX . "special_offers_path cp LEFT JOIN " . DB_PREFIX . "special_offers_description cd1 ON (cp.path_id = cd1.special_offers_id AND cp.special_offers_id != cp.path_id) WHERE cp.special_offers_id = c.special_offers_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.special_offers_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'special_offers_id=" . (int)$special_offers_id . "') AS keyword FROM " . DB_PREFIX . "special_offers c LEFT JOIN " . DB_PREFIX . "special_offers_description cd2 ON (c.special_offers_id = cd2.special_offers_id) WHERE c.special_offers_id = '" . (int)$special_offers_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");
        
        //$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id . "') AS keyword FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
        
		return $query->row;
	}

	public function getspecial_offerss($data = array()) {
//		$sql = "SELECT cp.special_offers_id AS special_offers_id, cd1.name AS name, c1.sort_order FROM " . DB_PREFIX . "special_offers_path cp LEFT JOIN " . DB_PREFIX . "special_offers c1 ON (cp.special_offers_id = c1.special_offers_id) LEFT JOIN " . DB_PREFIX . "special_offers c2 ON (cp.path_id = c2.special_offers_id) LEFT JOIN " . DB_PREFIX . "special_offers_description cd1 ON (cp.path_id = cd1.special_offers_id) LEFT JOIN " . DB_PREFIX . "special_offers_description cd2 ON (cp.special_offers_id = cd2.special_offers_id) WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";
        
        $sql = "SELECT c1.special_offers_id, c1.sort_order, cd1.name FROM " . DB_PREFIX . "special_offers c1, " . DB_PREFIX . "special_offers_description cd1 WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c1.special_offers_id = cd1.special_offers_id";
        
//        var_dump($sql);
        
		if (!empty($data['filter_name'])) {
			$sql .= " AND cd2.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		//$sql .= " GROUP BY c1.special_offers_id";

		$sort_data = array(
			'name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);
//        var_dump($query->rows);
		return $query->rows;
	}

	public function getspecial_offersDescriptions($special_offers_id) {
		$special_offers_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "special_offers_description WHERE special_offers_id = '" . (int)$special_offers_id . "'");

		foreach ($query->rows as $result) {
			$special_offers_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description']
			);
		}

		return $special_offers_description_data;
	}

	public function getspecial_offersFilters($special_offers_id) {
		$special_offers_filter_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "special_offers_filter WHERE special_offers_id = '" . (int)$special_offers_id . "'");

		foreach ($query->rows as $result) {
			$special_offers_filter_data[] = $result['filter_id'];
		}

		return $special_offers_filter_data;
	}

	public function getspecial_offersStores($special_offers_id) {
		$special_offers_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "special_offers_to_store WHERE special_offers_id = '" . (int)$special_offers_id . "'");

		foreach ($query->rows as $result) {
			$special_offers_store_data[] = $result['store_id'];
		}

		return $special_offers_store_data;
	}

	public function getspecial_offersLayouts($special_offers_id) {
		return array();
	}

	public function getTotalspecial_offerss() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "special_offers");

		return $query->row['total'];
	}

	public function getTotalspecial_offerssByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "special_offers_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}

    public function autocomplete() {
		$json = array();

		//if (isset($this->request->get['filter_name'])) {
			$this->load->model('design/special_offers');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_design_special_offers->getspecial_offerss($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'category_id' => $result['special_offers_id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		//}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
    
    public function getspecial_offersImages($special_offers_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "special_offers_images WHERE id_special_offers = '" . (int)$special_offers_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}
}
