<?php
/**
 * also_purchased_products.php
 *
 * @package modules
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: also_purchased_products.php 5369 2006-12-23 10:55:52Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
if (isset($_GET['products_id']) && SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS > 0 && MIN_DISPLAY_ALSO_PURCHASED > 0) {

  $also_purchased_products = $db->Execute(sprintf(SQL_ALSO_PURCHASED, (int)$_GET['products_id'], (int)$_GET['products_id']));

  $num_products_ordered = $also_purchased_products->RecordCount();

  $row = 0;
  $col = 0;
  $list_box_contents = array();
  $title = '';

  // show only when 1 or more and equal to or greater than minimum set in admin
  if ($num_products_ordered >= MIN_DISPLAY_ALSO_PURCHASED && $num_products_ordered > 0) {
    if ($num_products_ordered < SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS) {
      $col_width = floor(100/$num_products_ordered);
    } else {
      $col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS);
    }

    while (!$also_purchased_products->EOF) {
		
		$products_price = zen_get_products_display_price($also_purchased_products->fields['products_id']);
		
		$pid=$also_purchased_products->fields['products_id'];
	
		$specials_query = "select * from ".TABLE_SPECIALS." where products_id='$pid'";
		$specials_res = $db->Execute($specials_query);
		$feature_query = "select * from ".TABLE_FEATURED." where products_id='$pid'";
		$featured_res = $db->Execute($feature_query);
		  
		$product_attribute_query = "select distinct products_id from " . TABLE_PRODUCTS_ATTRIBUTES." where products_id='$pid'";
	 	$product_attribute_query_result = $db->Execute($product_attribute_query);
		  
		$sid=$specials_res->fields['products_id'];
		$fid=$featured_res->fields['products_id'];
		$attribute_product=$product_attribute_query_result->fields['products_id'];
		
		/*Reviews Query*/
		 $review_query = "select products_id, reviews_rating from ".TABLE_REVIEWS." where products_id='$pid'";
		 $review_res = $db->Execute($review_query);
		 $rating_stars = $review_res->fields['reviews_rating'];
			if($pid==$sid)
			{
			   $msg_product="<div class='tag tag-orange' title=''><div class='text'>Sale</div></div>";
			}
			else if($pid==$fid)
			 {
			   $msg_product="<div class='tag tag-orange' title=''><div class='text'>Hot</div></div>";
			}
			else
			{
			  $msg_product="<div class='tag tag-blue' title=''><div class='text'>New</div></div>";
			}
		
      	$also_purchased_products->fields['products_name'] = zen_get_products_name($also_purchased_products->fields['products_id']);
	  	
		$products_name = $also_purchased_products->fields['products_name'];
		//$products_name = ltrim(substr($products_name, 0, 30) . '');
	
		/*Wishlist/Compare Links*/
		if (UN_MODULE_WISHLISTS_ENABLED) { $wishlist_link= '<a class="lnk" href="' . zen_href_link(UN_FILENAME_WISHLIST, 'products_id=' . $also_purchased_products->fields['products_id'] . '&action=wishlist_add_product') . '"><i class="fa fa-heart"></i>Wishlist</a>';}else{ $wishlist_link='';}
	
		$compare_link='<a class="lnk" href="javascript: compareNew('.$also_purchased_products->fields['products_id'].', \'add\')"><i class="fa fa-exchange"></i>Compare</a>';
		/*Wishlist/Compare Links Ends*/
			
	
		$buy_now = zen_get_buy_now_button($also_purchased_products->fields['products_id'],'');
		if($buy_now!=NULL){
			$buy_now ='<a class="sold_out"><i class="fa fa-ban"></i></a>'.$buy_now;
		}
		elseif($attribute_product == $pid) {
			$buy_now = zen_get_buy_now_button($also_purchased_products->fields['products_id'],'<a class="btn btn-dark-blue btn-small-med btn-trans" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $also_purchased_products->fields['products_id']) . '">Select Options</a>');
		}
		else {
			$buy_now = zen_get_buy_now_button($also_purchased_products->fields['products_id'],'<a class="btn btn-dark-blue btn-small-med btn-trans" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $also_purchased_products->fields['products_id']) . '">Add to Cart</a>');
		}
		
		
	  $list_box_contents[$row][$col] = array('params' => 'class="centerBoxContentsAlsoPurch item"', 'text' => (($also_purchased_products->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : '
	<div class="product">
		<div class="product-image">
			<div class="image">' . zen_image(DIR_WS_IMAGES . $also_purchased_products->fields['products_image'], $also_purchased_products->fields['products_name'], IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT) . '
			</div>
			<div class="cart">
				<div class="action">
					<div>'.$buy_now.'</div>
					<div>'.$wishlist_link.'</div>
					<div>'.$compare_link.'</div>
				</div>
			</div>'.$msg_product.'
		</div>
			
		<div class="product-info">
			<h3 class="name">') .  
				'<a href="' . zen_href_link(zen_get_info_page($also_purchased_products->fields['products_id']), 'cPath=' . $productsInCategory[$also_purchased_products->fields['products_id']] . '&products_id=' . $also_purchased_products->fields['products_id']) . '">' . $products_name . '</a>
			</h3>'.
			mb_product_reviews($also_purchased_products->fields['products_id']).'
			<div class="price">' 
				. $products_price . 
			'</div>
		</div>
	 </div>');

      $col ++;
      if ($col > (SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS - 1)) {
        $col = 0;
        $row ++;
      }
      $also_purchased_products->MoveNext();
    }
  }
  if ($also_purchased_products->RecordCount() > 0 && $also_purchased_products->RecordCount() >= MIN_DISPLAY_ALSO_PURCHASED) {
	$title = '<h3 class="section-title">'. TEXT_ALSO_PURCHASED_PRODUCTS .'</h3>';
    $zc_show_also_purchased = true;
  }
}
?>