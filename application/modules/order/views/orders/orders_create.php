
<div class="col-md-offset-0 col-md-12">
<div class="box box-success ">
	<div class="box-header with-border">
		<h3 class="box-title"><?php if (isset($title)) echo $title ?></h3>
	</div>
	<?php echo validation_errors(); ?>
        <div class="box-body">
			<form method="POST" id="checkout" action="<?=base_url()?>order-create" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-5">
						<div class="box box-danger" style="border:2px solid #ddd">
							<div class="box-header" style="background-color: #ddd">
								<h3 class="box-title">Customer Informations</h3>
							</div>
							<div class="box-body">
								<div class="form-group ">
									<label for="billing_name">Name<span class="required">*</span></label>
									<input name="customer_name"  type="text" class="form-control"  id="billing_name" value="" />

								</div>
								<div class="form-group ">
									<label for="billing_email">Email</label>
									<input name="customer_email"  type="email" class="form-control"  id="user_email" value="" />
									<span id="user_email_error" style="color:red"></span>

								</div>
								<div class="form-group ">
									<label for="billing_phone">Phone<span class="required">*</span></label>
									<input name="customer_phone"  type="text" class="form-control"  id="customer_phone_valid" value="" />
<span id="customer_phone_error" style="color:red"></span>
								</div>
								<div class="form-group">
									<label for="billing_name">City<span class="text-danger">*</span></label>

									<select required name="city" id="city" class="form-control">
										<option value="">select city</option>
										<?php foreach ($districts as $row) : ?>
											<option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group shipping-address-group ">
									<label for="shipping_address1">Customer Address  </label>
									<textarea class="form-control" rows="5" name="customer_address" id="shipping_address1"></textarea>
								</div>

								<div class="checkbox">
									<label>
										<input type="checkbox" name="ship_to_billing" id="ship_to_billing" value="1">
										<b class="fgreen">Same as Customer Address </b>
									</label>
								</div>
								<div class="form-group ">
									<label for="billing_address1">Delivery Address </label>
									<textarea class="form-control " rows="5" name="delevery_address" id="billing_address1"> </textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-7">
						<div class="box" style="border:2px solid #ddd">
							<div class="box-header" style="background-color: #ddd">
								<h3 class="box-title">Order Info</h3>
							</div>
							<div class="box-body">
								<div class="form-group">
									<select name="product_ids" id="product_ids" class="form-control select2" multiple="multiple" data-placeholder="Type... product name here..." style="width:100%;">
										<?php if($orders): foreach ($orders as $order):?>
										<option value="<?php echo $order->product_id;?>"><?php echo $order->product_title.'-'.$order->sku;?></option>
										<?php endforeach;endif;?>
									</select>
								</div>
								<span id="product_html"></span>
							</div>
						</div>
						<div class="box box-primary" style="border:2px solid #ddd">
							<div class="box-header" style="background-color: #ddd">
								<h3 class="box-title">Actions</h3>
							</div>
							<div class="box-body">
								<div  hidden class="form-group" id="order_area">
									<label>
										<input type="radio" name="order_area" value="inside_dhaka" id="inside_dhaka" checked > Inside Dhaka
									</label>
									<br/>
									<label>
										<input type="radio" name="order_area" id="outside_dhaka" value="outside_dhaka"> Outside Dhaka
									</label>
								</div>
								<div class="form-group">
									<label for="billing_name">Payment type<span class="text-danger">*</span></label>
									<select  name="payment_type" id="payment_type" class="form-control">
										<option value="bKash">Bkash Payment</option>
										<option value="online">Online Payment</option>
										<option value="cash_on_delivery">Cash On Delivery </option>
									</select>
								</div>



								<div   class="form-group" >
									<label>BKash Transaction Id</label>
										<input type="text" class="form-control" name="bkash_payment" value=""   > 
									
									
									
								</div>
								<div hidden class="form-group">
									<label>Courier Service</label>
									<select name="courier_service" id="courier_service" class="form-control">
										<?php if(isset($couriers)): foreach ($couriers as $courier) :?>
				<option value="<?php echo $courier->courier_name?>"><?php echo $courier->courier_name?></option>
										<?php endforeach;endif; ?>
									</select>
								</div>

								<div  hidden class="form-group">
									<label>Order Status</label>
									<select name="order_status" id="order_status" class="form-control">
										<option value="new">New</option>
										<option value="pending_payment">Pending for Payment</option>
										<option value="processing">On Process</option>
										<option value="on_courier">With Courier</option>
										<option value="delivered">Delivered</option>
										<option value="refund">Refunded</option>
										<option value="cancled">Cancelled</option>
										<option value="completed">Completed</option>
									</select>
								</div>
								<div  hidden class="form-group <?=form_error('shipment_time') ? 'has-error' : ''?>">
									<label>Shipping Date</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" name="shipment_time" class="form-control pull-right" id="datepicker" value="<?=date('m/d/Y')?>">
									</div>
								</div>
							</div>
							<div class="box-footer">
								
								<?=form_hidden('submission_level', '1')?>
								<?=form_hidden('created_by', 'office-staff')?>
								<?=form_hidden('staff_id', $user_id)?>
								<button type="submit" class="btn btn-success pull-right">Save</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
        </div>
	<script>
$(document).ready(function () {
	$(document).on('change','#product_ids',function () {
		var product_ids = [];
		$.each($("form#checkout #product_ids option:selected, form#order_update #product_ids option:selected"), function()
		{
			product_ids.push($(this).val());
		});

		product_ids = product_ids.join(",");
		$.ajax({
			type: "POST",
			data: {product_id: product_ids,product_quantity : 1},
			url:"<?php echo base_url();?>order/OrderController/productSelection",
			success:function (result) {

				var response = JSON.parse(result);


				$('form#checkout #product_html, form#order_update #product_html').html(response.html);
			},
			errors: function (result) {

			}

		});

	});

		$(document).on('change',"form#checkout #outside_dhaka, form#order_update #outside_dhaka",function () {
			var courier_id= 2;
			var inside_dhaka =  jQuery("input[name='shipping_charge']").val();
			var outside_dhaka =  jQuery("input[name='shipping_charge_Out']").val();
			var total =  jQuery('.bold #total_cost').text();

			var total_price=parseFloat(total)+parseFloat(outside_dhaka)-parseFloat(inside_dhaka);
			jQuery('.bold #delivery_cost').text(outside_dhaka);

			jQuery("input[name='order_total']").val(total_price);
			jQuery('.bold #total_cost').text(total_price);
			$.ajax({
					type: "POST",
					data: {courier_id: courier_id},
					url: "<?php echo base_url();?>order/OrderController/CourierSelection",
					success: function (data) {
						$('#courier_service').html(data);
					}
				});
		});
	$(document).on('change',"form#checkout #inside_dhaka, form#order_update #inside_dhaka",function () {
		var courier_id= 1;
		var inside_dhaka =  jQuery("input[name='shipping_charge']").val();
		var outside_dhaka =  jQuery("input[name='shipping_charge_Out']").val();
		var total =  jQuery('.bold #total_cost').text();

		var total_price=parseFloat(total)-parseFloat(outside_dhaka)+parseFloat(inside_dhaka);
		jQuery('.bold #delivery_cost').text(inside_dhaka);

		jQuery("input[name='order_total']").val(total_price);
		jQuery('.bold #total_cost').text(total_price);
		$.ajax({
			type: "POST",
			data: {courier_id: courier_id},
			url: "<?php echo base_url();?>order/OrderController/CourierSelection",
			success: function (data) {
				$('#courier_service').html(data);
			}
		});
	});




	$("#ship_to_billing,#billing_address1").change(function() {
		if($(this).prop('checked')) {
			var deleveryAdress= $("#shipping_address1").val();
			$("#billing_address1").val(deleveryAdress);
		} else {
			$("#billing_address1").val("");
		}
	});



	$('body').on('click', 'form#checkout .update_items, form#order_update .update_items', function()
	{

		var city= $('#city  option:selected').text();

		var product_ids = [];
		var product_qtys = [];

		$.each($("form#checkout .item_qty, form#order_update .item_qty"), function()
		{
			product_ids.push($(this).attr('data-item-id'));
			product_qtys.push($(this).val());
		});
		product_ids = product_ids.join(",");
		product_qtys = product_qtys.join(",");

		$.ajax({
			type: 'POST',
			data: {
				"product_ids" : product_ids,
				"product_qtys" : product_qtys,
				"city":city
			},
			url:"<?php echo base_url();?>order/OrderController/productSelectionChange",
			success: function(result)
			{
				//alert('success');
				var response = JSON.parse(result);
				$('form#checkout #product_html, form#order_update #product_html').html(response.html);
			}
		});
	});




});
	</script>

	<script>
		$(document).on('input change click', '#checkout #shipping_charge_suzon', function () {

			var charge=$(this).val();
			var subtotal_cost=$('#checkout #subtotal_cost').text();
			var total=parseFloat(charge)+parseFloat(subtotal_cost);
			$('#total_cost').text(total.toFixed(2));

		});


		$('#customer_phone_valid').on('blur', function () {

			var customer_phone= $("#customer_phone_valid").val();
			 

			if (!/^01\d{9}$/.test(customer_phone)) {
				$('#customer_phone_error').text("Invalid phone number: must have exactly 11 digits and begin with ");
			} else {
				$('#customer_phone_error').text("");


			}
		});


		$('#user_email').blur(function () {
			var error_email = '';
			var email = $('#user_email').val();
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (!filter.test(email)) {
				$('#user_email_error').html('<label  >email address format is not correct</label>');
				$('#user_email_error .text-danger').fadeOut(50000000);


			}
			else {

		$('#user_email_error').html('<label class="text-danger"></label>');


			}
		});

		</script>

