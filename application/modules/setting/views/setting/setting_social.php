<div class="col-md-offset-0 col-md-12">
<div class="box  box-success">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo $title; ?></h3>


	</div>
	<div class="box-body">
		<form method="POST" action="<?=base_url('setting-social')?>" enctype="multipart/form-data">
			<div class="box-body">
				<div class="form-group <?=form_error('facebook') ? 'has-error' : ''?>">
					<label for="facebook">Facebook</label>
					<input type="text" class="form-control" name="facebook" id="facebook" value="<?=get_option('facebook')?>">
				</div>
				<div class="form-group <?=form_error('youtube') ? 'has-error' : ''?>">
					<label for="youtube">YouTube</label>
					<input type="text" class="form-control" name="youtube" id="youtube" value="<?=get_option('youtube')?>">
				</div>


				<div class="form-group <?=form_error('twitter') ? 'has-error' : ''?>">
					<label for="twitter">Twitter</label>
					<input type="text" class="form-control" name="twitter" id="twitter" value="<?=get_option('twitter')?>">
				</div>


				<div class="form-group <?=form_error('instagram') ? 'has-error' : ''?>">
					<label for="instagram">Instagram</label>
					<input type="text" class="form-control" name="instagram" id="instagram" value="<?=get_option('instagram')?>">
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-success pull-right">Update</button>
			</div>
		</form>


	</div>

</div>
</div>

<script>

	$('#checkAll').change(function(){

		if($(this).is(":checked")){

			$('.checkAll').prop('checked',true);

		}

		else if($(this).is(":not(:checked)")){

			$('.checkAll').prop('checked',false);

		}
	});
	$('#deleteAll').click(function (e) {
		e.preventDefault();
		var sliderId = new Array();
		var allId = $('.checkAll').val();
		$('.checkAll').each(function () {
			if ($(this).is(":checked")) {
				sliderId.push(this.value);
			}
		});
		alert(sliderId);
		if (sliderId.length > 0) {
			$.ajax({

				url: '<?php echo base_url()?>slider/sliderController/multipleDelete',
				data: {homeslider_id: sliderId},
				type: 'post',
				success: function (data) {
					alert(data)
					window.location = '<?php echo base_url()?>slider-list';
				}

			});
		} else {
		 alert("Select at least one product checkbox");

	}


	});

</script>
