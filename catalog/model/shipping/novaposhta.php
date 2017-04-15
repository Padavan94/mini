<?php

class ModelShippingNovaPoshta extends Model
{
    private $productWeight = 0.1;
    private $width = 1;
    private $height = 1;
    private $length = 1;
    private $total = 1;
    private $apiUrl = 'https://api.novaposhta.ua/v2.0/xml/';

    function getQuote($address)
    {
        if ($this->cart->hasProducts()) {
            $this->total = $this->cart->getTotal();
            foreach ($this->cart->getProducts() as $product) {
                if ($product['shipping']) {
                    $this->productWeight += $this->weight->convert($product['weight'], $product['weight_class_id'], $this->config->get('config_weight_class_id'));
                    $this->height += $product['height'];
                    $this->width += $product['width'];
                    $this->height += $product['height'];
                    $this->length += $product['length'];
                }
            }
        }

        $this->load->language('shipping/novaposhta');
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('novaposhta_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
        if (!$this->config->get('novaposhta_geo_zone_id')) {
            $status = true;
        } elseif ($query->num_rows) {
            $status = true;
        } else {
            $status = false;
        }
        $shippingResult = array();
		
        if ($status) {
			//var_dump($address);
            if ($this->config->get('novaposhta_api_key') && $this->config->get('novaposhta_sender_city')) {
                $shippingPriceData = array();
                
                $shippingPriceData['warehouse'] = array(
                    'code' => 'novaposhta.warehouse',
                    'title' => $this->language->get('text_novaposhta_warehouse'),
                    'cost' => 0,
                    'tax_class_id' => 0,
                    'text' => /*$this->currency->format(0.00, $this->session->data['currency'])*/ ''
                );

                if ($shippingPriceData) {
                    $shippingResult = array(
                        'code' => 'novaposhta',
                        'title' => $this->language->get('text_title'),
                        'quote' => $shippingPriceData,
                        'sort_order' => $this->config->get('novaposhta_sort_order'),
                        'error' => false
                    );
                }
            }
        }
        return $shippingResult;
    }

    private function getDocumentPrice($city)
    {
		//var_dump($this->productWeight);
		//var_dump($this->getCityRefByName(trim($city)) );
        $xml = '<?xml version="1.0" encoding="utf-8" ?>';
        $xml .= '<file>';
        $xml .= '<apiKey>' . $this->config->get('novaposhta_api_key') . '</apiKey>';
        $xml .= '<modelName>InternetDocument</modelName>';
        $xml .= '<calledMethod>getDocumentPrice</calledMethod>';
        $xml .= '<methodProperties>';
        $xml .= '<CitySender>' . $this->config->get('novaposhta_sender_city') . '</CitySender>';
        $xml .= '<CityRecipient>' . $this->getCityRefByName(trim($city)) . '</CityRecipient>';
        $xml .= '<Weight>' . $this->productWeight . '</Weight>';
        $xml .= '<Cost>' . $this->total . '</Cost>';
        $xml .= '<ServiceType>DoorsDoors</ServiceType>';
        $xml .= '</methodProperties>';
        $xml .= '</file>';

        $response = $this->getResult($xml);

        if ($response) {
            return simplexml_load_string($response);
        } else {
            return false;
        }
    }

    public function getDocumentPriceByRef($cityRef)
    {
		//var_dump($this->productWeight);
		//var_dump($this->getCityRefByName(trim($city)) );
        $xml = '<?xml version="1.0" encoding="utf-8" ?>';
        $xml .= '<file>';
        $xml .= '<apiKey>' . $this->config->get('novaposhta_api_key') . '</apiKey>';
        $xml .= '<modelName>InternetDocument</modelName>';
        $xml .= '<calledMethod>getDocumentPrice</calledMethod>';
        $xml .= '<methodProperties>';
        $xml .= '<CitySender>' . $this->config->get('novaposhta_sender_city') . '</CitySender>';
        $xml .= '<CityRecipient>' . $cityRef . '</CityRecipient>';
        $xml .= '<Weight>' . $this->productWeight . '</Weight>';
        $xml .= '<Cost>' . $this->total . '</Cost>';
        $xml .= '<ServiceType>DoorsDoors</ServiceType>';
        $xml .= '</methodProperties>';
        $xml .= '</file>';

        $response = $this->getResult($xml);

        if ($response) {
            return (string)simplexml_load_string($response)->data->item->Cost;
        } else {
            return false;
        }
    }    
    
	public function getAreas()
    {
        $xml = '<?xml version="1.0" encoding="utf-8" ?>';
        $xml .= '<file>';
        $xml .= '<apiKey>' . $this->config->get('novaposhta_api_key') . '</apiKey>';
        $xml .= '<modelName>Address</modelName>';
        $xml .= '<calledMethod>getAreas</calledMethod>';
        $xml .= '</file>';

        $response = $this->getResult($xml);
		$areas = array();

        if ($response) {
            $xml = simplexml_load_string($response);

            foreach ($xml->data->item as $area) {
				$tarea = array();
				$tarea['ref'] = $area->Ref;
                if ($this->language->get('code') == 'ru') {
                    $tarea['descr'] = $area->DescriptionRu;
                } else {
                    $tarea['descr'] = $area->Description;
                }
				$areas[] = $tarea;
            }
        }
        return $areas;
    }
	
	public function getCitys()
    {
        $xml = '<?xml version="1.0" encoding="utf-8" ?>';
        $xml .= '<file>';
        $xml .= '<apiKey>' . $this->config->get('novaposhta_api_key') . '</apiKey>';
        $xml .= '<modelName>Address</modelName>';
        $xml .= '<calledMethod>getCities</calledMethod>';
        $xml .= '</file>';

        $response = $this->getResult($xml);
		$city = array();

        if ($response) {
            $xml = simplexml_load_string($response);

            foreach ($xml->data->item as $citys) {
				$tarea = array();
                $tarea['id'] = (string)$citys->CityID;
				$tarea['ref'] = (string)$citys->Ref;
				$tarea['area'] = (string)$citys->Area;
                if ($this->language->get('code') == 'ru') {
                    $tarea['descr'] = (string)$citys->DescriptionRu;
                } else {
                    $tarea['descr'] = (string)$citys->Description;
                }
				$city[] = $tarea;
            }
        }
        return $city;
    }
	
    private function getCityRefByName($name)
    {
        $xml = '<?xml version="1.0" encoding="utf-8" ?>';
        $xml .= '<file>';
        $xml .= '<apiKey>' . $this->config->get('novaposhta_api_key') . '</apiKey>';
        $xml .= '<modelName>Address</modelName>';
        $xml .= '<calledMethod>getCities</calledMethod>';
        $xml .= '</file>';

        $response = $this->getResult($xml);

        if ($response) {
            $xml = simplexml_load_string($response);

            foreach ($xml->data->item as $city) {
                if ($this->language->get('code') == 'ru') {
                    $cityName = $city->DescriptionRu;
                } else {
                    $cityName = $city->Description;
                }
                if ($cityName == $name) {
                    return $city->Ref;
                }
            }
        }
        return '';
    }

	function getStreetRefByCity($cityref)
    {
        if(!$cityref){
            return [];
        }
        $xml = '<?xml version="1.0" encoding="utf-8" ?>';
        $xml .= '<file>';
        $xml .= '<apiKey>' . $this->config->get('novaposhta_api_key') . '</apiKey>';
        $xml .= '<modelName>Address</modelName>';
		//$xml .= '<methodProperties> <CityRef>'.$this->getCityRefByName(trim($cityref)).'</CityRef> <Page>1</Page> </methodProperties>';
        $xml .= '<methodProperties> <CityRef>'.$cityref.'</CityRef> <Page>1</Page> </methodProperties>';
        $xml .= '<calledMethod>getWarehouses</calledMethod>';
        $xml .= '</file>';

        $response = $this->getResult($xml);
		$data = array();
		if ($response) {
            $xml = simplexml_load_string($response);

            foreach ($xml->data->item as $city) {
                $data[] = $city->Description;
            }
        }
        return $data; 
    }
	
    private function getResult($request)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}

