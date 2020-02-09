
<div class="col-md-offset-0 col-md-12">
	<div class="box box-success ">
		<div class="box-header with-border">
			<h3 class="box-title"><?php if (isset($title)) echo $title ?></h3>


		</div>
		<div class="box-body">


			<form action="<?php echo base_url()?>picture-delete"  method="post" enctype="multipart/form-data" >
				<div class="box-body">
					<div class="form-group "><label for="media_title">Picture Name <span class="required">*</span></label>
						<input
							type="text" required class="form-control" name="picture" id="media_title" value=""></div>
				</div>

				<div class="box-footer">
					<input type="submit" class="btn btn-success pull-right" value="Delete picture"/>


				</div>
			</form>
		</div>
	</div>


