<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Affiliate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MainModel');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('cart');
        $this->load->helper('form');
        $this->load->helper('captcha');
        date_default_timezone_set('Asia/Dhaka');


    }


    public function index()
    {

        $userRole = $this->session->userdata('user_id');
        if ($userRole) {
            $user_id = $userRole;
            $data['user_id'] = $userRole;
            $data['all_category'] = $this->MainModel->select_all_category();
            $result = $this->MainModel->select_affiliate_request($user_id);
            $data['affiliate_request'] = $result->affiliate_request_status;

            $data['all_request'] = $this->MainModel->select_all_request($user_id);
            $data['all_paid_request'] = $this->MainModel->select_all_paid_request($user_id);
            $data['my_create_link'] = $this->MainModel->select_my_all_link($user_id);
            $data['home'] = $this->load->view('affiliate/affiliate_account', $data, true);
            $this->load->view('affiliate/home', $data);
        } else {
            redirect('/');

        }

    }
 public function	mobile_login(){
		
		
	}
    public function load_request_from()
    {
        $this->load->view('affiliate/request_from');
    }

    public function amount_request_entry()
    {
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'commission_amount' => $this->input->post('commission_amount'),
            'type' => $this->input->post('type'),
            'date' => $this->input->post('date'),
            'details' => $this->input->post('details'),
            'status' => 1
        );
        $result = $this->MainModel->insertData('user_commission_request', $data);
        if ($result) {
            echo "Request successfully accepted!!! Please check balance";
        }
    }

    public function load_product_link_from($id)
    {
        $data['product_link'] = $this->MainModel->select_link_by_id($id);
        $data['product_id'] = $id;
        $this->load->view('affiliate/link_generate', $data);
    }

    public function load_product_single_link_from()
    {
        $this->load->view('affiliate/single_link_generate');
    }

    public function single_link_generate()
    {
        $userRole = $this->session->userdata('user_id');
        $link_name = $this->input->post('link_name');
        $traffic_source = $this->input->post('traffic_source');
        $new_url = substr($link_name, strpos($link_name, "product/") + 8);
        $folder = explode("/", $new_url);
        $folder_name = $folder[0];
        $result = $this->MainModel->select_product_id($folder_name);
        $id = $result->product_id;
        $user_id = $userRole;
        $product_key = "product/" . $folder_name;
        $check_controller = "home/affiliate_check_controller";
        $base_url = base_url();
        $get_link = $base_url . $check_controller . "/" . $product_key . "/" . $user_id;
        $data = array(
            'user_id' => $user_id,
            'product_id' => $id,
            'traffic_source' => $traffic_source,
            'product_link' => $get_link
        );
        $result = $this->MainModel->insertData('product_link_info', $data);
        if ($result) {
            echo $get_link;
        }
    }


    public function create_information()
    {
        $userRole = $this->session->userdata('user_id');
        $data = array(
            'user_id' => $userRole,
            'referral_website' => $this->input->post('referral_website'),
            'payment_type' => $this->input->post('payment_type'),
            'payment_information' => $this->input->post('payment_information')
        );
        $result = $this->MainModel->insertData('affiliate_information', $data);
        if ($result) {
            echo "First step completed successfully.";
        }
    }

    public function link_generate()
    {
        $userRole = $this->session->userdata('user_id');
        $id = $this->input->post('id');
        $link_name = $this->input->post('link_name');
        $traffic_source = $this->input->post('traffic_source');
        $user_id = $userRole;
        $product_key = "product/" . $link_name;
        $check_controller = "home/affiliate_check_controller";
        $base_url = base_url();
        $get_link = $base_url . $check_controller . "/" . $product_key . "/" . $user_id;
        $data = array(
            'user_id' => $user_id,
            'product_id' => $id,
            'traffic_source' => $traffic_source,
            'product_link' => $get_link
        );
        $result = $this->MainModel->insertData('product_link_info', $data);
        if ($result) {
            echo $get_link;
        }
    }

    public function load_product_link_view($id)
    {
        $data['product_link'] = $this->MainModel->select_all_product_by_id($id);
        $this->load->view('affiliate/product_link_view', $data);
    }

    public function phone_check()
    {

        $email = $this->input->post('phone');
        $result = $this->MainModel->getSingleData('user_mobile', $email, 'affiliate_users', '*');
        if ($result) {

            echo 'not';
        } else {

            echo 'unique';


        }
    }
    public function email_check()
    {

        $email = $this->input->post('email');
        $result = $this->MainModel->getSingleData('user_email', $email, 'affiliate_users', '*');
        if ($result) {

            echo 'not';
        } else {

            echo 'unique';


        }
    }

    public function sign_up_user()
    {
        $data['user_f_name'] = $this->input->post('user_f_name');
        $data['user_mobile'] = $this->input->post('mobile');
        $data['user_email'] = $this->input->post('user_email');
        $data['user_password'] = $this->input->post('user_password');
        $data['created_date'] = date('Y-m-d h:i :s');
        $user_id = $this->MainModel->returnInsertId('affiliate_users', $data);
        if ($user_id) {

            $dataa['user_f_name'] = $data['user_f_name'];
            $dataa['user_id'] = $user_id;
            $dataa['user_email'] =  $data['user_email'];
            $dataa['user_status'] = 'active';
            $this->session->set_userdata($dataa);

            echo 'ok';

        } else {
            echo 'Something wrong try again';

        }

    }

    public function mobile_sign_up_user()
    {


        $data_row['user_f_name'] = $this->input->post('user_f_name');
        $data_row['user_mobile'] = $this->input->post('user_mobile');
        $user_mobile = $this->input->post('user_mobile');

        $inputCaptcha = $this->input->post('captcha');
        $sessCaptcha = $this->session->userdata('captchaCode');
        $data_row['user_email'] = $this->input->post('user_email');
        $data_row['user_password'] = $this->input->post('user_password');
        $data_row['created_date'] = date('Y-m-d h:i :s');

$random_number = rand(1000,9999);

        if($inputCaptcha === $sessCaptcha){
            $this->db->where('user_mobile', $user_mobile);
            $result = $this->db->get('affiliate_users')->row();
            //SELECT * FROM `affiliate_users` WHERE user_mobile='01738305670'
            // print_r($result);
            if (empty($result)) {
                if (strlen($user_mobile) < 11) {
                    $dataa['signerror'] = "Enter Valid Bangladeshi Mobile Number";

                    $this->load->view('website/header');
                    $this->load->view('affiliate/mobile_login_sign_up_form', $dataa);
                    $this->load->view('website/footer');
                }
                $user_id = $this->MainModel->returnInsertId('affiliate_users', $data_row);
                if ($user_id) {

                    $dataa['user_f_name'] = $data_row['user_f_name'];
                    $dataa['user_id'] = $user_id;
                    $dataa['user_email'] = $data_row['user_email'];
                    $dataa['user_status'] = 'active';
                    $this->session->set_userdata($dataa);

                    redirect('Affiliate/my_account');
                }
            } else {

                $data['signerror'] = "This number already been registered, please reset your number or use another number";

                $this->load->view('website/header');
                $this->load->view('affiliate/mobile_login_sign_up_form', $data);
                $this->load->view('website/footer');
            }
        } else {

            $vals = array(
                'word'          => $random_number,
                'img_path'      => './captcha_images/',
                'img_url'       => base_url().'captcha_images/',
                'font_path'     => './path/to/fonts/texb.ttf',
                'img_width'     => '200',
                'img_height'    => 60,
                'expiration'    => 7200,
                'word_length'   => 4,
                'font_size'     => 30,
                'img_id'        => 'Imageid',


                // White background and border, black text and red grid
                'colors'        => array(
                    'background' => array(0, 128, 0),
                    'border' => array(255, 0, 0),
                    'text' => array(255, 255, 255),
                    'grid' => array(255, 0, 0)
                )
            );

            $cap = create_captcha($vals);

            // Unset previous captcha and set new captcha word
            $this->session->unset_userdata('captchaCode');
            $this->session->set_userdata('captchaCode', $cap['word']);

            // Pass captcha image to view
            $data['captchaImg'] = $cap['image'];



            $data['signerror'] = "Captcha code does not match, please try again.";

            $this->load->view('website/header');
            $this->load->view('affiliate/mobile_login_sign_up_form', $data);
            $this->load->view('website/footer');

        }

    }

    public function login_check()
    {

      $mobile = trim($this->input->post('user_email'));
       $password =trim($this->input->post('user_password'));
        $user = "select * from affiliate_users  
where affiliate_users.user_password='$password' and affiliate_users.user_mobile='$mobile'";
        $userResult = $this->MainModel->SingleQueryData($user);

        if ($userResult) {
            $data['user_f_name'] = $userResult->user_f_name;
            $data['user_id'] = $userResult->user_id;
            $data['user_email'] = $userResult->user_email;
            $data['user_status'] = 'active';
            $user_status = $userResult->user_status;
            if ($user_status == 0) {

                echo 'You are In Active user';
            } else {
                $this->session->set_userdata($data);
                echo 'Login Successfully';

            }


        } else {
            echo "Incorrect Mobile number or password";

        }


    }


    public function mobile_login_check()
    {

        $mobile = trim($this->input->post('user_email'));
        $password =trim($this->input->post('user_password'));
        $user = "select * from affiliate_users  
where affiliate_users.user_password='$password' and affiliate_users.user_mobile='$mobile'";
        $userResult = $this->MainModel->SingleQueryData($user);

        $inputCaptcha = $this->input->post('captcha');
        $sessCaptcha = $this->session->userdata('captchaCode');
        if($inputCaptcha === $sessCaptcha){
                if ($userResult) {
                    $data['user_f_name'] = $userResult->user_f_name;
                    $data['user_id'] = $userResult->user_id;
                    $data['user_email'] = $userResult->user_email;
                    $data['user_status'] = 'active';
                    $user_status = $userResult->user_status;
                    if ($user_status == 0) {

                        $data['error'] = "You are In Active user";

                        $this->load->view('website/header');
                        $this->load->view('affiliate/mobile_login_sign_up_form', $data);
                        $this->load->view('website/footer');

                    } else {
                        $this->session->set_userdata($data);
                        redirect('affiliate/my_account');

                    }


                } else {
                    $data['error'] = "Incorrect Mobile number or password";

                    $this->load->view('website/header');
                    $this->load->view('affiliate/mobile_login_sign_up_form', $data);
                    $this->load->view('website/footer');

                }
            } else {
            $random_number = rand(1000,9999);
            $vals = array(
                'word'          => $random_number,
                'img_path'      => './captcha_images/',
                'img_url'       => base_url().'captcha_images/',
                'font_path'     => './path/to/fonts/texb.ttf',
                'img_width'     => '200',
                'img_height'    => 60,
                'expiration'    => 7200,
                'word_length'   => 4,
                'font_size'     => 30,
                'img_id'        => 'Imageid',


                // White background and border, black text and red grid
                'colors'        => array(
                    'background' => array(0, 128, 0),
                    'border' => array(255, 0, 0),
                    'text' => array(255, 255, 255),
                    'grid' => array(255, 0, 0)
                )
            );

            $cap = create_captcha($vals);

            // Unset previous captcha and set new captcha word
            $this->session->unset_userdata('captchaCode');
            $this->session->set_userdata('captchaCode', $cap['word']);

            // Pass captcha image to view
            $data['captchaImg'] = $cap['image'];



            $data['error'] = "Captcha code does not match, please try again";

                $this->load->view('website/header');
                $this->load->view('affiliate/mobile_login_sign_up_form', $data);
                $this->load->view('website/footer');


            }


    }

    public function login_check_rating(){


     $mobile = trim($this->input->post('user_email'));
     $password =trim($this->input->post('user_password'));
     $user = "select * from affiliate_users  
where affiliate_users.user_password='$password' and affiliate_users.user_mobile='$mobile'";
     $userResult = $this->MainModel->SingleQueryData($user);

     if ($userResult) {
         $data['user_f_name'] = $userResult->user_f_name;
         $data['user_id'] = $userResult->user_id;
         $data['user_email'] = $userResult->user_email;
         $data['user_status'] = 'active';
         $user_status = $userResult->user_status;
         if ($user_status == 0) {

             echo 'You are In Active user';
         } else {
             $this->session->set_userdata($data);
            $data['login']='Login Successfully';

         }


     } else {
        
         $data['login']='Invalid Mobile   or password  !!!!';

     }
     echo json_encode($data);

 }
    public function my_account()
    {


        $data['home'] = $this->load->view('affiliate/my_account', '', true);
        $this->load->view('affiliate/home', $data);

    }


    public function edit()
    {
        $user_id = $this->session->userdata('user_id');
        $user_data['user'] = $this->MainModel->getSingleData('user_id', $user_id, 'affiliate_users', '*');
        if ($this->input->post()) {
            $user_id = $this->session->userdata('user_id');

            $data['user_f_name'] = $this->input->post('user_f_name');
            $data['user_l_name'] = $this->input->post('user_l_name');
            $data['user_email'] = $this->input->post('user_email');
            $data['user_address'] = $this->input->post('user_address');
            $data['user_mobile'] = $this->input->post('user_mobile');
            $update = $this->MainModel->updateData('user_id', $user_id, 'affiliate_users', $data);
            if ($update) {
                $this->session->set_flashdata('message', 'Account updated successfully !!!');
                redirect('affiliate/edit', 'refresh');
            }

        } else {

            $data['home'] = $this->load->view('affiliate/account_edit', $user_data, true);
            $this->load->view('affiliate/home', $data);
        }

    }

    public function change_password(){
        

        if ($this->input->post()) {
               $old_password = $this->input->post('old_password');
               $new_password = $this->input->post('new_password');


            $this->db->select('user_password');
            $this->db->where('user_password',$old_password);
            $this->db->limit(1);
            $result= $this->db->get('affiliate_users')->row();
           // $result=$this->db->query($query);

           if($result) {
            $data['user_password']=   $this->input->post('new_password');
               $user_id = $this->session->userdata('user_id');
             

               $update = $this->MainModel->updateData('user_id', $user_id, 'affiliate_users', $data);
               if ($update) {
                   $this->session->set_flashdata('message', 'Password updated successfully !!!');
                   redirect('affiliate/change_password', 'refresh');
               }
           } else {
               $this->session->set_flashdata('message', 'Old Password does not matched ');
               redirect('affiliate/change_password', 'refresh');
           }

        } else {
            $data['home'] = $this->load->view('affiliate/change_password', '', true);
            $this->load->view('affiliate/home', $data);
        }

    }

    public function logOut()
    {
        $this->session->unset_userdata('user_status');
        $this->session->unset_userdata('user_id');

        redirect('/');


    }


    public function order_list()
    {
        $user_id = $this->session->userdata('user_id');
        $data['orders_list'] = $this->MainModel->getAllData("affiliate_user_id=$user_id", 'order_data', '*', 'order_id desc');


        $data['home'] = $this->load->view('affiliate/my_order_list', $data, true);
        $this->load->view('affiliate/home', $data);


    }

    public function order_edit($id)
    {
        $user_data['order'] = $this->MainModel->getSingleData('order_id', $id, 'order_data', '*');

        $data['home'] = $this->load->view('affiliate/my_order_edit', $user_data, true);
        $this->load->view('affiliate/home', $data);


    }

    public function affiliate_page()
    {


        $this->load->view('affiliate/affiliate_page');
        // $this->load->view('affiliate/home', $data);

    }
    public function create_affiliate_request()
    {

        $userRole = $this->session->userdata('user_id');
        $data = array(
            'permanent_address' => $this->input->post('permanent_address'),
            'present_address' => $this->input->post('present_address'),
            'phone_number' => $this->input->post('phone_number'),
            'email' => $this->input->post('email')
        );
        $data1 = array(
            'affiliate_request_status' => 1
        );
        $this->MainModel->update_status($data1, $userRole);
        $result = $this->MainModel->insertData('affiliate_request_information', $data);
        if ($result) {
            echo "Your request successfully sent.";
        }
    }
    public function  login_signup(){



     
       $user_id= $this->session->userdata('user_id');
        if($user_id){
            redirect('Affiliate/my_account');
        } else {
$random_number = rand(1000,9999);
            
            $vals = array(
                'word'          => $random_number,
                'img_path'      => './captcha_images/',
                'img_url'       => base_url().'captcha_images/',
                'font_path'     => './path/to/fonts/texb.ttf',
                'img_width'     => '200',
                'img_height'    => 60,
                'expiration'    => 7200,
                'word_length'   => 4,
                'font_size'     => 30,
                'img_id'        => 'Imageid',


                // White background and border, black text and red grid
                'colors'        => array(
                    'background' => array(0, 128, 0),
                    'border' => array(255, 0, 0),
                    'text' => array(255, 255, 255),
                    'grid' => array(255, 0, 0)
                )
            );

            $cap = create_captcha($vals);

            // Unset previous captcha and set new captcha word
            $this->session->unset_userdata('captchaCode');
            $this->session->set_userdata('captchaCode', $cap['word']);

            // Pass captcha image to view
            $data['captchaImg'] = $cap['image'];




            $this->load->view('website/header');
            $this->load->view('affiliate/mobile_login_sign_up_form',$data);
            $this->load->view('website/footer');
        }
    }

    public function refresh(){
        // Captcha configuration
$random_number = rand(1000,9999);
        $vals = array(
            'word'          => $random_number,
            'img_path'      => './captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path'     => './path/to/fonts/texb.ttf',
            'img_width'     => '200',
            'img_height'    => 60,
            'expiration'    => 7200,
            'word_length'   => 4,
            'font_size'     => 30,
            'img_id'        => 'Imageid',


            // White background and border, black text and red grid
            'colors'        => array(
                'background' => array(0, 128, 0),
                'border' => array(255, 0, 0),
                'text' => array(255, 255, 255),
                'grid' => array(255, 0, 0)
            )
        );

        $cap = create_captcha($vals);
        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$cap['word']);

        // Display captcha image
        echo $cap['image'];
    }

}

