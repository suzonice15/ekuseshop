<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageController extends MX_Controller {

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

		$data['main'] = "Page";
		$data['active'] = "Page" ;
		$data['pages'] = $this->MainModel->getAllData('', 'page', '*', 'page_id ASC');
		$data['pageContent'] = $this->load->view('page/pages/page_index', $data, true);
		$this->load->view('layouts/main', $data);
	}

	public function create()
	{

		$data['title'] = "Page registration form ";
		$data['main'] = "Page";
		$data['active'] = "Add Page";
		$data['categories'] = $this->MainModel->getAllData('', 'category', '*', 'parent_id ASC');
		$data['pageContent'] = $this->load->view('page/pages/page_create', $data, true);
		$this->load->view('layouts/main', $data);
	}


	public function store()
	{
		$data['page_name']		=	$this->input->post('page_name');
		$data['page_link']		=	$this->input->post('page_link');
		$data['page_template']			=	$this->input->post('page_template');
		$data['page_content']			=	$this->input->post('page_content');
		$data['created_time']			=	date('Y-m-d h:i:s');




			if($this->MainModel->insertData('page',$data))
			{
				
$this->session->set_flashdata('message','Page  added successfully!!!!!!!');
	redirect('page-create');
	
	}
			else
			{
				
$this->session->set_flashdata('error','Page does not add successfully!!!!!!!!');
	redirect('page-create');

			}

	}


	public function show($id)
	{

	}

	public function edit($id)
	{
		$data['page'] = $this->MainModel->getSingleData('page_id', $id, 'page', '*');
		$page_id = $data['page']->page_id;
		if (isset($page_id)) {
			$data['title'] = "Page update page ";
			$data['main'] = "Page";
			$data['active'] = "Update Page";
			$data['pageContent'] = $this->load->view('page/pages/page_edit', $data, true);
			$this->load->view('layouts/main', $data);
		} else {
			$this->session->set_flashdata('message', "The element you are trying to edit does not exist.");
			redirect('page-list');
		}

	}

	public function update()
	{

		$page_id=$this->input->post('page_id');

		$data['page_name']		=	$this->input->post('page_name');
		$data['page_link']		=	$this->input->post('page_link');
		$data['page_template']			=	$this->input->post('page_template');
		$data['page_content']			=	$this->input->post('page_content');
		$data['created_time']			=	date('Y-m-d h:i:s');

		if($this->MainModel->updateData('page_id',$page_id,'page',$data)){


				$this->session->set_flashdata('message','Page  Updated successfully!!!!!!!!!!!!!!!!!!!');
					redirect('page-list');

				}
				else
				{

					$this->session->set_flashdata('error','Page does not Updated successfully!!!!!!!!!!!!!!!!!!!');
					redirect('page-edit');

				}



	}




	public function destroy($id)
	{
		$data['page'] = $this->MainModel->getSingleData('page_id', $id, 'page', '*');
		$page_id = $data['page']->page_id;
		if (isset($page_id)) {
			$result = $this->MainModel->deleteData('page_id', $id, 'page');
			if ($result) {
				$this->session->set_flashdata('message', "Page deleted successfully !!!!");
				redirect('page-list');
			}
		} else {
			$this->session->set_flashdata('message', "The element you are trying to delete does not exist.");
			redirect('page-list');
		}
	}
	
}
