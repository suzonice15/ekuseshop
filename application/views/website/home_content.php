 <div class="xs-banner banner-fullwidth-version-2 suzon_slider_class"
>
    <div class="container container-fullwidth">
        <div class="row">
            <div class="xs-banner-slider-6 owl-carousel col-lg-12 col-md-12 col-sm-12">
                <?php

                $sliders = get_homeslider();
                if ($sliders):
                    foreach ($sliders as $slider):
                        ?>
                        <a href="<?php echo $slider->target_url; ?>">
                            <div class="xs-banner-item row">

                                <img  alt="<?php echo $slider->homeslider_text; ?>"
                                     src="<?php echo base_url();
                                     echo $slider->homeslider_banner; ?>">

                            </div>
                        </a>

                    <?php endforeach; endif; ?>


            </div>

        </div>
    </div>
</div>

<!-- offer banner section -->
<div class="xs-section-padding-bottom suzon_add_class col-md-12 col-lg-12">
    <div class="container container-fullwidth">
        <div class="row">
            <?php
            $adds = get_result("SELECT * FROM `adds` where adds_type='home' ORDER BY adds_id DESC limit 3");

            if (isset($adds)) {
                foreach ($adds as $add) {
                    $picture = base_url() . $add->media_path;
                    ?>

                    <div class="col-md-4 col-12" style="margin-bottom: -24px;">
                        <div class="xs-banner-campaign">
                            <a  style="z-index:10000" href="<?= $add->adds_link ?>">
                                <img src="<?= $picture ?>
" alt="<?= $add->created_time ?>">
                            </a>
                        </div><!-- .xs-banner-campaign END -->
                    </div>

                <?php }
            } ?>


        </div><!-- .row END -->
    </div><!-- .container .container-fullwidth END -->
</div><!-- End offer banner section -->

<!-- top category section -->
<div class="xs-section-padding-bottom v-semi-black" >
    <div class="container container-fullwidth">
        <div class="row">

            <div class="col-md-12">
                <div class="xs-content-header mx-3">
                    <h2 class="xs-content-title">Top Categories This Week</h2>
                    <ul class="nav nav-tabs xs-nav-tab" role="tablist">
                        <?php


                        $home_cat_section = explode(",", get_option('top_weekly_category'));
                        $active_tab = 0;
                        if (sizeof($home_cat_section) > 0) {
                            foreach ($home_cat_section as $home_cat) {
                                $category_info = get_category_info($home_cat);

                                $active_tab++;


                                ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($active_tab == 1) {
                                        echo 'active';
                                    } ?> " id="top-on-<?php echo $category_info->category_name; ?>-tab"
                                       data-toggle="tab"
                                       href="#top-on-<?php echo $category_info->category_name; ?>" role="tab"
                                       aria-controls="top-on-<?php echo $category_info->category_name; ?>"
                                       aria-selected="true"><?php echo $category_info->category_title; ?></a>
                                </li>

                                <?php


                            }
                        }

                        ?>


                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="tab-content">
                    <?php
                    $home_cat_section = explode(",", get_option('top_weekly_category'));
                    //echo '<pre>'; print_r($home_cat_section); echo '</pre>';
                    $active_tab = 0;

                    foreach ($home_cat_section as $home_cat) {
                        $category_info = get_category_info($home_cat);
                        $category_title = $category_info->category_title;
                        $category_name = $category_info->category_name;
                        $active_tab++;


                        //	echo '<pre>'; print_r($catproducts); echo '</pre>';
                        ?>
                        <div class="tab-pane fade show <?php if ($active_tab == 1) {
                            echo 'active';
                        } ?>" id="top-on-<?php echo $category_name; ?>" role="tabpanel"
                             aria-labelledby="top-on-<?php echo $category_name; ?>-tab">
                            <div class="row no-gutters product-thumb-version">

                                <?php
                                $top_category_products = get_top_category_products($home_cat, 8);
                                $i = 0;
                                if (isset($top_category_products)) {

                                    foreach ($top_category_products as $prod) {
                                        $featured_image = get_product_meta($prod->product_id, 'featured_image');
                                        $featured_image = get_media_path($featured_image, 'thumb');
                                        $_product_title = strip_tags($prod->product_title);

                                        $product_link = base_url() . 'product/' . $prod->product_name;


                                        $discount = false;

                                        $product_price = $sell_price = $prod->product_price;

                                        $product_discount = $prod->discount_price;
                                        $discount_type = $prod->discount_type;

                                        if ($product_discount != 0) {
                                            $discount = '';

                                            $product_discount_price = floatval($product_discount);
                                            $sell_price = $product_discount_price;


                                        }

                                        $total_rating = $total_review = $avg_rating = 0;
                                        $reviews = get_review($prod->product_id);


                                        if (isset($reviews)) {
                                            foreach ($reviews as $review) {
                                                $rating[] = $review->rating;
                                            }
                                            $total_review = count($reviews);
                                        }
                                        $_product_title = strip_tags($prod->product_title);
                                        $i++;
                                        if ($i < 13) {
                                            ?>

                                            <div class="col-lg-3 col-md-6 top_category_main_section">
                                                <div class="xs-product-widget media">
                                                    <a
                                                        href="<?= $product_link ?>">

                                                        <img width="125" height="142" class="d-flex" src="<?= $featured_image ?>"
                                                             alt="<?= $_product_title ?>">
                                                    </a>

                                                    <div class="media-body align-self-center product-widget-content">
                                                        <div class="xs-product-header media">
															<span
                                                                  class="star-rating ">(<?php echo $total_review; ?>
                                                                )</span>

                                                        </div><!-- .xs-product-header END -->
                                                        <h4 class="product-title"><a
                                                                href="<?= $product_link ?>"><?= $_product_title ?></a>
                                                        </h4>
														<span style="color:#00B050" class="price">

                                            <del style="color:red"> <?php
                                                if ($product_price > $sell_price) {
                                                    echo formatted_price($product_price);

                                                } ?></del>
                                        </span>
                                                        <br>
														<span style="color:#00B050" class="price">
                                            <?php echo formatted_price($sell_price); ?>
															</span>

                                                    </div>    <!-- .xs-deals-info END -->

                                                    <!-- .product-widget-content END -->
                                                </div><!-- .xs-product-widget END -->
                                                <div class="col-md-2 ml-5 top_category_hover_add_to_cart"
                                                     style="">

                                                    <a href="#" style="width: 209px;
margin-left: -12px;
color: white;
background-color: green;margin-top: 25px;" class="btn btn-success btn-sm  add_to_cart"
                                                       data-product_id="<?= $prod->product_id ?>"
                                                       data-product_price="<?= $sell_price ?>"
                                                       data-product_title="<?= $prod->product_title ?>"><i
                                                            class="icon icon-online-shopping-cart"></i>    &nbsp; Add to Cart</a>


                                                </div>
                                            </div>
                                        <?php }

                                    }

                                }
                                ?>


                            </div><!-- .row END -->

                        </div><!-- #bestOnSale END -->

                    <?php } ?>


                </div>
            </div>
        </div>
    </div><!-- .container END -->
</div><!-- end top category section -->

<!-- hot sale section -->
<section class="xs-section-padding bg-gray v-yellow-and-black" style="margin-top: -91px;padding: 28px 14px;">
    <div class="container container-fullwidth">
        <div class="row">
            <div class="col-lg-12">
                <div class="xs-content-header">
                    <h2 class="xs-content-title">Hot Sale</h2>
                    <ul class="nav nav-tabs xs-nav-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="hot-40off-tab" data-toggle="tab" href="#hot-40off" role="tab"
                               aria-controls="hot-40off" aria-selected="true">1-20% Off</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="hot-57off-tab" data-toggle="tab" href="#hot-57off" role="tab"
                               aria-controls="hot-57off" aria-selected="false">21-40% Off</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="hot-75off-tab" data-toggle="tab" href="#hot-75off" role="tab"
                               aria-controls="hot-75off" aria-selected="false">41-75% Off</a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="tab-content version-border-right" >
                    <div class="tab-pane fade show active" id="hot-40off" role="tabpanel"
                         aria-labelledby="hot-40off-tab">
                        <div class="row no-gutters">
                            <?php if (isset($product25)) :
                                foreach ($product25 as $prod):


                                    $featured_image = get_product_meta($prod->product_id, 'featured_image');
                                    $featured_image = get_media_path($featured_image, 'thumb');
                                    $_product_title = strip_tags($prod->product_title);

                                    $product_link = base_url() . 'product/' . $prod->product_name;


                                    $discount = false;

                                    $product_price = $sell_price = $prod->product_price;

                                    $product_discount = $prod->discount_price;
                                    $discount_type = $prod->discount_type;

                                    if ($product_discount != 0) {


                                        $product_discount_price = floatval($product_discount);


                                        $sell_price = $product_discount_price;

                                    }

                                    $_product_title = strip_tags($prod->product_title);


                                    ?>
                                    <div class="col-lg-2 col-md-4 col-sm-12 col-12">
                                        <div class="xs-deal-blocks deal-block-v2 hot_sell_offer_mother_class">
                                            <a  href="<?= $product_link ?>">
                                                <img class="img-fluid" src="<?= $featured_image ?>"
                                                     alt="<?= $_product_title ?>" style="width: 100%;">

                                            </a>
                                            <div class="xs-product-offer-label">
                                                <span><?php echo round($prod->product_percent_tag); ?>%</span>
                                                <small>Offer</small>
                                            </div>
                                            <div class="title-and-price">
                                                <h4 class="product-title ">
                                                    <a
                                                       href="<?= $product_link ?>"><?= $_product_title ?></a>
                                                </h4>
												<span style="color:#00B050" class="price">
                                            <?php echo formatted_price($sell_price); ?>

                                                    <del style="color:red"> <?php
                                                        if ($product_price > $sell_price) {
                                                            echo formatted_price($product_price);

                                                        } ?></del>
                                        </span>
                                            </div>
                                            <div class="xs-deals-info">


                                                <div class="hot_sell_offer">
                                                    <a href="#"  style="margin-left: -141px;" class="btn btn-success btn-sm  add_to_cart col-4"
                                                       data-product_id="<?= $prod->product_id ?>"
                                                       data-product_price="<?= $sell_price ?>"
                                                       data-product_title="<?= $prod->product_title ?>"><i
                                                            class="icon icon-online-shopping-cart"></i>&nbsp; Add to Cart</a>
                                                </div>


                                            </div><!-- .xs-deals-info END -->

                                            <div class="countdow-timer" style="margin-top: -30px;">
                                                <h4><span class="color-primary">Hurry up!</span> Offers ends in:</h4>
                                                <div class="xs-countdown-timer"
                                                     data-countdown="<?php echo date('Y-m-d', strtotime($prod->discount_date_to)) ?>"></div>
                                            </div><!-- .countdow-timer END -->
                                        </div>
                                    </div>
                                <?php endforeach;endif; ?>
                        </div>
                    </div><!-- #hot-40off END -->


                    <div class="tab-pane fade show" id="hot-57off" role="tabpanel" aria-labelledby="hot-57off-tab">
                        <div class="row no-gutters">
                            <?php if (isset($product50)) :
                                foreach ($product50 as $prod):


                                    $featured_image = get_product_meta($prod->product_id, 'featured_image');
                                    $featured_image = get_media_path($featured_image, 'thumb');
                                    $_product_title = strip_tags($prod->product_title);

                                    $product_link = base_url() . 'product/' . $prod->product_name;


                                    $discount = false;

                                    $product_price = $sell_price = $prod->product_price;

                                    $product_discount = $prod->discount_price;
                                    $discount_type = $prod->discount_type;

                                    if ($product_discount != 0) {
                                        $product_discount_price = floatval($product_discount);


                                        $sell_price = $product_discount_price;
                                    }

                                    $_product_title = strip_tags($prod->product_title);


                                    ?>
                                    <div class="col-lg-2 col-md-4 col-sm-12 col-12">
                                        <div class="xs-deal-blocks deal-block-v2 hot_sell_offer_mother_class">
                                            <a  href="<?= $product_link ?>"><img
                                                    src="<?= $featured_image ?>" alt="<?= $_product_title ?>"
                                                    style="width: 100%;"></a>
                                            <div class="xs-product-offer-label">
                                                <span><?php echo round($prod->product_percent_tag); ?>%</span>
                                                <small>Offer</small>
                                            </div>
                                            <div class="title-and-price">
                                                <h4 class="product-title">
                                                    <a
                                                       href="<?= $product_link ?>"><?= $_product_title ?></a>
                                                </h4>
												<span style="color:#00B050" class="price">
                                            <?php echo formatted_price($sell_price); ?>

                                                    <del style="color:red"> <?php
                                                        if ($product_price > $sell_price) {
                                                            echo formatted_price($product_price);

                                                        } ?></del>
                                        </span>
                                            </div>
                                            <div class="xs-deals-info">


                                                <div class="hot_sell_offer">
                                                    <a href="#" style="margin-left: -141px;" class="btn btn-success  btn-sm   add_to_cart"
                                                       data-product_id="<?= $prod->product_id ?>"
                                                       data-product_price="<?= $sell_price ?>"
                                                       data-product_title="<?= $prod->product_title ?>"><i
                                                            class="icon icon-online-shopping-cart"></i>&nbsp; Add to Cart</a>
                                                </div>


                                            </div><!-- .xs-deals-info END -->

                                            <div class="countdow-timer" style="margin-top: -30px;">
                                                <h4><span class="color-primary">Hurry up!</span> Offers ends in:</h4>
                                                <div class="xs-countdown-timer"
                                                     data-countdown="<?php echo date('Y-m-d', strtotime($prod->discount_date_to)) ?>"></div>
                                            </div><!-- .countdow-timer END -->
                                        </div>
                                    </div>
                                <?php endforeach;endif; ?>
                        </div>
                    </div><!-- #hot-40off END -->


                    <div class="tab-pane fade show " id="hot-75off" role="tabpanel" aria-labelledby="hot-75off-tab">
                        <div class="row no-gutters">
                            <?php if (isset($product75)) :
                                foreach ($product75 as $prod):


                                    $featured_image = get_product_meta($prod->product_id, 'featured_image');
                                    $featured_image = get_media_path($featured_image, 'thumb');
                                    $_product_title = strip_tags($prod->product_title);

                                    $product_link = base_url() . 'product/' . $prod->product_name;


                                    $discount = false;

                                    $product_price = $sell_price = $prod->product_price;

                                    $product_discount = $prod->discount_price;
                                    $discount_type = $prod->discount_type;

                                    if ($product_discount != 0) {
                                        $product_discount_price = floatval($product_discount);


                                        $sell_price = $product_discount_price;
                                    }

                                    $_product_title = strip_tags($prod->product_title);


                                    ?>
                                    <div class="col-lg-2 col-md-4 col-sm-12 col-12">
                                        <div class="xs-deal-blocks deal-block-v2 hot_sell_offer_mother_class">
                                            <a  href="<?= $product_link ?>"><img class="lazyloaded"
                                                    src="<?= $featured_image ?>" alt="<?= $_product_title ?>"
                                                    style="width: 100%;"></a>
                                            <div class="xs-product-offer-label">
                                                <span><?php echo round($prod->product_percent_tag); ?>%</span>
                                                <small>Offer</small>
                                            </div>
                                            <div class="title-and-price">
                                                <h4 class="product-title">
                                                    <a
                                                       href="<?= $product_link ?>"><?= $_product_title ?></a>
                                                </h4>
												<span style="color:#00B050" class="price">
                                            <?php echo formatted_price($sell_price); ?>

                                                    <del style="color:red"> <?php
                                                        if ($product_price > $sell_price) {
                                                            echo formatted_price($product_price);

                                                        } ?></del>
                                        </span>
                                            </div>
                                            <div class="xs-deals-info">


                                                <div class="hot_sell_offer">
                                                    <a href="#" style="margin-left: -141px;" class="btn btn-success btn-sm   add_to_cart"
                                                       data-product_id="<?= $prod->product_id ?>"
                                                       data-product_price="<?= $sell_price ?>"
                                                       data-product_title="<?= $prod->product_title ?>"><i
                                                            class="icon icon-online-shopping-cart"></i>&nbsp; Add to Cart</a>
                                                </div>


                                            </div><!-- .xs-deals-info END -->
                                            <div class="countdow-timer" style="margin-top: -30px;">
                                                <h4><span class="color-primary">Hurry up!</span> Offers ends in:</h4>
                                                <div class="xs-countdown-timer"
                                                     data-countdown="<?php echo date('Y-m-d', strtotime($prod->discount_date_to)) ?>"></div>
                                            </div><!-- .countdow-timer END -->
                                        </div>
                                    </div>
                                <?php endforeach;endif; ?>
                        </div>
                    </div><!-- #hot-40off END -->

                </div>
            </div>
        </div><!-- .row END -->
    </div><!-- .container END -->
</section><!-- end hot sale section -->

<!-- product category block section -->



<span class="home_cat_content"></span>

<script type="text/javascript">
//    var xhr = new XMLHttpRequest();
//    xhr.open("GET", '<?php //echo site_url('ajax/home_cat_content'); ?>//');
//    xhr.send();
//    xhr.onreadystatechange = function()
//    {
//        jQuery('.home_cat_content').append(xhr.responseText);
//    }
//  //  $('#list').append(data);
    jQuery('.home_cat_content').load('<?php echo site_url('ajax/home_cat_content'); ?>');
</script>

