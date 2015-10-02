<?php
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

if (function_exists('zen_register_admin_page')) {
  if (!zen_page_key_exists('adminNotesAdvanced')) {
    // Add the link
    zen_register_admin_page('adminNotesAdvanced', 'BOX_ADMIN_NOTES_ADVANCED', 'FILENAME_ADMIN_NOTES_ADVANCED', '', 'extras', 'Y', 100);
  }else{
    // Now that the menu item has been created/registered, can stop the wasteful process of having
    // this script run again and again by removing it
    @unlink(DIR_FS_ADMIN . DIR_WS_INCLUDES . 'functions/extra_functions/register_admin_page.php');
  }
}
