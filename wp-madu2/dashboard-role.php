<?php

function customize_meta_boxes() {
     //retrieve current user info
     global $current_user;
     get_currentuserinfo();

     //if current user level is less than 3, remove the postcustom meta box
     if ($current_user->user_level < 3)
          remove_meta_box('postcustom','post','normal');
}

add_action('admin_init','customize_meta_boxes');

?>