<?php
/**
 * specials_index module
 *
 * @package modules
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: specials_index.php 6424 2007-05-31 05:59:21Z ajeh $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
//This page displays the category products entered by user in Theme Admin Panel
// initialize vars
$categories_products_id_list = '';
$list_of_products = '';
$specials_index_query = '';
$display_limit = '';

$master_category_id = $featured_category_id[1];

if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
  $specials_index_query = "select p.products_id, p.products_image, pd.products_name, p.master_categories_id
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.master_categories_id = " . $master_category_id. "
                           and p.products_id = pd.products_id
                           and p.products_status = '1'
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
} else {
  // get all products and cPaths in this subcat tree
  $productsInCategory = zen_get_categories_products_list( (($manufacturers_id > 0 && $_GET['filter_id'] > 0) ? zen_get_generated_category_path_rev($_GET['filter_id']) : $cPath), false, true, 0, $display_limit);

  if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
    // build products-list string to insert into SQL query
    foreach($productsInCategory as $key => $value) {
      $list_of_products .= $key . ', ';
    }
    $list_of_products = substr($list_of_products, 0, -2); // remove trailing comma
    $specials_index_query = "select distinct p.products_id, p.products_image, pd.products_name, p.master_categories_id
                             from (" . TABLE_PRODUCTS . " p
                             left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                             where p.master_categories_id = " . $master_category_id. "
                             and p.products_id = pd.products_id
                             and p.products_status = '1' 
                             and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                             and p.products_id in (" . $list_of_products . ")";
  }
}
if ($specials_index_query != '') $specials_index = $db->Execute($specials_index_query, MAX_DISPLAY_SPECIAL_PRODUCTS_INDEX);

$row = 0;
$col = 0;
$list_box_contents = array();
$title = '';

$num_products_count = ($specials_index_query == '') ? 0 : $specials_index->RecordCount();

// show only when 1 or more
if ($num_products_count > 0) {
  if ($num_products_count < SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS || SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS == 0 ) {
    $col_width = floor(100/$num_products_count);
  } else {
    $col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS);
  }

  $list_box_contents = array();
  while (!$specials_index->EOF) {
    $products_price = zen_get_products_display_price($specials_index->fields['products_id']);
	
	 $pid = $specials_index->fields['products_id'];
	
	 $specials_query = "select * from ".TABLE_SPECIALS." where products_id='$pid'";
	 $specials_res = $db->Execute($specials_query);
	 
	 $feature_query = "select * from ".TABLE_FEATURED." where products_id='$pid'";
	 $featured_res = $db->Execute($feature_query);
	 
	 $product_attribute_query = "select distinct products_id from " . TABLE_PRODUCTS_ATTRIBUTES." where products_id='$sid'";
	 $product_attribute_query_result = $db->Execute($product_attribute_query);
	 
	 $sid=$specials_res->fields['products_id'];
	 $fid=$featured_res->fields['products_id'];
	 
	 $attribute_product=$product_attribute_query_result->fields['products_id'];
	 
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
	
	//$products_description_hover = zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($specials_index->fields['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION); //To Display Product Desc on Hover
	//$products_description_hover = ltrim(substr($products_description_hover, 0, 115) . '...'); //Trims and Limits the desc on hover
	
	$products_description = zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($specials_index->fields['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION); //To Display Product Desc 
	$products_description = ltrim(substr($products_description, 0, 50) . '..'); //Trims and Limits the desc
	
	
	//Productname Trim 
	//$products_name_hover = $specials_index->fields['products_name'];
	//$products_name_hover = ltrim(substr($products_name_hover, 0, 50) . '...');
	
	$products_name = $specials_index->fields['products_name'];
	//$products_name = ltrim(substr($products_name, 0, 20) . '..');
	
    if (!isset($productsInCategory[$specials_index->fields['products_id']])) $productsInCategory[$specials_index->fields['products_id']] = zen_get_generated_category_path_rev($specials_index->fields['master_categories_id']);

	if (UN_MODULE_WISHLISTS_ENABLED) { $wishlist_link= '<a class="lnk" href="' . zen_href_link(UN_FILENAME_WISHLIST, 'products_id=' . $specials_index->fields['products_id'] . '&action=wishlist_add_product') . '"><i class="fa fa-heart"></i>Wishlist</a>';}else{ $wishlist_link='';}
	
	$compare_link='<a class="lnk" href="javascript: compareNew('.$specials_index->fields['products_id'].', \'add\')"><i class="fa fa-exchange"></i>Compare</a>';
	
	$buy_now = zen_get_buy_now_button($specials_index->fields['products_id'],'');
	if($buy_now!=NULL){
		$buy_now ='<a class="btn btn-dark-blue btn-small-med btn-trans">'.$buy_now.'</a>';
	}
	elseif($attribute_product == $sid) {
		$buy_now = zen_get_buy_now_button($specials_index->fields['products_id'],'<a class="btn btn-dark-blue btn-small-med btn-trans" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $specials_index->fields['products_id']) . '">Select Options</a>');
	}
	else {
		$buy_now = zen_get_buy_now_button($specials_index->fields['products_id'],'<a class="btn btn-dark-blue btn-small-med btn-trans" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $specials_index->fields['products_id']) . '">Add to Cart</a>');
	}
	
    $specials_index->fields['products_name'] = zen_get_products_name($specials_index->fields['products_id']);
	
    $list_box_contents[$row][$col] = array('params' => 'class="item centerBoxContentsSpecialsReloaded centerBoxContentsSpecials product-item back"' . ' ', 'text' => (($specials_index->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : 
	'<div class="product">
		<div class="product-image">
			<div class="image">' . zen_image(DIR_WS_IMAGES . $specials_index->fields['products_image'], $specials_index->fields['products_name'], IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT) . '
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
				'<a href="' . zen_href_link(zen_get_info_page($specials_index->fields['products_id']), 'cPath=' . $productsInCategory[$specials_index->fields['products_id']] . '&products_id=' . $specials_index->fields['products_id']) . '">' . $products_name . '</a>
			</h3>'.
			mb_product_reviews($specials_index->fields['products_id']).'
			<div class="price">' 
				. $products_price . 
			'</div>
		</div>
	 </div>');

    $col ++;
    if ($col > (SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS - 1)) {
      $col = 0;
      $row ++;
    }
    $specials_index->MoveNext();
  }
  
  	$category_query = "select categories_name from ".TABLE_CATEGORIES_DESCRIPTION." where categories_id='$master_category_id'";
	$category_query = $db->Execute($category_query);

  if ($specials_index->RecordCount() > 0) {
    $title = '<h3 class="section-title">'.$category_query->fields['categories_name'].'</h3>';
    $zc_show_specials = true;
  }
}
?>