<?php
/**
 * Module Template
 *
 * Loaded automatically by index.php?main_page=specials.<br />
 * Displays listing of All Products
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_specials_listing.php 6096 2007-04-01 00:43:21Z ajeh $
 */
?>
<?php
 ?>
 <?php  if(((isset($_GET['view'])) && ($_GET['view']=='rows')) || (PRODUCT_LISTING_LAYOUT_STYLE=='rows' && (!isset($_GET['view'])) )){
 echo '<div id="product-area" class="section offer products-container portrait product-list" data-layout="list">';
}else{
 echo '<div id="product-area" class="section offer products-container portrait product-grid" data-layout="grid">';
} ?>
<div class="row" style=" transform: ">
<?php
  $group_id = zen_get_configuration_key_value('PRODUCT_SPECIALS_GROUP_ID');

  if ($specials_split->number_of_rows > 0) {
	  
	 
    $specials = $db->Execute($specials_split->sql_query);

    while (!$specials->EOF) {

	$products_name = $specials->fields['products_name'];
	//$products_name = ltrim(substr($products_name, 0, 25) . '');
	
	$products_description_full = zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($specials->fields['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION); //To Display Product Desc 
	
	$products_description_list = ltrim(substr($products_description_full, 0, 250) . ''); //Trims and Limits the desc
	
	$moreinfo = '<a class="more_info_text" href="' . zen_href_link(zen_get_info_page($specials->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($specials->fields['master_categories_id']) . '&products_id=' . $specials->fields['products_id']) . '">'.MORE_INFO_TEXT.'</a>';

      if (PRODUCT_SPECIALS_IMAGE != '0') {
        if ($specials->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) {
          $display_products_image = str_repeat('', substr(PRODUCT_SPECIALS_IMAGE, 3, 1));
        } else {
			
		  $product_img_src=mb_getbaseimg_effects($specials->fields['products_image']);
    $second_img_src=mb_gethoverimg_effects($specials->fields['products_image']);
		  
          $display_products_image = zen_image(DIR_WS_IMAGES . $specials->fields['products_image'], $products_name, IMAGE_PRODUCT_SPECIALS_WIDTH, IMAGE_PRODUCT_SPECIALS_HEIGHT) . str_repeat('', substr(PRODUCT_SPECIALS_IMAGE, 3, 1));
        }
      } else {
        $display_products_image = '';
		$product_img_src='';
		$second_img_src='';
      }
	 
      if (PRODUCT_SPECIALS_IMAGE != '0') {
        $display_products_name = '<a href="' . zen_href_link(zen_get_info_page($specials->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($specials->fields['master_categories_id']) . '&products_id=' . $specials->fields['products_id']) . '">' . $products_name . '</a>' . str_repeat('', substr(PRODUCT_SPECIALS_NAME, 3, 1));
      } else {
        $display_products_name = '';
      }

      if (PRODUCT_SPECIALS_WEIGHT != '0' and zen_get_show_product_switch($specials->fields['products_id'], 'weight')) {
        $display_products_weight = TEXT_PRODUCTS_WEIGHT . $specials->fields['products_weight'] . TEXT_SHIPPING_WEIGHT . str_repeat('', substr(PRODUCT_SPECIALS_WEIGHT, 3, 1));
      } else {
        $display_products_weight = '';
      }

      if (PRODUCT_SPECIALS_QUANTITY != '0' and zen_get_show_product_switch($specials->fields['products_id'], 'quantity')) {
        if ($specials->fields['products_quantity'] <= 0) {
          $display_products_quantity = TEXT_OUT_OF_STOCK . str_repeat('', substr(PRODUCT_SPECIALS_QUANTITY, 3, 1));
        } else {
          $display_products_quantity = TEXT_PRODUCTS_QUANTITY . $specials->fields['products_quantity'] . str_repeat('', substr(PRODUCT_SPECIALS_QUANTITY, 3, 1));
        }
      } else {
        $display_products_quantity = '';
      }

      if (PRODUCT_SPECIALS_DATE_ADDED != '0' and zen_get_show_product_switch($specials->fields['products_id'], 'date_added')) {
        $display_products_date_added = TEXT_DATE_ADDED . ' ' . zen_date_long($specials->fields['products_date_added']) . str_repeat('', substr(PRODUCT_SPECIALS_DATE_ADDED, 3, 1));
      } else {
        $display_products_date_added = '';
      }

       if (PRODUCT_SPECIALS_MANUFACTURER != '0' and zen_get_show_product_switch($specials->fields['products_id'], 'manufacturer')) {
        $display_products_manufacturers_name = ($specials->fields['manufacturers_name'] != '' ? TEXT_MANUFACTURER . ' ' . $specials->fields['manufacturers_name'] . str_repeat('', substr(PRODUCT_SPECIALS_MANUFACTURER, 3, 1)) : '');
      } else {
        $display_products_manufacturers_name = '';
      }

      if ((PRODUCT_SPECIALS_PRICE != '0' and zen_get_products_allow_add_to_cart($specials->fields['products_id']) == 'Y')  and zen_check_show_prices() == true) {
        $products_price = zen_mb_get_products_display_price($specials->fields['products_id']);
        $display_products_price = TEXT_PRICE . ' ' . $products_price . str_repeat('', substr(PRODUCT_SPECIALS_PRICE, 3, 1)) . (zen_get_show_product_switch($specials->fields['products_id'], 'ALWAYS_FREE_SHIPPING_IMAGE_SWITCH') ? (zen_get_product_is_always_free_shipping($specials->fields['products_id']) ? TEXT_PRODUCT_FREE_SHIPPING_ICON . '<br />' : '') : '');
      } else {
        $display_products_price = '';
		$products_price='';
      }
	

// more info in place of buy now
      if (PRODUCT_NEW_BUY_NOW != '0' and zen_get_products_allow_add_to_cart($specials->fields['products_id']) == 'Y') {
        if (zen_has_product_attributes($specials->fields['products_id'])) {
          $link = '<a href="' . zen_href_link(zen_get_info_page($specials->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($specials->fields['master_categories_id']) . '&products_id=' . $specials->fields['products_id']) . '">' . MORE_INFO_TEXT . '</a>';
        } else {
          if (PRODUCT_SPECIALS_MULTIPLE_ADD_TO_CART > 0 && $specials->fields['products_qty_box_status'] != 0) {
//            $how_many++;
            $link = '<span>'.TEXT_PRODUCT_SPECIALS_MULTIPLE_ADD_TO_CART . "</span><input class='input-text' type=\"text\" name=\"products_id[" . $specials->fields['products_id'] . "]\" value=\"0\" size=\"4\" />";
          } else {
            $link = '<a href="' . zen_href_link(FILENAME_SPECIALS, zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $specials->fields['products_id']) . '">' . zen_image_button(BUTTON_IMAGE_BUY_NOW, BUTTON_BUY_NOW_ALT) . '</a>&nbsp;';
          }
        }

        $the_button = $link;
        $products_link = '<a href="' . zen_href_link(zen_get_info_page($specials->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($specials->fields['master_categories_id']) . '&products_id=' . $specials->fields['products_id']) . '">' . MORE_INFO_TEXT . '</a>';
        $display_products_button = zen_get_buy_now_button($specials->fields['products_id'], $the_button, $products_link) . zen_get_products_quantity_min_units_display($specials->fields['products_id']) . str_repeat('', substr(PRODUCT_NEW_BUY_NOW, 3, 1));
      } else {
        $link = '<a href="' . zen_href_link(zen_get_info_page($specials->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($specials->fields['master_categories_id']) . '&products_id=' . $specials->fields['products_id']) . '">' . MORE_INFO_TEXT . '</a>';
        $the_button = $link;
        $products_link = '<a href="' . zen_href_link(zen_get_info_page($specials->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($specials->fields['master_categories_id']) . '&products_id=' . $specials->fields['products_id']) . '">' . MORE_INFO_TEXT . '</a>';
        $display_products_button = zen_get_buy_now_button($specials->fields['products_id'], $the_button, $products_link) . zen_get_products_quantity_min_units_display($specials->fields['products_id']) . str_repeat('', substr(PRODUCT_NEW_BUY_NOW, 3, 1));
      }

      if (PRODUCT_SPECIALS_DESCRIPTION > '0') {
        $disp_text = zen_get_products_description($specials->fields['products_id']);
        $disp_text = zen_clean_html($disp_text);

        $display_products_description = stripslashes(zen_trunc_string($disp_text, PRODUCT_SPECIALS_DESCRIPTION));
		
      } else {
        $display_products_description = '';
      }
 
	     	$get_discount_prod=mb_discount_product($specials->fields['products_id']);
			
			 $sid=$specials->fields['products_id'];

			 $products_query = "select * from ".TABLE_PRODUCTS." where products_id='$sid'";
			 $products_res = $db->Execute($products_query);
			 
			 $feature_query = "select * from ".TABLE_FEATURED." where products_id='$sid'";
			 $featured_res = $db->Execute($feature_query);
			 
			 $pid=$products_res->fields['products_id'];
			 $fid=$featured_res->fields['products_id'];
			 
			 if($pid==$sid)
				{
				   $msg_product="<div class='tag tag-orange' title=''><div class='text'>SALE</div></div>";
				}
				else if($sid==$fid)
				 {
				   $msg_product="<div class='tag tag-orange' title=''><div class='text'>HOT</div></div>";
				}
				else
				{
				  $msg_product="<div class='tag tag-blue' title=''><div class='text'>NEW</div></div>";
				}
					
			$pid = $specials->fields['products_id'];
			$product_attribute_query = "select distinct products_id from " . TABLE_PRODUCTS_ATTRIBUTES." where products_id='$pid'";
			$product_attribute_query_result = $db->Execute($product_attribute_query);
			$attribute_product=$product_attribute_query_result->fields['products_id'];
		
			/*Wishlist Links*/
			if (UN_MODULE_WISHLISTS_ENABLED) { $wishlist_link= '<a class="lnk" href="' . zen_href_link(UN_FILENAME_WISHLIST, 'products_id=' . $specials->fields['products_id'] . '&action=wishlist_add_product') . '"><i class="fa fa-heart"></i>Wishlist</a>';}else{ $wishlist_link='';}
	
			$compare_link='<a class="lnk" href="javascript: compareNew('.$specials->fields['products_id'].', \'add\')"><i class="fa fa-exchange"></i>Compare</a>';
			
			/*Add to Cart Button*/
			$buy_now = zen_get_buy_now_button($specials->fields['products_id'],'');
			$gridview_buy_now = zen_get_buy_now_button($specials->fields['products_id'],'');
			if($buy_now!=NULL){
				$buy_now ='<a class="btn btn-dark-blue btn-small-med btn-trans">'.$buy_now.'</a>';
				$gridview_buy_now = '<a title="Sold Out" class="detailbutton-wrapper add-to-cart" href="' . zen_href_link(zen_get_info_page($specials->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($specials->fields['master_categories_id']) . '&products_id=' . $specials->fields['products_id']) . '"><i class="fa fa-ban fa-lg"></i></a>';
			}
			elseif($attribute_product == $pid) {
				$buy_now = zen_get_buy_now_button($specials->fields['products_id'],'<a class="btn btn-dark-blue btn-small-med btn-trans" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $specials->fields['products_id']) . '">Select Options</a>');
				
				$gridview_buy_now = '<a title="Add to Cart" class="detailbutton-wrapper add-to-cart" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $specials->fields['products_id']) . '"><i class="fa fa-shopping-cart fa-lg"></i></a>'; 
			}
			else {
				$buy_now = zen_get_buy_now_button($specials->fields['products_id'],'<a class="btn btn-dark-blue btn-small-med btn-trans" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $specials->fields['products_id']) . '">Add to Cart</a>');
				
				$gridview_buy_now = '<a title="Add to Cart" class="detailbutton-wrapper add-to-cart" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $specials->fields['products_id']) . '"><i class="fa fa-shopping-cart fa-lg"></i></a>'; 
			}
			
			/*Wishlist Links*/
			if (UN_MODULE_WISHLISTS_ENABLED) { 
				$gridview_wishlist_link= zen_href_link(UN_FILENAME_WISHLIST, 'products_id=' . $specials->fields['products_id'] . '&action=wishlist_add_product');
			}else{ $gridview_wishlist_link=''; }
	
			$gridview_compare_link='javascript: compareNew('.$specials->fields['products_id'].', \'add\')';
			
 ?>
 <?php 
 if((isset($_GET['view'])) && ($_GET['view']=='rows')){ $pos_list='style="display: block; opacity: 1;"';}else{ $pos_list='style="display: inline-block; opacity: 1;"'; }
 ?>
	<div class="mix mix_all grid-list" <?php echo $pos_list; ?>>
    	<div data-filter="all products" data-name="<?php echo $products_name; ?>" data-discount="0" data-price="110" class="item product-item">
        	<!-- Product Grid View -->
            <div class="product grid-view">
			
				<div class="product-thumbnail">
					<div class="product-thumbnail-image">
						<a href="<?php echo zen_href_link(zen_get_info_page($specials->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($specials->fields['master_categories_id']) . '&products_id=' . $specials->fields['products_id']);?>"><?php echo $display_products_image; ?></a>
					
						<div class="product-thumbnail-buttons">
						
							<div class="add_to_cart_link buttons">
								<?php echo $gridview_buy_now; ?>
							</div>
							
							<div class="wish_link buttons">
								<a title="Add to Wishlist" class="wishlink" href="<?php echo $gridview_wishlist_link; ?>">
									<i class="fa fa-heart"></i>
								</a>
							</div>
							
							<div class="product-compare-link buttons">
								<a title="Add to Compare" class="addtocompare" href="<?php echo $gridview_compare_link; ?>">
								<i class="fa fa-files-o fa-lg"></i>
								</a>
							</div>
						
						</div>
						<?php echo $msg_product; ?>
					</div>
				</div>
				
                <div class="product-info">
                   	<h3 class="name">
           				<?php echo $display_products_name; ?>
                   	</h3>
                    <?php echo mb_product_reviews($specials->fields['products_id']);?>
                    <div class="price">
                    	<?php echo $products_price; ?>
                    </div>
              	</div>
           	</div>
            <!-- Product Grid View Ends -->
            <!-- Product List View -->
            <div class="product-listview list-view">
				<div class="row product-list-row">
					<div class="col col-lg-4 col-sm-4">
						<div class="product-image">
                            <div class="image">
                                <?php echo $display_products_image; ?>
                            </div>
						</div>
                   	</div>
                    <div class="col col-lg-8 col-sm-8">
                    	<div class="product-info">
                            <h3 class="name">
                                <?php echo $display_products_name; ?>
                            </h3>
                            <?php echo mb_product_reviews($specials->fields['products_id']);?>
                            <div class="description">
                            	<?php echo $products_description_list.$moreinfo; ?>
                            </div>
                            <div class="product-stats">
                                <div class="row">
                                    <div class="col col-sm-4">
                                        <div class="price"><?php echo $products_price; ?></div>
                                    </div>
                                    <div class="col col-sm-8">
                                        <div class="cart-action">
                                            <?php echo $buy_now; ?>
                                        </div>
                                        <div class="sec-action">
                                            <?php echo $wishlist_link . $compare_link; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
                    </div><?php echo $msg_product; ?>
          		</div>
     		</div>
            <!-- Product List View Ends -->
        </div>	
	</div>
<?php
      $specials->MoveNext();
    }
  } else {
?>
<div class="col-xs-12"><div class="alert alert-info"><?php echo TEXT_NO_SPECIALS; ?></div></div>
<?php
  }
?>
</div>
</div>