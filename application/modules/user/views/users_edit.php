
<div class="col-md-offset-0 col-md-12">
	<div class="box box-success ">
		<div class="box-header with-border">
			<h3 class="box-title"><?php if (isset($title)) echo $title ?></h3>


		</div>
		<div class="box-body">


			<form action="<?php echo base_url()?>user-update"  id="user" method="post" enctype="multipart/form-data" >
				<?php $this->load->view('users_form');?>

				<div class="box-footer">
					<input type="submit" class="btn btn-success pull-left" value="Update"/>


				</div>
			</form>
		</div>
	</div>


<script>

	document.forms['user'].elements['user_status'].value="<?php echo $user->user_status;?>";
	document.forms['user'].elements['user_type'].value="<?php echo $user->user_type;?>";


</script>
