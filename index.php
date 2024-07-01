<?php 
// PHP REFERENCE, FEBUARY 2023 

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

// Disable Block Editor on specific post types
add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
function prefix_disable_gutenberg($current_status, $post_type){
    // List post types here
    if(
	$post_type === 'product' ||
	$post_type === 'page' ||
        $post_type === 'brew' ||
        $post_type === 'promo-cards' ||
        $post_type === 'slides'
	   ) 
	return false;
    return $current_status;
}

// Shorthand if/else for displaying a custom field.
//  "Get" that field, if it has a value, THEN (?) display it. Or ELSE (:) echo the string 'N/A'
// (Don't forget an echo at the start)
    get_field('abv_value_%') ? the_field('abv_value_%') : 'N/A'; 

// Get an excerpt of the full description, but don't cut off the middle of a word.
// Can adjust the 200 at the end if you want to show more or less words.
// If wanted, you could also add . '...'; at the end if you wanted the preview to end like this...
    $description = get_field('field_name'); 
    $description_short = preg_replace('/\\s\\S*$/', '', substr($description, 0, 200)); 

// SHORTCODE TO DISPLAY ACF FIELDS AS A TABLE IN THE SINGLE PRODUCT ELEMENTOR TEMPLATE (Example, removed most of the table code just to keep it short in this file)
    function custom_table_shortcode() {
        $html = "<table id='events-table'>
        <tbody>
        <tr>
            <td>Event Date</td>
            <td>" . get_acf_field("event_date") . "</td>
        </tr>
        
        </tbody>
    </table>";
    return $html;
    }
    add_shortcode( "events_acf_table", "custom_table_shortcode" );

    // That code would be in its own file, in this case called events-acf-data-table.php
    // Then in functions.php, you can just reference it like this:
    require_once get_stylesheet_directory() . '/events-acf-data-table.php';
    // NOTE: used get_stylesheet_directory() because this would be within a child theme.

// Sanitizes user input by removing any unwanted characters or tags
    function sanitizeInput($input) {
        $input = trim($input); // Remove whitespace from beginning and end of string
        $input = strip_tags($input); // Remove any HTML tags
        $input = htmlentities($input); // Convert any special characters to HTML entities
        return $input;
    }
  
// Generates a random string of a given length
    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

// Formats a number with a given number of decimal places and separators
    function formatNumber($number, $decimals = 2, $decimalSeparator = '.', $thousandsSeparator = ',') {
        return number_format($number, $decimals, $decimalSeparator, $thousandsSeparator);
    }
  
// Checks whether a given email address is valid
    function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
  
// Returns the URL of the current page
    function getCurrentPageUrl() {
        $protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
        $url = $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        return $url;
    }
  

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
        $wp_admin_bar->add_menu(
            array(
                'parent' => 'site-name',
                'id'     => 'custom_link_4',
                'title'  => 'Products',
                'href'   => '/wp-admin/edit.php?post_type=product',
            )
        );
    }
}
add_action('wp_before_admin_bar_render', 'custom_admin_bar_links');





<?php // WP Query Loop

$args = array(
	'post_type' => 'grave',
	'post_status' => 'publish',
	'orderby' => 'title',
	'order'   => 'ASC',
	'posts_per_page' => 10, 
	's' => $search_text,
	'paged' => $paged,
);

$graves_query = new WP_Query( $args );



	
if ( $graves_query->have_posts() ) : 
    while ( $graves_query->have_posts() ) : $graves_query->the_post(); ?>
    
    <?php
	$first_name = get_field('first_name');
	$last_name = get_field('last_name');
    ?>


    <h4><?= $first_name . ' ' . $last_name; ?></h4>
	

    
	<?php wp_reset_postdata(); ?>
    <?php endwhile; ?>
<?php else : ?>
    <h2>No Graves Found!</h2>
<?php endif; ?>









  
