<?php
/**
 * Blog Controller in design modules
 */
class ControllerDesignspecialoffers extends Controller
{
	private $error = array();

	public function index() {
		$this->language->load('design/special_offers');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/special_offers');

		$this->getList();
	}

	public function add() {
		$this->language->load('design/special_offers');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/special_offers');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_design_special_offers->addspecial_offers($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('design/special_offers', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->language->load('design/special_offers');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/special_offers');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_design_special_offers->editspecial_offers($this->request->get['special_offers_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('design/special_offers', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('design/special_offers');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/special_offers');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $special_offers_id) {
				$this->model_design_special_offers->deletespecial_offers($special_offers_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('design/special_offers', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	public function repair() {
		$this->language->load('design/special_offers');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/special_offers');

		if ($this->validateRepair()) {
			$this->model_design_special_offers->repairspecial_offers();

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('design/special_offers', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('design/special_offers', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('design/special_offers/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('design/special_offers/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['repair'] = $this->url->link('design/special_offers/repair', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['special_offerss'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$special_offers_total = $this->model_design_special_offers->getTotalspecial_offerss();

		$results = $this->model_design_special_offers->getspecial_offerss($filter_data);

		foreach ($results as $result) {
			$data['special_offerss'][] = array(
				'special_offers_id' => $result['special_offers_id'],
				'name'        => $result['name'],
				'sort_order'  => $result['sort_order'],
				'edit'        => $this->url->link('design/special_offers/edit', 'token=' . $this->session->data['token'] . '&special_offers_id=' . $result['special_offers_id'] . $url, 'SSL'),
				'delete'      => $this->url->link('design/special_offers/delete', 'token=' . $this->session->data['token'] . '&special_offers_id=' . $result['special_offers_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');
        $data['column_status'] = $this->language->get('column_status');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_rebuild'] = $this->language->get('button_rebuild');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('design/special_offers', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_sort_order'] = $this->url->link('design/special_offers', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $special_offers_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('design/special_offers', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($special_offers_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($special_offers_total - $this->config->get('config_limit_admin'))) ? $special_offers_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $special_offers_total, ceil($special_offers_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('design/special_offers_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['special_offers_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_url'] = $this->language->get('text_url');
        $data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_parent'] = $this->language->get('entry_parent');
        $data['entry_url'] = $this->language->get('entry_url');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_column'] = $this->language->get('entry_column');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');
        $data['tab_image'] = $this->language->get('tab_image');
        $data['entry_additional_image'] = $this->language->get('entry_additional_image');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		if (isset($this->error['meta_title'])) {
			$data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$data['error_meta_title'] = array();
		}

		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('design/special_offers', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['special_offers_id'])) {
			$data['action'] = $this->url->link('design/special_offers/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('design/special_offers/edit', 'token=' . $this->session->data['token'] . '&special_offers_id=' . $this->request->get['special_offers_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('design/special_offers', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['special_offers_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$special_offers_info = $this->model_design_special_offers->getspecial_offers($this->request->get['special_offers_id']);
		}

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['special_offers_description'])) {
			$data['special_offers_description'] = $this->request->post['special_offers_description'];
		} elseif (isset($this->request->get['special_offers_id'])) {
			$data['special_offers_description'] = $this->model_design_special_offers->getspecial_offersDescriptions($this->request->get['special_offers_id']);
		} else {
			$data['special_offers_description'] = array();
		}

//        if (isset($this->request->post['path'])) {
//			$data['path'] = $this->request->post['path'];
//		} elseif (!empty($special_offers_info)) {
//			$data['path'] = $special_offers_info['path'];
//		} else {
//			$data['path'] = '';
//		}

		if (isset($this->request->post['parent_id'])) {
			$data['parent_id'] = $this->request->post['parent_id'];
		} elseif (!empty($special_offers_info)) {
			$data['parent_id'] = $special_offers_info['parent_id'];
		} else {
			$data['parent_id'] = 0;
		}

        if (isset($this->request->post['url'])) {
			$data['url'] = $this->request->post['url'];
		} elseif (!empty($special_offers_info)) {
			$data['url'] = $special_offers_info['url'];
		} else {
			$data['url'] = '';
		}

        if (isset($this->request->post['url'])) {
			$data['link_layout_id'] = $this->request->post['url'];
		} elseif (!empty($special_offers_info)) {
			$data['url'] = $special_offers_info['url'];
		} else {
			$data['url'] = '';
		}

		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($special_offers_info)) {
			$data['image'] = $special_offers_info['image'];
		} else {
			$data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($special_offers_info) && is_file(DIR_IMAGE . $special_offers_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($special_offers_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($special_offers_info)) {
			$data['sort_order'] = $special_offers_info['sort_order'];
		} else {
			$data['sort_order'] = 0;
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($special_offers_info)) {
			$data['status'] = $special_offers_info['status'];
		} else {
			$data['status'] = true;
		}

		if (isset($this->request->post['special_offers_layout'])) {
			$data['special_offers_layout'] = $this->request->post['special_offers_layout'];
		} elseif (isset($this->request->get['special_offers_id'])) {
			$data['special_offers_layout'] = $this->model_design_special_offers->getspecial_offersLayouts($this->request->get['special_offers_id']);
		} else {
			$data['special_offers_layout'] = array();
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
        // Images
		if (isset($this->request->post['special_offers_image'])) {
			$special_offers_images = $this->request->post['special_offers_image'];
		} elseif (isset($this->request->get['special_offers_id'])) {
//			$special_offers_images = $this->model_catalog_product->getProductImages($this->request->get['special_offers_id']);
            $special_offers_images = $this->model_design_special_offers->getspecial_offersImages($this->request->get['special_offers_id']);
//            $special_offers_images = array();
		} else {
			$special_offers_images = array();
		}
        $data['special_offers_images'] = array();

		foreach ($special_offers_images as $special_offers_image) {
//			if (is_file(DIR_IMAGE . $product_image['image'])) {
				$image = $special_offers_image['image'];
				$thumb = $special_offers_image['image'];
//			} else {
//				$image = '';
//				$thumb = 'no_image.png';
//			}
			$data['special_offers_images'][] = array(
				'image'      => $image,
				'thumb'      => $this->model_tool_image->resize($thumb, 100, 100),
				'sort_order' => $special_offers_image['sort_order']
			);
		}
		$this->response->setOutput($this->load->view('design/special_offers_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'design/special_offers')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['special_offers_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'design/special_offers')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validateRepair() {
		if (!$this->user->hasPermission('modify', 'design/special_offers')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('design/special_offers');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 50
			);

			$results = $this->model_design_special_offers->getspecial_offers($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'special_offers_id' => $result['special_offers_id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
