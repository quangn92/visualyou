<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: tpl_drop_menu.php  2005/06/15 15:39:05 DrByte Exp $
//

?>
	<!-- menu area -->
         <ul id="nav" class="nav navbar-nav">
         	<?php /*?><li id='home' class="<?php if($this_is_home_page){ echo "tab_active"; } ?>" >
            	<a href="<?php echo zen_href_link(FILENAME_DEFAULT."&pg=home"); ?>">
                	<?php echo HEADER_TITLE_CATALOG; ?>
              	</a>
          	</li><?php */?>
            <!--Categories Link in Menu-->
			<?php			
         		// load the UL-generator class and produce the menu list dynamically from there
         		require_once (DIR_WS_CLASSES . 'categories_ul_generator_menu_style_2.php');
         		$zen_CategoriesUL = new zen_categories_ul_generator;
        		$menulist = $zen_CategoriesUL->buildTree(true);
			   	$menulist = str_replace('"level4"','"level5"',$menulist);
			   	$menulist = str_replace('"level3"','"level4"',$menulist);
			   	$menulist = str_replace('"level2"','"level3"',$menulist);
			   	$menulist = str_replace('"level1"','"level2"',$menulist);
			   	$menulist = str_replace('<li class="">','<li class="">',$menulist);
			   	$menulist = str_replace("</li>\n</ul>\n</li>\n</ul>\n","</li>\n</ul>\n",$menulist);
			   	echo $menulist;
        	?>
            <!--Categories Link in Menu Ends-->
            <!--Display the EZ Pages link in Menu. Uncomment if needed. -->
		   	<?php if (EZPAGES_STATUS_HEADER == '1' or (EZPAGES_STATUS_HEADER == '2' and (strstr(
                    EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
                     <li id='ezpages'>
                         <a href="<?php echo zen_href_link("page&id=".$pages_id."&pg=ezpages"); ?>">
                          <?php echo HEADER_TITLE_EZPAGES; ?>
                         </a>
                         <ul class="nav-child unstyled"> 
                             <?php require($template->get_template_dir('tpl_ezpages_bar_header.php',DIR_WS_TEMPLATE, 
              $current_page_base,'templates'). '/tpl_ezpages_bar_header.php'); ?>
                         </ul>    
            		</li>  
           	<?php } ?>
            <!--EZ Pages Menu Ends Here-->
          </ul>
		  <ri id="custom-cnt-search" class="cnt-search">
				<div class="input-group">
					<!--<a class="fa fa-search search-button" href=""> </a>-->
						<div class="field">
							<!--Search Bar-->
							<?php
							   $text = str_replace("ENTER SEARCH KEYWORDS HERE", "Search entire store here..", "ENTER SEARCH KEYWORDS HERE");
							   $content = "";
							   $content .= zen_draw_form('quick_find_header', zen_href_link
										  (FILENAME_ADVANCED_SEARCH_RESULT, '', 'SSL', false), 'get');
							   $content .= zen_draw_hidden_field('main_page',FILENAME_ADVANCED_SEARCH_RESULT);
							   $content .= zen_draw_hidden_field('search_in_description', '1') . zen_hide_session_id();
							   $content .= '<div class="form-search">' . 
								 zen_draw_input_field('keyword', '', 'class="input-text" maxlength="30" value="'.$text.'" onfocus="if(this.value == \''.$text.'\') this.value = \'\';" onblur="if (this.value == \'\') this.value = \'' . $text . '\';"') . '<span class="input-group-btn"><button class="btn btn-default" title="Search" type="submit"><i class="fa fa-search"></i></button></span></div>';
							   $content .= "</form>";
							   echo($content);
							?>
					  </div>
				  </div>
			  </ri>
		  <!-- search ends here -->
	      <!-- end dropMenuWrapper-->
    <div class="clearBoth"></div>