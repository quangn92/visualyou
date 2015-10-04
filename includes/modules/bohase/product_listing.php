<?php
/**
 * product_listing module
 *
 * @package modules
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: product_listing.php 6787 2007-08-24 14:06:33Z drbyte $
 * UPDATED TO WORK WITH COLUMNAR PRODUCT LISTING For Zen Cart v1.3.6 - 10/25/2006
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// BOF Number of Items Per Page
if(isset($_POST['max_display']) || isset($_GET['max_display'])) {
$_SESSION['product_listing_max_display'] = (int)$_REQUEST['max_display'];
} elseif (!isset($_SESSION['product_listing_max_display'])) {
$_SESSION['product_listing_max_display'] = (int)MAX_DISPLAY_PRODUCTS_LISTING;
}
// EOF Number of Items Per Page

// Column Layout Support originally added for Zen Cart v 1.1.4 by Eric Stamper - 02/14/2004
// Upgraded to be compatible with Zen-cart v 1.2.0d by Rajeev Tandon - Aug 3, 2004
// Column Layout Support (Grid Layout) upgraded for v1.3.0 compatibility DrByte 04/04/2006
// Column Layout Support (Grid Layout) upgraded for v1.5.0 compatibility and changed to customer control asarfraz July 26 2012
// Modified for admin control of customer option by Glenn Herbert (gjh42) 2012-09-20   test 20120929 grid sorter
//
if (!defined('PRODUCT_LISTING_LAYOUT_STYLE')) define('PRODUCT_LISTING_LAYOUT_STYLE',(isset($_GET['view']) ? $_GET['view'] : 'rows'));
if (!defined('PRODUCT_LISTING_COLUMNS_PER_ROW')) define('PRODUCT_LISTING_COLUMNS_PER_ROW',3);
if (!defined('PRODUCT_LISTING_GRID_SORT')) define('PRODUCT_LISTING_GRID_SORT',0);
$product_listing_layout_style = isset($_GET['view'])? $_GET['view']: PRODUCT_LISTING_LAYOUT_STYLE;
$row = 0;
$col = 0;
$list_box_contents = array();
$title = '';

// $max_results = ($product_listing_layout_style=='columns' && PRODUCT_LISTING_COLUMNS_PER_ROW>0) ? (PRODUCT_LISTING_COLUMNS_PER_ROW * (int)(MAX_DISPLAY_PRODUCTS_LISTING/PRODUCT_LISTING_COLUMNS_PER_ROW)) : MAX_DISPLAY_PRODUCTS_LISTING;

$max_results = (PRODUCT_LISTING_LAYOUT_STYLE=='columns' && PRODUCT_LISTING_COLUMNS_PER_ROW>0) ? (PRODUCT_LISTING_COLUMNS_PER_ROW * (int)($_SESSION['product_listing_max_display']/PRODUCT_LISTING_COLUMNS_PER_ROW)) : $_SESSION['product_listing_max_display'];



$show_submit = zen_run_normal();
$listing_split = new splitPageResults($listing_sql, $max_results, 'p.products_id', 'page');
$zco_notifier->notify('NOTIFY_MODULE_PRODUCT_LISTING_RESULTCOUNT', $listing_split->number_of_rows);
$how_many = 0;

// Begin Row Layout Header
if ($product_listing_layout_style == 'rows' or PRODUCT_LISTING_GRID_SORT) {		// For Column Layout (Grid Layout) add on module

//$list_box_contents[0] = array('params' => 'class="productListing-rowheading"');

$zc_col_count_description = 0;
$lc_align = '';
$lst_lc_text='';
for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
  switch ($column_list[$col]) {
    case 'PRODUCT_LIST_MODEL':
    $lc_text = TABLE_HEADING_MODEL;
	//$lst_lc_text = TABLE_HEADING_MODEL;
    $lc_align = '';
    $zc_col_count_description++;
    break;
    case 'PRODUCT_LIST_NAME':
    $lc_text = TABLE_HEADING_PRODUCTS;
	//$lst_lc_text =TABLE_HEADING_PRODUCTS;
    $lc_align = '';
    $zc_col_count_description++;
    break;
    case 'PRODUCT_LIST_MANUFACTURER':
    $lc_text = TABLE_HEADING_MANUFACTURER;
	//$lst_lc_text = TABLE_HEADING_MANUFACTURER;
    $lc_align = '';
    $zc_col_count_description++;
    break;
    case 'PRODUCT_LIST_PRICE':
    $lc_text = TABLE_HEADING_PRICE;
    $lc_align = 'right' . (PRODUCTS_LIST_PRICE_WIDTH > 0 ? '" width="' . PRODUCTS_LIST_PRICE_WIDTH : '');
	//$lst_lc_text = TABLE_HEADING_PRICE;
    $zc_col_count_description++;
    break;
    case 'PRODUCT_LIST_QUANTITY':
    $lc_text = TABLE_HEADING_QUANTITY;
	//$lst_lc_text = TABLE_HEADING_QUANTITY;
    $lc_align = 'right';
    $zc_col_count_description++;
    break;
    case 'PRODUCT_LIST_WEIGHT':
    $lc_text = TABLE_HEADING_WEIGHT;
//	$lst_lc_text = TABLE_HEADING_WEIGHT;
    $lc_align = 'right';
    $zc_col_count_description++;
    break;
    case 'PRODUCT_LIST_IMAGE':
    if ($product_listing_layout_style == 'rows') { //skip if grid
     // $lc_text = TABLE_HEADING_IMAGE;
	 // $lst_lc_text = TABLE_HEADING_IMAGE;
     // $lc_align = 'center';
    //  $zc_col_count_description++;
    }
    break;
  }
  
  if ( ($column_list[$col] != 'PRODUCT_LIST_IMAGE')) {
    $lc_text= mb_create_sort_heading($_GET['sort'], $col+1, $lc_text);
	//$lst_lc_text = zen_create_sort_heading($_GET['sort'], $col+1, $lc_text);
	$list_box_contents[0][$col] = array('text' => $lc_text);
  }
}


    $grid_sort = $list_box_contents[0];
	if ($product_listing_layout_style == 'rows') {
		$list_box_contents = array();
		$list_box_contents[0] = array('text' => '');
	}
	if ($product_listing_layout_style == 'columns') {
       $list_box_contents = array();
	}
	$listing_asc_des=mb_create_sort_heading_asc_des($_GET['sort'],'','');
	$gridlist_tab='';
   if (defined('PRODUCT_LISTING_LAYOUT_STYLE_CUSTOMER') and PRODUCT_LISTING_LAYOUT_STYLE_CUSTOMER == '1') {
    //echo '<div class="view-mode">' .  array(array('id'=>'rows','text'=>PRODUCT_LISTING_LAYOUT_ROWS),array('id'=>'columns','text'=>PRODUCT_LISTING_LAYOUT_COLUMNS))) . '</div>';
	$gridlist_tab=mb_gridlist_tab(FILENAME_DEFAULT);
  }

} // End Row Layout Header used in Column Layout (Grid Layout) add on module

/////////////  HEADER ROW ABOVE /////////////////////////////////////////////////

$num_products_count = $listing_split->number_of_rows;

if ($listing_split->number_of_rows > 0) {
  $rows = 0;
  // Used for Column Layout (Grid Layout) add on module
  $column = 0;	
  if ($product_listing_layout_style == 'columns') {
    if ($num_products_count < PRODUCT_LISTING_COLUMNS_PER_ROW || PRODUCT_LISTING_COLUMNS_PER_ROW == 0 ) {
      $col_width = floor(100/$num_products_count) - 4.0;
    } else {
      $col_width = floor(100/PRODUCT_LISTING_COLUMNS_PER_ROW) - 4.0;
    }
  }
  
  
  // Used for Column Layout (Grid Layout) add on module
  $trg_extra_val='';
  $listing = $db->Execute($listing_split->sql_query);
  $extra_row = 0;
  while (!$listing->EOF) {

    if ($product_listing_layout_style == 'rows') { // Used in Column Layout (Grid Layout) Add on module
    $rows++;

    if ((($rows-$extra_row)/2) == floor(($rows-$extra_row)/2)) {
      $list_box_contents[$rows] = array('params' => 'class="item even"');
    } else {
      $list_box_contents[$rows] = array('params' => 'class="item odd"');
    }
   
    $cur_row = sizeof($list_box_contents) - 1;
    }   // End of Conditional execution - only for row (regular style layout)

    $product_contents = array(); // Used For Column Layout (Grid Layout) Add on module
	
	$products_name = $listing->fields['products_name'];
	//$products_name = ltrim(substr($products_name, 0, 25) . '');
	
	$products_description_full = zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($listing->fields['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION); //To Display Product Desc 
	
	$products_description_list = ltrim(substr($products_description_full, 0, 250) . ''); //Trims and Limits the desc
	
	$moreinfo = '<a class="more_info_text" href="' . zen_href_link(zen_get_info_page($listing->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($listing->fields['master_categories_id']) . '&products_id=' . $listing->fields['products_id']) . '">'.MORE_INFO_TEXT.'</a>';

    for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
      $lc_align = '';
      switch ($column_list[$col]) {
        case 'PRODUCT_LIST_MODEL':
        $lc_align = '';
		if($listing->fields['manufacturers_name']!=''){
			$trg_extra_val.= '<div class="product-model">'.TABLE_HEADING_MODEL.' : '.$listing->fields['products_model']."</div>";
        }
		//$lst_lc_text = '<div class="product-model">'.$listing->fields['products_model']."</div>";
		
        break;
        case 'PRODUCT_LIST_NAME':
        $lc_align = '';
        if (isset($_GET['manufacturers_id'])) {
			   $product_name = '<h2 class="product-name"><a href="' . zen_href_link(zen_get_info_page($listing->fields['products_id']), 'cPath=' . (($_GET['manufacturers_id'] > 0 and $_GET['filter_id']) > 0 ?  zen_get_generated_category_path_rev($_GET['filter_id']) : ($_GET['cPath'] > 0 ? zen_get_generated_category_path_rev($_GET['cPath']) : zen_get_generated_category_path_rev($listing->fields['master_categories_id']))) . '&products_id=' . $listing->fields['products_id']) . '">' . $products_name . '</a></h2>';
		     $product_name_only=$products_name;
		   $product_desc='<div class="text"><p>' . zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($listing->fields['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION) . '</p></div>' ;
			   
		
        } else {
			
         $product_name = '<h2 class="product-name"><a href="' . zen_href_link(zen_get_info_page($listing->fields['products_id']), 'cPath=' . (($_GET['manufacturers_id'] > 0 and $_GET['filter_id']) > 0 ?  zen_get_generated_category_path_rev($_GET['filter_id']) : ($_GET['cPath'] > 0 ? zen_get_generated_category_path_rev($_GET['cPath']) : zen_get_generated_category_path_rev($listing->fields['master_categories_id']))) . '&products_id=' . $listing->fields['products_id']) . '">' . $products_name . '</a></h2>';
		 $product_name_only=$products_name;
		   $product_desc='<div class="text"><p>' . zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($listing->fields['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION) . '</p></div>';
        }
	
        break;
        case 'PRODUCT_LIST_MANUFACTURER':
        $lc_align = '';
		if($listing->fields['manufacturers_name']!=''){
       $trg_extra_val .= '<div class="product-menufacture">'.TABLE_HEADING_MANUFACTURER.' : '.'<span><a href="' . zen_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $listing->fields['manufacturers_id']) . '">' . $listing->fields['manufacturers_name'] . '</a></span></div>';}
		//$lst_lc_text = '<div class="product-menufacture"><a href="' . zen_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $listing->fields['manufacturers_id']) . '">' . $listing->fields['manufacturers_name'] . '</a></div>';
        break;
        case 'PRODUCT_LIST_PRICE':
       // $lc_price = '<div class="price-box">'.zen_get_products_display_price($listing->fields['products_id']) . '</div>';
		$product_price_box = zen_mb_get_products_display_price($listing->fields['products_id']);
        $lc_align = 'right';
        $lc_text =  $lc_price;
		$lst_lc_text =  $lc_price;
        // more info in place of buy now
        $lc_button = '';
		
        if (zen_has_product_attributes($listing->fields['products_id']) or PRODUCT_LIST_PRICE_BUY_NOW == '0') {
          $lc_button = '<a href="' . zen_href_link(zen_get_info_page($listing->fields['products_id']), 'cPath=' . (($_GET['manufacturers_id'] > 0 and $_GET['filter_id']) > 0 ?  zen_get_generated_category_path_rev($_GET['filter_id']) : ($_GET['cPath'] > 0 ? $_GET['cPath'] : zen_get_generated_category_path_rev($listing->fields['master_categories_id']))) . '&products_id=' . $listing->fields['products_id']) . '">' . MORE_INFO_TEXT . '</a>';
		  $lst_lc_button = '<a href="' . zen_href_link(zen_get_info_page($listing->fields['products_id']), 'cPath=' . (($_GET['manufacturers_id'] > 0 and $_GET['filter_id']) > 0 ?  zen_get_generated_category_path_rev($_GET['filter_id']) : ($_GET['cPath'] > 0 ? $_GET['cPath'] : zen_get_generated_category_path_rev($listing->fields['master_categories_id']))) . '&products_id=' . $listing->fields['products_id']) . '">' . MORE_INFO_TEXT . '</a>';
        } else {
          if (PRODUCT_LISTING_MULTIPLE_ADD_TO_CART != 0) {
            if (
                // not a hide qty box product
                $listing->fields['products_qty_box_status'] != 0 &&
                // product type can be added to cart
                zen_get_products_allow_add_to_cart($listing->fields['products_id']) != 'N'
                &&
                // product is not call for price
                $listing->fields['product_is_call'] == 0
                &&
                // product is in stock or customers may add it to cart anyway
                ($listing->fields['products_quantity'] > 0 || SHOW_PRODUCTS_SOLD_OUT_IMAGE == 0) ) {
              $how_many++;
            }
            // hide quantity box
            if ($listing->fields['products_qty_box_status'] == 0) {
              $add_to_cart_button = '<a class="addtocart" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing->fields['products_id']) . '"></a>';
            } else {
              $lc_button = TEXT_PRODUCT_LISTING_MULTIPLE_ADD_TO_CART . "<input type=\"text\" class=\"addtocart input-text\" name=\"products_id[" . $listing->fields['products_id'] . "]\" value=\"0\" size=\"4\" />";
			  $lst_lc_button = TEXT_PRODUCT_LISTING_MULTIPLE_ADD_TO_CART . "<input type=\"text\" class=\"addtocart input-text\" name=\"products_id[" . $listing->fields['products_id'] . "]\" value=\"0\" size=\"4\" />";
            }
          } else {
// qty box with add to cart button
            if (PRODUCT_LIST_PRICE_BUY_NOW == '2' && $listing->fields['products_qty_box_status'] != 0) {
              $lc_button= zen_draw_form('cart_quantity', zen_href_link(zen_get_info_page($listing->fields['products_id']), zen_get_all_get_params(array('action')) . 'action=add_product&products_id=' . $listing->fields['products_id']), 'post', 'enctype="multipart/form-data"') . '<input type="text" name="cart_quantity" value="' . (zen_get_buy_now_qty($listing->fields['products_id'])) . '" maxlength="6" size="4" class="addtocart input-text" />&nbsp;&nbsp;' . zen_draw_hidden_field('products_id', $listing->fields['products_id']) .'<button class="button btn_addtocart">'.BUTTON_ADD_TO_CART.'</button>'.'</form>';
			  $lst_lc_button= zen_draw_form('cart_quantity', zen_href_link(zen_get_info_page($listing->fields['products_id']), zen_get_all_get_params(array('action')) . 'action=add_product&products_id=' . $listing->fields['products_id']), 'post', 'enctype="multipart/form-data"') . '<input type="text" name="cart_quantity" value="' . (zen_get_buy_now_qty($listing->fields['products_id'])) . '" maxlength="6" size="4" class="addtocart input-text" />&nbsp;&nbsp;' . zen_draw_hidden_field('products_id', $listing->fields['products_id'])  .'<button class="button btn_addtocart">'.BUTTON_ADD_TO_CART.'</button>'.'</form>';
            } else {
              $lc_button = '<a title="Add to Cart" class="add-to-cart product_cart_image" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing->fields['products_id']) . '"><span class="icon-shopcart"></span></a>';
			
			   $lst_lc_button = '<a class="btn btn-primary btn-iconed" title="Add to Cart" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing->fields['products_id']) . '"><i class="icon-shopcart"></i><span>Add to Cart</span></a>';
            }
          }
        }
         $the_button = $lc_button;
		 $lst_the_button = $lst_lc_button;
		 
        $products_link = '<a class="link-learn" href="' . zen_href_link(zen_get_info_page($listing->fields['products_id']), 'cPath=' . ( ($_GET['manufacturers_id'] > 0 and $_GET['filter_id']) > 0 ? zen_get_generated_category_path_rev($_GET['filter_id']) : $_GET['cPath'] > 0 ? zen_get_generated_category_path_rev($_GET['cPath']) : zen_get_generated_category_path_rev($listing->fields['master_categories_id'])) . '&products_id=' . $listing->fields['products_id']) . '">' . MORE_INFO_TEXT . '</a>';
		
		$product_link_only=zen_href_link(zen_get_info_page($listing->fields['products_id']), 'cPath=' . ( ($_GET['manufacturers_id'] > 0 and $_GET['filter_id']) > 0 ? zen_get_generated_category_path_rev($_GET['filter_id']) : $_GET['cPath'] > 0 ? zen_get_generated_category_path_rev($_GET['cPath']) : zen_get_generated_category_path_rev($listing->fields['master_categories_id'])) . '&products_id=' . $listing->fields['products_id']);
		
		
        $min_quantity='<div class="product-minquantity">' . zen_get_products_quantity_min_units_display($listing->fields['products_id']).'</div>';
        $freeshipping = '<div class="product-freeship">' . (zen_get_show_product_switch($listing->fields['products_id'], 'ALWAYS_FREE_SHIPPING_IMAGE_SWITCH') ? (zen_get_product_is_always_free_shipping($listing->fields['products_id']) ? TEXT_PRODUCT_FREE_SHIPPING_ICON : '') : '');
		
		$lst_lc_text .= '';
        $min_quantity='<div class="product-minquantity">' . zen_get_products_quantity_min_units_display($listing->fields['products_id']).'</div>';
        
			$freeshipping= '<div class="product-freeship">' . (zen_get_show_product_switch($listing->fields['products_id'], 'ALWAYS_FREE_SHIPPING_IMAGE_SWITCH') ? (zen_get_product_is_always_free_shipping($listing->fields['products_id']) ? TEXT_PRODUCT_FREE_SHIPPING_ICON : '') : '');

        break;
        case 'PRODUCT_LIST_QUANTITY':
        $lc_align = 'right';
		if($listing->fields['products_quantity']!=''){
        $trg_extra_val .= '<div class="product-qty">'.TABLE_HEADING_QUANTITY.' : '.$listing->fields['products_quantity']."</div>";}
		//$lst_lc_text = '<div class="product-qty">'.$listing->fields['products_quantity']."</div>";
        break;
        case 'PRODUCT_LIST_WEIGHT':
        $lc_align = 'right';
		if($listing->fields['products_weight']!=''){
        $trg_extra_val .= '<div class="product-weight">'.TABLE_HEADING_WEIGHT.' : '.$listing->fields['products_weight'].'</div>';}
		//$lst_lc_text = '<div class="product-weight">'.$listing->fields['products_weight'].'</div>';
        break;
        case 'PRODUCT_LIST_IMAGE':
        $lc_align = 'center';
        if ($listing->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) {
          $lc_text = '';
		  $lst_lc_text = '';
        } else {
          if (isset($_GET['manufacturers_id'])) {
			$product_img_link=   zen_href_link(zen_get_info_page($listing->fields['products_id']), 'cPath=' . (($_GET['manufacturers_id'] > 0 and $_GET['filter_id']) > 0 ?  zen_get_generated_category_path_rev($_GET['filter_id']) : ($_GET['cPath'] > 0 ? zen_get_generated_category_path_rev($_GET['cPath']) : zen_get_generated_category_path_rev($listing->fields['master_categories_id']))) . '&products_id=' . $listing->fields['products_id']);
			$product_img_src=mb_getbaseimg_effects($listing->fields['products_image']);
            $second_img_src=mb_gethoverimg_effects($listing->fields['products_image']);
			
            $product_img = zen_image(DIR_WS_IMAGES . $listing->fields['products_image'], $products_name, IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT);
          } else {
			
			$product_img_src=mb_getbaseimg_effects($listing->fields['products_image']);
            $second_img_src=mb_gethoverimg_effects($listing->fields['products_image']);
			
            $product_img = zen_image(DIR_WS_IMAGES . $listing->fields['products_image'], $products_name, IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT);
          }
        }
        break;
      }
      $product_contents[] = $lc_text; // Used For Column Layout (Grid Layout) Option
	  $listview_product_contents[] = $lst_lc_text;
}

 		$get_discount_prod=mb_discount_product($listing->fields['products_id']);
		if(mb_featured_product($listing->fields['products_id'])==1){
			$ribbon="<div class='tag tag-orange' title=''><div class='text'>HOT</div></div>";
		}
		else if(mb_special_product($listing->fields['products_id'])==1){
			$ribbon="<div class='tag tag-orange' title=''><div class='text'>SALE</div></div>";
		}
		else if(mb_new_product($listing->fields['products_id'])==1){
			$ribbon="<div class='tag tag-blue' title=''><div class='text'>NEW</div></div>";
		}
		else {
		}
		
		$pid = $listing->fields['products_id'];
		
		$product_attribute_query = "select distinct products_id from " . TABLE_PRODUCTS_ATTRIBUTES." where products_id='$pid'";
	 	$product_attribute_query_result = $db->Execute($product_attribute_query);
		$attribute_product=$product_attribute_query_result->fields['products_id'];

	$display_products_model = TEXT_PRODUCTS_MODEL . $listing->fields['products_model'] . str_repeat('', substr(PRODUCT_ALL_LIST_MODEL, 3, 1));
		
		/* Begin gridview */
		/*Wishlist Links*/
		if (UN_MODULE_WISHLISTS_ENABLED) {
			$wishlist_link= zen_href_link(UN_FILENAME_WISHLIST, 'products_id=' . $listing->fields['products_id'] . '&action=wishlist_add_product');
		} else {
			$wishlist_link='';
		}
	
		$compare_link='javascript: compareNew('.$listing->fields['products_id'].', \'add\')';
			
		/*Add to Cart Button*/
		$buy_now = zen_get_buy_now_button($listing->fields['products_id'],'');
		if($buy_now!=NULL){
			$buy_now = '<a title="Sold Out" class="detailbutton-wrapper add-to-cart" href="' . $product_link_only . '"><i class="fa fa-ban fa-lg"></i></a>';
		}
		elseif($attribute_product == $pid) {
			$buy_now = '<a title="Add to Cart" class="detailbutton-wrapper add-to-cart" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing->fields['products_id']) . '"><i class="fa fa-shopping-cart fa-lg"></i></a>'; 
		}
		else {
			$buy_now = '<a title="Add to Cart" class="detailbutton-wrapper add-to-cart" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing->fields['products_id']) . '"><i class="fa fa-shopping-cart fa-lg"></i></a>'; 
		}
		/* End gridview */
		
		/* Begin listview */
		/*Wishlist Links*/
		if (UN_MODULE_WISHLISTS_ENABLED) { $listview_wishlist_link= '<a class="lnk" href="' . zen_href_link(UN_FILENAME_WISHLIST, 'products_id=' . $listing->fields['products_id'] . '&action=wishlist_add_product') . '"><i class="fa fa-heart"></i>Add to Wishlist</a>';}else{ $listview_wishlist_link='';}

		$listview_compare_link='<a class="lnk" href="javascript: compareNew('.$listing->fields['products_id'].', \'add\')"><i class="fa fa-exchange"></i>Add to Compare</a>';
	
		
		/*Add to Cart Button*/
		$listview_buy_now = zen_get_buy_now_button($listing->fields['products_id'],'');
		if($listview_buy_now!=NULL){
			$listview_buy_now ='<a class="btn btn-dark-blue btn-small-med btn-trans">'.$listview_buy_now.'</a>';
		}
		elseif($attribute_product == $pid) {
			$listview_buy_now = zen_get_buy_now_button($listing->fields['products_id'],'<a class="btn btn-dark-blue btn-small-med btn-trans" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing->fields['products_id']) . '">Select Options</a>');
		}
		else {
			$listview_buy_now = zen_get_buy_now_button($listing->fields['products_id'],'<a class="btn btn-dark-blue btn-small-med btn-trans" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing->fields['products_id']) . '">Add to Cart</a>');
		}
		/* End listview */
			
		/*$listview_addtocartbtn = zen_get_buy_now_button($listing->fields['products_id']);
		
		if($listview_addtocartbtn !=NULL){
			$listview_addtocartbtn ='<a class="sold_out le-btn"><i class="fa fa-ban fa-lg"></i>'.$listview_addtocartbtn.'</a>';
		}
		else {
			$listview_addtocartbtn = zen_get_buy_now_button($listing->fields['products_id'],'<a class="detailbutton-wrapper add-to-cart le-btn" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing->fields['products_id']) . '"><i class="fa fa-shopping-cart fa-lg"></i><span>to Cart</span></a>');
		}*/
		/*Add to Cart Button Ends*/
		
		 
      $lc_text = '<div class="item product-item" data-filter="listing" data-name="'.$product_name_only.'" data-discount="'.$get_discount_prod.'" data-price="101">';
	  
	  		$lc_text.='<div class="product grid-view">';
				$lc_text.='<div class="product-thumbnail">
							<div class="product-thumbnail-image">
								<a href="' . $product_link_only . '">
									' . $product_img . '
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
								'.$ribbon.'
							</div>
						</div>';
				$lc_text.='<div class="product-info">
								<h3 class="name">	
									<a href="'.$product_link_only.'">'.$product_name_only.'</a>
								</h3>'
								.mb_product_reviews($listing->fields['products_id']).'
								<div class="price">'.$product_price_box.'</div>';
				$lc_text.='</div>
						</div>';
		
	   		$lc_text.='<div class="product-listview list-view">
							<div class="row product-list-row">';
	   					$lc_text.='<div class="col col-lg-4 col-sm-4">
										<div class="product-image">
											<div class="image">
												<a href="'.$product_link_only.'">'.$product_img.'</a>
											</div>
										</div>
									</div>';
						 $lc_text.='<div class="col col-lg-8 col-sm-8">
										<div class="product-info">
											<h3 class="name">
												<a href="'.$product_link_only.'">'.$product_name_only.'</a>
											</h3>'
											.mb_product_reviews($listing->fields['products_id']).'
											<div class="description">
												'.$products_description_list.$moreinfo.'
											</div>
											<div class="product-stats">
												<div class="row">
													<div class="col col-sm-4">
														<div class="price">'.$product_price_box.'</div>
													</div>
													<div class="col col-sm-8">
														<div class="cart-action">
															'.$listview_buy_now.'
														</div>
														<div class="sec-action">
															'.$listview_wishlist_link . $listview_compare_link .'
														</div>
													</div>
												</div>
											</div>';
							 $lc_text.='</div>
									</div>'.$ribbon.'
								</div>';
	   			$lc_text.='</div>';
	 		$lc_text.='</div>';
		$lc_text.='</div>';
 if ($product_listing_layout_style == 'rows') {
        $list_box_contents[$rows][$column] = array('params' => 'class="mix mix_all grid-list" style="display: gblock;  opacity: 1;"' . ' ' . '',
                                                 'text'  => $lc_text);
	  $lst_lc_text='';
	  $lc_text='';
    }

      
    if ($product_listing_layout_style == 'columns') {
    $list_box_contents[$rows][$column] = array('params' => 'class="mix mix_all grid-list" style="display: inline-block;  opacity: 1;"' . ' ' . '', 'text'  => $lc_text);
      $column ++;
      if ($column >= PRODUCT_LISTING_COLUMNS_PER_ROW) {
        $column = 0;
        $rows ++;
      }
	  $lc_text='';
	  $trg_extra_val='';
	  $product_price_box='';
    }
    // End of Code fragment for Column Layout (Grid Layout) option in add on module
    $listing->MoveNext();
  }
  $error_categories = false;
} else {
  $list_box_contents = array();

  $list_box_contents[0] = array('params' => 'class="productListing-odd"');
  $list_box_contents[0][] = array('params' => 'class="productListing-data alert alert-danger alert-dismissable"',
                                              'text' => TEXT_NO_PRODUCTS);

  $error_categories = true;
}

if (($how_many > 0 and $show_submit == true and $listing_split->number_of_rows > 0) and (PRODUCT_LISTING_MULTIPLE_ADD_TO_CART == 1 or  PRODUCT_LISTING_MULTIPLE_ADD_TO_CART == 3) ) {
  $show_top_submit_button = true;
} else {
  $show_top_submit_button = false;
}
if (($how_many > 0 and $show_submit == true and $listing_split->number_of_rows > 0) and (PRODUCT_LISTING_MULTIPLE_ADD_TO_CART >= 2) ) {
  $show_bottom_submit_button = true;
} else {
  $show_bottom_submit_button = false;
}



  if ($how_many > 0 && PRODUCT_LISTING_MULTIPLE_ADD_TO_CART != 0 and $show_submit == true and $listing_split->number_of_rows > 0) {
  // bof: multiple products
    echo zen_draw_form('multiple_products_cart_quantity', zen_href_link(FILENAME_DEFAULT, zen_get_all_get_params(array('action')) . 'action=multiple_products_add_product'), 'post', 'enctype="multipart/form-data"');
  }

?>
