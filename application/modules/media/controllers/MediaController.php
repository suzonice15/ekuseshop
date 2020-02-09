<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MediaController extends MX_Controller
{

	public function __construct()
	{
		$this->load->model('MainModel');

		$userType=$this->session->userdata('user_type');
		if($userType !='super-admin' &&  $userType !='admin'){
			redirect('admin');
		}
	}

	public function index()
	{

		$data['main'] = "Media";
		$data['active'] = "View Midia";


			$data['pageContent'] = $this->load->view('media/media/media_index', $data, true);
			$this->load->view('layouts/main', $data);
		


	}

	function pagination()
	{
		$this->load->model("OrderModel");
		$this->load->library("pagination");
		$config = array();
		$config["base_url"] = "#";

		$search=$this->input->post('search');
		if($search){
			$config["total_rows"] = $this->OrderModel->count_all_by_search($search);


		} else {

			$config["total_rows"] = $this->OrderModel->count_all();
		}
		$config["per_page"] = 10;
		$config["uri_segment"] = 4;
		$config["use_page_numbers"] = TRUE;
		$config["full_tag_open"] = '<ul class="pagination">';
		$config["full_tag_close"] = '</ul>';
		$config["first_tag_open"] = '<li>';
		$config["first_tag_close"] = '</li>';
		$config["last_tag_open"] = '<li>';
		$config["last_tag_close"] = '</li>';
		$config['next_link'] = '&gt;';
		$config["next_tag_open"] = '<li>';
		$config["next_tag_close"] = '</li>';
		$config["prev_link"] = "&lt;";
		$config["prev_tag_open"] = "<li>";
		$config["prev_tag_close"] = "</li>";
		$config["cur_tag_open"] = "<li class='active'><a href='#'>";
		$config["cur_tag_close"] = "</a></li>";
		$config["num_tag_open"] = "<li>";
		$config["num_tag_close"] = "</li>";
		$config["num_links"] = 3;
		$this->pagination->initialize($config);
		if($search){
			$page =1;


		} else {

			$page = $this->uri->segment(4);
		}

		$start = ($page - 1) * $config["per_page"];

		if($search){

			$output = array(
				'pagination_link'  => $this->pagination->create_links(),
				'media'   => $this->OrderModel->fetch_product_by_search($config["per_page"], $start,$search)
			);


		} else {

			$output = array(
				'pagination_link'  => $this->pagination->create_links(),
				'media'   => $this->OrderModel->fetch_products($config["per_page"], $start)
			);
		}


		echo json_encode($output);
	}


	public function create()
	{

		$data['title'] = "Media registration form ";
		$data['main'] = "Media";
		$data['active'] = "Add Media";
		$data['categories'] = $this->MainModel->getAllData('', 'category', '*', 'parent_id ASC');
		$data['pageContent'] = $this->load->view('media/media/media_create', $data, true);
		$this->load->view('layouts/main', $data);
	}


	public function store()
	{
		$row_data['media_title'] = $this->input->post('media_title');
		$this->form_validation->set_rules('media_title', 'Category Title', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			redirect('media-create');
			$this->session->set_flashdata('error', 'Fill Up all the field !!!!!!!!!!!!!!!!!!!');
		} else {
			if (isset($_FILES["featured_image"]) && $_FILES["featured_image"]["size"] > 50) {
				$uploaded_image_path = "uploads/" . date('d-m-Y-') . $_FILES["featured_image"]["name"];
				$uploaded_file_path = "uploads/" . $_FILES["featured_image"]["name"];

				if (!file_exists($uploaded_file_path)) {
					move_uploaded_file($_FILES["featured_image"]["tmp_name"], $uploaded_image_path);

					$media_data = array();
					$row_data['media_path'] = $uploaded_image_path;
					$row_data['created_time'] = date("Y-m-d H:i:s");
				} else {
					move_uploaded_file($_FILES["featured_image"]["tmp_name"], $uploaded_image_path);
					$media_id = get_media_id($uploaded_file_path);
				}

				$row_data['media_id'] = $media_id;
			}


			if ($this->MainModel->insertData('media', $row_data)) {

				$this->session->set_flashdata('message', 'Media  added successfully   !!!!!!');
				redirect('media-list');

			} else {

				$this->session->set_flashdata('error', 'Media does not add successfully  !!!!!!');
				redirect('media-create');

			}
		}
	}


	public function show($id)
	{

	}

	public function edit($id)
	{

	}

	public function picture_delete()
	{
		$picture=$this->input->post('picture');

		if(isset($picture)){

			$picture_path=$picture;
			//print_r($picture_path);
			if (file_exists($picture_path)) {
				unlink($picture_path);
				$this->session->set_flashdata('message', 'Picture  delete successfully   !!!!!!');
				redirect('picture-delete');
			}
			else {
				$this->session->set_flashdata('error', 'Picture  not found  failed to delete    !!!!!!');
				redirect('picture-delete');

			}
		} else {
			$data['title'] = "Media Picture delete  form ";
			$data['main'] = "Media";
			$data['active'] = "delete Picture";
			$data['pageContent'] = $this->load->view('media/media/media_picture_delete', $data, true);
			$this->load->view('layouts/main', $data);


		}



	}


	public function multipleDelete()
	{
		$media = $this->input->post('media_id');
		for ($i = 0; $i < sizeof($media); $i++) {
			$result = $this->MainModel->deleteData('media_id', $media[$i], 'media');
		}

		if ($result) {

			echo('Multiple Media deleted succefully');
		} else {
			echo('Multiple Media does not  deleted succefully');

		}

	}

	public function destroy($id)
	{
//		$data['category'] = $this->MainModel->getSingleData('category_id', $id, 'category', '*');
//		$category_id = $data['category']->category_id;
//		if (isset($category_id)) {
//			$result = $this->MainModel->deleteData('category_id', $id, 'category');
//			if ($result) {
//				$this->session->set_flashdata('message', "Category deleted successfully !!!!");
//				redirect('category-list');
//			}
//		} else {
//			$this->session->set_flashdata('message', "The element you are trying to delete does not exist.");
//			redirect('category-list');
//		}
	}

}
