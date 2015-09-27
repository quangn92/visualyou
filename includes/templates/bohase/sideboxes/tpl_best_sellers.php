<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_best_sellers.php 2982 2006-02-07 07:56:41Z birdbrain $
 */
  $content = '';
  
    
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">' . "\n";
  $content .= '<div class="wrapper">' . "\n" . '<div class="sideBoxContentItem">' . "\n";
  for ($i=1; $i<=sizeof($bestsellers_list); $i++) {
    
	$bestsellers_name=$bestsellers_list[$i]['name'];
    //$bestsellers_name=ltrim(substr($bestsellers_name, 0, 20));
	$bestsellers_list_price = zen_get_products_display_price($bestsellers_list[$i]['id']);
    $content .=  '<div class="sidebox_content"><div class="product_sideboximage">' . zen_image(DIR_WS_IMAGES . $bestsellers_list[$i]['products_image'], $bestsellers_list[$i]['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</div>';
    $content .= '<div class="product_sideboxname"><a href="' . zen_href_link(zen_get_info_page($bestsellers_list[$i]['id']), 'products_id=' . $bestsellers_list[$i]['id']) . '">' . zen_trunc_string($bestsellers_name, BEST_SELLERS_TRUNCATE, BEST_SELLERS_TRUNCATE_MORE) . '</a>';
    $content .= '<div class="sidebox_price">' . $bestsellers_list_price . '</div></div></div>'; }
  $content .= '</div>' . "\n";
  $content .= '</div>';
   $content .= '</div>';
?>