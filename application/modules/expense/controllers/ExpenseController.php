<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExpenseController extends MX_Controller
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
		$data['main'] = "Expens Category";
		$data['active'] = "Expens view";
		$data['expenses'] = $this->MainModel->getAllData('', 'expense_category', '*', 'expense_cat_id DESC');
		$data['pageContent'] = $this->load->view('expense/expense/expense_index', $data, true);
		$this->load->view('layouts/main', $data);
	}

	public function create()
	{
		$data['title'] = "Shift registration form ";
		$data['main'] = "Shift";
		$data['active'] = "Add shift";
		$data['pageContent'] = $this->load->view('expense/expense/expense_create', $data, true);
		$this->load->view('layouts/main', $data);
	}


	public function store()
	{

		$data['expense_cat_name'] = $this->input->post('expense_cat_name');
		$this->form_validation->set_rules('expense_cat_name', 'shift name', 'required');
		if ($this->form_validation->run()) {
			$result = $this->MainModel->insertData('expense_category', $data);
			if ($result) {
				$this->session->set_flashdata('message', "Category added successfully !!!!");
				redirect('expense-category-create');
			}
		} else {

			$this->session->set_flashdata('error', "value reqiured");
			redirect('expense-category-create');
		}


	}

	public function show($id)
	{

	}

	public function edit($id)
	{


		$data['expense'] = $this->MainModel->getSingleData('expense_cat_id', $id, 'expense_category', '*');
		$expenseId = $data['expense']->expense_cat_id;

		if ($expenseId) {

			$data['title'] = "Expense Category update page ";
			$data['main'] = "Expense Category";
			$data['active'] = "Update Category";
			$data['pageContent'] = $this->load->view('expense/expense/expense_edit', $data, true);
			$this->load->view('layouts/main', $data);
		} else {
			$this->session->set_flashdata('error', "The element you are trying to edit does not exist.");
			redirect('expense-category-list');
		}


	}

	public function update()
	{
		$expenseId = $this->input->post('expense_cat_id');
		$expenseData = $this->MainModel->getSingleData('expense_cat_id', $expenseId, 'expense_category', '*');
		$expenseId = $expenseData->expense_cat_id;

		if (isset($expenseId)) {
			$data['expense_cat_name'] = $this->input->post('expense_cat_name');
			$this->form_validation->set_rules('expense_cat_name', 'shift name', 'required');
			if ($this->form_validation->run()) {
				$result = $this->MainModel->updateData('expense_cat_id', $expenseId, 'expense_category', $data);
				if ($result) {
					$this->session->set_flashdata('message', "Expense Category updated successfully !!!!");
					redirect('expense-category-list');
				}
			} else {
				//$data['message'] = "value reqiured";
				//  $this->session->set_userdata($data);
				$this->session->set_flashdata('error', "value reqiured");
				redirect('expense-category-update');
			}
		} else {
			$this->session->set_flashdata('error', "The element you are trying to edit does not exist.");
			redirect('expense-category-list');
		}


	}



	public function destroy($id)
	{
		$expenseData = $this->MainModel->getSingleData('expense_cat_id', $id, 'expense_category', '*');
		$expenseId = $expenseData->expense_cat_id;

		if (isset($expenseId)) {
			$result = $this->MainModel->deleteData('expense_cat_id', $expenseId, 'expense_category');
			if ($result) {


				$this->session->set_flashdata('message', "Expense Cateogyr deleted successfully !!!!");
				redirect('expense-category-list');
			}
		} else {
			$this->session->set_flashdata('error', "The element you are trying to delete does not exist.");
			redirect('expense-category-list');
		}
	}


}
