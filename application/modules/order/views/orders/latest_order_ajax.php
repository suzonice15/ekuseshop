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
	<?php echo $links; ?>
</div>



<script>
	$(document).ready(function () {
		$("#ajax_pagingsearc a").attr('onclick', 'return main_page_pagination($(this));');
	});
</script>
