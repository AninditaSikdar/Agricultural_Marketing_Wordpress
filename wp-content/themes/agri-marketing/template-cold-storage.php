<?php
/**
 * Template Name: Cold Storage Locator
 *
 * @package AgriMarketing
 */
get_header();
$theme_uri = get_template_directory_uri();
$post_id = get_the_ID();
$banner_subtitle = agri_get_meta($post_id, 'banner_subtitle', 'Check available capacity, contact unit managers, reserve temperature-controlled storage, and access electronic Negotiable Warehouse Receipt (e-NWR) pledge financing.');
$info_title      = agri_get_meta($post_id, 'cs_info_title', 'WDRA Standards & e-NWR Warehouse Financing');
$info_subtitle   = agri_get_meta($post_id, 'cs_info_subtitle', 'How farmers can pledge electronic receipts to receive bank credit without distress selling.');

// 3 Storage Features
$f1_title = agri_get_meta($post_id, 'cs_f1_title', '📜 e-NWR Electronic Receipts');
$f1_desc  = agri_get_meta($post_id, 'cs_f1_desc', 'WDRA-accredited warehouses issue digital warehouse receipts recognized by NABARD and commercial banks for 75% pledge financing.');

$f2_title = agri_get_meta($post_id, 'cs_f2_title', '🥔 Potato Preservation Protocol');
$f2_desc  = agri_get_meta($post_id, 'cs_f2_desc', 'Storage temperature: 2°C - 4°C with 85%-90% relative humidity. Regular CIPC treatment for sprout suppression.');

$f3_title = agri_get_meta($post_id, 'cs_f3_title', '⚡ Subsidized Power Tariff');
$f3_desc  = agri_get_meta($post_id, 'cs_f3_desc', 'Special government agricultural electricity tariff concessions for registered cold chain operators maintaining quality grades.');
?>

<?php
agri_render_inner_banner(array(
    'title'       => get_the_title(),
    'subtitle'    => $banner_subtitle,
    'tag'         => '❄️ WDRA Cold Storage & Warehousing Grid',
    'image'       => $theme_uri . '/images/banner-cold-storage.jpg',
    'badge_label' => 'WDRA & e-NWR Hub',
    'badge_val'   => 'Real-Time Space Availability',
    'i18n_title'  => 'cs_title',
    'i18n_sub'    => 'cs_subtitle',
    'i18n_crumb'  => 'nav_cold_storage',
    'meta_pills'  => array('📜 e-NWR Pledge Loans', '🌡️ IoT Multi-Chamber', '🛡️ Zero Post-Harvest Loss')
));
?>

<!-- Cold Storage Directory -->
<section class="section">
    <div class="container">
        <!-- Filter Bar -->
        <div style="max-width:420px; margin:0 auto 2.5rem; text-align:center;">
            <label class="calc-label" style="font-weight:700;">Filter by District / Region:</label>
            <select id="coldStorageDistFilter" class="form-select" aria-label="Filter Cold Storage by District">
                <option value="all">All Districts (সকল জেলা)</option>
                <option value="Hooghly">Hooghly (হুগলি)</option>
                <option value="Burdwan">Burdwan (বর্ধমান)</option>
                <option value="Nadia">Nadia (নদিয়া)</option>
                <option value="Malda">Malda (মালদা)</option>
                <option value="Bankura">Bankura (বাঁকুড়া)</option>
                <option value="Darjeeling">Siliguri / North Bengal</option>
            </select>
        </div>

        <!-- Dynamic Facility Grid -->
        <div class="locator-grid" id="coldStorageGrid">
            <!-- Populated dynamically via app.js -->
        </div>

        <!-- e-NWR Financing & Quality Preservation Protocols -->
        <div class="section-header" style="margin-top:4.5rem; margin-bottom:1.5rem;">
            <h3 class="section-title" style="font-size:1.5rem;"><?php echo esc_html($info_title); ?></h3>
            <p class="section-subtitle"><?php echo esc_html($info_subtitle); ?></p>
        </div>

        <div class="workflow-grid">
            <div class="workflow-step-card">
                <span class="step-number">📜</span>
                <h4 class="step-title"><?php echo esc_html($f1_title); ?></h4>
                <p class="step-desc"><?php echo esc_html($f1_desc); ?></p>
            </div>
            <div class="workflow-step-card">
                <span class="step-number">🥔</span>
                <h4 class="step-title"><?php echo esc_html($f2_title); ?></h4>
                <p class="step-desc"><?php echo esc_html($f2_desc); ?></p>
            </div>
            <div class="workflow-step-card">
                <span class="step-number">⚡</span>
                <h4 class="step-title"><?php echo esc_html($f3_title); ?></h4>
                <p class="step-desc"><?php echo esc_html($f3_desc); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Storage Reservation Modal -->
<div class="modal-overlay" id="storageBookingModal">
    <div class="modal-card" style="max-width:480px;">
        <div class="modal-header">
            <h3 class="modal-title">📦 Storage Slot Reservation</h3>
            <button type="button" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <div style="background:var(--primary-soft); padding:0.85rem; border-radius:var(--radius-md); margin-bottom:1.25rem;">
                <div>Unit: <strong id="bookingUnitName" style="color:var(--primary);">Hooghly Agro Cold Storage Unit-1</strong></div>
                <div style="font-size:0.8rem; color:var(--text-muted);">Status: Available for immediate produce intake (e-NWR Eligible)</div>
            </div>

            <form onsubmit="event.preventDefault(); showToast('Storage Slot Reservation Request Sent! Unit Manager will call for intake schedule.', 'success'); ModalManager.close('storageBookingModal');">
                <div class="calc-group">
                    <label class="calc-label">Farmer / Depositor Name:</label>
                    <input type="text" class="form-input" placeholder="e.g. Subhash Mondal" required value="Subhash Mondal">
                </div>
                <div class="calc-group">
                    <label class="calc-label">Mobile Number:</label>
                    <input type="tel" class="form-input" placeholder="e.g. 9830012345" required value="9830112233">
                </div>
                <div class="form-grid-2">
                    <div class="calc-group">
                        <label class="calc-label">Required MT Capacity:</label>
                        <input type="number" class="form-input" placeholder="25" required value="25">
                    </div>
                    <div class="calc-group">
                        <label class="calc-label">Storage Duration:</label>
                        <select class="form-select">
                            <option value="3">3 Months</option>
                            <option value="6">6 Months</option>
                            <option value="9">9 Months (Full Season)</option>
                        </select>
                    </div>
                </div>
                <div class="calc-group">
                    <label style="display:flex; align-items:center; gap:0.5rem; font-size:0.85rem; cursor:pointer;">
                        <input type="checkbox" checked>
                        <span>Generate <strong>e-NWR (Electronic Negotiable Receipt)</strong> for Bank Loan</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%; margin-top:0.5rem;">
                    📦 Confirm Slot Reservation
                </button>
            </form>
        </div>
    </div>
</div>

<?php get_footer(); ?>
