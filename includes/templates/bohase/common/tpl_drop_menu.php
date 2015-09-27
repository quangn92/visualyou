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
<?php
  if(isset($_REQUEST['pg']))
  {
    $pg=$_REQUEST['pg'];
  }
?>
		 <!-- menu area -->
         <ul id="nav" class="nav navbar-nav">
         	<li id='home' class="<?php if($this_is_home_page){ echo "tab_active"; } ?>" >
            	<a href="<?php echo zen_href_link(FILENAME_DEFAULT); ?>">
                	<?php echo HEADER_TITLE_CATALOG; ?>
              	</a>
          	</li>
            <!--Categories Link in Menu-->
            <?php 
            	//$cat_query = "select * from ".DB_PREFIX."categories where categories_status='1' ORDER BY RAND() LIMIT 1";
                //$category = $db->Execute($cat_query);
                //$categories_id=$category->fields['categories_id'];
            ?>
			<li id='categories' class="<?php if($pg=='categories') { echo "tab_active";}?>" >
            	<a href="#">
					<?php echo HEADER_TITLE_CATEGORIES; ?><span class="fa fa-caret-down">
                </a>
			<?php			
         		// load the UL-generator class and produce the menu list dynamically from there
         		require_once (DIR_WS_CLASSES . 'categories_ul_generator.php');
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
            </li>
            <!--Categories Link in Menu Ends-->
            <!--Manufacturers Link in Menu-->
            <li id='brands' class="<?php if($pg=='brands') { echo "tab_active";}?>" >
            	<a href="<?php echo zen_href_link("manufacturers_all.html&pg=brands"); ?>">
					<?php echo HEADER_TITLE_MANUFACTURER; ?><span class="fa fa-caret-down">
                </a>
                <ul class="">
                    <?php
                        global $languages_id, $db;
                        $manufacturers_query = "SELECT DISTINCT m.manufacturers_id, m.manufacturers_name, p.manufacturers_id, 
						p.products_ordered FROM ".DB_PREFIX."manufacturers m, ".DB_PREFIX."products p WHERE 
						m.manufacturers_id = p.manufacturers_id GROUP BY 
						m.manufacturers_id ORDER BY m.manufacturers_name LIMIT 10" ;
                        $manufacturers = $db->Execute($manufacturers_query);
                        while (!$manufacturers->EOF) {
                        	$manufacturers_id=$manufacturers->fields['manufacturers_id'];
                            $manufacturers_name=$manufacturers->fields['manufacturers_name'];
                            	if($manufacturers_name !='' ) { ?>
                               		<li><a href="<?php echo zen_href_link("index&manufacturers_id=".$manufacturers_id."&pg=brands"); ?>">
                                    	<?php echo $manufacturers_name; ?></a>			
                                    </li>
                           	<?php }
                        	$manufacturers->MoveNext();
                    	}
                    ?>
                </ul>
            </li>
            <!--Manufacturers Link in Menu Ends-->
            <!--Display the EZ Pages link in Menu. Uncomment if needed. -->
		   	<?php if (EZPAGES_STATUS_HEADER == '1' or (EZPAGES_STATUS_HEADER == '2' and (strstr(
                    EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
                     <li id='ezpages'>
                         <a href="<?php echo zen_href_link("page&id=".$pages_id."&pg=ezpages"); ?>">
                          <?php echo HEADER_TITLE_EZPAGES; ?><span class="fa fa-caret-down">
                         </a>
                         <ul class="nav-child unstyled"> 
                             <?php require($template->get_template_dir('tpl_ezpages_bar_header.php',DIR_WS_TEMPLATE, 
              $current_page_base,'templates'). '/tpl_ezpages_bar_header.php'); ?>
                         </ul>    
            		</li>  
           	<?php } ?>
            <!--EZ Pages Menu Ends Here-->
          </ul>
          
	      <!-- end dropMenuWrapper-->
    	  <div class="clearBoth"></div>