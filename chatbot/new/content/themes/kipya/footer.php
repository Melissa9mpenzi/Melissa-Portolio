<!-- Footer Section -->
<footer class="tech-footer">
    <!-- Background Image with Overlay -->
    <div class="footer-background">
        <div class="overlay"></div>
        <!-- Image that shakes (separate from overlay) -->
        <div class="shaking-image"></div>
    </div>
    
    <div class="container">
        <!-- Main Footer Content - Four Columns -->
        <div class="row g-5">
            <!-- Column 1: Logo & Company Info - ENTIRE COLUMN with red background and overlap -->
            <div class="col-lg-3">
                <div class="footer-widget logo-column-wrapper">
                    <!-- Logo -->
                    <div class="footer-logo">
                        <?php if (has_custom_logo()): ?>
                            <?php the_custom_logo(); ?>
                        <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/lwegatech-logo.png" alt="LWEGATECH" class="logo-image">
                            <h3 class="logo-text">LWEGATECH</h3>
                        <?php endif; ?>
                    </div>
                    
                    <p class="footer-description">
                        Your trusted technology partner since 2008. 
                    </p>
                    
                    <div class="footer-contact">
                        <p><i class="fas fa-map-marker-alt"></i> Kampala, Uganda</p>
                        <p><i class="fas fa-phone-alt"></i> +256 (0) 123 456 789</p>
                        <p><i class="fas fa-envelope"></i> info@lwegatech.com</p>
                    </div>
                </div>
            </div>
            
            <!-- Column 2: Quick Links -->
            <div class="col-lg-3">
                <div class="footer-widget">
                    <h4 class="footer-widget-title">About Us</h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo home_url('/about-us/'); ?>"><i class="fas fa-chevron-right"></i> About Us</a></li>
                        <li><a href="<?php echo home_url('/our-work/'); ?>"><i class="fas fa-chevron-right"></i> Our Work</a></li>
                        <li><a href="<?php echo home_url('/the-team/'); ?>"><i class="fas fa-chevron-right"></i> The Team</a></li>
                        <li><a href="<?php echo home_url('/our-blog/'); ?>"><i class="fas fa-chevron-right"></i> Blog</a></li>
                        <li><a href="<?php echo home_url('/contact/'); ?>"><i class="fas fa-chevron-right"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Column 3: Our Services -->
            <div class="col-lg-3">
    <div class="footer-widget">
        <h4 class="footer-widget-title">Our Solutions</h4>
        <ul class="footer-links">
            <li><a href="<?php echo home_url('/website-design/'); ?>"><i class="fas fa-chevron-right"></i>Web Solutions</a></li>
            <li><a href="<?php echo home_url('/app-development/'); ?>"><i class="fas fa-chevron-right"></i> Apps & Software</a></li>
            <li><a href="<?php echo home_url('/ssl-certificates/'); ?>"><i class="fas fa-chevron-right"></i> Digital Security</a></li>
            <li><a href="<?php echo home_url('/web-hosting/'); ?>"><i class="fas fa-chevron-right"></i> Web Hosting</a></li>
            <li><a href="<?php echo home_url('/register-a-domain/'); ?>"><i class="fas fa-chevron-right"></i> Domains </a></li>
            <li><a href="<?php echo home_url('/web-maintenance/'); ?>"><i class="fas fa-chevron-right"></i> SEO and Maintenance</a></li>
        </ul>
    </div>
</div>
            
            <!-- Column 4: Connect & CTA -->
            <div class="col-lg-3">
                <div class="footer-widget">
                    <h4 class="footer-widget-title">Connect With Us</h4>
                    
                    <!-- Social Media Icons -->
                    <div class="social-links">
                        <a href="http://facebook.com/lwegatech/" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://x.com/lwegatech" class="social-link" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/company/lwegatech" class="social-link" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://www.instagram.com/lwegatech/" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                    
                    <!-- CTA Button -->
                    <div class="footer-cta">
                        <a href="https://www.lwegatech.info/new/contact/" class="footer-button">
                            <i class="fas fa-calendar-check"></i> Contact
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright">
                        <i class="far fa-copyright"></i> <?php echo date('Y'); ?> LWEGATECH. All rights reserved. | 
                        <span class="year-badge"><i class="fas fa-calendar-alt"></i> Since 2008</span>
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="footer-meta">
                        <span class="meta-item">Billing Policy</span>
                        <span class="meta-item">Privacy Policy</span>
                        <span class="meta-item">Terms of Service</span>
                        <span class="meta-item">Cookies</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Preloader -->
<div id="preloader">
    <div class="bounce-container">
        <div class="bounce-ball"></div>
        <div class="bounce-ball"></div>
        <div class="bounce-ball"></div>
        <div class="bounce-ball"></div>
    </div>
    <div class="logo-container">
        <?php
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        if ($logo) {
            echo '<img src="' . esc_url($logo[0]) . '" class="lt-logo" alt="' . get_bloginfo('name') . '">';
        } else {
            echo '<h2 class="lt-logo-text">' . get_bloginfo('name') . '</h2>';
        }
        ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',function(){const preloader=document.getElementById('preloader');if(preloader){setTimeout(function(){preloader.classList.add('hide');document.body.classList.add('loaded');setTimeout(function(){if(preloader.parentNode)preloader.style.display='none';},500);},500);}});window.addEventListener('load',function(){const preloader=document.getElementById('preloader');if(preloader&&!preloader.classList.contains('hide')){preloader.classList.add('hide');document.body.classList.add('loaded');setTimeout(function(){if(preloader.parentNode)preloader.style.display='none';},500);}});
</script>

<?php wp_footer(); ?>
</body>
</html>
