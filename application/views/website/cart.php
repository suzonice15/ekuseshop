<?php
$cart_items = 0;

foreach ($this->cart->contents() as $key => $val) {
    if (!is_array($val) OR !isset($val['price']) OR !isset($val['qty'])) {
        continue;
    }

    $cart_items += $val['qty'];
}
if ($user) {
    $firstname = $user->user_f_name;
    $last_name = $user->user_l_name;
    $name = $firstname . ' ' . $last_name;
    $user_email = $user->user_email;
    $user_mobile = $user->user_mobile;
    $user_address = $user->user_address;


}
?>

<style>

    .decrement_class {
        background-color:
            red;

        display: inline;

        text-align: right;

        margin-top: -23px;

        position: relative;

        top: -21px;

        left: 62px;

        color:
            white;

        cursor: pointer;
    }
    .quantity_value{
        display: inline-block;
        margin-left: 5px;
    }



    @media (max-width: 634px) {
        .decrement_class {
            background-color: red;
            display: inline;
            text-align: right;
            margin-top: -23px;
            position: relative;
            top: -3px;
            left: 1px;
            color: white;
        }
   .quantity_value {
        margin-left: -28px;
        margin-top: 18px;
        display: inline-block;
    }

    }

</style>

<br>


<div class="container container-fullwidth">

    <div class="row">
        <?php if (!empty($cart_items)) { ?>

            <div class="col-md-12 col-12 ">


                <div class="card">
                    <div class="card-header">Order Review
                    </div>
                    <div class="card-body">


					<span class="checkout-fields">


							<div class="checkoutstep">
                                <div class="cart-info" >
<div style="overflow-x:scroll;">
                                    <table class="table table-striped table-bordered" >
                                        <tbody>
                                        <tr>
                                            <th width="5%" class="name">Sl</th>
                                            <th   width="10%"  class="name">Products</th>
                                            <th  width="10%" class="name">Code</th>
                                            <th  width="10%" class="name">Quantity</th>
                                            <th   width="30%" class="name">Product Price</th>
                                            <th   width="20%" class="name">Total</th>
                                            <th   width="5%" class="total text-right">Remove </th>
                                        </tr>

                                        <?php
                                        $quntity = 0;
                                        $count=0;

                                        foreach ($this->cart->contents() as $items) {
                                            $featured_image = get_product_meta($items['id'], 'featured_image');
                                            $featured_image = get_media_path($featured_image, 'thumb');

                                            $quntity = $quntity + $items['qty'];
                                          $link= get_product_link($items['id']);
                                            $_product_title = get_product_title($items['id']);
                                            $_product_title = substr($_product_title, 0, 22) . '...';


                                            ?>
                                            <tr id="<?= $items['rowid'] ?>">
                                                <td>


                                                    <?php echo ++$count; ?>
                                                </td>
                                                <td>
                                                    <img src="<?= $featured_image ?>" width="30">

                                                   <a href="<?= $link?>" target="_blank"> <?= $_product_title ?>
                                                </td>
                                                <td>
                                                    <?= get_sku_code($items['id']) ?>

                                                </td>

                                                <td>
                                                    <div class="quantity-action ">
                                                        <div class="qtyplus col-md-1 col-6"
                                                             style="background-color: green;color: white;cursor: pointer;display: inline;"
                                                             onclick="IncrementFunction('quantity_value_<?= $items['id'] ?>','<?= $items['rowid'] ?>')">
                                                            +
                                                        </div>
                                                        <div class="col-md-1" style="margin-top: -21px;
margin-left: 20px;">
	<span
        id="quantity_value_<?= $items['id'] ?>"
        class="quantity_value"><?= $items['qty'] ?></span>
                                                        </div>


                                                        <div
                                                            onclick="DecrementFunction('quantity_value_<?= $items['id'] ?>','<?= $items['rowid'] ?>')"
                                                            class="qtyminus  decrement_class col-md-1 col-6"
                                                            data-action_type="minus">-
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
													<span
                                                        id="per_poduct_price"> ৳ <?= $this->cart->format_number($items['price']) ?></span>

                                                </td>
                                                <td>
												<span id="per_poduct_total_price_<?= $items['id'] ?>">
												 ৳ <?= $this->cart->format_number($items['subtotal']) ?>
													</span>



                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                       onclick="CartDataRemove('<?= $items['rowid'] ?>')"
                                                       style="color:red ;font-weight: bold;padding: 2px 5px;margin-left: 12px;">
                                                        <i class="fa fa-remove" title="Remove"></i>
                                                    </a>
                                                </td>


                                                <input type="hidden"
                                                       name="products[items][<?php echo $items['id'] ?>][featured_image]"
                                                       value="<?php echo $featured_image ?>">
                                                <input type="hidden" id="product_quantity"
                                                       name="products[items][<?php echo $items['id'] ?>][qty]"
                                                       value="<?php echo $items['qty'] ?>">
                                                <input type="hidden" id="product_price"
                                                       name="products[items][<?php echo $items['id'] ?>][price]"
                                                       value="<?php echo $this->cart->format_number($items['price']) ?>">
                                                <input type="hidden"
                                                       name="products[items][<?php echo $items['id'] ?>][subtotal]"
                                                       value="<?php echo $this->cart->format_number($items['subtotal']) ?>">
                                                <input type="hidden"
                                                       name="products[items][<?php echo $items['id'] ?>][size]"
                                                       value="<?php echo $items['options']['Size'] ?>">
                                                <input type="hidden"
                                                       name="products[items][<?php echo $items['id'] ?>][color]"
                                                       value="<?php echo $items['options']['Color'] ?>">


                                                <input type="hidden"
                                                       name="products[items][<?php echo $items['id'] ?>][name]"
                                                       value="<?php echo get_product_title($items['id']) ?>">
                                                <input type="hidden"
                                                       name="product_id[]"
                                                       value="<?php echo $items['id']; ?>">
                                                <input type="hidden" name="checkout_type" value="cash_on_delivery">

                                                <input type="hidden" class="product_name"
                                                       value="<?php echo get_product_title($items['id']) ?>"/>
                                                <input type="hidden" class="product_price"
                                                       value="<?php echo $this->cart->format_number($items['price']) ?>"/>
                                                <input type="hidden" class="product_color"
                                                       value="<?php echo $items['options']['Color']; ?>"/>
                                                <input type="hidden" class="product_size"
                                                       value="<?php echo $items['options']['Size']; ?>"/>
                                                <input type="hidden" class="product_qty"
                                                       value="<?php echo $items['qty']; ?>"/>
                                                <input type="hidden" class="product_featured_image"
                                                       value="<?php echo $featured_image; ?>"/>


                                            </tr>


                                            <tr>
                                                <input type="hidden" class="shipping_charge_in_dhaka"
                                                       value="<?php echo get_product_delevery_price_in_dhaka($items['id']) ?>">
                                                <input type="hidden" class="shipping_charge_out_of_dhaka"
                                                       value="<?php echo get_product_delevery_price_out_dhaka($items['id']) ?>">
                                            </tr>


                                        <?php } ?>

                                        </tbody>
                                    </table>

</div>


                                    <input type="hidden" id="quantity_list" name="quantity_list"
                                           value="<?php echo $quntity; ?>">


                                    <table class="table table-striped table-bordered review_cost">
                                        <tbody>
                                        <?php


                                        $order_total = $this->cart->total();
                                        ?>
                                        <input type="hidden" name="order_total"
                                               value="<?php echo $this->cart->format_number($order_total) ?>">



                                        <tr>
                                            <td>
                                                <span class="extra bold totalamout">Total</span>
                                            </td>
                                            <td class="text-right">
													<span class="bold totalamout">৳ <span
                                                            id="total_cost"><?= $this->cart->format_number($order_total) ?></span></span>


                                                <input type="hidden" name="checkout_type" value="cash_on_delivery">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
									  <a style="margin-left: 1px;" href="<?php echo base_url()?>chechout"  class="btn btn-primary btn-sm add_to_cart_cart_page  mobile_add_to_cart ">Checkout</a>


                    <a style="background-color:red;"  href="<?php echo base_url()?>"  class="cart_mobile_page btn btn-primary btn-sm add_to_cart_cart_page  mobile_add_to_cart  " >continue shopping</a>
                                </div>
                            </div>
                    </div>
                    </span>
                    </form>
                </div>
              

            </div>
        <?php } else { ?>
            <div class="col-md-12 text-center"><a href="<?php echo base_url() ?>"><img style="margin-bottom: -68px"
                                                                                       src="<?php echo base_url() ?>images/stop.png"/></a>
            </div>
            <div class="col-md-12 mt-5 text-center">
                <h1 class="text-danger text-center">You have no product to checkout.
                </h1>
                <a class="text-center text-capitalize btn btn-info" href="<?php echo base_url() ?>"> back to home</a>
            </div>
        <?php } ?>

    </div>

</div>
<input type="hidden" id="order_id" value="">

<script>
    $('#city').change(function () {
        var order_area = $(this).children("option:selected").val();

        if (order_area == 'Dhaka') {

            var charge = 0;
            $('.shipping_charge_in_dhaka').each(function () {
                charge += Number($(this).val());
            });
            var quantity_list = $('#quantity_list').val();
            charge=charge*quantity_list;
            if (quantity_list > 2) {
                charge = 0
            }
            var total_cost = $('#subtotal_cost').text();
            var total = parseFloat(charge) + parseFloat(total_cost.replace(/,/g, ''));
            $('#delivery_cost').text(charge);
            $('#total_cost').text(total.toFixed(2));
            $('input[name=order_total]').val(total);
            $('#shipping_charge').val(charge);

            $('#cash_on_delevery').show();
            $('#cash_on_delevery_text').show();

        } else {

            $('#hide_bkash_payment').show();

            var charge = 0;
            $('.shipping_charge_out_of_dhaka').each(function () {
                charge += Number($(this).val());
            });

            var quantity_list = $('#quantity_list').val();
            charge=charge*quantity_list;
            if (quantity_list > 2) {
                charge = 0
            }
            var total_cost = $('#subtotal_cost').text();
            var total = parseFloat(charge) + parseFloat(total_cost.replace(/,/g, ''));
            $('#delivery_cost').text(charge);
            $('#total_cost').text(total.toFixed(2));
            $('input[name=order_total]').val(total);
            $('#shipping_charge').val(charge);
            $('#cash_on_delevery').hide();
            $('#cash_on_delevery_text').hide();


        }

    });

</script>

<script>

    $('.payment_class_suzon').click(function () {
        var payment = $(this).val();
        if (payment == 'bKash') {
            $('#hide_bkash_payment').show();

        } else {
            $('#hide_bkash_payment').hide();

        }
    });
    $('#hide_bkash_payment').hide();


    $('#bKash').click(function () {
        var bkash = $('#bKash').val()
        if (bkash == 'bKash') {
            $('#hide_bkash_payment').show();

        } else {
            $('#hide_bkash_payment').hide();

        }
    });

    $("#ship_to_billing,#billing_address1").change(function () {

        if ($(this).prop('checked')) {
            var deleveryAdress = $("#shipping_address1").val();

            $("#shipping_address2").val(deleveryAdress);
        } else {
            $("#shipping_address2").val("");
        }
    });
</script>

<script>


    function IncrementFunction(Obj, rowid) {
        var id_list = Obj.split("_");
        var id = id_list[2];


        var quantity = document.getElementById(Obj).innerHTML;
        //var quantity = Number(x) + 1;
        if (quantity) {
            quantity++;
            quantity = document.getElementById(Obj).innerHTML = quantity;
        }

        var row_id = rowid;
        //var action_type=jQuery(this).attr('data-action_type');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '<?php echo base_url() ?>ajax/update_to_cart',
            data: {rowid: rowid, quantity: quantity},
            success: function (data) {
                var total = data.total_amount;
                $('input[name=order_total]').val(total);
                $('#subtotal_cost').text(data.total_amount.toFixed(2));
                $('#total_product_price').text(data.total_amount);
                var unit = $('#per_poduct_price').text();
                var total_product_price = parseFloat(unit * quantity);
                $('#per_poduct_total_price_' + id + '').text(total_product_price.toFixed(2));
                $('#total_product_price').val(total_product_price);
                $('#product_price').val(total_product_price.toFixed(2));
                $('#product_quantity').val(quantity);
                location.reload(true);

            }


        });


    }

    function DecrementFunction(Obj, rowid) {
        var x = document.getElementById(Obj).innerHTML;
        var quantity = Number(x) - 1;
        var row_id = rowid;
        var id_list = Obj.split("_");
        var id = id_list[2];


        if (quantity >= 1) {
            document.getElementById(Obj).innerHTML = quantity;

            $.ajax({
                type: "POST",
                dataType: "json",
                url: '<?php echo base_url() ?>ajax/update_to_cart',
                data: {rowid: rowid, quantity: quantity},
                success: function (data) {
                    var total = data.total_amount;
                    $('input[name=order_total]').val(total);
                    $('#subtotal_cost').text(data.total_amount.toFixed(2));
                    $('#total_product_price').text(data.total_amount);
                    var unit = $('#per_poduct_price').text();
                    var total_product_price = parseFloat(unit * quantity);
                    $('#per_poduct_total_price_' + id + '').text(total_product_price.toFixed(2));
                    $('#total_product_price').val(total_product_price);
                    $('#product_price').val(total_product_price.toFixed(2));
                    $('#product_quantity').val(quantity);
                    location.reload(true);

                }
            });


        }
    }

    function CartDataRemove(product_row) {
        var rowid = product_row;
        $('#' + rowid).fadeOut();

        jQuery.ajax({
            type: 'POST',
            data: {"rowid": rowid},
            url: '<?php echo base_url()?>ajax/remove_from_cart',
            success: function (result) {


                location.reload(true);
            }
        });


    }
</script>


<script>

    jQuery('form#checkout #customer_phone').on('blur', function () {

        //  var billing_phone = jQuery('form#checkout #customer_phone').val();
        //  var filter = /^[0-9]{11}$/;
        // alert(billing_phone);
        var order_id = $('#order_id').val();

        if ($('form#checkout #customer_phone').val().match('[0-9]{13}')) {
            alert("Enter valid Bangladeshi Number such as 0170000007");
            jQuery('form#checkout #customer_phone').addClass('error');
            jQuery('form#checkout button.confirm_order').attr('disabled', true);
        }
        else {
            var billing_name = jQuery('form#checkout #customer_name').val();
            var billing_phone = jQuery('form#checkout #customer_phone').val();
            var order_total = $("input[name=order_total]").val();
            var product_name = [];
            $('.product_name').each(function () {
                product_name.push($(this).val());
            });


            var product_price = [];
            $('.product_price').each(function () {
                product_price.push(Number($(this).val().replace(/\,/g, '')));
            });

            var product_color = [];
            $('.product_color').each(function () {
                product_color.push($(this).val());
            });


            var product_size = [];
            $('.product_size').each(function () {
                product_size.push($(this).val());
            });

            var product_qty = [];
            $('.product_qty').each(function () {
                product_qty.push($(this).val());
            });

            var product_featured_image = [];
            $('.product_featured_image').each(function () {
                product_featured_image.push($(this).val());
            });
            $.ajax({
                type: "POST",
                data: {
                    order_id: order_id,
                    product_name: product_name,
                    product_price: product_price,
                    product_color: product_color,
                    billing_phone: billing_phone,
                    billing_name: billing_name,
                    product_featured_image: product_featured_image,
                    product_qty: product_qty,
                    product_size: product_size,
                    order_total: order_total
                },
                url: '<?php echo base_url()?>ajax/tryOrder',
                success: function (result) {
                    debugger;
                    console.log(result);
                    $('#order_id').val(result)
                    //  alert(result);
                },
                error: function (result) {
                    console.log(result);

                    // alert(result);
                }
            });
        }
    });

    $('.btn_read_color').mouseenter(function () {
       $(this).css("background-color", "green")
    });

    


</script>


