<div class="col-md-offset-0 col-md-12">
<div class="box  box-success">
	<div class="box-header with-border">
		<h3 class="box-title pull-right">

            <a class="btn btn-info " href="<?php echo base_url();?>courier-create"><i class="fa fa-plus-circle"></i>Add new</span></a>

        </h3>


	</div>
	<div class="box-body">
<div class="table-responsive">
		<table id="example1" class="table table-bordered table-striped table-responsive ">
			<thead>
			<tr>
				<th>Sl</th>
				<th>Name</th>
				<th>Type</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			<?php if (isset($couriers)){
            $count = 0;
            foreach ($couriers as $courier) {
    ?>
    <tr>


        <td><?php echo ++$count; ?></td>
        <td><?php echo $courier->courier_name; ?></td>
        <td><?php $courier_status= $courier->courier_status==1 ? 'Inside Bangladesh' :'Outside Bangladesh'; echo $courier_status;?></td>

        <td><a title="edit"
               href="<?php echo base_url() ?>courier-edit/<?php echo $courier->courier_id; ?>"
            <span class="glyphicon glyphicon-edit btn btn-success"></span>
            </a>
			<a href="<?php echo base_url() ?>courier-delete/<?php echo $courier->courier_id; ?>"
			   onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
				<span class="glyphicon glyphicon-trash btn btn-danger"></span>


		</td>
    </tr>

			<?php }} ?>


			</tbody>

		</table>
</div>


	</div>

