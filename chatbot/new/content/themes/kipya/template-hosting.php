<?php
/**
 * Template Name: Web Hosting Page
 * Description: Template for displaying web hosting plans and pricing with dynamic currency
 */

get_header();
include get_template_directory() . '/inc/menus/menu.php';
?>

<main role="main">
   <!-- ===================== HERO SECTION ===================== -->
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

    <!-- Pricing Section -->
    <section class="pricing-section">
        <div class="container">
            <div class="kpy-sg-header">
                <div class="kpy-sg-title-container">
                    <div class="kpy-sg-title-bg" aria-hidden="true">
                        Real Uptime Experience
                    </div>
                    <h2 class="kpy-sg-title">
                        <span class="kpy-sg-title-red">Our</span>
                        <span class="kpy-sg-title-white">Packages</span>
                    </h2>
                </div>
            </div>
            
            <div class="pricing-grid">
                <!-- BRONZE Plan -->
                <div class="pricing-card bronze">
                    <div class="pricing-badge">BRONZE</div>
                    <div class="pricing-type">Web Hosting</div>
                    <div class="pricing-note">The cost is Exclusive of Taxes.</div>
                    <div class="pricing-price">
                        <?php echo format_currency(28000); ?><span>/mo</span>
                    </div>
                    <ul class="pricing-features">
                        <li><i class="bi bi-hdd-stack"></i> 4,000MB Disk Space</li>
                        <li><i class="bi bi-wifi"></i> 30,000MB Bandwidth</li>
                        <li><i class="bi bi-sliders2"></i> Control Panel</li>
                        <li><i class="bi bi-envelope"></i> 40 Email Accounts</li>
                        <li><i class="bi bi-database"></i> 50 Databases</li>
                        <li><i class="bi bi-plus-circle"></i> 3 Add Domains</li>
                        <li><i class="bi bi-headset"></i> Free Priority Support</li>
                    </ul>
                    <a href="#" class="pricing-btn">Get Started</a>
                </div>

                <!-- SILVER Plan -->
                <div class="pricing-card silver">
                    <div class="pricing-badge">SILVER</div>
                    <div class="pricing-type">Web Hosting</div>
                    <div class="pricing-note">The cost is Exclusive of Taxes.</div>
                    <div class="pricing-price">
                        <?php echo format_currency(58000); ?><span>/mo</span>
                    </div>
                    <ul class="pricing-features">
                        <li><i class="bi bi-hdd-stack"></i> 18,000MB Disk Space</li>
                        <li><i class="bi bi-wifi"></i> 100,000MB Bandwidth</li>
                        <li><i class="bi bi-sliders2"></i> Control Panel</li>
                        <li><i class="bi bi-envelope"></i> 300 Email Accounts</li>
                        <li><i class="bi bi-database"></i> 200 Databases</li>
                        <li><i class="bi bi-plus-circle"></i> 5 Add Domains</li>
                        <li><i class="bi bi-headset"></i> Free Priority Support</li>
                    </ul>
                    <a href="#" class="pricing-btn">Get Started</a>
                </div>

                <!-- GOLD Plan -->
                <div class="pricing-card gold featured">
                    <div class="popular-tag">MOST POPULAR</div>
                    <div class="pricing-badge">GOLD</div>
                    <div class="pricing-type">Web Hosting</div>
                    <div class="pricing-note">The cost is Exclusive of Taxes.</div>
                    <div class="pricing-price">
                        <?php echo format_currency(88000); ?><span>/mo</span>
                    </div>
                    <ul class="pricing-features">
                        <li><i class="bi bi-hdd-stack"></i> 50,000MB Disk Space</li>
                        <li><i class="bi bi-wifi"></i> 120,000MB Bandwidth</li>
                        <li><i class="bi bi-sliders2"></i> Control Panel</li>
                        <li><i class="bi bi-envelope"></i> Unlimited Email Accounts</li>
                        <li><i class="bi bi-database"></i> Unlimited Databases</li>
                        <li><i class="bi bi-headset"></i> Free Priority Support</li>
                        <li><i class="bi bi-gift"></i> 10 addon domains</li>
                    </ul>
                    <a href="#" class="pricing-btn">Get Started</a>
                </div>

                <!-- PLATINUM Plan -->
                <div class="pricing-card platinum">
                    <div class="pricing-badge">PLATINUM</div>
                    <div class="pricing-type">Web Hosting</div>
                    <div class="pricing-note">The cost is Exclusive of Taxes.</div>
                    <div class="pricing-price">
                        <?php echo format_currency(155000); ?><span>/mo</span>
                    </div>
                    <ul class="pricing-features">
                        <li><i class="bi bi-hdd-stack"></i> 80,000MB Disk Space</li>
                        <li><i class="bi bi-wifi"></i> 250,000MB Bandwidth</li>
                        <li><i class="bi bi-sliders2"></i> Control Panel</li>
                        <li><i class="bi bi-envelope"></i> Unlimited Email Accounts</li>
                        <li><i class="bi bi-database"></i> Unlimited Databases</li>
                        <li><i class="bi bi-headset"></i> Free Priority Support</li>
                        <li><i class="bi bi-gift"></i> 2 Free domain names (.com, .org, .net)</li>
                        <li><i class="bi bi-gift"></i> 20 addon domains</li>
                    </ul>
                    <a href="#" class="pricing-btn">Get Started</a>
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
                        Web Hosting FAQs
                    </div>
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
                        <span>What is web hosting and why do I need it?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Web hosting is a service that allows you to publish your website on the internet. It provides the server space and technologies needed to make your website accessible to visitors worldwide. Without web hosting, your website cannot be viewed online.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>What is the difference between shared hosting and VPS hosting?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Shared hosting means your website shares server resources with other websites, making it more affordable for small to medium sites. VPS (Virtual Private Server) hosting gives you dedicated resources and more control, ideal for growing businesses that need better performance and security.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>Can I upgrade my hosting plan later?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, absolutely! You can upgrade your hosting plan at any time as your business grows. Our team will help you migrate seamlessly with zero downtime, ensuring your website remains accessible throughout the upgrade process.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>Do you offer a money-back guarantee?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, we offer a 30-day money-back guarantee on all our hosting plans. If you're not completely satisfied with our service within the first 30 days, we'll refund your payment in full, no questions asked.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>What kind of support do you provide?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>We provide 24/7/365 technical support via email, live chat, and phone. Our expert support team is always ready to help you with any issues, from basic setup to advanced server configurations.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>Is SSL certificate included in the hosting plans?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, all our hosting plans come with free SSL certificates. This ensures your website is secure and encrypted, building trust with your visitors and improving your search engine rankings.</p>
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

 (function() {
        var canvas = document.getElementById('kpyWaveCanvas');
        if (!canvas) return;
        var ctx = canvas.getContext('2d');

        function resize() {
            canvas.width = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;
        }
        resize();
        window.addEventListener('resize', resize);

        var RIBBONS = 9;
        var WAVES = 3;
        var t = 0;
        var ribbons = [];

        for (var r = 0; r < RIBBONS; r++) {
            var isGhost = r >= 6;
            ribbons.push({
                yBase: 0.08 + (r / (RIBBONS - 1)) * 0.84,
                amp: isGhost ? (0.03 + Math.random() * 0.05) : (0.07 + Math.random() * 0.13),
                freq: 0.5 + Math.random() * 1.0,
                speed: 0.003 + Math.random() * 0.007,
                phase: Math.random() * Math.PI * 2,
                thickness: isGhost ? (0.4 + Math.random() * 0.8) : (0.8 + Math.random() * 3.0),
                opacity: isGhost ? (0.06 + Math.random() * 0.10) : (0.15 + Math.random() * 0.35),
                lum: isGhost ? 30 : (35 + Math.floor(Math.random() * 25)),
                sat: 85 + Math.floor(Math.random() * 15)
            });
        }

        function drawRibbon(rb, t) {
            var W = canvas.width;
            var H = canvas.height;
            ctx.beginPath();
            var steps = 250;
            for (var i = 0; i <= steps; i++) {
                var xRatio = i / steps;
                var x = xRatio * W;
                var y = rb.yBase * H;
                for (var w = 0; w < WAVES; w++) {
                    var wFreq = rb.freq * (w + 1) * 0.55;
                    var wAmp = rb.amp * H / (w + 1);
                    var wSpeed = rb.speed * (w % 2 === 0 ? 1 : -0.65);
                    y += Math.sin(xRatio * wFreq * Math.PI * 2 + t * wSpeed * 60 + rb.phase + w * 1.4) * wAmp;
                }
                if (i === 0) ctx.moveTo(x, y);
                else ctx.lineTo(x, y);
            }
            var grad = ctx.createLinearGradient(0, 0, W, 0);
            grad.addColorStop(0, 'hsla(0,' + rb.sat + '%,' + rb.lum + '%,0)');
            grad.addColorStop(0.12, 'hsla(0,' + rb.sat + '%,' + rb.lum + '%,' + (rb.opacity * 0.5) + ')');
            grad.addColorStop(0.45, 'hsla(0,' + rb.sat + '%,' + (rb.lum + 18) + '%,' + rb.opacity + ')');
            grad.addColorStop(0.72, 'hsla(0,' + rb.sat + '%,' + (rb.lum + 22) + '%,' + (rb.opacity * 1.15) + ')');
            grad.addColorStop(0.88, 'hsla(0,' + rb.sat + '%,' + rb.lum + '%,' + (rb.opacity * 0.6) + ')');
            grad.addColorStop(1, 'hsla(0,' + rb.sat + '%,' + rb.lum + '%,0)');
            ctx.strokeStyle = grad;
            ctx.lineWidth = rb.thickness;
            ctx.shadowColor = 'rgba(200, 0, 12, 0.55)';
            ctx.shadowBlur = rb.thickness > 1.5 ? 22 : 8;
            ctx.stroke();
            ctx.shadowBlur = 0;
        }

        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            t += 0.016;
            for (var i = 0; i < ribbons.length; i++) {
                drawRibbon(ribbons[i], t);
            }
            requestAnimationFrame(draw);
        }
        draw();
    })();
</script>