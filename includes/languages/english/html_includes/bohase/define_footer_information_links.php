<div class="col-sm-3">
    								<div class="links">
                                    	<h3 class="title"><?php echo FOOTER_TITLE_INFORMATIONS; ?></h3>
                                        <ul>																					<li class="contact_us">                                                <a href="https://www.visual-you.com/catalog/about-us-ezp-28.html">                                                    About Us                                                </a>                                            </li>
                                        	<?php if (DEFINE_SHIPPINGINFO_STATUS <= 1) { ?>
                                                <li>
                                                    <a href="<?php echo zen_href_link(FILENAME_SHIPPING, '', 'SSL'); ?>">
                                                        <?php echo HEADER_TITLE_SHIPPING_INFO; ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <?php if (DEFINE_PRIVACY_STATUS <= 1)  { ?>
                                                <li>
                                                    <a href="<?php echo zen_href_link(FILENAME_PRIVACY, '', 'SSL'); ?>">
                                                        <?php echo BOX_INFORMATION_PRIVACY; ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <?php if (DEFINE_CONDITIONS_STATUS <= 1) { ?>
                                                <li>
                                                    <a href="<?php echo zen_href_link(FILENAME_CONDITIONS, '', 'SSL'); ?>">
                                                        <?php echo HEADER_TITLE_CONDITIONS_OF_USE; ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <?php if (DEFINE_SITE_MAP_STATUS <= 1) { ?>
                                                <li>
                                                    <a href="<?php echo zen_href_link(FILENAME_SITE_MAP, '', 'SSL'); ?>">
                                                        <?php echo HEADER_TITLE_SITE_MAP; ?>
                                                    </a>
                                                </li>
                                            <?php } ?>	
                                        </ul>
                                  	</div>
                               	</div>