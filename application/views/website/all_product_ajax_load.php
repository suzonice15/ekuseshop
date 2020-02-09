

<div class="col-lg-12">
    <div class="row no-gutters product-block-category">
<?php
foreach ($products as $product) {
    $total_review = 0;
    $reviews = get_review($product->product_id);


    if (isset($reviews)) {
        $total_review = count($reviews);


    }


    $featured_image = get_product_meta($product->product_id, 'featured_image');
    $featured_image = get_media_path($featured_image, 'thumb');

    $product_price = $sell_price = $product->product_price;

    $product_discount = $product->discount_price;

    if ($product_discount) {


        $product_discount = floatval($product_discount);

        if ($product_discount) {
            $sell_price = $product_discount;
        }
    }

    $product_title = $product->product_title;
    $link = base_url() . 'product/' . $product->product_name;
    ?>
    <div class="col-md-6 col-sm-12 col-lg-3 col-12">
        <div class="xs-product-wraper version-2">
            <div class="xs-product-header media">
                        <span class="star-rating d-flex" style="margin-top: -29px;">
                            <span class="value">(<?php echo $total_review; ?>)</span>
                        </span>

            </div>
            <a
                href="<?= $link ?>"> <img width="100%"
                                          src="<?= $featured_image ?>"
                                          alt="Mobile"></a>
            <div class="xs-product-content text-center">
                        <span class="product-categories">

                        </span>
                <h4 class="product-title"><a
                        href="<?= $link ?>"><?= $product_title ?></a></h4>
												<span style="color:#00B050" class="price">
                           <?= formatted_price($sell_price) ?>

                                                    <del style="color:red">


                                                        <?php
                                                        if ($product_discount) {

                                                            ?><?= formatted_price($product_price) ?><?php
                                                        }
                                                        ?>

                                                    </del>
                        </span>
            </div><!-- .xs-product-content END -->

            <div class="xs-product-hover-area clearfix">
                <div style="margin-left: 125px;">
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

<?php } ?>


    </div>
</div>