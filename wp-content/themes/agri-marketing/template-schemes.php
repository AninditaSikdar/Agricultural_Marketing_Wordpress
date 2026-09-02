<?php
/**
 * Template Name: Schemes & Subsidies
 *
 * @package AgriMarketing
 */
get_header();
$theme_uri = get_template_directory_uri();
$post_id   = get_the_ID();
$banner_subtitle = agri_get_meta($post_id, 'banner_subtitle', 'Key initiatives facilitating direct farm-to-consumer linkages, logistics subsidies, and storage infrastructure.');

$calc_tag      = agri_get_meta($post_id, 'schemes_calc_tag', '🧮 Interactive Subsidy Tool');
$calc_title    = agri_get_meta($post_id, 'schemes_calc_title', 'Agri-Marketing Subsidy & Scheme Calculator');
$calc_subtitle = agri_get_meta($post_id, 'schemes_calc_subtitle', 'Calculate your estimated government grant eligibility in 3 easy clicks.');

$wf_title      = agri_get_meta($post_id, 'schemes_wf_title', 'How to Apply for Agricultural Subsidies');
$wf_subtitle   = agri_get_meta($post_id, 'schemes_wf_subtitle', 'Simplified 4-step digital onboarding process for individual growers and FPOs.');

// 4-Step Workflow
$s1_title = agri_get_meta($post_id, 'scheme_s1_title', 'Online Application');
$s1_desc  = agri_get_meta($post_id, 'scheme_s1_desc', 'Fill out the simplified grant application form with your Krishak Bandhu ID / Aadhaar card details.');

$s2_title = agri_get_meta($post_id, 'scheme_s2_title', 'Document Verification');
$s2_desc  = agri_get_meta($post_id, 'scheme_s2_desc', 'District Agri-Marketing Officer (DAMO) inspects land records and quotations submitted.');

$s3_title = agri_get_meta($post_id, 'scheme_s3_title', 'Administrative Sanction');
$s3_desc  = agri_get_meta($post_id, 'scheme_s3_desc', 'Receive formal in-principle sanction letter with direct subsidy allocation code.');

$s4_title = agri_get_meta($post_id, 'scheme_s4_title', 'Direct Bank Transfer (DBT)');
$s4_desc  = agri_get_meta($post_id, 'scheme_s4_desc', 'Subsidy amount is credited directly to the beneficiary\'s linked bank account upon asset delivery.');

// 4 Flagship Initiative Card Images
$card1_img = agri_get_meta($post_id, 'scheme_card1_image', $theme_uri . '/images/scheme-sufal-bangla.jpg');
$card2_img = agri_get_meta($post_id, 'scheme_card2_image', $theme_uri . '/images/scheme-amar-fasal.jpg');
$card3_img = agri_get_meta($post_id, 'scheme_card3_image', $theme_uri . '/images/scheme-cold-storage.jpg');
$card4_img = agri_get_meta($post_id, 'scheme_card4_image', $theme_uri . '/images/scheme-ami-packhouse.jpg');

// Dynamic Schemes Query (Retrieve all published schemes for interactive slider)
$schemes_query = new WP_Query(array(
    'post_type'      => 'agri_scheme',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC'
));
?>

<?php
agri_render_inner_banner(array(
    'title'       => get_the_title(),
    'subtitle'    => $banner_subtitle,
    'tag'         => '🌾 State Farmer Subsidies & Benefits',
    'image'       => $theme_uri . '/images/banner-schemes.jpg',
    'badge_label' => 'Direct Benefit Transfer',
    'badge_val'   => '100% DBT Verified',
    'i18n_title'  => 'srv_schemes_title',
    'i18n_sub'    => 'srv_schemes_desc',
    'i18n_crumb'  => 'nav_schemes',
    'meta_pills'  => array('🚜 Amar Fasal Amar Gari', '🛒 Sufal Bangla', '🧮 Subsidy Calculator')
));
?>

<!-- ==========================================================================
   FLAGSHIP INITIATIVES SLIDER
   ========================================================================== -->
<section class="section schemes-slider-section" id="schemesSliderSection">
    <div class="container">
        <div class="section-header-flex">
            <div class="section-header-left">
                <div class="section-tag" data-i18n="services_tag">🌟 Flagship Initiatives</div>
                <h2 class="section-title" data-i18n="srv_schemes_title">Government Schemes & Infrastructure Subsidies</h2>
                <p class="section-subtitle" data-i18n="srv_schemes_desc">
                    Explore financial assistance, modern cold chain infrastructure, and direct retail support for farmers and FPOs.
                </p>
            </div>
            <div class="slider-arrow-controls">
                <button type="button" class="slider-arrow-btn" id="schemesPrevBtn" aria-label="Previous Scheme Slide">‹</button>
                <button type="button" class="slider-arrow-btn" id="schemesNextBtn" aria-label="Next Scheme Slide">›</button>
            </div>
        </div>

        <div class="initiatives-slider-container" id="schemesSliderContainer">
            <div class="initiatives-slider-track" id="schemesSliderTrack">
                <?php if ($schemes_query->have_posts()) : ?>
                    <?php 
                    $fallback_cycle = array(
                        $theme_uri . '/images/scheme-amar-fasal.jpg',
                        $theme_uri . '/images/scheme-sufal-bangla.jpg',
                        $theme_uri . '/images/scheme-cold-storage.jpg',
                        $theme_uri . '/images/scheme-ami-packhouse.jpg'
                    );
                    $scheme_item_idx = 0;
                    while ($schemes_query->have_posts()) : $schemes_query->the_post(); 
                        $s_id = get_the_ID();
                        $pct = get_post_meta($s_id, '_subsidy_pct', true);
                        $badge = $pct ? ($pct . '% Subsidy') : 'Govt Initiative';
                        $benefits = get_post_meta($s_id, '_key_benefits', true);
                        $b_lines = !empty($benefits) ? explode("\n", str_replace("\r", "", $benefits)) : array();
                        $apply_link = get_post_meta($s_id, '_apply_url', true);
                        if (empty($apply_link) || $apply_link === '#') {
                            $apply_link = '#calculator';
                        }
                        
                        // Distinct image per scheme
                        $title_l = strtolower(get_the_title());
                        $distinct_default = $fallback_cycle[$scheme_item_idx % count($fallback_cycle)];
                        if (strpos($title_l, 'amar fasal') !== false || strpos($title_l, 'gari') !== false || strpos($title_l, 'transport') !== false || strpos($title_l, 'vehicle') !== false) {
                            $distinct_default = $theme_uri . '/images/scheme-amar-fasal.jpg';
                        } elseif (strpos($title_l, 'sufal') !== false || strpos($title_l, 'retail') !== false || strpos($title_l, 'outlet') !== false || strpos($title_l, 'kiosk') !== false) {
                            $distinct_default = $theme_uri . '/images/scheme-sufal-bangla.jpg';
                        } elseif (strpos($title_l, 'cold') !== false || strpos($title_l, 'storage') !== false || strpos($title_l, 'warehous') !== false || strpos($title_l, 'grid') !== false) {
                            $distinct_default = $theme_uri . '/images/scheme-cold-storage.jpg';
                        } elseif (strpos($title_l, 'ami') !== false || strpos($title_l, 'infra') !== false || strpos($title_l, 'packhouse') !== false || strpos($title_l, 'process') !== false) {
                            $distinct_default = $theme_uri . '/images/scheme-ami-packhouse.jpg';
                        }
                        
                        $stored_img = get_post_meta($s_id, '_scheme_image', true);
                        if (empty($stored_img) || strpos($stored_img, 'banner-schemes') !== false || strpos($stored_img, 'hero-farmer') !== false) {
                            $img_url = get_the_post_thumbnail_url($s_id, 'large') ?: $distinct_default;
                        } else {
                            $img_url = $stored_img;
                        }
                        $scheme_item_idx++;
                    ?>
                        <div class="initiative-slide-item">
                            <div class="initiative-card">
                                <div class="initiative-img-wrap">
                                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>" class="initiative-img">
                                    <span class="initiative-badge" style="background:var(--accent-gradient);"><?php echo esc_html($badge); ?></span>
                                </div>
                                <div class="initiative-body">
                                    <h3 class="initiative-title"><?php the_title(); ?></h3>
                                    <div class="initiative-desc">
                                        <?php echo wp_trim_words(get_the_content(), 22); ?>
                                    </div>
                                    <?php if (!empty($b_lines)) : ?>
                                        <ul class="initiative-features-list">
                                            <?php foreach (array_slice($b_lines, 0, 3) as $bl) : if (trim($bl)) : ?>
                                                <li><span class="check-icon">✓</span> <span><?php echo esc_html(trim($bl)); ?></span></li>
                                            <?php endif; endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                    <a href="<?php echo esc_url($apply_link); ?>" class="btn btn-outline" style="margin-top:auto">
                                        🚀 Apply / Check Eligibility →
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>

                <?php else : ?>
                    <!-- Fallback Initial Schemes -->
                    <div class="initiative-slide-item">
                        <div class="initiative-card">
                            <div class="initiative-img-wrap">
                                <img src="<?php echo esc_url($card1_img); ?>" alt="Sufal Bangla Modern Retail Stall" class="initiative-img">
                                <span class="initiative-badge">Direct Market</span>
                            </div>
                            <div class="initiative-body">
                                <h3 class="initiative-title">Sufal Bangla Outlets</h3>
                                <p class="initiative-desc">
                                    Direct farm-to-door retail network selling fresh vegetables, fruits, and dairy at fair prices while eliminating intermediaries.
                                </p>
                                <ul class="initiative-features-list">
                                    <li><span class="check-icon">✓</span> <span>450+ Static and Mobile Kiosks across WB</span></li>
                                    <li><span class="check-icon">✓</span> <span>Direct daily procurement from FPOs</span></li>
                                    <li><span class="check-icon">✓</span> <span>Quality grading & fair retail price tags</span></li>
                                </ul>
                                <a href="#calculator" class="btn btn-outline" style="margin-top:auto">
                                    🚀 Apply / Check Eligibility →
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="initiative-slide-item">
                        <div class="initiative-card">
                            <div class="initiative-img-wrap">
                                <img src="<?php echo esc_url($card2_img); ?>" alt="Amar Fasal Amar Gari Logistics Support" class="initiative-img">
                                <span class="initiative-badge" style="background:var(--accent-gradient);">50% Subsidy</span>
                            </div>
                            <div class="initiative-body">
                                <h3 class="initiative-title">Amar Fasal Amar Gari</h3>
                                <p class="initiative-desc">
                                    Capital subsidy program offering up to 50% financial assistance to farmers and self-help groups for purchasing produce transport vans.
                                </p>
                                <ul class="initiative-features-list">
                                    <li><span class="check-icon">✓</span> <span>50% Vehicle Cost Subsidy (Up to ₹1.5L)</span></li>
                                    <li><span class="check-icon">✓</span> <span>Reduces post-harvest transit losses</span></li>
                                    <li><span class="check-icon">✓</span> <span>Fast direct delivery to wholesale mandis</span></li>
                                </ul>
                                <a href="#calculator" class="btn btn-outline" style="margin-top:auto">
                                    🚀 Apply / Check Eligibility →
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="initiative-slide-item">
                        <div class="initiative-card">
                            <div class="initiative-img-wrap">
                                <img src="<?php echo esc_url($card3_img); ?>" alt="Modern Cold Storage Network" class="initiative-img">
                                <span class="initiative-badge" style="background:linear-gradient(135deg, #1a5276 0%, #2980b9 100%);">Infrastructure</span>
                            </div>
                            <div class="initiative-body">
                                <h3 class="initiative-title">Cold Storage & Warehousing Grid</h3>
                                <p class="initiative-desc">
                                    Integrated network of multi-chamber cold storage facilities with real-time slot booking and moisture-controlled potato chambers.
                                </p>
                                <ul class="initiative-features-list">
                                    <li><span class="check-icon">✓</span> <span>Real-time district capacity tracker</span></li>
                                    <li><span class="check-icon">✓</span> <span>Subsidized electricity tariff for agri-units</span></li>
                                    <li><span class="check-icon">✓</span> <span>Scientific preservation & Agmark quality testing labs</span></li>
                                </ul>
                                <a href="<?php echo esc_url(home_url('/cold-storage/')); ?>" class="btn btn-outline" style="margin-top:auto">
                                    🚀 Apply / Check Eligibility →
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="initiative-slide-item">
                        <div class="initiative-card">
                            <div class="initiative-img-wrap">
                                <img src="<?php echo esc_url($card4_img); ?>" alt="Agricultural Marketing Infrastructure" class="initiative-img">
                                <span class="initiative-badge" style="background:var(--accent-gradient);">35%-55% Subsidy</span>
                            </div>
                            <div class="initiative-body">
                                <h3 class="initiative-title">Agricultural Marketing Infrastructure (AMI)</h3>
                                <p class="initiative-desc">
                                    Assistance for setting up primary processing, washing, sorting, grading, and scientific packaging centers.
                                </p>
                                <ul class="initiative-features-list">
                                    <li><span class="check-icon">✓</span> <span>Up to 35%-55% Capital Investment Subsidy</span></li>
                                    <li><span class="check-icon">✓</span> <span>Scientific Agmark certification support</span></li>
                                    <li><span class="check-icon">✓</span> <span>Increases commodity shelf life & export potential</span></li>
                                </ul>
                                <a href="#calculator" class="btn btn-outline" style="margin-top:auto">
                                    🚀 Apply / Check Eligibility →
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="initiatives-slider-dots" id="schemesSliderDots"></div>
    </div>
</section>

<!-- ==========================================================================
   INTERACTIVE SUBSIDY & SCHEME CALCULATOR
   ========================================================================== -->
<section class="section section-bg-alt" id="calculator">
    <div class="container">
        <div class="section-header">
            <div class="section-tag"><?php echo esc_html($calc_tag); ?></div>
            <h2 class="section-title"><?php echo esc_html($calc_title); ?></h2>
            <p class="section-subtitle">
                <?php echo esc_html($calc_subtitle); ?>
            </p>
        </div>

        <div class="calculator-card">
            <!-- Form Configuration Side -->
            <div class="calc-form-side">
                <h3 class="calc-title">Configure Your Application</h3>
                <p class="calc-subtitle">Select your beneficiary type and required infrastructure.</p>

                <!-- Beneficiary Selector -->
                <div class="calc-group">
                    <label class="calc-label">Select Beneficiary Category:</label>
                    <div class="calc-options-grid">
                        <div class="calc-option-btn calc-opt-beneficiary active" data-val="small_farmer">
                            <span class="option-name">Small / Marginal Farmer</span>
                            <span class="option-sub">Landholding up to 2 Hectares</span>
                        </div>
                        <div class="calc-option-btn calc-opt-beneficiary" data-val="women_farmer">
                            <span class="option-name">Women Farmer / SHG</span>
                            <span class="option-sub">Women-led Agri Enterprises</span>
                        </div>
                        <div class="calc-option-btn calc-opt-beneficiary" data-val="fpo">
                            <span class="option-name">FPO / Farmers Cooperative</span>
                            <span class="option-sub">Registered Producer Groups</span>
                        </div>
                        <div class="calc-option-btn calc-opt-beneficiary" data-val="agri_startup">
                            <span class="option-name">Agri-Entrepreneur / Startup</span>
                            <span class="option-sub">Modern Marketing Infrastructure</span>
                        </div>
                    </div>
                </div>

                <!-- Facility Selector -->
                <div class="calc-group">
                    <label class="calc-label">Select Infrastructure / Support Needed:</label>
                    <div class="calc-options-grid">
                        <div class="calc-option-btn calc-opt-facility active" data-val="vehicle">
                            <span class="option-name">Produce Transport Van (Amar Fasal)</span>
                            <span class="option-sub">3-Wheeler / 4-Wheeler Small Commercial</span>
                        </div>
                        <div class="calc-option-btn calc-opt-facility" data-val="cold">
                            <span class="option-name">Solar Cold Room / Storage Unit</span>
                            <span class="option-sub">5 MT - 20 MT On-Farm Cold Chamber</span>
                        </div>
                        <div class="calc-option-btn calc-opt-facility" data-val="packhouse">
                            <span class="option-name">Grading, Sorting & Packhouse</span>
                            <span class="option-sub">Integrated Washing & Packaging Line</span>
                        </div>
                        <div class="calc-option-btn calc-opt-facility" data-val="kiosk">
                            <span class="option-name">Amar Dukan Modern Retail Kiosk</span>
                            <span class="option-sub">Urban & Sub-urban Direct Selling Stall</span>
                        </div>
                    </div>
                </div>

                <!-- Estimated Cost Slider -->
                <div class="calc-group">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.45rem;">
                        <label class="calc-label" style="margin-bottom:0;">Estimated Project Cost (₹ in Lakhs):</label>
                        <span id="calcCostDisplay" style="font-weight:800; color:var(--primary); font-size:1.1rem;">₹3.5 Lakhs</span>
                    </div>
                    <input type="range" id="calcCostInput" min="0.5" max="25.0" step="0.5" value="3.5" style="width:100%; accent-color:var(--primary);">
                </div>
            </div>

            <!-- Calculation Result Side -->
            <div class="calc-result-side">
                <div class="res-header">
                    <span class="res-badge">Eligible Government Subsidy</span>
                    <div class="res-amount" id="calcResAmount">₹1.50 Lakhs</div>
                    <div style="font-size:0.95rem; opacity:0.95;" id="calcResPercent">50% (Max ₹1.5L)</div>
                </div>

                <div>
                    <div style="font-size:0.8rem; text-transform:uppercase; letter-spacing:0.05em; opacity:0.85; margin-bottom:0.3rem;">Recommended Scheme:</div>
                    <div class="res-scheme-name" id="calcResScheme">Amar Fasal Amar Gari Scheme</div>

                    <div class="res-breakdown-box">
                        <div class="breakdown-row">
                            <span>Total Project Cost:</span>
                            <strong id="calcBreakTotal">₹3.50 Lakhs</strong>
                        </div>
                        <div class="breakdown-row">
                            <span>Government Subsidy Grant:</span>
                            <strong id="calcBreakGov" style="color:#fde047;">₹1.50 Lakhs</strong>
                        </div>
                        <div class="breakdown-row">
                            <span>Farmer Contribution / Bank Loan:</span>
                            <strong id="calcBreakOwn">₹2.00 Lakhs</strong>
                        </div>
                    </div>

                    <button class="btn btn-white" style="width:100%" onclick="if(window.showToast) showToast('Guidelines & Application Checklist Downloaded!', 'success')">
                        📥 <span>Download Application Guidelines</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- 4-Step Application Workflow -->
        <div class="section-header" style="margin-top:4rem; margin-bottom:1.5rem;">
            <h3 class="section-title" style="font-size:1.6rem;"><?php echo esc_html($wf_title); ?></h3>
            <p class="section-subtitle"><?php echo esc_html($wf_subtitle); ?></p>
        </div>

        <div class="workflow-grid">
            <div class="workflow-step-card">
                <span class="step-number">Step 1</span>
                <h4 class="step-title"><?php echo esc_html($s1_title); ?></h4>
                <p class="step-desc"><?php echo esc_html($s1_desc); ?></p>
            </div>
            <div class="workflow-step-card">
                <span class="step-number">Step 2</span>
                <h4 class="step-title"><?php echo esc_html($s2_title); ?></h4>
                <p class="step-desc"><?php echo esc_html($s2_desc); ?></p>
            </div>
            <div class="workflow-step-card">
                <span class="step-number">Step 3</span>
                <h4 class="step-title"><?php echo esc_html($s3_title); ?></h4>
                <p class="step-desc"><?php echo esc_html($s3_desc); ?></p>
            </div>
            <div class="workflow-step-card">
                <span class="step-number">Step 4</span>
                <h4 class="step-title"><?php echo esc_html($s4_title); ?></h4>
                <p class="step-desc"><?php echo esc_html($s4_desc); ?></p>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
