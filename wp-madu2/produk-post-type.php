<?php
/*
Plugin Name: Produk Post Type
Plugin URI: http://www.wptheming.com
Description: Enables a produk post type and taxonomies.
Version: 0.4
Author: Devin Price
Author URI: http://wptheming.com/produk-post-type/
License: GPLv2
*/

if ( ! class_exists( 'Produk_Post_Type' ) ) :

class Produk_Post_Type {

	// Current plugin version
	var $version = 0.4;
	
	function __construct() {
	
		// Runs when the plugin is activated
		register_activation_hook( __FILE__, array( &$this, 'plugin_activation' ) );
		
		// Add support for translations
		load_plugin_textdomain( 'produkposttype', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		
		// Adds the produk post type and taxonomies
		add_action( 'init', array( &$this, 'produk_init' ) );
		
		// Thumbnail support for produk posts
		//add_theme_support( 'post-thumbnails', array( 'produk' ) );
		
		// Adds columns in the admin view for thumbnail and taxonomies
		add_filter( 'manage_edit-produk_columns', array( &$this, 'produk_edit_columns' ) );
		add_action( 'manage_posts_custom_column', array( &$this, 'produk_column_display' ), 10, 2 );
		
		// Allows filtering of posts by taxonomy in the admin view
		add_action( 'restrict_manage_posts', array( &$this, 'produk_add_taxonomy_filters' ) );
		
		// Show produk post counts in the dashboard
		add_action( 'right_now_content_table_end', array( &$this, 'add_produk_counts' ) );
		
		// Give the produk menu item a unique icon
		add_action( 'admin_head', array( &$this, 'produk_icon' ) );
	}
	
	/**
	 * Flushes rewrite rules on plugin activation to ensure produk posts don't 404
	 * http://codex.wordpress.org/Function_Reference/flush_rewrite_rules
	 */
	
	function plugin_activation() {
		$this->produk_init();
		flush_rewrite_rules();
	}
	
	function produk_init() {
	
		/**
		 * Enable the Produk custom post type
		 * http://codex.wordpress.org/Function_Reference/register_post_type
		 */
	
		$labels = array(
			'name' => __( 'Produk', 'produkposttype' ),
			'singular_name' => __( 'Produk Item', 'produkposttype' ),
			'add_new' => __( 'Add New Item', 'produkposttype' ),
			'add_new_item' => __( 'Add New Produk Item', 'produkposttype' ),
			'edit_item' => __( 'Edit Produk Item', 'produkposttype' ),
			'new_item' => __( 'Add New Produk Item', 'produkposttype' ),
			'view_item' => __( 'View Item', 'produkposttype' ),
			'search_items' => __( 'Search Produk', 'produkposttype' ),
			'not_found' => __( 'No produk items found', 'produkposttype' ),
			'not_found_in_trash' => __( 'No produk items found in trash', 'produkposttype' )
		);
	
		$args = array(
	    	'labels' => $labels,
	    	'public' => true,
			'description' => 'Kelola produk',
        	'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', 'revisions', 'page-attributes' ),

			//'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'custom-fields', 'revisions' ),
			//'supports' => array( 'title', 'editor', 'thumbnail','custom-fields', 'revisions' ),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "produk"), // Permalinks format
			'menu_position' => 5,
			'has_archive' => true,
			'menu_icon' => get_template_directory_uri().'/images/cart.png'  // Icon Path
		); 
	
		register_post_type( 'produk', $args );
		
		/**
		 * Register a taxonomy for Produk Tags
		 * http://codex.wordpress.org/Function_Reference/register_taxonomy
		 */
		
		$taxonomy_produk_tag_labels = array(
			'name' => _x( 'Produk Tags', 'produkposttype' ),
			'singular_name' => _x( 'Produk Tag', 'produkposttype' ),
			'search_items' => _x( 'Search Produk Tags', 'produkposttype' ),
			'popular_items' => _x( 'Popular Produk Tags', 'produkposttype' ),
			'all_items' => _x( 'All Produk Tags', 'produkposttype' ),
			'parent_item' => _x( 'Parent Produk Tag', 'produkposttype' ),
			'parent_item_colon' => _x( 'Parent Produk Tag:', 'produkposttype' ),
			'edit_item' => _x( 'Edit Produk Tag', 'produkposttype' ),
			'update_item' => _x( 'Update Produk Tag', 'produkposttype' ),
			'add_new_item' => _x( 'Add New Produk Tag', 'produkposttype' ),
			'new_item_name' => _x( 'New Produk Tag Name', 'produkposttype' ),
			'separate_items_with_commas' => _x( 'Separate produk tags with commas', 'produkposttype' ),
			'add_or_remove_items' => _x( 'Add or remove produk tags', 'produkposttype' ),
			'choose_from_most_used' => _x( 'Choose from the most used produk tags', 'produkposttype' ),
			'menu_name' => _x( 'Produk Tags', 'produkposttype' )
		);
		
		$taxonomy_produk_tag_args = array(
			'labels' => $taxonomy_produk_tag_labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'produk_tag' ),
			'query_var' => true
		);
		
		register_taxonomy( 'produk_tag', array( 'produk' ), $taxonomy_produk_tag_args );
		
		/**
		 * Register a taxonomy for Produk Categories
		 * http://codex.wordpress.org/Function_Reference/register_taxonomy
		 */
	
	    $taxonomy_produk_category_labels = array(
			'name' => _x( 'Produk Categories', 'produkposttype' ),
			'singular_name' => _x( 'Produk Category', 'produkposttype' ),
			'search_items' => _x( 'Search Produk Categories', 'produkposttype' ),
			'popular_items' => _x( 'Popular Produk Categories', 'produkposttype' ),
			'all_items' => _x( 'All Produk Categories', 'produkposttype' ),
			'parent_item' => _x( 'Parent Produk Category', 'produkposttype' ),
			'parent_item_colon' => _x( 'Parent Produk Category:', 'produkposttype' ),
			'edit_item' => _x( 'Edit Produk Category', 'produkposttype' ),
			'update_item' => _x( 'Update Produk Category', 'produkposttype' ),
			'add_new_item' => _x( 'Add New Produk Category', 'produkposttype' ),
			'new_item_name' => _x( 'New Produk Category Name', 'produkposttype' ),
			'separate_items_with_commas' => _x( 'Separate produk categories with commas', 'produkposttype' ),
			'add_or_remove_items' => _x( 'Add or remove produk categories', 'produkposttype' ),
			'choose_from_most_used' => _x( 'Choose from the most used produk categories', 'produkposttype' ),
			'menu_name' => _x( 'Produk Categories', 'produkposttype' ),
	    );
		
	    $taxonomy_produk_category_args = array(
			'labels' => $taxonomy_produk_category_labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => true,
			'rewrite' => array( 'slug' => 'produk_category' ),
			'query_var' => true,
			
	    );
		
	    register_taxonomy( 'produk_category', array( 'produk' ), $taxonomy_produk_category_args );
		
	}
	 
	/**
	 * Add Columns to Produk Edit Screen
	 * http://wptheming.com/2010/07/column-edit-pages/
	 */
	 
	function produk_edit_columns( $produk_columns ) {
		$produk_columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => _x('Title', 'column name'),
			"thumbnail" => __('Thumbnail', 'produkposttype'),
			"produk_category" => __('Category', 'produkposttype'),
			"produk_tag" => __('Tags', 'produkposttype'),
			"author" => __('Author', 'produkposttype'),
			"comments" => __('Comments', 'produkposttype'),
			"date" => __('Date', 'produkposttype'),
		);
		$produk_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
		return $produk_columns;
	}
	
	function produk_column_display( $produk_columns, $post_id ) {
	
		// Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview
		
		switch ( $produk_columns ) {
			
			// Display the thumbnail in the column view
			case "thumbnail":
				$width = (int) 35;
				$height = (int) 35;
				$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
				
				// Display the featured image in the column view if possible
				if ( $thumbnail_id ) {
					$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
				}
				if ( isset( $thumb ) ) {
					echo $thumb;
				} else {
					echo __('None', 'produkposttype');
				}
				break;	
				
			// Display the produk tags in the column view
			case "produk_category":
			
			if ( $category_list = get_the_term_list( $post_id, 'produk_category', '', ', ', '' ) ) {
				echo $category_list;
			} else {
				echo __('None', 'produkposttype');
			}
			break;	
				
			// Display the produk tags in the column view
			case "produk_tag":
			
			if ( $tag_list = get_the_term_list( $post_id, 'produk_tag', '', ', ', '' ) ) {
				echo $tag_list;
			} else {
				echo __('None', 'produkposttype');
			}
			break;			
		}
	}
	
	/**
	 * Adds taxonomy filters to the produk admin page
	 * Code artfully lifed from http://pippinsplugins.com
	 */
	 
	function produk_add_taxonomy_filters() {
		global $typenow;
		
		// An array of all the taxonomyies you want to display. Use the taxonomy name or slug
		$taxonomies = array( 'produk_category', 'produk_tag' );
	 
		// must set this to the post type you want the filter(s) displayed on
		if ( $typenow == 'produk' ) {
	 
			foreach ( $taxonomies as $tax_slug ) {
				$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
				$tax_obj = get_taxonomy( $tax_slug );
				$tax_name = $tax_obj->labels->name;
				$terms = get_terms($tax_slug);
				if ( count( $terms ) > 0) {
					echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
					echo "<option value=''>$tax_name</option>";
					foreach ( $terms as $term ) {
						echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
					}
					echo "</select>";
				}
			}
		}
	}
	
	/**
	 * Add Produk count to "Right Now" Dashboard Widget
	 */
	
	function add_produk_counts() {
	        if ( ! post_type_exists( 'produk' ) ) {
	             return;
	        }
	
	        $num_posts = wp_count_posts( 'produk' );
	        $num = number_format_i18n( $num_posts->publish );
	        $text = _n( 'Produk Item', 'Produk Items', intval($num_posts->publish) );
	        if ( current_user_can( 'edit_posts' ) ) {
	            $num = "<a href='edit.php?post_type=produk'>$num</a>";
	            $text = "<a href='edit.php?post_type=produk'>$text</a>";
	        }
	        echo '<td class="first b b-produk">' . $num . '</td>';
	        echo '<td class="t produk">' . $text . '</td>';
	        echo '</tr>';
	
	        if ($num_posts->pending > 0) {
	            $num = number_format_i18n( $num_posts->pending );
	            $text = _n( 'Produk Item Pending', 'Produk Items Pending', intval($num_posts->pending) );
	            if ( current_user_can( 'edit_posts' ) ) {
	                $num = "<a href='edit.php?post_status=pending&post_type=produk'>$num</a>";
	                $text = "<a href='edit.php?post_status=pending&post_type=produk'>$text</a>";
	            }
	            echo '<td class="first b b-produk">' . $num . '</td>';
	            echo '<td class="t produk">' . $text . '</td>';
	
	            echo '</tr>';
	        }
	}
	
	/**
	 * Displays the custom post type icon in the dashboard
	 */
	 
	function produk_icon() { ?>
	    <style type="text/css" media="screen">
	        #menu-posts-produk .wp-menu-image {
	            background: url(<?php echo get_template_directory_uri() ?>/images/cart.png) no-repeat 6px 6px !important;
	        }
			#menu-posts-produk:hover .wp-menu-image, #menu-posts-produk.wp-has-current-submenu .wp-menu-image {
	            background-position:6px -16px !important;
	        }
			#icon-edit.icon32-posts-produk {background: url(<?php echo plugin_dir_url( __FILE__ ); ?>images/produk-32x32.png) no-repeat;}
	    </style>
	<?php }
	
}

new Produk_Post_Type;

endif;