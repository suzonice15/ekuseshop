<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller
{
function __construct()
{
	parent::__construct();
	$this->load->library('cart');
	$this->load->model('MainModel');

}


/*### universal delete ###*/
function delete_all_row()
{
	$row_ids = array_values(array_filter((explode(',', $this->input->get_post('row_id')))));
	$table = $this->input->post('table');
	if ($table == 'users') {
		$this->db->where_in('users.user_id', $row_ids);
	} else {
		$this->db->where_in($table . '_id', $row_ids);
	}

	$this->db->delete($table);

	die();
}

public function delete_row_by_id()
{
	$row_id = $this->input->post('row_id');
	$table = $this->input->post('table');
	if ($table == 'users') {
		$this->db->where('users.user_id', $row_id);
		echo $this->db->delete($table);
	} else {
		$this->db->where($table . '.' . $table . '_id', $row_id);
		echo $this->db->delete($table);
	}

	die();
}


/*### make order completed by ajax ###*/
public function make_order_done()
{
	$row_id = $this->input->post('row_id');
	$table = $this->input->post('table');

	$data['order_status'] = 'completed';
	$this->db->where('order.order_id', $row_id);
	echo $this->db->update('order', $data);
	die();
}


/*### add to cart ###*/
public function add_to_cart()
{
	$product_id = $this->input->post('product_id');
	$product_qty = $this->input->post('product_qty');
	$product_price = $this->input->post('product_price');
	$product_title = $this->input->post('product_title');

	$product_size = $this->input->post('product_size');
	$product_color = $this->input->post('product_color');



	$data=array(
		'id'	=>	$product_id,
		'qty'	=>	$product_qty,
		'price'	=>	$product_price,
		'name'	=>	$product_id,
		'options' => array('Size' => $product_size,'Color'=>$product_color)
	);




	$this->cart->insert($data);

	$cart_items = $cart_total = 0;
	foreach ($this->cart->contents() as $key => $val) {
		$cart_items += $val['qty'];
		$cart_total += $val['subtotal'];
	}
	$data['cart_items']=$cart_items;
	$data['cart_total']=$cart_total;


	echo json_encode($data);


}

public function remove_from_cart()
{
	$rowid = $this->input->post('rowid');

	$data = array('rowid' => $rowid, 'qty' => 0);

	$this->cart->update($data);

	$cart_items = $cart_total = 0;
	foreach ($this->cart->contents() as $key => $val) {
		$cart_items += $val['qty'];
		$cart_total += $val['subtotal'];
	}
	$html = '<table class="table table-striped table-bordered">
			<tr>
				<td colspan="3" class="cart-heading">
					<span class="itemno">' . $cart_items . '</span> ITEMS
				</td>
			</tr>';
	foreach ($this->cart->contents() as $items) {
		$featured_image = get_product_meta($items['id'], 'featured_image');
		$featured_image = get_media_path($featured_image);

		$html .= '<tr>
					<td class="total text-center">
						<a class="remove_from_cart" data-rowid="' . $items['rowid'] . '"><i class="tooltip-test font24 fa fa-remove"></i></a>
					</td>
					<td class="product-item text-center">
						<a>
							<img src="' . $featured_image . '" height="30" width="30"/>
						</a>
						<div class="item-name-and-price">
							<div class="item-name">' . get_product_title($items['id']) . '</div>
							<div class="item-price">
								TK ' . $this->cart->format_number($items['price']) . ' x ' . $items['qty'] . '
								<div class="quantity-action" data-rowid="' . $items['rowid'] . '">
									<div class="qtyplus" data-action_type="plus">+</div>
									<div class="qtyminus" data-action_type="minus">-</div>
								</div>
							</div>
						</div>
					</td>
					<td class="product-price">TK ' . $this->cart->format_number($items['subtotal']) . '</td>
				</tr>';
	}

	$html .= '<tr>
				<td colspan="3" class="cart-action">
					<div class="row row5">
						<div class="col-sm-6">
							<a href="' . base_url('checkout') . '">Place Order</a>
						</div>
						<div class="col-sm-6">
							<div class="cart-total text-right">TK ' . $this->cart->format_number($this->cart->total()) . '</div>
						</div>
					</div>
				</td>
			</tr>
		</table>';

	echo json_encode(array(
		"html" => $html,
		"current_cart_item" => $cart_items,
		"current_cart_total" => $this->cart->format_number($this->cart->total())
	));

	die();
}

public function update_to_cart()
{
	//$action_type = 'plus';//$this->input->post('action_type');
	$rowid = $this->input->post('rowid');
	$quantity = $this->input->post('quantity');

	foreach ($this->cart->contents() as $items) {
		if ($rowid == $items['rowid']) {
			//$action_qty = $items['qty'];
		}
	}



	$data = array('rowid' => $rowid, 'qty' => $quantity);
	$this->cart->update($data);

	$cart_items = $cart_total = 0;
	foreach ($this->cart->contents() as $key => $val) {
		$cart_items += $val['qty'];
		$cart_total += $val['subtotal'];
	}
	$data['total_amount']=$cart_total;
	echo json_encode($data);

}


/*### wishlist ###*/
public function add_to_wish_list()
{
	$wishlist = array();

	$product_id = $this->input->post('product_id');

	if ($this->session->userdata('wishlist')) {
		$wishlist = $this->session->userdata('wishlist');
	}

	array_push($wishlist, $product_id);

	$wishlist = array_unique($wishlist);

	$this->session->set_userdata('wishlist', $wishlist);

	echo true;
	die();
}

public function remove_wish_list()
{
	$wishlist = array();

	$product_id = $this->input->post('product_id');

	if ($this->session->userdata('wishlist')) {
		$wishlist = $this->session->userdata('wishlist');
	}

	$key = array_search($product_id, $wishlist);

	unset($wishlist[$key]);

	$wishlist = array_values($wishlist);

	$this->session->set_userdata('wishlist', $wishlist);

	if (count($wishlist) == 0) {
		echo 'empty_wishlist';
	} else {
		echo true;
	}
	die();
}


/*### remove gallery img ###*/
public function remove_gallery_img()
{
	$product_id = $this->input->post('product_id');
	$gallery_img_id = $this->input->post('gallery_img_id');

	$gallery_image = explode(",", get_product_meta($product_id, 'gallery_image'));
	if (sizeof($gallery_image) > 0) {
		$gallery_image = array_values(array_filter($gallery_image));

		if ($gallery_image[$gallery_img_id]) {
			unset($gallery_image[$gallery_img_id]);
			$gallery_image = implode(",", $gallery_image);
			update_product_meta($product_id, 'gallery_image', $gallery_image);

			echo true;
		}
	}

	die();
}


/*### review ###*/
public function add_to_review()
{
	date_default_timezone_set("Asia/Dhaka");

	$rating = $this->input->post('rating');
	$name = $this->input->post('name');
	$email = $this->input->post('email');
	$comment = $this->input->post('comment');
	$product_id = $this->input->post('product_id');

	if (!empty($rating) && !empty($name) && !empty($comment) && !empty($product_id)) {
		$review_data['rating'] = $rating;
		$review_data['name'] = $name;
		$review_data['email'] = $email;
		$review_data['comment'] = $comment;
		$review_data['product_id'] = $product_id;
		$review_data['created_time'] = date("Y-m-d H:i:s");

		$this->db->insert('review', $review_data);
		echo $this->db->insert_id();
	} else {
		echo false;
	}

	die();
}


/*### contact ###*/
public function contact_inquiry_action()
{
	date_default_timezone_set("Asia/Dhaka");

	$name = $this->input->post('name');
	$phone = $this->input->post('phone');
	$subject = $this->input->post('subject');
	$message = $this->input->post('message');

	if (!empty($name) && !empty($phone) && !empty($subject) && !empty($message)) {
		$inquiry_data['name'] = $name;
		$inquiry_data['phone'] = $phone;
		$inquiry_data['subject'] = $subject;
		$inquiry_data['message'] = $message;
		$inquiry_data['created_time'] = date("Y-m-d H:i:s");
		$inquiry_data['modified_time'] = date("Y-m-d H:i:s");

		$this->db->insert('inquiry', $inquiry_data);
		echo $this->db->insert_id();
	} else {
		echo false;
	}

	die();
}


/*### newsletter ###*/
public function newsletter()
{
	date_default_timezone_set("Asia/Dhaka");

	$newsletter_email = $this->input->post('newsletter_email');

	if (!empty($newsletter_email)) {
		$newsletter_data['newsletter_email'] = $newsletter_email;
		$newsletter_data['created_time'] = date("Y-m-d H:i:s");
		$newsletter_data['modified_time'] = date("Y-m-d H:i:s");

		$this->db->insert('newsletter', $newsletter_data);
		echo $this->db->insert_id();
	} else {
		echo false;
	}

	die();
}


/*### account ###*/
public function fblogin_process()
{
	$name = $this->input->post('name');
	$first_name = $this->input->post('first_name');
	$last_name = $this->input->post('last_name');
	$email = $this->input->post('email');
	$gender = $this->input->post('gender');
	$locale = $this->input->post('locale');
	$picture = $this->input->post('picture');
	$link = $this->input->post('link');

	$user_id = is_used_username($email);
	if (!$user_id) {
		$row_data = array();
		$row_data['user_name'] = $this->input->post('name');
		$row_data['user_email'] = $this->input->post('email');
		$row_data['user_login'] = $this->input->post('email');
		$row_data['user_pass'] = md5($this->input->post('email'));
		$row_data['user_type'] = 'customer';
		$row_data['user_status'] = 'visible';
		$row_data['registered_date'] = date('Y-m-d H:i');
		$row_data['updated_date'] = date('Y-m-d H:i');

		$this->db->insert('users', $row_data);
		$user_id = $this->db->insert_id();
	}

	if ($user_id) {
		update_user_meta($user_id, 'first_name', $first_name);
		update_user_meta($user_id, 'last_name', $last_name);
		update_user_meta($user_id, 'locale', $locale);
		update_user_meta($user_id, 'gender', $gender);
		update_user_meta($user_id, 'user_avatar', $picture);

		update_user_meta($user_id, 'user_address', '');
		update_user_meta($user_id, 'user_city', '');
		update_user_meta($user_id, 'user_state', '');
		update_user_meta($user_id, 'user_country', '');

		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_id', $user_id);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			$result = $query->result();

			$session = array();
			foreach ($result as $row) {
				$session = array(
					'user_id' => $row->user_id,
					'user_name' => $row->user_name,
					'user_phone' => $row->user_phone,
					'user_email' => $row->user_email,
					'user_login' => $row->user_login,
					'user_type' => $row->user_type,
					'user_status' => $row->user_status,
					'registered_date' => $row->registered_date,
					'updated_date' => $row->updated_date
				);

				$this->session->set_userdata('loggedin', $session);
			}
		}
	}

	echo json_encode($user_id);
	die();
}

public function update_account()
{
	$user_id = $this->input->post('user_id');

	$row_data = array();
	$data['user_name'] = $this->input->post('user_name');
	$data['user_login'] = $this->input->post('user_login');
	$data['user_phone'] = $this->input->post('user_phone');
	$data['user_email'] = $this->input->post('user_email');
	$data['updated_date'] = date('Y-m-d H:i');

	$user_address = $this->input->post('user_address');
	$user_city = $this->input->post('user_city');
	$user_state = $this->input->post('user_state');

	$this->db->where('users.user_id', $user_id);
	if ($this->db->update('users', $data)) {
		update_user_meta($user_id, 'user_address', $user_address);
		update_user_meta($user_id, 'user_city', $user_city);
		update_user_meta($user_id, 'user_state', $user_state);

		$userdata = $this->session->userdata('loggedin');
		$user_type = $userdata['user_type'];
		$user_status = $userdata['user_status'];
		$registered_date = $userdata['registered_date'];
		$updated_date = $userdata['updated_date'];

		$session = array(
			'user_id' => $user_id,
			'user_name' => $data['user_name'],
			'user_login' => $data['user_login'],
			'user_email' => $data['user_email'],
			'user_phone' => $data['user_phone'],
			'user_type' => $user_type,
			'user_status' => $user_status,
			'registered_date' => $registered_date,
			'updated_date' => $updated_date
		);
		$this->session->set_userdata('loggedin', $session);
	}

	echo true;
	die();
}


/*### change customer password ###*/
public function changepw()
{
	date_default_timezone_set("Asia/Dhaka");

	$user_id = $this->input->post('user_id');
	$old_pass = $this->input->post('old_pass');
	$user_pass = $this->input->post('user_pass');
	$updated_date = date("Y-m-d H:i:s");

	if (!empty($user_id) && !empty($old_pass) && !empty($user_pass)) {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_id', $user_id);
		$this->db->where('user_pass', md5($old_pass));
		$query = $this->db->get();
		$num_rows = $query->num_rows();

		if ($num_rows > 0) {
			$data['user_pass'] = md5($user_pass);
			$data['updated_date'] = $updated_date;
			$this->db->where('users.user_id', $user_id);
			if ($this->db->update('users', $data)) {
				$this->session->unset_userdata('loggedin');
				session_destroy();
				echo true;
			} else {
				echo false;
			}
		} else {
			echo false;
		}
	} else {
		echo false;
	}

	die();
}


public function scroll_pagination_product()
{

	$output = '<div class="row">';
	$category_id = $this->input->post('category_id');
	$limit = $this->input->post('limit');
	$start = $this->input->post('start');
	$products = $this->CategoryModel->scroll_pagination_product($category_id, $start, $limit);


	if (count($products) > 0) {
		$i = 1;
		foreach ($products as $product) {

			//$product_link = base_url($product->product_name);
			$product_link = base_url().'product/'.$product->product_name;

			$product_availability = NULL;
			$stock_qty = intval(get_product_meta($product->product_id, 'stock_qty'));
			if (!$stock_qty) {
				$product_availability = '<div class="availability">Out of Stock</div>';
			}

			$discount = false;


			$product_price = $sell_price = $product->product_price;

			$sku = $product->sku;
			$product_discount = $product->discount_price;
			$discount_type = $product->discount_type;


			if ($product_discount != 0) {
				$discount = true;

				$product_discount = $save_money = floatval($product_discount);

				if ($discount_type == 'fixed') {
					$sell_price = ($product_price - $product_discount);
				} elseif ($discount_type == 'percent') {
					$save_money = ($product_discount / 100) * $product_price;
					$sell_price = floatval($product_price - $save_money);
				}
			}

			$featured_image = get_product_meta($product->product_id, 'featured_image');
			$featured_image = get_media_path($featured_image, 'thumb');


			$output .= '<div class="col-md-2 col-lg-2 border col-6 col-sm-3">
				<a  style="padding: 0px;height: 180px;overflow: hidden;" class="img-hover col-sm-12 padding-zero" href="' . $product_link . '"   >
					<img class="img-fluid pt-3   w-100" style="margin: 0 auto;padding:5px" src="' . $featured_image . '" alt="' . $product->product_title . '"/>
				</a>
				<div class="text-danger text-center  font-weight-bold">
					<del>' . formatted_price($product_price) . '</del>
				
			<span class="text-success">' . formatted_price($sell_price) . '
				
				</div>
				<h6 class="text-center">
					<a class="text-decoration-none	" href="' . $product_link. '">' . $product->product_title . '
					</a>
				</h6>
			</div>';


		}
		$output .= '</div>';

		echo $output;


	}


}



public  function  scroll_home_product(){

	$output = '<div class="row">';
	//$category_id = $this->input->post('category_id');
	$limit = $this->input->post('limit');
	$start = $this->input->post('start');
	$home = 'home';
	$home_products = $this->CategoryModel->scroll_home_product( $start, $limit,$home);


	foreach ($home_products as $rel_prod) {
		/*# product price and discount #*/
		$rel_prod_discount = false;

		$rel_product_price = $rel_sell_price = $rel_prod->product_price;

		$product_discount = $rel_prod->discount_price;
		$discount_type = $rel_prod->discount_type;
		$discount_price_product='';
		if ($product_discount > 0) {
			$rel_prod_discount = true;

			$product_discount = $save_money = floatval($product_discount);

			if ($discount_type == 'fixed') {
				$rel_sell_price = ($rel_product_price - $product_discount);
			} elseif ($discount_type == 'percent') {
				$save_money = ($product_discount / 100) * $rel_product_price;
				$rel_sell_price = floatval($rel_product_price - $save_money);
			}
			$taka='<span class="font-weight-bold">৳</span>';
			$discount_price_product='<del>'.formatted_price($rel_product_price).'</del>';

		}
		$_product_title = strip_tags($rel_prod->product_title);
		$image = get_product_thumb($rel_prod->product_id, 'thumb');


		$link=base_url().'product/'.$rel_prod->product_name;

		$output .='<div class="border col-md-2 col-6">
		<a class="text-decoration-none	" href="'.$link .'">	
			<img class="img-fluid pt-3 zoomEffect"
				 src="'.$image.'"
				 title="Button Video Camera" alt="Button Video Camera"
				 data-src="http://www.kalerhaat.com/uploads/PicsArt_08-07-10.02.40.jpg">
		</a><div class="text-danger text-center">
			'.$discount_price_product.' <span class="text-success">'.formatted_price($rel_sell_price).'
				</span>
		</div>
		
		<div class="text-center">
			<a class="text-decoration-none	" href="'.$link .'">
				'.$_product_title.'
			</a>
		</div></div>';

	}
	$output .='</div>';
	echo $output;

die();
}

public  function  product_filter(){



	$category_id = $this->input->post('category_id');
	//$per_page = $this->input->post('per_page');
	$sorting = $this->input->post('sorting');
	//$start = $this->input->post('page');
	$this->load->library('pagination');
	$config = array();
	$config['base_url'] = '#';
	$config['total_rows'] = $this->MainModel->cageory_product_rows($category_id);
	$total_rows=$this->MainModel->cageory_product_rows($category_id);
	$config['per_page'] = 200;
	$config['uri_segment'] = 3;
	$config['use_page_numbers'] = TRUE;
	$config['full_tag_open'] = '<ul class="pagination">';
	$config['full_tag_close'] = '</ul>';
	$config['first_tag_open'] = '<li class="page-item" >';
	$config['first_tag_close'] = '</li>';
	$config['last_tag_open'] = '<li class="page-item" >';
	$config['last_tag_close'] = '</li>';
	$config['next_link'] = 'Next';
	$config['next_tag_open'] = '<li class="page-item">';
	$config['next_tag_close'] = '</li>';
	$config['prev_link'] = 'Previous';
	$config['prev_tag_open'] = '<li class="page-item">';
	$config['prev_tag_close'] = '</li>';
	$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
	$config['cur_tag_close'] = '</a></li>';
	$config['num_tag_open'] = '<li class="page-item">';
	$config['num_tag_close'] = '</li>';
	$config['num_links'] = 3;
	$this->pagination->initialize($config);
	$page = $this->uri->segment(3);
	$start = ($page - 1) * $config['per_page'];
	$output = array(
		'pagination_link'  => $this->pagination->create_links(),
		'product_list'   => $this->MainModel->fetch_data($config["per_page"], $start,$category_id,$sorting),
		'total'=>$total_rows
	);
	echo json_encode($output);
}

	public function tryOrder()
	{

		date_default_timezone_set("Asia/Dhaka");
		$order_total = $this->input->post('order_total');
		$products = $this->input->post('products');
		$order_id_check= $this->input->post('order_id');
		$row_data						=	array();
		$row_data['order_total']		=	$order_total;
		$row_data['customer_name']					=	$this->input->post('billing_name');
		$row_data['customer_phone']					=	$this->input->post('billing_phone');

		$row_data['shipment_time']		=	date("Y-m-d H:i:s");
		$row_data['created_time']		=	date("Y-m-d H:i:s");
		$row_data['modified_time']		=	date("Y-m-d H:i:s");
		$row_data['order_status']		=	'try';
		$row_data['try_status']		=	1;
		if(empty($order_id_check)) {
			$this->db->insert('order_data', $row_data);
			$order_id = $this->db->insert_id();
			$product_name = $this->input->post('product_name');
			$product_price = $this->input->post('product_price');
			$product_color = $this->input->post('product_color');
			$product_featured_image = $this->input->post('product_featured_image');
			$product_qty = $this->input->post('product_qty');
			$product_size = $this->input->post('product_size');
			for ($count = 0; $count < count($product_name); $count++) {
				$row_dataa['product_name'] = $product_name[$count];
				$row_dataa['product_price'] = $product_price[$count];
				$row_dataa['product_color'] = $product_color[$count];
				$row_dataa['product_image'] = $product_featured_image[$count];
				$row_dataa['product_size'] = $product_size[$count];
				$row_dataa['product_qnt'] = $product_qty[$count];
				$row_dataa['order_id'] = $order_id;
				$this->db->insert('tryorder', $row_dataa);
			}
			echo $order_id;
		}  else {
			echo $order_id_check;
		}


	}
	
	public function all_product(){
		$sql = "SELECT * FROM `product` ORDER BY `product`.`modified_time` DESC ";
		$data['products'] = get_result($sql);
		$this->load->view('website/all_product_ajax_load',$data);
	}
	public function home_cat_content(){
		$this->load->view('website/home_category_ajax_load');

	}
	
	public  function  top_category_ajax_product(){
		$this->load->view('website/top_category_this_week_ajax_load');


	}


	public function scroll_related_product(){


		$this->load->model("CategoryModel");
		$category_id = $this->input->post('category_id');
		$limit = $this->input->post('limit');
		$start = $this->input->post('start');
		$data['related_products'] = $this->CategoryModel->scroll_related_product($category_id, $start, $limit);
		$this->load->view('website/scroll_related_product_view_page',$data);

	}




}
