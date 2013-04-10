<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */
// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['bmf'];

	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Test data
	//$test_array = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
	
	// Multicheck Array
	//$multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
	
	// Multicheck Defaults
	//$multicheck_defaults = array("one" => "1","five" => "1");
	
	// Background Defaults
	
	//$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	//
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	//if((($feat_cat->slug=="Testimonial") || ($feat_cat->slug=="testimonial")) || (($feat_cat->slug=="Testimony") || ($feat_cat->slug=="testimony"))):
			$options_categories[$category->cat_ID] = $category->cat_name;
		//endif;
	}
	
	// Pull all the categories into an array
	$featured1 = array();  
	$featured1_obj = get_categories();
	foreach ($featured1_obj as $feat_cat) {
    	if((($feat_cat->slug==="Uncategorized") || ($feat_cat->slug==="uncategorized"))):
		else:
			//$featured1[$feat_cat->cat_ID] = $feat_cat->cat_name;
			$featured1[$feat_cat->cat_name] = $feat_cat->cat_name;
		endif;
	}
	// Pull all the categories into an array
	$featured2 = array();  
	$featured2_obj = get_categories();
	foreach ($featured2_obj as $feat_cat) {
    	if((($feat_cat->slug==="Uncategorized") || ($feat_cat->slug==="uncategorized"))):
		else:
			//$featured2[$feat_cat->cat_ID] = $feat_cat->cat_name;
			$featured2[$feat_cat->cat_name] = $feat_cat->cat_name;
		endif;
	}
	
	
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
	
	// Pull all the categories into an array
	/*$exclude_category= array();  
	$exclude_category_obj = get_categories();
	foreach ($exclude_category_obj as $exclude) {
    	//if((($feat_cat->slug=="Testimonial") || ($feat_cat->slug=="testimonial")) || (($feat_cat->slug=="Testimony") || ($feat_cat->slug=="testimony"))):
			$exclude_category[$exclude->cat_ID] = $exclude->cat_name;
			
		//endif;
	}*/
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_bloginfo('stylesheet_directory') . '/images/';
		
	$options = array();
	/*---- General Basic Configuration -----*/	
	$options[] = array( "name" => "Basic Custom Settings",
						"type" => "heading");
	$options[] = array( "name" => "Faveicon",
						"desc" => "Upload your faveicon",
						"id" => "faveicon",
						"type" => "upload");
	$options[] = array( "name" => "Costum Logo",
						"desc" => "Your business logo",
						"id" => "logos",
						"type" => "upload");	
	$options[] = array( "name" => "Select a 1st block of Featured Category",
						"desc" => "Display recent posts of this category on home",
						"id" => "getfeatured1",
						"type" => "select",
						"options" => $featured1);	
	$options[] = array( "name" => "Select a 2nd block of Featured Category",
						"desc" => "Display recent posts of this category on home",
						"id" => "getfeatured2",
						"type" => "select",
						"options" => $featured2);	
	/*$options[] = array( "name" => "Exclude Categories",
						"desc" => "Exclude Categories showing on Main Menu.",
						"id" => "exclude_mainmenu",
						"std" => $multicheck_defaults, // These items get checked by default
						"type" => "multicheck",
						"options" => $exclude_category);		*/				
	
	$options[] = array( "name" => "Footer Copyright",
						"desc" => "Type Your Copyright Quotes.",
						"id" => "copyright",
						"std" => "Erway Media Solusindo",
						"type" => "textarea"); 
	$options[] = array( "name" => "Google Analytics",
						"desc" => "Your Google Stuff",
						"id" => "analytics",
						"std" => "",
						"type" => "textarea"); 
	$options[] = array( "name" => "Histats Setting",
						"desc" => "Your Histats Counter",
						"id" => "histats",
						"std" => "",
						"type" => "textarea"); 
	$options[] = array( "name" => "Colorpicker",
						"desc" => "No color selected by default.",
						"id" => "bgcolor",
						"std" => "#ffcc00",
						"type" => "color");
	$options[] = array( "name" => "Social Media Settings",
						"type" => "heading");
	/*---- Social Media Configuration -----*/					
	$options[] = array( "name" => "Twitter ID",
						"desc" => "Type your twitter ID",
						"id" => "twitter",
						"std" => "roniwahyu",
						"class" => "mini",
						"type" => "text");
	$options[] = array( "name" => "Facebook ID",
						"desc" => "Type your Facebook ID",
						"id" => "facebook",
						"std" => "roniwahyu",
						"class" => "mini",
						"type" => "text");
/*	$options[] = array( "name" => "LinkedIn ID",
						"desc" => "Type your LinkedIn ID",
						"id" => "linkedin",
						"std" => "roniwahyu",
						"class" => "mini",
						"type" => "text");*/
	$options[] = array( "name" => "Google+",
						"desc" => "Type your Google ID",
						"id" => "googleplus",
						"std" => "roniwahyu",
						"class" => "mini",
						"type" => "text");
	$options[] = array( "name" => "Youtube",
						"desc" => "Type your Youtube ID",
						"id" => "youtube",
						"std" => "roniwahyu",
						"class" => "mini",
						"type" => "text");
/*	$options[] = array( "name" => "Feeds URL",
						"desc" => "Type your Feeds URL Here",
						"id" => "feeds",
						"std" => "",
						"type" => "text");*/
	/*---- Slideshow Configuration -----*/		
/*	$options[] = array( "name" => "Slideshow",
						"type" => "heading");
	
	$options[] = array( "name" => "Slideshow Image 1",
						"desc" => "Upload Image max. 700 280px",
						"id" => "slideshow1",
						"type" => "upload");
	$options[] = array( "name" => "Slideshow 1 Description",
						"desc" => "Type Your Description of Slideshow1",
						"id" => "slidedesc1",
						"std" => "Description 1",
						"type" => "textarea"); 
	$options[] = array( "name" => "Slideshow Image 2",
						"desc" => "Upload Image max. 700x280px",
						"id" => "slideshow2",
						"type" => "upload");
	$options[] = array( "name" => "Slideshow 2 Description",
						"desc" => "Type Your Description of Slideshow2",
						"id" => "slidedesc2",
						"std" => "Description 2",
						"type" => "textarea"); 
	$options[] = array( "name" => "Slideshow Image 3",
						"desc" => "Upload Image max. 700x280px",
						"id" => "slideshow3",
						"type" => "upload");
	$options[] = array( "name" => "Slideshow 3 Description",
						"desc" => "Type Your Description of Slideshow3",
						"id" => "slidedesc3",
						"std" => "Description 3",
						"type" => "textarea");
	$options[] = array( "name" => "Slideshow Image 4",
						"desc" => "Upload Image max. 700x280px",
						"id" => "slideshow4",
						"type" => "upload");
	$options[] = array( "name" => "Slideshow 4 Description",
						"desc" => "Type Your Description of Slideshow4",
						"id" => "slidedesc4",
						"std" => "Description 4",
						"type" => "textarea");
	$options[] = array( "name" => "Slideshow Image 5",
						"desc" => "Upload Image max. 700x280px",
						"id" => "slideshow5",
						"type" => "upload");
	$options[] = array( "name" => "Slideshow 5 Description",
						"desc" => "Type Your Description of Slideshow5",
						"id" => "slidedesc5",
						"std" => "Description 5",
						"type" => "textarea"); */
	/*---- Ads Configuration -----*/
	$options[] = array( "name" => "Ads Setting",
						"type" => "heading");
	$options[] = array( "name" => "Ads Script",
						"desc" => "Get More on Pro Version",
						"type" => "info"); 

	$options[] = array( "name" => "Top Left 125px125 Ads Banner",
						"desc" => "Upload your 125x125px image here",
						"id" => "adstopleft",
						"type" => "upload"); 
	$options[] = array( "name" => "Top Left Ads Banner URL Destination",
						"desc" => "Type Your URL Destination",
						"id" => "urltopleft",
						"std" => "http://",
						"type" => "text");
	$options[] = array( "name" => "Top Left Ads Description",
						"desc" => "Type Your Description",
						"id" => "topleft-desc",
						"type" => "text");

	$options[] = array( "name" => "Top Right 125px125 Ads Banner",
						"desc" => "Upload your 125x125px image here",
						"id" => "adstopright",
						"type" => "upload"); 	
	$options[] = array( "name" => "Top Right Ads Banner URL Destination",
						"desc" => "Type Your URL Destination",
						"id" => "urltopright",
						"std" => "http://",
						"type" => "text");
	$options[] = array( "name" => "Top Right Ads Description",
						"desc" => "Type Your Description",
						"id" => "topright-desc",
						"type" => "text");


	$options[] = array( "name" => "Left Bottom 125px125 Ads Banner",
						"desc" => "Upload your 125x125px image here",
						"id" => "adsleftbottom",
						"type" => "upload"); 
	$options[] = array( "name" => "Left Bottom Ads Banner URL Destination",
						"desc" => "Type Your URL Destination",
						"id" => "urlleftbottom",
						"std" => "http://",
						"type" => "text");
	$options[] = array( "name" => "Bottom Left Ads Description",
						"desc" => "Type Your Description",
						"id" => "bottomleft-desc",
						"type" => "text");


	$options[] = array( "name" => "Right Bottom 125px125 Ads Banner",
						"desc" => "Upload your 125x125px image here",
						"id" => "adsrightbottom",
						"type" => "upload"); 
	$options[] = array( "name" => "Right Bottom Ads Banner URL Destination",
						"desc" => "Type Your URL Destination",
						"id" => "urlrightbottom",
						"std" => "http://",
						"type" => "text");
	$options[] = array( "name" => "Bottom Right Ads Description",
						"desc" => "Type Your Description",
						"id" => "bottomright-desc",
						"type" => "text");
	

	$options[] = array( "name" => "468x60 Ads Banner",
						"desc" => "Paste your 468x60 px ads code here",
						"id" => "ads468x60",
						"std" => "",
						"type" => "textarea"); 

	$options[] = array( "name" => "300x250 Ads Banner",
						"desc" => "Paste your 300x250 px ads code here",
						"id" => "ads300x250",
						"std" => "",
						"type" => "textarea"); 
	$options[] = array( "name" => "728x90 Ads Banner",
						"desc" => "Paste your 728x90 px ads code here",
						"id" => "ads728x90",
						"std" => "",
						"type" => "textarea"); 
	
	$options[] = array( "name" => "Amazon Support",
						"type" => "heading");
	$options[] = array( "name" => "Amazon Secret ID",
						"desc" => "Get Pro Version",
						"type" => "info");
	

				
	return $options;
}