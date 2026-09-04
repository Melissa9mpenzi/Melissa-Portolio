<?php
/**
 * Template Name: Alternative Contact Page Template
 *
 * @package Kipya
 */

get_header();
include get_template_directory() . '/inc/menus/menu.php';

if (isset($_POST['contact_submitted'])) {
    $name    = sanitize_text_field($_POST['contact_name']);
    $email   = sanitize_email($_POST['contact_email']);
    $phone   = sanitize_text_field($_POST['contact_phone']);
    $subject = sanitize_text_field($_POST['contact_subject']);
    $message = sanitize_textarea_field($_POST['contact_message']);

    $post_content  = "Name: $name\n";
    $post_content .= "Email: $email\n";
    $post_content .= "Phone: $phone\n";
    $post_content .= "Subject: $subject\n\n";
    $post_content .= "Message:\n$message";

    $post_id = wp_insert_post(array(
        'post_title'   => 'New Contact: ' . $name . ' - ' . $subject,
        'post_content' => $post_content,
        'post_status'  => 'private',
        'post_type'    => 'contact_submission',
    ));

    if ($post_id) { $submission_success = true; }
}
?>

<main role="main" class="kct-main">

    <!-- ══════════════ HERO ══════════════ -->
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

    <!-- ══════════════ DEPARTMENT CARDS ══════════════ -->
    <section class="kct-dept-section kct-dark-waves">
        <div class="container">
            <div class="columns is-multiline kct-dept-grid">

                <!-- Client Support -->
                <div class="column is-4">
                    <div class="kct-dept-card">
                        <div class="kct-dept-num">01</div>
                        <div class="kct-dept-icon-wrap"><i class="bi bi-headset"></i></div>
                        <h3 class="kct-dept-title">Client Support</h3>
                        <p class="kct-dept-tagline">Email, cPanel/WHM, DNS, etc.</p>
                        <div class="kct-dept-divider"></div>
                        <ul class="kct-dept-info">
                            <li><i class="bi bi-telephone-fill"></i><span>+256 393 193 190 | +256 779 918835</span></li>
                            <li><i class="bi bi-envelope-fill"></i><a href="mailto:support@lwegatech.com">support@lwegatech.com</a></li>
                            <li><i class="bi bi-clock-fill"></i><span>7AM – 6PM</span></li>
                        </ul>
                        <a href="mailto:support@lwegatech.com" class="kct-dept-btn">Email Support <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Sales Center -->
                <div class="column is-4">
                    <div class="kct-dept-card kct-dept-featured">
                        <div class="kct-dept-popular"><i class="bi bi-star-fill"></i> Most Queries</div>
                        <div class="kct-dept-num">02</div>
                        <div class="kct-dept-icon-wrap"><i class="bi bi-cart3"></i></div>
                        <h3 class="kct-dept-title">Sales Center</h3>
                        <p class="kct-dept-tagline">Domains, Websites, Hosting, Apps</p>
                        <div class="kct-dept-divider"></div>
                        <ul class="kct-dept-info">
                            <li><i class="bi bi-telephone-fill"></i><span>+256 393 193 190 | +256 779 918835 | +256 701 918835</span></li>
                            <li><i class="bi bi-envelope-fill"></i><a href="mailto:sales@lwegatech.com">sales@lwegatech.com</a></li>
                            <li><i class="bi bi-clock-fill"></i><span>24/7 Available</span></li>
                        </ul>
                        <a href="mailto:sales@lwegatech.com" class="kct-dept-btn kct-dept-btn-featured">Contact Sales <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Account + Billing -->
                <div class="column is-4">
                    <div class="kct-dept-card">
                        <div class="kct-dept-num">03</div>
                        <div class="kct-dept-icon-wrap"><i class="bi bi-credit-card-fill"></i></div>
                        <h3 class="kct-dept-title">Account + Billing</h3>
                        <p class="kct-dept-tagline">Account Management, Domains &amp; Billing</p>
                        <div class="kct-dept-divider"></div>
                        <ul class="kct-dept-info">
                            <li><i class="bi bi-telephone-fill"></i><span>+256 393 193 190 | +256 777 305812 | +256 701 918835</span></li>
                            <li><i class="bi bi-envelope-fill"></i><a href="mailto:billing@lwegatech.com">billing@lwegatech.com</a></li>
                            <li><i class="bi bi-clock-fill"></i><span>7AM – 6PM</span></li>
                        </ul>
                        <a href="mailto:billing@lwegatech.com" class="kct-dept-btn">Billing Enquiry <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Web + Cloud Services -->
                <div class="column is-4">
                    <div class="kct-dept-card">
                        <div class="kct-dept-num">04</div>
                        <div class="kct-dept-icon-wrap"><i class="bi bi-cloud-fill"></i></div>
                        <h3 class="kct-dept-title">Web + Cloud Services</h3>
                        <p class="kct-dept-tagline">Websites, Updates, Apps</p>
                        <div class="kct-dept-divider"></div>
                        <ul class="kct-dept-info">
                            <li><i class="bi bi-telephone-fill"></i><span>+256 393 193 190 | +256 779 918835</span></li>
                            <li><i class="bi bi-envelope-fill"></i><a href="mailto:sales@lwegatech.com">sales@lwegatech.com</a></li>
                            <li><i class="bi bi-clock-fill"></i><span>7AM – 6PM</span></li>
                        </ul>
                        <a href="mailto:sales@lwegatech.com" class="kct-dept-btn">Get In Touch <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Jobs & Careers -->
                <div class="column is-4">
                    <div class="kct-dept-card kct-dept-careers">
                        <div class="kct-dept-num">05</div>
                        <div class="kct-dept-icon-wrap"><i class="bi bi-briefcase-fill"></i></div>
                        <h3 class="kct-dept-title">Jobs &amp; Careers</h3>
                        <p class="kct-dept-tagline">We're fun, cutting edge and growing daily.</p>
                        <div class="kct-dept-divider"></div>
                        <p class="kct-dept-careers-text">Interested in working with us? Be on the lookout for exciting career opportunities at Lwegatech. We will always announce any openings.</p>
                        <a href="#kct-contact-form" class="kct-dept-btn">Express Interest <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Report Abuse -->
                <div class="column is-4">
                    <div class="kct-dept-card kct-dept-abuse">
                        <div class="kct-dept-num">06</div>
                        <div class="kct-dept-icon-wrap"><i class="bi bi-shield-exclamation"></i></div>
                        <h3 class="kct-dept-title">Report Abuse</h3>
                        <p class="kct-dept-tagline">Report any kind of abuse right away!</p>
                        <div class="kct-dept-divider"></div>
                        <ul class="kct-dept-info">
                            <li><i class="bi bi-telephone-fill"></i><span>+256 779 918835 | +256 701 918835</span></li>
                            <li><i class="bi bi-envelope-fill"></i><a href="mailto:admin@lwegatech.com">admin@lwegatech.com</a></li>
                        </ul>
                        <a href="mailto:admin@lwegatech.com" class="kct-dept-btn kct-dept-btn-abuse">Report Now <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<!-- ══════════════ STYLES ══════════════ -->
<style>
/* ─── Root Tokens ─── */
:root { --kpy-font-body:"montserrat",sans-serif; --kpy-font-heading:"montserrat",sans-serif; --kpy-primary:#d90000; --kpy-primary-rgb:215,0,0; --kpy-secondary:#000000; --kpy-white:#ffffff; }
body,html { background-color:#000000 !important; background:#000000 !important; }
body { font-family:var(--kpy-font-body); }
h1,h2,h3,h4,h5,h6 { font-family:var(--kpy-font-heading); }
.kct-main { background:#000; }
.kct-main *,.kct-main img { border-radius:0 !important; box-sizing:border-box; }
.kct-red { color:var(--kpy-primary); }

/* ─── Section Labels ─── */
.kct-section-label { display:flex; align-items:center; justify-content:center; gap:12px; margin-bottom:1rem; font-size:0.72rem; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:var(--kpy-primary); }
.kct-label-line { display:inline-block; height:2px; width:40px; background:var(--kpy-primary); flex-shrink:0; }
.kct-section-title { font-size:clamp(2rem,4vw,2.8rem); font-weight:900; color:#fff; text-transform:uppercase; letter-spacing:-0.03em; line-height:1.1; margin-bottom:1rem; }
.kct-section-sub { color:#aaa; font-size:1rem; max-width:500px; margin:0 auto 4rem; }

/* ─── Hero ─── */
.hosting-hero { position:relative; min-height:400px; display:flex; align-items:center; background:#050505; overflow:hidden; padding:6rem 0 0; }
.hero-black-background { position:absolute; inset:0; background:linear-gradient(135deg,#050505 0%,#0d0d0d 60%,#0a0005 100%); z-index:0; }
.svg-background { position:absolute; inset:0; overflow:hidden; z-index:1; color:rgba(215,0,0,0.1); }
.svg-container { position:absolute; inset:0; display:grid; grid-template-columns:repeat(5,1fr); grid-template-rows:1fr; }
.network-svg { width:100%; height:100%; }
.network-1 { animation:netFloat 18s ease-in-out infinite; }
.network-2 { animation:netFloat 22s ease-in-out infinite reverse 1s; }
.network-3 { animation:netFloat 26s ease-in-out infinite 2s; }
.network-4 { animation:netFloat 20s ease-in-out infinite reverse 3s; }
.network-5 { animation:netFloat 24s ease-in-out infinite 4s; }
@keyframes netFloat { 0%,100% { transform:translate(0,0); } 50% { transform:translate(6px,-6px); } }
.connection-lines { position:absolute; inset:0; z-index:1; background-image:linear-gradient(rgba(215,0,0,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(215,0,0,0.03) 1px,transparent 1px); background-size:80px 80px; }
.grid-lines { position:absolute; inset:0; z-index:1; background-image:linear-gradient(rgba(255,255,255,0.015) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.015) 1px,transparent 1px); background-size:40px 40px; }
.hero-overlay { position:relative; z-index:2; width:100%; padding-bottom:0; }
.hero-content-wrapper { display:flex; align-items:center; gap:3rem; padding-bottom:3rem; }
.hero-badge { display:inline-flex; align-items:center; gap:8px; background:rgba(215,0,0,0.12); border:1px solid rgba(215,0,0,0.35); color:#ff3344; padding:7px 18px; font-size:0.72rem; font-weight:700; letter-spacing:2px; text-transform:uppercase; margin-bottom:1rem; }
.kpy-sg-title { font-size:clamp(2.2rem,5vw,4rem); font-weight:900; color:#fff; line-height:1.05; letter-spacing:-0.04em; text-transform:uppercase; margin:0 0 0.5rem; }
.hero-sub { color:rgba(255,255,255,0.5); font-size:1rem; margin:0; }
.hero-text-content { flex:1; }

.feature-circles-wrapper { border-top:1px solid rgba(215,0,0,0.2); background:rgba(215,0,0,0.04); padding:1.4rem 0; }
.feature-circles { display:flex; align-items:center; justify-content:space-around; flex-wrap:wrap; gap:1rem; }
.feature-circle { display:flex; align-items:center; gap:8px; color:rgba(255,255,255,0.7); font-size:0.78rem; font-weight:600; letter-spacing:0.5px; text-transform:uppercase; }
.feature-circle i { color:var(--kpy-primary); font-size:1.1rem; }

/* ─── Dark Waves BG ─── */
.kct-dark-waves { position:relative; }
.kct-dark-waves::before { content:""; position:absolute; inset:0; background-image:repeating-linear-gradient(45deg,rgba(215,0,0,0.022) 0px,rgba(215,0,0,0.022) 2px,transparent 2px,transparent 18px); pointer-events:none; z-index:0; }
.kct-dark-waves > .container { position:relative; z-index:1; }

/* ─── Department Section ─── */
.kct-dept-section { padding:6rem 0; background:#060606; border-top:1px solid #111; }
.kct-dept-grid { margin-top:0; }

/* WHITE card base */
.kct-dept-card { background:#ffffff; border:none; border-top:4px solid var(--kpy-primary); padding:2.5rem 2rem; height:100%; display:flex; flex-direction:column; position:relative; overflow:hidden; transition:transform 0.25s,box-shadow 0.25s; box-shadow:0 2px 20px rgba(0,0,0,0.35); }
.kct-dept-card::after { content:''; position:absolute; inset:0; background:radial-gradient(ellipse at top left,rgba(215,0,0,0.04) 0%,transparent 60%); pointer-events:none; }
.kct-dept-card:hover { transform:translateY(-6px); box-shadow:0 16px 48px rgba(0,0,0,0.5),0 0 0 2px var(--kpy-primary); }

/* Featured (Sales) — white with stronger red accent */
.kct-dept-featured { background:#ffffff; border-top:4px solid var(--kpy-primary); box-shadow:0 4px 30px rgba(217,0,0,0.2),0 2px 20px rgba(0,0,0,0.3); }
.kct-dept-featured:hover { box-shadow:0 16px 48px rgba(217,0,0,0.35),0 0 0 2px var(--kpy-primary); }
.kct-dept-popular { display:inline-flex; align-items:center; gap:6px; background:var(--kpy-primary); color:#fff; font-size:0.68rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:5px 12px; margin-bottom:1.2rem; align-self:flex-start; }

/* Careers card — gold accent */
.kct-dept-careers { border-top-color:#d4a000; }
.kct-dept-careers:hover { box-shadow:0 16px 48px rgba(212,160,0,0.2),0 0 0 2px #d4a000; }
.kct-dept-careers .kct-dept-icon-wrap { background:rgba(212,160,0,0.1); border-color:rgba(212,160,0,0.4); }
.kct-dept-careers .kct-dept-icon-wrap i { color:#b8860b; }
.kct-dept-careers-text { color:#666; font-size:0.88rem; line-height:1.6; margin:0 0 1.5rem; flex:1; }
.kct-dept-careers .kct-dept-btn { color:#b8860b; border-color:#d4a000; }
.kct-dept-careers .kct-dept-btn:hover { background:#d4a000; border-color:#d4a000; color:#000; }

/* Abuse card — darker red top */
.kct-dept-abuse { border-top-color:#a00; }

/* Card number watermark */
.kct-dept-num { position:absolute; top:1.5rem; right:1.5rem; font-size:3.5rem; font-weight:900; color:rgba(0,0,0,0.06); line-height:1; font-family:var(--kpy-font-heading); }

/* Icon block */
.kct-dept-icon-wrap { width:60px; height:60px; background:rgba(217,0,0,0.08); border:2px solid rgba(217,0,0,0.25); display:flex; align-items:center; justify-content:center; margin-bottom:1.4rem; transition:background 0.2s,border-color 0.2s,transform 0.2s; }
.kct-dept-icon-wrap i { color:var(--kpy-primary); font-size:1.6rem; }
.kct-dept-card:hover .kct-dept-icon-wrap { background:var(--kpy-primary); border-color:var(--kpy-primary); transform:scale(1.08); }
.kct-dept-card:hover .kct-dept-icon-wrap i { color:#fff; }

/* Card text — dark on white */
.kct-dept-title { font-size:1.05rem; font-weight:800; color:#0a0a0a; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.3rem; }
.kct-dept-tagline { color:#888; font-size:0.82rem; margin-bottom:1.2rem; }
.kct-dept-divider { height:2px; background:rgba(217,0,0,0.15); margin-bottom:1.2rem; }

/* Info list — dark text on white */
.kct-dept-info { list-style:none; padding:0; margin:0 0 1.8rem; flex:1; }
.kct-dept-info li { display:flex; align-items:flex-start; gap:10px; margin-bottom:0.75rem; font-size:0.83rem; color:#555; line-height:1.5; }
.kct-dept-info li i { color:var(--kpy-primary); margin-top:2px; flex-shrink:0; font-size:0.85rem; }
.kct-dept-info a { color:#333; text-decoration:none; transition:color 0.2s; }
.kct-dept-info a:hover { color:var(--kpy-primary); }

/* CTA buttons */
.kct-dept-btn { display:inline-flex; align-items:center; justify-content:center; gap:8px; background:transparent; color:var(--kpy-primary); font-weight:700; font-size:0.78rem; letter-spacing:1px; text-transform:uppercase; padding:0.8rem 1.5rem; text-decoration:none; border:2px solid var(--kpy-primary); transition:background 0.2s,border-color 0.2s,color 0.2s,box-shadow 0.2s; align-self:flex-start; margin-top:auto; }
.kct-dept-btn:hover { background:var(--kpy-primary); border-color:var(--kpy-primary); color:#fff; box-shadow:0 4px 16px rgba(215,0,0,0.3); }
.kct-dept-btn-featured { background:var(--kpy-primary); border-color:var(--kpy-primary); color:#fff; }
.kct-dept-btn-featured:hover { background:#aa0000; border-color:#aa0000; }
.kct-dept-btn-abuse { color:#a00; border-color:#a00; }
.kct-dept-btn-abuse:hover { background:#a00; color:#fff; }

/* ─── Contact Section ─── */
.kct-contact-section { padding:8rem 0; background:#080808; border-top:1px solid #111; }
.kct-contact-cols { gap:2rem; align-items:flex-start; }

/* WHITE form card */
.kct-form-card { background:#ffffff; border:none; border-top:4px solid var(--kpy-primary); padding:3rem; position:relative; overflow:hidden; box-shadow:0 4px 40px rgba(0,0,0,0.4); }

.kct-form-header { margin-bottom:2.5rem; padding-bottom:2rem; border-bottom:2px solid rgba(217,0,0,0.15); }
.kct-form-header-label { display:inline-flex; align-items:center; gap:8px; color:var(--kpy-primary); font-size:0.72rem; font-weight:700; letter-spacing:2px; text-transform:uppercase; margin-bottom:0.5rem; }
.kct-form-header p { color:#666; font-size:0.9rem; margin:0; }

.kct-field-group { margin-bottom:1.5rem; }
.kct-field-row { margin-bottom:0 !important; }
.kct-field-row .kct-field-group { margin-bottom:1.5rem; }

/* Labels — dark on white */
.kct-label { display:block; font-size:0.75rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:#333; margin-bottom:0.6rem; }
.kct-label span { color:var(--kpy-primary); }

/* Inputs — light bg, red border */
.kct-input { width:100%; background:#f9f9f9; border:2px solid #e0e0e0; color:#111; font-family:var(--kpy-font-body); font-size:0.92rem; padding:0.9rem 1.1rem; outline:none; transition:border-color 0.2s,background 0.2s,box-shadow 0.2s; -webkit-appearance:none; }
.kct-input::placeholder { color:#bbb; }
.kct-input:focus { border-color:var(--kpy-primary); background:#fff; box-shadow:0 0 0 3px rgba(215,0,0,0.1); }

.kct-select-wrap { position:relative; }
.kct-select { cursor:pointer; padding-right:2.5rem; }
.kct-select option { background:#fff; color:#111; }
.kct-select-arrow { position:absolute; right:1rem; top:50%; transform:translateY(-50%); color:var(--kpy-primary); pointer-events:none; font-size:0.85rem; }
.kct-textarea { resize:vertical; min-height:150px; }

.kct-form-footer { display:flex; align-items:center; flex-wrap:wrap; gap:1.5rem; margin-top:0.5rem; }
.kct-submit-btn { display:inline-flex; align-items:center; gap:10px; background:var(--kpy-primary); color:#fff; font-family:var(--kpy-font-body); font-weight:800; font-size:0.85rem; letter-spacing:1px; text-transform:uppercase; padding:1rem 2.2rem; border:2px solid var(--kpy-primary); cursor:pointer; transition:background 0.2s,transform 0.2s,box-shadow 0.2s; }
.kct-submit-btn:hover { background:#aa0000; border-color:#aa0000; transform:translateY(-2px); box-shadow:0 6px 20px rgba(215,0,0,0.35); }
.kct-form-note { display:flex; align-items:center; gap:6px; color:#999; font-size:0.78rem; margin:0; }
.kct-form-note i { color:var(--kpy-primary); }

/* Success Popup */
.kct-success-popup { display:none; position:absolute; inset:0; background:rgba(255,255,255,0.97); z-index:10; align-items:center; justify-content:center; flex-direction:column; text-align:center; padding:2rem; }
.kct-success-popup.active { display:flex; }
.kct-success-icon { width:80px; height:80px; margin:0 auto 1.5rem; }
.kct-success-content h3 { font-size:1.8rem; font-weight:900; color:#0a0a0a; margin-bottom:0.8rem; }
.kct-success-content p { color:#666; font-size:0.95rem; margin-bottom:2rem; }
.kct-close-popup { background:var(--kpy-primary); color:#fff; font-family:var(--kpy-font-body); font-weight:700; font-size:0.82rem; letter-spacing:1px; text-transform:uppercase; padding:0.8rem 2rem; border:none; cursor:pointer; transition:background 0.2s; }
.kct-close-popup:hover { background:#aa0000; }

/* ─── Info Stack (Quick Contact + Hours) — WHITE cards ─── */
.kct-info-stack { display:flex; flex-direction:column; gap:1.5rem; }
.kct-quick-card,.kct-hours-card { background:#ffffff; border:none; border-top:4px solid var(--kpy-primary); padding:2rem; position:relative; overflow:hidden; box-shadow:0 4px 30px rgba(0,0,0,0.35); }

.kct-quick-header,.kct-hours-header { display:flex; align-items:center; gap:10px; font-size:0.72rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--kpy-primary); margin-bottom:1.5rem; padding-bottom:1rem; border-bottom:2px solid rgba(217,0,0,0.15); }
.kct-quick-item { display:flex; align-items:flex-start; gap:1rem; margin-bottom:1.2rem; }
.kct-quick-icon { width:38px; height:38px; background:rgba(217,0,0,0.08); border:2px solid rgba(217,0,0,0.25); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.kct-quick-icon i { color:var(--kpy-primary); font-size:0.9rem; }
.kct-quick-label { font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:#aaa; margin:0 0 2px; }
.kct-quick-value { font-size:0.88rem; color:#222; text-decoration:none; font-weight:600; transition:color 0.2s; }
a.kct-quick-value:hover { color:var(--kpy-primary); }

.kct-hours-row { display:flex; justify-content:space-between; align-items:center; padding:0.7rem 0; border-bottom:1px solid #f0f0f0; font-size:0.85rem; color:#555; }
.kct-hours-row:last-child { border-bottom:none; }
.kct-hours-badge { background:rgba(217,0,0,0.08); border:1px solid rgba(217,0,0,0.3); color:var(--kpy-primary); font-size:0.7rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; padding:3px 10px; }
.kct-red-badge { background:var(--kpy-primary); border-color:var(--kpy-primary); color:#fff; }

/* ─── Map ─── */
.kct-map-wrap { margin-top:4rem; }
.kct-map-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem; flex-wrap:wrap; gap:1rem; }
.kct-directions-btn { display:inline-flex; align-items:center; gap:8px; background:var(--kpy-primary); color:#fff; font-weight:800; font-size:0.78rem; letter-spacing:1px; text-transform:uppercase; padding:0.7rem 1.5rem; text-decoration:none; border:2px solid var(--kpy-primary); transition:background 0.2s,box-shadow 0.2s; }
.kct-directions-btn:hover { background:#aa0000; color:#fff; box-shadow:0 4px 16px rgba(215,0,0,0.4); }
.kct-map-frame { background:#fff; border:none; border-top:4px solid var(--kpy-primary); overflow:hidden; position:relative; box-shadow:0 4px 40px rgba(0,0,0,0.4); }
.kct-map-frame iframe { display:block; width:100%; height:420px; }
.kct-map-pin-label { display:flex; align-items:center; gap:10px; background:var(--kpy-primary); color:#fff; font-size:0.8rem; font-weight:700; padding:0.8rem 1.5rem; }
.kct-map-pin-label i { font-size:1rem; }

/* ─── Responsive ─── */
@media (max-width:768px) { .hosting-hero { min-height:auto; padding:4rem 0 0; } .hero-content-wrapper { flex-direction:column; gap:1.5rem; padding-bottom:2rem; } .kpy-sg-title { font-size:2rem; } .kct-dept-section,.kct-contact-section { padding:5rem 0; } .kct-form-card { padding:2rem 1.5rem; } .kct-contact-cols { flex-direction:column; } .kct-info-stack { margin-top:2rem; } .kct-map-header { flex-direction:column; align-items:flex-start; } .feature-circles { justify-content:flex-start; } }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var closeBtn = document.querySelector('.kct-close-popup');
    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            document.querySelector('.kct-success-popup').classList.remove('active');
        });
    }
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

<?php get_footer(); ?>