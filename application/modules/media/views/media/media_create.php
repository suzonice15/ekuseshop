
<div class="col-md-offset-0 col-md-12">
<div class="box box-success ">
        <div class="box-header with-border">
         <h3 class="box-title"><?php if (isset($title)) echo $title ?></h3>


        </div>
        <div class="box-body">


		<form action="<?php echo base_url()?>media-save"  method="post" enctype="multipart/form-data" >
		<?php $this->load->view('media_form');?>

			<div class="box-footer">
				<input type="submit" class="btn btn-success pull-left" value="Save"/>

			</div>
		</form>
        </div>
        </div>


