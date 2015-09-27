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
	<!-- Brands Slider Wrapper Ends -->
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
                                <div class="col-xs-2">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-truck fa-stack-1x fa-inverse"></i>
                                    </span>
                                </div>
                                <div class="col-xs-10">
                                    <h4>FREE DELIVERY</h4>
                                    <h6>On Oder Above $680.00</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 col-md-3">
                        <div class="info-box">
                            <div class="row">
                                <div class="col-xs-2">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-money fa-stack-1x fa-inverse"></i>
                                    </span>
                                </div>
                                <div class="col-xs-10">
                                    <h4>100% Money back</h4>
                                    <h6>30 Day Money Back Guarantee.</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 col-md-3">
                        <div class="info-box">
                            <div class="row">
                                <div class="col-xs-2">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
                                    </span>
                                </div>
                                <div class="col-xs-10">
                                    <h4>CALL TO ORDER</h4>
                                    <h6>Call Phone: 84. 868 868 / 868 888</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 col-md-3">
                        <div class="info-box">
                            <div class="row">
                                <div class="col-xs-2">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-comments fa-stack-1x fa-inverse"></i>
                                    </span>
                                </div>
                                <div class="col-xs-10">
                                    <h4>online support</h4>
                                    <h6>24*7 Free Support</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Info Boxes Container Ends -->
	<?php } ?>