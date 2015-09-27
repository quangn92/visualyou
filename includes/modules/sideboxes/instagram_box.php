<?php
/**
 * instagram sidebox - displays instagram images
 *
 * @author Quang Nguyen
 */

// only show if either the tutorials are active or additional links are active
    require($template->get_template_dir('tpl_instagram_box.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_instagram_box.php');

    $title = "INSTAGRAM";
    $title_link = false;
    require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
?>
