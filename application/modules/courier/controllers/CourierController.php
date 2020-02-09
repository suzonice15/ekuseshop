<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CourierController extends MX_Controller
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
		$data['main'] = "Courier ";
		$data['active'] = "View Courier";
		$data['couriers'] = $this->MainModel->getAllData('', 'courier', '*', 'courier_id DESC');
		$data['pageContent'] = $this->load->view('courier/courier/courier_index', $data, true);
		$this->load->view('layouts/main', $data);
	}

	public function create()
	{
		$data['title'] = "Courier registration form ";
		$data['main'] = "Courier";
		$data['active'] = "Add Courier";
		$data['pageContent'] = $this->load->view('courier/courier/courier_create', $data, true);
		$this->load->view('layouts/main', $data);
	}


	public function store()
	{

		$data['courier_name'] = $this->input->post('courier_name');
		$data['courier_status'] = $this->input->post('courier_status');
		$this->form_validation->set_rules('courier_name', 'shift name', 'required');
		if ($this->form_validation->run()) {
			$result = $this->MainModel->insertData('courier', $data);
			if ($result) {
				$this->session->set_flashdata('message', "courier added successfully !!!!");
				redirect('courier-create');
			}
		} else {

			$this->session->set_flashdata('error', "value reqiured");
			redirect('courier-create');
		}


	}

	public function show($id)
	{

	}

	public function edit($id)
	{


		$data['courier'] = $this->MainModel->getSingleData('courier_id', $id, 'courier', '*');
		$courierId = $data['courier']->courier_id;

		if ($courierId) {

			$data['title'] = "Courier  update page ";
			$data['main'] = "Courier ";
			$data['active'] = "Update Courier";
			$data['pageContent'] = $this->load->view('courier/courier/courier_edit', $data, true);
			$this->load->view('layouts/main', $data);
		} else {
			$this->session->set_flashdata('error', "The element you are trying to edit does not exist.");
			redirect('courier-list');
		}


	}

	public function update()
	{
		$courierId = $this->input->post('courier_id');
		$expenseData = $this->MainModel->getSingleData('courier_id', $courierId, 'courier', '*');
		$courierId = $expenseData->courier_id;
		if (isset($courierId)) {
			$data['courier_name'] = $this->input->post('courier_name');
			$data['courier_status'] = $this->input->post('courier_status');
			$this->form_validation->set_rules('courier_name', 'shift name', 'required');
			if ($this->form_validation->run()) {
				$result = $this->MainModel->updateData('courier_id', $courierId, 'courier', $data);
				if ($result) {
					$this->session->set_flashdata('message', "Courier  updated successfully !!!!");
					redirect('courier-list');
				}
			} else {

				$this->session->set_flashdata('error', "value reqiured");
				redirect('courier-update');
			}
		} else {
			$this->session->set_flashdata('error', "The element you are trying to edit does not exist.");
			redirect('courier-list');
		}


	}



	public function destroy($id)
	{
		$expenseData = $this->MainModel->getSingleData('courier_id', $id, 'courier', '*');
		$courierId = $expenseData->courier_id;

		if (isset($courierId)) {
			$result = $this->MainModel->deleteData('courier_id', $courierId, 'courier');
			if ($result) {


				$this->session->set_flashdata('message', "Courier  deleted successfully !!!!");
				redirect('courier-list');
			}
		} else {
			$this->session->set_flashdata('error', "The element you are trying to delete does not exist.");
			redirect('courier-list');
		}
	}


}
