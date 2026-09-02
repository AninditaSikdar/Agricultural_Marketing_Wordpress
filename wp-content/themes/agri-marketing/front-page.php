<?php
/**
 * Template Name: Home Portal
 *
 * @package AgriMarketing
 */
get_header();

$theme_uri = get_template_directory_uri();
$hero_badge = get_option('agri_hero_badge', 'National Benchmark AgriTech & Price Intelligence Platform');
$hero_title = get_option('agri_hero_title', 'Empowering Farmers with Fair Prices & Digital Trade');
$hero_desc  = get_option('agri_hero_desc', 'Integrated digital infrastructure connecting 1.6M+ farmers, 4,367 connected mandis, instant e-Bijak invoicing, scientific quality assaying, and direct bank settlement.');
$stat_farmers = get_option('agri_stat_farmers', '1.6M+');
$stat_mandis  = get_option('agri_stat_mandis', '650+');

$hero_img = get_option('agri_hero_image');
if (empty($hero_img)) {
    $hero_img = get_post_meta(get_the_ID(), '_hero_image', true);
}
if (empty($hero_img) && has_post_thumbnail()) {
    $hero_img = get_the_post_thumbnail_url(null, 'full');
}
if (empty($hero_img)) {
    $hero_img = $theme_uri . '/images/hero-farmer.jpg';
}
?>

<!-- ==========================================================================
   HERO SECTION WITH VISUAL SHOWCASE & QUICK LOOKUP + VOICE SEARCH
   ========================================================================== -->
<section class="hero-section" id="home">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">
                <div class="hero-pill-badge">
                    🌿 <span data-i18n="hero_badge"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="hero-title">
                    <?php echo esc_html($hero_title); ?>
                </h1>
                <p class="hero-desc">
                    <?php echo esc_html($hero_desc); ?>
                </p>

                <div class="hero-actions">
                    <a href="<?php echo esc_url(home_url('/mandi-rates/')); ?>" class="btn hero-btn-rates">
                        📊 <span data-i18n="btn_explore_rates">Check Today's Mandi Rates</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/ebijak-ledger/')); ?>" class="btn hero-btn-ebijak">
                        📑 <span data-i18n="btn_ebijak">Generate e-Bijak Invoice</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/schemes/')); ?>" class="btn hero-btn-subsidy">
                        🧮 <span data-i18n="btn_calc_subsidy">Subsidy Calculator</span>
                    </a>
                </div>

                <!-- Instant Commodity Price Discovery Card -->
                <div class="hero-quick-discovery">
                    <div class="discovery-title">
                        <span>⚡ <span data-i18n="quick_widget_title">Instant Commodity Price Discovery</span></span>
                    </div>
                    <div class="discovery-form-row">
                        <select id="heroCropSelect" class="form-select" aria-label="Select Commodity">
                            <!-- Populated dynamically via app.js -->
                        </select>

                        <select id="heroDistrictSelect" class="form-select" aria-label="Select District">
                            <option value="all">All Districts</option>
                            <option value="Hooghly">Hooghly (হুগলি)</option>
                            <option value="Burdwan">Burdwan (পূর্ব ও পশ্চিম বর্ধমান)</option>
                            <option value="Nadia">Nadia (নদিয়া)</option>
                            <option value="Kolkata">Kolkata (কলকাতা)</option>
                            <option value="Murshidabad">Murshidabad (মুর্শিদাবাদ)</option>
                            <option value="Bankura">Bankura (বাঁকুড়া)</option>
                            <option value="Jalpaiguri">Jalpaiguri (জলপাইগুড়ি)</option>
                            <option value="Malda">Malda (মালদা)</option>
                        </select>

                        <button type="button" class="btn btn-primary" id="heroCheckPriceBtn">
                            🔍 <span data-i18n="btn_check_price">Get Price</span>
                        </button>
                    </div>

                    <!-- Quick Result Display Area -->
                    <div class="quick-result-card" id="heroQuickResult">
                        <div>
                            <strong id="qrCropName" style="color:var(--primary); font-size:1.05rem;">Potato (Jyoti)</strong>
                            <div style="font-size:0.8rem; color:var(--text-muted);">
                                <span data-i18n="quick_res_range">Range:</span> <strong id="qrRange">₹1,450 - ₹1,620</strong> |
                                <span data-i18n="quick_res_trend">Trend:</span> <strong id="qrTrend" style="color:var(--success);">▲ +₹40</strong>
                            </div>
                        </div>
                        <div style="text-align:right;">
                            <span style="font-size:0.75rem; color:var(--text-muted); display:block;" data-i18n="quick_res_modal">Modal Price:</span>
                            <span id="qrModalPrice" style="font-size:1.4rem; font-weight:800; color:var(--primary); font-family:'Outfit';">₹1,540/Qtl</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero Visual Media with Floating Interactive Cards -->
            <div class="hero-media-wrapper">
                <div class="hero-image-frame">
                    <img src="<?php echo esc_url($hero_img); ?>" alt="Agricultural Farmland & Fair Price Discovery" class="hero-main-img">
                </div>

                <!-- Floating Glass Card 1 -->
                <div class="hero-floating-card floating-card-1">
                    <div class="float-icon">🏛️</div>
                    <div>
                        <div class="float-val">4,367 Mandis</div>
                        <div class="float-lbl" data-i18n="float_mandi_count">Regulated Mandis (AGMARKNET)</div>
                    </div>
                </div>

                <!-- Floating Glass Card 2 -->
                <div class="hero-floating-card floating-card-2">
                    <div class="float-icon" style="background:var(--accent-soft); color:var(--accent-dark);">⚡</div>
                    <div>
                        <div class="float-val">100% DBT</div>
                        <div class="float-lbl" data-i18n="float_settlement">Direct Trade Settlements</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   KEY IMPACT STATS COUNTERS
   ========================================================================== -->
<section class="stats-banner-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon-box">🏢</div>
                <div>
                    <div class="stat-number" data-counter-target="650" data-counter-suffix="+" data-counter-duration="2000">0+</div>
                    <div class="stat-label" data-i18n="stat_mandis">Regulated Mandis</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon-box accent-bg">🌾</div>
                <div>
                    <div class="stat-number" data-counter-target="1.6" data-counter-decimals="1" data-counter-suffix="M+" data-counter-duration="2200">0.0M+</div>
                    <div class="stat-label" data-i18n="stat_farmers">Registered Farmers</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon-box blue-bg">🛒</div>
                <div>
                    <div class="stat-number" data-counter-target="450" data-counter-suffix="+" data-counter-duration="2400">0+</div>
                    <div class="stat-label" data-i18n="stat_outlets">Sufal Bangla Centers</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon-box">💰</div>
                <div>
                    <div class="stat-number" data-counter-target="7200" data-counter-prefix="₹" data-counter-suffix="+ Cr" data-counter-duration="2500">₹0+ Cr</div>
                    <div class="stat-label" data-i18n="stat_trade">Annual Trade Volume</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   MODULE A.3: ROLE-BASED PERSONA HUBS (FARMERS, TRADERS, COMMISSION AGENTS)
   ========================================================================== -->
<section class="section section-bg-alt" id="personaPortals">
    <div class="container">
        <div class="section-header">
            <div class="section-tag" data-i18n="persona_section_tag">🎯 Role-Based AgriTech Portals</div>
            <h2 class="section-title" data-i18n="persona_section_title">Workflows for Every Market Stakeholder</h2>
            <p class="section-subtitle" data-i18n="persona_section_sub">
                Benchmark workflows inspired by eNAM, AGMARKNET 2.0, Bijak, and FarmERP for farmers, buyers, and commission agents.
            </p>
        </div>

        <!-- Persona Navigation Switcher -->
        <div class="persona-tabs-nav">
            <button type="button" class="persona-tab-btn active" data-persona="farmer" data-i18n="tab_farmer">
                👨‍🌾 For Farmers & FPOs
            </button>
            <button type="button" class="persona-tab-btn" data-persona="trader" data-i18n="tab_trader">
                💼 For Traders & Buyers
            </button>
            <button type="button" class="persona-tab-btn" data-persona="agent" data-i18n="tab_agent">
                📑 For Commission Agents (Arhtiyas)
            </button>
        </div>

        <!-- PANE 1: FARMER WORKFLOWS -->
        <div class="persona-hub-pane active" id="pane-farmer">
            <div class="persona-grid">
                <!-- Feature 1: Check Mandi Bhav -->
                <div class="persona-feature-card">
                    <div class="persona-icon-box">📈</div>
                    <h3 class="persona-card-title" data-i18n="farmer_w1_title">Check Today's Mandi Bhav</h3>
                    <p class="persona-card-desc" data-i18n="farmer_w1_desc">
                        Real-time modal prices and arrival volume trends for 247 notified commodities across state mandis.
                    </p>
                    <a href="<?php echo esc_url(home_url('/mandi-rates/')); ?>" class="btn btn-outline" style="margin-top:auto;">
                        📊 Browse Mandi Rates →
                    </a>
                </div>

                <!-- Feature 2: Advance Gate Entry & Lot Creation -->
                <div class="persona-feature-card">
                    <div class="persona-icon-box" style="background:rgba(245, 158, 11, 0.15); color:var(--warning);">🚛</div>
                    <h3 class="persona-card-title" data-i18n="farmer_w2_title">Advance Gate Entry & Lot Creation</h3>
                    <p class="persona-card-desc" data-i18n="farmer_w2_desc">
                        Pre-register produce vehicle before arriving at APMC, generate a dynamic Lot ID, and track live weighbridge queue.
                    </p>
                    <button type="button" class="btn btn-primary" onclick="ModalManager.open('gateEntryModal')" style="margin-top:auto;">
                        📝 Pre-Register Vehicle & Lot →
                    </button>
                </div>

                <!-- Feature 3: Payment DBT Settlement Tracker -->
                <div class="persona-feature-card">
                    <div class="persona-icon-box" style="background:rgba(16, 185, 129, 0.15); color:var(--success);">💳</div>
                    <h3 class="persona-card-title" data-i18n="farmer_w3_title">Track Payment Transfer Status</h3>
                    <p class="persona-card-desc" data-i18n="farmer_w3_desc">
                        Track electronic bank credit and escrow release status using your Mandi Lot ID or UTR number.
                    </p>
                    <button type="button" class="btn btn-outline" onclick="ModalManager.open('dbtTrackerModal')" style="margin-top:auto;">
                        🔍 Check Settlement Status →
                    </button>
                </div>
            </div>
        </div>

        <!-- PANE 2: TRADER & BUYER WORKFLOWS -->
        <div class="persona-hub-pane" id="pane-trader">
            <div class="persona-grid">
                <!-- Feature 1: Browse Verified Lots -->
                <div class="persona-feature-card">
                    <div class="persona-icon-box">🔍</div>
                    <h3 class="persona-card-title" data-i18n="trader_w1_title">Browse Verified Produce Lots</h3>
                    <p class="persona-card-desc" data-i18n="trader_w1_desc">
                        Filter high-grade produce lots with objective moisture, grain size, and verified farmer KYC credentials.
                    </p>
                    <a href="<?php echo esc_url(home_url('/marketplace/')); ?>" class="btn btn-outline" style="margin-top:auto;">
                        🌾 View Verified Lots →
                    </a>
                </div>

                <!-- Feature 2: Quality Assaying Certificates -->
                <div class="persona-feature-card">
                    <div class="persona-icon-box" style="background:rgba(99, 102, 241, 0.15); color:#6366f1;">🧪</div>
                    <h3 class="persona-card-title" data-i18n="trader_w2_title">Digital Quality Assaying Certificates</h3>
                    <p class="persona-card-desc" data-i18n="trader_w2_desc">
                        Inspect laboratory-certified assay reports covering moisture content %, foreign matter %, and visual defect %.
                    </p>
                    <button type="button" class="btn btn-primary" onclick="MandiRatesModule.openAssayModal(1)" style="margin-top:auto;">
                        📄 View Sample Certificate →
                    </button>
                </div>

                <!-- Feature 3: Live E-Auction Floor -->
                <div class="persona-feature-card">
                    <div class="persona-icon-box" style="background:rgba(239, 68, 68, 0.15); color:#ef4444;">🏷️</div>
                    <h3 class="persona-card-title" data-i18n="trader_w3_title">Participate in Live E-Auction Floor</h3>
                    <p class="persona-card-desc" data-i18n="trader_w3_desc">
                        Transparent electronic bidding engine with countdown timers, competitive lot bidding, and instant trade confirmation.
                    </p>
                    <button type="button" class="btn btn-accent" onclick="ModalManager.open('liveAuctionModal')" style="margin-top:auto;">
                        ⚡ Enter Live Bidding Floor →
                    </button>
                </div>
            </div>
        </div>

        <!-- PANE 3: COMMISSION AGENT (ARHTIYA) WORKFLOWS -->
        <div class="persona-hub-pane" id="pane-agent">
            <div class="persona-grid">
                <!-- Feature 1: e-Bijak Invoicing -->
                <div class="persona-feature-card">
                    <div class="persona-icon-box">📑</div>
                    <h3 class="persona-card-title" data-i18n="agent_w1_title">Generate e-Bijak Digital Invoices</h3>
                    <p class="persona-card-desc" data-i18n="agent_w1_desc">
                        Standardized digital invoice builder calculating produce cost, APMC market cess (1.5%), commission %, and hamali fees.
                    </p>
                    <a href="<?php echo esc_url(home_url('/ebijak-ledger/')); ?>" class="btn btn-primary" style="margin-top:auto;">
                        ✨ Generate e-Bijak Bill →
                    </a>
                </div>

                <!-- Feature 2: Digital Khata -->
                <div class="persona-feature-card">
                    <div class="persona-icon-box" style="background:rgba(2, 132, 199, 0.15); color:var(--info);">📚</div>
                    <h3 class="persona-card-title" data-i18n="agent_w2_title">Manage Client Digital Ledgers (Khata)</h3>
                    <p class="persona-card-desc" data-i18n="agent_w2_desc">
                        Track client transaction records, buyer credit limits, outstanding dues, and digital payment receipts without paper ledgers.
                    </p>
                    <a href="<?php echo esc_url(home_url('/ebijak-ledger/')); ?>" class="btn btn-outline" style="margin-top:auto;">
                        📖 Open Digital Ledger →
                    </a>
                </div>

                <!-- Feature 3: APMC Tax Compliance -->
                <div class="persona-feature-card">
                    <div class="persona-icon-box" style="background:rgba(16, 185, 129, 0.15); color:var(--success);">🏛️</div>
                    <h3 class="persona-card-title" data-i18n="agent_w3_title">APMC Statutory & Tax Reports</h3>
                    <p class="persona-card-desc" data-i18n="agent_w3_desc">
                        Download itemized statutory fee statements, cess audit reports, and trade logs for state regulatory compliance.
                    </p>
                    <a href="<?php echo esc_url(home_url('/ebijak-ledger/')); ?>" class="btn btn-outline" style="margin-top:auto;">
                        📊 View Tax Statements →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   MODULE A.2: INTERACTIVE PRICE INTELLIGENCE DASHBOARD (7/30-DAY TRENDS)
   ========================================================================== -->
<section class="section" id="mandiPreview">
    <div class="container">
        <div class="section-header-flex">
            <div>
                <div class="section-tag" data-i18n="dashboard_tag">📊 Interactive Price Intelligence</div>
                <h2 class="section-title" data-i18n="dashboard_title">Multi-Mandi Price Intelligence & Trend Visualizer</h2>
                <p class="section-subtitle" data-i18n="dashboard_sub">
                    Analyze 7-day and 30-day historical modal price movements with daily arrival volume bars.
                </p>
            </div>
            <div style="display:flex; gap:0.75rem; align-items:center; flex-wrap:wrap;">
                <a href="<?php echo esc_url(home_url('/mandi-rates/')); ?>" class="btn btn-sm btn-outline">
                    🗺️ <span data-i18n="btn_arbitrage">Inter-Mandi Arbitrage</span>
                </a>
                <button class="btn btn-sm btn-primary" onclick="MandiRatesModule.exportCSV()">
                    📥 <span data-i18n="btn_download_csv">Export CSV</span>
                </button>
            </div>
        </div>

        <div class="mandi-board-card">
            <!-- Controls & Filters Bar -->
            <div class="mandi-controls-bar">
                <div class="category-tabs">
                    <button class="category-pill active" data-cat="all" data-i18n="tab_all">All Commodities</button>
                    <button class="category-pill" data-cat="veg" data-i18n="tab_veg">Vegetables</button>
                    <button class="category-pill" data-cat="grain" data-i18n="tab_grain">Cereals & Grains</button>
                    <button class="category-pill" data-cat="oilseed" data-i18n="tab_oilseed">Oilseeds & Cash Crops</button>
                    <button class="category-pill" data-cat="fruits" data-i18n="tab_fruits">Fruits</button>
                    <button class="category-pill" data-cat="spices" data-i18n="tab_spices">Spices</button>
                </div>

                <div class="filter-search-row">
                    <div class="search-input-wrap">
                        <span class="search-icon">🔍</span>
                        <input type="text" id="mandiSearchInput" class="form-input"
                            placeholder="Search crop (e.g. Potato, Onion, Rice)..." data-i18n="search_crop_ph">
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
                            <th data-i18n="th_trend">24h Trend & Arrivals</th>
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
                    Showing <span id="mandiStartIdx">1</span>–<span id="mandiEndIdx">6</span> of <strong id="mandiResultCount">12</strong> entries
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
    </div>
</section>

<!-- ==========================================================================
   MODULE A.4: PRICE DISCOVERY & NET FARMER REALISATION ADVISORY ENGINE (DOC SEC 8 & 9)
   ========================================================================== -->
<section class="section section-bg-alt" id="netRealisationSection">
    <div class="container">
        <div class="section-header">
            <div class="section-tag" data-i18n="net_real_tag">⚖️ Price Discovery & Net Farmer Advisory</div>
            <h2 class="section-title" data-i18n="net_real_title">Net Farmer Realisation Calculator & Corridor Advisory</h2>
            <p class="section-subtitle" data-i18n="net_real_sub">
                Instead of simply showing the highest gross market price, our intelligence engine calculates:
                <strong style="color:var(--primary); display:block; margin-top:0.4rem; font-family:'Outfit';">Net Realisation = Selling Price – Transportation – Handling – Commission – Storage – Statutory Cess</strong>
            </p>
        </div>

        <div class="net-realisation-card">
            <div class="net-real-grid">
                <!-- Left: Interactive Inputs -->
                <div class="net-real-inputs">
                    <h3 style="font-size:1.15rem; font-weight:800; color:var(--text-main); margin-bottom:1rem; display:flex; align-items:center; gap:0.5rem;">
                        <span>⚙️ Trade & Cost Parameters</span>
                    </h3>

                    <div class="form-grid-2">
                        <div class="calc-group">
                            <label class="calc-label">Select Commodity:</label>
                            <select id="nrCropSelect" class="form-select">
                                <option value="potato" data-price-local="1540" data-price-term="1780" data-loss="2">🥔 Potato (Jyoti Grade-A)</option>
                                <option value="rice" data-price-local="6500" data-price-term="7250" data-loss="1">🌾 Gobindobhog Rice</option>
                                <option value="onion" data-price-local="2350" data-price-term="2680" data-loss="3">🧅 Onion (Nashik Red)</option>
                                <option value="chilli" data-price-local="8200" data-price-term="9400" data-loss="2">🌶️ Purba Medinipur Chilli</option>
                                <option value="mango" data-price-local="4500" data-price-term="5800" data-loss="4">🥭 Malda Himsagar Mango</option>
                            </select>
                        </div>
                        <div class="calc-group">
                            <label class="calc-label">Lot Quantity (in Quintals):</label>
                            <input type="number" id="nrQuantity" class="form-input" value="100" min="10" max="1000">
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="calc-group">
                            <label class="calc-label">Local Mandi Selling Price (₹/Qtl):</label>
                            <input type="number" id="nrLocalPrice" class="form-input" value="1540">
                        </div>
                        <div class="calc-group">
                            <label class="calc-label">Terminal / Distant Price (₹/Qtl):</label>
                            <input type="number" id="nrTermPrice" class="form-input" value="1780">
                        </div>
                    </div>

                    <div class="form-grid-3" style="display:grid; grid-template-columns: repeat(3, 1fr); gap:0.75rem;">
                        <div class="calc-group">
                            <label class="calc-label">Transport (₹/Qtl):</label>
                            <input type="number" id="nrTransport" class="form-input" value="85">
                        </div>
                        <div class="calc-group">
                            <label class="calc-label">Handling/Hamali (₹/Qtl):</label>
                            <input type="number" id="nrHandling" class="form-input" value="25">
                        </div>
                        <div class="calc-group">
                            <label class="calc-label">Commission (₹/Qtl):</label>
                            <input type="number" id="nrCommission" class="form-input" value="30">
                        </div>
                    </div>

                    <div style="font-size:0.8rem; color:var(--text-muted); margin-top:0.5rem; background:rgba(255, 147, 1, 0.08); padding:0.6rem 0.85rem; border-radius:var(--radius-md); border-left:3px solid var(--accent);">
                        💡 <strong>Advisory Rule:</strong> Direct dispatch to terminal market is recommended only when Net Realisation exceeds Local Mandi return by ≥ 5%.
                    </div>
                </div>

                <!-- Right: Calculation Breakdown & Result Box -->
                <div class="net-real-output-card">
                    <div style="font-size:0.82rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.05em; font-weight:700;">Comparative Farmer Return</div>

                    <div class="net-real-comparison-boxes">
                        <div class="real-box local-box">
                            <div class="box-lbl">Option A: Local Mandi</div>
                            <div class="box-val" id="nrLocalNet">₹1,515 <small>/Qtl</small></div>
                            <div class="box-sub">Gross: ₹1,540 | Cess: ₹25</div>
                        </div>
                        <div class="real-box term-box">
                            <div class="box-lbl">Option B: Terminal Market</div>
                            <div class="box-val" id="nrTermNet" style="color:var(--success);">₹1,640 <small>/Qtl</small></div>
                            <div class="box-sub">Gross: ₹1,780 | Deductions: ₹140</div>
                        </div>
                    </div>

                    <div class="net-real-verdict-box" id="nrVerdictBox">
                        <div class="verdict-tag recommended">
                            ✅ Recommended: Dispatch to Terminal Market
                        </div>
                        <div style="font-size:0.92rem; font-weight:700; color:var(--text-main); margin-top:0.6rem;" id="nrGainText">
                            Farmer gains additional <strong style="color:var(--success);">+₹12,500 (+8.2%)</strong> Net Realisation on 100 Qtl lot!
                        </div>
                    </div>

                    <div style="display:flex; gap:0.6rem; margin-top:1.25rem;">
                        <a href="<?php echo esc_url(home_url('/logistics-freight/')); ?>" class="btn btn-primary" style="flex:1;">
                            🚛 Book Freight Dispatch →
                        </a>
                        <button type="button" class="btn btn-outline" onclick="ModalManager.open('sellRequestModal')">
                            📝 Post Sell Lot
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   SERVICES & INFRASTRUCTURE SLIDER (10 DOCUMENT PILLARS - SEC 1 TO 19)
   ========================================================================== -->
<section class="section services-slider-section" id="servicesSection">
    <div class="container">
        <div class="section-header-flex">
            <div class="section-header-left">
                <div class="section-tag" data-i18n="services_tag">🌟 Comprehensive Infrastructure</div>
                <h2 class="section-title" data-i18n="services_title">Agricultural Marketing Services & Infrastructure Grid</h2>
                <p class="section-subtitle" data-i18n="services_subtitle">
                    Explore end-to-end services across regulated markets, post-harvest processing, multi-tier logistics, cold chain, and direct trade.
                </p>
            </div>
            <div class="slider-arrow-controls">
                <button class="slider-arrow-btn" id="servicesPrevBtn" aria-label="Previous Service Slide">‹</button>
                <button class="slider-arrow-btn" id="servicesNextBtn" aria-label="Next Service Slide">›</button>
            </div>
        </div>

        <div class="services-slider-container" id="servicesSliderContainer">
            <div class="services-slider-track" id="servicesSliderTrack">
                <!-- 1. Daily Mandi Rates & AGMARKNET 2.0 (Sec 8) -->
                <div class="service-slide-item">
                    <div class="service-card">
                        <div class="service-card-icon">📈</div>
                        <h3 class="service-card-title" data-i18n="srv_mandi_title">Daily Mandi Rates & Bhav</h3>
                        <p class="service-card-desc" data-i18n="srv_mandi_desc">
                            Live AGMARKNET 2.0 APMC prices, 24-hour arrivals, inter-district spread, and interactive 7/30-day price intelligence visualizer.
                        </p>
                        <a href="<?php echo esc_url(home_url('/mandi-rates/')); ?>" class="service-card-link" data-i18n="srv_mandi_link">Explore Mandi Rates →</a>
                    </div>
                </div>

                <!-- 2. e-Bijak Invoicing & Ledgers (Sec 7) -->
                <div class="service-slide-item">
                    <div class="service-card">
                        <div class="service-card-icon" style="background:rgba(217, 119, 6, 0.15); color:var(--accent-dark);">📑</div>
                        <h3 class="service-card-title" data-i18n="srv_ebijak_title">e-Bijak Digital Invoicing</h3>
                        <p class="service-card-desc" data-i18n="srv_ebijak_desc">
                            Automated digital invoicing calculating APMC market cess (1.5%), commission %, hamali fees, and client digital ledgers (Khata).
                        </p>
                        <a href="<?php echo esc_url(home_url('/ebijak-ledger/')); ?>" class="service-card-link" data-i18n="srv_ebijak_link">Generate e-Bijak Bill →</a>
                    </div>
                </div>

                <!-- 3. 4-Tier Agri-Logistics & Freight Hub (Sec 5) -->
                <div class="service-slide-item">
                    <div class="service-card">
                        <div class="service-card-icon" style="background:rgba(16, 185, 129, 0.15); color:var(--success);">🚛</div>
                        <h3 class="service-card-title" data-i18n="srv_freight_title">4-Tier Agri-Logistics Hub</h3>
                        <p class="service-card-desc" data-i18n="srv_freight_desc">
                            Farm-to-hub transit, GPS tracking, load optimization, digital LR challans, and commercial fleet dispatch with subsidy integration.
                        </p>
                        <a href="<?php echo esc_url(home_url('/logistics-freight/')); ?>" class="service-card-link" data-i18n="srv_freight_link">Calculate Freight →</a>
                    </div>
                </div>

                <!-- 4. WDRA Cold Storage & Grain Silos (Sec 3 & 4) -->
                <div class="service-slide-item">
                    <div class="service-card">
                        <div class="service-card-icon" style="background:rgba(2, 132, 199, 0.15); color:var(--info);">❄️</div>
                        <h3 class="service-card-title" data-i18n="srv_cold_title">Cold Storage & Silos</h3>
                        <p class="service-card-desc" data-i18n="srv_cold_desc">
                            Multi-commodity cold storage, potato preservation, grain silos, and electronic Negotiable Warehouse Receipt (e-NWR) pledge financing.
                        </p>
                        <a href="<?php echo esc_url(home_url('/cold-storage/')); ?>" class="service-card-link" data-i18n="srv_cold_link">Find Storage Units →</a>
                    </div>
                </div>

                <!-- 5. Farm Connect & Direct Trade (Sec 7 & 16) -->
                <div class="service-slide-item">
                    <div class="service-card">
                        <div class="service-card-icon" style="background:rgba(99, 102, 241, 0.15); color:#6366f1;">🤝</div>
                        <h3 class="service-card-title" data-i18n="srv_market_title">Farm Connect Marketplace</h3>
                        <p class="service-card-desc" data-i18n="srv_market_desc">
                            Direct farm-to-buyer e-marketplace for verified produce, institutional bulk procurement RFPs, and transparent live electronic auction floor.
                        </p>
                        <a href="<?php echo esc_url(home_url('/marketplace/')); ?>" class="service-card-link" data-i18n="srv_market_link">View Produce Lots →</a>
                    </div>
                </div>

                <!-- 6. Post-Harvest & Quality Assaying (Sec 2 & 10) -->
                <div class="service-slide-item">
                    <div class="service-card">
                        <div class="service-card-icon" style="background:rgba(168, 85, 247, 0.15); color:#a855f7;">🧪</div>
                        <h3 class="service-card-title">Post-Harvest & Quality Labs</h3>
                        <p class="service-card-desc">
                            Scientific moisture testing, grade determination, visual purity, and AGMARK laboratory certificates with QR code traceability.
                        </p>
                        <a href="<?php echo esc_url(home_url('/about/')); ?>" class="service-card-link">View Lab Infrastructure →</a>
                    </div>
                </div>

                <!-- 7. Regional GI Produce & Branding (Sec 11) -->
                <div class="service-slide-item">
                    <div class="service-card">
                        <div class="service-card-icon" style="background:rgba(236, 72, 153, 0.15); color:#ec4899;">🏷️</div>
                        <h3 class="service-card-title">GI Produce & Branding Hub</h3>
                        <p class="service-card-desc">
                            Promoting West Bengal GI commodities: Malda Mango, Purba Medinipur Chilli, Bankura Rice, and Sundarbans Honey with retail packaging.
                        </p>
                        <a href="<?php echo esc_url(home_url('/marketplace/')); ?>" class="service-card-link">Explore GI Produce →</a>
                    </div>
                </div>

                <!-- 8. Krishak Bazar Managed Services (Sec 1 & 17) -->
                <div class="service-slide-item">
                    <div class="service-card">
                        <div class="service-card-icon" style="background:rgba(20, 184, 166, 0.15); color:#14b8a6;">🏛️</div>
                        <h3 class="service-card-title">Krishak Bazar O&M Services</h3>
                        <p class="service-card-desc">
                            Comprehensive market administration, stall allocations, shop-cum-godowns, electronic weighbridges, and waste management.
                        </p>
                        <a href="<?php echo esc_url(home_url('/about/')); ?>" class="service-card-link">Explore Market Yards →</a>
                    </div>
                </div>

                <!-- 9. FPO & Farmer Aggregation (Sec 6 & 14) -->
                <div class="service-slide-item">
                    <div class="service-card">
                        <div class="service-card-icon" style="background:rgba(249, 115, 22, 0.15); color:#f97316;">👥</div>
                        <h3 class="service-card-title">FPO Marketing Support Center</h3>
                        <p class="service-card-desc">
                            Dedicated FPO registration, collective bargaining, bulk procurement aggregation, buyer matching, and working-capital advisory.
                        </p>
                        <a href="<?php echo esc_url(home_url('/schemes/')); ?>" class="service-card-link">FPO Support Services →</a>
                    </div>
                </div>

                <!-- 10. Export Infrastructure & Cargo (Sec 13) -->
                <div class="service-slide-item">
                    <div class="service-card">
                        <div class="service-card-icon" style="background:rgba(59, 130, 246, 0.15); color:#3b82f6;">✈️</div>
                        <h3 class="service-card-title">Export Pack Houses & Logistics</h3>
                        <p class="service-card-desc">
                            APEDA certified export pack houses, integrated cold chains, container consolidation, and port cargo logistics for mango, tea, and rice.
                        </p>
                        <a href="<?php echo esc_url(home_url('/about/')); ?>" class="service-card-link">Export Facilities →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   MODULE B.1: WEST BENGAL REGIONAL GI & SPECIALITY COMMODITY SHOWCASE (DOC SEC 11)
   ========================================================================== -->
<section class="section section-bg-alt" id="giShowcaseSection">
    <div class="container">
        <div class="section-header-flex">
            <div>
                <div class="section-tag">🏷️ Geographical Indication (GI) & Speciality Produce</div>
                <h2 class="section-title">West Bengal Flagship Commodity Branding</h2>
                <p class="section-subtitle">
                    Dedicated commodity-specific infrastructure, branding, certified packaging, and QR traceability for indigenous agricultural wealth.
                </p>
            </div>
            <div>
                <a href="<?php echo esc_url(home_url('/marketplace/')); ?>" class="btn btn-outline">
                    🛒 Browse All GI Produce Lots →
                </a>
            </div>
        </div>

        <div class="gi-showcase-grid">
            <!-- 1. Malda Mango -->
            <div class="gi-card">
                <div class="gi-badge">GI Tagged</div>
                <div class="gi-icon">🥭</div>
                <h3 class="gi-title">Malda Mango (Fazli & Himsagar)</h3>
                <p class="gi-origin">📍 District: Malda (মালদা)</p>
                <p class="gi-desc">Famous for sweet pulp and high export demand. Supported by dedicated cold rooms, vapor heat treatment, and packaging centres.</p>
                <div class="gi-tags">
                    <span>Export Quality</span>
                    <span>APEDA Certified</span>
                    <span>Traceable</span>
                </div>
                <a href="<?php echo esc_url(home_url('/marketplace/')); ?>" class="gi-link">View Malda Lots →</a>
            </div>

            <!-- 2. Purba Medinipur Chilli -->
            <div class="gi-card">
                <div class="gi-badge">Speciality Cluster</div>
                <div class="gi-icon">🌶️</div>
                <h3 class="gi-title">Purba Medinipur Chilli</h3>
                <p class="gi-origin">📍 District: Purba Medinipur (পূর্ব মেদিনীপুর)</p>
                <p class="gi-desc">High capsaicin content and vibrant color. Supported by commodity-specific drying yards, sorting facilities, and bulk processing.</p>
                <div class="gi-tags">
                    <span>High Pungency</span>
                    <span>Direct FPO</span>
                    <span>Lab Tested</span>
                </div>
                <a href="<?php echo esc_url(home_url('/marketplace/')); ?>" class="gi-link">View Chilli Lots →</a>
            </div>

            <!-- 3. Bankura Gobindobhog Rice -->
            <div class="gi-card">
                <div class="gi-badge">GI Tagged</div>
                <div class="gi-icon">🌾</div>
                <h3 class="gi-title">Bankura Gobindobhog Rice</h3>
                <p class="gi-origin">📍 District: Bankura & Burdwan (বাঁকুড়া / বর্ধমান)</p>
                <p class="gi-desc">Aromatic short-grain heritage rice. Premium grading, dehusking, destoning, and vacuum retail packaging support.</p>
                <div class="gi-tags">
                    <span>Aromatic Heritage</span>
                    <span>AGMARK Graded</span>
                    <span>100% Pure</span>
                </div>
                <a href="<?php echo esc_url(home_url('/marketplace/')); ?>" class="gi-link">View Rice Lots →</a>
            </div>

            <!-- 4. Sundarbans Organic Honey -->
            <div class="gi-card">
                <div class="gi-badge">GI Tagged</div>
                <div class="gi-icon">🍯</div>
                <h3 class="gi-title">Sundarbans Mangrove Honey</h3>
                <p class="gi-origin">📍 District: South 24 Parganas (সুন্দরবন)</p>
                <p class="gi-desc">Pure wild mangrove forest honey with high therapeutic properties. AGMARK Grade-A certified with FSSAI compliance.</p>
                <div class="gi-tags">
                    <span>100% Wild Forest</span>
                    <span>AGMARK Grade-A</span>
                    <span>FSSAI Compliant</span>
                </div>
                <a href="<?php echo esc_url(home_url('/marketplace/')); ?>" class="gi-link">View Honey Lots →</a>
            </div>

            <!-- 5. Nadia Fresh Vegetables -->
            <div class="gi-card">
                <div class="gi-badge">Agri Export Cluster</div>
                <div class="gi-icon">🥬</div>
                <h3 class="gi-title">Nadia Intensive Vegetables</h3>
                <p class="gi-origin">📍 District: Nadia (নদিয়া)</p>
                <p class="gi-desc">High-yield direct farm-fresh greens and exotic vegetables connected to Sufal Bangla retail hubs via reefer logistics.</p>
                <div class="gi-tags">
                    <span>Same-Day Harvest</span>
                    <span>Sufal Bangla</span>
                    <span>0% Residue</span>
                </div>
                <a href="<?php echo esc_url(home_url('/marketplace/')); ?>" class="gi-link">View Vegetable Lots →</a>
            </div>

            <!-- 6. Darjeeling Orthodox Tea -->
            <div class="gi-card">
                <div class="gi-badge">GI Tagged</div>
                <div class="gi-icon">🍵</div>
                <h3 class="gi-title">Darjeeling Orthodox Tea</h3>
                <p class="gi-origin">📍 District: Darjeeling (দার্জিলিং)</p>
                <p class="gi-desc">The 'Champagne of Teas' with distinct muscatel flavour. Complete electronic auction catalogue and international export testing.</p>
                <div class="gi-tags">
                    <span>World GI</span>
                    <span>Single Estate</span>
                    <span>E-Auction</span>
                </div>
                <a href="<?php echo esc_url(home_url('/marketplace/')); ?>" class="gi-link">View Tea Lots →</a>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   MODAL DIALOGS
   ========================================================================== -->
<!-- 1. Interactive Canvas Price Chart Modal -->
<div class="modal-overlay" id="chartModal">
    <div class="modal-card" style="max-width:720px;">
        <div class="modal-header">
            <div>
                <h3 class="modal-title" id="modalCropTitle">Potato (Jyoti) - Hooghly APMC</h3>
                <div style="font-size:0.85rem; color:var(--text-muted);">
                    Lot Ref: <span id="modalLotBadge" class="badge-apmc-licensed" style="margin-left:0.35rem;">LOT-HGY-8841</span>
                </div>
            </div>
            <button type="button" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; flex-wrap:wrap; gap:0.5rem;">
                <div>
                    <span style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase;">Today's Modal Rate</span>
                    <div style="font-size:1.8rem; font-weight:800; color:var(--primary); font-family:'Outfit';" id="modalCurrentPrice">₹1,540 / Qtl</div>
                </div>
                <div style="text-align:right;">
                    <div class="timeframe-switchers">
                        <button type="button" class="timeframe-btn active" data-days="7" data-i18n="tab_7day">7-Day Trend</button>
                        <button type="button" class="timeframe-btn" data-days="30" data-i18n="tab_30day">30-Day Trend</button>
                    </div>
                    <div style="font-size:0.8rem; color:var(--text-muted); margin-top:0.4rem;" id="modalMinMax">Min: ₹1,450 | Max: ₹1,620</div>
                </div>
            </div>
            <div class="chart-canvas-wrapper">
                <canvas id="priceTrendChart"></canvas>
            </div>
            <div style="display:flex; justify-content:space-between; align-items:center; font-size:0.82rem; color:var(--text-muted); margin-top:1rem; flex-wrap:wrap; gap:0.5rem;">
                <span>📊 Source: AGMARKNET 2.0 / e-NAM Live APMC Checkpost Feed</span>
                <button class="btn btn-sm btn-primary" onclick="ModalManager.open('alertModal'); ModalManager.close('chartModal');">
                    🔔 Track Crop via SMS
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 3. Quality Assaying Certificate Modal -->
<div class="modal-overlay" id="assayModal">
    <div class="modal-card" style="max-width:620px;">
        <div class="modal-header">
            <div>
                <h3 class="modal-title" id="assayCropTitle">🧪 Quality Assaying Certificate</h3>
                <div style="font-size:0.85rem; color:var(--text-muted);">Assaying Lab Report Ref: <strong id="assayCertId">WB-QC-2026-8841</strong></div>
            </div>
            <button type="button" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
                <span class="assay-header-badge" id="assayAgmarkBadge">AGMARK Grade-I</span>
                <span class="badge-verified-kyc" id="assayFssaiBadge">FSSAI Grade-A</span>
                <span style="font-size:0.85rem; color:var(--text-muted);">Lot: <strong id="assayLotId">LOT-HGY-8841</strong></span>
            </div>
            <div class="assay-grid-params">
                <div class="assay-param-box"><div class="assay-param-val" id="assayMoisture">11.2%</div><div class="assay-param-lbl">Moisture Level</div></div>
                <div class="assay-param-box"><div class="assay-param-val" id="assayForeign">0.3%</div><div class="assay-param-lbl">Foreign Matter</div></div>
                <div class="assay-param-box"><div class="assay-param-val" id="assayGrain">45-55 mm</div><div class="assay-param-lbl">Size Uniformity</div></div>
                <div class="assay-param-box"><div class="assay-param-val" id="assayDefect">0.5%</div><div class="assay-param-lbl">Visual Defect</div></div>
            </div>
            <button type="button" class="btn btn-primary" style="width:100%;" onclick="showToast('Assaying Certificate PDF Downloaded!', 'success')">
                📄 Download Official Assaying Certificate (PDF)
            </button>
        </div>
    </div>
</div>

<!-- 4. Advance Gate Entry Registration Modal -->
<div class="modal-overlay" id="gateEntryModal">
    <div class="modal-card" style="max-width:540px;">
        <div class="modal-header">
            <h3 class="modal-title">🚛 Advance APMC Gate Entry Registration</h3>
            <button type="button" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <form id="advanceGateEntryForm">
                <div class="calc-group">
                    <label class="calc-label">Farmer / Producer Name:</label>
                    <input type="text" id="gateFarmerName" class="form-input" value="Subhash Mondal" required>
                </div>
                <div class="form-grid-2">
                    <div class="calc-group">
                        <label class="calc-label">Mobile Number:</label>
                        <input type="tel" id="gateFarmerMobile" class="form-input" value="9830112233" required>
                    </div>
                    <div class="calc-group">
                        <label class="calc-label">Transport Vehicle No:</label>
                        <input type="text" id="gateVehicleNum" class="form-input" value="WB-15-B-4412" required>
                    </div>
                </div>
                <div class="form-grid-2">
                    <div class="calc-group">
                        <label class="calc-label">Commodity & Variety:</label>
                        <select id="gateCropSelect" class="form-select">
                            <option value="Potato (Jyoti)">🥔 Potato (Jyoti Grade-A)</option>
                            <option value="Potato (Chandramukhi)">🥔 Potato (Chandramukhi)</option>
                            <option value="Gobindobhog Rice">🌾 Gobindobhog Rice</option>
                            <option value="Mustard Seeds">🌻 Mustard (Yellow)</option>
                            <option value="Raw Jute">🌿 Raw Jute (TD-5)</option>
                        </select>
                    </div>
                    <div class="calc-group">
                        <label class="calc-label">Estimated Quantity (Qtl):</label>
                        <input type="number" id="gateQtyInput" class="form-input" value="50" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%; margin-top:0.75rem;">
                    ✨ Generate Dynamic Lot ID & Gate Pass
                </button>
            </form>
            <div id="gatePassResult"></div>
        </div>
    </div>
</div>

<!-- 5. Payment Settlement DBT Status Modal -->
<div class="modal-overlay" id="dbtTrackerModal">
    <div class="modal-card" style="max-width:480px;">
        <div class="modal-header">
            <h3 class="modal-title">💳 DBT Payment Settlement Tracker</h3>
            <button type="button" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <form id="dbtStatusForm">
                <div class="calc-group">
                    <label class="calc-label">Enter Lot ID or UTR Number:</label>
                    <input type="text" id="dbtUtrInput" class="form-input" value="UTR-2026-WB-8819" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;">
                    🔍 Verify Payment Status
                </button>
            </form>
            <div id="dbtStatusResult"></div>
        </div>
    </div>
</div>

<!-- 6. Live E-Auction Simulator Modal -->
<div class="modal-overlay" id="liveAuctionModal">
    <div class="modal-card" style="max-width:540px;">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">🏷️ Live APMC Electronic Auction Floor</h3>
                <div style="font-size:0.85rem; color:var(--text-muted);">Active Lot: <strong>LOT-HGY-8841 (Potato Jyoti - 100 Qtl)</strong></div>
            </div>
            <button type="button" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <div class="auction-card">
                <span class="auction-live-pill">🔴 LIVE BIDDING</span>
                <div style="font-size:0.85rem; color:var(--text-muted); text-transform:uppercase;">Time Remaining for Lot</div>
                <div class="auction-timer" id="auctionTimerDisplay">02:25</div>
                <div style="display:flex; justify-content:space-between; align-items:flex-end; margin:1rem 0;">
                    <div>
                        <span style="font-size:0.8rem; color:var(--text-muted);">Current Highest Bid:</span>
                        <div style="font-size:2rem; font-weight:800; color:var(--primary); font-family:'Outfit';" id="auctionCurrentBid">₹1,540</div>
                    </div>
                    <div style="text-align:right;">
                        <span class="badge-verified-kyc">4 Verified Bidders Active</span>
                    </div>
                </div>
                <div style="display:flex; gap:0.5rem; margin-top:1.25rem;">
                    <button type="button" class="btn btn-primary" style="flex:1;" onclick="placeAuctionBid(20)">+₹20 (Bid ₹1,560)</button>
                    <button type="button" class="btn btn-accent" style="flex:1;" onclick="placeAuctionBid(50)">+₹50 (Bid ₹1,590)</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 7. SMS Alert Modal -->
<div class="modal-overlay" id="alertModal">
    <div class="modal-card" style="max-width:480px;">
        <div class="modal-header">
            <h3 class="modal-title">🔔 Daily Mandi Price Alerts</h3>
            <button type="button" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <p style="font-size:0.9rem; color:var(--text-muted); margin-bottom:1.25rem;">
                Get real-time morning SMS / WhatsApp alerts for your chosen crops directly from your local APMC Mandi.
            </p>
            <form id="smsAlertForm">
                <div class="calc-group">
                    <label class="calc-label">Mobile Number (WhatsApp Enabled):</label>
                    <input type="tel" class="form-input" placeholder="e.g. 9830012345" required pattern="[0-9]{10}">
                </div>
                <div class="calc-group">
                    <label class="calc-label">Select Primary Commodity:</label>
                    <select class="form-select" required>
                        <option value="potato">🥔 Potato (আলু / आलू)</option>
                        <option value="onion">🧅 Onion (পেঁয়াজ / प्याज)</option>
                        <option value="rice">🌾 Paddy & Rice (ধান ও চাল)</option>
                        <option value="tomato">🍅 Tomato (টমেটো)</option>
                        <option value="jute">🌿 Raw Jute (পাট)</option>
                        <option value="mustard">🌻 Mustard (সরিষা)</option>
                    </select>
                </div>
                <div class="calc-group">
                    <label class="calc-label">Select Mandi / District:</label>
                    <select class="form-select" required>
                        <option value="hooghly">Hooghly APMC</option>
                        <option value="burdwan">Burdwan Mandi</option>
                        <option value="nadia">Nadia Central</option>
                        <option value="kolkata">Kolkata Koley Market</option>
                        <option value="all">State Average Bulletin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%; margin-top:0.5rem;">
                    ✨ Activate Free SMS Alerts
                </button>
            </form>
        </div>
    </div>
</div>

<!-- 8. Farmer Produce Sell Request Modal (Doc Sec 7) -->
<div class="modal-overlay" id="sellRequestModal">
    <div class="modal-card" style="max-width:540px;">
        <div class="modal-header">
            <h3 class="modal-title">🌾 Farmer Direct Sell Request</h3>
            <button type="button" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <p style="font-size:0.85rem; color:var(--text-muted); margin-bottom:1rem;">
                List your harvest produce directly on the State Agricultural Marketing Board portal for verified buyers and institutional procurement.
            </p>
            <form onsubmit="event.preventDefault(); showToast('Sell Request submitted successfully! Local APMC Field Officer will verify lot.', 'success'); ModalManager.close('sellRequestModal');">
                <div class="form-grid-2">
                    <div class="calc-group">
                        <label class="calc-label">Farmer / FPO Name:</label>
                        <input type="text" class="form-input" placeholder="e.g. Ramesh Ghosh" required>
                    </div>
                    <div class="calc-group">
                        <label class="calc-label">Phone / WhatsApp:</label>
                        <input type="tel" class="form-input" placeholder="e.g. 9830012345" required>
                    </div>
                </div>
                <div class="form-grid-2">
                    <div class="calc-group">
                        <label class="calc-label">Crop & Variety:</label>
                        <input type="text" class="form-input" placeholder="e.g. Gobindobhog Rice" required>
                    </div>
                    <div class="calc-group">
                        <label class="calc-label">Available Quantity (Qtl):</label>
                        <input type="number" class="form-input" placeholder="100" required>
                    </div>
                </div>
                <div class="form-grid-2">
                    <div class="calc-group">
                        <label class="calc-label">Expected Price (₹/Qtl):</label>
                        <input type="number" class="form-input" placeholder="6800" required>
                    </div>
                    <div class="calc-group">
                        <label class="calc-label">Mandi / District Location:</label>
                        <input type="text" class="form-input" placeholder="e.g. Burdwan" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%; margin-top:0.5rem;">
                    🚀 Publish Sell Offer
                </button>
            </form>
        </div>
    </div>
</div>

<!-- 9. Institutional Bulk RFP Post Modal (Doc Sec 7 & 16) -->
<div class="modal-overlay" id="bulkRfpModal">
    <div class="modal-card" style="max-width:540px;">
        <div class="modal-header">
            <h3 class="modal-title">🏢 Institutional Bulk Procurement RFP</h3>
            <button type="button" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <p style="font-size:0.85rem; color:var(--text-muted); margin-bottom:1rem;">
                Post your bulk commodity demand (Hotels, Hospitals, Supermarkets, Food Processors, Government Caterers) to receive competitive FPO bids.
            </p>
            <form onsubmit="event.preventDefault(); showToast('Institutional RFP posted! Verified FPOs will submit quotations.', 'success'); ModalManager.close('bulkRfpModal');">
                <div class="calc-group">
                    <label class="calc-label">Organization / Buyer Name:</label>
                    <input type="text" class="form-input" placeholder="e.g. Metro Retail Supermarkets Ltd." required>
                </div>
                <div class="form-grid-2">
                    <div class="calc-group">
                        <label class="calc-label">Buyer Category:</label>
                        <select class="form-select" required>
                            <option value="hotel">Hotel / Restaurant Chain</option>
                            <option value="supermarket">Supermarket / Retail Chain</option>
                            <option value="processor">Food Processing Company</option>
                            <option value="hospital">Hospital / Institution / Hostel</option>
                            <option value="exporter">Agri Exporter</option>
                        </select>
                    </div>
                    <div class="calc-group">
                        <label class="calc-label">Contact Phone:</label>
                        <input type="tel" class="form-input" placeholder="e.g. 9830012345" required>
                    </div>
                </div>
                <div class="form-grid-2">
                    <div class="calc-group">
                        <label class="calc-label">Required Commodity:</label>
                        <input type="text" class="form-input" placeholder="e.g. Potato / Yellow Mustard" required>
                    </div>
                    <div class="calc-group">
                        <label class="calc-label">Monthly Volume (Qtl/MT):</label>
                        <input type="number" class="form-input" placeholder="500" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-accent" style="width:100%; margin-top:0.5rem;">
                    📢 Post Institutional RFP Tender
                </button>
            </form>
        </div>
    </div>
</div>

<?php get_footer(); ?>
