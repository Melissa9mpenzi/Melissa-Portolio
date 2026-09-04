<?php
    // Function to display breadcrumb
    function custom_breadcrumb() {
    echo '<div class="breadcrumb mx-auto" data-aos="fade-up">';
    echo '<a href="' . home_url() . '">Home &nbsp;</a>';

    // Check if on a single post or page
    if (is_single() || is_page()) {
         

        echo ' / ' . get_the_title();
    } elseif (is_category()) {
        $category = get_queried_object();
        echo ' / ' . esc_html($category->name);
    } elseif (is_tag()) {
        $tag = get_queried_object();
        echo ' / ' . esc_html($tag->name);
    } elseif (is_author()) {
        $author = get_queried_object();
        echo ' / ' . esc_html($author->display_name);
    } elseif (is_search()) {
        echo ' / Search results for "' . esc_html(get_search_query()) . '"';
    } elseif (is_404()) {
        echo ' / 404 Page Not Found';
    }

    echo '</div>';
}

?>
