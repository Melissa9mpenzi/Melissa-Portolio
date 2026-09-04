<?php
/**
 * Template Name: Apps - App Development
 * Template Post Type: page
 *
 * @package Kipya
 */

get_header();
include get_template_directory() . '/inc/menus/menu.php';

kipya_render_service_template(
    array(
        'family'        => 'apps',
        'eyebrow'       => 'Apps by LWEGATECH',
        'hero_title'    => 'App Development',
        'hero_subtitle' => 'Your customers are on mobile. Meet them there with Apps that perform.',
        'gif_url'       => 'https://media.giphy.com/media/xT9IgzoKnwFNmISR8I/giphy.gif',
        'intro_title'   => 'Seamless, Practical Mobile Experiences',
        'intro_text'    => "At Lwegatech, we build purpose driven mobile experiences for startups, SMEs, and enterprises ready to scale. Whether you need a custom native app for iOS/Android or a hybrid solution that integrates with your existing systems, our team delivers. We combine human creativity with AI intelligence to create seamless, practical experiences on any device. The result? Apps that don't just work—they work for your business.",
        'highlights'    => array(
            array('icon' => 'fa-solid fa-mobile-screen', 'title' => 'Multi-platform expertise', 'text' => 'Native and hybrid apps tailored for all devices.'),
            array('icon' => 'fa-solid fa-code-merge', 'title' => 'Seamless system integration', 'text' => 'We connect your app to existing operations effortlessly.'),
            array('icon' => 'fa-solid fa-chart-line', 'title' => 'Cost-effective, results-driven', 'text' => 'Focusing on high ROI without compromising quality.'),
        ),
        'kpis'          => array(
            array('value' => 'iOS/Android', 'label' => 'Supported Platforms'),
            array('value' => 'Scalable', 'label' => 'Future-ready technology'),
            array('value' => 'Practical', 'label' => 'Driven by user success'),
        ),
        'steps'         => array(
            array('title' => 'Strategy & UX', 'text' => 'Mapping the user journey for maximum engagement.'),
            array('title' => 'Agile Development', 'text' => 'Building core features with regular transparent updates.'),
            array('title' => 'Testing & Launch', 'text' => 'Rigorous QA to ensure a flawless app store release.'),
            array('title' => 'Support', 'text' => 'Continuous updates and monitoring post-launch.'),
        ),
        'deliverables'  => array(
            'Custom Native or Hybrid Mobile App',
            'Secure API Integrations',
            'Intuitive User Interface Design',
            'Ongoing Maintenance & Support',
        ),
        'faqs'          => array(
            array('q' => 'Do you build native or hybrid apps?', 'a' => 'We specialize in both native (iOS/Android) and hybrid frameworks like React Native to map the right technology to your specific budget and timeline.'),
            array('q' => 'How long does app development take?', 'a' => 'A standard MVP can be launched within 3-4 months, while highly complex enterprise applications may require 6+ months for complete architectural deployment.'),
            array('q' => 'Do you provide app store deployment?', 'a' => 'Yes, our team handles all Apple App Store and Google Play Store regulations, submissions, and approvals autonomously so you can focus on launch marketing.'),
            array('q' => 'Do I own the source code?', 'a' => 'Absolutely. Upon project completion and final payment, the complete intellectual property and source code are handed over to you.'),
            array('q' => 'Will you maintain the app after launch?', 'a' => 'Yes. We offer continuous SLA maintenance packages to handle bugs, OS updates, and new feature integrations effectively post-launch.'),
            array('q' => 'Do you design the UI/UX yourselves?', 'a' => 'Yes, our in-house design team collaborates deeply with you before any code is written to ensure an engaging wireframe prototype.'),
            array('q' => 'What if my app needs to integrate with our internal API?', 'a' => 'Our backend engineering team specializes in mapping secure REST and GraphQL endpoints for seamless data flow from legacy internal systems.'),
            array('q' => 'Is there a limit to the number of revisions during design?', 'a' => 'We operate in highly collaborative Agile sprints, ensuring feedback is constantly integrated without rigid "revision limits" blocking the project.'),
            array('q' => 'Do you perform security testing on the apps?', 'a' => 'Every app undergoes rigorous penetration testing and data encryption validation prior to Store Approval submission.'),
            array('q' => 'Can you help us build a monetized subscription app?', 'a' => 'Certainly. We routinely integrate Stripe, Apple Pay, and Google Play Billing for complex recurring subscription models.'),
        ),
        'cta_title'     => 'Ready to meet your customers on mobile?',
        'cta_text'      => 'Using solid expertise in mobile apps development, our team will help you get the best of mobile technology for your business. Work with us and create your company success.',
        'cta_primary_label' => 'Build My App',
        'cta_primary_url' => 'https://billing.lwegatech.com/get-quote=business-package/13cda37c8f347e8848b66453097cfbf663e14522b81e4cd3',
        'cta_secondary_label' => 'Contact Us',
        'cta_secondary_url' => home_url('/contact-us/'),
        'render_editor' => false,
    )
);

get_footer();
