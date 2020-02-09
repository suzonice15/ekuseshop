<div class="col-md-offset-0 col-md-12">
<div class="box  box-success">
	<div class="box-header with-border">
		<h3 class="box-title pull-right">

            <a class="btn btn-info " href="<?php echo base_url();?>expense-category-create"><i class="fa fa-plus-circle"></i>Add new</span></a>

        </h3>


	</div>
	<div class="box-body">
<div class="table-responsive">
		<table id="example1" class="table table-bordered table-striped table-responsive ">
			<thead>
			<tr>
				<th>Sl</th>
				<th>Category</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			<?php if (isset($expenses)){
            $count = 0;
            foreach ($expenses as $expense) {
    ?>
    <tr>


        <td><?php echo ++$count; ?></td>
        <td><?php echo $expense->expense_cat_name; ?></td>
        <td><a title="edit"
               href="<?php echo base_url() ?>expense-category-edit/<?php echo $expense->expense_cat_id; ?>"
            <span class="glyphicon glyphicon-edit btn btn-success"></span>
            </a>
			<a href="<?php echo base_url() ?>expense-category-delete/<?php echo $expense->expense_cat_id; ?>"
			   onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
				<span class="glyphicon glyphicon-trash btn btn-danger"></span>


		</td>
    </tr>

			<?php }} ?>


			</tbody>

		</table>
</div>


	</div>

