<?php
/**
 * Template Name: About Us
 *
 * @package AgriMarketing
 */
get_header();
$theme_uri = get_template_directory_uri();
$post_id   = get_the_ID();

// Retrieve Dynamic CMS Meta with Fallbacks
$banner_subtitle   = agri_get_meta($post_id, 'banner_subtitle', 'Mandate, vision, strategic objectives, quality testing infrastructure, and agricultural marketing administration.');
$mandate_tag       = agri_get_meta($post_id, 'about_mandate_tag', '🏛️ Department Mandate');
$mandate_title     = agri_get_meta($post_id, 'about_mandate_title', 'Empowering Agricultural Trade & Fair Price Realization');
$mandate_p1        = agri_get_meta($post_id, 'about_mandate_p1', 'The <strong>Agricultural Marketing Department</strong> was constituted to establish an efficient, transparent, and farmer-friendly marketing system for agricultural and horticultural produce.');
$mandate_p2        = agri_get_meta($post_id, 'about_mandate_p2', 'Through a network of over 650 regulated APMC Mandis, 450+ Sufal Bangla retail hubs, multi-chamber cold storage facilities, and modern electronic auction platforms (e-NAM), the Department protects farmers from exploitation while safeguarding consumer interests.');

$vision_title      = agri_get_meta($post_id, 'about_vision_title', '🎯 Vision');
$vision_desc       = agri_get_meta($post_id, 'about_vision_desc', 'To double farmer price realizations through direct trade, eliminate post-harvest losses, and modernize agricultural supply chains.');
$quality_title     = agri_get_meta($post_id, 'about_quality_title', '🛡️ Quality Standards');
$quality_desc      = agri_get_meta($post_id, 'about_quality_desc', 'State-of-the-art Agmark certified testing laboratories ensuring quality grading and chemical residue checks.');

// 4 Impact Stats
$stat1_icon        = agri_get_meta($post_id, 'about_stat1_icon', '🏢');
$stat1_num         = agri_get_meta($post_id, 'about_stat1_num', '650');
$stat1_suffix      = agri_get_meta($post_id, 'about_stat1_suffix', '+');
$stat1_label       = agri_get_meta($post_id, 'about_stat1_label', 'Regulated APMC Mandis');

$stat2_icon        = agri_get_meta($post_id, 'about_stat2_icon', '🌾');
$stat2_num         = agri_get_meta($post_id, 'about_stat2_num', '1.6');
$stat2_suffix      = agri_get_meta($post_id, 'about_stat2_suffix', 'M+');
$stat2_label       = agri_get_meta($post_id, 'about_stat2_label', 'Registered Farmers');

$stat3_icon        = agri_get_meta($post_id, 'about_stat3_icon', '🛒');
$stat3_num         = agri_get_meta($post_id, 'about_stat3_num', '450');
$stat3_suffix      = agri_get_meta($post_id, 'about_stat3_suffix', '+');
$stat3_label       = agri_get_meta($post_id, 'about_stat3_label', 'Sufal Bangla Centers');

$stat4_icon        = agri_get_meta($post_id, 'about_stat4_icon', '🧪');
$stat4_num         = agri_get_meta($post_id, 'about_stat4_num', '100');
$stat4_suffix      = agri_get_meta($post_id, 'about_stat4_suffix', '%');
$stat4_label       = agri_get_meta($post_id, 'about_stat4_label', 'Agmark Quality Tested');

// 4 Strategic Pillars Section
$pillars_tag       = agri_get_meta($post_id, 'about_pillars_tag', '🌟 Core Pillars');
$pillars_title     = agri_get_meta($post_id, 'about_pillars_title', 'Strategic Objectives & Key Functions');
$pillars_subtitle  = agri_get_meta($post_id, 'about_pillars_subtitle', 'Transforming primary agricultural marketing into a resilient, technology-driven ecosystem.');

$p1_title          = agri_get_meta($post_id, 'about_p1_title', 'Regulated Market Oversight');
$p1_desc           = agri_get_meta($post_id, 'about_p1_desc', 'Supervision of APMC checkposts, electronic weighing scales, transparent bidding, and timely payment settlements directly to farmer bank accounts.');

$p2_title          = agri_get_meta($post_id, 'about_p2_title', 'Direct Retail Outlets');
$p2_desc           = agri_get_meta($post_id, 'about_p2_desc', 'Expanding Sufal Bangla mobile vans and stationary counters to bring farm-fresh vegetables directly from fields to urban households at fair prices.');

$p3_title          = agri_get_meta($post_id, 'about_p3_title', 'Cold Storage & Logistics');
$p3_desc           = agri_get_meta($post_id, 'about_p3_desc', 'Financial subsidies for multi-commodity cold chain infrastructure, refrigerated transport vehicles, and modern packhouses under flagship schemes.');

$p4_title          = agri_get_meta($post_id, 'about_p4_title', 'Agmark Certification');
$p4_desc           = agri_get_meta($post_id, 'about_p4_desc', 'Operating regional laboratories for quality inspection, grading, and AGMARK certification for edible oils, ghee, honey, and spices.');

// Reach Out CTA
$cta_title         = agri_get_meta($post_id, 'about_cta_title', 'Need District Office Details or Have an Inquiry?');
$cta_desc          = agri_get_meta($post_id, 'about_cta_desc', 'Access the complete district APMC office directory, regional mandi contacts, or submit feedback to our public helpdesk.');
$cta_btn           = agri_get_meta($post_id, 'about_cta_btn', '📞 Go to Contact & Helpdesk Directory →');
$cta_url           = agri_get_meta($post_id, 'about_cta_url', home_url('/contact/'));
?>

<!-- ==========================================================================
   INNER PAGE BANNER WITH BREADCRUMBS
   ========================================================================== -->
<section class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <div class="breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>" data-i18n="nav_home">Home</a>
                <span class="separator">/</span>
                <span class="current"><?php the_title(); ?></span>
            </div>
            <h1 class="page-banner-title"><?php the_title(); ?></h1>
            <p class="page-banner-desc">
                <?php echo esc_html($banner_subtitle); ?>
            </p>
        </div>
    </div>
</section>

<!-- ==========================================================================
   DEPARTMENT MISSION & OVERVIEW
   ========================================================================== -->
<section class="section">
    <div class="container">
        <div class="about-grid">
            <div>
                <div class="section-tag"><?php echo esc_html($mandate_tag); ?></div>
                <h2 class="section-title" style="margin-bottom:1rem;"><?php echo esc_html($mandate_title); ?></h2>
                <div style="font-size:0.98rem; color:var(--text-muted); line-height:1.7; margin-bottom:1.2rem;">
                    <?php echo wp_kses_post(wpautop($mandate_p1)); ?>
                </div>
                <div style="font-size:0.98rem; color:var(--text-muted); line-height:1.7; margin-bottom:1.5rem;">
                    <?php echo wp_kses_post(wpautop($mandate_p2)); ?>
                </div>

                <div class="workflow-grid" style="margin-top:1.5rem;">
                    <div class="workflow-step-card" style="padding:1.2rem;">
                        <h4 style="font-weight:700; color:var(--primary); margin-bottom:0.3rem;"><?php echo esc_html($vision_title); ?></h4>
                        <p style="font-size:0.85rem; color:var(--text-muted);">
                            <?php echo esc_html($vision_desc); ?>
                        </p>
                    </div>
                    <div class="workflow-step-card" style="padding:1.2rem;">
                        <h4 style="font-weight:700; color:var(--accent-dark); margin-bottom:0.3rem;"><?php echo esc_html($quality_title); ?></h4>
                        <p style="font-size:0.85rem; color:var(--text-muted);">
                            <?php echo esc_html($quality_desc); ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="hero-image-frame" style="box-shadow:var(--shadow-lg);">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large', array('class' => 'hero-main-img', 'alt' => get_the_title())); ?>
                <?php else : ?>
                    <img src="<?php echo esc_url($theme_uri . '/images/sufal-market.jpg'); ?>" alt="Agricultural Marketing Department Produce Stall" class="hero-main-img">
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>

<!-- ==========================================================================
   KEY IMPACT METRICS COUNTERS
   ========================================================================== -->
<section class="stats-banner-section" style="border-top:1px solid var(--border-color); border-bottom:1px solid var(--border-color);">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon-box"><?php echo esc_html($stat1_icon); ?></div>
                <div>
                    <div class="stat-number" data-counter-target="<?php echo esc_attr(floatval($stat1_num)); ?>" data-counter-suffix="<?php echo esc_attr($stat1_suffix); ?>" data-counter-duration="2000">0<?php echo esc_html($stat1_suffix); ?></div>
                    <div class="stat-label"><?php echo esc_html($stat1_label); ?></div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon-box accent-bg"><?php echo esc_html($stat2_icon); ?></div>
                <div>
                    <div class="stat-number" data-counter-target="<?php echo esc_attr(floatval($stat2_num)); ?>" data-counter-decimals="<?php echo (strpos($stat2_num, '.') !== false) ? '1' : '0'; ?>" data-counter-suffix="<?php echo esc_attr($stat2_suffix); ?>" data-counter-duration="2200">0.0<?php echo esc_html($stat2_suffix); ?></div>
                    <div class="stat-label"><?php echo esc_html($stat2_label); ?></div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon-box blue-bg"><?php echo esc_html($stat3_icon); ?></div>
                <div>
                    <div class="stat-number" data-counter-target="<?php echo esc_attr(floatval($stat3_num)); ?>" data-counter-suffix="<?php echo esc_attr($stat3_suffix); ?>" data-counter-duration="2400">0<?php echo esc_html($stat3_suffix); ?></div>
                    <div class="stat-label"><?php echo esc_html($stat3_label); ?></div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon-box"><?php echo esc_html($stat4_icon); ?></div>
                <div>
                    <div class="stat-number" data-counter-target="<?php echo esc_attr(floatval($stat4_num)); ?>" data-counter-suffix="<?php echo esc_attr($stat4_suffix); ?>" data-counter-duration="2000">0<?php echo esc_html($stat4_suffix); ?></div>
                    <div class="stat-label"><?php echo esc_html($stat4_label); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   KEY STRATEGIC OBJECTIVES & FUNCTIONS
   ========================================================================== -->
<section class="section section-bg-alt">
    <div class="container">
        <div class="section-header">
            <div class="section-tag"><?php echo esc_html($pillars_tag); ?></div>
            <h2 class="section-title"><?php echo esc_html($pillars_title); ?></h2>
            <p class="section-subtitle">
                <?php echo esc_html($pillars_subtitle); ?>
            </p>
        </div>

        <div class="workflow-grid">
            <div class="workflow-step-card">
                <span class="step-number">1</span>
                <h3 class="step-title"><?php echo esc_html($p1_title); ?></h3>
                <p class="step-desc"><?php echo esc_html($p1_desc); ?></p>
            </div>

            <div class="workflow-step-card">
                <span class="step-number">2</span>
                <h3 class="step-title"><?php echo esc_html($p2_title); ?></h3>
                <p class="step-desc"><?php echo esc_html($p2_desc); ?></p>
            </div>

            <div class="workflow-step-card">
                <span class="step-number">3</span>
                <h3 class="step-title"><?php echo esc_html($p3_title); ?></h3>
                <p class="step-desc"><?php echo esc_html($p3_desc); ?></p>
            </div>

            <div class="workflow-step-card">
                <span class="step-number">4</span>
                <h3 class="step-title"><?php echo esc_html($p4_title); ?></h3>
                <p class="step-desc"><?php echo esc_html($p4_desc); ?></p>
            </div>
        </div>

        <!-- Reach Out Card -->
        <div style="margin-top:3.5rem; background:var(--bg-surface); border:1.5px solid var(--border-color); border-radius:var(--radius-xl); padding:2.5rem; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1.5rem; box-shadow:var(--shadow-md);">
            <div>
                <h3 style="font-size:1.4rem; font-weight:800; color:var(--text-main); margin-bottom:0.4rem;">
                    <?php echo esc_html($cta_title); ?>
                </h3>
                <p style="font-size:0.92rem; color:var(--text-muted); max-width:650px;">
                    <?php echo esc_html($cta_desc); ?>
                </p>
            </div>
            <div>
                <a href="<?php echo esc_url($cta_url); ?>" class="btn btn-primary">
                    <?php echo esc_html($cta_btn); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
