<?php //Custom Post Type :: UPCOMING EVENTS

function custom_post_type_events() {
    $labels = array(
        'name'                => __('Upcoming Events', 'kipya' ),
        'add_new_item'        => __( 'Add New Event', 'kipya' ),
        'add_new'             => __( 'Add New Event', 'kipya' ),
        'edit_item'           => __( 'Edit Event', 'kipya' ),
        'update_item'         => __( 'Update Event', 'kipya' ),
        'all_items'           => __( 'All Events', 'kipya' ),
        'search_items'        => __( 'Search Event', 'kipya' ),
        'singular_name'       => __('Event'),
    );
    $supports = array(
        'title',        // Post title
        'editor',      // Allows short description
        'thumbnail',    // Allows feature images
    );
    $args = array(
        'labels'              => $labels,
        'description'         => 'For all Upcoming Events', 
        'supports'            => $supports,
        'hierarchical'        => false, 
        'public'              => true,  // Makes the post type public
        'show_ui'             => true,  // Displays an interface for this post type
        'show_in_menu'        => true,  // Displays in the Admin Menu (the left panel)
        'show_in_admin_bar'   => true,  // Displays in the black admin bar
        'menu_position'       => 6,     // The position number in the left menu
        'menu_icon'           => 'dashicons-calendar',  
        'can_export'          => true,  // Allows content export using Tools -> Export
        'has_archive'         => true,  // Enables post type archive (by month, date, or year)
        'exclude_from_search' => false, 
        'capability_type'     => 'post', // Allows read, edit, delete like “Post”
        'register_meta_box_cb' => 'add_custom_meta_boxes_events',
    );
    register_post_type('events', $args);
}
add_action('init', 'custom_post_type_events');

// Register Custom Taxonomy: Event Categories
function register_event_categories_taxonomy() {
    $labels = array(
        'name'              => _x('Event Categories', 'taxonomy general name', 'kipya'),
        'singular_name'     => _x('Event Category', 'taxonomy singular name', 'kipya'),
        'search_items'      => __('Search Event Categories', 'kipya'),
        'all_items'         => __('All Event Categories', 'kipya'),
        'edit_item'         => __('Edit Event Category', 'kipya'),
        'update_item'       => __('Update Event Category', 'kipya'),
        'add_new_item'      => __('Add New Event Category', 'kipya'),
        'new_item_name'     => __('New Event Category Name', 'kipya'),
        'menu_name'         => __('Categories', 'kipya'),
    );

    $args = array(
        'hierarchical'      => true, // Like categories
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'rewrite'           => array('slug' => 'event-category'),
    );

    register_taxonomy('event_category', array('events'), $args);
}
add_action('init', 'register_event_categories_taxonomy');


//Add Custom Meta Boxes on Upcoming Events
function add_custom_meta_boxes_events() {
    add_meta_box('event_details', 'Event Details', 'render_custom_meta_box_events', 'events', 'normal', 'high');
}

// Render custom meta boxes
function render_custom_meta_box_events($post) {
    // Get existing values
    $post_id = $post->ID;
    $start_date = get_post_meta($post->ID, '_start_date', true);
    $end_date = get_post_meta($post->ID, '_end_date', true);
    $location = get_post_meta($post->ID, '_location', true);
    $link = get_post_meta($post->ID, '_link', true);

    // Output fields
    ?>
    <div class="row">
        <div class="col-md-6 mb-3" style="width: 50%; margin-bottom:10px;float:left;">
            <label for="start_date"><b>Start Date</b></label><br/>
            <input type="datetime-local" id="start_date" name="start_date" style="width: 90%;" value="<?= esc_attr($start_date); ?>">
        </div>
        <div class="col-md-6 mb-3" style="width: 50%; margin-bottom:10px;float:left;">
            <label for="end_date"><b>End Date</b></label><br/>
            <input type="datetime-local" id="end_date" name="end_date" style="width: 90%;" value="<?= esc_attr($end_date); ?>">
        </div>
        <div class="col-md-12 mb-3" style="width: 100%; margin-bottom:10px;">
            <label for="location" class="form-label"><b>Location</b></label><br/>
            <textarea id="location" name="location" rows="5" style="width: 100%"><?= esc_textarea($location); ?></textarea>
        </div>
        <div class="col-md-12 mb-3">
            <label for="link" class="form-label"><b>Link</b></label><br/>
            <input type="text" id="link" name="link" style="width: 100%" value="<?= esc_attr($link); ?>">
        </div>
    </div>
    <?php
}

// Save custom meta box data
function save_custom_meta_box_events($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Save custom fields
    // Define an array of field names
    $fields = array('start_date', 'end_date', 'location', 'link');

    // Loop through the fields and update post meta
    foreach ($fields as $field) {
        // Check if the field key is set in $_POST
        if (isset($_POST[$field])) {
            // If set, update post meta
            if ($field === 'location') {
                update_post_meta($post_id, '_' . $field, wp_kses_post($_POST[$field]));
            } else {
                update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
            }
        } else {
            // If not set, handle accordingly (you can leave it empty or provide a default value)
            update_post_meta($post_id, '_' . $field, ''); // Setting it to an empty string in this case
        }
    }

}

add_action('add_meta_boxes', 'add_custom_meta_boxes_events');
add_action('save_post', 'save_custom_meta_box_events');

// Add custom columns to the events post type - DASHBOARD
function add_custom_columns_to_events($columns) {
    // Add new columns
    $columns['event_photo'] = 'Photo';
    $columns['event_start_date'] = 'Start Date';
    $columns['event_end_date'] = 'End Date';
    $columns['event_location'] = 'Location';

    // Remove unwanted columns if needed
    unset($columns['date']); // Remove default date column

    return $columns;
}
add_filter('manage_events_posts_columns', 'add_custom_columns_to_events');

// Populate custom columns with data
function populate_custom_columns($column, $post_id) {
    switch ($column) {
        case 'event_photo':
            // Display the featured image
            $photo_url = get_the_post_thumbnail_url($post_id, 'thumbnail'); // You can adjust the image size ('thumbnail', 'medium', 'large', 'full')
            if ($photo_url) {
                echo '<img src="' . esc_url($photo_url) . '" alt="Event Photo" style="max-height: 50px; width: auto;" />';
            } else {
                echo 'No photo available';
            }
            break;        

        case 'event_start_date':
            // Display the start date
            $start_date = get_post_meta($post_id, '_start_date', true);
            echo esc_html($start_date);
            break;

        case 'event_end_date':
            // Display the end date
            $end_date = get_post_meta($post_id, '_end_date', true);
            echo esc_html($end_date);
            break;

        case 'event_location':
                // Display the end date
                $location = get_post_meta($post_id, '_location', true);
                echo esc_html($location);
                break;
    }
}
add_action('manage_events_posts_custom_column', 'populate_custom_columns', 10, 2);

//For Single job listing Template
function custom_single_template($single) {
    global $post;

    // Check if the post type is 'job_listing'
    if ($post->post_type === 'events') {
        // Path to your custom single template
        $custom_template = locate_template('single-event.php');
        if ($custom_template) {
            return $custom_template;
        }
    }
    // Default template
    return $single;
}
add_filter('single_template', 'custom_single_template');


/** =================================================================
 *  SHORTCODE - UPCOMING EVENTS
 *===================================================================*/
function upcoming_event_shortcode($atts) {
    // Define shortcode attributes, if needed
    $atts = shortcode_atts(
        array(
            'posts_per_page' => 4,
        ),
        $atts,
        'upcoming_events'
    );

    // Custom query to retrieve upcoming events
    $events_args = array(
        'post_type' => 'events', // Replace with your custom post type slug
        'posts_per_page' => $atts['posts_per_page'],
        'order' => 'ASC',
        'orderby' => 'meta_value',
        'meta_key' => '_start_date',
        'meta_query' => array(
            array(
                'key' => '_start_date',
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
        echo '<div class="columns is-multiline">';
        while ($events_query->have_posts()) : $events_query->the_post();
            $post_id = get_the_ID();
            $text = get_the_content();
            $url =  get_post_meta(get_the_ID(), '_link', true);
            $location =  get_post_meta(get_the_ID(), '_location', true);
            $start_date = get_post_meta(get_the_ID(), '_start_date', true);
            $formatted_start_date = date('jS, F Y', strtotime($start_date)); // Format for Date
            $formatted_start_month = date('F', strtotime($start_date)); // Format for Month
            $formatted_start_time = date('g:i A', strtotime($start_date)); // Format for Time
            ?>
            
            <div class="column is-one-quarter-desktop is-half-tablet kpy_events">
            <a href="<?= the_permalink(); ?>" style="cursor: pointer;">
                <div class="card event" data-aos="fade-up">
					<div class="post-thumbnail">
						<?php // Display the post thumbnail
							if (has_post_thumbnail()) {
								the_post_thumbnail(); 
							}else{
								echo '<img src="'. get_template_directory_uri().'/assets/images/photo-placeholder.jpg" alt="UCAA"/>';
							}
						?>
					</div><!-- thumbnail !-->
					<div class="card-content">
					    <div class="date">
					        <span class="icon"><i class="fa-regular fa-calendar" aria-hidden="true"></i></span> <?= esc_html($formatted_start_date); ?>
					    </div>
						<h3><?php the_title(); ?></h3>
						<span class="location"><span class="icon"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></span> <?= esc_html($location); ?></span>
					</div><!-- card content !-->
				</div><!-- card !-->
            </a>
            </div><!-- col !-->
            
            <!-- (Bootstrap offcanvas removed) -->
            <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo 'No upcoming events found.';
        echo '</div>';
    endif;
     
    return ob_get_clean();
}

add_shortcode('upcoming_event', 'upcoming_event_shortcode');


function upcoming_events_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'posts_per_page' => 4,
            'title' => 'Our Upcoming Events'
        ),
        $atts,
        'upcoming_events'
    );

    $events_args = array(
        'post_type' => 'events',
        'posts_per_page' => $atts['posts_per_page'],
        'order' => 'ASC',
        'orderby' => 'meta_value',
        'meta_key' => '_start_date',
        'meta_query' => array(
            array(
                'key' => '_start_date',
                'value' => date('Y-m-d'),
                'compare' => '>=',
                'type' => 'DATE',
            ),
        ),
    );

    $events_query = new WP_Query($events_args);

    ob_start();
     
    if ($events_query->have_posts()) :
        echo '<div class="kpy-events-section">';
        echo '<h2 class="kpy-section-title">' . esc_html($atts['title']) . '</h2>';
        echo '<div class="kpy-events-grid">';
        
        $count = 0;
        while ($events_query->have_posts()) : $events_query->the_post();
            $post_id = get_the_ID();
            $location = get_post_meta(get_the_ID(), '_location', true);
            $start_date = get_post_meta(get_the_ID(), '_start_date', true);
            $formatted_start_date = date('jS, F Y', strtotime($start_date));
            $formatted_start_time = date('g:i A', strtotime($start_date));
            
            if ($count == 0) {
                // First post - big vertical card
                echo '<div class="kpy-event-card-main">';
            } elseif ($count == 1) {
                // Start right column
                echo '<div class="kpy-event-card-side">';
            }
            ?>
            
            <div class="kpy-event-card <?php echo ($count == 0) ? 'main-card' : 'side-card'; ?>">
                <a href="<?php the_permalink(); ?>">
                    <div class="event-card-inner">
                        <div class="event-thumbnail">
                            <?php if (has_post_thumbnail()) {
                                the_post_thumbnail('large', ['class' => 'event-image']); 
                            } else {
                                echo '<img src="'. get_template_directory_uri().'/assets/images/photo-placeholder.jpg" alt="Event" class="event-image"/>';
                            } ?>
                        </div>
                        <div class="event-content">
                            <div class="event-date">
                                <i class="bi bi-calendar2-event"></i> <?= esc_html($formatted_start_date); ?>
                            </div>
                            <h3 class="event-title"><?php the_title(); ?></h3>
                            <div class="event-meta">
                                <span class="event-location"><i class="bi bi-geo-alt"></i> <?= esc_html($location); ?></span>
                                <span class="event-time"><i class="bi bi-clock"></i> <?= esc_html($formatted_start_time); ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            
            <?php
            if ($count == 0) {
                echo '</div>'; // Close main card
            } elseif ($count == $atts['posts_per_page'] - 1) {
                echo '</div>'; // Close side cards
            }
            $count++;
        endwhile;
        
        echo '</div></div>';
    else :
        echo '<div class="kpy-no-events">No upcoming events found.</div>';
    endif;
    
    wp_reset_postdata();
    return ob_get_clean();
}

add_shortcode('upcoming_events', 'upcoming_events_shortcode');