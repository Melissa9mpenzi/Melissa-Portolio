<?php
/**
 * Template Name: Apps - Monitoring & Evaluation
 * Template Post Type: page
 *
 * @package Kipya
 */

get_header();
include get_template_directory() . '/inc/menus/menu.php';

kipya_render_service_template(
    array(
        'family'        => 'apps',
        'eyebrow'       => 'M&E Systems by LWEGATECH',
        'hero_title'    => 'Monitoring and Evaluation',
        'hero_subtitle' => 'In today’s data-driven world, effective Monitoring and Evaluation (M&E) systems are essential for accountability.',
        'gif_url'       => 'https://media.giphy.com/media/26n6WvwCRGQjfpos8/giphy.gif',
        'intro_title'   => 'Assess Progress & Drive Change',
        'intro_text'    => 'At LWEGATECH, we specialize in developing custom M&E systems tailored to your specific needs. Our solutions enable you to collect, analyze, and report data efficiently, empowering you to make informed decisions and drive impactful change.',
        'highlights'    => array(
            array('icon' => 'fa-solid fa-chart-pie', 'title' => 'Dashboard Visualization', 'text' => 'Interactive dashboards that present key metrics visually to track progress at a glance.'),
            array('icon' => 'fa-solid fa-file-invoice', 'title' => 'Real-Time Reporting', 'text' => 'Generate insightful reports providing up-to-date information on project performance.'),
            array('icon' => 'fa-solid fa-database', 'title' => 'Integration Capabilities', 'text' => 'Seamless integration with existing systems for a unified approach to data management.'),
        ),
        'kpis'          => array(
            array('value' => 'Secure', 'label' => 'Data Protection'),
            array('value' => 'Real-Time', 'label' => 'Analytics'),
            array('value' => 'Custom', 'label' => 'Indicators'),
        ),
        'steps'         => array(
            array('title' => 'Define Goals', 'text' => 'Customize indicators that align with your specific objectives.'),
            array('title' => 'Collect Data', 'text' => 'Streamline data gathering through user-friendly forms & automated surveys.'),
            array('title' => 'Analyze Performance', 'text' => 'Evaluate program effectiveness and identify areas for improvement.'),
            array('title' => 'Engage Stakeholders', 'text' => 'Collaborate through feedback mechanisms and communication channels.'),
        ),
        'deliverables'  => array(
            'Customizable Indicators Dashboard',
            'Data Collection & Survey Tools',
            'Advanced Performance Analytics',
            'Robust Data Security & Compliance',
        ),
        'faqs'          => array(
            array('q' => 'Can the M&E system integrate with our older databases?', 'a' => 'Absolutely. We build robust APIs capable of bridging modern data visualization systems with your legacy on-premises databases.'),
            array('q' => 'Is our sensitive organizational data secure?', 'a' => 'Security is paramount. We deploy end-to-end encryption protocols and strictly adhere to global compliance data regulations like GDPR.'),
            array('q' => 'Can we customize the dashboard metrics later?', 'a' => 'Yes! The dashboards are built modularly, allowing you to drag, drop, and customize the tracked indicators autonomously post-deployment.'),
            array('q' => 'Do you offer mobile applications for field data collection?', 'a' => 'Yes, our M&E suite natively integrates with offline-capable mobile deployment apps for seamless remote data structuring.'),
            array('q' => 'How are user permissions handled?', 'a' => 'We deploy granular Role-Based Access Control (RBAC), meaning you easily restrict what different analysts, managers, or guests can see.'),
            array('q' => 'Can the system generate automatic PDF reports?', 'a' => 'Certainly. You can configure scheduled automated reports that compile crucial KPIs into polished PDFs delivered straight to stakeholder emails.'),
            array('q' => 'Is training provided for our staff?', 'a' => 'Full administrative and user training sessions are physically or virtually conducted, supported by an exhaustive, custom-written Digital Manual.'),
            array('q' => 'How does the system handle real-time data?', 'a' => 'Through WebSocket protocols and optimized caching, your dashboards instantly pulse update exactly as field data hits the central server.'),
            array('q' => 'What happens if we need completely new metrics built next year?', 'a' => 'Our scalable architecture allows rapid development of new modules. You can simply assign a new sprint under a retainer agreement.'),
            array('q' => 'Can the data be exported to Excel or SPSS?', 'a' => 'Instant robust exporting via CSV, Excel, XML, or specialized formats (SPSS) is hardcoded into every single graphical reporting table.'),
        ),
        'cta_title'     => 'Ready to make data-driven decisions?',
        'cta_text'      => 'Our specialized team is ready to build M&E tools tailored specifically for your organization.',
        'cta_primary_label' => 'Build M&E System',
        'cta_primary_url' => 'https://billing.lwegatech.com/get-quote=business-package/13cda37c8f347e8848b66453097cfbf663e14522b81e4cd3',
        'cta_secondary_label' => 'Contact Us',
        'cta_secondary_url' => home_url('/contact-us/'),
        'render_editor' => false,
    )
);

get_footer();
