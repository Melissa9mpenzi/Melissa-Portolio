<?php
function allPartners_shortcode($atts) {
    ob_start(); // Start output buffering
    
    $atts = shortcode_atts(
        array(
            'category' => '', // Default to empty string if not specified
            'number' => 40, // Default number of posts per page (increased for more logos)
            'order' => 'RAND', //Default Descending order
        ),
        $atts,
        'partner'
    );

    // Custom query to retrieve Partners
    $partners_args = array(
        'post_type' => 'partner',
        'posts_per_page' => $atts['number'], // Number of posts per page
        'orderby' => 'date', // Order by date
        'order' => $atts['order'], // order
    );

    // Check if category attribute is provided and not empty
    if (!empty($atts['category'])) {
        $partners_args['tax_query'] = array(
            array(
                'taxonomy' => 'partner_category',
                'field' => 'slug',
                'terms' => $atts['category'],
            ),
        );
    }

    $partners_query = new WP_Query($partners_args);
    
    // Collect all partners for the logo grid
    $all_partners = array();
    if ($partners_query->have_posts()) {
        $all_partners = $partners_query->posts;
    }
    ?>
    
    <!-- Statistics Section with + and % signs -->
    <div class="kpy-stats-section">
		<div class="kpy-sg-header">
            <div class="kpy-sg-title-container">
                <div class="kpy-sg-title-bg" aria-hidden="true">
                    Aiming Higher
                </div>

                <!-- MAIN TITLE -->
                <h2 class="kpy-sg-title">
                    <span class="kpy-sg-title-red">Our</span>
                    <span class="kpy-sg-title-white">Impact</span>
                </h2>
            </div>
        </div>
        <div class="container">
            <div class="kpy-stats-wrapper">
                <div class="kpy-stat-item">
                    <div class="kpy-stat-number" data-count="16" data-type="years">0</div>
                    <div class="kpy-stat-label">Years</div>
                </div>
                <div class="kpy-stat-item">
                    <div class="kpy-stat-number" data-count="5" data-type="countries">0</div>
                    <div class="kpy-stat-label">Countries</div>
                </div>
                <div class="kpy-stat-item">
                    <div class="kpy-stat-number" data-count="1500" data-type="websites">0</div>
                    <div class="kpy-stat-label">Websites</div>
                </div>
                <div class="kpy-stat-item">
                    <div class="kpy-stat-number" data-count="60" data-type="repeat">0</div>
                    <div class="kpy-stat-label">Repeat Business</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logo Sliders Section - Each logo container now has gradient on all 4 sides and is smaller -->
    <div class="kpy-logos-sliders">
        <div class="container">
            <?php if (!empty($all_partners)) : ?>
                <!-- Each row is a separate infinite slider -->
                <?php
                // Split partners into rows of max 10 logos each
                $rows = array_chunk($all_partners, 10);
                $row_count = 0;
                foreach ($rows as $row_partners) :
                    $direction_class = ($row_count % 2 == 0) ? 'kpy-slider-right' : 'kpy-slider-left';
                ?>
                <div class="kpy-logo-slider-wrapper <?php echo $direction_class; ?>">
                    <div class="kpy-logo-slider">
                        <div class="kpy-logo-track">
                            <!-- Original set of logos for this row -->
                            <?php foreach($row_partners as $partner) : 
                                $link = get_post_meta($partner->ID, '_website', true);
                                $logo_url = get_the_post_thumbnail_url($partner->ID, 'medium');
                                if (!$logo_url) {
                                    $logo_url = get_template_directory_uri() . '/assets/images/photo-placeholder.jpg';
                                }
                            ?>
                                <div class="kpy-logo-item">
                                    <?php if ($link) : ?>
                                        <a href="<?= esc_url($link); ?>" target="_blank" rel="noopener noreferrer">
                                            <img src="<?= esc_url($logo_url); ?>" alt="<?= esc_attr($partner->post_title); ?>">
                                        </a>
                                    <?php else : ?>
                                        <img src="<?= esc_url($logo_url); ?>" alt="<?= esc_attr($partner->post_title); ?>">
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                            
                            <!-- Duplicate set for seamless infinite loop -->
                            <?php foreach($row_partners as $partner) : 
                                $link = get_post_meta($partner->ID, '_website', true);
                                $logo_url = get_the_post_thumbnail_url($partner->ID, 'medium');
                                if (!$logo_url) {
                                    $logo_url = get_template_directory_uri() . '/assets/images/photo-placeholder.jpg';
                                }
                            ?>
                                <div class="kpy-logo-item">
                                    <?php if ($link) : ?>
                                        <a href="<?= esc_url($link); ?>" target="_blank" rel="noopener noreferrer">
                                            <img src="<?= esc_url($logo_url); ?>" alt="<?= esc_attr($partner->post_title); ?>">
                                        </a>
                                    <?php else : ?>
                                        <img src="<?= esc_url($logo_url); ?>" alt="<?= esc_attr($partner->post_title); ?>">
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php 
                $row_count++;
                endforeach; 
                ?>
            <?php else : ?>
                <p>No Partners found.</p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>



    <script>
    (function() {
        // Add gradient span elements for LEFT and RIGHT gradients dynamically
        // This ensures each logo item has the left and right gradient layers
        function addSideGradients() {
            const logoItems = document.querySelectorAll('.kpy-logo-item');
            logoItems.forEach(item => {
                // Check if gradients already exist to avoid duplicates
                if (!item.querySelector('.logo-left-gradient')) {
                    const leftGrad = document.createElement('span');
                    leftGrad.className = 'logo-left-gradient';
                    item.appendChild(leftGrad);
                }
                if (!item.querySelector('.logo-right-gradient')) {
                    const rightGrad = document.createElement('span');
                    rightGrad.className = 'logo-right-gradient';
                    item.appendChild(rightGrad);
                }
            });
        }
        
        // Stats counter on scroll with + and % signs
        const statNumbers = document.querySelectorAll('.kpy-stat-number');
        let hasAnimated = false;
        
        function animateNumbers() {
            if (hasAnimated) return;
            
            const statsSection = document.querySelector('.kpy-stats-section');
            if (!statsSection) return;
            
            const sectionPosition = statsSection.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.3;
            
            if (sectionPosition < screenPosition) {
                hasAnimated = true;
                
                statNumbers.forEach(stat => {
                    const targetCount = parseInt(stat.getAttribute('data-count'));
                    const statType = stat.getAttribute('data-type');
                    if (isNaN(targetCount)) return;
                    
                    let currentCount = 0;
                    const duration = 2000; // 2 seconds
                    const increment = targetCount / (duration / 16); // 60fps approx
                    const label = stat.parentElement?.querySelector('.kpy-stat-label')?.innerText;
                    
                    // Determine suffix based on stat type
                    let suffix = '';
                    if (statType === 'countries') {
                        suffix = '+';
                    } else if (statType === 'websites') {
                        suffix = '+';
                    } else if (statType === 'repeat') {
                        suffix = '%';
                    } else {
                        suffix = '';
                    }
                    
                    const updateCounter = () => {
                        currentCount += increment;
                        if (currentCount < targetCount) {
                            let displayValue = Math.floor(currentCount);
                            if (targetCount >= 1000 && suffix !== '%') {
                                stat.innerText = displayValue.toLocaleString() + suffix;
                            } else {
                                stat.innerText = displayValue + suffix;
                            }
                            requestAnimationFrame(updateCounter);
                        } else {
                            // Final value with proper formatting
                            if (targetCount >= 1000 && suffix !== '%') {
                                stat.innerText = targetCount.toLocaleString() + suffix;
                            } else {
                                stat.innerText = targetCount + suffix;
                            }
                        }
                    };
                    
                    // Set initial value with suffix
                    if (suffix === '+') {
                        stat.innerText = '0+';
                    } else if (suffix === '%') {
                        stat.innerText = '0%';
                    } else {
                        stat.innerText = '0';
                    }
                    
                    requestAnimationFrame(updateCounter);
                });
            }
        }
        
        // Initialize gradients after DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                addSideGradients();
                // Also watch for dynamic content (in case slider clones cause issues)
                const observer = new MutationObserver(function(mutations) {
                    addSideGradients();
                });
                observer.observe(document.body, { childList: true, subtree: true });
            });
        } else {
            addSideGradients();
        }
        
        // Check on scroll and load
        window.addEventListener('scroll', animateNumbers);
        window.addEventListener('load', () => {
            animateNumbers();
            addSideGradients();
        });
        
        // Ensure infinite loop works properly
        const sliders = document.querySelectorAll('.kpy-logo-track');
        sliders.forEach(slider => {
            // No manual intervention needed - CSS animation handles infinite loop
        });
    })();
    </script>

    <?php
    return ob_get_clean(); // Return the buffered content
}

add_shortcode('all_funders', 'allPartners_shortcode');
?>