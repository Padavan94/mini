<?php
class ModelDesignCollectionsWidget extends Model {
//	public function getSpecialOffer($category_id) {
//		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_image bi LEFT JOIN " . DB_PREFIX . "category_image_description bid ON (bi.category_image_id  = bid.category_image_id) WHERE bi.category_id = '" . (int)$category_id . "' AND bid.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY bi.sort_order ASC");
//        var_dump($query->rows);
//		return $query->rows;
//	}
    
    public function getSpecialOffer($quantity=5)
	{
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "category i LEFT JOIN ". DB_PREFIX . "category_description id ON (i.category_id = id.category_id) WHERE i.parent_id = 63 AND id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i.status = '1' ORDER BY i.date_modified DESC LIMIT 0," . $quantity);
        
//        var_dump($query->rows);
		return $query->rows;
	}
}