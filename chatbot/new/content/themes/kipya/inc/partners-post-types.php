<?php //Custom Post :: Partners

function custom_post_type_partner(){
    $labels = array(
        'name'                => __('Partners', 'kipya' ),
        'add_new_item'        => __( 'Add New Partner', 'kipya' ),
        'add_new'             => __( 'Add New Partner', 'kipya' ),
        'edit_item'           => __( 'Edit Partner', 'kipya' ),
        'update_item'         => __( 'Update Partner', 'kipya' ),
        'all_items'           => __( 'Partners', 'kipya' ),
        'search_items'        => __( 'Search ', 'kipya' ),
        'singular_name'       => __('Partner'),
    );
    $supports = array(
        'title',        // Post title
        'excerpt',      // Allows short description
        'editor',      // Allows full description
        'thumbnail',    // Allows feature images

    );
    $args = array(
        'labels'              => $labels,
        'description'         => 'For all Partners', 
        'supports'            => $supports,
        'hierarchical'        => false, 
        'public'              => true,  // Makes the post type public
        'show_ui'             => true,  // Displays an interface for this post type
        'show_in_menu'        => true,  // Displays in the Admin Menu (the left panel)
        'show_in_admin_bar'   => true,  // Displays in the black admin bar
        'menu_position'       => 10,     // The position number in the left menu
        'menu_icon'           => 'dashicons-filter',  
        'can_export'          => true,  // Allows content export using Tools -> Export
        'has_archive'         => true,  // Enables post type archive (by month, date, or year)
        'exclude_from_search' => false, 
        'capability_type'     => 'post', // Allows read, edit, delete like “Post”
    );
    register_post_type('partner', $args);

    // Register meta boxes individually
    add_action('add_meta_boxes_partner', 'add_custom_meta_boxes_partners');

    //Adding Category
    $taxonomy_labels = array(
        'name'              => _x('Partner Categories', 'taxonomy general name'),
        'singular_name'     => _x('Partner Category', 'taxonomy singular name'),
        'search_items'      => __('Search Partner Categories'),
        'all_items'         => __('All Partner Categories'),
        'edit_item'         => __('Edit Partner Category'),
        'update_item'       => __('Update Partner Category'),
        'add_new_item'      => __('Add New Partner Category'),
        'new_item_name'     => __('New Partner Category Name'),
        'menu_name'         => __('Partner Categories'),
    );
    $taxonomy_args = array(
        'hierarchical'      => true, 
        'labels'            => $taxonomy_labels,
        'show_ui'           => true,
        'show_in_rest'      => true, 
        'query_var'         => true,
        'rewrite'           => array('slug' => 'partner-category'),
    );
    register_taxonomy('partner_category', 'partner', $taxonomy_args);
}
add_action('init', 'custom_post_type_partner');

//Add Custom Meta Boxes on partner
function add_custom_meta_boxes_partners() {
    add_meta_box('partners_details', 'Partner Details', 'render_custom_meta_box_partners', 'partner', 'normal', 'high');
}

// Render custom meta boxes
function render_custom_meta_box_partners($post) {
    // Get existing values
	$post_id    = $post->ID;
    $project   = get_post_meta($post->ID, '_project', true);
    $website    = get_post_meta($post->ID, '_website', true);

    // Output fields
    ?>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="project"><b>Project Name (Optional)</b></label><br/>
            <input type="text" id="project" name="project" style="width: 100%;" value="<?= esc_attr($project); ?>">
        </div>
        <div class="col-md-12 mb-3">
            <label for="link" class="form-label"><b>Partner Website</b></label><br/>
            <input type="text" id="link" name="website" style="width: 100%" value="<?= esc_attr($website); ?>" placeholder="https://www.example.com">
        </div>
    </div>
    <?php
}

// Save custom meta box data
function save_custom_meta_box_partners($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Save custom fields
    // Define an array of field names
    $fields = array('project',  'website');
    foreach ($fields as $field) {
        // Check if the field key is set in $_POST
        if (isset($_POST[$field])) {
            // If set, update post meta
            if ($field === 'project') {
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

add_action('add_meta_boxes', 'add_custom_meta_boxes_partners');
add_action('save_post', 'save_custom_meta_box_partners');




/** =============================================================
 * ADMIN DASHBOARD
 *==============================================================*/
// Add custom columns to the partner post type - DASHBOARD
function add_custom_columns_to_partner($columns) {
    $new_columns = array(
        'cb' => $columns['cb'],
        'photo' => __('Photo'),
        'title' => __('Name'),
        'project' => __('Project'),
        'partner_category' => __('Category'),
    );    
    return $new_columns;
}
add_filter('manage_partner_posts_columns', 'add_custom_columns_to_partner');


// Populate custom columns with data
function populate_custom_partner_columns($column, $post_id) {
    switch ($column) {
        case 'photo':
            // Display the featured image
            $photo_url = get_the_post_thumbnail_url($post_id, 'thumbnail'); // You can adjust the image size ('thumbnail', 'medium', 'large', 'full')
            if ($photo_url) {
                echo '<img src="' . esc_url($photo_url) . '" alt="Photo" style="max-height: 50px; width: auto;" />';
            } else {
                echo 'No photo available';
            }
            break;        

        case 'title':
            // Display the start date
            $title = get_post_meta($post_id, 'title', true);
            echo esc_html($title);
            break;

        case 'project':
            // Display the end date
            $position = get_post_meta($post_id, '_project', true);
            echo esc_html($position);
            break;

        case 'partner_category':
            // Display the partner category
            $terms = wp_get_post_terms($post_id, 'partner_category'); 
            if (!empty($terms) && !is_wp_error($terms)) {
                $categories = array();
                foreach ($terms as $term) {
                    $categories[] = $term->name;
                }
                echo esc_html(implode(', ', $categories));
            } else {
                echo 'No category';
            }
            break;
    }
}
add_action('manage_partner_posts_custom_column', 'populate_custom_partner_columns', 10, 2);


/** =================================================================
 *  SHORTCODE - Partners - Home PAGE
 *===================================================================*/
function partner_shortcode($atts) {

    $atts = shortcode_atts(
        array(
            'category' => 'partners', // Default to empty string if not specified
            'number' => 14, // Default number of posts per page
            'order' => 'RAND', //Default Descending order
        ),
        $atts,
        'partner'
    );

    // Custom query to retrieve Partners
    $partners_args = array(
        'post_type' => 'partner',
        'posts_per_page' => $atts['number'], // Number of posts per page
        'orderby' => 'date', // Order by date
        'order' => $atts['order'], // order
    );

    // Check if category attribute is provided and not empty
    if (!empty($atts['category'])) {
        $partners_args['tax_query'] = array(
            array(
                'taxonomy' => 'partner_category',
                'field' => 'slug',
                'terms' => $atts['category'],
            ),
        );
    }

    $partners_query = new WP_Query($partners_args);

    ob_start();

    // Check if there are upcoming events
    if ($partners_query->have_posts()) :?>
        <div class="columns">
        <div class="column is-12" data-aos="fade-up">
        
        <div class="partner">
        <?php
        while ($partners_query->have_posts()) : $partners_query->the_post();
            $post_id = get_the_ID();

            $position       = get_post_meta(get_the_ID(), '_position', true);
            $website        = get_post_meta(get_the_ID(), '_website', true);
            ?>
            <a href="<?= $website; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" target="_blank">
            <div class="card mb-3">
				<?php // Display the post thumbnail
					if (has_post_thumbnail()) {
						the_post_thumbnail(); 
					}else{
						echo '<img src="'. get_template_directory_uri().'/assets/images/placeholder-image.jpg" alt="URRENO"/>';
					}
				?>
            </div><!-- card !-->
            </a>
                
            

            <?php
        endwhile;
        wp_reset_postdata();
        ?>
        </div>
    <?php else : ?>
        No Partners/Associates found
    </div><!-- col !--> 
    </div><!-- row!-->
    <?php endif; 

    return ob_get_clean(); 
} 

add_shortcode('funders', 'partner_shortcode');


