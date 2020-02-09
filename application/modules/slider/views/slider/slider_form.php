<div class="box-body">
	<div class="form-group <?=form_error('homeslider_title') ? 'has-error' : ''?>">
		<label for="homeslider_title">Slider Title  <span class="required">*</span></label>
		<input type="text" class="form-control" name="homeslider_title" id="homeslider_title" value="<?php if(isset($slider)) { echo $slider->homeslider_title; } ?>">
		<input type="hidden" class="form-control" name="homeslider_id" id="homeslider_title" value="<?php if(isset($slider)) { echo $slider->homeslider_id; } ?>">
	</div>

	<div class="form-group <?=form_error('target_url') ? 'has-error' : ''?>">
		<label for="target_url">Target URL</label>
		<input type="text" class="form-control" name="target_url" id="target_url" value="<?php if(isset($slider)) { echo $slider->target_url; } ?>">
	</div>

	<div class="form-group featured-image <?=form_error('homeslider_banner') ? 'has-error' : ''?>">
		<label>Alter Text</label>

			<div class="col-sm-126">

				<input type="text" class="form-control" name="homeslider_text" value="<?php if(isset($slider)) { echo $slider->homeslider_text; } ?>"/>
			</div>


	</div>

	<div class="form-group <?=form_error('target_url') ? 'has-error' : ''?>">

		<div class="col-sm-6">
			<span>Slider Image size 1300 ✖ 400</span>
			<input type="file" class="form-control" name="featured_image"/>

		</div>
	</div>
	<div class="form-group <?=form_error('target_url') ? 'has-error' : ''?>">
		<div class="col-sm-6">
			<?php if(isset($slider->homeslider_banner)):?>
				<img  width="200" height="100" src="<?php echo base_url();echo $slider->homeslider_banner;?>"/>
			<?php endif;?>
		</div>
	</div>

</div>

