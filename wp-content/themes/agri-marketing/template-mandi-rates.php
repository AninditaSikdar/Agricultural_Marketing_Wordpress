<?php
/**
 * Template Name: Daily Mandi Rates
 *
 * @package AgriMarketing
 */
get_header();
$post_id = get_the_ID();
$banner_subtitle = agri_get_meta($post_id, 'banner_subtitle', 'Live modal prices, minimum-maximum ranges, and daily arrivals updated directly from APMC checkposts.');

// 3 Guidelines
$g1_title = agri_get_meta($post_id, 'rate_g1_title', 'Daily Modal Rate Formula');
$g1_desc  = agri_get_meta($post_id, 'rate_g1_desc', 'The Modal Price represents the most frequently transacted transaction rate for standard Agmark quality parameters during primary arrivals.');

$g2_title = agri_get_meta($post_id, 'rate_g2_title', 'Transparent Electronic Auctions');
$g2_desc  = agri_get_meta($post_id, 'rate_g2_desc', 'All APMC checkposts operate under e-NAM (National Agriculture Market) guidelines ensuring electronic weighing and direct bank settlement within 24 hours.');

$g3_title = agri_get_meta($post_id, 'rate_g3_title', 'Grievance Redressal & Support');
$g3_desc  = agri_get_meta($post_id, 'rate_g3_desc', 'For weighing discrepancies or delayed payments, contact the Mandi Secretary or dial our 24x7 Kisan Call Center: 1800-180-1551.');
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
                <span class="current" data-i18n="nav_rates"><?php the_title(); ?></span>
            </div>
            <h1 class="page-banner-title"><?php the_title(); ?></h1>
            <p class="page-banner-desc">
                <?php echo esc_html($banner_subtitle); ?>
            </p>
        </div>
    </div>
</section>

<!-- ==========================================================================
   FULL MANDI RATES BOARD
   ========================================================================== -->
<section class="section">
    <div class="container">
        <div class="mandi-board-card">
            <!-- Controls & Filters Bar -->
            <div class="mandi-controls-bar">
                <!-- Category Tabs -->
                <div class="category-tabs">
                    <button class="category-pill active" data-cat="all" data-i18n="tab_all">All Commodities</button>
                    <button class="category-pill" data-cat="veg" data-i18n="tab_veg">Vegetables</button>
                    <button class="category-pill" data-cat="grain" data-i18n="tab_grain">Cereals & Grains</button>
                    <button class="category-pill" data-cat="pulses" data-i18n="tab_pulses">Pulses</button>
                    <button class="category-pill" data-cat="oilseed" data-i18n="tab_oilseed">Oilseeds & Cash Crops</button>
                    <button class="category-pill" data-cat="fruits" data-i18n="tab_fruits">Fruits</button>
                    <button class="category-pill" data-cat="spices" data-i18n="tab_spices">Spices</button>
                </div>

                <!-- Search and District Filter -->
                <div class="filter-search-row">
                    <div class="search-input-wrap">
                        <span class="search-icon">🔍</span>
                        <input type="text" id="mandiSearchInput" class="form-input" placeholder="Search crop (e.g. Potato, Onion, Rice)..." data-i18n="search_crop_ph">
                    </div>

                    <div class="filter-dropdowns">
                        <select id="mandiDistrictSelect" class="form-select" aria-label="Filter Mandi District">
                            <option value="all" data-i18n="all_districts">All Districts</option>
                            <option value="Hooghly">Hooghly</option>
                            <option value="Burdwan">Burdwan</option>
                            <option value="Nadia">Nadia</option>
                            <option value="Kolkata">Kolkata</option>
                            <option value="Murshidabad">Murshidabad</option>
                            <option value="Bankura">Bankura</option>
                            <option value="Jalpaiguri">Jalpaiguri</option>
                            <option value="Malda">Malda</option>
                            <option value="North 24 Parganas">North 24 Parganas</option>
                            <option value="South 24 Parganas">South 24 Parganas</option>
                        </select>

                        <button class="btn btn-accent" onclick="ModalManager.open('alertModal')">
                            🔔 <span data-i18n="btn_set_alert">Get SMS Alert</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mandi Data Table -->
            <div class="mandi-table-container">
                <table class="mandi-table">
                    <thead>
                        <tr>
                            <th data-i18n="th_commodity">Commodity & Variety</th>
                            <th data-i18n="th_mandi">Market / Mandi</th>
                            <th data-i18n="th_min">Min (₹/Qtl)</th>
                            <th data-i18n="th_max">Max (₹/Qtl)</th>
                            <th data-i18n="th_modal">Modal Price (₹/Qtl)</th>
                            <th data-i18n="th_trend">24h Trend</th>
                            <th data-i18n="th_action">Action</th>
                        </tr>
                    </thead>
                    <tbody id="mandiTableBody">
                        <!-- Populated dynamically via app.js -->
                    </tbody>
                </table>
            </div>

            <!-- Table Pagination Bar -->
            <div class="mandi-pagination-bar">
                <div class="pagination-info">
                    Showing <span id="mandiStartIdx">1</span>–<span id="mandiEndIdx">6</span> of <strong id="mandiResultCount">12</strong> commodity entries
                </div>
                <div class="pagination-controls" id="mandiPaginationNav">
                    <button class="pagination-nav-btn" id="mandiPrevBtn" onclick="MandiRatesModule.prevPage()" disabled aria-label="Previous Page">
                        ‹ Previous
                    </button>
                    <div class="pagination-pages" id="mandiPageNumbers">
                        <!-- Populated dynamically via app.js -->
                    </div>
                    <button class="pagination-nav-btn" id="mandiNextBtn" onclick="MandiRatesModule.nextPage()" aria-label="Next Page">
                        Next ›
                    </button>
                </div>
            </div>
        </div>

        <!-- Market Advisory & Guidelines Box -->
        <div class="workflow-grid" style="margin-top:2.5rem;">
            <div class="workflow-step-card">
                <span class="step-number">1</span>
                <h3 class="step-title"><?php echo esc_html($g1_title); ?></h3>
                <p class="step-desc"><?php echo esc_html($g1_desc); ?></p>
            </div>

            <div class="workflow-step-card">
                <span class="step-number">2</span>
                <h3 class="step-title"><?php echo esc_html($g2_title); ?></h3>
                <p class="step-desc"><?php echo esc_html($g2_desc); ?></p>
            </div>

            <div class="workflow-step-card">
                <span class="step-number">3</span>
                <h3 class="step-title"><?php echo esc_html($g3_title); ?></h3>
                <p class="step-desc"><?php echo esc_html($g3_desc); ?></p>
            </div>
        </div>

    </div>
</section>

<!-- ==========================================================================
   INTERACTIVE 7-DAY PRICE TREND MODAL
   ========================================================================== -->
<div class="modal-overlay" id="trendModal">
    <div class="modal-card">
        <div class="modal-header">
            <h3 class="modal-title" id="trendModalTitle">📈 7-Day Modal Price Trend</h3>
            <button type="button" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <div style="background:var(--bg-subtle); padding:1rem; border-radius:var(--radius-md); margin-bottom:1.5rem; display:flex; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
                <div>
                    <span style="font-size:0.8rem; color:var(--text-muted);">Current Modal Price</span>
                    <div id="trendCurrentPrice" style="font-size:1.4rem; font-weight:800; color:var(--primary);">₹1,540/Qtl</div>
                </div>
                <div>
                    <span style="font-size:0.8rem; color:var(--text-muted);">Weekly Change</span>
                    <div id="trendWeeklyDelta" style="font-size:1.2rem; font-weight:700; color:var(--success);">+₹60 (+4.0%)</div>
                </div>
            </div>
            <div style="position:relative; width:100%; height:260px;">
                <canvas id="trendCanvas" width="560" height="260" style="width:100%; height:100%;"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
   SMS PRICE ALERT SUBSCRIPTION MODAL
   ========================================================================== -->
<div class="modal-overlay" id="alertModal">
    <div class="modal-card" style="max-width:480px;">
        <div class="modal-header">
            <h3 class="modal-title">🔔 Subscribe to Daily Mandi SMS Alerts</h3>
            <button type="button" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <p style="font-size:0.88rem; color:var(--text-muted); margin-bottom:1.2rem;">
                Receive daily morning wholesale rates for your selected commodity directly on your mobile via free government SMS.
            </p>
            <form onsubmit="event.preventDefault(); if(window.showToast) showToast('SMS Alert subscription active! You will receive daily morning bulletins.', 'success'); ModalManager.close('alertModal');">
                <div class="calc-group">
                    <label class="calc-label">Select Crop:</label>
                    <select class="form-select" required>
                        <option value="">Choose Commodity...</option>
                        <option>Potato (Jyoti)</option>
                        <option>Potato (Chandramukhi)</option>
                        <option>Onion (Nasik / Local)</option>
                        <option>Paddy (Common / Grade-A)</option>
                        <option>Raw Jute (TD-5)</option>
                        <option>Mustard (Yellow)</option>
                        <option>Tomato (Hybrid)</option>
                    </select>
                </div>
                <div class="calc-group">
                    <label class="calc-label">Your Mandi / District:</label>
                    <select class="form-select" required>
                        <option value="">Choose District Mandi...</option>
                        <option>Sheoraphuli APMC (Hooghly)</option>
                        <option>Memari Central APMC (Burdwan)</option>
                        <option>Krishnanagar APMC (Nadia)</option>
                        <option>Matigara Yard (Siliguri)</option>
                        <option>English Bazar APMC (Malda)</option>
                        <option>Berhampore APMC (Murshidabad)</option>
                    </select>
                </div>
                <div class="calc-group">
                    <label class="calc-label">Mobile Number (10-digit):</label>
                    <input type="tel" class="form-input" placeholder="e.g. 9830012345" required pattern="[0-9]{10}">
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%; margin-top:0.8rem;">
                    📲 Activate Free SMS Alerts
                </button>
            </form>
        </div>
    </div>
</div>

<?php
get_footer();
