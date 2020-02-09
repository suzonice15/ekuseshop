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
        background-color: red;
        color: white;
        cursor: pointer;
        float: right;
        margin-top: -20px;
        margin-left: 44px;
    }

    @media (max-width: 634px) {
        .decrement_class {
            background-color: red;
            color: white;
            cursor: pointer;
            float: right;
            margin-top: 1px;
        }

    }




    @media (max-width: 600px) {
        .bikash_transaction_logo {
            position: relative;
            right: 0px;
            top: 11px;
        }
        .checkout-page .row{
            margin-right: -34px;
            margin-left: -29px;
        }

    }

    @media only screen and (min-width: 992px) {
        .bikash_transaction_logo {
            position: absolute;
            right: 0px;
            top:112px;
        }

    }

</style>

<br>


<div class="container container-fullwidth checkout-page" style="margin-bottom: 15px;">
  <form action="<?php echo base_url() ?>chechout" id="checkout" name="checkout" method="post">

    <div class="row">
        <?php if (!empty($cart_items)) { ?>


            <div class="col-md-5 col-12">
                <div class="card">
                    <div class="card-header"><b>Order Review</b>
                    </div>
                    <div class="card-body">


					<span class="checkout-fields">


							<div class="checkoutstep">
                                <div class="cart-info">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                        <tr>
                                            <th width="35%" class="name">Products</th>
                                            <th width="5%" class="name">Quantity</th>
                                            <th width="30%" class="name">Price</th>
                                            <th width="30%" class="name">Total</th>
                                        </tr>

                                        <?php
                                        $quntity = 0;

                                        foreach ($this->cart->contents() as $items) {
                                            $featured_image = get_product_meta($items['id'], 'featured_image');
                                            $featured_image = get_media_path($featured_image, 'thumb');

                                            $quntity = $quntity + $items['qty'];
                                            $_product_title = get_product_title($items['id']);
                                            $_product_title = substr($_product_title, 0, 22) . '...';


                                            ?>
                                            <tr id="<?= $items['rowid'] ?>">
                                                <td>
                                                    <img src="<?= $featured_image ?>" width="30">

                                                    <?= $_product_title ?>
                                                </td>

                                                <td>
                                                    <div class="quantity-action ">

                                                        <div class="col-md-1">
	<span
        id="quantity_value_<?= $items['id'] ?>"
        style="display: inline-block;margin-right: 16px;"><?= $items['qty'] ?></span>
                                                        </div>


                                                    </div>
                                                </td>

                                                <td>
													<span
                                                        id="per_poduct_price">  ৳ <?= $this->cart->format_number($items['price']) ?></span>

                                                </td>
                                                <td>
												<span id="per_poduct_total_price_<?= $items['id'] ?>"> ৳
                                                    <?= $this->cart->format_number($items['subtotal']) ?>
													</span>

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


                                    <input type="hidden" id="quantity_list" name="quantity_list"
                                           value="<?php echo $quntity; ?>">


                                    <table class="table table-striped table-bordered review_cost">
                                        <thead>

                                            <th  width="60%"></th>
                                            <th  width="30%"></th>

                                        </thead>
                                        <tbody>
                                        <?php


                                        $order_total = $this->cart->total();
                                        ?>
                                        <input type="hidden" name="order_total"
                                               value="<?php echo $this->cart->format_number($order_total) ?>">


                                        <tr>
                                            <td>
                                                <span class="extra bold">Sub-Total</span>
                                            </td>
                                            <td class="text-right">
													<span class="bold">৳
														<span id="subtotal_cost">
														<?= $this->cart->format_number($this->cart->total()) ?>													</span>
													</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="extra bold">Delivery Cost&nbsp;(<span style="color:green">Free for more than 2 units order</span>)
                                            </td>
                                            <td class="text-right">
													<span class="bold">৳ <span
                                                            id="delivery_cost"> </span></span>


                                                <input type="hidden" id="shipping_charge" name="shipping_charge"
                                                       value=" ">
                                            </td>
                                        </tr>
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


                                </div>

                            </div>

                        <a href="<?php echo base_url() ?>cart" style="background-color: green"
                           class="btn btn-success btn-sm">Update cart</a>
                    </div>
                    </span>
                    </form>
                </div>
            </div>

            <div class="col-md-7 col">
                <div class="card">
                    <div class="card-header"><b>Customer Information</b>
                    </div>
                    <div class="card-body">
                      
                            <div class="checkoutstep">
                                <div class="form-group">
                                    <label for="billing_name"><b>Name</b><span class="text-danger">*</span></label>
                                    <input required type="text" id="customer_name" name="customer_name"
                                           value="<?php if (isset($name)) {
                                               echo $name;
                                           } else {  echo set_value('customer_name');} ?>" class="form-control"
                                           id="billing_name"
                                           placeholder="Name">

                                    <p id="customer_name_error" class="text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label for="billing_name"><b>Phone</b><span class="text-danger">*</span></label>

                                    <input required type="text" id="customer_phone" name="customer_phone"
                                           value="<?php if (isset($user_mobile)) {
                                               echo $user_mobile;
                                           } else {  echo set_value('customer_phone');}?>" class="form-control "
                                           id="billing_phone" placeholder="Phone Number">
                                    <p id="customer_phone_error" class="text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label for="billing_name"><b>Email</b></label>

                                    <input type="text" name="customer_email" id="customer_email"
                                           value="<?php if (isset($user_email)) {
                                               echo $user_email;
                                           }  else {  echo set_value('customer_email');} ?>" class="form-control "
                                           id="billing_email" placeholder="Email">
                                    <p id="customer_email_error" class="text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label for="billing_name"><b>City</b><span class="text-danger">*</span> &nbsp &nbsp
                                        &nbsp<span class="text-danger" id="city_eroor"></span></label>

                                    <select required name="city" id="city" class="form-control">
                                        <option value="">Please select your city</option>
                                        <?php foreach ($districts as $row) : ?>
                                            <option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group ">

                                    <div class="form-group">
                                        <label for="comment"><b>Customer Address </b><span
                                                class="text-danger">*</span></label>
 <textarea name="customer_address"
           id="shipping_address1" required placeholder="Write your full  address" required class="form-control" rows="3"
           id="comment"><?php if (isset($user_address)) {
         echo $user_address;
     } else {  echo set_value('customer_address');} ?></textarea>

                                        <span class="text-danger" id="shipping_address1_error"></span>
                                    </div>

                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="ship_to_billing" id="ship_to_billing" value="1" >
                                        <b class="fgreen">Same as Customer Address </b>
                                    </label>

                                </div>


                                <div class="form-group">
                                    <label for="comment"><b>Delivery Adress</b></label>
                                        <textarea name="delevery_address"
                                                  id="shipping_address2"
                                                  placeholder="Delivery  Address" class="form-control" rows="3"
                                                  id="comment"><?php   echo set_value('delevery_address'); ?></textarea>
                                </div>


                            </div>
                            <div class="col-md-12">

                                <div class="checkoutstep payment_type">
                                    <div class="form-group mb0 text-center"><label>

                                            <input required id="cash_on_delevery" class="payment_class_suzon"
                                                   type="radio"
                                                   name="payment_type"
                                                   value="cash_on_delivery"
                                            >
											<span id="cash_on_delevery_text"
                                                  style="background-color: green" class="btn btn-success btn-sm">Cash On Delivery</span></label>

                                        <label> <input required class="payment_class_suzon" type="radio" id="bKash"
                                                       name="payment_type" value="bKash"/> <span
                                                style="background-color: green" class="btn btn-success btn-sm">Bkash Payment</span>
                                        </label>
                                        <label> <input required class="payment_class_suzon"
                                                       style="background-color: green" class="btn btn-success btn-sm"
                                                       type="radio"
                                                       name="payment_type"
                                                       value="online"/> <span
                                                style="background-color: green" class="btn btn-success btn-sm">Online Payment</span>
                                        </label>


                                    </div>
                                    <div id="hide_bkash_payment" class="form-group">
                                        <p id="bikash_eroor" class="text-danger"></p>
                                        <p for="billing_name"
                                           class="text-dark bold "><?= get_option('bkash_payment') ?></p>

                                        <input  style="height: 43px" type="text" name="bkash_payment" value="<?php   echo set_value('bkash_payment'); ?>"
                                               class="form-control col-12 col-md-8"
                                               id="bkash_payment" placeholder="Enter your bkash transaction id">
                                        <img class="bikash_transaction_logo"
                                             src="<?= base_url() ?>images/bkahscan.png">
                                    </div>
                                    <h5 style="margin-left: 19px;">We Accepte:<img class="logo logo-visa"
                                                                                   src="<?php echo base_url()?>/images/card-logo.png">
                                    </h5>
                                    <input type="checkbox" required name="terms_and_conditions" id="terms_and_conditions" value="1"> I have read and agree with the <a href="<?php echo base_url()?>/pages/terms">Terms &amp; Conditions</a> </label> </p>
                                </div>
                            </div>
                        
                            <div class="checkout-box" style="margin-left: 32px;">
                                <div class="submit-btns">
                                    <input type="submit" class="btn btn-primary btn-sm" id="confirm_order" value="Confirm Order">

                                    <a style="background-color:red" href="<?php echo base_url() ?>"
                                       class="btn btn-primary  btn-sm ">Continue
                                        Shopping</a>
                                </div>
                            </div>


                    </div>
                </div>
            </div>

        <?php } else { ?>
            <div class="col-md-12 text-center"><a href="<?php echo base_url() ?>"><img style="margin-bottom: -68px"
                                                                                       src="<?php echo base_url() ?>images/stop.png"/></a>
            </div>
            <div class="col-md-12 mt-5 text-center">
                <h1 class="text-danger text-center">You have no product to checkout.
                </h1>
                <a class="text-center text-capitalize btn btn-info btn-sm" href="<?php echo base_url() ?>"> back to
                    home</a>
            </div>
        <?php } ?>

    </div>

</div>
<input type="hidden" id="order_id" value="">

<script>
    $('#shipping_address1').on('click', function () {
        var city = $('#city').children("option:selected").val();
        if (city.length == 0) {
            $('#city_eroor').text('Please select your city ');
        } else {
            $('#city_eroor').text('');

        }
    });
    $('#city').on('change blur', function () {
        var order_area = $(this).children("option:selected").val();
        if (city.length == 0) {
            $('#city_eroor').text('Please select your city ');
        } else {
            $('#city_eroor').text('');

        }
        if (order_area == 'Dhaka') {

            var charge = 0;
            $('.shipping_charge_in_dhaka').each(function () {
                charge = Number($(this).val());
            });
            var quantity_list = $('#quantity_list').val();
            charge = charge * quantity_list;
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
                charge = Number($(this).val());
            });

            var quantity_list = $('#quantity_list').val();
            charge = charge * quantity_list;
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

    $("#confirm_order").click(function () {


        var customer_name = $("#customer_name").val();
        if(customer_name.length == 0){
            $('#customer_name_error').text('You can`t leave this empty');
        } else {
            $('#customer_name_error').text('');
        }


        var customer_phone = $("#customer_phone").val();
        if(customer_phone.length == 0){
            $('#customer_phone_error').text('You can`t leave this empty');
        } else {
            $('#customer_phone_error').text('');
        }

        var city = $("#city").val();
        if(city.length == 0){
            $('#city_eroor').text('You can`t leave this empty');
        } else {
            $('#city_eroor').text('');
        }
        var shipping_address1 = $("#shipping_address1").val();
        if(shipping_address1.length == 0){
            $('#shipping_address1_error').text('You can`t leave this empty');
        } else {
            $('#shipping_address1_error').text('');
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

        var customer_phone = $('#customer_phone').val();
        var order_id = $('#order_id').val();

        if (!/^01\d{9}$/.test(customer_phone)) {
            $('#customer_phone_error').text("Invalid phone number: must have exactly 11 digits and begin with ");
        } else {
            $('#customer_phone_error').text("");
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
                url: '<?php echo base_url()?>ajax/tryOrderu',
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


</script>

<script>

    $(document).ready(function () {
        var payment;
        $('.payment_class_suzon').click(function () {
            payment = $(this).val();

        });
        $('form[name=checkout]').submit(function () {


            if (payment == 'bKash') {
                var bkash_payment = $('input[name=bkash_payment]').val();

                if (bkash_payment.length < 5) {
                    return true;
                }

            } else {

                return true;

            }
            debugger;


        });
    });
</script>
<script>
    $('#customer_email').blur(function () {
        var error_email = '';
        var email = $('#customer_email').val();
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(email)) {
            $('#customer_email_error').html('<label class="text-danger">email address format is not correct</label>');


        } else {
            $('#customer_email_error').html('');

        }
    });
</script>

