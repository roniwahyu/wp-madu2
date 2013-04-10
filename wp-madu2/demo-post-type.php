<?php 

/** DEMO POST TYPE **/

add_action('init', 'demo_register_post_type');
  
function demo_register_post_type() {
	    register_post_type('demo', array(
		    'labels' => array(
		    'name' => 'Demos',
		    'singular_name' => 'Demo',
		    'add_new' => 'Add new demo',
		    'edit_item' => 'Edit demo',
		    'new_item' => 'New demo',
		    'view_item' => 'View demo',
		    'search_items' => 'Search demos',
		    'not_found' => 'No demos found',
		    'not_found_in_trash' => 'No demos found in Trash'
	    ),
	    'public' => true,
	    'supports' => array(
	    'title',
	    'excerpt'
    ),
   	 'taxonomies' => array('category', 'post_tag') // this is IMPORTANT
    ));
}
    add_action('init', 'demo_add_default_boxes');
     
    function demo_add_default_boxes() {
   		 register_taxonomy_for_object_type('category', 'demo');
    	register_taxonomy_for_object_type('post_tag', 'demo');
    }
?>