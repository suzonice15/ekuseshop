<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SettingController extends MX_Controller
{

	public function __construct()
	{
		$this->load->model('MainModel');
		$this->load->library('image_lib');
		$userType=$this->session->userdata('user_type');
		if($userType !='super-admin' &&  $userType !='admin'   ){
			redirect('admin');
		}
	}

	public function default_setting()
	{

		$data['main'] = "Default Setting";
		$data['active'] = "Update Setting";
		$data['title'] = "Default Setting  Update form ";

		$data['pageContent'] = $this->load->view('setting/setting/setting_default', $data, true);
		$this->load->view('layouts/main', $data);
	}
	
	public function default_update(){
	    

			$data = array();
			$data['site_title'] = $this->input->post('site_title');
			$data['logo'] = $this->input->post('logo');
			$data['icon'] = $this->input->post('icon');
			$data['phone'] = $this->input->post('phone');
		//	$data['phone_order'] = $this->input->post('phone_order');
		//	$data['email'] = $this->input->post('email');
		//	$data['admin_email'] = $this->input->post('admin_email');
		//	$data['support_box'] = $this->input->post('support_box');
		//	$data['footer'] = $this->input->post('footer');
			$data['copyright'] = $this->input->post('copyright');
			$data['default_product_terms'] = $this->input->post('default_product_terms');
			$data['shipping_charge_in_dhaka'] = $this->input->post('shipping_charge_in_dhaka');
			$data['shipping_charge_out_of_dhaka'] = $this->input->post('shipping_charge_out_of_dhaka');
			$data['delevery_timing'] = $this->input->post('delevery_timing');
			$data['customer_service'] 	= $this->input->post('customer_service');
			$data['easy_return'] 		= $this->input->post('easy_return');
			$data['bkash_payment'] 		= $this->input->post('bkash_payment');
			$data['home_pomosion_title'] 		= $this->input->post('home_pomosion_title');
			$data['home_pomosion_sub_title'] 		= $this->input->post('home_pomosion_sub_title');
			$data['home_pomosion_link'] 		= $this->input->post('home_pomosion_link');

			foreach ($data as $key => $val) {
				update_option($key, $val);
			}
			$this->session->set_flashdata('message', ' Update Suceessfully  !!!');
			redirect('setting-default');
	
	}

	public function home()
	{

		$data['main'] = "Home Page Setting";
		$data['active'] = "Update Setting";
		$data['title'] = "Home Page Setting  Update form ";

		if($this->input->post())
		{
			$data 						=	array();
			$data['home_cat_section']	=	$this->input->post('home_cat_section');
			$data['home_seo_title']		=	$this->input->post('home_seo_title');
			$data['home_seo_keywords']	=	$this->input->post('home_seo_keywords');
			$data['home_seo_content']	=	$this->input->post('home_seo_content');
			//$data['home_about_title']	=	$this->input->post('home_about_title');
			$data['home_about_content']	=	$this->input->post('home_about_content');
			$data['top_weekly_category']	=	$this->input->post('top_weekly_category');

		

			foreach($data as $key=>$val)
			{
				update_option($key, $val);
			}

			$this->session->set_flashdata('message', ' Update Suceessfully  !!!');
			redirect('setting-home');
		}

		$data['pageContent'] = $this->load->view('setting/setting/setting_home_page', $data, true);
		$this->load->view('layouts/main', $data);
	}


	public function extra()
	{

		$data['main'] = "Extra Setting";
		$data['active'] = "Update Setting";
		$data['title'] = "Extra Setting  Update form ";

		if($this->input->post()) {

			$data					=	array();
			$data['logo_slider']	=	$this->input->post('logo_slider');
			$data['partner_logo']	=	$this->input->post('partner_logo');

			foreach($data as $key=>$val)
			{
				update_option($key, $val);
			}

			$this->session->set_flashdata('message', ' Update Suceessfully  !!!');
			redirect('setting-extra');
		}

		$data['pageContent'] = $this->load->view('setting/setting/setting_extra_page', $data, true);
		$this->load->view('layouts/main', $data);
	}



	public function popup()
	{

		$data['main'] = "Popup Setting";
		$data['active'] = "Update Setting";
		$data['title'] = "Popup Setting  Update form ";

		if($this->input->post()) {

			$data						=	array();
			$data['popup_html']			=	$this->input->post('popup_html');
			$data['popup_height']		=	$this->input->post('popup_height');
			$data['popup_width']		=	$this->input->post('popup_width');
			$data['popup_show_time']	=	$this->input->post('popup_show_time');
			$data['popup_type']			=	$this->input->post('popup_type');

			foreach($data as $key=>$val)
			{
				update_option($key, $val);
			}


			$this->session->set_flashdata('message', ' Update Suceessfully  !!!');
			redirect('setting-popup');
		}

		$data['pageContent'] = $this->load->view('setting/setting/setting_popup', $data, true);
		$this->load->view('layouts/main', $data);
	}


	public function facebook()
	{

		$data['main'] = "Facebook Api ";
		$data['active'] = "Update facebook";
		$data['title'] = "Facebook API  Update form ";

		if($this->input->post()) {

			$data						=	array();
			$data					=	array();
			$data['fb_app_id']		=	$this->input->post('fb_app_id');
			$data['fb_app_secret']	=	$this->input->post('fb_app_secret');
			foreach($data as $key=>$val)
			{
				update_option($key, $val);
			}
			$this->session->set_flashdata('message', ' Update Suceessfully  !!!');
			redirect('setting-facebook');
		}

		$data['pageContent'] = $this->load->view('setting/setting/setting_facebook', $data, true);
		$this->load->view('layouts/main', $data);
	}


	public function social()
	{

		$data['main'] = "Social Setting";
		$data['active'] = "Update Setting";
		$data['title'] = "Social Setting  Update form ";

		if($this->input->post()) {

			$data				=	array();
			$data['facebook']	=	$this->input->post('facebook');
			$data['twitter']	=	$this->input->post('twitter');
			$data['youtube']	=	$this->input->post('youtube');
			$data['instagram']	=	$this->input->post('instagram');

			foreach($data as $key=>$val)
			{
				update_option($key, $val);
			}

			$this->session->set_flashdata('message', ' Update Suceessfully  !!!');
			redirect('setting-social');
		}

		$data['pageContent'] = $this->load->view('setting/setting/setting_social', $data, true);
		$this->load->view('layouts/main', $data);
	}

}
