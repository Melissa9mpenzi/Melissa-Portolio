<?php
/**
 * Contact Custom Post Type and Functionality
 */

// Register custom post type for contact submissions
function register_contact_submission_post_type() {
    $args = array(
        'labels' => array(
            'name' => 'Contact Submissions',
            'singular_name' => 'Submission'
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-email-alt',
        'capability_type' => 'post',
        'capabilities' => array(
            'create_posts' => false,
            'edit_posts' => 'edit_others_posts',
            'delete_posts' => 'delete_others_posts',
        ),
        'map_meta_cap' => true,
        'supports' => array('title'),
        'exclude_from_search' => true,
        'publicly_queryable' => false,
    );
    register_post_type('contact_submission', $args);
}
add_action('init', 'register_contact_submission_post_type');

// Display popup UI in admin
function contact_submission_admin_popup() {
    $screen = get_current_screen();
    if ($screen && $screen->post_type === 'contact_submission') {
        ?>
        <div id="submission-popup" class="submission-modal" style="display:none;">
            <div class="submission-modal-content">
                <div class="submission-modal-header">
                    <h2 id="popup-title"></h2>
                    <button class="submission-modal-close" title="Close popup">&times;</button>
                </div>
                <div class="submission-modal-body" id="popup-body"></div>
                <div class="submission-modal-footer">
                    <span class="submission-date"></span>
                </div>
            </div>
        </div>

        <style>
        .submission-modal {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.3);
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }

        .submission-modal-content {
            background: #fff;
            max-width: 700px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            border-radius: 8px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }
        
        #popup-title  {
            color: #fff !important;
        }

        .submission-modal-header  {
            background: #000;
            color: #fff;
            padding: 20px;
            font-size: 18px;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .submission-modal-close {
            background: none;
            border: none;
            color: #fff;
            font-size: 26px;
            cursor: pointer;
        }

         .submission-modal-body {
            padding: 25px;
            overflow-y: auto;
            scrollbar-width: none; /* Firefox */
        }
        .submission-modal-body::-webkit-scrollbar {
            display: none; /* Chrome */
        }

        .submission-section {
            margin-bottom: 20px;
        }

        .submission-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        .submission-value {
            color: #444;
            line-height: 1.6;
            background: #f8f9fa;
            padding: 12px 15px;
            border-radius: 4px;
            white-space: pre-wrap;
        }

        .submission-modal-footer {
            padding: 15px 25px;
            background: #f1f1f1;
            text-align: right;
            font-size: 13px;
            color: #666;
            border-top: 1px solid #ddd;
        }

        .wp-list-table .row-title {
            cursor: pointer;
            color: #2271b1;
            font-weight: 500;
        }
        </style>

        <script>
        jQuery(document).ready(function($) {
    $('.wp-list-table .row-title').on('click', function(e) {
        e.preventDefault();
        const postId = $(this).closest('tr').attr('id').replace('post-', '');

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'get_submission_data',
                post_id: postId,
                security: '<?php echo wp_create_nonce("submission_nonce"); ?>'
            },
            success: function(response) {
                if (response.success) {
                    $('#popup-title').text(response.data.title);
                    $('.submission-date').text('Received: ' + response.data.date);

                    const lines = response.data.content.split('\n');
                    let contentHTML = '';
                    let inMessage = false;

                    lines.forEach(function(line, index) {
                        if (line.includes(':') && !inMessage) {
                            const [label, ...rest] = line.split(':');
                            const value = rest.join(':').trim();
                            const trimmedLabel = label.trim().toLowerCase();

                            if (trimmedLabel === 'message') {
                                inMessage = true;
                                contentHTML += `
                                    <div class="submission-section">
                                        <span class="submission-label">${label}</span>
                                        <div class="submission-value">${value}`;
                            } else {
                                contentHTML += `
                                    <div class="submission-section">
                                        <span class="submission-label">${label}</span>
                                        <div class="submission-value">${value}</div>
                                    </div>`;
                            }
                        } else if (inMessage) {
                            contentHTML += `<br>${line}`;
                            if (index === lines.length - 1) {
                                contentHTML += `</div></div>`; // Close message section
                            }
                        }
                    });

                    $('#popup-body').html(contentHTML);
                    $('#submission-popup').fadeIn();
                    $('body').css('overflow', 'hidden');
                } else {
                    alert('Could not load submission details.');
                }
            }
        });
    });

    // Close popup
    $(document).on('click', '.submission-modal-close, .submission-modal', function(e) {
        if ($(e.target).is('.submission-modal') || $(e.target).is('.submission-modal-close')) {
            $('#submission-popup').fadeOut();
            $('body').css('overflow', '');
        }
    });

    // ESC key to close
    $(document).on('keyup', function(e) {
        if (e.key === 'Escape') {
            $('#submission-popup').fadeOut();
            $('body').css('overflow', '');
        }
    });
});

        </script>
        <?php
    }
}
add_action('admin_footer', 'contact_submission_admin_popup');

// Handle AJAX request
function get_submission_data_ajax() {
    check_ajax_referer('submission_nonce', 'security');

    if (!current_user_can('edit_others_posts')) {
        wp_send_json_error('Unauthorized');
    }

    $post_id = intval($_POST['post_id']);
    $post = get_post($post_id);

    if ($post && $post->post_type === 'contact_submission') {
        wp_send_json_success(array(
            'title'   => $post->post_title,
            'content' => $post->post_content,
            'date'    => date_i18n('F j, Y \a\t g:i a', strtotime($post->post_date))
        ));
    }

    wp_send_json_error('Submission not found');
}
add_action('wp_ajax_get_submission_data', 'get_submission_data_ajax');

// Customize admin table
function customize_contact_submission_admin() {
    remove_post_type_support('contact_submission', 'title');

    add_filter('manage_contact_submission_posts_columns', function($columns) {
        unset($columns['date']);
        $columns['submission_date'] = 'Received';
        return $columns;
    });

    add_action('manage_contact_submission_posts_custom_column', function($column, $post_id) {
        if ($column === 'submission_date') {
            echo get_the_date('Y/m/d \a\t g:i a', $post_id);
        }
    }, 10, 2);
}
add_action('admin_init', 'customize_contact_submission_admin');