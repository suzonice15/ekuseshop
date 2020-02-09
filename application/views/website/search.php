
    <div class="container-fluid">
                <div class="col-lg-12">
                   


                        <div class="col-lg-12">


                            <div class="row no-gutters product-block-category">
                                <?php

                                if (isset($products)) {
                                    if (count($products) == 1) {

                                        foreach ($products as $prod_row) ;
                                        //$this->load->helper('url');
                                        $link = base_url() . 'product/' . ($prod_row->product_name);
                                        redirect($link);

                                    } else {

                                        foreach ($products as $product) {


                                            $total_review = 0;
                                            $reviews = get_review($product->product_id);


                                            if (isset($reviews)) {
                                                $total_review = count($reviews);


                                            }


                                            $featured_image = get_product_meta($product->product_id, 'featured_image');
                                            $featured_image = get_media_path($featured_image, 'thumb');

                                            $discount = false;

                                            $product_price = $sell_price = $product->product_price;

                                            $product_discount = $product->discount_price;
                                            $discount_type = $product->discount_type;

                                            if ($product_discount != 0) {
                                                $discount = '';

                                                $product_discount = $save_money = floatval($product_discount);

                                                if ($discount_type == 'fixed') {
                                                    $sell_price = ($product_price - $product_discount);
                                                } elseif ($discount_type == 'percent') {
                                                    $save_money = ($product_discount / 100) * $product_price;
                                                    $sell_price = floatval($product_price - $save_money);
                                                }
                                            }
                                            $less_money = '';

                                            if ($product_price > $sell_price) {
                                                $less_money = formatted_price($product_price);

                                            }
                                            $product_title = $product->product_title;
                                            $link = base_url() . 'product/' . $product->product_name;


                                            ?>


                                            <div class="col-md-3 col-lg-3 col-6">
                                                <div class="xs-product-wraper version-2">
                                                    <div class="xs-product-header media">
                        <span class="star-rating d-flex" style="margin-top: -29px;">
                            <span class="value">(<?php echo $total_review; ?>)</span>
                        </span>

                                                    </div>
                                                    <a href="<?= $link ?>">
                                                        <img
                                                            src="<?= $featured_image ?>"
                                                            alt="Mobile">
                                                    </a>
                                                    <div class="xs-product-content text-center">
                        <span class="product-categories">

                        </span>
                                                        <h4 class="product-title"><a
                                                                href="<?= $link ?>"><?= $product_title ?></a></h4>
												<span class="price">
                           <?= formatted_price($sell_price) ?>
                                                    <del><?= $less_money ?></del>
                        </span>
                                                    </div><!-- .xs-product-content END -->

                                                    <div class="xs-product-hover-area clearfix">
                                                        <div style="margin-left: 123px;">
                                                            <a href="#" class="btn btn-primary btn-sm  add_to_cart"
                                                               data-product_id="<?= $product->product_id ?>"
                                                               data-product_price="<?= $sell_price ?>"
                                                               data-product_title="<?= $product_title ?>"><i
                                                                    class="icon icon-online-shopping-cart"></i>Add to Cart</a>
                                                        </div>
                                                        <div>
                                                            <a href="#" class="btn btn-info btn-sm buy_now"
                                                               data-product_id="<?= $product->product_id ?>"
                                                               data-product_price="<?= $sell_price ?>"
                                                               data-product_title="<?= $product_title ?>"><i
                                                                    class="icon icon-bag"></i>Buy Now</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        <?php }
                                    }

                                }
                                ?>


                            </div>
                        </div>
                    </div>

               
          
    </div>
    <!-- .container END -->



