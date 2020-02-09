<div class="col-md-offset-0 col-md-12">

<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo $title; ?></h3>


	</div>
	<div class="box-body">



		<form method="POST" action="<?=base_url('add-update')?>"  name="teacher" enctype="multipart/form-data">
			<?php $this->load->view('add_form');?>

			<div class="box-footer">
				<button type="submit" class="btn btn-success pull-left">Update</button>
			</div>
		</form>



	</div>
</div>
<script>



		

		document.forms['teacher'].elements['adds_type'].value="<?php echo $add->adds_type;?>";


	</script>













