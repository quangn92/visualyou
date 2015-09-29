<?php if($display_brands_slider=="yes") { ?>
	<!-- Brands Slider Wrapper -->
	<div class="logo-slider wow fadeInUp animated">
		<div class="<?php echo $container_class; ?>">
    		<div class="logo-slider-inner">
                <div id="logo-slider" class="owl-carousel owl-theme">
                    <?php 
                        while (!$manufactureimage->EOF) {
                        //print_r($manufactureimage);
                            $manufacturers_image = $manufactureimage->fields['manufacturers_image'];
                            $manufacturers_id = $manufactureimage->fields['manufacturers_id'];
							$manufacturers_name = $manufactureimage->fields['manufacturers_name'];
                    ?>
                    <div class="item">
                        <a class="image" href="<?php echo zen_href_link("index&manufacturers_id=".$manufacturers_id); ?>">
                        	<img src="images/<?php echo $manufacturers_image;?>" alt="brands-image" />
                        </a>
                    </div>
                    <?php $manufactureimage->MoveNext();
                        } ?>
                </div>
			</div>
		</div>
	</div>
    <?php } ?>
    <?php if($display_info_boxes=="yes") { ?>
    <!-- Info Boxes Container -->
    <div class="info-boxes wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
        <div class="<?php echo $container_class; ?>">
            <div class="info-boxes-inner">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12 col-md-3">
                        <div class="info-box">
                            <div class="row">
                            <a href="https://trustlogo.com/ttb_searcher/trustlogo?v_querytype=W&v_shortname=CL1&v_search=http://www.visual-you.com/catalog/&x=6&y=5" target="_blank">
                                <div class="col-xs-2">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-lock fa-stack-1x fa-inverse">
                                        </i>                                     
                                    </span>
                                </div>
                                <div class="col-xs-10">
                                    <h4>SSL SECURED</h4>
                                    <h6>Safe & Secured shopping</h6>
                                </div>
                            </div></a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 col-md-3">
                        <div class="info-box">
                            <div class="row">
                            <a href="https://www.visual-you.com/catalog/shippinginfo.html ">
                                <div class="col-xs-2">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-plane fa-stack-1x fa-inverse"></i>
                                    </span>
                                </div>
                                <div class="col-xs-10">
                                    <h4>WORLDWIDE</h4>
                                    <h6>USPS.com Shipping</h6>
                                </div>
                            </div></a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 col-md-3">
                        <div class="info-box">
                            <div class="row">
                            <a href="https://www.visual-you.com/catalog/visual-you-donates-ezp-32.html">
                                <div class="col-xs-2">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-heart fa-stack-1x fa-inverse"></i>
                                    </span>
                                </div>
                                <div class="col-xs-10">
                                    <h4>Visual You </h4>
                                    <h6>Donates</h6>
                                </div>
                            </div></a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 col-md-3">
                        <div class="info-box">
                            <div class="row">
                            <a href="http://www.bbb.org/losangelessiliconvalley/business-reviews/internet-shopping/visual-you-in-san-jose-ca-1000004593" target="_blank">
                                <div class="col-xs-2">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-fire fa-stack-1x fa-inverse"></i>
                                    </span>
                                </div>
                                <div class="col-xs-10">
                                    <h4>BBB A+ </h4>
                                    <h6>Accredited Business</h6>
                                </div>
                            </div></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Info Boxes Container Ends -->
	<?php } ?>
