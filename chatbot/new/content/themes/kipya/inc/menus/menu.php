<?php
/**
 * Custom Walker Class for mega dropdown navigation
 * CTA column ONLY appears in mega menus (not in simple dropdowns)
 * Icons on left, title and description on right
 */
class Mega_Menu_Walker extends Walker_Nav_Menu {
    private $has_grandchildren = false;
    private $current_item = null;
    
    private $item_icons = array(
        // Web Solutions - Mega Menu
        'Web Hosting' => 'fa-solid fa-server',
        'Website Design' => 'fa-solid fa-pen-fancy',
        'SEO and Maintenance' => 'fa-solid fa-chart-line',
        'Domains' => 'fa-solid fa-globe',
        'Digital Security' => 'fa-solid fa-shield-halved',
        'Transfer Your Domain' => 'fa-solid fa-right-left',
        
        // App Solutions - Simple Dropdown
        'App and Software Development' => 'fa-solid fa-mobile-screen-button',
        'Monitoring & Evaluation' => 'fa-solid fa-chart-simple',
        'MIS Solutions' => 'fa-solid fa-database',
        'Integration Services' => 'fa-solid fa-link',
        
        // Systems - Simple Dropdown
        'BoraPOS' => 'fa-solid fa-cash-register',
        'ReviseNow' => 'fa-solid fa-file-pen',
        
        // Default
        'default' => 'fa-solid fa-arrow-right'
    );
    
    private $item_descriptions = array(
        // Web Solutions - Mega Menu
        'Web Hosting' => 'Fast, secure hosting with 99.9% uptime',
        'Website Design' => 'Custom designs that convert visitors to customers',
        'SEO and Maintenance' => 'Keep your site optimized and running smoothly',
        'Domains' => 'Find and register your perfect domain name',
        'Digital Security' => 'Protect your website with SSL certificates',
        'Transfer Your Domain' => 'Move your domain hassle-free to Lwegatech',
        
        // App Solutions - Simple Dropdown
        'App and Software Development' => 'Custom applications tailored to your needs',
        'Monitoring & Evaluation' => 'Track, analyze, and improve your impact',
        'MIS Solutions' => 'Streamline operations with intelligent systems',
        'Integration Services' => 'Connect your tools and platforms seamlessly',
        
        // Systems - Simple Dropdown
        'BoraPOS' => 'Complete point of sale system for businesses',
        'ReviseNow' => 'Powerful document review and collaboration tool',
        
        // Default fallback
        'default' => 'Learn more about this service'
    );
    
    function start_lvl(&$output, $depth = 0, $args = null) {
        if ($depth == 0) {
            if ($this->has_grandchildren) {
                // Mega menu with CTA
                $output .= '<div class="mega-menu"><div class="mega-menu-content">';
                $output .= '<div class="mega-menu-columns-wrapper">';
            } else {
                // Simple dropdown with illustration
                $output .= '<div class="simple-dropdown"><div class="simple-dropdown-content">';
                $output .= '<div class="simple-menu-items-wrapper">';
                $output .= '<ul class="simple-menu-items">';
            }
        } else if ($depth == 1 && $this->has_grandchildren) {
            $output .= '<div class="mega-menu-column">';
            if ($this->current_item) {
                $output .= '<h4>' . $this->current_item->title . '</h4>';
            }
            $output .= '<ul>';
        } else if ($depth == 1 && !$this->has_grandchildren) {
            // Already in ul from above
        } else {
            $output .= '<ul>';
        }
    }
    
    function end_lvl(&$output, $depth = 0, $args = null) {
        if ($depth == 0) {
            if ($this->has_grandchildren) {
                $output .= '</div>'; // Close mega-menu-columns-wrapper
                $output .= $this->get_cta_column(); // CTA ONLY for mega menus
                $output .= '</div></div>'; // Close mega-menu-content and mega-menu
            } else {
                $output .= '</ul>'; // Close simple-menu-items
                $output .= '</div>'; // Close simple-menu-items-wrapper
                $output .= $this->get_simple_dropdown_illustration(); // Add illustration to simple dropdown
                $output .= '</div></div>'; // Close simple-dropdown-content and simple-dropdown
            }
            $this->has_grandchildren = false;
        } else if ($depth == 1 && $this->has_grandchildren) {
            $output .= '</ul>';
            $output .= '</div>'; // Close mega-menu-column
        } else {
            $output .= '</ul>';
        }
    }
    
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $this->current_item = $item;
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $has_children = in_array('menu-item-has-children', $classes);
        
        if ($depth == 0 && $has_children) {
            $this->has_grandchildren = $this->check_for_grandchildren($item->ID);
            if ($this->has_grandchildren) {
                $classes[] = 'has-mega-menu has-dropdown';
            } else {
                $classes[] = 'has-simple-dropdown has-dropdown';
            }
        }
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        if ($depth == 0) {
            $output .= '<li' . $class_names . '>';
        } elseif ($depth == 1 && $this->has_grandchildren) {
            // Column headers in mega menu - we handle in start_lvl
        } elseif ($depth >= 1) {
            $output .= '<li' . $class_names . '>';
        }
        
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        
        if ($depth == 0) {
            $atts['class'] = 'nav-item' . ($has_children ? ' dropdown-toggle' : '');
        }
        
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        $item_output = $args->before;
        
        // Check if this is a card-style item (depth >= 1 in simple dropdown OR depth >= 2 in mega menu)
        $is_card_item = ($depth >= 1 && !$this->has_grandchildren) || ($depth >= 2 && $this->has_grandchildren);
        
        if ($is_card_item) {
            // Card-style menu item with icon on left, title and description on right
            $icon_class = isset($this->item_icons[$item->title]) ? $this->item_icons[$item->title] : $this->item_icons['default'];
            $description = isset($this->item_descriptions[$item->title]) ? $this->item_descriptions[$item->title] : $this->item_descriptions['default'];
            
            $item_output .= '<a' . $attributes . '>';
            $item_output .= '<span class="menu-item-icon"><i class="' . esc_attr($icon_class) . '" aria-hidden="true"></i></span>';
            $item_output .= '<span class="menu-item-content">';
            $item_output .= '<span class="menu-item-title">' . apply_filters('the_title', $item->title, $item->ID) . '</span>';
            $item_output .= '<span class="menu-item-description">' . $description . '</span>';
            $item_output .= '</span>';
            $item_output .= '</a>';
        } else if ($depth == 1 && $this->has_grandchildren) {
            // Column header - handled in start_lvl
        } else {
            // Regular menu item (top level)
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            if ($depth == 0 && $has_children) {
                $item_output .= '<span class="dropdown-arrow"><i class="fa-solid fa-chevron-down" aria-hidden="true"></i></span>';
            }
            $item_output .= '</a>';
        }
        
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    function end_el(&$output, $item, $depth = 0, $args = null) {
        if ($depth == 0) {
            $output .= '</li>';
        } elseif ($depth == 1 && $this->has_grandchildren) {
            // Column headers don't have closing li
        } elseif ($depth >= 1) {
            $output .= '</li>';
        }
    }
    
    private function check_for_grandchildren($parent_id) {
        $menu_locations = get_nav_menu_locations();
        if (!isset($menu_locations['primary'])) {
            return false;
        }
        
        $menu_items = wp_get_nav_menu_items($menu_locations['primary']);
        if (!$menu_items) return false;
        
        // First level children
        $children = array();
        foreach ($menu_items as $item) {
            if ($item->menu_item_parent == $parent_id) {
                $children[] = $item->ID;
            }
        }
        
        // Check for grandchildren
        foreach ($children as $child_id) {
            foreach ($menu_items as $item) {
                if ($item->menu_item_parent == $child_id) {
                    return true;
                }
            }
        }
        
        return false;
    }
    
    private function get_cta_column() {
        $cta = '<div class="mega-menu-cta">';
        $cta .= '<div class="cta-icon"><i class="fa-solid fa-headset" aria-hidden="true"></i></div>';
        $cta .= '<div class="cta-title">Talk to Our Sales Team</div>';
        $cta .= '<div class="cta-description">Let\'s help you find the right hosting plan.</div>';
        $cta .= '<a href="' . esc_url(home_url('/contact/')) . '" class="cta-button">Contact Sales <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>';
        $cta .= '</div>';
        return $cta;
    }
    
    private function get_simple_dropdown_illustration() {
        $illustration = '<div class="simple-dropdown-illustration">';
        $illustration .= '<svg viewBox="0 0 520 400" xmlns="http://www.w3.org/2000/svg">';
        $illustration .= '<rect x="110" y="55" width="300" height="215" rx="14" fill="#c0000c" opacity=".9"></rect>';
        $illustration .= '<rect x="124" y="69" width="272" height="188" rx="7" fill="#fff5f5"></rect>';
        $illustration .= '<rect x="124" y="69" width="272" height="26" rx="7" fill="#fddcdc"></rect>';
        $illustration .= '<circle cx="140" cy="82" r="5" fill="#f08080" opacity=".7"></circle>';
        $illustration .= '<circle cx="156" cy="82" r="5" fill="#f08080" opacity=".7"></circle>';
        $illustration .= '<circle cx="172" cy="82" r="5" fill="#f08080" opacity=".7"></circle>';
        $illustration .= '<rect x="196" y="77" width="120" height="10" rx="4" fill="#f5b8b8"></rect>';
        $illustration .= '<rect x="137" y="107" width="160" height="10" rx="4" fill="#f5b8b8"></rect>';
        $illustration .= '<rect x="137" y="124" width="240" height="7" rx="3" fill="#fddcdc"></rect>';
        $illustration .= '<rect x="137" y="138" width="200" height="7" rx="3" fill="#fddcdc"></rect>';
        $illustration .= '<rect x="137" y="156" width="105" height="72" rx="8" fill="#fdf2f2" stroke="#f5b8b8" stroke-width="1.5"></rect>';
        $illustration .= '<rect x="150" y="168" width="60" height="8" rx="3" fill="#f08080"></rect>';
        $illustration .= '<rect x="150" y="183" width="50" height="6" rx="2" fill="#fddcdc"></rect>';
        $illustration .= '<rect x="150" y="196" width="40" height="6" rx="2" fill="#fddcdc"></rect>';
        $illustration .= '<rect x="150" y="209" width="55" height="9" rx="4" fill="#c0000c"></rect>';
        $illustration .= '<rect x="253" y="156" width="120" height="72" rx="8" fill="#f2f2f2" stroke="#ccc" stroke-width="1.5"></rect>';
        $illustration .= '<rect x="266" y="168" width="70" height="8" rx="3" fill="#555" opacity=".7"></rect>';
        $illustration .= '<rect x="266" y="183" width="55" height="6" rx="2" fill="#ddd"></rect>';
        $illustration .= '<rect x="266" y="196" width="45" height="6" rx="2" fill="#ddd"></rect>';
        $illustration .= '<rect x="266" y="209" width="55" height="9" rx="4" fill="#111"></rect>';
        $illustration .= '<rect x="233" y="270" width="54" height="28" rx="3" fill="#c0000c" opacity=".5"></rect>';
        $illustration .= '<rect x="200" y="296" width="120" height="11" rx="5" fill="#c0000c" opacity=".4"></rect>';
        $illustration .= '<ellipse cx="80" cy="254" rx="19" ry="20" fill="#fcd9a8"></ellipse>';
        $illustration .= '<ellipse cx="80" cy="242" rx="19" ry="10" fill="#2c1a0e"></ellipse>';
        $illustration .= '<rect x="60" y="274" width="40" height="58" rx="10" fill="#c0000c"></rect>';
        $illustration .= '<rect x="100" y="278" width="40" height="13" rx="6" fill="#fcd9a8" transform="rotate(-15 100 278)"></rect>';
        $illustration .= '<rect x="45" y="282" width="15" height="40" rx="6" fill="#c0000c"></rect>';
        $illustration .= '<rect x="62" y="330" width="14" height="28" rx="5" fill="#111"></rect>';
        $illustration .= '<rect x="82" y="330" width="14" height="28" rx="5" fill="#111"></rect>';
        $illustration .= '<ellipse cx="438" cy="248" rx="19" ry="20" fill="#fcd9a8"></ellipse>';
        $illustration .= '<ellipse cx="438" cy="236" rx="19" ry="10" fill="#1a1a1a"></ellipse>';
        $illustration .= '<rect x="418" y="268" width="40" height="58" rx="10" fill="#111"></rect>';
        $illustration .= '<rect x="398" y="272" width="22" height="13" rx="6" fill="#fcd9a8" transform="rotate(10 398 272)"></rect>';
        $illustration .= '<rect x="458" y="276" width="15" height="40" rx="6" fill="#111"></rect>';
        $illustration .= '<rect x="420" y="324" width="14" height="28" rx="5" fill="#333"></rect>';
        $illustration .= '<rect x="440" y="324" width="14" height="28" rx="5" fill="#333"></rect>';
        $illustration .= '<rect x="388" y="90" width="68" height="52" rx="9" fill="white" stroke="#fddcdc" stroke-width="1.5"></rect>';
        $illustration .= '<rect x="400" y="103" width="40" height="7" rx="3" fill="#f5b8b8"></rect>';
        $illustration .= '<rect x="400" y="117" width="28" height="6" rx="2" fill="#fddcdc"></rect>';
        $illustration .= '<rect x="400" y="129" width="34" height="6" rx="2" fill="#fddcdc"></rect>';
        $illustration .= '<rect x="58" y="88" width="64" height="52" rx="9" fill="white" stroke="#ddd" stroke-width="1.5"></rect>';
        $illustration .= '<circle cx="75" cy="104" r="8" fill="#c0000c" opacity=".2"></circle>';
        $illustration .= '<rect x="88" y="100" width="24" height="7" rx="3" fill="#c0000c" opacity=".5"></rect>';
        $illustration .= '<rect x="70" y="117" width="42" height="6" rx="2" fill="#eee"></rect>';
        $illustration .= '<rect x="70" y="129" width="32" height="6" rx="2" fill="#eee"></rect>';
        $illustration .= '<circle cx="355" cy="335" r="18" fill="#c0000c" opacity=".9"></circle>';
        $illustration .= '<polyline points="347,335 353,341 365,323" stroke="white" stroke-width="2.8" fill="none" stroke-linecap="round" stroke-linejoin="round"></polyline>';
        $illustration .= '<circle cx="465" cy="155" r="4" fill="#f08080" opacity=".7"></circle>';
        $illustration .= '<circle cx="479" cy="155" r="4" fill="#f08080" opacity=".5"></circle>';
        $illustration .= '<circle cx="493" cy="155" r="4" fill="#f08080" opacity=".3"></circle>';
        $illustration .= '</svg>';
        $illustration .= '</div>';
        return $illustration;
    }
}

// Mobile Menu Walker
class Mobile_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul class="mobile-submenu">';
    }
    
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $has_children = in_array('menu-item-has-children', $classes);
        if ($has_children) {
            $classes[] = 'has-children';
        }
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $output .= '<li' . $class_names . '>';
        
        $atts = array();
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';
        $atts['class'] = 'mobile-nav-item';
        
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
?>

<!-- Main Header -->
<header class="main-header">
    <!-- Sticky Main Header -->
    <div class="header-main sticky-top">
        <div class="header-container">
            <!-- Logo -->
            <div class="logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                    if ($logo) {
                        echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
                    } else {
                        echo '<h2>' . get_bloginfo('name') . '</h2>';
                    }
                    ?>
                </a>
            </div>

            <!-- Navigation Menu -->
            <nav class="main-nav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'nav-menu',
                    'fallback_cb' => false,
                    'walker' => new Mega_Menu_Walker()
                ));
                ?>
            </nav>

            <!-- Header Actions -->
            <div class="header-actions">
                <!-- Order Now Button -->
                <div class="order-now-wrapper">
                    <a href="https://billing.lwegatech.com/start-order=e5707cb90d9b02186b770d8ccea3ba1fcd01c08ae429f724" class="order-now-btn">
                        Order Now
                        <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="account-wrapper">
                    <a href="https://billing.lwegatech.com/" class="account-link">
                        <i class="bi bi-person-circle" aria-hidden="true"></i>
                    </a>
                </div>
                <!-- Search Icon -->
                <div class="search-wrapper">
                    <button class="search-toggle" id="searchToggle">
                        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                    </button>
                
                    <div class="search-dropdown" id="searchDropdown">
                        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                            <input 
                                type="search" 
                                id="header-search-input"
                                name="s" 
                                placeholder="Search here..." 
                                autocomplete="off"
                            >
                            <button type="submit">
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </form>
                
                        <div id="header-search-results"></div>
                    </div>
                </div>
                <!-- Contact Toggle Button -->
                <button class="contact-toggle" id="contactToggle">
                    <i class="bi bi-grid" aria-hidden="true"></i>
                </button>
                <button class="mobile-nav-toggle" id="mobileNavToggle">
                    <i class="bi bi-list" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Contact Canvas -->
<div class="contact-canvas" id="contactCanvas">
    <div class="contact-canvas-header">
        <h3>Contact Information</h3>
        <button class="contact-canvas-close" id="contactCanvasClose">
            <i class="fa-solid fa-xmark" aria-hidden="true"></i>
        </button>
    </div>
    
    <div class="contact-canvas-content">
        <div class="contact-info-section">
            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fa-solid fa-phone" aria-hidden="true"></i>
                </div>
                <div class="contact-details">
                    <h4>Phone Numbers</h4>
                    <a href="tel:+256777461759">+256 (0) 393 193 190</a>
                </div>
            </div>
            
            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                </div>
                <div class="contact-details">
                    <h4>Email</h4>
                    <a href="mailto:info@lwegatech.com">sales@lwegatech.com</a>
                </div>
            </div>
            
            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                </div>
                <div class="contact-details">
                    <h4>Address</h4>
                    <p>Bukenya Mall Office,<br>P.O.Box 0755, Kampala, Uganda</p>
                </div>
            </div>
            
            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fa-solid fa-clock" aria-hidden="true"></i>
                </div>
                <div class="contact-details">
                    <h4>Working Hours</h4>
                    <p>Monday - Friday: 8:00 AM - 5:00 PM</p>
                </div>
            </div>
        </div>
        
        <div class="social-section">
            <h4>Follow Us</h4>
            <div class="social-icons-grid">
                <a href="https://x.com/lwegatech" class="social-icon" title="X / Twitter" target="_blank" rel="noopener"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a>
                <a href="#" class="social-icon" title="YouTube" target="_blank" rel="noopener"><i class="fa-brands fa-youtube" aria-hidden="true"></i></a>
                <a href="https://www.linkedin.com/company/lwegatech" class="social-icon" title="LinkedIn" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin" aria-hidden="true"></i></a>
                <a href="https://www.facebook.com/lwegatech/" class="social-icon" title="Facebook" target="_blank" rel="noopener"><i class="fa-brands fa-facebook" aria-hidden="true"></i></a>
                <a href="https://www.instagram.com/lwegatech/" class="social-icon" title="Instagram" target="_blank" rel="noopener"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>

<!-- Contact Canvas Overlay -->
<div class="contact-canvas-overlay" id="contactCanvasOverlay"></div>

<!-- Mobile Navigation Menu -->
<div class="mobile-nav-menu" id="mobileNavMenu">
    <div class="mobile-nav-header">
        <h3>Menu</h3>
        <button class="mobile-nav-close" id="mobileNavClose">
            <i class="fa-solid fa-xmark" aria-hidden="true"></i>
        </button>
    </div>
    <?php
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'container' => false,
        'menu_class' => 'mobile-nav-list',
        'fallback_cb' => false,
        'walker' => new Mobile_Menu_Walker()
    ));
    ?>
    
    <!-- Mobile Account Link -->
    <div class="mobile-account-link">
        <a href="https://billing.lwegatech.com/">
            <i class="bi bi-person-circle" aria-hidden="true"></i>
            My Account
        </a>
    </div>
    
    <!-- Mobile Order Now Button -->
    <div class="mobile-order-now">
        <a href="https://billing.lwegatech.com/start-order=e5707cb90d9b02186b770d8ccea3ba1fcd01c08ae429f724" class="order-now-btn mobile">
            Order Now
            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
        </a>
    </div>
</div>

<!-- Mobile Navigation Overlay -->
<div class="mobile-nav-overlay" id="mobileNavOverlay"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Contact Canvas Toggle
    const contactToggle = document.getElementById('contactToggle');
    const contactCanvas = document.getElementById('contactCanvas');
    const contactCanvasClose = document.getElementById('contactCanvasClose');
    const contactCanvasOverlay = document.getElementById('contactCanvasOverlay');
    const mainHeader = document.querySelector('.main-header');
    
    if (contactToggle && contactCanvas && contactCanvasClose && contactCanvasOverlay) {
        contactToggle.addEventListener('click', function() {
            contactCanvas.classList.add('active');
            contactCanvasOverlay.classList.add('active');
            if (mainHeader) mainHeader.classList.add('canvas-active');
            document.body.style.overflow = 'hidden';
        });
        
        contactCanvasClose.addEventListener('click', function() {
            contactCanvas.classList.remove('active');
            contactCanvasOverlay.classList.remove('active');
            if (mainHeader) mainHeader.classList.remove('canvas-active');
            document.body.style.overflow = '';
        });
        
        contactCanvasOverlay.addEventListener('click', function() {
            contactCanvas.classList.remove('active');
            contactCanvasOverlay.classList.remove('active');
            if (mainHeader) mainHeader.classList.remove('canvas-active');
            document.body.style.overflow = '';
        });
    }
    
    // Mobile Navigation Toggle
    const mobileNavToggle = document.getElementById('mobileNavToggle');
    const mobileNavMenu = document.getElementById('mobileNavMenu');
    const mobileNavClose = document.getElementById('mobileNavClose');
    const mobileNavOverlay = document.getElementById('mobileNavOverlay');
    
    if (mobileNavToggle && mobileNavMenu && mobileNavClose && mobileNavOverlay) {
        mobileNavToggle.addEventListener('click', function() {
            mobileNavMenu.classList.add('active');
            mobileNavOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
        
        mobileNavClose.addEventListener('click', function() {
            mobileNavMenu.classList.remove('active');
            mobileNavOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        mobileNavOverlay.addEventListener('click', function() {
            mobileNavMenu.classList.remove('active');
            mobileNavOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    }
    
    // Desktop Search Toggle
    const searchToggle = document.getElementById('searchToggle');
    const searchDropdown = document.getElementById('searchDropdown');
    const searchInput = document.getElementById('header-search-input');
    
    if (searchToggle && searchDropdown) {
        searchToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            searchDropdown.classList.toggle('active');
            if (searchDropdown.classList.contains('active') && searchInput) {
                searchInput.focus();
            }
        });
    }
    
    // Close search dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (searchDropdown && searchToggle && !searchDropdown.contains(e.target) && !searchToggle.contains(e.target)) {
            searchDropdown.classList.remove('active');
        }
    });
    
    // Scroll effect
    window.addEventListener('scroll', function() {
        const header = document.querySelector('.main-header');
        if (header) {
            header.classList.toggle('scrolled', window.scrollY > 50);
        }
    });
    
    // Mobile Accordion
    const mobileMenu = document.getElementById('mobileNavMenu');
    if (mobileMenu) {
        mobileMenu.addEventListener('click', function(e) {
            const link = e.target.closest('.has-children > a');
            if (link) {
                e.preventDefault();
                const parentLi = link.parentElement;
                const submenu = parentLi.querySelector(':scope > .mobile-submenu');
                
                if (submenu) {
                    // Close other open submenus
                    parentLi.parentElement.querySelectorAll('.has-children').forEach(sibling => {
                        if (sibling !== parentLi) {
                            sibling.classList.remove('open');
                            const siblingSubmenu = sibling.querySelector(':scope > .mobile-submenu');
                            if (siblingSubmenu) siblingSubmenu.classList.remove('active');
                        }
                    });
                    
                    // Toggle current submenu
                    submenu.classList.toggle('active');
                    parentLi.classList.toggle('open');
                }
            }
        });
    }
});
</script>