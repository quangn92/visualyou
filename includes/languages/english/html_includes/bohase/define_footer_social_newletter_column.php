<div class="social-newsletter">
                        	<div class="social-links">
                        		<h3 class="title">CONNECT WITH US</h3>
                                <ul class="social list-inline list-unstyled">
                                    <!--Footer facebook icon-->
				    <?php if($facebook_link != NULL) {?>
                                    <li>
                                        <a href="<?php echo $facebook_link;?>" target="_blank" title="Connect through Facebook">
					    <img border="0" alt="facebook icons" src="includes/templates/bohase/images/icons/social01_fb.gif" width="40px" height="40px">
                               		</a>
                                    </li>
                                    <?php } ?>
				    <!--Footer instagram icon-->
                                    <?php if($instagram_link != NULL) {?>
                                    <li>
                                        <a href="<?php echo $instagram_link;?>/" target="_blank" title="Connect through Instagram">
                                            <img border="0" alt="installgram icon" src="includes/templates/bohase/images/icons/social03_ig.gif" width="40px" height="40px">
                                        </a>
                                    </li>
                                    <?php } ?>
				    <!--Footer tumblr icon-->
                                    <?php if($tumblr_link != NULL) {?>
                                    <li>
                                        <a href="<?php echo $tumblr_link;?>" target="_blank" title="Connect through Tumblr">
                                            <img border="0" alt="tumblr icon" src="includes/templates/bohase/images/icons/social05_tumbler.gif" width="40px" height="40px">
                                        </a>
                                    </li>
                                    <?php } ?>
				    <!--Footer twitter icon-->
                                    <?php if($twitter_link != NULL) {?>
                                    <li>
                                        <a href="<?php echo $twitter_link;?>" target="_blank" title="Connect through Twitter">
                                            <img border="0" alt="twitter icon" src="includes/templates/bohase/images/icons/social02_twitter.gif" width="40px" height="40px">
                                        </a>
                                    </li>
                                    <?php } ?>
				    <!--Footer pinterest icon-->
                                    <?php if($pinterest_link != NULL) {?>
                                    <li>
                                        <a href="<?php echo $pinterest_link;?>" target="_blank" title="Connect through Pinterest">
                                            <img border="0" alt="pinterest icon" src="includes/templates/bohase/images/icons/social04_pinter.gif" width="40px" height="40px">
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>
                         	</div>                          
                            <div class="newsletter">
                            	<div class="input-group">
                                	<!-- Begin MailChimp Signup Form -->
									<?php echo $newsletter_details; ?>
                                    <!--End mc_embed_signup-->
                                </div>
                            </div>
                            <div style="font-size:12px; margin-top: 3px; color: #697175;">
                                <p>Awesomeness in your inbox!  Never miss out on <br> Exclusive news, products & deals! </p>
                            </div>    
                    	</div>
