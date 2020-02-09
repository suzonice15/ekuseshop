<?php



if ($related_products ) {

    ?>
<div class="row no-gutters product-block-category">
<?php



foreach ($related_products as $rel_prod) {
    /*# product price and discount #*/


    $sell_price = $rel_prod->product_price;
    $product_sell = $sell_price;

    $product_discount = $rel_prod->discount_price;
    $discount_type = $rel_prod->discount_type;
    $link = base_url() . 'product/' . $rel_prod->product_name;

    if ($product_discount != 0) {

        $sell_price = floatval($product_discount);

    }
    $_product_title = strip_tags($rel_prod->product_title);
    $total_review_id = 0;
    $total_review_id = get_total_review($rel_prod->product_id);


    //	$total_rating = array_sum($rating);
    //$total_review_id= strlen($reviews);


    ?>
    <div class="col-md-3 col-lg-3 col-12">
        <div class="xs-product-wraper version-2">
            <div class="xs-product-header media ">
                        <span class="star-rating d-flex" style="margin-top: -29px;">
                            <span class="value">(<?php if (isset($total_review_id)) {
                                    echo $total_review_id;
                                } ?>)</span>
                        </span>

            </div><!-- .xs-product-header END -->
            <a href="<?= $link ?>">
                <img width="100%" src="<?= get_product_thumb($rel_prod->product_id, 'thumb') ?>"
                     alt="<?= $_product_title ?>">
            </a>
            <div class="xs-product-content text-center">

                <h4 class="product-title"><a href="<?= $link ?>"><?= $_product_title ?></a></h4>
							<span class="price" style="color:#00B050">
								<?= formatted_price($sell_price) ?>

                                <?php
                                if ($product_discount != 0)
                                {
                                ?>
                                <del style="color:red"><?= formatted_price($product_sell) ?></del>
                                <?php
                                }
                                ?></del>
                        </span>
            </div><!-- .xs-product-content END -->


            <div class="xs-product-hover-area clearfix">
                <div style="margin-left: 123px;">
                    <a href="#" class="btn btn-primary btn-sm  add_to_cart_releted_product"
                       data-product_id="<?= $rel_prod->product_id ?>"
                       data-product_price="<?= $sell_price ?>"
                       data-product_title="<?= $product_title ?>"><i
                            class="icon icon-online-shopping-cart"></i>Add to Cart</a>
                </div>
                <div>
                    <a href="#" class="btn btn-info btn-sm buy_now_releted_product"
                       data-product_id="<?= $rel_prod->product_id ?>"
                       data-product_price="<?= $sell_price ?>"
                       data-product_title="<?= $product_title ?>"><i
                            class="icon icon-bag"></i>Buy Now</a>
                </div>
            </div>

        </div><!-- .xs-product-wraper .version-2 END -->
    </div>

<?php }

?>
</div>

<?php
}

?>

