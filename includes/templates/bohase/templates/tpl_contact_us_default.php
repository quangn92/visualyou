<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=contact_us.<br />
 * Displays contact us page form.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_contact_us_default.php 18695 2011-05-04 05:24:19Z drbyte $
 */
?><head><title>Contact Us</title></head>
<?php 
$template_query = "SELECT * FROM " . TABLE_TEMPLATE_SETTINGS;
$template_result = $db->Execute($template_query);
$store_map = $template_result->fields['store_map'];
?>


<span class="breadcrumb-title"><?php echo $var_pageDetails->fields['pages_title']; ?></span>

<div class="centerColumn" id="contactUsDefault">
	<?php echo zen_draw_form('contact_us', zen_href_link(FILENAME_CONTACT_US, 'action=send')); ?>
    <header>
		<h4 id="contactus-heading"><?php echo HEADING_TITLE; ?></h4>
	</header>
    <?php
  		if (isset($_GET['action']) && ($_GET['action'] == 'success')) {
	?>
		<div class="alert alert-success alert-dismissable"><?php echo TEXT_SUCCESS; ?></div>
	<?php
  		} 
	?>
    <?php if ($messageStack->size('contact') > 0) echo $messageStack->output('contact'); ?>
    <div class="contact-details">
        <div class="contact-info">
    		<div class="row">
				<?php if($store_map != NULL) { ?>
            	<div class="map-container col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<div class="contact-map">
                    	<?php echo $store_map; ?>
                    </div>
                </div>
                <?php
					}
				?>
                <div class="static-content col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<div class="content">
                        <div class="contact-sample-text">
                        <?php if (DEFINE_CONTACT_US_STATUS >= '1' and DEFINE_CONTACT_US_STATUS <= '2') { ?>
                            <?php
                            /**
                             * require html_define for the contact_us page
                             */
                              require($define_page); 
                            ?>
                        <?php
                          }
                        ?>
                        </div>
                	</div>
                </div>
            </div>
        </div>
   	</div>
	<div class="row">
    	<div class="store-contact-form col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?php
            // show dropdown if set
                if (CONTACT_US_LIST !=''){
            ?>
            <label class="inputLabel" for="send-to"><?php echo SEND_TO_TEXT; ?></label>
            <?php echo zen_draw_pull_down_menu('send_to',  $send_to_array, 0, 'id="send-to"') . '<span class="alert-text">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?>
            <br class="clearBoth" />
            <?php
                }
            ?>
            <div class="row sender-name-email">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 sender-name">
                    <label><?php echo ENTRY_NAME . '<span class="alertrequired">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
                    <?php echo zen_draw_input_field('contactname', $name, ' size="40" id="contactname"') ; ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 sender-email" for="email-address">
                    <label><?php echo ENTRY_EMAIL . '<span class="alertrequired">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
                    <?php echo zen_draw_input_field('email', ($email_address), ' size="40" id="email-address"') ; ?>
                </div>
            </div>
        	<br class="clearBoth" />
            <div class="row message-detail">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 contactus-message" for="enquiry">
                    <label><?php echo ENTRY_ENQUIRY . '<span class="alertrequired">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
                    <?php echo zen_draw_textarea_field('enquiry', '30', '7', $enquiry, ' id="enquiry"'); ?>
                </div>
                <!-- bo Google reCAPTCHA  -->
				<script src='https://www.google.com/recaptcha/api.js'></script>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 recaptcha-details">
                    <label><?php echo GOOGLE_RECAPTCHA . '<span class="alertrequired">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
	                <div class="g-recaptcha" data-sitekey="<?php echo $siteKey;?>"></div>
                </div>
                <!-- eo Google reCAPTCHA  -->
            </div>
            <div class="row contactus-sendbutton">
                <div class="col-lg-12">
                    <div class="alert-text forward"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
                    <?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_SEND_ALT); ?>
                </div>
            </div>
		</div>
	</div>
</form>
</div>