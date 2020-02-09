<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InqueryController extends MX_Controller {

	public function __construct()
	{
		$this->load->model('MainModel');


	}

	public function index()
	{

		$userType=$this->session->userdata('user_type');
		if($userType !='super-admin' &&  $userType !='admin'  && $userType !='office-staff' ){
			redirect('admin');
		}
		$data['main'] = "Inquery";
		$data['active'] = "inquery" ;
		$data['inquerys'] = $this->MainModel->getAllData('', 'inquiry', '*', 'inquiry_id DESC');
		$data['pageContent'] = $this->load->view('inquery/inquery_index', $data, true);
		$this->load->view('layouts/main', $data);
	}

	public function create()
	{

		$data['title'] = "Page registration form ";
		$data['main'] = "Page";
		$data['active'] = "Add Page";
		$data['categories'] = $this->MainModel->getAllData('', 'category', '*', 'parent_id ASC');
		$data['pageContent'] = $this->load->view('inquery/inquery_create', $data, true);
		$this->load->view('layouts/main', $data);
	}


	public function store()
	{
		$data['name']		=	$this->input->post('name');
		$data['phone']		=	$this->input->post('phone');
		$data['subject']		=	$this->input->post('subject');
		$data['message']		=	$this->input->post('message');
		$data['created_time']			=	date('Y-m-d h:i:s');
		if($this->MainModel->insertData('inquiry',$data))
			{
				echo 'Your query submit   successfully!!!!!!!';
	} else {
			echo 'Your query does not submit   successfully!!!!!!!';
		}

	}


	public function query_form()
	{
		$uri_string='contact';
		$post = get_uri_not_found_data(end($uri_string));


		$data['page_title'] = $post->page_name;
		$data['page_name'] = $post->page_link;
		$data['page_content'] = $post->page_content;

		$template = $post->page_template;
		$template = $template == 'default' ? 'page' : $template;

		$this->load->view('website/header', $data);
		$this->load->view($template, $data);
		$this->load->view('website/footer', $data);
	}

	public function edit($id)
	{

		$data['status']			=	1;

		$page_id=$this->MainModel->updateData('inquiry_id',$id,'inquiry',$data);

		if (isset($page_id)) {
			$this->session->set_flashdata('message','Inquery seen    successfully!!!!!!!!!!!!!!!!!!!');
			redirect('inquery-list');

		}
		else
		{
			$this->session->set_flashdata('error','Page does not Updated successfully!!!!!!!!!!!!!!!!!!!');
			redirect('inquery-edit');

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
		$data['page_position']			=	$this->input->post('page_position');
		$data['page_order']			=	$this->input->post('page_order');

		if($this->MainModel->updateData('page_id',$page_id,'page',$data)){


				$this->session->set_flashdata('message','Page  Updated successfully!!!!!!!!!!!!!!!!!!!');
					redirect('inquery-list');

				}
				else
				{

					$this->session->set_flashdata('error','Page does not Updated successfully!!!!!!!!!!!!!!!!!!!');
					redirect('page-edit');

				}



	}




	public function destroy($id)
	{
		$data['page'] = $this->MainModel->getSingleData('inquiry_id', $id, 'inquiry', '*');
		$page_id = $data['page']->inquiry_id;
		if (isset($page_id)) {
			$result = $this->MainModel->deleteData('inquiry_id', $id, 'inquiry');
			if ($result) {
				$this->session->set_flashdata('message', "Information  deleted successfully !!!!");
				redirect('inquery-list');
			}
		} else {
			$this->session->set_flashdata('message', "The element you are trying to delete does not exist.");
			redirect('inquery-list');
		}
	}
	
}
