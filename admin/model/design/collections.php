<?php
class ModelDesignCollections extends Model {

	public function addcollections($data) {
		$this->event->trigger('pre.admin.collections.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "collections SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");
//        var_dump("INSERT INTO " . DB_PREFIX . "collections SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");
		$collections_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "collections SET image = '" . $this->db->escape($data['image']) . "' WHERE collections_id = '" . (int)$collections_id . "'");
		}

		foreach ($data['collections_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "collections_description SET collections_id = '" . (int)$collections_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) ."'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
//		$level = 0;
//
//		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "collections_path` WHERE collections_id = '0' ORDER BY `level` ASC");
//        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "collections_path` WHERE collections_id = '0' ORDER BY `level` ASC");
//
//		foreach ($query->rows as $result) {
//			$this->db->query("INSERT INTO `" . DB_PREFIX . "collections_path` SET `collections_id` = '" . (int)$collections_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");
//
//			$level++;
//		}

		//$this->db->query("INSERT INTO `" . DB_PREFIX . "collections_path` SET `collections_id` = '" . (int)$collections_id . "', `path_id` = '" . (int)$collections_id . "', `level` = '" . (int)$level . "'");
//
        if (isset($data['collections_image'])) {
            foreach ($data['collections_image'] as $image) {
    //        var_dump($image);
    //                var_dump("INSERT INTO " . DB_PREFIX . "collections_images SET id_collections = '" . (int)$collections_id . "', image = '" . $this->db->escape($image['image']) . "', sort_order = '" . (int)$image['sort_order'] . "'");
                if ($image['image']){
                    $this->db->query("INSERT INTO " . DB_PREFIX . "collections_images SET id_collections = '" . (int)$collections_id . "', image = '" . $this->db->escape($image['image']) . "', sort_order = '" . (int)$image['sort_order'] . "'");
                }
            }
        }
//        
		$this->cache->delete('collections');

		$this->event->trigger('post.admin.collections.add', $collections_id);

		return $collections_id;
	}

	public function editcollections($collections_id, $data) {
//        var_dump($data);
		$this->event->trigger('pre.admin.collections.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "collections SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE collections_id = '" . (int)$collections_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "collections SET image = '" . $this->db->escape($data['image']) . "' WHERE collections_id = '" . (int)$collections_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "collections_description WHERE collections_id = '" . (int)$collections_id . "'");

		foreach ($data['collections_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "collections_description SET collections_id = '" . (int)$collections_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
        
        $this->db->query("DELETE FROM " . DB_PREFIX . "collections_images WHERE id_collections = '" . (int)$collections_id . "'");
        
        if (isset($data['collections_image'])) {
            foreach ($data['collections_image'] as $image) {
    //        var_dump($image);
    //                var_dump("INSERT INTO " . DB_PREFIX . "collections_images SET id_collections = '" . (int)$collections_id . "', image = '" . $this->db->escape($image['image']) . "', sort_order = '" . (int)$image['sort_order'] . "'");
                if ($image['image']){
                    $this->db->query("INSERT INTO " . DB_PREFIX . "collections_images SET id_collections = '" . (int)$collections_id . "', image = '" . $this->db->escape($image['image']) . "', sort_order = '" . (int)$image['sort_order'] . "'");
                }
            }
        }
        

		// MySQL Hierarchical Data Closure Table Pattern
//		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "collections_path` WHERE path_id = '" . (int)$collections_id . "' ORDER BY level ASC");
//
//		if ($query->rows) {
//			foreach ($query->rows as $collections_path) {
//				// Delete the path below the current one
//				$this->db->query("DELETE FROM `" . DB_PREFIX . "collections_path` WHERE collections_id = '" . (int)$collections_path['collections_id'] . "' AND level < '" . (int)$collections_path['level'] . "'");
//
//				$path = array();
//
//				// Get the nodes new parents
//				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "collections_path` WHERE collections_id = '0' ORDER BY level ASC");
//
//				foreach ($query->rows as $result) {
//					$path[] = $result['path_id'];
//				}
//
//				// Get whats left of the nodes current path
//				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "collections_path` WHERE collections_id = '" . (int)$collections_path['collections_id'] . "' ORDER BY level ASC");
//
//				foreach ($query->rows as $result) {
//					$path[] = $result['path_id'];
//				}
//
//				// Combine the paths with a new level
//				$level = 0;
//
//				foreach ($path as $path_id) {
//					$this->db->query("REPLACE INTO `" . DB_PREFIX . "collections_path` SET collections_id = '" . (int)$collections_path['collections_id'] . "', `path_id` = '" . (int)$path_id . "', level = '" . (int)$level . "'");
//
//					$level++;
//				}
//			}
//		} else {
//			// Delete the path below the current one
//			$this->db->query("DELETE FROM `" . DB_PREFIX . "collections_path` WHERE collections_id = '" . (int)$collections_id . "'");
//
//			// Fix for records with no paths
//			$level = 0;
//
//			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "collections_path` WHERE collections_id = '0' ORDER BY level ASC");
//
//			foreach ($query->rows as $result) {
//				$this->db->query("INSERT INTO `" . DB_PREFIX . "collections_path` SET collections_id = '" . (int)$collections_id . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");
//
//				$level++;
//			}
//
//			$this->db->query("REPLACE INTO `" . DB_PREFIX . "collections_path` SET collections_id = '" . (int)$collections_id . "', `path_id` = '" . (int)$collections_id . "', level = '" . (int)$level . "'");
//		}


		$this->cache->delete('collections');

		$this->event->trigger('post.admin.collections.edit', $collections_id);
	}

	public function deletecollections($collections_id) {
		$this->event->trigger('pre.admin.collections.delete', $collections_id);

//		$this->db->query("DELETE FROM " . DB_PREFIX . "collections_path WHERE collections_id = '" . (int)$collections_id . "'");
//
//		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "collections_path WHERE path_id = '" . (int)$collections_id . "'");
//
//		foreach ($query->rows as $result) {
//			$this->deletecollections($result['collections_id']);
//		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "collections WHERE collections_id = '" . (int)$collections_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "collections_description WHERE collections_id = '" . (int)$collections_id . "'");
        
//        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "collections_images WHERE id_collections = '" . (int)$collections_id . "'");
//        var_dump($query->rows);
//        die();
//        foreach ($query->rows as $result) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "collections_images WHERE id_collections = '" . (int)$collections_id . "'");
//		}
        
		$this->cache->delete('collections');

		$this->event->trigger('post.admin.collections.delete', $collections_id);
	}

	public function repairCategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "collections WHERE parent_id = '" . (int)$parent_id . "'");

//		foreach ($query->rows as $collections) {
//			// Delete the path below the current one
//			$this->db->query("DELETE FROM `" . DB_PREFIX . "collections_path` WHERE collections_id = '" . (int)$collections['collections_id'] . "'");
//
//			// Fix for records with no paths
//			$level = 0;
//
//			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "collections_path` WHERE collections_id = '" . (int)$parent_id . "' ORDER BY level ASC");
//
//			foreach ($query->rows as $result) {
//				$this->db->query("INSERT INTO `" . DB_PREFIX . "collections_path` SET collections_id = '" . (int)$collections['collections_id'] . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");
//
//				$level++;
//			}
//
//			$this->db->query("REPLACE INTO `" . DB_PREFIX . "collections_path` SET collections_id = '" . (int)$collections['collections_id'] . "', `path_id` = '" . (int)$collections['collections_id'] . "', level = '" . (int)$level . "'");
//
//			$this->repairCategories($collections['collections_id']);
//		}
	}

	public function getcollections($collections_id) {
		//$query = $this->db->query("SELECT DISTINCT *, (SELECT cd1.name AS name FROM " . DB_PREFIX . "collections_path cp LEFT JOIN " . DB_PREFIX . "collections_description cd1 ON (cp.path_id = cd1.collections_id AND cp.collections_id != cp.path_id) WHERE cp.collections_id = c.collections_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.collections_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'collections_id=" . (int)$collections_id . "') AS keyword FROM " . DB_PREFIX . "collections c LEFT JOIN " . DB_PREFIX . "collections_description cd2 ON (c.collections_id = cd2.collections_id) WHERE c.collections_id = '" . (int)$collections_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");
        
        $query = $this->db->query("SELECT DISTINCT *, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'collections_id=" . (int)$collections_id . "') AS keyword FROM " . DB_PREFIX . "collections c LEFT JOIN " . DB_PREFIX . "collections_description cd2 ON (c.collections_id = cd2.collections_id) WHERE c.collections_id = '" . (int)$collections_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");
        
//        var_dump("SELECT DISTINCT *, (SELECT cd1.name AS name FROM " . DB_PREFIX . "collections_path cp LEFT JOIN " . DB_PREFIX . "collections_description cd1 ON (cp.path_id = cd1.collections_id AND cp.collections_id != cp.path_id) WHERE cp.collections_id = c.collections_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.collections_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'collections_id=" . (int)$collections_id . "') AS keyword FROM " . DB_PREFIX . "collections c LEFT JOIN " . DB_PREFIX . "collections_description cd2 ON (c.collections_id = cd2.collections_id) WHERE c.collections_id = '" . (int)$collections_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");
        
        //$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id . "') AS keyword FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
        
		return $query->row;
	}

	public function getcollectionss($data = array()) {
//		$sql = "SELECT cp.collections_id AS collections_id, cd1.name AS name, c1.sort_order FROM " . DB_PREFIX . "collections_path cp LEFT JOIN " . DB_PREFIX . "collections c1 ON (cp.collections_id = c1.collections_id) LEFT JOIN " . DB_PREFIX . "collections c2 ON (cp.path_id = c2.collections_id) LEFT JOIN " . DB_PREFIX . "collections_description cd1 ON (cp.path_id = cd1.collections_id) LEFT JOIN " . DB_PREFIX . "collections_description cd2 ON (cp.collections_id = cd2.collections_id) WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";
        
        $sql = "SELECT c1.collections_id, c1.sort_order, cd1.name FROM " . DB_PREFIX . "collections c1, " . DB_PREFIX . "collections_description cd1 WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c1.collections_id = cd1.collections_id";
        
//        var_dump($sql);
        
		if (!empty($data['filter_name'])) {
			$sql .= " AND cd2.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		//$sql .= " GROUP BY c1.collections_id";

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

	public function getcollectionsDescriptions($collections_id) {
		$collections_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "collections_description WHERE collections_id = '" . (int)$collections_id . "'");

		foreach ($query->rows as $result) {
			$collections_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description']
			);
		}

		return $collections_description_data;
	}

	public function getcollectionsFilters($collections_id) {
		$collections_filter_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "collections_filter WHERE collections_id = '" . (int)$collections_id . "'");

		foreach ($query->rows as $result) {
			$collections_filter_data[] = $result['filter_id'];
		}

		return $collections_filter_data;
	}

	public function getcollectionsStores($collections_id) {
		$collections_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "collections_to_store WHERE collections_id = '" . (int)$collections_id . "'");

		foreach ($query->rows as $result) {
			$collections_store_data[] = $result['store_id'];
		}

		return $collections_store_data;
	}

	public function getcollectionsLayouts($collections_id) {
		return array();
	}

	public function getTotalcollectionss() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "collections");

		return $query->row['total'];
	}

	public function getTotalcollectionssByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "collections_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}

    public function autocomplete() {
		$json = array();

		//if (isset($this->request->get['filter_name'])) {
			$this->load->model('design/collections');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_design_collections->getcollectionss($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'category_id' => $result['collections_id'],
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
    
    public function getcollectionsImages($collections_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "collections_images WHERE id_collections = '" . (int)$collections_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}
}
