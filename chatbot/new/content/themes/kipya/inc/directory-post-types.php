<?php //Custom Post :: DIRECTORY / MEMBERSHIP

function custom_post_type_directory(){
    $labels = array(
        'name'                => __('Directory', 'kipya' ),
        'add_new_item'        => __( 'Add New Member ', 'kipya' ),
        'add_new'             => __( 'Add New Member ', 'kipya' ),
        'edit_item'           => __( 'Edit Member ', 'kipya' ),
        'update_item'         => __( 'Update Member ', 'kipya' ),
        'all_items'           => __( 'Directory Members ', 'kipya' ),
        'search_items'        => __( 'Search ', 'kipya' ),
        'singular_name'       => __('Directory'),
    );
    $supports = array(
        'title',        // Post title
        'excerpt',      // Allows short description
        'editor',      // Allows full description
        'thumbnail',    // Allows feature images

    );
    $args = array(
        'labels'              => $labels,
        'description'         => 'You are using LT Business Directory', 
        'supports'            => $supports,
        'hierarchical'        => false, 
        'public'              => true,  // Makes the post type public
        'show_ui'             => true,  // Displays an interface for this post type
        'show_in_menu'        => true,  // Displays in the Admin Menu (the left panel)
        'show_in_admin_bar'   => true,  // Displays in the black admin bar
        'menu_position'       => 10,     // The position number in the left menu
        'menu_icon'           => 'dashicons-id',  
        'can_export'          => true,  // Allows content export using Tools -> Export
        'has_archive'         => true,  // Enables post type archive (by month, date, or year)
        'exclude_from_search' => false, 
        'capability_type'     => 'post', // Allows read, edit, delete like “Post”
    );
    register_post_type('directory', $args);

    // Register meta boxes individually
    add_action('add_meta_boxes_directory', 'add_custom_meta_boxes_directorys');
    add_action('add_meta_boxes_directory', 'add_custom_meta_boxes_directory_contact_person');
    add_action('add_meta_boxes_directory', 'add_custom_meta_boxes_directory_socials');

    //Adding Category
    $taxonomy_labels = array(
        'name'              => _x('Directory Categories', 'taxonomy general name'),
        'singular_name'     => _x('Directory Category', 'taxonomy singular name'),
        'search_items'      => __('Search directory Categories'),
        'all_items'         => __('All directory Categories'),
        'edit_item'         => __('Edit directory Category'),
        'update_item'       => __('Update directory Category'),
        'add_new_item'      => __('Add New directory Category'),
        'new_item_name'     => __('New directory Category Name'),
        'menu_name'         => __('Directory Categories'),
    );
    $taxonomy_args = array(
        'hierarchical'      => true, 
        'labels'            => $taxonomy_labels,
        'show_ui'           => true,
        'show_in_rest'      => true, 
        'query_var'         => true,
        'rewrite'           => array('slug' => 'directory-category'),
    );
    register_taxonomy('directory_category', 'directory', $taxonomy_args);
}
add_action('init', 'custom_post_type_directory');

//Add Custom Meta Boxes on directory - ORGANIZATION DETAILS
function add_custom_meta_boxes_directorys() {
    add_meta_box('company_details', 'ORGANIZATION DETAILS', 'render_custom_meta_box_directorys', 'directory', 'normal', 'high');
}

// Render custom meta boxes
function render_custom_meta_box_directorys($post) {
    // Get existing values
	$post_id    = $post->ID;
    $address   = get_post_meta($post->ID, '_address', true);
    $phone      = get_post_meta($post->ID, '_phone', true);
    $email      = get_post_meta($post->ID, '_email', true);
    $fax        = get_post_meta($post->ID, '_fax', true);
    $town       = get_post_meta($post->ID, '_town', true);
    $district   = get_post_meta($post->ID, '_district', true);
    $website    = get_post_meta($post->ID, '_website', true);

    // Output fields
    ?>
    <div class="row">
        <div class="col-md-6 mb-3" style="width: 50%; margin-bottom:10px;float:left;">
            <label for="address"><b>Physical Address </b></label><br/>
            <input type="text" id="address" name="address" style="width: 90%;" value="<?= esc_attr($address); ?>">
        </div>
        <div class="col-md-6 mb-3" style="width: 50%; margin-bottom:10px;float:left;">
            <label for="town" class="form-label"><b>Town / City</b></label><br/>
            <input type="text" id="town" name="town" style="width: 90%;" value="<?= esc_attr($town); ?>">
        </div>
        <div class="col-md-6 mb-3" style="width: 50%; margin-bottom:10px;float:left;">
            <label for="district" class="form-label"><b>District</b></label><br/>
            <input type="text" id="district" name="district" style="width: 90%;" value="<?= esc_attr($district); ?>">
        </div>
        <div class="col-md-6 mb-3" style="width: 50%; margin-bottom:10px;float:left;">
            <label for="link" class="form-label"><b>Website</b></label><br/>
            <input type="text" id="link" name="website" style="width: 90%" value="<?= esc_attr($website); ?>" placeholder="https://www.example.org">
        </div>
        
        <div class="col-md-12 mb-3">
            <label for="link" class="form-label"><em>Proceed down for Contact Person details</em></label>
        </div>
    </div>
    <?php
}

// Save custom meta box data
function save_custom_meta_box_directorys($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Save custom fields
    // Define an array of field names
    $fields = array('address', 'phone', 'email', 'fax', 'town', 'district', 'website');
    foreach ($fields as $field) {
        // Check if the field key is set in $_POST
        if (isset($_POST[$field])) {
            // If set, update post meta
            if ($field === 'phone') {
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

add_action('add_meta_boxes', 'add_custom_meta_boxes_directorys');
add_action('save_post', 'save_custom_meta_box_directorys');

//Add Custom Meta Boxes on directory - CONTACT PERSON DETAILS
function add_custom_meta_boxes_directory_contact_person() {
    add_meta_box('contact_person', 'CONTACT PERSON DETAILS', 'render_custom_meta_box_directory_contact_person', 'directory', 'normal', 'high');
}

// Render custom meta boxes
function render_custom_meta_box_directory_contact_person($post) {
    // Get existing values
	$post_id    = $post->ID;
    $cpname     = get_post_meta($post->ID, '_cpname', true);
    $cpphone    = get_post_meta($post->ID, '_cpphone', true);
    $cpemail    = get_post_meta($post->ID, '_cpemail', true);
    $position   = get_post_meta($post->ID, '_position', true);

    // Output fields
    ?>
    <div class="row">
        <div class="col-md-6" style="margin-bottom:10px;">
            <label for="cpname"><b>Contact Person Name </b></label><br/>
            <input type="text" id="cpname" name="cpname" style="width: 90%;" value="<?= esc_attr($cpname); ?>">
        </div><!-- Contact Person - Full Names !-->
        <div class="col-md-6 mb-3" style="margin-bottom:10px;">
            <label for="cpemail" class="form-label"><b>Contact Email</b></label><br/>
            <input type="text" id="cpemail" name="cpemail" style="width: 90%;" value="<?= esc_attr($cpemail); ?>">
        </div><!-- Contact Person - Email !-->
        <div class="col-md-6 mb-3" style="margin-bottom:10px;">
            <label for="cpphone" class="form-label"><b>Mobile Number</b></label><br/>
            <input type="text" id="cpphone" name="cpphone" style="width: 90%;" value="<?= esc_attr($cpphone); ?>">
        </div><!-- Contact Person - Mobile !-->
        <div class="col-md-6 mb-3" style="margin-bottom:10px;">
            <label for="position"><b>Position / Title</b></label><br/>
            <input type="text" id="position" name="position" style="width: 90%;" value="<?= esc_attr($position); ?>">
        </div><!-- Contact Person - Position !-->
    </div>
    <?php
}

// Save custom meta box data
function save_custom_meta_box_directory_contact_person($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Save custom fields
    // Define an array of field names
    $fields = array('cpname', 'cpphone', 'cpemail', 'position');
    foreach ($fields as $field) {
        // Check if the field key is set in $_POST
        if (isset($_POST[$field])) {
            // If set, update post meta
            if ($field === 'position') {
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

add_action('add_meta_boxes', 'add_custom_meta_boxes_directory_contact_person');
add_action('save_post', 'save_custom_meta_box_directory_contact_person');


//Add Custom Meta Boxes on directory - SOCIAL MEDIA DETAILS
function add_custom_meta_boxes_directory_socials() {
    add_meta_box('social_details', 'Social Details', 'render_custom_meta_box_directory_socials', 'directory', 'normal', 'high');
}

// Render custom meta boxes
function render_custom_meta_box_directory_socials($post) {
    // Get existing values
	$post_id        = $post->ID;
    $facebook       = get_post_meta($post->ID, '_facebook', true);
    $linkedin       = get_post_meta($post->ID, '_linkedin', true);
    $instagram      = get_post_meta($post->ID, '_instagram', true);
    $x              = get_post_meta($post->ID, '_x', true);
    $whatsapp       = get_post_meta($post->ID, '_whatsapp', true);

    // Output fields
    ?>
    <div class="row">
        <div class="col-md-6 mb-3" style="width: 50%; margin-bottom:10px;float:left;">
            <label for="facebook"><b>Facebook</b></label>
            <input type="text" id="facebook" name="facebook" style="width: 60%;" value="<?= esc_attr($facebook); ?>" placeholder="provide full link">
        </div>
        <div class="col-md-6 mb-3" style="width: 50%; margin-bottom:10px;float:left;">
            <label for="twitter"><b>X / Twitter</b></label>
            <input type="text" id="twitter" name="x" style="width: 60%;" value="<?= esc_attr($x); ?>" placeholder="provide full link">
        </div>
        <div class="col-md-6 mb-3" style="width: 50%; margin-bottom:10px;float:left;">
            <label for="insta" class="form-label"><b>Instagram</b></label>
            <input type="text" id="insta" name="instagram" style="width: 60%;" value="<?= esc_attr($instagram); ?>" placeholder="provide full link">
        </div>
        <div class="col-md-6 mb-3" style="width: 50%; margin-bottom:10px;float:left;">
            <label for="linkedin" class="form-label"><b>LinkedIn</b></label> 
            <input type="text" id="linkedin" name="linkedin" style="width: 60%;" value="<?= esc_attr($linkedin); ?>" placeholder="provide full link">
        </div>
        <div class="col-md-12 mb-3">
            <label for="whatsapp" class="form-label"><b>WhatsApp</b></label>
            <input type="text" id="whatsapp" name="whatsapp" style="width: 90%" value="<?= esc_attr($whatsapp); ?>" placeholder="E.g +256xxxxxxxxx">
        </div>
    </div>
    <?php
}

// Save custom meta box data - Social Media
function save_custom_meta_box_directory_socials($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Save custom fields - Socials
    $fields = array('facebook', 'linkedin', 'instagram', 'x', 'whatsapp');
    foreach ($fields as $field) {
        // Check if the field key is set in $_POST
        if (isset($_POST[$field])) {
            // If set, update post meta
            if ($field === 'facebook') {
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

add_action('add_meta_boxes', 'add_custom_meta_boxes_directory_socials');
add_action('save_post', 'save_custom_meta_box_directory_socials');


/** =============================================================
 * ADMIN DASHBOARD
 *==============================================================*/
// Add custom columns to the directory post type - DASHBOARD
function add_custom_columns_to_directory($columns) {
    $new_columns = array(
        'cb' => $columns['cb'],
        'title' => __('Organization Name'),
        'photo' => __('Photo'),
        'directory_category' => __('Category'),
        'email' => __('Contact Email'),
        'phone' => __('Telephone'),
        'district' => __('District'),
    );    
    return $new_columns;
}
add_filter('manage_directory_posts_columns', 'add_custom_columns_to_directory');


// Populate custom columns with data
function populate_custom_directory_columns($column, $post_id) {
    switch ($column) {
        case 'title':
            // Display the start date
            $title = get_post_meta($post_id, 'title', true);
            echo esc_html($title);
            break;
        case 'photo':
            // Display the featured image
            $photo_url = get_the_post_thumbnail_url($post_id, 'thumbnail'); // You can adjust the image size ('thumbnail', 'medium', 'large', 'full')
            if ($photo_url) {
                echo '<img src="' . esc_url($photo_url) . '" alt="Photo" style="max-height: 50px; width: auto;" />';
            } else {
                echo 'No photo available';
            }
            break;        

        case 'directory_category':
            // Display the directory category
            $terms = wp_get_post_terms($post_id, 'directory_category'); 
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

        case 'email':
                $email = get_post_meta($post_id, '_email', true);
                echo esc_html($email);
                break;
        case 'phone':
                $phone = get_post_meta($post_id, '_phone', true);
                echo esc_html($phone);
                break;
    
        case 'district':
                    $district = get_post_meta($post_id, '_district', true);
                    echo esc_html($district);
                    break;
    }
}
add_action('manage_directory_posts_custom_column', 'populate_custom_directory_columns', 10, 2);


/** =================================================================
 *  SHORTCODE - Directory
 *===================================================================*/
function directory_shortcode($atts) {
    // Define shortcode attributes
    $atts = shortcode_atts(
        array(
            'category' => 'club', // Default to empty string if not specified
            'number' => 500, // Default number of posts per page
            'order' => 'DESC', // Changed default to DESC for most recent first
        ),
        $atts,
        'directory'
    );

    // Custom query to retrieve Directory
    $directory_args = array(
        'post_type' => 'directory',
        'posts_per_page' => $atts['number'],
        'orderby' => 'date', // Changed from 'name' to 'date'
        'order' => $atts['order'],
    );

    // Check if category attribute is provided and not empty
    if (!empty($atts['category'])) {
        $directory_args['tax_query'] = array(
            array(
                'taxonomy' => 'directory_category',
                'field' => 'slug',
                'terms' => $atts['category'],
            ),
        );
    }

    $directory_query = new WP_Query($directory_args);

    // Start output buffer
    ob_start();
    
    ?>

    <div class="publications">
        <div class="table-container"><table id="downloads-table" class="table is-fullwidth expandable-table dataTable no-footer" style="width: 100%">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through the directory and output table rows
                    while ($directory_query->have_posts()) : $directory_query->the_post();
                    $post_id = get_the_ID();
                    
                    $address       = get_post_meta($post_id, '_address', true);
                    $district   = get_post_meta($post_id, '_district', true);
                    $website    = get_post_meta($post_id, '_website', true);
                    $cpname      =  get_post_meta($post_id, '_cpname', true);
                    $position      =  get_post_meta($post_id, '_position', true);
                    $cpphone      =  get_post_meta($post_id, '_cpphone', true);
                    $cpemail      =  get_post_meta($post_id, '_cpemail', true);
                    $permalink    = get_permalink($post_id); // Get the single page permalink
                    ?>
                        <tr>
                            <td width="25%">
                                <div class="member-thumbnail">
                                    <a href="<?= $permalink ?>">
                					<?php // Display the post thumbnail
                						if (has_post_thumbnail()) {
                							the_post_thumbnail(); 
                						}else{
                							echo '<img src="'. get_template_directory_uri().'/assets/images/placeholder.png" alt="NHP Platform"/>';
                						}
                					?>
                                    </a>
                				</div><!-- thumbnail !-->
                            </td>
                            <td width="75%">
                                <a href="<?= $permalink ?>"><h4 class="member-title"><?php the_title(); ?></h4></a>
                                <h5 class="pub-summ">Area of Focus</h5>
                                <div class="pub-desc"> <?php esc_html(the_content()); ?></div>
                                <div class="member-summ"><small><strong>Address/Location:</strong> <?=$address; ?>, <?= $district; ?></small></br>
                                <small><strong>Contact Person:</strong> <?= $cpname; ?> / <strong>Position:</strong> <?= $position; ?></small></br>
                                <small><strong>Telephone:</strong> <?= $cpphone; ?> / <strong>Email:</strong> <?= $cpemail; ?></small> 
                                <div class="member-link"><a href="<?= $permalink ?>">View More </a></div>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table></div>
    </div>

    <?php
    // Reset post data
    wp_reset_postdata();
    
    // Clean output buffer and return content
    return ob_get_clean();
}
add_shortcode('directory', 'directory_shortcode');

?>