<?php
$prefix = 'dbt_';

$meta_box = array(
    'id' => 'my-meta-box',
    'title' => 'Rating System',
    'page' => 'barang',
    'context' => 'side',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Affialiate Url',
            'desc' => 'Enter affiliate url',
            'id' => $prefix . 'affurl',
            'type' => 'text',
            'std' => 'http://'
        ),
		 array(
            'name' => 'Top Review',
            'id' => $prefix . 'topreview',
            'type' => 'checkbox'
        ),
        array(
            'name' => 'Top Review Rating Stars',
            'id' => $prefix . 'topstar',
            'type' => 'select',
			'std' => '0',
            'options' => array(
				'0','1', '2', '3','4','5')
        ),
		array(
            'name' => 'Top Review Rank Number',
            'id' => $prefix . 'toprank',
            'type' => 'select',
			'std' => '0',
            'options' => array(
				'0','1', '2','3')
        ),
		array(
            'type' => 'hr'	
        ),
		array(
            'name' => 'Most Popular',
            'id' => $prefix . 'mostpopular',
            'type' => 'checkbox'
        ),
		 array(
            'name' => 'Most Popular Review Rating Stars',
            'id' => $prefix . 'popularstar',
            'type' => 'select',
			'std' => '0',
            'options' => array(
				'0','1', '2', '3','4','5')
        ),
		array(
            'name' => 'Most Popular Review Rank Number',
            'id' => $prefix . 'popularrank',
            'type' => 'select',
			'std' => '0',
            'options' => array(
				'0','1', '2','3')
        ),
		array(
            'type' => 'hr'	
        ),
		array(
            'name' => 'Recommended',
            'id' => $prefix . 'recommended',
            'type' => 'checkbox'
        ),
		array(
            'name' => 'Recommended Review Rating Stars',
            'id' => $prefix . 'recommendstar',
            'type' => 'select',
			'std' => '0',
            'options' => array(
				'0','1', '2', '3','4','5')
        ),
		array(
            'name' => 'Most Popular Review Rank Number',
            'id' => $prefix . 'recommendrank',
            'type' => 'select',
			'std' => '0',
            'options' => array(
				'0','1', '2','3')
        ),
    )
);
add_action('admin_menu', 'mytheme_add_box');

// Add meta box
function mytheme_add_box() {
    global $meta_box;

    add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

// Callback function to show fields in meta box
function mytheme_show_box() {
    global $meta_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td columnspan=3 border=1>';
        switch ($field['type']) {
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['desc'];
                break;
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />', $field['desc'];
                break;
            case 'select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                echo '</select>';
                break;
			case 'topreview':
                
                break;
            case 'radio':
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                break;
			case 'hr':
				echo '<hr height=1 >';
				break;
		}
        echo     '<td>',
            '</tr>';
    }

    echo '</table>';
}

add_action('save_post', 'mytheme_save_data');

// Save data from meta box
function mytheme_save_data($post_id) {
    global $meta_box;

    // verify nonce
    if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    foreach ($meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}
?>