<?php
class ControllerModuleCollectionsWidget extends Controller {
	public function index($setting) {
//        var_dump($setting);
		static $module = 0;

		$this->load->model('design/collections_widget');
		$this->load->model('tool/image');

		//$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		//$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.transitions.css');
		//$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');

		$data['collections'] = array();

		$results = $this->model_design_collections_widget->getSpecialOffer($setting['quantity']);
//        var_dump($results);
//        die();

		foreach ($results as $result) {
			/*if (is_file(DIR_IMAGE . $result['image'])) {
				$data['collections'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
				);
			}*/
            if (!$result['image']){
                $result['image']= 'no_image.png';
            }
                        $data['collections'][] = array(
					'title' => $result['name'],
					'link'  => $this->url->link('blog/collections', '', 'SSL') . '&path=' . $result['collections_id'],
                    'image' => '/image/' . $result['image'],
//                    'description'  => $result['description'],
                    'description'  => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 70) . '..',

                                );
		}

		$data['module'] = $module++;
return $this->load->view('module/collections_widget', $data);
	/*	if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/collections_widget.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/collections_widget.tpl', $data);
		} else {
			return $this->load->view('default/template/module/collections_widget.tpl', $data);
		}*/
	}
}