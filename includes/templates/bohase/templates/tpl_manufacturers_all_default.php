<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_manufacturers_all.php 2935 2006-02-01 11:12:40Z birdbrain $
 */
?>

<!-- bof: manufacturers_all -->
<div class="centerColumn" id="manuAllWrapper">
	<header>
		<h4 id="allProductsDefaultHeading"><?php echo HEADING_TITLE; ?></h4>
	</header>
    <div id="manufacturersAll">
<?php
  echo $manu_content;
?>
	</div>
</div>
<!-- eof: manufacturers_all -->
