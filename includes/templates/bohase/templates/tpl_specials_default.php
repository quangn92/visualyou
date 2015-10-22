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

	<div class="category-info">
    	<div class="category-details">
			<!-- <h2 class="category-title" style="margin-bottom: 6px;"><?php echo $breadcrumb->last(); ?></h2> -->
			<h2 class="category-title" style="margin-bottom: 6px;">Sale</h2>
				<p align="center"><img src="https://www.visual-you.com/images/vu_halloween2015_special_banner01.jpg"></p>
				<p align="center">&nbsp;</p> 

				<div align="center">
					<table border="0" width="85%">
						<tbody>
							<tr>
								<td>
									<p style="margin: 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 18px; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px;" align="center">
									&nbsp;</p>
									<p align="center">
										<span style="color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 18px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; display: inline !important; float: none;">
										Our special SALE for the upcoming Halloween! ^_^</span>
									</p>
									&nbsp;
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<p></p>
		</div>
	</div>
	
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