<div class="col-md-offset-0 col-md-12">

<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo $title; ?></h3>


	</div>
	<div class="box-body">



		<form method="POST" action="<?=base_url('setting-popup')?>" enctype="multipart/form-data">
			<div class="box-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group <?=form_error('popup_type') ? 'has-error' : ''?>">
							<label for="popup_type">Popup Type <br><small>Ex. winter or summar or any other as you wish but without space</small></label>
							<input type="text" class="form-control" name="popup_type" id="popup_type" value="<?=get_option('popup_type')?>">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group <?=form_error('popup_show_time') ? 'has-error' : ''?>">
							<label for="popup_show_time">Popup Show Time (in second). <br><small>1 second means 1000</small></label>
							<input type="text" class="form-control" name="popup_show_time" id="popup_show_time" value="<?=get_option('popup_show_time')?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group <?=form_error('popup_height') ? 'has-error' : ''?>">
							<label for="popup_height">Popup Height <br><small>Ex. 300px</small></label>
							<input type="text" class="form-control" name="popup_height" id="popup_height" value="<?=get_option('popup_height')?>">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group <?=form_error('popup_width') ? 'has-error' : ''?>">
							<label for="popup_width">Popup Width <br><small>Ex. 600px</small></label>
							<input type="text" class="form-control" name="popup_width" id="popup_width" value="<?=get_option('popup_width')?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group <?=form_error('popup_link') ? 'has-error' : ''?>">
							<label for="popup_link">Targetted Link</label>
							<input type="text" class="form-control" name="popup_link" id="popup_link" value="<?=get_option('popup_link')?>">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group <?=form_error('popup_img_link') ? 'has-error' : ''?>">
							<label for="popup_img_link">Banner Image Link</small></label>
							<input type="text" class="form-control" name="popup_img_link" id="popup_img_link" value="<?=get_option('popup_img_link')?>">
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-success pull-right">Update</button>
			</div>
		</form>


	</div>
</div>







