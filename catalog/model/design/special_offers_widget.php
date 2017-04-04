<?php
class ModelDesignSpecialOffersWidget extends Model {
//	public function getSpecialOffer($special_offers_id) {
//		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "special_offers_image bi LEFT JOIN " . DB_PREFIX . "special_offers_image_description bid ON (bi.special_offers_image_id  = bid.special_offers_image_id) WHERE bi.special_offers_id = '" . (int)$special_offers_id . "' AND bid.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY bi.sort_order ASC");
//        var_dump($query->rows);
//		return $query->rows;
//	}
    
    public function getSpecialOffer($quantity=5)
	{
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "special_offers i LEFT JOIN ". DB_PREFIX . "special_offers_description id ON (i.special_offers_id = id.special_offers_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i.status = '1' ORDER BY i.date_modified DESC LIMIT 0," . $quantity);
        
//        var_dump($query->rows);
		return $query->rows;
	}
}