<?php
$home_cat_section = explode(",", get_option('home_cat_section'));
//echo '<pre>'; print_r($home_cat_section); echo '</pre>';
$active_tab = 0;

foreach ($home_cat_section as $home_cat) {
    $category_info = get_category_info($home_cat);
    $category_title = $category_info->category_title;
    $category_id = $category_info->category_id;
    $category_name = $category_info->category_name;
    $link = base_url().'category/'.$category_info->category_name;
    //print_r($category_info)
    $featured_image = get_media_path($category_info->medium_banner);
    //$featured_image = get_media_path($featured_image, 'thumb');


    ?>
    <section class="product-cate-block-section" style="margin-top: 19px;
margin-bottom: -46px;">
        <div class="container container-fullwidth">
            <div class="product-cate-block-wraper">
                <div class="row no-gutters">
                    <div class="col-lg-12">
                        <div class="row no-gutters">


                            <div class="col-lg-2 col-sm-12 col-md-12 col-12 ">
                                <div class="block-product-cate-wraper"
                                     style="background-image: url(<?= $featured_image ?>">
                                    <a class="home_category_hover_anchor" href="<?php echo $link;?>"> <h3 class="block-cate-header category_bold" style="color:white" ><?= $category_title ?></h3></a>
                                    <ul class="nav flex-column">

                                        <?php
                                        $subcategorys = get_subcategories($category_id);
                                        if (isset($subcategorys)) {
                                            $count = 1;

                                            foreach ($subcategorys as $sub):
                                                $link = base_url() . 'category/' . $sub->category_name;
                                                if ($count <= 12):
                                                    ?>

                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                           href="<?= $link ?>"><?= $sub->category_title ?></a>
                                                    </li>

                                                    <?php
                                                endif;
                                                $count++;
                                            endforeach;
                                        }
                                        ?>


                                    </ul>
                                    <div class="xs-overlay bg-teal"></div>
                                </div>
                            </div>

                            <!--

                            <div class="col-12 mobile_category_menu" style="margin-top:50px;background-color: #2CC7DB;">


                                <h3 class="block-cate-header"><?= $category_title ?> <i class="fa fa-bars"
                                                                                        onclick="mobile_caollapse_menu_function(<?php echo $home_cat; ?>)"></i>
                                </h3>


                                <ul class="nav flex-column mobile_caollapse_menu" id="<?php echo $home_cat; ?>">

                                    <?php
                            $subcategorys = get_subcategories($category_id);
                            if (isset($subcategorys)) {
                                $count = 0;

                                foreach ($subcategorys as $sub):
                                    $link = base_url() . 'category/' . $sub->category_name;
                                    if ($count < 12):
                                        ?>

                                    <li class="nav-item">
                                        <a class="nav-link"
                                           href="<?= $link ?>"><?= $sub->category_title ?></a>
                                    <li>
                                        <?php
                                    endif;
                                    $count++;
                                endforeach;
                            }
                            ?>


                                </ul>

                            </div>

                            -->


                            <div class="col-lg-10 col-sm-12  col-md-12 col-12 ">
                                <div class="row no-gutters product-block-category">
                                    <?php
                                    $catproducts = get_category_products($home_cat, 8);
                                    if (isset($catproducts)) {
                                        $i = 0;
                                        foreach ($catproducts as $prod) {
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


                                            $i++;

                                            ?>
                                            <div class="col-md-6 col-12 col-lg-3 col-sm-6">
                                                <div class="xs-product-wraper version-2">
                                                    <a href="<?= $product_link ?>">
                                                        <img src="<?= $featured_image ?>"
                                                             alt="<?= $_product_title ?>"  ></a>
                                                    <div class="product-content" style="text-align:center">
                                                        <h4 class="product-title" style="text-align: center"><a
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

                                                    <div class="xs-product-hover-area clearfix">
                                                        <div>
                                                            <a href="#"
                                                               class="btn btn-primary btn-sm  add_to_cart mobile_add_to_cart"
                                                               data-product_id="<?= $prod->product_id ?>"
                                                               data-product_price="<?= $sell_price ?>"
                                                               data-product_title="<?= $prod->product_title ?>"><i
                                                                    class="icon icon-online-shopping-cart"></i>&nbsp;Add to
                                                                Cart</a>
                                                        </div>
                                                        <div>
                                                            <a style="width: 170px;
margin-left: -30px;" href="#" class="btn btn-info  btn-sm   buy_now mobile_buy_now_cart"
                                                               data-product_id="<?= $prod->product_id ?>"
                                                               data-product_price="<?= $sell_price ?>"
                                                               data-product_title="<?= $prod->product_title ?>"><i
                                                                    class="icon icon-bag"></i>&nbsp;Buy Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }

                                    ?>


                                </div>
                            </div>


                        </div>
                    </div>
                </div><!-- .row END -->


            </div>
        </div><!-- .container END -->

    </section><!-- end product category block section -->


<?php } ?>