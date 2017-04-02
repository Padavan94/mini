<?php
class ModelBlogspecialoffers extends Model {

	/**
	 * Get active special_offers data by special_offers_id
	 * @param  int   $special_offers_id		Selected index of special_offers data
	 * @return array                Return selected special_offers data
	 */
	public function getBlogById($special_offers_id)
	{
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "special_offers i LEFT JOIN ". DB_PREFIX . "special_offers_description id ON (i.special_offers_id = id.special_offers_id) WHERE i.special_offers_id = '" . (int)$special_offers_id . "' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i.status = '1'");

		return $query->row;
	}

	/**
	 * Get all active special_offers data
	 * @return array		All special_offers data
	 */
	public function getBlog($start=0, $limit=0)
	{
		$sql = "SELECT DISTINCT * FROM " . DB_PREFIX . "special_offers i LEFT JOIN ". DB_PREFIX . "special_offers_description id ON (i.special_offers_id = id.special_offers_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i.status = '1' ORDER BY i.date_added DESC";
        if($start || $limit){
            $sql .= " LIMIT $start, $limit";
        }
        $query = $this->db->query($sql);
//        var_dump($sql);
		return $query->rows;
	}
    
     public function getBlogByIdImages($special_offers_id)
	{
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "special_offers_images i WHERE i.id_special_offers = '" . (int)$special_offers_id . "' ORDER BY i.sort_order ASC");

		return $query->rows;
	}
}
