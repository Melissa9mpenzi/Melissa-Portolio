<?php
/**
 * Template Name: Secure Backups Page
 * Description: Template for displaying secure backup information
 */

get_header();
include get_template_directory() . '/inc/menus/menu.php';
?>

<main role="main">
    <section class="hero-section hosting-hero">
        <!-- Solid black background -->
        <div class="hero-black-background"></div>

        <!-- SVG Background Layer with animated networks -->
        <div class="svg-background">
            <div class="svg-container">
                <svg class="network-svg network-1" viewBox="0 0 300 300">
                    <path d="M50 150 L120 80 L200 120 L250 180 L180 250 L80 220 L50 150" stroke="currentColor" fill="none" stroke-dasharray="4 6"/>
                    <path d="M120 80 L200 120 M200 120 L250 180 M180 250 L80 220 M80 220 L50 150" stroke="currentColor" fill="none" stroke-width="1"/>
                    <circle cx="50" cy="150" r="6" stroke="currentColor" fill="none"/>
                    <circle cx="120" cy="80" r="6" stroke="currentColor" fill="none"/>
                    <circle cx="200" cy="120" r="6" stroke="currentColor" fill="none"/>
                    <circle cx="250" cy="180" r="6" stroke="currentColor" fill="none"/>
                    <circle cx="180" cy="250" r="6" stroke="currentColor" fill="none"/>
                    <circle cx="80" cy="220" r="6" stroke="currentColor" fill="none"/>
                    <path d="M120 80 L80 220 M200 120 L180 250 M250 180 L50 150" stroke="currentColor" fill="none" stroke-dasharray="3 8" opacity="0.6"/>
                </svg>
                <svg class="network-svg network-2" viewBox="0 0 300 300">
                    <path d="M150 30 L240 90 L240 210 L150 270 L60 210 L60 90 L150 30" stroke="currentColor" fill="none" stroke-dasharray="5 5"/>
                    <path d="M150 30 L150 270 M60 90 L240 210 M60 210 L240 90" stroke="currentColor" fill="none" opacity="0.5"/>
                    <circle cx="150" cy="30" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="240" cy="90" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="240" cy="210" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="150" cy="270" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="60" cy="210" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="60" cy="90" r="5" stroke="currentColor" fill="none"/>
                </svg>
                <svg class="network-svg network-3" viewBox="0 0 300 300">
                    <path d="M50 50 L250 50 M50 120 L250 120 M50 190 L250 190 M50 260 L250 260" stroke="currentColor" fill="none" opacity="0.4"/>
                    <path d="M50 50 L50 260 M120 50 L120 260 M190 50 L190 260 M260 50 L260 260" stroke="currentColor" fill="none" opacity="0.4"/>
                    <circle cx="50" cy="50" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="120" cy="50" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="190" cy="50" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="260" cy="50" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="50" cy="120" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="120" cy="120" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="190" cy="120" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="260" cy="120" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="50" cy="190" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="120" cy="190" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="190" cy="190" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="260" cy="190" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="50" cy="260" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="120" cy="260" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="190" cy="260" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="260" cy="260" r="4" stroke="currentColor" fill="none"/>
                    <path d="M50 50 L260 260 M260 50 L50 260" stroke="currentColor" fill="none" stroke-dasharray="6 6" opacity="0.3"/>
                </svg>
                <svg class="network-svg network-4" viewBox="0 0 300 300">
                    <circle cx="150" cy="150" r="50" stroke="currentColor" fill="none" stroke-dasharray="4 8"/>
                    <circle cx="150" cy="150" r="100" stroke="currentColor" fill="none" stroke-dasharray="4 6"/>
                    <path d="M150 30 L150 270 M30 150 L270 150 M70 70 L230 230 M230 70 L70 230" stroke="currentColor" fill="none" opacity="0.5"/>
                    <circle cx="150" cy="150" r="8" stroke="currentColor" fill="none"/>
                    <circle cx="150" cy="50" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="150" cy="250" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="50" cy="150" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="250" cy="150" r="4" stroke="currentColor" fill="none"/>
                </svg>
                <svg class="network-svg network-5" viewBox="0 0 300 300">
                    <circle cx="150" cy="150" r="40" stroke="currentColor" fill="none" opacity="0.4"/>
                    <circle cx="150" cy="150" r="80" stroke="currentColor" fill="none" opacity="0.4"/>
                    <circle cx="150" cy="150" r="120" stroke="currentColor" fill="none" opacity="0.4"/>
                    <path d="M150 30 L150 270" stroke="currentColor" fill="none" opacity="0.3"/>
                    <path d="M30 150 L270 150" stroke="currentColor" fill="none" opacity="0.3"/>
                    <path d="M70 70 L230 230" stroke="currentColor" fill="none" opacity="0.3"/>
                    <path d="M230 70 L70 230" stroke="currentColor" fill="none" opacity="0.3"/>
                    <circle cx="150" cy="150" r="8" stroke="currentColor" fill="none"/>
                    <circle cx="150" cy="70" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="150" cy="230" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="70" cy="150" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="230" cy="150" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="100" cy="100" r="3" stroke="currentColor" fill="none"/>
                    <circle cx="200" cy="200" r="3" stroke="currentColor" fill="none"/>
                    <circle cx="100" cy="200" r="3" stroke="currentColor" fill="none"/>
                    <circle cx="200" cy="100" r="3" stroke="currentColor" fill="none"/>
                </svg>
            </div>
        </div>

        <div class="connection-lines"></div>
        <div class="grid-lines"></div>

        <!-- Hero Content -->
        <div class="hero-overlay">
            <div class="container">
                <div class="hero-content-wrapper">
                    <?php if (has_post_thumbnail()) : 
                        $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                        $thumbnail_alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
                    ?>
                        <div class="hero-thumbnail">
                            <div class="hero-thumbnail-inner">
                                <img src="<?php echo esc_url($thumbnail_url[0]); ?>" 
                                     alt="<?php echo esc_attr($thumbnail_alt ?: get_the_title()); ?>" 
                                     class="hero-featured-image">
                                <div class="hero-thumbnail-overlay">
                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="hero-text-content">
                        <div class="hero-badge">
                            <i class="bi bi-shield-check-fill"></i> We Offer Secure Backup 
                        </div>
                        <h1 class="kpy-sg-title"><?php the_title(); ?></h1>
                    </div>
                </div>
                
                <!-- Feature Circles - Horizontal line at bottom -->
                <div class="feature-circles-wrapper">
                    <div class="feature-circles">
                        <div class="feature-circle"><i class="bi bi-cloud-check-fill"></i><span>Automated Backups</span></div>
                        <div class="feature-circle"><i class="bi bi-shield-lock-fill"></i><span>Military Grade Encryption</span></div>
                        <div class="feature-circle"><i class="bi bi-database-fill"></i><span>Offsite Storage</span></div>
                        <div class="feature-circle"><i class="bi bi-clock-fill"></i><span>24/7 Monitoring</span></div>
                        <div class="feature-circle"><i class="bi bi-file-earmark-lock-fill"></i><span>Compliant Storage</span></div>
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
                    Secure Backup FAQs
                </div>

                <!-- MAIN TITLE -->
                <h2 class="kpy-sg-title">
                    <span class="kpy-sg-title-red">Frequently </span>
                    <span class="kpy-sg-title-white">Asked Questions</span>
                </h2>
            </div>
        </div>
            
            <div class="faqs-grid">
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>How often are backups performed?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Backup frequency depends on your hosting plan. All our hosting plans include automated daily backups. Premium plans include hourly backups, and our enterprise solutions offer continuous real-time backups to ensure your data is always protected.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>Where is my backup data stored?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Your backup data is stored in secure, redundant offsite data centers with military-grade encryption. We use multiple geographic locations to ensure maximum protection and availability, so your data remains safe even in case of regional incidents.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>How secure is my backup data?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>We use AES-256 encryption for data at rest and SSL/TLS encryption for data in transit. All backups are encrypted with your unique encryption keys, ensuring that only you can access your data. Our infrastructure meets the highest security standards including SOC 2 and ISO 27001 certification.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>How do I restore my data from a backup?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Restoring your data is simple with our one-click restore feature available in all hosting plans. You can select any backup point from your retention history and restore individual files, databases, or your entire website instantly through your control panel.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>How long do you keep backups?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Backup retention varies by hosting plan. Basic plans include 30-day retention, professional plans include 90-day retention, and business plans include 1-year retention. Enterprise clients can customize retention periods to meet their specific compliance requirements.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>Can I backup databases separately?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, all our hosting plans include separate database backups. You can backup MySQL, PostgreSQL, and other database types independently from your files. This allows for granular restore options and better data management.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>Is there a backup testing feature?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, we provide backup testing and verification features. You can test your backups in a sandbox environment to ensure they can be restored successfully before actually needing them in a disaster recovery scenario.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>What happens if I accidentally delete my website?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Don't worry! If you accidentally delete your website or files, you can easily restore from the most recent backup with just one click. Our support team is also available 24/7 to assist you with the restoration process if needed.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
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