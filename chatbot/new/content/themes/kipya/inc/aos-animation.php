<?php

function aos_block_shortcode($atts, $content = null) {
    // Parse the shortcode attributes
    $atts = shortcode_atts(
        array(
            'animation' => 'fade-up', // Default animation
            'duration' => '1000', // Default duration
            'delay' => '50', // Default delay
            'easing' => 'ease-in-out', // Default easing
            'once' => 'true', // Default once
            'mirror' => 'false', // Default mirror
        ),
        $atts,
        'aos_block'
    );

    // Output AOS initialization and the enclosed content
    ob_start(); ?>
    <div class="aos-init" data-aos="<?php echo esc_attr($atts['animation']); ?>" data-aos-duration="<?php echo esc_attr($atts['duration']); ?>" data-aos-delay="<?php echo esc_attr($atts['delay']); ?>ms" data-aos-easing="<?php echo esc_attr($atts['easing']); ?>" data-aos-once="<?php echo esc_attr($atts['once']); ?>" data-aos-mirror="<?php echo esc_attr($atts['mirror']); ?>">
        <?php echo do_shortcode($content); ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('aos_block', 'aos_block_shortcode');


?>