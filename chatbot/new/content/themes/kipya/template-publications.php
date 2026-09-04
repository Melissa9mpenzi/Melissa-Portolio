<?php /* Template Name: Publications Page Template */ get_header(); 
    include get_template_directory() . '/inc/menus/menu.php'; 
?>
	<main role="main">
	 	<?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
		<section class="header-wrap1" style="background: linear-gradient(to top, rgba(15, 5, 1, 0.75), rgba(51, 2, 2, 0.9)), url('<?php echo $backgroundImg[0]; ?>') no-repeat;background-size: cover;background-position: center center; ">
		    <div class="overlay">
		    <div class="page-title">
        		  <div class="container">
                    <div class="row justify-content-between">
                    <div class="col-lg-12 align-self-end"> 
						<h1 class="entry-title" data-aos="fade-up"><?php the_title(); ?></h1>
						<?php custom_breadcrumb(); ?>
                    </div>
                    </div>
                </div>
		    </div>
		    </div>
        </section>

		<section>
		    <div class="pub-content-area container" data-aos="fade-up">
		        <?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			 <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-9">
                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>
                </div>         
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="about-side">
                       <h3>Latest News</h3>
                        <?php include get_template_directory() . '/inc/related-news.php'; ?> 
                    </div>
                </div>
            </div>
				<?php edit_post_link(); ?>

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
		    </div>
		</section>
		<!-- /section -->
 </main>


<?php get_footer(); ?>
