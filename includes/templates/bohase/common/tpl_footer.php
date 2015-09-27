<?php
/**
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_footer.php 3183 2006-03-14 07:58:59Z birdbrain $
 */
require(DIR_WS_MODULES . zen_get_module_directory('footer.php'));
?>
<?php
if (!$flag_disable_footer) {
	$cat_slide = "select * from ".DB_PREFIX."manufacturers ORDER BY RAND()";
	$manufactureimage = $db->Execute($cat_slide);
	

	//$category_query = "select ca.categories_id, ca.categories_image, ca.parent_id, ca.date_added, ca.last_modified, ca.categories_status, cad.categories_id, cad.categories_name, cad.categories_description from " .TABLE_CATEGORIES . " ca, " .TABLE_CATEGORIES_DESCRIPTION . " cad where ca.categories_id = cad.categories_id and ca.categories_status='1' and cad.language_id='".(int)$_SESSION['languages_id']."'";
	///$categories = $db->Execute($category_query);
	
	if($homepage_layout=='homepage_layout_3' || $display_featured_products_style=='display_style_1') {
		$featured_class="col-lg-9 col-md-8";
	}
	else {
		$featured_class="col-lg-12 col-md-12";
	}
	
	if($homepage_layout=='homepage_layout_1' || $homepage_layout=='homepage_layout_2') {
		$strip_class="strip strip-no-bg";
	}
	elseif($bottom_banners_style=="2") {
		$strip_class="strip strip-right-left";
	}
	else {
		$strip_class="strip";
	}
?>
<div class="wrapper-body-inner">
	<div class="body-container">
        <div class="<?php echo $container_class; ?>">
            <?php if ($this_is_home_page){ ?>
            <?php if($display_bottom_banners=="yes") { ?>
            <div class="wide-banners wow fadeInUp animated">
                <div class="row">
                    <?php
                        $i=1;
                        while(!$bottom_banner_query_result->EOF) {
                            $bottom_bannner_image = $bottom_banner_query_result->fields['bottom_banner'];
                            $bottom_banner_caption = $bottom_banner_query_result->fields['bottom_banner_caption'];
                    ?>
                    <?php if($bottom_banners_style=="2") { ?>
                    <div class="<?php if($i==1){ echo 'col-xs-12 col-sm-5 col-md-4';} else { echo $bottom_banner_class;}?>">
                        <div class="wide-banner cnt-strip">
                            <div class="image">
                                <img alt="banner-images" src="<?php echo $template->get_template_dir
                                    ('',DIR_WS_TEMPLATE, $current_page_base,'images').'/banners/'.$bottom_bannner_image;?>" />
                            </div>
                            <div class="<?php echo $strip_class; ?>">
                                <div class="strip-inner">
                                	<?php echo $bottom_banner_caption; ?>
                            	</div>
                            </div>
                        </div>
                    </div>
                    <?php } elseif($bottom_banners_style=="1") { ?>
                    <div class="custom-banner <?php echo $bottom_banner_class;?>">
                        <div class="wide-banner cnt-strip">
                            <div class="image">
                                <img alt="banner-images" src="<?php echo $template->get_template_dir
                                    ('',DIR_WS_TEMPLATE, $current_page_base,'images').'/banners/'.$bottom_bannner_image;?>" />
                            </div>
                            <div class="<?php echo $strip_class; ?>">
                                <div class="strip-inner">
                                    <?php echo $bottom_banner_caption; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php
                        $i++;
                        $bottom_banner_query_result->MoveNext();
                    } 
                    ?>
                </div>
            </div>
            <?php } ?>
            <?php if($display_category=="yes") { ?>
            <div class="sections">	
                <div class="row">
                    <div class="col-md-6">
                    <?php
                        $show_display_category = $db->Execute(SQL_SHOW_PRODUCT_INFO_MAIN);
                        while(!$show_display_category->EOF) {
                    ?>
                        <?php 
                        if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MAIN_NEW_PRODUCTS') { 
                            require($template->get_template_dir('tpl_modules_whats_new_reloaded.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_whats_new_reloaded.php'); 
                        }
                        ?>
                    <?php
                        $show_display_category->MoveNext();
                    } ?>
                    </div>
                    <div class="col-md-6">
                    <?php
                        $show_display_category = $db->Execute(SQL_SHOW_PRODUCT_INFO_MAIN);
                        while(!$show_display_category->EOF) {
                    ?>
                    
                        <?php 
                        if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MAIN_SPECIALS_PRODUCTS') { 
                            require($template->get_template_dir('tpl_modules_specials_default_reloaded.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_specials_default_reloaded.php'); 
                        }
                        ?>
                    <?php
                        $show_display_category->MoveNext();
                    } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php
				if($display_featured_products=='yes')	{
                $show_display_category = $db->Execute(SQL_SHOW_PRODUCT_INFO_MAIN);
                while(!$show_display_category->EOF) {
                    if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MAIN_FEATURED_PRODUCTS') { 
            ?>
            <!-- Index Featured Products Wrapper -->
            <section class="section wow fadeInUp animated">
                <div class="product-grid">
                    <div class="row">
                        <div class="<?php echo $featured_class." ".$column_class; ?> col-sm-12 col-xs-12">
                            <?php if($display_featured_products_style=='display_style_1' || $display_featured_products_style=='display_style_2') { ?>
                                <?php require($template->get_template_dir('tpl_modules_featured_products.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_featured_products_reloaded.php'); ?>
                            <?php } else { ?>
                                <?php require($template->get_template_dir('tpl_modules_featured_products.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_featured_products.php'); ?>
                            <?php } ?>
                        </div>
                        <?php if($display_featured_products_style=='display_style_1') { ?>
                        <div class="col-md-3">
                            <div class="wide-banner cnt-strip m-t-60">
                                <div class="image">
                                    <img alt="banner-images" src="<?php echo $template->get_template_dir
                                        ('',DIR_WS_TEMPLATE, $current_page_base,'images').'/banners/'.$featured_products_banner;?>" />
                                </div>
                                <div class="strip strip-more">
                                    <div class="strip-inner">
                                        <?php echo $featured_products_banner_caption; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        
                        <?php
                            if (COLUMN_RIGHT_STATUS == 0 ||(CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '') || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == ''))) {
                                        // global disable of column_right
                                        $flag_disable_right = true;
                                    }
                            if($homepage_layout=='homepage_layout_3') {
                                $flag_disable_right = false;
                            }
							
							if($homepage_layout=='homepage_layout_3' && $display_featured_products=="yes" && $display_featured_products_style=="display_style_1") {
                                $flag_disable_right = true;
                            }		
                        
                            if (!isset($flag_disable_right) || !$flag_disable_right) {
                                if($flag_disable_left == true) { 
                                  ?>
                                  <div id="right-column" class="col-lg-3 col-md-4 col-sm-12 col-xs-12 rightcolumn m-t-30">
                                  <?php
                                      } else {
                                  ?>
                                  <div id="right-column" class="col-lg-3 col-md-4 col-sm-6 col-xs-12 rightcolumnwl m-t-30">
                                      <?php
                                          }
                                       /**
                                        * prepares and displays right column sideboxes
                                        *
                                        */
                                      ?>
                                      <div>
                                          <?php require(DIR_WS_MODULES . zen_get_module_directory('column_right.php')); ?>
                                          <?php if($display_right_column_banner=="yes") { ?>
                                          <div class="wide-banner cnt-strip rightBoxContainer">
                                              <div class="image">
                                                  <img alt="banner-images" src="<?php echo $template->get_template_dir
                                                     ('',DIR_WS_TEMPLATE, $current_page_base,'images').'/banners/'.$right_column_banner;?>" />
                                              </div>
                                              <div class="strip strip strip-more">
                                                  <?php echo $right_column_banner_caption; ?>
                                              </div>
                                          </div>
                                          <?php } ?>
                                      </div>
    
                                  </div>
                              <?php
                              }
                              ?>
                    </div>                   
                </div>
            </section>
            <!-- Index Featured Products Wrapper Ends -->
            <?php		}
                    $show_display_category->MoveNext();
                	}
				}
			}
            ?>
        </div>
    </div>
</div>
<footer>
	
    <?php
	include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_BRANDS_INFOBOXES, 'false');
	?>
	
    <div class="links-social">
    	<div class="container-class <?php echo $container_class; ?>">
    		<div class="links-social-inner">
    			<div class="row">
    				<div class="col-md-8">
   						<div class="link-groups">
    						<div class="row">
                            
                            	<!-- Information column -->
                            	<?php
								include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_INFORMATION_LINKS, 'false'); ?>
    							<!-- Information column Ends -->
                                <!-- My Account column -->
                                <?php
								include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_ACCOUNT_LINKS, 'false'); ?>
                                <!-- My Account column Ends-->
                                <!-- Customer Care column -->
                                <?php
								include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_CUSTOMER_CARE_LINKS, 'false'); ?>
                                <!-- Customer Care column Ends -->
                                <!-- Get In touch column -->
                                <?php
								include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_GETIN_TOUCH_LINKS, 'false'); ?>
                                <!-- Get In touch column Ends -->
                            </div>
                       	</div>
                   	</div>
                    <div class="col-md-4">
                        <!-- Social/Newletter column -->
						<?php
                        include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_SOCIAL_NEWSLETTER_COLUMN, 'false'); ?>
                        <!-- Social/Newletter column Ends -->
                	</div>
                </div>
           	</div>
        </div>
  	</div>
<!-- Copy Right Section -->
	<div class="copyright">
		<div class="<?php echo $container_class; ?>">
        	<div class="row">
                <div class="copyright-text col-xs-12 col-sm-5">
                    <p>&copy; <?php echo $store_copyright; ?></p>
                </div>
                <div class="payment-image col-xs-12 col-sm-7">
                    <p><img alt="<?php if($payment_image!=NULL){ echo "payment-image"; } ?>" src="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images').'/banners/'.$payment_image;?>" /></p>
                </div>
			</div>
    	</div>
	</div>
<a id="scrollUp" class="top goto-top fa fa-chevron-up fa-2x" style="display: block;"></a>
<!-- Copyright Section Ends -->
<?php
} // flag_disable_footer
?>
</footer>
<!-- Zenshoppe JS Files -->
<!-- Google Jquery -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Google Jquery Ends -->
<?php if ($this_is_home_page) { ?>
	<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/jquery.easing.1.3.js'?>" type="text/javascript"></script>
<?php }	?> 
<!-- Masonary JS -->
<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/masonry.pkgd.min.js'?>" type="text/javascript"></script>
<!-- Masonary JS Ends -->

<!-- Menu Maker JS -->
<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/menumaker.js'?>" type="text/javascript"></script>
<!-- Menu Maker JS Ends -->
<!-- Accordian for Categories Sidebox JS -->
<script src="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/jquery.dcjqaccordion.2.7.js'?>" type="text/javascript"></script>
<!-- Accordian for Categories Sidebox JS Ends -->
<!-- Bootstrap JS -->
<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/bootstrap.js'?>" type="text/javascript"></script>
<!-- Bootstrap JS Ends -->
<!-- Browser Selector JS -->
<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/css_browser_selector.js'?>" type="text/javascript"></script>
<!-- Browser Selector JS Ends -->
<!-- Zenshoppe Custom JS -->
<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/template_custom.js'?>" type="text/javascript"></script>
<!-- Zenshoppe Custom JS Ends -->
<!-- Tab JS -->
<script src="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/tabcontent.js'?>" type="text/javascript"></script>
<!-- Tab JS Ends -->
<!--Owl Slider-->
<script src="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/owl.carousel.js'?>" type="text/javascript"></script>
<!--Owl Slider Ends-->
<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/modernizr.js'?>" type="text/javascript"></script>
<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/wow.min.js'?>" type="text/javascript"></script>
<!-- JQuery Lightbox JS and Cloud Zoom JS-->  
<?php if (in_array($current_page_base,explode(",",'product_info,product_reviews_info,product_reviews,product_reviews_write'))) { ?>
<script src="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/jscript_jquery_1-4-4.js'?>" type="text/javascript"></script>
<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/cloud-zoom.1.0.3.js'?>" type="text/javascript"></script>
<script type="text/javascript">
//Cloud Zoom
var cld = jQuery.noConflict();
cld('#zoom01, .cloud-zoom-gallery').CloudZoom();
</script>
<?php } ?>
<!-- JQuery Lightbox JS and Cloud Zoom JS Ends--> 
<?php if($homepage_layout=="homepage_layout_6") { ?>
<script type="text/javascript">
	/*var $container = $('#product-area, #special-listing');
// initialize
$container.masonry({
  columnWidth: 237,
  gutter: 30,
  itemSelector: '.grid-list, .specialsListBoxContents',
  isFitWidth: true,
});*/
$(window).load(function() {  
    var $container = $('#product-area, #special-listing');
    $container.masonry({
        columnWidth: 237,
  		gutter: 30,
  		itemSelector: '.grid-list, .specialsListBoxContents',
  		isFitWidth: true,
    });
});
//var msnry = $container.data('masonry');
</script>
<?php } else { ?>
<script type="text/javascript">
/*	var $container = $('#product-area, #special-listing');
// initialize
$container.masonry({
  columnWidth: 262,
  gutter: 30,
  itemSelector: '.grid-list, .specialsListBoxContents',
  isFitWidth: true,
});*/
$(window).load(function() {  
    var $container = $('#product-area, #special-listing');
    $container.masonry({
        columnWidth: 262,
  		gutter: 30,
  		itemSelector: '.grid-list, .specialsListBoxContents',
  		isFitWidth: true,
    });
});
//var msnry = $container.data('masonry');
</script>
<?php } ?>
<script type="text/javascript">
/*OWL CAROUSEL*/
$(document).ready(function () {

	var dragging = true;
	var owlElementID = '#wide-slider';

	function fadeInReset() {
        if (!dragging) {
            $(owlElementID + " .caption .fadeIn-1, " + owlElementID + " .caption .fadeIn-2, " + owlElementID + " .caption .fadeIn-3").stop().delay(800).animate({ opacity: 0 }, { duration: 400, easing: "easeInCubic" });
        }
        else {
            $(owlElementID + " .caption .fadeIn-1, " + owlElementID + " .caption .fadeIn-2, " + owlElementID + " .caption .fadeIn-3").css({ opacity: 0 });
        }
    }
    
    function fadeInDownReset() {
        if (!dragging) {
            $(owlElementID + " .caption .fadeInDown-1, " + owlElementID + " .caption .fadeInDown-2, " + owlElementID + " .caption .fadeInDown-3").stop().delay(800).animate({ opacity: 0, top: "-15px" }, { duration: 400, easing: "easeInCubic" });
        }
        else {
            $(owlElementID + " .caption .fadeInDown-1, " + owlElementID + " .caption .fadeInDown-2, " + owlElementID + " .caption .fadeInDown-3").css({ opacity: 0, top: "-15px" });
        }
    }
    
    function fadeInUpReset() {
        if (!dragging) {
            $(owlElementID + " .caption .fadeInUp-1, " + owlElementID + " .caption .fadeInUp-2, " + owlElementID + " .caption .fadeInUp-3").stop().delay(800).animate({ opacity: 0, top: "15px" }, { duration: 400, easing: "easeInCubic" });
        }
        else {
            $(owlElementID + " .caption .fadeInUp-1, " + owlElementID + " .caption .fadeInUp-2, " + owlElementID + " .caption .fadeInUp-3").css({ opacity: 0, top: "15px" });
        }
    }
    
    function fadeInLeftReset() {
        if (!dragging) {
            $(owlElementID + " .caption .fadeInLeft-1, " + owlElementID + " .caption .fadeInLeft-2, " + owlElementID + " .caption .fadeInLeft-3").stop().delay(800).animate({ opacity: 0, left: "15px" }, { duration: 400, easing: "easeInCubic" });
        }
        else {
            $(owlElementID + " .caption .fadeInLeft-1, " + owlElementID + " .caption .fadeInLeft-2, " + owlElementID + " .caption .fadeInLeft-3").css({ opacity: 0, left: "15px" });
        }
    }
    
    function fadeInRightReset() {
        if (!dragging) {
            $(owlElementID + " .caption .fadeInRight-1, " + owlElementID + " .caption .fadeInRight-2, " + owlElementID + " .caption .fadeInRight-3").stop().delay(800).animate({ opacity: 0, left: "-15px" }, { duration: 400, easing: "easeInCubic" });
        }
        else {
            $(owlElementID + " .caption .fadeInRight-1, " + owlElementID + " .caption .fadeInRight-2, " + owlElementID + " .caption .fadeInRight-3").css({ opacity: 0, left: "-15px" });
        }
    }
    
    function fadeIn() {
        $(owlElementID + " .active .caption .fadeIn-1").stop().delay(500).animate({ opacity: 1 }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeIn-2").stop().delay(700).animate({ opacity: 1 }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeIn-3").stop().delay(1000).animate({ opacity: 1 }, { duration: 800, easing: "easeOutCubic" });
    }
    
    function fadeInDown() {
        $(owlElementID + " .active .caption .fadeInDown-1").stop().delay(500).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInDown-2").stop().delay(900).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInDown-3").stop().delay(1300).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
    }
    
    function fadeInUp() {
        $(owlElementID + " .active .caption .fadeInUp-1").stop().delay(500).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInUp-2").stop().delay(700).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInUp-3").stop().delay(1000).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
    }
    
    function fadeInLeft() {
        $(owlElementID + " .active .caption .fadeInLeft-1").stop().delay(500).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInLeft-2").stop().delay(700).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInLeft-3").stop().delay(1000).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
    }
    
    function fadeInRight() {
        $(owlElementID + " .active .caption .fadeInRight-1").stop().delay(500).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInRight-2").stop().delay(700).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInRight-3").stop().delay(1000).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
    }

    $("#wide-slider").owlCarousel({
		autoPlay: true,
        stopOnHover: true,
        navigation: true,
        pagination: true,
        singleItem: true,
        addClassActive: true,
		slideSpeed: 400,
	  	paginationSpeed: 400,
		rewindNav: true,
        transitionStyle: "fade",

		afterInit: function() {
            fadeIn();
            fadeInDown();
            fadeInUp();
            fadeInLeft();
            fadeInRight();
        },
            
        afterMove: function() {
            fadeIn();
            fadeInDown();
            fadeInUp();
            fadeInLeft();
            fadeInRight();
            
        },
        
        afterUpdate: function() {
            fadeIn();
            fadeInDown();
            fadeInUp();
            fadeInLeft();
            fadeInRight();
        },
        
        startDragging: function() {
            dragging = true;
        },
        
        afterAction: function() {
            fadeInReset();
            fadeInDownReset();
            fadeInUpReset();
            fadeInLeftReset();
            fadeInRightReset();
            dragging = false;

        }
	});

});

</script>