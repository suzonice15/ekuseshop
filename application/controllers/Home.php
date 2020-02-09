<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MainModel');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('cart');
        $this->load->helper('form');
        $this->load->library('pdf');
        $this->load->helper('captcha');


        date_default_timezone_set('Asia/Dhaka');

        $visitor['client_ip'] = $_SERVER['REMOTE_ADDR'];
        $visitor['date'] = date('Y-m-d');
        $result = $this->MainModel->visitorCount($visitor['client_ip'], $visitor['date']);
        if (empty($result)) {
            $result = $this->MainModel->insertData('hitcounter', $visitor);

        }


    }

    public function index()
    {
        $today=date('Y-m-d');


        $data['page_name'] = 'home';
        $data['seo_title'] = get_option('home_seo_title');
        $data['seo_keywords'] = get_option('home_seo_keywords');
        $data['seo_content'] = get_option('home_seo_content');
        $query25 = "SELECT * FROM `product` WHERE `discount_type`='percent' and product_percent_tag BETWEEN 1 and 20
and discount_date_from <='$today' and discount_date_to >='$today'  order by modified_time desc limit 6";
        $data['product25'] = $this->MainModel->AllQueryDalta($query25);
        $query50 = "SELECT * FROM `product` WHERE `discount_type`='percent' and product_percent_tag BETWEEN 21 and 40 and discount_date_from <='$today' and discount_date_to >='$today'
order by modified_time desc limit 6";
        $data['product50'] = $this->MainModel->AllQueryDalta($query50);
        $query75 = "SELECT * FROM `product` WHERE `discount_type`='percent' and product_percent_tag BETWEEN 41 and 75
and discount_date_from <='$today' and discount_date_to >='$today' order by modified_time desc limit 6";
        $data['product75'] = $this->MainModel->AllQueryDalta($query75);




        $data['home'] = $this->load->view('website/home_content', $data, true);
        $this->load->view('website/home', $data);
    }

    public function ajax_search_items()
    {
        $search_query = trim($this->input->post('search_query'));
        $search_query = strtolower($search_query);
        $discount = '';

        $result = get_result("SELECT * FROM product WHERE product_title LIKE '%$search_query%' OR sku LIKE '$search_query%' limit 0, 6");
        $html = '';


        //	echo $result->num_rows();

        if ($result) {
            $i = 0;
            foreach ($result as $prod) {
                $product_link = base_url() . 'product/' . $prod->product_name;
                // product price
                $product_price =  $prod->product_price;
                $product_discount = $prod->discount_price;
                $sku= $prod->sku;
                if ($product_discount) {
                    $discount = $product_price;
                    $sell_price =$product_discount;
                } else {
                    $sell_price =  $product_price;
                }
                $image = get_product_thumb($prod->product_id);

                if ($i <= 7) {
                    $html .= '<tr><td width = "20%" ><a href="' . $product_link . '" class="text-decoration-none">
							<img width = "70" height = "50" src ="' . $image . '" ></a></td>
							<td width = "80%" ><a href="' . $product_link . '" class="text-decoration-none">' . $prod->product_title . ' <br/><del>' . formatted_price($discount) . '</del>  ' . formatted_price($sell_price) . '<br/>Code:'.$sku.' </td>	
						</a></tr>';
                }

                $i++;
            }


            $resultx = get_result("SELECT * FROM product WHERE product_title LIKE '%$search_query%' OR sku LIKE '$search_query%' ");

//            if (sizeof($resultx) > 7) {
//                $html .= '<tr><td colspan="2"><a class="btn btn-info btn-sm" href="' . base_url() . 'search?q=' . $search_query . '">' . (sizeof($resultx) - 6) . ' more results</a></td></tr>';
//            }
        } else {
            $html .= '<tr style="padding:10px;"><td>No results found!</td></tr>';
        }

        echo json_encode(array("status" => "success", "return_value" => $html));
        die();
    }



    public function cart()
    {

        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->MainModel->getSingleData('user_id', $user_id, 'affiliate_users', '*');
        $data['page_name'] = 'home';
        $districts_query = "SELECT name FROM `districts` order by id ASC ";
        $data['districts'] = $this->MainModel->AllQueryDalta($districts_query);
        $data['home'] = $this->load->view('website/cart', $data, true);
        $this->load->view('website/home', $data);


    }


    public function checkout()
    {
        date_default_timezone_set('Asia/Dhaka');

        if ($this->input->post()) {
            $get_cookies = $this->input->cookie('unique_code', true);
            if ($get_cookies) {
                $result = $this->MainModel->check_cookies_data($get_cookies);
                $set_user_id = $result->user_id;
            } else {
                $set_user_id = "";
            }
            $userid = $this->session->userdata('user_id');
            if ($userid) {
                $user_id = $this->session->userdata('user_id');
            } else {
                $user_id = 0;

            }
            $posts 				= $this->input->post();
            //echo '<pre>'; print_r($posts); echo '</pre>';exit;
            $this->session->set_userdata('checkout_form_data', $posts);



            $order_total= $this->input->post('order_total');
            $row_data['order_total'] = $this->input->post('order_total');
            $row_data['created_by'] = 'customer';
            $row_data['products'] = serialize($this->input->post('products'));
            $row_data['payment_type'] = $this->input->post('payment_type');
            $row_data['shipping_charge'] = $this->input->post('shipping_charge');
            $row_data['customer_name'] = $this->input->post('customer_name');
            $row_data['customer_phone'] = $this->input->post('customer_phone');
            $row_data['customer_email'] = $this->input->post('customer_email');
            $row_data['customer_address'] = $this->input->post('customer_address');
            $row_data['delevery_address'] = $this->input->post('delevery_address');
            $row_data['bkash_payment'] = $this->input->post('bkash_payment');
            $row_data['city'] = $this->input->post('city');
            $row_data['affiliate_user_id'] = $user_id;
            $row_data['shipment_time'] = date("Y-m-d h:i:s");
            $row_data['created_time'] = date("Y-m-d h:i:s");
            $row_data['modified_time'] = date("Y-m-d");
            $payment_type 		= $this->input->post('payment_type');
            $billing_country	= 'Bangladesh';



            if($payment_type=='cash_on_delivery' || $payment_type=='bKash')
            {
                $order_id = $this->MainModel->returnInsertId('order_data', $row_data);
                $this->session->set_userdata('order_id',$order_id);

                if($order_id)
                {

                    redirect('checkout/thank-you/?directpay=success', 'refresh');
                }
                else
                {
                    redirect('checkout/thank-you/?directpay=fail?order_id=', 'refresh');
                }
            }
            else
            {
                $post_data = array();
                $post_data['total_amount'] =  $row_data['order_total'];
              //  print_r($post_data['total_amount']);exit();
                $post_data['currency'] = "BDT";
                $post_data['tran_id'] = "SSLC".uniqid();
                $post_data['success_url'] = base_url()."success";
                $post_data['fail_url'] = base_url()."fail";
                $post_data['cancel_url'] = base_url()."cancel";
                $post_data['ipn_url'] = base_url()."ipn";
                # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

                # EMI INFO
                // $post_data['emi_option'] = "1";
                // $post_data['emi_max_inst_option'] = "9";
                // $post_data['emi_selected_inst'] = "9";

                # CUSTOMER INFORMATION
                $post_data['cus_name'] =  $row_data['customer_name'];
                $post_data['cus_email'] =$row_data['customer_email'];
                $post_data['cus_add1'] =  $row_data['customer_address'] ;
               $post_data['cus_city'] =  $row_data['city'];
               // $post_data['cus_state'] = $this->input->post('state');
              ////  $post_data['cus_postcode'] = $this->input->post('postcode');
              $post_data['cus_country'] = $billing_country;
             $post_data['cus_phone'] = $row_data['customer_phone'] ;

                # SHIPMENT INFORMATION


                $post_data['ship_name'] = $row_data['customer_name'];
                $post_data['ship_add1'] =  $row_data['customer_address'];
                $post_data['ship_city'] =  $row_data['city'];
                $post_data['ship_state'] =$row_data['city'];
                $post_data['ship_postcode'] ="1216";
                $post_data['ship_country'] = $billing_country;

                # OPTIONAL PARAMETERS
              //  $post_data['value_a'] = "ref001";
              //  $post_data['value_b'] = "ref002";
               // $post_data['value_c'] = "ref003";
               // $post_data['value_d'] = "ref004";

                $post_data['product_profile'] = "physical-goods";
                $post_data['shipping_method'] = "YES";
                $post_data['num_of_item'] = "1";
                $post_data['product_name'] = "Computer,Speaker";
                $post_data['product_category'] = "Ecommerce";

                $cart_items = array();

                if(isset($products['items']) && sizeof($products['items'])>0)
                {
                    foreach($products['items'] as $item_id=>$item)
                    {
                        $cart_items[] = array('product'=>$item['name'], 'amount'=>str_replace(',', '', $item['subtotal']));
                    }
                }

                $post_data['cart'] = json_encode($cart_items);

                $post_data['product_amount'] = "10";
                $post_data['vat'] = "1";
                $post_data['discount_amount'] = "1";
                $post_data['convenience_fee'] = "1";

                $this->load->library('session');

                $session = array(
                    'tran_id' => $post_data['tran_id'],
                    'amount' => $post_data['total_amount'],
                    'currency' => $post_data['currency']
                );
                $this->session->set_userdata('tarndata', $session);


                if($this->sslcommerz->RequestToSSLC($post_data, SSLCZ_STORE_ID, SSLCZ_STORE_PASSWD))
                {

                    echo "Pending";
                    /***************************************
                    # Change your database status to Pending.
                     ****************************************/
                }

            }

//            $order_id = $this->MainModel->returnInsertId('order_data', $row_data);
//            if ($order_id) {
//
////                $product_all = $this->input->post('product_id');
////                foreach ($product_all as $key => $prod) {
////                    $data['order_id'] = $order_id;
////                    $data['product_id'] = $prod;
////                    $data['user_id'] = $set_user_id;
////                    $this->MainModel->insertData('user_order_count', $data);
////                }
//                $this->cart->destroy();
//
//
//                redirect('checkout/thank-you/?order_id=' . $order_id, 'refresh');
//            }


        } else {

            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->MainModel->getSingleData('user_id', $user_id, 'affiliate_users', '*');

            $data['page_name'] = 'home';
            $districts_query = "SELECT name FROM `districts` order by id ASC ";
            $data['districts'] = $this->MainModel->AllQueryDalta($districts_query);

            $data['home'] = $this->load->view('website/checkout', $data, true);
            $this->load->view('website/home', $data);
        }

    }


    public function thank_you()
    {
        $data['page_name'] = 'home';

        $data['page_name'] = 'home';

//        $checkout_type = $order->payment_type;
//        $products = unserialize($order->products);
//        $order_total = $order->order_total;

        $userid = $this->session->userdata('user_id');
        if ($userid) {
            $user_id = $this->session->userdata('user_id');
        } else {
            $user_id = 0;

        }
//        $billing_name = $order->customer_name;
//        $billing_email = $order->customer_email;
//        $billing_address = $order->customer_address;
//        $delivery_address = $order->delevery_address;
//        $shipping_charge = $order->shipping_charge;
        $cfdata = $this->session->userdata('checkout_form_data');
        $row_data['order_total'] =  $cfdata['order_total'];
        $row_data['created_by'] = 'customer';
        $row_data['products'] = serialize($cfdata['products']);
        $row_data['payment_type'] = $cfdata['payment_type'];
        $row_data['shipping_charge'] = $cfdata['shipping_charge'];
        $row_data['customer_name'] =  $cfdata['customer_name'] ;
        $row_data['customer_phone'] =   $cfdata['customer_phone'];
        $row_data['customer_email'] = $cfdata['customer_email'];
        $row_data['customer_address'] = $cfdata['customer_address'] ;
        $row_data['delevery_address'] =  $cfdata['delevery_address'];
        $row_data['city'] =  $cfdata['city'];
        $row_data['affiliate_user_id'] = $user_id;
        $row_data['shipment_time'] = date("Y-m-d h:i:s");
        $row_data['created_time'] = date("Y-m-d h:i:s");
        $row_data['modified_time'] = date("Y-m-d");
        $order_id = $this->session->userdata('order_id');

        if(isset($_GET['directpay']) && $_GET['directpay']=='success')
        {
            if($this->session->userdata('sslcommerz_data'))
            {
                $ssldata 	= $this->session->userdata('sslcommerz_data');
                //echo '<pre>'; print_r($ssldata); echo '</pre>';
                $row_data['sslcommerz'] = serialize($ssldata);
                $order_id = $this->MainModel->returnInsertId('order_data', $row_data);
                //$order_id = $this->checkout->place_order($row_data);
            }
        }


        $order = $this->MainModel->getSingleData('order_id', $order_id, 'order_data', '*');

        //send order confirmation email to customer
//        $customer_email = $billing_email;
//        $site_title = get_option('site_title');
//        $site_email = get_option('email');
//
//        $config['protocol'] = 'sendmail';
//        $config['mailpath'] = '/usr/sbin/sendmail';
//        $config['charset'] = 'iso-8859-1';
//        $config['wordwrap'] = TRUE;
//        $this->email->initialize($config);
//
//        $this->email->from($site_email, $site_title);
//        $this->email->to($customer_email, 'ok');
//        $this->email->subject('Order Confirmation');
//
//        $order_status = 'new';
//        $product_items = $products;
//        $payment_method = ucwords(str_replace('_', ' ', $checkout_type));
//        $order_number = $order_id;
//        $customer_name = $billing_name;
//        $customer_address = $billing_address;
//        $delivery_address = $delivery_address;

//        ob_start();
//        include('application/views/emails/email-header.php');
//        include('application/views/emails/new-order.php');
//        include('application/views/emails/email-footer.php');
//        $email_body = ob_get_clean();
//
//        //  echo $email_body;
//        $this->email->message($email_body);
//        $this->email->send();
//        $this->cart->destroy();
//        if ($this->email->send()) {
//
//            // echo 'ok';
//            //  exit();
//        } else {
//            // echo 'false';
//            // exit();
//        }
        $this->session->set_userdata('checkout_form_data', null);
        $this->session->set_userdata('sslcommerz_data', null);

        $this->cart->destroy();
        $data['order'] = $order;

        $data['home'] = $this->load->view('website/thank_you', $data, true);

        $this->load->view('website/home', $data);

    }


    public function category()
    {
        $uri_string = explode("/", uri_string());
        $category_name = end($uri_string);
        $category_data = $this->MainModel->getSingleData('category_name', $category_name, 'category', 'category_id,category_title,category_name,seo_title,seo_meta_title,seo_keywords,seo_content,seo_meta_content');


        $data['breadcumb_category'] = $category_data->category_title;
        $data['breadcumb_category_link'] = $category_data->category_name;
        $data['category_id'] = $category_data->category_id;
        $category_name = $category_data->category_name;


        $data['seo_title'] = $category_data->seo_title;
        $data['seo_keywords'] = $category_data->seo_keywords;
        $data['seo_content'] = $category_data->seo_content;
        $data['page_title'] = ucwords(str_replace("-", " ", $category_name));



        $data['home'] = $this->load->view('website/category_products', $data, true);
        $this->load->view('website/home', $data);



    }

    public function product()
    {

        $uri_string = explode("/", uri_string());
        $product_name = end($uri_string);
        $post = $this->MainModel->getSingleData('product_name', $product_name, 'product', 'product_availability,product_name,product_id,product_title,product_price,discount_price,product_description,sku,product_stock,product_of_size,product_color,discount_type,product_video,seo_title,seo_keywords,seo_content,product_terms,product_summary');

        $data['prod_row'] = $post;
        $data['page_title'] = $post->product_title;
        $product_id = $post->product_id;
        $data['seo_title'] = $post->seo_title;
        $data['seo_keywords'] = $post->seo_keywords;
        $data['seo_content'] = $post->seo_content;
        $data['product_page_error_solve'] = 1;
        $sql = "SELECT category_title,category_name FROM `term_relation` join category on category.category_id=term_relation.term_id
WHERE product_id=$post->product_id limit 1";
        $category = get_result($sql);
        $data['specifications'] = $this->MainModel->allDataById("product_id", $product_id, 'product_specification', '*');

        $data['breadcumb_category'] = $category[0]->category_title;
        $data['breadcumb_category_link'] = 'category/' . $category[0]->category_name;


        $data['home'] = $this->load->view('website/product_font_view', $data, true);
        $this->load->view('website/home', $data);



    }

    public function pages()
    {
        $uri_string = explode("/", uri_string());
        $product_name = end($uri_string);

        $post = get_uri_not_found_data(end($uri_string));


        $data['page_title'] = $post->page_name;
        $data['page_name'] = $post->page_link;
        $data['page_content'] = $post->page_content;

        $template = $post->page_template;
        $template = $template == 'default' ? 'page' : $template;



        $data['home'] = $this->load->view($template, $data, true);
        $this->load->view('website/home', $data);



    }

    public function search()
    {
        //WHERE interests LIKE '%sports%' OR interests LIKE '%pub%'
        $search = $this->input->get_post('q');
        $sql = "SELECT * FROM `product` WHERE `product_title` LIKE '%$search%'  OR sku LIKE '$search%'  ORDER BY product_id DESC";
        $data['products'] = get_result($sql);



        $data['home'] = $this->load->view('website/search', $data, true);
        $this->load->view('website/home', $data);


    }

    public function all_products()
    {

        $this->load->view('website/header');
        $this->load->view('website/all_products');
        $this->load->view('website/footer');
    }

    public function affiliate_check_controller($route_name = null, $product_key = null, $user_id = null)
    {
        $unique_number = (mt_rand(10000, 999999));
        $cookie = array(
            'name' => 'unique_code',
            'value' => $unique_number,
            'expire' => time() + (86400 * 7),
            'secure' => false
        );
        $this->input->set_cookie($cookie);
        $result = $this->MainModel->select_product_id($product_key);
        $data = array(
            'user_id' => $user_id,
            'product_id' => $result->product_id,
            'unique_number' => $unique_number
        );
        $this->MainModel->insertData('product_hit_count', $data);
        $base_url = base_url();
        $get_link = $base_url . $route_name . "/" . $product_key;
        redirect($get_link);
    }

    public function pdf($order_id){


        $order = $this->MainModel->getSingleData('order_id', $order_id, 'order_data', '*');
        $data['order'] = $order;


        $this->pdf->load_view('website/pdf',$data);
        $this->pdf->render();
        $this->pdf->stream($order_id.".pdf");

    }

    public function password_reset(){
        $unique_number = mt_rand(1000, 99999);
        $vals = array(
            'word'          => $unique_number,
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

            if ($this->input->post('email')) {

                $email = $this->input->post('email');
                if (is_numeric($email)) {
                    $mobile = $email;
                    $mobile_data['mobile'] = $mobile;
                    $mobile_check = preg_match('/^[0-9]{11}+$/', $mobile);
                    if ($mobile_check) {
                        $insert_id = $this->MainModel->returnInsertId('password_reset_request', $mobile_data);
                        if ($insert_id) {
                            $data['success'] = 'Thank you Within few hours we contact with you';


                            $this->load->view('website/header');
                            $this->load->view('affiliate/passord_reset', $data);
                            $this->load->view('website/footer');
                        }
                    } else {
                        $data['error'] = 'Invalid phone number: must have exactly 11 digits and begin with 01';


                        $this->load->view('website/header');
                        $this->load->view('affiliate/passord_reset', $data);
                        $this->load->view('website/footer');

                    }
                } else {
                    $query = "SELECT * FROM `affiliate_users` WHERE user_email='$email'";
                    $results = get_result($query);
                    if ($results) {
                        $name = $results[0]->user_f_name;
                        $resetPassLink = base_url() . 'home/new_password/' . $email;
                        $data['success'] = 'To reset password varify  your email address';
                        $message = "Dear $name, 
                Recently a request was submitted to reset a password for your account. If this was a mistake, just ignore this email and nothing will happen.
               To reset your password, visit the following link: $resetPassLink
               Regards,
               Ekusheshop.com";
                        // $message='To reset password <a href="">click</a>here';
                        mail($email, 'Password Reset', $message);


                        $this->load->view('website/header');
                        $this->load->view('affiliate/passord_reset', $data);
                        $this->load->view('website/footer');

                    } else {
                        $data['error'] = 'There is no account  with the email address you provided.';
                        $this->load->view('website/header');
                        $this->load->view('affiliate/passord_reset', $data);
                        $this->load->view('website/footer');
                    }
                }

            }



        else {


            $this->load->view('website/header');
            $this->load->view('affiliate/passord_reset',$data);
            $this->load->view('website/footer');
        }

    }


    public function password_reset_check(){


        $random_number = rand(1000,9999);

        $inputCaptcha = $this->input->post('captcha');
        $sessCaptcha = $this->session->userdata('captchaCode');
        if($inputCaptcha === $sessCaptcha){
            $email = $this->input->post('email');
            if (is_numeric($email)) {
                $mobile = $email;
                $mobile_data['mobile'] = $mobile;
                $mobile_check = preg_match('/^[0-9]{11}+$/', $mobile);
                if ($mobile_check) {
                    $insert_id = $this->MainModel->returnInsertId('password_reset_request', $mobile_data);
                    if ($insert_id) {
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
                        $data['success'] = 'Thank you Within few hours we contact with you';


                        $this->load->view('website/header');
                        $this->load->view('affiliate/passord_reset', $data);
                        $this->load->view('website/footer');
                    }
                } else {
                   // $random_number = rand(1000,9999);
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
                    $data['error'] = 'Invalid phone number: must have exactly 11 digits and begin with 01';


                    $this->load->view('website/header');
                    $this->load->view('affiliate/passord_reset', $data);
                    $this->load->view('website/footer');

                }
            } else {
                $query = "SELECT * FROM `affiliate_users` WHERE user_email='$email'";
                $results = get_result($query);
                if ($results) {
                    $name = $results[0]->user_f_name;
                    $resetPassLink = base_url() . 'home/new_password/' . $email;
                    $data['success'] = 'To reset password varify  your email address';
                    $message = "Dear $name, 
                Recently a request was submitted to reset a password for your account. If this was a mistake, just ignore this email and nothing will happen.
               To reset your password, visit the following link: $resetPassLink
               Regards,
               Ekusheshop.com";
                    // $message='To reset password <a href="">click</a>here';
                    mail($email, 'Password Reset', $message);
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
                    $this->load->view('affiliate/passord_reset', $data);
                    $this->load->view('website/footer');

                } else {
                    $vals = array(
                        'word'          =>$random_number,
                        'img_path'      => './captcha_images/',
                        'img_url'       => base_url().'captcha_images/',
                        'font_path'     => './path/to/fonts/texb.ttf',
                        'img_width'     => '200',
                        'img_height'    => 60,
                        'expiration'    => 7200,
                        'word_length'   =>4,
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
                    $data['error'] = 'There is no account  with the email address you provided.';
                    $this->load->view('website/header');
                    $this->load->view('affiliate/passord_reset', $data);
                    $this->load->view('website/footer');
                }
            }

        }



        else {

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
            $data['error'] = 'Captcha code does not match, please try again.';
            $this->load->view('website/header');
            $this->load->view('affiliate/passord_reset',$data);
            $this->load->view('website/footer');
        }

    }





    public function new_password(){
        $uri_string = explode("/", uri_string());
        $uri_email = end($uri_string);
        $data['email']=$uri_email;
        $this->load->view('website/header');
        $this->load->view('affiliate/new_password',$data);
        $this->load->view('website/footer');
    }

    public function new_update_password(){

        $email=$this->input->post('email');
        $data['email']=$email;
        $passord=$this->input->post('passord');
        $row['user_password']=$passord;
        $npassord=$this->input->post('npassord');
        if(strlen($passord) <8 ){
            $data['error']="Enter at least 8 digit alphabets";

            $this->load->view('website/header');
            $this->load->view('affiliate/new_password',$data);
            $this->load->view('website/footer');
        }
        if($passord !=$npassord){
            $data['error']="New password and confirm password does not match";
            $this->load->view('website/header');
            $this->load->view('affiliate/new_password',$data);
            $this->load->view('website/footer');
        } else {
            $this->MainModel->updateData('user_email', $email, 'affiliate_users', $row);
            $data['success']="Your password has been changed";
            $this->load->view('website/header');
            $this->load->view('affiliate/new_password',$data);
            $this->load->view('website/footer');
        }
    }

}
