<div class="col-md-offset-0 col-md-12">

<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo $title; ?></h3>


	</div>
	<div class="box-body">



		<form method="POST" action="<?=base_url('slider-update')?>" enctype="multipart/form-data">
			<?php $this->load->view('slider_form');?>

			<div class="box-footer">
				<button type="submit" class="btn btn-success pull-left">Update</button>
			</div>
		</form>



	</div>
</div>
<script>



		

		document.forms['teacher'].elements['designation_id'].value="<?php echo $teacher->designation_id;?>";


	</script>













