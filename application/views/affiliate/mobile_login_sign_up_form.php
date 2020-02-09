<div class="container">
    <div class="row">
        <div class="col-md-6">


            <form action="<?php echo base_url() ?>affiliate/mobile_login_check" method="post">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <h6 class="form-text text-danger"><?php if (isset($error)) {
                                echo $error;
                            } ?></h6>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> Mobile Number</label>
                            <input required type="text" class="form-control" id="login_phone" name="user_email"
                                   placeholder="Enter Your Mobile Number" value="<?php echo set_value('user_email') ?>" autocomplete="off" >
                            <p class="text-danger" id="login_phone_eror"></p>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Password </label>
                            <input required type="password" class="form-control" name="user_password"
                                   placeholder="Enter Your password"  id="login_password" value="<?php echo set_value('user_password') ?>" autocomplete="off">
                            <p class="text-danger" id="login_password_eror"></p>
                        </div>
                        <div class="form-group">

                            <label class="">Captcha:</label>

                            <p>Can't read the Captcha ? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</p>


                            <p id="captImg"><?php echo $captchaImg; ?></p>
                            <input type="text" name="captcha" value="<?php echo set_value('captcha') ?>"  class="form-control" placeholder="Enter captcha code"/>

                            </div>


                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">

                            <div class="btn-group mr-2" role="group" aria-label="Second group">
                                <button   style="background-color: green" type="submit"  id="login_to_website"  class="btn btn-success btn-sm"  > Sign In</button>
                            </div>
                            <div class="btn-group" role="group" aria-label="Third group">
                                <a target="_blank" href="<?php echo base_url() ?>home/password_reset"
                                   style="margin-top: 11px;margin-left: 18px;">Forgot Your Password ?</a>

                            </div>
                        </div>
                    </div>
                </div>
            </form>


        </div>
        <div class="col-md-6">


            <form action="<?php echo base_url() ?>affiliate/mobile_sign_up_user"  id="myForm" method="post">
                <div class="card">
                    <div class="card-header">
                        Signup
                    </div>
                    <div class="card-body">
                        <h6 class="form-text text-danger"><?php if (isset($signerror)) {
                                echo $signerror;
                            } ?></h6>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> Name</label>
                            <input  value="<?php echo set_value('user_f_name') ?>" required type="text" name="user_f_name"  id="user_f_name" class="form-control"
                                   placeholder="Enter Your Full Name">
                            <p id="user_f_name_error"></p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Mobile </label>
                            <input required value="<?php echo set_value('user_mobile') ?>" name="user_mobile" id="mobile_user_mobile" type="text" class="form-control"
                                   placeholder="Enter your mobile">
                            <p id="mobile_user_mobile_error"></p>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Email </label>
                            <input name="user_email" value="<?php echo set_value('user_email') ?>" id="mobile_user_email" type="email" class="form-control"
                                   placeholder="Enter your email">
                            <p id="mobile_user_email_error"></p>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> Password </label>
                            <input required name="user_password" value="<?php echo set_value('user_password') ?>" type="password" id="mobile_user_passwor_signup" class="form-control"
                                   placeholder="Enter your password">
                            <p id="mobile_user_passwor_signup_error"></p>


                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1"> Confirm Password </label>
                            <input required name="conform_password" type="password" value="<?php echo set_value('conform_password') ?>" id="conform_password" class="form-control"
                                   placeholder="Enter your password">
                            <p id="confirm_password_error"></p>


                        </div>
                        <div class="form-group">

                            <label class="">Captcha:</label>
                            <p>Can't read the Captcha ? click <a href="javascript:void(0);" class="refreshCaptchaSign">here</a> to refresh.</p>



                                <p id="captSignImg"><?php echo $captchaImg; ?></p>
                            <input type="text" name="captcha" value="<?php echo set_value('captcha') ?>" class="form-control "  placeholder="Enter captcha code"/>


                        </div>
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">

                            <div class="btn-group mr-2" role="group" aria-label="Second group">
                                <button   style="background-color: green" type="submit" id="user_login_mobile" class="btn btn-success btn-sm"  > Signup</button>

                            </div>

                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>

</div>

<script>
    $(document).ready(function(){
        $('.refreshCaptcha').on('click', function(){
            $.get('<?php echo base_url().'Affiliate/refresh'; ?>', function(data){
                $('#captImg').html(data);
            });
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('.refreshCaptchaSign').on('click', function(){
            $.get('<?php echo base_url().'Affiliate/refresh'; ?>', function(data){
                $('#captSignImg').html(data);
            });
        });
    });
</script>
<script>
    $(document).ready(function () {


            $(document).on('input','#mobile_user_email',function () {


            var error_email = '';
            var email = $('#mobile_user_email').val();
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(email)) {
                $('#mobile_user_email_error').html('<label class="text-danger">Email address format is not correct</label>');
                $('#mobile_user_email_error .text-danger').fadeOut(50000000);

                $('#user_login_mobile').prop('disabled','disabled');
            }
            else {
                $('#mobile_user_email_error').html('');

                $.ajax({
                    url: "<?php echo base_url()?>Affiliate/email_check",
                    method: "POST",
                    data: {email: email},
                    success: function (result) {
                        if (result == 'unique') {
// $('#user_email_error').html('<label class="text-success">Ok,Unique</label>');
                            $('#user_login_mobile').prop('disabled','');
                        }
                        else {
                            $('#mobile_user_email_error').html('<label class="text-danger">Duplicated email Enter another email</label>');
                            $('#user_login_mobile').prop('disabled','disabled');
                        }
                    }
                })
            }
        });



        $(document).on('blur','#user_f_name',function () {

            var user_f_name = $('#user_f_name').val();

            if (user_f_name.length < 2) {
                $('#user_f_name_error').html("<span class='text-danger'>You can`t leave this empty</span> ");
                $('#user_login_mobile').prop('disabled','disabled');
            } else {
                $('#user_f_name_error').html("");
                $('#user_login_mobile').prop('disabled','');



            }
        });


        $(document).on('input','#mobile_user_mobile',function () {
            var error_email = '';
            var user_mobile = $('#mobile_user_mobile').val();
            if (!/^01\d{9}$/.test(user_mobile)) {
                $('#mobile_user_mobile_error').html("<span class='text-danger'>The length of the Phone number must be 11 digits</span> ");
                $('#user_login_mobile').prop('disabled','disabled');
            } else {
                $('#mobile_user_mobile_error').html("");


                $.ajax({
                    url: "<?php echo base_url()?>Affiliate/phone_check",
                    method: "POST",
                    data: {phone: user_mobile},
                    success: function (result) {
                        if (result == 'unique') {
// $('#user_email_error').html('<label class="text-success">Ok,Unique</label>');
                            $('#user_login_mobile').prop('disabled','');
                        }
                        else {
                            $('#mobile_user_mobile_error').html('<label class="text-danger">This number already been registered, please reset your number or use another number . </label>');


                            $('#user_login_mobile').prop('disabled','disabled');

                        }
                    }
                });
            }
        });

        $('#mobile_user_passwor_signup').blur(function () {

            var passowrd = $('#mobile_user_passwor_signup').val();

            if (passowrd.length < 8) {
                $('#mobile_user_passwor_signup_error').html("<span class='text-danger'>Enter at least 8 digit password</span> ");

                $('#user_login_mobile').prop('disabled','disabled');
            } else {
                $('#mobile_user_passwor_signup_error').html("");
                $('#user_login_mobile').prop('disabled','');

            }
        });

        $(document).on('input','#conform_password', function () {
            var passowrd = $('#mobile_user_passwor_signup').val();
            var confirm_passowrd = $('#conform_password').val();
            if(passowrd !=confirm_passowrd){
              $('#confirm_password_error').html('<label class="text-danger">password does not matched with confirm password </label>');

                $('#user_login_mobile').prop('disabled','disabled');
            } else {
                $('#confirm_password_error').html('<label class="text-success">password matched with confirm password </label>');
                $('#user_login_mobile').prop('disabled','');


            }

        });
    });
    $(document).ready(function () {
        $('#user_login_mobile').click(function () {
            var user_f_name = $('#user_f_name').val();


            if (user_f_name.length ==0) {
                $('#user_f_name_error').html("<span class='text-danger'>You can`t leave this empty</span> ");

            }
            var user_mobile = $('#mobile_user_mobile').val();
            if (user_mobile.length ==0) {
                $('#mobile_user_mobile_error').html("<span class='text-danger'>You can`t leave this empty</span> ");

            }
            var confirm_passowrd = $('#conform_password').val();
            if (confirm_passowrd.length ==0) {
                $('#confirm_password_error').html("<span class='text-danger'>You can`t leave this empty</span> ");

            }
            var mobile_user_passwor_signup = $('#mobile_user_passwor_signup').val();
            if (mobile_user_passwor_signup.length ==0) {
                $('#mobile_user_passwor_signup_error').html("<span class='text-danger'>You can`t leave this empty</span> ");

            }


        });


        $('#login_phone').blur(function () {

            var passowrd = $('#login_phone').val();

            var login_phone = $('#login_phone').val();
            if(login_phone.length ==0){
                $('#login_phone_eror').text('You can`t leave this empty');
            } else {
                $('#login_phone_eror').text('');
            }

        });

        $('#login_password').blur(function () {

            var login_password = $('#login_password').val();
            if(login_password.length ==0){
                $('#login_password_eror').text('You can`t leave this empty');
            } else {
                $('#login_password_eror').text('');
            }

        });

        $('#login_to_website').click(function(){

            var login_phone = $('#login_phone').val();
            if(login_phone.length ==0){
                $('#login_phone_eror').text('You can`t leave this empty');
            } else {
                $('#login_phone_eror').text('');
            }

            var login_password = $('#login_password').val();
            if(login_password.length ==0){
                $('#login_password_eror').text('You can`t leave this empty');
            } else {
                $('#login_password_eror').text('');
            }
        })
    });
</script>