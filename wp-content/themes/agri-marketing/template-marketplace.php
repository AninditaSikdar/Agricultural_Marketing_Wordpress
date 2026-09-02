<?php
/**
 * Template Name: Farm Connect Marketplace
 *
 * @package AgriMarketing
 */
get_header();
$post_id = get_the_ID();
$banner_subtitle     = agri_get_meta($post_id, 'banner_subtitle', 'Direct verified farm listings from agricultural cooperatives and farmer producer organizations.');
$safeguards_title    = agri_get_meta($post_id, 'mp_safeguards_title', 'Direct Marketing & Assurance Safeguards');
$safeguards_subtitle = agri_get_meta($post_id, 'mp_safeguards_subtitle', 'How the State Agricultural Marketing Board guarantees secure trade.');

// 3 Assurance Safeguards
$s1_title = agri_get_meta($post_id, 'mp_s1_title', '🌿 Quality Assay & Agmark');
$s1_desc  = agri_get_meta($post_id, 'mp_s1_desc', 'All listed crops undergo scientific moisture, size, and purity checks at designated APMC testing labs.');

$s2_title = agri_get_meta($post_id, 'mp_s2_title', '💳 Direct Digital Settlement');
$s2_desc  = agri_get_meta($post_id, 'mp_s2_desc', 'Trade payments are protected via state-monitored escrow and transferred directly to the farmer\'s bank account.');

$s3_title = agri_get_meta($post_id, 'mp_s3_title', '🚛 Logistics & Weighing');
$s3_desc  = agri_get_meta($post_id, 'mp_s3_desc', 'Standardized e-weighbridges at checkposts with subsidized transit vehicles under Amar Fasal Amar Gari.');
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
                <span class="current" data-i18n="nav_marketplace"><?php the_title(); ?></span>
            </div>
            <h1 class="page-banner-title"><?php the_title(); ?></h1>
            <p class="page-banner-desc">
                <?php echo esc_html($banner_subtitle); ?>
            </p>
        </div>
    </div>
</section>

<!-- ==========================================================================
   PRODUCE MARKETPLACE LISTINGS
   ========================================================================== -->
<section class="section">
    <div class="container">
        <!-- Header Actions -->
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem; margin-bottom:2rem;">
            <div>
                <h2 style="font-size:1.4rem; font-weight:800; color:var(--text-main); margin-bottom:0.25rem;">Live Verified Farm Stocks</h2>
                <p style="font-size:0.88rem; color:var(--text-muted);">Direct farm-gate offers with zero middleman commissions.</p>
            </div>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-outline">
                📞 Contact Marketing Officer
            </a>
        </div>

        <!-- Dynamic Produce Grid -->
        <div class="produce-grid" id="marketplaceGrid">
            <!-- Populated dynamically via app.js -->
        </div>

        <!-- Trade Security & Quality Assurance -->
        <div class="section-header" style="margin-top:4.5rem; margin-bottom:1.5rem;">
            <h3 class="section-title" style="font-size:1.5rem;"><?php echo esc_html($safeguards_title); ?></h3>
            <p class="section-subtitle"><?php echo esc_html($safeguards_subtitle); ?></p>
        </div>

        <div class="workflow-grid">
            <div class="workflow-step-card">
                <span class="step-number">1</span>
                <h4 class="step-title"><?php echo esc_html($s1_title); ?></h4>
                <p class="step-desc"><?php echo esc_html($s1_desc); ?></p>
            </div>
            <div class="workflow-step-card">
                <span class="step-number">2</span>
                <h4 class="step-title"><?php echo esc_html($s2_title); ?></h4>
                <p class="step-desc"><?php echo esc_html($s2_desc); ?></p>
            </div>
            <div class="workflow-step-card">
                <span class="step-number">3</span>
                <h4 class="step-title"><?php echo esc_html($s3_title); ?></h4>
                <p class="step-desc"><?php echo esc_html($s3_desc); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   PRODUCE DIRECT INQUIRY MODAL
   ========================================================================== -->
<div class="modal-overlay" id="produceInquiryModal">
    <div class="modal-card" style="max-width:480px;">
        <div class="modal-header">
            <h3 class="modal-title">🤝 Send Purchase Quote</h3>
            <button type="button" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <div style="background:var(--bg-subtle); padding:0.85rem; border-radius:var(--radius-md); margin-bottom:1.25rem;">
                <div>Commodity: <strong id="inquiryCropName" style="color:var(--primary);">Potato</strong></div>
                <div>Seller / Hub: <span id="inquiryFarmerName">Subhash Mondal</span></div>
            </div>
            <form id="produceBidForm">
                <div class="calc-group">
                    <label class="calc-label">Buyer / Trader Name & Mandi License:</label>
                    <input type="text" id="bidBuyerName" class="form-input" placeholder="Your Name / Business" required>
                </div>
                <div class="calc-group">
                    <label class="calc-label">Your Bid Price Quote (₹ per Quintal):</label>
                    <input type="number" id="bidPriceQuote" class="form-input" placeholder="e.g. 1550" required>
                </div>
                <div class="calc-group">
                    <label class="calc-label">Contact Phone Number:</label>
                    <input type="tel" id="bidPhone" class="form-input" placeholder="10-digit mobile number" required pattern="[0-9]{10}">
                </div>
                <button type="submit" class="btn btn-primary" id="bidSubmitBtn" style="width:100%; margin-top:1rem;">
                    🚀 Send Purchase Quote to Seller
                </button>
            </form>
        </div>
    </div>
</div>

<?php
get_footer();
