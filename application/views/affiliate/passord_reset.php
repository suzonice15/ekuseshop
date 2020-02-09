<div class="container">
    <div class="row">


        <div class="col-md-5">

        <form action="<?php echo base_url()?>home/password_reset_check" method="post">
        <h2>Forgot Your Password</h2>
        <div class="form-group">
            <label for="exampleInputEmail1">Please enter your email address below to receive a password reset link</label>
           <br>
            <label for="exampleInputEmail1">Email <span style="color:red">*</span></label>
            <input type="text" class="form-control" value="<?php echo set_value('email') ?>" name="email" placeholder="Enter your email address  ">
            <h6   class="form-text text-danger"><?php if(isset($error)){ echo $error;} ?></h6>
            <h6   class="form-text text-success"><?php if(isset($success)){ echo $success;} ?></h6>
        </div>
        <div class="form-group">

            <label class="">Captcha:</label>

            <p>Can't read the Captcha ? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</p>


            <p id="captImg"><?php echo $captchaImg; ?></p>
            <input type="text" name="captcha" value="<?php echo set_value('captcha') ?>"  class="form-control" placeholder="Enter captcha code"/>


        </div>
        <button type="submit" class="btn btn-primary" style="text-transform: uppercase">Reset your password</button>
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