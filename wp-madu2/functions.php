<?php

$themename = "madu";
$shortname = "madu";


register_nav_menu( 'primary', __( 'Primary Menu', 'madu' ) );
register_nav_menu( 'headmenu', __( 'Header Menu', 'madu' ) );
register_nav_menu( 'footermenu', __( 'Footer Menu', 'madu' ) );

require_once("function/twitter.php");


add_filter('the_content', 'filter_ptags_on_images');


if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support('post-thumbnails', array( 'post', 'page','portfolio','event','produk' ) );
		add_theme_support( 'post-formats', array( 'aside', 'gallery','video','audio' ) ); // Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
		
		set_post_thumbnail_size( 200,    150,     true ); // Normal post thumbnails
		add_image_size( 'large' , 600,  '',     true ); // Large thumbnails
		add_image_size( 'medium', 300,  '',     true ); // Medium thumbnails
		add_image_size( 'small' , 125,  '',     true ); // Small thumbnails
		add_image_size( 'slider' , 988,  350,    true ); // slider thumbnail
		add_image_size('banner-images',200,'',true);
		add_image_size( 'featured' , 960,  400,    true ); // slider thumbnail
		add_image_size('blogthumb',600,200,true);
		add_image_size('product-image','','',true);
		add_image_size('product-thumb',50,50,true);
		
		add_theme_support('automatic-feed-links'); //Enables post and comment RSS feed links to head.
		add_theme_support('widgets');


}
/* Sidebar */


if ( function_exists('register_sidebar') ) {

	register_sidebar(array(
	  	'name' => __( 'Primary' ),
				'id' => 'primary',
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h3 class="widget_title">',
                'after_title' => '</h3>',
	));
	register_sidebar(array(

	  	'name' => __( 'Homepage Widget' ),
	  			'id' => 'homepage',
                'before_widget' => '<div id="%1$s" class="kolom3">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="widget_title"><a href="#">',
                'after_title' => '</a></h3>',
	));
	register_sidebar(array(

	  	'name' => __( 'Homepage Widget 2' ),
	  			'id' => 'homepage2',
                'before_widget' => '<div id="%1$s" class="kolom3">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="widget_title"><a href="#">',
                'after_title' => '</a></h3>',
	));
	register_sidebar(array(

	  	'name' => __( 'Homepage Widget 3 Frame' ),
	  			'id' => 'homepage3',
	  			'class' => 'sidebar',
                'before_widget' => '<section id="%1$s" class="widget product-page-widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h3 class="widget_title"><a href="#">',
                'after_title' => '</a></h3>',
	));
	register_sidebar(array(

	  	'name' => __( 'Product Page' ),
	  			'id' => 'product',
                'before_widget' => '<section id="%1$s" class="widget product-page-widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h3 class="widget_title"><a href="#">',
                'after_title' => '</a></h3>',
	));

	register_sidebar(array(
	  	'name' => __( 'Footer Widget 1' ),
	  			'id' => 'footer1',
                'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h5 class="widget_title"><a href="#">',
                'after_title' => '</a></h5>',
	));

	register_sidebar(array(

	  	'name' => __( 'Footer Widget 2' ),

	  			'id' => 'footer2',
                'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h5 class="widget_title"><a href="#">',
                'after_title' => '</a></h5>',

	));

}

/*CUSTOM WIDGET */
wp_register_sidebar_widget(
    'about_us_widget',          // your unique widget id
    'About Us',                 // widget name
    'about_us_widget_display',  // callback function to display widget
    array(                      // options
        'description' => 'Description of what your widget does'
    )
);

wp_register_widget_control(
	'about_us_widget',		// id
	'about_us_widget',		// name
	'about_us_widget_control'	// callback function
);

    function about_us_widget_control($args=array(), $params=array()) {
    	//the form is submitted, save into database
    	if (isset($_POST['submitted'])) {
    		update_option('about_us_widget_title', $_POST['widgettitle']);
    		update_option('about_us_widget_twitterurl', $_POST['twitterurl']);
    		update_option('about_us_widget_description', $_POST['description']);
    	}
    	//load options
    	$widgettitle = get_option('about_us_widget_title');
    	$twitterurl = get_option('about_us_widget_twitterurl');
    	$description = get_option('about_us_widget_description');
    	?>
    	Widget Title:<br />
    	<input type="text" class="widefat" name="widgettitle" value="<?php echo stripslashes($widgettitle); ?>" />
    	<br /><br />
    	Description about you:<br />
    	<textarea class="widefat" rows="5" name="description"><?php echo stripslashes($description); ?></textarea>
    	<br /><br />
    	Twitter Profile URL:<br />
    	<input type="text" class="widefat" name="twitterurl" value="<?php echo stripslashes($twitterurl); ?>" />
    	<br /><br />
    	<input type="hidden" name="submitted" value="1" />
    	<?php
    }

    function about_us_widget_display($args=array(), $params=array()) {
    	//load options
    	$widgettitle = get_option('about_us_widget_title');
    	$description = get_option('about_us_widget_description');
    	$twitterurl = get_option('about_us_widget_twitterurl');
    	//widget output
    	echo stripslashes($args['before_widget']);
    	echo stripslashes($args['before_title']);
    	echo stripslashes($widgettitle);
    	echo stripslashes($args['after_title']);
    	echo '<div class="textwidget">'.stripslashes(nl2br($description));
    	if ($twitterurl != '') {
    		echo '<p><a href="'.stripslashes($twitterurl).'" target="_blank">Follow us on Twitter</a></p>';
    	}
    	echo '</div>';//close div.textwidget
      echo stripslashes($args['after_widget']);
    }
/*END OF CUSTOM WIDGET*/



/*THEME OPTIONS*/



function get_theme_option($option)

{

	global $shortname;

	return stripslashes(get_option($shortname . '_' . $option));

}



function get_theme_settings($option)

{

	return stripslashes(get_option($option));

}

/*

 * Helper function to return the theme option value. If no value has been saved, it returns $default.

 * Needed because options are saved as serialized strings.

 *

 * This code allows the theme to work without errors if the Options Framework plugin has been disabled.

 */

 

if ( !function_exists( 'of_get_option' ) ) {

function of_get_option($name, $default = false) {

 

    $optionsframework_settings = get_option('optionsframework');

 

    // Gets the unique option id

    $option_name = $optionsframework_settings['id'];

 

    if ( get_option($option_name) ) {

        $options = get_option($option_name);

    }

 

    if ( isset($options[$name]) ) {

        return $options[$name];

    } else {

        return $default;

    }

}

}

if ( !function_exists( 'optionsframework_init' ) ) {



	/*-----------------------------------------------------------------------------------*/

	/* Options Framework Theme

	/*-----------------------------------------------------------------------------------*/



	/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */



	if ( STYLESHEETPATH == TEMPLATEPATH ) {

		define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');

		define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/');

	} else {

		define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/admin/');

		define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('stylesheet_directory') . '/admin/');

	}



	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');



}



/* 

 * This is an example of how to add custom scripts to the options panel.

 * This example shows/hides an option when a checkbox is clicked.

 */



add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');



function optionsframework_custom_scripts() { ?>



<script type="text/javascript">

jQuery(document).ready(function() {



	jQuery('#example_showhidden').click(function() {

  		jQuery('#section-example_text_hidden').fadeToggle(400);

	});

	

	if (jQuery('#example_showhidden:checked').val() !== undefined) {

		jQuery('#section-example_text_hidden').show();

	}	

	

});

</script>



<?php

}



/* 

 * Turns off the default options panel from Twenty Eleven

 */

 

add_action('after_setup_theme','remove_twentyeleven_options', 100);

function remove_twentyeleven_options() {

	remove_action( 'admin_menu', 'twentyeleven_theme_options_add_page' );

}



// Related Posts Function (call using related_posts(); )

function related_posts() {

	echo '<ul id="related-posts">';

	global $post;

	$tags = wp_get_post_tags($post->ID);

	if($tags) {

		foreach($tags as $tag) { $tag_arr .= $tag->slug . ','; }

        $args = array(

        	'tag' => $tag_arr,

        	'numberposts' => 5, /* you can change this to show more */

        	'post__not_in' => array($post->ID)

     	);

        $related_posts = get_posts($args);

        if($related_posts) {

        	foreach ($related_posts as $post) : setup_postdata($post); ?>

	           	<li class="related_post"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>

	        <?php endforeach; } 

	    else { ?>

            <li class="no_related_post">No Related Posts Yet!</li>

		<?php }

	}

	wp_reset_query();

	echo '</ul>';

}

// Numeric Page Navi (built into the theme by default)

function page_navi($before = '', $after = '') {

	global $wpdb, $wp_query;

	$request = $wp_query->request;

	$posts_per_page = intval(get_query_var('posts_per_page'));

	$paged = intval(get_query_var('paged'));

	$numposts = $wp_query->found_posts;

	$max_page = $wp_query->max_num_pages;

	if ( $numposts <= $posts_per_page ) { return; }

	if(empty($paged) || $paged == 0) {

		$paged = 1;

	}

	$pages_to_show = 7;

	$pages_to_show_minus_1 = $pages_to_show-1;

	$half_page_start = floor($pages_to_show_minus_1/2);

	$half_page_end = ceil($pages_to_show_minus_1/2);

	$start_page = $paged - $half_page_start;

	if($start_page <= 0) {

		$start_page = 1;

	}

	$end_page = $paged + $half_page_end;

	if(($end_page - $start_page) != $pages_to_show_minus_1) {

		$end_page = $start_page + $pages_to_show_minus_1;

	}

	if($end_page > $max_page) {

		$start_page = $max_page - $pages_to_show_minus_1;

		$end_page = $max_page;

	}

	if($start_page <= 0) {

		$start_page = 1;

	}

	echo $before.'<nav class="page-navigation"><ol class="page_navi clearfix">'."";

	if ($start_page >= 2 && $pages_to_show < $max_page) {

		$first_page_text = "First";

		echo '<li class="bpn-first-page-link"><a href="'.get_pagenum_link().'" title="'.$first_page_text.'">'.$first_page_text.'</a></li>';

	}

	echo '<li class="bpn-prev-link">';

	previous_posts_link('<<');

	echo '</li>';

	for($i = $start_page; $i  <= $end_page; $i++) {

		if($i == $paged) {

			echo '<li class="bpn-current">'.$i.'</li>';

		} else {

			echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';

		}

	}

	echo '<li class="bpn-next-link">';

	next_posts_link('>>');

	echo '</li>';

	if ($end_page < $max_page) {

		$last_page_text = "Last";

		echo '<li class="bpn-last-page-link"><a href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'">'.$last_page_text.'</a></li>';

	}

	echo '</ol></nav>'.$after."";

}



// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)

function filter_ptags_on_images($content){

   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);

}




//custom readmore on excerpt function

function new_excerpt_more($more) {

	global $post;

	//return '<a class="read-more" href="'. get_permalink($post->ID) . '">Read More...</a>';

}

add_filter('excerpt_more', 'new_excerpt_more');



function my_excerpt($excerpt_length = 55, $id = false, $echo = true) {

	  

    $text = '';

    

	  if($id) {

	  	$the_post = & get_post( $my_id = $id );

	  	$text = ($the_post->post_excerpt) ? $the_post->post_excerpt : $the_post->post_content;

	  } else {

	  	global $post;

	  	$text = ($post->post_excerpt) ? $post->post_excerpt : get_the_content('');

    }

	  

		$text = strip_shortcodes( $text );

		$text = apply_filters('the_content', $text);

		$text = str_replace(']]>', ']]&gt;', $text);

	  $text = strip_tags($text);

	

		$excerpt_more = ' ' . '...';
	  	// $excerpt_more = ' <span class="button"><a href="'.the_permalink().'">Lanjut ></a></span>';

		$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);

		if ( count($words) > $excerpt_length ) {

			array_pop($words);

			$text = implode(' ', $words);

			$text = $text . $excerpt_more;

		} else {

			$text = implode(' ', $words);

		}

	if($echo)

  echo apply_filters('the_content', $text);

	else

	return $text;

}



function get_my_excerpt($excerpt_length = 55, $id = false, $echo = false) {
	 return my_excerpt($excerpt_length, $id, $echo);
}

function share_this($content){
    if(!is_feed() && !is_home()) {
        $content .= '<div class="share-this">
                    <span class="share-twitter"><a href="http://twitter.com/share"
class="twitter-share-button"
data-count="horizontal">Tweet</a></span>
                    <script type="text/javascript"
src="http://platform.twitter.com/widgets.js"></script>
                    <div class="facebook-share-button">
                        <iframe
src="http://www.facebook.com/plugins/like.php?href='.
urlencode(get_permalink($post->ID))
.'&amp;layout=button_count&amp;show_faces=false&amp;width=200&amp;action=like&amp;colorscheme=light&amp;height=21"
scrolling="no" frameborder="0" style="border:none;
overflow:hidden; width:200px; height:21px;"
allowTransparency="true"></iframe>
                    </div>
                </div>';
    }
    return $content;
}
//add_action('the_content', 'share_this');

/*Automatic NoFollow for External Links*/
add_filter('the_content', 'auto_nofollow');
 
function auto_nofollow($content) {
    //return stripslashes(wp_rel_nofollow($content));
 
    return preg_replace_callback('/<a>]+/', 'auto_nofollow_callback', $content);
}
 
function auto_nofollow_callback($matches) {
    $link = $matches[0];
    $site_link = get_bloginfo('url');
 
    if (strpos($link, 'rel') === false) {
        $link = preg_replace("%(href=S(?!$site_link))%i", 'rel="nofollow" $1', $link);
    } elseif (preg_match("%href=S(?!$site_link)%i", $link)) {
        $link = preg_replace('/rel=S(?!nofollow)S*/i', 'rel="nofollow"', $link);
    }
    return $link;
}

/* Posting Khusus Katalog Produk */
/*add_action( 'init', 'register_cpt_katalog' );

function register_cpt_katalog() {

    $labels = array( 
        'name' => _x( 'Katalog','katalog' ),
        'singular_name' => _x( 'Katalog','katalog' ),
        'add_new' => _x( 'Add New', 'testimony' ),
        'add_new_item' => _x( 'Add New Katalog','katalog' ),
        'edit_item' => _x( 'Edit Katalog','katalog' ),
        'new_item' => _x( 'New Katalog','katalog' ),
        'view_item' => _x( 'View Katalog','katalog' ),
        'search_items' => _x( 'Search Katalog','katalog' ),
        'not_found' => _x( 'No Testimony found', 'testimony' ),
        'not_found_in_trash' => _x( 'No Testimony found in Trash', 'testimony' ),
        'parent_item_colon' => _x( 'Parent testimony:', 'testimony' ),
        'menu_name' => _x( 'Katalog','katalog' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Katalog Page',
        'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
        'taxonomies' => array( 'category', 'post_tag', 'katalog' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 22,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'Katalog Produk',$args );
}
*/
/* Posting Khusus Slideshow Depan */
add_action( 'init', 'register_cpt_slideshow' );

function register_cpt_slideshow() {

    $labels = array( 
        'name' => _x( 'Slideshow','slideshow' ),
        'singular_name' => _x( 'Slideshow','slideshow' ),
        'add_new' => _x( 'Add New', 'slideshow' ),
        'add_new_item' => _x( 'Add New Slideshow','slideshow' ),
        'edit_item' => _x( 'Edit Slideshow','slideshow' ),
        'new_item' => _x( 'New Slideshow','slideshow' ),
        'view_item' => _x( 'View Slideshow','slideshow' ),
        'search_items' => _x( 'Search Slideshow','slideshow' ),
        'not_found' => _x( 'No Slideshow found', 'slideshow' ),
        'not_found_in_trash' => _x( 'No Slideshow found in Trash', 'slideshow' ),
        'parent_item_colon' => _x( 'Parent slideshow:', 'slideshow' ),
        'menu_name' => _x( 'Slideshow','slideshow' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Slideshow Page',
        'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
        'taxonomies' => array( 'category', 'post_tag','slideshow' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 22,
        'menu_icon' => get_template_directory_uri().'/images/monitor.png',  // Icon Path
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'slideshow',$args );
}



/** EVENT META BOX **/
require_once('event-posts.php');
//require_once('meta-produk.php');
//require_once('dashboard-widget.php');
require_once('custom-login-logo.php');
require_once('produk-post-type.php');
require_once('portfolio-post-type.php');
require_once('demo.php');
//require_once('dashboard-role.php');
//require_once('owngallery.php');


?>

