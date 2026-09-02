<?php
/**
 * Template Name: Tenders & Notices
 *
 * @package AgriMarketing
 */
get_header();
$theme_uri = get_template_directory_uri();
$post_id = get_the_ID();
$banner_subtitle = agri_get_meta($post_id, 'banner_subtitle', 'Official e-Procurement announcements, daily arrival bulletins, MSP guidelines, and agricultural market advisories.');

// Query Market Advisories CPT
$adv_query = new WP_Query(array(
    'post_type'      => 'market_advisory',
    'posts_per_page' => 6,
    'post_status'    => 'publish'
));
?>

<?php
agri_render_inner_banner(array(
    'title'       => get_the_title(),
    'subtitle'    => $banner_subtitle,
    'tag'         => '📢 Official Tenders, EOIs & Price Bulletins',
    'image'       => $theme_uri . '/images/banner-notices.jpg',
    'badge_label' => 'Public Notice Board',
    'badge_val'   => 'Gazette & Procurement',
    'i18n_title'  => 'nav_notices',
    'i18n_sub'    => '',
    'i18n_crumb'  => 'nav_notices',
    'meta_pills'  => array('📑 e-Procurement', '📊 Daily Price Bulletins', '📜 MSP Notifications')
));
?>

<!-- ==========================================================================
   NOTICES & ADVISORY CONTENT SECTION
   ========================================================================== -->
<section class="section">
    <div class="container">
        <div class="notices-grid">
            <!-- Left Notice Card -->
            <div class="notice-list-card">
                <div class="notice-tabs">
                    <button class="notice-tab-btn active" data-i18n="tab_tenders">Tenders & EOIs</button>
                    <button class="notice-tab-btn" data-i18n="tab_bulletins">Daily Price Bulletins</button>
                    <button class="notice-tab-btn" data-i18n="tab_circulars">MSP & Government Orders</button>
                </div>

                <div class="notice-list">
                    <!-- Populated dynamically via app.js -->
                </div>
            </div>

            <!-- Right Advisory Card -->
            <div class="advisory-sidebar-card">
                <div class="advisory-title">
                    🌾 <span>Daily Farmer Market Advisory</span>
                </div>

                <?php if ($adv_query->have_posts()) : ?>
                    <?php while ($adv_query->have_posts()) : $adv_query->the_post(); 
                        $a_id = get_the_ID();
                        $crop_label = get_post_meta($a_id, '_crop_name', true) ?: get_the_title();
                        $crop_icon  = get_post_meta($a_id, '_crop_icon', true) ?: '🌾';
                    ?>
                        <div class="advisory-item">
                            <div class="advisory-crop"><?php echo esc_html($crop_icon . ' ' . $crop_label); ?></div>
                            <div class="advisory-text">
                                <?php echo wp_kses_post(get_the_content()); ?>
                            </div>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>

                <?php else : ?>
                    <div class="advisory-item">
                        <div class="advisory-crop">🥔 Potato (Jyoti / Chandramukhi)</div>
                        <p class="advisory-text">
                            Cold storage release is steady. Maintain optimal humidity (85-90%) during transit to prevent spoilage in humid weather.
                        </p>
                    </div>

                    <div class="advisory-item">
                        <div class="advisory-crop">🌾 Paddy & Rice (Kharif)</div>
                        <p class="advisory-text">
                            Moisture content should not exceed 14% at APMC procurement checkposts for Grade-A MSP realization.
                        </p>
                    </div>

                    <div class="advisory-item">
                        <div class="advisory-crop">🌿 Raw Jute (TD-5)</div>
                        <p class="advisory-text">
                            Demand in North 24 Parganas and Nadia mills is surging. Farmers are advised to sort fiber cleanly for higher grades.
                        </p>
                    </div>

                    <div class="advisory-item">
                        <div class="advisory-crop">🌻 Yellow Mustard</div>
                        <p class="advisory-text">
                            Market demand is upward trending with festive season approaching. Sowing preparations for early rabi may be planned.
                        </p>
                    </div>
                <?php endif; ?>
        </div>
    </div>
</section>

<?php
get_footer();
