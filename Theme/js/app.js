/**
 * Agricultural Marketing Department - Official Website
 * Interactive Application Engine & Multilingual System (EN, BN, HI)
 * Multi-Page Architecture with External Data JSON Support
 */

document.addEventListener('DOMContentLoaded', async () => {
    // 0. Load Common Header & Footer Components from components/*.html
    await HeaderComponent.init();
    await FooterComponent.init();

    // 1. Initialize Core UI Managers
    AccessibilityManager.init();
    ThemeManager.init();
    NavigationModule.init();
    ModalManager.init();

    // 2. Load Data from JSON Files & Initialize Business Modules
    await DataLoader.init();
    I18nEngine.init();
    MandiRatesModule.init();
    QuickDiscoveryModule.init();
    SubsidyCalculatorModule.init();
    ColdStorageModule.init();
    MarketplaceModule.init();
    NoticesModule.init();
    NumberCounterModule.init();
    ServicesSliderModule.init();
});

/* ==========================================================================
   0. COMMON HEADER COMPONENT LOADER
   ========================================================================== */
const HeaderComponent = {
    template: `
<!-- Top Accessibility & Utility Bar -->
<aside class="top-util-bar" aria-label="Accessibility & Quick Utility Bar">
    <div class="container top-util-container">
        <div class="util-left">
            <span class="helpline-pill">
                <span class="pulse-dot"></span>
                <span data-i18n="farmer_helpline">Farmer Helpline (Toll-Free):</span>
                <strong>1800-180-1551</strong>
            </span>
        </div>

        <div class="util-right">
            <!-- Font Size Switcher (A-, A, A+) -->
            <div class="font-size-control" aria-label="Font Size Adjuster">
                <button type="button" class="font-btn font-dec" data-size="dec" title="Decrease Font Size">A-</button>
                <button type="button" class="font-btn font-std active" data-size="std" title="Normal Font Size">A</button>
                <button type="button" class="font-btn font-inc" data-size="inc" title="Increase Font Size">A+</button>
            </div>

            <!-- Language Switcher -->
            <div class="lang-switcher" aria-label="Language Selector">
                <button type="button" class="lang-btn active" data-lang="en">English</button>
                <button type="button" class="lang-btn" data-lang="bn">বাংলা</button>
                <button type="button" class="lang-btn" data-lang="hi">हिंदी</button>
            </div>

            <!-- Theme Toggle Button -->
            <button type="button" class="theme-toggle-btn" id="themeToggleBtn" aria-label="Toggle Dark/Light Mode">
                <span id="themeIcon">🌙</span>
                <span id="themeText" data-i18n="dark_mode">Dark</span>
            </button>
        </div>
    </div>
</aside>

<!-- Main Brand Header & Mega Navigation -->
<header class="main-header">
    <div class="container header-container">
        <a href="index.html" class="brand-section" aria-label="Agricultural Marketing Department">
            <div class="brand-emblem-wrapper">
                <img src="./images/Logo.png" alt="Agricultural Marketing Department Logo" class="brand-logo-img">
            </div>
        </a>

        <nav class="nav-menu" id="navMenu" aria-label="Main Navigation">
            <div class="nav-item"><a href="index.html" class="nav-link" data-i18n="nav_home">Home</a></div>
            <div class="nav-item">
                <a href="mandi-rates.html" class="nav-link">
                    <span data-i18n="nav_rates">Mandi Rates</span>
                </a>
            </div>
            <div class="nav-item"><a href="schemes.html" class="nav-link" data-i18n="nav_schemes">Schemes & Subsidies</a></div>
            <div class="nav-item"><a href="cold-storage.html" class="nav-link" data-i18n="nav_cold_storage">Cold Storages</a></div>
            <div class="nav-item"><a href="marketplace.html" class="nav-link" data-i18n="nav_marketplace">Farm Connect</a></div>
            <div class="nav-item"><a href="about.html" class="nav-link" data-i18n="nav_about">About Us</a></div>
            <div class="nav-item"><a href="contact.html" class="nav-link" data-i18n="nav_contact">Contact Us</a></div>
        </nav>

        <div class="header-actions">
            <button class="mobile-toggle-btn" id="mobileMenuToggle" aria-label="Toggle Navigation Menu">
                ☰
            </button>
        </div>
    </div>
</header>

<!-- Live Commodity Price Ticker -->
<div class="ticker-wrapper" aria-label="Live Mandi Price Ticker">
    <div class="ticker-label">
        <span class="pulse-dot"></span>
        <span data-i18n="ticker_label">Daily Market Rates</span>
    </div>
    <div class="ticker-track-container">
        <div class="ticker-track" id="tickerTrack">
            <!-- Populated dynamically via app.js -->
        </div>
    </div>
</div>`,

    async init() {
        const headerContainer = document.getElementById('common-header') || document.getElementById('site-header');
        if (!headerContainer) return;

        // Try fetch first if served via HTTP server
        if (window.location.protocol.startsWith('http')) {
            try {
                const res = await fetch('./components/header.html');
                if (res.ok) {
                    headerContainer.innerHTML = await res.text();
                    return;
                }
            } catch (err) {
                // fall through to embedded template
            }
        }

        // Immediate fallback for direct file:/// opening or offline environments
        headerContainer.innerHTML = this.template;
    }
};

/* ==========================================================================
   0.1 COMMON FOOTER COMPONENT LOADER
   ========================================================================== */
const FooterComponent = {
    template: `
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <h3 class="footer-brand-title" data-i18n="footer_about_title">Agricultural Marketing Department</h3>
                <p class="footer-desc" data-i18n="footer_about_desc">
                    Committed to empowering farmers, stabilizing food prices, providing state-of-the-art
                    agricultural logistics, and building transparent market mechanisms.
                </p>
                <div class="footer-helpline-box">
                    <div class="f-help-label" data-i18n="footer_helpline_label">Kisan Call Center / 24x7 Helpline:</div>
                    <span class="f-help-num">1800-180-1551</span>
                </div>
            </div>

            <div>
                <h4 class="footer-col-title" data-i18n="footer_quick_links">Quick Navigation</h4>
                <ul class="footer-links">
                    <li><a href="index.html">› <span data-i18n="nav_home">Home</span></a></li>
                    <li><a href="mandi-rates.html">› <span data-i18n="nav_rates">Daily Mandi Rates</span></a></li>
                    <li><a href="schemes.html">› <span data-i18n="nav_schemes">Schemes & Subsidies</span></a></li>
                    <li><a href="cold-storage.html">› <span data-i18n="nav_cold_storage">Cold Storage Network</span></a></li>
                    <li><a href="marketplace.html">› <span data-i18n="nav_marketplace">Farm Connect Hub</span></a></li>
                    <li><a href="about.html">› <span data-i18n="nav_about">About Us</span></a></li>
                    <li><a href="contact.html">› <span data-i18n="nav_contact">Contact Us</span></a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-col-title" data-i18n="footer_schemes_links">Important Schemes</h4>
                <ul class="footer-links">
                    <li><a href="schemes.html">› <span data-i18n="footer_scheme_amar">Amar Fasal Amar Gari</span></a></li>
                    <li><a href="schemes.html">› <span data-i18n="footer_scheme_sufal">Sufal Bangla Outlets</span></a></li>
                    <li><a href="schemes.html">› <span data-i18n="footer_scheme_solar">Solar Cold Chain Assistance</span></a></li>
                    <li><a href="schemes.html">› <span data-i18n="footer_scheme_krishak">Krishak Bandhu Linkage</span></a></li>
                    <li><a href="schemes.html">› <span data-i18n="footer_scheme_enam">e-NAM Inter-state Trade</span></a></li>
                    <li><a href="schemes.html">› <span data-i18n="footer_scheme_agmark">Agmark Quality Certification</span></a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-col-title" data-i18n="footer_contact_title">Headquarters</h4>
                <p style="font-size:0.88rem; color:#94a3b8; line-height:1.6; margin-bottom:1rem;"
                    data-i18n="footer_address">
                    Subhanna, 5th & 6th Floor, DF Block, Sector-I, Salt Lake, Kolkata - 700064
                </p>
                <div style="font-size:0.85rem; color:#cbd5e1; display:flex; flex-direction:column; gap:0.35rem;">
                    <div>📞 <strong data-i18n="footer_lbl_helpline">Helpline:</strong> 1800-180-1551</div>
                    <div>✉️ <strong data-i18n="footer_lbl_email">Email:</strong> agrimarketing@gov.in</div>
                    <div>🌐 <strong data-i18n="footer_lbl_website">Website:</strong> agrimarketing.gov.in</div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div data-i18n="footer_rights">
                © 2026 Agricultural Marketing Department. All Rights Reserved.
            </div>
            <div style="display:flex; gap:1.2rem; flex-wrap:wrap;">
                <a href="about.html" style="color:#94a3b8;" data-i18n="footer_privacy">Privacy Policy</a>
                <a href="about.html" style="color:#94a3b8;" data-i18n="footer_terms">Terms of Use</a>
                <a href="about.html" style="color:#94a3b8;" data-i18n="footer_accessibility">Accessibility Statement</a>
                <a href="about.html" style="color:#94a3b8;" data-i18n="footer_sitemap">Sitemap</a>
            </div>
        </div>
    </div>
</footer>`,

    async init() {
        const footerContainer = document.getElementById('common-footer') || document.getElementById('site-footer');
        if (!footerContainer) return;

        // Try fetch first if served via HTTP server
        if (window.location.protocol.startsWith('http')) {
            try {
                const res = await fetch('./components/footer.html');
                if (res.ok) {
                    footerContainer.innerHTML = await res.text();
                    return;
                }
            } catch (err) {
                // fall through to embedded template
            }
        }

        // Immediate fallback for direct file:/// opening or offline environments
        footerContainer.innerHTML = this.template;
    }
};

/* ==========================================================================
   DATA LOADER (Loads from ./data/*.json with Embedded Fallbacks)
   ========================================================================== */
const DataLoader = {
    async init() {
        try {
            const [mandiRes, csRes, marketRes, noticesRes, schemesRes, transRes] = await Promise.allSettled([
                fetch('./data/mandi-rates.json').then(r => r.json()),
                fetch('./data/cold-storage.json').then(r => r.json()),
                fetch('./data/marketplace.json').then(r => r.json()),
                fetch('./data/notices.json').then(r => r.json()),
                fetch('./data/schemes.json').then(r => r.json()),
                fetch('./data/translations.json').then(r => r.json())
            ]);

            if (mandiRes.status === 'fulfilled' && Array.isArray(mandiRes.value)) {
                MandiRatesModule.data = mandiRes.value;
            }
            if (csRes.status === 'fulfilled' && Array.isArray(csRes.value)) {
                ColdStorageModule.units = csRes.value;
            }
            if (marketRes.status === 'fulfilled' && Array.isArray(marketRes.value)) {
                MarketplaceModule.produce = marketRes.value;
            }
            if (noticesRes.status === 'fulfilled' && noticesRes.value) {
                NoticesModule.data = noticesRes.value;
            }
            if (schemesRes.status === 'fulfilled' && Array.isArray(schemesRes.value)) {
                SchemesModule.data = schemesRes.value;
            }
            if (transRes.status === 'fulfilled' && transRes.value) {
                I18nEngine.translations = transRes.value;
            }
        } catch (e) {
            console.info("Using embedded default datasets.");
        }
    }
};

/* ==========================================================================
   1. MULTILINGUAL I18N ENGINE (English, Bengali, Hindi)
   ========================================================================== */
const I18nEngine = {
    currentLang: 'en',
    translations: {
        en: {
            "gov_name": "State Agricultural Marketing Board",
            "farmer_helpline": "Farmer Helpline (Toll-Free):",
            "skip_content": "Skip to Content",
            "light_mode": "Light",
            "dark_mode": "Dark",
            "dept_gov": "Agricultural Marketing Department",
            "dept_title": "Agricultural Marketing Department",
            "dept_subtitle": "Directorate of Agricultural Marketing | State Marketing Board",
            "nav_home": "Home",
            "nav_rates": "Mandi Rates",
            "nav_schemes": "Schemes & Subsidies",
            "nav_cold_storage": "Cold Storages",
            "nav_marketplace": "Farm Connect",
            "nav_about": "About Us",
            "nav_contact": "Contact Us",
            "ticker_label": "Daily Market Rates",
            "hero_badge": "Agricultural Price Discovery & Market Intelligence",
            "hero_title_prefix": "Empowering Farmers with ",
            "hero_title_highlight": "Fair Prices & Smart Markets",
            "hero_desc": "Connecting 1.6M+ farmers directly with regulated mandis, Sufal Bangla retail hubs, modern cold chains, and transparent electronic trading across the state.",
            "btn_explore_rates": "Check Today's Mandi Rates",
            "btn_sufal_bangla": "Sufal Bangla Outlets",
            "quick_widget_title": "Instant Commodity Price Discovery",
            "select_crop_ph": "Select Commodity...",
            "select_dist_ph": "Select District...",
            "btn_check_price": "Get Price",
            "quick_res_modal": "Modal Price:",
            "quick_res_range": "Range:",
            "quick_res_trend": "Trend:",
            "quick_res_arrivals": "Arrivals:",
            "float_mandi_count": "Regulated APMC Mandis",
            "float_settlement": "Direct Trade Settlements",
            "stat_mandis": "Regulated Mandis",
            "stat_farmers": "Registered Farmers",
            "stat_outlets": "Sufal Bangla Centers",
            "stat_trade": "Annual Trade Volume",
            "services_tag": "🌟 Comprehensive Services",
            "services_title": "Agricultural Marketing Services & Infrastructure",
            "services_subtitle": "Access real-time commodity rates, government subsidies, cold chain storage facilities, and farm produce marketing.",
            "srv_mandi_title": "Daily Mandi Rates",
            "srv_mandi_desc": "Live APMC checkpost prices, 24-hour trends, modal price comparison, and interactive 7-day canvas charts.",
            "srv_mandi_link": "Explore Mandi Rates →",
            "srv_schemes_title": "Schemes & Subsidies",
            "srv_schemes_desc": "Amar Fasal Amar Gari vehicle subsidy, Sufal Bangla kiosks, and our 3-click interactive subsidy eligibility calculator.",
            "srv_schemes_link": "Calculate Subsidy →",
            "srv_cold_title": "Cold Storage Grid",
            "srv_cold_desc": "Check real-time capacity across districts, view temperature zones, and reserve potato & vegetable storage slots online.",
            "srv_cold_link": "Find Storage Units →",
            "srv_market_title": "Farm Connect Hub",
            "srv_market_desc": "Direct farm-to-buyer e-marketplace for verified grains, vegetables, spices, and organic fruits without middlemen.",
            "srv_market_link": "View Farm Listings →",
            "srv_krishak_title": "Krishak Bazar Hubs",
            "srv_krishak_desc": "Modern farmer-to-consumer retail yards, weekly rural hats, electronic weighing, and transparent direct spot auctioning.",
            "srv_krishak_link": "Explore Krishak Bazars →",
            "srv_agmark_title": "Agmark Quality Testing",
            "srv_agmark_desc": "Regional testing laboratories for edible oils, spices, and honey, ensuring chemical residue compliance and AGMARK grading.",
            "srv_agmark_link": "View Quality Standards →",
            "mandi_tag": "Real-Time Market Intelligence",
            "mandi_title": "Daily Commodity Mandi Rates",
            "mandi_subtitle": "Live modal prices, minimum-maximum ranges, and daily arrivals updated directly from APMC checkposts.",
            "tab_all": "All Commodities",
            "tab_veg": "Vegetables",
            "tab_grain": "Cereals & Grains",
            "tab_pulses": "Pulses",
            "tab_oilseed": "Oilseeds & Cash Crops",
            "tab_fruits": "Fruits",
            "tab_spices": "Spices",
            "search_crop_ph": "Search crop (e.g. Potato, Onion, Rice)...",
            "all_districts": "All Districts",
            "th_commodity": "Commodity & Variety",
            "th_mandi": "Market / Mandi",
            "th_min": "Min (₹/Qtl)",
            "th_max": "Max (₹/Qtl)",
            "th_modal": "Modal Price (₹/Qtl)",
            "th_trend": "24h Trend",
            "th_action": "Action",
            "btn_view_trend": "7-Day Trend",
            "btn_set_alert": "Get SMS Alert",
            "btn_download_csv": "Export CSV",
            "btn_print_rates": "Print Rates",
            "mandi_guide_1_title": "Daily Modal Rate Formula",
            "mandi_guide_1_desc": "Modal price represents the most frequent transaction price realized by farmers on the trading floor for standard quality grade.",
            "mandi_guide_2_title": "Transparent Electronic Auction",
            "mandi_guide_2_desc": "All APMC yards operate under e-NAM electronic weighing and direct bank settlement within 24 hours.",
            "mandi_guide_3_title": "Dispute Resolution",
            "mandi_guide_3_desc": "For pricing disputes or weighing anomalies, contact the APMC Market Secretary or call Toll-Free Helpline: 1800-180-1551.",
            "init_tag": "Flagship Programs",
            "init_title": "Empowering Agri-Logistics & Direct Trade",
            "init_subtitle": "Key initiatives facilitating direct farm-to-consumer linkages, logistics subsidies, and storage infrastructure.",
            "sufal_title": "Sufal Bangla Outlets",
            "sufal_desc": "Direct farm-to-door retail network selling fresh vegetables, fruits, and dairy at fair prices while eliminating intermediaries.",
            "sufal_f1": "450+ Static and Mobile Kiosks",
            "sufal_f2": "Direct daily procurement from FPOs",
            "sufal_f3": "Quality grading & fair retail price tags",
            "amar_fasal_title": "Amar Fasal Amar Gari",
            "amar_desc": "Capital subsidy program offering up to 50% financial assistance to farmers and self-help groups for purchasing produce transport vans.",
            "amar_f1": "50% Vehicle Cost Subsidy (Up to ₹1.5L)",
            "amar_f2": "Reduces post-harvest transit losses",
            "amar_f3": "Fast direct delivery to wholesale mandis",
            "cold_grid_title": "Cold Storage & Warehousing Grid",
            "cold_desc": "Integrated network of multi-chamber cold storage facilities with real-time slot booking and moisture-controlled potato chambers.",
            "cold_f1": "Real-time district capacity tracker",
            "cold_f2": "Subsidized electricity tariff for agri-units",
            "cold_f3": "Scientific preservation & Agmark labs",
            "calc_tag": "Interactive Subsidy Tool",
            "calc_title": "Agri-Marketing Subsidy & Scheme Calculator",
            "calc_subtitle": "Calculate your estimated grant eligibility in 3 easy clicks.",
            "lbl_beneficiary": "Select Beneficiary Category:",
            "opt_small_farmer": "Small / Marginal Farmer",
            "opt_small_farmer_sub": "Landholding up to 2 Hectares",
            "opt_women_farmer": "Women Farmer / SHG",
            "opt_women_farmer_sub": "Women-led Agri Enterprises",
            "opt_fpo": "FPO / Farmers Cooperative",
            "opt_fpo_sub": "Registered Producer Groups",
            "opt_agri_startup": "Agri-Entrepreneur / Startup",
            "opt_agri_startup_sub": "Modern Marketing Infrastructure",
            "lbl_facility": "Select Infrastructure / Support Needed:",
            "opt_fac_vehicle": "Produce Transport Van (Amar Fasal)",
            "opt_fac_cold": "Solar Cold Room / Storage Unit",
            "opt_fac_packhouse": "Grading, Sorting & Packhouse",
            "opt_fac_kiosk": "Amar Dukan Modern Retail Kiosk",
            "lbl_cost": "Estimated Project Cost (₹ in Lakhs):",
            "res_subsidy_title": "Eligible Government Subsidy",
            "res_scheme_label": "Recommended Scheme:",
            "btn_apply_scheme": "Download Application Guidelines",
            "cs_tag": "Storage Infrastructure",
            "cs_title": "District Cold Storage & APMC Locator",
            "cs_subtitle": "Check available capacity, contact managers, and book temperature-controlled storage.",
            "btn_book_space": "Reserve Storage Slot",
            "cs_available": "Available Space",
            "cs_limited": "Filling Fast",
            "market_tag": "Direct Farm Connect",
            "market_title": "Farmer Produce Showcase & Trade Hub",
            "market_subtitle": "Direct verified farm listings from agricultural cooperatives and farmer producer organizations.",
            "btn_contact_farmer": "Send Bid / Inquiry",
            "notices_tag": "Official Communications",
            "notices_title": "Tenders, Notifications & Advisory",
            "tab_tenders": "Tenders & EOIs",
            "tab_bulletins": "Daily Price Bulletins",
            "tab_circulars": "MSP & Notifications",
            "btn_download_pdf": "Download PDF",
            "advisory_heading": "Daily Farmer Market Advisory",
            "footer_about_title": "Agricultural Marketing Department",
            "footer_about_desc": "Committed to empowering farmers, stabilizing food prices, providing state-of-the-art agricultural logistics, and building transparent market mechanisms.",
            "footer_quick_links": "Quick Navigation",
            "footer_schemes_links": "Important Schemes",
            "footer_scheme_amar": "Amar Fasal Amar Gari",
            "footer_scheme_sufal": "Sufal Bangla Outlets",
            "footer_scheme_solar": "Solar Cold Chain Assistance",
            "footer_scheme_krishak": "Krishak Bandhu Linkage",
            "footer_scheme_enam": "e-NAM Inter-state Trade",
            "footer_scheme_agmark": "Agmark Quality Certification",
            "footer_helpline_label": "Kisan Call Center / 24x7 Helpline:",
            "footer_lbl_helpline": "Helpline:",
            "footer_lbl_email": "Email:",
            "footer_lbl_website": "Website:",
            "footer_privacy": "Privacy Policy",
            "footer_terms": "Terms of Use",
            "footer_accessibility": "Accessibility Statement",
            "footer_sitemap": "Sitemap",
            "footer_contact_title": "Headquarters",
            "footer_address": "Subhanna, 5th & 6th Floor, DF Block, Sector-I, Salt Lake, Kolkata - 700064",
            "footer_rights": "© 2026 Agricultural Marketing Department. All Rights Reserved."
        },
        bn: {
            "gov_name": "রাজ্য কৃষি বিপণন পর্ষদ",
            "farmer_helpline": "কৃষক হেল্পলাইন (টোল-ফ্রি):",
            "skip_content": "সরাসরি মূল অংশে যান",
            "light_mode": "লাইট",
            "dark_mode": "ডার্ক",
            "dept_gov": "কৃষি বিপণন বিভাগ",
            "dept_title": "কৃষি বিপণন বিভাগ",
            "dept_subtitle": "কৃষি বিপণন অধিকার | রাজ্য কৃষি বিপণন পর্ষদ",
            "nav_home": "হোম",
            "nav_rates": "মান্ডি দর",
            "nav_schemes": "প্রকল্প ও ভর্তুকি",
            "nav_cold_storage": "হিমাগার",
            "nav_marketplace": "কৃষক সংযোগ",
            "nav_about": "পরিচিতি",
            "nav_contact": "যোগাযোগ",
            "ticker_label": "সরাসরি মান্ডি দর",
            "hero_badge": "কৃষি বাজার দর ও বিপণন সেবা",
            "hero_title_prefix": "কৃষকদের ক্ষমতায়নে ",
            "hero_title_highlight": "ন্যায্য মূল্য ও আধুনিক বাজার",
            "hero_desc": "রাজ্যের ১৬ লক্ষেরও বেশি কৃষককে নিয়ন্ত্রিত মান্ডি, সুফল বাংলা আউটলেট, আধুনিক হিমাগার এবং স্বচ্ছ ই-ট্রেডিং ব্যবস্থার সাথে সরাসরি যুক্ত করা হচ্ছে।",
            "btn_explore_rates": "আজকের বাজার দর দেখুন",
            "btn_sufal_bangla": "সুফল বাংলা কেন্দ্রসমূহ",
            "quick_widget_title": "দ্রুত শস্যের দর সন্ধান",
            "select_crop_ph": "শস্য নির্বাচন করুন...",
            "select_dist_ph": "জেলা নির্বাচন করুন...",
            "btn_check_price": "দর দেখুন",
            "quick_res_modal": "গড় দর:",
            "quick_res_range": "সর্বনিম্ন - সর্বোচ্চ:",
            "quick_res_trend": "পরিবর্তন:",
            "quick_res_arrivals": "আমদানি:",
            "float_mandi_count": "নিয়ন্ত্রিত এপিএমসি মান্ডি",
            "float_settlement": "সরাসরি লেনদেন নিষ্পত্তি",
            "stat_mandis": "নিয়ন্ত্রিত মান্ডি",
            "stat_farmers": "নিবন্ধিত কৃষক",
            "stat_outlets": "সুফল বাংলা কেন্দ্র",
            "stat_trade": "বার্ষিক বাণিজ্য পরিমাণ",
            "services_tag": "🌟 শীর্ষ সেবাসমূহ",
            "services_title": "কৃষি বিপণন সেবা ও পরিকাঠামো",
            "services_subtitle": "রিয়েল-টাইম কৃষি বাজার দর, সরকারি ভর্তুকি, কোল্ড চেইন সংরক্ষণ এবং ফসল বিপণন সুবিধা।",
            "srv_mandi_title": "দৈনিক মান্ডি দর",
            "srv_mandi_desc": "এপিএমসি চেকপোস্ট থেকে সরাসরি বাজার দর, ২৪ ঘণ্টার ট্রেন্ড এবং ৭ দিনের চার্ট।",
            "srv_mandi_link": "বাজার দর দেখুন →",
            "srv_schemes_title": "প্রকল্প ও ভর্তুকি",
            "srv_schemes_desc": "আমার ফসল আমার গাড়ি যানবাহন ভর্তুকি এবং সহজ ভর্তুকি ক্যালকুলেটর।",
            "srv_schemes_link": "ভর্তুকি গণনা করুন →",
            "srv_cold_title": "হিমাগার গ্রিড",
            "srv_cold_desc": "জেলা ভিত্তিক হিমাগারের ধারণক্ষমতা জানুন এবং অনলাইনে সংরক্ষণের স্লট বুক করুন।",
            "srv_cold_link": "হিমাগার সন্ধান →",
            "srv_market_title": "কৃষক সংযোগ হাব",
            "srv_market_desc": "মধ্যস্বত্বভোগী ছাড়া কৃষকদের থেকে সরাসরি শস্য, শাকসবজি ও ফল ক্রয়ের প্ল্যাটফর্ম।",
            "srv_market_link": "তালিকা দেখুন →",
            "srv_krishak_title": "কৃষক বাজার হাব",
            "srv_krishak_desc": "আধুনিক কৃষক বাজার, গ্রামীণ হাট, ইলেকট্রনিক ওজন মাপক ও স্বচ্ছ স্পট নিলাম ব্যবস্থা।",
            "srv_krishak_link": "কৃষক বাজার দেখুন →",
            "srv_agmark_title": "এগমার্ক গুণমান পরীক্ষা",
            "srv_agmark_desc": "খাদ্যতেল, মসলা ও মধুর গুণমান যাচাইয়ের জন্য আঞ্চলিক অত্যাধুনিক এগমার্ক গবেষণাগার।",
            "srv_agmark_link": "গুণমান মানদণ্ড দেখুন →",
            "mandi_tag": "সরাসরি বাজার তথ্য",
            "mandi_title": "দৈনিক কৃষি মান্ডি দর",
            "mandi_subtitle": "এপিএমসি চেকপোস্ট থেকে সরাসরি সংগৃহীত সর্বনিম্ন, সর্বোচ্চ এবং গড় দর।",
            "tab_all": "সকল শস্য",
            "tab_veg": "শাকসবজি",
            "tab_grain": "দানাশস্য ও চাল",
            "tab_pulses": "ডালজাতীয়",
            "tab_oilseed": "তৈলবীজ ও অর্থকরী",
            "tab_fruits": "ফলমূল",
            "tab_spices": "মসলাপাতি",
            "search_crop_ph": "শস্য খুঁজুন (যেমন: আলু, পেঁয়াজ, চাল)...",
            "all_districts": "সকল জেলা",
            "th_commodity": "শস্য ও প্রকারভেদ",
            "th_mandi": "বাজার / মান্ডি",
            "th_min": "সর্বনিম্ন (₹/কুইন্টাল)",
            "th_max": "সর্বোচ্চ (₹/কুইন্টাল)",
            "th_modal": "গড় দর (₹/কুইন্টাল)",
            "th_trend": "২৪ ঘণ্টার ট্রেন্ড",
            "th_action": "পদক্ষেপ",
            "btn_view_trend": "৭ দিনের ট্রেন্ড",
            "btn_set_alert": "এসএমএস এলার্ট পান",
            "btn_download_csv": "সিএসভি ডাউনলোড",
            "btn_print_rates": "প্রিন্ট করুন",
            "mandi_guide_1_title": "দৈনিক মডেল দরের নিয়ম",
            "mandi_guide_1_desc": "মডেল দর হল নির্দিষ্ট মানের ফসলের জন্য বাজারে সবচেয়ে বেশি সংখ্যক লেনদেন যে মূল্যে সম্পন্ন হয়েছে।",
            "mandi_guide_2_title": "স্বচ্ছ ইলেকট্রনিক নিলাম",
            "mandi_guide_2_desc": "সমস্ত এপিএমসি মান্ডি ই-ন্যাম (e-NAM) ডিজিটাল ওজন এবং ২৪ ঘণ্টার মধ্যে সরাসরি ব্যাঙ্ক ট্রান্সফারে পরিচালিত হয়।",
            "mandi_guide_3_title": "অভিযোগ ও সমাধান",
            "mandi_guide_3_desc": "মূল্য নির্ধারণ বা ওজনের অসঙ্গতির জন্য মান্ডি সচিবের সাথে যোগাযোগ করুন বা টোল-ফ্রি হেল্পলাইনে কল করুন: ১৮০০-১৮০-১৫৫১।",
            "init_tag": "শীর্ষ কর্মসূচি",
            "init_title": "কৃষি লজিস্টিকস ও সরাসরি বিপণন সম্প্রসারণ",
            "init_subtitle": "কৃষক ও উপভোক্তাদের সরাসরি সংযোগ, পরিবহন ভর্তুকি এবং আধুনিক সংরক্ষণ পরিকাঠামো।",
            "sufal_title": "সুফল বাংলা আউটলেট",
            "sufal_desc": "মধ্যস্বত্বভোগী ছাড়া কৃষকদের থেকে সরাসরি ন্যায্য মূল্যে তাজা শাকসবজি ও ফল সাধারণ মানুষের কাছে পৌঁছে দেওয়ার উদ্যোগ।",
            "sufal_f1": "৪৫০+ স্থায়ী ও ভ্রাম্যমাণ আউটলেট",
            "sufal_f2": "কৃষক উৎপাদক সংস্থা (FPO) থেকে সরাসরি সংগ্রহ",
            "sufal_f3": "গুণমান পরীক্ষা ও ন্যায্য মূল্য তালিকা",
            "amar_fasal_title": "আমার ফসল আমার গাড়ি",
            "amar_desc": "কৃষক ও স্বনির্ভর গোষ্ঠীর জন্য ফসল পরিবহন যান ক্রয়ে ৫০% পর্যন্ত সরকারি আর্থিক ভর্তুকি প্রকল্প।",
            "amar_f1": "৫০% যানবাহন ভর্তুকি (সর্বোচ্চ ১.৫ লাখ টাকা)",
            "amar_f2": "ফসল পরিবহনের অপচয় রোধ",
            "amar_f3": "পাইকারি মান্ডিতে দ্রুত সরাসরি সরবরাহ",
            "cold_grid_title": "হিমাগার ও কোল্ড চেইন পরিকাঠামো",
            "cold_desc": "রিয়েল-টাইম স্লট বুকিং এবং আর্দ্রতা-নিয়ন্ত্রিত আলু ও সবজি সংরক্ষণের জন্য আধুনিক কোল্ড চেইন গ্রিড।",
            "cold_f1": "জেলা ভিত্তিক খালি জায়গার সঠিক তথ্য",
            "cold_f2": "কৃষি হিমাগারে বিদ্যুৎ শুল্কে বিশেষ ছাড়",
            "cold_f3": "বিজ্ঞানসম্মত সংরক্ষণ ও এগমার্ক ল্যাব",
            "calc_tag": "ইন্টারেক্টিভ ভর্তুকি ক্যালকুলেটর",
            "calc_title": "কৃষি বিপণন ভর্তুকি ও প্রকল্প গণক",
            "calc_subtitle": "সহজে মাত্র ৩টি ক্লিকে আপনার সম্ভাব্য সরকারি অনুদান ও ভর্তুকির পরিমাণ হিসাব করুন।",
            "lbl_beneficiary": "আবেদনকারীর শ্রেণি নির্বাচন করুন:",
            "opt_small_farmer": "ক্ষুদ্র ও প্রান্তিক কৃষক",
            "opt_small_farmer_sub": "২ হেক্টর পর্যন্ত কৃষিজমি",
            "opt_women_farmer": "মহিলা কৃষক / স্বনির্ভর দল",
            "opt_women_farmer_sub": "মহিলা পরিচালিত কৃষি উদ্যোগ",
            "opt_fpo": "এফপিও / কৃষক সমবায়",
            "opt_fpo_sub": "নিবন্ধিত কৃষক উৎপাদক দল",
            "opt_agri_startup": "কৃষি উদ্যোক্তা / স্টার্টআপ",
            "opt_agri_startup_sub": "আধুনিক বিপণন পরিকাঠামো",
            "lbl_facility": "প্রয়োজনীয় পরিকাঠামো / সহায়তা:",
            "opt_fac_vehicle": "ফসল পরিবহন যান (আমার ফসল)",
            "opt_fac_cold": "সোলার কোল্ড রুম / ছোট হিমাগার",
            "opt_fac_packhouse": "গ্রেডিং ও প্যাকেজিং কেন্দ্র",
            "opt_fac_kiosk": "আমার দোকান আধুনিক রিটেল স্টল",
            "lbl_cost": "আনুমানিক প্রকল্প ব্যয় (লক্ষ টাকায়):",
            "res_subsidy_title": "প্রাপ্য সরকারি ভর্তুকি",
            "res_scheme_label": "প্রস্তাবিত প্রকল্প:",
            "btn_apply_scheme": "আবেদন নির্দেশিকা ডাউনলোড করুন",
            "cs_tag": "সংরক্ষণ পরিকাঠামো",
            "cs_title": "জেলা ভিত্তিক হিমাগার ও এপিএমসি সন্ধান",
            "cs_subtitle": "হিমাগারের খালি ধারণক্ষমতা জানুন এবং সরাসরি সংরক্ষণের স্লট বুক করুন।",
            "btn_book_space": "সংরক্ষণ স্লট বুক করুন",
            "cs_available": "স্থান খালি আছে",
            "cs_limited": "দ্রুত ভর্তি হচ্ছে",
            "market_tag": "সরাসরি কৃষক সংযোগ",
            "market_title": "কৃষকদের উৎপাদিত শস্যের সরাসরি প্রদর্শনী",
            "market_subtitle": "কৃষকদের থেকে সরাসরি শস্য ক্রয়ের জন্য যাচাইকৃত তালিকা।",
            "btn_contact_farmer": "দরপ্রস্তাব / যোগাযোগ পাঠান",
            "notices_tag": "অফিসিয়াল বিজ্ঞপ্তি",
            "notices_title": "টেন্ডার, সরকারি বিজ্ঞপ্তি ও কৃষক বার্তা",
            "tab_tenders": "টেন্ডার ও ইওআই",
            "tab_bulletins": "দৈনিক মূল্য বুলেটিন",
            "tab_circulars": "সহায়ক মূল্য ও বিজ্ঞপ্তি",
            "btn_download_pdf": "পিডিএফ ডাউনলোড",
            "advisory_heading": "কৃষকদের জন্য দৈনিক বাজার পরামর্শ",
            "footer_about_title": "কৃষি বিপণন বিভাগ",
            "footer_about_desc": "কৃষকদের ন্যায্য মূল্য প্রদান, খাদ্যদ্রব্যের মূল্য স্থিতিশীল রাখা ও আধুনিক বিপণন ব্যবস্থা গড়ে তুলতে দায়বদ্ধ।",
            "footer_quick_links": "প্রয়োজনীয় লিংক",
            "footer_schemes_links": "গুরুত্বপূর্ণ প্রকল্প",
            "footer_scheme_amar": "আমার ফসল আমার গাড়ি",
            "footer_scheme_sufal": "সুফল বাংলা আউটলেট",
            "footer_scheme_solar": "সৌর কোল্ড চেইন সহায়তা",
            "footer_scheme_krishak": "কৃষক বন্ধু সংযুক্তি",
            "footer_scheme_enam": "ই-ন্যাম আন্তঃরাজ্য বাণিজ্য",
            "footer_scheme_agmark": "এগমার্ক মান পরীক্ষণ ও শংসাপত্র",
            "footer_helpline_label": "কিষাণ কল সেন্টার / ২৪x৭ হেল্পলাইন:",
            "footer_lbl_helpline": "হেল্পলাইন:",
            "footer_lbl_email": "ইমেল:",
            "footer_lbl_website": "ওয়েবসাইট:",
            "footer_privacy": "গোপনীয়তা নীতি",
            "footer_terms": "ব্যবহারের শর্তাবলী",
            "footer_accessibility": "অ্যাক্সেসিবিলিটি বিবৃতি",
            "footer_sitemap": "সাইটম্যাপ",
            "footer_contact_title": "প্রধান কার্যালয়",
            "footer_address": "শুভন্না ভবন, ৫ম ও ৬ষ্ঠ তল, ডিএফ ব্লক, সেক্টর-১, সল্টলেক, কলকাতা - ৭০০০৬৪",
            "footer_rights": "© ২০২৬ কৃষি বিপণন বিভাগ। সর্বস্বত্ব সংরক্ষিত।"
        },
        hi: {
            "gov_name": "राज्य कृषि विपणन बोर्ड",
            "farmer_helpline": "किसान हेल्पलाइन (टोल-फ्री):",
            "skip_content": "सीधे मुख्य सामग्री पर जाएं",
            "light_mode": "लाइट",
            "dark_mode": "डार्क",
            "dept_gov": "কৃषि विपणन विभाग",
            "dept_title": "कृषि विपणन विभाग",
            "dept_subtitle": "कृषि विपणन निदेशालय | राज्य विपणन बोर्ड",
            "nav_home": "होम",
            "nav_rates": "मंडी भाव",
            "nav_schemes": "योजनाएं व सब्सिडी",
            "nav_cold_storage": "कोल्ड स्टोरेज",
            "nav_marketplace": "फार्म कनेक्ट",
            "nav_about": "परिचय",
            "nav_contact": "संपर्क",
            "ticker_label": "लाइव मंडी भाव",
            "hero_badge": "कृषि मूल्य खोज एवं विपणन सेवाएं",
            "hero_title_prefix": "किसानों का सशक्तिकरण ",
            "hero_title_highlight": "उचित मूल्य व आधुनिक बाजार से",
            "hero_desc": "राज्य के 16 लाख से अधिक किसानों को विनियमित मंडियों, सुफल बांग्ला आउटलेट्स, आधुनिक कोल्ड स्टोरेज और पारदर्शी ई-ट्रेडिंग से सीधे जोड़ना।",
            "btn_explore_rates": "आज का मंडी भाव देखें",
            "btn_sufal_bangla": "सुफल बांग्ला केंद्र",
            "quick_widget_title": "त्वरित फसल मूल्य खोज",
            "select_crop_ph": "फसल चुनें...",
            "select_dist_ph": "जिला चुनें...",
            "btn_check_price": "भाव देखें",
            "quick_res_modal": "मॉडल भाव:",
            "quick_res_range": "न्यूनतम - अधिकतम:",
            "quick_res_trend": "रुझान:",
            "quick_res_arrivals": "आवक:",
            "float_mandi_count": "विनियमित एपीएमसी मंडियां",
            "float_settlement": "प्रत्यक्ष व्यापार निपटान",
            "stat_mandis": "विनियमित मंडियां",
            "stat_farmers": "पंजीकृत किसान",
            "stat_outlets": "सुफल बांग्ला केंद्र",
            "stat_trade": "वार्षिक व्यापार मात्रा",
            "services_tag": "🌟 प्रमुख सेवाएं",
            "services_title": "कृषि विपणन सेवाएं एवं अवसंरचना",
            "services_subtitle": "रीयल-टाइम मंडी भाव, सरकारी सब्सिडी, कोल्ड स्टोरेज और कृषि उत्पाद विपणन सुविधाएं।",
            "srv_mandi_title": "दैनिक मंडी भाव",
            "srv_mandi_desc": "एपीएमसी चौकियों से सीधे न्यूनतम, अधिकतम और 7-दिवसीय चार्ट।",
            "srv_mandi_link": "मंडी भाव देखें →",
            "srv_schemes_title": "योजनाएं व सब्सिडी",
            "srv_schemes_desc": "अमर फसल अमर गाड़ी वाहन सब्सिडी और इंटरैक्टिव सब्सिडी कैलकुलेटर।",
            "srv_schemes_link": "सब्सिडी गणना करें →",
            "srv_cold_title": "कोल्ड स्टोरेज ग्रिड",
            "srv_cold_desc": "जिलावार कोल्ड स्टोरेज क्षमता जांचें और ऑनलाइन स्लॉट बुक करें।",
            "srv_cold_link": "स्टोरेज खोजें →",
            "srv_market_title": "फार्म कनेक्ट हब",
            "srv_market_desc": "बिचौलियों के बिना किसानों से सीधे फसल व फल खरीदने का ई-मार्केटप्लेस।",
            "srv_market_link": "लिस्टिंग देखें →",
            "srv_krishak_title": "कृषक बाजार हब",
            "srv_krishak_desc": "आधुनिक कृषक बाजार, ग्रामीण हाट, इलेक्ट्रॉनिक वजन और पारदर्शी नीलामी।",
            "srv_krishak_link": "कृषक बाजार देखें →",
            "srv_agmark_title": "एगमार्क गुणवत्ता परीक्षण",
            "srv_agmark_desc": "खाद्य तेल, मसाले और शहद के लिए क्षेत्रीय एगमार्क प्रयोगशालाएं।",
            "srv_agmark_link": "गुणवत्ता मानक देखें →",
            "mandi_tag": "रियल-टाइम बाजार सूचना",
            "mandi_title": "दैनिक कृषि मंडी भाव",
            "mandi_subtitle": "एपीएमसी चौकियों से सीधे न्यूनतम, अधिकतम और मॉडल भाव की अद्यतन जानकारी।",
            "tab_all": "सभी फसलें",
            "tab_veg": "सब्जियां",
            "tab_grain": "अनाज व खाद्यान्न",
            "tab_pulses": "दालें",
            "tab_oilseed": "तिलहन व नकदी फसलें",
            "tab_fruits": "फल",
            "tab_spices": "मसाले",
            "search_crop_ph": "फसल खोजें (जैसे: आलू, प्याज, चावल)...",
            "all_districts": "सभी जिले",
            "th_commodity": "फसल व किस्म",
            "th_mandi": "बाजार / मंडी",
            "th_min": "न्यूनतम (₹/क्विंटल)",
            "th_max": "अधिकतम (₹/क्विंटल)",
            "th_modal": "मॉडल भाव (₹/क्विंटल)",
            "th_trend": "24 घंटे का रुझान",
            "th_action": "कार्रवाई",
            "btn_view_trend": "7-दिवसीय रुझान",
            "btn_set_alert": "एसएमएस अलर्ट पाएं",
            "btn_download_csv": "सीएसवी डाउनलोड",
            "btn_print_rates": "प्रिंट करें",
            "mandi_guide_1_title": "दैनिक मॉडल भाव सूत्र",
            "mandi_guide_1_desc": "मॉडल भाव मानक गुणवत्ता वाली उपज के लिए ट्रेडिंग फ्लोर पर किसानों द्वारा प्राप्त सर्वाधिक लेनदेन मूल्य को दर्शाता है।",
            "mandi_guide_2_title": "पारदर्शी इलेक्ट्रॉनिक नीलामी",
            "mandi_guide_2_desc": "सभी एपीएमसी मंडियां ई-नाम (e-NAM) इलेक्ट्रॉनिक तौल और 24 घंटे के भीतर सीधे बैंक निपटान के तहत कार्य करती हैं।",
            "mandi_guide_3_title": "विवाद समाधान",
            "mandi_guide_3_desc": "मूल्य विवाद या तौल विसंगतियों के लिए एपीएमसी सचिव से संपर्क करें या टोल-फ्री हेल्पलाइन पर कॉल करें: 1800-180-1551।",
            "init_tag": "प्रमुख कार्यक्रम",
            "init_title": "कृषि लॉजिस्टिक्स एवं प्रत्यक्ष व्यापार का विस्तार",
            "init_subtitle": "किसान और उपभोक्ताओं का सीधा संपर्क, वाहन सब्सिडी और आधुनिक भंडारण बुनियादी ढांचा।",
            "sufal_title": "सुफल बांग्ला आउटलेट",
            "sufal_desc": "बिचौलियों के बिना किसानों से सीधे ताजी सब्जियां और फल उपभोक्ताओं तक उचित मूल्य पर पहुंचाने का उपक्रम।",
            "sufal_f1": "450+ स्थायी व मोबाइल कियोस्क",
            "sufal_f2": "एफपीओ से सीधे दैनिक खरीद",
            "sufal_f3": "गुणवत्ता परीक्षण और पारदर्शी मूल्य",
            "amar_fasal_title": "अमर फसल अमर गाड़ी",
            "amar_desc": "किसानों और स्वयं सहायता समूहों के लिए कृषि परिवहन वाहन खरीदने हेतु 50% तक सरकारी सब्सिडी योजना।",
            "amar_f1": "50% वाहन लागत सब्सिडी (अधिकतम ₹1.5 लाख)",
            "amar_f2": "परिवहन में फसल बर्बादी में कमी",
            "amar_f3": "थोक मंडियों तक त्वरित सीधी आपूर्ति",
            "cold_grid_title": "कोल्ड स्टोरेज व वेयरहाउसिंग ग्रिड",
            "cold_desc": "रीयल-टाइम स्लॉट बुकिंग और नमी-नियंत्रित भंडारण कक्षों के साथ आधुनिक कोल्ड चेन नेटवर्क।",
            "cold_f1": "जिलावार उपलब्ध क्षमता ट्रैकर",
            "cold_f2": "कृषि इकाइयों के लिए रियायती बिजली दर",
            "cold_f3": "वैज्ञानिक संरक्षण व एगमार्क प्रयोगशालाएं",
            "calc_tag": "इंटरैक्टिव सब्सिडी टूल",
            "calc_title": "कृषि विपणन सब्सिडी व योजना कैलकुलेटर",
            "calc_subtitle": "आसानी से मात्र 3 क्लिक में अपनी अनुमानित सब्सिडी पात्रता की गणना करें।",
            "lbl_beneficiary": "लाभार्थी श्रेणी चुनें:",
            "opt_small_farmer": "लघु एवं सीमांत किसान",
            "opt_small_farmer_sub": "2 हेक्टेयर तक कृषि भूमि",
            "opt_women_farmer": "महिला किसान / स्वयं सहायता समूह",
            "opt_women_farmer_sub": "महिला संचालित कृषि उद्यम",
            "opt_fpo": "एफपीओ / किसान सहकारी समिति",
            "opt_fpo_sub": "पंजीकृत उत्पादक समूह",
            "opt_agri_startup": "कृषि उद्यमी / स्टार्टअप",
            "opt_agri_startup_sub": "आधुनिक विपणन अवसंरचना",
            "lbl_facility": "आवश्यक अवसंरचना / सहायता:",
            "opt_fac_vehicle": "उपज परिवहन वाहन (अमर फसल)",
            "opt_fac_cold": "सोलर कोल्ड रूम / भंडारण इकाई",
            "opt_fac_packhouse": "ग्रेडिंग व पैकेजिंग केंद्र",
            "opt_fac_kiosk": "अमर दुकान आधुनिक रिटेल कियोस्क",
            "lbl_cost": "अनुमानित परियोजना लागत (₹ लाख में):",
            "res_subsidy_title": "पात्र सरकारी सब्सिडी",
            "res_scheme_label": "अनुशंसित योजना:",
            "btn_apply_scheme": "आवेदन दिशानिर्देश डाउनलोड करें",
            "cs_tag": "भंडारण अवसंरचना",
            "cs_title": "जिला कोल्ड स्टोरेज व एपीएमसी खोजें",
            "cs_subtitle": "उपलब्ध भंडारण क्षमता की जांच करें और सीधे स्लॉट बुक करें।",
            "btn_book_space": "स्टोरेज स्लॉट आरक्षित करें",
            "cs_available": "स्थान उपलब्ध है",
            "cs_limited": "तेजी से भर रहा है",
            "market_tag": "प्रत्यक्ष किसान संपर्क",
            "market_title": "किसान उत्पाद प्रदर्शनी एवं व्यापार केंद्र",
            "market_subtitle": "किसानों से सीधे कृषि उत्पाद खरीदने के लिए सत्यापित सूची।",
            "btn_contact_farmer": "बोली / पूछताछ भेजें",
            "notices_tag": "आधिकारिक सूचनाएं",
            "notices_title": "निविदाएं, सरकारी आदेश व किसान सलाह",
            "tab_tenders": "निविदा व ईओआई",
            "tab_bulletins": "दैनिक मूल्य बुलेटिन",
            "tab_circulars": "न्यूनतम समर्थन मूल्य व आदेश",
            "btn_download_pdf": "पीडीएफ डाउनलोड",
            "advisory_heading": "किसानों के लिए दैनिक मंडी सलाह",
            "footer_about_title": "कृषि विपणन विभाग",
            "footer_about_desc": "किसानों के सशक्तिकरण, खाद्य मूल्यों में स्थिरता और आधुनिक कृषि विपणन प्रणाली के निर्माण के लिए प्रतिबद्ध।",
            "footer_quick_links": "त्वरित लिंक",
            "footer_schemes_links": "प्रमुख योजनाएं",
            "footer_scheme_amar": "आमार फसल आमार गाड़ी",
            "footer_scheme_sufal": "सुफल बांग्ला आउटलेट्स",
            "footer_scheme_solar": "सोलर कोल्ड चेन सहायता",
            "footer_scheme_krishak": "कृषक बंधु लिंकेज",
            "footer_scheme_enam": "ई-नाम अंतर-राज्यीय व्यापार",
            "footer_scheme_agmark": "एगमार्क गुणवत्ता प्रमाणन",
            "footer_helpline_label": "किसान कॉल सेंटर / २४x७ हेल्पलाइन:",
            "footer_lbl_helpline": "हेल्पलाइन:",
            "footer_lbl_email": "ईमेल:",
            "footer_lbl_website": "वेबसाइट:",
            "footer_privacy": "गोपनीयता नीति",
            "footer_terms": "उपयोग की शर्तें",
            "footer_accessibility": "सुलभता विवरण",
            "footer_sitemap": "साइटमैप",
            "footer_contact_title": "मुख्यालय",
            "footer_address": "सुभन्ना भवन, 5वीं व 6वीं मंजिल, डीएफ ब्लॉक, सेक्टर-1, साल्ट लेक, कोलकाता - 700064",
            "footer_rights": "© 2026 कृषि विपणन विभाग। सर्वाधिकार सुरक्षित।"
        }
    },

    init() {
        const savedLang = localStorage.getItem('app_lang') || 'en';
        this.setLanguage(savedLang);

        // Global delegated click listener for language switch buttons
        document.addEventListener('click', (e) => {
            const btn = e.target.closest('[data-lang]');
            if (btn && btn.classList.contains('lang-btn')) {
                const lang = btn.getAttribute('data-lang');
                this.setLanguage(lang);
            }
        });
    },

    _getDict(lang) {
        if (this.translations && this.translations[lang]) {
            return this.translations[lang];
        }
        return this.translations['en'] || {};
    },

    setLanguage(lang) {
        const validLangs = ['en', 'bn', 'hi'];
        if (!validLangs.includes(lang)) lang = 'en';
        this.currentLang = lang;
        localStorage.setItem('app_lang', lang);
        document.documentElement.setAttribute('lang', lang);

        // Update active state on all lang buttons
        document.querySelectorAll('.lang-btn').forEach(btn => {
            btn.classList.toggle('active', btn.getAttribute('data-lang') === lang);
        });

        // Translate all [data-i18n] elements across the entire page
        const dict = this._getDict(lang);
        document.querySelectorAll('[data-i18n]').forEach(el => {
            const key = el.getAttribute('data-i18n');
            if (dict[key] !== undefined) {
                if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
                    el.placeholder = dict[key];
                } else {
                    el.innerHTML = dict[key];
                }
            }
        });

        // Re-render active dynamic modules safely
        try { if (typeof MandiRatesModule !== 'undefined') { MandiRatesModule.renderTicker(); MandiRatesModule.renderTable(); } } catch (e) { }
        try { if (typeof QuickDiscoveryModule !== 'undefined') QuickDiscoveryModule.updateLocalizedOptions(); } catch (e) { }
        try { if (typeof SubsidyCalculatorModule !== 'undefined') SubsidyCalculatorModule.calculate(); } catch (e) { }
        try { if (typeof ColdStorageModule !== 'undefined') ColdStorageModule.render(); } catch (e) { }
        try { if (typeof MarketplaceModule !== 'undefined') MarketplaceModule.render(); } catch (e) { }
    }
};

/* ==========================================================================
   2. ACCESSIBILITY CONTROLLER (A-, A, A+ Continuous Font Size Scaling)
   ========================================================================== */
const AccessibilityManager = {
    currentScale: 1.0,
    minScale: 0.75, // Min 75%
    maxScale: 1.40, // Max 140%
    step: 0.05,     // 5% per click continuous adjustment

    init() {
        const saved = localStorage.getItem('font_scale');
        let initialScale = 1.0;
        if (saved) {
            if (saved === 'std') initialScale = 1.0;
            else if (saved === 'dec') initialScale = 0.90;
            else if (saved === 'inc') initialScale = 1.15;
            else {
                const parsed = parseFloat(saved);
                if (!isNaN(parsed) && isFinite(parsed)) initialScale = parsed;
            }
        }
        this.setScale(initialScale);

        document.querySelectorAll('.font-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const action = e.currentTarget.getAttribute('data-size');
                this.handleAction(action);
            });
        });
    },

    handleAction(action) {
        if (action === 'std') this.reset();
        else if (action === 'inc') this.increase();
        else if (action === 'dec') this.decrease();
    },

    increase() {
        const next = Math.min(this.maxScale, parseFloat((this.currentScale + this.step).toFixed(2)));
        this.setScale(next);
    },

    decrease() {
        const next = Math.max(this.minScale, parseFloat((this.currentScale - this.step).toFixed(2)));
        this.setScale(next);
    },

    reset() {
        this.setScale(1.0);
    },

    setFontScale(sizeKeyOrValue) {
        if (sizeKeyOrValue === 'std') this.reset();
        else if (sizeKeyOrValue === 'inc') this.increase();
        else if (sizeKeyOrValue === 'dec') this.decrease();
        else {
            const parsed = parseFloat(sizeKeyOrValue);
            if (!isNaN(parsed)) this.setScale(parsed);
        }
    },

    setScale(scaleVal) {
        const numericVal = typeof scaleVal === 'number' ? scaleVal : parseFloat(scaleVal);
        const clamped = Math.min(this.maxScale, Math.max(this.minScale, isNaN(numericVal) ? 1.0 : numericVal));
        this.currentScale = parseFloat(clamped.toFixed(2));

        document.documentElement.style.setProperty('--font-scale', this.currentScale);
        localStorage.setItem('font_scale', this.currentScale.toString());

        this.updateUI();
    },

    updateUI() {
        const isStd = Math.abs(this.currentScale - 1.0) < 0.01;
        const isInc = this.currentScale > 1.01;
        const isDec = this.currentScale < 0.99;
        const pct = Math.round(this.currentScale * 100);

        document.querySelectorAll('.font-btn').forEach(btn => {
            const type = btn.getAttribute('data-size');
            if (type === 'std') {
                btn.classList.toggle('active', isStd);
                btn.setAttribute('title', 'Normal Font Size (100%)');
            } else if (type === 'inc') {
                btn.classList.toggle('active', isInc);
                const isMax = this.currentScale >= this.maxScale;
                btn.disabled = isMax;
                btn.setAttribute('title', isMax ? `Maximum Font Size Reached (${pct}%)` : `Increase Font Size (Current: ${pct}%)`);
            } else if (type === 'dec') {
                btn.classList.toggle('active', isDec);
                const isMin = this.currentScale <= this.minScale;
                btn.disabled = isMin;
                btn.setAttribute('title', isMin ? `Minimum Font Size Reached (${pct}%)` : `Decrease Font Size (Current: ${pct}%)`);
            }
        });
    }
};

/* ==========================================================================
   3. THEME MANAGER (Light / Dark Mode)
   ========================================================================== */
const ThemeManager = {
    init() {
        const savedTheme = localStorage.getItem('theme_mode') || 'light';
        this.setTheme(savedTheme);

        const toggleBtn = document.getElementById('themeToggleBtn');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                const current = document.documentElement.getAttribute('data-theme') || 'light';
                const next = current === 'light' ? 'dark' : 'light';
                this.setTheme(next);
            });
        }
    },

    setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme_mode', theme);

        const iconSpan = document.getElementById('themeIcon');
        const textSpan = document.getElementById('themeText');
        if (iconSpan) iconSpan.textContent = theme === 'light' ? '🌙' : '☀️';
        if (textSpan) {
            textSpan.textContent = theme === 'light' ? 'Dark' : 'Light';
        }
    }
};

/* ==========================================================================
   4. MANDI RATES & PRICE DISCOVERY MODULE
   ========================================================================== */
const MandiRatesModule = {
    data: [
        { id: 1, nameEn: "Potato (Jyoti)", nameBn: "আলু (জ্যোতি)", nameHi: "आलू (ज्योति)", category: "veg", icon: "🥔", mandi: "Hooghly APMC", district: "Hooghly", min: 1450, max: 1620, modal: 1540, trend: "+40", trendType: "up", history: [1420, 1450, 1480, 1500, 1510, 1500, 1540] },
        { id: 2, nameEn: "Potato (Chandramukhi)", nameBn: "আলু (চন্দ্রমুখী)", nameHi: "आलू (चंद्रमुखी)", category: "veg", icon: "🥔", mandi: "Burdwan Central", district: "Burdwan", min: 1750, max: 1950, modal: 1880, trend: "+60", trendType: "up", history: [1700, 1720, 1760, 1800, 1820, 1850, 1880] },
        { id: 3, nameEn: "Onion (Nashik Red)", nameBn: "পেঁয়াজ (নাসিক লাল)", nameHi: "प्याज (नासिक लाल)", category: "veg", icon: "🧅", mandi: "Kolkata (Koley Market)", district: "Kolkata", min: 2400, max: 2750, modal: 2600, trend: "-50", trendType: "down", history: [2800, 2750, 2720, 2680, 2650, 2620, 2600] },
        { id: 4, nameEn: "Tomato (Hybrid)", nameBn: "টমেটো (হাইব্রিড)", nameHi: "टमाटर (हाइब्रिड)", category: "veg", icon: "🍅", mandi: "Nadia APMC", district: "Nadia", min: 1800, max: 2200, modal: 2050, trend: "+80", trendType: "up", history: [1750, 1820, 1880, 1920, 1950, 2000, 2050] },
        { id: 5, nameEn: "Gobindobhog Rice", nameBn: "গোবিন্দভোগ চাল", nameHi: "गोविंदभोग चावल", category: "grain", icon: "🌾", mandi: "Burdwan Regulated", district: "Burdwan", min: 6200, max: 6800, modal: 6500, trend: "0", trendType: "stable", history: [6450, 6500, 6500, 6480, 6500, 6500, 6500] },
        { id: 6, nameEn: "Basmati Paddy (1121)", nameBn: "বাসমতী ধান (১১২১)", nameHi: "बासमती धान (1121)", category: "grain", icon: "🌾", mandi: "Murshidabad Market", district: "Murshidabad", min: 3800, max: 4250, modal: 4100, trend: "+75", trendType: "up", history: [3900, 3950, 3980, 4020, 4050, 4080, 4100] },
        { id: 7, nameEn: "Mustard (Yellow)", nameBn: "হলুদ সরিষা", nameHi: "पीली सरसों", category: "oilseed", icon: "🌻", mandi: "Bankura Mandi", district: "Bankura", min: 5400, max: 5850, modal: 5650, trend: "-30", trendType: "down", history: [5800, 5780, 5750, 5720, 5700, 5680, 5650] },
        { id: 8, nameEn: "Raw Jute (TD-5)", nameBn: "কাঁচা পাট (টিডি-৫)", nameHi: "कच्चा जूट (TD-5)", category: "oilseed", icon: "🌿", mandi: "North 24 Pgs (Barasat)", district: "North 24 Parganas", min: 5100, max: 5500, modal: 5350, trend: "+120", trendType: "up", history: [4950, 5050, 5120, 5200, 5250, 5300, 5350] },
        { id: 9, nameEn: "Green Chili (Tejas)", nameBn: "কাঁচা লঙ্কা (তেজস)", nameHi: "हरी मिर्च (तेजस)", category: "veg", icon: "🌶️", mandi: "South 24 Pgs", district: "South 24 Parganas", min: 3200, max: 3900, modal: 3600, trend: "-110", trendType: "down", history: [4100, 3950, 3850, 3800, 3720, 3650, 3600] },
        { id: 10, nameEn: "Turmeric (Raw Finger)", nameBn: "কাঁচা হলুদ", nameHi: "কচ্চি হলদি", category: "spices", icon: "🫚", mandi: "Jalpaiguri APMC", district: "Jalpaiguri", min: 7800, max: 8600, modal: 8300, trend: "+150", trendType: "up", history: [7900, 8000, 8050, 8120, 8200, 8250, 8300] },
        { id: 11, nameEn: "Pointed Gourd (Potol)", nameBn: "পটল", nameHi: "परवल", category: "veg", icon: "🥒", mandi: "Hooghly APMC", district: "Hooghly", min: 2800, max: 3400, modal: 3100, trend: "+45", trendType: "up", history: [2900, 2950, 3000, 3020, 3050, 3080, 3100] },
        { id: 12, nameEn: "Mango (Himsagar)", nameBn: "আম (হিমসাগর)", nameHi: "आम (हिमसागर)", category: "fruits", icon: "🥭", mandi: "Malda English Bazar", district: "Malda", min: 4500, max: 5500, modal: 5000, trend: "-80", trendType: "down", history: [5400, 5350, 5280, 5200, 5150, 5080, 5000] }
    ],

    activeCategory: 'all',
    searchQuery: '',
    selectedDistrict: 'all',
    currentPage: 1,
    pageSize: 6,

    init() {
        this.renderTicker();
        this.renderTable();
        this.bindEvents();
    },

    bindEvents() {
        document.querySelectorAll('.category-pill').forEach(pill => {
            pill.addEventListener('click', (e) => {
                document.querySelectorAll('.category-pill').forEach(p => p.classList.remove('active'));
                e.currentTarget.classList.add('active');
                this.activeCategory = e.currentTarget.getAttribute('data-cat');
                this.currentPage = 1;
                this.renderTable();
            });
        });

        const searchInput = document.getElementById('mandiSearchInput');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                this.searchQuery = e.target.value.toLowerCase().trim();
                this.currentPage = 1;
                this.renderTable();
            });
        }

        const districtSelect = document.getElementById('mandiDistrictSelect');
        if (districtSelect) {
            districtSelect.addEventListener('change', (e) => {
                this.selectedDistrict = e.target.value;
                this.currentPage = 1;
                this.renderTable();
            });
        }
    },

    getFilteredData() {
        const lang = I18nEngine.currentLang;
        return this.data.filter(item => {
            const matchesCat = this.activeCategory === 'all' || item.category === this.activeCategory;
            const matchesDist = this.selectedDistrict === 'all' || item.district === this.selectedDistrict;
            const cropName = (lang === 'bn' ? item.nameBn : lang === 'hi' ? item.nameHi : item.nameEn).toLowerCase();
            const matchesSearch = !this.searchQuery || cropName.includes(this.searchQuery) || item.mandi.toLowerCase().includes(this.searchQuery);
            return matchesCat && matchesDist && matchesSearch;
        });
    },

    prevPage() {
        if (this.currentPage > 1) {
            this.currentPage--;
            this.renderTable();
        }
    },

    nextPage() {
        const filtered = this.getFilteredData();
        const totalPages = Math.ceil(filtered.length / this.pageSize) || 1;
        if (this.currentPage < totalPages) {
            this.currentPage++;
            this.renderTable();
        }
    },

    goToPage(pageNum) {
        this.currentPage = pageNum;
        this.renderTable();
    },

    renderTicker() {
        const track = document.getElementById('tickerTrack');
        if (!track) return;

        const lang = I18nEngine.currentLang;
        let itemsHtml = '';
        const list = [...this.data, ...this.data];
        list.forEach(item => {
            const cropName = lang === 'bn' ? item.nameBn : lang === 'hi' ? item.nameHi : item.nameEn;
            const trendHtml = item.trendType === 'up'
                ? `<span class="trend-up">▲ ₹${item.trend}</span>`
                : item.trendType === 'down'
                    ? `<span class="trend-down">▼ ₹${item.trend.replace('-', '')}</span>`
                    : `<span class="trend-stable">━ ₹0</span>`;

            itemsHtml += `
                <div class="ticker-item" onclick="MandiRatesModule.openChartModal(${item.id})">
                    <span>${item.icon}</span>
                    <span class="ticker-crop">${cropName}</span>
                    <span class="ticker-price">₹${item.modal.toLocaleString('en-IN')}/Q</span>
                    ${trendHtml}
                </div>
            `;
        });

        track.innerHTML = itemsHtml;
    },

    renderTable() {
        const tableBody = document.getElementById('mandiTableBody');
        if (!tableBody) return;

        const lang = I18nEngine.currentLang;
        const filtered = this.getFilteredData();
        const totalItems = filtered.length;
        const totalPages = Math.ceil(totalItems / this.pageSize) || 1;

        if (this.currentPage > totalPages) {
            this.currentPage = totalPages;
        }

        if (totalItems === 0) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align:center; padding: 2.5rem; color: var(--text-muted);">
                        🌾 No commodities found matching your criteria.
                    </td>
                </tr>
            `;
            this.updatePaginationUI(0, 0, 0, 1);
            return;
        }

        const startIndex = (this.currentPage - 1) * this.pageSize;
        const endIndex = Math.min(startIndex + this.pageSize, totalItems);
        const pagedItems = filtered.slice(startIndex, endIndex);

        let rowsHtml = '';
        pagedItems.forEach(item => {
            const cropName = lang === 'bn' ? item.nameBn : lang === 'hi' ? item.nameHi : item.nameEn;
            const trendBadge = item.trendType === 'up'
                ? `<span class="trend-badge up">▲ +₹${item.trend}</span>`
                : item.trendType === 'down'
                    ? `<span class="trend-badge down">▼ -₹${item.trend.replace('-', '')}</span>`
                    : `<span class="trend-badge stable">━ ₹0</span>`;

            rowsHtml += `
                <tr>
                    <td>
                        <div class="crop-cell">
                            <span class="crop-emoji-icon">${item.icon}</span>
                            <div>
                                <span class="crop-name-title">${cropName}</span>
                                <span class="crop-variety">${item.mandi}</span>
                            </div>
                        </div>
                    </td>
                    <td><strong>${item.district}</strong></td>
                    <td>₹${item.min.toLocaleString('en-IN')}</td>
                    <td>₹${item.max.toLocaleString('en-IN')}</td>
                    <td><span class="price-modal-badge">₹${item.modal.toLocaleString('en-IN')}</span></td>
                    <td>${trendBadge}</td>
                    <td>
                        <button class="btn btn-sm btn-outline" onclick="MandiRatesModule.openChartModal(${item.id})">
                            📈 <span>7-Day Trend</span>
                        </button>
                    </td>
                </tr>
            `;
        });

        tableBody.innerHTML = rowsHtml;
        this.updatePaginationUI(startIndex + 1, endIndex, totalItems, totalPages);
    },

    updatePaginationUI(start, end, total, totalPages) {
        document.querySelectorAll('#mandiStartIdx').forEach(el => el.textContent = start);
        document.querySelectorAll('#mandiEndIdx').forEach(el => el.textContent = end);
        document.querySelectorAll('#mandiResultCount').forEach(el => el.textContent = total);

        document.querySelectorAll('#mandiPrevBtn').forEach(btn => {
            btn.disabled = this.currentPage <= 1;
        });

        document.querySelectorAll('#mandiNextBtn').forEach(btn => {
            btn.disabled = this.currentPage >= totalPages || total === 0;
        });

        document.querySelectorAll('#mandiPageNumbers').forEach(container => {
            let pagesHtml = '';
            for (let i = 1; i <= totalPages; i++) {
                const activeCls = i === this.currentPage ? 'active' : '';
                pagesHtml += `<button class="pagination-page-btn ${activeCls}" onclick="MandiRatesModule.goToPage(${i})" aria-label="Page ${i}">${i}</button>`;
            }
            container.innerHTML = pagesHtml;
        });
    },

    openChartModal(commodityId) {
        const item = this.data.find(d => d.id === commodityId);
        if (!item) return;

        const lang = I18nEngine.currentLang;
        const cropName = lang === 'bn' ? item.nameBn : lang === 'hi' ? item.nameHi : item.nameEn;

        const modalTitle = document.getElementById('modalCropTitle');
        const modalCurPrice = document.getElementById('modalCurrentPrice');
        const modalMinMax = document.getElementById('modalMinMax');

        if (modalTitle) modalTitle.textContent = `${item.icon} ${cropName} - ${item.mandi}`;
        if (modalCurPrice) modalCurPrice.textContent = `₹${item.modal.toLocaleString('en-IN')} / Quintal`;
        if (modalMinMax) modalMinMax.textContent = `Min: ₹${item.min} | Max: ₹${item.max}`;

        ModalManager.open('chartModal');
        setTimeout(() => this.drawCanvasChart(item), 150);
    },

    drawCanvasChart(item) {
        const canvas = document.getElementById('priceTrendChart');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        const dpr = window.devicePixelRatio || 1;

        canvas.width = canvas.parentElement.clientWidth * dpr;
        canvas.height = 260 * dpr;
        ctx.scale(dpr, dpr);

        const width = canvas.parentElement.clientWidth;
        const height = 260;
        const padding = { top: 25, right: 30, bottom: 40, left: 55 };

        ctx.clearRect(0, 0, width, height);

        const prices = item.history;
        const minP = Math.min(...prices) * 0.95;
        const maxP = Math.max(...prices) * 1.05;
        const days = ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Today'];

        const getX = index => padding.left + (index / (prices.length - 1)) * (width - padding.left - padding.right);
        const getY = price => height - padding.bottom - ((price - minP) / (maxP - minP)) * (height - padding.top - padding.bottom);

        ctx.strokeStyle = 'rgba(15, 104, 56, 0.12)';
        ctx.fillStyle = '#64748b';
        ctx.font = '11px Plus Jakarta Sans, sans-serif';
        ctx.textAlign = 'right';

        const ySteps = 4;
        for (let i = 0; i <= ySteps; i++) {
            const val = minP + (i / ySteps) * (maxP - minP);
            const y = getY(val);
            ctx.beginPath();
            ctx.moveTo(padding.left, y);
            ctx.lineTo(width - padding.right, y);
            ctx.stroke();
            ctx.fillText('₹' + Math.round(val), padding.left - 8, y + 4);
        }

        const grad = ctx.createLinearGradient(0, padding.top, 0, height - padding.bottom);
        grad.addColorStop(0, 'rgba(15, 104, 56, 0.35)');
        grad.addColorStop(1, 'rgba(15, 104, 56, 0.00)');

        ctx.beginPath();
        ctx.moveTo(getX(0), getY(prices[0]));
        for (let i = 1; i < prices.length; i++) {
            ctx.lineTo(getX(i), getY(prices[i]));
        }
        ctx.lineTo(getX(prices.length - 1), height - padding.bottom);
        ctx.lineTo(getX(0), height - padding.bottom);
        ctx.closePath();
        ctx.fillStyle = grad;
        ctx.fill();

        ctx.beginPath();
        ctx.moveTo(getX(0), getY(prices[0]));
        for (let i = 1; i < prices.length; i++) {
            ctx.lineTo(getX(i), getY(prices[i]));
        }
        ctx.strokeStyle = '#0f6838';
        ctx.lineWidth = 3;
        ctx.stroke();

        ctx.textAlign = 'center';
        for (let i = 0; i < prices.length; i++) {
            const x = getX(i);
            const y = getY(prices[i]);

            ctx.beginPath();
            ctx.arc(x, y, 5, 0, Math.PI * 2);
            ctx.fillStyle = '#ffffff';
            ctx.fill();
            ctx.strokeStyle = '#0f6838';
            ctx.lineWidth = 2.5;
            ctx.stroke();

            ctx.beginPath();
            ctx.arc(x, y, 2.5, 0, Math.PI * 2);
            ctx.fillStyle = '#0f6838';
            ctx.fill();

            ctx.fillStyle = '#64748b';
            ctx.fillText(days[i], x, height - padding.bottom + 18);
        }
    },

    exportCSV() {
        let csv = "Commodity,Market,District,Min_Price,Max_Price,Modal_Price,Trend\n";
        this.data.forEach(d => {
            csv += `"${d.nameEn}","${d.mandi}","${d.district}",${d.min},${d.max},${d.modal},"${d.trend}"\n`;
        });
        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.setAttribute("download", `WB_Mandi_Rates_${new Date().toISOString().slice(0, 10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        showToast('Mandi rates exported successfully as CSV file!', 'success');
    }
};

/* ==========================================================================
   5. QUICK PRICE DISCOVERY MODULE (HERO SECTION)
   ========================================================================== */
const QuickDiscoveryModule = {
    init() {
        this.updateLocalizedOptions();
        const checkBtn = document.getElementById('heroCheckPriceBtn');
        if (checkBtn) {
            checkBtn.addEventListener('click', () => this.handleLookup());
        }
    },

    updateLocalizedOptions() {
        const cropSelect = document.getElementById('heroCropSelect');
        const distSelect = document.getElementById('heroDistrictSelect');
        const lang = I18nEngine.currentLang;
        const dict = I18nEngine._getDict(lang);

        if (cropSelect) {
            const curVal = cropSelect.value;
            const cropPh = dict.select_crop_ph || (lang === 'bn' ? 'শস্য নির্বাচন করুন...' : lang === 'hi' ? 'फसल चुनें...' : 'Select Commodity...');
            let optionsHtml = `<option value="">${cropPh}</option>`;
            MandiRatesModule.data.forEach(item => {
                const name = lang === 'bn' ? item.nameBn : lang === 'hi' ? item.nameHi : item.nameEn;
                optionsHtml += `<option value="${item.id}">${item.icon} ${name}</option>`;
            });
            cropSelect.innerHTML = optionsHtml;
            if (curVal) cropSelect.value = curVal;
        }

        if (distSelect) {
            const curDist = distSelect.value || 'all';
            const allDistText = dict.all_districts || (lang === 'bn' ? 'সকল জেলা' : lang === 'hi' ? 'सभी जिले' : 'All Districts');
            const districts = [
                { val: "all", label: allDistText },
                { val: "Hooghly", label: lang === 'bn' ? "হুগলি (Hooghly)" : lang === 'hi' ? "हुगली (Hooghly)" : "Hooghly" },
                { val: "Burdwan", label: lang === 'bn' ? "পূর্ব ও পশ্চিম বর্ধমান (Burdwan)" : lang === 'hi' ? "बर्धमान (Burdwan)" : "Burdwan" },
                { val: "Nadia", label: lang === 'bn' ? "নদিয়া (Nadia)" : lang === 'hi' ? "नादिया (Nadia)" : "Nadia" },
                { val: "Kolkata", label: lang === 'bn' ? "কলকাতা (Kolkata)" : lang === 'hi' ? "कोलकाता (Kolkata)" : "Kolkata" },
                { val: "Murshidabad", label: lang === 'bn' ? "মুর্শিদাবাদ (Murshidabad)" : lang === 'hi' ? "मुर्शिदाबाद (Murshidabad)" : "Murshidabad" },
                { val: "Bankura", label: lang === 'bn' ? "বাঁকুড়া (Bankura)" : lang === 'hi' ? "बांकुड़ा (Bankura)" : "Bankura" },
                { val: "Jalpaiguri", label: lang === 'bn' ? "জলপাইগুড়ি (Jalpaiguri)" : lang === 'hi' ? "जलपाईगुड़ी (Jalpaiguri)" : "Jalpaiguri" },
                { val: "Malda", label: lang === 'bn' ? "মালদা (Malda)" : lang === 'hi' ? "मालदा (Malda)" : "Malda" }
            ];
            let distHtml = '';
            districts.forEach(d => {
                distHtml += `<option value="${d.val}">${d.label}</option>`;
            });
            distSelect.innerHTML = distHtml;
            distSelect.value = curDist;
        }
    },

    handleLookup() {
        const cropSelect = document.getElementById('heroCropSelect');
        const resCard = document.getElementById('heroQuickResult');
        if (!cropSelect || !resCard) return;

        if (!cropSelect.value) {
            showToast('Please select a commodity first!', 'warning');
            return;
        }

        const item = MandiRatesModule.data.find(d => d.id === parseInt(cropSelect.value));
        if (!item) return;

        const lang = I18nEngine.currentLang;
        const cropName = lang === 'bn' ? item.nameBn : lang === 'hi' ? item.nameHi : item.nameEn;

        document.getElementById('qrCropName').textContent = `${item.icon} ${cropName} (${item.mandi})`;
        document.getElementById('qrModalPrice').textContent = `₹${item.modal.toLocaleString('en-IN')}/Qtl`;
        document.getElementById('qrRange').textContent = `₹${item.min} - ₹${item.max}`;
        document.getElementById('qrTrend').textContent = `${item.trendType === 'up' ? '▲ +' : item.trendType === 'down' ? '▼ -' : '━ '}₹${item.trend.replace('-', '')}`;

        resCard.classList.add('active');
    }
};

/* ==========================================================================
   6. INTERACTIVE SUBSIDY & SCHEME CALCULATOR
   ========================================================================== */
const SubsidyCalculatorModule = {
    selectedBeneficiary: 'small_farmer',
    selectedFacility: 'vehicle',
    costValue: 3.5,

    init() {
        document.querySelectorAll('.calc-opt-beneficiary').forEach(btn => {
            btn.addEventListener('click', (e) => {
                document.querySelectorAll('.calc-opt-beneficiary').forEach(b => b.classList.remove('active'));
                e.currentTarget.classList.add('active');
                this.selectedBeneficiary = e.currentTarget.getAttribute('data-val');
                this.calculate();
            });
        });

        document.querySelectorAll('.calc-opt-facility').forEach(btn => {
            btn.addEventListener('click', (e) => {
                document.querySelectorAll('.calc-opt-facility').forEach(b => b.classList.remove('active'));
                e.currentTarget.classList.add('active');
                this.selectedFacility = e.currentTarget.getAttribute('data-val');
                this.calculate();
            });
        });

        const costInput = document.getElementById('calcCostInput');
        if (costInput) {
            costInput.addEventListener('input', (e) => {
                this.costValue = parseFloat(e.target.value) || 1;
                const costDisplay = document.getElementById('calcCostDisplay');
                if (costDisplay) costDisplay.textContent = `₹${this.costValue.toFixed(1)} Lakhs`;
                this.calculate();
            });
        }

        this.calculate();
    },

    calculate() {
        let percent = 40;
        let maxCap = 2.0;
        let schemeName = "Amar Fasal Amar Gari Scheme";

        if (this.selectedBeneficiary === 'small_farmer') {
            percent = 50;
            maxCap = 1.5;
        } else if (this.selectedBeneficiary === 'women_farmer') {
            percent = 60;
            maxCap = 2.5;
        } else if (this.selectedBeneficiary === 'fpo') {
            percent = 55;
            maxCap = 15.0;
        } else if (this.selectedBeneficiary === 'agri_startup') {
            percent = 35;
            maxCap = 10.0;
        }

        if (this.selectedFacility === 'cold') {
            schemeName = "Solar Cold Room & Storage Support Scheme";
            percent = Math.min(percent + 5, 60);
            maxCap = 5.0;
        } else if (this.selectedFacility === 'packhouse') {
            schemeName = "Agricultural Marketing Infrastructure (AMI) Scheme";
            maxCap = 8.0;
        } else if (this.selectedFacility === 'kiosk') {
            schemeName = "Amar Dukan Modern Retail Kiosk Grant";
            maxCap = 1.2;
        }

        const eligibleSubsidy = Math.min((this.costValue * percent) / 100, maxCap);
        const farmerShare = this.costValue - eligibleSubsidy;

        const amountEl = document.getElementById('calcResAmount');
        const percentEl = document.getElementById('calcResPercent');
        const schemeEl = document.getElementById('calcResScheme');
        const breakTotal = document.getElementById('calcBreakTotal');
        const breakGov = document.getElementById('calcBreakGov');
        const breakOwn = document.getElementById('calcBreakOwn');

        if (amountEl) amountEl.textContent = `₹${eligibleSubsidy.toFixed(2)} Lakhs`;
        if (percentEl) percentEl.textContent = `${percent}% (Max ₹${maxCap}L)`;
        if (schemeEl) schemeEl.textContent = schemeName;
        if (breakTotal) breakTotal.textContent = `₹${this.costValue.toFixed(2)} Lakhs`;
        if (breakGov) breakGov.textContent = `₹${eligibleSubsidy.toFixed(2)} Lakhs`;
        if (breakOwn) breakOwn.textContent = `₹${farmerShare.toFixed(2)} Lakhs`;
    }
};

/* ==========================================================================
   7. COLD STORAGE LOCATOR MODULE
   ========================================================================== */
const ColdStorageModule = {
    units: [
        { id: 1, name: "Hooghly Agro Cold Storage Unit-1", district: "Hooghly", capacity: 12000, available: 3200, temp: "2°C - 4°C (Potato / Veg)", phone: "+91 98301 44551", status: "available" },
        { id: 2, name: "Burdwan Central Krishi Bhandar", district: "Burdwan", capacity: 15000, available: 1400, temp: "1°C - 3°C (Multi-Chamber)", phone: "+91 94340 77890", status: "limited" },
        { id: 3, name: "Nadia Kisan Cold Chain & Packhouse", district: "Nadia", capacity: 8500, available: 2800, temp: "0°C - 5°C (Horticulture)", phone: "+91 97321 66542", status: "available" },
        { id: 4, name: "Malda Mango & Fruit Preservation Hub", district: "Malda", capacity: 6000, available: 850, temp: "4°C - 8°C (Ripening & Storage)", phone: "+91 94741 22300", status: "limited" },
        { id: 5, name: "Bankura Multi-Commodity Cold Unit", district: "Bankura", capacity: 10000, available: 4100, temp: "2°C - 6°C (Seeds & Veg)", phone: "+91 96472 88910", status: "available" },
        { id: 6, name: "Siliguri Agri Logistic Cold Center", district: "Darjeeling / Siliguri", capacity: 14000, available: 5200, temp: "-2°C - 4°C (Export Hub)", phone: "+91 98002 11456", status: "available" }
    ],

    init() {
        this.render();
        const distFilter = document.getElementById('coldStorageDistFilter');
        if (distFilter) {
            distFilter.addEventListener('change', (e) => this.render(e.target.value));
        }
    },

    render(filterDist = 'all') {
        const grid = document.getElementById('coldStorageGrid');
        if (!grid) return;

        const filtered = this.units.filter(u => filterDist === 'all' || u.district.includes(filterDist));

        let html = '';
        filtered.forEach(unit => {
            const percentFilled = Math.round(((unit.capacity - unit.available) / unit.capacity) * 100);
            const badgeClass = unit.status === 'available' ? 'available' : 'limited';
            const badgeText = unit.status === 'available' ? 'Available Space' : 'Filling Fast';

            html += `
                <div class="facility-card">
                    <span class="facility-badge-status ${badgeClass}">${badgeText}</span>
                    <h3 class="facility-title">${unit.name}</h3>
                    <div class="facility-location">📍 ${unit.district}</div>
                    <div class="capacity-meter-wrap">
                        <div class="capacity-labels">
                            <span>${unit.available.toLocaleString('en-IN')} MT Free</span>
                            <span>${percentFilled}% Filled</span>
                        </div>
                        <div class="capacity-bar-bg">
                            <div class="capacity-bar-fill" style="width: ${percentFilled}%"></div>
                        </div>
                    </div>
                    <div class="facility-details">
                        <div>❄️ <strong>Temp:</strong> ${unit.temp}</div>
                        <div>📞 <strong>Manager:</strong> ${unit.phone}</div>
                    </div>
                    <button class="btn btn-sm btn-primary" style="width:100%" onclick="ModalManager.openStorageBooking('${unit.name}')">
                        📦 Reserve Storage Slot
                    </button>
                </div>
            `;
        });

        grid.innerHTML = html;
    }
};

/* ==========================================================================
   8. E-MARKETPLACE & DIRECT FARM PRODUCE MODULE
   ========================================================================== */
const MarketplaceModule = {
    produce: [
        { id: 1, crop: "Organic Jyoti Potato", icon: "🥔", farmer: "Subhash Mondal (FPO Member)", location: "Arambagh, Hooghly", qty: "450 Bags (50kg)", price: "₹780 / Bag", grade: "Agmark Grade-A" },
        { id: 2, crop: "Premium Gobindobhog Rice", icon: "🌾", farmer: "Burdwan Progressive Farmers SHG", location: "Memari, Burdwan", qty: "120 Quintals", price: "₹6,400 / Qtl", grade: "100% Certified" },
        { id: 3, crop: "Export Quality Fresh Ginger", icon: "🫚", farmer: "Tapan Roy (Hill Agro)", location: "Alipurduar, North Bengal", qty: "85 Quintals", price: "₹7,900 / Qtl", grade: "Pesticide Free" },
        { id: 4, crop: "Fresh Red Hybrid Tomato", icon: "🍅", farmer: "Pranab Ghosh", location: "Krishnanagar, Nadia", qty: "200 Crates", price: "₹420 / Crate", grade: "Farm Fresh" },
        { id: 5, crop: "Golden Mustard Seeds", icon: "🌻", farmer: "Bankura Krishi Bikash", location: "Kotulpur, Bankura", qty: "90 Quintals", price: "₹5,600 / Qtl", grade: "Agmark Certified" },
        { id: 6, crop: "Malda Mango Pulp (Fazli)", icon: "🥭", farmer: "Malda Mango Producer Co.", location: "Ratua, Malda", qty: "300 Barrels", price: "₹4,800 / Barrel", grade: "FSSAI Grade-A" }
    ],

    init() {
        this.render();
    },

    render() {
        const grid = document.getElementById('marketplaceGrid');
        if (!grid) return;

        let html = '';
        this.produce.forEach(p => {
            html += `
                <div class="produce-card">
                    <span class="produce-grade-tag">${p.grade}</span>
                    <div class="produce-icon-box">${p.icon}</div>
                    <h3 class="produce-title">${p.crop}</h3>
                    <div class="produce-farmer">👨‍🌾 ${p.farmer}</div>
                    <div class="produce-stats-row">
                        <div>
                            <span class="p-stat-lbl">Available</span>
                            <span class="p-stat-val">${p.qty}</span>
                        </div>
                        <div>
                            <span class="p-stat-lbl">Price Quote</span>
                            <span class="p-stat-val">${p.price}</span>
                        </div>
                    </div>
                    <div style="font-size:0.78rem; color:var(--text-muted); margin-bottom:1rem;">📍 ${p.location}</div>
                    <button class="btn btn-sm btn-accent" style="margin-top:auto" onclick="ModalManager.openProduceInquiry('${p.crop}', '${p.farmer}')">
                        🤝 Send Bid / Inquiry
                    </button>
                </div>
            `;
        });

        grid.innerHTML = html;
    }
};

/* ==========================================================================
   9. SCHEMES & NOTICES MODULE
   ========================================================================== */
const SchemesModule = {
    data: []
};

const NoticesModule = {
    data: {
        tenders: [
            { id: "T1", day: "28", month: "Aug", title: "Expression of Interest (EOI) for installation of Solar Powered Micro Cold Rooms in Hooghly and Burdwan APMC premises.", ref: "Ref: WBSAMB/NIT-14/2026", fileSize: "1.2 MB" },
            { id: "T2", day: "25", month: "Aug", title: "Revised Daily Price Bulletin & Arrival Report for Agricultural and Horticultural Commodities for Kharif Season.", ref: "Ref: AMD/PB/AUG-2026/08", fileSize: "850 KB" },
            { id: "T3", day: "20", month: "Aug", title: "Notification regarding Minimum Support Price (MSP) and procurement centers for Paddy and Jute for Kharif Marketing Season.", ref: "Ref: GO-WB-AGRI-552/2026", fileSize: "2.1 MB" }
        ],
        advisory: []
    },

    init() {
        document.querySelectorAll('.notice-tab-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                document.querySelectorAll('.notice-tab-btn').forEach(b => b.classList.remove('active'));
                e.currentTarget.classList.add('active');
                showToast('Switched notice filter category', 'info');
            });
        });
    }
};

/* ==========================================================================
   10. MODAL & DIALOG MANAGER
   ========================================================================== */
const ModalManager = {
    init() {
        document.querySelectorAll('.modal-close-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const overlay = e.currentTarget.closest('.modal-overlay');
                if (overlay) overlay.classList.remove('active');
            });
        });

        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) overlay.classList.remove('active');
            });
        });

        const alertForm = document.getElementById('smsAlertForm');
        if (alertForm) {
            alertForm.addEventListener('submit', (e) => {
                e.preventDefault();
                showToast('✅ SMS / WhatsApp Daily Price Alert Activated successfully!', 'success');
                this.close('alertModal');
            });
        }



        const contactForm = document.getElementById('citizenContactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', (e) => {
                e.preventDefault();
                showToast('✅ Grievance / Inquiry submitted! Ticket ID: WB-AGRI-' + Math.floor(100000 + Math.random() * 900000), 'success');
                contactForm.reset();
            });
        }
    },

    open(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) modal.classList.add('active');
    },

    close(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) modal.classList.remove('active');
    },

    openStorageBooking(unitName) {
        const titleEl = document.getElementById('bookingUnitName');
        if (titleEl) titleEl.textContent = unitName;
        this.open('storageBookingModal');
    },

    openProduceInquiry(cropName, farmerName) {
        const cEl = document.getElementById('inquiryCropName');
        const fEl = document.getElementById('inquiryFarmerName');
        if (cEl) cEl.textContent = cropName;
        if (fEl) fEl.textContent = farmerName;
        this.open('produceInquiryModal');
    }
};

/* ==========================================================================
   11. NUMBER COUNTER MODULE (Smooth Rolling Count-Up with Easing)
   ========================================================================== */
const NumberCounterModule = {
    animatedElements: new Set(),

    init() {
        const counters = document.querySelectorAll('[data-counter-target]');
        if (!counters.length) return;

        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.animateCounter(entry.target);
                        obs.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.15,
                rootMargin: '0px 0px -40px 0px'
            });

            counters.forEach(counter => observer.observe(counter));
        } else {
            counters.forEach(counter => this.animateCounter(counter));
        }
    },

    animateCounter(el) {
        if (this.animatedElements.has(el)) return;
        this.animatedElements.add(el);

        const target = parseFloat(el.getAttribute('data-counter-target')) || 0;
        const prefix = el.getAttribute('data-counter-prefix') || '';
        const suffix = el.getAttribute('data-counter-suffix') || '';
        const decimals = parseInt(el.getAttribute('data-counter-decimals'), 10) || 0;
        const duration = parseInt(el.getAttribute('data-counter-duration'), 10) || 2000;

        const startTime = performance.now();

        // Quintic Easing Out for smooth deceleration
        const easeOutQuint = (t) => 1 - Math.pow(1 - t, 5);

        const updateNumber = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easedProgress = easeOutQuint(progress);
            const currentVal = (easedProgress * target);

            let formattedVal;
            if (decimals > 0) {
                formattedVal = currentVal.toFixed(decimals);
            } else {
                formattedVal = Math.floor(currentVal).toLocaleString('en-IN');
            }

            el.textContent = `${prefix}${formattedVal}${suffix}`;

            if (progress < 1) {
                requestAnimationFrame(updateNumber);
            } else {
                const finalVal = decimals > 0 ? target.toFixed(decimals) : target.toLocaleString('en-IN');
                el.textContent = `${prefix}${finalVal}${suffix}`;
                el.classList.add('counter-completed');
            }
        };

        requestAnimationFrame(updateNumber);
    }
};

/* ==========================================================================
   12. SERVICES & INFRASTRUCTURE AUTO-SLIDER MODULE
   ========================================================================== */
const ServicesSliderModule = {
    currentIndex: 0,
    intervalTimer: null,
    slideInterval: 3200,
    isPaused: false,
    touchStartX: 0,
    touchEndX: 0,

    init() {
        const track = document.getElementById('servicesSliderTrack');
        const container = document.getElementById('servicesSliderContainer');
        if (!track || !container) return;

        this.renderDots();
        this.updateSlider();
        setTimeout(() => this.updateSlider(), 150);
        this.startAutoSlide();
        this.bindEvents();
    },

    getVisibleCount() {
        const width = window.innerWidth;
        if (width <= 680) return 1;
        if (width <= 1024) return 2;
        return 3;
    },

    getTotalSlides() {
        const items = document.querySelectorAll('.service-slide-item');
        return items.length || 0;
    },

    getMaxIndex() {
        const total = this.getTotalSlides();
        const visible = this.getVisibleCount();
        return Math.max(0, total - visible);
    },

    renderDots() {
        const dotsContainer = document.getElementById('servicesSliderDots');
        if (!dotsContainer) return;

        const maxIdx = this.getMaxIndex();
        let dotsHtml = '';
        for (let i = 0; i <= maxIdx; i++) {
            const activeCls = i === this.currentIndex ? 'active' : '';
            dotsHtml += `<button type="button" class="slider-dot ${activeCls}" data-slide="${i}" aria-label="Go to service slide ${i + 1}"></button>`;
        }
        dotsContainer.innerHTML = dotsHtml;

        dotsContainer.querySelectorAll('.slider-dot').forEach(dot => {
            dot.addEventListener('click', (e) => {
                const idx = parseInt(e.currentTarget.getAttribute('data-slide'), 10);
                this.goToSlide(idx);
                this.startAutoSlide();
            });
        });
    },

    updateSlider() {
        const track = document.getElementById('servicesSliderTrack');
        if (!track) return;

        const items = document.querySelectorAll('.service-slide-item');
        if (!items.length) return;

        const itemWidth = items[0].getBoundingClientRect().width;
        const gap = 24;
        const offset = this.currentIndex * (itemWidth + gap);

        track.style.transform = `translateX(-${offset}px)`;

        const dots = document.querySelectorAll('.slider-dot');
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === this.currentIndex);
        });

        const prevBtn = document.getElementById('servicesPrevBtn');
        const nextBtn = document.getElementById('servicesNextBtn');
        if (prevBtn) prevBtn.style.opacity = '1';
        if (nextBtn) nextBtn.style.opacity = '1';
    },

    nextSlide() {
        const maxIdx = this.getMaxIndex();
        if (this.currentIndex < maxIdx) {
            this.currentIndex++;
        } else {
            this.currentIndex = 0;
        }
        this.updateSlider();
    },

    prevSlide() {
        const maxIdx = this.getMaxIndex();
        if (this.currentIndex > 0) {
            this.currentIndex--;
        } else {
            this.currentIndex = maxIdx;
        }
        this.updateSlider();
    },

    goToSlide(idx) {
        const maxIdx = this.getMaxIndex();
        this.currentIndex = Math.max(0, Math.min(idx, maxIdx));
        this.updateSlider();
    },

    startAutoSlide() {
        this.stopAutoSlide();
        this.intervalTimer = setInterval(() => {
            if (!this.isPaused) {
                this.nextSlide();
            }
        }, this.slideInterval);
    },

    stopAutoSlide() {
        if (this.intervalTimer) {
            clearInterval(this.intervalTimer);
            this.intervalTimer = null;
        }
    },

    bindEvents() {
        const prevBtn = document.getElementById('servicesPrevBtn');
        const nextBtn = document.getElementById('servicesNextBtn');
        const container = document.getElementById('servicesSliderContainer');

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                this.prevSlide();
                this.startAutoSlide();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                this.nextSlide();
                this.startAutoSlide();
            });
        }

        if (container) {
            container.addEventListener('mouseenter', () => { this.isPaused = true; });
            container.addEventListener('mouseleave', () => { this.isPaused = false; });

            container.addEventListener('touchstart', (e) => {
                this.touchStartX = e.changedTouches[0].screenX;
                this.isPaused = true;
            }, { passive: true });

            container.addEventListener('touchend', (e) => {
                this.touchEndX = e.changedTouches[0].screenX;
                this.isPaused = false;
                this.handleSwipe();
            }, { passive: true });
        }

        window.addEventListener('resize', () => {
            const maxIdx = this.getMaxIndex();
            if (this.currentIndex > maxIdx) {
                this.currentIndex = maxIdx;
            }
            this.renderDots();
            this.updateSlider();
        });
    },

    handleSwipe() {
        const diff = this.touchStartX - this.touchEndX;
        if (Math.abs(diff) > 40) {
            if (diff > 0) {
                this.nextSlide();
            } else {
                this.prevSlide();
            }
            this.startAutoSlide();
        }
    }
};

/* ==========================================================================
   13. NAVIGATION & ACTIVE ROUTING MODULE
   ========================================================================== */
const NavigationModule = {
    init() {
        const toggleBtn = document.getElementById('mobileMenuToggle');
        const navMenu = document.getElementById('navMenu');

        if (toggleBtn && navMenu) {
            toggleBtn.addEventListener('click', () => {
                navMenu.classList.toggle('active');
            });

            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    navMenu.classList.remove('active');
                });
            });
        }

        const cleanPath = (p) => (p || '')
            .split('?')[0]
            .split('#')[0]
            .split('/')
            .filter(Boolean)
            .pop() || 'index';
        const normCurrent = cleanPath(window.location.pathname).replace(/\.(html|htm)$/i, '').toLowerCase();
        const activeName = (normCurrent === '' || normCurrent === '/' || normCurrent === 'index') ? 'index' : normCurrent;

        document.querySelectorAll('.nav-link').forEach(link => {
            const href = link.getAttribute('href');
            if (href) {
                const normHref = cleanPath(href).replace(/\.(html|htm)$/i, '').toLowerCase();
                const linkName = (normHref === '' || normHref === '/' || normHref === 'index') ? 'index' : normHref;
                if (linkName === activeName) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            }
        });

        window.addEventListener('scroll', () => {
            const header = document.querySelector('.main-header');
            if (header) {
                if (window.scrollY > 30) {
                    header.classList.add('header-scrolled');
                } else {
                    header.classList.remove('header-scrolled');
                }
            }
        }, { passive: true });
    }
};

function showToast(message, type = 'info') {
    let container = document.querySelector('.toast-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'toast-container';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `<span>${message}</span>`;
    container.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => toast.remove(), 300);
    }, 3800);
}
