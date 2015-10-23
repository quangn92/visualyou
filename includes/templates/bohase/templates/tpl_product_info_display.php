<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=product_info.<br />
 * Displays details of a typical product
 *
 * @package templateSystem
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_product_info_display.php 19690 2011-10-04 16:41:45Z drbyte $
 */
 //require(DIR_WS_MODULES . '/debug_blocks/product_info_prices.php');
?>
<div class="centerColumn product-container" id="productGeneral">

    <!--bof Form start-->
    <?php echo zen_draw_form('cart_quantity', zen_href_link(zen_get_info_page($_GET['products_id']), zen_get_all_get_params(array('action')) . 'action=add_product', $request_type), 'post', 'enctype="multipart/form-data"') . "\n"; ?>
    <!--eof Form start-->

	<?php if ($messageStack->size('product_info') > 0) echo $messageStack->output('product_info'); ?>
	<div class="product-top product">
    	<div class="row">
            <div class="col-md-5 col-sm-4">
                <div class="product-image-slider">
                    <?php
                        if (zen_not_null($products_image)) {
                    ?>
                    <!--bof Main Product Image -->
                    <div class="product_image">
                        <?php
                        /**
                        * display the main product image
                        */ ?>
                        <?php
                        require($template->get_template_dir('/tpl_modules_main_product_image.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_main_product_image.php'); ?>
                    </div><!--eof product image -->
                    <!--bof product additional images--><?php
                    /**
                     * display the products additional images
                     */
                    require($template->get_template_dir('/tpl_modules_additional_images.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_additional_images.php'); ?>
                    <?php
                        }
                    ?>
                    <!--eof product additional images-->
                </div>
            </div> <!--eof Product_info left wrapper -->
            <div class="col-md-7 col-sm-8">
                <div class="product-info"> 
                    <h1 class="name"><?php echo $products_name; ?></h1>
                    <!--eof Product Name-->
                    <div class="product-info-ratings">
                        <?php 
                            if ($flag_show_product_info_reviews == 1) {
                                if ($reviews->fields['count'] > 0 ) { 
                                    if ($flag_show_product_info_reviews_count == 1) {
                                        echo mb_product_reviews($_GET['products_id']);
                                    } 
                                  } ?>
                        <?php } ?>
                        <p class="rating-links">
                            <a class="lnk" href="<?php echo  zen_href_link(FILENAME_PRODUCT_REVIEWS, zen_get_all_get_params()); ?>" title="<?php echo BUTTON_REVIEWS_ALT; ?>">
                                <?php  echo TEXT_CURRENT_REVIEWS ." ". $reviews->fields['count']; ?>
                            </a>
                            <span class="separator">&nbsp;|&nbsp;</span>
                            <a class="lnk" href="<?php echo zen_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, zen_get_all_get_params(array('reviews_id'))); ?>"><?php echo TEXT_ADD_YOUR_REVIEW; ?></a>
                        </p>
                    </div>
                    <?php if (PRODUCT_INFO_PREVIOUS_NEXT == 1 or PRODUCT_INFO_PREVIOUS_NEXT == 3) { ?>
                    <?php if ($products_found_count > 1) { ?>
                    <div class="product-next-prev">
                        <div class="btn btn-dark-blue btn-small btn-trans" data-toggle="tooltip" data-original-title="Previous Product">
                        	<a href="<?php echo zen_href_link(zen_get_info_page($previous), "cPath=$cPath&products_id=$previous"); ?>"><?php echo $previous_image . $previous_button; ?></a>
                       	</div>
                        <div class="btn btn-dark-blue btn-small btn-trans" data-toggle="tooltip" data-original-title="Next Product">
                        	<a href="<?php echo zen_href_link(zen_get_info_page($next_item), "cPath=$cPath&products_id=$next_item"); ?>"><?php echo  $next_item_button . $next_item_image; ?></a>
                       	</div>
					</div> 
                    <?php } ?>
                    <?php }	?>
                    <div class="stock-container info-container">
                      <!--bof Product Price block -->

                      <div class="price-container info-container">
                          <div class="row">
                              <div class="col-sm-2">
                                  <div class="price-box">
                                      <span class="label">Price :</span>
                                  </div>
                              </div>
                              <div class="col-sm-9">
                              	  <div class="productprice-amount" style="display:inline-block">
                                  	  <div id="productPrices" class="productGeneral">
										  <?php
                                              // base price
                                              if ($show_onetime_charges_description == 'true') {
                                                  $one_time = '<span >' . TEXT_ONETIME_CHARGE_SYMBOL . TEXT_ONETIME_CHARGE_DESCRIPTION . '</span><br />';
                                              } else {
                                                  $one_time = '';
                                              }
                                              echo $one_time . ((zen_has_product_attributes_values((int)$_GET['products_id']) and $flag_show_product_info_starting_at == 1) ? '' : '') . zen_get_products_display_price((int)$_GET['products_id']);
                                          ?>
										</div>
                                  	</div>
                              	</div>
                        	</div>
                      	</div>
                      	
                    <!--bof Add to Cart Box -->
                    <?php
                    if (CUSTOMERS_APPROVAL == 3 and TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE_SHOWROOM == '') {
                      // do nothing
                    } else {
                    ?>
                    <?php
                        $display_qty = (($flag_show_product_info_in_cart_qty == 1 and $_SESSION['cart']->in_cart($_GET['products_id'])) ? '<p>' . PRODUCTS_ORDER_QTY_TEXT_IN_CART . $_SESSION['cart']->get_quantity($_GET['products_id']) . '</p>' : '');
                        if ($products_qty_box_status == 0 or $products_quantity_order_max== 1) {
                            // hide the quantity box and default to 1
                            $the_button = '<input type="hidden" name="cart_quantity" value="1" />' . zen_draw_hidden_field('products_id', (int)$_GET['products_id']) . '<div class="cart_button">'.zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT).'</div>';
                        } else {
						// show the quantity box
						$quantity = str_replace("Add to cart","Quantity ","Add to cart:");
						$the_button = '
							<div class="row">
								<div class="col-sm-3">
									<span class="label">' . $quantity . '</span>
								</div>
								<div class="col-sm-3">
									<input type="text" class="quantity-input txt txt-qty" name="cart_quantity" value="' . (zen_get_buy_now_qty($_GET['products_id'])) . '" maxlength="6" size="4" />
								</div>
								<div class="cart_button col-sm-6">
								<input id="custom-add-button" class="cssButton submit_button button  button_in_cart" onmouseover="this.id=\'custom-add-button-hover\', this.className=\'cssButtonHover  button_in_cart button_in_cartHover\'" onmouseout="this.id=\'custom-add-button\', this.className=\'cssButton submit_button button  button_in_cart\'" type="submit" value="ADD TO CART">
								</div>
							</div>' . zen_get_products_quantity_min_units_display((int)$_GET['products_id']) . zen_draw_hidden_field('products_id', (int)$_GET['products_id']);
							
						}
                        $display_button = zen_get_buy_now_button($_GET['products_id'], $the_button);
                        
                        if (UN_MODULE_WISHLISTS_ENABLED) { $wishlist_link= '<a class="lnk" title="Wishlist" href="' . zen_href_link(UN_FILENAME_WISHLIST, 'products_id=' . $_GET['products_id'] . '&action=wishlist_add_product') . '"><i class="fa fa-heart"></i>Wishlist</a>';}else{ $wishlist_link='';}
						
						$freegift_link = '<a class="lnk" title="Free Gift" href="https://www.visual-you.com/catalog/coupons-amp-specials-ezp-23"><i style="font-size: 15px;" class="fa fa-gift"></i>Free Gift</a>';
                        
                        $compare_link='<a class="lnk" title="Compare" href="javascript: compareNew('.$_GET['products_id'].', \'add\')"><i class="fa fa-exchange"></i>Compare</a>';
                        
                      ?>
                      <?php if ($display_qty != '' or $display_button != '') { ?>
                      <div class="quantity-container info-container">
                          <div class="row">
                              <div class="addtocart-info">
                                  <div class="cart_quantity col-lg-8 col-sm-12">
                                      <?php
                                          //echo $display_qty;
                                          echo $display_button;
                                          //echo $products_qty_box_status;
                                      ?>
                                  </div>
                                  <div class="col-lg-3 col-sm-6">
                                      <div class="btn-options">
                                          <?php echo $wishlist_link; ?>
                                          <?php echo $compare_link; ?>
										  <?php echo $freegift_link; ?>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <?php } // display qty and button ?>
					  <?php } // CUSTOMERS_APPROVAL == 3 ?>
                      <!--eof Add to Cart Box-->
                      <?php
                          //}
                      ?>                    	
                      	
                    </div>

                    <!--bof Attributes Module -->
                    <?php
                      if ($pr_attr->fields['total'] > 0) {
                    ?>
                    <?php
                    /**
                     * display the product atributes
                     */
                      require($template->get_template_dir('/tpl_modules_attributes.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_attributes.php'); ?>
                    <?php
                      }
                    ?>
                    <!--eof Attributes Module -->
                    
                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
			<div class="addthis_sharing_toolbox" style="margin: 15px 0px 15px 0px; width: 100%; float: left;" ></div>
			<!-- Go to www.addthis.com/dashboard to customize your tools -->
            <script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55ff0023c7cbb528" async="async"></script>
			
		    <!-- Counter timer begins -->			
			<div class="countdown">
				<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Unica+One:400|Lobster+Two">
				<script src="/catalog/includes/templates/bohase/jscript/dailydeal-jquery.min.js" type="text/javascript"></script>
				<script src="/catalog/includes/templates/bohase/jscript/dailydeal-flip-countdown.js" type="text/javascript"></script>
				<link href="/catalog/includes/templates/bohase/css/dailydeal-flip-countdown.css" rel="stylesheet" type="text/css" media="all">

				<style>
					.countdown div.digits div.digits-inner div.flip-wrap div.up div.inn, .countdown div.digits div.digits-inner div.flip-wrap div.down div.inn { background: #F04D3B; color: #FFFFFF; }
					.countdown .unit-wrap > span { color: #333333; }
				</style>
				<span class="big-title-big"><a class="custom-lnk" title="Relaunch Specials" href="https://www.visual-you.com/catalog/coupons-specials-ezp-23">Halloween Specials</a> ends in</span>
				<div class="flip-countdown countdown-days" id="clock">
					<div class="unit-wrap">
						<div class="days">										
						</div>
						<span class="ce-days-label">DAYS</span>
					</div>
					<div class="unit-wrap">
						<div class="hours"></div>
						<span class="ce-hours-label">HOURS</span>
					</div>
					<div class="unit-wrap">
						<div class="minutes"></div>
						<span>MINS</span>
					</div>
					<div class="unit-wrap">
						<div class="seconds"></div>
						<span class="ce-seconds-label">SECONDS</span>
					</div>
				</div>
				<script type="text/javascript">
					var productsDateTimeTo = {};productsDateTimeTo["2015-10-27 00:30:00"] = "clock";
					var dateTimeTo = false;
					jQueryDD.each(productsDateTimeTo, function(time, product_ids) {
						dateTimeTo = time;
					});

					if (dateTimeTo === false) {
						jQueryDD('#clock').parent().remove();
					}
					var countdownId = "";
					var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
					for( var i=0; i < 5; i++ ) countdownId += possible.charAt(Math.floor(Math.random() * possible.length));
					jQueryDD('#clock').attr({'id':'clock-'+countdownId});

					var gmt = -07;
					var aDate = new Date();
					var utc = aDate.getTime() + (aDate.getTimezoneOffset() * 60000);
					var newdate = new Date(utc + (3600000*gmt));
					var monthNames = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
					var hours = newdate.getHours().toString();
					if (hours.length==1) {
						hours = '0'+hours;
					}
					var minutes = newdate.getMinutes().toString();
					if (minutes.length==1) {
						minutes = '0'+minutes;
					}
					var seconds = newdate.getSeconds().toString();
					if (seconds.length==1) {
						seconds = '0'+seconds;
					}

					var currentDate = monthNames[newdate.getMonth()]+' '+newdate.getDate()+', '+newdate.getFullYear()+' '+hours+':'+minutes+':'+seconds;
					
					if (dateTimeTo !== false) {
						var dateTimeArray = dateTimeTo.split(' ');
						runCountdown('clock-'+countdownId,dateTimeArray[0],dateTimeArray[1],currentDate,'DAYS','HOURS','MINUTES','SECONDS');
					}
				</script>
			</div>
		    <!-- Counter timer ends-->
			
		    <!-- Product model -->
		    <div style="margin-top: 15px;">
		    <?php if ( (($flag_show_product_info_model == 1 and $products_model != '') or ($flag_show_product_info_weight == 1 and $products_weight !=0) or ($flag_show_product_info_quantity == 1) or ($flag_show_product_info_manufacturer == 1 and !empty($manufacturers_name))) ) { ?>
                            <ul id="productDetailsList" class="floatingBox">
                                <?php echo (($flag_show_product_info_model == 1 and $products_model !='') ? '<li class="custom-product-font">' . TEXT_PRODUCT_MODEL . $products_model . '</li>' : '') . "\n"; ?>
                                <?php echo (($flag_show_product_info_weight == 1 and $products_weight !=0) ? '<li class="custom-product-font">' . TEXT_PRODUCT_WEIGHT .  $products_weight . TEXT_PRODUCT_WEIGHT_UNIT . 
                                    '</li>'  : '') . "\n"; ?>
                                <?php echo (($flag_show_product_info_quantity == 1) ? '<li class="custom-product-font"><span class="units">' . TEXT_PRODUCT_QUANTITY . '</span></li>'  : '') . "\n"; ?>
                                <?php echo (($flag_show_product_info_manufacturer == 1 and !empty($manufacturers_name)) ? '<li class="custom-product-font"><span class="units">' . TEXT_PRODUCT_MANUFACTURER . 
                                    $manufacturers_name . '</span></li>' : '') . "\n"; ?>
                            </ul>
                        <?php } ?>
                        </div>

             </div> 
              </div>
            </div>
            <!--bof free ship icon  -->
            <?php if(zen_get_product_is_always_free_shipping($products_id_current) && $flag_show_product_info_free_shipping) { ?>
            <div id="freeShippingIcon"><?php echo TEXT_PRODUCT_FREE_SHIPPING_ICON; ?></div>
            <?php } ?>
            <!--eof free ship icon  -->
        </div>
	<div class="product-bottom">
        <div class="product-tabs">
            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                <li class="active"><a data-toggle="tab" href="#description"><?php echo TEXT_PRODUCT_DESCRIPTION; ?></a></li>
                <li><a data-toggle="tab" href="#product-info-reviews"><?php echo TEXT_PRODUCT_REVIEWS; ?></a></li>
                <?php if(DISQUS_STATUS != 'false') { ?>
                <li><a data-toggle="tab" href="#product-info-comments"><?php echo TEXT_PRODUCT_COMMENTS; ?></a></li>
                <?php } ?>
		<!--<li><a data-toggle="tab" href="#size-chart"><?php echo TEXT_SIZE_CHART; ?></a></li>-->
                <li><a data-toggle="tab" href="#delivery"><?php echo TEXT_DELIVERY; ?></a></li>
            </ul>
            <div class="tab-content">
                <div id="description" class="tab-pane active">
                    <div class="product-tab">
                        <p class="text"><?php echo stripslashes($products_description); ?></p>
                        <!--bof Product URL -->
						<?php
                          if (zen_not_null($products_url)) {
                            if ($flag_show_product_info_url == 1) {
                        ?>
                            <p id="productInfoLink" class="productGeneral centeredContent"><?php echo sprintf(TEXT_MORE_INFORMATION, zen_href_link(FILENAME_REDIRECT, 'action=product&products_id=' . zen_output_string_protected($_GET['products_id']), 'NONSSL', true, false)); ?></p>
                        <?php
                            } // $flag_show_product_info_url
                          }
                        ?>
                        <!--eof Product URL -->
                        <!--bof Quantity Discounts table -->
							<?php
                              if ($products_discount_type != 0) { ?>
                            <?php
                            /**
                             * display the products quantity discount
                             */
                             require($template->get_template_dir('/tpl_modules_products_quantity_discounts.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_products_quantity_discounts.php'); ?>
                            <?php
                              }
                            ?>
                        <!--eof Quantity Discounts table -->
                    </div>
                </div>
                <div id="product-info-reviews" class="tab-pane">
                    <div class="product-tab">
                        <?php
                            if ($flag_show_product_info_reviews == 1) { 
                        // if more than 0 reviews, then show reviews button; otherwise, show the "write review" button ?>
                                <?php if ($reviews->fields['count'] > 0 ) { ?>
                                    <?php require($template->get_template_dir('tpl_dgReview.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_dgReview.php');?>
                                <?php } else { ?>
                                    <div id="productReviewLink" class="buttonRow back">There are no reviews for this product. <br/><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, zen_get_all_get_params(array())) . '">' . zen_image_button(BUTTON_IMAGE_WRITE_REVIEW, BUTTON_WRITE_REVIEW_ALT) . '</a>'; ?>
                                    </div>
                                <?php
                                  } ?>
                        <?php }
                        ?>
                    </div>
                </div>
                
            <!--    
             <div id="size-chart" class="tab-pane">
                    <div class="product-tab">
			<b>Size Chart Show here</b>
                    </div>
                </div>-->
                
                <div id="delivery" class="tab-pane">
                    <div class="product-tab">
						<?php include('includes/templates/bohase/common/delivery.html'); ?>
                    </div>
                </div>
                
                <div id="product-info-comments" class="tab-pane">
                    <div class="product-tab">
                        <!--Begin Disqus /-->
                        <?php if(DISQUS_STATUS != 'false') { ?>
                        
                        <div id="disqus_thread"></div>
			<script type="text/javascript">
			    /* * * CONFIGURATION VARIABLES * * */
			    var disqus_shortname = 'lokisa';
			    
			    /* * * DON'T EDIT BELOW THIS LINE * * */
			    (function() {
			        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
			        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
			        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			    })();
			</script>
			<noscript>Please enable JavaScript to view the 
				<a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a>
			</noscript>
                        
                        <script type="text/javascript">
			    /* * * CONFIGURATION VARIABLES * * */
			    var disqus_shortname = 'lokisa';
			    
			    /* * * DON'T EDIT BELOW THIS LINE * * */
			    (function () {
			        var s = document.createElement('script'); s.async = true;
			        s.type = 'text/javascript';
			        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
			        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
			    }());
			</script>
                        
                        <?php } ?>
                        <!--End Disqus /-->
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    </div>
   	
    
	<?php require($template->get_template_dir('tpl_modules_also_purchased_products.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_also_purchased_products.php');?>
    <!--eof also purchased products module-->
    
    <!--bof also related products module-->
	<?php require($template->get_template_dir('tpl_modules_related_products.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_related_products.php');?>
<!--eof also related products module-->

    <!--bof Prev/Next bottom position -->
    <?php if (PRODUCT_INFO_PREVIOUS_NEXT == 2 or PRODUCT_INFO_PREVIOUS_NEXT == 3) { ?>
    <?php
    /**
     * display the product previous/next helper
     */
     require($template->get_template_dir('/tpl_products_next_previous.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_products_next_previous.php'); ?>
    <?php } ?>
    <!--eof Prev/Next bottom position -->
    
    <!--bof Product date added/available-->
    <?php
     /* if ($products_date_available > date('Y-m-d H:i:s')) {
        if ($flag_show_product_info_date_available == 1) {
    ?>
      <p id="productDateAvailable" class="productGeneral centeredContent"><?php echo sprintf(TEXT_DATE_AVAILABLE, zen_date_long($products_date_available)); ?></p>
    <?php
        }
      } else {
        if ($flag_show_product_info_date_added == 1) {
    ?>
          <p id="productDateAdded" class="productGeneral centeredContent"><?php echo sprintf(TEXT_DATE_ADDED, zen_date_long($products_date_added)); ?></p>
    <?php
        } // $flag_show_product_info_date_added
      } */
    ?>
    <!--eof Product date added/available -->
    
    <!--bof Form close-->
    </form>
    <!--bof Form close-->
</div>
