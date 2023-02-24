<?php
    // Template Name: Events Calendar
    // Used to show the calendar of events Custom Post Type
?>

<?php get_header(); ?>

<?php // Page Hero If Needed ?>
<?php get_template_part('template-parts/page-hero-2'); ?>

<main>
    <?php // Events Calendar Top ?>
    <?php get_template_part('template-parts/events-calendar-top'); ?>
    
    <?php 
        $today = date('Ymd'); // Get today's date
        // dd($today);
        $the_query = new WP_Query([
            'post_type' => 'events',
            'posts_per_page' => 20,
            'offset' => 1,  // Skip the first post, since it's being featured at the top of the page
            'visibility' => 'public',
            'post_status' => 'publish',
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'event_date', 
                    'value' => $today,
                    'compare' => '>=', // Compare the date and time value of the event to the current date, only get posts that are in the future.
                ),
            ),
        ]); 
    ?>


    <section class="events-calendar">
        <div class="beverage-heading-container">
            <h2 class="brews-banner-heading">Upcoming <span class="red-underline">Events</span></h2>
        </div>
        
        <div class="events-calendar-grid">
            <?php if ( $the_query->have_posts() ) : ?>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>  
                    <div class="event-card" style="background-image: url(<?php echo get_field("event_image") ? the_field("event_image") : '/wp-content/uploads/2022/12/concert-crowd-on-a-music-concert-2022-06-07-13-01-45-utc-scaled.jpg'; ?>)">
                        <a href="<?php the_permalink(); ?>">
                            <h3 class="event-title"><?php echo the_title(); ?></h3>
                            <h4 class="event-date"><?php the_field("event_date"); ?></h4>
                            <h4 class="event-time"><?php the_field("event_time"); ?></h4>
                            <div class="custom-overlay-event"></div>
                        </a>
                    </div>
                <?php endwhile; ?> 
            <?php endif; ?>  
        </div>  
    </section>
</main>

<?php get_footer(); ?>