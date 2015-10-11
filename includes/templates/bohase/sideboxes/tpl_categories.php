<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_categories.php 4162 2006-08-17 03:55:02Z ajeh $
 */
  $content = "";
  
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">' . "\n";
  $content .= '<ul>' . "\n";
  
    if (SHOW_CATEGORIES_BOX_SPECIALS == 'true' or SHOW_CATEGORIES_BOX_PRODUCTS_NEW == 'true' or SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS == 'true' or SHOW_CATEGORIES_BOX_PRODUCTS_ALL == 'true') {

		// display a separator between categories and links
		if (SHOW_CATEGORIES_SEPARATOR_LINK == '1') {
		  $content .= '' . "\n";
		}
	
		$content .= '<ul>'; 
		
		
		if (SHOW_CATEGORIES_BOX_SPECIALS == 'true') {
		  $show_this = $db->Execute("select s.products_id from " . TABLE_SPECIALS . " s where s.status= 1 limit 1");
		  if ($show_this->RecordCount() > 0) {
			$content .= '<li><a class="category-links" href="' . zen_href_link(FILENAME_SPECIALS) . '">' . CATEGORIES_BOX_HEADING_SPECIALS . '</a></li>' . "\n";
		  }
		}
	
		if (SHOW_CATEGORIES_BOX_PRODUCTS_NEW == 'true') {
		  // display limits
		//$display_limit = zen_get_products_new_timelimit();
		  $display_limit = zen_get_new_date_range();

		  $show_this = $db->Execute("select p.products_id
									 from " . TABLE_PRODUCTS . " p
									 where p.products_status = 1 " . $display_limit . " limit 1");
		  if ($show_this->RecordCount() > 0) {
			$content .= '<li><a class="category-links" href="' . zen_href_link(FILENAME_PRODUCTS_NEW) . '">' . CATEGORIES_BOX_HEADING_WHATS_NEW . '</a></li>' . "\n";
		  }
		}
	
		if (SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS == 'true') {
		  $show_this = $db->Execute("select products_id from " . TABLE_FEATURED . " where status= 1 limit 1");
		  if ($show_this->RecordCount() > 0) {
			$content .= '<li><a class="category-links" href="' . zen_href_link(FILENAME_FEATURED_PRODUCTS) . '">' . CATEGORIES_BOX_HEADING_FEATURED_PRODUCTS . '</a></li>' . "\n";
		  }
		}
	
		if (SHOW_CATEGORIES_BOX_PRODUCTS_ALL == 'true') {
		  $content .= '<li><a class="category-links" href="' . zen_href_link(FILENAME_PRODUCTS_ALL) . '">' . CATEGORIES_BOX_HEADING_PRODUCTS_ALL . '</a></li>' . "\n";
		}
	
		$content .= '</ul>'; 
	
	}
  
    for ($i=0;$i<sizeof($box_categories_array);$i++) {
		switch(true) {
	// to make a specific category stand out define a new class in the stylesheet example: A.category-holiday
	// uncomment the select below and set the cPath=3 to the cPath= your_categories_id
	// many variations of this can be done
	//      case ($box_categories_array[$i]['path'] == 'cPath=3'):
	//        $new_style = 'category-holiday';
	//        break;
		  case ($box_categories_array[$i]['top'] == 'true'):
			$new_style = 'category-top';
			break;
		  case ($box_categories_array[$i]['has_sub_cat']):
			$new_style = 'category-subs';
			break;
		  default:
			$new_style = 'category-products';
		  }
		 if (zen_get_product_types_to_category($box_categories_array[$i]['path']) == 3 or ($box_categories_array[$i]['top'] != 'true' and SHOW_CATEGORIES_SUBCATEGORIES_ALWAYS != 1)) {
			// skip if this is for the document box (==3)
		  } else {
		  $content .= '<li>';
		  $content .= '<a class="' . $new_style . '" href="' . zen_href_link(FILENAME_DEFAULT.'&pg=store', $box_categories_array[$i]['path']) . '">';
			
		  if ($box_categories_array[$i]['current']) {
			if ($box_categories_array[$i]['has_sub_cat']) {
			  $content .= '<span class="category-subs-parent">' . $box_categories_array[$i]['name'] . '</span>';
			} else {
			  $content .= '<span class="category-subs-selected">' . $box_categories_array[$i]['name'] . '</span>';
			}
		  } else {
				$content .= $box_categories_array[$i]['name'];
		  }

		  //if ($box_categories_array[$i]['has_sub_cat']) {
			//$content .= CATEGORIES_SEPARATOR;
		  //}
		  //$content .= '</a>';

		  if (SHOW_COUNTS == 'true' or $box_categories_array[$i]['has_sub_cat']) {
			if ((CATEGORIES_COUNT_ZERO == '1' and $box_categories_array[$i]['count'] == 0) or $box_categories_array[$i]['count'] >= 1) {
			  $content .= '<span class="cat-count">' . CATEGORIES_SEPARATOR . '&nbsp;' . CATEGORIES_COUNT_PREFIX . $box_categories_array[$i]['count'] . CATEGORIES_COUNT_SUFFIX . '</span>';
			}
		  }
		  $content .= '</a>';
		  $content .= '</li>';
		  
		}
	}

    $content .= '</ul>' . "\n";
	  
	if (SHOW_CATEGORIES_BOX_PRODUCTS_NEW == 'true') {
		if (SHOW_CATEGORIES_SEPARATOR_LINK == '1') {
		  $content .= '' . "\n";
		}
	
		$content .= '<ul>'; 
		$content .= '<li><a class="category-links" href="https://www.visual-you.com/catalog/more-c-198/">More</a></li>' . "\n";
		
		$url_string = explode('/', $_SERVER['REQUEST_URI']);
		if ($current_category_id == '198' or $current_category_id == '9' or $current_category_id == '160' or $current_category_id == '133' or $current_category_id == '144' or $url_string[2] == 'coupons-specials-ezp-23.html') {
			$content .= '<li><a class="category-subs" href="https://www.visual-you.com/catalog/more-c-198/japan-panda-fundraiser-c-198_160/"><i class="fa fa-angle-right"></i>Fundraiser</a></li>' . "\n";
			if ($current_category_id == '160' or $current_category_id == '133' or $current_category_id == '144') {
				
				$content .= '<li><a class="category-products" href="https://www.visual-you.com/catalog/index&amp;pg=store.html?cPath=198_160_133">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right"></i>Love 4 Japan FUNDRAISER</a></li>' . "\n";
				$content .= '<li><a class="category-products" href="https://www.visual-you.com/catalog/index&amp;pg=store.html?cPath=198_160_144">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right"></i>Adopt a Panda FUNDRAISER</a></li>' . "\n";
			}

			$content .= '<li><a class="category-products" href="https://www.visual-you.com/catalog/more-c-198/mystery-bags-c-198_9/"><i class="fa fa-angle-right"></i>Mystery Bags</a></li>' . "\n";
			$content .= '<li><a class="category-links" href="https://www.visual-you.com/catalog/coupons-specials-ezp-23.html"><i class="fa fa-angle-right"></i>Coupons & Specials</a></li>' . "\n";
		}
		$content .= '</ul>' . "\n";
	}
	  
	$content .= '</div>';
?>