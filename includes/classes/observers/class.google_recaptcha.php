<?php
/**
*
* @package plugins
* @copyright Copyright 2003-2015 Zen Cart Development Team
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
*
* Designed for v1.5.4
*/

// Register API keys at https://www.google.com/recaptcha/admin
$siteKey = "6LciSg0TAAAAANFp5k5-7CzzvDBqdAwY2HsVFEvd";
$secret = "6LciSg0TAAAAAHlKlGwybduD_pN22TIo8iKw2YlU";

// Zencart stuff
class google_recaptcha extends base {
	function __construct() {
			$this->attach($this, array('NOTIFY_CONTACT_US_CAPTCHA_CHECK', 'NOTIFY_CREATE_ACCOUNT_CAPTCHA_CHECK'));
	}

	function update(&$class, $eventID, $paramsArray = array()) {
		global $messageStack, $error, $secret;
		$event_array = array('NOTIFY_CONTACT_US_CAPTCHA_CHECK' => 'contact', 'NOTIFY_CREATE_ACCOUNT_CAPTCHA_CHECK' => 'create_account');
		// reCAPTCHA response?
		if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
		  $messageStack->add('contact', GOOGLE_RECAPTCHA_CHECK_ERROR);
		  $messageStack->add('create_account', GOOGLE_RECAPTCHA_CHECK_ERROR);
          $error = true;
        }
	return $error;
	}
}