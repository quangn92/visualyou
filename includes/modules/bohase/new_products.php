<?php
/**
 * new_products.php module
 *
 * @package modules
 * @copyright Copyright 2003-2008 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: new_products.php 8730 2008-06-28 01:31:22Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

// initialize vars
$categories_products_id_list = '';
$list_of_products = '';
$new_products_query = '';

$display_limit = zen_get_new_date_range();

if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
  $new_products_query = "select distinct p.products_id, p.products_image, p.products_tax_class_id, pd.products_name,
                                p.products_date_added, p.products_date_available, p.products_price, p.products_type, 
								p.master_categories_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                           where p.products_id = pd.products_id
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                           and   p.products_status = 1 " . $display_limit;
} else {
  // get all products and cPaths in this subcat tree
  $productsInCategory = zen_get_categories_products_list( (($manufacturers_id > 0 && $_GET['filter_id'] > 0) ? zen_get_generated_category_path_rev($_GET['filter_id']) : $cPath), false, true, 0, $display_limit);

  if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
    // build products-list string to insert into SQL query
    foreach($productsInCategory as $key => $value) {
      $list_of_products .= $key . ', ';
    }
    $list_of_products = substr($list_of_products, 0, -2); // remove trailing comma

    $new_products_query = "select distinct p.products_id, p.products_image, p.products_tax_class_id, pd.products_name,
                                  p.products_date_added, p.products_date_available, p.products_price, p.products_type, 
								  p.master_categories_id
                           from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                           where p.products_id = pd.products_id
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                           and p.products_status = 1
                           and p.products_id in (" . $list_of_products . ")";
  }
}
//echo $new_products_query;
if ($new_products_query != '') $new_products = $db->ExecuteRandomMulti($new_products_query, MAX_DISPLAY_NEW_PRODUCTS);

$row = 0;
$col = 0;
$list_box_contents = array();
$title = '';

$num_products_count = ($new_products_query == '') ? 0 : $new_products->RecordCount();

// show only when 1 or more
if ($num_products_count > 0) {
  if ($num_products_count < SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS || SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS == 0 ) {
    $col_width = floor(100/$num_products_count);
  } else {
    $col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS);
  }

  while (!$new_products->EOF) {
	  //print_r($new_products);
     $products_price = zen_get_products_display_price($new_products->fields['products_id']);
	
	 $pid=$new_products->fields['products_id'];
	
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
		   $msg_product="<div class='tag tag-orange' title=''><div class='text'>SALE</div></div>";
		}
		else if($pid==$fid)
	     {
		   $msg_product="<div class='tag tag-orange' title=''><div class='text'>HOT</div></div>";
		}
		else
		{
		  $msg_product="<div class='tag tag-blue' title=''><div class='text'>NEW</div></div>";
		}
	
		$products_name = $new_products->fields['products_name'];
		//$products_name = ltrim(substr($products_name, 0, 35) . ''); //Trims and Limits the product name
	
    	if (!isset($productsInCategory[$new_products->fields['products_id']])) $productsInCategory[$new_products->fields['products_id']] = zen_get_generated_category_path_rev($new_products->fields['master_categories_id']);
	
	if (UN_MODULE_WISHLISTS_ENABLED) { 
		$wishlist_link= zen_href_link(UN_FILENAME_WISHLIST, 'products_id=' . $new_products->fields['products_id'] . '&action=wishlist_add_product');
	} else { 
		$wishlist_link='';
	}

	$compare_link='javascript: compareNew('.$new_products->fields['products_id'].', \'add\')';

		/*$buy_now = zen_get_buy_now_button($new_products->fields['products_id'],'');
		if($buy_now!=NULL){
			$buy_now ='<a class="btn btn-dark-blue btn-small-med btn-trans">'.$buy_now.'</a>';
		}
		elseif($attribute_product == $pid) {
			$buy_now = zen_get_buy_now_button($new_products->fields['products_id'],'<a class="btn btn-dark-blue btn-small-med btn-trans" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $new_products->fields['products_id']) . '">Select Options</a>');
		}
		else {
			$buy_now = zen_get_buy_now_button($new_products->fields['products_id'],'<a class="btn btn-dark-blue btn-small-med btn-trans" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $new_products->fields['products_id']) . '">Add to Cart</a>');
		}*/
		
	/*Add to Cart Button*/
	$buy_now = zen_get_buy_now_button($new_products->fields['products_id'],'');
	if($buy_now!=NULL){
		$buy_now = '<a title="Sold Out" class="detailbutton-wrapper add-to-cart" href="' . zen_href_link(zen_get_info_page($new_products->fields['products_id']), 'cPath=' . $productsInCategory[$new_products->fields['products_id']] . '&products_id=' . $new_products->fields['products_id']) . '"><i class="fa fa-ban fa-lg"></i></a>';
	}
	elseif($attribute_product == $pid) {
		$buy_now = '<a title="Add to Cart" class="detailbutton-wrapper add-to-cart" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $new_products->fields['products_id']) . '"><i class="fa fa-shopping-cart fa-lg"></i></a>'; 
	}
	else {
		$buy_now = '<a title="Add to Cart" class="detailbutton-wrapper add-to-cart" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $new_products->fields['products_id']) . '"><i class="fa fa-shopping-cart fa-lg"></i></a>'; 
	}
	
	$list_box_contents[$row][$col] = array('params' => 'class="item centerBoxContentsNew product-item back"' . ' ', 'text' => (($new_products->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : 
	'<div class="product">
		<div class="product-thumbnail">
			<div class="product-thumbnail-image">
				<a href="' . zen_href_link(zen_get_info_page($new_products->fields['products_id']), 'cPath=' . $productsInCategory[$new_products->fields['products_id']] . '&products_id=' . $new_products->fields['products_id']) . '">
					' . zen_image(DIR_WS_IMAGES . $new_products->fields['products_image'], $new_products->fields['products_name'], IMAGE_PRODUCT_NEW_WIDTH, IMAGE_PRODUCT_NEW_HEIGHT) . '
				</a>
			
				<div class="product-thumbnail-buttons">
				
					<div class="add_to_cart_link buttons">
						' . $buy_now . '
					</div>
					
					<div class="wish_link buttons">
						<a title="Add to Wishlist" class="wishlink" href="' . $wishlist_link. '">
							<i class="fa fa-heart"></i>
						</a>
					</div>
					
					<div class="product-compare-link buttons">
						<a title="Add to Compare" class="addtocompare" href="' . $compare_link. '">
						<i class="fa fa-files-o fa-lg"></i>
						</a>
					</div>
				
				</div>
				'.$msg_product.'
			</div>
		</div>
			
		<div class="product-info">
			<h3 class="name">') .  
				'<a href="' . zen_href_link(zen_get_info_page($new_products->fields['products_id']), 'cPath=' . $productsInCategory[$new_products->fields['products_id']] . '&products_id=' . $new_products->fields['products_id']) . '">' . $products_name . '</a>
			</h3>'.
			mb_product_reviews($new_products->fields['products_id']).'
			<div class="price">' 
				. $products_price . 
			'</div>
		</div>
	 </div>');
	
    $col ++;
    if ($col > (SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS - 1)) {
      $col = 0;
      $row ++;
    }
    $new_products->MoveNextRandom();
  }

  if ($new_products->RecordCount() > 0) {
    if (isset($new_products_category_id) && $new_products_category_id != 0) {
      $category_title = zen_get_categories_name((int)$new_products_category_id);
      $title = '<h3 class="section-title">'. sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')) . ($category_title != '' ? ' - ' . $category_title : '' ) . '</h3>';
    } else {
      $title = '<h3 class="section-title">'. sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')) . ($category_title != '' ? ' - ' . $category_title : '' ) . '</h3>';
    }
    $zc_show_new_products = true;
  }
}
?>