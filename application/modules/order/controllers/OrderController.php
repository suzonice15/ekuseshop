<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class OrderController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('cart');
        $this->load->model('OrderModel', 'order');
        $this->load->model('MainModel');

        $this->load->library('Ajax_pagination');
        $this->perPage = 5;
        $userType=$this->session->userdata('user_type');

        if($userType !='super-admin' && $userType !='admin' && $userType !='office-staff'){
            redirect('admin');
        }
    }

    public function index()
    {


        $data['main'] = "Orders ";
        $data['active'] = "View Order ";
      $query="SELECT * FROM `order_data` where order_status !='try' and try_status=0 ORDER BY `order_id` DESC limit 20";
        $data['orders'] =  $this->MainModel->AllQueryDalta($query);
        $data['pageContent'] = $this->load->view('order/orders/orders_index', $data, true);
        $this->load->view('layouts/main', $data);


    }

    public function all_payment_request()
    {
        $data['payment_request'] = $this->MainModel->select_all_request_for_admin();
        $data['pageContent'] = $this->load->view('order/orders/all_payment_request', $data, true);
        $this->load->view('layouts/main', $data);
    }

    public function approved_payment($id)
    {
        $data = array(
            'status' => 0
        );
        $result = $this->MainModel->update_payment($data, $id);
        if ($result) {
            echo "Payment approved successfully.";
        }
    }




    function create()
    {
        date_default_timezone_set("Asia/Dhaka");

        $data['main'] = "Orders ";
        $total_cost=0;

        $data['active'] = "Add Order ";
        $data['title'] = " Order  registration form";
        $productQuery = "select product.product_id,product.product_title,sku from product 
";
        $data['orders'] = $this->MainModel->AllQueryDalta($productQuery);
        $data['user_id'] = 2;
        $districts_query = "SELECT name FROM `districts` order by id ASC ";
        $data['districts'] = $this->MainModel->AllQueryDalta($districts_query);

        $data['couriers'] = $this->MainModel->getAllData("courier_status=1", 'courier', '*', 'courier_id desc');
        if ($this->input->post()) {
            $shipping_charge = $this->input->post('shipping_charge');

            $total_cost =$this->input->post('order_total')+$shipping_charge ;
            $row_data['order_total'] = $total_cost;
            $row_data['created_by'] =$this->session->userdata('user_name');

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
            $row_data['shipment_time'] = date("Y-m-d H:i:s");
            $row_data['created_time'] = date("Y-m-d H:i:s");
            $row_data['modified_time'] = date("Y-m-d");

            $customer_name = $row_data['customer_name'];
            $customer_email = $row_data['customer_email'];
            $site_title = get_option('site_title');
            $site_email = get_option('email');
            $row_data['staff_id'] = $this->input->post('staff_id');

            $row_data['order_status'] = 'new';//$this->input->post('order_status');
            $this->form_validation->set_rules('customer_name', 'name', 'trim|required');
            $this->form_validation->set_rules('customer_phone', 'phone', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $this->session->set_flashdata('error', 'Fill Up all the Required field    !');
                redirect('order-create');
            } else {
                $order_id = $this->MainModel->returnInsertId('order_data', $row_data);
                if ($order_id) {

                    // send order confirmation email to customer
                    $site_title = get_option('site_title');
                    $site_email = get_option('email');

                    $config['protocol'] = 'sendmail';
                    $config['charset'] = 'utf-8';
                    $config['wordwrap'] = TRUE;
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);

                    $this->email->from($site_email, $site_title);
                    $this->email->to($customer_email);
                    $this->email->subject('Order Confirmation');

                    $order_status = 'new';

                    ob_start();
                    include('applications/views/emails/email-header.php');
                    include('applications/views/emails/new-order.php');
                    include('applications/views/emails/email-footer.php');
                    $email_body = ob_get_clean();

                    //echo $email_body;
                    $this->email->message($email_body);
                    $this->email->send();

                    $this->session->set_flashdata('message', "Order created successfully-- Order Number :$order_id");
                    redirect('order-create');
                } else {
                    $this->session->set_flashdata('error', 'Order does not completed try again');
                    redirect('order-create');
                }
            }
        } else {
            $data['pageContent'] = $this->load->view('order/orders/orders_create', $data, true);
            $this->load->view('layouts/main', $data);
        }

    }

    public function tryorder()
    {
        $data['main'] = " Try Orders ";
        $data['active'] = "try Order ";
        $data['title'] = "";
        $data['pageContent'] = $this->load->view('order/orders/order_try', $data, true);
        $this->load->view('layouts/main', $data);


    }

    public function try_view($order_id)
    {

        $data['order'] = $this->MainModel->getSingleData('order_id', $order_id, 'order_data', '*');
        $data['try_order'] = $this->MainModel->try_view($order_id);
        $data['pageContent'] = $this->load->view('order/orders/order_try_view', $data, true);
        $this->load->view('layouts/main', $data);


    }

    public function update()
    {
    

        $order_number = $this->input->post('row_id');
        $data['order_status'] = $this->input->post('order_status');

        $order_status = $this->input->post('order_status');
        $shipping_charge = $this->input->post('shipping_charge');
        $shipping_charge_in_ajax = $this->input->post('shipping_charge_in_ajax');
        $data['modified_time'] = date("Y-m-d H:i:s");
        if($shipping_charge_in_ajax>0) {
            $data['order_total'] = $this->input->post('order_total') + $shipping_charge;
        } else {

            $data['order_total'] = $this->input->post('order_total') ;
        }
        $data['products'] = serialize($this->input->post('products'));
        $data['customer_name'] = $this->input->post('customer_name');
        $data['customer_phone'] = $this->input->post('customer_phone');
        $data['customer_email'] = $this->input->post('customer_email');
        $data['customer_address'] = $this->input->post('customer_address');
        $data['delevery_address'] = $this->input->post('delevery');
        $data['shipping_charge'] = $this->input->post('shipping_charge');
        $data['discount'] = $this->input->post('discount');
        $data['order_note'] = $this->input->post('order_note');
        $data['bkash_payment'] = $this->input->post('bkash_payment');
        $data['payment_type'] = $this->input->post('payment_type');
        $data['city'] = $this->input->post('city');
        
      

        if ($order_status == 'delivered') {
            $results = $this->MainModel->select_product_id_by_order_id($order_number);

            foreach ($results as $result) {
                $price = $result->product_price;
                $discount = $result->discount_price;
                if ($discount) {
                    $set_commistion = ($discount * 3) / 100;
                } else {

                    $set_commistion = ($price * 3) / 100;
                }

                $data2 = array(
                    'user_id' => $result->user_id,
                    'product_id' => $result->product_id,
                    'commission' => $set_commistion
                );
                $this->MainModel->insertData('user_commission',$data2);
            }
        }


        $customer_name = $data['customer_name'];
        $customer_email = $data['customer_email'];
        $site_title = get_option('site_title');
        $site_email = get_option('email');


        $data['shipment_time'] = date('Y-m-d h:i s', strtotime($this->input->post('shipment_time')));

        $config['protocol'] = 'sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from($site_email, $site_title);
        $this->email->to($customer_email);
        $this->email->subject('Order Status');

        if ($order_status == 'cancled') {
            ob_start();
            include('applications/views/emails/email-header.php');
            include('applications/views/emails/cancle-order.php');
            include('applications/views/emails/email-footer.php');
            $email_body = ob_get_clean();
        } elseif ($order_status == 'completed') {
            ob_start();
            include('applications/views/emails/email-header.php');
            include('applications/views/emails/complete-order.php');
            include('applications/views/emails/email-footer.php');
            $email_body = ob_get_clean();
        } else {
            ob_start();
            include('applications/views/emails/email-header.php');
            include('applications/views/emails/order-content.php');
            include('applications/views/emails/email-footer.php');
            $email_body = ob_get_clean();
        }
        $order_data = $this->MainModel->updateData('order_id', $order_number, 'order_data', $data);


        if ($order_data) {
            $this->session->set_flashdata('message', 'Order updated successfully !!!');
            redirect('order-list', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Failed to Update the data !!!');
            $this->edit($order_number);
        }


    }


    public function order_view($order_id)
    {
        $data['main'] = "Orders ";
        $data['active'] = "View Single Order ";
        $data['order'] = $this->MainModel->getSingleData('order_id', $order_id, 'order_data', '*');
        $data['pageContent'] = $this->load->view('order/orders/orders_view', $data, true);
        $this->load->view('layouts/main', $data);

    }

    public function OptionName($option_name)
    {
        $curiar = $this->MainModel->getSingleData('option_name', $option_name, 'options', 'option_value');
        $data = unserialize($curiar);
        var_dump($data);


    }


    function update_order()
    {
        date_default_timezone_set("Asia/Dhaka");

        if ($this->session->userdata('loggedin')) {
            $userdata = $this->session->userdata('loggedin');
            $data['user_id'] = $userdata['user_id'];
            $data['user_name'] = $userdata['user_name'];
            $data['user_phone'] = $userdata['user_phone'];
            $data['user_type'] = $userdata['user_type'];
            $data['user_email'] = $userdata['user_email'];
            $data['row_id'] = $this->input->post('row_id');
            $data['page_title'] = 'Order(' . $data['row_id'] . ')';
            $data['form_title'] = 'Update';
            $data['user_sidebar'] = $this->load->view('admin/sidebar', $data, true);

            if ($data['user_type'] == 'admin' || $data['user_type'] == 'super-admin' || $data['user_type'] == 'office-staff' || $data['user_type'] == 'delivery-man') {
                $order_number = $data['row_id'];
                $order_status = $this->input->post('order_status');
                $order = $this->order->order_view($order_number);

                $row_data = array();
                $row_data['modified_time'] = date("Y-m-d H:i:s");

                if (!isset($_GET['shipment']) && !isset($_GET['courier']) && !isset($_GET['ready_to_deliver'])) {
                    $order_total = $this->input->post('order_total');
                    $products = $this->input->post('products');

                    $billing_name = $this->input->post('billing_name');
                    $billing_phone = $this->input->post('billing_phone');
                    $billing_email = $this->input->post('billing_email');
                    $billing_address1 = $this->input->post('billing_address1');
                    $shipping_address1 = $this->input->post('shipping_address1');

                    $service_cost = $this->input->post('service_cost');
                    $discount = $this->input->post('discount');

                    $row_data['order_total'] = $order_total;
                    $row_data['products'] = serialize($products);
                } else {
                    $order_total = $order->order_total;
                    $billing_email = get_order_meta($order->order_id, 'billing_email');
                    $products = unserialize($order->products);
                    $billing_name = get_order_meta($order->order_id, 'billing_name');
                    $billing_address1 = get_order_meta($order->order_id, 'billing_address1');
                    $shipping_address1 = get_order_meta($order->order_id, 'shipping_address1');
                }

                // send order status email to customer
                $customer_email = $billing_email;
                $site_title = get_option('site_title');
                $site_email = get_option('email');

                $product_items = $products;
                $payment_method = ucwords(str_replace('_', ' ', $order->payment_type));
                $shipping_charge = get_order_meta($order->order_id, 'shipping_charge');
                //$order_total 				= $order_total;
                $customer_name = $billing_name;
                $customer_address = $billing_address1;
                $delivery_address = $shipping_address1;

                $courier_code = $this->input->post('courier_code');
                $courier_phone = $this->input->post('courier_phone');
                $courier_email = $this->input->post('courier_email');

                $delivery_man = ($this->input->post('delivery_man')) ? $this->input->post('delivery_man') : null;
                $delivery_man_phone = ($this->input->post('delivery_man_phone')) ? $this->input->post('delivery_man_phone') : null;
                $delivery_time = ($this->input->post('delivery_time')) ? date('Y-m-d', strtotime($this->input->post('delivery_time'))) : null;

                $config['protocol'] = 'sendmail';
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = TRUE;
                $config['mailtype'] = 'html';
                $this->email->initialize($config);

                $this->email->from($site_email, $site_title);
                $this->email->to($customer_email);
                $this->email->subject('Order Status');

                if ($order_status == 'cancled') {
                    ob_start();
                    include('applications/views/emails/email-header.php');
                    include('applications/views/emails/cancle-order.php');
                    include('applications/views/emails/email-footer.php');
                    $email_body = ob_get_clean();
                } elseif ($order_status == 'completed') {
                    ob_start();
                    include('applications/views/emails/email-header.php');
                    include('applications/views/emails/complete-order.php');
                    include('applications/views/emails/email-footer.php');
                    $email_body = ob_get_clean();
                } else {
                    ob_start();
                    include('applications/views/emails/email-header.php');
                    include('applications/views/emails/order-content.php');
                    include('applications/views/emails/email-footer.php');
                    $email_body = ob_get_clean();
                }

                if (isset($_GET['shipment']) && $_GET['shipment'] == 'process') {
                    $row_data['courier_code'] = $courier_code;
                    $row_data['order_status'] = $order_status;

                    if ($this->order->update_order($row_data, $order_number)) {
                        update_order_meta($order_number, 'courier_phone', $courier_phone);
                        update_order_meta($order_number, 'courier_email', $courier_email);

                        $this->email->message($email_body);
                        $this->email->send();

                        redirect('admin/order/print-view/' . $order_number . '?message=success&purpose=update', 'refresh');
                    } else {
                        redirect('admin/order/print-view/' . $order_number . '?message=false&msg=failed+to+update', 'refresh');
                    }
                } elseif (isset($_GET['courier']) && $_GET['courier'] == 'process') {
                    $row_data['courier_code'] = $courier_code;
                    $row_data['order_status'] = $order_status;

                    if ($this->order->update_order($row_data, $order_number)) {
                        update_order_meta($order_number, 'courier_phone', $courier_phone);
                        update_order_meta($order_number, 'courier_email', $courier_email);
                        update_order_meta($order_number, 'delivery_man', $delivery_man);
                        update_order_meta($order_number, 'delivery_man_phone', $delivery_man_phone);
                        update_order_meta($order_number, 'delivery_time', $delivery_time);

                        $this->email->message($email_body);
                        $this->email->send();

                        redirect('admin/order/courier-view/' . $order_number . '?message=success&purpose=update', 'refresh');
                    } else {
                        redirect('admin/order/courier-view/' . $order_number . '?message=false&msg=failed+to+update', 'refresh');
                    }
                } elseif (isset($_GET['ready_to_deliver']) && $_GET['ready_to_deliver'] == 'process') {
                    $row_data['courier_code'] = $courier_code;
                    $row_data['order_status'] = $order_status;

                    if ($this->order->update_order($row_data, $order_number)) {
                        update_order_meta($order_number, 'courier_phone', $courier_phone);
                        update_order_meta($order_number, 'courier_email', $courier_email);
                        update_order_meta($order_number, 'delivery_man', $delivery_man);
                        update_order_meta($order_number, 'delivery_man_phone', $delivery_man_phone);
                        update_order_meta($order_number, 'delivery_time', $delivery_time);

                        $this->email->message($email_body);
                        $this->email->send();

                        redirect('admin/order/ready-to-deliver-view/' . $order_number . '?message=success&purpose=update', 'refresh');
                    } else {
                        redirect('admin/order/ready-to-deliver-view/' . $order_number . '?message=false&msg=failed+to+update', 'refresh');
                    }
                } else {
                    $order_area = $this->input->post('order_area');

                    $row_data['courier_service'] = $this->input->post('courier_service');
                    $row_data['shipment_time'] = date("Y-m-d H:i:s", strtotime($this->input->post('shipment_time')));
                    $row_data['order_status'] = $order_status;

                    if ($this->order->update_order($row_data, $order_number)) {
                        update_order_meta($order_number, 'billing_name', $billing_name);
                        update_order_meta($order_number, 'billing_phone', $billing_phone);
                        update_order_meta($order_number, 'billing_email', $billing_email);
                        update_order_meta($order_number, 'billing_address1', $billing_address1);
                        update_order_meta($order_number, 'shipping_address1', $shipping_address1);

                        update_order_meta($order_number, 'service_cost', $service_cost);
                        update_order_meta($order_number, 'discount', $discount);

                        update_order_meta($order_number, 'order_area', $order_area);
                        update_order_meta($order_number, 'courier_phone', $courier_phone);
                        update_order_meta($order_number, 'courier_email', $courier_email);
                        update_order_meta($order_number, 'delivery_man', $delivery_man);
                        update_order_meta($order_number, 'delivery_man_phone', $delivery_man_phone);

                        $this->email->message($email_body);
                        $this->email->send();

                        redirect('admin/order/view/' . $order_number . '?message=success&purpose=update', 'refresh');
                    } else {
                        redirect('admin/order/view/' . $order_number . '?message=false&msg=failed+to+update', 'refresh');
                    }
                }
            } else {
                redirect('authentication-failure', 'refresh');
            }
        } else {
            redirect('admin', 'refresh');
        }
    }


    function report()
    {

        $data['main'] = "Order Reports ";
        $data['active'] = "View Order report ";
        $data['user_type'] = "admin";

        $data['page_title'] = 'Order Report';
        $data['form_title'] = 'Update';
        $data['pageContent'] = $this->load->view('order/orders/orders_report', $data, true);
        $this->load->view('layouts/main', $data);

    }


    function courier_report()
    {
        if ($this->session->userdata('loggedin')) {
            $userdata = $this->session->userdata('loggedin');
            $data['user_id'] = $userdata['user_id'];
            $data['user_name'] = $userdata['user_name'];
            $data['user_phone'] = $userdata['user_phone'];
            $data['user_type'] = $userdata['user_type'];
            $data['user_email'] = $userdata['user_email'];
            $data['row_id'] = $this->input->post('row_id');
            $data['page_title'] = 'Courier Report';
            $data['form_title'] = 'Update';
            $data['user_sidebar'] = $this->load->view('admin/sidebar', $data, true);

            if ($data['user_type'] == 'admin' || $data['user_type'] == 'super-admin') {
                $this->load->view('header', $data);
                $this->load->view('courier_report', $data);
                $this->load->view('footer', $data);
            } else {
                redirect('authentication-failure', 'refresh');
            }
        } else {
            redirect('admin', 'refresh');
        }
    }


    function ready_for_shipment()
    {
        if ($this->session->userdata('loggedin')) {
            $userdata = $this->session->userdata('loggedin');
            $data['user_id'] = $userdata['user_id'];
            $data['user_name'] = $userdata['user_name'];
            $data['user_phone'] = $userdata['user_phone'];
            $data['user_type'] = $userdata['user_type'];
            $data['user_email'] = $userdata['user_email'];
            $data['row_id'] = $this->input->post('row_id');
            $data['page_title'] = 'Order Ready For Shipment';
            $data['form_title'] = 'Update';
            $data['user_sidebar'] = $this->load->view('admin/sidebar', $data, true);

            if ($data['user_type'] == 'admin' || $data['user_type'] == 'super-admin' || $data['user_type'] == 'delivery-man') {
                $this->load->view('header', $data);
                $this->load->view('order_ready_for_shipment', $data);
                $this->load->view('footer', $data);
            } else {
                redirect('authentication-failure', 'refresh');
            }
        } else {
            redirect('admin', 'refresh');
        }
    }


    function ready_to_deliver()
    {
        if ($this->session->userdata('loggedin')) {
            $userdata = $this->session->userdata('loggedin');
            $data['user_id'] = $userdata['user_id'];
            $data['user_name'] = $userdata['user_name'];
            $data['user_phone'] = $userdata['user_phone'];
            $data['user_type'] = $userdata['user_type'];
            $data['user_email'] = $userdata['user_email'];
            $data['row_id'] = $this->input->post('row_id');
            $data['page_title'] = 'Order Ready to Deliver';
            $data['form_title'] = 'Update';
            $data['user_sidebar'] = $this->load->view('admin/sidebar', $data, true);

            if ($data['user_type'] == 'admin' || $data['user_type'] == 'super-admin' || $data['user_type'] == 'delivery-man') {
                $this->load->view('header', $data);
                $this->load->view('order_ready_to_deliver', $data);
                $this->load->view('footer', $data);
            } else {
                redirect('authentication-failure', 'refresh');
            }
        } else {
            redirect('admin', 'refresh');
        }
    }


    function on_courier()
    {
        if ($this->session->userdata('loggedin')) {
            $userdata = $this->session->userdata('loggedin');
            $data['user_id'] = $userdata['user_id'];
            $data['user_name'] = $userdata['user_name'];
            $data['user_phone'] = $userdata['user_phone'];
            $data['user_type'] = $userdata['user_type'];
            $data['user_email'] = $userdata['user_email'];
            $data['row_id'] = $this->input->post('row_id');
            $data['page_title'] = 'Order On Courier';
            $data['form_title'] = 'Update';
            $data['user_sidebar'] = $this->load->view('admin/sidebar', $data, true);

            if ($data['user_type'] == 'admin' || $data['user_type'] == 'super-admin' || $data['user_type'] == 'delivery-man') {
                $this->load->view('header', $data);
                $this->load->view('order_on_courier', $data);
                $this->load->view('footer', $data);
            } else {
                redirect('authentication-failure', 'refresh');
            }
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function courier_view($order_id)
    {
        if ($this->session->userdata('loggedin')) {
            $userdata = $this->session->userdata('loggedin');
            $data['user_id'] = $userdata['user_id'];
            $data['user_name'] = $userdata['user_name'];
            $data['user_phone'] = $userdata['user_phone'];
            $data['user_type'] = $userdata['user_type'];
            $data['user_email'] = $userdata['user_email'];
            $data['page_title'] = 'Order (' . $order_id . ') Courier View';
            $data['form_title'] = 'Update';
            $data['user_sidebar'] = $this->load->view('admin/sidebar', $data, true);
            $data['order'] = $this->order->order_view($order_id);

            if ($data['user_type'] == 'admin' || $data['user_type'] == 'super-admin' || $data['user_type'] == 'office-staff' || $data['user_type'] == 'delivery-man') {
                $this->load->view('header', $data);
                $this->load->view('order_courier_view', $data);
                $this->load->view('footer', $data);
            } else {
                redirect('admin', 'refresh');
            }
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function ready_to_deliver_view($order_id)
    {
        if ($this->session->userdata('loggedin')) {
            $userdata = $this->session->userdata('loggedin');
            $data['user_id'] = $userdata['user_id'];
            $data['user_name'] = $userdata['user_name'];
            $data['user_phone'] = $userdata['user_phone'];
            $data['user_type'] = $userdata['user_type'];
            $data['user_email'] = $userdata['user_email'];
            $data['page_title'] = 'Order (' . $order_id . ') Ready to Deliver';
            $data['form_title'] = 'Update';
            $data['user_sidebar'] = $this->load->view('admin/sidebar', $data, true);
            $data['order'] = $this->order->order_view($order_id);

            if ($data['user_type'] == 'admin' || $data['user_type'] == 'super-admin' || $data['user_type'] == 'office-staff' || $data['user_type'] == 'delivery-man') {
                $this->load->view('header', $data);
                $this->load->view('order_ready_to_deliver_view', $data);
                $this->load->view('footer', $data);
            } else {
                redirect('admin', 'refresh');
            }
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function productSelection()
    {
        $item_count=0;
        $product_ids = explode(",", $this->input->post('product_id'));
        $qty = $this->input->post('product_quantity');
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where_in('product_id', $product_ids);
        $query = $this->db->get();
        $products = $query->result();
        $html = 'No Products Info. Found!';
        if (count($products) > 0) {
            $html = '<table class="table table-striped table-bordered">
				<tr>
					<th class="name" width="30%">Product</th>
                                            <th class="name" width="5%">Code</th>
                                            <th class="image text-center" width="5%">Image</th>
                                            <th class="image text-center" width="10%">Size</th>
                                            <th class="image text-center" width="15%">Color</th>
                                            <th class="quantity text-center" width="10%">Qty</th>
                                            <th class="price text-center" width="10%">Price</th>
                                            <th class="total text-right" width="10%">Sub-Total</th>
				</tr>';
            foreach ($products as $prod) {
                if($prod->discount_price){
                    $sell_price=$prod->discount_price;
                } else {

                    $sell_price = floatval($prod->product_price);
                }
                $this->db->select('product_of_size');
                $this->db->where('product_id', $prod->product_id);
                $productSize = $this->db->get('product')->result();
                foreach ($productSize as $product) {
                    $proSizeList = $product->product_of_size;
                }
                $productSize_OF = explode(',', $proSizeList);
                $this->db->select('product_color');
                $this->db->where('product_id', $prod->product_id);
                $productColor = $this->db->get('product')->result();
                foreach ($productColor as $product_co) {
                    $proColorlist = $product_co->product_color;
                }
                $productColor = explode(',', $proColorlist);
                $subtotal = ($sell_price * $qty);
                $totalamout[] = $subtotal;
                $featured_image = get_product_thumb($prod->product_id, 'thumb');
                $html .= '<tr>
						<td>' . $prod->product_title . '</td>
						<td>'.$prod->sku.'</td>
						<td class="image text-center">
							<img src="' . $featured_image . '" height="30" width="30">
						</td>
						
								<td>
								<select name="products[items][' . $prod->product_id . '][Size]"  id="productSize" class="form-control item_Size" >';
                foreach ($productSize_OF as $key => $product_size_id_of):
                    $html .= '<option value="' . $product_size_id_of . '">' . $product_size_id_of . '</option>';
                endforeach;
                $html .= '</select> 	</td>';
                $html .= '<td>
								<select name="products[items][' . $prod->product_id . '][Color]"  id="productSize" class="form-control item_color" >';
                foreach ($productColor as $key => $productCol):
                    $html .= '<option value="' . $productCol . '">' . $productCol . '</option>';
                endforeach;
                $html .= '</select></td>
						<td class="text-center">
							<input type="number" name="products[items][' . $prod->product_id . '][qty]" class="form-control item_qty" value="' . $qty . '" data-item-id="' . $prod->product_id . '" style="width:60px;">
						</td>
						<td class="text-center">৳ ' . $sell_price . '.00</td>
						<td class="text-right">৳ ' . $subtotal . '.00</td>
					</tr>';
                $html .= form_hidden('products[items][' . $prod->product_id . '][featured_image]', $featured_image);
                $html .= form_hidden('products[items][' . $prod->product_id . '][price]', $sell_price);
                $html .= form_hidden('products[items][' . $prod->product_id . '][name]', $prod->product_title);
                $html .= form_hidden('products[items][' . $prod->product_id . '][subtotal]', $subtotal);
                $html .='<input type="hidden" class="shipping_charge_in_dhaka"
                                                       value="'.get_product_delevery_price_in_dhaka($prod->product_id).'"> 
                                                       <input type="hidden" class="shipping_charge_out_of_dhaka"
                                                       value="'.get_product_delevery_price_out_dhaka($prod->product_id).'">
                                                         <input type="hidden" id="quantity_list" value="'.$item_count.'">';
            }
            $html .= '</table>';
            $html .= '<a class="btn btn-primary pull-right update_items">Change</a><br><br><br>';
            $order_total = array_sum($totalamout);
            $delivery_cost = 0;//get_option('shipping_charge_in_dhaka');
            $delivery_cost_Out_Side_Dhaka = 0;//get_option('shipping_charge_out_of_dhaka');
            $order_total = $order_total + $delivery_cost;
            $html .= '<table class="table table-striped table-bordered">
				<tbody>
					<tr>
						<td>
							<span class="extra bold">Sub-Total</span>
						</td>
						<td class="text-right">
							<span class="bold">৳ 
								<span id="subtotal_cost">
									' . array_sum($totalamout) . '.00
								</span>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold">Delivery Cost</span>
						</td>
						<td  class="text-right">
							<span class="bold"><span id="delivery_cost"><input type="text" name="shipping_charge" id="shipping_charge_suzon" class="form-control"></span></span>
								<input type="hidden"  id="shipping_charge_suzon" name="shipping_charge_in_ajax" value="10" class="form-control">
							' . form_hidden('shipping_charge', $delivery_cost) . '
						
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold totalamout">Total</span>
						</td>
						<td class="text-right">
							<span class="bold totalamout">৳ <span id="total_cost">' . $order_total . '.00</span></span>
							' . form_hidden('order_total', $order_total) . '
							' . form_hidden('checkout_type', 'cash_on_delivery') . '
						</td>
					</tr>';
            $html .= '</tbody>
			</table>';
        }
        echo json_encode(array("html" => $html));
        die();
    }




    function productSelectionChange()
    {
        $total_quntity=0;
        $subtotall=0;
        $product_ids = explode(",", $this->input->get_post('product_ids'));
        $product_qtys = explode(",", $this->input->get_post('product_qtys'));
        $shipping_charge =  $this->input->get_post('shipping_charge');
        $size = $this->input->get_post('size');
        $pqty = array_combine($product_ids, $product_qtys);

        $this->db->select('*');
        $this->db->from('product');
        $this->db->where_in('product_id', $product_ids);
        $query = $this->db->get();
        $products = $query->result();
        $html = 'No Products Info. Found!';
        if (count($products) > 0) {
            $html = '<table class="table table-striped table-bordered">
				<tr>
					 <th class="name" width="30%">Product</th>
                                            <th class="name" width="5%">Code</th>
                                            <th class="image text-center" width="5%">Image</th>
                                            <th class="image text-center" width="10%">Size</th>
                                            <th class="image text-center" width="15%">Color</th>
                                            <th class="quantity text-center" width="10%">Qty</th>
                                            <th class="price text-center" width="10%">Price</th>
                                            <th class="total text-right" width="10%">Sub-Total</th>
				</tr>';
            foreach ($products as $prod) {
                $qty = $pqty[$prod->product_id];
                $total_quntity=$qty+$pqty[$prod->product_id];;
                $this->db->select('product_of_size');
                $this->db->where('product_id', $prod->product_id);
                $productSize = $this->db->get('product')->result();
                foreach ($productSize as $product) {
                    $proSizeList = $product->product_of_size;
                }
                $productSize_OF = explode(',', $proSizeList);
                $this->db->select('product_color');
                $this->db->where('product_id', $prod->product_id);
                $productColor = $this->db->get('product')->result();
                foreach ($productColor as $product_co) {
                    $proColorlist = $product_co->product_color;
                }
                $productColor = explode(',', $proColorlist);
                if($prod->discount_price){
                    $sell_price = floatval($prod->discount_price);
                    $sell_price=$sell_price.'.00';

                } else {
                    $sell_price = floatval($prod->product_price);
                    $sell_price=$sell_price.'.00';



                }

             

                $subtotal = ($sell_price * $qty);
                $subtotall = $subtotal.'.00';
                $totalamout[] = $subtotal;
               // $totalamout[] = $totalamout[].'.00';
                $product_link = base_url() . 'product/' . $prod->product_name;
                $featured_image = get_product_thumb($prod->product_id, 'thumb');

                $html .= '<tr>
						<td><a href="'.$product_link.'">' . $prod->product_title . '</a></td>
						<td>'.$prod->sku.'</td>
						<td class="image text-center">
							<img src="' . $featured_image . '" height="30" width="30">
						</td>
							<td>
								<select name="products[items][' . $prod->product_id . '][Size]"  id="productSize" class="form-control item_Size" >';
                foreach ($productSize_OF as $key => $product_size_id_of):
                    $html .= '<option value="' . $product_size_id_of . '">' . $product_size_id_of . '</option>';
                endforeach;
                $html .= '</select></td>';
                $html .= '<td>
								<select name="products[items][' . $prod->product_id . '][Color]"  id="productSize" class="form-control item_color" >';
                foreach ($productColor as $key => $productCol):
                    $html .= '<option value="' . $productCol . '">' . $productCol . '</option>';
                endforeach;
                $html .= '</select></td>
						<td class="text-center">
							<input type="number" name="products[items][' . $prod->product_id . '][qty]" class="form-control item_qty" value="' . $qty . '" data-item-id="' . $prod->product_id . '" style="width:60px;">
						</td>
						<td class="text-center">৳ ' . $sell_price .'</td>
						<td class="text-right">৳ ' . $subtotall . '</td>
					</tr>';
                $html .= form_hidden('products[items][' . $prod->product_id . '][featured_image]', $featured_image);
                //$html.=form_hidden('products[items]['.$prod->product_id.'][qty]', $qty);
                $html .= form_hidden('products[items][' . $prod->product_id . '][price]', $sell_price);
                $html .= form_hidden('products[items][' . $prod->product_id . '][name]', $prod->product_title);
                $html .= form_hidden('products[items][' . $prod->product_id . '][subtotal]', $subtotall);
            }
            $html .= '</table>';
            $html .= '<a class="btn btn-primary pull-right update_items">Change</a><br><br><br>';
            $order_total = array_sum($totalamout);
            $delivery_cost = $shipping_charge;//get_option('shipping_charge_in_dhaka');
            $delivery_cost_Out_Side_Dhaka = 0;// get_option('shipping_charge_out_of_dhaka');
            $order_total = $order_total + $delivery_cost;
            $order_total =$order_total.'.00' ;
            $html .= '<table class="table table-striped table-bordered">
				<tbody>
					<tr>
						<td>
							<span class="extra bold">Sub-Total</span>
						</td>
						<td class="text-right">
							<span class="bold">৳ 
								<span id="subtotal_cost">
									' . array_sum($totalamout) . '.00
								</span>
							</span>
						</td>
					</tr>
					<tr>
						<td >
							<span class="extra bold">Delivery Cost</span>
						</td>
						<td class="text-right">
							<span  class="bold"><span id="delivery_cost">
							<input type="text" name="shipping_charge" id="shipping_charge_suzon" class="form-control"></span></span>
								<input type="hidden"  id="shipping_charge_suzon" name="shipping_charge_in_ajax" value="10" class="form-control">
							' . form_hidden('shipping_charge_Out', $delivery_cost_Out_Side_Dhaka) . '
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold totalamout">Total</span>
						</td>
						<td class="text-right">
							<span class="bold totalamout">৳ <span id="total_cost">' . $order_total . '</span></span>
							' . form_hidden('order_total', $order_total) . '
							' . form_hidden('checkout_type', 'cash_on_delivery') . '
						</td>
					</tr>
				</tbody>
			</table>';
        }
        echo json_encode(array("html" => $html));
        die();
    }


    function productSelectionUpdate()
    {
        $product_ids = explode(",", $this->input->get_post('product_ids'));
        $product_qtys = explode(",", $this->input->get_post('product_qtys'));
        $shipping_charge =  $this->input->get_post('shipping_charge');
        $size = $this->input->get_post('size');
        $pqty = array_combine($product_ids, $product_qtys);

        $this->db->select('*');
        $this->db->from('product');
        $this->db->where_in('product_id', $product_ids);
        $query = $this->db->get();
        $products = $query->result();
        $html = 'No Products Info. Found!';
        if (count($products) > 0) {
            $html = '<table class="table table-striped table-bordered">
				<tr>
					 <th class="name" width="30%">Product</th>
                                            <th class="name" width="5%">Code</th>
                                            <th class="image text-center" width="5%">Image</th>
                                            <th class="image text-center" width="10%">Size</th>
                                            <th class="image text-center" width="15%">Color</th>
                                            <th class="quantity text-center" width="10%">Qty</th>
                                            <th class="price text-center" width="10%">Price</th>
                                            <th class="total text-right" width="10%">Sub-Total</th>
				</tr>';
            foreach ($products as $prod) {
                $qty = $pqty[$prod->product_id];
                $this->db->select('product_of_size');
                $this->db->where('product_id', $prod->product_id);
                $productSize = $this->db->get('product')->result();
                foreach ($productSize as $product) {
                    $proSizeList = $product->product_of_size;
                }
                $productSize_OF = explode(',', $proSizeList);
                $this->db->select('product_color');
                $this->db->where('product_id', $prod->product_id);
                $productColor = $this->db->get('product')->result();
                foreach ($productColor as $product_co) {
                    $proColorlist = $product_co->product_color;
                }
                $productColor = explode(',', $proColorlist);
                if($prod->discount_price){
                    $sell_price = floatval($prod->discount_price);

                } else {
                    $sell_price = floatval($prod->product_price);


                }

                $subtotal = ($sell_price * $qty);
                $totalamout[] = $subtotal;
                $product_link = base_url() . 'product/' . $prod->product_name;

                $featured_image = get_product_thumb($prod->product_id, 'thumb');


                $html .= '<tr>
						<td><a href="'.$product_link.'">' . $prod->product_title . '</a></td>
						<td>'.$prod->sku.'</td>
						<td class="image text-center">
							<img src="' . $featured_image . '" height="30" width="30">
						</td>
							<td>
								<select name="products[items][' . $prod->product_id . '][Size]"  id="productSize" class="form-control item_Size" >';
                foreach ($productSize_OF as $key => $product_size_id_of):
                    $html .= '<option value="' . $product_size_id_of . '">' . $product_size_id_of . '</option>';
                endforeach;
                $html .= '</select></td>';
                $html .= '<td>
								<select name="products[items][' . $prod->product_id . '][Color]"  id="productSize" class="form-control item_color" >';
                foreach ($productColor as $key => $productCol):
                    $html .= '<option value="' . $productCol . '">' . $productCol . '</option>';
                endforeach;
                $html .= '</select></td>
						<td class="text-center">
							<input type="number" name="products[items][' . $prod->product_id . '][qty]" class="form-control item_qty" value="' . $qty . '" data-item-id="' . $prod->product_id . '" style="width:60px;">
						</td>
						<td class="text-center">৳ ' . $sell_price . '</td>
						<td class="text-right">৳ ' . $subtotal . '</td>
					</tr>';
                $html .= form_hidden('products[items][' . $prod->product_id . '][featured_image]', $featured_image);
                //$html.=form_hidden('products[items]['.$prod->product_id.'][qty]', $qty);
                $html .= form_hidden('products[items][' . $prod->product_id . '][price]', $sell_price);
                $html .= form_hidden('products[items][' . $prod->product_id . '][name]', $prod->product_title);
                $html .= form_hidden('products[items][' . $prod->product_id . '][subtotal]', $subtotal);
            }
            $html .= '</table>';
            $html .= '<a class="btn btn-primary pull-right update_items">Change</a><br><br><br>';
            $order_total = array_sum($totalamout);
            $delivery_cost = $shipping_charge;//get_option('shipping_charge_in_dhaka');
            $delivery_cost_Out_Side_Dhaka = 0;// get_option('shipping_charge_out_of_dhaka');
            $order_total = $order_total + $delivery_cost;
            $html .= '<table class="table table-striped table-bordered">
				<tbody>
					<tr>
						<td>
							<span class="extra bold">Sub-Total</span>
						</td>
						<td class="text-right">
							<span class="bold">৳ 
								<span id="subtotal_cost">
									' . array_sum($totalamout) . '
								</span>
							</span>
						</td>
					</tr>
					<tr>
						<td >
							<span class="extra bold">Delivery Cost </span>
						</td>
						<td class="text-right">
							<span  class="bold"> <input type="text" id="shipping_charge_suzon" name="shipping_charge" class="form-control">
							<input type="hidden"  id="shipping_charge_suzon" name="shipping_charge_in_ajax" value="10" class="form-control">
							</span>
							</span>
							
							' . form_hidden('shipping_charge_Out', $delivery_cost_Out_Side_Dhaka) . '
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold totalamout">Total</span>
						</td>
						<td class="text-right">
							<span class="bold totalamout">৳ <span id="total_cost">' . $order_total . '</span></span>
							' . form_hidden('order_total', $order_total) . '
							' . form_hidden('checkout_type', 'cash_on_delivery') . '
						</td>
					</tr>
				</tbody>
			</table>';
        }
        echo json_encode(array("html" => $html));
        die();
    }

    public function CourierSelection()
    {
        $courier_id = $this->input->post('courier_id');
        $data['couriers'] = $this->MainModel->getAllData("courier_status=$courier_id", 'courier', '*', 'courier_id desc');
        $html = '<select name="courier_service" id="courier_service" class="form-control">';
        foreach ($data['couriers'] as $courier):
            $html .= '<option value="' . $courier->courier_name . '">' . $courier->courier_name . '</option>';
        endforeach;
        $html .= '<select>';
        echo $html;

    }

    public function delete($orderId)
    {

        if (isset($orderId)) {
            $result = $this->MainModel->deleteData('order_id', $orderId, 'order_data');
            if ($result) {

                $this->session->set_flashdata('message', ' Order deleted    successfully!');
                redirect('order-list');

            } else {
                $this->session->set_flashdata('error', ' Order Does not deleted    successfully!');
                redirect('order-list');


            }
        }

    }

    public function totalOrderReport()
    {
        $data['option'] = $this->input->post('order_status');
        $option = $this->input->post('order_status');
        $data['order_by'] = $this->input->post('order_by');
        $optionBy = $data['order_by'];
        $data['date_to'] = date('Y-m-d', strtotime($this->input->post('date_to')));
        $date_to = date('Y-m-d', strtotime($this->input->post('date_to')));
        $data['date_from'] = date('Y-m-d', strtotime($this->input->post('date_from')));
        $date_from = date('Y-m-d', strtotime($this->input->post('date_from')));


        if ($option==1) {
            $query = "SELECT * FROM `order_data` WHERE
`order_status` !='try' and `try_status`=0 and `modified_time` >= '$date_from' and  `modified_time` <= '$date_to'
order by `order_id` DESC ";
        } elseif(empty($option)) {
            $query = "SELECT * FROM `order_data`  
WHERE   order_status !='try' and try_status=0 and `modified_time` >= '$date_from' and  `modified_time` <= '$date_to'
order by `order_id` DESC";

        } else {
            $query = "SELECT * FROM `order_data`  
WHERE  order_status !='try' and try_status=0 and  `order_status`='$option' and `modified_time` >= '$date_from' and  `modified_time` <= '$date_to'
order by `order_id` DESC";
        }

        $data['orders'] = $this->MainModel->AllQueryDalta($query);


        $data['main'] = "Orders ";
        $data['active'] = "View Order ";

        $data['pageContent'] = $this->load->view('order/orders/orders_index', $data, true);
        $this->load->view('layouts/main', $data);


    }


    public function multipleDelete()
    {
        $order = $this->input->post('order_id');
        for ($i = 0; $i < sizeof($order); $i++) {
            $result = $this->MainModel->deleteData('order_id', $order[$i], 'order');
        }

        if ($result) {

            echo('Multiple order deleted succefully');
        } else {
            echo('Multiple order does not  deleted succefully');

        }

    }


    public function orderToday()
    {

        $data = array();    //get the posts data
        $data['orders'] = $this->order->orderRows(array('limit' => $this->perPage));
        $totalRec = count($this->order->orderRows());
        //pagination configuration
        $config['target'] = '#data_list';
        $config['base_url'] = base_url() . 'order/OrderController/ajax_pagination_data';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        //$data['products']		= $this->prod->get_products(array('limit'=>$this->perPage));
        $data['orders'] = $this->order->orderRows(array('limit' => $this->perPage));


        $data['pageContent'] = $this->load->view('order/orders/orders_today', $data, true);
        $this->load->view('layouts/main', $data);


    }

    function ajax_pagination_data()
    {
        $conditions = array();

        $page = $this->input->post('page');
        $offset = (!$page) ? 0 : $page;
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');

        if (!empty($keywords)) {
            $conditions['search']['keywords'] = $keywords;
        }

        if (!empty($sortBy)) {
            $conditions['search']['sortBy'] = $sortBy;
        }

        //total rows count
        $totalRec = count($this->order->orderRows($conditions));

        //set limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

        //pagination configuration
        $config['target'] = '#data_list';
        $config['base_url'] = base_url() . 'order/OrderController/ajax_pagination_data';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $data['orders'] = $this->order->orderRows($conditions);

        $this->load->view('order/orders/orders_today', $data, false);


    }

    
    //    new code here 2019-10-02

    public function cookie_time_set()
    {
        $result = $this->MainModel->select_cookies_time();
        $data['cookies_time'] = $result->set_time;
        $data['pageContent'] = $this->load->view('order/orders/cookie_time_set', $data, true);
        $this->load->view('layouts/main', $data);
    }

    public function set_cookies_time()
    {
        $data = array(
            'set_time' => $this->input->post('set_time'),
        );
        $result = $this->MainModel->update_cookies_time($data);
        if ($result) {
            echo "Cookies successfully added";
        }
    }

    public function product_delivered_list()
    {
        $data['product_delivered'] = $this->MainModel->select_all_product_delivered_list();
        $data['pageContent'] = $this->load->view('order/orders/product_delivered_list', $data, true);
        $this->load->view('layouts/main', $data);
    }

    public function approved_product_delivered($id)
    {
        $data = array(
            'status' => 2,
            'date'=>date('Y-m-d')
        );
        $result = $this->MainModel->approved_product_delivered($data, $id);
        if ($result) {
            echo "Order completed successfully.";
        }
    }

    public function cancel_product_delivered($id)
    {
        $result = $this->MainModel->cancel_product_delivered($id);
        if ($result) {
            echo "Order cancel successfully.";
        }
    }

    public function bill_closing()
    {
        $result = $this->MainModel->select_closing_date();
        $from_date = $result->from_date;
        $to_date = $result->to_date;
        $status = $result->status;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['closing_status'] = $status;
        $data['bill_closing'] = $this->MainModel->select_all_product_completed_list($from_date, $to_date);
        $result = $this->MainModel->check_closing($from_date, $to_date, $status);
        if ($result) {
            $data['check_closing'] = $result->product_id;
        } else {
            $data['check_closing'] = 1;
        }
        $data['pageContent'] = $this->load->view('order/orders/bill_closing', $data, true);
        $this->load->view('layouts/main', $data);
    }

    public function bill_closing_confirm()
    {
        $total_fields = $this->input->post('total_num_of_fields');
        $user_id = $this->input->post('user_id');
        $product_id = $this->input->post('product_id');
        $commission = $this->input->post('commission');
        $to_date = $this->input->post('to_date');
        $closing_status = $this->input->post('closing_status');
        for ($i = 0; $i < $total_fields; $i++) {
            $data = array(
                'user_id' => $user_id[$i],
                'product_id' => $product_id[$i],
                'commission' => $commission[$i],
                'date' => $to_date[$i],
                'status' => 2,
                'closing_status' => $closing_status[$i]
            );
            $result = $this->MainModel->insertData('user_commission', $data);
        }
        if ($result) {
            echo "Bill closing successfully.";
        }
    }

    public function set_closing_date()
    {
        $result = $this->MainModel->select_closing_date();
        $data['from_date'] = $result->from_date;
        $data['to_date'] = $result->to_date;
        $data['pageContent'] = $this->load->view('order/orders/closing_date_set', $data, true);
        $this->load->view('layouts/main', $data);
    }

    public function update_closing_date()
    {
        $data = array(
            'from_date' => $this->input->post('from_date'),
            'to_date' => $this->input->post('to_date'),
            'status' => $this->input->post('status')
        );
        $result = $this->MainModel->update_closing_time($data);
        if ($result) {
            echo "Closing date successfully added";
        }
    }

    public function affiliate_request()
    {
        $data['request'] = $this->MainModel->select_affiliate_request_by_status();
        $data['pageContent'] = $this->load->view('order/orders/affiliate_request', $data, true);
        $this->load->view('layouts/main', $data);
    }

    public function approved_affiliate_request($id)
    {
        $data = array(
            'affiliate_request_status' => 2
        );
        $result = $this->MainModel->approved_affiliate_request($data, $id);
        if ($result) {
            echo "Request accept successfully.";
        }
    }

    public function cancel_affiliate_request($id)
    {
        $result = $this->MainModel->cancel_affiliate_request($id);
        if ($result) {
            echo "Request cancel successfully.";
        }
    }


    public function try_delete($orderId)
    {

        if (isset($orderId)) {
            $result = $this->MainModel->deleteData('order_id', $orderId, 'order_data');
            if ($result) {

                $this->session->set_flashdata('message', ' Try  Order deleted    successfully!');
                redirect('order/OrderController/tryorder');

            } else {
                $this->session->set_flashdata('error', ' Order Does not deleted    successfully!');
                redirect('order/OrderController/tryorder');


            }
        }

    }
    

    public function try_update()
    {

        date_default_timezone_set("Asia/Dhaka");
        $order_total = $this->input->post('order_total');
        $order_id_check= $this->input->post('order_id');

        $row_data['order_total']		=	$order_total;
        $row_data['customer_name']					=	$this->input->post('customer_name');
        $row_data['customer_phone']					=	$this->input->post('customer_phone');
        $row_data['order_status']					=	$this->input->post('order_status');

        $row_data['shipment_time']		=	date("Y-m-d H:i:s");
        $row_data['created_time']		=	date("Y-m-d H:i:s");
        $row_data['modified_time']		=	date("Y-m-d H:i:s");
        if(isset($order_id_check)) {
            $order_data = $this->MainModel->updateData('order_id', $order_id_check, 'order_data', $row_data);
            $product_name = $this->input->post('product_name');
            $product_price = $this->input->post('product_price');
            $product_color = $this->input->post('product_color');
            $product_featured_image = $this->input->post('product_image');
            $product_qty = $this->input->post('product_qnt');
            $product_size = $this->input->post('product_size');
            for ($count = 0; $count < count($product_name); $count++) {
                $row_dataa['product_name'] = $product_name[$count];
                $row_dataa['product_price'] = $product_price[$count];
                $row_dataa['product_color'] = $product_color[$count];
                $row_dataa['product_image'] = $product_featured_image[$count];
                $row_dataa['product_size'] = $product_size[$count];
                $row_dataa['product_qnt'] = $product_qty[$count];
                $row_dataa['order_id'] = $order_id_check;
                print_r($row_dataa);
                $order_data = $this->MainModel->updateData('order_id', $order_id_check, 'tryorder', $row_dataa);

            }
            $this->session->set_flashdata('message', ' Try  Order updated    successfully!');
            redirect('order/OrderController/tryorder');
        }

    }




}
