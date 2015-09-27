<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_password_forgotten_default.php 3712 2006-06-05 20:54:13Z drbyte $
 */
?>
<div class="centerColumn" id="passwordForgotten">
	<header>
		<h4 id="passwordforgotten_heading"> <?php echo HEADING_TITLE; ?> </h4>
	</header>
    <?php if ($messageStack->size('password_forgotten') > 0) echo $messageStack->output('password_forgotten'); ?>
	<div class="content">
		<?php echo zen_draw_form('password_forgotten', zen_href_link(FILENAME_LOGIN, 'action=process', 'SSL')); ?>
        <div id="passwordForgottenMainContent"><?php echo TEXT_MAIN; ?></div>
		<br class="clearBoth" />
		<div class="alert-text forward"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
		<br class="clearBoth" />
		<label for="email-address">
			<?php echo ENTRY_EMAIL_ADDRESS . (zen_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="alert-text">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': '' ); ?>
        </label>
		<?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="email-address"'); ?>
		<br class="clearBoth" />
		<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?></div> 
<?php /*?><div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div><?php */?>
</form>
	</div>
</div>