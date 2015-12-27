<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: notes_extras_dhtml.php v0.912 Paul Mathot $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  $za_contents[] = array('text' => '<strong id="notesLink">Admin Notes Advanced</strong>', 'link' => zen_href_link('notes.php', '', 'NONSSL'));
?>
