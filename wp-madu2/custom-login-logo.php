<?php
function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_bloginfo('template_directory').'/images/logobinaapiari128.png) !important;
        		height:145px !important;
        		display:block;
        		background-size:128px 148px !important;
         }
    </style>';
}


add_action('login_head', 'my_custom_login_logo');



?>