<?php
/**
 * Contact Us Page
 *
 * @package page
 * @copyright Copyright 2003-2013 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version GIT: $Id: Author: DrByte  Sun Feb 17 23:22:33 2013 -0500 Modified in v1.5.2 $
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_COLLABORATIONS');

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

$error = false;
if (isset($_GET['action']) && ($_GET['action'] == 'send')) {
  $name = zen_db_prepare_input($_POST['contactname']);
  $email_address = zen_db_prepare_input($_POST['email']);
  $url = zen_db_prepare_input($_POST['url']);
  $subscriber = zen_db_prepare_input($_POST['numberofsubscriber']);
  $website1 = zen_db_prepare_input($_POST['website1']);
  $website2 = zen_db_prepare_input($_POST['website2']);
  $website3 = zen_db_prepare_input($_POST['website3']);
  $description = zen_db_prepare_input($_POST['description']);
  $comment = zen_db_prepare_input($_POST['comment']);
  $location = zen_db_prepare_input(strip_tags($_POST['location']));
  $antiSpam = isset($_POST['should_be_empty']) ? zen_db_prepare_input($_POST['should_be_empty']) : '';
  $zco_notifier->notify('NOTIFY_COLLABORATIONS_CAPTCHA_CHECK');

  $zc_validate_email = zen_validate_email($email_address);

  if ($zc_validate_email and !empty($location) and !empty($name) and !empty($url) && $error == FALSE) {
    // if anti-spam is not triggered, prepare and send email:
   if ($antiSpam != '') {
      $zco_notifier->notify('NOTIFY_SPAM_DETECTED_USING_COLLABORATIONS');
   } elseif ($antiSpam == '') {

    // auto complete when logged in
    if($_SESSION['customer_id']) {
      $sql = "SELECT customers_id, customers_firstname, customers_lastname, customers_password, customers_email_address, customers_default_address_id
              FROM " . TABLE_CUSTOMERS . "
              WHERE customers_id = :customersID";

      $sql = $db->bindVars($sql, ':customersID', $_SESSION['customer_id'], 'integer');
      $check_customer = $db->Execute($sql);
      $customer_email= $check_customer->fields['customers_email_address'];
      $customer_name= $check_customer->fields['customers_firstname'] . ' ' . $check_customer->fields['customers_lastname'];
    } else {
      $customer_email = NOT_LOGGED_IN_TEXT;
      $customer_name = NOT_LOGGED_IN_TEXT;
    }

   $send_to_email = trim(EMAIL_FROM);
   $send_to_name =  trim(STORE_NAME);
   
    // Prepare extra-info details
    $extra_info = email_collect_extra_info($name, $email_address, $customer_name, $customer_email);
    // Prepare Text-only portion of message
    $text_message = OFFICE_FROM . "\t" . $name . "\n" .
    OFFICE_EMAIL . "\t" . $email_address . "\n\n" .
    '------------------------------------------------------' . "\n\n" .
    'Location:' . "\t" . strip_tags($_POST['location']) .  "\n\n" .
    ENTRY_URL . "\t" . strip_tags($_POST['url']) .  "\n\n" .
    ENTRY_SUBSCRIBER . "\t" . strip_tags($_POST['numberofsubscriber']) .  "\n\n" .
    ENTRY_WEBSITES . "\nWebsite #1:" . strip_tags($_POST['website1']) .  "\nWebsite #2:" .
    strip_tags($_POST['website2']) .  "\nWebsite #3:" .
    strip_tags($_POST['website3']) .  "\n\n" .
    ENTRY_DESCRIPTION . "\n" . strip_tags($_POST['description']) .  "\n\n" .
    ENTRY_COMMENT . "\n" . strip_tags($_POST['comment']) .  "\n\n" .
    '------------------------------------------------------' . "\n\n" .
    $extra_info['TEXT'];
    // Prepare HTML-portion of message
    $html_msg['EMAIL_MESSAGE_HTML'] = strip_tags($_POST['location']);
    $html_msg['COLLABORATION_OFFICE_FROM'] = OFFICE_FROM . ' ' . $name . '<br />' . OFFICE_EMAIL . '(' . $email_address . ')';
    $html_msg['EXTRA_INFO'] = $extra_info['HTML'];
    // Send message
    zen_mail($send_to_name, $send_to_email, EMAIL_SUBJECT, $text_message, $name, $email_address, $html_msg,'collaborations');
   }
    zen_redirect(zen_href_link(FILENAME_COLLABORATIONS, 'action=success', 'SSL'));
  } else {
    $error = true;
    if (empty($name)) {
      $messageStack->add('collaboration', ENTRY_EMAIL_NAME_CHECK_ERROR);
    }
    if (empty($url)) {
      $messageStack->add('collaboration', ENTRY_URL_CHECK_ERROR);
    }
    if ($zc_validate_email == false) {
      $messageStack->add('collaboration', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }
    if (empty($location)) {
      $messageStack->add('collaboration', ENTRY_LOCATION_CHECK_ERROR);
    }
  }
} // end action==send


if (ENABLE_SSL == 'true' && $request_type != 'SSL') {
  zen_redirect(zen_href_link(FILENAME_COLLABORATIONS, '', 'SSL'));
}

$send_to_array = array();
if (COLLABORATIONS_LIST !=''){
  foreach(explode(",", COLLABORATIONS_LIST) as $k => $v) {
    $send_to_array[] = array('id' => $k, 'text' => preg_replace('/\<[^*]*/', '', $v));
  }
}

// include template specific file name defines
$define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_COLLABORATIONS, 'false');

$breadcrumb->add(NAVBAR_TITLE);

// This should be the last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_COLLABORATIONS');
