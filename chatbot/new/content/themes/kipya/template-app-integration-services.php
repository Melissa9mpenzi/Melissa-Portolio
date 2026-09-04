<?php
/**
 * Template Name: Apps - Integration Services
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
        'hero_title'    => 'Integration Services',
        'hero_subtitle' => 'Connect systems, automate workflows, and remove data silos across your stack.',
        'animation_url' => 'https://assets3.lottiefiles.com/packages/lf20_5tkzkblw.json',
        'gif_url'       => 'https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExd2w1Z2Jva3Q2cTlrb21hcnI4Nm5zN3JkcW1tbjdjNGNzc2kwemxkMCZlcD12MV9naWZzX3NlYXJjaCZjdD1n/KEYMsj2LcXzfcTP5ii/giphy.gif',
        'intro_title'   => 'Your systems should talk to each other',
        'intro_text'    => 'We implement secure integrations between websites, apps, CRMs, payment platforms, and internal systems.',
        'highlights'    => array(
            array('icon' => 'fa-solid fa-link', 'title' => 'API Integrations', 'text' => 'Reliable data exchange between core business systems.'),
            array('icon' => 'fa-solid fa-bolt', 'title' => 'Workflow Automation', 'text' => 'Automate repetitive tasks and approval handovers.'),
            array('icon' => 'fa-solid fa-shield', 'title' => 'Secure Data Movement', 'text' => 'Protected transfers with audit-friendly implementation patterns.'),
        ),
        'kpis'          => array(
            array('value' => 'Connected', 'label' => 'Apps and systems in sync'),
            array('value' => 'Automated', 'label' => 'Less manual repetition'),
            array('value' => 'Secure', 'label' => 'Controlled data exchange'),
        ),
        'steps'         => array(
            array('title' => 'Integration mapping', 'text' => 'We document data points, timing, and ownership.'),
            array('title' => 'Connector design', 'text' => 'Architecture is planned for reliability and future growth.'),
            array('title' => 'Implementation + testing', 'text' => 'Endpoints and events are built and validated.'),
            array('title' => 'Monitoring', 'text' => 'We track reliability and optimize error handling.'),
        ),
        'deliverables'  => array(
            'System-to-system integration workflows',
            'Automated sync and event processes',
            'Monitoring-ready integration health checks',
            'Documentation for long-term maintainability',
        ),
        'cta_title'     => 'Connect your tools and eliminate data silos',
        'cta_text'      => 'Integrate your stack securely so teams work faster with clean synchronized data.',
        'cta_primary_label' => 'Plan Integrations',
        'cta_primary_url' => 'https://billing.lwegatech.com/get-quote=business-package/13cda37c8f347e8848b66453097cfbf663e14522b81e4cd3',
        'cta_secondary_label' => 'Contact Us',
        'cta_secondary_url' => home_url('/contact-us/'),
        'render_editor' => false,
    )
);

get_footer();

