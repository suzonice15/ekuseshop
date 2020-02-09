<div class="col-md-offset-0 col-md-12">
    <div class="box box-success ">
        <div class="box-body">
            <div class="table-responsive">
                <div class="text-center" style="color: green;" id="add_msg"></div>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>SL NO</th>
                        <th>Affiliate Name</th>
                        <th>Product ID</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <?php
                    $i = 0;
                    foreach ($request as $v_request) {
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $v_request->user_f_name . "" . $v_request->user_l_name; ?></td>
                            <td><?php echo $v_request->user_email; ?></td>
                            <td><?php echo $v_request->user_mobile; ?></td>
                            <td>
                                <a href="#"
                                   onclick="approved_affiliate_request(<?php echo $v_request->user_id; ?>)"
                                   class="btn btn-warning" title="Inactive">
                                    Approved
                                </a>
                                <a href="#"
                                   onclick="cancel_affiliate_request(<?php echo $v_request->user_id; ?>)"
                                   class="btn btn-danger" title="Inactive">
                                    Cancel
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

            </div>
        </div>
    </div>
</div>

<script>
    function approved_affiliate_request($id) {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>order/OrderController/approved_affiliate_request/' + $id,
            success: function (result) {
                if (result) {
                    $('#add_msg').html(result);
                    window.setTimeout(function () {
                        window.location.href = "<?php echo base_url()?>affiliate-request";
                    }, 2000);
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
    function cancel_affiliate_request($id) {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>order/OrderController/cancel_affiliate_request/' + $id,
            success: function (result) {
                if (result) {
                    $('#add_msg').html(result);
                    window.setTimeout(function () {
                        window.location.href = "<?php echo base_url()?>affiliate-request";
                    }, 2000);
                    return false;
                } else {
                    return false;
                }
            }
        });
        return false;
    }
</script>