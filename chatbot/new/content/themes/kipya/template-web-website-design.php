<?php
/**
 * Template Name: Web - Web Design
 *
 * @package Kipya
 */

get_header();
include get_template_directory() . '/inc/menus/menu.php';

if (function_exists('kipya_render_service_template')) {
    kipya_render_service_template(array(
        'family'          => 'web',
        'eyebrow'         => 'Websites by LWEGATECH',
        'hero_title'      => 'Professional Website Design',
        'hero_subtitle'   => 'We bring your ideas to life with thoughtful design and smart functionality.',
        'intro_gif'       => 'https://media.giphy.com/media/SWoSkN6DxTszqIKEqv/giphy.gif',
        'intro_title'     => 'Tailored For Your Business',
        'intro_text'      => "Whether you're starting fresh or redesigning, our team ensures your website looks great, loads fast, and helps you achieve more online. We offer flexible web packages tailored exactly to your needs.",
        'packages_bg_text'=> 'Website Designing',
        'packages_sub'    => 'Professional website design tailored for your business — modern, responsive, and optimised to give your brand a strong online presence.',
        'packages_button_url' => home_url('/web-design-packages/'),
        'packages_button_label' => 'View Details About Our Packages',
        'packages' => array(),

        'highlights'      => array(
            array('title' => 'Responsive Design', 'text' => 'Flawless experiences on mobile, tablet, and desktop.',                               'icon' => 'fa-solid fa-mobile-screen'),
            array('title' => 'Speed Optimized',   'text' => 'Fast loading times to improve user retention and SEO ranking.',                     'icon' => 'fa-solid fa-gauge-high'),
            array('title' => 'Custom CMS',         'text' => 'Easy-to-use backend so you can manage your content without any coding knowledge.', 'icon' => 'fa-solid fa-layer-group'),
        ),


        'faqs' => array(
            array('q' => 'Do you provide domain registration and hosting?',   'a' => 'Yes, every package can be bundled with reliable hosting services and custom domain registration handled entirely by our infrastructure team.'),
            array('q' => 'Will my website be mobile-responsive?',             'a' => '100% yes. All websites follow "Mobile-First" principles, ensuring perfect rendering on phones, tablets, and desktops.'),
            array('q' => 'Can I update the website content myself?',          'a' => 'Yes, we implement CMS platforms like WordPress so non-technical staff can manage blogs, news, and media with ease.'),
            array('q' => 'How long does a typical website take?',             'a' => 'LAUNCH is ready in 20 days; GROW in 30 days. DOMINATE and ENTERPRISE timelines depend on the scope of custom features required.'),
            array('q' => 'Do you provide e-commerce implementation?',         'a' => 'Yes! DOMINATE and ENTERPRISE include full e-commerce with payment gateway integration including mobile money and cards.'),
            array('q' => 'Are SEO best practices included?',                  'a' => 'Absolutely. We build with Semantic HTML5 and Google Lighthouse standards for an SEO-ready structure right from launch.'),
            array('q' => 'Will I own the code and the domain?',               'a' => '100%. Upon project completion and final payment, you retain complete legal ownership of all intellectual property and domains.'),
            array('q' => 'Can you integrate our existing CRM or systems?',    'a' => 'Yes. DOMINATE and ENTERPRISE support API integrations spanning HubSpot, Salesforce, payment gateways, and custom endpoints.'),
            array('q' => 'Do we get training on how to use the CMS?',         'a' => 'Yes. GROW includes a 2-hour onsite training session; DOMINATE offers half-day training; ENTERPRISE covers the entire team.'),
            array('q' => 'What happens after the free support period?',       'a' => 'We offer Website Maintenance packages to protect and update your site on a monthly or quarterly basis.'),
        ),

        'deliverables' => array(
            '100% Custom Design & Layout',
            'Social Media & Google Analytics Integration',
            'Full Content Management System Access',
            'Security Configurations',
            'User Manual & Team Training',
        ),

        'why_choose_us' => array(
            array('title' => 'Mobile First',      'icon' => 'bi bi-phone',                     'text' => 'Every design starts with mobile in mind — flawless across all screen sizes from day one.'),
            array('title' => 'Corporate Layouts', 'icon' => 'bi bi-layout-text-window-reverse', 'text' => 'Professional, polished layouts crafted to reinforce corporate identity and brand consistency.'),
            array('title' => 'Custom Designs',    'icon' => 'bi bi-brush',                     'text' => 'Fully bespoke designs built from scratch to reflect your unique business personality.'),
            array('title' => 'SEO Friendly',      'icon' => 'bi bi-search',                    'text' => 'Built with semantic HTML5 and Google Lighthouse standards for top search engine rankings.'),
            array('title' => 'Digital Marketing', 'icon' => 'bi bi-megaphone',                 'text' => 'Integrated marketing-ready features to grow your audience and turn visitors into customers.'),
            array('title' => 'Ecommerce Ready',   'icon' => 'bi bi-cart3',                     'text' => 'Powerful e-commerce with secure payment gateways and seamless product management.'),
        ),

        'cta_title'           => 'Ready to build your digital presence?',
        'cta_text'            => 'Partner with Lwegatech to create a fast, converting, and professional website.',
        'cta_primary_label'   => 'Start Your Project',
        'cta_primary_url'     => 'https://billing.lwegatech.com/get-quote=business-package/13cda37c8f347e8848b66453097cfbf663e14522b81e4cd3',
        'cta_secondary_label' => 'Contact Us',
        'cta_secondary_url'   => home_url('/contact-us/'),
    ));
}

get_footer();
?>