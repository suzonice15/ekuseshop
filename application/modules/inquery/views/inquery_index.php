<div class="col-md-offset-0 col-md-12">
<div class="box  box-success">
	<div class="box-header with-border">
		

	</div>
	<div class="box-body">
<div class="table-responsive">
		<table id="example1" class="table table-bordered table-striped table-responsive ">
			<thead>
			<tr>
				<th>Sl</th>
				<th>Customer  Name</th>
				<th>Customer Phone</th>
				<th>Subject</th>
				<th>Message</th>
				<th>Date</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			<?php if (isset($inquerys)){
            $count = 0;
            foreach ($inquerys as $inquery) {
    ?>
    <tr>
        <td><?php echo ++$count; ?></td>
        <td><?php echo $inquery->name; ?></td>
        <td><?php echo $inquery->phone; ?></td>
        <td><?php echo $inquery->subject; ?></td>
        <td><?php echo $inquery->message; ?></td>
        <td><?php echo $inquery->created_time; ?></td>
		<?php if($inquery->status==0){

			?>
			<td><button class="btn btn-success"> Unread</button></td>
			<?php }  else {  ?>
			<td><button class="btn btn-danger"> Read</button></td>

		<?php }?>



        <td>
            <a title="delete"
               href="<?php echo base_url() ?>inquery-edit/<?php echo $inquery->inquiry_id; ?>"
              >
                <span class="glyphicon glyphicon-eye-open btn btn-success"></span>
            </a>
			<a title="delete"
			   href="<?php echo base_url() ?>inquery-delete/<?php echo $inquery->inquiry_id; ?>"
			   onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
				<span class="glyphicon glyphicon-trash btn btn-danger"></span>
			</a>
        </td>
    </tr>
			<?php }  } ?>

			</tbody>

		</table>
</div>


	</div>

</div>
</div>
