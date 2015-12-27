<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: copy_to_confirm.php 3380 2006-04-06 05:12:45Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
   
function install_quick_updates() {
	global $db;
	$project = PROJECT_VERSION_MAJOR.'.'.PROJECT_VERSION_MINOR;
	if ( (substr($project,0,5) == "1.3.8") || (substr($project,0,5) == "1.3.9") ) {
		$db->Execute("INSERT INTO ".TABLE_CONFIGURATION_GROUP." VALUES ('', 'Quick Updates', 'Quick Updates Configuration', '1', '1')");
		$group_id = mysql_insert_id();
		$db->Execute("UPDATE ".TABLE_CONFIGURATION_GROUP." SET sort_order = ".$group_id." WHERE configuration_group_id = ".$group_id);
		$db->Execute("INSERT INTO ".TABLE_CONFIGURATION." (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
		(NULL, 'Display the ID.',                          'QUICKUPDATES_DISPLAY_ID',          'true',  'Enable/Disable the products id displaying',                     ".$group_id.", '1', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'), 
		(NULL, 'Display the thumbnail.',                   'QUICKUPDATES_DISPLAY_THUMBNAIL',   'true',  'Enable/Disable the products thumbnail displaying',              ".$group_id.", '2', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the model.',                        'QUICKUPDATES_MODIFY_MODEL',        'true',  'Enable/Disable the products model displaying and modification', ".$group_id.", '3', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the name.',                         'QUICKUPDATES_MODIFY_NAME',         'true',  'Enable/Disable the products name editing',                      ".$group_id.", '4', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the Description.',                  'QUICKUPDATES_MODIFY_DESCRIPTION',  'true',  'Enable/Disable the displaying and modification of products description', ".$group_id.", '5', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the status of the products.',       'QUICKUPDATES_MODIFY_STATUS',       'true',  'Allow/Disallow the Status displaying and modification',       ".$group_id.", '6',  NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the weight of the products.',       'QUICKUPDATES_MODIFY_WEIGHT',       'true',  'Allow/Disallow the Weight displaying and modification?',      ".$group_id.", '7',  NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the quantity of the products.',     'QUICKUPDATES_MODIFY_QUANTITY',     'true',  'Allow/Disallow the quantity displaying and modification',     ".$group_id.", '8',  NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the manufacturer of the products.', 'QUICKUPDATES_MODIFY_MANUFACTURER', 'false', 'Allow/Disallow the Manufacturer displaying and modification', ".$group_id.", '9',  NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the class of tax of the products.', 'QUICKUPDATES_MODIFY_TAX',          'false', 'Allow/Disallow the Class of tax displaying and modification', ".$group_id.", '10', NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the category.',                     'QUICKUPDATES_MODIFY_CATEGORY',     'true',  'Enable/Disable the products category modify',                 ".$group_id.", '11', NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Display price with all included of tax.',  'QUICKUPDATES_DISPLAY_TVA_OVER',    'true',  'Enable/Disable the displaying of the Price with all tax included when your mouse is over a product', ".$group_id.", '20', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Display the link towards the products information page.',                       'QUICKUPDATES_DISPLAY_PREVIEW',            'false', 'Enable/Disable the display of the link towards the products information page ',                      ".$group_id.", '30', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Display the link towards the page where you will be able to edit the product.', 'QUICKUPDATES_DISPLAY_EDIT',               'true',  'Enable/Disable the display of the link towards the page where you will be able to edit the product', ".$group_id.", '31', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Activate or desactivate the commercial margin.',                                'QUICKUPDATES_ACTIVATE_COMMERCIAL_MARGIN', 'true',  'Do you want that the commercial margin be activate or not ?',".$group_id.", '40', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the sort order.',                   'QUICKUPDATES_MODIFY_SORT_ORDER',        'true', 'Enable/Disable the products sort order modify',               ".$group_id.", '12', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Use popup edit.',                          'QUICKUPDATES_MODIFY_DESCRIPTION_POPUP', 'true', 'Enable/Disable using popup edit link to description editing', ".$group_id.", '13', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),') ");
	} elseif (substr($project,0,3) == "1.5") {
		$db->Execute("INSERT INTO ".TABLE_CONFIGURATION_GROUP." VALUES ('', 'Quick Updates', 'Quick Updates Configuration', '1', '1')");
		$group_id = $db->Insert_ID();
		$db->Execute("UPDATE ".TABLE_CONFIGURATION_GROUP." SET sort_order = ".$group_id." WHERE configuration_group_id = ".$group_id);
        zen_register_admin_page('quick_updates_config', 'BOX_CATALOG_QUICK_UPDATES','FILENAME_CONFIGURATION', 'gID='.$group_id, 'configuration', 'Y', 103);
		$db->Execute("INSERT INTO ".TABLE_CONFIGURATION." (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)  VALUES 
		(NULL, 'Display the ID.',                          'QUICKUPDATES_DISPLAY_ID',          'true',  'Enable/Disable the products id displaying',                     ".$group_id.", '1', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'), 
		(NULL, 'Display the thumbnail.',                   'QUICKUPDATES_DISPLAY_THUMBNAIL',   'true',  'Enable/Disable the products thumbnail displaying',              ".$group_id.", '2', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the model.',                        'QUICKUPDATES_MODIFY_MODEL',        'true',  'Enable/Disable the products model displaying and modification', ".$group_id.", '3', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the name.',                         'QUICKUPDATES_MODIFY_NAME',         'true',  'Enable/Disable the products name editing',                      ".$group_id.", '4', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the Description.',                  'QUICKUPDATES_MODIFY_DESCRIPTION',  'true',  'Enable/Disable the displaying and modification of products description', ".$group_id.", '5', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the status of the products.',       'QUICKUPDATES_MODIFY_STATUS',       'true',  'Allow/Disallow the Status displaying and modification',       ".$group_id.", '6',  NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the weight of the products.',       'QUICKUPDATES_MODIFY_WEIGHT',       'true',  'Allow/Disallow the Weight displaying and modification?',      ".$group_id.", '7',  NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the quantity of the products.',     'QUICKUPDATES_MODIFY_QUANTITY',     'true',  'Allow/Disallow the quantity displaying and modification',     ".$group_id.", '8',  NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the manufacturer of the products.', 'QUICKUPDATES_MODIFY_MANUFACTURER', 'false', 'Allow/Disallow the Manufacturer displaying and modification', ".$group_id.", '9',  NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the class of tax of the products.', 'QUICKUPDATES_MODIFY_TAX',          'false', 'Allow/Disallow the Class of tax displaying and modification', ".$group_id.", '10', NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the category.',                     'QUICKUPDATES_MODIFY_CATEGORY',     'true',  'Enable/Disable the products category modify',                 ".$group_id.", '11', NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Display price with all included of tax.',  'QUICKUPDATES_DISPLAY_TVA_OVER',    'true',  'Enable/Disable the displaying of the Price with all tax included when your mouse is over a product', ".$group_id.", '20', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Display the link towards the products information page.',                       'QUICKUPDATES_DISPLAY_PREVIEW',            'false', 'Enable/Disable the display of the link towards the products information page ',                      ".$group_id.", '30', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Display the link towards the page where you will be able to edit the product.', 'QUICKUPDATES_DISPLAY_EDIT',               'true',  'Enable/Disable the display of the link towards the page where you will be able to edit the product', ".$group_id.", '31', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Activate or desactivate the commercial margin.',                                'QUICKUPDATES_ACTIVATE_COMMERCIAL_MARGIN', 'true',  'Do you want that the commercial margin be activate or not ?',".$group_id.", '40', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Modify the sort order.',                   'QUICKUPDATES_MODIFY_SORT_ORDER',        'true', 'Enable/Disable the products sort order modify',               ".$group_id.", '12', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		(NULL, 'Use popup edit.',                          'QUICKUPDATES_MODIFY_DESCRIPTION_POPUP', 'true', 'Enable/Disable using popup edit link to description editing', ".$group_id.", '13', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),') ");
	} else { // unsupported version 
		// i should do something here!
	} 
}

function remove_quick_updates() {
	global $db;
	$project = PROJECT_VERSION_MAJOR.'.'.PROJECT_VERSION_MINOR;
	if ( (substr($project,0,5) == "1.3.8") || (substr($project,0,5) == "1.3.9") ) {
		$sql = "SELECT configuration_group_id FROM ".TABLE_CONFIGURATION_GROUP." WHERE configuration_group_title = 'Quick Updates' LIMIT 1";
		$result = $db->Execute($sql);
		if (mysql_num_rows($result)) { 
			$group_id =  mysql_fetch_array($result);
			$db->Execute("DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_group_id = ".$group_id[0]);
			$db->Execute("DELETE FROM ".TABLE_CONFIGURATION_GROUP." WHERE configuration_group_id = ".$group_id[0]);
		}
	} elseif (substr($project,0,3) == "1.5") {
		$sql = "SELECT configuration_group_id FROM ".TABLE_CONFIGURATION_GROUP." WHERE configuration_group_title = 'Quick Updates' LIMIT 1";
		$result = $db->Execute($sql);
		if ($result->RecordCount() > 0) { 
			$group_id =  $result->fields['configuration_group_id'];
			$db->Execute("DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_group_id = ".$group_id);
			$db->Execute("DELETE FROM ".TABLE_CONFIGURATION_GROUP." WHERE configuration_group_id = ".$group_id);
			$db->Execute("DELETE FROM ".TABLE_ADMIN_PAGES." WHERE page_key = 'quick_updates'");
			$db->Execute("DELETE FROM ".TABLE_ADMIN_PAGES." WHERE page_key = 'quick_updates_config'");
		}
	} else { // unsupported version 
	} 
}
?>