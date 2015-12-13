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
?><head><title>Collaborations</title></head>

<span class="breadcrumb-title"><?php echo $var_pageDetails->fields['pages_title']; ?></span>

<div class="centerColumn" id="contactUsDefault">
	<?php echo zen_draw_form('collaborations', zen_href_link(FILENAME_COLLABORATIONS, 'action=send')); ?>
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
    <?php 
    if ($messageStack->size('collaboration') > 0) echo $messageStack->output('collaboration'); ?>
    <div class="contact-details">
        <div class="contact-info">
    		<div class="row">
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
            
            <div class="row sender-name-email">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 sender-name">
                    <label><?php echo ENTRY_NAME . '<span class="alertrequired">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
                    <?php echo zen_draw_input_field('contactname', $name, ' size="40" id="contactname"') ; ?>
                </div>
            </div>        	
         
         <br class="clearBoth" />
            <div class="row message-detail">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 sender-email" for="email-address">
                    <label><?php echo ENTRY_EMAIL . '<span class="alertrequired">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
                    <?php echo zen_draw_input_field('email', ($email_address), ' size="40" id="email-address"') ; ?>
                </div>
            </div>
          
         <br class="clearBoth" />
            <div class="row message-detail">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 contactus-message" for="location">
                    <label><?php echo ENTRY_LOCATION . '<span class="alertrequired">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
                    <?php echo zen_draw_input_field('location', $location, ' size="40" id="location"'); ?>
                </div>
            </div>
                
         <br class="clearBoth" />
            <div class="row message-detail">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 contactus-message" for="url">
                    <label><?php echo ENTRY_URL . '<span class="alertrequired">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
                    <?php echo zen_draw_input_field('url', $url, ' size="40" id="url"'); ?>
                </div>
            </div>
                
         <br class="clearBoth" />
            <div class="row message-detail">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 contactus-message" for="numberofsubscriber">
                    <label><?php echo ENTRY_SUBSCRIBER; ?></label>
                    <?php echo zen_draw_input_field('numberofsubscriber', $numberofsubscriber, ' size="40" id="numberofsubscriber"'); ?>
                </div>
            </div>
                
         <br class="clearBoth" />
            <div class="row message-detail">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 contactus-message" for="websites">
                    <label><?php echo ENTRY_WEBSITES; ?></label>
                    <?php echo zen_draw_input_field('websites', $websites, ' size="40" id="websites"'); ?>
                </div>
            </div>
                
         <br class="clearBoth" />
            <div class="row message-detail">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 contactus-message" for="websites">
                    <?php echo zen_draw_input_field('websites', $websites, ' size="40" id="websites"'); ?>
                </div>
            </div>         
            
         <br class="clearBoth" />
            <div class="row message-detail">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 contactus-message" for="websites">
                    <?php echo zen_draw_input_field('websites', $websites, ' size="40" id="websites"'); ?>
                </div>
            </div> 
            
         <br class="clearBoth" />
            <div class="row message-detail">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 contactus-message" for="description">
                    <label><?php echo ENTRY_DESCRIPTION; ?></label>
                    <?php echo zen_draw_textarea_field('description', '30', '7', $description, ' id="description"'); ?>
                </div>
            </div>
            
            
        	<br class="clearBoth" />
            <div class="row message-detail">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 contactus-message" for="comment">
                    <label><?php echo ENTRY_COMMENT; ?></label>
                    <?php echo zen_draw_textarea_field('comment', '30', '7', $comment, ' id="comment"'); ?>
                </div>
            </div>
            
        	<br class="clearBoth" />
            <div class="row contactus-sendbutton">
                <!-- bo Google reCAPTCHA  -->
                <script src='https://www.google.com/recaptcha/api.js'></script>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 recaptcha-details">
                    <label><?php echo GOOGLE_RECAPTCHA . '<span class="alertrequired">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
	                <div class="g-recaptcha" data-sitekey="<?php echo $siteKey;?>"></div>
                </div>
                <!-- eo Google reCAPTCHA  -->
                
                <div class="col-lg-12">
                    <div class="alert-text forward"><?php echo FORM_REQUIRED_INFORMATION; ?>
                    <br>
                     <input class="cssButton submit_button btn btn-small-med  button_send" onmouseover="this.className='cssButtonHover btn btn-small-med button_send button_sendHover'" onmouseout="this.className='cssButton submit_button btn btn-small-med  button_send'" value="Submit" style="float:left" type="submit">
                    </div>
                </div>
            </div>
		</div>
	</div>
</form>
</div>