<?php
/**
 * Template Name: Domain Transfers Page
 * Description: Template for displaying domain transfer information
 */

get_header();
include get_template_directory() . '/inc/menus/menu.php';
?>

<main role="main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
        <section class="kpy-hero hosting-hero <?php echo esc_attr(get_post_type()); ?>-hero">
        <div class="kpy-hero-black-bg"></div>
        <canvas class="kpy-wave-canvas" id="kpyWaveCanvas"></canvas>
        <div class="kpy-grid-lines"></div>
        <div class="kpy-hero-overlay">
            <div class="container">
                <div class="columns is-vcentered">
                    <div class="column is-6">
                        <div class="kpy-hero-badge">
                            <i class="bi bi-star-fill"></i>
                            <?php 
                            $eyebrow = get_post_meta(get_the_ID(), 'hero_eyebrow', true);
                            echo esc_html($eyebrow ?: 'LWEGATECH LIMITED');
                            ?>
                        </div>
                        <h1 class="kpy-hero-title"><?php the_title(); ?></h1>
                        <p class="kpy-hero-subtitle">
                            <?php 
                            if (has_excerpt()) {
                                echo esc_html(wp_trim_words(get_the_excerpt(), 20, '...'));
                            } else {
                                echo esc_html(wp_trim_words(get_the_content(), 20, '...'));
                            }
                            ?>
                        </p>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <!-- FAQs Section -->
    <section class="faqs-section">
        <div class="container">
           <div class="kpy-sg-header">
            <div class="kpy-sg-title-container">
                <div class="kpy-sg-title-bg" aria-hidden="true">
                    Transfer Domain FAQs
                </div>

                <!-- MAIN TITLE -->
                <h2 class="kpy-sg-title">
                    <span class="kpy-sg-title-red">Frequently </span>
                    <span class="kpy-sg-title-white">Asked Questions</span>
                </h2>
            </div>
            
            <div class="faqs-grid">
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>What is domain transfer and why should I transfer?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Domain transfer is the process of moving your domain name registration from one registrar to another. Transferring to Lwegatech gives you access to better pricing, enhanced security features, free SSL certificates, 24/7 expert support, and seamless integration with our hosting services.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>How long does a domain transfer take?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Domain transfers typically take 5-7 days to complete. The process involves verification steps and waiting periods required by ICANN regulations. However, you can speed up the process by approving the transfer request through your current registrar's email confirmation.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>Will my website experience downtime during transfer?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>No, your website will not experience any downtime during the domain transfer process. Your domain will continue to function normally with your current hosting provider until the transfer is complete. We ensure a seamless transition with zero disruption to your website visitors.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>What do I need to transfer my domain?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>To transfer your domain, you'll need: 1) An authorization code (EPP code) from your current registrar, 2) Your domain must be unlocked for transfer, 3) Your domain must be at least 60 days old, and 4) Your domain should not be within 15 days of expiration. Our support team will guide you through each step.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>Is there a fee for domain transfer?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, domain transfers typically include a one-year registration renewal fee. Many TLDs include free transfer with hosting purchase. Check our current promotions - we often offer free domain transfers when you sign up for any hosting plan.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>What domain extensions can I transfer?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>We support transfer for most major domain extensions including .com, .net, .org, .info, .biz, .co.ug, .ug, .ac.ug, and many more. If you have a specific TLD, please contact our support team to verify transfer availability.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>Can I transfer an expired domain?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Domains that have expired may still be transferable depending on the grace period offered by your current registrar. Typically, domains can be transferred within 30-45 days after expiration. After that, the domain may be released and you'll need to register it again.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>What happens to my email and DNS settings?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Your DNS settings and email configurations remain unchanged during the transfer process. You have the option to keep your existing DNS settings or update them to use Lwegatech's nameservers. We recommend keeping your current settings until the transfer is complete.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>Can I transfer multiple domains at once?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, you can transfer multiple domains in a single transaction. Our bulk transfer tool allows you to process multiple domain transfers simultaneously. Each domain requires its own authorization code, and you can track the status of all transfers from your dashboard.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>What happens to the remaining time on my domain?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>When you transfer a domain, you typically get an additional year added to your registration period. The remaining time from your current registrar is not lost - it's combined with the new registration period, giving you extended domain ownership at no extra cost.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>

<script>
// FAQ Accordion Functionality
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', () => {
            item.classList.toggle('active');
        });
    });
});
</script>