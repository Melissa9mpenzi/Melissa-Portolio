<?php 
if (is_singular('downloads')) {
    get_header(); 
    include get_template_directory() . '/inc/menus/menu.php'; 

    $post_id = get_the_ID();
            
    $file_url       =  get_post_meta($post_id, '_file_url', true);
    $file_size      =  get_post_meta($post_id, '_file_size', true);
    $downloadCount = get_post_meta($post_id, '_download_count', true);
    
    // Get the file size
    $file_size = '';
    if ($file_url) {
        $headers = get_headers($file_url, 1);
        $file_size = isset($headers['Content-Length']) ? size_format($headers['Content-Length']) : '';
        }
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
        </section>
		<section>
		    <div class="container page-content2">
		        <div class="post-content">
		            <div class="row justify-content-between pub-single">
		            <div class="col-lg-5 col-md-5 col-sm-5" data-aos="fade up">
		        <?php if (have_posts()): while (have_posts()) : the_post(); ?>
			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		            <!-- post thumbnail -->
        			<div class="post-thumbnail">
        			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
        				<?php the_post_thumbnail(); // Fullsize image for the single post ?>
        			<?php endif; ?>
        			</div>
		        </div>
		        <div class="col-lg-7 col-md-7 col-sm-7">
		            <div class="about-side-pub">
		                <!-- /post thumbnail -->
                <h1 class="entry-title"><?php the_title(); ?></h1>
				<h4 class="pub-summ">Overview</h4>
				<div class="pub-desc"><?php the_content(); ?></div>
				<hr />
				<div class="pub-download"> <a href="<?= $file_url; ?>" target="_blank" onclick="updateDownloadCount(<?= $post_id; ?>)"> Download</button></a></div> 
				<div class="pub-stats py-3"> <i class="bi bi-bar-chart-fill"></i> <small>No. Of Downloads: <?= $downloadCount; ?></small> <i class="bi bi-file-earmark-pdf"></i> <small>File Size: <?= $file_size; ?> </small> </div>   
                    <!-- social media sharing !-->
				<div class="d-flex justify-content-start bd-highlight mb-5">
                            <div class="bd-highlight p-1">
                            <small class="text-muted">share this publication</small>
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
	<script>
    function updateDownloadCount(post_id) {
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            data: {
                action: 'update_download_count',
                post_id: post_id
            },
            success: function(response) {
                // Optionally handle success response
                console.log('Download count updated successfully.');
            }
        });
    }
</script>
 </main>
 <?php
    } else {
    // If the post type is not "downloads", you can display a message or redirect to another page
    echo '<p>Sorry, this page is only for downloads.</p>';
    }

 get_footer(); ?>