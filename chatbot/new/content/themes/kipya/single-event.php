<?php 
	get_header(); 
    include get_template_directory() . '/inc/menus/menu.php'; 
	
	$post_id = get_the_ID();
    $text = get_the_content();
    $url =  get_post_meta(get_the_ID(), '_link', true);
    $location =  get_post_meta(get_the_ID(), '_location', true);
    $start_date = get_post_meta(get_the_ID(), '_start_date', true);
	$end_date = get_post_meta(get_the_ID(), '_end_date', true);
    $formatted_start_date = date('jS, F Y', strtotime($start_date)); // Format for Date
    $formatted_start_month = date('F', strtotime($start_date)); // Format for Month
    $formatted_start_time = date('g:i A', strtotime($start_date)); // Format for Time
	$formatted_end_date = date('jS, F Y', strtotime($end_date)); // Format for Date

	?>
	<main role="main">
		<?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
		<section>
		    <div class="header-wrap1" style="background: linear-gradient(90deg, rgba(6, 6, 5, 0.8), rgba(12, 12, 12, 0.5)), url('<?php echo $backgroundImg[0]; ?>') no-repeat;background-size: cover;background-position: center center;">
        <div class="container"><div class="row">
			<div class="col-lg-12 entry-title" data-aos="fade-up">
				<h1><?php the_title(); ?></h1>
				<?php custom_breadcrumb(); ?>
        	</div>
		</div></div>
    </div>
        </section><!-- Header Section !-->
		<section class="single-post-page py-lg-4 py-3">
		    <div class="container-xxl">
		        <div class="row">
		            <div class="col-lg-9 col-md-9 col-sm-9" data-aos="fade up"><div class="post-content">
		        <?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<!-- post thumbnail -->
        			<div class="post-thumbnail mt-3">
        			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
        				<?php the_post_thumbnail(); // Fullsize image for the single post ?>
        			<?php endif; ?>
        			</div>
        			<!-- /post thumbnail -->
				<h1 class="entry-title"><?php the_title(); ?></h1>
					<hr>
					<div class="row">
						<div class="col-md-7">
						<strong>Location:</strong> <br> <span class="badge bg-success"><?= esc_html($location); ?></span>
						</div>
						<div class="col-md-5"><small>
							<div class="row g-1">
								<div class="col"><strong>Start Date:</strong> <br> <span class="badge bg-info"><?= esc_html($formatted_start_date); ?></span></div>
								<div class="col"><strong>End Date:</strong> <br> <span class="badge bg-warning"><?= esc_html($formatted_end_date); ?></span></div>
								
							</div></small>
						</div>
					</div>
					
					<hr>
					<?php the_content(); ?>
				
				<!-- social media sharing !-->
				<div class="d-flex justify-content-center bd-highlight mb-1">
                            <div class="bd-highlight p-1">
                                <small class="text-muted">share this article</small>
                            </div>
                            <div class="bd-highlight p-1">
                                <a class="btn btn-sm btn-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?= esc_url(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" title="Facebook">
                                <small>Share on <i class="bi bi-facebook"></i> </small>
                                </a>
                            </div><!-- Facebook !-->
                            <div class="bd-highlight p-1">
                                <a class="btn btn-sm btn-twitter" href="https://twitter.com/intent/tweet?url=<?= esc_url(get_permalink()); ?>&text=<?= the_title(); ?>" target="_blank" rel="noopener noreferrer" title="Twitter">
                                <small> Share on <i class="bi bi-twitter-x"></i></small>
                                </a>
                            </div><!-- Twitter !-->
                            <div class="bd-highlight p-1">
                                <a class="btn btn-sm btn-whatsapp" href="whatsapp://send?text=Check out this product: <?= the_title(); ?> - <?= esc_url(get_permalink());?>" data-action="share/whatsapp/share" title="WhatsApp">
                                <small><i class="bi bi-whatsapp"></i> WhatsApp</small>
                                </a>
                            </div><!-- WhatsApp !-->
                        </div><!-- social sharing !-->
				<!-- End of Social Media sharing !-->
		        </div>
		        </div>
		        <div class="col-lg-3 col-md-3 col-sm-3">
		            <div class="about-side">
		                <h3>Other Events</h3>
		                <?php
                        include get_template_directory() . '/inc/related-news.php';
                        ?>

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

				<h2><?php _e( 'Sorry, nothing to display.', 'pelere' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>
		    </div>
		</section>
		<div class="mb-md-5 mt-3"></div>
		<!-- /section -->
 </main>
<?php 

get_footer(); ?>