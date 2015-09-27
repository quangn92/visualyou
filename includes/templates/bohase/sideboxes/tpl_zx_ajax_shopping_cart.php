<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2014 ZenExpert - http://www.zenexpert.com
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_zx_ajax_shopping_cart.php 1 2014-06-05 19:07:36Z ZenExpert $
 */
  $content ="";
  
  $content .= '<div id="topcartinner">';

    $content .= '<a href="'. zen_href_link(FILENAME_SHOPPING_CART, '', 'SSL') .'" class="dropdown-toggle lnk-cart btn btn-blue btn-small" id="topcartlink" onClick="ajax_cart(); return false"><i class="glyphicon glyphicon-shopping-cart"></i><span class="item-count">Cart '. $_SESSION['cart']->count_contents() .'</span></a></div>';

?>