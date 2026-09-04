<?php /* Template Name: About Page Template */ get_header(); 
    include get_template_directory() . '/inc/menus/menu.php'; 
?>
	<main role="main">
	    <section class="page-header shadow-sm">
	        <div class="container">
	            <div class="row">
	                <div class="col-md-7 col-sm-7" data-aos="fade-up">
	                    <h1 class="entry-title"><?php the_title(); ?></h1>
	                    <p class="excerpt"><?php the_excerpt(); ?></p>
	                </div><!-- Title & Excerpt !-->
	                <div class="col-md-5 col-sm-5 align-self-center">
	                    <?php custom_breadcrumb(); ?>
	                </div><!-- breadcrumb !-->
	            </div><!-- row !-->
	        </div><!-- container !-->
	    </section><!-- Header Section !-->
	<main role="main">
		<!-- section -->
		<section>
    <div class="Error_404">
        <div class="container">
                <div class="error_pic">
                    <i class="bi bi-heartbreak-fill"></i></div>
                <div class="error_desk"><h2>Ooops... Error 404</h2><h4>We are sorry, but the page you are looking for does not exist.</h4><p><span class="check">Please check entered address and try again or </span> <a class="button button_filled" href="./">go to homepage</a></p></div>
        </div>
    </div>
		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
