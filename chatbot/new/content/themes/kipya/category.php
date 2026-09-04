<?php get_header(); ?>

	<main role="main" style="background-color: #F4F4F4;">
		<!-- section -->
		<div class="header-wrap" style="background: linear-gradient(90deg, rgba(0, 0, 0, 0.7), rgba(168, 169, 173, 0.3)), url('<?php echo get_template_directory_uri(); ?>/images/Storm-over-resource-consult-2.jpg') no-repeat center center; min-height: 380px; padding-top: 20%;">
        <div class="container"><div class="row"><div class="col-lg-12 align-self-baseline">
        <h1 class="entry-title"><?php _e( '', 'html5blank' ); single_cat_title(); ?></h1>
        <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id=“breadcrumbs”>','</p><p>' );
            }
        ?>
        </div></div></div>
    </div>
		<section class="services section-bg">
            <div class="container servpages pt-5">

			<div class="row">
             <div class="col">  
             <?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>
             </div>   
                
            </div>
            </div>
		</section>
		<!-- /section -->
	</main>



<?php get_footer(); ?>
