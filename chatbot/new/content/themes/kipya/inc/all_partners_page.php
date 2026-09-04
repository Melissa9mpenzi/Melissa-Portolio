<?php
function allPartnerz_shortcode($atts) {


	$atts = shortcode_atts(
        array(
            'category' => '', // Default to empty string if not specified
            'number' => 14, // Default number of posts per page
            'order' => 'rand', //Default Descending order
        ),
        $atts,
        'partner'
    );

    // Custom query to retrieve Partners
    $partners_args = array(
        'post_type' => 'partner',
        'posts_per_page' => $atts['number'], // Number of posts per page
        'category'=> $atts['category'],
        'orderby' => 'date', // Order by date
        'order' => $atts['order'], // order
    );

    // Check if category attribute is provided and not empty
    if (!empty($atts['category'])) {
        $partners_args['tax_query'] = array(
            array(
                'taxonomy' => 'partner_category',
                'field' => 'slug',
                'terms' => $atts['category'],
            ),
        );
    }

    $partners_query = new WP_Query($partners_args);

    ob_start();
	?>																
	<?php $partners_query = new WP_Query($partners_args);?>
		<?php if ($partners_query->have_posts()) : ?>
		<div class="columns is-multiline">
			<?php while ($partners_query->have_posts()) :
				$partners_query->the_post();
				$categories = get_the_category();
            	$website        = get_post_meta(get_the_ID(), '_website', true);
				
			?>
			<div class="column is-one-quarter-desktop is-half-tablet all_partners">
				<article>
					<a href="<?= esc_url($website); ?>" target="_blank">
						<div class="card mb-3" data-aos="fade-up">
							<div class="post-thumbnail">
								<?php // Display the post thumbnail
									if (has_post_thumbnail()) {
										the_post_thumbnail('full'); 
									}else{
										echo '<img src="'. get_template_directory_uri().'/assets/images/photo-placeholder.jpg" alt="NGO"/>';
									}
								?>
								
							</div>
							<div class="card-content">
								<h3 style="font-size: 12px"><small><?php the_title(); ?></small></h3>
							</div><!-- card body !-->
						</div><!-- card !-->
					</a>
				</article>
			</div><!-- col !-->
			<?php endwhile;
				wp_reset_postdata();
			else :
				echo 'No partners/associates found.';
			endif;
			?>
	</div><!-- Columns !-->
    <?php

    return ob_get_clean(); // Return the buffered content
}

// Register the shortcode
add_shortcode('bhfpartners', 'allPartnerz_shortcode');

?>