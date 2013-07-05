<?php
/*
Plugin Name: WP Easy Responsive Tabs to Accordion
Plugin URI:
Description: Easy responsive tabs - is a lightweight jQuery plugin which optimizes normal horizontal or vertical tabs to accordion on multi devices like: web, tablets, Mobile (IPad & IPhone). This plugin adapts the screen size and changes its action accordingly.
Version: 1.0.0
Author: jQuery plugin by Samson Onna / Changed into plugin of WordPress by Kurudrive(Hidekazu Ishikawa) at Vektor,Inc.
Author URI: http://vektor-inc.co.jp
License: MIT

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
	wp_register_script( 'easyResponsiveTabs' , plugins_url('js/easyResponsiveTabs.js', __FILE__), array('jquery'), '20130704' );
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
		'Easy Responsive Tabs to Accordion setting',		// Name of page
		'Tabs to Accordion',		// Label in menu
		'edit_plugins',				// Capability required　このメニューページを閲覧・使用するために最低限必要なユーザーレベルまたはユーザーの種類と権限。
		'easyResponsiveTabs_plugin_options',				// ユニークなこのサブメニューページの識別子
		'easyResponsiveTabs_add_customSettingPage'			// メニューページのコンテンツを出力する関数
	);
	if ( ! $custom_page )
	return;
}
add_action( 'admin_menu', 'easyResponsiveTabs_add_customSetting' );

/*-------------------------------------------*/
/*	Setting Page
/*-------------------------------------------*/
function easyResponsiveTabs_add_customSettingPage() { ?>
<div class="wrap" id="easyResponsiveTabs_plugin_options">
<?php screen_icon(); ?>
<h2>Easy Responsive Tabs to Accordion</h2>

<form method="post" action="options.php">
<?php
	settings_fields( 'easyResponsiveTabs_plugin_options' );
	$options_easyResponsiveTabs = easyResponsiveTabs_get_plugin_options();
	$default_options = easyResponsiveTabs_get_default_options();
?>
<div id="" class="sectionBox">
<table class="form-table">
<tr>
	<th>Sample html</th>
	<td>
<xmp>
<div id="demoTab">
	<ul class="resp-tabs-list">
		<li>Tab title 1</li>
		<li>Tab title 2</li>
		<li>Tab title 3</li>
	</ul> 
	<div class="resp-tabs-container">
		<div>TabText1 TabText1 TabText1 TabText1 TabText1 TabText1 TabText1</div>
		<div>TabText2 TabText2 TabText2 TabText2 TabText2 TabText2</div>
		<div>TabText3 TabText3 TabText3 TabText3 TabText3Tab</div>
	</div>
</div>
</xmp>
	</td>
	</tr>
	<tr>
	<th>Input Target Selectors</th>
	<td>
	<textarea cols="20" rows="15" name="easyResponsiveTabs_plugin_options[easyResponsiveTabsSelectors]" id="easyResponsiveTabsSelectors" value="" style="width:80%;" /><?php echo $options_easyResponsiveTabs['easyResponsiveTabsSelectors'] ?></textarea><br />
	<dl>
	<dt>ex1 : Call the easyResponsiveTabs function</dt>
	<dd><pre>
jQuery('#demoTab').easyResponsiveTabs();
	</pre></dd>
</dl>
<dl>
	<dt>ex2 : With optional parameters</dt>
	<dd><pre>
jQuery("#demoTab").easyResponsiveTabs({
	type: 'default', //Types: default, vertical, accordion           
	width: 'auto', //auto or any custom width
	fit: true   // 100% fits in a container
});
</pre></dd>
</dl>
</td>
</tr>
</table>
<?php submit_button(); ?>
</div><!-- [ /# ] -->
</form>
</div>
<?php }

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