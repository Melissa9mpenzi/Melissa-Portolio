<?php
// Handle IWCA partnership form submission
add_action('admin_post_iwca_partnership_submission', 'handle_iwca_partnership_submission');
add_action('admin_post_nopriv_iwca_partnership_submission', 'handle_iwca_partnership_submission');

function handle_iwca_partnership_submission() {
    // Verify nonce
    if (!isset($_POST['iwca_partnership_nonce']) || !wp_verify_nonce($_POST['iwca_partnership_nonce'], 'iwca_partnership_submit')) {
        if (wp_doing_ajax()) {
            wp_send_json_error(['message' => 'Security check failed']);
        } else {
            wp_die('Security check failed.');
        }
    }

    // Sanitize and validate form data
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $mobile = sanitize_text_field($_POST['mobile']);
    $description = sanitize_text_field($_POST['description']);
    $other_description = isset($_POST['other_description']) ? sanitize_text_field($_POST['other_description']) : '';
    $organization = sanitize_text_field($_POST['organization']);
    $country = sanitize_text_field($_POST['country']);
    $district = sanitize_text_field($_POST['district']);
    $issues = isset($_POST['issues']) ? array_map('sanitize_text_field', $_POST['issues']) : [];
    $other_issues = isset($_POST['other_issues']) ? sanitize_text_field($_POST['other_issues']) : '';
    $additional_info = sanitize_textarea_field($_POST['additional_info']);
    $contact_method = sanitize_text_field($_POST['contact_method']);
    $terms_agreement = isset($_POST['terms_agreement']) ? 'Yes' : 'No';

    // Combine description with other_description if applicable
    $final_description = $description;
    if ($description === 'other' && !empty($other_description)) {
        $final_description .= ': ' . $other_description;
    }

    // Combine issues with other_issues if applicable
    $issues_list = $issues;
    if (in_array('Other causes', $issues) && !empty($other_issues)) {
        $issues_list[] = 'Other: ' . $other_issues;
    }

    // Create post for storage in dashboard
    $post_data = array(
        'post_title' => $organization . ' - ' . $first_name . ' ' . $last_name,
        'post_type' => 'iwca_partnership',
        'post_status' => 'publish',
        'meta_input' => array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'full_name' => $first_name . ' ' . $last_name,
            'email' => $email,
            'mobile' => $mobile,
            'description' => $final_description,
            'organization' => $organization,
            'country' => $country,
            'district' => $district,
            'issues' => $issues_list,
            'additional_info' => $additional_info,
            'contact_method' => $contact_method,
            'terms_agreement' => $terms_agreement,
            'submission_date' => current_time('mysql'),
            'status' => 'New',
        )
    );

    // Insert the post
    $post_id = wp_insert_post($post_data);

    if (is_wp_error($post_id)) {
        if (wp_doing_ajax()) {
            wp_send_json_error(['message' => 'Failed to save application']);
        } else {
            wp_die('Failed to save application');
        }
    }

    // Send email notification to admin
    $to = get_option('admin_email');
    $subject = 'New IWCA Uganda Partnership Application: ' . $organization;
    $message = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .header { background: #5c3224; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .section { margin-bottom: 20px; border: 1px solid #ddd; padding: 15px; border-radius: 5px; }
            .section-title { color: #5c3224; font-weight: bold; margin-bottom: 10px; }
            table { width: 100%; border-collapse: collapse; }
            td { padding: 8px; border-bottom: 1px solid #ddd; }
            .label { font-weight: bold; color: #5c3224; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>New IWCA Uganda Partnership Application</h2>
        </div>
        <div class='content'>
            <div class='section'>
                <div class='section-title'>Application Details</div>
                <table>
                    <tr><td class='label'>Application ID:</td><td>IWCA-" . $post_id . "</td></tr>
                    <tr><td class='label'>Submission Date:</td><td>" . date('F j, Y, g:i a') . "</td></tr>
                    <tr><td class='label'>Status:</td><td>New</td></tr>
                </table>
            </div>
            
            <div class='section'>
                <div class='section-title'>Applicant Information</div>
                <table>
                    <tr><td class='label'>Full Name:</td><td>" . $first_name . " " . $last_name . "</td></tr>
                    <tr><td class='label'>Email:</td><td>" . $email . "</td></tr>
                    <tr><td class='label'>Mobile:</td><td>" . $mobile . "</td></tr>
                    <tr><td class='label'>Description:</td><td>" . $final_description . "</td></tr>
                </table>
            </div>
            
            <div class='section'>
                <div class='section-title'>Organization Information</div>
                <table>
                    <tr><td class='label'>Organization:</td><td>" . $organization . "</td></tr>
                    <tr><td class='label'>Country:</td><td>" . $country . "</td></tr>
                    <tr><td class='label'>District/State:</td><td>" . $district . "</td></tr>
                    <tr><td class='label'>Preferred Contact:</td><td>" . $contact_method . "</td></tr>
                </table>
            </div>
            
            <div class='section'>
                <div class='section-title'>Areas of Interest</div>
                <table>
                    <tr><td colspan='2'>" . implode('<br>', $issues_list) . "</td></tr>
                </table>
            </div>
            
            <div class='section'>
                <div class='section-title'>Additional Information</div>
                <p>" . nl2br($additional_info) . "</p>
            </div>
            
            <div class='section'>
                <div class='section-title'>Admin Actions</div>
                <p><a href='" . admin_url('post.php?post=' . $post_id . '&action=edit') . "'>View/Edit Application in Dashboard</a></p>
            </div>
        </div>
    </body>
    </html>
    ";

    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($to, $subject, $message, $headers);

    // Send confirmation email to applicant
    $confirmation_subject = 'Thank you for your IWCA Uganda Partnership Application';
    $confirmation_message = "
    Dear " . $first_name . ",

    Thank you for your interest in partnering with IWCA Uganda Chapter.

    We have received your application and our team will review it shortly. 
    We appreciate your commitment to empowering women in Uganda's coffee industry.

    Application Details:
    - Application ID: IWCA-" . $post_id . "
    - Organization: " . $organization . "
    - Submission Date: " . date('F j, Y') . "

    You can expect to hear from us within 5-7 business days.

    Best regards,
    IWCA Uganda Chapter Team
    ";

    wp_mail($email, $confirmation_subject, $confirmation_message);

    // Return success response for AJAX
    if (wp_doing_ajax()) {
        wp_send_json_success(['message' => 'Application submitted successfully']);
    } else {
        // For non-AJAX submissions, redirect to same page with success parameter
        wp_redirect(add_query_arg('submitted', 'success', wp_get_referer()));
        exit;
    }
}

// Register AJAX action for form submission
add_action('wp_ajax_iwca_partnership_submission', 'handle_iwca_partnership_submission');
add_action('wp_ajax_nopriv_iwca_partnership_submission', 'handle_iwca_partnership_submission');

// Check if form was submitted and add success message
add_action('wp_footer', 'iwca_partnership_success_message');
function iwca_partnership_success_message() {
    // Only show on the partnership page
    if (!is_page_template('iwca-partnership-template.php')) {
        return;
    }
    
    if (isset($_GET['submitted']) && $_GET['submitted'] === 'success') {
        ?>
        <script>
        jQuery(document).ready(function($) {
            // Show success modal for non-AJAX submissions
            function showSuccessModal() {
                $('#successModal').addClass('active');
                $('html, body').css({
                    'overflow': 'hidden',
                    'height': '100%'
                });
            }
            showSuccessModal();
        });
        </script>
        <?php
    }
}

// Register custom post type for partnership applications
add_action('init', 'register_iwca_partnership_post_type');
function register_iwca_partnership_post_type() {
    $labels = array(
        'name' => __('Partnership Applications'),
        'singular_name' => __('Partnership Application'),
        'menu_name' => __('IWCA Applications'),
        'name_admin_bar' => __('Partnership Application'),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Application'),
        'new_item' => __('New Application'),
        'edit_item' => __('Edit Application'),
        'view_item' => __('View Application'),
        'all_items' => __('All Applications'),
        'search_items' => __('Search Applications'),
        'not_found' => __('No applications found.'),
        'not_found_in_trash' => __('No applications found in Trash.')
    );

    $args = array(
        'labels' => $labels,
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => false,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-businessperson',
        'supports' => array('title'),
        'show_in_rest' => true,
    );

    register_post_type('iwca_partnership', $args);
}

// Add custom columns to partnership applications list
add_filter('manage_iwca_partnership_posts_columns', 'set_custom_iwca_partnership_columns');
function set_custom_iwca_partnership_columns($columns) {
    unset($columns['date']);
    $columns['application_id'] = __('Application ID');
    $columns['full_name'] = __('Full Name');
    $columns['organization'] = __('Organization');
    $columns['email'] = __('Email');
    $columns['country'] = __('Country');
    $columns['submission_date'] = __('Submission Date');
    return $columns;
}

// Populate custom columns
add_action('manage_iwca_partnership_posts_custom_column', 'custom_iwca_partnership_column', 10, 2);
function custom_iwca_partnership_column($column, $post_id) {
    switch ($column) {
        case 'application_id':
            echo 'IWCA-' . $post_id;
            break;
        case 'full_name':
            echo get_post_meta($post_id, 'full_name', true);
            break;
        case 'organization':
            echo get_post_meta($post_id, 'organization', true);
            break;
        case 'email':
            echo '<a href="mailto:' . get_post_meta($post_id, 'email', true) . '">' . get_post_meta($post_id, 'email', true) . '</a>';
            break;
        case 'country':
            echo get_post_meta($post_id, 'country', true);
            break;
        case 'issues':
            $issues = get_post_meta($post_id, 'issues', true);
            if (is_array($issues)) {
                echo implode(', ', array_slice($issues, 0, 3));
                if (count($issues) > 3) {
                    echo '...';
                }
            }
            break;
        case 'status':
            $status = get_post_meta($post_id, 'status', true) ?: 'New';
            echo '<span class="status-badge status-' . strtolower($status) . '">' . $status . '</span>';
            break;
        case 'submission_date':
            echo get_post_meta($post_id, 'submission_date', true);
            break;
    }
}

// Make columns sortable
add_filter('manage_edit-iwca_partnership_sortable_columns', 'iwca_partnership_sortable_columns');
function iwca_partnership_sortable_columns($columns) {
    $columns['organization'] = 'organization';
    $columns['submission_date'] = 'submission_date';
    $columns['status'] = 'status';
    return $columns;
}

// Add status dropdown filter
add_action('restrict_manage_posts', 'iwca_partnership_status_filter');
function iwca_partnership_status_filter($post_type) {
    if ('iwca_partnership' !== $post_type) {
        return;
    }
    
    $statuses = array('New', 'Reviewed', 'Contacted', 'Approved', 'Rejected');
    $current_status = isset($_GET['iwca_status']) ? $_GET['iwca_status'] : '';
    
    echo '<select name="iwca_status">';
    echo '<option value="">All Statuses</option>';
    foreach ($statuses as $status) {
        printf(
            '<option value="%s"%s>%s</option>',
            $status,
            $status == $current_status ? ' selected="selected"' : '',
            $status
        );
    }
    echo '</select>';
}

// Filter posts by status
add_filter('parse_query', 'iwca_partnership_status_query');
function iwca_partnership_status_query($query) {
    global $pagenow;
    
    if ('edit.php' != $pagenow || !isset($_GET['post_type']) || 'iwca_partnership' != $_GET['post_type'] || !isset($_GET['iwca_status'])) {
        return;
    }
    
    $status = $_GET['iwca_status'];
    if ($status) {
        $meta_query = array(
            array(
                'key' => 'status',
                'value' => $status,
                'compare' => '='
            )
        );
        $query->set('meta_query', $meta_query);
    }
}

// Add custom admin CSS
add_action('admin_head', 'iwca_partnership_admin_styles');
function iwca_partnership_admin_styles() {
    echo '<style>
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-new {
            background: #f0f0f0;
            color: #333;
        }
        .status-reviewed {
            background: #e3f2fd;
            color: #1976d2;
        }
        .status-contacted {
            background: #fff3e0;
            color: #f57c00;
        }
        .status-approved {
            background: #e8f5e9;
            color: #388e3c;
        }
        .status-rejected {
            background: #ffebee;
            color: #d32f2f;
        }
        .wp-list-table .column-application_id { width: 100px; }
        .wp-list-table .column-full_name { width: 150px; }
        .wp-list-table .column-organization { width: 180px; }
        .wp-list-table .column-email { width: 200px; }
        .wp-list-table .column-country { width: 100px; }
        .wp-list-table .column-status { width: 100px; }
        .wp-list-table .column-submission_date { width: 150px; }
    </style>';
}

// Add metabox for detailed view
add_action('add_meta_boxes', 'iwca_partnership_metabox');
function iwca_partnership_metabox() {
    add_meta_box(
        'iwca_partnership_details',
        'Application Details',
        'iwca_partnership_metabox_callback',
        'iwca_partnership',
        'normal',
        'high'
    );
}

function iwca_partnership_metabox_callback($post) {
    echo '<table class="widefat fixed" cellspacing="0" style="margin-top: 10px;">';
    echo '<tbody>';
    
    $fields = array(
        'Application ID' => 'IWCA-' . $post->ID,
        'Submission Date' => get_post_meta($post->ID, 'submission_date', true),
        'Status' => get_post_meta($post->ID, 'status', true) ?: 'New',
        'Full Name' => get_post_meta($post->ID, 'full_name', true),
        'Email' => get_post_meta($post->ID, 'email', true),
        'Mobile' => get_post_meta($post->ID, 'mobile', true),
        'Description' => get_post_meta($post->ID, 'description', true),
        'Organization' => get_post_meta($post->ID, 'organization', true),
        'Country' => get_post_meta($post->ID, 'country', true),
        'District/State' => get_post_meta($post->ID, 'district', true),
        'Preferred Contact' => get_post_meta($post->ID, 'contact_method', true),
        'Terms Agreement' => get_post_meta($post->ID, 'terms_agreement', true),
    );
    
    foreach ($fields as $label => $value) {
        echo '<tr>';
        echo '<td width="30%"><strong>' . $label . ':</strong></td>';
        echo '<td>' . esc_html($value) . '</td>';
        echo '</tr>';
    }
    
    // Areas of Interest
    $issues = get_post_meta($post->ID, 'issues', true);
    echo '<tr>';
    echo '<td><strong>Areas of Interest:</strong></td>';
    echo '<td>';
    if (is_array($issues)) {
        echo '<ul style="margin: 0; padding-left: 20px;">';
        foreach ($issues as $issue) {
            echo '<li>' . esc_html($issue) . '</li>';
        }
        echo '</ul>';
    }
    echo '</td>';
    echo '</tr>';
    
    // Additional Information
    $additional = get_post_meta($post->ID, 'additional_info', true);
    if ($additional) {
        echo '<tr>';
        echo '<td><strong>Additional Information:</strong></td>';
        echo '<td>' . nl2br(esc_html($additional)) . '</td>';
        echo '</tr>';
    }
    
    echo '</tbody>';
    echo '</table>';
}

// Add status update metabox
add_action('add_meta_boxes', 'iwca_partnership_status_metabox');
function iwca_partnership_status_metabox() {
    add_meta_box(
        'iwca_partnership_status',
        'Update Status',
        'iwca_partnership_status_metabox_callback',
        'iwca_partnership',
        'side',
        'high'
    );
}

function iwca_partnership_status_metabox_callback($post) {
    wp_nonce_field('iwca_partnership_status_save', 'iwca_partnership_status_nonce');
    
    $current_status = get_post_meta($post->ID, 'status', true) ?: 'New';
    $statuses = array('New', 'Reviewed', 'Contacted', 'Approved', 'Rejected');
    
    echo '<select name="iwca_application_status" style="width: 100%; margin-bottom: 10px;">';
    foreach ($statuses as $status) {
        echo '<option value="' . $status . '" ' . selected($current_status, $status, false) . '>' . $status . '</option>';
    }
    echo '</select>';
    
    echo '<input type="submit" class="button button-primary" value="Update Status">';
}

// Save status updates
add_action('save_post_iwca_partnership', 'iwca_partnership_status_save');
function iwca_partnership_status_save($post_id) {
    if (!isset($_POST['iwca_partnership_status_nonce']) || 
        !wp_verify_nonce($_POST['iwca_partnership_status_nonce'], 'iwca_partnership_status_save')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['iwca_application_status'])) {
        update_post_meta($post_id, 'status', sanitize_text_field($_POST['iwca_application_status']));
    }
}
?>