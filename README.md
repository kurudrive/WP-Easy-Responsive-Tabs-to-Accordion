WP Easy Responsive Tabs to Accordion
=================================

WP Easy Responsive Tabs to Accordion changes Easy Responsive Tabs to Accordion to WordPress plugin.

Easy responsive tabs - is a lightweight jQuery plugin which optimizes normal horizontal or vertical tabs to accordion on multi devices like: web, tablets, Mobile (IPad &amp; IPhone). This plugin adapts the screen size and changes its form accordingly.


Features
=========

+ Horizontal / Vertical Tabs to Accordion
+ Tabs and accordion are created entirely with jQuery
+ Supports multiple sets of tabs on same page
+ Cross browser compatibility (IE7+, Chrome, Firefox, Safari and Opera)
+ Multi device support (Web, Tablets & Mobile)

Demo
====

http://webtrendset.com/demo/easy-responsive-tabs/Index.html


How to use
==========

=> install this plugin to your WordPress.

=> Here is the Markup for Tabs structure:

        <div id="demoTab">          
            <ul class="resp-tabs-list">
                <li> .... </li>
                <li> .... </li>
                <li> .... </li>
            </ul> 

            <div class="resp-tabs-container">                                                        
                <div> ....... </div>
                <div> ....... </div>
                <div> ....... </div>
            </div>
        </div>    
        
=> Input setting page to call the easyResponsiveTabs function:

        jQuery('#demoTab').easyResponsiveTabs();
        
=> With optional parameters:

        jQuery("#demoTab").easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any custom width
            fit: true   // 100% fits in a container
        });
