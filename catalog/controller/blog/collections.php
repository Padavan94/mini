<?php

class ControllerBlogCollections extends Controller
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

//            $this->load->language('blog/collections');

            $this->document->setTitle("Коллекции");

            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/home')
            );

            $data['breadcrumbs'][] = array(
                'text' => "Коллекции",
                'href' => $this->url->link('blog/collections')
            );

            $data['heading_title'] = $this->language->get('heading_title');
        if(!isset($this->request->get['path'])) {

            // get all blog data
            $this->load->model('blog/collections');

        if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
         
        if (isset($this->request->get['limit'])) {
                $limit = (int)$this->request->get['limit'];
        } else {
                $limit = $this->config->get('config_product_limit');
                //$limit=3;
        }
            //$blogs = $this->model_blog_collections->getBlog();
	$collectionss_total = count($this->model_blog_collections->getBlog());
	$pagination = new Pagination();
        $pagination->total = $collectionss_total;
        $pagination->page = $page;
        $pagination->limit = $limit;
        $pagination->url = $this->url->link($this->request->get['route'], '&page={page}');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($collectionss_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($collectionss_total - $limit)) ? $collectionss_total : ((($page - 1) * $limit) + $limit), $collectionss_total, ceil($collectionss_total / ($limit+1)));

        // http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
        if ($page == 1) {
            $this->document->addLink($this->url->link($this->request->get['route'], 'SSL'), 'canonical');
        } elseif ($page == 2) {
            $this->document->addLink($this->url->link($this->request->get['route'], 'SSL'), 'prev');
        } else {
            $this->document->addLink($this->url->link($this->request->get['route'], '&page='. ($page - 1), 'SSL'), 'prev');
        }

        if ($limit && ceil($collectionss_total / $limit) > $page) {
            $this->document->addLink($this->url->link($this->request->get['route'], '&page='. ($page + 1), 'SSL'), 'next');
        }
        
        
        $start = ($page - 1) * $limit;
        
        
        
        

		$collectionss = $this->model_blog_collections->getBlog($start,$limit);
                



            if(!empty($collectionss))
            foreach($collectionss as $b => $blog)                
            {	
                
                if (!$blog['image']){
                    $blog['image']= 'no_image.png';
                }
                
                $data['blog'][$b]['name'] = $blog['name'];
                $data['blog'][$b]['image'] = $blog['image'];
                $data['blog'][$b]['description'] = $blog['description'];
                $data['blog'][$b]['day'] = date('j', strtotime($blog['date_added']));
                $data['blog'][$b]['blog_id'] = $blog['collections_id'];                 
                $data['blog'][$b]['month'] = $data['text_date_added'][date('n', strtotime($blog['date_added']))];
                $data['blog'][$b]['year'] = date('Y', strtotime($blog['date_added']));                
                $data['blog'][$b]['date_added'] = date('j.m.Y', strtotime($blog['date_added']));
                $data['blog'][$b]['time_added'] = date('H:i', strtotime($blog['date_added']));
                
                $images = $this->model_blog_collections->getBlogByIdImages($blog['collections_id']);
                
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
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/blog/collections.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/blog/collections.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('blog/collections.tpl', $data));
            }
        
        } else {
            
            $this->load->language('blog/collections');
            $this->document->setTitle("Коллекции");
            $this->load->model('tool/image');
            $data['heading_title'] = $this->language->get('heading_title');

            // get all blog data
            $this->load->model('blog/collections');

            $blog = $this->model_blog_collections->getBlogById($this->request->get['path']);

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
            $images = $this->model_blog_collections->getBlogByIdImages($this->request->get['path']);
            if($images){
                $data['images'] = $images;
            } else {
                $data['images'] = array();
            }
            
//            var_dump( $data['images']);
            $data['breadcrumbs'][] = array(
                'text' => $data['blog']['name'],
                'href' => $this->url->link('blog/collections')
            );
            
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['column_right'] = $this->load->controller('common/column_right');
            $data['content_top'] = $this->load->controller('common/content_top');
            $data['content_bottom'] = $this->load->controller('common/content_bottom');
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');
            
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/collections/collections-single.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/blog/collections-single.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('/blog/collections-single.tpl', $data));
            }
        }
	}
}
