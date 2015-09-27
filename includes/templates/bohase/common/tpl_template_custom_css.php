<?php
/**
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
?>
<!--Query to fetch Template values-->
<?php 
$template_query = "SELECT * FROM " . TABLE_TEMPLATE_SETTINGS;
$template_result = $db->Execute($template_query);

$homepage_layout = $template_result->fields['homepage_layout'];
$header_style = $template_result->fields['header_style'];
$slideshow_position = $template_result->fields['slideshow_position'];
$full_width_slideshow = $template_result->fields['full_width_slideshow'];

if($homepage_layout=="homepage_layout_6") {
	$container_class="no-container";
}
else {
	$container_class="container";
}

if($header_style=='header_style_1') {
	$header_class = 'header-style-1';
	$header_nav_class = 'home';
	$nav_bg_class = 'no-nav-bg';
}
elseif($header_style=='header_style_2') {
	$header_class = 'header-style-1 header-style-2';
	$header_nav_class = 'home';
	$nav_bg_class = 'no-nav-bg';
}
elseif($header_style=='header_style_3') {
	$header_class = 'header-style-3';
	$header_nav_class = 'home-4';
	$nav_bg_class = 'nav-bg';
}

$custom_color = $template_result->fields['custom_color'];
$custom_rgba_color = $template_result->fields['custom_rgba_color'];
$predef_color = $template_result->fields['predef_color'];
$use_predef_color = $template_result->fields['use_predef_color'];

if($predef_color=="#379adc"){
	$theme_hover_color = "#1e71a9";
	$theme_rgba_color = "rgba(55, 154, 220, 0.5)";
}
elseif($predef_color=="#12cca7"){
	$theme_hover_color = "#0c866d";
	$theme_rgba_color = "rgba(18, 204, 167, 0.5)";
}
if($predef_color=="#34495e"){
	$theme_hover_color = "#19232d";
	$theme_rgba_color = "rgba(52, 73, 94, 0.5)";
}
if($predef_color=="#f27a24"){
	$theme_hover_color = "#be560b";
	$theme_rgba_color = "rgba(242, 122, 36, 0.5)";
}
if($predef_color=="#f55c59"){
	$theme_hover_color = "#f11511";
	$theme_rgba_color = "rgba(245, 92, 89, 0.5)";
}

if($use_predef_color=="yes"){
	$theme_color = $predef_color;
}
else {
	$custom_color = (explode(",",$custom_color));
	$theme_color = $custom_color[0];
	$theme_hover_color = $custom_color[1];
	$theme_rgba_color = $custom_rgba_color;
}

$logo_image = $template_result->fields['logo_image'];

$featured_products_banner_caption = $template_result->fields['featured_products_banner_caption'];
$featured_products_banner = $template_result->fields['featured_products_banner'];

$display_featured_products = $template_result->fields['display_featured_products'];
$display_featured_products_style = $template_result->fields['display_featured_products_style'];
$display_brands_slider = $template_result->fields['display_brands_slider'];
$display_info_boxes = $template_result->fields['display_info_boxes'];

$display_right_column_banner = $template_result->fields['display_right_column_banner'];
$right_column_banner = $template_result->fields['right_column_banner'];
$right_column_banner_caption = $template_result->fields['right_column_banner_caption'];

if ($full_width_slideshow=="small") {
	$slideshow_class="col-md-6";
	$slideshow_banner_class="col-md-3";
	if($slideshow_position=="center") {
		$slideshow_class.= " col-md-push-3";
		$slideshow_banner_class.= " col-md-pull-6";
	}
	elseif($slideshow_position=="right") {
		$slideshow_class.= " col-md-push-6";
		$slideshow_banner_class.= " col-md-pull-6";
	}
}
elseif($full_width_slideshow=="large"){
	$slideshow_class="col-md-12";
	$slideshow_banner_class="hidden-lg hidden-md hidden-xs hidden-sm";
	$pagination_class="wide-slider-pagination";
	//$caption_class="content-small content-inline";
}
elseif($full_width_slideshow=="medium"){
	$slideshow_class="col-md-9";
	$slideshow_banner_class="col-md-3";
	$caption_class="content-small content-inline";
	$pagination_class="wide-slider-pagination wide-slider-pagination-left";
}

$display_top_banners = $template_result->fields['display_top_banners'];
$top_banners_style = $template_result->fields['top_banners_style'];

$display_bottom_banners = $template_result->fields['display_bottom_banners'];
$bottom_banners_style = $template_result->fields['bottom_banners_style'];

$display_category = $template_result->fields['display_category'];

$store_address = $template_result->fields['store_address'];
$store_contact = $template_result->fields['store_contact'];
$store_email = $template_result->fields['store_email'];
$store_copyright = $template_result->fields['store_copyright'];
$store_fax = $template_result->fields['store_fax'];
$store_skype = $template_result->fields['store_skype'];
$store_map = $template_result->fields['store_map'];
$newsletter_details = $template_result->fields['newsletter_details'];

$facebook_link = $template_result->fields['facebook_link'];
$instagram_link = $template_result->fields['instagram_link'];
$tumblr_link = $template_result->fields['tumblr_link'];
$twitter_link = $template_result->fields['twitter_link'];
$pinterest_link = $template_result->fields['pinterest_link'];
$google_link = $template_result->fields['google_link'];
$tumblr_link = $template_result->fields['tumblr_link'];
$linkedin_link = $template_result->fields['linkedin_link'];
$youtube_link = $template_result->fields['youtube_link'];

$featured_category = $template_result->fields['featured_category']; 
$featured_category_id = (explode(",",$featured_category));

$payment_image = $template_result->fields['payment_image'];

$show_theme_background = $template_result->fields['show_theme_background'];
$theme_background_image = $template_result->fields['theme_background_image'];
$theme_bg_color = $template_result->fields['theme_bg_color'];

?>

<?php if($this_is_home_page) { 
	$slideshow_query = "SELECT * from " . TABLE_TEMPLATE_SLIDESHOW;
	$slideshow_query_result = $db->Execute($slideshow_query);
	
	$top_banner_query = "SELECT * from " . TABLE_TEMPLATE_TOP_BANNER;
	$top_banner_query_result = $db->Execute($top_banner_query);
	
	$bottom_banner_query = "SELECT * from " . TABLE_TEMPLATE_BOTTOM_BANNER;
	$bottom_banner_query_result = $db->Execute($bottom_banner_query);
	
	//$rows = $top_banner_query_result->RecordCount();
	
	if($top_banners_style=="1") {
		$top_banner_class = "col-md-6 col-lg-6 col-xs-12 col-sm-4";
	}
	elseif($top_banners_style=="2") {
		$top_banner_class = "col-md-4 col-lg-4 col-xs-12 col-sm-4";
	}
	
	if($bottom_banners_style=="1") {
		$bottom_banner_class = "col-md-6 custom-bottom-banner col-xs-12 col-sm-6";
	}
	elseif($bottom_banners_style=="2") {
		$bottom_banner_class = " col-xs-12 col-sm-7 col-md-8 col-lg-8";
	}
}
?>
<!--Query Ends-->
<style type="text/css">

<?php if($show_theme_background=="yes") { ?>
body.body-style-6 {
  background: url("<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images').'/bgpatterns/'.$theme_background_image; ?>") no-repeat fixed 0 0 transparent;
}
<?php } else { ?>
body.body-style-6 {
	background: none repeat scroll 0 0 <?php echo $theme_bg_color; ?>;
}
<?php } ?>
/*Select Dropdown*/
.select2-results .select2-highlighted{background: <?php echo $theme_color; ?>;color:#fff}
/*Select Dropdown*/
/*Pagination*/
.pagination-style a {
	background-color: <?php echo $theme_color; ?>;
}
.pagination-style .current, .pagination-style a:hover {
	background-color: <?php echo $theme_hover_color; ?>;
}
/*Pagination*/
#cssmenu.small-screen .nav > li > a {
    background: <?php echo $theme_color; ?> none repeat scroll 0 0;
}
#centercontent-wrapper header > h4 {
	border-bottom: 3px solid <?php echo $theme_color; ?>;
}
/*ToolTip*/
.tooltip-inner {
	background-color: <?php echo $theme_color; ?>;
}
.tooltip.top .tooltip-arrow{
	border-top:5px solid <?php echo $theme_color; ?>;
}
.tooltip.left .tooltip-arrow{
	border-left:5px solid <?php echo $theme_color; ?>;
}
.tooltip.bottom .tooltip-arrow{
	border-bottom:5px solid <?php echo $theme_color; ?>;
}
.tooltip.right .tooltip-arrow{
	border-right:5px solid <?php echo $theme_color; ?>;
}
/*Tooltip Ends*/
/*Misc.*/
.product-next-prev .navNextPrevList > a, .product_info_tab .tabs li.selected a, #indexProductListCatDescription p:first-child:first-letter {
    background: none repeat scroll 0 0 <?php echo $theme_color; ?>;
}
.product-next-prev .navNextPrevList > a:hover {
	background:none repeat scroll 0 0 <?php echo $theme_color; ?>;
}
#cssmenu.small-screen #menu-button, #cssmenu.small-screen .submenu-button {
	background-color: <?php echo $theme_hover_color; ?>;
	transition: all 0.3s ease-in-out 0s;
		-moz-transition: all 0.3s ease-in-out 0s;
		-webkit-transition: all 0.3s ease-in-out 0s;
		-o-transition: all 0.3s ease-in-out 0s;
		-ms-transition: all 0.3s ease-in-out 0s;
}
#product_name a:hover, #loginForm .buttonRow.back.important > a:hover, .buttonRow.back.important > a:hover, .cartBoxTotal, #checkoutSuccessOrderLink > a:hover, #checkoutSuccessContactLink > a:hover, #checkoutSuccess a.cssButton.button_logoff:hover, #subproduct_name > a, a.table_edit_button span.cssButton.small_edit:hover, #accountDefault a:hover, .allorder_text > a:hover, #productReviewLink > a:hover, .buttonRow.product_price > a:hover, #searchContent a:hover, #siteMapList a:hover, .box_heading_style h1 a:hover, .info-links > li:hover a, #navBreadCrumb li a:hover, .footer-toplinks a:hover, .banner:hover .link:hover, #cartContentsDisplay a.table_edit_button:hover, #timeoutDefaultContent a:hover, #logoffDefaultMainContent > a span.pseudolink:hover, #createAcctDefaultLoginLink > a:hover, #unsubDefault a .pseudolink:hover, .review_content > p i.fa, .gv_faq a:hover, .alert > a:hover, .reviews-list p a:hover, .reviews-list h4 a:hover, #left-column .leftBoxContainer a:hover, #right-column .rightBoxContainer a:hover, .readmore,button, #shoppingCartDefault .buttonRow, #pageThree .buttonRow.back > a, #pageFour .buttonRow.back > a, #pageTwo .buttonRow.back > a, #discountcouponInfo .content .buttonRow.forward > a, #main-slideshow .owl-controls .owl-buttons div, .our-services header > h2, .top-banner h3 .banner_subtitle, .custom-banner-image h3 .banner_subtitle, .top-contact-number, .top-contact-email, .header-container .header .greeting a:hover, .header-container .header .cart-info .shopping_cart_link, .content.caption h2, .content.caption a, #right-column #categories li:hover a, #left-column #categories li:hover a, #left-column #cartBoxListWrapper li:hover > a, #right-column #cartBoxListWrapper li:hover > a, #right-column li a:hover, #left-column li a:hover, .sideBoxContentItem a:hover, .product_sideboxname > a:hover, #left-column .leftBoxHeading a:hover, #right-column .rightBoxHeading a:hover, #reviewsContent > a:hover, .product-name-desc .product_name a:hover, .add_title, .btn.dropdown-toggle.btn-setting, #additionalimages-slider .owl-controls .owl-prev, #additionalimages-slider .owl-controls .owl-next, .item .product-actions a, .centerBoxContentsAlsoPurch .product-actions a, #specialsListing .item .product-actions a, #whatsNew .centerBoxContentsNew.centeredContent .product_price, #featuredProducts .centerBoxContentsFeatured.centeredContent .product_price, .item .product_price, #specialsDefault .centerBoxContentsSpecials.centeredContent .product_price, #specialsListing .specialsListBoxContents .product_price, #alsopurchased_products .product_price, #upcomingProducts .product_price, .productListing-data .product_name > a:hover, .newproductlisting .product_name > a:hover, .brands-wrapper h2, .category-slideshow-wrapper h2, .box_heading h2, .custom-newsletter-left header > h2, #indexDefault > #horizontalTab li.resp-tab-active, .alsoPurchased header > h2, .product_price.total span.total_price, .breadcrumb-current, .cartTableHeading, #cartSubTotal, table#cartContentsDisplay tr th, #prevOrders .tableHeading th, #accountHistInfo .tableHeading th, #cartSubTotal, .remodal h1, .remodal-close:after, .remodal-confirm, .about-us-details header > h2, .cart_table .fa-times-circle:hover, .basketcol span.cartTitle, #viewCart a, .product-list .item:hover .info-right .product-title a, .extra-links li a:hover, .contact-us li.aboutus_mail a:hover, .prodinfo-actions .wish_link a, .prodinfo-actions .compare_link a, .about-us-details h3, #left-column .leftBoxContainer .leftBoxHeading a:hover, #right-column .rightBoxContainer .rightBoxHeading a:hover, #nav-cat li.submenu > a.active, #timeoutDefault .timeoutbuttons a:hover, .product-info-ratings .rating-links a.lnk:hover, .product-listview .product-info .name a:hover, .pseudolink:hover, .notfound_title {
	color: <?php echo $theme_color; ?>;
}
#checkoutSuccess a:hover, #siteMapMainContent a:hover, .login-buttons > a:hover, .alert > a:hover, #navBreadCrumb li:last-child a:hover, #cartImage > a:hover, .product_wishlist_name > a:hover, #compareDefaultMainContent a:hover, .index-ratings > a:hover, .link-list.inline a:hover, .copyright a:hover, .more_info_text, .body-container .product-container .product-top .product-info .quantity-container .lnk:hover, #description .product-tab p#productInfoLink a {
	color: <?php echo $theme_color; ?> !important;
}

header.header-style-1 .header-top .cnt-cart .dropdown-cart .cartTopProductRemove.action > a:hover, header.header-style-3 .header-top .cnt-cart .dropdown-cart .cartTopProductRemove.action > a:hover, .body-container .cart-container table tbody tr td.details .product-desc .name a:hover {
	color: <?php echo $theme_color; ?>;
}

.top-nav-holder .nav-menu ul > li.active, .top-nav-holder .nav-menu ul > li:hover > a, .top-nav-holder .nav-menu ul > li.active a:hover, .top-nav-holder .nav-menu ul > li.active a:focus, .top-nav-holder .nav-menu ul > li > a:focus, #nav > li.tab_active, .top-menu-holder li#home a:hover {
    background-color: <?php echo $theme_color; ?>;
}

/*Grid List*/
<?php  if(((isset($_GET['view'])) && ($_GET['view']=='rows')) || (PRODUCT_LISTING_LAYOUT_STYLE=='rows' && (!isset($_GET['view'])) )){ ?>
.display-mode ul .grid, .display-mode ul .list {
    border: 1px solid #abb0ac;
    color: #abb0ac;
	background:none;
}
.display-mode ul .list, .display-mode ul .list:hover, .display-mode ul .grid:hover {
	background: none repeat scroll 0 0 <?php echo $theme_color; ?>;
	border:1px solid <?php echo $theme_color; ?>;
	color:#FFFFFF;
}
<?php } else { ?>
.display-mode ul .grid, .display-mode ul .list {
    border: 1px solid #abb0ac;
    color: #abb0ac;
	background:none;
}
.display-mode ul .grid, .display-mode ul .grid:hover, .display-mode ul .list:hover {
	background: none repeat scroll 0 0 <?php echo $theme_color; ?>;
	border:1px solid <?php echo $theme_color; ?>;
	color:#FFFFFF;
}
<?php } ?>
.primary-color {
  color: <?php echo $theme_color; ?>;
}
.primary-color-svg {
  fill: <?php echo $theme_color; ?>;
}
.color-dark-blue {
  color: <?php echo $theme_color; ?> !important;
}
/* Buttons */
.btn.btn-blue.btn-trans:hover,
.btn.btn-blue.btn-trans:focus,
.btn.btn-blue.btn-trans:active {
  background: <?php echo $theme_color; ?>;
  color: #FFF;
}
.btn.btn-dark-blue.btn-trans:hover,
.btn.btn-dark-blue.btn-trans:focus,
.btn.btn-dark-blue.btn-trans:active {
  background: <?php echo $theme_color; ?>;
  color: #FFF;
}
/* Dropdown */
.dropdown.dropdown-small .dropdown-menu > li a:hover,
.dropdown.dropdown-small .dropdown-menu > li a:focus,
.dropdown.dropdown-small .dropdown-menu > li a:active {
  background-color: <?php echo $theme_color; ?>;
  color: #FFF;
}
.dropdown.dropdown-med .btn {
  font-family: 'Roboto', sans-serif;
  font-size: 13px;
  font-weight: light;
  color: <?php echo $theme_color; ?>;
  line-height: 24px;
}
.dropdown.dropdown-med .dropdown-menu li a {
  font-family: 'Roboto', sans-serif;
  font-size: 13px;
  font-weight: light;
  color: <?php echo $theme_color; ?>;
  line-height: 24px;
}
#nav li > ul li a:hover,
#nav li > ul li a:focus,
#nav li > ul li a:active {
  background-color: <?php echo $theme_color; ?> !important;
  color: #FFF;
}
#cssmenu ul ul li.has-sub:hover {
    background: <?php echo $theme_color; ?> none repeat scroll 0 0;
	color: #FFF;
}
#cssmenu ul ul li.has-sub:hover > a {
	color: #FFFFFF;
}
/* Nav Tabs */
.nav-tabs.nav-tab-box li:focus > a,
.nav-tabs.nav-tab-box li:hover > a,
.nav-tabs.nav-tab-box li:active > a,
.nav-tabs.nav-tab-box li.active > a {
  font-family: 'Roboto', sans-serif;
  font-size: 14px;
  font-weight: light;
  color: <?php echo $theme_color; ?>;
  line-height: 18px;
}
.nav-tabs.nav-tab-fa-icon li > a:hover,
.nav-tabs.nav-tab-fa-icon li > a:focus,
.nav-tabs.nav-tab-fa-icon li > a:active {
  color: <?php echo $theme_color; ?>;
}
.nav-tabs.nav-tab-fa-icon li:focus > a,
.nav-tabs.nav-tab-fa-icon li:hover > a,
.nav-tabs.nav-tab-fa-icon li:active > a,
.nav-tabs.nav-tab-fa-icon li.active > a {
  color: <?php echo $theme_color; ?>;
}
.nav-tabs.nav-tab-cell li > a:hover,
.nav-tabs.nav-tab-cell li > a:focus,
.nav-tabs.nav-tab-cell li > a:active {
  border-color: <?php echo $theme_color; ?>;
  background: <?php echo $theme_color; ?>;
}
.nav-tabs.nav-tab-cell li:focus > a,
.nav-tabs.nav-tab-cell li:hover > a,
.nav-tabs.nav-tab-cell li:active > a,
.nav-tabs.nav-tab-cell li.active > a {
  border: 1px solid <?php echo $theme_color; ?>;
  background: <?php echo $theme_color; ?>;
}
/* Breadcrumb */
.breadcrumb ul li a:hover,
.breadcrumb ul li a:active,
.breadcrumb ul li a:focus {
  color: <?php echo $theme_color; ?>;
}
/* Category Page Tool Bar */
.filters-container .pagination-container ul li a:hover,
.filters-container .pagination-container ul li a:focus,
.filters-container .pagination-container ul li a:active {
  color: <?php echo $theme_color; ?>;
}
.filters-container .pagination-container ul li.active a {
  color: <?php echo $theme_color; ?>;
}

/* Blog Post */
.blog-post .blog-post-info .title a:hover,
.blog-post .blog-post-info .title a:focus,
.blog-post .blog-post-info .title a:active {
  color: <?php echo $theme_color; ?>;
}
.blog-post .blog-post-info .lnk:hover,
.blog-post .blog-post-info .lnk:focus,
.blog-post .blog-post-info .lnk:active {
  color: <?php echo $theme_color; ?>;
}
/* Price Range Slider */
.range-container .ui-slider .ui-slider-range {
  background: <?php echo $theme_color; ?>;
}
/* Footer */
footer .links-social .social-newsletter .social-links ul li a:hover,
footer .links-social .social-newsletter .social-links ul li a:focus,
footer .links-social .social-newsletter .social-links ul li a:active {
  background: <?php echo $theme_color; ?>;
  border-color: <?php echo $theme_color; ?>;
}
/*===================================================================================*/
/*  Form
/*===================================================================================*/
.form-container a:hover,
.form-container a:focus,
.form-container a:active {
  color: <?php echo $theme_color; ?>;
}
/*===================================================================================*/
/*  General Styles
/*===================================================================================*/
a {
  color: <?php echo $theme_color; ?>;
}
a.lnk:hover,
a.lnk:focus,
a.lnk:active {
  color: <?php echo $theme_color; ?>;
}
.body-container .scroll-tabs .nav-tab-line li.active a,
.body-container .scroll-tabs .nav-tab-line li:focus a,
.body-container .scroll-tabs .nav-tab-line li:hover a {
  border-bottom-color: <?php echo $theme_color; ?>;
}
.body-container .section-title {
  border-bottom-color: <?php echo $theme_color; ?>;
}
/*===================================================================================*/
/*  Header
/*===================================================================================*/
header.header-style-1 .header-top .cnt-account ul li a:hover,
header.header-style-1 .header-top .cnt-account ul li a:focus,
header.header-style-1 .header-top .cnt-account ul li a:active {
  color: <?php echo $theme_color; ?>;
}
header.header-style-1 .header-top .cnt-cart ul li a {
  font-family: 'Roboto', sans-serif;
  font-size: 12px;
  font-weight: light;
  color: <?php echo $theme_color; ?>;
  line-height: 26px;
}
header.header-style-1 .header-top .cnt-cart .dropdown-cart .dropdown-menu li .cart-item .col-xs-1 a:hover,
header.header-style-1 .header-top .cnt-cart .dropdown-cart .dropdown-menu li .cart-item .col-xs-1 a:focus,
header.header-style-1 .header-top .cnt-cart .dropdown-cart .dropdown-menu li .cart-item .col-xs-1 a:active {
  color: <?php echo $theme_color; ?>;
}
header.header-style-1 .header-nav .navbar-nav > li > a:hover,
header.header-style-1 .header-nav .navbar-nav > li > a:focus,
header.header-style-1 .header-nav .navbar-nav > li > a:active {
  background: <?php echo $theme_color; ?>;
  color: #FFF !important;
}
header.header-style-1 .header-nav .navbar-nav > li .yamm-content .links li a:hover,
header.header-style-1 .header-nav .navbar-nav > li .yamm-content .links li a:focus,
header.header-style-1 .header-nav .navbar-nav > li .yamm-content .links li a:active {
  color: <?php echo $theme_color; ?> !important;
}
header.header-style-1 .header-nav .navbar-nav > li:hover > a,
header.header-style-1 .header-nav .navbar-nav > li:focus > a,
header.header-style-1 .header-nav .navbar-nav > li:active > a {
  background: <?php echo $theme_color; ?>;
  color: #FFF !important;
}
header.header-style-3 .header-top .cnt-account ul li a:hover,
header.header-style-3 .header-top .cnt-account ul li a:focus,
header.header-style-3 .header-top .cnt-account ul li a:active {
  color: <?php echo $theme_color; ?>;
}
header.header-style-3 .header-top .cnt-cart ul li a {
  font-family: 'Roboto', sans-serif;
  font-size: 12px;
  font-weight: light;
  color: <?php echo $theme_color; ?>;
  line-height: 26px;
}
header.header-style-3 .header-top .cnt-cart .dropdown-cart .dropdown-menu li .cart-item .col-xs-1 a:hover,
header.header-style-3 .header-top .cnt-cart .dropdown-cart .dropdown-menu li .cart-item .col-xs-1 a:focus,
header.header-style-3 .header-top .cnt-cart .dropdown-cart .dropdown-menu li .cart-item .col-xs-1 a:active {
  color: <?php echo $theme_color; ?>;
}
header.header-style-3 .header-nav .navbar-nav li > a:hover,
header.header-style-3 .header-nav .navbar-nav li > a:focus,
header.header-style-3 .header-nav .navbar-nav li > a:active,
, header.header-style-3 .header-nav .navbar-nav li.tab_active > a {
  background: <?php echo $theme_color; ?>;
  color: #FFF !important;
}
header.header-style-3 .header-nav .navbar-nav li .yamm-content .links li a:hover,
header.header-style-3 .header-nav .navbar-nav li .yamm-content .links li a:focus,
header.header-style-3 .header-nav .navbar-nav li .yamm-content .links li a:active {
  color: <?php echo $theme_color; ?> !important;
}
header.header-style-3 .header-nav .navbar-nav li:hover > a,
header.header-style-3 .header-nav .navbar-nav li:focus > a,
header.header-style-3 .header-nav .navbar-nav li:active > a, header.header-style-3 .header-nav .navbar-nav li.tab_active > a {
  background: <?php echo $theme_color; ?>;
  color: #FFF !important;
}
.body-container .cart-container table tbody tr td.qty input {
  font-family: 'Roboto', sans-serif;
  font-size: 15px;
  font-weight: light;
  color: <?php echo $theme_color; ?>;
  line-height: 24px;
}
.body-container .product-container .product-top .product-info .info-container .value {
  font-family: 'Roboto', sans-serif;
  font-size: 14px;
  font-weight: light;
  color: <?php echo $theme_color; ?>;
  line-height: 18px;
}
.body-container .product-container .product-top .product-info .quantity-container .txt-qty {
  font-family: 'Roboto', sans-serif;
  font-size: 15px;
  font-weight: light;
  color: <?php echo $theme_color; ?>;
  line-height: 18px;
}
/*=============================================================================================*/
/*  Product : Product Mini, Product Nav, Product Micro, Product List, Product, Product Summary
/*=============================================================================================*/
.product-mini .product-info .name a:hover,
.product-mini .product-info .name a:focus,
.product-mini .product-info .name a:active {
  color: <?php echo $theme_color; ?>;
}
.product-mini .product-info .price .offer {
  font-family: 'Roboto', sans-serif;
  font-size: 18px;
  font-weight: bold;
  color: <?php echo $theme_color; ?>;
  line-height: 24px;
}
.product-nav .product-nav-item .product-nav-item-inner:hover,
.product-nav .product-nav-item .product-nav-item-inner:focus,
.product-nav .product-nav-item .product-nav-item-inner:active,
.product-nav .product-nav-item .product-nav-item-inner.active {
  background: <?php echo $theme_color; ?>;
}
.product-micro .product-info .name a:hover,
.product-micro .product-info .name a:focus,
.product-micro .product-info .name a:active {
  color: <?php echo $theme_color; ?>;
}
.product-list .product-info .name a:hover,
.product-list .product-info .name a:focus,
.product-list .product-info .name a:active {
  color: <?php echo $theme_color; ?>;
}
.product-list .product-info .product-stats .sec-action a:hover,
.product-list .product-info .product-stats .sec-action a:focus,
.product-list .product-info .product-stats .sec-action a:active {
  color: <?php echo $theme_color; ?>;
}
.product .product-image-slider .bx-wrapper .bx-viewport ul li.active .prod-image .prod-image-inner {
  border-color: <?php echo $theme_color; ?>;
}
.product .product-info .name a:hover,
.product .product-info .name a:focus,
.product .product-info .name a:active {
  color: <?php echo $theme_color; ?>;
}
.product-summary .name:hover,
.product-summary .name:focus,
.product-summary .name:active {
  color: <?php echo $theme_color; ?>;
}
.facet-box h2.lined span {
  border-bottom-color: <?php echo $theme_color; ?>;
}
.facet-box ul li .facet .action:hover,
.facet-box ul li .cnt .action:hover,
.facet-box ul li .facet .action:focus,
.facet-box ul li .cnt .action:focus,
.facet-box ul li .facet .action:active,
.facet-box ul li .cnt .action:active {
  color: <?php echo $theme_color; ?>;
}
.facet-box ul li .facet:hover,
.facet-box ul li .facet:focus,
.facet-box ul li .facet:active {
  color: <?php echo $theme_color; ?>;
}
.facet-box .prod-tags .prod-tag:hover,
.facet-box .prod-tags .prod-tag:focus,
.facet-box .prod-tags .prod-tag:active {
  background: <?php echo $theme_color; ?>;
  border-color: <?php echo $theme_color; ?>;
}
/*===================================================================================*/
/*  Carousel : Wide Slider, Product Slider, Default Slider, Custom Controls
/*===================================================================================*/
/* Wide Slider */
.wide-slider .owl-carousel .item .content .small {
  font-family: 'Roboto', sans-serif;
  font-size: 30px;
  font-weight: bold;
  color: <?php echo $theme_color; ?>;
  line-height: 40px;
}
@media (max-width: 991px) {
.wide-slider .owl-carousel .item .content .small {
    font-family: 'Roboto', sans-serif;
    font-size: 16px;
    font-weight: bold;
    color: <?php echo $theme_color; ?>;
    line-height: 24px;
  }
}
@media (max-width: 550px) {
.wide-slider .owl-carousel .item .content .small {
    font-family: 'Roboto', sans-serif;
    font-size: 12px;
    font-weight: bold;
    color: <?php echo $theme_color; ?>;
    line-height: 18px;
  }
}
.xlarge {
  font-family: 'Roboto', sans-serif;
  font-size: 60px;
  font-weight: bold;
  color: #58abe2;
  line-height: 70px;
}
@media (max-width: 991px) {
  .xlarge {
    font-family: 'Roboto', sans-serif;
    font-size: 30px;
    font-weight: bold;
    color: #58abe2;
    line-height: 36px;
  }
}
@media (max-width: 550px) {
  .xlarge {
    font-family: 'Roboto', sans-serif;
    font-size: 16px;
    font-weight: bold;
    color: #58abe2;
    line-height: 24px;
  }
}
.btn.btn-blue, .btn.btn-dark-blue,
.button, input[type="submit"], input[type="reset"], input[type="button"], .readmore, button, #shoppingCartDefault .buttonRow, .change_address > a, #pageThree .buttonRow.back > a, #pageFour .buttonRow.back > a, #pageTwo .buttonRow.back > a, #discountcouponInfo .content .buttonRow.forward > a, #wishlist .cssButton.button_back, #wishlist .cssButtonHover.button_back.button_backHover
{
  background: <?php echo $theme_color; ?>;
  text-transform: none;
  font-family: 'Roboto', sans-serif;
  font-size: 12px;
  font-weight: 500;
  color: #ffffff;
  line-height: 21px;
  border:none;
  border-radius:4px;
}
.btn.btn-blue:hover,
.btn.btn-blue:focus,
.btn.btn-blue:active,
.btn.btn-dark-blue:hover,
.btn.btn-dark-blue:focus,
.btn.btn-dark-blue:active,
.button:hover, input[type="submit"]:hover, input[type="reset"]:hover, input[type="button"]:hover, .readmore:hover, button:hover, .billto-shipto .details:hover , .profile a:hover, #shoppingCartDefault .buttonRow:hover, .change_address > a:hover, #pageThree .buttonRow.back > a:hover, #pageFour .buttonRow.back > a:hover, #pageTwo .buttonRow.back > a:hover, #discountcouponInfo .content .buttonRow.forward > a:hover, #wishlist .cssButtonHover.button_back.button_backHover {
  background: <?php echo $theme_hover_color; ?> !important;
}
.btn.btn-blue.btn-trans, .btn.btn-dark-blue.btn-trans {
  background: <?php echo $theme_rgba_color; ?>;
}
header.header-style-1 .header-top .cnt-cart ul li a.btn-blue {
  background: <?php echo $theme_color; ?>;
  text-transform: none;
  font-family: 'Roboto', sans-serif;
  font-size: 12px;
  font-weight: 500;
  color: #ffffff;
  line-height: 21px;
}
header.header-style-3 .header-top .cnt-cart ul li a.btn-blue {
  background: <?php echo $theme_color; ?>;
  text-transform: none;
  font-family: 'Roboto', sans-serif;
  font-size: 12px;
  font-weight: 500;
  color: #ffffff;
  line-height: 21px;
}
.wide-slider.wide-slider-pagination .owl-controls .owl-pagination .owl-page.active span:after {
  color: <?php echo $theme_color; ?>;
}
.wide-slider.wide-slider-small .owl-controls .owl-pagination .owl-page.active span:after {
  color: <?php echo $theme_color; ?>;
}
.body-container .product-slider .owl-controls .owl-prev:hover, #additionalimages-slider .owl-controls .owl-prev:hover, #additionalimages-slider .owl-controls .owl-next:hover {
  border-color: <?php echo $theme_color; ?>;
}
.body-container .product-slider .owl-controls .owl-prev:hover:before, #additionalimages-slider .owl-controls .owl-prev:hover:before, #additionalimages-slider .owl-controls .owl-next:hover:before {
  color: <?php echo $theme_color; ?>;
}
.body-container .product-slider .owl-controls .owl-next:hover {
  border-color: <?php echo $theme_color; ?>;
}
.body-container .product-slider .owl-controls .owl-next:hover:before {
  color: <?php echo $theme_color; ?>;
}
.body-container .default-slider .owl-controls .owl-prev:hover {
  border-color: <?php echo $theme_color; ?>;
}
.body-container .default-slider .owl-controls .owl-prev:hover:before {
  color: <?php echo $theme_color; ?>;
}
.body-container .default-slider .owl-controls .owl-next:hover {
  border-color: <?php echo $theme_color; ?>;
}
.body-container .default-slider .owl-controls .owl-next:hover:before {
  color: <?php echo $theme_color; ?>;
}
.body-container .owl-controls-custom .owl-prev:hover {
  border-color: <?php echo $theme_color; ?>;
}
.body-container .owl-controls-custom .owl-prev:hover:before {
  color: <?php echo $theme_color; ?>;
}
.body-container .owl-controls-custom .owl-next:hover {
  border-color: <?php echo $theme_color; ?>;
}
.body-container .owl-controls-custom .owl-next:hover:before {
  color: <?php echo $theme_color; ?>;
}
.facet-box .facet-slider .owl-controls .owl-prev:hover {
  border-color: <?php echo $theme_color; ?>;
}
.facet-box .facet-slider .owl-controls .owl-prev:hover:before {
  color: <?php echo $theme_color; ?>;
}
.facet-box .facet-slider .owl-controls .owl-next:hover {
  border-color: <?php echo $theme_color; ?>;
}
.facet-box .facet-slider .owl-controls .owl-next:hover:before {
  color: <?php echo $theme_color; ?>;
}
.show-theme-options:hover {
  background-color: <?php echo $theme_color; ?> !important;
  color: #FFF !important;
}
footer .links-social .newsletter .input-group #mc_embed_signup input.button:hover {
  background-color: <?php echo $theme_color; ?> !important;
  color: #FFF;
}
.category-info .category-details h2.category-title {
  color: <?php echo $theme_color; ?>;
}
.product .product-image-slider .bx-wrapper .bx-viewport ul li .prod-image .arrow:before {
  color: <?php echo $theme_color; ?>;
}
#scrollUp {
  background-color: <?php echo $theme_color; ?>;
}
.info-boxes .info-box:hover .fa-stack .fa-circle {
  color: <?php echo $theme_color; ?>;
}
.bx-wrapper .bx-controls .bx-prev:hover {
  border-color: <?php echo $theme_color; ?> !important;
}
.bx-wrapper .bx-controls .bx-prev:hover:before {
  color: <?php echo $theme_color; ?> !important;
}
.bx-wrapper .bx-controls .bx-next:hover {
  border-color: <?php echo $theme_color; ?> !important;
}
.bx-wrapper .bx-controls .bx-next:hover:before {
  color: <?php echo $theme_color; ?> !important;
}

/* Theme Color Ends*/

<?php if($this_is_home_page) {?>
	.breadcrumb,#indexCategories .category-info{display:none}
	#subcategory_names{margin: 30px 0 0}
<?php } ?>
<?php if($this_is_home_page && $homepage_layout != "homepage_layout_5") {?>
#whatsNew > h3, #specialsDefault > h3, #bestSellers > h3 {display: none;}
<?php } ?>
<?php if($homepage_layout == "homepage_layout_5") {?>
.single_price, .productSalePrice, .productSpecialPrice, .productPriceDiscount {font-size:15px;}
#bestSellers{display:none;}
<?php } ?>
<?php if(!$this_is_home_page) {?>
	header.header-style-1 .header-nav, header.header-style-2 .header-nav {
		margin-top: 0px;
	}
	header.header-style-2, header.header-style-1 {
		position: relative;
	}
	header.header-style-1 .header-nav .navbar, header.header-style-2 .header-nav .navbar {
    	background: rgba(0, 0, 0, 0.88) none repeat scroll 0 0;
	}
<?php } ?>
<?php if(($display_info_boxes == "no" && $display_brands_slider == "no") || $display_info_boxes == "no") { ?>
	footer .links-social {
		margin-top:50px;
	}
<?php } ?>
</style>
