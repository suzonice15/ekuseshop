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


			foreach ($orders as $order){

				$product_items = @unserialize($order->products);
echo $order->order_id;
				?>

			<?php  } } ?>

		</tbody>

	</table>
	<?php echo $this->ajax_pagination->create_links(); ?>
</div>

