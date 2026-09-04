<?php

function register_accordion_post_type() {
    register_post_type('accordion', [
        'labels' => [
            'name' => __('Accordions'),
            'singular_name' => __('Accordion'),
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor'],
        'hierarchical' => false,
        'show_in_rest' => true,
    ]);

    register_taxonomy('accordion_category', 'accordion', [
        'labels' => [
            'name' => __('Accordion Categories'),
            'singular_name' => __('Accordion Category'),
        ],
        'hierarchical' => true,
        'show_in_rest' => true,
    ]);
}
add_action('init', 'register_accordion_post_type');


//Shortcode
function accordion_shortcode($atts) {
    $atts = shortcode_atts(['category' => ''], $atts);

    // Fetch posts in the specified category
    $args = [
        'post_type' => 'accordion',
        'order' => 'ASC',
        'tax_query' => [
            [
                'taxonomy' => 'accordion_category',
                'field' => 'slug',
                'terms' => $atts['category'],
            ],
        ],
        'posts_per_page' => -1,
    ];
    $query = new WP_Query($args);

    if (!$query->have_posts()) {
        return '<p class="has-text-grey">No accordion items found.</p>';
    }

    // Build the accordion HTML
    $output = '<div class="kpy-accordion">';
    $count = 0;

    while ($query->have_posts()) {
        $query->the_post();
        $count++;
        $title = get_the_title();
        $excerpt = get_the_content();
        $panel_id = 'kpy-accordion-panel-' . $count;

        $output .= '
        <div class="kpy-accordion-item ' . ($count === 1 ? 'is-active' : '') . '">
            <button class="kpy-accordion-trigger button is-white is-fullwidth has-text-left" type="button"
                aria-controls="' . esc_attr($panel_id) . '"
                aria-expanded="' . ($count === 1 ? 'true' : 'false') . '"
                data-accordion-target="#' . esc_attr($panel_id) . '">
                <span class="icon mr-2"><i class="fa-regular fa-circle-check" aria-hidden="true"></i></span>
                <span>' . esc_html($title) . '</span>
            </button>
            <div id="' . esc_attr($panel_id) . '" class="kpy-accordion-panel">
                <div class="content">
                    ' . $excerpt . '
                </div>
            </div>
        </div>';
    }

    wp_reset_postdata();
    $output .= '</div>';

    return $output;
}
add_shortcode('accordion', 'accordion_shortcode');
