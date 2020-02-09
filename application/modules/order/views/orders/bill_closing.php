<div class="col-md-offset-0 col-md-12">
    <div class="box box-success ">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if (isset($title)) echo $title ?></h3>
        </div>
        <div class="box-body">
<div class="text-center" style="color: green;" id="add_msg"></div>
<br>
<form action="#" id="closing_bill" method="post">
    <div class="table-responsive">

    <table id="example1" class="table table-bordered table-striped">

       <thead>
        <tr>
            <th>SL NO</th>
            <th>Affiliate Name</th>
            <th>Date From</th>
            <th>To Date</th>
            <th>Current Amount</th>
            <th>Sales Price</th>
            <th>Commission</th>
            <th>Total Amount</th>
        </tr>
       </thead>
        <?php
        $i = 0;
        foreach ($bill_closing as $v_request) {
            $i++;
            ?>
            <tbody>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $v_request->user_f_name . "" . $v_request->user_l_name; ?></td>
                <td><?php echo $from_date ?></td>
                <td><?php echo $to_date ?></td>
                <td><?php echo $v_request->current_amount; ?></td>
                <td>
                    <?php
                    $total_count = 0;
                    $result = $this->MainModel->select_all_product_price($from_date, $to_date, $v_request->user_id);
                    foreach ($result as $v_price) {
                        if ($v_price->discount_price > 0) {
                            $total_count += $v_price->discount_price;
                        } else {
                            $total_count += $v_price->product_price;
                        }
                    }
                    echo $total_count;
                    ?>
                </td>
                <td>
                    <?php
                    $set_commission = 0;
                    if (($total_count > 149999) and ($total_count <= 399999)) {
                        $set_commission = (($total_count * 1) / 100);
                        echo(($total_count * 1) / 100);
                    } else if ($total_count > 399999) {
                        $set_commission = (($total_count * 2) / 100);
                        echo(($total_count * 2) / 100);
                    } else {
                        echo "0.00";
                        $set_commission = 0;
                    }
                    ?>
                    <input type="hidden" name="user_id[]" value="<?php echo $v_request->user_id; ?>">
                    <input type="hidden" name="product_id[]" value="10000000">
                    <input type="hidden" name="commission[]" value="<?php echo $set_commission; ?>">
                    <input type="hidden" name="to_date[]" value="<?php echo $to_date; ?>">
                    <input type="hidden" name="closing_status[]" value="<?php echo $closing_status; ?>">
                </td>
                <td><?php echo $v_request->current_amount + $set_commission; ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="7">&nbsp;
                <input type="hidden" value="<?php echo $i; ?>" name="total_num_of_fields">
            </td>
            <td>
                <?php
                if ($check_closing == 1) { ?>
                    <input type="submit" class="btn btn-success" value="Confirm">
                <?php } else { ?>
                    <input type="submit" class="btn btn-success" disabled="disabled" value="Confirm">
                <?php } ?>
            </td>
        </tr>
            </tbody>
    </table>
    </div>
</form>

        </div>
    </div>
    </div>

<script>
    $('#closing_bill').submit(function () {
        var dataString = $('#closing_bill').serialize();
        $.ajax({
            type: 'post',
            url: '<?php echo base_url()?>order/OrderController/bill_closing_confirm',
            data: dataString,
            success: function (result) {
                if (result) {
                    $('#add_msg').html(result);
                    window.setTimeout(function () {
                        window.location.href = "<?php echo base_url()?>order/OrderController/bill_closing";
                    }, 2000);
                    return false;
                } else {
                    return false;
                }
            }
        });
        return false;
    });
</script>