<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_specials_default.php 2958 2006-02-03 08:55:25Z birdbrain $
 */
?>
<div class="centerColumn" id="specialsListing">

<header>
	<h4 id="specialsListingHeading"><?php echo $breadcrumb->last(); ?></h4>
</header>
<!-- bof: specials -->
<?php
/********************************** GRID LIST VIEW ***************************************/
   $gridlist_tab='';
   if (defined('PRODUCT_LISTING_LAYOUT_STYLE_CUSTOMER') and PRODUCT_LISTING_LAYOUT_STYLE_CUSTOMER == '1') {
    //echo '<div class="view-mode">' .  array(array('id'=>'rows','text'=>PRODUCT_LISTING_LAYOUT_ROWS),array('id'=>'columns','text'=>PRODUCT_LISTING_LAYOUT_COLUMNS))) . '</div>';
	$gridlist_tab=mb_gridlist_tab(FILENAME_SPECIALS);
  }
   /**********************************EOF GRID LIST VIEW ***************************************/
/**
 * require the list_box_content template to display the products
 */
?>

<div class="sorter filters-container">
<?php
 echo $gridlist_tab;
?>
</div>

<!-- Product List -->
<?php
/**
 * display the new products
 */
require($template->get_template_dir('/tpl_modules_specials_listing.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_specials_listing.php'); ?>
<!-- Product List Ends -->

<!-- eof: specials -->
<?php
  if (($specials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<div class="pageresult_bottom filters-container">
	<!-- Top Product Counts-->
    <div class="product-page-count">

		<?php
		  if (($specials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
		?>

		<div id="specialsListingBottomNumber" class="navSplitPagesResult back"><?php echo $specials_split->display_count(TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?>
		</div>
		<?php } ?>
	</div>
	
	<?php if($specials_split->number_of_pages > 1) { //to hide the pagination div if no. of pages < 1 ?>
	<div id="specialsListingBottomLinks" class="navSplitPagesLinks forward pagination-style"><?php echo TEXT_RESULT_PAGE . ' ' . $specials_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?>
    </div>
<?php
	} ?>
</div>    
<?php  } // split page
?>
</div>