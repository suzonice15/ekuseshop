
<div class="col-md-offset-1 col-md-10">

<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo $title; ?></h3>


	</div>
	<div class="box-body">
		<form method="POST" action="<?=base_url('setting-facebook')?>" enctype="multipart/form-data">
			<div class="box-body">
				<div class="form-group <?=form_error('fb_app_id') ? 'has-error' : ''?>">
					<label for="fb_app_id">App ID</label>
					<input type="text" class="form-control" name="fb_app_id" id="fb_app_id" value="<?=get_option('fb_app_id')?>">
				</div>
				<div class="form-group <?=form_error('fb_app_secret') ? 'has-error' : ''?>">
					<label for="fb_app_secret">App Secret</label>
					<input type="text" class="form-control" name="fb_app_secret" id="fb_app_secret" value="<?=get_option('fb_app_secret')?>">
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-success pull-right">Update</button>
			</div>
		</form>

		</div>
	</div>


</div>
</div>
