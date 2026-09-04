<!Doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
		<?php
		$seo_title = get_post_meta(get_the_ID(), '_seo_title', true);
		if (!empty($seo_title)) {echo esc_html($seo_title);} else {echo esc_html(get_the_title());}
		?>
		</title>
		<meta name="description" content="
		<?php
		$seo_description = get_post_meta(get_the_ID(), '_seo_description', true);
		if (!empty($seo_description)) { echo esc_html($seo_description);} else {echo esc_html(get_the_excerpt());}
		?>
		">
		<meta name="keywords" content="
		<?php
		$seo_keywords = get_post_meta(get_the_ID(), '_seo_keywords', true);
		if (!empty($seo_keywords)) {echo esc_html($seo_keywords);} else {echo esc_html('International Women Coffee Alliance');}
		?>
		">
		<!-- Open Graph and Twitter Card Meta Tags -->
		<meta property="og:title" content="
		<?php
			if (!empty($seo_title)) {echo esc_html($seo_title);} else {echo esc_html(get_the_title());}
		?>
		"/>
		<meta property="og:description" content="
		<?php
			if (!empty($seo_description)) {echo esc_html($seo_description);} else {echo esc_html(get_the_excerpt());}
		?>
		"/>
		<meta property="og:image" content="
		<?php
		$featured_image = get_the_post_thumbnail_url();
		$default_image=  get_template_directory_uri() . '/assets/images/intro-bg.jpg'; 
		if (!empty($featured_image)) {echo esc_url($featured_image);} else {echo esc_url($default_image);}
		?>
		" />
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<meta name="twitter:title" content="
		<?php
		if (!empty($seo_title)) {echo esc_html($seo_title);} else {echo esc_html(get_the_title());}
		?>
		"/>
		<meta name="twitter:description" content="
		<?php
		if (!empty($seo_description)) {echo esc_html($seo_description);} else {echo esc_html(get_the_excerpt());} 
		?>
		"/>
		<meta name="twitter:image" content="
		<?php
		if (!empty($featured_image)) {echo esc_url($featured_image);} else {echo esc_url($default_image);}
		?>
		"/>
	

		<?php wp_head(); ?>
	</head>
