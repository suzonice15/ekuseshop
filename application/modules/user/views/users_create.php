
<div class="col-md-offset-0 col-md-12">
<div class="box box-success ">
        <div class="box-header with-border">
         <h3 class="box-title"><?php if (isset($title)) echo $title ?></h3>


        </div>
        <div class="box-body">


		<form action="<?php echo base_url()?>user-save"  id="user" method="post" enctype="multipart/form-data" >
		<?php $this->load->view('users_form');?>

			<div class="box-footer">
				<input type="submit" class="btn btn-success pull-left" value="Save"/>

			</div>
		</form>
        </div>
        </div>
    
    
    <script>
        $('#customer_phone').on('blur', function () {
           
            var customer_phone = $('#customer_phone').val();
            if (!/^01\d{9}$/.test(customer_phone)) {
                $('#phone_error').text("Invalid phone number: must have exactly 11 digits and begin with ");
            } else {
                $('#phone_error').text("");


            }
        });


        $('#customer_email').blur(function () {
            var error_email = '';
            var email = $('#customer_email').val();
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(email)) {
                $('#customer_email_error').html('<label class="text-danger">email address format is not correct</label>');


            } else {
                $('#customer_email_error').html('');

            }
        });
            
  </script>


