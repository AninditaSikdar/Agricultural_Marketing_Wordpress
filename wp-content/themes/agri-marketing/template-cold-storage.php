<?php
/**
 * Template Name: Cold Storage Network
 *
 * @package AgriMarketing
 */
get_header();
$post_id = get_the_ID();
$banner_subtitle    = agri_get_meta($post_id, 'banner_subtitle', 'Check available capacity, contact managers, and book temperature-controlled storage.');
$protocols_title    = agri_get_meta($post_id, 'cs_protocols_title', 'Recommended Cold Preservation Protocols');
$protocols_subtitle = agri_get_meta($post_id, 'cs_protocols_subtitle', 'Official state standards for optimum storage life and quality maintenance.');

// 3 Cold Preservation Protocols
$p1_title = agri_get_meta($post_id, 'cs_p1_title', '🥔 Potato (Table & Seed)');
$p1_desc  = agri_get_meta($post_id, 'cs_p1_desc', 'Storage temperature: 2°C - 4°C with 85%-90% relative humidity. Regular CIPC treatment for sprout suppression.');

$p2_title = agri_get_meta($post_id, 'cs_p2_title', '🧅 Onion & Garlic');
$p2_desc  = agri_get_meta($post_id, 'cs_p2_desc', 'Storage temperature: 0°C - 2°C with 65%-70% relative humidity. Good forced air ventilation is essential to avoid fungal neck rot.');

$p3_title = agri_get_meta($post_id, 'cs_p3_title', '🥭 Fruits & Vegetables');
$p3_desc  = agri_get_meta($post_id, 'cs_p3_desc', 'Pre-cooling at 10°C followed by preservation in controlled atmosphere chambers at 4°C - 8°C for maximum crispness.');
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
                <span class="current" data-i18n="nav_cold_storage"><?php the_title(); ?></span>
            </div>
            <h1 class="page-banner-title"><?php the_title(); ?></h1>
            <p class="page-banner-desc">
                <?php echo esc_html($banner_subtitle); ?>
            </p>
        </div>
    </div>
</section>

<!-- ==========================================================================
   COLD STORAGE DIRECTORY
   ========================================================================== -->
<section class="section">
    <div class="container">
        <!-- Filter Bar -->
        <div style="max-width:380px; margin:0 auto 2.5rem; text-align:center;">
            <label class="calc-label" style="font-weight:700;">Filter by District / Region:</label>
            <select id="coldStorageDistFilter" class="form-select" aria-label="Filter Cold Storage by District">
                <option value="all">All Districts (সকল জেলা)</option>
                <option value="Hooghly">Hooghly (হুগলি)</option>
                <option value="Burdwan">Burdwan (বর্ধমান)</option>
                <option value="Nadia">Nadia (নদিয়া)</option>
                <option value="Malda">Malda (মালদা)</option>
                <option value="Bankura">Bankura (বাঁকুড়া)</option>
                <option value="Siliguri">Siliguri / North Bengal</option>
            </select>
        </div>

        <!-- Dynamic Facility Grid -->
        <div class="locator-grid" id="coldStorageGrid">
            <!-- Populated dynamically via app.js -->
        </div>

        <!-- Cold Storage Advisory & Standards -->
        <div class="section-header" style="margin-top:4rem; margin-bottom:1.5rem;">
            <h3 class="section-title" style="font-size:1.5rem;"><?php echo esc_html($protocols_title); ?></h3>
            <p class="section-subtitle"><?php echo esc_html($protocols_subtitle); ?></p>
        </div>

        <div class="workflow-grid">
            <div class="workflow-step-card">
                <span class="step-number">1</span>
                <h4 class="step-title"><?php echo esc_html($p1_title); ?></h4>
                <p class="step-desc"><?php echo esc_html($p1_desc); ?></p>
            </div>
            <div class="workflow-step-card">
                <span class="step-number">2</span>
                <h4 class="step-title"><?php echo esc_html($p2_title); ?></h4>
                <p class="step-desc"><?php echo esc_html($p2_desc); ?></p>
            </div>
            <div class="workflow-step-card">
                <span class="step-number">3</span>
                <h4 class="step-title"><?php echo esc_html($p3_title); ?></h4>
                <p class="step-desc"><?php echo esc_html($p3_desc); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   STORAGE RESERVATION MODAL
   ========================================================================== -->
<div class="modal-overlay" id="storageBookingModal">
    <div class="modal-card" style="max-width:480px;">
        <div class="modal-header">
            <h3 class="modal-title">📦 Storage Slot Reservation</h3>
            <button type="button" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <p style="font-size:0.9rem; color:var(--text-muted); margin-bottom:1rem;">
                Selected Facility: <strong id="bookingUnitName" style="color:var(--primary);">Hooghly Cold Storage</strong>
            </p>
            <form id="storageBookingForm">
                <div class="calc-group">
                    <label class="calc-label">Farmer / FPO Name:</label>
                    <input type="text" id="bookingFarmerName" class="form-input" placeholder="Your Full Name" required>
                </div>
                <div class="calc-group">
                    <label class="calc-label">Commodity & Quantity (Metric Tonnes / Bags):</label>
                    <input type="text" id="bookingCropDetails" class="form-input" placeholder="e.g. 500 Bags Potato Jyoti" required>
                </div>
                <div class="calc-group">
                    <label class="calc-label">Contact Phone Number:</label>
                    <input type="tel" id="bookingPhone" class="form-input" placeholder="10-digit mobile number" required pattern="[0-9]{10}">
                </div>
                <button type="submit" class="btn btn-primary" id="bookingSubmitBtn" style="width:100%; margin-top:1rem;">
                    🚀 Confirm Slot Reservation
                </button>
            </form>
        </div>
    </div>
</div>

<?php
get_footer();
