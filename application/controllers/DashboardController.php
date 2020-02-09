<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MainModel');
        $userRole = $this->session->userdata('user_active');
        if ($userRole != "active") {
            redirect('admin');

        }

    }

    public function index()
    {
        date_default_timezone_set("Asia/Dhaka");


        $new_sql = "SELECT COUNT(order_id) as total_order FROM `order_data` WHERE `order_status` = 'new'";
        $new_result = get_result($new_sql);
        foreach ($new_result as $row) ;
        $new_order = $row->total_order;
        $data['new_order'] = $new_order;
        $today = date('Y-m-d');
        $total_order_sql = "SELECT COUNT(order_id) as total_order_count FROM `order_data`  WHERE  order_status !='try' and  modified_time = '$today%'";
        $total_order_result = get_result($total_order_sql);
        foreach ($total_order_result as $row) ;
        $data['total_order_count'] = $row->total_order_count;

        $customer_sql = "SELECT COUNT(user_id) as total_user_id FROM `affiliate_users`  
where affiliate_user=1 ";
        $customer__result = get_result($customer_sql);
        foreach ($customer__result as $row) ;
        $data['total_generel_user'] = $row->total_user_id;
        $customer_sql = "SELECT COUNT(user_id) as total_affiliate_user_id FROM `affiliate_users`  
where affiliate_request_status=2 ";
        $customer__result = get_result($customer_sql);
        foreach ($customer__result as $row) ;
        $data['total_affiliate_user'] = $row->total_affiliate_user_id;

        $product_sql = "SELECT COUNT(product_id) as product_id FROM `product` ";
        $product__result = get_result($product_sql);
        foreach ($product__result as $row) ;
        $data['total_product'] = $row->product_id;

        $product_sql = "SELECT COUNT(product_id) as product_id FROM `product` ";
        $product__result = get_result($product_sql);
        foreach ($product__result as $row) ;
        $data['total_product'] = $row->product_id;

        $hitcounter_sql = "SELECT COUNT(hitcounter_id) as hitcounter_id FROM `hitcounter` WHERE date like '$today%' ";
        $hitcounter__result = get_result($hitcounter_sql);
        foreach ($hitcounter__result as $row) ;
        $data['total_hitcounter'] = $row->hitcounter_id;


        $riview_sql = "SELECT COUNT(review_id) as review_id  FROM `review`   WHERE review_active=0";
        $riveiw__result = get_result($riview_sql);
        foreach ($riveiw__result as $row) ;
        $data['total_reviews'] = $row->review_id;

        $media_id_sql = "SELECT COUNT(media_id) as media_id FROM `media` ";
        $media__result = get_result($media_id_sql);
        foreach ($media__result as $row) ;
        $data['total_media'] = $row->media_id;


        $data['main'] = "Dashboard";
        $data['active'] = "view Dashboard";
        $data['pageContent'] = $this->load->view('dashboard', $data, true);
        $this->load->view('layouts/main', $data);
    }

    public function password()
    {

        $data['passwords'] = $this->MainModel->getAllData('status=0', 'password_reset_request', '*', 'password_id ASC');
        $data['title'] = "";
        $data['main'] = "Password Change";
        $data['active'] = "Change Password";
        $data['pageContent'] = $this->load->view('layouts/password', $data, true);
        $this->load->view('layouts/main', $data);
    }

    public function changed($id)
    {
        $user_data['status'] = 1;
        $this->MainModel->updateData('password_id', $id, 'password_reset_request', $user_data);
        $data['passwords'] = $this->MainModel->getAllData('status=0', 'password_reset_request', '*', 'password_id ASC');
        $data['title'] = "";
        $data['main'] = "Password Change";
        $data['active'] = "Change Password";
        $data['pageContent'] = $this->load->view('layouts/password', $data, true);
        $this->load->view('layouts/main', $data);
    }


}
