

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/jquery-ui.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/animate.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/iconfont.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/isotope.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/magnific-popup.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/owl.theme.default.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/vertical-menu.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/navigation.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/lightslider.css">


<!--For Plugins external css-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/plugins.css"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/mobile_menu.css"/>
<!--Theme custom css -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/mycustom.css">

<!--Theme Responsive css-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/responsive.css"/>

<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 maincnt mt20">
                <section id="thankyou">
                    <?php
                    if((isset($order)) )
                    {


                        ?><h1  class="btn btn-success text-center  col-12 mt-2">Thank you.<?php echo $order->customer_name;?> Your order has been received.</h1>
                        <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h5 class="float-left">Order Details</h5><h5> <a href="<?php echo base_url()?>home/pdf/<?php echo $order->order_id;?>">download </a></h5>
                                </div>
                                <div class="card-body">
                                    <div class="cart-info">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <th width="5%" class="name">Sl</th>
                                                <th  width="30%"class="name">Products</th>
                                                <th  width="10%" class="name">Code</th>
                                                <th width="15%" class="name">Quantity</th>
                                                <th  width="20%"  class="name">Price</th>
                                                <th width="15%"  class="name">Total</th>
                                            </tr>
                                            <?php
                                            $product_items = unserialize($order->products);
                                            //echo '<pre>'; print_r($product_items); echo '</pre>';
                                            $count=1;
                                            foreach($product_items['items'] as $product_id=>$item)
                                            {

                                                //$featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;
                                                $featured_image = get_product_thumb($product_id);

                                                ?><tr>
                                                <td><?php echo $count;?></td>

                                                <td class="product-item" style="width:50%">
<!--                                                    <a>-->
<!--                                                        <img src="data:image/png;base64,--><?php //echo $featured_image?><!--" height="30" width="30"/>-->
<!--                                                    </a>-->
                                                    <div class="item-name-and-price">
                                                        <div class="item-name">
                                                            <?=$item['name']?>
                                                        </div>

                                                    </div>
                                                </td>

                                                <td>  <?= get_sku_code($product_id) ?></td>
                                                <td>   <?=$item['qty']?></td>
                                                <td>   <?=$item['price']?> </td>
                                                <td>   <?=$item['subtotal']?> </td>

                                                </tr>
                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </table>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                            <tr>
                                                <td style="50%">
                                                    <span class="extra bold totalamout">Delivery Cost</span>
                                                </td>
                                                <td class="text-right" style="width:50%">
                                                    <span class="bold totalamout">TK <?=$order->shipping_charge;?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="50%">
                                                    <span class="extra bold totalamout">Total</span>
                                                </td>
                                                <td class="text-right" style="width:50%">
                                                    <span class="bold totalamout">TK <?=$order->order_total?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="50%">
                                                    <span class="extra bold">Order number</span>
                                                </td>
                                                <td class="text-right" style="width:50%">
                                                    <span class="bold"><?=($order->order_id < 10 ? 0 : '').$order->order_id?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="50%">
                                                    <span class="extra bold">Payment method</span>
                                                </td>
                                                <td class="text-right" style="width:50%">
                                                    <span class="bold"><?=ucwords(str_replace("_", " ", $order->payment_type))?></span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div><?php
                    }

                    else
                    {
                        ?><h1 class="error">Invalid Order Request!</h1><?php
                    }
                    ?>
                </section>
            </div>
        </div>
    </div>


