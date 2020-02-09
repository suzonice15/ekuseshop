<div class="col-md-offset-0 col-md-12">
<div class="box  box-success">
	<div class="box-header with-border">
		<h3 class="box-title pull-right">

            <a class="btn btn-info " href="<?php echo base_url();?>page-create"><i class="fa fa-plus-circle"></i>Add new</span></a>

        </h3>


	</div>
	<div class="box-body">
<div class="table-responsive">
		<table id="example1" class="table table-bordered table-striped table-responsive ">
			<thead>
			<tr>
				<th>Sl</th>
				<th>Page Name</th>
				<th>Page  Url</th>
				<th>Page template</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			<?php if (isset($pages)){
            $count = 0;
            foreach ($pages as $page) {
    ?>
    <tr>



        <td><?php echo ++$count; ?></td>
        <td><?php echo $page->page_name; ?></td>
        <td><?php echo $page->page_link; ?></td>
        <td><?php echo $page->page_template; ?></td>
        <td><a title="edit"
               href="<?php echo base_url() ?>page-edit/<?php echo $page->page_id; ?>"
            <span class="glyphicon glyphicon-edit btn btn-success"></span>
            </a>
            <a title="delete"
               href="<?php echo base_url() ?>page-delete/<?php echo $page->page_id; ?>"
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
