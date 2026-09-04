<?php

// ===============================
// 1. AJAX Handler for Filtering
// ===============================
function filter_downloads_by_file_category() {
    $slug = sanitize_text_field($_POST['category_slug']);
    echo do_shortcode('[publication category="' . $slug . '"]');
    wp_die();
}
add_action('wp_ajax_filter_downloads_by_file_category', 'filter_downloads_by_file_category');
add_action('wp_ajax_nopriv_filter_downloads_by_file_category', 'filter_downloads_by_file_category');


// ===============================
// 2. Publications Shortcode
// ===============================
function download_shortcode($atts) {
    $atts = shortcode_atts(array(
        'category' => '',
        'number' => 70,
        'order' => 'DESC',
    ), $atts, 'publication');

    $paged = max(1, get_query_var('paged') ?: 1);

    $args = array(
        'post_type' => 'downloads',
        'posts_per_page' => $atts['number'],
        'orderby' => 'date',
        'order' => $atts['order'],
        'paged' => $paged,
    );

    if (!empty($atts['category'])) {
        $args['tax_query'] = array(array(
            'taxonomy' => 'file_category',
            'field'    => 'slug',
            'terms'    => $atts['category'],
        ));
    }

    $query = new WP_Query($args);
    ob_start();
    ?>

    <div id="downloads-table_wrapper" class="dataTables_wrapper no-footer">
        <div class="dataTables_length" id="downloads-table_length">
            <label>Show 
                <select name="downloads-table_length" aria-controls="downloads-table" class="">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select> entries
            </label>
        </div>
        <div id="downloads-table_filter" class="dataTables_filter">
            <label>Search:<input type="search" class="" placeholder="" aria-controls="downloads-table"></label>
        </div>
        
        <table id="downloads-table" class="table expandable-table w-100 dataTable no-footer" style="width: 100%;" aria-describedby="downloads-table_info">
            <thead>
                <tr>

                    <th class="sorting sorting_asc" tabindex="0" aria-controls="downloads-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label=": activate to sort column descending" style="width: 0px;"></th>
                    <th class="sorting" tabindex="0" aria-controls="downloads-table" rowspan="1" colspan="1" aria-label=": activate to sort column ascending" style="width: 0px;"></th>
                    <th class="d-none sorting" tabindex="0" aria-controls="downloads-table" rowspan="1" colspan="1" aria-label=": activate to sort column ascending" style="width: 0px;"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $count = 0;
                while ($query->have_posts()) : $query->the_post(); 
                    $count++;
                    $post_id = get_the_ID();
                    $file_url = get_post_meta($post_id, '_file_url', true);
                    $download_count = get_post_meta($post_id, '_download_count', true);
                    $file_size = '';
                    if ($file_url) {
                        $headers = @get_headers($file_url, 1);
                        $file_size = isset($headers['Content-Length']) ? size_format($headers['Content-Length']) : '';
                    }
                    $row_class = ($count % 2 == 0) ? 'even' : 'odd';
                    $link = esc_url(get_permalink());
                ?>
                <tr class="<?php echo $row_class; ?> clickable-row" data-href="<?php echo $link; ?>">
                    <!-- Paper Icon Image -->
                    <td width="20%" class="sorting_1">
                        <img decoding="async" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png"" alt="publication" style="width: 100px;">
                    </td>
                
                    <!-- Content Block -->
                    <td width="100%">
                        <div class="py-1">
                            <small>Downloads: <?php echo esc_html($download_count); ?> | Size: <?php echo esc_html($file_size); ?></small>
                        </div>
                        <h4 class="pub-title"><?php echo get_the_title(); ?></h4>
                        <div class="pub-link">
                            <p><?php the_excerpt(); ?></p>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>

            </tbody>
        </table>
        
        <div class="dataTables_info" id="downloads-table_info" role="status" aria-live="polite">
            Showing <?php echo (($paged - 1) * $atts['number']) + 1; ?> to <?php echo min($paged * $atts['number'], $query->found_posts); ?> of <?php echo $query->found_posts; ?> entries
        </div>
        
        <div class="dataTables_paginate paging_simple_numbers" id="downloads-table_paginate">
            <?php
            echo paginate_links(array(
                'total' => $query->max_num_pages,
                'current' => $paged,
                'prev_text' => __('Previous'),
                'next_text' => __('Next'),
                'type' => 'plain',
                'before_page_number' => '<a class="paginate_button" aria-controls="downloads-table" aria-role="link" data-dt-idx="1" tabindex="0">',
                'after_page_number' => '</a>',
                'format' => '',
            ));
            ?>
        </div>
    </div>

    <script>
    function updateDownloadCount(post_id) {
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            data: {
                action: 'update_download_count',
                post_id: post_id
            },
            success: function(response) {
                console.log('Download count updated');
            }
        });
    }
    
    jQuery(document).ready(function($) {

    // Make table row clickable
    $('.clickable-row').on('click', function () {
        window.location = $(this).data('href');
    });

    // Show entries functionality
    $('#downloads-table_length select').change(function() {
        console.log('Show entries changed to:', $(this).val());
    });

    // Search functionality
    $('#downloads-table_filter input').keyup(function() {
        var searchText = $(this).val().toLowerCase();
        $('#downloads-table tbody tr').each(function() {
            var rowText = $(this).text().toLowerCase();
            $(this).toggle(rowText.indexOf(searchText) > -1);
        });
    });
});
    </script>


    <?php
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('publication', 'download_shortcode');



// ===============================
// 3. Downloads Category Menu Shortcode
// ===============================
function download_category_menu_shortcode($atts) {
    $categories = get_terms(array(
        'taxonomy' => 'file_category',
        'hide_empty' => true,
        'orderby' => 'name',
        'parent' => 0,
    ));

    if (empty($categories) || is_wp_error($categories)) {
        return '<div class="downloads-category-menu-notice">No categories available</div>';
    }

    ob_start(); ?>

    <div class="downloads-category-menu">
        <h4 class="category-menu-title">Browse Publications</h4>
        <ul class="category-menu-list">
            <li class="category-menu-item">
                <a href="#" class="category-menu-link active" data-category="">All</a>
            </li>
            <?php foreach ($categories as $category): ?>
                <li class="category-menu-item">
                    <a href="#" class="category-menu-link" data-category="<?php echo esc_attr($category->slug); ?>">
                        <span class="category-name"><?php echo esc_html($category->name); ?></span>
                        <span class="category-count">(<?php echo esc_html($category->count); ?>)</span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('.category-menu-link');

        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // highlight active category
                links.forEach(l => l.classList.remove('active'));
                this.classList.add('active');

                const category = this.getAttribute('data-category');

                // AJAX request to filter table
                fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'action=filter_downloads_by_file_category&category_slug=' + category
                })
                .then(response => response.text())
                .then(data => {
                    // Replace the table with filtered results
                    document.querySelector('#downloads-table_wrapper').outerHTML = data;
                });
            });
        });
    });
    </script>

    <?php
    return ob_get_clean();
}
add_shortcode('download_category_menu', 'download_category_menu_shortcode');
