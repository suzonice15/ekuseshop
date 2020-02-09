<section id="mpart">
    <section class="container">
        <div class="row">
            <div class="col-sm-12 maincnt mt20">
                <section id="thankyou">
                    <?php
                    if ((isset($_GET['directpay']) && $_GET['directpay']=='success')) { ?><h1 class="text-center  col-12 mt-2"
                                                 style="font-size: 20px;
background-color:
green;
width: 100%;
height: auto;
margin-top: 28px;
color:
white;
padding: 8px 8px;">Thank you.
                        Your Order has been Completly Succesful.</h1>
                        <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-default">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-3 col">
                                            <h4>Order Details </h4>
                                        </div>
                                        <div class="col-md-4 col">

                                        </div>
                                        <div class="col-md-5 col float-right">
                                            <a href="<?php echo base_url();?>" class="btn btn-info btn-sm d-print-none">
                                                <span class="fa fa-backward"></span> BACK TO HOME
                                            </a>

                                            <button  class="btn btn-primary print btn-sm d-print-none"
                                                    style="font-size:24px"><i
                                                    class="fa fa-download"></i> download
                                            </button>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="cart-info">

                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                            <tr>
                                                <td style="75%">
                                                    <span class="extra bold totalamout"><b>Order Number</b></span>
                                                </td>
                                                <td class="text-right" style="width:50%">
                                                    <span class="bold totalamout"><b><?php echo $order->order_id; ?></b></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="75%">
                                                    <span class="extra bold totalamout"><b>Customer Name</b></span>
                                                </td>
                                                <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b> <?= $order->customer_name; ?></b></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="75%">
                                                    <span class="extra bold totalamout"><b>Customer Phone</span>
                                                </td>
                                                <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b><?= $order->customer_phone ?></b></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="75%">
                                                    <span class="extra bold totalamout"><b>Customer Address</span>
                                                </td>
                                                <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b><?= $order->customer_address ?></b></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="75%">
                                                    <span class="extra bold totalamout"><b>Payment method</span>
                                                </td>
                                                <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b><?= ucwords(str_replace("_", " ", $order->payment_type)) ?></b></span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>


                                        <div style="overflow-x: scroll;">
                                            <table class="table table-striped table-bordered">
                                                <tr>
                                                    <th class="name">Sl</th>
                                                    <th class="name">Picture</th>
                                                    <th class="name">Products</th>
                                                    <th class="name">Code</th>
                                                    <th class="name">Quantity</th>
                                                    <th class="name">Price</th>
                                                    <th class="name">Total</th>
                                                </tr>
                                                <?php
                                                $product_items = unserialize($order->products);
                                                //echo '<pre>'; print_r($product_items); echo '</pre>';
                                                $count = 1;
                                                $total = 0;
                                                foreach ($product_items['items'] as $product_id => $item) {


                                                    $totall = intval(preg_replace('/[^\d.]/', '', $item['subtotal']));

                                                    $total += $totall ;
                                                    $featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $count; ?></td>
                                                        <td>


                                                            <img src="<?= $featured_image ?>" height="30" width="30"/>

                                                        </td>

                                                        <td class="product-item" style="width:50%">

                                                            <div class="item-name-and-price">
                                                                <div class="item-name">
                                                                    <?= $item['name'] ?>
                                                                </div>

                                                            </div>
                                                        </td>

                                                        <td>  <?= get_sku_code($product_id) ?></td>
                                                        <td>   <?= $item['qty'] ?></td>
                                                        <td>  ৳ <?=$item['price'] ?> </td>
                                                        <td>  ৳ <?=$item['subtotal'] ?>    </td>

                                                    </tr>
                                                    <?php
                                                    $count++;
                                                }
                                                ?>
                                            </table>
                                        </div>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                            <tr>
                                                <td style="75%">
                                                    <span class="extra bold totalamout"><b>Sub Total</b></span>
                                                </td>
                                                <td class="text-right" style="width:50%">
                                                    <span class="bold totalamout"><b> <?= formatted_price($total) ?>  </b></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="75%">
                                                    <span class="extra bold totalamout"><b>Delivery Cost</b></span>
                                                </td>
                                                <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b><?= formatted_price($order->shipping_charge) ?> </b></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="75%">
                                                    <span class="extra bold totalamout"><b>Total</span>
                                                </td>
                                                <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b><?= formatted_price($order->order_total) ?> </b></span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div><?php
                    } elseif(isset($_GET['directpay']) && $_GET['directpay']=='fail')
                    {
                        ?><h1 class="error">Sorry you have failed to place your order!</h1><?php
                    }
                    elseif(isset($_GET['directpay']) && $_GET['directpay']=='cancle')
                    {
                        ?><h1 class="error">Sorry order request is cancled!</h1><?php
                    }
                    else
                    {
                        ?><h1 class="error">Invalid Order Request!</h1><?php
                    }
                    ?>
                </section>
            </div>
        </div>
    </section>
</section>


<script>

    $('.print').click(function(){
        window.print();
    });

</script>
