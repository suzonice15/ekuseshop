<div class="col-md-offset-0 col-md-12">
    <div class="box box-success ">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if (isset($title)) echo $title ?></h3>
        </div>
        <div class="box-body">

<form action="#" id="set_date" method="post">
    <div class="form-group">
        <div class="row">
            <div class="col-md-3">
                <label>From Date</label>
                <input id="set_time" value="<?php echo $from_date; ?>" name="from_date" autocomplete="off"
                       required="required" type="text"
                       class="form-control">
            </div>
            <div class="col-md-3">
                <label>To Date</label>
                <input id="set_time" value="<?php echo $to_date; ?>" name="to_date" autocomplete="off"
                       required="required" type="text"
                       class="form-control">
            </div>
            <div class="col-md-3">
                <label>Closing Status</label>
              <select name="status" required="required" class="form-control">
                  <option value="">Select One</option>
                  <option value="1">1st Slab</option>
                  <option value="2">2nd Slab</option>
                  <option value="3">Final</option>
              </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <div class="col-md-4">
                <input type="submit" class="form-control btn btn-success" value="Submit">
            </div>
        </div>
    </div>
    <br>
    <div id="add_msg" class="text-center"></div>
</form>
</div>
</div>
</div>
<script>
    $(document).ready(function () {
        $("#set_date").submit(function () {
            var dataString = $('#set_date').serialize();
            $.ajax({
                type: "POST",
                url: '<?php echo base_url() ?>order/OrderController/update_closing_date',
                data: dataString,
                success: function (result) {
                    if (result) {
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