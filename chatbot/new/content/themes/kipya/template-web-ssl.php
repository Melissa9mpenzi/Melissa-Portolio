<?php
/**
 * Template Name: Web - SSL
 *
 * @package Kipya
 */

get_header();
include get_template_directory() . '/inc/menus/menu.php';

if (function_exists('kipya_render_service_template')) {
    kipya_render_service_template(array(
        'family'        => 'web',
        'eyebrow'       => 'Security by LWEGATECH',
        'hero_title'    => 'SSL Certificates',
        'hero_subtitle' => 'Protect your website, build trust and protect your brand with affordable Certificates from Top Cybersecurity Brands.',
        'gif_url'       => 'https://media.giphy.com/media/3oKIPp6e23P4QeFw1G/giphy.gif',
        'intro_title'   => 'Domain Validated (DV) Certificates',
        'intro_text'    => "An easy and affordable way to protect your site.\n\nDomain Validated (DV) certificates are a fast and simple way to secure your website with industry-standard up to 256-bit encryption. The process of obtaining one of these SSL certificates couldn't be easier and is usually handled with just a standard email. A file-based authentication method can also be used and is recommended if you have direct access to the server that hosts your domain name.\n\nIn order to receive a DV certificate from one of our trusted Certification Authorities (CAs), all you have to do is prove that you own the domain that you wish to protect. Since no extensive validation process is required, DV certificates are the most affordable type of SSL on the planet.\n\nEvery SSL Certificate plan includes: Up to 256-bit encryption, HTTPS browser trust indicator, Browser secure padlock icon, A site seal from the respective CA, Better Google Rankings, Devices Trust Levels.",
        'packages'      => array(
            array(
                'title'    => 'Domain Validation (DV)',
                'price'    => format_currency(150000) . ' / yr',
                'desc'     => 'An ideal solution for a very light ecommerce site or a perfect way to safely secure your www. & domain.com',
                'features' => array(
                    'Up to 256-bit encryption, industry standard SSL',
                    'The lowest cost install SSL certificate',
                    '99% browser recognition rate, no chained installation',
                    'Unlimited server licenses',
                    'Automated online validation - no paperwork',
                    'Immediate SSL certificate issuance 24/7/365',
                    'Secures both www. & yourdomain.com',
                    'Optional - Installation Support Available!'
                ),
                'order_base_url' => 'https://billing.lwegatech.com/order2/ssl-certificate/domain-validation-dv-=',
                'cta_label' => 'Get Started',
            ),
            array(
                'title'    => 'Wildcard (DV)',
                'price'    => format_currency(850000) . ' / yr',
                'desc'     => 'Secure one main domain and unlimited amount of subdomains with a single SSL certificate that is www, domain.com & mail.domain.com',
                'features' => array(
                    'Multiple subdomains on a Single Domain Name',
                    '2048 bit signatures and Up to 256-bit',
                    'The lowest cost install SSL certificate',
                    'Trusted by all popular browsers',
                    'Automated online validation - no paperwork',
                    'Immediate SSL certificate issuance 24/7/365',
                    'Free Unlimited Server Licenses',
                    'Optional - Installation Support Available!'
                ),
                'order_base_url' => 'https://billing.lwegatech.com/order2/ssl-certificate/wildcard-dv-=',
                'cta_label' => 'Get Started',
            )
        ),
        'faqs'          => array(
            array('q' => 'What is the difference between a Standard and Wildcard DV?', 'a' => 'A Standard DV (Domain Validated) secures a single exact URL (e.g., example.com). A Wildcard secures your primary domain and theoretically infinite subdomains (e.g., blog.example.com).'),
            array('q' => 'How long does automated deployment take?', 'a' => 'Because Domain Validation utilizes robotic DNS tracking instead of human corporate verification, issuance is typically completed globally within 10 minutes.'),
            array('q' => 'Will SSL improve my Google search results?', 'a' => 'Absolutely. Google officially utilizes HTTPS indexing as a core ranking signal. Sites without SSL are severely suppressed in global search algorithms.'),
            array('q' => 'What does "Up to 256-bit encryption" mean?', 'a' => 'It indicates astronomical cryptographic strength. 256-bit keys are virtually impossible to crack using current computing power, ensuring safe data transit.'),
            array('q' => 'Do I need technical skills to install it?', 'a' => 'No. While generating CSRs and installing the certificate on a server requires skill, our team provides "Optional Installation Support" to handle this completely.'),
            array('q' => 'What happens when my certificate expires?', 'a' => 'If it expires, browsers will display a stark "Not Secure" warning to all your users. Our plans include proactive renewal notifications ahead of time.'),
            array('q' => 'Will my SSL certificate secure my emails as well?', 'a' => 'It can. If your mail server is configured using the secured domain (e.g., secure.domain.com), transit encryption guarantees safe SMTP/IMAP pathways.'),
            array('q' => 'Is there paperwork involved during validation?', 'a' => 'None whatsoever. Standard DV and Wildcard DV certificates utilize completely automated DNS or Email-based ownership verification protocols.'),
            array('q' => 'Does it protect against hackers altering my site?', 'a' => 'SSL specifically encrypts data in-transit between a browser and server; it does not stop server hacking. For complete codebase protection, request a Web Maintenance plan.'),
            array('q' => 'How does the Site Seal work?', 'a' => 'A dynamic Site Seal graphic is provided to be placed onto your footer, visually reassuring visitors that the connection utilizes a verified top-tier Authority.'),
        ),
        'deliverables'  => array(
            'Full Installation & Configuration on your Server',
            'Forced HTTPS Redirect Architecture',
            'Better Google Rankings & SEO',
            'High Devices Trust Levels',
        ),
        'cta_title'     => 'Ready to secure your website?',
        'cta_text'      => 'Get started with an industry standard SSL certificate and protect your customers.',
        'cta_primary_label' => 'Get SSL Now',
        'cta_primary_url'   => 'https://billing.lwegatech.com/get-quote=business-package/13cda37c8f347e8848b66453097cfbf663e14522b81e4cd3',
        'cta_secondary_label' => 'Contact Us',
        'cta_secondary_url' => home_url('/contact-us/'),
    ));
}

get_footer();