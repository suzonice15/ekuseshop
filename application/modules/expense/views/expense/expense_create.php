
<div class="col-md-offset-1 col-md-9">
<div class="box box-success ">
        <div class="box-header with-border">
         <h3 class="box-title"><?php if (isset($title)) echo $title ?></h3>


        </div>
        <div class="box-body">
		<form action="<?php echo base_url()?>expense-category-save"  method="post" enctype="multipart/form-data" >
		<?php $this->load->view('expense_form');?>

			<div class="box-footer">
				<input type="submit" class="btn btn-success pull-right" value="Save"/>
				<a class="btn btn-danger pull-left " href="<?php echo base_url();?>expense-category-list">Cancel</a>

			</div>
		</form>

		</div>
        </div>

