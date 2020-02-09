<div class="col-md-offset-2 col-md-6">
	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title"><?php if (isset($title)) echo $title ?></h3>


		</div>
		<div class="box-body">

        <form action="<?php echo base_url() ?>shift-update" class="form-horizontal" method="post">
            <?php $this->load->view('shifts_form'); ?>

    </div>

	<div class="box-footer">
		<input type="submit" class="btn btn-success pull-right" value="Update"/>
		<a class="btn btn-danger " href="<?php echo base_url();?>shift-list">Cancel</a>

	</div>
    </form>
</div>
