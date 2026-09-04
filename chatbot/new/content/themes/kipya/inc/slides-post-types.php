<?php
// Custom Post Type :: TECH SLIDES (renamed for clarity)
function custom_post_type_tech_slides() {
    $labels = array(
        'name'                => __('Tech Slides', 'kipya'),
        'add_new_item'        => __('Add New Tech Slide', 'kipya'),
        'add_new'             => __('Add New Tech Slide', 'kipya'),
        'edit_item'           => __('Edit Tech Slide', 'kipya'),
        'update_item'         => __('Update Tech Slide', 'kipya'),
        'all_items'           => __('All Tech Slides', 'kipya'),
        'search_items'        => __('Search Tech Slides', 'kipya'),
        'singular_name'       => __('Tech Slide', 'kipya'),
    );
    $supports = array(
        'title',        // Post title
        'excerpt',      // Allows short description
        'thumbnail',    // Allows feature images
    );
    $args = array(
        'labels'              => $labels,
        'description'         => 'Post type for tech slides with moving SVGs', 
        'supports'            => $supports,
        'hierarchical'        => false, 
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-chart-area',  
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'capability_type'     => 'post'
    );
    register_post_type('tech_slides', $args);
}
add_action('init', 'custom_post_type_tech_slides');

// Add custom columns to the dashboard
function add_custom_columns_to_tech_slides($columns) {
    $new_columns = array(
        'slide_photo'       => 'Preview',
        'title'             => 'Title',
        'slide_description' => 'Description',
        'slide_media_type'  => 'Media Type',
    );

    unset($columns['date']);
    $columns = array_merge($new_columns, $columns);
    return $columns;
}
add_filter('manage_edit-tech_slides_columns', 'add_custom_columns_to_tech_slides');

function populate_custom_columns_tech_slides($column, $post_id) {
    switch ($column) {
        case 'slide_photo':
            $photo_url = get_the_post_thumbnail_url($post_id, 'thumbnail');
            if ($photo_url) {
                echo '<img src="' . esc_url($photo_url) . '" alt="Slide Photo" style="max-height: 80px; width: auto;" />';
            } else {
                echo 'No image';
            }
            break;

        case 'slide_description':
            $descr = get_the_excerpt($post_id);
            echo esc_html($descr);
            break;
            
        case 'slide_media_type':
            $media_type = get_post_meta($post_id, '_tech_media_type', true);
            echo ucfirst($media_type ?: 'image');
            break;
    }
}
add_action('manage_tech_slides_posts_custom_column', 'populate_custom_columns_tech_slides', 10, 2);

// Add meta boxes for video upload
function add_tech_slides_meta_boxes() {
    add_meta_box(
        'tech_media',
        'Video Media (Right Side)',
        'render_tech_media_meta_box',
        'tech_slides',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_tech_slides_meta_boxes');

// Render media meta box
function render_tech_media_meta_box($post) {
    wp_nonce_field('tech_media_meta_box', 'tech_media_meta_box_nonce');
    
    $media_type = get_post_meta($post->ID, '_tech_media_type', true);
    $video_url = get_post_meta($post->ID, '_tech_video_url', true);
    $video_mp4 = get_post_meta($post->ID, '_tech_video_mp4', true);
    
    // Default to image if not set
    if (empty($media_type)) {
        $media_type = 'image';
    }
    ?>
    <div class="tech-media-options">
        <p>
            <label style="margin-right: 20px;">
                <input type="radio" name="tech_media_type" value="image" <?php checked($media_type, 'image'); ?>>
                Use Featured Image
            </label>
            <label style="margin-right: 20px;">
                <input type="radio" name="tech_media_type" value="youtube" <?php checked($media_type, 'youtube'); ?>>
                YouTube Video (Loop)
            </label>
            <label style="margin-right: 20px;">
                <input type="radio" name="tech_media_type" value="mp4" <?php checked($media_type, 'mp4'); ?>>
                Self-Hosted MP4 (Loop)
            </label>
        </p>
        
        <div class="tech-video-fields" style="background: #f5f5f5; padding: 15px; margin-top: 15px; border-radius: 4px;">
            <div class="tech-youtube-field" style="<?php echo ($media_type !== 'youtube') ? 'display:none;' : ''; ?>">
                <p>
                    <label for="tech_video_url">YouTube Video URL:</label>
                    <input type="url" id="tech_video_url" name="tech_video_url" value="<?php echo esc_url($video_url); ?>" class="widefat" placeholder="https://www.youtube.com/watch?v=...">
                    <small>Video will loop seamlessly with no controls</small>
                </p>
            </div>
            
            <div class="tech-mp4-field" style="<?php echo ($media_type !== 'mp4') ? 'display:none;' : ''; ?>">
                <p>
                    <label for="tech_video_mp4">MP4 File URL:</label>
                    <input type="url" id="tech_video_mp4" name="tech_video_mp4" value="<?php echo esc_url($video_mp4); ?>" class="widefat" placeholder="https://example.com/video.mp4">
                </p>
                <p>
                    <button type="button" class="button upload-mp4-button">Upload MP4</button>
                </p>
            </div>
        </div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        $('input[name="tech_media_type"]').on('change', function() {
            var selected = $(this).val();
            $('.tech-video-fields > div').hide();
            $('.tech-' + selected + '-field').show();
        });
        
        $('.upload-mp4-button').on('click', function(e) {
            e.preventDefault();
            var frame = wp.media({
                title: 'Select MP4 Video',
                library: {
                    type: 'video/mp4'
                },
                multiple: false
            });
            
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#tech_video_mp4').val(attachment.url);
            });
            
            frame.open();
        });
    });
    </script>
    <?php
}

// Save meta box data
function save_tech_slides_meta_boxes($post_id) {
    if (!isset($_POST['tech_media_meta_box_nonce']) || !wp_verify_nonce($_POST['tech_media_meta_box_nonce'], 'tech_media_meta_box')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['tech_media_type'])) {
        update_post_meta($post_id, '_tech_media_type', sanitize_text_field($_POST['tech_media_type']));
    }
    
    if (isset($_POST['tech_video_url'])) {
        update_post_meta($post_id, '_tech_video_url', esc_url_raw($_POST['tech_video_url']));
    }
    
    if (isset($_POST['tech_video_mp4'])) {
        update_post_meta($post_id, '_tech_video_mp4', esc_url_raw($_POST['tech_video_mp4']));
    }
}
add_action('save_post_tech_slides', 'save_tech_slides_meta_boxes');