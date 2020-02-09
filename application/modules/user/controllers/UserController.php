<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends MX_Controller
{

	public function __construct()
	{
		$this->load->model('MainModel');

		$userType=$this->session->userdata('user_type');
		if($userType !='super-admin' &&  $userType !='admin'  ){
			redirect('admin');
		}

	}
	public function affiliate_user(){
		$data['main'] = "Users";
		$data['active'] = "View Users";
		$data['users'] = $this->MainModel->getAllData('', 'affiliate_users', '*', 'user_id ASC');
		$data['pageContent'] = $this->load->view('user/users_affiliate_user', $data, true);
		$this->load->view('layouts/main', $data);
	}

	public function index()
	{

		$data['main'] = "Users";
		$data['active'] = "View Users";
		$data['users'] = $this->MainModel->getAllData('', 'users', '*', 'user_id ASC');
		$data['pageContent'] = $this->load->view('user/users_index', $data, true);
		$this->load->view('layouts/main', $data);

	}

	public function create()
	{
		$data['title'] = "user registration form ";
		$data['main'] = "user";
		$data['active'] = "Add user";
		$data['pageContent'] = $this->load->view('user/users_create', $data, true);
		$this->load->view('layouts/main', $data);
	}


	public function store()
	{
		$row_data['user_name'] = $this->input->post('user_name');
		$row_data['user_phone'] = $this->input->post('user_phone');
		$row_data['user_email'] = $this->input->post('user_email');
		$row_data['user_type'] = $this->input->post('user_type');
		$row_data['user_status'] = $this->input->post('user_status');
		$row_data['registered_date'] = date('Y-m-d');
		$row_data['user_pass'] = md5($this->input->post('user_pass'));
		$this->form_validation->set_rules('user_name', 'Category Title', 'trim|required');
		$this->form_validation->set_rules('user_phone', 'Category Title', 'trim|required');
		$this->form_validation->set_rules('user_phone', 'Category Title', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			redirect('user-create');
			$this->session->set_flashdata('error', 'Fill Up all the field !!!!!!!!!!!!!!!!!!!');
		} else {
			if (isset($_FILES["user_picture"]) && $_FILES["user_picture"]["size"] > 50) {
				$uploaded_image_path = "uploads/user/" . date('d-m-Y-') . $_FILES["user_picture"]["name"];
				$uploaded_file_path = "uploads/user/" . $_FILES["user_picture"]["name"];

				if (!file_exists($uploaded_file_path)) {
					move_uploaded_file($_FILES["user_picture"]["tmp_name"], $uploaded_image_path);


					$row_data['user_picture'] = $uploaded_image_path;
				} else {
					move_uploaded_file($_FILES["user_picture"]["tmp_name"], $uploaded_image_path);

				}


			}


			if ($this->MainModel->insertData('users', $row_data)) {

				$this->session->set_flashdata('message', 'user  added successfully   !!!!!!');
				redirect('users');

			} else {

				$this->session->set_flashdata('error', 'user does not add successfully  !!!!!!');
				redirect('user-create');

			}
		}
	}


	public function edit($id)
	{
		$data['user'] = $this->MainModel->getSingleData('user_id', $id, 'users', '*');
		$user_id = $data['user']->user_id;
		if (isset($user_id)) {
			$data['title'] = "User update page ";
			$data['main'] = "User";
			$data['active'] = "Update User";
			$data['pageContent'] = $this->load->view('user/users_edit', $data, true);
			$this->load->view('layouts/main', $data);
		} else {
			$this->session->set_flashdata('message', "The element you are trying to edit does not exist.");
			redirect('users');
		}
	}
public function affiliate_user_edit($id){

	$data['user'] = $this->MainModel->getSingleData('user_id', $id, 'affiliate_users', '*');
	$user_id = $data['user']->user_id;
	if (isset($user_id)) {
		$data['title'] = "User update page ";
		$data['main'] = "User";
		$data['active'] = "Update User";
		$data['pageContent'] = $this->load->view('user/affiliate_user_edit', $data, true);
		$this->load->view('layouts/main', $data);
	} else {
		$this->session->set_flashdata('message', "The element you are trying to edit does not exist.");
		redirect('affiliate-user');
	}
}
	public function affiliate_user_update(){

		$user_id = $this->input->post('user_id');
		$row_data['user_f_name'] = $this->input->post('user_f_name');
		$row_data['user_email'] = $this->input->post('user_email');
		$row_data['user_mobile'] = $this->input->post('user_mobile');
		$row_data['user_status'] = $this->input->post('user_status');
		$row_data['user_address'] = $this->input->post('user_address');
		$row_data['affiliate_user'] = $this->input->post('affiliate_user');
		if($this->input->post('user_password')) {
			$row_data['user_password'] =trim($this->input->post('user_password'));

		}
		$result = $this->MainModel->updateData('user_id', $user_id, 'affiliate_users', $row_data);
		if($result){
			$this->session->set_flashdata('message', 'Customer/Affiliate user updated successfully !!!');
			redirect('affiliate-user', 'refresh');
		}


	}
	public function update()
	{
		$user_id = $this->input->post('user_id');
		$row_data['user_name'] = $this->input->post('user_name');
		$row_data['user_phone'] = $this->input->post('user_phone');
		$row_data['user_email'] = $this->input->post('user_email');
		$row_data['user_type'] = $this->input->post('user_type');
		$row_data['user_status'] = $this->input->post('user_status');
		$row_data['registered_date'] = date('Y-m-d');
		if($this->input->post('user_pass')) {
			$row_data['user_pass'] = md5($this->input->post('user_pass'));

		}
		$this->form_validation->set_rules('user_name', 'Category Title', 'trim|required');
		$this->form_validation->set_rules('user_phone', 'Category Title', 'trim|required');
		$this->form_validation->set_rules('user_phone', 'Category Title', 'trim|required');


		if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('error', 'Fill up all the  Required field  !!!!!');
			$this->edit($user_id);
		} else {
			if ((($_FILES["user_picture"]["type"] == "image/jpg") || ($_FILES["user_picture"]["type"] == "image/jpeg") || ($_FILES["user_picture"]["type"] == "image/png") || ($_FILES["user_picture"]["type"] == "image/gif"))) {
				if ($_FILES["user_picture"]["error"] > 0) {
					echo "Return Code: " . $_FILES["user_picture"]["error"] . "<br />";
				} else {
					$uploaded_image_path = "uploads/user/" . date('d-m-Y-') . $_FILES["user_picture"]["name"];
					$uploaded_file_path = "uploads/user/" . $_FILES["user_picture"]["name"];

					if (!file_exists($uploaded_file_path)) {
						move_uploaded_file($_FILES["user_picture"]["tmp_name"], $uploaded_image_path);


						$row_data['user_picture'] = $uploaded_image_path;
					}


				}
		}

			$result = $this->MainModel->updateData('user_id', $user_id, 'users', $row_data);
			if($result){
				$this->session->set_flashdata('message', 'user updated successfully !!!');
				redirect('users', 'refresh');
			}




	}
}



	public function destroy($id)
	{
	$data['category'] = $this->MainModel->getSingleData('user_id', $id, 'users', '*');
	$category_id = $data['category']->user_id;
	if (isset($category_id)) {
		$result = $this->MainModel->deleteData('user_id', $id, 'users');
		if ($result) {
			$this->session->set_flashdata('message', "Category deleted successfully !!!!");
			redirect('users');
		}
	} else {
		$this->session->set_flashdata('message', "The element you are trying to delete does not exist.");
		redirect('users');
	}
	}

}
