<div class="container">
    <form action="<?php echo base_url()?>home/new_update_password" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1"> Email address</label>
            <input readonly type="email" class="form-control" name="email" placeholder="Enter email" value="<?php if(isset($email)) { echo $email; };?>">
            <h6   class="form-text text-danger"><?php if(isset($error)){ echo $error;} ?></h6>
            <h6   class="form-text text-success"><?php if(isset($success)){ echo $success;} ?></h6>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1"> New  Password</label>
            <input type="passord" class="form-control" name="passord" placeholder="Enter new password">

        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Confirm New  Password</label>
            <input type="passord" class="form-control" name="npassord" placeholder="Enter confirm passord">

        </div>

        <button type="submit" class="btn btn-primary">Reset your password</button>
    </form>

</div>