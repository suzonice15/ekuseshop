<style>
    .aw-aff-balance-info {
        margin-top: 25px;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: start;
        -ms-flex-pack: start;
        justify-content: flex-start;
        -webkit-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-align-items: flex-start;
        -ms-align-items: flex-start;
        align-items: flex-start;
        padding-top: 10px;
    }

    .aw-aff-balance-info .balance-element {
        position: relative;
        padding-left: 15px;
        margin-bottom: 40px;
        margin-right: 40px;
    }

    .aw-aff-balance-info .balance-element .balance-label {
        display: block;
        color: #666666;
        font-weight: 400;
        font-style: normal;
        font-size: 13px;
        line-height: 1;
        margin-bottom: 5px;
    }

    .aw-aff-balance-info .balance-element:first-child .balance-label {
        font-size: 14px;
    }

    .aw-aff-balance-info .balance-element .balance-value {
        display: block;
        font-size: 18px;
        font-weight: 600;
        line-height: 1;
    }

    .aw-aff-balance-info .balance-element:first-child .balance-value {
        font-size: 24px;
    }

    .aw-aff-balance-info .balance-element::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        background-color: #999999;
        height: 100%;
        width: 3px;
    }

    .aw-aff-balance-info .balance-element:first-child::before {
        background-color: #669932;
    }

    .message-notice-one {
        margin: 0 0 10px;
        padding: 8px 5px 5px 45px;
        display: block;
        background: #fdf0d5;
        color: #6f4400;
        position: relative;
    }

    .message-notice-one:before {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        font-size: 24px;
        line-height: 24px;
        color: #c07600;
        content: '\f071';
        font-family: 'FontAwesome';
        vertical-align: middle;
        display: inline-block;
        font-weight: normal;
        overflow: hidden;
        speak: none;
        overflow: visible;
        left: 0;
        top: 22px;
        width: 45px;
        position: absolute;
        text-align: center;
        margin-top: -18px;
    }

    .message-notice-two {
        margin: 0 0 10px;
        padding: 8px 5px 5px 45px;
        display: block;
        background: #fdf0d5;
        color: #6f4400;
        position: relative;
    }

    .message-notice-two:before {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        font-size: 24px;
        line-height: 24px;
        color: #c07600;
        content: '\f071';
        font-family: 'FontAwesome';
        margin: -12px 0 0;
        vertical-align: middle;
        display: inline-block;
        font-weight: normal;
        overflow: hidden;
        speak: none;
        overflow: visible;
        left: 0;
        top: 22px;
        width: 45px;
        position: absolute;
        text-align: center;
    }

    .message-notice-one p, .message-notice-two p {
        font-size: 13px;
        margin-bottom: 0px;
        text-align: justify;
    }

    .nav-tabs .nav-item {
        border: 1px solid #b0b0b0;
        background-color: #e4e4e4;
        padding: 6.76px;
        font-size: 14px;
        margin-right: 3px;
    }

    .nav-item .nav-link {
        color: black;
    }
</style>
<?php if ($affiliate_request == 2) { ?>
    <div class="col-lg-9">
        <p style="margin-top: 12px; font-size: 18px; color: black;">Affiliate Program</p>
        <div class="message-notice-one">
            <p>
                The first step is complete! Now, please submit payment details so we could transfer payments to you.
            </p>
        </div>
        <div class="home-nav-tab-wrapper">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#information">Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#promotions">Promotions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#recommendations">Recommendations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#reports">Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#balance">Balance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#transactions">Transactions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#payouts">Payouts</a>
                </li>

            </ul>
            <div class="tab-content">

                <!--=============================================-->
                <!--==============first tab start================-->
                <!--=============================================-->
                <div id="information" class="tab-pane active">
                    <form action="#" id="information_add" method="post">
                        <br>
                        <br>
                        <p>For more information about affiliate program please go to <a href="">Terms &
                                Conditions</a> page.
                        </p>
                        <label><b>Referral website (primary traffic source) *</b></label>
                        <input type="text" name="referral_website" class="form-control">
                        <br>
                        <label><b>Payment Type</b></label>
                        <select class="form-control" name="payment_type" required="required">
                            <option value="">--Please Select--</option>
                            <option value="1">Other</option>
                            <option value="2">bKash Payment</option>
                            <option value="3">Bank Transfer</option>
                            <option value="4">Cash Collection from ekusheshop.com.bd office</option>
                        </select>
                        <br>
                        <label><b>Payment Information *</b></label>
                        <textarea cols="119" rows="3" name="payment_information"></textarea>
                        <span style="font-size: 13px;">Please specify personal payment info, which we could use for payout: PayPal email or any e-wallet payment details.</span>
                        <br>
                        <br>
                        <div id="add_msg_information"
                             style="height: 30px; padding-top: 3px; text-align: center; display: none; background-color: green; color: white;">
                        </div>
                        <br>
                        <input type="submit" class="btn btn-success" value="SAVE">
                    </form>
                </div>
                <!--=============================================-->
                <!--==============first tab end==================-->
                <!--=============================================-->


                <!--=============================================-->
                <!--============second tab start ================-->
                <!--=============================================-->
                <div id="promotions" class="tab-pane fade">

                    <br>
                    <p><b>Code Prefix</b></p>
                    <input type="text" class="form-control" value="siddiq06" readonly="readonly">
                    <p style="font-size: 13px;">Provide any alphanumeric combination as a unique code prefix to
                        be used in coupon codes.
                        Once the code prefix is saved, it can't be changed.</p>
                    <p style="font-size: 13px;">
                        Example: ABC10 - Unique ID; SHOES15OFF - coupon code template; Generated coupon:
                        ABC10-SHOES15OFF</p>

                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th>Campaign</th>
                            <th>Description</th>
                            <th>Commission</th>
                            <th>Coupon Code</th>
                            <th>Link Action</th>
                            <th>Coupon Action</th>
                        </tr>
                        <tr>
                            <td>All Products</td>
                            <td>&nbsp;</td>
                            <td>3%</td>
                            <td>Not generated</td>
                            <td>
                                <a href="#" onclick="single_get_link()" type="button"
                                   class="btn btn-success" data-toggle="modal" data-target="#myModal">GET LINK</a>
                            </td>
                            <td>jj</td>
                        </tr>
                    </table>
                    1 item(s)
                </div>
                <!--=============================================-->
                <!--==============second tab end=================-->
                <!--=============================================-->


                <!--=============================================-->
                <!--==============third tab start=================-->
                <!--=============================================-->
                <div id="recommendations" class="tab-pane fade">
                    <br>
                    <p>
                        To save your time and effort that you would spend searching for products suitable for
                        promotion on your resource, we've gathered our top picks in one place. Check out the list of
                        recommended products to find the ones that work best for you.
                    </p>
                    <br>
                    <label><b>Product Type</b></label>
                    <select style="z-index: 999999999" class="form-control" id="product_type" required="required"
                            onchange="select_product_link()">
                        <option value="">--Please Select--</option>
                        <?php foreach ($all_category as $v_category) { ?>
                            <option
                                value="<?php echo $v_category->category_id; ?>"><?php echo $v_category->category_title; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <p id="product_link_view"></p>

                </div>
                <!--=============================================-->
                <!--==============third tab end==================-->
                <!--=============================================-->


                <!--=============================================-->
                <!--==============fourth tab start===============-->
                <!--=============================================-->
                <div id="reports" class="tab-pane fade">
                    <br>
                    <br>
                    <p style="font-size: 18px; color: black;">Performance by Link</p>
                    <input type="submit" class="btn btn-success" value="FILTERS">
                    <br>
                    <br>
                    <br>
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th>Campaign</th>
                            <th>Traffic Source</th>
                            <th>Hits</th>
                            <th>Orders</th>
                            <th>Buyers</th>
                            <th>EarnedCommissions</th>
                            <th>Conversion</th>
                        </tr>
                        <?php
                        $total = 0;
                        foreach ($my_create_link as $v_link) {
                            $total++;
                            ?>
                            <tr>
                                <td>All Products</td>
                                <td><?php echo $v_link->traffic_source; ?></td>
                                <td>
                                    <?php
                                    $count_hit = $this->MainModel->count_hit_by_user_id($v_link->product_id, $user_id);
                                    echo $count_hit->total_count;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $count_order = $this->MainModel->count_order($v_link->product_id, $user_id);
                                    echo $count_order->total_order;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $count_buy = $this->MainModel->count_buy($v_link->product_id, $user_id);
                                    echo $count_buy->total_buy;
                                    ?>
                                </td>
                                <td>
                                    ৳
                                    <?php
                                    $count_commission1 = $this->MainModel->count_total_commission_by_product($user_id, $v_link->product_id);
                                    if ($count_commission1) {
                                        echo $count_commission1->commission;
                                    } else {
                                        echo "0.00";
                                    }

                                    ?>
                                </td>
                                <td>0%</td>
                            </tr>
                        <?php } ?>
                    </table>
                    <?php echo $total; ?> item(s)
                    <br>
                    <br>
                    <br>
                    <p style="font-size: 18px; color: black;">Performance by Coupon</p>
                    <br>
                    <input type="submit" class="btn btn-success" value="FILTERS">
                    <br>
                    <br>
                    <br>
                    <table class="table table-bordered table-striped table-hover" style="font-size: 13px;">
                        <tr>
                            <th>Campaign</th>
                            <th>Coupon Code</th>
                            <th>Total No of Uses</th>
                            <th>Earned Commissions</th>
                        </tr>
                        <tr>
                            <td>We couldn't find any records.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                    0 item(s)
                </div>
                <!--=============================================-->
                <!--==============fourth tab end=================-->
                <!--=============================================-->

                <!--=============================================-->
                <!--==============five tab start=================-->
                <!--=============================================-->
                <div id="balance" class="tab-pane fade">
                    <?php $count_commission1 = $this->MainModel->count_total_commission_without_completed($user_id);
                    if ($count_commission1->total_commission) {
                        ?>
                        <br>
                        *Note: some text here*
                    <?php } ?>
                    <div class="aw-aff-balance-info">
                        <p class="balance-element">
                            <span class="balance-label" data-bind="text: balance.label">Available Commissions</span>
                        <span class="balance-value" data-bind="text: balance.value">
                             <?php
                             $count_commission = $this->MainModel->count_total_commission($user_id);
                             echo "৳" . round($count_commission->total_commission, 2);
                             ?>
                        </span>
                            <?php if ($count_commission1->total_commission) { ?>
                                <span>(<?php echo $count_commission1->total_commission; ?>)</span>
                            <?php } ?>

                        </p>
                        <?php
                        $total_paid_commission = $this->MainModel->count_total_paid_commission($user_id);
                        $count_request_commission = $this->MainModel->count_total_request_commission($user_id);
                        ?>
                        <p class="balance-element">
                            <span class="balance-label" data-bind="text: balance.label">Pending Commissions</span>
                        <span class="balance-value"
                              data-bind="text: balance.value">৳
                            <?php echo $count_commission->total_commission - ($count_request_commission->total_commission_request + $total_paid_commission->total_commission_request); ?>
                        </span>
                        </p>
                        <p class="balance-element">
                            <span class="balance-label" data-bind="text: balance.label">Processed for Payout</span>
                        <span class="balance-value"
                              data-bind="text: balance.value">৳
                            <?php echo round($count_request_commission->total_commission_request, 2); ?>
                        </span>
                        </p>
                        <p class="balance-element">
                            <span class="balance-label" data-bind="text: balance.label">Total Paid</span>
                        <span class="balance-value" data-bind="text: balance.value">
                                ৳
                            <?php echo round($total_paid_commission->total_commission_request, 2); ?>
                        </span>
                        </p>
                    </div>
                    <br>
                    <table class="table table-bordered table-striped table-hover" style="font-size: 13px;">
                        <tr>
                            <th>Campaign</th>
                            <th>Qty of Ordered Items</th>
                            <th>Commission Amount</th>
                            <th>Commission Registration Date</th>
                            <th>Commission Availability Date</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                    0 item(s)
                </div>
                <!--=============================================-->
                <!--===============five tab end==================-->
                <!--=============================================-->


                <!--=============================================-->
                <!--===============six tab start=================-->
                <!--=============================================-->
                <div id="transactions" class="tab-pane fade">
                    <br>
                    <input type="submit" class="btn btn-success" onclick="request_from()" value="Transaction Request">
                    <br>
                    <br>
                    <div id="request_from"></div>
                    <br>
                    <table class="table table-bordered table-striped table-hover" style="font-size: 13px;">
                        <tr>
                            <th>Transaction ID</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Transaction Type</th>
                            <th>Details</th>
                        </tr>
                        <?php
                        $total_request = 0;
                        foreach ($all_request as $v_request) {
                            $total_request++;
                            ?>
                            <tr>
                                <td><?php echo $v_request->id; ?></td>
                                <td><?php echo $v_request->date; ?></td>
                                <td><?php echo $v_request->commission_amount; ?></td>
                                <td>
                                    <?php
                                    if ($v_request->type == 1) {
                                        echo "Other";
                                    } else if ($v_request->type == 2) {
                                        echo "bKash Payment";
                                    } else if ($v_request->type == 3) {
                                        echo "Bank Transfer";
                                    } else if ($v_request->type == 4) {
                                        echo "Cash Collection from ekusheshop.com.bd office";
                                    } else {
                                        echo "Nothing";
                                    } ?>
                                </td>
                                <td><?php echo $v_request->details; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                    <?php echo $total_request; ?> item(s)
                </div>
                <!--=============================================-->
                <!--===============six tab end===================-->
                <!--=============================================-->


                <!--=============================================-->
                <!--===============seven tab start===============-->
                <!--=============================================-->

                <div id="payouts" class="tab-pane fade">
                    <div class="aw-aff-balance-info">
                        <p class="balance-element">
                            <span class="balance-label" data-bind="text: balance.label">Available Commissions</span>
                        <span class="balance-value" data-bind="text: balance.value">
                              <?php
                              $count_commission = $this->MainModel->count_total_commission($user_id);
                              echo "৳" . round($count_commission->total_commission, 2);
                              ?>
                        </span>
                        </p>
                        <?php
                        $total_paid_commission = $this->MainModel->count_total_paid_commission($user_id);
                        $count_request_commission = $this->MainModel->count_total_request_commission($user_id);
                        ?>
                        <p class="balance-element">
                            <span class="balance-label" data-bind="text: balance.label">Pending Commissions</span>
                        <span class="balance-value"
                              data-bind="text: balance.value">৳
                            <?php echo $count_commission->total_commission - ($count_request_commission->total_commission_request + $total_paid_commission->total_commission_request); ?>
                        </span>
                        </p>
                        <p class="balance-element">
                            <span class="balance-label" data-bind="text: balance.label">Processed for Payout</span>
                        <span class="balance-value"
                              data-bind="text: balance.value">৳
                            <?php echo round($count_request_commission->total_commission_request, 2); ?>
                        </span>
                        </p>
                        <p class="balance-element">
                            <span class="balance-label" data-bind="text: balance.label">Total Paid</span>
                        <span class="balance-value" data-bind="text: balance.value">
                                ৳
                            <?php echo round($total_paid_commission->total_commission_request, 2); ?>

                        </span>
                        </p>
                    </div>
                    <div class="message-notice-two">
                        <p>
                            ৳500.00 is left to reach the minimum balance for a payout. Check out the
                            availability
                            dates of your pending commissions to know when you'll be able to request money
                            payout.
                        </p>
                    </div>
                    <p style="font-size: 18px; color: black;">Payment History</p>
                    <table class="table table-bordered table-striped table-hover" style="font-size: 13px;">
                        <tr>
                            <th>Payout ID</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Amount</th>
                        </tr>
                        <?php
                        $total_paid = 0;
                        foreach ($all_paid_request as $v_paid) {
                            $total_paid++;
                            ?>
                            <tr>
                                <td><?php echo $v_paid->id; ?></td>
                                <td><?php echo $v_paid->user_f_name . " " . $v_paid->user_l_name; ?></td>
                                <td>Completed</td>
                                <td><?php echo $v_paid->commission_amount; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                    <?php echo $total_paid; ?> item(s)
                </div>
                <!--=============================================-->
                <!--================seven tab end================-->
                <!--=============================================-->
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="col-lg-9">
        <div id="information" class="tab-pane active">
            <form action="#" id="affiliate_request" method="post">
                <br>
                <label><b>Phone Number*</b></label>
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <input type="text" name="phone_number" required="required" class="form-control">
                <br>
                <label><b>Email*</b></label>
                <input type="text" name="email" required="required" class="form-control">
                <label><b>Present Address*</b></label>
                <input type="text" name="present_address" required="required" class="form-control">
                <br>
                <label><b>Permanent Address*</b></label>
                <input type="text" name="permanent_address" required="required" class="form-control">
                <br>
                <br>
                <div id="add_msg"
                     style="height: 30px; padding-top: 3px; text-align: center; display: none; background-color: green; color: white;">
                </div>
                <br>
                <input type="submit" class="btn btn-success" value="SAVE">
            </form>
        </div>
    </div>
<?php } ?>

<div class="container">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top: 115px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title" style="text-align: center;">Affiliate Link Generate</h3>
                </div>
                <div class="modal-body" id="load_data">
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#information_add').submit(function () {
            var dataString = $('#information_add').serialize();
            $.ajax({
                type: "POST",
                url: '<?php echo base_url() ?>affiliate/create_information',
                data: dataString,
                success: function (result) {
                    if (result) {
                        $('#add_msg_information').show();
                        $('#add_msg_information').html(result);
                        return false;
                    } else {
                        return false;
                    }
                }
            });
            return false;
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#affiliate_request').submit(function () {
            var dataString = $('#affiliate_request').serialize();
            $.ajax({
                type: "POST",
                url: '<?php echo base_url() ?>affiliate/create_affiliate_request',
                data: dataString,
                success: function (result) {
                    if (result) {
                        $('#add_msg').show();
                        $('#add_msg').html(result);
                        return false;
                    } else {
                        return false;
                    }
                }
            });
            return false;
        });
    });
</script>

<script>
    function select_product_link() {
        var product_type = $('#product_type').val();
        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>affiliate/load_product_link_view/' + product_type,
            success: function (result) {
                if (result) {
                    $('#product_link_view').html(result);
                    return false;
                } else {
                    return false;
                }
            }
        });
        return false;
    }
</script>

<script>
    function get_link($id) {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>affiliate/load_product_link_from/' + $id,
            success: function (result) {
                if (result) {
                    $('#load_data').html(result);
                    return false;
                } else {
                    return false;
                }
            }
        });
        return false;
    }
</script>
<script>
    function single_get_link() {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>affiliate/load_product_single_link_from',
            success: function (result) {
                if (result) {
                    $('#load_data').html(result);
                    return false;
                } else {
                    return false;
                }
            }
        });
        return false;
    }
</script>

<script>
    function request_from() {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>affiliate/load_request_from',
            success: function (result) {
                if (result) {
                    $('#request_from').html(result);
                    return false;
                } else {
                    return false;
                }
            }
        });
        return false;
    }
</script>
