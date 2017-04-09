<?php
class ModelDesignCollectionsWidget extends Model {
//	public function getSpecialOffer($collections_id) {
//		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "collections_image bi LEFT JOIN " . DB_PREFIX . "collections_image_description bid ON (bi.collections_image_id  = bid.collections_image_id) WHERE bi.collections_id = '" . (int)$collections_id . "' AND bid.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY bi.sort_order ASC");
//        var_dump($query->rows);
//		return $query->rows;
//	}
    
    public function getSpecialOffer($quantity=5)
	{
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "collections i LEFT JOIN ". DB_PREFIX . "collections_description id ON (i.collections_id = id.collections_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i.status = '1' ORDER BY i.date_modified DESC LIMIT 0," . $quantity);
        
//        var_dump($query->rows);
		return $query->rows;
	}
}