<!-- News Loop -->
<?php
$current_post_id = get_the_ID();

// Get the latest 5 galleries excluding the current one
$news_args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'category_name' => 'photo-gallery',
    'order' => 'RAND',
    'post__not_in' => array($current_post_id), // Exclude the current post
    
);

$news_query = new WP_Query($news_args);

if ($news_query->have_posts()) :
?>
<div class="row">
    <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
    <div class="col-12">
        <article>
            <a href="<?= esc_url(get_permalink()); ?>">
                <div class="card card-outline-success shadow-sm mb-3 border-0" data-aos="fade-up">
                    <div class="card-body card-outline-success">
                        <h5><?php the_title(); ?></h5>
                    </div><!-- card body !-->
                </div><!-- card !-->
            </a>
        </article>
    </div><!-- col !-->
    <?php endwhile;
    wp_reset_postdata();
    ?>
</div><!-- Row !-->
<?php
else :
    echo 'No Related Galleries found.';
endif;
?>
