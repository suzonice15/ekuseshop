<div class="col-md-offset-0 col-md-12">
	<div class="box  box-success">
		<div class="box-header with-border  ">

			<form method="POST">

				<div class="row row5">
					<div class="col-sm-12">


						<div class="col-sm-9 pull-right form-group btn-order-status">

							<a id="StatusId_completed" onclick="$(this).css('background-color', 'red');" href="http://www.kalerhaat.com/admin/order/custom/1" class="btn btn-info">
								New
							</a>

							<a id="StatusId_completed" onclick="$(this).css('background-color', 'red');" href="http://www.kalerhaat.com/admin/order/custom/2" class="btn btn-info">
								Pending Payment
							</a>
							<a id="StatusId_completed" onclick="$(this).css('background-color', 'red');" href="http://www.kalerhaat.com/admin/order/custom/3" value="completed" class="btn btn-info">
								Order Processing
							</a>


							<a id="StatusId_completed" onclick="$(this).css('background-color', 'red');" href="http://www.kalerhaat.com/admin/order/custom/5" value="completed" class="btn btn-info">
								Completed
							</a>
							<a id="StatusId_completed" onclick="$(this).css('background-color', 'red');" href="http://www.kalerhaat.com/admin/order/custom/6" value="completed" class="btn btn-info">
								Cancel
							</a>

							<a id="StatusId_completed" href="http://www.kalerhaat.com/admin/order/custom/7" value="" class="btn btn-info">
								Phone Pending
							</a>





						</div>
					</div>
					<div class="col-sm-1">

					</div>
				</div></form>
		</div>
		<div class="box-body">
			<div class="table-responsive">
				<div class="col-xs-12">
					<div class="">
						<div class="box-header">


								<label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label>



							<div class="box-tools">
								<div class="input-group input-group-sm hidden-xs" style="width: 150px;">
									<input type="text" name="table_search"  onkeyup="searchFilter()" class="form-control col-md-6 pull-right" placeholder="Search">

									<div class="input-group-btn">
										<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table  id="data_list" class="table table-bordered  table-hover">
								<thead>
								<tr>
									<th>Sl</th>
									<th>Customer Information</th>
									<th>Product Details</th>
									<th>Order Status</th>
									<th>Created by</th>
									<th>Action</th>
								</tr>
								</thead>

							<tbody>


							<?php if(isset($orders)) {
								$count=0;

								foreach ($orders as $order){

							$product_items = @unserialize($order->products);

							$product_images = NULL;

							if(is_array($product_items) && sizeof($product_items)>0)
							{
								foreach($product_items['items'] as $product_id=>$item)
								{
									$productData=  get_product_meta_data($product_id);

									$Qty= $item['qty'];
									$featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;
									$name = isset($item['name']) ? $item['name'] : null;
									$product_NAME='<span style="color:blue">'.$name.' </span> ';

									$product_images.='<img src="'.$featured_image.'" style="width:30px;height:30px;margin:3px;">';
								}}
								?>

								<tr>
									<td><?php echo  ++$count;?></td>
									<td>Order Id:
										<?php echo $order->order_id;?>
										<br/>
										<?php echo $order->created_time;?>
										<br/>
										<button class="btn btn-success">Customer Name:<?php echo $order->customer_name;?></button>
										<button class="btn btn-info">Customer Mobile:<?php echo $order->customer_phone;?></button>
																			<button class="btn btn-info">Customer Address:<?php echo $order->customer_address;?></button>
										<button class="btn btn-danger">Total Amount:<?php echo $order->order_total;?></button>


									</td>
									<td> <img width="50" height="50" src="<?php echo $featured_image; ?>" />

									</td>
									<td>
										<span class="label label-success"><?php echo $order->order_status;?></span></td>
									<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
								</tr>
							<?php  } } ?>

							</tbody>

							</table>
							<?php echo $this->ajax_pagination->create_links(); ?>
						</div>



						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
			</div>


		</div>

	</div>
</div>

<script>
	function searchFilter(page_num) {
		page_num = page_num ? page_num:0;
		var keywords = $('#keywords').val();
		var sortBy = $('#sortBy').val();

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>order/OrderController/ajax_pagination_data/'+page_num,
			data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
			success: function (html) {
				alert(html);

				$('#data_list').html(html);

			}
		});
	}
</script>
