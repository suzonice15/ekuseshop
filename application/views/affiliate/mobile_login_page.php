
<div class="col-lg-9">
				
		<?php 
			
	$message = $this->session->flashdata('message');


	if (isset($message)) {
		?>
	
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php
			echo $message;
					$this->session->unset_userdata('message');


					?>
	</div>	
		<?php
	}	?>	



<h5>Edit Account Information
</h5>
<br/>
<form action="<?php echo base_url()?>affiliate/edit" method="post" >
	<div class="form-group col-md-6 ">
	<label for="sell_price">First Name<span class="text-danger">*</span></label>	
	<input required type="text" class="form-control" name="user_f_name"  value="<?php echo $user->user_f_name?>">

	</div>
	
	<div hidden class="form-group col-md-6 ">
	<label for="sell_price">Last Name<span class="text-danger">*</span></label>	
	<input  type="text" class="form-control" name="user_l_name"  value="<?php echo $user->user_l_name?>">
	</div>
	<div class="form-group col-md-6 ">
	<label for="sell_price">Email<span class="text-danger"></span></label>	
	<input  type="text" class="form-control" name="user_email"  value="<?php echo $user->user_email?>  ">
	</div>
	<div class="form-group col-md-6 ">
	<label for="sell_price"> Password
 <span class="text-danger"></span></label>	
	<input  type="text" class="form-control" name="user_password"  value="">
	</div>
	
	<div class="form-group col-md-6 ">
	<label for="sell_price"> Mobile
 <span class="text-danger"></span></label>	
	<input  type="text" class="form-control" name="user_mobile"  value=" <?php echo $user->user_mobile?>">
	</div>
	<div class="form-group col-md-6 ">
	<label for="sell_price"> Address</label>


	
	
<textarea rows="4" cols="50" name="user_address" class="form-control"><?php echo $user->user_address;?></textarea> 
	</div>
	<div hidden class="form-group col-md-6 ">
	<label for="sell_price">New Password
 <span class="text-danger"></span></label>	
	<input  type="text" class="form-control" name="new_user_password"  value=" ">
	</div>
	
	<div  class="form-group col-md-2 ">
	<button  type="submit"  class="form-control btn btn-success" > Update</button >
	</div>
	
	</form>
</div>