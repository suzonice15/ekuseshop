<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RiviewController extends MX_Controller {

	public function __construct()
	{
		$this->load->model('MainModel');

		$userType=$this->session->userdata('user_type');
		if($userType !='super-admin' &&  $userType !='admin' && $userType !='office-staff'){
			redirect('admin');
		}
	}

	public function index()
	{

		$data['main'] = "Review";
		$data['active'] = "Review" ;
		$data['reviews'] = $this->MainModel->getAllData('', 'review', '*', 'review_id DESC');
		$data['pageContent'] = $this->load->view('review/review_index', $data, true);
		$this->load->view('layouts/main', $data);
	}

	public function create()
	{

		$data['title'] = "Page registration form ";
		$data['main'] = "Page";
		$data['active'] = "Add Page";
		$data['categories'] = $this->MainModel->getAllData('', 'category', '*', 'parent_id ASC');
		$data['pageContent'] = $this->load->view('review/review_create', $data, true);
		$this->load->view('layouts/main', $data);
	}


	public function store()
	{
		$data['page_name']		=	$this->input->post('page_name');
		$data['name']		=	$this->input->post('name');
		$data['email']			=	$this->input->post('email');
		$data['page_content']			=	$this->input->post('page_content');
		$data['comment']			=	$this->input->post('comment');
		$data['rating']			=	$this->input->post('rating');
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


		$data['review_active']			=	1;

		if($this->MainModel->updateData('review_id',$id,'review',$data)){


			$this->session->set_flashdata('message','Review  Updated successfully!!!!!!!!!!!!!!!!!!!');
			redirect('review-list');

		}
		else
		{

			$this->session->set_flashdata('error','review does not Updated successfully!!!!!!!!!!!!!!!!!!!');
			redirect('review-edit');

		}

	}

	public function off($id)
	{


		$data['review_active']			=	0;

		if($this->MainModel->updateData('review_id',$id,'review',$data)){


			$this->session->set_flashdata('message','Review  Updated successfully!!!!!!!!!!!!!!!!!!!');
			redirect('review-list');

		}
		else
		{

			$this->session->set_flashdata('error','review does not Updated successfully!!!!!!!!!!!!!!!!!!!');
			redirect('review-edit');

		}

	}

	public function edit($id)
	{
		$data['riview'] = $this->MainModel->getSingleData('review_id', $id, 'review', '*');
		$page_id = $data['riview']->review_id;
		if (isset($page_id)) {
			$data['title'] = "Page update page ";
			$data['main'] = "Page";
			$data['active'] = "Update Page";
			$data['pageContent'] = $this->load->view('review/review_edit', $data, true);
			$this->load->view('layouts/main', $data);
		} else {
			$this->session->set_flashdata('message', "The element you are trying to edit does not exist.");
			redirect('review-list');
		}

	}

	public function update()
	{

		$page_id=$this->input->post('review_id');

		$data['name']		=	$this->input->post('name');
		$data['email']			=	$this->input->post('email');
		$data['created_time']			=	date('Y-m-d h:i:s');
		$data['comment']			=	$this->input->post('comment');
		$data['rating']			=	$this->input->post('rating');
		$data['review_active']			=	$this->input->post('review_active');

		if($this->MainModel->updateData('review_id',$page_id,'review',$data)){


				$this->session->set_flashdata('message','Review  Updated successfully!!!!!!!!!!!!!!!!!!!');
					redirect('review-list');

				}
				else
				{

					$this->session->set_flashdata('error','review does not Updated successfully!!!!!!!!!!!!!!!!!!!');
					redirect('review-edit');

				}



	}




	public function destroy($id)
	{
		$data['page'] = $this->MainModel->getSingleData('review_id', $id, 'review', '*');
		$page_id = $data['page']->review_id;
		if (isset($page_id)) {
			$result = $this->MainModel->deleteData('review_id', $id, 'review');
			if ($result) {
				$this->session->set_flashdata('message', "Riview deleted successfully !!!!");
				redirect('review-list');
			}
		} else {
			$this->session->set_flashdata('message', "The element you are trying to delete does not exist.");
			redirect('review-list');
		}
	}
	
}
