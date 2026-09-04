<?php
/**
 * Donation Custom Post Type and Functionality
 */

// Register Donation Post Type
function register_donation_post_type() {
    $args = array(
        'labels' => array(
            'name' => 'Donations',
            'singular_name' => 'Donation'
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-money-alt',
        'capability_type' => 'post',
        'capabilities' => array(
            'create_posts' => false,
            'edit_posts' => 'edit_others_posts',
            'delete_posts' => 'delete_others_posts',
        ),
        'map_meta_cap' => true,
        'supports' => array('title', 'editor'),
    );
    register_post_type('donation', $args);
}
add_action('init', 'register_donation_post_type');

// Custom Columns for Donations List
function donation_custom_columns($columns) {
    unset($columns['date']);
    $columns['amount'] = 'Amount';
    $columns['method'] = 'Payment Method';
    $columns['project'] = 'Project';
    $columns['date'] = 'Date';
    return $columns;
}
add_filter('manage_donation_posts_columns', 'donation_custom_columns');

function donation_custom_column_data($column, $post_id) {
    $content = get_post_field('post_content', $post_id);
    $lines = explode("\n", $content);
    $data = array();
    foreach ($lines as $line) {
        $parts = explode(':', $line, 2);
        if (count($parts) == 2) {
            $data[strtolower(trim($parts[0]))] = trim($parts[1]);
        }
    }

    switch ($column) {
        case 'amount':
            echo isset($data['amount']) ? esc_html($data['amount']) : '—';
            break;
        case 'method':
            echo isset($data['method']) ? esc_html($data['method']) : '—';
            break;
        case 'project':
            echo isset($data['project']) ? esc_html($data['project']) : 'General';
            break;
    }
}
add_action('manage_donation_posts_custom_column', 'donation_custom_column_data', 10, 2);

function donation_sortable_columns($columns) {
    $columns['amount'] = 'amount';
    $columns['method'] = 'method';
    $columns['project'] = 'project';
    return $columns;
}
add_filter('manage_edit-donation_sortable_columns', 'donation_sortable_columns');

// Admin CSS
function donation_admin_css() {
    global $post_type;
    if ($post_type == 'donation') {
        ?>
        <style>
            .donation-details {
                background: white;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                margin-top: 20px;
            }
            .donation-detail {
                margin-bottom: 15px;
                padding-bottom: 15px;
                border-bottom: 1px solid #eee;
            }
            .donation-detail:last-child {
                border-bottom: none;
                margin-bottom: 0;
                padding-bottom: 0;
            }
            .detail-label {
                font-weight: 600;
                color: #2271b1;
                display: block;
                margin-bottom: 5px;
            }
            .detail-value {
                color: #333;
            }
            .receipt-link {
                display: inline-block;
                margin-top: 10px;
                padding: 5px 10px;
                background: #f0f0f1;
                border-radius: 3px;
                text-decoration: none;
            }
            .receipt-link:hover {
                background: #e0e0e0;
            }
            .back-to-donations {
                margin-bottom: 15px;
                display: inline-block;
                background: #2271b1;
                color: #fff;
                padding: 8px 12px;
                border-radius: 3px;
                text-decoration: none;
            }
            .back-to-donations:hover {
                background: #1d5e99;
            }
        </style>
        <?php
    }
}
add_action('admin_head', 'donation_admin_css');

// Hide title, editor, and submit box
function make_donation_post_read_only() {
    global $post;
    if (!$post || $post->post_type !== 'donation') return;

    // Hide title input
    echo '<style>#titlediv, #postdivrich, .edit-post-status, .misc-pub-section, .edit-slug-box { display: none !important; }</style>';

    // Remove editor support
    remove_post_type_support('donation', 'editor');
}
add_action('admin_head-post.php', 'make_donation_post_read_only');

// Remove publish/update/delete box
function hide_donation_publish_box() {
    global $post;
    if ($post->post_type === 'donation') {
        remove_meta_box('submitdiv', 'donation', 'side');
    }
}
add_action('add_meta_boxes', 'hide_donation_publish_box');

// Display formatted content after title
function display_donation_read_only_content($post) {
    if ($post->post_type !== 'donation') return;

    $content = $post->post_content;
    $lines = explode("\n", $content);

    echo '<a href="' . admin_url('edit.php?post_type=donation') . '" class="back-to-donations">← Back to Donations</a>';
    echo '<div class="donation-details">';

    foreach ($lines as $line) {
        if (empty(trim($line))) continue;

        $parts = explode(':', $line, 2);
        if (count($parts) == 2) {
            $label = trim($parts[0]);
            $value = trim($parts[1]);

            echo '<div class="donation-detail">';
            echo '<span class="detail-label">' . esc_html($label) . '</span>';
            if (strtolower($label) === 'receipt' && !empty($value)) {
                echo '<div class="detail-value"><a href="' . esc_url($value) . '" class="receipt-link" target="_blank">View Receipt</a></div>';
            } else {
                echo '<div class="detail-value">' . esc_html($value) . '</div>';
            }
            echo '</div>';
        }
    }

    echo '</div>';
}
add_action('edit_form_after_title', 'display_donation_read_only_content');
