<?php
/**
 * Common Template - tpl_main_page.php
 *
 * Governs the overall layout of an entire page<br />
 * Normally consisting of a header, left side column. center column. right side column and footer<br />
 * For customizing, this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * - make a directory /templates/my_template/privacy<br />
 * - copy /templates/templates_defaults/common/tpl_main_page.php to /templates/my_template/privacy/tpl_main_page.php<br />
 * <br />
 * to override the global settings and turn off columns un-comment the lines below for the correct column to turn off<br />
 * to turn off the header and/or footer uncomment the lines below<br />
 * Note: header can be disabled in the tpl_header.php<br />
 * Note: footer can be disabled in the tpl_footer.php<br />
 * <br />
 * $flag_disable_header = true;<br />
 * $flag_disable_left = true;<br />
 * $flag_disable_right = true;<br />
 * $flag_disable_footer = true;<br />
 * <br />
 * // example to not display right column on main page when Always Show Categories is OFF<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 * <br />
 * example to not display right column on main page when Always Show Categories is ON and set to categories_id 3<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '' or $cPath == '3') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php 7085 2007-09-22 04:56:31Z ajeh $
 */

// the following IF statement can be duplicated/modified as needed to set additional flags
?>
</head>
<?php
  if (in_array($current_page_base,explode(",",'products_new,products_all,specials,featured_products,checkout_shipping_address,checkout_payment,checkout_shipping,checkout_payment_address,checkout_confirmation,advanced_search_result,password_forgotten,account,account_history,account_history_info,account_edit,address_book,address_book_process,account_password,account_newsletters,account_notifications,gv_faq,gv_redeem,discount_coupon,advanced_search,checkout_success,time_out,page_not_found,product_reviews_write,reviews,product_reviews,product_reviews_info,logoff,create_account_success')) ) {
	$flag_disable_right = true;
  }
  if (in_array($current_page_base,explode(",",'product_info,login,create_account,shopping_cart,contact_us,compare,wishlist'))) {
		$flag_disable_left = true;
		$flag_disable_right = true;
	}
  /*if (in_array($current_page_base,explode(",",'manufacturers_all')) ) {
    $flag_disable_right = true;
  }*/
	if ($current_page_base == 'index' and $_GET['cPath'] != '' ) {
		//$flag_disable_left = true;
		$flag_disable_right = true;
	}
	if ($current_page_base == 'index' and $_GET['manufacturers_id'] != '' ) {
		//$flag_disable_left = true;
		$flag_disable_right = true;
	}
  $header_template = 'tpl_header.php';
  $footer_template = 'tpl_footer.php';
  $left_column_file = 'column_left.php';
  $right_column_file = 'column_right.php';
  $body_id = ($this_is_home_page) ? 'indexHome' : str_replace('_', '', $_GET['main_page']);
?>

<body id="<?php echo $body_id . 'Body'; ?>"<?php if($zv_onload !='') echo ' onload="'.$zv_onload.'"'; ?> class="<?php if($homepage_layout=="homepage_layout_6") echo "body-style-6"; ?>">

<!--		<div id="preloader">
          <div id="status">&nbsp;</div>
          <noscript>JavaScript is off. Please enable to view full site.</noscript>
        </div>
-->
<?php if($homepage_layout=="homepage_layout_6") { ?>
<div class="wrapper">
	<div class="container">
		<div class="wrapper-inner">
<?php } ?>
		<div class="wrappper">
        <div class="wrapper-body-inner">
            <?php
             /**
              * prepares and displays header output
              *
              */
              if (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_HEADER_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == '')) {
                $flag_disable_header = true;
              }
			  
              require($template->get_template_dir('tpl_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_header.php');?>
              
              <?php if ($this_is_home_page) { ?>
              	<?php if (DEFINE_MAIN_PAGE_STATUS >= 1 and DEFINE_MAIN_PAGE_STATUS <= 2) { ?>
					<div id="indexDefaultMainContent" class="content">
						<div class="body-container">
							<?php require($define_page); ?>
                       	</div>
                   	</div>
 				<?php } ?>
              <?php } ?>
				<?php 	if ($this_is_home_page && $homepage_layout=="homepage_layout_5") { 
					$flag_disable_right = true;
					$flag_disable_left = false;
			 	}
				elseif($this_is_home_page && $homepage_layout != "homepage_layout_5") {
					$flag_disable_right = true;
					$flag_disable_left = true;
				}
				?>
				<?php if (DEFINE_BREADCRUMB_STATUS == '1' || (DEFINE_BREADCRUMB_STATUS == '2' && !$this_is_home_page) ) { ?>
                <!-- Breadcrumb Container -->
                <div class="breadcrumb">
                    <div class="<?php echo $container_class; ?>">
                        <div class="breadcrumb-inner">
                        	<ul class="list-inline list-unstyled"><?php echo $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); ?></ul>
                        </div>
                    </div>
                </div>
            	<?php } ?>
            	<!-- Breadcrumb Container Ends -->
       	<!-- Main Content Wrapper -->
        <div class="body-container">
            <div class="<?php echo $container_class; ?>">
                <div class="main">
                    <div class="row">
                        <div class="main-content">
                            <div id="contentarea-wrapper">
                                <?php if($flag_disable_left == true && $flag_disable_right == true ) { ?>
                                <div id="centercontent-wrapper" class="col-lg-12 single-column">
                                        <?php } elseif($flag_disable_left == true) { ?> 
                                    <div id="centercontent-wrapper" class="col-lg-9 col-md-8 col-sm-12 col-xs-12 columnwith-right"> 
                                            <?php } elseif($flag_disable_right == true) { ?> 
                                        <div id="centercontent-wrapper" class="col-lg-9 col-md-8 col-sm-12 col-xs-12 columnwith-left">
                                            <?php }else { 
                                                $class_name = 'three-columns';
                                            ?> 
                                            <div id="centercontent-wrapper" class="col-lg-6 col-md-4 col-sm-12 col-xs-12 noleft-margin two-column">
                                                <?php } ?>
                                                
                                                <?php
                                                  if (SHOW_BANNERS_GROUP_SET1 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET1)) {
                                                    if ($banner->RecordCount() > 0) {
                                                ?>
                                                <div id="bannerOne" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
                                                <?php
                                                    }
                                                  }
                                                ?>
                                                <!-- bof upload alerts -->
                                                <?php if ($messageStack->size('upload') > 0) echo $messageStack->output('upload'); ?>
                                                <!-- eof upload alerts -->
                                                <?php
                                                 /**
                                                  * prepares and displays center column
                                                  *
                                                  */ ?>
                                                <?php require($body_code); ?>
                                                <?php
                                                  if (SHOW_BANNERS_GROUP_SET4 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET4)) {
                                                    if ($banner->RecordCount() > 0) {
                                                ?>
                                                <div id="bannerFour" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
                                                <?php
                                                    }
                                                  } ?> 
                                            </div>
                                            <?php
                                                if (COLUMN_LEFT_STATUS == 0 || (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '') || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_LEFT_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == ''))) {
                                      // global disable of column_left
                                                $flag_disable_left = true;
                                            }?>
                                            <?php
                                                if (!isset($flag_disable_left) || !$flag_disable_left) {
													if($flag_disable_right == true) { 
                                            ?>
                                                <div id="left-column" class="col-lg-3 col-md-custom col-sm-12 col-xs-12 <?php echo $class_name; ?>">	
                                                <?php } else { ?>
                                                <div id="left-column" class="col-lg-3 col-md-custom col-sm-12 col-xs-12 <?php echo $class_name; ?>">	
                                                <?php } ?>
                                                <?php
                                                    /**
                                                    * prepares and displays left column sideboxes
                                                    *
                                                    */
                                                ?>
                                                    <div><?php require(DIR_WS_MODULES . zen_get_module_directory('column_left.php')); ?></div>
                                                </div>
                                            <?php
                                                }
                                            ?>
                                                    
                                            <?php
                                                if (COLUMN_RIGHT_STATUS == 0 || (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '') || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == ''))) {
                                                  // global disable of column_right
                                                  $flag_disable_right = true;
                                                }
                                                    if (!isset($flag_disable_right) || !$flag_disable_right) {
                                                        if($flag_disable_left == true) { 
                                                    ?>
                                                    <div id="right-column" class="col-lg-3 col-md-4 col-sm-12 col-xs-12 rightcolumn">
                                                    <?php
                                                        } else {
                                                    ?>
                                                    <div id="right-column" class="col-lg-3 col-md-4 col-sm-6 col-xs-12 rightcolumnwl">
                                                        <?php
                                                            }
                                                         /**
                                                          * prepares and displays right column sideboxes
                                                          *
                                                          */
                                                        ?>
                                                        <div><?php require(DIR_WS_MODULES . zen_get_module_directory('column_right.php')); ?></div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
						</div>
            		</div>
            	</div>
        	</div>
    	</div>
    </div>
    </div>
        <?php
		 /**
		  * prepares and displays footer output
		  *
		  */
		  if (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_FOOTER_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == '')) {
			$flag_disable_footer = true;
		  }
		  require($template->get_template_dir('tpl_footer.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_footer.php');
		?>
		<!--bof- parse time display -->
<?php
  if (DISPLAY_PAGE_PARSE_TIME == 'true') {
?>
<div class="smallText center">Parse Time: <?php echo $parse_time; ?> - Number of Queries: <?php echo $db->queryCount(); ?> - Query Time: <?php echo $db->queryTime(); ?></div>
<?php
  }
?>
<!--eof- parse time display -->
<!--bof- banner #6 display -->
<?php
  if (SHOW_BANNERS_GROUP_SET6 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET6)) {
    if ($banner->RecordCount() > 0) {
?>
<?php
    }
  }
?>
<!--eof- banner #6 display -->
<?php if($homepage_layout=="homepage_layout_6") { ?>
	    </div>
    </div>
</div>
<?php } ?>
</div>

<div id="fb-root""></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

</body>
