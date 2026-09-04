<?php // Add custom fields for SEO

// Add SEO meta boxes on Pages and Posts
function add_seo_meta_boxes() {
    $post_types = array('page', 'post');

    foreach ($post_types as $post_type) {
        add_meta_box(
            'seo_meta_box',
            'SEO Settings',
            'render_seo_meta_box',
            $post_type,
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'add_seo_meta_boxes');

// Render SEO meta boxes
function render_seo_meta_box($post) {
    // Retrieve current values for fields
    $seo_title = get_post_meta($post->ID, '_seo_title', true);
    $seo_description = get_post_meta($post->ID, '_seo_description', true);
    $seo_keywords = get_post_meta($post->ID, '_seo_keywords', true);

    // Include nonce field for security
    wp_nonce_field('seo_meta_box_nonce', 'seo_meta_box_nonce');

    // Output HTML for the fields
    ?>
    <p>
        <label for="seo_title">SEO Title:</label>
        <input type="text" id="seo_title" name="seo_title" style="width: 100%;" value="<?= esc_attr($seo_title); ?>" />
    </p>
    <p>
        <label for="seo_description">SEO Description:</label>
        <textarea id="seo_description" name="seo_description" style="width: 100%;"><?= esc_textarea($seo_description); ?></textarea>
    </p>
    <p>
        <label for="seo_keywords">SEO Keywords:</label>
        <input type="text" id="seo_keywords" name="seo_keywords" style="width: 100%;" value="<?= esc_attr($seo_keywords); ?>" />
    </p>
    <?php
}

// Save custom fields for SEO
function save_seo_meta_boxes($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Save SEO fields
    if (isset($_POST['seo_title'])) {
        update_post_meta($post_id, '_seo_title', sanitize_text_field($_POST['seo_title']));
    }

    if (isset($_POST['seo_description'])) {
        update_post_meta($post_id, '_seo_description', sanitize_textarea_field($_POST['seo_description']));
    }

    if (isset($_POST['seo_keywords'])) {
        update_post_meta($post_id, '_seo_keywords', sanitize_text_field($_POST['seo_keywords']));
    }
}
add_action('save_post', 'save_seo_meta_boxes');

