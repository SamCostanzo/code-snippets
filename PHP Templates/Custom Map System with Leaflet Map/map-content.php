<?php
    // Template part for the leaflet map content used in the loop
    // This code is taken from the Cultivate Herkimer website, so just replace the ACF names with the ones you need
    
    // $map_coordinates has both the lat and long as a single string, with the values seperated by a comma. 
    // (Map coords are taken from Google Maps manually)
    $map_coordinates = get_field('farm_location_map_coordinates');
    
    // Use explode() to seperate that string by the comma. Returns an array with the two values. 
    // Using trim() to get rid of the whitespace on either side of the string.
    $map_coordinates_array = array_map('trim', explode(",", $map_coordinates));

    // Setting lat to the first item in that array, and long to the second.
    $lat = $map_coordinates_array[0];
    $long = $map_coordinates_array[1];
    
    // Custom Field Vars
    $farm_location_title = get_the_title();
    $permalink = get_the_permalink();
    $farm_address = get_field('farm_address');
    $owner_farmer = get_field('owner_farmer');
    $farm_city = get_field('farm_city');
    $farm_state = get_field('farm_state');
    $farm_zip_code = get_field('farm_zip_code');
    $farm_phone_number = get_field('farm_phone_number');
    $full_address = $farm_address . ', ' . $farm_city . ', ' . $farm_state . ' ' . $farm_zip_code;
    
    $map_marker_content = "
        <div class='map-marker-content-container'>
            <h4>$farm_location_title</h4>
            <p class='map-marker-text'>$full_address</p>
            <p class='map-marker-text'><strong>Owner/farmer:</strong> $owner_farmer</p>
            <p class='map-marker-text'><strong>Phone:</strong> $farm_phone_number</p>
            <div class='map-marker-divider'></div> 
            <a href='$permalink' class='map-marker-button'>View</a>
        </div>
    ";
?>

<?php echo do_shortcode("[leaflet-marker lat=$lat lng=$long] $map_marker_content [/leaflet-marker]"); ?>