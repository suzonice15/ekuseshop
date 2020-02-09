<?php
$uri_string = uri_string();
$site_title = get_option('site_title');
$page_title = isset($page_title) ? $page_title : $site_title;
$og_image = $logo = get_option('logo');
$favicon = get_option('icon');


if (isset($seo_title) && !empty($seo_title)) {
    $title = $seo_title;
} else {
    $title = $page_title . (!empty($uri_string) ? ' | ' . $site_title : NULL);
}


if (isset($prod_row)) {
    $og_image = get_product_meta($prod_row->product_id, 'featured_image');
    $og_image = get_media_path($og_image);
}


$cart_items = 0;
foreach ($this->cart->contents() as $key => $val) {
    if (!is_array($val) OR !isset($val['price']) OR !isset($val['qty'])) {
        continue;
    }
    $cart_items += $val['qty'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?= $title ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta charset="utf-8">

    <link rel="shortcut icon" href="<?= $favicon ?>">

    <meta name="description" content="<?= isset($seo_content) ? $seo_content : $page_title ?>"/>
    <meta name="keywords" content="<?= isset($seo_keywords) ? $seo_keywords : $page_title ?>"/>
    <meta name="robots" content="noodp"/>
    <link rel="canonical" href="<?= base_url() ?>"/>
    <meta property="og:locale" content="EN"/>
    <meta property="og:url" content="<?= current_url() ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="<?= $page_title ?>"/>
    <meta property="og:description" content="<?= $page_title ?>"/>
    <meta property="og:image" content="<?= $og_image ?>"/>
    <meta property="og:site_name" content="<?= $site_title ?>"/>

    <link rel="image_src" href="<?= $og_image ?>"/>
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
    <script src='https://www.google.com/recaptcha/api.js'></script>


    <!--For Plugins external css-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/plugins.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/mobile_menu.css"/>
    <!--Theme custom css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/mycustom.css">

    <!--Theme Responsive css-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontend/css/responsive.css"/>
    <script src="<?php echo base_url(); ?>assets/fontend/js/jquery-3.2.1.min.js"></script>
    <!--	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>-->


</head>
<body>

<style>
    .sticky_class {
        position: fixed;
        top: -64px;
        border: 2px solid #ddd;
        background-color: #F7F7F7;
        z-index: 99999;
        height: 64px;
        margin-top: 55px;
        width: 100%;
    }

    .sticky_mobile_class {
        position: fixed;
        top: -66px;

        background-color: #fff;
        z-index: 99999;
        height: 53px;
        margin-top: 55px;
        width: 100%;
    }

    .top_sticky_category_menu {
    }

    .sticy_menu_id {
        position: relative;
        top: -24px;
        left: 44px;
    }

    .sticy_menu_id1 {
        position: relative;
        top: 1px;
        left: 44px;
    }
</style>


<div class="xs-top-bar d-none d-md-none d-lg-block d-print-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">

                    <div class="col-lg-6">
                        <ul class="xs-social-list">
                            <li class="xs-list-text">Follow Us</li>
                            <li><a target="_blank" href="<?php echo get_option('facebook'); ?>"><i
                                        class="icon icon-facebook"></i></a>
                            </li>
                            <li><a target="_blank" href="<?php echo get_option('youtube'); ?>"><i
                                        class="icon icon-youtube-v"></i></a>
                            </li>
                            <li><a target="_blank" href="<?php echo get_option('twitter'); ?>"><i
                                        class="icon icon-twitter"></i></a>
                            </li>


                            <li><a target="_blank" href="<?php echo get_option('instagram'); ?>"><i
                                        class="icon icon-instagram"></i></a></li>
                        </ul><!-- .xs-social-list END -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="xs-top-bar-info right-content">
                    <?php

                    $active = $this->session->userdata('user_status');
                    $user_f_name = $this->session->userdata('user_f_name');
                    $user_l_name = $this->session->userdata('user_l_name');
                    $name = $user_f_name . ' ' . $user_l_name;
                    if ($active == 'active') {

                        ?>
                        <li>
                            <div class="dropdown">
                                <button type="button" class=" dropdown-toggle" data-toggle="dropdown"
                                        style="background-color: #F5F5F5;color: black;border: none;">
                                    Welcome <?php echo $name ?>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" style="z-index:9999999999">
                                    <a class="dropdown-item" href="<?php echo base_url() ?>Affiliate/my_account">My
                                        ACCOUNT</a>
                                    <a class="dropdown-item" href="<?php echo base_url() ?>Affiliate/logOut">Sign
                                        Out</a>

                                </div>
                            </div>
                        </li>
                    <?php } else { ?>

                        <li><a href="<?=base_url()?>affiliate/login_signup"  >Login / signup</a></li>
                    <?php } ?>


                </ul><!-- .xs-top-bar-info END -->

            </div>
        </div><!-- .row END -->
    </div><!-- .container END -->
</div>

<!-- xs modal -->
<div class="modal xs-modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="icon icon-cross"></span>
            </button>
            <ul class="nav nav-tabs xs-tab-nav" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#login" role="tab" data-toggle="tab">
                        Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#signup" role="tab" data-toggle="tab">
                        Signup
                    </a>
                </li>
            </ul><!-- xs-tab-nav -->
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fadeInRights show fade in active" id="login">
                    <p id="sign_up_login_error" class="text-danger"></p>
                    <form action="#" method="POST" class="xs-customer-form">
                        <div class="input-group input-group-append">
                            <input type="text" class="form-control" id="mobile_value" name="mobile_value"
                                   placeholder="Enter Your Mobile">
                            <i class="icon icon-profile-male input-group-text"></i>
                        </div>
                        <div class="input-group input-group-append">
                            <input type="password" name="user_password" id="user_password_login" class="form-control"
                                   placeholder="Enter Your Password">
                            <i class="icon icon-key2 input-group-text"></i>
                        </div>

                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">

                            <div class="btn-group mr-2" role="group" aria-label="Second group">
                                <button type="button" id="user_login" class="btn btn-primary">Sign In</button>
                            </div>
                            <div class="btn-group" role="group" aria-label="Third group">
                                <a target="_blank" href="<?php echo base_url() ?>home/password_reset"
                                   style="margin-top: 11px;margin-left: 18px;">Forgot Your Password ?</a>

                            </div>
                        </div>
                        <!-- .xs-customer-form END
                    <p>or</p>
                    <a href="javascript:void" class="btn btn-info btn-block" id="facebookLogin" >Login with your facebook</a>
-->
                    </form><!-- .xs-customer-form END -->
                </div><!-- tab-pane #login -->
                <div role="tabpanel" class="tab-pane fadeInRights fade" id="signup">
                    <p id="login_up_sign_error" class="text-danger"></p>

                    <form action="<?php echo base_url() ?>Affiliate/login_check" method="POST" class="xs-customer-form">

                        <div class="input-group input-group-append">
                            <input type="text" name="user_f_name" class="form-control"
                                   placeholder="Enter your  name">
                            <i class="icon icon-profile-male input-group-text"></i>
                        </div>
                        <div class="input-group input-group-append">
                            <input name="user_mobile" id="user_mobile" type="text" class="form-control"
                                   placeholder="Enter your mobile">
                            <i class="icon icon-phone input-group-text"></i>
                        </div>
                        <p id="user_phone_error"></p>


                        <div class="input-group input-group-append">
                            <input name="user_email" id="user_email" type="email" class="form-control"
                                   placeholder="Enter your email">
                            <i class="icon icon-envelope2 input-group-text"></i>
                            <br>

                        </div>
                        <p id="user_email_error"></p>
                        <div class="input-group input-group-append">
                            <input name="user_password" type="password" id="user_passwor_signup" class="form-control"
                                   placeholder="Enter your password">
                            <i class="icon icon-key2 input-group-text"></i>
                        </div>

                        <p id="user_passowrd_error"></p>

                        <button type="button" id="signUp" class="btn btn-primary btn-block">Signup</button>
                        <!-- .xs-customer-form END
                     <p>or</p>
                     <a href="javascript:void" class="btn btn-info btn-block" id="facebookLogin" >Login with your facebook</a>
-->                   </form><!-- .xs-customer-form END -->
                </div><!-- tab-pane #signup -->
            </div><!-- tab-content -->
        </div>
    </div>
</div><!-- End xs modal --><!-- End topBar section -->

<!-- header section -->
<header class="xs-header version-fullwidth d-print-none">
    <!-- nav bar section -->
    <div class="xs-navBar v-yellow  mobile_margin_class_suzon">
        <div class="container container-fullwidth">
            <div class="row">
                <div class="col-lg-2 col-sm-4 xs-order-1" style="margin-top: -12px;">
                    <div class="xs-logo-wraper hide_class_suzon">
                        <a href="<?php echo base_url() ?>">
                            <img src="<?php echo get_option('logo') ?>" alt="">
                        </a>

                    </div>

                </div>
                <div class=" justify-content-center  col-lg-6 col-sm-3 xs-order-3 xs-menus-group ">
                    <nav class="xs-menus">
                        <div class="nav-header">
                            <div class="nav-toggle"></div>
                        </div><!-- .nav-header END -->
                        <div class="nav-menus-wrapper hide_class_suzon ">
                            <style>
                                .hide_class_suzon ul li a:hover{color:red !important;}
                                </style>

                            <ul class="nav-menu top_menu_style">
                                <li><a href="<?php echo base_url(); ?>">Home</a>


<!---->
<!---->
<!--                                <li><a href="--><?php //echo base_url(); ?><!--all-products">All Products</a>-->
                                <li><a href="<?php echo base_url(); ?>pages/contact-us">Contact us</a>
                                <li><a href="<?php echo base_url(); ?>pages/affiliate-program">Affiliate</a>


                                </li>
                                <li><a href="<?php echo base_url(); ?>chechout">Checkout</a>

                                <li><a href="<?php echo base_url(); ?>affiliate/my_account">My Account</a>


                                </li>
                            </ul>
                        </div><!-- .nav-menus-wrapper END -->
                    </nav><!-- .xs-menus END -->
                </div>

                <div class="col-lg-2 col-sm-3 xs-order-3 xs-menus-group">
                    <nav class="xs-menus">

                        <br>
                        <ul class="xs-header-info">
                            <li class="d-none d-md-none d-lg-block" style="color:#FF0066;margin-top:15px"><img
                                    style="margin-top: -9px;" width="35px"
                                    src="<?php echo base_url() ?>images/phone.gif"><span style="font-size: 17px;
font-family: " Courier New ", Courier, monospace;"> <?php echo get_option('phone') ?></span></li>
                        </ul>


                    </nav><!-- .xs-menus END -->
                </div>
                <div class="col-lg-2 col-sm-5 xs-order-2 xs-wishlist-group">
                    <div class="xs-wish-list-item">
                        <ul class="xs-header-info">
                            <li class="d-none d-md-none d-lg-block" style="margin-top: 17px;margin-right: 43px;">

                                <a style="background-color: green;margin-top: -11px;"
                                   href="<?php echo base_url() ?>pages/trackorder" class="btn btn-success  btn-sm  "><i
                                        class="icon icon-van"></i>Track
                                    Order</a>

                            </li>
                        </ul>

                        <div class="dropdown dropright xs-miniCart-dropdown">
                            <a href="#" class="xs-single-wishList offset-cart-menu">
                                <?php
                                $cart_items = $cart_total = 0;
                                /*echo '<pre>'; print_r($this->cart->contents()); echo '</pre>';*/

                                foreach ($this->cart->contents() as $key => $val) {
                                    if (!is_array($val) OR !isset($val['price']) OR !isset($val['qty'])) {
                                        continue;
                                    }

                                    $cart_items += $val['qty'];
                                    $cart_total += $val['subtotal'];

                                }
                                ?>

                                <span hidden class="xs-item-count highlight"><?php if ($cart_items > 0) {
                                        echo $cart_items;
                                    } ?></span>

                                <i hidden class="icon icon-bag"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div><!-- .row END -->
        </div><!-- .container END -->
    </div>    <!-- End nav bar section -->

    <!-- nav down section -->
    <div class="xs-navDown v-yellow" id="sticky_class">
        <div class="container container-fullwidth" id="top_category_menu">
            <div class="row">
                <div class="col-lg-3 col-xl-3  d-none d-md-none d-lg-block">
                    <!-- vertical menu bar -->
                    <a class="home_icon_class" href="<?php echo base_url() ?>"> <i class="fa fa-fw fa-home"></i></a>

                    <div class="cd-dropdown-wrapper xs-vartical-menu v-gray" id="sticy_menu_id">
                        <a class="cd-dropdown-trigger" href="#0">
                            <i class="fa fa-list-ul"></i> CATEGORIES
                        </a>
                        <nav class="cd-dropdown top_sticky_category_menu">
                            <h2>Marketpress</h2>
                            <a href="#0" class="cd-close">Close</a>
                            <ul class="cd-dropdown-content">
                                <?php
                                $parentCategories = get_result("SELECT * FROM `category` where parent_id=0 and status=1 ORDER BY rank_order ASC");
                                foreach ($parentCategories as $parentCategory) {

                                    $parent_id = $parentCategory->category_id;
                                    $link_parent = base_url() . 'category/' . $parentCategory->category_name;
                                    $subCategories = get_result("SELECT * FROM `category` where  parent_id=$parent_id ORDER BY rank_order ASC");

                                    if ($subCategories) {
                                        ?>

                                        <li class="has-children">
                                            <a class="no-padding"
                                               href="<?= $link_parent ?>"><?php echo $parentCategory->category_title; ?>
                                                <i
                                                    class="fa fa-angle-right submenu-icon"></i></a>


                                            <ul class="cd-secondary-dropdown is-hidden">
                                                <li class="go-back"><a
                                                        href="<?= $link_parent ?>"><?php echo $parentCategory->category_title; ?> </a>
                                                </li>

                                                <?php $subCategories = get_result("SELECT * FROM `category` where  parent_id=$parent_id and status=1 ORDER BY rank_order ASC");
                                                if (isset($subCategories)) {
                                                    foreach ($subCategories as $subCategory) {

                                                        $sub_parent = $subCategory->category_id;
                                                        $link_sub_parent = base_url() . 'category/' . $subCategory->category_name;

                                                        ?>
                                                        <li class="has-children">
                                                            <a href="<?= $link_sub_parent ?>" style="cursor:pointer"
                                                               class="secend_menu_class"><?php echo $subCategory->category_title; ?>
                                                                </a>
                                                            <ul class="is-hidden">
                                                                <?php
                                                                $childenCategories = get_result("SELECT * FROM `category` where  parent_id=$sub_parent and status=1 ORDER BY rank_order ASC");
                                                                if (isset($childenCategories)) {

                                                                    foreach ($childenCategories as $childen) {

                                                                        $sub_parent = $subCategory->category_id;
                                                                        $link_sub_sub_parent = base_url() . 'category/' . $childen->category_name;

                                                                        ?>

                                                                        <li><a
                                                                                href="<?= $link_sub_sub_parent ?>"><?php echo $childen->category_title; ?></a>
                                                                        </li>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>

                                                                <!--                                                            <li><a-->
                                                                <!--                                                                    href="-->
                                                                <?//= $link_sub_parent ?><!--">All -->
                                                                <?php //echo $subCategory->category_title; ?><!--</a>-->
                                                                <!--                                                            </li>-->
                                                            </ul>
                                                        </li>
                                                        <?php


                                                    }
                                                } ?>


                                            </ul> <!-- .cd-secondary-dropdown -->
                                        </li> <!-- .has-children -->
                                    <?php } else { ?>
                                        <li>
                                            <a href="<?= $link_parent ?>">  <?php echo $parentCategory->category_title; ?>
                                            </a>


                                        </li>

                                    <?php }
                                } ?>


                            </ul> <!-- .cd-dropdown-content -->
                        </nav> <!-- .cd-dropdown -->
                    </div>
                </div>
                <div class="col-lg-5 col-xl-6 ">
                    <form class="xs-navbar-search" method="get" action="<?php echo base_url() ?>search">
                        <div class="input-group ">
                            <input type="text" name="q" id="seachId" class="form-control"
                                   placeholder="Find your products" autocomplete="off">


                            <div class="input-group-btn ">

                                <button type="submit" class="btn btn-success"><i class="fa fa-search"
                                                                                 style="margin-top: 7px;"></i></button>

                            </div>


                        </div>
                        <div class="search_div_section">
                            <table id="table_click_hide" class="table table-bordered" style="background-color: #fff;">

                                <tbody id="searching_data">


                                </tbody>
                            </table>
                        </div>

                    </form>
                </div>
                <div class="col-lg-4 col-xl-3 d-none d-md-none d-lg-block">
                    <a id="black_offer" target="_blank" href="<?= get_option('home_pomosion_link') ?>"
                       class="btn btn-outline-primary btn-lg">
                        <strong><?= get_option('home_pomosion_title') ?></strong>
                        <?= get_option('home_pomosion_sub_title') ?>
                    </a>
                    <div id="black_offer_show" style="margin-top:20px">
                        <img style="margin-top: -9px;" width="25px" src="<?php echo base_url() ?>images/phone.gif"><b
                            style="font-size: 15px;
margin-right: 32px;;
font-family: " Courier New", Courier, monospace;"> <?php echo get_option('phone') ?></b>
                        </li>


                        <a style="color:white !important;style;background-color: green"
                           href="<?php echo base_url() ?>pages/trackorder"
                           class="btn btn-success  btn-sm col-lg-2 sticky_hover_track_order">
                            <i class="icon icon-van"></i>

                            Track
                            Order</a>


                    </div>


                </div><!-- .row END -->
            </div><!-- .container END -->
        </div>    <!-- End nav down section -->
    </div>    <!-- End nav down section -->

    <!-- <div class="nav-cover"></div> -->
</header>
<!-- End header section -->


<header id="hide_mobile_menu">
    <div class="container-fluid">
        <div class="row">


            <div class="col-1 off-canvas-toggle" style="margin-top: 8px;cursor: pointer;display:none">


                <div class="moble_menu_icon"></div>
                <div class="moble_menu_icon"></div>
                <div class="moble_menu_icon"></div>


            </div>

            <div class="col-4">

                <a href="<?php echo base_url() ?>">
                    <img src="<?php echo get_option('logo') ?>" alt="" style="margin-left: 10px;
margin-top: 5px;display:none">
                </a>
            </div>

            <div class="col-7">

                <nav class="xs-menus" style="margin-top: -8px;z-index: 9999999">
                    <div class="nav-header">
                        <div hidden class="nav-toggle" style="position: absolute;

top: 615px;"></div>
                    </div><!-- .nav-header END -->
                    <div class="nav-menus-wrapper " style="display:none">
                        <ul class="nav-menu" style="text-align: center;font-size: 16px;
font-family: initial;">
                            <li><a href="<?php echo base_url(); ?>">Home</a>


                            <li><a href="<?php echo base_url(); ?>pages/affiliate-program">Affiliate</a>

                            <li><a href="<?php echo base_url(); ?>all-products">All Products</a>


                            </li>

                            <?php

                            $active = $this->session->userdata('user_status');
                            $user_f_name = $this->session->userdata('user_f_name');
                            $user_l_name = $this->session->userdata('user_l_name');
                            $name = $user_f_name . ' ' . $user_l_name;
                            if ($active == 'active') {

                                ?>
                                <li>
                                    <div class="dropdown">
                                        <button type="button" class=" dropdown-toggle" data-toggle="dropdown"
                                                style="background-color: #F5F5F5;color: black;border: none;">
                                            Welcome <?php echo $name ?>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" style="z-index:9999999999">
                                            <a class="dropdown-item"
                                               href="<?php echo base_url() ?>Affiliate/my_account">My
                                                ACCOUNT</a>
                                            <a class="dropdown-item" href="<?php echo base_url() ?>Affiliate/logOut">Sign
                                                Out</a>

                                        </div>
                                    </div>
                                </li>
                            <?php } else { ?>

                                <li><a href="<?php echo base_url() ?>affiliate/login_signup">Login / signup</a></li>
                            <?php } ?>


                        </ul>
                    </div><!-- .nav-menus-wrapper END -->
                </nav><!-- .xs-menus END -->

                <nav class="navbar navbar-expand-sm" style="margin-top: -75px;

margin-left: 50px;z-index: 10000">

                    <!-- Links -->
                </nav>


            </div>


        </div><!-- .row END -->
    </div><!-- .container END -->


    <div class="row">
        <div class="col-12">
            <form class="xs-navbar-search" method="get" action="<?php echo base_url() ?>search">
                <div class="input-group " style="margin-top: 11px;">
                    <input type="text" style="height: 40px;
width: 79%;
margin-left: 1px;
z-index: 10000000;" name="q" id="seach_mobile_Id"
                           class="form-control"
                           placeholder="Find your products" autocomplete="off">
                    <div class="input-group-btn ">
                        <button type="submit" class="btn btn-success" style="height: 40px;padding: 10px;background-color: green"><i
                                class="fa fa-search"></i></button>
                    </div>
                </div>
                <div class="search_div_section">
                    <table id="table_mobile_click_hide" class="table table-bordered" style="background-color: #fff;">

                        <tbody id="searching_mobile_data">


                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div><!-- .row END -->
    </div><!-- .container END -->


    <!-- <div class="nav-cover"></div> -->
</header>

<div class="wrapper">

    <nav class="mobile-nav">


        <ul class="nav__item-container" style="margin-left: 72px;">


            <li class="nav__item off-canvas__container" data-off-canvas-direction="left">

                
							   <a  style="position: relative;

left: -59px;

font-size: 15px;

color:
black;

top: 0px;

padding: 8px 1px;" href="JavaScript:Void(0);" 
                               id="mobile_menu_close_cross_icon" >CATEGORIES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;✕</a>


                <ul class="nav__item__content off-canvas__content">

                    <?php
                    $parentCategories = get_result("SELECT * FROM `category` where parent_id=0 and status=1 ORDER BY rank_order ASC");
                    foreach ($parentCategories as $parentCategory) {

                        $parent_id = $parentCategory->category_id;
                        $link_parent = base_url() . 'category/' . $parentCategory->category_name;
                        $subCategories = get_result("SELECT * FROM `category` where  parent_id=$parent_id and status=1 ORDER BY rank_order ASC");

                        if ($subCategories) {
                            ?>

                            <li class="nav__item">
                            <span class="nav-click"><i class="fa fa-fw fa-angle-down"></i></span>
                            <a href="<?php echo $link_parent; ?>"
                               class="nav__item__title"><?php echo $parentCategory->category_title; ?></a>
                            <?php
                            $subCategories = get_result("SELECT * FROM `category` where  parent_id=$parent_id and status=1 ORDER BY rank_order ASC");
                            if (isset($subCategories)) {
                                foreach ($subCategories as $subCategory) {

                                    $sub_parent = $subCategory->category_id;
                                    $link_sub_parent = base_url() . 'category/' . $subCategory->category_name;


                                    ?>
                                    <ul class="nav__item__content">
                                        <?php $childenCategories = get_result("SELECT * FROM `category` where  parent_id=$sub_parent and status=1 ORDER BY rank_order ASC");
                                        if (isset($childenCategories)) {

                                            ?>

                                            <li class="nav__item">
                                                <span class="nav-click"><i class="fa fa-fw fa-angle-down"></i></span>
                                                <a href="#"
                                                   class="nav__item__title"><?php echo $subCategory->category_title; ?></a>
                                                <ul class="nav__item__content">
                                                    <?php foreach ($childenCategories as $childen) {

                                                        $sub_parent = $subCategory->category_id;
                                                        $link_sub_sub_parent = base_url() . 'category/' . $childen->category_name;

                                                        ?>

                                                        <li class="nav__item"><a
                                                                href="<?php echo $link_sub_sub_parent; ?>"
                                                                class="nav__item__title"><?php echo $childen->category_title; ?></a>
                                                        </li>

                                                    <?php } ?>

                                                </ul>
                                            </li>
                                        <?php } else { ?>
                                            <li class="nav__item"><a href="<?php echo $link_sub_parent; ?>"
                                                                     class="nav__item__title"><?php echo $subCategory->category_title; ?></a>
                                            </li>

                                            </li>
                                        <?php } ?>


                                    </ul>


                                <?php }
                            }
                        } else { ?>


                            <li class="nav__item"><a href="<?= $link_parent ?>"
                                                     class="nav__item__title"><?php echo $parentCategory->category_title; ?></a>
                            </li>

                        <?php }
                    } ?>

                </ul>

            </li>

        </ul>

    </nav>


</div>

<!-- End header section -->

