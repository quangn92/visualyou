<?php 
/**
 * Bohase - Premium Zencart Template
 *
 * @package Boahse Admin File
 * @author PerfectusThemes
 * @author website www.perfectusinc.com
 * @copyright Copyright 2015-2016 Perfectus Inc.
 * @license http://www.gnu.org/copyleft/gpl.html   GNU Public License V2.0
 * @version $Id: template_settings.php 1.0
 */
 
require('includes/application_top.php');
require(DIR_WS_MODULES . 'prod_cat_header_code.php');	

	$query = "SELECT * from " . TABLE_TEMPLATE_SETTINGS;
			$query_result = $db->Execute($query);
			
			$homepage_layout_result = $query_result->fields['homepage_layout'];
			
			$use_predef_color_result = $query_result->fields['use_predef_color'];
			
			$custom_color_result = $query_result->fields['custom_color'];
			$custom_color_result = (explode(",",$custom_color_result));
			$custom_rgba_color_result = $query_result->fields['custom_rgba_color'];
			
			$predef_color_result = $query_result->fields['predef_color'];
			
			$logo_image_result = $query_result->fields['logo_image'];
			
			$header_style_result = $query_result->fields['header_style'];
			
			$full_width_slideshow_result = $query_result->fields['full_width_slideshow'];
			$slideshow_position_result = $query_result->fields['slideshow_position'];
			
			$display_top_banners_result = $query_result->fields['display_top_banners'];
			$top_banners_style_result = $query_result->fields['top_banners_style'];
			
			$display_bottom_banners_result = $query_result->fields['display_bottom_banners'];
			$bottom_banners_style_result = $query_result->fields['bottom_banners_style'];
			
			$display_category_result = $query_result->fields['display_category'];
			$display_featured_products_result = $query_result->fields['display_featured_products'];
			$display_featured_products_style_result = $query_result->fields['display_featured_products_style'];
			$display_brands_slider_result = $query_result->fields['display_brands_slider'];
			$display_info_boxes_result = $query_result->fields['display_info_boxes'];
			
			$store_address_result = $query_result->fields['store_address'];
			$store_map_result = $query_result->fields['store_map'];
			$store_contact_result = $query_result->fields['store_contact'];
			$store_email_result = $query_result->fields['store_email'];
			$store_copyright_result = $query_result->fields['store_copyright'];
			$store_fax_result = $query_result->fields['store_fax'];
			$store_skype_result = $query_result->fields['store_skype'];
			$newsletter_details_result = $query_result->fields['newsletter_details'];
			
            $facebook_link_result = $query_result->fields['facebook_link'];
            $instagram_link_result = $query_result->fields['instagram_link'];
            $tumblr_link_result = $query_result->fields['tumblr_link'];
			$twitter_link_result = $query_result->fields['twitter_link'];
			$pinterest_link_result = $query_result->fields['pinterest_link'];
			$google_link_result = $query_result->fields['google_link'];
			$youtube_link_result = $query_result->fields['youtube_link'];
			
			$featured_category_result = $query_result->fields['featured_category'];
			
			$payment_image_result = $query_result->fields['payment_image'];
			
			$right_column_banner_caption_result = $query_result->fields['right_column_banner_caption'];
			$right_column_banner_result = $query_result->fields['right_column_banner'];
			$display_right_column_banner_result = $query_result->fields['display_right_column_banner'];
			
			$featured_products_banner_result = $query_result->fields['featured_products_banner'];
			$featured_products_banner_caption_result = $query_result->fields['featured_products_banner_caption'];
			
			$theme_background_image_result = $query_result->fields['theme_background_image'];
			$show_theme_background_result = $query_result->fields['show_theme_background'];
			$theme_bg_color_result = $query_result->fields['theme_bg_color'];
			
	//Insert slideshow details
	if(isset($_POST['add_slideshow'])) {
			$slideshow_image = $_FILES['slideshow_image']['name'];
			$file_tmp =$_FILES['slideshow_image']['tmp_name'];
			$slideshow_caption = trim($_POST['slideshow_caption']);
			if($slideshow_image != NULL) {
				$slideshow_insert = "INSERT INTO " . TABLE_TEMPLATE_SLIDESHOW . " (id, slideshow_image, slideshow_caption) VALUES ('','$slideshow_image','$slideshow_caption')";
				$slideshow_result = $db->Execute($slideshow_insert);
				move_uploaded_file( $file_tmp,"../includes/templates/" . $template_dir . "/images/slideshow/" . $slideshow_image);
			}
	}
	
	//Insert top banners details
	if(isset($_POST['add_top_banner'])) {
			$top_banner = $_FILES['top_banner']['name'];
			$file_tmp =$_FILES['top_banner']['tmp_name'];
			$top_banner_caption = trim($_POST['top_banner_caption']);
			if($top_banner != NULL) {
				$top_banners_insert = "INSERT INTO " . TABLE_TEMPLATE_TOP_BANNER . " (id, top_banner, top_banner_caption) VALUES ('','$top_banner','$top_banner_caption')";
				$top_banners_result = $db->Execute($top_banners_insert);
				move_uploaded_file( $file_tmp,"../includes/templates/" . $template_dir . "/images/banners/" . $top_banner);
			}
	}
	
	//Insert bottom banners details
	if(isset($_POST['add_bottom_banner'])) {
			$bottom_banner = $_FILES['bottom_banner']['name'];
			$file_tmp =$_FILES['bottom_banner']['tmp_name'];
			$bottom_banner_caption = trim($_POST['bottom_banner_caption']);
			if($bottom_banner != NULL) {
				$bottom_banners_insert = "INSERT INTO " . TABLE_TEMPLATE_BOTTOM_BANNER . " (id, bottom_banner, bottom_banner_caption) VALUES ('','$bottom_banner','$bottom_banner_caption')";
				$bottom_banners_result = $db->Execute($bottom_banners_insert);
				move_uploaded_file( $file_tmp,"../includes/templates/" . $template_dir . "/images/banners/" . $bottom_banner);
			}
	}
	
	if(! isset($_POST['template_settings']))
	{
		$homepage_layout = $homepage_layout_result;
		
		$custom_color = $custom_color_result;
		$custom_rgba_color = $custom_rgba_color_result;
		$predef_color = $predef_color_result;
		$use_predef_color = $use_predef_color_result;
		
		$logo_image = $logo_image_result;
		
		$header_style = $header_style_result;
		
		$full_width_slideshow = $full_width_slideshow_result;
		$slideshow_position = $slideshow_position_result;
		
		$display_top_banners = $display_top_banners_result;
		$top_banners_style = $top_banners_style_result;
		
		$display_bottom_banners = $display_bottom_banners_result;
		$bottom_banners_style = $bottom_banners_style_result;

		$display_category = $display_category_result;
		$display_featured_products = $display_featured_products_result;
		$display_featured_products_style = $display_featured_products_style_result;
		$display_brands_slider = $display_brands_slider_result;
		$display_info_boxes = $display_info_boxes_result;
		
		$store_address = $store_address_result;
		$store_map = $store_map_result;
		$store_contact = $store_contact_result;
		$store_email = $store_email_result;
		$store_copyright = $store_copyright_result;
		$store_fax = $store_fax_result;
		$store_skype = $store_skype_result;
		$newsletter_details = $newsletter_details_result;
		
        $facebook_link = $facebook_link_result;
		$instagram_link = $instagram_link_result;
        $tumblr_link = $tumblr_link_result;
		$twitter_link = $twitter_link_result;
		$pinterest_link = $pinterest_link_result;
		$google_link = $google_link_result;
		$youtube_link = $youtube_link_result;
		
		$featured_category = $featured_category_result;
		
		$payment_image = $payment_image_result;
		
		$featured_products_banner = $featured_products_banner_result;
		$featured_products_banner_caption = $featured_products_banner_caption_result;
		
		$right_column_banner = $right_column_banner_result;
		$right_column_banner_caption = $right_column_banner_caption_result;
		$display_right_column_banner = $display_right_column_banner_result;
		
		$theme_background_image = $theme_background_image_result;
		$show_theme_background = $show_theme_background_result;
		$theme_bg_color = $theme_bg_color_result;
	}
	
	if(isset($_POST['template_settings']))
	{
		header('Location: '.$_SERVER['PHP_SELF']); /* Important */
		
		$use_predef_color = $_POST['use_predef_color'];
		
		$custom_color = zen_db_prepare_input($_POST['custom_color']) . ',' . zen_db_prepare_input($_POST['custom_color_hover']);
		$custom_color = trim($custom_color);
		if($custom_color == NULL){
			$custom_color = $custom_color_result;	
		}
		
		$custom_rgba_color = zen_db_prepare_input($_POST['custom_rgba_color']);
		$custom_rgba_color = trim($custom_rgba_color);
		if($custom_rgba_color == NULL){
			$custom_rgba_color = $custom_rgba_color_result;	
		}
		
		$predef_color = zen_db_prepare_input($_POST['predef_color']);
		$predef_color = trim($predef_color);
		if($predef_color == NULL){
			$predef_color = $predef_color_result;	
		}
		
		$logo_image = $_FILES["file_logoimage"]["name"];
		if($logo_image == NULL){
			$logo_image = $logo_image_result;
		}
		
		$homepage_layout = zen_db_prepare_input($_POST['homepage_layout']);
		$display_featured_products_style = zen_db_prepare_input($_POST['display_style']);
		
		if($homepage_layout=='homepage_layout_3') {
			$update_query_1 = "UPDATE " . DB_PREFIX.configuration. " set configuration_value='3' where configuration_key='SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS'";
			$update_query_result_1 = $db->Execute($update_query_1);
			
			$update_query_2 = "UPDATE " . DB_PREFIX.configuration. " set configuration_value='6' where configuration_key='MAX_DISPLAY_SEARCH_RESULTS_FEATURED'";
			$update_query_result_2 = $db->Execute($update_query_2);
		}
		elseif($homepage_layout=='homepage_layout_4' || $homepage_layout=='homepage_layout_5'){
			$update_query_2 = "UPDATE " . DB_PREFIX.configuration. " set configuration_value='3' where configuration_key='SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS'";
			$update_query_result_2 = $db->Execute($update_query_2);
			
			$update_query_2 = "UPDATE " . DB_PREFIX.configuration. " set configuration_value='6' where configuration_key='MAX_DISPLAY_SEARCH_RESULTS_FEATURED'";
			$update_query_result_2 = $db->Execute($update_query_2);
		}
		elseif($display_featured_products_style=='display_style_1') {
			$update_query_3 = "UPDATE " . DB_PREFIX.configuration. " set configuration_value='3' where configuration_key='SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS'";
			$update_query_result_3 = $db->Execute($update_query_3);
			
			$update_query_4 = "UPDATE " . DB_PREFIX.configuration. " set configuration_value='6' where configuration_key='MAX_DISPLAY_SEARCH_RESULTS_FEATURED'";
			$update_query_result_4 = $db->Execute($update_query_4);
		}
		else {
			$update_query_else_1 = "UPDATE " . DB_PREFIX.configuration. " set configuration_value='4' where configuration_key='SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS'";
			$update_query_else_result_1 = $db->Execute($update_query_else_1);
			
			$update_query_else_2 = "UPDATE " . DB_PREFIX.configuration. " set configuration_value='8' where configuration_key='MAX_DISPLAY_SEARCH_RESULTS_FEATURED'";
			$update_query_else_result_2 = $db->Execute($update_query_else_2);
		}
		
		$header_style = zen_db_prepare_input($_POST['header_style']);
		
		$full_width_slideshow = zen_db_prepare_input($_POST['full_width_slideshow']);
		$slideshow_position = zen_db_prepare_input($_POST['slideshow_position']);
		
		
		if($full_width_slideshow=='medium' || $full_width_slideshow=='small') {
			$mainpage_query_1 = "UPDATE " . DB_PREFIX.configuration. " set configuration_value='0' where configuration_key='DEFINE_MAIN_PAGE_STATUS'";
			$mainpage_query__result_1 = $db->Execute($mainpage_query_1);			
		}
		else {
			$mainpage_query_1 = "UPDATE " . DB_PREFIX.configuration. " set configuration_value='1' where configuration_key='DEFINE_MAIN_PAGE_STATUS'";
			$mainpage_query__result_1 = $db->Execute($mainpage_query_1);
		}
		
		
		$display_top_banners = zen_db_prepare_input($_POST['display_top_banners']);
		$top_banners_style = zen_db_prepare_input($_POST['top_banners_style']);
		
		$display_bottom_banners = zen_db_prepare_input($_POST['display_bottom_banners']);
		$bottom_banners_style = zen_db_prepare_input($_POST['bottom_banners_style']);
		
		$display_category = zen_db_prepare_input($_POST['display_category']);
		$display_featured_products = zen_db_prepare_input($_POST['display_featured_products']);
		$display_brands_slider = zen_db_prepare_input($_POST['display_brands_slider']);
		$display_info_boxes = zen_db_prepare_input($_POST['display_info_boxes']);
		
		
		$featured_category = zen_db_prepare_input($_POST['featured_category']);
		
		$store_address = trim(zen_db_prepare_input($_POST['store_address']));
		$store_map = trim(zen_db_prepare_input($_POST['store_map']));
		$store_contact = trim(zen_db_prepare_input($_POST['store_contact']));
		$store_email = trim(zen_db_prepare_input($_POST['store_email']));
		$store_copyright = trim(zen_db_prepare_input($_POST['store_copyright']));
		$store_fax = trim(zen_db_prepare_input($_POST['store_fax']));
		$store_skype = trim(zen_db_prepare_input($_POST['store_skype']));
		$newsletter_details = trim(zen_db_prepare_input($_POST['newsletter_details']));
		
        $facebook_link = trim(zen_db_prepare_input($_POST['facebook_link']));
		$instagram_link = trim(zen_db_prepare_input($_POST['instagram_link']));
		$tumblr_link = trim(zen_db_prepare_input($_POST['tumblr_link']));
		$twitter_link = trim(zen_db_prepare_input($_POST['twitter_link']));
		$pinterest_link = trim(zen_db_prepare_input($_POST['pinterest_link']));
		$google_link = trim(zen_db_prepare_input($_POST['google_link']));
		$youtube_link = trim(zen_db_prepare_input($_POST['youtube_link']));
		
		$payment_image = $_FILES["payment_image"]["name"];
		if($payment_image == NULL){
			$payment_image = $payment_image_result;
		}
		
		$featured_products_banner = $_FILES["featured_products_banner"]["name"];
		if($featured_products_banner == NULL) {
			$featured_products_banner = $featured_products_banner_result;
		}
		
		$featured_products_banner_caption = trim($_POST['featured_products_banner_caption']);
		
		$right_column_banner = $_FILES["right_column_banner"]["name"];
		if($right_column_banner == NULL){
			$right_column_banner = $right_column_banner_result;
		}
		
		$right_column_banner_caption = trim(zen_db_prepare_input($_POST['right_column_banner_caption']));
		$display_right_column_banner = zen_db_prepare_input($_POST['display_right_column_banner']);
		
		$theme_background_image = $_FILES["theme_background_image"]["name"];
		if($theme_background_image == NULL){
			$theme_background_image = $theme_background_image_result;
		}
		
		$show_theme_background = zen_db_prepare_input($_POST['show_theme_background']);
		$theme_bg_color = zen_db_prepare_input($_POST['theme_bg_color']);
		
        $template_query = "UPDATE " . TABLE_TEMPLATE_SETTINGS. " SET homepage_layout='$homepage_layout', theme_background_image='$theme_background_image', show_theme_background='$show_theme_background', theme_bg_color='$theme_bg_color', predef_color='$predef_color', custom_color='$custom_color', custom_rgba_color='$custom_rgba_color', use_predef_color='$use_predef_color', logo_image='$logo_image', full_width_slideshow='$full_width_slideshow', slideshow_position='$slideshow_position', display_top_banners='$display_top_banners', top_banners_style='$top_banners_style', display_bottom_banners='$display_bottom_banners', bottom_banners_style='$bottom_banners_style', header_style='$header_style', display_category='$display_category', display_featured_products='$display_featured_products', display_featured_products_style='$display_featured_products_style', store_address='$store_address', store_fax='$store_fax', store_skype='$store_skype', store_map='$store_map', newsletter_details='$newsletter_details', store_contact='$store_contact', store_email='$store_email', store_copyright='$store_copyright', facebook_link='$facebook_link', twitter_link='$twitter_link',
instagram_link='$instagram_link', tumblr_link='$tumblr_link', pinterest_link='$pinterest_link', google_link='$google_link', youtube_link='$youtube_link', payment_image='$payment_image', featured_category='$featured_category', featured_products_banner='$featured_products_banner', featured_products_banner_caption='$featured_products_banner_caption', display_brands_slider='$display_brands_slider', display_info_boxes='$display_info_boxes', right_column_banner='$right_column_banner', right_column_banner_caption='$right_column_banner_caption', display_right_column_banner='$display_right_column_banner' WHERE id=1";
		
		$template_result = $db->Execute($template_query);
		
		
		//Delete selected Slideshow details
		foreach((array)$_POST['slideshow_image_id'] as $key => $del_id ) {
			if(isset($_POST['slideshow_image_id'])){
				$checkboxAll = zen_db_prepare_input($_POST['slideshow_image_id']);
				$slideshow_image_delete = "DELETE FROM " . TABLE_TEMPLATE_SLIDESHOW . " where id='$del_id'";
				$slideshow_delete_result = $db->Execute($slideshow_image_delete);
			}
		}
		
		//Delete selected Top Banner details
		foreach((array)$_POST['top_banner_image_id'] as $key => $del_id ) {
			if(isset($_POST['top_banner_image_id'])){
				$checkboxAll = zen_db_prepare_input($_POST['top_banner_image_id']);
				$top_banner_image_delete = "DELETE FROM " . TABLE_TEMPLATE_TOP_BANNER . " where id='$del_id'";
				$top_banner_delete_result = $db->Execute($top_banner_image_delete);
			}
		}
		
		//Delete selected Bottom Banner details
		foreach((array)$_POST['bottom_banner_image_id'] as $key => $del_id ) {
			if(isset($_POST['bottom_banner_image_id'])){
				$checkboxAll = zen_db_prepare_input($_POST['bottom_banner_image_id']);
				$bottom_banner_image_delete = "DELETE FROM " . TABLE_TEMPLATE_BOTTOM_BANNER . " where id='$del_id'";
				$bottom_banner_delete_result = $db->Execute($bottom_banner_image_delete);
			}
		}
		
		//Update selected Slideshow details
		$k=0;
		if(isset($_POST['slideshow_caption_edit'][$k]) || isset($_POST['slideshow_image_update'][$k])) {
			foreach((array)$_POST['slideshow_image_id_update'] as $k => $update_id) {
				$slideshow_caption_edit = trim(zen_db_prepare_input($_POST['slideshow_caption_edit'][$k]));
				$slideshow_image_update = $_FILES['slideshow_image_update']['name'][$k];
				$file_tmp_update =$_FILES['slideshow_image_update']['tmp_name'][$k];
				
				//if(($slideshow_caption_edit != NULL)) {
				if(isset($_POST['slideshow_caption_edit'][$k])) {
					$slideshow_update = "UPDATE " . TABLE_TEMPLATE_SLIDESHOW . " SET slideshow_caption='$slideshow_caption_edit' where id='$update_id'";
					$slideshow_update_result = $db->Execute($slideshow_update);
				}
				
				if(($slideshow_image_update != NULL)) {
				/* process for old file remove */
				$template_result = $db->Execute("SELECT slideshow_image FROM " . TABLE_TEMPLATE_SLIDESHOW . " where id='$update_id'");
				$template_result_img=$template_result->fields['slideshow_image'];
				if(file_exists("../includes/templates/" . $template_dir . "/images/slideshow/" . $template_result_img))
				{
				   unlink("../includes/templates/" . $template_dir . "/images/slideshow/" . $template_result_img);
				}
				/* eof  process for old file remove */
				
				$slideshow_update = "UPDATE " . TABLE_TEMPLATE_SLIDESHOW . " SET slideshow_image='$slideshow_image_update' where id='$update_id'";
				$slideshow_update_result = $db->Execute($slideshow_update);
				move_uploaded_file($file_tmp_update,"../includes/templates/" . $template_dir . "/images/slideshow/" . $slideshow_image_update);
				}
			}
			$k++;
		}
		
		
		//Update selected top banner details
		$k=0;
		if(isset($_POST['top_banner_caption_edit'][$k]) || isset($_POST['top_banner_image_update'][$k])) {
			foreach((array)$_POST['top_banner_image_id_update'] as $k => $update_id) {
				$top_banner_caption_edit = trim(zen_db_prepare_input($_POST['top_banner_caption_edit'][$k]));
				$top_banner_image_update = $_FILES['top_banner_image_update']['name'][$k];
				$file_tmp_update = $_FILES['top_banner_image_update']['tmp_name'][$k];
				
				if(isset($_POST['top_banner_caption_edit'][$k])) {
					$top_banner_update = "UPDATE " . TABLE_TEMPLATE_TOP_BANNER . " SET top_banner_caption='$top_banner_caption_edit' where id='$update_id'";
					$top_banner_update_result = $db->Execute($top_banner_update);
				}
				
				if(($top_banner_image_update != NULL)) {
				/* process for old file remove */
				$template_top_banner_result = $db->Execute("SELECT top_banner FROM " . TABLE_TEMPLATE_TOP_BANNER . " where id='$update_id'");
				$template_top_banner_result_img=$template_top_banner_result->fields['top_banner'];
				if(file_exists("../includes/templates/" . $template_dir . "/images/banners/" . $template_top_banner_result_img))
				{
				   unlink("../includes/templates/" . $template_dir . "/images/banners/" . $template_top_banner_result_img);
				}
				/* eof  process for old file remove */
				
				$top_banner_update = "UPDATE " . TABLE_TEMPLATE_TOP_BANNER . " SET top_banner='$top_banner_image_update' where id='$update_id'";
				$top_banner_update_result = $db->Execute($top_banner_update);
				move_uploaded_file($file_tmp_update,"../includes/templates/" . $template_dir . "/images/banners/" . $top_banner_image_update);
				}
			}
			$k++;
		}
		
		//Update selected bottom banner details
		$k=0;
		if(isset($_POST['bottom_banner_caption_edit'][$k]) || isset($_POST['bottom_banner_image_update'][$k])) {
			foreach((array)$_POST['bottom_banner_image_id_update'] as $k => $update_id) {
				$bottom_banner_caption_edit = trim(zen_db_prepare_input($_POST['bottom_banner_caption_edit'][$k]));
				$bottom_banner_image_update = $_FILES['bottom_banner_image_update']['name'][$k];
				$file_tmp_update = $_FILES['bottom_banner_image_update']['tmp_name'][$k];
				
				if(isset($_POST['bottom_banner_caption_edit'][$k])) {
					$bottom_banner_update = "UPDATE " . TABLE_TEMPLATE_BOTTOM_BANNER . " SET bottom_banner_caption='$bottom_banner_caption_edit' where id='$update_id'";
					$bottom_banner_update_result = $db->Execute($bottom_banner_update);
				}
				
				if(($bottom_banner_image_update != NULL)) {
				/* process for old file remove */
				$template_bottom_banner_result = $db->Execute("SELECT bottom_banner FROM " . TABLE_TEMPLATE_BOTTOM_BANNER . " where id='$update_id'");
				$template_bottom_banner_result_img=$template_bottom_banner_result->fields['bottom_banner'];
				if(file_exists("../includes/templates/" . $template_dir . "/images/banners/" . $template_bottom_banner_result_img))
				{
				   unlink("../includes/templates/" . $template_dir . "/images/banners/" . $template_bottom_banner_result_img);
				}
				/* eof  process for old file remove */
				
				$bottom_banner_update = "UPDATE " . TABLE_TEMPLATE_BOTTOM_BANNER . " SET bottom_banner='$bottom_banner_image_update' where id='$update_id'";
				$bottom_banner_update_result = $db->Execute($bottom_banner_update);
				move_uploaded_file($file_tmp_update,"../includes/templates/" . $template_dir . "/images/banners/" . $bottom_banner_image_update);
				}
			}
			$k++;
		}
		
		
		move_uploaded_file($_FILES["file_logoimage"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/logo/" . $_FILES["file_logoimage"]["name"]);
		
		move_uploaded_file($_FILES["payment_image"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/banners/" . $_FILES["payment_image"]["name"]);
		
		move_uploaded_file($_FILES["theme_background_image"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/bgpatterns/" . $_FILES["theme_background_image"]["name"]);

		move_uploaded_file($_FILES["featured_products_banner"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/banners/" . $_FILES["featured_products_banner"]["name"]);
	}
	
?>


<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>

<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="../includes/templates/<?php echo $template_dir; ?>/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../includes/templates/<?php echo $template_dir; ?>/css/templatecss.css">
<!--<link rel="stylesheet" type="text/css" href="../includes/templates/<?php //echo $template_dir; ?>/css/mcColorPicker.css">-->
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,900,300,100' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,500,600,700,900' rel='stylesheet' type='text/css'>
<style type="text/css">
h4.accordian-header, h3.product_head_admin{
	color: #666666;
	text-transform:uppercase;
	letter-spacing:1px;
}
.accordian-content .row {
    margin-bottom: 20px;
    margin-top: 20px;
}
h4.accordian-header.active{
	font-weight:bold;
}
input[type="submit"] {
	color: #FFFFFF;
	border: none;	
	background: #379adc;
}
input[type="submit"]:hover{
	background-color: #1e71a9;
	transition: all 0.3s ease-in 0s;
		-moz-transition: all 0.3s ease-in 0s;
		-webkit-transition: all 0.3s ease-in 0s;
		-o-transition: all 0.3s ease-in 0s;
		-ms-transition: all 0.3s ease-in 0s;
	color: #FFFFFF;	
}
</style>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
<script src="../includes/templates/<?php echo $template_dir; ?>/jscript/mcColorPicker.js" type="text/javascript"></script>
<script type="text/javascript">
 var acc = jQuery.noConflict();
acc(document).ready(function(){

//Set default open/close settings
acc('.accordian-content').hide(); //Hide/close all containers
acc('.accordian-header:first').addClass('active').next().show(); //Add "active" class to first trigger, then show/open the immediate next container

//On Click
acc('.accordian-header').click(function(){
if( acc(this).next().is(':hidden') ) { //If immediate next container is closed...
acc('.accordian-header').removeClass('active').next().slideUp(); //Remove all .accordian-header classes and slide up the immediate next container
acc(this).toggleClass('active').next().slideDown(); //Add .accordian-header class to clicked trigger and slide down the immediate next container
}
return false; //Prevent the browser jump to the link anchor
});

});
</script>
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
	function init()
	{
		cssjsmenu('navbar');
		if (document.getElementById)
		{
		  var kill = document.getElementById('hoverJS');
		  kill.disabled = true;
		}
		if (typeof _editor_url == "string")
		{
			HTMLArea.replaceAll();
		}
	}
  // -->
</script>
<?php if ($editor_handler != '') include ($editor_handler); ?>
</head>

<!-- body //-->
<body onLoad="init()">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<div id="maincontent-wrapper" class="template_admin">
	<div class="container">
    	<div class="msadmin_options">
            <div class="product_info_accordian row">
            	<h3 class="product_head_admin">Template Settings</h3>
				<form name="template_settings" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                
                <div class="homepage_layout">
                	<h4 class="accordian-header">HomePage Layout : </h4>
                    <div class="accordian-content">
                    	<p>
        					<label for="homepage_layout" style="vertical-align:middle">Select the Homepage Layout : </label>
							<input type="radio" name="homepage_layout" value="homepage_layout_1" <?php if($homepage_layout=="homepage_layout_1"){echo "checked";} ?>/>
                            	&nbsp; Homepage - 1  &nbsp; &nbsp;
							<input type="radio" name="homepage_layout" value="homepage_layout_2" <?php if($homepage_layout=="homepage_layout_2"){echo "checked";} ?>/>
                            	&nbsp; Homepage - 2  &nbsp; &nbsp;
							<input type="radio" name="homepage_layout" value="homepage_layout_3" <?php if($homepage_layout=="homepage_layout_3"){echo "checked";} ?>/>
                            	&nbsp; Homepage - 3  &nbsp; &nbsp;<br/>
							<input type="radio" name="homepage_layout" value="homepage_layout_4" <?php if($homepage_layout=="homepage_layout_4"){echo "checked";} ?>/>
                            	&nbsp; Homepage - 4  &nbsp; &nbsp;
							<input type="radio" name="homepage_layout" value="homepage_layout_5" <?php if($homepage_layout=="homepage_layout_5"){echo "checked";} ?>/>
                            	&nbsp; Homepage - 5  &nbsp; &nbsp;
							<input type="radio" name="homepage_layout" value="homepage_layout_6" <?php if($homepage_layout=="homepage_layout_6"){echo "checked";} ?>/>
                            	&nbsp; Homepage - 6
        				</p>
                 	</div>
              	</div>
                
				<div class="theme_background">
                	<h4 class="accordian-header">Theme Background For Boxed Layout (Homepage - 6): </h4>
                    <div class="accordian-content">
                    	<p>
        					<label for="show_theme_background" style="vertical-align:middle">Theme Background Pattern : </label>
							<input type="radio" name="show_theme_background" value="yes" <?php if($show_theme_background=="yes"){echo "checked";} ?>/>
                            	&nbsp; Yes  &nbsp; &nbsp;
							<input type="radio" name="show_theme_background" value="no" <?php if($show_theme_background=="no"){echo "checked";} ?>/>
                            	&nbsp; No
        				</p>
                    	<p>
                        	<label for="theme_background_image">Select Theme Background Pattern :</label>
                            <input type="file" size="30" name="theme_background_image" id="file" value="<?php echo $theme_background_image; ?>"/>
                        </p>
                        <p>
                        	<?php if($theme_background_image != NULL) { 
							echo "<label style='vertical-align:top'>Current Image : </label>";?> 
                            <img height="auto" width="100px" 
                            	src="../includes/templates/<?php echo $template_dir; ?>/images/bgpatterns/<?php echo $theme_background_image; ?>"/>
							<?php } ?>
                        </p>
                        <p>
                            <label for="theme_bg_color">Theme Background Color :</label>
                            <input type="text" class="color" size="60" name="theme_bg_color" value="<?php echo $theme_bg_color; ?>" /> 
                            <span class="admin-text" style="color:#FF4444"></span>
						</p>
                	</div>
                </div>
                
                <div class="bg_color_setting">
					<h4 class="accordian-header">Choose your Theme Color :</h4>
					<div class="accordian-content">
                    	<p>
                            <label for="color">Select from Predefined Theme Color :</label>
                            <input type="radio" name="use_predef_color" value="yes" <?php if($use_predef_color=="yes"){echo "checked";} ?>/>
                            	&nbsp; Yes  &nbsp; &nbsp;
							<input type="radio" name="use_predef_color" value="no" <?php if($use_predef_color=="no"){echo "checked";} ?>/>
                            	&nbsp; No &nbsp; &nbsp;
                            <select id="predef-color" name="predef_color">
                            	<option value="">Select Theme Color</option>
                            	<option name="color" value="#379adc" <?php if($predef_color=="#379adc") { ?>selected<?php } ?>>Blue
                                </option>
                                <option name="color" value="#12cca7" <?php if($predef_color=="#12cca7") { ?>selected="selected"<?php } ?>>Green
                                </option>
                                <option name="color" value="#34495e" <?php if($predef_color=="#34495e") { ?>selected="selected"<?php } ?>>Navy
                                </option>
                                <option name="color" value="#f27a24" <?php if($predef_color=="#f27a24") { ?>selected="selected"<?php } ?>>Orange
                                </option>
                                <option name="color" value="#f55c59" <?php if($predef_color=="#f55c59") { ?>selected="selected"<?php } ?>>Red
                                </option>
                            </select>
                            <span class="admin-text" style="color:#FF4444"><br/><br/>If you don't want to use the predefined theme color, please select "No" above and enter your choice of Color code in the following text box.</span><br/><br/>
						</p>
                        <p>
                            <label for="color">Theme Color :</label>
                            <input type="text" class="color" size="60" name="custom_color" value="<?php echo $custom_color[0]; ?>" /> 
                            <span class="admin-text" style="color:#FF4444"></span>
						</p>
                        <p>
                            <label for="color">Theme Color on Hover :</label>
                            <input type="text" class="color" size="60" name="custom_color_hover" value="<?php echo $custom_color[1]; ?>" /> 
                            <span class="admin-text" style="color:#FF4444"></span>
						</p>
                        <p>
                            <label for="color">RGBA Color Code for button transparency :</label>
                            <input type="text" class="color" size="60" name="custom_rgba_color" value="<?php echo $custom_rgba_color; ?>" /> 
                            <span class="admin-text" style="color:#FF4444"><br/>To get RGBA Code of your desired theme color, <a href="http://hex2rgba.devoth.com/" target="_blank">click here</a></span>
						</p>
                    </div>
               	</div>
				<div class="logo_setting">
					<h4 class="accordian-header">Store Logo :</h4>
            		<div class="accordian-content">
                    	<p>
        					<label for="file_logoimage" style="vertical-align:middle">Select Logo :</label>
							<input type="file" size="30" name="file_logoimage" id="file" value="<?php echo $logo_image; ?>"/><br/><br/> 
							<?php if($logo_image != NULL) { 
								echo "<label style='vertical-align:top'>Current Image : </label>";?> 
                                <img height="auto" width="200px" src="../includes/templates/<?php echo $template_dir; ?>/images/logo/<?php echo $logo_image; ?>"/>
							<?php }?>
        				</p>
    				</div>
              	</div>
                <div class="header_style">
					<h4 class="accordian-header">Header Style :</h4>
            		<div class="accordian-content">
                    	<p>
        					<label for="header_style" style="vertical-align:middle">Select the Header of your Choice : </label>
							<input type="radio" name="header_style" value="header_style_1" <?php if($header_style=="header_style_1"){echo "checked";} ?>/>
                            	&nbsp; Header Style - 1  &nbsp; &nbsp;
							<input type="radio" name="header_style" value="header_style_2" <?php if($header_style=="header_style_2"){echo "checked";} ?>/>
                            	&nbsp; Header Style - 2  &nbsp; &nbsp;
							<input type="radio" name="header_style" value="header_style_3" <?php if($header_style=="header_style_3"){echo "checked";} ?>/>
                            	&nbsp; Header Style - 3
        				</p>
    				</div>
              	</div>
                <div class="slideshow">
                	<h4 class="accordian-header">Slideshow Customization :</h4>
                    <div class="accordian-content">
                    	<p>
        					<label for="full_width_slideshow" style="vertical-align:middle">Select Size of Slideshow : </label>
							<input type="radio" name="full_width_slideshow" value="full_width" <?php if($full_width_slideshow=="full_width"){echo "checked";} ?>/>
                            	&nbsp; Full Width  &nbsp; &nbsp;
                            <input type="radio" name="full_width_slideshow" value="large" <?php if($full_width_slideshow=="large"){echo "checked";} ?>/>
                            	&nbsp; Large  &nbsp; &nbsp;
                                
							<input type="radio" name="full_width_slideshow" value="medium" <?php if($full_width_slideshow=="medium"){echo "checked";} ?>/>
                            	&nbsp; Medium  &nbsp; &nbsp;
                                
							<input type="radio" name="full_width_slideshow" value="small" <?php if($full_width_slideshow=="small"){echo "checked";} ?>/>
                            	&nbsp; Small
        				</p>
                        <p>
        					<label for="slideshow_position" style="vertical-align:middle">Select Position of Slideshow (For Small Size Only) : </label>
							<input type="radio" name="slideshow_position" value="left" <?php if($slideshow_position=="left"){echo "checked";} ?>/>
                            	&nbsp; Left  &nbsp; &nbsp;
                            <input type="radio" name="slideshow_position" value="center" <?php if($slideshow_position=="center"){echo "checked";} ?>/>
                            	&nbsp; Center  &nbsp; &nbsp;
                                
							<input type="radio" name="slideshow_position" value="right" <?php if($slideshow_position=="right"){echo "checked";} ?>/>
                            	&nbsp; Right
        				</p>
                    	<p>
                        	<label for="slideshow_image">Add Slideshow Image:</label>
                            <input type="file" name="slideshow_image" id="file" />
                        </p>
                        <p>
                        	<label for="slideshow_caption">Add Slideshow Captions :</label>
                            <span class="admin-text" style="color:#FF4444">
                            </span>
                            <textarea rows="4" cols="3" name="slideshow_caption" style="width:30%;"></textarea>
                        </p>
                        <p>
                        	<input type="submit" name="add_slideshow" value="Add Slideshow" />
                        </p>
                	</div>
              	</div>
              	<div class="slideshow">
                	<h4 class="accordian-header">Delete/Edit Slideshow Details :</h4>
                   	<div class="accordian-content">
                       	Current Slideshow Images: 
                    	<span class="admin-text" style="color:#FF4444">
                        	&nbsp; &nbsp; Select Image from below to Delete it.
                      	</span>
                        <br/> <br/>
                        <?php 
							$slideshow_query = "SELECT * from " . TABLE_TEMPLATE_SLIDESHOW;
							$slideshow_query_result = $db->Execute($slideshow_query);
							$i=0;
							while(!$slideshow_query_result->EOF) {
								
								$slideshow_image_name = $slideshow_query_result->fields['slideshow_image'];
								$slideshow_image_id = $slideshow_query_result->fields['id'];
								$slideshow_image_id_update=$slideshow_image_id;
								$slideshow_caption_added = trim($slideshow_query_result->fields['slideshow_caption']);
						?>
                        <div class="row">
                            <div class="slideshow_image">
                                <div class="col-lg-1">
                                    <input type="checkbox" name="slideshow_image_id[]" value="<?php echo $slideshow_image_id; ?>" />
                                    <label for="slideshow_delete">Delete</label>&nbsp;
                                </div>
                                <div class="col-lg-3">
                                    <input type="hidden" name="slideshow_image_id_update[]" value="<?php echo $slideshow_image_id_update; ?>"/>
                                    <label for="slideshow_image_update">Slideshow Image:</label>
                            		<input type="file" name="slideshow_image_update[<?php echo $i; ?>]" id="file" value="<?php echo $slideshow_image_id_update; ?>"/>
                                </div>
                                <div class="col-lg-3">
                                    <img height="auto" width="120px" src="../includes/templates/<?php echo $template_dir; ?>/images/slideshow/<?php echo $slideshow_image_name; ?>"/>
                                </div>
                                <div class="col-lg-5">
                                    <textarea rows="4" cols="3" name="slideshow_caption_edit[<?php echo $i; ?>]" value="<?php echo $slideshow_image_id_update; ?>"><?php echo $slideshow_caption_added; ?></textarea>
                                </div>
                            </div>
						</div>
                        <?php $i++; $slideshow_query_result->MoveNext(); } ?>
                	</div>
                </div>
                
                <div class="top_banners">
                	<h4 class="accordian-header">Top Banners Customization :</h4>
                    <div class="accordian-content">
                    	<p>
        					<label for="display_top_banners" style="vertical-align:middle">Display Top Banners : </label>
							<input type="radio" name="display_top_banners" value="yes" <?php if($display_top_banners=="yes"){echo "checked";} ?>/>
                            	&nbsp; Yes  &nbsp; &nbsp;
							<input type="radio" name="display_top_banners" value="no" <?php if($display_top_banners=="no"){echo "checked";} ?>/>
                            	&nbsp; No
        				</p>
                        <p>
        					<label for="top_banners_style" style="vertical-align:middle">Display Top Banners Layout: </label>
							<input type="radio" name="top_banners_style" value="1" <?php if($top_banners_style=="1"){echo "checked";} ?>/>
                            	&nbsp; Layout - 1  &nbsp; &nbsp;
							<input type="radio" name="top_banners_style" value="2" <?php if($top_banners_style=="2"){echo "checked";} ?>/>
                            	&nbsp; Layout - 2
        				</p>
                    	<p>
                        	<label for="top_banner">Add Banner:</label>
                            <input type="file" name="top_banner" id="file" />
                        </p>
                        <p>
                        	<label for="top_banner_caption">Add Banner Captions :</label>
                            <span class="admin-text" style="color:#FF4444">
                            </span>
                            <textarea rows="4" cols="3" name="top_banner_caption" style="width:30%;"></textarea>
                        </p>
                        <p>
                        	<input type="submit" name="add_top_banner" value="Add Banner" />
                        </p>
                	</div>
              	</div>
                
                <div class="top_banners">
                	<h4 class="accordian-header">Delete/Edit Top Banner Details :</h4>
                   	<div class="accordian-content">
                       	Current Banners: 
                    	<span class="admin-text" style="color:#FF4444">
                        	&nbsp; &nbsp; Select Image from below to Delete it.
                      	</span>
                        <br/> <br/>
                        <?php 
							$top_banner_query = "SELECT * from " . TABLE_TEMPLATE_TOP_BANNER;
							$top_banner_query_result = $db->Execute($top_banner_query);
							$i=0;
							while(!$top_banner_query_result->EOF) {
								
								$top_banner_image_name = $top_banner_query_result->fields['top_banner'];
								$top_banner_image_id = $top_banner_query_result->fields['id'];
								$top_banner_image_id_update=$top_banner_image_id;
								$top_banner_caption_added = trim($top_banner_query_result->fields['top_banner_caption']);
						?>
                        <div class="row">
                            <div class="top_banner">
                                <div class="col-lg-1">
                                    <input type="checkbox" name="top_banner_image_id[]" value="<?php echo $top_banner_image_id; ?>" />
                                    <label for="top_banner_delete">Delete</label>&nbsp;
                                </div>
                                <div class="col-lg-3">
                                    <input type="hidden" name="top_banner_image_id_update[]" value="<?php echo $top_banner_image_id_update; ?>"/>
                                    <label for="top_banner_image_update">Banner:</label>
                            		<input type="file" name="top_banner_image_update[<?php echo $i; ?>]" id="file" value="<?php echo $top_banner_image_update; ?>"/>
                                </div>
                                <div class="col-lg-3">
                                    <img height="auto" width="120px" src="../includes/templates/<?php echo $template_dir; ?>/images/banners/<?php echo $top_banner_image_name; ?>"/>
                                </div>
                                <div class="col-lg-5">
                                    <textarea rows="4" cols="3" name="top_banner_caption_edit[<?php echo $i; ?>]" value="<?php echo $top_banner_image_id_update; ?>"><?php echo $top_banner_caption_added; ?></textarea>
                                </div>
                            </div>
						</div>
                        <?php $i++; $top_banner_query_result->MoveNext(); } ?>
                	</div>
                </div>
                
                <div class="bottom_banners">
                	<h4 class="accordian-header">Bottom Banners Customization :</h4>
                    <div class="accordian-content">
                    	<p>
        					<label for="display_bottom_banners" style="vertical-align:middle">Display Bottom Banners : </label>
							<input type="radio" name="display_bottom_banners" value="yes" <?php if($display_bottom_banners=="yes"){echo "checked";} ?>/>
                            	&nbsp; Yes  &nbsp; &nbsp;
							<input type="radio" name="display_bottom_banners" value="no" <?php if($display_bottom_banners=="no"){echo "checked";} ?>/>
                            	&nbsp; No
        				</p>
                        <p>
        					<label for="bottom_banners_style" style="vertical-align:middle">Display Bottom Banners Layout: </label>
							<input type="radio" name="bottom_banners_style" value="1" <?php if($bottom_banners_style=="1"){echo "checked";} ?>/>
                            	&nbsp; Layout - 1  &nbsp; &nbsp;
							<input type="radio" name="bottom_banners_style" value="2" <?php if($bottom_banners_style=="2"){echo "checked";} ?>/>
                            	&nbsp; Layout - 2
        				</p>
                    	<p>
                        	<label for="bottom_banner">Add Banner:</label>
                            <input type="file" name="bottom_banner" id="file" />
                        </p>
                        <p>
                        	<label for="bottom_banner_caption">Add Banner Captions :</label>
                            <span class="admin-text" style="color:#FF4444">
                            </span>
                            <textarea rows="4" cols="3" name="bottom_banner_caption" style="width:30%;"></textarea>
                        </p>
                        <p>
                        	<input type="submit" name="add_bottom_banner" value="Add Banner" />
                        </p>
                	</div>
              	</div>
                
                <div class="bottom_banners">
                	<h4 class="accordian-header">Delete/Edit Bottom Banner Details :</h4>
                   	<div class="accordian-content">
                       	Current Banners: 
                    	<span class="admin-text" style="color:#FF4444">
                        	&nbsp; &nbsp; Select Image from below to Delete it.
                      	</span>
                        <br/> <br/>
                        <?php 
							$bottom_banner_query = "SELECT * from " . TABLE_TEMPLATE_BOTTOM_BANNER;
							$bottom_banner_query_result = $db->Execute($bottom_banner_query);
							$i=0;
							while(!$bottom_banner_query_result->EOF) {
								
								$bottom_banner_image_name = $bottom_banner_query_result->fields['bottom_banner'];
								$bottom_banner_image_id = $bottom_banner_query_result->fields['id'];
								$bottom_banner_image_id_update=$bottom_banner_image_id;
								$bottom_banner_caption_added = trim($bottom_banner_query_result->fields['bottom_banner_caption']);
						?>
                        <div class="row">
                            <div class="bottom_banner">
                                <div class="col-lg-1">
                                    <input type="checkbox" name="bottom_banner_image_id[]" value="<?php echo $bottom_banner_image_id; ?>" />
                                    <label for="bottom_banner_delete">Delete</label>&nbsp;
                                </div>
                                <div class="col-lg-3">
                                    <input type="hidden" name="bottom_banner_image_id_update[]" value="<?php echo $bottom_banner_image_id_update; ?>"/>
                                    <label for="bottom_banner_image_update">Banner:</label>
                            		<input type="file" name="bottom_banner_image_update[<?php echo $i; ?>]" id="file" value="<?php echo $bottom_banner_image_update; ?>"/>
                                </div>
                                <div class="col-lg-3">
                                    <img height="auto" width="120px" src="../includes/templates/<?php echo $template_dir; ?>/images/banners/<?php echo $bottom_banner_image_name; ?>"/>
                                </div>
                                <div class="col-lg-5">
                                    <textarea rows="4" cols="3" name="bottom_banner_caption_edit[<?php echo $i; ?>]" value="<?php echo $bottom_banner_image_id_update; ?>"><?php echo $bottom_banner_caption_added; ?></textarea>
                                </div>
                            </div>
						</div>
                        <?php $i++; $bottom_banner_query_result->MoveNext(); } ?>
                	</div>
                </div>
                
                <div class="featured_category">            
					<h4 class="accordian-header">Category Products Section :</h4>
    				<div class="accordian-content">
                    	<p>
        					<label for="display_category" style="vertical-align:middle">Display Category Products Section : </label>
							<input type="radio" name="display_category" value="yes" <?php if($display_category=="yes"){echo "checked";} ?>/>
                            	&nbsp; Yes  &nbsp; &nbsp;
							<input type="radio" name="display_category" value="no" <?php if($display_category=="no"){echo "checked";} ?>/>
                            	&nbsp; No
        				</p>
                        <p>
                            <label for="featured_category">Enter Categories Id to display it's products :</label>
                        	<input type="text" size="60" name="featured_category" value="<?php echo $featured_category; ?>" />
                        </p>
                        <p>
                    		<span class="admin-text" style="color:#FF4444">
                        		Enter Any 2 Categories Id seperated by comma.
                        	</span>
                    	</p>
                    </div>
                </div>
                
                <div class="featured_category">            
					<h4 class="accordian-header">Featured Products Section :</h4>
    				<div class="accordian-content">
                    	<p>
        					<label for="display_featured_products" style="vertical-align:middle">Display Featured Products Section : </label>
							<input type="radio" name="display_featured_products" value="yes" <?php if($display_featured_products=="yes"){echo "checked";} ?>/>
                            	&nbsp; Yes  &nbsp; &nbsp;
							<input type="radio" name="display_featured_products" value="no" <?php if($display_featured_products=="no"){echo "checked";} ?>/>
                            	&nbsp; No
        				</p>
                        <p>
                            <label for="display_featured_products" style="vertical-align:middle">Select Display Style from Below : </label>
                        </p>
                        <div class="row">
                        	<div class="col-lg-4">
                            	<input type="radio" name="display_style" value="display_style_1" <?php if($display_featured_products_style=="display_style_1"){echo "checked";} ?>/>
      							<label for="display_style" style="vertical-align:middle">Display Style - 1 </label>
                            	<img height="auto" width="100%" src="../includes/templates/<?php echo $template_dir; ?>/images/style_1.png"/>
                           	</div>
                            <div class="col-lg-4">
                            	<input type="radio" name="display_style" value="display_style_2" <?php if($display_featured_products_style=="display_style_2"){echo "checked";} ?>/>
                                <label for="display_style" style="vertical-align:middle">Display Style - 2 </label>
                            	<img height="auto" width="100%" src="../includes/templates/<?php echo $template_dir; ?>/images/style_2.png"/>
                           	</div>
                            <div class="col-lg-4">
                            	<input type="radio" name="display_style" value="display_style_3" <?php if($display_featured_products_style=="display_style_3"){echo "checked";} ?>/>
                                <label for="display_style" style="vertical-align:middle">Display Style - 3 </label>
                            	<img height="auto" width="100%" src="../includes/templates/<?php echo $template_dir; ?>/images/style_3.png"/>
                           	</div>
                    	</div>
                        <p>
                    		<span class="admin-text" style="color:#FF4444">
                        		For Display Style - 1 only.
                        	</span>
                    	</p>
                        <p>
                        	<label for="featured_products_banner">Add Custom Banner :</label>
                            <input type="file" name="featured_products_banner" id="file" /> 
							<?php if($featured_products_banner != NULL) { 
								echo "<br/><br/><label style='vertical-align:top'>Current Image : </label>";?> 
                                <img height="auto" width="200px" src="../includes/templates/<?php echo $template_dir; ?>/images/banners/<?php echo $featured_products_banner; ?>"/>
							<?php }?>
                        </p>
                        <p>
                        	<label for="featured_products_banner_caption">Add Custom Banner Captions :</label>
                            <span class="admin-text" style="color:#FF4444">
                            </span>
                            <textarea rows="4" cols="3" name="featured_products_banner_caption" style="width:30%;">
								<?php echo trim($featured_products_banner_caption); ?>
                          	</textarea>
                        </p>
                    </div>
                </div>
                
                
                <div class="right_column_banner">            
					<h4 class="accordian-header">Banner in Right Column (Homepage - 3) :</h4>
    				<div class="accordian-content">
                    	<p>
        					<label for="display_right_column_banner" style="vertical-align:middle">Display Banner in Right Column : </label>
							<input type="radio" name="display_right_column_banner" value="yes" <?php if($display_right_column_banner=="yes"){echo "checked";} ?>/>
                            	&nbsp; Yes  &nbsp; &nbsp;
							<input type="radio" name="display_right_column_banner" value="no" <?php if($display_right_column_banner=="no"){echo "checked";} ?>/>
                            	&nbsp; No
        				</p>
                        <p>
                    		<span class="admin-text" style="color:#FF4444">
                        		For Home Page - 3 only.
                        	</span>
                    	</p>
                        <p>
                        	<label for="right_column_banner">Add Banner :</label>
                            <input type="file" name="right_column_banner" id="file" /> 
							<?php if($right_column_banner != NULL) { 
								echo "<br/><br/><label style='vertical-align:top'>Current Image : </label>";?> 
                                <img height="auto" width="200px" src="../includes/templates/<?php echo $template_dir; ?>/images/banners/<?php echo $right_column_banner; ?>"/>
							<?php }?>
                        </p>
                        <p>
                        	<label for="right_column_banner_caption">Add Banner Caption :</label>
                            <span class="admin-text" style="color:#FF4444">
                            </span>
                            <textarea rows="4" cols="3" name="right_column_banner_caption" style="width:30%;">
								<?php echo trim($right_column_banner_caption); ?>
                          	</textarea>
                        </p>
                    </div>
                </div>
                
                <div class="brands_carousel">
                	<h4 class="accordian-header">Brands Slider & Info Boxes :</h4>
                    <div class="accordian-content">
                    	<p>
        					<label for="display_brands_slider" style="vertical-align:middle">Display Brands Slider : </label>
							<input type="radio" name="display_brands_slider" value="yes" <?php if($display_brands_slider=="yes"){echo "checked";} ?>/>
                            	&nbsp; Yes  &nbsp; &nbsp;
							<input type="radio" name="display_brands_slider" value="no" <?php if($display_brands_slider=="no"){echo "checked";} ?>/>
                            	&nbsp; No
        				</p>
                        <p>
        					<label for="display_info_boxes" style="vertical-align:middle">Display Info Boxes : </label>
							<input type="radio" name="display_info_boxes" value="yes" <?php if($display_info_boxes=="yes"){echo "checked";} ?>/>
                            	&nbsp; Yes  &nbsp; &nbsp;
							<input type="radio" name="display_info_boxes" value="no" <?php if($display_info_boxes=="no"){echo "checked";} ?>/>
                            	&nbsp; No
        				</p>
                   	</div>
               	</div>
                
                <div class="contact_details">            
					<h4 class="accordian-header">Store Contact Details :</h4>
    				<div class="accordian-content">
                    	<p>
                    		<span class="admin-text" style="color:#FF4444">
                        		Leave empty to remove the detail from template.
                        	</span>
                    	</p>
                    	<p>
                        	<label for="store_address">Address :</label>
                            <textarea rows="3" cols="2" name="store_address" style="width:30%;"><?php echo $store_address; ?></textarea>
                        </p>
                        <p>
                            <label for="store_contact">Contact Number :</label>
                        	<input type="text" size="60" name="store_contact" value="<?php echo $store_contact; ?>" />
                        </p>
                        <p>
                            <label for="store_fax">Fax :</label>
                        	<input type="text" size="60" name="store_fax" value="<?php echo $store_fax; ?>" />
                        </p>
                        <p>
                            <label for="store_skype">Skype Id :</label>
                        	<input type="text" size="60" name="store_skype" value="<?php echo $store_skype; ?>" />
                        </p>
                        <p>
                            <label for="store_email">Store Email Address :</label>
                            <input type="text" size="60" name="store_email" value="<?php echo $store_email; ?>" />
                        </p>
                    </div>
                </div>
                <div class="sociallinks_details">            
					<h4 class="accordian-header">Store Social Links :</h4>
    				<div class="accordian-content">
                        <p>
                        	<label for="facebook_link">Facebook Page Link :</label>
                            <input type="text" size="60" name="facebook_link" value="<?php echo $facebook_link; ?>" />
                            <span class="admin-text" style="color:#FF4444">
                                <br/><br/>(e.g : envato). Leave text-box empty to hide the Facebook link.
                            </span>
                        </p>
 <p>
                       	     <label for="instagram_link">Instagram Page Link :</label>
                            <input type="text" size="60" name="instagram_link" value="<?php echo $instagram_link; ?>" />
                            <span class="admin-text" style="color:#FF4444">
                                <br/><br/>(e.g : https://instagram.com/lokisafashion). Leave text-box empty to hide the Instagram link.
                            </span>
                        </p>
                        
                        <p>
                       	     <label for="tumblr_link">Tumblr Page Link :</label>
                            <input type="text" size="60" name="tumblr_link" value="<?php echo $tumblr_link; ?>" />
                            <span class="admin-text" style="color:#FF4444">
                                <br/><br/>(e.g : https://lokisafashion.tumblr.com/). Leave text-box empty to hide the Tumblr link.
                            </span>
                        </p> 
                       <p>
                        	<label for="twitter_link">Twitter Page Link :</label>
                            <input type="text" size="60" name="twitter_link" value="<?php echo $twitter_link; ?>" />
                            <span class="admin-text" style="color:#FF4444">
                                <br/><br/>(e.g : envato). Leave text-box empty to hide the Twitter link.
                            </span>
                        </p>
                        <p>
                        	<label for="pinterest_link">Pinterest Link :</label>
                            <input type="text" size="60" name="pinterest_link" value="<?php echo $pinterest_link; ?>" />
                            <span class="admin-text" style="color:#FF4444">
                                <br/><br/>(e.g : envato). Leave text-box empty to hide the Pinterest link.
                            </span>
                        </p>
                        <p>
                        	<label for="google_link">Google Plus Link :</label>
                            <input type="text" size="60" name="google_link" value="<?php echo $google_link; ?>" />
                            <span class="admin-text" style="color:#FF4444">
                                <br/><br/>(e.g : https://plus.google.com/yourpage). Leave text-box empty to hide the Google Plus link.
                            </span>
                        </p>
                        <p>
                        	<label for="youtube_link">Youtube Page Link :</label>
                            <input type="text" size="60" name="youtube_link" value="<?php echo $youtube_link; ?>" />
                            <span class="admin-text" style="color:#FF4444">
                                <br/><br/>Leave text-box empty to hide the Youtube link.
                            </span>
                        </p>
                    </div>
                </div>
                <div class="newsletter_details">            
					<h4 class="accordian-header">Newletter Subscribe Details :</h4>
    				<div class="accordian-content">
                        <p>
                        	<label for="newsletter_details">Newsletter Subcribe Code for your Store (Mail Chimp Account) :</label>
            				<textarea rows="5" cols="2" name="newsletter_details" style="width:40%;"><?php echo $newsletter_details; ?></textarea>
            				<span class="admin-text" style="color:#FF4444;">
            					Get this code from your Mail Chimp Account. Follow instructions in Documentation to get the code.
            				</span>
                        </p>
                     </div>
                </div>
                <div class="payment_image">
                	<h4 class="accordian-header">Payment Method Image : </h4>
                    <div class="accordian-content">
                    	<p>
                        	<label for="payment_image">Select Payment Method Image :</label>
                            <input type="file" size="30" name="payment_image" id="file" value="<?php echo $payment_image; ?>"/>
                        </p>
                        <p>
                        	<?php if($payment_image != NULL) { 
							echo "<label style='vertical-align:top'>Current Image : </label>";?> 
                            <img height="auto" width="100px" 
                            	src="../includes/templates/<?php echo $template_dir; ?>/images/banners/<?php echo $payment_image; ?>"/>
							<?php } ?>
                        </p>
                	</div>
                </div>
                <div class="googlemap_details">            
					<h4 class="accordian-header">Google Map :</h4>
    				<div class="accordian-content">
                        <p>
                        	<label for="store_map">Google Map iframe code for your Store :</label>
            				<textarea rows="5" cols="2" name="store_map" style="width:40%;"><?php echo $store_map; ?></textarea>
            				<span class="admin-text" style="color:#FF4444;">
            					Get this iframe code from Google Maps. Leave blank to remove Google Map from Contact Us page.
            				</span>
                        </p>
                     </div>
                </div>
                <div class="copyright_details">            
					<h4 class="accordian-header">Copyright Text :</h4>
    				<div class="accordian-content">
                        <p>
                        	<label for="store_copyright">Copy Right Information :</label>
                            <textarea rows="5" cols="2" name="store_copyright" style="width:40%;"><?php echo $store_copyright; ?>
                            </textarea>
                        </p>
    				</div>
                </div>
        		<p style="text-align:center"><input type="submit" name="template_settings" value="Save Changes" /></p>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->

</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
