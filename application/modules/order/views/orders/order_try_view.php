<div class="col-md-offset-0 col-md-12">
    <div class="box box-success ">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if (isset($title)) echo $title ?></h3>
        </div>


            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <?php


                        $order_id = $order->order_id;
                        $service_cost = $order->order_id;
                        ?>


                        <form method="POST" id="order_update" action="<?= base_url() ?>order-try_update"
                              enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="box box-primary" style="border:2px solid #ddd">
                                        <div class="box-header" style="background-color: #ddd;">
                                            <h3 class="box-title">Customer Info</h3>
<!--                                            <a href="javascript:void(0)" class="pull-right change_order_data">Change</a>-->
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <p><b>Name:</b> <?= $order->customer_name; ?></p>
                                                        <p><b>Phone:</b> <?= $order->customer_phone; ?></p>

                                                    </td>
                                                </tr>

                                                <input class="form-control" type="hidden" name="customer_name"
                                                       value="<?php echo $order->customer_name; ?>"/>
                                                <input class="form-control" type="hidden" name="customer_phone"
                                                       value="<?php echo $order->customer_phone; ?>"/>
                                                </tbody>
                                            </table>

											<span id="order_data">
										<hr class="break break10">

										<div class="form-group ">
                                            <label for="billing_name">Name </label>


                                            <input class="form-control" type="text" name="customer_name"
                                                   value="<?php echo $order->customer_name; ?>"/>
                                        </div>


										<div class="form-group ">
                                            <label for="billing_email">Email</label>


                                            <input type="text" class="form-control" name="customer_email"
                                                   value="<?php echo $order->customer_email; ?>"/>
                                        </div>


										<div class="form-group ">
                                            <label for="billing_email">Customer Phone</label>
                                            <input type="text" name="customer_phone" class="form-control"
                                                   value="<?php echo $order->customer_phone; ?>"/>
                                        </div>


										<div class="form-group ">
                                            <label for="billing_address1"> Address line 1 </label>
                                            <input class="form-control" name="customer_address"
                                                   value="<?= $order->customer_address ?>		">


                                        </div>




									</span>
                                        </div>
                                    </div>

                                    <div class="box box-primary" style="border:2px solid #ddd">
                                        <div class="box-header" style="background-color: #ddd">
                                            <h3 class="box-title">Order Info</h3>
                                        </div>
                                        <div class="box-body">
									<span id="product_html">
										<table class="table  table-bordered">
                                            <tr>
                                                <th class="name" width="50%">Product</th>
                                                <th class="image text-center" width="5%">Image</th>
                                                <th class="image text-center" width="5%">Size</th>
                                                <th class="image text-center" width="5%">Color</th>
                                                <th class="quantity text-center" width="5%">Qty</th>
                                                <th class="price text-center" width="15%">Price</th>
                                                <th class="total text-right" width="15%">Sub-Total</th>
                                            </tr>
                                            <?php
                                            $html = null;
                                            foreach ($try_order as $row) {

?>
                                               <tr>
														<td><?php echo  $row->product_name ?></td>
													
														<td class="image text-center">
															<img src="<?php echo $row->product_image?>" height="30" width="30">
														</td>
														
														<td><?php echo $row->product_size ?></td>
                                                <td><?php echo $row->product_color ?></td>
															<td><?php echo $row->product_qnt ?>
														</td>
														<td class="text-center">৳ <?php echo $row->product_price ?>.00</td>
														<td class="text-right">৳ <?php echo $row->product_price ?>.00</td>
													</tr>
                                                <input type="hidden" name="product_name[]" value="<?php echo  $row->product_name ?>">
                                                <input type="hidden" name="product_image[]" value="<?php echo  $row->product_image ?>">
                                                <input type="hidden" name="product_price[]" value="<?php echo  $row->product_price ?>">
                                                <input type="hidden" name="product_size[]" value="<?php echo  $row->product_size ?>">
                                                <input type="hidden" name="product_color[]" value="<?php echo  $row->product_color ?>">
                                                <input type="hidden" name="product_qnt[]" value="<?php echo  $row->product_qnt ?>">

                                                <?php

                                            }

                                            ?>
                                        </table>
										<table class="table table-striped table-bordered">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <span class="extra bold totalamout">Total</span>
                                                </td>
                                                <td class="text-right">
                                                    <span class="bold totalamout">৳ <span
                                                                id="total_cost"><?= $order->order_total ?>
                                                       </span></span>
                                            <?= form_hidden('order_total', $order->order_total) ?>
                                            </td>
                                            </tr>
                                            </tbody>
                                            </table>
                                            </span>

                                            <div hidden class="form-group">
                                                <select name="product_ids" id="product_ids" class="form-control select2"
                                                        multiple="multiple"
                                                        data-placeholder="Type... product name here..."
                                                        style="width:100%;">
                                                    <?= get_option_based_product(true, $product_ids) ?>
                                                </select>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="box box-danger">
                                        <div class="box-header">
                                            <h3 class="box-title">Actions</h3>
                                        </div>
                                        <div class="box-body">



                                            <div
                                                     </div>

                                            <div class="form-group">
                                                <label>Shipping Date</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>

                                                    <input type="text" name="shipment_time"
                                                           class="form-control pull-right" id="datepicker" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Order Status</label>
                                                <select name="order_status" id="order_status" class="form-control">
                                                    <option value="pending_payment">Pending for Payment  </option>
                                                    <option value="processing">On Process </option>
                                                    <option value="on_courier">With Courier </option>
                                                    <option value="delivered">Delivered </option>
                                                    <option value="completed">Completed </option>
                                                    <option value="refund">Refunded </option>
                                                    <option value="cancled">Cancelled </option>
                                                </select>
                                            </div>


                                            <div class="box-footer">
                                                <input type="hidden" name="order_id" value="<?= $order->order_id ?>">
                                                <button class="btn btn-success pull-right hidden-print"
                                                         > Update
                                                </button>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </section>

    </div>
    <script>
       $('#order_data').hide();
    </script>