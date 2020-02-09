<div class="col-lg-3 col-md-3 col-sm-12 col-12">
    <?php
    $user_id=$this->session->userdata('user_id');

    if(isset($user_id)){
    ?>
    <div class="list-group">
        <a href="<?php echo base_url() ?>affiliate/my_account" class="list-group-item list-group-item-action">My
            Account</a>
        <a href="<?php echo base_url() ?>affiliate/change_password" class="list-group-item list-group-item-action">Changed Password</a>
        <a style="z-index: 100" href="<?php echo base_url() ?>affiliate/order_list"
           class="list-group-item list-group-item-action">My Orders</a>
        <a style="z-index: 100" href="<?php echo base_url() ?>affiliate/edit"
           class="list-group-item list-group-item-action">Account Information
        </a>
        <a style="z-index: 100" href="<?php echo base_url() ?>affiliate" class="list-group-item list-group-item-action">Affiliate
            Program</a>
        <a style="z-index: 100" href="<?php echo base_url() ?>Affiliate/logOut"
           class="list-group-item list-group-item-action mobile_sign_out">Sign
            Out</a>
    </div>

    <?php } ?>

</div>
