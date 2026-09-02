<?php
/**
 * Template Name: Home Portal
 *
 * @package AgriMarketing
 */
get_header();

$theme_uri = get_template_directory_uri();
$hero_badge = get_option('agri_hero_badge', 'Agricultural Price Discovery & Market Intelligence');
$hero_title = get_option('agri_hero_title', 'Empowering Farmers with Fair Prices & Smart Markets');
$hero_desc  = get_option('agri_hero_desc', 'Connecting 1.6M+ farmers directly with regulated mandis, Sufal Bangla retail hubs, modern cold chains, and transparent electronic trading across the state.');
$stat_farmers = get_option('agri_stat_farmers', '1.6M+');
$stat_mandis  = get_option('agri_stat_mandis', '650+');
$stat_cold_storage = get_option('agri_stat_cold_storage', '480+');
$stat_subsidy = get_option('agri_stat_subsidy', '₹1,250 Cr');
?>

<!-- ==========================================================================
   HERO SECTION WITH VISUAL SHOWCASE & QUICK LOOKUP
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
                    <a href="<?php echo esc_url(home_url('/mandi-rates/')); ?>" class="btn btn-primary">
                        📊 <span data-i18n="btn_explore_rates">Check Today's Mandi Rates</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/schemes/')); ?>" class="btn btn-outline">
                        🛒 <span data-i18n="btn_sufal_bangla">Sufal Bangla Outlets</span>
                    </a>
                </div>

                <!-- Instant Commodity Price Discovery Card -->
                <div class="hero-quick-discovery">
                    <div class="discovery-title">
                        ⚡ <span data-i18n="quick_widget_title">Instant Commodity Price Discovery</span>
                    </div>
                    <div class="discovery-form-row">
                        <select id="heroCropSelect" class="form-select" aria-label="Select Commodity">
                            <!-- Populated dynamically -->
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
                    <img src="<?php echo esc_url($theme_uri . '/images/hero-farmer.jpg'); ?>" alt="Agricultural Farmland & Fresh Harvest Produce" class="hero-main-img">
                </div>

                <!-- Floating Glass Card 1 -->
                <div class="hero-floating-card floating-card-1">
                    <div class="float-icon">🏛️</div>
                    <div>
                        <div class="float-val"><?php echo esc_html($stat_mandis); ?> APMC</div>
                        <div class="float-lbl" data-i18n="float_mandi_count">Regulated APMC Mandis</div>
                    </div>
                </div>

                <!-- Floating Glass Card 2 -->
                <div class="hero-floating-card floating-card-2">
                    <div class="float-icon" style="background:var(--accent-soft); color:var(--accent-dark);">✨</div>
                    <div>
                        <div class="float-val">98.4%</div>
                        <div class="float-lbl" data-i18n="float_accuracy">Price Discovery Accuracy</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   KEY IMPACT STATS TICKER SECTION
   ========================================================================== -->
<section class="stats-ribbon">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon-box">🌾</div>
                <div>
                    <div class="stat-number" data-counter-target="650" data-counter-suffix="+" data-counter-duration="2000"><?php echo esc_html($stat_mandis); ?></div>
                    <div class="stat-label" data-i18n="stat_mandis">Regulated APMC Mandis</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon-box green-bg">👨‍🌾</div>
                <div>
                    <div class="stat-number" data-counter-target="1.6" data-counter-suffix="M+" data-counter-decimals="1" data-counter-duration="2200"><?php echo esc_html($stat_farmers); ?></div>
                    <div class="stat-label" data-i18n="stat_farmers">Registered Farmers</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon-box blue-bg">🛒</div>
                <div>
                    <div class="stat-number" data-counter-target="450" data-counter-suffix="+" data-counter-duration="2400"><?php echo esc_html($stat_cold_storage); ?></div>
                    <div class="stat-label" data-i18n="stat_outlets">Sufal Bangla Centers</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon-box">💰</div>
                <div>
                    <div class="stat-number" data-counter-target="7200" data-counter-prefix="₹" data-counter-suffix="+ Cr" data-counter-duration="2500"><?php echo esc_html($stat_subsidy); ?></div>
                    <div class="stat-label" data-i18n="stat_trade">Annual Trade Volume</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   DEPARTMENT SERVICES & INFRASTRUCTURE
   ========================================================================== -->
<section class="section section-bg-alt services-slider-section" id="servicesSection">
    <div class="container">
        <div class="section-header-flex">
            <div class="section-header-left">
                <div class="section-tag" data-i18n="services_tag">🌟 Comprehensive Services</div>
                <h2 class="section-title" data-i18n="services_title">Agricultural Marketing Services & Infrastructure</h2>
                <p class="section-subtitle" data-i18n="services_subtitle">
                    Access real-time commodity rates, government subsidies, cold chain storage facilities, and farm produce marketing.
                </p>
            </div>
            <!-- Slider Nav Arrow Controls -->
            <div class="slider-arrow-controls">
                <button class="slider-arrow-btn" id="servicesPrevBtn" aria-label="Previous Service Slide">‹</button>
                <button class="slider-arrow-btn" id="servicesNextBtn" aria-label="Next Service Slide">›</button>
            </div>
        </div>

        <!-- Auto Slider Track Container -->
        <div class="services-slider-container" id="servicesSliderContainer">
            <div class="services-slider-track" id="servicesSliderTrack">
                <!-- Service 1: Mandi Rates -->
                <div class="service-slide-item">
                    <div class="service-card">
                        <div class="service-card-icon">📈</div>
                        <h3 class="service-card-title" data-i18n="srv_mandi_title">Daily Mandi Rates</h3>
                        <p class="service-card-desc" data-i18n="srv_mandi_desc">
                            Live APMC checkpost prices, 24-hour trends, modal price comparison, and interactive 7-day canvas charts.
                        </p>
                        <a href="<?php echo esc_url(home_url('/mandi-rates/')); ?>" class="service-card-link" data-i18n="srv_mandi_link">Explore Mandi Rates →</a>
                    </div>
                </div>

                <!-- Service 2: Schemes & Subsidies -->
                <div class="service-slide-item">
                    <div class="service-card">
                        <div class="service-card-icon" style="background:var(--accent-soft); color:var(--accent-dark);">🧮</div>
                        <h3 class="service-card-title" data-i18n="srv_schemes_title">Schemes & Subsidies</h3>
                        <p class="service-card-desc" data-i18n="srv_schemes_desc">
                            Amar Fasal Amar Gari vehicle subsidy, Sufal Bangla kiosks, and our 3-click interactive subsidy eligibility calculator.
                        </p>
                        <a href="<?php echo esc_url(home_url('/schemes/')); ?>" class="service-card-link" data-i18n="srv_schemes_link">Calculate Subsidy →</a>
                    </div>
                </div>

                <!-- Service 3: Cold Storages -->
                <div class="service-slide-item">
                    <div class="service-card">
                        <div class="service-card-icon" style="background:rgba(2, 132, 199, 0.15); color:var(--info);">❄️</div>
                        <h3 class="service-card-title" data-i18n="srv_cold_title">Cold Storage Grid</h3>
                        <p class="service-card-desc" data-i18n="srv_cold_desc">
                            Check real-time capacity across districts, view temperature zones, and reserve potato & vegetable storage slots online.
                        </p>
                        <a href="<?php echo esc_url(home_url('/cold-storage/')); ?>" class="service-card-link" data-i18n="srv_cold_link">Find Storage Units →</a>
                    </div>
                </div>

                <!-- Service 4: Farm Connect -->
                <div class="service-slide-item">
                    <div class="service-card">
                        <div class="service-card-icon" style="background:rgba(245, 158, 11, 0.15); color:var(--warning);">🤝</div>
                        <h3 class="service-card-title" data-i18n="srv_market_title">Farm Connect Hub</h3>
                        <p class="service-card-desc" data-i18n="srv_market_desc">
                            Direct farm-to-buyer e-marketplace for verified grains, vegetables, spices, and organic fruits without middlemen.
                        </p>
                        <a href="<?php echo esc_url(home_url('/marketplace/')); ?>" class="service-card-link" data-i18n="srv_market_link">View Farm Listings →</a>
                    </div>
                </div>

                <!-- Service 5: Krishak Bazar Hubs -->
                <div class="service-slide-item">
                    <div class="service-card">
                        <div class="service-card-icon" style="background:rgba(16, 185, 129, 0.15); color:var(--success);">🏪</div>
                        <h3 class="service-card-title" data-i18n="srv_krishak_title">Krishak Bazar Hubs</h3>
                        <p class="service-card-desc" data-i18n="srv_krishak_desc">
                            Modern farmer-to-consumer retail yards, weekly rural hats, electronic weighing, and transparent direct spot auctioning.
                        </p>
                        <a href="<?php echo esc_url(home_url('/marketplace/')); ?>" class="service-card-link" data-i18n="srv_krishak_link">Explore Krishak Bazars →</a>
                    </div>
                </div>

                <!-- Service 6: Agmark Quality Certification -->
                <div class="service-slide-item">
                    <div class="service-card">
                        <div class="service-card-icon" style="background:rgba(99, 102, 241, 0.15); color:#6366f1;">🧪</div>
                        <h3 class="service-card-title" data-i18n="srv_agmark_title">Agmark Quality Testing</h3>
                        <p class="service-card-desc" data-i18n="srv_agmark_desc">
                            Regional testing laboratories for edible oils, spices, and honey, ensuring chemical residue compliance and AGMARK grading.
                        </p>
                        <a href="<?php echo esc_url(home_url('/schemes/')); ?>" class="service-card-link" data-i18n="srv_agmark_link">View Quality Standards →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slider Dots Pagination Indicator -->
        <div class="services-slider-dots" id="servicesSliderDots">
            <!-- Populated dynamically via app.js -->
        </div>
    </div>
</section>

<!-- ==========================================================================
   SPOTLIGHT: DAILY MANDI RATES PREVIEW
   ========================================================================== -->
<section class="section" id="mandiPreview">
    <div class="container">
        <div class="section-header">
            <div class="section-tag">
                📈 <span data-i18n="mandi_tag">Real-Time Market Intelligence</span>
            </div>
            <h2 class="section-title" data-i18n="mandi_title">Daily Commodity Mandi Rates</h2>
            <p class="section-subtitle" data-i18n="mandi_subtitle">
                Live modal prices, minimum-maximum ranges, and daily arrivals updated directly from APMC checkposts.
            </p>
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
                </div>

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
</section>

<!-- ==========================================================================
   MODAL DIALOGS
   ========================================================================== -->
<!-- 1. Interactive Canvas Price Chart Modal -->
<div class="modal-overlay" id="chartModal">
    <div class="modal-card">
        <div class="modal-header">
            <div>
                <h3 class="modal-title" id="modalCropTitle">Potato (Jyoti) - Hooghly APMC</h3>
                <div style="font-size:0.85rem; color:var(--text-muted);">7-Day Price Trend & Volume Fluctuation</div>
            </div>
            <button type="button" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
                <div>
                    <span style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase;">Today's Modal Rate</span>
                    <div style="font-size:1.8rem; font-weight:800; color:var(--primary); font-family:'Outfit';" id="modalCurrentPrice">₹1,540 / Qtl</div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:0.8rem; color:var(--text-muted);" id="modalMinMax">Min: ₹1,450 | Max: ₹1,620</div>
                </div>
            </div>

            <div class="chart-canvas-wrapper">
                <canvas id="priceTrendChart"></canvas>
            </div>

            <div style="display:flex; justify-content:space-between; align-items:center; font-size:0.82rem; color:var(--text-muted);">
                <span>📊 Source: Agricultural Marketing Department APMC Feed</span>
                <button class="btn btn-sm btn-primary" onclick="ModalManager.open('alertModal'); ModalManager.close('chartModal');">
                    🔔 Track This Crop via SMS
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 2. SMS / WhatsApp Price Alert Modal -->
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

<?php
get_footer();
