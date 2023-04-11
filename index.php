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
  
















  
