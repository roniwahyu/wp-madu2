<?php
/* Posting Khusus Item Produk  */
add_action( 'init', 'register_cpt_produk' );

function register_cpt_produk() {

    $labels = array( 
        'name' => _x( 'Produk','produk' ),
        'singular_name' => _x( 'Produk','produk' ),
        'add_new' => _x( 'Add New', 'produk' ),
        'add_new_item' => _x( 'Add New Produk','produk' ),
        'edit_item' => _x( 'Edit Produk','produk' ),
        'new_item' => _x( 'Produk Baru','produk' ),
        'view_item' => _x( 'Lihat Produk','produk' ),
        'search_items' => _x( 'Cari Produk','produk' ),
        'not_found' => _x( 'Tidak ada produk terdaftar', 'produk' ),
        'not_found_in_trash' => _x( 'Tidak Ada produk di Tempat Sampah', 'produk' ),
        'parent_item_colon' => _x( 'Parent Produk:', 'produk' ),
        'menu_name' => _x( 'Kelola Produk','produk' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Kelola produk',
        'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', 'revisions', 'page-attributes' ),
        //	'taxonomies' => array( 'category', 'post_tag','produk' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 22,
        'menu_icon' => get_template_directory_uri().'/images/cart.png',  // Icon Path
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
   // echo var_dump($args);
    register_post_type( 'produk',$args );

    /**
		 * Register a taxonomy for produk Tags
		 * http://codex.wordpress.org/Function_Reference/register_taxonomy
		 */
		
		$taxonomy_produk_tag_labels = array(
			'name' => _x( 'produk Tags', 'produkposttype' ),
			'singular_name' => _x( 'produk Tag', 'produkposttype' ),
			'search_items' => _x( 'Search produk Tags', 'produkposttype' ),
			'popular_items' => _x( 'Popular produk Tags', 'produkposttype' ),
			'all_items' => _x( 'All produk Tags', 'produkposttype' ),
			'parent_item' => _x( 'Parent produk Tag', 'produkposttype' ),
			'parent_item_colon' => _x( 'Parent produk Tag:', 'produkposttype' ),
			'edit_item' => _x( 'Edit produk Tag', 'produkposttype' ),
			'update_item' => _x( 'Update produk Tag', 'produkposttype' ),
			'add_new_item' => _x( 'Add New produk Tag', 'produkposttype' ),
			'new_item_name' => _x( 'New produk Tag Name', 'produkposttype' ),
			'separate_items_with_commas' => _x( 'Separate produk tags with commas', 'produkposttype' ),
			'add_or_remove_items' => _x( 'Add or remove produk tags', 'produkposttype' ),
			'choose_from_most_used' => _x( 'Choose from the most used produk tags', 'produkposttype' ),
			'menu_name' => _x( 'produk Tags', 'produkposttype' )
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
		 * Register a taxonomy for produk Categories
		 * http://codex.wordpress.org/Function_Reference/register_taxonomy
		 */
	
	    $taxonomy_produk_category_labels = array(
			'name' => _x( 'produk Categories', 'produkposttype' ),
			'singular_name' => _x( 'produk Category', 'produkposttype' ),
			'search_items' => _x( 'Search produk Categories', 'produkposttype' ),
			'popular_items' => _x( 'Popular produk Categories', 'produkposttype' ),
			'all_items' => _x( 'All produk Categories', 'produkposttype' ),
			'parent_item' => _x( 'Parent produk Category', 'produkposttype' ),
			'parent_item_colon' => _x( 'Parent produk Category:', 'produkposttype' ),
			'edit_item' => _x( 'Edit produk Category', 'produkposttype' ),
			'update_item' => _x( 'Update produk Category', 'produkposttype' ),
			'add_new_item' => _x( 'Add New produk Category', 'produkposttype' ),
			'new_item_name' => _x( 'New produk Category Name', 'produkposttype' ),
			'separate_items_with_commas' => _x( 'Separate produk categories with commas', 'produkposttype' ),
			'add_or_remove_items' => _x( 'Add or remove produk categories', 'produkposttype' ),
			'choose_from_most_used' => _x( 'Choose from the most used produk categories', 'produkposttype' ),
			'menu_name' => _x( 'produk Categories', 'produkposttype' ),
	    );
		
	    $taxonomy_produk_category_args = array(
			'labels' => $taxonomy_produk_category_labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => true,
			'rewrite' => array( 'slug' => 'produk_category' ),
			'query_var' => true
	    );
		
	    register_taxonomy( 'produk_category', array( 'produk' ), $taxonomy_produk_category_args );
}

?>