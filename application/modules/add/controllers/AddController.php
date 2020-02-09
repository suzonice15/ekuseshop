<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddController extends MX_Controller
{

	public function __construct()
	{
		$this->load->model('MainModel');
		$this->load->library('image_lib');

		$userType=$this->session->userdata('user_type');
		if($userType !='super-admin' &&  $userType !='admin'){
			redirect('admin');
		}
	}

	public function index()
	{

		$data['main'] = "Add";
		$data['active'] = "View Add";
		$data['adds'] = $this->MainModel->getAllData('', 'adds', '*', 'adds_id desc');
		$data['pageContent'] = $this->load->view('add/add/add_index', $data, true);
		$this->load->view('layouts/main', $data);
	}

	public function create()
	{

		$data['title'] = "Add registration form ";
		$data['main'] = "Add";
		$data['active'] = "Add ";
		$data['pageContent'] = $this->load->view('add/add/add_create', $data, true);
		$this->load->view('layouts/main', $data);
	}


	public function store()
	{
		$row_data['adds_title']	=	$this->input->post('adds_title');
		$row_data['adds_link']	=	$this->input->post('adds_link');
		$row_data['adds_type']	=	$this->input->post('adds_type');
		$row_data['created_time']	=	$this->input->post('created_time');


		$this->form_validation->set_rules('adds_title', 'Ads Title', 'trim|required');

		if ($this->form_validation->run()==FALSE)
		{
			$this->create();
		}
		else
		{
			if(isset($_FILES["media_file"]))
			{


				$uploaded_image_path = "uploads/".date('s-i-h-d-m-Y-').$_FILES["media_file"]["name"];

				$uploaded_file_path = "uploads/".date('s-i-h-d-m-Y-').$_FILES["media_file"]["name"];
				if(!file_exists($uploaded_file_path))
				{

					if(move_uploaded_file($_FILES["media_file"]["tmp_name"], $uploaded_image_path))
					{

						$row_data['media_path'] = $uploaded_image_path;



					}
				}

			}


				if($this->MainModel->insertData('adds',$row_data))
				{

					$this->session->set_flashdata('message','Adds  added successfully!!!!!!');
					redirect('add-create');
				}
				else
				{
					$this->session->set_flashdata('error','Adds  does not added successfully!!!!!!');
					redirect('add-create');
				}


		}
	}


	public function show($id)
	{

	}

	public function edit($id)
	{
		$data['add'] = $this->MainModel->getSingleData('adds_id', $id, 'adds', '*');
		
		$add_id = $data['add']->adds_id;
		if (isset($add_id)) {
			$data['title'] = "Adds update page ";
			$data['main'] = "Add";
			$data['active'] = "Update Add";
			$data['pageContent'] = $this->load->view('add/add/add_edit', $data, true);
			$this->load->view('layouts/main', $data);
		} else {
			$this->session->set_flashdata('message', "The element you are trying to edit does not exist.");
			redirect('add-list');
		}

	}

	public function update()
	{

		$add_id	=	$this->input->post('adds_id');
		$row_data['adds_title']	=	$this->input->post('adds_title');
		$row_data['adds_link']	=	$this->input->post('adds_link');
		$row_data['adds_type']	=	$this->input->post('adds_type');
		$row_data['created_time']	=	$this->input->post('created_time');


			if(isset($_FILES["media_file"]))
			{
				$uploaded_image_path = "uploads/".date('s-i-h-d-m-Y-').$_FILES["media_file"]["name"];
				$uploaded_file_path = "uploads/".date('s-i-h-d-m-Y-').$_FILES["media_file"]["name"];
				if(!file_exists($uploaded_file_path))
				{
					if(move_uploaded_file($_FILES["media_file"]["tmp_name"], $uploaded_image_path))
					{
						$row_data['media_path'] = $uploaded_image_path;


					}
				}


			//	$row_data['media_id'] = $media;



			}
		if($this->MainModel->updateData('adds_id',$add_id,'adds',$row_data))
		{

			$this->session->set_flashdata('message','Adds  Updated successfully!!!!!!');
			redirect('add-list');
		}

		}





	public function multipleDelete()
	{
		$adds_id = $this->input->post('adds_id');
		for ($i = 0; $i < sizeof($adds_id); $i++) {
			$result = $this->MainModel->deleteData('adds_id', $adds_id[$i], 'adds');
		}

		if ($result) {

			echo('Multiple add  deleted succefully');
		} else {
			echo('Multiple add does not  deleted succefully');

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
