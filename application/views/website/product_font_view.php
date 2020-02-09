<?php
$product_link = base_url($prod_row->product_name);
$featured_image = get_product_thumb($prod_row->product_id);
$featured_image = get_product_thumb($prod_row->product_id);
$product_video = $prod_row->product_video;


$product_title = $prod_row->product_title;
$sku = $prod_row->sku;


/*# product category #*/
$product_cat = null;
$product_cats = get_result("SELECT term_id FROM term_relation WHERE product_id=$prod_row->product_id");
if (count($product_cats) > 0) {
    foreach ($product_cats as $pcat) {
        $product_cat[] = $pcat->term_id;
    }
    $product_cats = implode(",", $product_cat);
}


/*# product stock availability #*/
$product_availabie = $prod_row->product_availability;
$product_availability = '<span class="text-success"> In Stock</span>';
if ($product_availabie == 'Out of stock') {
    $product_availability = '<span class="text-danger">Out Of Stock</span>';

}

//print_r($specifications);exit();
/*# product price and discount #*/
$discount = false;

$product_price = $prod_row->product_price;
$product_video = $prod_row->product_video;

$product_discount = $prod_row->discount_price;

if ($product_discount) {
    $sell_price = $product_discount;
} else {
    $sell_price = $product_price;

}

/*# review rating #*/
$total_rating = $total_review = $avg_rating = 0;
$reviews = get_review($prod_row->product_id);


if (isset($reviews)) {
    foreach ($reviews as $review) {
        $rating[] = $review->rating;
    }
    $total_rating = array_sum($rating);
    $total_review = count($reviews);
    $avg_rating = number_format((($total_rating) / ($total_review)), 2);
}


$five_starr = rating_counter($prod_row->product_id, 5);
$four_starr = rating_counter($prod_row->product_id, 4);
$three_starr = rating_counter($prod_row->product_id, 3);
$two_starr = rating_counter($prod_row->product_id, 2);
$one_starr = rating_counter($prod_row->product_id, 1);
$five_star = $five_starr->rating;

$four_star = $four_starr->rating;
$three_star = $three_starr->rating;
$two_star = $two_starr->rating;
$one_star = $one_starr->rating;
$summery = $prod_row->product_summary;
?>


<style>

    .increament_decreament_class {
        margin-left: 15px;
    }

    @media (max-width: 634px) {
        .increament_decreament_class {
            margin-left: 0px;

        }

    }

</style>


<div class="container container-fullwidth" style="margin-bottom: -79px;">
    <nav class="bg-white">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-decoration-none"><a href="<?php echo base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active"><a
                    href="<?php echo base_url() ?><?= $breadcumb_category_link ?>">            <?= $breadcumb_category ?>
                </a></li>
            <li class="breadcrumb-item active"><?= $prod_row->product_title ?></li>
        </ol>
    </nav>
</div>
<div class="xs-section-padding xs-product-details-section">
    <div class="container">
        <div class="row">
            <div id="desktop_picture" class="col-lg-4" style="margin-left: -55px;">


                <img width="100%" class="img-fluid" id="zoom_09" style="z-index: 999999" src="<?= $featured_image ?>"
                     alt="<?= $product_title ?>">
                <div id="gallery_09">


                    <div id="gallery_09" style="margin-top: 10px;">

                        <a href="javascript:void(0)" style="z-index: 9999999" class="elevatezoom-gallery active"
                           data-image="<?= $featured_image ?>"
                           data-zoom-image="<?= $featured_image ?>">
                            <img
                                src="<?= $featured_image ?>"
                                width="50" alt="<?= $product_title ?>"></a>

                        <?php
                        $gallery_image_meta = get_product_meta($prod_row->product_id, 'gallery_image');
                        $gallery_image = explode(",", $gallery_image_meta);

                        foreach ($gallery_image as $gallery_id) {
                            $gallery = get_media_path($gallery_id);

                            if (isset($gallery)) {


                                ?>


                                <a href="javascript:void(0)" class="elevatezoom-gallery active"
                                   data-image="<?= $gallery ?>"
                                   data-zoom-image="<?= $gallery ?>">
                                    <img
                                        src="<?= $gallery ?>"
                                        width="50" alt="<?= $product_title ?>"></a>


                            <?php }
                        } ?>

                    </div>

                </div>


            </div>

            <div id="mobile_picture" class="demo col-lg-4">
                <ul id="lightSlider">
                    <li data-thumb="<?= $featured_image ?>">
                        <img src="<?= $featured_image ?>" alt="<?= $product_title ?>"/>
                    </li>
                    <?php
                    $gallery_image_meta = get_product_meta($prod_row->product_id, 'gallery_image');
                    if (!empty($gallery_image_meta)) {

                        $gallery_image = explode(",", $gallery_image_meta);
                        if (count($gallery_image) > 0) {
                            foreach ($gallery_image as $gallery_id) {
                                $gallery = get_media_path($gallery_id);

                                ?>
                                <li data-thumb="<?= $gallery ?>">
                                    <img src="<?= $gallery ?>" alt="<?= $product_title ?>"/>
                                </li>
                            <?php }
                        }
                    } ?>
                </ul>
            </div>

            <div class="col-lg-5">
                <div class="summary-content single-product-summary">

                    <h4><?= $product_title ?></h4>
					<span class="star-rating color-green">
                        <span class="value">(<?php if (isset($total_review)) {
                                echo $total_review;
                            } ?> Customers review)</span>

                    </span>
                    <h6>Product Code: <?= $sku ?></h6>
                    <div class="availability in-stock">Availability: <span><?= $product_availability ?></span></div>
					<span style="color:#00B050;font-size:23px;" class="price highlight">
                        <del style="color:red">
                            <?php
                            if ($product_discount) {
                                echo 'Regular Price:';
                                ?><?= formatted_price($product_price) ?><?php
                            }
                            ?>
                        </del>

                        <?php if ($product_discount) { ?>

                            Discounted  Price:
                        <?php } else { ?>
                            Regular Price:
                        <?php } ?>

                        <?= formatted_price($sell_price) ?>
                    </span>
                    <?php

                    $summeryy = trim($prod_row->product_summary);
                    if (strlen($summeryy) > 0) {
                        ?>
                        <div style="margin-top: 13px;margin-bottom: -20px;">

                            <?php echo $summeryy; ?>

                        </div>
                    <?php } ?>


                    <br/>
                    <div class="xs-add-to-chart-form row">
                        <div class="col-lg-12">
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        //$product_of_size = array();

                                        $product_of_size = $prod_row->product_of_size;
                                        $product_of_size = explode(",", $product_of_size);


                                        if (sizeof($product_of_size) > 1) {


                                            echo "<span style='color:red;'>Product Sizes * </span>";
                                            foreach ($product_of_size as $size):

                                                ?>
                                                <input type="radio" class="product_size" name="product_size"
                                                       id="product_size_<?php echo $size; ?>"
                                                       value="<?php echo $size; ?>"/>&nbsp;&nbsp;<?php echo $size; ?>&nbsp;</label>


                                                <?php
                                            endforeach;
                                        }

                                        ?>

                                        <?php
                                        //$product_of_size = array();

                                        $product_colors = $prod_row->product_color;
                                        $product_colors = explode(",", $product_colors);


                                        if (sizeof($product_colors) > 1) {


                                            echo "<br><span style='color:red;'>Product Colors * </span>";
                                            foreach ($product_colors as $color):

                                                ?>
                                                <input type="radio" class="product_color" name="product_color"
                                                       id="product_color_<?php echo $color; ?>"
                                                       value="<?php echo $color; ?>"/>&nbsp;&nbsp;<?php echo $color; ?>&nbsp;</label>


                                                <?php
                                            endforeach;
                                        }

                                        ?>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-6 increament_decreament_class">
                                            <div class="btn-group">
                                                <button type="button"
                                                        class="quantity-left-minus decrement_plus  btn-number"
                                                        data-type="minus" data-field="">
                                                    <i class="fa fa-fw fa-minus"></i>
                                                </button>


                                                <input type="text" id="quantity" style="width: 44px;
text-align: center;" name="quantity" class="form-control input-number" value="1"
                                                       min="1" max="100">

                                                <button type="button"
                                                        class="quantity-right-plus increament_plus  btn-number"
                                                        data-type="plus" data-field="">
                                                    <i class="fa fa-fw fa-plus"></i>
                                                </button>

                                            </div>
                                        </div>

                                        <?php if (sizeof($product_colors) > 1 || sizeof($product_colors) > 1) : ?>
                                            <div class="col-md-6 col-6">
                                                <div class="btn-group " style="width: 500px">


                                                    <a
                                                        id="add_to_cart" href="javascript:void(0)"
                                                        class="   add_to_cart_single"
                                                        data-product_id="<?= $prod_row->product_id ?>"
                                                        data-product_price="<?= $sell_price ?>"
                                                        data-product_title="<?= $prod_row->product_title ?>">
                                                        <span class="glyphicon glyphicon-shopping-cart"></span>
                                                        Add to Cart </a>
                                                    <a id="buy_now" href="javascript:void(0)" id="buy_now"
                                                       href="javascript:void(0)"
                                                       class="  buy_now_single"
                                                       data-product_id="<?= $prod_row->product_id ?>"
                                                       data-product_price="<?= $sell_price ?>"
                                                       data-product_title="<?= $prod_row->product_title ?>">
                                                        Buy Now </a>
                                                </div>
                                            </div>
                                        <?php else : ?>

                                            <div class="col-md-5 col-6">
                                                <div class="btn-group " style="width: 500px">


                                                    <a
                                                        id="add_to_cart" href="javascript:void(0)"
                                                        class="  add_to_cart"
                                                        data-product_id="<?= $prod_row->product_id ?>"
                                                        data-product_price="<?= $sell_price ?>"
                                                        data-product_title="<?= $prod_row->product_title ?>">
                                                        <span class="glyphicon glyphicon-shopping-cart"></span>
                                                        Add to Cart </a>
                                                    <a id="buy_now" href="javascript:void(0)" class="buy_now"
                                                       data-product_id="<?= $prod_row->product_id ?>"
                                                       data-product_price="<?= $sell_price ?>"
                                                       data-product_title="<?= $prod_row->product_title ?>">
                                                        Buy Now </a>
                                                </div>
                                            </div>
                                        <?php endif; ?>


                                    </div>
                                </div>


                                <div class="clearfix"></div>


                            </form>
                        </div>

                    </div>


                </div>
            </div>

            <style>
                .desktop_servece_id h6{
                   font-weight: bold;

                }
                .desktop_servece_id p{
                    font-weight: normal;
                    font-size: 13px;

                }

                </style>

            <div class="col-lg-3 desktop_servece_id" style="margin-top: -65px;">
                <div class="row">
                    <div class="col-lg-3">

	<span class="fa-stack fa-2x icon" style="margin-top: 16px;
position: relative;
top: 65px;
color:#219291
">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-truck fa-stack-1x fa-inverse" style="margin-top: 10px;"></i>
            </span>

                    </div>

                    <div class="col-lg-12" style="margin: -1px 60px;margin-bottom: -71px;">


                        <h6>Delivery Timing</h6>
                        <p><?php echo get_option('delevery_timing') ?></p>


                    </div>


                </div>


                <div class="row">
                    <div class="col-lg-3">

	<span class="fa-stack fa-2x icon" style="margin-top: 16px;
position: relative;
top: 65px;
color:#219291
">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-users fa-stack-1x fa-inverse" style="margin-top: 10px;"></i>
            </span>

                    </div>

                    <div class="col-lg-12" style="margin: -1px 60px;margin-bottom: -71px;">


                        <h6>Customer Service</h6>
                        <p><?php echo get_option('customer_service') ?></p>


                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-3">

	<span class="fa-stack fa-2x icon" style="margin-top: 16px;
position: relative;
top: 65px;
color:#219291
">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-reply fa-stack-1x fa-inverse" style="margin-top: 10px;"></i>
            </span>

                    </div>

                    <div class="col-lg-12" style="margin: -1px 60px;margin-bottom: -71px;">


                        <h6>Easy Returns</h6>
                        <p><?php echo get_option('easy_return') ?></p>


                    </div>


                </div>


            </div>

        </div>
    </div>
</div><!-- end product info section -->

<!-- product details section -->
<div class="xs-section-padding-bottom">
    <div class="container">
        <ul class="nav nav-tabs xs-nav-tab version-4" id="myTab" role="tablist">

            <li class="nav-item">
                <a class="nav-link active " id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                   aria-controls="profile" aria-selected="false">Descriptions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                   aria-selected="true">Specification</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="video-tab" data-toggle="tab" href="#video" role="tab"
                   aria-controls="video" aria-selected="false">Video</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="guarantees-tab" data-toggle="tab" href="#guarantees" role="tab"
                   aria-controls="guarantees" aria-selected="false">Terms and Conditons</a>
            </li>




            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                   aria-controls="contact" aria-selected="false">Reviews <span>(<?php if (isset($total_review)) {
                            echo $total_review;
                        } ?> Ratings)</span></a>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane animated slideInUp show active" id="profile" role="tabpanel"
                 aria-labelledby="profile-tab">


                <?= ($prod_row->product_description) ?>


            </div>

            <div class="tab-pane animated slideInUp " id="home" role="tabpanel" aria-labelledby="home-tab">

                <table class="table table-bordered">
                    <colgroup>
                        <col width="25%">
                        <col>
                    </colgroup>
                    <tbody>

                    <?php

                    if (isset($specifications)) {


                        foreach ($specifications as $specification) {
                            //  print_r($specification);

                            if ($specification->key == '') {
                                continue;
                            } else {
                                ?>

                                <tr class="first odd">
                                    <th class="label"><?php echo $specification->key; ?></th>
                                    <td class="data last"><?php echo $specification->value; ?></td>
                                </tr>

                            <?php }
                        }
                    } ?>
                    </tbody>
                </table>


            </div>


            <div class="tab-pane animated slideInUp" id="guarantees" role="tabpanel" aria-labelledby="guarantees-tab">
                <?php

                $term_name = $prod_row->product_terms;
                if (empty($term_name)) {

                    echo get_option('default_product_terms');

                } else {
                    echo $term_name;
                }

                ?>

            </div>
            <div class="tab-pane animated slideInUp" id="video" role="tabpanel" aria-labelledby="video-tab">
                <?php
                if (!empty($product_video)) {
                    ?>
                   

                    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?=$product_video?>" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    <?php
                }
                ?>
            </div>
            <div class="tab-pane animated slideInUp" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="rate-detail">
                                    <ul class="rate-list">
                                        <li>
                                            <span class="rate-title">5 Stars</span>
											<span class="rate-graph">
                                                <span class="rate-graph-bar" data-percent="90" style="width:100% !important "></span>
                                            </span>
                                            <span class="star-rating" data-value="5"><?php if(isset($five_star)) { echo $five_star;} ?></span>
                                        </li>
                                        <li>
                                            <span class="rate-title">4 Stars</span>
											<span class="rate-graph">
                                                <span class="rate-graph-bar" data-percent="80" style="width:80% !important "></span>
                                            </span>
                                            <span class="star-rating" data-value="4" ><?php if(isset($four_star)) { echo $four_star;} ?></span>
                                        </li>
                                        <li>
                                            <span class="rate-title">3 Stars</span>
											<span class="rate-graph">
                                                <span class="rate-graph-bar" data-percent="60" style="width:60% !important "></span>
                                            </span>
                                            <span class="star-rating" data-value="3"><?php if(isset($three_star)) { echo $three_star;} ?></span>
                                        </li>
                                        <li>
                                            <span class="rate-title">2 Stars</span>
											<span class="rate-graph">
                                                <span class="rate-graph-bar" data-percent="40" style="width:40% !important "></span>
                                            </span>
                                            <span class="star-rating" data-value="2"><?php if(isset($two_star)) { echo $two_star;} ?></span>
                                        </li>
                                        <li>
                                            <span class="rate-title">1 Stars</span>
											<span class="rate-graph">
                                                <span class="rate-graph-bar" data-percent="20" style="width:20% !important "></span>
                                            </span>
                                            <span class="star-rating" data-value="1"><?php if(isset($one_star)) { echo $one_star;} ?></span>
                                        </li>
                                    </ul>
                                    <?php


                                    $userid = $this->session->userdata('user_id');
                                    $name = $this->session->userdata('user_f_name');
                                    $email = $this->session->userdata('user_email');
                                    ?>
                                    <p id="review_success_message" class="text-success"></p>
                                    <form class="form-vertical reviewform" id="main_login_check">
                                        <fieldset class="field field-rating srating">
                                            <input type="radio" id="star5" name="rating" value="5">
                                            <label class="full" for="star5" title="5 stars"></label>
                                            <input type="radio" id="star4" name="rating" value="4">
                                            <label class="full" for="star4" title="4 stars"></label>
                                            <input type="radio" id="star3" name="rating" value="3">
                                            <label class="full" for="star3" title="3 stars"></label>
                                            <input type="radio" id="star2" name="rating" value="2">
                                            <label class="full" for="star2" title="2 stars"></label>
                                            <input type="radio" id="star1" name="rating" value="1">
                                            <label class="full" for="star1" title="1 star"></label>
                                        </fieldset>
                                        <div class="form-group">
                                            <?php

                                            $name=$this->session->userdata('user_f_name');
                                            $email=$this->session->userdata('user_email');
                                            ?>
                                            <input type="text" readonly name="name" id="rating_name"
                                                   class="form-control field field-name"
                                                   placeholder="Name" value="<?php if(isset($name)){ echo $name;}?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" readonly value="" id="rating_email" name="email"
                                                   class="form-control field field-email"
                                                   placeholder="Email" value="<?php if(isset($email)){ echo $email;}?>">
                                        </div>
                                        <div class="form-group">
											<textarea rows="3" name="comment" class="form-control field field-comment"
                                                      placeholder="Comments"></textarea>
                                        </div>

                                        <input type="hidden" name="product_id" value="<?= $prod_row->product_id ?>">
                                        <button style="background-color: green" type="button" id="reviewbtn" class="btn btn-success form-control">
                                            Submit Review
                                        </button>


                                    </form>

                                    <form class="form-vertical reviewform" id="login_rating">
                                        <li>Please login /<a href="<?php echo base_url()?>affiliate/login_signup" >Signup </a>to write a review</li>
                                        <h6 class="text-danger" id="login_rating_error"></h6>

                                        <div class="form-group">
                                            <input type="text" name="phone" id="phone"
                                                   class="form-control field field-name"
                                                   placeholder="Phone" value="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" value="" name="password" id="password"
                                                   class="form-control field field-email"
                                                   placeholder="Password">
                                        </div>


                                        <button style="background-color: green" type="button" id="login_rating_submit"
                                                class="btn btn-success form-control">
                                            Login
                                        </button>


                                    </form>
                                    <input type="hidden" name="user_id" value="<?php if (isset($userid)) {
                                        echo $userid;
                                    } ?>">

                                    <br>
                                    <br>
                                    <li><a href="#" class="btn btn-primary btn-sm" id="write_your_rivew">Write Your
                                            review</a></li>
                                </div>
<br>
                                <div class="rating-overall-desc">

                                <ul class="commentlist">

                                    <?php
                                    if (isset($reviews) > 0) {
                                        foreach ($reviews as $review) {
                                            $total_review=$review->rating;
                                            ?>

                                            <li class="comment even thread-even depth-1">
                                                <div class="review-user review-header">
                                                    <div class="rating">
                                                        <span style="width:<?= $total_review*20?>%"></span>
                                                    </div>
                                                    <br>
                                                    <h6 itemprop="author">By <span style="border-bottom: dotted;"><b><?= $review->name ?></b></span><img style="margin-left: 8px;
margin-right: 3px;
vertical-align: sub;width: 20px;" src="<?php echo base_url()?>images/verified.png"> Verified
                                                        on <small style="border-bottom: dotted;" > <?php echo date('d F Y', strtotime($review->created_time)); ?></small></h6>

                                                </div>
                                                <div class="review-body">
                                                    <div class="review-text" itemprop="description">
                                                        <p><?= $review->comment ?></p>
                                                    </div>
                                                </div>
                                            </li>

                                            <?php
                                        }
                                    } ?>


                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .container END -->
</div><!-- end product details section -->

<!-- product info section -->

<div class="col-lg-3 mobile_servece_id" style="margin-top: 8px;

margin-bottom: 16px;">
    <hr style="margin-bottom: -51px;">
    <div class="row">
        <div class="col-lg-3">

	<span class="fa-stack fa-2x icon" style="margin-top: 16px;
position: relative;
top: 65px;
color:#219291
">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-truck fa-stack-1x fa-inverse" style="margin-top: 10px;"></i>
            </span>

        </div>

        <div class="col-lg-12" style="margin: -1px 60px;margin-bottom: -71px;">


            <h2>Delivery Timing</h2>
            <p><?php echo get_option('delevery_timing') ?></p>


        </div>


    </div>


    <div class="row">
        <div class="col-lg-3">

	<span class="fa-stack fa-2x icon" style="margin-top: 16px;
position: relative;
top: 65px;
color:#219291
">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-users fa-stack-1x fa-inverse" style="margin-top: 10px;"></i>
            </span>

        </div>

        <div class="col-lg-12" style="margin: -1px 60px;margin-bottom: -71px;">


            <h2>Customer Service</h2>
            <p><?php echo get_option('customer_service') ?></p>


        </div>
    </div>


    <div class="row">
        <div class="col-lg-3">

	<span class="fa-stack fa-2x icon" style="margin-top: 16px;
position: relative;
top: 65px;
color:#219291
">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-reply fa-stack-1x fa-inverse" style="margin-top: 10px;"></i>
            </span>

        </div>

        <div class="col-lg-12" style="margin: -1px 60px;margin-bottom: -71px;">


            <h2>Easy Returns</h2>
            <p><?php echo get_option('easy_return') ?></p>


        </div>


    </div>


</div>

<br/><br/>
<br/>
<br/><br/>

    <section class="xs-section-padding bg-gray" style="margin-top: -74px;">
    <div class="container" style="margin-top: -60px;margin-bottom: -79px;">
        <div class="xs-content-header version-2">
            <h2 class="xs-content-title">Related Products</h2>
            <div class="clearfix"></div>
        </div>
        <input type="hidden" name="related_category" value="<?php echo $product_cats; ?>">

        <div class="row">
          

                <div id="load_data"></div>
                <div id="load_data_message"></div>

               
             
        </div><!-- .row END -->


    </div><!-- .container END -->
</section><!-- end product info section -->

    <script>
        jQuery(document).ready(function () {

            var limit = 24;
            var start = 0;
            var action = 'inactive';
            var related_category = jQuery('input[name=related_category]').val();

            function load_data(limit, start) {


                $.ajax({
                    url: "<?php echo base_url(); ?>Ajax/scroll_related_product",
                    method: "POST",
                    data: {limit: limit, start: start, category_id: related_category},
                    cache: false,
                    success: function (data) {

                        if (data == '') {
                            jQuery('#load_data_message').html('<h3>No More Result Found</h3>');
                            action = 'active';
                        } else {
                            jQuery('#load_data').append(data);
                            jQuery('#load_data_message').html("");
                            action = 'inactive';
                        }
                    }
                })
            }

            if (action == 'inactive') {
                action = 'active';
                load_data(limit, start);
            }

            $(window).scroll(function () {
                if (action == 'inactive') {

                    action = 'active';
                    start = start + limit;

                        load_data(limit, start);

                }
            });

        });
    </script>


    <script>

    $(document).on('click', '.geleary_image_id', function () {
        var image = $(this).attr("src");
        $("#zoom_09").attr("src", image);
        //	$("#zoom_09").attr("data-zoom-image",image);
        //alert(image)
    });


    $('#reviewbtn').on('click', function () {


        $('.reviewform').find('.field').removeClass('validation-error');

        var rating = $('.reviewform input[name=rating]:checked').val();
        var name = $('.reviewform input[name=name]').val();
        var email = $('.reviewform input[name=email]').val();
        var comment = $('.reviewform textarea[name=comment]').val();
        var product_id = $('.reviewform input[name=product_id]').val();
        var base_url = '<?php echo base_url()?>';


        if (typeof (rating) == 'undefined') {
            $('.reviewform .field-rating').addClass('validation-error');
            return false;
        }
        if (name == '') {
            $('.reviewform .field-name').focus();
            $('.reviewform .field-name').addClass('validation-error');
            return false;
        }

        if (comment == '') {
            $('.reviewform .field-comment').focus();
            $('.reviewform .field-comment').addClass('validation-error');
            return false;
        }

        var ajax_url = base_url + 'ajax/add_to_review';

        $.ajax({
            type: 'POST',
            data: {
                "rating": rating,
                "name": name,
                "email": email,
                "comment": comment,
                "product_id": product_id
            },
            url: ajax_url,

            success: function (result) {

              $('#main_login_check').hide();
               $('#review_success_message').text('Review added successfully...')
            }
        });
    });

</script>


<script>
    $(document).ready(function () {
        $('body').on('click', '.add_to_cart_single', function () {
            var this_link = $(this);
            var product_id = $(this).attr('data-product_id');
            var product_price = $(this).attr('data-product_price');
            var product_title = $(this).attr('data-product_title');
            var product_size = $("input[name='product_size']:checked").val();
            var product_color = $("input[name='product_color']:checked").val();

            if (product_size && product_color) {
                var product_qty = 1;

                if ($("input#quantity").length > 0) {
                    product_qty = $("input#quantity").val();
                }


                $.ajax({
                    type: 'POST',
                    data: {
                        "product_id": product_id,
                        "product_qty": product_qty,
                        "product_price": product_price,
                        "product_title": product_title,
                        "product_size": product_size,
                        "product_color": product_color
                    },
                    url: '<?php echo base_url()?>ajax/add_to_cart',

                    success: function (result) {


                        var response = JSON.parse(result);
                        $('.xs-item-count').text(total_result);


                    }
                });

                return false;
            } else {

                alert('Enter the Product Size or Color');
            }
        });


        $('body').on('click', '.buy_now_single', function () {
            var product_id = $(this).attr('data-product_id');
            var product_price = $(this).attr('data-product_price');
            var product_title = $(this).attr('data-product_title');

            var product_size = $("input[name='product_size']:checked").val();
            var product_color = $("input[name='product_color']:checked").val();
            if (product_size && product_color) {

                var product_qty = 1;

                if ($("input#quantity").length > 0) {
                    product_qty = $("input#quantity").val();
                }

                $.ajax({
                    type: 'POST',
                    data: {
                        "product_id": product_id,
                        "product_qty": product_qty,
                        "product_price": product_price,
                        "product_title": product_title,
                        "product_size": product_size,
                        "product_color": product_color
                    },
                    url: '<?php echo base_url()?>ajax/add_to_cart',

                    success: function (result) {


                        var location = '<?php echo base_url() ?>chechout';
                        //window.location('')
                        window.location.href = location;
                    }
                });

                return false;
            } else {
                alert('Enter the Product Size or Color');

            }
        });


    });
</script>

<script>
    $(document).ready(function () {

        var quantitiy = 0;
        $('.quantity-right-plus').click(function (e) {

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            $('#quantity').val(quantity + 1);


            // Increment

        });

        $('.quantity-left-minus').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            // Increment
            if (quantity > 0) {
                $('#quantity').val(quantity - 1);
            }
        });

    });


    $('#mobile_picture').hide();
    var width = window.innerWidth
        || document.documentElement.clientWidth
        || document.body.clientWidth;
    if (width < 900) {

        $('#mobile_picture').show();
        $('#desktop_picture').hide();


    } else {
        $('#mobile_picture').hide();
        $('#desktop_picture').show();


    }


</script>


<script>


    /****************** add single product ********************/

    $(document).on('click', '.add_to_cart_releted_product', function () {
        var product_id = $(this).attr('data-product_id');
        var product_price = $(this).attr('data-product_price');
        //var product_size = $('#product_size').val();
        var product_title = $(this).attr('data-product_title');
        var product_qty = 1;

        $.ajax({
            type: 'POST',
            data: {
                "product_id": product_id,
                "product_qty": product_qty,
                "product_price": product_price,
                "product_title": product_title

            },
            url: '<?php echo base_url()?>ajax/add_to_cart',
            success: function (result) {
                var total_result = JSON.parse(result);
                $('.xs-item-count').text(total_result.cart_items);
                $('#total_item_bag').text(total_result.cart_items);
                $('#total_amount_bag').text(total_result.cart_total);


            }

        });
        return false;
    });

    /****************** buy single product ********************/
    jQuery(document).on('click', '.buy_now_releted_product', function () {
        var product_id = jQuery(this).attr('data-product_id');
        var product_price = jQuery(this).attr('data-product_price');
        var product_title = jQuery(this).attr('data-product_title');

        var product_qty = 1;


        jQuery.ajax({
            type: 'POST',
            data: {
                "product_id": product_id,
                "product_qty": product_qty,
                "product_price": product_price,
                "product_title": product_title
            },
            url: '<?php echo base_url()?>ajax/add_to_cart',
            success: function (result) {

                var total_result = JSON.parse(result);

                $('#shoping_bag .itemno').text(total_result);
                var location = '<?php echo base_url() ?>chechout';

                window.location.href = location;
            }
        });

        return false;
    });
</script>

<script>

    $('#login_rating_submit').click(function () {
        var phone = $('input[name=phone]').val();
        var password = $('input[name=password]').val();
        if (phone.length < 11 || password.length < 1) {
            $('#login_rating_error').text("Fill up all the field");


        } else {
            $.ajax({
                url: "<?php echo base_url()?>Affiliate/login_check_rating",
                method: "POST",
                dataType: "json",
                data: {user_email: phone, user_password: password},
                success: function (result) {

                    var name = result.user_f_name;
                    var email = result.user_email;
                    var user_id = result.user_id;
                    $('input[name=user_id]').val(user_id);


                    var login = result.login;
                    if (login == 'Login Successfully') {
                        $('#main_login_check').show();
                        $('#login_rating').hide();
                        var phone = $('#rating_email').val(email);
                        var password = $('#rating_name').val(name);
                        $('#login_rating_error').text("Login Successfully");


                    } else {
                        $('#login_rating_error').text("Incorrect Mobile number or password");
                        $('#main_login_check').hide();
                        $('#login_rating').show();


                    }


                },
                errors: function () {
                    alert(result);
                }
            });
        }
    });
</script>


<script>
    var user_id = $('input[name=user_id]').val();
    $('#login_rating').hide();

    if (user_id) {
        $('#main_login_check').show();
        $('#write_your_rivew').hide();
    } else {
        $('#main_login_check').hide();
        $('#write_your_rivew').show();


    }
    $('#write_your_rivew').click(function () {
        $(this).hide();
        $('#login_rating').show();

    });
</script>