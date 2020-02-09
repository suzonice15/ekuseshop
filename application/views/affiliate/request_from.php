<form action="#" id="amount_request" method="post">
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label>Select Type:</label>
                <select class="form-control" name="type" required="required">
                    <option value="">--Please Select--</option>
                    <option value="1">Other</option>
                    <option value="2">bKash Payment</option>
                    <option value="3">Bank Transfer</option>
                    <option value="4">Cash Collection from ekusheshop.com.bd office</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Amount:</label>
                <input id="commission_amount" required="required" name="commission_amount" type="text" class="form-control"
                       placeholder="Amount ....">
            </div>
            <div class="col-md-4">
                <label>Date:</label>
                <input id="date" name="date" autocomplete="off" required="required" type="text" class="form-control from_date"
                       placeholder="date ....">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <label>Details:</label>
                <textarea name="details" class="form-control"></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-md-12">
                <input type="submit" class="form-control btn btn-success" value="Submit">
            </div>
        </div>
    </div>
    </br>
    <div id="add_msg" class="text-center"></div>
</form>

<script>
    $('body').on('focus', ".from_date", function () {
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeYear: true, changeMonth: true, yearRange: "1970:2100"});
    });
</script>

<script>
    $(document).ready(function () {
        $("#amount_request").submit(function () {
            var dataString = $('#amount_request').serialize();
            $.ajax({
                type: "POST",
                url: '<?php echo base_url() ?>affiliate/amount_request_entry',
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