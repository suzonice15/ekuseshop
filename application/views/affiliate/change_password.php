
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



    <h5>Change Password
    </h5>
    <br/>
    <form action="<?php echo base_url()?>affiliate/change_password" method="post" >
        <?php $message=$this->session->flashdata('message'); echo $message;?>
        <div class="form-group col-md-6 ">
            <label for="sell_price">Old Password<span class="text-danger">*</span></label>
            <input  type="text" class="form-control" name="old_password" id="old_password"  value="">
            <p id="old_password_error"></p>
        </div>


        <div class="form-group col-md-6 ">
            <label for="sell_price">New Password<span class="text-danger"></span></label>
            <input  type="text" class="form-control" name="new_password"  id="new_password" value="">
            <p id="new_password_error"></p>
        </div>

        <div class="form-group col-md-6 ">
            <label for="sell_price"> Confirm New Password
                <span class="text-danger"></span></label>
            <input  type="text" class="form-control" name="cnew_password"  id="cnew_password" value="">
            <p id="cnew_password_error"></p>
        </div>

        <div  class="form-group col-md-2 ">
            <button  type="submit"   id="update_password" style="background-color: green" class="btn btn-success  btn-sm "  > Submit</button >
        </div>

    </form>
</div>

<script>
    $(document).ready(function () {



        $(document).on('input','#new_password',function () {
            var error_email = '';
            var new_password = $('#new_password').val();
            if (new_password.length<8) {
                $('#new_password_error').html("<span class='text-danger'>Enter at least 8 digits</span> ");
                $('#update_password').prop('disabled','disabled');
            } else {
                $('#new_password_error').html("<span class='text-danger'></span> ");
                $('#update_password').prop('disabled','');
            }
        });
        $(document).on('input','#cnew_password',function () {

            var new_password = $('#new_password').val();
            var cnew_password = $('#cnew_password').val();
            if (cnew_password != new_password) {
                $('#cnew_password_error').html("<span class='text-danger'>New Password and Confirm Password does not matched </span> ");
                $('#update_password').prop('disabled','disabled');
            } else {
                $('#cnew_password_error').html("<span class='text-success'>New Password and Confirm Password  matched </span> ");
                $('#update_password').prop('disabled','');
            }
        });
        $(document).on('input','#old_password',function () {

            var old_password = $('#old_password').val();
            if (old_password.length < 8) {
                $('#old_password_error').html("<span class='text-danger'>Enter at least 8 digits </span> ");
                $('#update_password').prop('disabled','disabled');
            } else {
                $('#old_password_error').html("<span class='text-success'> </span> ");
                $('#update_password').prop('disabled','');
            }
        });

    });
</script>