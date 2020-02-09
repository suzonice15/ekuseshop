
<div class="col-md-offset-0 col-md-12">

	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title"><?php echo $title; ?></h3>


		</div>
		<div class="box-body">

<form method="POST" action="<?=base_url('setting-extra')?>" enctype="multipart/form-data">
	<div class="box-body">
		<div class="form-group ">
			<label for="logo_slider">Logo Slider</label>
			<textarea class="form-control" rows="20" name="logo_slider"><?=get_option('logo_slider')?></textarea>
		</div>
		<div class="form-group ">
			<label for="partner_logo">Partner Logo</label>
			<textarea class="form-control" rows="10" name="partner_logo"><?=get_option('partner_logo')?></textarea>
		</div>
	</div>
	<div class="box-footer">
		<button type="submit" class="btn btn-success pull-right">Update</button>
	</div>
</form>


</div>
</div>


