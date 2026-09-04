<?php
/**
 * Template Name: About Us Page
 * Description: Modern template for displaying about us content
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
                <div class="hero-split-layout">
                    <div class="hero-text-contents">
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
                    <div class="hero-image-angle">
                        <?php if (has_post_thumbnail()): 
                            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                        ?>
                        <div class="angle-image-wrapper">
                            <img src="<?php echo esc_url($thumb[0]); ?>" 
                                 alt="<?php the_title_attribute(); ?>" 
                                 class="angle-image">
                            <div class="angle-overlay"></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story - Centered with Loop Ring Background -->
    <section class="story-section" data-oas="fade-up">
        <div class="container">
            <div class="story-centered">
                <div class="kpy-sg-header">
                    <div class="kpy-sg-title-container">
                        <div class="kpy-sg-title-bg" aria-hidden="true">
                            Our Story
                        </div>
                        <h2 class="kpy-sg-title">
                            <span class="kpy-sg-title-red">Our</span>
                            <span class="kpy-sg-title-white">Story</span>
                        </h2>
                    </div>
                </div>
                <div class="story-text-centered">
                    <p class="story-paragraph" data-oas="fade-up" data-oas-delay="100">Lwegatech was founded in 2008 with a simple belief: that Ugandan businesses deserve world-class digital solutions without leaving the continent. Sixteen years later, that belief has become our legacy.</p>
                    <p class="story-paragraph" data-oas="fade-up" data-oas-delay="200">We've grown from a bold idea into one of East Africa's most trusted technology partners serving over 1,500 clients across Uganda, Tanzania, Rwanda, South Sudan, and beyond. Not by following trends, but by setting standards. Not by promising quick fixes, but by building lasting partnerships.</p>
                    <p class="story-paragraph" data-oas="fade-up" data-oas-delay="300">Today, our team of experienced computer consultants, software engineers, and digital strategists brings together local insight and global expertise. We understand the unique challenges Ugandan businesses face because we face them too.</p>
                </div>
            </div>
        </div>
        <div class="loop-ring-background">
            <div class="loop-ring-bg">
                <div class="ring-dot-bg dot-bg-1"></div>
                <div class="ring-dot-bg dot-bg-2"></div>
                <div class="ring-dot-bg dot-bg-3"></div>
                <div class="ring-dot-bg dot-bg-4"></div>
                <div class="ring-dot-bg dot-bg-5"></div>
                <div class="ring-dot-bg dot-bg-6"></div>
                <div class="ring-core-bg">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Vision Section - Timeline Grid with Data-OAS Effects -->
    <section class="mission-vision-section-new" data-oas="fade-up">
        <div class="container">
            <div class="kpy-sg-header" data-oas="fade-up">
                <div class="kpy-sg-title-container">
                    <div class="kpy-sg-title-bg" aria-hidden="true">
                        Our Purpose
                    </div>
                    <h2 class="kpy-sg-title">
                        <span class="kpy-sg-title-red">Mission</span>
                        <span class="kpy-sg-title-white">& Vision</span>
                    </h2>
                </div>
            </div>
            <div class="timeline-container" data-oas="stagger-children">
                <!-- Mission Item -->
                <div class="timeline-node mission-node" data-oas="slide-up" data-oas-delay="0">
                    <div class="timeline-node-content">
                        <div class="node-icon" data-oas="pulse-on-hover"><i class="bi bi-bullseye"></i></div>
                        <h3>Our Mission</h3>
                        <p>To deliver reliable, affordable, and high impact digital solutions that empower businesses and individuals in Uganda, across Africa, and around the world.</p>
                    </div>
                    <div class="node-marker" data-oas="glow-pulse"></div>
                </div>
                
                <!-- Timeline Path with Progress -->
                <div class="timeline-path" data-oas="draw-line" data-oas-delay="400">
                    <div class="path-line"></div>
                    <div class="path-progress"></div>
                    <div class="path-dot dot-1" data-oas="pulse"></div>
                    <div class="path-dot dot-2" data-oas="pulse" data-oas-delay="100"></div>
                    <div class="path-dot dot-3" data-oas="pulse" data-oas-delay="200"></div>
                    <div class="path-dot dot-4" data-oas="pulse" data-oas-delay="300"></div>
                </div>
                
                <!-- Vision 1 Item -->
                <div class="timeline-node vision-node" data-oas="slide-up" data-oas-delay="200">
                    <div class="vision-bg-number" data-oas="fade-in-scale">01</div>
                    <div class="timeline-node-content">
                        <div class="node-icon" data-oas="pulse-on-hover"><i class="bi bi-eye-fill"></i></div>
                        <h3>Our Vision</h3>
                        <p>To be East Africa's most trusted technology partner recognized for innovation, excellence, and lasting client relationships.</p>
                    </div>
                    <div class="node-marker" data-oas="glow-pulse"></div>
                </div>
                
                <!-- Timeline Path with Progress -->
                <div class="timeline-path" data-oas="draw-line" data-oas-delay="600">
                    <div class="path-line"></div>
                    <div class="path-progress"></div>
                    <div class="path-dot dot-1" data-oas="pulse"></div>
                    <div class="path-dot dot-2" data-oas="pulse" data-oas-delay="100"></div>
                    <div class="path-dot dot-3" data-oas="pulse" data-oas-delay="200"></div>
                    <div class="path-dot dot-4" data-oas="pulse" data-oas-delay="300"></div>
                </div>
                
                <!-- Vision 2 Item -->
                <div class="timeline-node vision-node" data-oas="slide-up" data-oas-delay="400">
                    <div class="vision-bg-number" data-oas="fade-in-scale">02</div>
                    <div class="timeline-node-content">
                        <div class="node-icon" data-oas="pulse-on-hover"><i class="bi bi-cloud-upload"></i></div>
                        <h3>Our Vision</h3>
                        <p>To own and operate Africa's premier data center anchoring the continent's digital future on homegrown, sovereign infrastructure.</p>
                    </div>
                    <div class="node-marker" data-oas="glow-pulse"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Approach - Process Steps -->
    <section class="approach-section" data-oas="fade-up">
        <div class="container">
            <div class="kpy-sg-header" data-oas="fade-up">
                <div class="kpy-sg-title-container">
                    <div class="kpy-sg-title-bg" aria-hidden="true">
                        Our Approach
                    </div>
                    <h2 class="kpy-sg-title">
                        <span class="kpy-sg-title-red">How We</span>
                        <span class="kpy-sg-title-white">Work</span>
                    </h2>
                </div>
                <p class="section-subtitle" data-oas="fade-up" data-oas-delay="100">A proven process that delivers results, every time</p>
            </div>
            <div class="process-steps" data-oas="stagger-children">
                <div class="process-step" data-oas="slide-up" data-oas-delay="0">
                    <div class="step-number">01</div>
                    <div class="step-icon"><i class="bi bi-ear"></i></div>
                    <div class="step-content">
                        <h3>Listen</h3>
                        <p>We learn about your goals, audience, and challenges.</p>
                    </div>
                </div>
                <div class="process-step" data-oas="slide-up" data-oas-delay="50">
                    <div class="step-number">02</div>
                    <div class="step-icon"><i class="bi bi-clipboard-check"></i></div>
                    <div class="step-content">
                        <h3>Plan</h3>
                        <p>Clear scope, timeline and price — no surprises.</p>
                    </div>
                </div>
                <div class="process-step" data-oas="slide-up" data-oas-delay="100">
                    <div class="step-number">03</div>
                    <div class="step-icon"><i class="bi bi-palette"></i></div>
                    <div class="step-content">
                        <h3>Design</h3>
                        <p>You see and approve before we code.</p>
                    </div>
                </div>
                <div class="process-step" data-oas="slide-up" data-oas-delay="150">
                    <div class="step-number">04</div>
                    <div class="step-icon"><i class="bi bi-code-square"></i></div>
                    <div class="step-content">
                        <h3>Build</h3>
                        <p>We develop with care, keeping you updated.</p>
                    </div>
                </div>
                <div class="process-step" data-oas="slide-up" data-oas-delay="200">
                    <div class="step-number">05</div>
                    <div class="step-icon"><i class="bi bi-rocket-takeoff"></i></div>
                    <div class="step-content">
                        <h3>Launch</h3>
                        <p>Smooth go-live with zero downtime.</p>
                    </div>
                </div>
                <div class="process-step" data-oas="slide-up" data-oas-delay="250">
                    <div class="step-number">06</div>
                    <div class="step-icon"><i class="bi bi-headset"></i></div>
                    <div class="step-content">
                        <h3>Support</h3>
                        <p>We're here after launch — training, tweaks, and peace of mind.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us with Image in Middle -->
    <section class="why-choose-section" data-oas="fade-up">
        <div class="container">
            <div class="kpy-sg-header" data-oas="fade-up">
                <div class="kpy-sg-title-container">
                    <div class="kpy-sg-title-bg" aria-hidden="true">
                        Why Lwegatech
                    </div>
                    <h2 class="kpy-sg-title">
                        <span class="kpy-sg-title-red">Why Choose</span>
                        <span class="kpy-sg-title-white">Us?</span>
                    </h2>
                </div>
            </div>
            <div class="why-choose-layout">
                <div class="why-choose-left" data-oas="slide-right" data-oas-delay="100">
                    <div class="feature-item" data-oas="hover-lift">
                        <i class="bi bi-calendar-check"></i>
                        <div>
                            <strong>16 Years of Proven Excellence</strong>
                            <p>We've been here. We'll be here.</p>
                        </div>
                    </div>
                    <div class="feature-item" data-oas="hover-lift" data-oas-delay="50">
                        <i class="bi bi-geo-alt-fill"></i>
                        <div>
                            <strong>Deep Local Expertise</strong>
                            <p>We understand Uganda's unique digital landscape.</p>
                        </div>
                    </div>
                    <div class="feature-item" data-oas="hover-lift" data-oas-delay="100">
                        <i class="bi bi-headset"></i>
                        <div>
                            <strong>Comprehensive Support</strong>
                            <p>From concept to launch and beyond.</p>
                        </div>
                    </div>
                </div>
                <div class="why-choose-center" data-oas="zoom-in" data-oas-delay="200">
                    <div class="center-image-wrapper">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image.png" alt="Why Choose Lwegatech" class="center-img">
                        <div class="center-image-overlay"></div>
                        <div class="floating-badge" data-oas="float">
                            <span>Trusted Since 2008</span>
                        </div>
                    </div>
                </div>
                <div class="why-choose-right" data-oas="slide-left" data-oas-delay="100">
                    <div class="feature-item" data-oas="hover-lift">
                        <i class="bi bi-chat-dots"></i>
                        <div>
                            <strong>No-Jargon Communication</strong>
                            <p>We speak your language, not just tech.</p>
                        </div>
                    </div>
                    <div class="feature-item" data-oas="hover-lift" data-oas-delay="50">
                        <i class="bi bi-handshake"></i>
                        <div>
                            <strong>Long-Term Partnership</strong>
                            <p>We succeed when you succeed.</p>
                        </div>
                    </div>
                    <div class="feature-item" data-oas="hover-lift" data-oas-delay="100">
                        <i class="bi bi-star-fill"></i>
                        <div>
                            <strong>Proven Track Record</strong>
                            <p>Over 1,500 satisfied clients and counting.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="values-section" data-oas="fade-up">
        <div class="container">
            <div class="kpy-sg-header" data-oas="fade-up">
                <div class="kpy-sg-title-container">
                    <div class="kpy-sg-title-bg" aria-hidden="true">
                        What Drives Us
                    </div>
                    <h2 class="kpy-sg-title">
                        <span class="kpy-sg-title-red">Our Core</span>
                        <span class="kpy-sg-title-white">Values</span>
                    </h2>
                </div>
            </div>
            <div class="values-grid" data-oas="stagger-children">
                <div class="value-card" data-oas="flip-up" data-oas-delay="0">
                    <div class="value-icon"><i class="bi bi-person-workspace"></i></div>
                    <h3>Personalized Solution</h3>
                    <p>We don't believe in one-size-fits-all. Every client has unique goals, challenges, and dreams — we build solutions that fit you, not the other way around.</p>
                </div>
                <div class="value-card" data-oas="flip-up" data-oas-delay="100">
                    <div class="value-icon"><i class="bi bi-speedometer2"></i></div>
                    <h3>Efficiency and Effectiveness</h3>
                    <p>We respect your time and your investment. We work smart, deliver on schedule, and make sure everything we build actually works.</p>
                </div>
                <div class="value-card" data-oas="flip-up" data-oas-delay="200">
                    <div class="value-icon"><i class="bi bi-chat-heart"></i></div>
                    <h3>Customer Sensitivity</h3>
                    <p>We listen before we speak. Whether you're tech-savvy or just getting started, we meet you where you are — with patience, clarity, and genuine care.</p>
                </div>
                <div class="value-card" data-oas="flip-up" data-oas-delay="300">
                    <div class="value-icon"><i class="bi bi-people-fill"></i></div>
                    <h3>Team Work</h3>
                    <p>Great things are never built alone. Within Lwegatech, we support each other. With our clients, we partner as equals.</p>
                </div>
            </div>
        </div>
    </section>

    <?php endwhile; endif; ?>
</main>

<script>
// Data-OAS Animation System
document.addEventListener('DOMContentLoaded', function() {
    const animatedElements = document.querySelectorAll('[data-oas]');
    
    const animations = {
        'fade-up': {
            initial: { opacity: 0, transform: 'translateY(30px)' },
            final: { opacity: 1, transform: 'translateY(0)' }
        },
        'fade-in-scale': {
            initial: { opacity: 0, transform: 'scale(0.8)' },
            final: { opacity: 1, transform: 'scale(1)' }
        },
        'slide-up': {
            initial: { opacity: 0, transform: 'translateY(50px)' },
            final: { opacity: 1, transform: 'translateY(0)' }
        },
        'slide-right': {
            initial: { opacity: 0, transform: 'translateX(-50px)' },
            final: { opacity: 1, transform: 'translateX(0)' }
        },
        'slide-left': {
            initial: { opacity: 0, transform: 'translateX(50px)' },
            final: { opacity: 1, transform: 'translateX(0)' }
        },
        'zoom-in': {
            initial: { opacity: 0, transform: 'scale(0.9)' },
            final: { opacity: 1, transform: 'scale(1)' }
        },
        'flip-up': {
            initial: { opacity: 0, transform: 'rotateX(90deg)', transformOrigin: 'top' },
            final: { opacity: 1, transform: 'rotateX(0deg)' }
        },
        'draw-line': {
            initial: {},
            final: {}
        },
        'pulse': {
            initial: {},
            final: {}
        },
        'pulse-on-hover': {
            initial: {},
            final: {}
        },
        'glow-pulse': {
            initial: {},
            final: {}
        },
        'hover-lift': {
            initial: {},
            final: {}
        },
        'float': {
            initial: {},
            final: {}
        },
        'stagger-children': {
            initial: {},
            final: {}
        }
    };
    
    // Set initial states
    animatedElements.forEach(el => {
        const animation = el.getAttribute('data-oas');
        const delay = parseInt(el.getAttribute('data-oas-delay') || '0');
        
        if (animation === 'stagger-children') {
            const children = el.children;
            Array.from(children).forEach((child, index) => {
                child.style.opacity = '0';
                child.style.transform = 'translateY(30px)';
                child.style.transition = `opacity 0.6s cubic-bezier(0.2, 0.9, 0.4, 1.1), transform 0.6s cubic-bezier(0.2, 0.9, 0.4, 1.1)`;
                child.style.transitionDelay = `${index * 80}ms`;
            });
        } else if (animation === 'draw-line') {
            const pathProgress = el.querySelector('.path-progress');
            if (pathProgress) {
                pathProgress.style.width = '0%';
                pathProgress.style.height = '0%';
            }
        } else if (animation === 'pulse') {
            el.style.animation = 'pulseEffect 2s infinite';
        } else if (animation === 'pulse-on-hover') {
            el.addEventListener('mouseenter', () => {
                el.style.animation = 'pulseQuick 0.4s ease';
                setTimeout(() => { el.style.animation = ''; }, 400);
            });
        } else if (animation === 'glow-pulse') {
            el.style.animation = 'glowPulse 1.5s infinite';
        } else if (animation === 'hover-lift') {
            el.addEventListener('mouseenter', () => {
                el.style.transform = 'translateY(-8px)';
                el.style.transition = 'transform 0.3s ease';
            });
            el.addEventListener('mouseleave', () => {
                el.style.transform = 'translateY(0)';
            });
        } else if (animation === 'float') {
            el.style.animation = 'floatEffect 3s ease-in-out infinite';
        } else if (animations[animation] && animations[animation].initial) {
            Object.assign(el.style, animations[animation].initial);
            el.style.transition = `all 0.8s cubic-bezier(0.2, 0.9, 0.4, 1.1)`;
            if (delay) el.style.transitionDelay = `${delay}ms`;
        }
    });
    
    // Intersection Observer for scroll-triggered animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const animation = el.getAttribute('data-oas');
                const delay = parseInt(el.getAttribute('data-oas-delay') || '0');
                
                if (animation === 'stagger-children') {
                    const children = el.children;
                    Array.from(children).forEach((child, index) => {
                        setTimeout(() => {
                            child.style.opacity = '1';
                            child.style.transform = 'translateY(0)';
                        }, index * 80);
                    });
                } else if (animation === 'draw-line') {
                    const pathProgress = el.querySelector('.path-progress');
                    const isMobile = window.innerWidth <= 1024;
                    if (pathProgress) {
                        if (isMobile) {
                            pathProgress.style.width = '100%';
                        } else {
                            pathProgress.style.height = '100%';
                        }
                    }
                } else if (animation === 'pulse') {
                    // Already animated
                } else if (animation === 'pulse-on-hover') {
                    // Already set
                } else if (animation === 'glow-pulse') {
                    // Already set
                } else if (animation === 'hover-lift') {
                    // Already set
                } else if (animation === 'float') {
                    // Already set
                } else if (animations[animation] && animations[animation].final) {
                    setTimeout(() => {
                        Object.assign(el.style, animations[animation].final);
                    }, delay);
                }
                
                observer.unobserve(el);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
    
    animatedElements.forEach(el => observer.observe(el));
    
    // Add keyframes for animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes pulseEffect {
            0%, 100% { transform: scale(1); opacity: 0.7; }
            50% { transform: scale(1.3); opacity: 1; }
        }
        @keyframes pulseQuick {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
        @keyframes glowPulse {
            0%, 100% { box-shadow: 0 0 0 2px rgba(192,0,12,0.5); }
            50% { box-shadow: 0 0 0 6px rgba(192,0,12,0.3); }
        }
        @keyframes floatEffect {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        .timeline-path .path-progress {
            transition: height 1.2s ease-out, width 1.2s ease-out;
        }
        @media (max-width: 1024px) {
            .timeline-path .path-progress {
                transition: width 1.2s ease-out;
            }
        }
    `;
    document.head.appendChild(style);
    
    // Manual trigger for draw-line animations that are visible on load
    setTimeout(() => {
        document.querySelectorAll('[data-oas="draw-line"]').forEach(el => {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                const pathProgress = el.querySelector('.path-progress');
                const isMobile = window.innerWidth <= 1024;
                if (pathProgress) {
                    if (isMobile) {
                        pathProgress.style.width = '100%';
                    } else {
                        pathProgress.style.height = '100%';
                    }
                }
            }
        });
    }, 500);
});
</script>



<?php get_footer(); ?>