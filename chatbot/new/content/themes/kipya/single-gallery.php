<?php
get_header(); 
include get_template_directory() . '/inc/menus/menu.php'; 
?>

<!-- Enqueue GLightbox manually if not already added -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">


<main role="main">

<?php $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>


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
<!-- Hero Section End -->

<div class="container d-none mb-3">
    <div class="row">
        <div class="col">
            <?php custom_breadcrumb(); ?>
        </div>
    </div>
</div>

<section class="py-md-5 py-2">
    <div class="container-xxl">
        <div class="row">
            <div class="col-xl-9 col-lg-8 mb-3 mygallery">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();

                        $gallery = get_post_gallery(get_the_ID(), false);

                        if ($gallery && isset($gallery['ids'])) :
                            $image_ids = explode(',', $gallery['ids']);
                            ?>
                            <div class="row g-2">
                                <?php foreach ($image_ids as $image_id) :
                                    $image_url = wp_get_attachment_image_url($image_id, 'large');
                                    $thumbnail_url = wp_get_attachment_image_url($image_id, 'medium');
                                    ?>
                                    <div class="col-md-4 col-6">
                                        <a href="<?php echo esc_url($image_url); ?>" class="glightbox" data-gallery="gallery-group">
                                            <img 
                                                src="<?php echo esc_url($thumbnail_url); ?>" 
                                                alt="<?php echo esc_attr(get_the_title($image_id)); ?>" 
                                                class="img-fluid rounded ksmall" 
                                                style="width: 100%; height: 250px;border-radius:0 30px !important;"
                                            >
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php
                        else :
                            echo '<p>No images found in this gallery.</p>';
                        endif;

                    endwhile;
                else :
                    echo '<p>Sorry, no posts matched your criteria.</p>';
                endif;
                ?>
            </div>
            <div class="col-xl-3 col-lg-4 mb-3 about-side">
                <h3>More Galleries</h3>
                <?php include get_template_directory() . '/related-galleries.php'; ?>
            </div>
        </div>
    </div>
</section>

</main>

<!-- GLightbox JS -->
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lightbox = GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true,
            closeButton: true,
            arrows: true,
            zoomable: true,
        });
    });
</script>

<?php get_footer(); ?>
