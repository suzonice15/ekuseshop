<div class="col-md-offset-0 col-md-12">
    <div class="box box-success ">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if (isset($title)) echo $title ?></h3>
        </div>
        <div class="box-body">
<div class="text-center" style="color: green;" id="add_msg"></div>
<br>

            <div class="table-responsive">

            <table id="example1" class="table table-bordered table-striped">

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
    foreach ($product_delivered as $v_request) {
        $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $v_request->user_f_name . "" . $v_request->user_l_name; ?></td>
            <td><?php echo $v_request->product_id; ?></td>
            <td><?php echo $v_request->date; ?></td>
            <td>
                <a href="#"
                   onclick="approved_product_delivered(<?php echo $v_request->id; ?>)"
                   class="btn btn-warning" title="Inactive">
                    Approved
                </a>
                <a href="#"
                   onclick="cancel_product_delivered(<?php echo $v_request->id; ?>)"
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
    function approved_product_delivered($id) {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>order/OrderController/approved_product_delivered/' + $id,
            success: function (result) {
                if (result) {
                    $('#add_msg').html(result);
                    window.setTimeout(function () {
                        window.location.href = "<?php echo base_url()?>order/OrderController/product_delivered_list";
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
    function cancel_product_delivered($id) {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>order/OrderController/cancel_product_delivered/' + $id,
            success: function (result) {
                if (result) {
                    $('#add_msg').html(result);
                    window.setTimeout(function () {
                        window.location.href = "<?php echo base_url()?>order/OrderController/product_delivered_list";
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