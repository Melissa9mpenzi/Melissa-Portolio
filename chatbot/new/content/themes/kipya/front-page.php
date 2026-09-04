<?php /* Template Name: Front Page Template */ get_header(); 
include get_template_directory() . '/inc/menus/menu.php';
?>
		<main role="main">
		 <?php
        include get_template_directory() . '/inc/slides/ken-burns-slides.php';
        ?>
			<section>
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

	</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'kipya' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>
		</section>
    </main> <!-- Main Area !-->
<?php get_footer(); ?>

