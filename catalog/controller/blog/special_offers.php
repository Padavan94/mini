<?php

class ControllerBlogspecialoffers extends Controller
{
	private $error = array();

	public function index()
	{
        $this->load->language('blog/category');
        $data['text_share'] = $this->language->get('text_share');
        $data['text_button'] = $this->language->get('text_button');
        $data['text_error'] = $this->language->get('not_found');
        $data['text_date_added'] = $this->language->get('text_date_added');
        $data['text_read'] = $this->language->get('text_read');
//        var_dump($data);

//            $this->load->language('blog/special_offers');

            $this->document->setTitle("Lookbook");

            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/home')
            );

            $data['breadcrumbs'][] = array(
                'text' => "Lookbook",
                'href' => $this->url->link('blog/special_offers')
            );

            $data['heading_title'] = $this->language->get('heading_title');
        if(!isset($this->request->get['path'])) {

            // get all blog data
            $this->load->model('blog/special_offers');

        if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
         
        //if (isset($this->request->get['limit'])) {
		//	$limit = (int)$this->request->get['limit'];
		//} else {
			//$limit = $this->config->get('config_product_limit');
                        $limit=3;
		//}
            //$blogs = $this->model_blog_special_offers->getBlog();
	$special_offerss_total = count($this->model_blog_special_offers->getBlog());
	$pagination = new Pagination();
        $pagination->total = $special_offerss_total;
        $pagination->page = $page;
        $pagination->limit = $limit;
        $pagination->url = $this->url->link($this->request->get['route'], '&page={page}');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($special_offerss_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($special_offerss_total - $limit)) ? $special_offerss_total : ((($page - 1) * $limit) + $limit), $special_offerss_total, ceil($special_offerss_total / ($limit+1)));

        // http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
        if ($page == 1) {
            $this->document->addLink($this->url->link($this->request->get['route'], 'SSL'), 'canonical');
        } elseif ($page == 2) {
            $this->document->addLink($this->url->link($this->request->get['route'], 'SSL'), 'prev');
        } else {
            $this->document->addLink($this->url->link($this->request->get['route'], '&page='. ($page - 1), 'SSL'), 'prev');
        }

        if ($limit && ceil($special_offerss_total / $limit) > $page) {
            $this->document->addLink($this->url->link($this->request->get['route'], '&page='. ($page + 1), 'SSL'), 'next');
        }
        
        
        $start = ($page - 1) * $limit;
        
        
        
        

		$special_offerss = $this->model_blog_special_offers->getBlog($start,$limit);
                



            if(!empty($special_offerss))
            foreach($special_offerss as $b => $blog)                
            {	
                
                if (!$blog['image']){
                    $blog['image']= 'no_image.png';
                }
                
                $data['blog'][$b]['name'] = $blog['name'];
                $data['blog'][$b]['image'] = $blog['image'];
                $data['blog'][$b]['description'] = $blog['description'];
                $data['blog'][$b]['day'] = date('j', strtotime($blog['date_added']));
                $data['blog'][$b]['blog_id'] = $blog['special_offers_id'];                 
                $data['blog'][$b]['month'] = $data['text_date_added'][date('n', strtotime($blog['date_added']))];
                $data['blog'][$b]['year'] = date('Y', strtotime($blog['date_added']));                
                $data['blog'][$b]['date_added'] = date('j.m.Y', strtotime($blog['date_added']));
                $data['blog'][$b]['time_added'] = date('H:i', strtotime($blog['date_added']));
                
                $images = $this->model_blog_special_offers->getBlogByIdImages($blog['special_offers_id']);
                
                if($images){                    
                    $data['blog'][$b]['images'] = $images;                    
                } 
                else {
                    $data['blog'][$b]['images'] = array();                   
                }
                
                
                
            }
            //rsort($data['blog']);
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['column_right'] = $this->load->controller('common/column_right');
            $data['content_top'] = $this->load->controller('common/content_top');
            $data['content_bottom'] = $this->load->controller('common/content_bottom');
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');
//            var_dump($data);
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/blog/special_offers.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/blog/special_offers.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('blog/special_offers.tpl', $data));
            }
        
        } else {
            
            $this->load->language('blog/special_offers');
            $this->document->setTitle("Lookbook");
            $this->load->model('tool/image');
            $data['heading_title'] = $this->language->get('heading_title');

            // get all blog data
            $this->load->model('blog/special_offers');

            $blog = $this->model_blog_special_offers->getBlogById($this->request->get['path']);

            if($blog){
                $data['blog'] = $blog;
            } else {
                $data['blog'] = array();
            }
            
            $data['blog']['day'] = date('n', strtotime($blog['date_added']));
            $data['blog']['month'] = $data['text_date_added'][date('n', strtotime($blog['date_added']))];
            $data['blog']['year'] = date('Y', strtotime($blog['date_added']));
            $data['blog']['date_added'] = date('j.m.Y', strtotime($blog['date_added']));
            $data['blog']['time_added'] = date('H:i', strtotime($blog['date_added']));
            
//            var_dump($blog);
            $images = $this->model_blog_special_offers->getBlogByIdImages($this->request->get['path']);
            if($images){
                $data['images'] = $images;
            } else {
                $data['images'] = array();
            }
            
//            var_dump( $data['images']);
            $data['breadcrumbs'][] = array(
                'text' => $data['blog']['name'],
                'href' => $this->url->link('blog/special_offers')
            );
            
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['column_right'] = $this->load->controller('common/column_right');
            $data['content_top'] = $this->load->controller('common/content_top');
            $data['content_bottom'] = $this->load->controller('common/content_bottom');
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');
            
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/special_offers/special_offers-single.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/blog/special_offers-single.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('/blog/special_offers-single.tpl', $data));
            }
        }
	}
}
