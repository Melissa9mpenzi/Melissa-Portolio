<?php
/**
 * Template Name: Apps - MIS Solutions
 * Template Post Type: page
 *
 * @package Kipya
 */

get_header();
include get_template_directory() . '/inc/menus/menu.php';

kipya_render_service_template(
    array(
        'family'        => 'apps',
        'eyebrow'       => 'Systems by LWEGATECH',
        'hero_title'    => 'MIS Solutions',
        'hero_subtitle' => 'As technology advances, the demand for automating workflows has never been greater.',
        'gif_url'       => 'https://media.giphy.com/media/l41lOlmIQyA6WqkiQ/giphy.gif',
        'intro_title'   => 'Automate Processes, Drive Results',
        'intro_text'    => "At LWEGATECH, our team of experts in software and systems development is uniquely positioned to deliver tailored Management Information Systems that enhance efficiency. From BORApos sales systems to robust HR management, we build the digital backbone your organization needs.",
        'highlights'    => array(
            array('icon' => 'fa-solid fa-users', 'title' => 'HR & Membership MIS', 'text' => 'Manage employee lifecycles, member tracking, appraisals, and onboarding.'),
            array('icon' => 'fa-solid fa-folder-open', 'title' => 'Document Management', 'text' => 'Transform from paper to digital. Store, share, track, and collaborate with just a click.'),
            array('icon' => 'fa-solid fa-tasks', 'title' => 'Workflow & Project MIS', 'text' => 'Monitor work stages, track deadlines, and ensure accountability.'),
        ),
        'kpis'          => array(
            array('value' => 'Automated', 'label' => 'Workflows'),
            array('value' => 'Efficient', 'label' => 'Process Management'),
            array('value' => 'Tailored', 'label' => 'To Your Requirements'),
        ),
        'steps'         => array(
            array('title' => 'System Audit', 'text' => 'Evaluating your current processes and paper-based workflows.'),
            array('title' => 'Solution Design', 'text' => 'Architecting a system to handle HR, Documents, or E-Learning.'),
            array('title' => 'Implementation', 'text' => 'Deploying custom software built for exact workplace needs.'),
            array('title' => 'Training', 'text' => 'Ensuring your team adopts the new automated tools smoothly.'),
        ),
        'deliverables'  => array(
            'Invoicing & Sales Management System',
            'Membership Information System',
            'HR Management Information System',
            'E-Learning & Document Management',
        ),
        'faqs'          => array(
            array('q' => 'Do we need technical staff to maintain the MIS?', 'a' => 'No technical expertise is required. We deploy highly intuitive, user-friendly interfaces backed by a dedicated support SLA for technical administration.'),
            array('q' => 'Can the MIS replace our current paper-heavy workflow?', 'a' => 'Yes, our primary focus is complete digital transformation. We digitize documentation, approval chains, and internal communication perfectly.'),
            array('q' => 'Is the system cloud-hosted or on-site?', 'a' => 'We offer both tailored infrastructure models based entirely on your organization\'s internal security policies and bandwidth capabilities.'),
            array('q' => 'How quickly can an MIS be fully deployed?', 'a' => 'Typically, a robust initial MVP (Minimum Viable Product) replaces core paper processes within 3-4 months, with continuous rollout of advanced modules.'),
            array('q' => 'Can our HR system integrate directly with Payroll?', 'a' => 'Yes, integration with major payroll APIs or automated ledger synchronization is heavily featured in our custom system architectures.'),
            array('q' => 'Does the MIS include an internal ticketing system?', 'a' => 'If requested, we can deploy a heavily customizable internal helpdesk allowing cross-department issue tracking instantly.'),
            array('q' => 'How secure are internal messages and files?', 'a' => 'Intranets and internal hubs utilize banking-grade AES-256 encryption at rest and strictly enforce HTTPS in transit.'),
            array('q' => 'Can we set up a multi-tier approval system?', 'a' => 'Our systems specialize in multi-nodal logic trees. Document approvals can seamlessly ping distinct managers successively before final archival.'),
            array('q' => 'Will employees use an app or a web browser?', 'a' => 'The entire core MIS exists strictly as a responsive web-interface, but we absolutely build accompanying companion native Apps for specific field workers.'),
            array('q' => 'Is there a limit to the number of user accounts?', 'a' => 'Unlike restrictive SaaS platforms, your custom MIS does not aggressively charge per-seat limitations. You manage internal user licensing autonomously.'),
        ),
        'cta_title'     => 'Need a tailored Management Information System?',
        'cta_text'      => 'Let us transform your workplace processes with intuitive custom software.',
        'cta_primary_label' => 'Request System Quote',
        'cta_primary_url' => 'https://billing.lwegatech.com/get-quote=business-package/13cda37c8f347e8848b66453097cfbf663e14522b81e4cd3',
        'cta_secondary_label' => 'Contact Us',
        'cta_secondary_url' => home_url('/contact-us/'),
        'render_editor' => false,
    )
);

get_footer();
