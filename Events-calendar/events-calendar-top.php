<?php
    // Template Part: Events Calendar Top
    // Used to show the next event right at the top of the events page. Used in the main template.
?>

<?php 
    $today = date('Ymd'); // Get today's date
    $the_query = new WP_Query([
        'post_type' => 'events',
        'posts_per_page' => 1,
        'visibility' => 'public',
        'post_status' => 'publish',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'event_date', // this is the custom field name for the event date
                'value' => $today,
                'compare' => '>=', // Compare the date and time value of the event to the current date, only get posts that are in the future.
            ),
        ),
    ]); 
?>

<section class="event-calendar-top">

    <div class="beverage-heading-container calendar-top-heading">
            <h2 class="brews-banner-heading">Coming up <span class="red-underline">Next</span></h2>
        </div>

    <?php if ( $the_query->have_posts() ) : ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>  
            <div class="event-card" style="background-image: url(<?php echo get_field("event_image") ? the_field("event_image") : '/wp-content/uploads/2022/12/concert-crowd-on-a-music-concert-2022-06-07-13-01-45-utc-scaled.jpg'; ?>)">
                <a class="event-card-top-link" href="<?php the_permalink(); ?>">
                    <!-- <h3 class="event-title"><?php // echo the_title(); ?></h3>
                    <h4 class="event-date"><?php // the_field("event_date"); ?></h4>
                    <h4 class="event-time"><?php // the_field("event_time"); ?></h4> -->
                    <!-- <div class="custom-overlay-event"></div> -->
                </a>
            </div>

            <div class="event-calendar-top-text-under-card">
                <h4 class="event-date"><?php the_field("event_date"); ?></h4>
                <h3 class="event-title">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo the_title(); ?>
                    </a>    
                </h3>
                <?php the_field("event_description"); ?>
                <h4 class="event-time"><span class="red-underline event-time-underline"><?php the_field("event_time"); ?></span></h4>
            </div>

        <?php endwhile; ?> 
    <?php endif; ?>  
</section>

<hr class="events-calendar-divider">