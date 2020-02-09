<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SliderController extends MX_Controller
{

	public function __construct()
	{
		$this->load->model('MainModel');
		$this->load->library('image_lib');
		$userType=$this->session->userdata('user_type');
		if($userType !='super-admin' &&  $userType !='admin'  ){
			redirect('admin');
		}


	}

	public function index()
	{

		$data['main'] = "Slider";
		$data['active'] = "View Slidsers";
		$data['sliders'] = $this->MainModel->getAllData('', 'homeslider', '*', 'homeslider_id ASC');

		$data['pageContent'] = $this->load->view('slider/slider/slider_index', $data, true);
		$this->load->view('layouts/main', $data);
	}

	public function create()
	{

		$data['title'] = "Slider registration form ";
		$data['main'] = "Slider";
		$data['active'] = "Add Slider";
		$data['pageContent'] = $this->load->view('slider/slider/slider_create', $data, true);
		$this->load->view('layouts/main', $data);
	}


	public function store()
	{
		$row_data['homeslider_title'] = $this->input->post('homeslider_title');
		$row_data['homeslider_text'] = $this->input->post('homeslider_banner');
		$row_data['target_url'] = $this->input->post('target_url');

		$this->form_validation->set_rules('homeslider_title', 'Category Title', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			redirect('slider-create');
			$this->session->set_flashdata('error', 'Fill Up all the field !!!!!!!!!!!!!!!!!!!');
		} else {
			if (isset($_FILES["featured_image"]) && $_FILES["featured_image"]["size"] > 50) {
				$uploaded_image_path = "uploads/sliders/" .date('d-m-Y-'). $_FILES["featured_image"]["name"];
				$uploaded_file_path = "uploads/sliders/" . $_FILES["featured_image"]["name"];
				if (!file_exists($uploaded_file_path)) {
					move_uploaded_file($_FILES["featured_image"]["tmp_name"], $uploaded_image_path);

					$row_data['homeslider_banner'] = $uploaded_image_path;
				}

			}


			if ($this->MainModel->insertData('homeslider', $row_data)) {

				$this->session->set_flashdata('message', 'Slider  added successfully!!!!!!!!!!!!!!!!!!!');
				redirect('slider-create');
			} else {

				$this->session->set_flashdata('error', 'Slider does not add successfully!!!!!!!!!!!!!!!!!!!');
				redirect('slider-create');

			}
		}
	}


	public function show($id)
	{

	}

	public function edit($id)
	{
		$data['slider'] = $this->MainModel->getSingleData('homeslider_id', $id, 'homeslider', '*');
		$homeslider_id = $data['slider']->homeslider_id;
		if (isset($homeslider_id)) {
			$data['title'] = "Slider update page ";
			$data['main'] = "Slider";
			$data['active'] = "Update Slider";
			$data['pageContent'] = $this->load->view('slider/slider/slider_edit', $data, true);
			$this->load->view('layouts/main', $data);
		} else {
			$this->session->set_flashdata('message', "The element you are trying to edit does not exist.");
			redirect('slider-list');
		}

	}

	public function update()
	{
		$row_data['homeslider_title'] = $this->input->post('homeslider_title');
		$row_data['homeslider_text'] = $this->input->post('homeslider_banner');
		$row_data['target_url'] = $this->input->post('target_url');
		$catId = $this->input->post('homeslider_id');

		$this->form_validation->set_rules('homeslider_title', 'Category Title', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->edit();
		} else {
			if (isset($_FILES["featured_image"]) && $_FILES["featured_image"]["size"] > 50) {
				$uploaded_image_path = "uploads/sliders/".date('d-m-Y-'). $_FILES["featured_image"]["name"];
				$uploaded_file_path = "uploads/sliders/" . $_FILES["featured_image"]["name"];
				if (!file_exists($uploaded_file_path)) {
					move_uploaded_file($_FILES["featured_image"]["tmp_name"], $uploaded_image_path);
					$row_data['homeslider_banner'] = $uploaded_image_path;
				}

			}


			if ($this->MainModel->updateData('homeslider_id', $catId, 'homeslider', $row_data)) {

				$this->session->set_flashdata('message', 'Slider  Updated successfully!!!!!!!!!!!!!!!!!!!');
				redirect('slider-list');

			} else {

				$this->session->set_flashdata('error', 'Slider does not Updated successfully!!!!!!!!!!!!!!!!!!!');
				redirect('slider-edit');

			}


			}


		}





	public function multipleDelete()
	{
		$category = $this->input->post('homeslider_id');
		for ($i = 0; $i < sizeof($category); $i++) {
			$result = $this->MainModel->deleteData('homeslider_id', $category[$i], 'homeslider');
		}

		if ($result) {

			echo('Multiple slider deleted succefully');
		} else {
			echo('Multiple slider does not  deleted succefully');

		}

	}

	public function destroy($id)
	{
		$data['category'] = $this->MainModel->getSingleData('homeslider_id', $id, 'category', '*');
		$homeslider_id = $data['category']->homeslider_id;
		if (isset($homeslider_id)) {
			$result = $this->MainModel->deleteData('homeslider_id', $id, 'category');
			if ($result) {
				$this->session->set_flashdata('message', "Category deleted successfully !!!!");
				redirect('category-list');
			}
		} else {
			$this->session->set_flashdata('message', "The element you are trying to delete does not exist.");
			redirect('category-list');
		}
	}

}
