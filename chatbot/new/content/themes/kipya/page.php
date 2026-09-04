<?php
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

<script>
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


    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php the_content(); ?>
        </article>
    <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>