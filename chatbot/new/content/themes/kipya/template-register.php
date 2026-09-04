<?php
/**
 * Template Name: Domain Registration Page
 * Description: Template for displaying domain registration and pricing with automatic currency detection
 */

get_header();

include get_template_directory() . '/inc/menus/menu.php';
?>
<main role="main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
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
    <!-- Domain Extensions Section -->
    <section class="domains-section">
        <div class="container">
            <div class="kpy-sg-header">
                <div class="kpy-sg-title-container">
                    <div class="kpy-sg-title-bg" aria-hidden="true">
                        Domain Extensions
                    </div>
                    <h2 class="kpy-sg-title">
                        <span class="kpy-sg-title-red">Our</span>
                        <span class="kpy-sg-title-white">Best Selection</span>
                    </h2>
                </div>
                <p class="section-description">Choose a domain name that will represent you or that your customers will be proud of! By registering a domain name, you are establishing exclusive ownership of a particular name, meaning nobody else can use it while registered. Domain names can be used for both Web sites and email, allowing your visitors to more easily locate your site.</p>
            </div>
            
            <div class="domains-grid">
                <div class="domain-card">
                    <div class="domain-icon"><i class="bi bi-globe2"></i></div>
                    <div class="domain-extension">.com</div>
                    <div class="domain-description">Most popular top-level domain extension for businesses</div>
                    <div class="domain-price"><?php echo format_currency(95000); ?><span>/yr</span></div>
                </div>
                
                <div class="domain-card">
                    <div class="domain-icon"><i class="bi bi-building"></i></div>
                    <div class="domain-extension">.org</div>
                    <div class="domain-description">Used by non-profit, educational, and public-interest organizations.</div>
                    <div class="domain-price"><?php echo format_currency(95000); ?><span>/yr</span></div>
                </div>
                
                <div class="domain-card">
                    <div class="domain-icon"><i class="bi bi-wifi"></i></div>
                    <div class="domain-extension">.net</div>
                    <div class="domain-description">Widely used for technology-related ventures and networks</div>
                    <div class="domain-price"><?php echo format_currency(95000); ?><span>/yr</span></div>
                </div>
                
                <div class="domain-card">
                    <div class="domain-icon"><i class="bi bi-briefcase"></i></div>
                    <div class="domain-extension">.biz</div>
                    <div class="domain-description">For commercial, business-oriented websites and online ventures.</div>
                    <div class="domain-price"><?php echo format_currency(95000); ?><span>/yr</span></div>
                </div>
                
                <div class="domain-card">
                    <div class="domain-icon"><i class="bi bi-info-circle"></i></div>
                    <div class="domain-extension">.info</div>
                    <div class="domain-description">informative top-level domain ideal for informational websites.</div>
                    <div class="domain-price"><?php echo format_currency(95000); ?><span>/yr</span></div>
                </div>
                
                <div class="domain-card">
                    <div class="domain-icon"><i class="bi bi-flag"></i></div>
                    <div class="domain-extension">.ug</div>
                    <div class="domain-description">Very short and ideal for businesses established in Uganda.</div>
                    <div class="domain-price"><?php echo format_currency(265000); ?><span>/yr</span></div>
                </div>
                
                <div class="domain-card">
                    <div class="domain-icon"><i class="bi bi-building"></i></div>
                    <div class="domain-extension">.co.ug</div>
                    <div class="domain-description">An alternative on .ug and very good for businesses in Uganda</div>
                    <div class="domain-price"><?php echo format_currency(265000); ?><span>/yr</span></div>
                </div>
                
                <div class="domain-card">
                    <div class="domain-icon"><i class="bi bi-heart"></i></div>
                    <div class="domain-extension">.org.ug</div>
                    <div class="domain-description">Mainly dedicated to non-profit organizations</div>
                    <div class="domain-price"><?php echo format_currency(265000); ?><span>/yr</span></div>
                </div>
                
                <div class="domain-card">
                    <div class="domain-icon"><i class="bi bi-heart-fill"></i></div>
                    <div class="domain-extension">.or.ug</div>
                    <div class="domain-description">For Non-profit organizations in Uganda</div>
                    <div class="domain-price"><?php echo format_currency(95000); ?><span>/yr</span></div>
                </div>
                
                <div class="domain-card">
                    <div class="domain-icon"><i class="bi bi-bank2"></i></div>
                    <div class="domain-extension">.go.ug</div>
                    <div class="domain-description">Best recommended for Uganda government bodies & ministries</div>
                    <div class="domain-price"><?php echo format_currency(425000); ?><span>/yr</span></div>
                </div>
                
                <div class="domain-card">
                    <div class="domain-icon"><i class="bi bi-briefcase"></i></div>
                    <div class="domain-extension">.co</div>
                    <div class="domain-description">Ideal alternative to .com for businesses</div>
                    <div class="domain-price"><?php echo format_currency(160000); ?><span>/yr</span></div>
                </div>
                
                <div class="domain-card">
                    <div class="domain-icon"><i class="bi bi-flag-fill"></i></div>
                    <div class="domain-extension">.us</div>
                    <div class="domain-description">Recommended for US based firms. Go for a .us domain.</div>
                    <div class="domain-price"><?php echo format_currency(160000); ?><span>/yr</span></div>
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
                        Domain Registration 
                    </div>
                    <h2 class="kpy-sg-title">
                        <span class="kpy-sg-title-red">About Domain </span>
                        <span class="kpy-sg-title-white">FAQs</span>
                    </h2>
                </div>
            </div>
            
            <div class="faqs-grid">
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>What is a domain name?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>A domain name is your website's unique address on the internet (like yourbusiness.com). It helps people find your website easily and establishes your brand online. Domain names are registered on a first-come, first-served basis and are renewed annually.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>How do I register a domain name?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Simply search for your desired domain name using our domain search tool above. If available, you can register it instantly. If not, we'll suggest alternative options. Registration is quick and you'll have ownership as long as you renew it annually.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>What's included with my domain registration?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Each domain registration includes free DNS management, domain forwarding, email forwarding, and a free SSL certificate when hosted with Lwegatech. You also get 24/7 support and an easy-to-use control panel to manage your domain settings.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>Can I transfer my existing domain to Lwegatech?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes! You can transfer your existing domain to Lwegatech at any time. We offer free domain transfers with hosting purchase. The process is simple - just unlock your domain, get the authorization code from your current registrar, and initiate the transfer with us.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>What is the difference between .com, .ug, and other extensions?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Domain extensions (TLDs) indicate your website's purpose or location. .com is global and business-focused, .org is for organizations, .ug is specific to Uganda, .co.ug for Ugandan businesses, .go.ug for government entities. Choose based on your target audience and business type.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>How long does domain registration take?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Domain registration is instant for most extensions. Once you complete the registration process and payment, your domain is immediately registered in your name and available for use. Some country-specific domains like .ug may take 24-48 hours for registration to complete.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>Can I get a refund if I change my mind?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Domain registrations are final sales due to ICANN regulations. However, we offer a 5-day grace period during which you may request a refund for certain extensions. We recommend carefully selecting your domain name before purchase.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="bi bi-question-circle-fill"></i>
                        <span>Do I need hosting to register a domain?</span>
                        <i class="bi bi-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>No, you can register a domain without hosting. You can park your domain with us until you're ready to build your website. When you're ready, you can easily add hosting to make your website live.</p>
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