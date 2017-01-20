<?php
/*
Plugin Name: WP Easy Responsive Tabs to Accordion
Plugin URI:
Description: Easy responsive tabs - is a lightweight jQuery plugin which optimizes normal horizontal or vertical tabs to accordion on multi devices like: web, tablets, Mobile (IPad & IPhone). This plugin adapts the screen size and changes its action accordingly.
Version: 1.2.2
Author: jQuery plugin by Samson Onna / Changed for WordPress plugin by Kurudrive.
Author URI: http://ligthning.vektor-inc.co.jp
License: GPL2

/*  Copyright 2013 Hidekazu Ishikawa ( email : kurudrive@gmail.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$data = get_file_data( __FILE__, array( 'version' => 'Version','textdomain' => 'Text Domain' ) );
define( 'VK_ERTAB_VERSION', $data['version'] );
define( 'VK_ERTAB_BASENAME', plugin_basename( __FILE__ ) );
define( 'VK_ERTAB_URL', plugin_dir_url( __FILE__ ) );
define( 'VK_ERTAB_DIR', plugin_dir_path( __FILE__ ) );

require_once( 'vk-admin-config.php' );

/*-------------------------------------------*/
/*	Load text domain
/*-------------------------------------------*/
function easyResponsiveTabs() {
	load_plugin_textdomain( 'easyResponsiveTabs' );
}
add_action( 'init', 'easyResponsiveTabs' );

/*-------------------------------------------*/
/*	load css
/*-------------------------------------------*/
add_action('wp_head', 'easyResponsiveTabs_css');
function easyResponsiveTabs_css(){
	$cssPath = apply_filters( "easyResponsiveTabs_css", plugins_url("css/easy-responsive-tabs.css", __FILE__) );
	wp_enqueue_style( 'easyResponsiveTabs_css', $cssPath , false, '2013-07-04');
}
/*-------------------------------------------*/
/*	load js
/*-------------------------------------------*/
add_action('wp_footer', 'easyResponsiveTabs_js');
function easyResponsiveTabs_js(){
	wp_register_script( 'easyResponsiveTabs' , plugins_url('js/easyResponsiveTabs.js', __FILE__), array('jquery'), VK_ERTAB_VERSION );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'easyResponsiveTabs' ); ?>
	<script language="JavaScript">
    jQuery(function(){
    	<?php
		// $options_easyResponsiveTabs = easyResponsiveTabs_get_plugin_options();
  //   	echo $options_easyResponsiveTabs['easyResponsiveTabsSelectors']
    	?>
    	<?php
    	echo wp_kses_post(get_easyResponsiveTabs_options('easyResponsiveTabsSelectors'));
    	//echo get_easyResponsiveTabs_options('easyResponsiveTabsSelectors');
    	?>
	});
    </script>
    <?php
}

function easyResponsiveTabs_get_default_options() {
	$easyResponsiveTabs_options = array(
		'easyResponsiveTabsSelectors' => 'jQuery("#demoTab").easyResponsiveTabs();',
	);
	return apply_filters( 'easyResponsiveTabs_default_options', $easyResponsiveTabs_options );
}

function easyResponsiveTabs_plugin_options_Custom_init() {
	if ( false === easyResponsiveTabs_get_plugin_options() )
	add_option( 'easyResponsiveTabs_plugin_options', easyResponsiveTabs_get_default_options() );
	register_setting(
		'easyResponsiveTabs_plugin_options',
		'easyResponsiveTabs_plugin_options',
		'easyResponsiveTabs_plugin_options_validate'
	);
}
add_action( 'admin_init', 'easyResponsiveTabs_plugin_options_Custom_init' );

/*-------------------------------------------*/
/*	functionsで毎回呼び出して$options_easyResponsiveTabsに入れる処理を他でする。
/*-------------------------------------------*/
function easyResponsiveTabs_get_plugin_options() {
	return get_option( 'easyResponsiveTabs_plugin_options', easyResponsiveTabs_get_default_options() );
}

/*-------------------------------------------*/
/*	メニューに追加
/*-------------------------------------------*/
function easyResponsiveTabs_add_customSetting() {
	$custom_page = add_options_page(
		'WP Easy Responsive Tabs to Accordion setting',		// Name of page
		'WP Easy Responsive Tabs to Accordion',		// Label in menu
		'edit_plugins',				// Capability required　このメニューページを閲覧・使用するために最低限必要なユーザーレベルまたはユーザーの種類と権限。
		'easyResponsiveTabs_plugin_options',				// ユニークなこのサブメニューページの識別子
		'easyResponsiveTabs_add_customSettingPage'			// メニューページのコンテンツを出力する関数
	);
	if ( ! $custom_page )
	return;
}
add_action( 'admin_menu', 'easyResponsiveTabs_add_customSetting' );


/*-------------------------------------------*/
/*	Add link to setting page in Plugin list page
/*-------------------------------------------*/
function easyResponsiveTabs_set_plugin_meta( $links ) { 
    $settings_link             = '<a href="options-general.php?page=easyResponsiveTabs_plugin_options">'.__( 'Setting', 'easyResponsiveTabs' ).'</a>';
    array_unshift($links, $settings_link);
    return $links;
}
 add_filter('plugin_action_links_'.VK_ERTAB_BASENAME , 'easyResponsiveTabs_set_plugin_meta', 10, 1);

function easyResponsiveTabs_plugin_options_validate( $input ) {
	$output = $defaults = easyResponsiveTabs_get_default_options();
	$output['easyResponsiveTabsSelectors'] = $input['easyResponsiveTabsSelectors'];
	return apply_filters( 'easyResponsiveTabs_plugin_options_validate', $output, $input, $defaults );
}

/*-------------------------------------------*/
/*	optionの値を単純に引っ張る
/*-------------------------------------------*/
function get_easyResponsiveTabs_options($optionLabel) {
	$options_easyResponsiveTabs = easyResponsiveTabs_get_plugin_options();
	if ($options_easyResponsiveTabs[$optionLabel]){
		return $options_easyResponsiveTabs[$optionLabel];
	}
}