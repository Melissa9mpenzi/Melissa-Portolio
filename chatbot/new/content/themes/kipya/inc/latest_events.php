<?php
function latestnews_shortcode() {
    ob_start();

    $news_args = array(
        'post_type'      => 'post', // 'page' changed to 'post'
        'posts_per_page' => 20,
        'category_name'  => 'latest_news',
    );

    $news_query = new WP_Query($news_args);

    if ($news_query->have_posts()) : ?>
        <div class="columns is-multiline news-card">
            <?php while ($news_query->have_posts()) :
                $news_query->the_post(); ?>
                <div class="column is-one-third-desktop is-half-tablet news-section news-title">
                    <article>
                        <div class="card mb-3">
                            <a href="<?= esc_url(get_permalink()); ?>">
                                <h3><?php the_title(); ?></h3>
                            </a>
                            <div class="content post-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?= esc_url(get_permalink()); ?>" class="read-more">Read More</a>
                        </div>
                    </article>
                </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    <?php else :
        echo 'No news found.';
    endif;

    return ob_get_clean();
}
add_shortcode('latest_news', 'latestnews_shortcode');

// AJAX Handlers
function load_latest_news_ajax() {
    echo do_shortcode('[latest_news]');
    wp_die();
}
add_action('wp_ajax_load_latest_news', 'load_latest_news_ajax');
add_action('wp_ajax_nopriv_load_latest_news', 'load_latest_news_ajax');

// Register JavaScript
function enqueue_ajax_scripts() {
    wp_enqueue_script('custom-ajax', get_template_directory_uri() . '/js/custom.js', array('jquery'), null, true);
    wp_localize_script('custom-ajax', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_scripts');
?>