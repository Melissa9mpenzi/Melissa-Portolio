<?php //Custom Post Type :: DOWNLOADS

// Register custom taxonomy for file categories
function custom_post_type_downloads() {
    $labels = array(
        'name'                => __('Downloads', 'kipya' ),
        'add_new_item'        => __( 'New Download', 'kipya' ),
        'add_new'             => __( 'New Download', 'kipya' ),
        'edit_item'           => __( 'Edit Download', 'kipya' ),
        'update_item'         => __( 'Update Download', 'kipya' ),
        'all_items'           => __( 'All Downloads', 'kipya' ),
        'search_items'        => __( 'Search', 'kipya' ),
        'singular_name'       => __('Download'),
        'not_found'           => __( 'No downloads found.', 'kipya' ),
        'not_found_in_trash'  => __( 'No downloads found in Trash.', 'kipya' )
    );

    $supports = array(
        'title',
        'editor',
        'thumbnail',
    );

    $args = array(
        'labels'              => $labels,
        'description'         => 'For all Downloads and Publications',
        'supports'            => $supports,
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 7,
        'menu_icon'           => 'dashicons-download',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'capability_type'     => 'post',
        //'register_meta_box_cb' => 'add_custom_meta_boxes_downloads',
    );
    register_post_type('downloads', $args);  
    register_file_taxonomy(); // Register custom taxonomy for files
}

function register_file_taxonomy() {
    $args = array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'              => _x( 'File Categories', 'taxonomy general name' ),
            'singular_name'     => _x( 'File Category', 'taxonomy singular name' ),
            // ... (other labels)
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'file-category' ),
    );

    register_taxonomy( 'file_category', array( 'downloads' ), $args );
}
add_action('init', 'custom_post_type_downloads');

// Add custom meta boxes on Downloads
function add_custom_meta_boxes_downloads() {
    add_meta_box(
        'file_info_meta_box',
        'File Information',
        'render_file_info_meta_box',
        'downloads',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes_downloads', 'add_custom_meta_boxes_downloads');

// Render custom meta boxes on Downloads
function render_file_info_meta_box($post) {
    // Retrieve current values for fields
    $file_upload = get_post_meta($post->ID, '_file_upload', true);
    $file_url = get_post_meta($post->ID, '_file_url', true);
    $external_file = get_post_meta($post->ID, '_external_file', true);
    $download_count = get_post_meta($post->ID, '_download_count', true);

    // Get the file size
    $file_size = '';
    if ($file_url) {
        $headers = get_headers($file_url, 1);
        $file_size = isset($headers['Content-Length']) ? size_format($headers['Content-Length']) : '';
    }

    // Include nonce field for security
    wp_nonce_field('custom_file_info_nonce', 'file_info_nonce');
    
     // Increment download count on file download
    increment_download_count($post->ID);

    // Output HTML for the fields
    ?>
    <p>
        <label for="file_upload">File Upload:</label><br/>
        <input type="text" id="file_upload" name="file_upload" style="width: 80%;" value="<?= esc_attr($file_upload); ?>" />
        <button type="button" id="upload_button" class="button">Upload</button>
        <input type="hidden" id="file_url" name="file_url" style="width: 100%;" value="<?= esc_attr($file_url); ?>" />
    </p>
    <p>
        <a href="<?= esc_attr($file_url); ?>">  <?= the_title();?> </a> 
         <?= ' ('.esc_html($file_size).')'; ?>
    </p>
    <p>
        <label for="download_count">Download Count:</label><br/>
        <input type="text" id="download_count" name="download_count" style="width: 80%;" value="<?= esc_attr($download_count); ?>" readonly />
    </p>
    <p>
    <label for="external_file">External File URL:</label>
    <input type="text" id="external_file" name="external_file" style="width: 100%;" value="<?= esc_attr($external_file); ?>" />
    </p>
    
    <script>
        jQuery(document).ready(function($){
            var fileFrame;

            $('#upload_button').on('click', function(event) {
                event.preventDefault();

                if (fileFrame) {
                    fileFrame.open();
                    return;
                }

                fileFrame = wp.media.frames.fileFrame = wp.media({
                    title: 'Choose File',
                    button: {
                        text: 'Choose File'
                    },
                    multiple: false
                });

                fileFrame.on('select', function() {
                    var attachment = fileFrame.state().get('selection').first().toJSON();
                    $('#file_upload').val(attachment.url);
                    $('#file_url').val(attachment.url); // Also update file_url
                });

                fileFrame.open();
            });

            // Increment download count when download link is clicked
            $('a[href="<?= esc_attr($file_url); ?>"]').on('click', function() {
                increment_download_count(<?= $post->ID; ?>);
            });
        });
    </script>
    <?php
}

// Increment download count on file download
function increment_download_count($post_id) {
    $download_count = get_post_meta($post_id, '_download_count', true);
    $download_count = empty($download_count) ? 1 : intval($download_count) + 1;
    update_post_meta($post_id, '_download_count', $download_count);
}

// Save custom fields for Downloads
function save_custom_meta_boxes_downloads($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Save file URL
    if (isset($_POST['file_url'])) {
        update_post_meta($post_id, '_file_url', esc_url_raw($_POST['file_url']));
    }

    // Save external file URL
    if (isset($_POST['external_file'])) {
        update_post_meta($post_id, '_external_file', esc_url_raw($_POST['external_file']));
    }
    
    // Save download count
    if (isset($_POST['download_count'])) {
        update_post_meta($post_id, '_download_count', intval($_POST['download_count']));
    }
}
add_action('save_post_downloads', 'save_custom_meta_boxes_downloads');

// Add custom columns to Downloads - DASHBOARD
function add_custom_columns_to_downloads($columns) {
    $new_columns = array(
        'cb' => $columns['cb'],
        'photo' => __('Photo'),
        'title' => __('Title'),
        'file_size' => __('File Size'),
        'download_count' => __('Download Count'),
        'file_categories' => __('File Categories'),
        'date' => __('Date Published'),
    );
    return $new_columns;
}
add_filter('manage_downloads_posts_columns', 'add_custom_columns_to_downloads');

// Populate custom columns in Downloads dashboard
function populate_custom_columns_in_downloads($column, $post_id) {
    switch ($column) {
        case 'photo':
            $photo_url = get_the_post_thumbnail_url($post_id, 'thumbnail');
            if ($photo_url) {
                echo '<img src="' . esc_url($photo_url) . '" alt="Event Photo" style="max-width: 40px; height: 40px;" />';
            } else {
                echo 'No photo available';
            }
            break;
        case 'file_size':
            $file_url = get_post_meta($post_id, '_file_url', true);
            $file_size = '';
            if ($file_url) {
                $headers = get_headers($file_url, 1);
                $file_size = isset($headers['Content-Length']) ? size_format($headers['Content-Length']) : '';
            }
            echo esc_html($file_size);
            break;
        case 'download_count':
            $download_count = get_post_meta(get_the_ID(), '_download_count', true);
            echo esc_html($download_count);
            break;
        case 'file_categories':
            $file_categories = get_the_terms($post_id, 'file_category');
            if ($file_categories && !is_wp_error($file_categories)) {
                $categories = array();
                foreach ($file_categories as $category) {
                    $categories[] = $category->name;
                }
                echo esc_html(implode(', ', $categories));
            } else {
                echo 'No categories';
            }
            break;
    }
}
add_action('manage_downloads_posts_custom_column', 'populate_custom_columns_in_downloads', 10, 2);





/***=============================================================
 * SAVE Download Counts
*===============================================================*/
// Update download count via AJAX
add_action('wp_ajax_update_download_count', 'update_download_count_callback');
add_action('wp_ajax_nopriv_update_download_count', 'update_download_count_callback');
function update_download_count_callback() {
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    if ($post_id > 0) {
        $download_count = get_post_meta($post_id, '_download_count', true);
        $download_count = empty($download_count) ? 1 : intval($download_count) + 1;
        update_post_meta($post_id, '_download_count', $download_count);
        echo 'success';
    } else {
        echo 'error';
    }
    wp_die();
}



