<div class="col-md-offset-0 col-md-12">
    <div class="box box-success ">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if (isset($title)) echo $title ?></h3>


        </div>
        <div class="box-body">


            <form action="<?php echo base_url() ?>setting/SettingController/default_update" method="post"
                  enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group ">
                        <label for="site_title">Site Title</label>
                        <input type="text" class="form-control" name="site_title" id="site_title"
                               value="<?= get_option('site_title') ?>">
                    </div>

                    <div class="form-group >">
                        <label for="logo">Logo(size 280 * 80)</label>
                        <input type="text" class="form-control" name="logo" id="logo" value="<?= get_option('logo') ?>">
                    </div>

                    <div class="form-group">
                        <label for="icon">Icon(size 64 * 64 )</label>
                        <input type="text" class="form-control" name="icon" id="icon" value="<?= get_option('icon') ?>">
                    </div>

                    <div class="form-group ">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone"
                               value="<?= get_option('phone') ?>">
                    </div>
                    <div class="form-group ">
                        <label for="phone">Home promosion title</label>
                        <input type="text" class="form-control" name="home_pomosion_title" id="phone"
                               value="<?= get_option('home_pomosion_title') ?>">
                    </div>

                    <div class="form-group ">
                        <label for="phone">Home promosion sub title</label>
                        <input type="text" class="form-control" name="home_pomosion_sub_title" id="phone"
                               value="<?= get_option('home_pomosion_sub_title') ?>">
                    </div>
                    <div class="form-group ">
                        <label for="phone">Home promosion link</label>
                        <input type="text" class="form-control" name="home_pomosion_link" id="phone"
                               value="<?= get_option('home_pomosion_link') ?>">
                    </div>



                    <div hidden class="form-group ">
                        <label for="footer">Phone to Order</label>
                        <textarea class="form-control" rows="5"
                                  name="phone_order"><?= get_option('phone_order') ?></textarea>
                    </div>

                    <div hidden class="form-group ">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                               value="<?= get_option('email') ?>">
                    </div>

                    <div hidden class="form-group ">
                        <label for="admin_email">Admin Email</label>
                        <input type="text" class="form-control" name="admin_email" id="admin_email"
                               value="<?= get_option('admin_email') ?>">
                    </div>

                    <div class="form-group  ">
                        <label for="shipping_charge_in_dhaka">Shipping Charge In Dhaka</label>
                        <input type="text" class="form-control" name="shipping_charge_in_dhaka"
                               id="shipping_charge_in_dhaka" value="<?= get_option('shipping_charge_in_dhaka') ?>">
                    </div>

                    <div class="form-group ">
                        <label for="shipping_charge_out_of_dhaka">Shipping Charge Out Of Dhaka</label>
                        <input type="text" class="form-control" name="shipping_charge_out_of_dhaka"
                               id="shipping_charge_out_of_dhaka"
                               value="<?= get_option('shipping_charge_out_of_dhaka') ?>">
                    </div>

                    <div hidden class="form-group ">
                        <label for="support_box">Support Box</label>
                        <textarea class="form-control" rows="15"
                                  name="support_box"><?= get_option('support_box') ?></textarea>
                    </div>

                    <div class="form-group ">
                        <label for="support_box">Delivery Timing</label>
                        <textarea class="form-control" rows="2"
                                  name="delevery_timing"><?= get_option('delevery_timing') ?></textarea>
                    </div>

                    <div class="form-group ">
                        <label for="support_box">Customer Service</label>
                        <textarea class="form-control" rows="2"
                                  name="customer_service"><?= get_option('customer_service') ?></textarea>
                    </div>

                    <div class="form-group ">
                        <label for="support_box">Easy Returns</label>
                        <textarea class="form-control" rows="2"
                                  name="easy_return"><?= get_option('easy_return') ?></textarea>
                    </div>

                    <div class="form-group ">
                        <label for="support_box">Bkash Pament Message</label>
                        <textarea class="form-control" rows="2"
                                  name="bkash_payment"><?= get_option('bkash_payment') ?></textarea>
                    </div>


                    <div hidden class="form-group ">
                        <label for="footer">Footer</label>
                        <textarea class="form-control" rows="15" name="footer"><?= get_option('footer') ?></textarea>
                    </div>

                    <div class="form-group ">
                        <label for="copyright">Copyright</label>
                        <input type="text" class="form-control" name="copyright" id="copyright"
                               value="<?= get_option('copyright') ?>">
                    </div>

                    <div class="form-group ">
                        <label for="default_product_terms">Default Product Terms</label>
                        <textarea class="form-control" rows="10"
                                  name="default_product_terms"><?= get_option('default_product_terms') ?></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right">Update</button>
                </div>
            </form>

        </div>
    </div>





