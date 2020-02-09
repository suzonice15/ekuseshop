<div class="col-md-offset-0 col-md-12">

<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo $title; ?></h3>


	</div>
	<div class="box-body">


		<form action="<?php echo base_url()?>page-update"  name="page_update" method="post" enctype="multipart/form-data" >
			<?php $this->load->view('page_form');?>

			<div class="box-footer">
				<button type="submit" class="btn btn-success pull-left">Update</button>
			</div>
		</form>



	</div>
</div>
<script>

		document.forms['page_update'].elements['page_template'].value="<?php echo $page->page_template;?>";
		document.forms['page_update'].elements['page_position'].value="<?php echo $page->page_position;?>";


	</script>













