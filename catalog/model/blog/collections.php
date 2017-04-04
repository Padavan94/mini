<?php
class ModelBlogCollections extends Model {

	/**
	 * Get active collections data by collections_id
	 * @param  int   $collections_id		Selected index of collections data
	 * @return array                Return selected collections data
	 */
	public function getBlogById($collections_id)
	{
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "collections i LEFT JOIN ". DB_PREFIX . "collections_description id ON (i.collections_id = id.collections_id) WHERE i.collections_id = '" . (int)$collections_id . "' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i.status = '1'");

		return $query->row;
	}

	/**
	 * Get all active collections data
	 * @return array		All collections data
	 */
	public function getBlog($start=0, $limit=0)
	{
		$sql = "SELECT DISTINCT * FROM " . DB_PREFIX . "collections i LEFT JOIN ". DB_PREFIX . "collections_description id ON (i.collections_id = id.collections_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i.status = '1' ORDER BY i.date_added DESC";
        if($start || $limit){
            $sql .= " LIMIT $start, $limit";
        }
        $query = $this->db->query($sql);
//        var_dump($sql);
		return $query->rows;
	}
    
     public function getBlogByIdImages($collections_id)
	{
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "collections_images i WHERE i.id_collections = '" . (int)$collections_id . "' ORDER BY i.sort_order ASC");

		return $query->rows;
	}
}
