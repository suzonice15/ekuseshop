<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminajax extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('email');
	}


	/*### generate order review html ###*/
	function generate_order_review_html()
	{
		$product_ids = explode(",", $this->input->get_post('product_ids'));
		$qty = $this->input->get_post('product_quantity');
		
        $this->db->select('*');
        $this->db->from('product');
		$this->db->where_in('product_id', $product_ids);
		$query = $this->db->get();
		$products = $query->result();
		
		$html='No Products Info. Found!';
		
		if(count($products)>0)
		{
			$html='<table class="table table-striped table-bordered">
				<tr>
					<th class="name" width="5%">Product</th>
					<th class="image text-center" width="5%">Image</th>
						<th class="image text-center" width="10%">Size</th>
							<th class="image text-center" width="20%">Color</th>
					<th class="quantity text-center" width="10%">Qty</th>
					<th class="price text-center" width="10%">Price</th>
					<th class="total text-right" width="10%">Sub-Total</th>
				</tr>';
				
				foreach($products as $prod)
				{
					$sell_price = floatval(get_product_meta($prod->product_id, 'sell_price'));
					$this->db->select('product_of_size');
				    $this->db->where('product_id',$prod->product_id);
					$productSize=$this->db->get('product')->result();
					foreach($productSize as $product){
					    
					  $proSizeList=  $product->product_of_size;
					}
					$productSize_OF=explode(',',$proSizeList);
					
					$this->db->select('product_color');
				    $this->db->where('product_id',$prod->product_id);
					$productColor=$this->db->get('product')->result();
					foreach($productColor as $product_co){
					    
					  $proColorlist=  $product_co->product_color;
					}
					$productColor=explode(',',$proColorlist);
				
					$subtotal = ($sell_price * $qty);
					$totalamout[] = $subtotal;
					$featured_image = get_product_thumb($prod->product_id, 'thumb');
					
					$html.='<tr>
						<td>'.$prod->product_title.'</td>
						<td class="image text-center">
							<img src="'.$featured_image.'" height="30" width="30">
						</td>
						
								<td>
								<select name="products[items]['.$prod->product_id.'][Size]"  id="productSize" class="form-control item_Size" >';
								foreach($productSize_OF as $key=>$product_size_id_of):
							$html.='<option value="'.$product_size_id_of.'">'.$product_size_id_of.'</option>';
							
								endforeach;
								
								$html.='</select> 	</td>';
									$html.='<td>
								<select name="products[items]['.$prod->product_id.'][Color]"  id="productSize" class="form-control item_color" >';
								foreach($productColor as $key=>$productCol):
							$html.='<option value="'.$productCol.'">'.$productCol.'</option>';
								endforeach;
							$html.='</select></td>
						<td class="text-center">
							<input type="number" name="products[items]['.$prod->product_id.'][qty]" class="form-control item_qty" value="'.$qty.'" data-item-id="'.$prod->product_id.'" style="width:60px;">
						</td>
						<td class="text-center">TK '.$sell_price.'</td>
						<td class="text-right">TK '.$subtotal.'</td>
					</tr>';
					
					$html.=form_hidden('products[items]['.$prod->product_id.'][featured_image]', $featured_image);
					$html.=form_hidden('products[items]['.$prod->product_id.'][price]', $sell_price);
					$html.=form_hidden('products[items]['.$prod->product_id.'][name]', $prod->product_title);
					$html.=form_hidden('products[items]['.$prod->product_id.'][subtotal]', $subtotal);
				}
				
			$html.='</table>';

			$html.='<a class="btn btn-primary pull-right update_items">Change</a><br><br><br>';

			$order_total = array_sum($totalamout);

			$delivery_cost = get_option('shipping_charge_in_dhaka');
			$order_total = $order_total + $delivery_cost;

			$html.='<table class="table table-striped table-bordered">
				<tbody>
					<tr>
						<td>
							<span class="extra bold">Sub-Total</span>
						</td>
						<td class="text-right">
							<span class="bold">TK 
								<span id="subtotal_cost">
									'.array_sum($totalamout).'
								</span>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold">Delivery Cost</span>
						</td>
						<td class="text-right">
							<span class="bold">TK <span id="delivery_cost">'.$delivery_cost.'</span></span>
							'.form_hidden('shipping_charge', $delivery_cost).'
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold totalamout">Total</span>
						</td>
						<td class="text-right">
							<span class="bold totalamout">TK <span id="total_cost">'.$order_total.'</span></span>
							'.form_hidden('order_total', $order_total).'
							'.form_hidden('checkout_type', 'cash_on_delivery').'
						</td>
					</tr>';

				$html.='</tbody>
			</table>';
		}
		
		echo json_encode(array("html"=>$html));
		die();
	}


	/*### generate order review update html ###*/
	function generate_order_review_update_html()
	{
		$product_ids = explode(",", $this->input->get_post('product_ids'));
		$product_qtys = explode(",", $this->input->get_post('product_qtys'));
		$size = $this->input->get_post('size');

		$pqty = array_combine($product_ids, $product_qtys);
		
        $this->db->select('*');
        $this->db->from('product');
		$this->db->where_in('product_id', $product_ids);
		$query = $this->db->get();
		$products = $query->result();
		
		$html='No Products Info. Found!';
		
		if(count($products)>0)
		{
			$html='<table class="table table-striped table-bordered">
				<tr>
					<th class="name" width="5%">Product</th>
					<th class="image text-center" width="5%">Image</th>
						<th class="image text-center" width="10%">Size</th>
							<th class="image text-center" width="20%">Color</th>
					<th class="quantity text-center" width="10%">Qty</th>
					<th class="price text-center" width="10%">Price</th>
					<th class="total text-right" width="10%">Sub-Total</th>
				</tr>';
				
				foreach($products as $prod)
				{
					$qty = $pqty[$prod->product_id];
						$this->db->select('product_of_size');
				    $this->db->where('product_id',$prod->product_id);
					$productSize=$this->db->get('product')->result();
					foreach($productSize as $product){
					    
					  $proSizeList=  $product->product_of_size;
					}
					$productSize_OF=explode(',',$proSizeList);
					
					$this->db->select('product_color');
				    $this->db->where('product_id',$prod->product_id);
					$productColor=$this->db->get('product')->result();
					foreach($productColor as $product_co){
					    
					  $proColorlist=  $product_co->product_color;
					}
					$productColor=explode(',',$proColorlist);

					$sell_price = floatval(get_product_meta($prod->product_id, 'sell_price'));
					$subtotal = ($sell_price * $qty);
					$totalamout[] = $subtotal;
					
					$featured_image = get_product_thumb($prod->product_id, 'thumb');
					
					$html.='<tr>
						<td>'.$prod->product_title.'</td>
						<td class="image text-center">
							<img src="'.$featured_image.'" height="30" width="30">
						</td>
							<td>
								<select name="products[items]['.$prod->product_id.'][Size]"  id="productSize" class="form-control item_Size" >';
								foreach($productSize_OF as $key=>$product_size_id_of):
							$html.='<option value="'.$product_size_id_of.'">'.$product_size_id_of.'</option>';
							
								endforeach;
								
								$html.='</select> 	</td>';
								
									$html.='<td>
								<select name="products[items]['.$prod->product_id.'][Color]"  id="productSize" class="form-control item_color" >';
								foreach($productColor as $key=>$productCol):
							$html.='<option value="'.$productCol.'">'.$productCol.'</option>';
								endforeach;
							$html.='</select></td>
						<td class="text-center">
							<input type="number" name="products[items]['.$prod->product_id.'][qty]" class="form-control item_qty" value="'.$qty.'" data-item-id="'.$prod->product_id.'" style="width:60px;">
						</td>
						<td class="text-center">TK '.$sell_price.'</td>
						<td class="text-right">TK '.$subtotal.'</td>
					</tr>';
					
					$html.=form_hidden('products[items]['.$prod->product_id.'][featured_image]', $featured_image);
					//$html.=form_hidden('products[items]['.$prod->product_id.'][qty]', $qty);
					$html.=form_hidden('products[items]['.$prod->product_id.'][price]', $sell_price);
					$html.=form_hidden('products[items]['.$prod->product_id.'][name]', $prod->product_title);
					$html.=form_hidden('products[items]['.$prod->product_id.'][subtotal]', $subtotal);
				}
				
			$html.='</table>';

			$html.='<a class="btn btn-primary pull-right update_items">Change</a><br><br><br>';

			$order_total = array_sum($totalamout);

			$delivery_cost = get_option('shipping_charge_in_dhaka');
			$order_total = $order_total + $delivery_cost;

			$html.='<table class="table table-striped table-bordered">
				<tbody>
					<tr>
						<td>
							<span class="extra bold">Sub-Total</span>
						</td>
						<td class="text-right">
							<span class="bold">TK 
								<span id="subtotal_cost">
									'.array_sum($totalamout).'
								</span>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold">Delivery Cost</span>
						</td>
						<td class="text-right">
							<span class="bold">TK <span id="delivery_cost">'.$delivery_cost.'</span></span>
							'.form_hidden('shipping_charge', $delivery_cost).'
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold totalamout">Total</span>
						</td>
						<td class="text-right">
							<span class="bold totalamout">TK <span id="total_cost">'.$order_total.'</span></span>
							'.form_hidden('order_total', $order_total).'
							'.form_hidden('checkout_type', 'cash_on_delivery').'
						</td>
					</tr>
				</tbody>
			</table>';
		}
		
		echo json_encode(array("html"=>$html));
		die();
	}


	/*### generate order review update html by service cost ###*/
	function generate_order_review_update_html_by_cost()
	{
		$product_ids = explode(",", $this->input->get_post('product_ids'));
		$product_qtys = explode(",", $this->input->get_post('product_qtys'));

		$service_cost = $this->input->get_post('service_cost');
		$discount = $this->input->get_post('discount');

		$pqty = array_combine($product_ids, $product_qtys);
		
        $this->db->select('*');
        $this->db->from('product');
		$this->db->where_in('product_id', $product_ids);
		$query = $this->db->get();
		$products = $query->result();
		
		$html='No Products Info. Found!';
		
		if(count($products)>0)
		{
			$html='<table class="table table-striped table-bordered">
				<tr>
					<th class="name" width="30%">Product</th>
					<th class="image text-center" width="30">Image</th>
					<th class="quantity text-center" width="100">Qty</th>
					<th class="price text-center" width="100">Price</th>
					<th class="total text-right" width="120">Sub-Total</th>
				</tr>';
				
				foreach($products as $prod)
				{
					$qty = $pqty[$prod->product_id];

					$sell_price = floatval(get_product_meta($prod->product_id, 'sell_price'));
					$subtotal = ($sell_price * $qty);
					$totalamout[] = $subtotal;
					
					$featured_image = get_product_thumb($prod->product_id, 'thumb');
					
					$html.='<tr>
						<td>'.$prod->product_title.'</td>
						<td class="image text-center">
							<img src="'.$featured_image.'" height="30" width="30">
						</td>
						<td class="text-center">
							<input type="number" name="products[items]['.$prod->product_id.'][qty]" class="form-control item_qty" value="'.$qty.'" data-item-id="'.$prod->product_id.'" style="width:60px;">
						</td>
						<td class="text-center">TK '.$sell_price.'</td>
						<td class="text-right">TK '.$subtotal.'</td>
					</tr>';
					
					$html.=form_hidden('products[items]['.$prod->product_id.'][featured_image]', $featured_image);
					//$html.=form_hidden('products[items]['.$prod->product_id.'][qty]', $qty);
					$html.=form_hidden('products[items]['.$prod->product_id.'][price]', $sell_price);
					$html.=form_hidden('products[items]['.$prod->product_id.'][name]', $prod->product_title);
					$html.=form_hidden('products[items]['.$prod->product_id.'][subtotal]', $subtotal);
				}
				
			$html.='</table>';

			$html.='<a class="btn btn-primary pull-right update_items">Change</a><br><br><br>';

			$order_total = array_sum($totalamout);

			$delivery_cost = get_option('shipping_charge_in_dhaka');
			$order_total = $order_total + $delivery_cost + $service_cost - $discount;

			$html.='<table class="table table-striped table-bordered">
				<tbody>
					<tr>
						<td>
							<span class="extra bold">Sub-Total</span>
						</td>
						<td class="text-right">
							<span class="bold">TK 
								<span id="subtotal_cost">
									'.array_sum($totalamout).'
								</span>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold">Delivery Cost</span>
						</td>
						<td class="text-right">
							<span class="bold">TK <span id="delivery_cost">'.$delivery_cost.'</span></span>
							'.form_hidden('shipping_charge', $delivery_cost).'
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold service_cost" data-service_cost="'.$service_cost.'">Service Cost</span>
						</td>
						<td class="text-right">
							<span class="bold">TK <span id="service_cost">'.$service_cost.'</span></span>
							'.form_hidden('service_cost', $service_cost).'
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold discount" data-discount="'.$discount.'">Discount</span>
						</td>
						<td class="text-right">
							<span class="bold">TK <span id="discount">'.$discount.'</span></span>
							'.form_hidden('discount', $discount).'
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold totalamout">Total</span>
						</td>
						<td class="text-right">
							<span class="bold totalamout">TK <span id="total_cost">'.$order_total.'</span></span>
							'.form_hidden('order_total', $order_total).'
							'.form_hidden('checkout_type', 'cash_on_delivery').'
						</td>
					</tr>
				</tbody>
			</table>';
		}
		
		echo json_encode(array("html"=>$html));
		die();
	}


	/*### send order mail to courier ###*/
	function send_order_mail_to_courier()
	{
		$row_ids = explode(",", $this->input->get_post('row_ids'));
		
        $this->db->select('*');
        $this->db->from('order');
		$this->db->where_in('order_id', $row_ids);
		$query = $this->db->get();
		$orders = $query->result();

		foreach($orders as $order);
		$courier_email = get_order_meta($order->order_id, 'courier_email');
		$site_title = get_option('site_title');
		$site_email = get_option('email');
		
		$config['protocol'] = 'sendmail';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);

		$this->email->from($site_email, $site_title);
		$this->email->to($courier_email);
		$this->email->subject('Shipment Orders');
		
		ob_start();
		include('applications/views/emails/email-header.php');
		include('applications/views/emails/order-mail-to-courier.php');
		include('applications/views/emails/email-footer.php');
		$email_body = ob_get_clean();
		
		//echo $email_body;
		$this->email->message($email_body); 

		$return = FALSE;
		if($this->email->send())
		{
			$return = TRUE;
		}
		
		echo json_encode(array("return"=>$return));
		die();
	}


	/*### order area based courier service option ###*/
	function order_area_based_courier_service_option()
	{
		$order_area = $this->input->get_post('order_area');

		$couriers = unserialize(get_option('courier'));
		//echo '<pre>'; print_r($couriers); echo '</pre>';

		$html='No Courier Found!';
		
		if($couriers)
		{
			$courier_option=array();

			foreach($couriers as $index=>$courier)
			{
				if($order_area==$courier['type'])
				{
					$courier_option[$courier['courier']] = $courier['courier'];
				}
			}

			$html = form_dropdown('courier_service', $courier_option, '', array('class'=>'form-control', 'id'=>'courier_service'));
		}
		
		echo json_encode(array("html"=>$html));
		die();
	}
}
