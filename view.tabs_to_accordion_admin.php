<?php
/*-------------------------------------------*/
/*	Setting Page
/*-------------------------------------------*/
function easyResponsiveTabs_add_customSettingPage_body() { ?>
<div class="wrap" id="easyResponsiveTabs_plugin_options">
<form method="post" action="options.php">
<?php
	settings_fields( 'easyResponsiveTabs_plugin_options' );
	$options_easyResponsiveTabs = easyResponsiveTabs_get_plugin_options();
	$default_options = easyResponsiveTabs_get_default_options();
?>
<div>
<section id="sample" class="sectionBox">
<h3>1. Sample Code</h3>
<p><?php _e('Enter the following code to the template file or the body of a post.','easyResponsiveTabs');?></p>
<hr>
<xmp><div id="demoTab">
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
</div></xmp>
</section>

<section id="inputSerectors">
<h3>2. Input Target Selectors</h3>
<textarea cols="20" rows="5" name="easyResponsiveTabs_plugin_options[easyResponsiveTabsSelectors]" id="easyResponsiveTabsSelectors" value="" style="width:95%;" /><?php echo $options_easyResponsiveTabs['easyResponsiveTabsSelectors'] ?></textarea><br />
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
</section>
</div>
<?php submit_button(); ?>
</form>
</div>
<?php }