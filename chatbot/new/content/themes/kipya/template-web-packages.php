<?php
/**
 * Template Name: Web Design Packages
 *
 * @package Kipya
 */

get_header();
include get_template_directory() . '/inc/menus/menu.php';

$packages = array(
    array(
        'tier'         => 'launch',
        'title'        => 'LAUNCH',
        'type'         => 'Website Design',
        'note_top'     => 'The cost is Exclusive of Taxes.',
        'price'        => 'From 1,950,000 UGX',
        'price_period' => '/project',
        'delivery'     => 'Ready in 20 working days',
        'desc'         => 'Perfect for startups and small businesses taking their first steps online.',
        'features'     => array('Up to 10 pages (Home, About, Services/Programs, Contact, Gallery, etc.)','Mobile responsive design','Content Management System (CMS) — update content yourself','Contact forms — capture inquiries easily','Social media integration — connect with your community','Basic SEO setup — get found on Google','Free deployment — we handle all the tech','30 days support — we\'re here as you settle in'),
        'cta_label'    => 'Get Started',
        'cta_url'      => 'https://billing.lwegatech.com/get-quote=business-package/13cda37c8f347e8848b66453097cfbf663e14522b81e4cd3',
        'featured'     => false,
    ),
    array(
        'tier'         => 'grow',
        'title'        => 'GROW',
        'type'         => 'Website Design',
        'note_top'     => 'The cost is Exclusive of Taxes.',
        'price'        => 'From 3,950,000 UGX',
        'price_period' => '/project',
        'delivery'     => 'Ready in 30 working days',
        'desc'         => 'For organizations ready to tell their full story and build authority.',
        'features'     => array('Everything in LAUNCH, plus:','Up to 15 pages — more room to tell your story','News & Updates section — share milestones in real-time','Publications/Resource Hub — position yourself as an authority','Advanced media galleries — photos, videos, downloadable content','Social media feeds — automatically show your latest posts','Team training (2 hours onsite) — your staff gains confidence','60 days priority support — we\'re on call as you build momentum'),
        'cta_label'    => 'Get Started',
        'cta_url'      => 'https://billing.lwegatech.com/get-quote=business-package/13cda37c8f347e8848b66453097cfbf663e14522b81e4cd3',
        'featured'     => true,
    ),
    array(
        'tier'         => 'dominate',
        'title'        => 'DOMINATE',
        'type'         => 'Website Design',
        'note_top'     => 'The cost is Exclusive of Taxes.',
        'price'        => 'From 6,950,000 UGX',
        'price_period' => '/project',
        'delivery'     => 'Timeline based on scope',
        'desc'         => 'For organizations that need to transact, automate, and scale.',
        'features'     => array('Everything in GROW, plus:','Up to 25 pages — unlimited storytelling potential','E-Commerce / Payment Integration — sell products, accept mobile money & cards','Custom Feature Development — member portals, directories, dashboards','API Integrations — connect to CRM, payment gateway, or external data','Interactive Tools (Calculators/Forms) — engage users and capture leads','Google Analytics + Performance Tracking — see exactly how your site performs','Advanced Training (half-day onsite) — your staff gains confidence','90 days priority support — extended peace of mind during growth'),
        'cta_label'    => 'Get Started',
        'cta_url'      => 'https://billing.lwegatech.com/get-quote=business-package/13cda37c8f347e8848b66453097cfbf663e14522b81e4cd3',
        'featured'     => false,
    ),
    array(
        'tier'         => 'enterprise',
        'title'        => 'ENTERPRISE',
        'type'         => 'Custom Solution',
        'note_top'     => 'Pricing varies by scope. Contact us for a custom quote.',
        'price'        => 'Custom Quote',
        'price_period' => '',
        'delivery'     => 'Timeline based on requirements',
        'desc'         => 'Tailored solutions for large organizations with complex requirements.',
        'features'     => array('Custom software / MIS development','Mobile apps (Android/iOS)','Multi-site management','Advanced security & compliance','Dedicated account manager','12-month priority support','Training for your entire team'),
        'cta_label'    => 'Get Quote',
        'cta_url'      => 'https://billing.lwegatech.com/get-quote=business-package/13cda37c8f347e8848b66453097cfbf663e14522b81e4cd3',
        'featured'     => false,
    ),
);

$total_packages = count($packages);
$slides_to_show = 2;
$total_slides = $total_packages; // One dot per package for mobile compatibility
?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<main role="main" style="background:#0d0d0d;font-family:'Segoe UI',sans-serif;">
<section data-aos="fade-up" style="padding:6rem 0;background:#111;border-top:1px solid #1a1a1a;">
    <div class="container">
        <div style="text-align:center;margin-bottom:3rem;">
            <div style="display:flex;align-items:center;justify-content:center;gap:12px;margin-bottom:1rem;font-size:0.75rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:#c0000c;">
                <span style="display:inline-block;height:2px;width:40px;background:#c0000c;"></span>
                <span>Pricing</span>
                <span style="display:inline-block;height:2px;width:40px;background:#c0000c;"></span>
            </div>
            <h2 style="font-size:2.6rem;font-weight:900;color:#fff;line-height:1.1;letter-spacing:-0.03em;margin-bottom:1.5rem;text-transform:uppercase;text-align:center;">Our <span style="color:#c0000c;">Packages</span></h2>
            <p style="color:#888;font-size:1rem;max-width:500px;margin:0 auto;">Professional website design tailored for your business — modern, responsive, and optimised to give your brand a strong online presence.</p>
        </div>

        <!-- Carousel Container -->
        <div class="kpy-carousel-wrapper" style="position:relative;max-width:1000px;margin:0 auto;">
            <!-- Prev Arrow -->
            <button class="kpy-carousel-arrow kpy-carousel-prev" aria-label="Previous packages" style="position:absolute;left:-50px;top:50%;transform:translateY(-50%);width:44px;height:44px;background:#1a1a1a;border:1px solid #333;color:#fff;cursor:pointer;z-index:10;display:flex;align-items:center;justify-content:center;transition:all 0.2s;">
                <i class="bi bi-chevron-left" style="font-size:1.2rem;"></i>
            </button>

            <!-- Carousel Viewport -->
            <div class="kpy-carousel-viewport" style="overflow:hidden;">
                <div class="kpy-carousel-track" style="display:flex;transition:transform 0.4s ease;">
                    <?php foreach ($packages as $index => $pkg):
                        $is_featured = !empty($pkg['featured']);
                    ?>
                    <div class="kpy-carousel-slide" data-index="<?php echo $index; ?>" style="flex:0 0 50%;padding:12px;box-sizing:border-box;">
                        <div style="background:#0f0f0f;border:1px solid <?php echo $is_featured ? '#c0000c' : '#222'; ?>;height:100%;display:flex;flex-direction:column;position:relative;overflow:hidden;">
                            <?php if ($is_featured): ?>
                            <div style="display:flex;align-items:center;justify-content:center;gap:6px;background:#c0000c;color:#fff;font-size:0.7rem;font-weight:800;letter-spacing:2px;text-transform:uppercase;padding:0.5rem 1rem;width:100%;"><i class="bi bi-star-fill"></i> Most Popular</div>
                            <?php endif; ?>
                            <div style="font-size:1.4rem;font-weight:900;color:#fff;letter-spacing:2px;text-transform:uppercase;padding:1.4rem 2rem 0.2rem;"><?php echo esc_html($pkg['title']); ?></div>
                            <div style="font-size:0.78rem;color:#888;font-weight:600;letter-spacing:1px;text-transform:uppercase;padding:0 2rem 0.5rem;"><?php echo esc_html($pkg['type']); ?></div>
                            <?php if (!empty($pkg['note_top'])): ?>
                            <div style="font-size:0.72rem;color:#555;font-style:italic;padding:0 2rem 0.8rem;"><?php echo esc_html($pkg['note_top']); ?></div>
                            <?php endif; ?>
                            <div style="font-size:1.5rem;font-weight:900;color:#c0000c;padding:0.8rem 2rem 1rem;border-bottom:1px solid #1f1f1f;line-height:1;"><?php echo esc_html($pkg['price']); ?><?php if (!empty($pkg['price_period'])): ?><span style="font-size:0.88rem;font-weight:600;color:#777;margin-left:2px;"><?php echo esc_html($pkg['price_period']); ?></span><?php endif; ?></div>
                            <ul style="list-style:none;padding:1.2rem 2rem;margin:0;flex:1;">
                                <?php foreach ((array)$pkg['features'] as $feature): ?>
                                <li style="display:flex;align-items:flex-start;gap:10px;padding:0.55rem 0;border-bottom:1px solid #1a1a1a;color:#ccc;font-size:0.88rem;line-height:1.4;"><i class="bi bi-check-circle-fill" style="color:#c0000c;flex-shrink:0;margin-top:2px;font-size:0.9rem;"></i><span><?php echo esc_html($feature); ?></span></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php if (!empty($pkg['delivery'])): ?>
                            <div style="display:flex;align-items:center;gap:6px;font-size:0.78rem;color:#888;padding:0.6rem 2rem;"><i class="bi bi-clock" style="color:#c0000c;"></i><?php echo esc_html($pkg['delivery']); ?></div>
                            <?php endif; ?>
                            <a href="<?php echo esc_url($pkg['cta_url']); ?>" style="display:flex;align-items:center;justify-content:center;gap:8px;background:<?php echo $is_featured ? '#c0000c' : 'transparent'; ?>;color:#fff;font-weight:800;font-size:0.85rem;letter-spacing:1px;text-transform:uppercase;padding:1rem 2rem;text-decoration:none;border:none;border-top:1px solid #1f1f1f;transition:background 0.2s;margin-top:auto;"><?php echo esc_html($pkg['cta_label']); ?><i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Next Arrow -->
            <button class="kpy-carousel-arrow kpy-carousel-next" aria-label="Next packages" style="position:absolute;right:-50px;top:50%;transform:translateY(-50%);width:44px;height:44px;background:#1a1a1a;border:1px solid #333;color:#fff;cursor:pointer;z-index:10;display:flex;align-items:center;justify-content:center;transition:all 0.2s;">
                <i class="bi bi-chevron-right" style="font-size:1.2rem;"></i>
            </button>
        </div>

        <!-- Dots Navigation -->
        <div class="kpy-carousel-dots" style="display:flex;justify-content:center;gap:8px;margin-top:2rem;">
            <?php for ($i = 0; $i < $total_slides; $i++): ?>
            <button class="kpy-dot <?php echo $i === 0 ? 'active' : ''; ?>" data-slide="<?php echo $i; ?>" aria-label="Go to slide <?php echo $i + 1; ?>" style="width:10px;height:10px;border-radius:50%;border:none;background:<?php echo $i === 0 ? '#c0000c' : '#333'; ?>;cursor:pointer;transition:background 0.2s;"></button>
            <?php endfor; ?>
        </div>

        <!-- Counter -->
        <div class="kpy-carousel-counter" style="text-align:center;margin-top:1rem;color:#888;font-size:0.85rem;">
            <span class="kpy-counter-current" style="color:#c0000c;font-weight:700;">1</span>
            <span class="kpy-counter-sep"> / </span>
            <span class="kpy-counter-total"><?php echo $total_slides; ?></span>
        </div>
    </div>
</section>
</main>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({duration:800,once:true,offset:100,easing:'ease-out-cubic'});

    // Carousel functionality
    const track = document.querySelector('.kpy-carousel-track');
    const slides = document.querySelectorAll('.kpy-carousel-slide');
    const prevBtn = document.querySelector('.kpy-carousel-prev');
    const nextBtn = document.querySelector('.kpy-carousel-next');
    const dots = document.querySelectorAll('.kpy-dot');
    const currentCounter = document.querySelector('.kpy-counter-current');
    const totalCounter = document.querySelector('.kpy-counter-total');

    // Detect mobile
    const isMobile = window.innerWidth <= 768;
    const slidesToShow = isMobile ? 1 : 2;
    const totalSlides = Math.ceil(slides.length / slidesToShow);
    let currentSlide = 0;

    // Update counter display
    if (totalCounter) totalCounter.textContent = totalSlides;

    function updateCarousel() {
        const slideWidth = 100 / slidesToShow;
        track.style.transform = 'translateX(-' + (currentSlide * 100) + '%)';

        // Update dots (recalculate for mobile)
        const dotIndex = Math.min(currentSlide, dots.length - 1);
        dots.forEach((dot, index) => {
            dot.style.background = index === dotIndex ? '#c0000c' : '#333';
        });

        // Update counter
        if (currentCounter) currentCounter.textContent = currentSlide + 1;

        // Update arrow states
        prevBtn.style.opacity = currentSlide === 0 ? '0.5' : '1';
        prevBtn.style.cursor = currentSlide === 0 ? 'not-allowed' : 'pointer';
        nextBtn.style.opacity = currentSlide === totalSlides - 1 ? '0.5' : '1';
        nextBtn.style.cursor = currentSlide === totalSlides - 1 ? 'not-allowed' : 'pointer';
    }

    prevBtn.addEventListener('click', function() {
        if (currentSlide > 0) {
            currentSlide--;
            updateCarousel();
        }
    });

    nextBtn.addEventListener('click', function() {
        if (currentSlide < totalSlides - 1) {
            currentSlide++;
            updateCarousel();
        }
    });

    dots.forEach((dot, index) => {
        dot.addEventListener('click', function() {
            currentSlide = index;
            updateCarousel();
        });
    });

    // Initialize
    updateCarousel();

    // Hover effects for arrows
    prevBtn.addEventListener('mouseenter', function() {
        if (currentSlide > 0) this.style.background = '#c0000c';
    });
    prevBtn.addEventListener('mouseleave', function() {
        this.style.background = '#1a1a1a';
    });
    nextBtn.addEventListener('mouseenter', function() {
        if (currentSlide < totalSlides - 1) this.style.background = '#c0000c';
    });
    nextBtn.addEventListener('mouseleave', function() {
        this.style.background = '#1a1a1a';
    });
});
</script>
<?php get_footer(); ?>
