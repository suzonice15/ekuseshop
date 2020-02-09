<div class="col-md-offset-0 col-md-12">
<div class="box  box-success">
	<div class="box-header with-border">
		<h3 class="box-title pull-right">


        </h3>


	</div>
	<div class="box-body">
<div class="table-responsive">
		<table id="example1" class="table table-bordered table-striped table-responsive ">
			<thead>
			<tr>
				<th>Sl</th>
				<th>Product</th>
				<th>Customer  Name</th>

				<th>Customer Email</th>
				<th>Comments</th>
				<th>Rating</th>

				<th>Status</th>
				<th>Date</th>

				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			<?php if (isset($reviews)){
            $count = 0;
            foreach ($reviews as $inquery) {

				$featured_image = get_product_meta($inquery->product_id, 'featured_image');
				$featured_image = get_media_path($featured_image, 'thumb');
    ?>
    <tr>



        <td><?php echo ++$count; ?></td>
		<td> <img width="30" src="<?=$featured_image?>"><?php echo get_product_title($inquery->product_id) ?></td>
        <td><?php echo $inquery->name; ?></td>
        <td><?php echo $inquery->email; ?></td>
        <td><?php echo $inquery->comment; ?></td>
        <td><?php echo $inquery->rating; ?></td>




		<?php if($inquery->review_active==0):?>
        <td>  <button class="btn btn-danger">Unpublish</button></td>

				<?php else : ?>
			<td>   <button class="btn btn-success">Publish</button></td>

				<?php endif;?>

		<td><?php echo $inquery->created_time; ?></td>


		<td>

				<?php if($inquery->review_active==0):?>
			<a title="Publish"
			   href="<?php echo base_url() ?>review-show/<?php echo $inquery->review_id; ?>"
			<span class="glyphicon glyphicon-arrow-up btn btn-info"></span>
			</a>
			<?php else : ?>
					<a title="Unpublish"
					   href="<?php echo base_url() ?>review-off/<?php echo $inquery->review_id; ?>"
					<span class="glyphicon glyphicon-arrow-down btn btn-danger"></span>
					</a>

				<?php endif;?>

			<a title="edit"
			   href="<?php echo base_url() ?>review-edit/<?php echo $inquery->review_id; ?>"
			<span class="glyphicon glyphicon-edit btn btn-success"></span>
			</a>
		<a title="delete"
               href="<?php echo base_url() ?>review-delete/<?php echo $inquery->review_id; ?>"
               onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
                <span class="glyphicon glyphicon-trash btn btn-danger"></span>
            </a>
        </td>
    </tr>
			<?php } } ?>

			</tbody>

		</table>
</div>


	</div>

</div>
</div>
