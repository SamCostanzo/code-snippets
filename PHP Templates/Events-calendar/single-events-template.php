<?php
    // TEMPLATE: Used for the single view of the events posts.
    // Remove .page-hero-container if not needed.
?>

<?php get_header(); ?>

<section class="page-hero-container">
    <div class="page-hero-background" style="background: url('/wp-content/uploads/2022/12/concert-crowd-on-a-music-concert-2022-06-07-13-01-45-utc-scaled.jpg') center center no-repeat; background-size:cover;">
        <div class="page-hero-wrapper">
            <div class="page-hero-content">
                <h2 class="page-hero-main-heading"><?= the_title(); ?></h2>
                <h4 class="custom-breadcrumbs">
                    <a href="/">Home</a> /
                    <a href="/events">Events</a>
                </h4>
            </div>
        </div>
    </div>
    <div class="page-hero-overlay"></div>
</section>

<section class="single-event-container">
    <main>
        <div class="single-event-flex-container">
            <div class="single-event-left">
                <h4 class="single-event-when"><span class="red-underline when-underline">When</span></h4>
                <h4 class="event-date"><?php the_field("event_date"); ?></h4>
                <h4 class="event-time"><?php the_field("event_time"); ?></h4>
                <h4 class="single-event-when"><span class="red-underline when-underline">Where</span></h4>
                <h4 class="event-location">830 Varick Street, Utica, NY 13502</h4>
            </div>
            <div class="single-event-right">
                <?php the_field("event_description"); ?>
                
                <?php if(get_field("event_button_text")) : ?>
                    <a class="slider-button" href="<?php the_field("event_button_link"); ?>">
                        <?php the_field("event_button_text"); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </main>
</section>

<?php get_footer(); ?>