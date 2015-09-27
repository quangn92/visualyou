<!-- Banner Container -->
    <?php if($display_top_banners=="yes") { ?>
    <div class="<?php echo $container_class; ?>">
        <div class="wide-banners wow fadeInUp animated">
            <div class="row">
                <?php
					$i=1;					
					while(!$top_banner_query_result->EOF) {
                        $top_banner_image = $top_banner_query_result->fields['top_banner'];
                        $top_banner_caption = $top_banner_query_result->fields['top_banner_caption'];
                ?>
                <?php if($top_banners_style=="1") { ?>
                <div class="<?php if($i==1) { echo $top_banner_class; } else { echo "col-lg-3 col-md-3 col-sm-4 col-xs-12"; } ?>">
                    <div class="wide-banner cnt-strip">
                        <div class="image">
                            <img alt="banner-images" src="<?php echo $template->get_template_dir
                                ('',DIR_WS_TEMPLATE, $current_page_base,'images').'/banners/'.$top_banner_image;?>" />
                        </div>
                        <div class="strip">
                            <?php echo $top_banner_caption; ?>
                        </div>
                    </div>
                </div>
                <?php } elseif($top_banners_style=="2") { ?>
                <div class="<?php echo $top_banner_class; ?>">
                    <div class="wide-banner cnt-strip">
                        <div class="image">
                            <img alt="banner-images" src="<?php echo $template->get_template_dir
                                ('',DIR_WS_TEMPLATE, $current_page_base,'images').'/banners/'.$top_banner_image;?>" />
                        </div>
                        <div class="strip">
                            <?php echo $top_banner_caption; ?>
                        </div>
                    </div>
                </div>
				<?php } ?>
                <?php
					$i++;
                    $top_banner_query_result->MoveNext();
                } 
                ?>
            </div>
        </div>
   	</div>
    <?php } ?>
    <!-- Banner Container Ends -->

<div class="<?php echo $container_class; ?>">
</div>
