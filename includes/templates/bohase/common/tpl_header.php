<?php
/**
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 @version $Id: tpl_header.php 3392 2006-04-08 15:17:37Z birdbrain $
 */
?>


<?php
	// Display all header alerts via messageStack:
  	if ($messageStack->size('header') > 0) {
    	echo $messageStack->output('header');
  	}
  	if (isset($_GET['error_message']) && zen_not_null($_GET['error_message'])) {
  		echo htmlspecialchars(urldecode($_GET['error_message']));
  	}
  	if (isset($_GET['info_message']) && zen_not_null($_GET['info_message'])) {
   		echo htmlspecialchars($_GET['info_message']);
	} else {
	}
?>
<!--bof-header logo and navigation display-->
<?php
if (!isset($flag_disable_header) || !$flag_disable_header) {
?>

<!-- Header Container -->
<header class="<?php echo $header_class; ?>">
	<!---Top Bar Container -->
	<div class="header-top animate-dropdown">
    	<div class="<?php echo $container_class; ?>">
        	<div class="row">
            	<div class="col-lg-12">
                    <div class="header-top-inner">
                        <div class="custom-left-top-column cnt-account">
                            <ul class="list-unstyled list-inline">
                                <li>
                                    <a class='my_account' href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>">
                                        <?php echo HEADER_TITLE_MY_ACCOUNT; ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo zen_href_link(wishlist, '', 'SSL'); ?>">
                                        <?php echo HEADER_TITLE_WISHLIST; ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo zen_href_link(compare, '', 'SSL'); ?>">
                                        <?php echo HEADER_TITLE_COMPARE; ?>
                                    </a>
                                </li>
                                <li>
                                    <?php if (isset($_SESSION['customer_id'])) { ?>
                                        <a class="logout" href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>">
                                            <?php echo HEADER_TITLE_LOGOFF; ?>
                                        </a>
                                    <?php } else { ?>
                                        <a class="login" href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>">
                                            <?php echo HEADER_TITLE_LOGIN; ?>
                                        </a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>
						
                        <div class="custom-right-top-column cnt-cart">
                            <ul class="list-unstyled list-inline">
								<li class="dropdown dropdown-cart">
									<div id="google_translate_element"></div>
									<script type="text/javascript">
										function googleTranslateElementInit() {
										  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'de,en,es,fr,ja,ko', layout: google.translate.TranslateElement.FloatPosition.TOP_RIGHT}, 'google_translate_element');
										}
									</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
								</li>
                                <?php 
                                    if (HEADER_LANGUAGES_DISPLAY == 'True') {
                                ?>
                                <li class="dropdown dropdown-small">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Language <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <?php include(DIR_WS_MODULES . zen_get_module_directory('header_languages.php')); ?>
                                    </ul>
                                </li>
                                <?php } ?>
                                <?php 
                                    if (HEADER_CURRENCIES_DISPLAY == 'True') {
                                ?>
                                <li class="dropdown dropdown-small">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Currency <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <?php include(DIR_WS_MODULES . zen_get_module_directory('header_currencies.php')); ?>
                                    </ul>
                                </li>
                                <?php } ?>
                                <?php
                                    // BOF AJAX Cart 
                                    if (ZX_AJAX_CART_STATUS == 'true') {
                                ?>
                                <li class="dropdown dropdown-cart">
                                    <!-- BOF ZX AJAX Add to Cart -->
                                    <?php
                                                echo '<div id="carttopcontainer" class="dropdown-menu"></div>';
                                                require(DIR_WS_MODULES. 'sideboxes/'.$template_dir. '/zx_ajax_shopping_cart.php');
                                    ?>
                                    <!-- EOF ZX AJAX Add to Cart -->
                                </li>
                                <?php	} 
                                        // EOF AJAX Cart
                                ?>
                            </ul>
                        </div>
                    </div>
            	</div>
            </div>
        </div>
    </div>
    <!---Top Bar Container Ends -->
    <!-- Sticky Header -->
    <div class="header-top sticky-header-wrapper animate-dropdown">
    	<div class="container">
        	<div class="row">
                <div class="header-top-inner">
                    <div class="custom-left-top-column">
                        <div class="cnt-account">
                            <ul class="list-unstyled list-inline">
                                <li>
                                    <a class='my_account' href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>">
                                        <?php echo HEADER_TITLE_MY_ACCOUNT; ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo zen_href_link(wishlist, '', 'SSL'); ?>">
                                        <?php echo HEADER_TITLE_WISHLIST; ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo zen_href_link(compare, '', 'SSL'); ?>">
                                        <?php echo HEADER_TITLE_COMPARE; ?>
                                    </a>
                                </li>
                                <li>
                                    <?php if (isset($_SESSION['customer_id'])) { ?>
                                        <a class="logout" href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>">
                                            <?php echo HEADER_TITLE_LOGOFF; ?>
                                        </a>
                                    <?php } else { ?>
                                        <a class="login" href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>">
                                            <?php echo HEADER_TITLE_LOGIN; ?>
                                        </a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>
                    </div>
					
                    <div class="custom-right-top-column">
                        <div class="cnt-cart">
                            <ul class="list-unstyled list-inline">
                            	<?php 
                            		if (HEADER_LANGUAGES_DISPLAY == 'True') {
                                ?>
								<li class="dropdown dropdown-small">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Language <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <?php include(DIR_WS_MODULES . zen_get_module_directory('header_languages.php')); ?>
                                    </ul>
                                </li>
                                <?php } ?>
                                <?php 
                            		if (HEADER_CURRENCIES_DISPLAY == 'True') {
                                ?>
                                <li class="dropdown dropdown-small">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Currency <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <?php include(DIR_WS_MODULES . zen_get_module_directory('header_currencies.php')); ?>
                                    </ul>
                                </li>
                                <?php } ?>
                                <?php
                                	// BOF AJAX Cart 
                                    if (ZX_AJAX_CART_STATUS == 'true') {
								?>
                                <li class="dropdown dropdown-cart">
                                    <!-- BOF ZX AJAX Add to Cart -->
                                    <?php
                                    	echo '<div id="carttopcontainer" class="dropdown-menu"></div>';
                                        require(DIR_WS_MODULES. 'sideboxes/'.$template_dir. '/zx_ajax_shopping_cart.php');
                                    ?>
                                    <!-- EOF ZX AJAX Add to Cart -->
                                </li>
                                <?php	} 
                                	// EOF AJAX Cart
								?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sticky Header Ends -->
	<?php if($header_style=='header_style_2') { ?>
    <div class="header-nav animate-dropdown <?php echo $header_nav_class; ?>">
    	<div class="navbar navbar-default" role="navigation">
			<div class="container-class <?php echo $container_class; ?>">
            	<div class="row">
                    <div class="navbar-header col-lg-3 col-md-3 col-xs-12 col-sm-12">
                        <a class="navbar-brand" href="#">
                            <div class="logo">
                                <img alt="<?php if($logo_image!=NULL){ echo "logo"; } ?>" src="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images').'/logo/'.$logo_image;?>" />
                            </div>
                        </a>
                    </div>
                    <div class="nav-bg-class <?php echo $nav_bg_class; ?> col-lg-6 col-md-6 col-xs-12 col-sm-6">
                        <div class="navbar-collapse">
                            <div class="nav-outer">
                                <div id="cssmenu">
                                        <?php require($template->get_template_dir('tpl_drop_menu.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_drop_menu.php');?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cnt-search col-lg-3 col-md-3 col-xs-12 col-sm-6">
                        <div class="input-group">
                            <!--<a class="fa fa-search search-button" href=""> </a>-->
                            <div class="field">
                                <!--Search Bar-->
                                <?php
                                   $text = str_replace("ENTER SEARCH KEYWORDS HERE", "Search entire store here..", "ENTER SEARCH KEYWORDS HERE");
                                   $content = "";
                                   $content .= zen_draw_form('quick_find_header', zen_href_link
                                              (FILENAME_ADVANCED_SEARCH_RESULT, '', 'SSL', false), 'get');
                                   $content .= zen_draw_hidden_field('main_page',FILENAME_ADVANCED_SEARCH_RESULT);
                                   $content .= zen_draw_hidden_field('search_in_description', '1') . zen_hide_session_id();
                                   $content .= '<div class="form-search">' . 
                                     zen_draw_input_field('keyword', '', 'class="input-text" maxlength="30" value="'.$text.'" onfocus="if(this.value == \''.$text.'\') this.value = \'\';" onblur="if (this.value == \'\') this.value = \'' . $text . '\';"') . '<span class="input-group-btn"><button class="btn btn-default" title="Search" type="submit"><i class="fa fa-search"></i></button></span></div>';
                                   $content .= "</form>";
                                   echo($content);
                                ?>
                                <!--Search Bar Ends-->
                            </div>
                        </div>
                    </div>
                </div>
        	</div>
        </div>
    </div>
    <?php } elseif($header_style=='header_style_1') { ?>
    <div class="container-class <?php echo $container_class; ?>">
        <div class="row">
            <div class="navbar-header col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="logo">
                	<a class="navbar-brand" href="#">
                        <img alt="<?php if($logo_image!=NULL){ echo "logo"; } ?>" src="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images').'/logo/'.$logo_image;?>" />
               		</a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-nav animate-dropdown <?php echo $header_nav_class; ?>">
        <div class="navbar navbar-default" role="navigation">
			<div class="container-class <?php echo $container_class; ?>">
                <div class="row">
                    <div class="nav-bg-class <?php echo $nav_bg_class; ?> col-lg-9 col-md-9 col-xs-12 col-sm-6">
                        <div class="navbar-collapse">
                            <div class="nav-outer">
                                <div id="cssmenu">
                                        <?php require($template->get_template_dir('tpl_drop_menu.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_drop_menu.php');?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cnt-search col-lg-3 col-md-3 col-xs-12 col-sm-6">
                        <div class="input-group">
                            <!--<a class="fa fa-search search-button" href=""> </a>-->
                            <div class="field">
                                <!--Search Bar-->
                                <?php
                                   $text = str_replace("ENTER SEARCH KEYWORDS HERE", "Search entire store here..", "ENTER SEARCH KEYWORDS HERE");
                                   $content = "";
                                   $content .= zen_draw_form('quick_find_header', zen_href_link
                                              (FILENAME_ADVANCED_SEARCH_RESULT, '', 'SSL', false), 'get');
                                   $content .= zen_draw_hidden_field('main_page',FILENAME_ADVANCED_SEARCH_RESULT);
                                   $content .= zen_draw_hidden_field('search_in_description', '1') . zen_hide_session_id();
                                   $content .= '<div class="form-search">' . 
                                     zen_draw_input_field('keyword', '', 'class="input-text" maxlength="30" value="'.$text.'" onfocus="if(this.value == \''.$text.'\') this.value = \'\';" onblur="if (this.value == \'\') this.value = \'' . $text . '\';"') . '<span class="input-group-btn"><button class="btn btn-default" title="Search" type="submit"><i class="fa fa-search"></i></button></span></div>';
                                   $content .= "</form>";
                                   echo($content);
                                ?>
                                <!--Search Bar Ends-->
                            </div>
                        </div>
                    </div>
                </div>
        	</div>
        </div>
    </div>
	<?php } else { ?>
    <div class="header-nav animate-dropdown <?php echo $header_nav_class; ?>">
    	<div class="navbar navbar-default" role="navigation">
			<div class="container-class <?php echo $container_class; ?>">
				<div class="navbar-header">
                   	<div class="logo">
                        <div style="position: relative; width: 25%; height: 134px; float:left;">
                            <div style="margin-top: 25px;text-align: left;">
                                <script type="text/javascript">
                                    function togglediv(id) {
                                        var div = document.getElementById(id);
                                        div.style.display = div.style.display == "none" ? "block" : "none";
                                    }

                                    setInterval(
                                        function(){ 
                                            togglediv('int-shipping');  
                                            togglediv('us-shipping'); 
                                        }, 3000);
                                </script>
                                <font face="Calibri">
                                <div class="shipping" id="int-shipping" style="display:none;">
                                <h3 style="color:red;">Free Shipping</h3>
                                <p style="font-size:15px;">on all INT. orders <strike>$110</strike> $80+</p>
                                    <p style="font-size:10px;"><a href="https://www.visual-you.com/catalog/coupons-specials-ezp-23"><u>DETAILS</u></a></p>
                                </div>

                                <div class="shipping" id="us-shipping" style="display:block;">
                                <h3 style="color:red;">Free Shipping</h3>
                                <p style="font-size:15px;">on all U.S. orders <strike>$85</strike> $50+</p>
                                <p style="font-size:10px;"><a href="https://www.visual-you.com/catalog/coupons-specials-ezp-23"><u>DETAILS</u></a></p>
                                </div>
                                </font>

                            </div> 
</div>
						<div style="position: relative; width: 50%; height: 100%; float: left;">
							<a class="custom-navbar-brand" href="#">
								<img alt="<?php if($logo_image!=NULL){ echo "logo"; } ?>" src="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images').'/logo/'.$logo_image;?>" />
							</a>
						</div>
						<div style="position: relative; width: 25%; height: 134px; float:left;">
						<div style="position: absolute; bottom: 0; right: 0;">
							<div class="fb-like" style="float: left; margin-right: 5px;" data-href="<?php echo $facebook_link; ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>

								<a target="_blank" href="<?php echo $instagram_link; ?>">
								<img style="margin-bottom: 15px;" src="https://www.visual-you.com/images/new_social_mini_ig.gif" width="25" height="25"></a>

								<a target="_blank" href="<?php echo $tumblr_link; ?>">
								<img style="margin-bottom: 15px;" src="https://www.visual-you.com/images/new_social_mini__tumblr.gif" width="25" height="25" alt="s"></a>

								<a target="_blank" href="<?php echo $twitter_link; ?>">
								<img style="margin-bottom: 15px;" src="https://www.visual-you.com/images/new_social_mini_twitter.gif" width="25" height="25"></a>

								<a target="_blank" href="<?php echo $pinterest_link; ?>">
								<img style="margin-bottom: 15px;" src="https://www.visual-you.com/images/new_social_mini_pinterest.gif" width="25" height="25"></a>
							</div>
						</div>
                    </div> 
                </div>
                <div class="nav-bg-class <?php echo $nav_bg_class; ?>">
                    <div class="navbar-collapse">
                        <div class="nav-outer">
                            <div id="cssmenu">
                                    <?php require($template->get_template_dir('tpl_drop_menu_2.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_drop_menu_2.php');?>
                            </div>
                        </div>
                    </div>
                </div>
        	</div>
        </div>
    </div>
	<?php } ?>
</header>
<!-- header-container End-->

<?php if ($this_is_home_page) { ?>
	
<div class="body-container">
	<!-- Slideshow-Container-->	
    <?php if($full_width_slideshow=='full_width') { ?>
    <div class="no-animate wide-slider wide-slider-large wide-slider-pagination m-t-30">
        <div id="wide-slider" class="owl-carousel owl-theme">
            <?php
                while(!$slideshow_query_result->EOF) {
                    $slider_image = $slideshow_query_result->fields['slideshow_image'];
                    $slider_caption = $slideshow_query_result->fields['slideshow_caption'];
            ?>
            <div class="item">
                <div class="content caption">
                    <div class="<?php echo $container_class; ?>">
                        <?php echo $slider_caption; ?>
                    </div>
                </div>
                <img alt="slideshow-images" src="<?php echo $template->get_template_dir
                ('',DIR_WS_TEMPLATE, $current_page_base,'images').'/slideshow/'.$slider_image;?>" />
            </div>
            <?php
                $slideshow_query_result->MoveNext();
                }
            ?>
        </div>
    </div>
    <?php } else { ?>
    <div class="<?php echo $container_class; ?>">
		<div class="wide-banners">
			<div class="row">
				<div class="<?php echo $slideshow_class; ?>">
                	<div class="no-animate wide-slider wide-slider-<?php echo $full_width_slideshow ." ".$pagination_class; ?> m-t-30">
                    	<div id="wide-slider" class="owl-carousel owl-theme">
							<?php
                                while(!$slideshow_query_result->EOF) {
                                    $slider_image = $slideshow_query_result->fields['slideshow_image'];
                                    $slider_caption = $slideshow_query_result->fields['slideshow_caption'];
                            ?>
                            <div class="item">
                                <div class="content caption <?php echo $caption_class; ?>">
                                	<?php if($full_width_slideshow!="small"){ ?>
                                    <div class="content-inner <?php if($full_width_slideshow!="large" && $homepage_layout!="homepage_layout_5"){ echo $container_class; } ?>">
                                    <?php } ?>
										<?php echo $slider_caption; ?>
                                    <?php if($full_width_slideshow!="small"){ ?>
                                   	</div>
                                    <?php } ?>
                                </div>
                                <img alt="slideshow-images" src="<?php echo $template->get_template_dir
                                ('',DIR_WS_TEMPLATE, $current_page_base,'images').'/slideshow/'.$slider_image;?>" />
                            </div>
                            <?php
                                $slideshow_query_result->MoveNext();
                                }
                            ?>
                        </div>
                    </div>
    			</div>
                <?php if($full_width_slideshow!="large" && $display_top_banners=="yes") { 
					$i=1;					
					while(!$top_banner_query_result->EOF) {
                        $top_banner_image = $top_banner_query_result->fields['top_banner'];
                        $top_banner_caption = $top_banner_query_result->fields['top_banner_caption'];
				?>
                <?php if($full_width_slideshow=="small") { ?>
                <div class="<?php if($i==1 || $slideshow_position=="right"){ echo $slideshow_banner_class; } else { echo "col-md-3"; }?> ">
                	<div class="wide-banner cnt-strip">
                        <div class="image">
                            <img alt="banner-images" src="<?php echo $template->get_template_dir
                                ('',DIR_WS_TEMPLATE, $current_page_base,'images').'/banners/'.$top_banner_image;?>" />
                        </div>
                        <div class="strip">
                            <?php echo $top_banner_caption; ?>
                        </div>
                    </div>
                </div>
                <?php } elseif($full_width_slideshow=="medium" && $i==1) { ?>
                <div class="<?php echo $slideshow_banner_class; ?>">
                	<div class="wide-banner cnt-strip">
                        <div class="image">
                            <img alt="banner-images" src="<?php echo $template->get_template_dir
                                ('',DIR_WS_TEMPLATE, $current_page_base,'images').'/banners/'.$top_banner_image;?>" />
                        </div>
                        <div class="strip">
                            <?php echo $top_banner_caption; ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php 
					$i++;
                    $top_banner_query_result->MoveNext();
				} ?>
                <?php } ?>
         	</div>
       	</div>
   	</div>
	<?php } ?>
    <!-- Slideshow-Container Ends-->
</div>
<?php } ?>

<?php if (!$this_is_home_page) { ?>
	<div id="headerpic">
		<?php
        	if (SHOW_BANNERS_GROUP_SET3 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET3)) {
            	if ($banner->RecordCount() > 0) {
        ?>
		<div id="bannerThree" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
		<?php
            }
          }
        ?>
	</div>
		<?php } ?>
    <?php } ?>
