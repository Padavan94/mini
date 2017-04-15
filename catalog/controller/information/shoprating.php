<?php
class ControllerInformationShoprating extends Controller {
	public function index() {

		$this->load->model('catalog/shoprating');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
                $data['breadcrumbs'][] = array(
                    'text' => 'Отзывы поупателей',
                    'href' => $this->url->link('information/shoprating')
                );
                //var_dump($this->model_catalog_shoprating->getLastReviews(5));
		$data['last_reviews'] = $this->model_catalog_shoprating->getLastReviews(5);
                        
                $data['column_left'] = $this->load->controller('common/column_left');
                $data['column_right'] = $this->load->controller('common/column_right');
                $data['content_top'] = $this->load->controller('common/content_top');
                $data['content_bottom'] = $this->load->controller('common/content_bottom');
                $data['footer'] = $this->load->controller('common/footer');
                $data['header'] = $this->load->controller('common/header');

                $this->response->setOutput($this->load->view('information/shoprating', $data));
		
	}
}