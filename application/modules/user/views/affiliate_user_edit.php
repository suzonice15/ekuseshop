<div class="col-md-offset-0 col-md-12">
    <div class="box box-success ">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if (isset($title)) echo $title ?></h3>


        </div>
        <div class="box-body">

            <form action="<?php echo base_url() ?>affiliate-user-update" id="user" method="post"
                  enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group "><label for="media_title">Name<span class="required"></span></label>
                        <input
                            type="text" required class="form-control" name="user_f_name"
                            value="<?php if (isset($user)) {
                                echo $user->user_f_name;
                            } ?>">
                        <input
                            type="hidden" required class="form-control" name="user_id" value="<?php if (isset($user)) {
                            echo $user->user_id;
                        } ?>">


                    </div>
                    <div class="form-group "><label for="media_title">Phone<span class="required"></span></label>
                        <input
                            type="text" required class="form-control" name="user_mobile" value="<?php if (isset($user)) {
                            echo $user->user_mobile;
                        } ?>">
                    </div>

                    <div class="form-group "><label for="media_title">Email<span class="required"></span></label>
                        <input
                            type="text" required class="form-control" name="user_email" value="<?php if (isset($user)) {
                            echo $user->user_email;
                        } ?>">


                    </div>
                    <div class="form-group "><label for="media_title">Password<span class="required"></span></label>
                        <input
                            type="text" required class="form-control" name="user_password" value="<?php if (isset($user)) {
                            echo $user->user_password;
                        } ?>">


                    </div>
                    <div class="form-group "><label for="media_title">Address<span class="required"></span></label>
                        <textarea
                            class="form-control" name="user_address"><?php if (isset($user)) {
                                echo $user->user_address;
                            } ?></textarea>


                    </div>


                    <div class="form-group "><label for="media_title">User Status<span class="required"></span></label>
                        <select name="user_status" id="user_status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    
                </div>


                <div class="box-footer">
                    <input type="submit" class="btn btn-success pull-left" value="Update"/>


                </div>
            </form>
        </div>
    </div>


    <script>

        document.forms['user'].elements['user_status'].value = "<?php echo $user->user_status;?>";
        document.forms['user'].elements['affiliate_user'].value = "<?php echo $user->affiliate_user;?>";


    </script>
