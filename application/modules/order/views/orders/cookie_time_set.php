<div class="col-md-offset-0 col-md-12">
    <div class="box box-success ">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if (isset($title)) echo $title ?></h3>
        </div>
        <div class="box-body">

<form action="#" id="set_time" method="post">
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label>Set Cookies activities days</label>
                <input id="set_time" value="<?php echo $cookies_time;?>" name="set_time" autocomplete="off" required="required" type="text"
                       class="form-control from_date"
                       placeholder="Set time....">
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
        $("#set_time").submit(function () {
            var dataString = $('#set_time').serialize();
            $.ajax({
                type: "POST",
                url: '<?php echo base_url() ?>order/OrderController/set_cookies_time',
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