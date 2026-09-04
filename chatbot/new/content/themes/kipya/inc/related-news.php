<!-- News Loop -->
<?php
$current_post_id = get_the_ID();

// Get the latest 5 news articles excluding the current one
$news_args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'category_name' => 'news, blog',
    'post__not_in' => array($current_post_id) // Exclude the current post
);

$news_query = new WP_Query($news_args);

if ($news_query->have_posts()) :
?>
<div class="columns is-multiline">
    <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
    <div class="column is-12">
        <article>
            <a href="<?= esc_url(get_permalink()); ?>">
                <div class="card kpy-horizontal-news-card mb-3" data-aos="fade-up">
                    <div class="post-thumbnail">
                        <?php // Display the post thumbnail
                        if (has_post_thumbnail()) {
                            the_post_thumbnail();
                        } else {
                            echo '<img src="' . get_template_directory_uri() . '/assets/images/placeholder-image.jpg" alt="News"/>';
                        }
                        ?>
                    </div>
                    <div class="card-content">
                        <h5><?php the_title(); ?></h5>
                        <div class="catz">
                            <span class="icon"><i class="fa-regular fa-calendar-check" aria-hidden="true"></i></span> <?php
                            $post_date = get_the_date();
                            echo $post_date;
                            ?>
                        </div><!-- Date !-->
                        <!--<a href="<?= esc_url(get_permalink()); ?>" class="btn btn-outline-info read-more">Read More</a> !-->
                    </div><!-- card content !-->
                </div><!-- card !-->
            </a>
        </article>
    </div><!-- col !-->
    <?php endwhile;
    wp_reset_postdata();
    ?>
</div><!-- Columns !-->
<?php
else :
    echo 'No news found.';
endif;
?>
