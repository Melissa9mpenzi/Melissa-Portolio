<?php
/**
 * Tech interface hero (partial)
 * Included by `front-page.php`.
 */

// Get the most recent tech slide
$tech_query = new WP_Query([
    'post_type'      => 'tech_slides',
    'posts_per_page' => 1,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

$title = '';
$description = '';
$media_type = 'image';
$backgroundImg = '';
$video_url = '';
$video_mp4 = '';

if ($tech_query->have_posts()) {
    $tech_query->the_post();
    
    // Core Fields
    $title        = get_the_title();
    $description  = get_the_excerpt();
    
    // Media Fields
    $media_type = get_post_meta(get_the_ID(), '_tech_media_type', true);
    if (empty($media_type)) $media_type = 'image';
    
    $backgroundImg = get_the_post_thumbnail_url(get_the_ID(), 'full');
    $video_url = get_post_meta(get_the_ID(), '_tech_video_url', true);
    $video_mp4 = get_post_meta(get_the_ID(), '_tech_video_mp4', true);
    
    wp_reset_postdata();
}

// Split title for typing effect (first half static, second half dynamic)
$title_length = strlen($title);
$split_point = floor($title_length / 2);
$static_title = substr($title, 0, $split_point);
$dynamic_title = substr($title, $split_point);
?>

<div class="tech-interface">
        <div class="svg-background">
            <div class="svg-container">
                <!-- Network 1: Connected Nodes -->
                <svg class="network-svg network-1" viewBox="0 0 300 300">
                    <!-- Connection lines -->
                    <path d="M50 150 L120 80 L200 120 L250 180 L180 250 L80 220 L50 150" stroke="currentColor" fill="none" stroke-dasharray="4 6"/>
                    <path d="M120 80 L200 120 M200 120 L250 180 M180 250 L80 220 M80 220 L50 150" stroke="currentColor" fill="none" stroke-width="1"/>
                    
                    <!-- Nodes -->
                    <circle cx="50" cy="150" r="6" stroke="currentColor" fill="none"/>
                    <circle cx="120" cy="80" r="6" stroke="currentColor" fill="none"/>
                    <circle cx="200" cy="120" r="6" stroke="currentColor" fill="none"/>
                    <circle cx="250" cy="180" r="6" stroke="currentColor" fill="none"/>
                    <circle cx="180" cy="250" r="6" stroke="currentColor" fill="none"/>
                    <circle cx="80" cy="220" r="6" stroke="currentColor" fill="none"/>
                    
                    <!-- Additional connections -->
                    <path d="M120 80 L80 220 M200 120 L180 250 M250 180 L50 150" stroke="currentColor" fill="none" stroke-dasharray="3 8" opacity="0.6"/>
                </svg>

                <!-- Network 2: Mesh Network -->
                <svg class="network-svg network-2" viewBox="0 0 300 300">
                    <!-- Central hub with spokes -->
                    <circle cx="150" cy="150" r="12" stroke="currentColor" fill="none"/>
                    
                    <path d="M150 150 L50 50 M150 150 L250 70 M150 150 L220 240 M150 150 L60 230" stroke="currentColor" fill="none"/>
                    
                    <circle cx="50" cy="50" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="250" cy="70" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="220" cy="240" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="60" cy="230" r="5" stroke="currentColor" fill="none"/>
                    
                    <!-- Interconnections -->
                    <path d="M50 50 L250 70 M250 70 L220 240 M220 240 L60 230 M60 230 L50 50" stroke="currentColor" fill="none" stroke-dasharray="5 5" opacity="0.5"/>
                </svg>

                <!-- Network 3: Grid Pattern -->
                <svg class="network-svg network-3" viewBox="0 0 300 300">
                    <!-- Grid lines -->
                    <path d="M50 50 L250 50 M50 120 L250 120 M50 190 L250 190 M50 260 L250 260" stroke="currentColor" fill="none" opacity="0.4"/>
                    <path d="M50 50 L50 260 M120 50 L120 260 M190 50 L190 260 M260 50 L260 260" stroke="currentColor" fill="none" opacity="0.4"/>
                    
                    <!-- Nodes at intersections -->
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
                    
                    <!-- Diagonal connections -->
                    <path d="M50 50 L260 260 M260 50 L50 260" stroke="currentColor" fill="none" stroke-dasharray="6 6" opacity="0.3"/>
                </svg>

                <!-- Network 4: Tree/Branch Structure -->
                <svg class="network-svg network-4" viewBox="0 0 300 300">
                    <!-- Main trunk/branch -->
                    <path d="M150 40 L150 260" stroke="currentColor" fill="none"/>
                    
                    <!-- Branches -->
                    <path d="M150 100 L80 150 M150 100 L220 150" stroke="currentColor" fill="none"/>
                    <path d="M150 180 L70 220 M150 180 L230 220" stroke="currentColor" fill="none"/>
                    
                    <!-- Branch off branches -->
                    <path d="M80 150 L40 120 M80 150 L40 180" stroke="currentColor" fill="none" opacity="0.5"/>
                    <path d="M220 150 L260 120 M220 150 L260 180" stroke="currentColor" fill="none" opacity="0.5"/>
                    
                    <!-- Nodes -->
                    <circle cx="150" cy="40" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="150" cy="260" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="150" cy="100" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="150" cy="180" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="80" cy="150" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="220" cy="150" r="4" stroke="currentColor" fill="none"/>
                    <circle cx="40" cy="120" r="3" stroke="currentColor" fill="none"/>
                    <circle cx="40" cy="180" r="3" stroke="currentColor" fill="none"/>
                    <circle cx="260" cy="120" r="3" stroke="currentColor" fill="none"/>
                    <circle cx="260" cy="180" r="3" stroke="currentColor" fill="none"/>
                </svg>

                <!-- Network 5: Circular/Web Pattern -->
                <svg class="network-svg network-5" viewBox="0 0 300 300">
                    <!-- Concentric circles -->
                    <circle cx="150" cy="150" r="40" stroke="currentColor" fill="none" opacity="0.4"/>
                    <circle cx="150" cy="150" r="80" stroke="currentColor" fill="none" opacity="0.4"/>
                    <circle cx="150" cy="150" r="120" stroke="currentColor" fill="none" opacity="0.4"/>
                    
                    <!-- Radial lines -->
                    <path d="M150 30 L150 270" stroke="currentColor" fill="none" opacity="0.3"/>
                    <path d="M30 150 L270 150" stroke="currentColor" fill="none" opacity="0.3"/>
                    <path d="M70 70 L230 230" stroke="currentColor" fill="none" opacity="0.3"/>
                    <path d="M230 70 L70 230" stroke="currentColor" fill="none" opacity="0.3"/>
                    
                    <!-- Nodes -->
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

                <!-- Network 6: Random Connections -->
                <svg class="network-svg network-6" viewBox="0 0 300 300">
                    <!-- Random connection web -->
                    <path d="M40 80 L120 40 L200 70 L260 120 L230 200 L160 250 L70 220 L40 150 L40 80" stroke="currentColor" fill="none" stroke-dasharray="3 4"/>
                    
                    <!-- Internal connections -->
                    <path d="M120 40 L200 70 M200 70 L230 200 M230 200 L160 250 M160 250 L70 220 M70 220 L40 150 M40 150 L120 40" stroke="currentColor" fill="none"/>
                    
                    <!-- Cross connections -->
                    <path d="M120 40 L160 250 M200 70 L70 220 M40 80 L230 200 M260 120 L70 220" stroke="currentColor" fill="none" opacity="0.5"/>
                    
                    <!-- Nodes -->
                    <circle cx="40" cy="80" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="120" cy="40" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="200" cy="70" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="260" cy="120" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="230" cy="200" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="160" cy="250" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="70" cy="220" r="5" stroke="currentColor" fill="none"/>
                    <circle cx="40" cy="150" r="5" stroke="currentColor" fill="none"/>
                </svg>
                <!-- Network 7: Spiral Web -->
<svg class="network-svg network-7" viewBox="0 0 300 300" stroke="#909090">
    <path d="M150 30 L150 270 M30 150 L270 150" stroke="currentColor" fill="none" opacity="0.3"/>
    <path d="M70 70 L230 230 M230 70 L70 230" stroke="currentColor" fill="none" opacity="0.3"/>
    <circle cx="150" cy="150" r="40" stroke="currentColor" fill="none" opacity="0.4"/>
    <circle cx="150" cy="150" r="80" stroke="currentColor" fill="none" opacity="0.4"/>
    <circle cx="150" cy="150" r="120" stroke="currentColor" fill="none" opacity="0.4"/>
    <circle cx="150" cy="60" r="4" stroke="currentColor" fill="none"/>
    <circle cx="150" cy="240" r="4" stroke="currentColor" fill="none"/>
    <circle cx="60" cy="150" r="4" stroke="currentColor" fill="none"/>
    <circle cx="240" cy="150" r="4" stroke="currentColor" fill="none"/>
    <circle cx="100" cy="100" r="4" stroke="currentColor" fill="none"/>
    <circle cx="200" cy="200" r="4" stroke="currentColor" fill="none"/>
    <circle cx="100" cy="200" r="4" stroke="currentColor" fill="none"/>
    <circle cx="200" cy="100" r="4" stroke="currentColor" fill="none"/>
    <path d="M150 60 L100 100 M150 60 L200 100 M150 240 L100 200 M150 240 L200 200 M60 150 L100 100 M60 150 L100 200 M240 150 L200 100 M240 150 L200 200" stroke="currentColor" fill="none" opacity="0.5"/>
</svg>

<!-- Network 8: Fractal Tree -->
<svg class="network-svg network-8" viewBox="0 0 300 300" stroke="#909090">
    <path d="M150 250 L150 150 M150 150 L100 100 M150 150 L200 100" stroke="currentColor" fill="none" stroke-width="1.5"/>
    <path d="M100 100 L70 60 M100 100 L130 60 M200 100 L170 60 M200 100 L230 60" stroke="currentColor" fill="none" opacity="0.6"/>
    <path d="M70 60 L50 30 M70 60 L90 30 M130 60 L110 30 M130 60 L150 30 M170 60 L150 30 M170 60 L190 30 M230 60 L210 30 M230 60 L250 30" stroke="currentColor" fill="none" opacity="0.4"/>
    <circle cx="150" cy="250" r="6" stroke="currentColor" fill="none"/>
    <circle cx="150" cy="150" r="5" stroke="currentColor" fill="none"/>
    <circle cx="100" cy="100" r="4" stroke="currentColor" fill="none"/>
    <circle cx="200" cy="100" r="4" stroke="currentColor" fill="none"/>
    <circle cx="70" cy="60" r="3" stroke="currentColor" fill="none"/>
    <circle cx="130" cy="60" r="3" stroke="currentColor" fill="none"/>
    <circle cx="170" cy="60" r="3" stroke="currentColor" fill="none"/>
    <circle cx="230" cy="60" r="3" stroke="currentColor" fill="none"/>
</svg>
            </div>
        </div>

        <!-- Additional Connection Lines Overlay -->
        <div class="connection-lines"></div>

        <!-- Grid Lines Overlay -->
        <div class="grid-lines"></div>

        <!-- Content Overlay -->
        <div class="content-overlay">
            <div class="content-container">
                <!-- Left Column - Main Content (Full Width) -->
                <div class="left-column">
                    <div class="text-content">
                        <!-- Title with Dynamic Part -->
                        <?php if (!empty($title)): ?>
                        <div class="big-title">
                            <h1>
                                <span class="static-part"><?= esc_html($static_title) ?></span>
                                <span class="dynamic-part" id="dynamicTitle"></span>
                            </h1>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Two Column Row for Description, Buttons, and Video -->
                        <div class="content-row">
                            <!-- Left Column of Row: Description and Buttons -->
                            <div class="content-col">
                                <?php if (!empty($description)): ?>
                                <div class="big-description">
                                    <p><?= esc_html($description) ?></p>
                                </div>
                                <?php endif; ?>
                                
                                <!-- Full Color Buttons -->
                                <div class="tech-buttons">
                                    <a href="<?php echo kipya_url_for_path('web-solutions'); ?>" class="tech-button primary">View Our Packages</a>
                                    <a href="<?php echo kipya_url_for_path('contact'); ?>" class="tech-button secondary">Lets Talk</a>
                                </div>
                            </div>
                            
                            <!-- Right Column of Row: Video -->
                            <div class="video-col">
                                <div class="video-wrapper">
                                    <div class="video-container">
                                        <?php if ($media_type === 'youtube' && $video_url): ?>
                                            <?php
                                            // Extract YouTube ID
                                            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video_url, $matches);
                                            $youtube_id = isset($matches[1]) ? $matches[1] : '';
                                            if ($youtube_id):
                                            ?>
                                            <iframe src="https://www.youtube.com/embed/<?= $youtube_id ?>?autoplay=1&mute=0&loop=1&playlist=<?= $youtube_id ?>&controls=0&showinfo=0&rel=0&modestbranding=1&iv_load_policy=3" 
                                                    frameborder="0" 
                                                    allow="autoplay; encrypted-media" 
                                                    allowfullscreen>
                                            </iframe>
                                            <?php endif; ?>
                                        
                                        <?php elseif ($media_type === 'mp4' && $video_mp4): ?>
                                            <video autoplay muted loop playsinline>
                                                <source src="<?= esc_url($video_mp4) ?>" type="video/mp4">
                                            </video>
                                        
                                        <?php elseif ($media_type === 'image' && $backgroundImg): ?>
                                            <img src="<?= esc_url($backgroundImg) ?>" alt="<?= esc_attr($title) ?>" class="fallback-image">
                                        
                                        <?php else: ?>
                                            <div style="width:100%; height:100%; background:#111; display:flex; align-items:center; justify-content:center; color:#333;">
                                                <p>No media selected</p>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="video-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Typing effect for dynamic part of title
    document.addEventListener('DOMContentLoaded', function() {
        const dynamicElement = document.getElementById('dynamicTitle');
        const fullDynamicText = "<?= esc_js($dynamic_title) ?>";
        
        if (dynamicElement && fullDynamicText) {
            let index = 0;
            let isDeleting = false;
            let currentText = '';
            
            function typeEffect() {
                if (isDeleting) {
                    // Deleting characters
                    currentText = fullDynamicText.substring(0, currentText.length - 1);
                    dynamicElement.textContent = currentText;
                    
                    if (currentText === '') {
                        isDeleting = false;
                        setTimeout(typeEffect, 500); // Pause before typing again
                        return;
                    }
                } else {
                    // Typing characters
                    currentText = fullDynamicText.substring(0, currentText.length + 1);
                    dynamicElement.textContent = currentText;
                    
                    if (currentText === fullDynamicText) {
                        isDeleting = true;
                        setTimeout(typeEffect, 2000); // Pause at full text
                        return;
                    }
                }
                
                // Speed control: faster when deleting, slower when typing
                const speed = isDeleting ? 50 : 150;
                setTimeout(typeEffect, speed);
            }
            
            // Start the effect
            typeEffect();
        }

        // Ensure videos loop properly
        const videos = document.querySelectorAll('video');
        videos.forEach(video => {
            video.loop = true;
            video.play().catch(e => console.log('Autoplay prevented:', e));
        });
    });
    </script>

</div>