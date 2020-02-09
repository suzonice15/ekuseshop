<div class="container container-fullwidth" style="margin-bottom: 50px">
<div class="container-fluid">
		<div class="row">

			<div class="col-lg-9 col-md-9 col-12">
				<div class="subheader">
					<ul class="breadcrumb">
						<li><a href="<?=base_url()?>">Home</a>/</li>
						<li class="active" style="margin-left: 5px;"><?=$page_title?></li>
					</ul>

					<div class="page-title ">
						<h1 class="text-center"><?=$page_title?></h1>
					</div>
					<br>
				</div>
				<div>
					<ol type="circle">
						<li style="list-style: circle; ">	আপনার অর্ডারের আপডেট জানতে নিচের বক্সে অর্ডার নাম্বার অথবা আপনার মোবাইল নাম্বার দিয়ে Track order বাটনে চাপুন।</li>
						<li style="list-style: circle; " >	To get latest update about your order please enter your order number or mobile number and click on the Track order button</li>

					</ol>
				</div>

				<hr class="break break30">
				<form  action="" method="post">
					<div class="row row5">
						<div class="col-sm-6 col-md-6 col-12">
							<div class="form-group">
								<input type="text"  style="z-index: 999999999" class="form-control" name="track_id" value="<?php if(isset($_POST['track_id'])) { echo $_POST['track_id'];} ?>" placeholder="Mobile Number/ Order Number"/>
							</div>
						</div>

						<div class="col-sm-3 col-md-3 col-12">
							<div class="form-group">
								<button type="submit" style="background-color: green" name="submit" class="btn btn-success   btn-sm form-control">Track order  </button>
							</div>
						</div>
					</div>
				</form>
				<?php
				function order_status_condition($id){
					$array_value=Array(
						'new'=>'New',
						'pending_payment'=>'Pending for Payment',
						'processing'=>'On Process',
						'on_courier'=>'With Courier',
						'delivered'=>'Delivered',
						'completed'=>'Completed',
						'refund'=>'Refunded',
						'cancled'=>'Cancelled',
						'try'=>'Try'


					);
					return $array_value[$id];
				}
				$curiar='';
				if(isset($_POST['submit']) && isset($_POST['track_id']))
				{
					$track_id = $_POST['track_id'];

					if(!empty($track_id))
					{

						$orders = get_result("SELECT * FROM `order_data` WHERE `order_id`='$track_id' or `customer_phone`='$track_id' and  `order_status` !='try' order by order_id  desc limit 1");


						if(isset($orders) && sizeof($orders)>0)
						{
							$track_html='';
							$mail='';
							foreach($orders as $order) {
								//echo '<pre>'; print_r($order); echo '</pre>';

								$order_day = date('d-M-Y', strtotime($order->created_time));
								$order_status=order_status_condition($order->order_status);

								$courier_name = $order->customer_name;
								$courier_phone = $order->customer_phone;
								$courier_email = $order->customer_email;
								$customer_addressl = $order->customer_address;
								$customer_deliveryaddressl = $order->delevery_address;
								$order_note = $order->order_note;
								$shipment_time = $order->shipment_time;
								if($order->courier_service){
									$curiar='
										<td width="50%">Courier Service</td>
										<td>' . $order->courier_service . '</td>
									';
								}
								if($order->customer_email){
									$mail ='<td width="50%">Customer Email</td>
										<td>' . $courier_email . '</td>';

								}

								$track_html .= '<table class="table table-striped table-bordered">
									<tr>
										<th colspan="2"><center>Current Status</center></th>
									</tr>
									<tr>
										<td width="50%">Order Date</td>
										<td>' .$order_day. '</td>
									</tr>
									<tr>
										<td width="50%">Shipping Date</td>
										<td>' .$shipment_time. '</td>
									</tr>
									<tr>'.$curiar.'</tr>
									
										<tr>
										<td width="50%">Customer Name</td>
										<td>' . $courier_name . '</td>
									</tr>
									<tr>
										<td width="50%">Customer Phone</td>
										<td>' . $courier_phone . '</td>
									</tr>
									<tr>
										'.$mail.'
									</tr>
									<tr>
										<td width="50%">Customer Address</td>
										<td>' . $customer_addressl . '</td>
									</tr>
									<tr>
										<td width="50%">Delivery Adress</td>
										<td>' . $customer_deliveryaddressl . '</td>
									</tr>
									<tr>
										<td width="50%">Order Info</td>
										<td>' . $order_note . '</td>
									</tr>
								';

								$track_html .= '<tr>
										<td width="50%">Order Status</td>
										<td>'.$order_status.'</td>
									</tr>
									';


								$track_html .= '</tr>';
							}
							$track_html.='</table>';

							echo $track_html;

	$active=$this->session->userdata('user_status');

	if($active !='active') {

		echo '<a href="'.base_url().'affiliate/login_signup" style="width: 300px;" class="btn btn-primary btn-sm"  >Login to your account for more details</a>';
	}

						}
						else {

							echo '<h1 style="color:#d00;text-align: center">You have no ordered products</h1>';

						}
					}
					else
					{
						echo '<p style="color:#d00;">Enter Mobile  Number/ Order ID </p>';
					}
				}
				?>




			</div>


			<div class="col-lg-3 col-md-3 col-12" style="margin-left:-17px;">
				<div class="adsbox">
					<?php
					$adds = get_adds();

					if(isset($adds)>0)
					{
						$side_html='<ul>';

						foreach($adds as $add)
						{
							$link=base_url().$add->media_path;
							$side_html.='<li>
								<a href="'.$add->adds_link.'">
									<img  width="100%" class="img-fluid" src="'.$link.'">
								</a>
							</li><br/>';
						}

						$side_html.='</ul>';

						echo $side_html;
					}
					?>
				</div>
			</div>
				</div>
	</div>
</div>

<?php


?>
