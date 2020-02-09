<div class="col-md-offset-1 col-md-9">
	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title"><?php if (isset($title)) echo $title ?></h3>


		</div>
		<div class="box-body">

			<form name="courier" action="<?php echo base_url() ?>courier-update" class="form-horizontal" method="post">
				<?php $this->load->view('courier_form'); ?>

		</div>

		<div class="box-footer">
			<input type="submit" class="btn btn-success pull-left" value="Update"/>

		</div>
		</form>
	</div>
	<script>
		document.forms['courier'].elements['courier_status'].value=<?php echo  $courier->courier_status;?>

	</script>
