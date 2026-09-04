<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container mb-4">
        <div class="row">
            <div class="col-lg-5">
               <!-- post thumbnail -->
	    	<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail(array(620,400)); // Declare pixel size you need inside the array ?>
			</a>
		<?php endif; ?>
		<!-- /post thumbnail --> 
            </div>
            <div class="col-lg-7 blopg">
                	<!-- post title -->
        		<h3 class="kipya-post-title">
        			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        		</h3>
        		<!-- post meta details -->
        		<div class="kipya-blog-meta">
        		<span class="date"><i class="bi bi-clock-fill"></i> <?php the_time('F j, Y'); ?> </span> &nbsp;&nbsp;
        		<span class="author"><i class="bi bi-person-fill"></i> <?php _e( 'By', 'html5blank' ); ?> <?php the_author(); ?></span>
        		
                </div>
        		<!-- /post title -->
        		<?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>

	        	<?php edit_post_link(); ?>
		        	
		        
            </div>
        </div>
    </div>
		
	</article>
	<!-- /article -->

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
