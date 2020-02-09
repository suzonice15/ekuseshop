
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
                                $top_category_products = get_top_category_products($home_cat, 12);
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
background-color: green;" class="btn btn-success btn-sm  add_to_cart"
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


