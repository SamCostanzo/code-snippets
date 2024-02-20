<?php

// DD helper 
function dd($data){
    echo '<pre>';
        var_dump($data);
    echo '</pre>';
}

// GET ACF FIELD OR ECHO N/A
function get_acf_field($field_name) {
    if (function_exists('get_field') && get_field($field_name)) {
        return get_field($field_name);
    } else {
        return 'N/A';
    } 
}

// Disable Block editor for every post type.
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);


// Custom Link to 'visit site' admin bar dropdown
function custom_admin_bar_links() {
    global $wp_admin_bar;

    // Check if the user is logged in and has the 'Administrator' role
    if (is_user_logged_in() && current_user_can('administrator')) {

        // Add a custom link to the admin bar under "Visit Site"
        $wp_admin_bar->add_menu(
            array(
                'parent' => 'site-name',
                'id'     => 'custom_link_1',
                'title'  => 'Plugins',
                'href'   => '/wp-admin/plugins.php',
            )
        );
        $wp_admin_bar->add_menu(
            array(
                'parent' => 'site-name',
                'id'     => 'custom_link_2',
                'title'  => 'Pages',
                'href'   => '/wp-admin/edit.php?post_type=page',
            )
        );
        $wp_admin_bar->add_menu(
            array(
                'parent' => 'site-name',
                'id'     => 'custom_link_3',
                'title'  => 'Media',
                'href'   => '/wp-admin/upload.php',
            )
        );
    }
}
add_action('wp_before_admin_bar_render', 'custom_admin_bar_links');
