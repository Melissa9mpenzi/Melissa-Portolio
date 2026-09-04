<?php 
if (is_singular('directory')) {
/* Template Name: Single Directory Template */ get_header(); 
    include get_template_directory() . '/inc/menus/menu.php'; 

    $post_id        = get_the_ID();
    $address        = get_post_meta($post_id, '_address', true);
    $phone          = get_post_meta($post_id, '_phone', true);
    $email          = get_post_meta($post_id, '_email', true);
    $fax            = get_post_meta($post_id, '_fax', true);
    $town           = get_post_meta($post_id, '_town', true);
    $district       = get_post_meta($post_id, '_district', true);
    $website        = get_post_meta($post_id, '_website', true);
    $cpname         = get_post_meta($post_id, '_cpname', true);
    $cpphone        = get_post_meta($post_id, '_cpphone', true);
    $cpemail        = get_post_meta($post_id, '_cpemail', true);
    $position       = get_post_meta($post_id, '_position', true);
    $facebook       = get_post_meta($post_id, '_facebook', true);
    $linkedin       = get_post_meta($post_id, '_linkedin', true);
    $instagram      = get_post_meta($post_id, '_instagram', true);
    $x              = get_post_meta($post_id, '_x', true);
    $whatsapp       = get_post_meta($post_id, '_whatsapp', true);
    
    ?>
	<main role="main">
	    <?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
		<section class="header-wrap1" style="background: linear-gradient(to top, rgba(94, 196, 1, 0.05), rgba(94, 196, 1, 0.1)), url('<?php echo $backgroundImg[0]; ?>') no-repeat;background-size: cover;background-position: center center; ">
		    <div class="overlay">
		    <div class="page-title">
        		  <div class="container">
                    <div class="row justify-content-between">
                    <div class="col-lg-12 align-self-end"> <h1 class="entry-title"><?php the_title(); ?></h1>
                    </div>
                    </div>
                </div>
		    </div>
		    </div>
        </section><!-- Header Section !-->
		<section>
		    <div class="container page-content2">
		        <div class="post-content">
		            <div class="row justify-content-between pub-single">
		            <div class="col-lg-5 col-md-5 col-sm-5" data-aos="fade up">
		                <?php if (have_posts()): while (have_posts()) : the_post(); ?>
			            <!-- article -->
			            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            			<div class="post-thumbnail mb-3">
            			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
            				<?php the_post_thumbnail(); // Fullsize image for the single post ?>
            			<?php endif; ?>
            			</div><!-- post thumbnail -->
            		
		        </div>
		        <div class="col-lg-7 col-md-7 col-sm-7">
		            <div class="about-side-pub">
		                <!-- /post thumbnail -->
                <h1 class="entry-title"><?php the_title(); ?></h1>
				<h4 class="pub-summ">About</h4>
				<div class="pub-desc"><?php the_content(); ?></div>
				<hr />
				 
				  
                    <!-- social media sharing !-->
				<div class="d-flex justify-content-start bd-highlight mb-5">
                            <div class="bd-highlight p-1">
                            <small class="text-muted">share this member</small>
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
                            <div class="bd-highlight p-1">
                                <?php do_action('back_button'); ?>
                            </div><!-- Back button !-->
                        </div><!-- social sharing !-->
				<!-- End of Social Media sharing !-->
				
		            </div>
		        </div>
		        </div>
		        </div>
		  

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
 <?php
    } else {
    echo '<p>Sorry, this page is only for Directory Member Listing.</p>';
    }

 get_footer(); ?>