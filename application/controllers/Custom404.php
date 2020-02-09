<?php
class Custom404 extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('CategoryModel');

	}
 
	public function index()
	{


		$uri_string = explode("/", uri_string());
		$uri_string_end = end($uri_string);

		if(is_numeric($uri_string_end))
		{
			$page = $uri_string_end;
			$post_name = $uri_string[count($uri_string)-2];
			$post = get_uri_not_found_data($post_name);
			$data['post'] = $post;

		}
		else
		{
			$page = 1;
			$post = get_uri_not_found_data(end($uri_string));

//print_r($post);exit();

		}


		if(isset($post))
		{
			if(isset($post->product_id))
			{
				$data['prod_row'] = $post;
				$data['page_title']		=	$post->product_title;
				$data['page_name']		=	'single product';
				$data['seo_title']		=	get_product_meta($post->product_id, 'seo_title');
				$data['seo_keywords']	=	get_product_meta($post->product_id, 'seo_keywords');
				$data['seo_content']	=	get_product_meta($post->product_id, 'seo_content');
//				$data['home']=$this->load->view('product_font_view', $data,true );
//				$this->load->view('website/home',$data);
				$sql="SELECT category_title,category_name FROM `term_relation` join category on category.category_id=term_relation.term_id
WHERE product_id=$post->product_id limit 1";
			$category=get_result($sql);
				$data['breadcumb_category']=$category[0]->category_title;
				$data['breadcumb_category_link']=$category[0]->category_name;
			//print_r($breadcumb_category);
				$this->load->view('website/header', $data);
				$this->load->view('website/product_font_view', $data);
				$this->load->view('website/footer', $data);
			}
			elseif(isset($post->category_id))
			{
				$cat=$post->category_name;
				$sortby = 'default';
				$price_from=0;
				$price_to=100000;

				$sql="SELECT category_title,category_name FROM `category` WHERE category_id=$post->category_id limit 1";
				$category=get_result($sql);

				$data['breadcumb_category']=$category[0]->category_title;
				$data['breadcumb_category_link']=$category[0]->category_name;
				$category_id 				= 	$post->category_id;
				$category_title				=	get_category_title($category_id);
				$category_name				=	get_category_name($category_id);
				$catinfo					=	get_category_info($category_id);

				$data['products']			=	$this->CategoryModel->archive_product($category_id);
				$data['total_rows']			=	$this->CategoryModel->total_rows($category_id);


				$data['page_title']			=	ucwords(str_replace("-", " ", $cat));
				$data['page_name'] 			= 	'archive';
				//print_r()

				$data['seo_title']			=	$catinfo->seo_title;
				$data['seo_keywords']		=	$catinfo->seo_keywords;
				$data['seo_content']		=	$catinfo->seo_content;

				$data['category_title']		=	$category_title;
				$data['category_id']		=	$category_id;
				$data['category_name']		=	$category_name;
				$data['catinfo']			=	$catinfo;
				

				$this->load->view('website/header', $data);
				$this->load->view('website/category_products', $data);
				$this->load->view('website/footer', $data);
			}
			else
			{


				$data['page_title']		=	$post->page_name;
				$data['page_name']		=	$post->page_link;
				$data['page_content']	=$post->page_content;

				$template = $post->page_template;
				$template = $template == 'default' ? 'page' : $template;

				$this->load->view('website/header', $data);
				$this->load->view($template, $data);
				$this->load->view('website/footer', $data);
			}
		}
		else
		{
			$data['page_title']='Not Found';
			$data['page_name']='not-found';
			
			$this->load->view('website/header', $data);
			$this->load->view('custom404', $data);
			$this->load->view('website/footer', $data);
		}
	}
}
