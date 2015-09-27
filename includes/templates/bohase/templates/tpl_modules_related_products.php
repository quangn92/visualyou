<?php
/**
* Finds related products based on on field
*					TABLE_PRODUCTS.products_family
* @date 2009-12-12
* @author: Joe McFrederick
* @license: GPL v2.0
* @package: Zencart
* @require: Field `products_family` VARCHAR(50) must be added to TABLE_PRODUCTS
*
*/

	$relatedProducts = $db->Execute("SELECT products_family FROM " . TABLE_PRODUCTS . " WHERE  products_id = '" . (int)$_GET['products_id'] ."'", 1);
	
	$products_family = '';
	if ($relatedProducts->RecordCount() > 0 AND !empty($relatedProducts->fields['products_family'])) 
	{
		$related_string = explode('|', $relatedProducts->fields['products_family']);

		foreach ($related_string as $family)
		{
			$products_family .= "OR p.products_family REGEXP '" . $family . "' ";
		}

		$products_family = " AND (" . substr($products_family, 2) . ") ";
		


		//Build query string to find related products
		$sql = "select p.products_id, pd.products_name,

					  pd.products_description, p.products_model,

					  p.products_quantity, p.products_image,

					  pd.products_url, p.products_price,

					  p.products_tax_class_id, p.products_date_added,

					  p.products_date_available, p.manufacturers_id, p.products_quantity,

					  p.products_weight, p.products_priced_by_attribute, p.product_is_free,

					  p.products_qty_box_status,

					  p.products_quantity_order_max,

					  p.products_discount_type, p.products_discount_type_from, p.products_sort_order, p.products_price_sorter

			   from   " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd

			   where  p.products_status = '1' 

			   " . $products_family . " 

			   and    p.products_id != '" . (int)$_GET['products_id'] . "'

			   and    pd.products_id = p.products_id

			   and    pd.language_id = '" . (int)$_SESSION['languages_id'] . "' 

			   LIMIT 9";

		//Run Query and check for related products
		$relatedResult = $db->Execute($sql);
		
		if($relatedResult->RecordCount() > 0)
		{
			?>
			<div class="centerBoxWrapper" id="relatedProducts">
			<?php
				
				$row = 0;

				$col = 0;

				$list_box_contents = array();
				
				$title = '';

				//Build infoBox
				$list_box_contents[0] = array('params' => 'class="productListing-heading"',
											  'align' => 'center',
											  'text' => 'Related Products');
				
				// show only when 1 or more and equal to or greater than minimum set in admin

					
					$col_width =  ($relatedResult->RecordCount() < SHOW_PRODUCT_INFO_COLUMNS_RELATED_PRODUCTS) ? floor(100/$relatedResult->RecordCount()) : floor(100/SHOW_PRODUCT_INFO_COLUMNS_RELATED_PRODUCTS);
				
								
					while (!$relatedResult->EOF)
					{
					
					$products_price = zen_get_products_display_price($relatedResult->fields['products_id']);
	
	 $pid=$relatedResult->fields['products_id'];
	
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
	
		$products_name = $relatedResult->fields['products_name'];
		//$products_name = ltrim(substr($products_name, 0, 35) . ''); //Trims and Limits the product name
	
    	if (!isset($productsInCategory[$relatedResult->fields['products_id']])) $productsInCategory[$relatedResult->fields['products_id']] = zen_get_generated_category_path_rev($relatedResult->fields['master_categories_id']);
	
		if (UN_MODULE_WISHLISTS_ENABLED) { $wishlist_link= '<a class="lnk" href="' . zen_href_link(UN_FILENAME_WISHLIST, 'products_id=' . $relatedResult->fields['products_id'] . '&action=wishlist_add_product') . '"><i class="fa fa-heart"></i>Add to Wishlist</a>';}else{ $wishlist_link='';}
	
		$compare_link='<a class="lnk" href="javascript: compareNew('.$relatedResult->fields['products_id'].', \'add\')"><i class="fa fa-exchange"></i>Add to Compare</a>';

		$buy_now = zen_get_buy_now_button($relatedResult->fields['products_id'],'');
		if($buy_now!=NULL){
			$buy_now ='<a class="btn btn-dark-blue btn-small-med btn-trans">'.$buy_now.'</a>';
		}
		elseif($attribute_product == $pid) {
			$buy_now = zen_get_buy_now_button($relatedResult->fields['products_id'],'<a class="btn btn-dark-blue btn-small-med btn-trans" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $relatedResult->fields['products_id']) . '">Select Options</a>');
		}
		else {
			$buy_now = zen_get_buy_now_button($relatedResult->fields['products_id'],'<a class="btn btn-dark-blue btn-small-med btn-trans" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $relatedResult->fields['products_id']) . '">Add to Cart</a>');
		}

					 $list_box_contents[$row][$col] = array('params' => 'class="item centerBoxContentsRelatedProduct product-item back"' . ' ', 'text' => (($relatedResult->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : 
	'<div class="product">
		<div class="product-image">
			<div class="image">' . zen_image(DIR_WS_IMAGES . $relatedResult->fields['products_image'], $relatedResult->fields['products_name'], IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT) . '
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
				'<a href="' . zen_href_link(zen_get_info_page($relatedResult->fields['products_id']), 'cPath=' . $productsInCategory[$relatedResult->fields['products_id']] . '&products_id=' . $relatedResult->fields['products_id']) . '">' . $products_name . '</a>
			</h3>'.
			mb_product_reviews($relatedResult->fields['products_id']).'
			<div class="price">' 
				. $products_price . 
			'</div>
		</div>
	 </div>');



						$col ++;

						if ($col > (SHOW_PRODUCT_INFO_COLUMNS_RELATED_PRODUCTS - 1))
						{

							$col = 0;

							$row ++;

						}

					$relatedResult->MoveNext();

					}
				
				$title = '<h3 class="section-title">'.BOX_HEADING_RELATED_PRODUCTS.'</h3>';	


				require($template->get_template_dir('tpl_columnar_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_columnar_display.php');
			?>
			</div>

		<?php
		}
	}
/* End of File */