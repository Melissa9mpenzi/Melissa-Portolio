<?php
/**
 * Template Name: Web - Web Maintenance
 *
 * @package Kipya
 */

get_header();
include get_template_directory() . '/inc/menus/menu.php';

if (function_exists('kipya_render_service_template')) {
    kipya_render_service_template(array(
        'family'          => 'web',
        'eyebrow'         => 'Care by LWEGATECH',
        'hero_title'      => 'Website Maintenance',
        'hero_subtitle'   => 'Reliable, affordable, and ongoing website maintenance so you can focus on growing your business.',
        'intro_gif'       => 'https://media.giphy.com/media/f3iwJFOVOwuy7K6FFw/giphy.gif',
        'intro_title'     => 'Never Worry About Upkeep Again',
        'intro_text'      => "Do you have a website but struggle to keep it updated, secure, or performing well? Many business owners find it hard to balance content updates, plugin issues, and design changes while managing daily operations. We handle updates, security, performance, and backups — so you can focus on growth while we keep your website safe.",
        'packages_bg_text'=> 'Web Maintenance',
        'packages_sub'    => 'Whether you need simple monthly care or full-time professional support, our flexible packages are built to grow with your business.',
        'highlights'      => array(
            array('title' => '24/7 Security Monitoring', 'text' => 'Proactive protection against malware, exploits, and brute-force attacks.',       'icon' => 'fa-solid fa-shield-halved'),
            array('title' => 'Routine Backups',          'text' => 'Automated off-site backups ensure your data is never permanently lost.',           'icon' => 'fa-solid fa-cloud-arrow-up'),
            array('title' => 'Performance Tweaks',       'text' => 'Continuous optimisation to keep load speeds incredibly fast for all users.',       'icon' => 'fa-solid fa-bolt'),
        ),

        'packages' => array(

            // ── 01  WEB CARE ───────────────────────────────────────────────
            array(
                'tier'         => 'web-care',
                'title'        => 'WEB Care',
                'type'         => 'Web Maintenance',
                'note_top'     => 'The cost is Exclusive of Taxes.',
                'price'        => '100,000 UGX',
                'price_period' => '/mo',
                'delivery'     => '48–72 hr turnaround on minor tasks',
                'desc'         => 'Organisations needing basic monthly care and regular site upkeep.',
                'features'     => array(
                    'Up to 5 content updates per month',
                    'Monthly CMS & plugin update',
                    'Basic security check & malware scan',
                    'Backup once every month',
                    'Minor text or image corrections',
                    '48–72 hour turnaround time for minor tasks',
                    'Website performance & update annual report',
                ),
                'cta_label'    => 'Get Started',
                'order_base_url' => 'https://billing.lwegatech.com/order2/website-maintenance/web-care=',
                'featured'     => false,
            ),

            // ── 02  WEB PLUS ───────────────────────────────────────────────
            array(
                'tier'         => 'web-plus',
                'title'        => 'WEB Plus',
                'type'         => 'Web Maintenance',
                'note_top'     => 'The cost is Exclusive of Taxes.',
                'price'        => '350,000 UGX',
                'price_period' => '/mo',
                'delivery'     => 'Same-day emergency uploads',
                'desc'         => 'Active organisations needing frequent updates and emergency support.',
                'features'     => array(
                    'Weekly content updates',
                    'Emergency uploads (within same day)',
                    'CMS & plugin updates',
                    'Security scans and protection',
                    'Broken link fixes & error troubleshooting',
                    'Image optimisation',
                    'Video and gallery updates',
                    'Website performance & update monthly report',
                ),
                'cta_label'    => 'Get Started',
                'order_base_url' => 'https://billing.lwegatech.com/order2/website-maintenance/web-plus=',
                'featured'     => true,
            ),

            // ── 03  WEB QUARTER ────────────────────────────────────────────
            array(
                'tier'         => 'web-quarter',
                'title'        => 'WEB Quarter',
                'type'         => 'Web Maintenance',
                'note_top'     => 'The cost is Exclusive of Taxes.',
                'price'        => '450,000 UGX',
                'price_period' => '/qtr',
                'delivery'     => 'Quarterly professional oversight',
                'desc'         => 'Organisations with occasional updates but wanting professional oversight.',
                'features'     => array(
                    'Up to 35 content updates per quarter',
                    'CMS & plugin updates',
                    'Security scans and protection',
                    'Troubleshooting & restoration of site functionality',
                    'Regular site backups',
                    'SEO best-practice implementation',
                    'Social media updates on request',
                    'Backups & quarterly report',
                ),
                'cta_label'    => 'Get Started',
                'order_base_url' => 'https://billing.lwegatech.com/order2/website-maintenance/web-quarter=',
                'featured'     => false,
            ),
        ),

        'faqs' => array(
            array('q' => 'What happens if my site breaks after an update?',           'a' => 'Our team performs exhaustive sandboxed visual checks post-update. If a failure happens, we immediately roll back to the automated backup.'),
            array('q' => 'Does maintenance cover new content additions?',             'a' => 'Depending on the tier (e.g., WEB Plus), minor content changes and emergency uploads are fully bundled into your monthly care hours.'),
            array('q' => 'How do I know my site is actually being monitored?',        'a' => 'You will receive detailed, transparent reports covering uptime metrics, stopped attacks, and updated plugins.'),
            array('q' => 'Am I locked into a long-term contract?',                   'a' => 'No. We believe in earning your business constantly. Our WEB Care plan operates on a flexible month-to-month commitment.'),
            array('q' => 'What happens if I exceed my content update limit?',        'a' => 'We will alert you and provide affordable hourly options for the remainder of the billing period.'),
            array('q' => 'Can you maintain a site you didn\'t originally build?',    'a' => 'Yes. We first perform a comprehensive technical audit of the codebase, then seamlessly assume maintenance responsibilities.'),
            array('q' => 'How quickly are emergency uploads processed on WEB Plus?', 'a' => 'WEB Plus guarantees same-day processing for critical emergency uploads or urgent news integrations.'),
            array('q' => 'Is malware removal included in the plans?',                'a' => 'Our security scans proactively prevent malware. If your site is already infected before joining, we will quote a flat-fee removal.'),
            array('q' => 'Do you optimise images for us?',                           'a' => 'Yes, WEB Plus and WEB Quarter both include ongoing image optimisation protocols to keep server latency low.'),
            array('q' => 'Are backups stored safely off-site?',                      'a' => 'Yes. Backups are deployed to secure, redundant offshore AWS / Google Cloud containers — never kept locally on your host.'),
        ),

        'deliverables' => array(
            'Daily or Monthly Off-site Backups',
            'Full Malware & Hacker Protection',
            'Routine Theme & Plugin Updates',
            'Broken Link Fixes & Error Troubleshooting',
            'Flexible Packages (Monthly / Quarterly)',
        ),

        'why_choose_us' => array(
            array('title' => 'Proactive Monitoring', 'icon' => 'bi bi-activity',        'text' => '24/7 uptime monitoring with instant alerts so your website is always online and accessible.'),
            array('title' => 'Expert Technicians',   'icon' => 'bi bi-person-gear',     'text' => 'Dedicated experts who know your site inside out, ready to resolve any issue fast.'),
            array('title' => 'Transparent Reports',  'icon' => 'bi bi-bar-chart-line',  'text' => 'Detailed monthly reports keeping you fully informed about your website\'s health and changes.'),
            array('title' => 'Fast Turnaround',      'icon' => 'bi bi-lightning-charge','text' => 'Quick response times ensuring updates and emergency fixes are handled without unnecessary delay.'),
            array('title' => 'Secure Backups',       'icon' => 'bi bi-shield-check',    'text' => 'Automated off-site backups to AWS/Google Cloud so your data is always protected and recoverable.'),
            array('title' => 'Flexible Plans',       'icon' => 'bi bi-sliders',         'text' => 'Month-to-month and quarterly plans designed to grow with your business needs and budget.'),
        ),

        'cta_title'           => 'Let\'s Keep Your Website Running — Effortlessly.',
        'cta_text'            => 'Stop worrying about updates, downtime, and technical errors. Join dozens of businesses already trusting Lwegatech.',
        'cta_primary_label'   => 'Choose a Plan',
        'cta_primary_url'     => 'https://billing.lwegatech.com/get-quote=business-package/13cda37c8f347e8848b66453097cfbf663e14522b81e4cd3',
        'cta_secondary_label' => 'Contact Us',
        'cta_secondary_url'   => home_url('/contact-us/'),
    ));
}

get_footer();
?>