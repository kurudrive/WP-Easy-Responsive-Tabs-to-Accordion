<?php

/*-------------------------------------------*/
/*  Load modules
/*-------------------------------------------*/
if ( ! class_exists( 'Vk_Admin' ) )
{
	require_once( VK_ERTAB_DIR.'vk-admin/class.vk-admin.php' );
}

$admin_pages = array( 'settings_page_easyResponsiveTabs_plugin_options' );
Vk_Admin::admin_scripts( $admin_pages );

/*-------------------------------------------*/
/*	Setting Page
/*-------------------------------------------*/
function easyResponsiveTabs_add_customSettingPage() {
	require_once( VK_ERTAB_DIR . 'view.tabs_to_accordion_admin.php' );
	$get_page_title = '';
	$get_logo_html = '<h1>WP Easy Responsive Tabs to Accordion</h1>';
	$get_menu_html = '<li><a href="#sample">1. Sample Code</a></li>';
	$get_menu_html .= '<li><a href="#inputSerectors">2. Input Target Selectors</a></li>';
	Vk_Admin::admin_page_frame( $get_page_title, 'easyResponsiveTabs_add_customSettingPage_body', $get_logo_html, $get_menu_html );
}