<br>
<div class="text-center" style="color: green;" id="add_msg"></div>
<br>
<table class="table table-bordered table-striped table-hover">
    <tr>
        <th>SL NO</th>
        <th>User Name</th>
        <th>Date</th>
        <th>Amount</th>
        <th>Type</th>
        <th>Details</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php
    $i = 0;
    foreach ($payment_request as $v_request) {
        $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $v_request->user_f_name . "" . $v_request->user_l_name; ?></td>
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
            <td>
                <?php
                if ($v_request->status == 1) {
                    echo "<p style='color: red'>Pending</p>";
                } else {
                    echo "<p style='color: green'>Approved</p>";
                } ?>
            </td>
            <td>
                <?php
                if ($v_request->status == 1) { ?>
                    <a href="#"
                       onclick="approved_payment(<?php echo $v_request->id; ?>)"
                       class="btn btn-warning" title="Inactive">
                        Approved
                    </a>
                <?php } else {
                    ?>
                    <a href="#" disabled="disabled"
                       class="btn btn-warning" title="Inactive">
                        Approved
                    </a>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>

<script>
    function approved_payment($id) {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>order/OrderController/approved_payment/' + $id,
            success: function (result) {
                if (result) {
                    $('#add_msg').html(result);
                    window.setTimeout(function () {
                        window.location.href = "<?php echo base_url()?>order/OrderController/all_payment_request";
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