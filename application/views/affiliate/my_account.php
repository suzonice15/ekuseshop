
<div class="col-lg-9">


<h5>ACCOUNT INFORMATION
</h5>
<hr>

	<?php
	$user_id=$this->session->userdata('user_id');

	if(isset($user_id)){
	?>
<div class="col-md-6">
<h4>
Contact Information
</h4>
<p>	
<?php 
	$active=$this->session->userdata('user_status');
								$user_f_name=$this->session->userdata('user_f_name');
								$user_l_name=$this->session->userdata('user_l_name');
								$name=$user_f_name.' '.$user_l_name;
								echo $name;
	
	?>
</p>
<p><?php echo $this->session->userdata('user_email');?></p>
<div class="box-actions">
                <a  style="z-index: 9999999999"  href="<?php echo base_url()?>affiliate/edit">
                    <span>Edit</span>
                </a>
               
            </div>

</div>

	<?php }  else { ?>
		<h4>Please <a href="<?php echo base_url()?>affiliate/login_signup">login</a> / <a href="<?php echo base_url()?>affiliate/login_signup"> Signup </a> to access your account</h4>

	<?php } ?>



</div>