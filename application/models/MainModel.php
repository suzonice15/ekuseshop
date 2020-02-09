<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MainModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function add_new_media($data)
    {
        $this->db->insert('media', $data);
        return $this->db->insert_id();
    }

    public function try_view($order_id)
    {
        $this->db->select('*');
        $this->db->from('order_data');
        $this->db->join('tryorder', 'tryorder.order_id = order_data.order_id');
        $this->db->where('order_data.order_id', $order_id);
        $result = $this->db->get();
        return $result->result();
    }

    public function getAllData($condition = '', $tableName = '', $selectQuery = '', $order = '')
    {
        $this->db->select($selectQuery);
        if ($condition): $this->db->where($condition);
        endif;
        if ($order):$this->db->order_by($order);
        endif;
        return $this->db->get($tableName)->result();

    }

    public function getSingleData($field, $condition, $tableName, $selectQuery)
    {
        $this->db->select($selectQuery);
        $this->db->where($field, $condition);
        return $this->db->get($tableName)->row();

    }

    public function allDataById($field, $condition, $tableName, $selectQuery)
    {
        $this->db->select($selectQuery);
        $this->db->where($field, $condition);
        return $this->db->get($tableName)->result();

    }

    public function getSingleDataArrayType($field, $condition, $tableName, $selectQuery)
    {
        $this->db->select($selectQuery);
        $this->db->where($field, $condition);
        return $this->db->get($tableName)->row_array();

    }

    public function getDataRow($field, $condition, $tableName, $selectQuery)
    {
        $this->db->select($selectQuery);
        $this->db->where($field, $condition);
        return $this->db->get($tableName)->num_rows();

    }

    function insertData($tableName, $data)
    {
        return $this->db->insert($tableName, $data);
    }

    function deleteData($field, $condition, $tableName)
    {
        $this->db->where($field, $condition);
        return $this->db->delete($tableName);
    }

    function AllQueryDalta($query)
    {
        return $this->db->query($query)->result();
    }

    function SingleQueryData($query)
    {
        return $this->db->query($query)->row();
    }

    function QuerySingleData($query)
    {
        return $this->db->query($query)->row();
    }


    function QuerySingleDataDelete($query)
    {
        $this->db->query($query)->result();
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {

            return false;
        }
    }

    function updateData($field, $condition, $tableName, $data)
    {

        $this->db->where($field, $condition);
        $result = $this->db->update($tableName, $data);
        if ($result) {

            return true;
        } else {

            return false;
        }
    }

    function loginCheck($email, $password)
    {
        $this->db->select('*');
        $this->db->where(array('user_email' => $email, 'user_password' => $password));
        return $this->db->get('users')->row();
    }

    function returnInsertId($tableName, $data)
    {
        $this->db->insert($tableName, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function updateDataReturnInsertId($field, $condition, $tableName, $data)
    {

        $this->db->where($field, $condition);
        $this->db->update($tableName, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;

    }

    function visitorCount($ip, $date)
    {
        $this->db->where('client_ip', $ip);
        $this->db->where('date', $date);
        $insert_id = $this->db->get('hitcounter')->row();
        return $insert_id;
    }

    function countByLikeCondition($field_name, $cond, $tableName)
    {
        $this->db->like($field_name, $cond, 'after');
        return $this->db->count_all_results($tableName);
    }

    function countAll($tableName)
    {
        return $this->db->count_all($tableName);
    }

    public function select_all_data_by_name($limit, $start, $fieldName, $field_title, $tableName, $orderBy)
    {
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->like($fieldName, $field_title, 'both');
        $this->db->order_by($orderBy);
        $query_result = $this->db->get($tableName);
        $result = $query_result->result();
        return $result;
    }

    public function select_all_data_by_limit($limit, $start, $tableName, $orderBy)
    {
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->order_by($orderBy);
        $query_result = $this->db->get($tableName);
        $result = $query_result->result();
        return $result;
    }

    public function cageory_product_rows($category_id)
    {
        $this->db->select('product.product_id');
        $this->db->join('term_relation', 'product.product_id = term_relation.product_id');
        $this->db->where('term_relation.term_id', $category_id);
        $data = $this->db->get('product');
        return $data->num_rows();

    }

    public function fetch_data($per_page, $start, $category_id, $sorting)
    {

        $this->db->select('DISTINCT(product.product_id),product_title,product_price,discount_price,product_name');
        $this->db->join('term_relation', 'product.product_id = term_relation.product_id');
        $this->db->where('term_relation.term_id', $category_id);
        if ($sorting == 'name_asc') {
            $this->db->order_by("product.product_title", 'ASC');

        } elseif ($sorting == 'name_desc') {
            $this->db->order_by("product.product_title", 'DESC');

        } elseif ($sorting == 'price_asc') {
            $this->db->order_by("product.product_price", 'ASC');

        } elseif ($sorting == 'price_desc') {
            $this->db->order_by("product.product_price", 'DESC');

        } else {
            $this->db->order_by("product.product_price", 'ASC');

        }

        $this->db->limit($per_page, $start);
        $data = $this->db->get('product');
        $output = '<div class="row"><div class="row no-gutters product-block-category">';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {

                $featured_image = get_product_meta($row->product_id, 'featured_image');
                $featured_image = get_media_path($featured_image, 'thumb');

                $discount = false;

                $product_price = $sell_price = $row->product_price;

                $product_discount = $row->discount_price;
                $discount_type = $row->discount_type;

                if ($product_discount != 0) {
                    $discount = '';

                    $product_discount = $save_money = floatval($product_discount);

                    $product_discount_price = floatval($product_discount);
                    $sell_price = $product_discount_price;

                }
                $less_money = '';

                if ($product_price > $sell_price) {
                    $less_money = formatted_price($product_price);

                }
                $product_title = $row->product_title;
                $link = base_url() . 'product/' . $row->product_name;
                $total_review_id = 0;
                $total_review_id = get_total_review($row->product_id);


                $output .= '<div class="col-md-6 col-lg-3  col-sm-12 col-12">
                                        <div class="xs-product-wraper version-2">
                                            <div class="xs-product-header media">
                        <span class="star-rating d-flex" style="margin-top: -29px;">
                            <span class="value">(' . $total_review_id . ')</span>
                        </span>

						</div>
						<a href="' . $link . '"><img src="' . $featured_image . '" alt="' . $product_title . '" width="100%"></a>
						<div class="xs-product-content text-center">
                        <span class="product-categories">
                          
                        </span>
							<h4 class="product-title"><a href="' . $link . '">' . $product_title . '</a></h4>
							<span  style="color:#00B050" class="price">
                            ' . formatted_price($sell_price) . '
                            <del style="color:red">' . $less_money . '</del>
                        </span>
						</div><!-- .xs-product-content END -->
						<div class="xs-product-hover-area clearfix col-12">
													<div  style="margin-left: 123px;" >
														<a href="#" class="btn btn-primary btn-sm  add_to_cart"
														   data-product_id="' . $row->product_id . '" data-product_price="' . $sell_price . '"
														   data-product_title="' . $row->product_title . '" ><i class="icon icon-online-shopping-cart"></i>Add to Cart</a>
													</div>
													<div >
														<a href="#" class="btn btn-info btn-sm buy_now"
														   data-product_id="' . $row->product_id . '" data-product_price="' . $sell_price . '"
														   data-product_title="' . $row->product_title . '"><i class="icon icon-bag"></i>Buy Now</a>
													</div>
												</div>
					</div>
				</div> ';
            }
            $output .= '</div></div>';
        } else {
            $output = '<h3></h3>';
        }
        return $output;


    }

    public function select_all_data()
    {
        $this->db->select('*');
        $query_result = $this->db->get('product_link');
        $result = $query_result->result();
        return $result;
    }

    public function select_all_category()
    {
        $this->db->select('category_id,category_title');
        $query_result = $this->db->get('category');
        $result = $query_result->result();
        return $result;
    }

    public function select_link_by_id($id)
    {
        $this->db->select('product_name');
        $this->db->where('product_id', $id);
        $query_result = $this->db->get('product');
        $result = $query_result->result();
        return $result;
    }

    public function select_all_product_by_id($id)
    {
        $this->db->select('product.product_id,product_title,product_name,product_price,discount_price');
        $this->db->where('term_id', $id);
        $this->db->join('term_relation', 'term_relation.product_id = product.product_id');
        $this->db->join('category', 'category.category_id = term_relation.term_id');
        $query_result = $this->db->get('product');
        $result = $query_result->result();
        return $result;
    }

    public function select_product_id($product_name)
    {
        $this->db->select('product_id');
        $this->db->where('product_name', $product_name);
        $query_result = $this->db->get('product');
        $result = $query_result->row();
        return $result;
    }

    public function select_my_all_link($user_id)
    {
        $this->db->select('*');
        $this->db->where('user_id', $user_id);
        $query_result = $this->db->get('product_link_info');
        $result = $query_result->result();
        return $result;
    }

    public function count_hit_by_user_id($product_id, $user_id)
    {
        $this->db->select('count(id) total_count');
        $this->db->where('product_id', $product_id);
        $this->db->where('user_id', $user_id);
        $query_result = $this->db->get('product_hit_count');
        $result = $query_result->row();
        return $result;
    }

    public function check_cookies_data($get_cookies)
    {
        $this->db->select('user_id');
        $this->db->where('unique_number', $get_cookies);
        $query_result = $this->db->get('product_hit_count');
        $result = $query_result->row();
        return $result;
    }

    public function count_order($product_id, $user_id)
    {
        $this->db->select('count(order_id) total_order');
        $this->db->where('product_id', $product_id);
        $this->db->where('user_id', $user_id);
        $query_result = $this->db->get('user_order_count');
        $result = $query_result->row();
        return $result;
    }

    public function count_buy($product_id, $user_id)
    {
        $this->db->select('count(user_order_count.order_id) total_buy');
        $this->db->where('user_order_count.product_id', $product_id);
        $this->db->where('user_order_count.user_id', $user_id);
        $this->db->join('order_data', 'order_data.order_id = user_order_count.order_id');
        $this->db->where('order_data.order_status', "delivered");
        $query_result = $this->db->get('user_order_count');
        $result = $query_result->row();
        return $result;
    }



    public function count_total_request_commission($user_id)
    {
        $this->db->select('sum(commission_amount) total_commission_request');
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 1);
        $query_result = $this->db->get('user_commission_request');
        $result = $query_result->row();
        return $result;
    }

    public function count_total_paid_commission($user_id)
    {
        $this->db->select('sum(commission_amount) total_commission_request');
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 0);
        $query_result = $this->db->get('user_commission_request');
        $result = $query_result->row();
        return $result;
    }

    public function select_all_request($user_id)
    {
        $this->db->select('*');
        $this->db->where('user_id', $user_id);
        $query_result = $this->db->get('user_commission_request');
        $result = $query_result->result();
        return $result;
    }

    public function select_all_paid_request($user_id)
    {
        $this->db->select('user_commission_request.*,affiliate_users.user_f_name,affiliate_users.user_l_name');
        $this->db->where('user_commission_request.user_id', $user_id);
        $this->db->where('user_commission_request.status', 0);
        $this->db->join('affiliate_users', 'affiliate_users.user_id = user_commission_request.user_id');
        $query_result = $this->db->get('user_commission_request');
        $result = $query_result->result();
        return $result;
    }

    public function count_total_commission_by_product($user_id, $product_id)
    {
        $this->db->select('commission');
        $this->db->where('user_id', $user_id);
        $this->db->where('product_id', $product_id);
        $query_result = $this->db->get('user_commission');
        $result = $query_result->row();
        return $result;
    }

    public function select_all_request_for_admin()
    {
        $this->db->select('user_commission_request.*,affiliate_users.user_f_name,affiliate_users.user_l_name');
        $this->db->join('affiliate_users', 'affiliate_users.user_id = user_commission_request.user_id');
        $query_result = $this->db->get('user_commission_request');
        $result = $query_result->result();
        return $result;
    }

    public function update_payment($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('user_commission_request', $data);
    }

    public function select_cookies_time()
    {
        $this->db->select('*');
        $query_result = $this->db->get('set_cookies_time');
        $result = $query_result->row();
        return $result;
    }

    public function select_product_id_by_order_id($order_id)
    {

        $this->db->select('product.product_id,user_order_count.user_id,product.product_price,product.discount_price');
        $this->db->where('user_order_count.order_id',$order_id);
        $this->db->join('product','product.product_id=user_order_count.product_id');
        $query_result = $this->db->get('user_order_count');
        $result = $query_result->result();
        return $result;
    }

    //    new code 2019-10-02
    public function count_total_commission($user_id)
    {
        $this->db->select('sum(commission) total_commission');
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 2);
        $query_result = $this->db->get('user_commission');
        $result = $query_result->row();
        return $result;
    }

    public function count_total_commission_without_completed($user_id)
    {
        $this->db->select('sum(commission) total_commission');
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 1);
        $query_result = $this->db->get('user_commission');
        $result = $query_result->row();
        return $result;
    }

    public function select_all_product_delivered_list()
    {
        $this->db->select('user_commission.*,affiliate_users.user_f_name,affiliate_users.user_l_name');
        $this->db->where('user_commission.status', 1);
        $this->db->join('affiliate_users', 'affiliate_users.user_id = user_commission.user_id');
        $query_result = $this->db->get('user_commission');
        $result = $query_result->result();
        return $result;
    }

    public function approved_product_delivered($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('user_commission', $data);
    }

    public function cancel_product_delivered($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('user_commission');
    }

    public function select_all_product_completed_list($from_date, $to_date)
    {
        $this->db->select('sum(user_commission.commission) current_amount,user_commission.user_id,affiliate_users.user_f_name,affiliate_users.user_l_name');
        $this->db->where('user_commission.status', 2);
        $this->db->where('user_commission.closing_status', 0);
        $this->db->where('date >=', $from_date);
        $this->db->where('date <=', $to_date);
        $this->db->join('affiliate_users', 'affiliate_users.user_id = user_commission.user_id');
        $this->db->group_by('user_commission.user_id');
        $query_result = $this->db->get('user_commission');
        $result = $query_result->result();
        return $result;
    }
    public function select_all_product_price($from_date, $to_date, $user_id)
    {
        $this->db->select('product.product_price,product.discount_price');
        $this->db->where('user_commission.status', 2);
        $this->db->where('user_commission.user_id', $user_id);
        $this->db->where('user_commission.date >=', $from_date);
        $this->db->where('user_commission.date <=', $to_date);
        $this->db->join('product', 'product.product_id = user_commission.product_id');
        $query_result = $this->db->get('user_commission');
        $result = $query_result->result();
        return $result;
    }
    public function check_closing($from_date, $to_date, $closing_status)
    {
        $this->db->select('product_id');
        $this->db->where('status', 2);
        $this->db->where('closing_status', $closing_status);
        $this->db->where('product_id', 10000000);
        $this->db->where('date >=', $from_date);
        $this->db->where('date <=', $to_date);
        $query_result = $this->db->get('user_commission');
        $result = $query_result->row();
        return $result;
    }

    public function update_cookies_time($data)
    {
        $this->db->where('id', 1);
        return $this->db->update('set_cookies_time', $data);
    }

    public function select_closing_date()
    {
        $this->db->select('*');
        $query_result = $this->db->get('set_closing_date');
        $result = $query_result->row();
        return $result;
    }
    public function update_closing_time($data){
        $this->db->where('id', 1);
        return $this->db->update('set_closing_date', $data);
    }
    public function select_affiliate_request($user_id)
    {
        $this->db->select('affiliate_request_status');
        $this->db->where('user_id', $user_id);
        $query_result = $this->db->get('affiliate_users');
        $result = $query_result->row();
        return $result;
    }

    public function select_affiliate_request_by_status()
    {
        $this->db->select('*');
        $this->db->where('affiliate_request_status', 1);
        $query_result = $this->db->get('affiliate_users');
        $result = $query_result->result();
        return $result;
    }

    public function update_status($data1, $userRole)
    {
        $this->db->where('user_id', $userRole);
        return $this->db->update('affiliate_users', $data1);
    }

    public function approved_affiliate_request($data, $id)
    {
        $this->db->where('user_id', $id);
        return $this->db->update('affiliate_users', $data);
    }

    public function cancel_affiliate_request($id)
    {
        $this->db->where('user_id', $id);
        return $this->db->delete('affiliate_users');
    }

}
	

   
