<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'madu_';

global $meta_boxes;

$meta_boxes = array();

// 1st meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'panelproduk',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Advanced Panel',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'produk' ),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'side',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'  => 'Kode Produk',
			'id'    => "{$prefix}kode",
			'desc'  => 'Kode Produk',
			'type'  => 'text',
			'std'   => '',
		),
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Harga Produk',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}harga",
			// Field description (optional)
			'desc'  => 'Harga Produk Sekarang (Rp)',
			'type'  => 'text',
			// Default value (optional)
			'std'   => 'Rp.',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			//'clone' => true,
		),	
		array(
			'name'  => 'Harga Spesial',
			'id'    => "{$prefix}hargaspecial",
			'desc'  => 'Harga Produk Spesial (Rp)',
			'type'  => 'text',
			'std'   => 'Rp.',
		),
		// CHECKBOX
		array(
			'name' => 'Coret Harga Lama',
			'id'   => "{$prefix}coretharga",
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 1,
		),
		// RADIO BUTTONS
		array(
			'name'    => 'Stok Produk',
			'id'      => "{$prefix}stokproduk",
			'type'    => 'select',
			// Array of 'value' => 'Label' pairs for radio options.
			// Note: the 'value' is stored in meta field, not the 'Label'
			'options' => array(
				'ready' => 'Tersedia',
				'soldout' => 'Habis',
			),
		),
		array(
			'name'  => 'Jumlah Stok',
			'id'    => "{$prefix}stokproduk",
			'desc'  => 'Jumlah Barang Tersisa (Pcs)',
			'type'  => 'text',
			'std'   => '',
		),
		array(
			'name'    => 'Badge Khusus',
			'id'      => "{$prefix}badge",
			'type'    => 'select',
			// Array of 'value' => 'Label' pairs for radio options.
			// Note: the 'value' is stored in meta field, not the 'Label'
			'options' => array(
				'new' => 'New',
				'laris' => 'Best Seller',
				'populer' => 'Most Popular',
				'limited' => 'Limited Edition',
			),
		),
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Properties Tambahan',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}tambahan",
			// Field description (optional)
			'desc'  => 'Ukuran, Type, Dimensi, Panjang, Lebar,dsb',
			'type'  => 'text',
			// Default value (optional)
			'std'   => '',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => true,
		),	
	),
	/*'validation' => array(
		'rules' => array(
			"{$prefix}password" => array(
				'required'  => true,
				'minlength' => 7,
			),
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}password" => array(
				'required'  => 'Password is required',
				'minlength' => 'Password must be at least 7 characters',
			),
		)
	)*/
);

// 2nd meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'advancedpanel',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Panel Advanced',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'produk' ),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',


	'fields' => array(
		// NUMBER
		array(
			'name' => 'Number',
			'id'   => "{$prefix}number",
			'type' => 'number',

			'min'  => 0,
			'step' => 5,
		),
		// DATE
		array(
			'name' => 'Date picker',
			'id'   => "{$prefix}date",
			'type' => 'date',

			// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
			'js_options' => array(
				'appendText'      => '(yyyy-mm-dd)',
				'dateFormat'      => 'yy-mm-dd',
				'changeMonth'     => true,
				'changeYear'      => true,
				'showButtonPanel' => true,
			),
		),
		// DATETIME
		array(
			'name' => 'Datetime picker',
			'id'   => $prefix . 'datetime',
			'type' => 'datetime',

			// jQuery datetime picker options. See here http://trentrichardson.com/examples/timepicker/
			'js_options' => array(
				'stepMinute'     => 15,
				'showTimepicker' => true,
			),
		),
		// TIME
		array(
			'name' => 'Time picker',
			'id'   => $prefix . 'time',
			'type' => 'time',

			// jQuery datetime picker options. See here http://trentrichardson.com/examples/timepicker/
			'js_options' => array(
				'stepMinute' => 5,
				'showSecond' => true,
				'stepSecond' => 10,
			),
		),
		// COLOR
		array(
			'name' => 'Color picker',
			'id'   => "{$prefix}color",
			'type' => 'color',
		),
		// CHECKBOX LIST
		array(
			'name' => 'Checkbox list',
			'id'   => "{$prefix}checkbox_list",
			'type' => 'checkbox_list',
			// Options of checkboxes, in format 'value' => 'Label'
			'options' => array(
				'value1' => 'Label1',
				'value2' => 'Label2',
			),
		),
		// TAXONOMY
		array(
			'name'    => 'Taxonomy',
			'id'      => "{$prefix}taxonomy",
			'type'    => 'taxonomy',
			'options' => array(
				// Taxonomy name
				'taxonomy' => 'category',
				// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree' or 'select'. Optional
				'type' => 'select_tree',
				// Additional arguments for get_terms() function. Optional
				'args' => array()
			),
		),
		// WYSIWYG/RICH TEXT EDITOR
		array(
			'name' => 'WYSIWYG / Rich Text Editor',
			'id'   => "{$prefix}wysiwyg",
			'type' => 'wysiwyg',
			'std'  => 'WYSIWYG default value',

			// Editor settings, see wp_editor() function: look4wp.com/wp_editor
			'options' => array(
				'textarea_rows' => 4,
				'teeny'         => true,
				'media_buttons' => false,
			),
		),
		// FILE UPLOAD
		array(
			'name' => 'File Upload',
			'id'   => "{$prefix}file",
			'type' => 'file',
		),
		// IMAGE UPLOAD
		array(
			'name' => 'Image Upload',
			'id'   => "{$prefix}image",
			'type' => 'image',
		),
		// THICKBOX IMAGE UPLOAD (WP 3.3+)
		array(
			'name' => 'Thichbox Image Upload',
			'id'   => "{$prefix}thickbox",
			'type' => 'thickbox_image',
		),
		// PLUPLOAD IMAGE UPLOAD (WP 3.3+)
		array(
			'name'             => 'Plupload Image Upload',
			'id'               => "{$prefix}plupload",
			'type'             => 'plupload_image',
			'max_file_uploads' => 4,
		),
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
//function YOUR_PREFIX_register_meta_boxes()
function madu_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'madu_register_meta_boxes' );