<div class="col-sm-3">
    								<div class="links">
                                    	<h3 class="title"><?php echo FOOTER_TITLE_CUSTOMER_CARE; ?></h3>
                                        <ul>
                                            <?php if (EZPAGES_STATUS_FOOTER == '1' or (EZPAGES_STATUS_FOOTER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
<?php require($template->get_template_dir('tpl_ezpages_bar_footer.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_ezpages_bar_footer.php'); ?>
<?php } ?>
                                        </ul>
                                  	</div>
                               	</div>