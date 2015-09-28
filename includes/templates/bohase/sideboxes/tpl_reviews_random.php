<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_reviews_random.php 16044 2010-04-23 01:15:45Z drbyte $
 */
  $content = "";
  $review_box_counter = 0;
  while (!$random_review_sidebox_product->EOF) {
    $review_box_counter++;
    $content .= '<div class="random-reviews sideBoxContent centeredContent '.str_replace('_', '-', $box_id . 'Content').'">';
    $content .= '<div class="reviewsidebox_content"><div class="product_reviewsideimage">' . zen_image(DIR_WS_IMAGES . $random_review_sidebox_product->fields['products_image'], $random_review_sidebox_product->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</div><div class="product_reviewsideboxname"><a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $random_review_sidebox_product->fields['products_id'] . '&reviews_id=' . $random_review_sidebox_product->fields['reviews_id']) . '">' . nl2br(zen_output_string_protected(stripslashes($random_review_sidebox_product->fields['reviews_text']))) . '</a><div class="sidebox_random_rating">' . zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $random_review_sidebox_product->fields['reviews_rating'] . '_small.png' , sprintf(BOX_REVIEWS_TEXT_OF_5_STARS, $random_review_sidebox_product->fields['reviews_rating']));
    $content .= '</div></div></div></div>';
    $random_review_sidebox_product->MoveNextRandom();
  }
