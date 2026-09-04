<?php

function more_events_shortcode($atts) {
    // Define shortcode attributes, if needed
    $atts = shortcode_atts(
        array(
            'posts_per_page' => 15,
        ),
        $atts,
        'more_events'
    );

    // Custom query to retrieve upcoming events
    $events_args = array(
        'post_type' => 'events', // Replace with your custom post type slug
        'posts_per_page' => $atts['posts_per_page'],
        'order' => 'ASC',
        'orderby' => 'meta_value',
        'meta_key' => '_end_date',
        'meta_query' => array(
            array(
                'key' => '_end_date',
                'value' => date('Y-m-d'),
                'compare' => '>=',
                'type' => 'DATE',
            ),
        ),
    );

    $events_query = new WP_Query($events_args);

    ob_start();

    // Check if there are upcoming events
    if ($events_query->have_posts()) :
        while ($events_query->have_posts()) : $events_query->the_post();
            $post_id = get_the_ID();
            $text = get_the_content();
            $brief_text = get_the_excerpt();
            $url =  get_post_meta(get_the_ID(), '_link', true);
            $location =  get_post_meta(get_the_ID(), '_location', true);
            $start_date = get_post_meta(get_the_ID(), '_start_date', true);
            $end_date = get_post_meta(get_the_ID(), '_end_date', true);
            $formatted_start_date = date('jS, F Y', strtotime($start_date)); // Format for Date
            $formatted_start_month = date('F', strtotime($start_date)); // Format for Month
            $formatted_start_time = date('g:i A', strtotime($start_date)); // Format for Time
            $formatted_end_date = date('jS, F Y', strtotime($end_date)); // Format for Date
            $formatted_end_month = date('F', strtotime($end_date)); // Format for Month
            $formatted_end_time = date('g:i A', strtotime($end_date)); // Format for Time
            ?>
            
            <div class="box all_events mb-4" data-aos="fade-up">
                <div class="columns is-mobile is-vcentered">
                <div class="column is-3">
                    <?php
                        $photo_url = get_the_post_thumbnail_url($post_id, 'large'); // You can adjust the image size ('thumbnail', 'medium', 'large', 'full')
                        if ($photo_url) {
                            echo '<figure class="image is-4by3"><img src="' . esc_url($photo_url) . '" alt="Event Photo" /></figure>';
                        } else {
                            echo '<figure class="image is-4by3"><img src="'. get_template_directory_uri().'/assets/images/placeholder-image.jpg" alt="Event Photo" /></figure>';
                        } 
                    ?>
                </div>
                <div class="column is-9">
                    <a href="<?= the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
                    <div class="columns is-mobile">
                        <div class="column time">
                           <span style="font-weight:600;"><small>Date:</small><br/></span>   
                                <?= esc_html($formatted_start_date); ?>
                                <?php if($formatted_end_date){ echo ' - '.$formatted_end_date;} ?>
                        </div>
                        <div class="column time">
                        <span style="font-weight:600;"><small>From:</small></span><br/>  <?= esc_html($location); ?>
                        </div>
                    </div><!-- Date & Time !-->
                    <span class="content">  <?=  $brief_text; ?></span>
                    <div>
                        <a href="<?= the_permalink(); ?>" class="button is-outlined is-danger"> 
                            View details <span class="icon"><i class="fa-solid fa-arrow-right" aria-hidden="true"></i></span>
                        </a>
                    </div>
                </div>
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo 'No latest events.';
    endif;

    return ob_get_clean();
}

add_shortcode('more_events', 'more_events_shortcode');