<?php
/**
 * Specials
 *
 * @package page
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: main_template_vars.php 18802 2011-05-25 20:23:34Z drbyte $
 */

if (MAX_DISPLAY_SPECIAL_PRODUCTS > 0 ) {
  $specials_query_raw = "SELECT p.products_id, p.products_image, pd.products_name,
                          p.master_categories_id
                         FROM (" . TABLE_PRODUCTS . " p
                         LEFT JOIN " . TABLE_SPECIALS . " s on p.products_id = s.products_id
                         LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                         WHERE p.products_id = s.products_id and p.products_id = pd.products_id and p.products_status = '1'
                         AND s.status = 1
                         AND pd.language_id = :languagesID
                         ORDER BY s.specials_date_added DESC";

  $specials_query_raw = $db->bindVars($specials_query_raw, ':languagesID', $_SESSION['languages_id'], 'integer');
  $specials_split = new splitPageResults($specials_query_raw, MAX_DISPLAY_SPECIAL_PRODUCTS);
  
  $specials = $db->Execute($specials_split->sql_query);
  $row = 0;
  $col = 0;
  $list_box_contents = array();
  $title = '';

  $num_products_count = $specials->RecordCount();
  if ($num_products_count) {
    if ($num_products_count < SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS || SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS==0 ) {
      $col_width = floor(100/$num_products_count);
    } else {
      $col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS);
    }

    $list_box_contents = array();
    while (!$specials->EOF) {

      $products_price = zen_get_products_display_price($specials->fields['products_id']);
	  
		$products_name = $specials->fields['products_name'];
		//$products_name = ltrim(substr($products_name, 0, 25) . '');
		
		$pid = $specials->fields['products_id'];
		
		$product_attribute_query = "select distinct products_id from " . TABLE_PRODUCTS_ATTRIBUTES." where products_id='$pid'";
	 	$product_attribute_query_result = $db->Execute($product_attribute_query);
		$attribute_product=$product_attribute_query_result->fields['products_id'];
		
		$products_description = zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($specials->fields['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION); //To Display Product Desc 
	
	if (UN_MODULE_WISHLISTS_ENABLED) { 
		$wishlist_link= zen_href_link(UN_FILENAME_WISHLIST, 'products_id=' . $specials->fields['products_id'] . '&action=wishlist_add_product');
	} else { $wishlist_link=''; }

	$compare_link='javascript: compareNew('.$specials->fields['products_id'].', \'add\')';

	$buy_now = zen_get_buy_now_button($specials->fields['products_id'],'');
	if($buy_now!=NULL){
		$buy_now = '<a title="Sold Out" class="detailbutton-wrapper add-to-cart" href="' . zen_href_link(zen_get_info_page($specials->fields['products_id']), 'cPath=' . $productsInCategory[$new_products->fields['products_id']] . '&products_id=' . $specials->fields['products_id']) . '"><i class="fa fa-ban fa-lg"></i></a>';
	}
	elseif($attribute_product == $pid) {
		$buy_now = '<a title="Add to Cart" class="detailbutton-wrapper add-to-cart" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $specials->fields['products_id']) . '"><i class="fa fa-shopping-cart fa-lg"></i></a>'; 
	}
	else {
		$buy_now = '<a title="Add to Cart" class="detailbutton-wrapper add-to-cart" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $specials->fields['products_id']) . '"><i class="fa fa-shopping-cart fa-lg"></i></a>'; 
	}			

	if(mb_special_product($specials->fields['products_id'])==1){
		$ribbon="<div class='tag tag-orange' title=''><div class='text'>SALE</div></div>";
	}
	else {
	}
	
      //$specials->fields['products_name'] = zen_get_products_name($specials->fields['products_id']);
      $list_box_contents[$row][$col] = array('params' => 'class="specialsListBoxContents"',
                                             'text' => '
	<div class="product">
		<div class="product-thumbnail">
			<div class="product-thumbnail-image">
				<a href="' . zen_href_link(zen_get_info_page($specials->fields['products_id']), 'cPath=' . $productsInCategory[$new_products->fields['products_id']] . '&products_id=' . $specials->fields['products_id']) . '">
					' . zen_image(DIR_WS_IMAGES . $specials->fields['products_image'], $specials->fields['products_name'], IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT) . '
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
		</div>
			
		<div class="product-info">
			<h3 class="name">' .  
				'<a href="' . zen_href_link(zen_get_info_page($specials->fields['products_id']), 'cPath=' . $productsInCategory[$new_products->fields['products_id']] . '&products_id=' . $specials->fields['products_id']) . '">' . $products_name . '</a>
			</h3>'.
			mb_product_reviews($specials->fields['products_id']).'
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
      $specials->MoveNext();
    }
    require($template->get_template_dir('tpl_specials_default.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_specials_default.php');
  }
}
