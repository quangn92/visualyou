<?php
/**
 * Bohase - Premium Zencart Template
 *
 * @package Boahse Admin File
 * @author PerfectusThemes
 * @author website www.perfectusinc.com
 * @copyright Copyright 2015-2016 Perfectus Inc.
 * @license http://www.gnu.org/copyleft/gpl.html   GNU Public License V2.0
 * @version $Id: template_settings.php 1.0
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

if (function_exists('zen_register_admin_page')) {
    if (!zen_page_key_exists('template_settings')) {
        // Add Color menu to Tools menu
        zen_register_admin_page('template_settings', 'BOX_TOOLS_TEMPLATE_SETTINGS','FILENAME_TEMPLATE_SETTINGS', '', 'tools', 'Y', 21);
    }
}
?>