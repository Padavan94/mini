<?php
class ControllerModuleSpecialOffersWidget extends Controller {
	public function index($setting) {
//        var_dump($setting);
		static $module = 0;

		$this->load->model('design/special_offers_widget');
		$this->load->model('tool/image');

		//$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		//$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.transitions.css');
		//$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');

		$data['special_offers'] = array();

		$results = $this->model_design_special_offers_widget->getSpecialOffer($setting['quantity']);
//        var_dump($results);
//        die();

		foreach ($results as $result) {
			/*if (is_file(DIR_IMAGE . $result['image'])) {
				$data['special_offers'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
				);
			}*/
            if (!$result['image']){
                $result['image']= 'no_image.png';
            }
                        $data['special_offers'][] = array(
					'title' => $result['name'],
					'link'  => $this->url->link('blog/special_offers', '', 'SSL') . '&path=' . $result['special_offers_id'],
                    'image' => '/image/' . $result['image'],
//                    'description'  => $result['description'],
                    'description'  => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 200) . '..',

                                );
		}

		$data['module'] = $module++;
return $this->load->view('module/special_offers_widget', $data);
	/*	if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/special_offers_widget.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/special_offers_widget.tpl', $data);
		} else {
			return $this->load->view('default/template/module/special_offers_widget.tpl', $data);
		}*/
	}
}