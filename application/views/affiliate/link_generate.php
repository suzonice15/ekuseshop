<?php foreach ($product_link as $v_product_link) { ?>
    <form action="#" method="post" id="add_link_generate_frm">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Insert the link for a particular product *:</label>
                    <input type="hidden" name="id" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="link_name" value="<?php echo $v_product_link->product_name; ?>">
                    <input type="text" class="form-control"
                           value="<?php echo base_url() . "product/" . $v_product_link->product_name; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Traffic source:</label>
                    <input type="text" name="traffic_source" class="form-control">
                </div>
            </div>
        </div>

        <div class="row" style="display: none;" id="show_link_field">
            <div class="col-md-12">
                <div class="form-group">
                    <label style="color: green;">Just copy & paste this link anywhere you want!:</label>
                    <input type="text" id="show_value" class="form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-5">
                <input type="submit" class="form-control btn btn-success" value="Generate Link">
            </div>
        </div>
        <div id="add_msg" class="text-center" style="display: none; color: green;">
            Your link is generated successfully.
        </div>
    </form>
<?php } ?>

<script>
    $(document).ready(function () {
        $('#add_link_generate_frm').submit(function () {
            var dataString = $('#add_link_generate_frm').serialize();
            $.ajax({
                type: "POST",
                url: '<?php echo base_url() ?>affiliate/link_generate',
                data: dataString,
                success: function (result) {
                    if (result) {
                        $('#show_link_field').show();
                        $('#add_msg').show();
                        $('#show_value').val(result);
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

