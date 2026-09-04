<?php


add_action('wp_ajax_kipya_ajax_search', 'kipya_ajax_search');
add_action('wp_ajax_nopriv_kipya_ajax_search', 'kipya_ajax_search');

function kipya_ajax_search() {
    // Get the search query
    $search_query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';

    // Search for posts, pages, and custom post types like 'downloads'
    $args = array(
        's' => $search_query,
        'post_type' => array('post', 'page', 'downloads'), // You can add other post types here
        'posts_per_page' => 10 // Limit results
    );

    $search_results = new WP_Query($args);

    if ($search_results->have_posts()) {
        while ($search_results->have_posts()) {
            $search_results->the_post();
            // Get the title
            $title = get_the_title();
            // Get the permalink
            $permalink = get_permalink();
            // Get the excerpt or truncate the content to 100 characters
            $excerpt = wp_trim_words(get_the_excerpt(), 20, '...'); // Limit excerpt to 100 chars approx.
            ?>
            <div class="search-result-item">
                <h5><a href="<?= esc_url($permalink); ?>"><?= esc_html($title); ?></a></h5>
                <p><?= esc_html($excerpt); ?></p>
            </div>
            <?php
        }
        wp_reset_postdata();
    } else {
        echo '<p>No results found.</p>';
    }

    wp_die(); // Terminate the script properly.
}


