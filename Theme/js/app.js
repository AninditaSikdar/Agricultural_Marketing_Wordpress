/**
 * Agricultural Marketing Portal - National Benchmark AgriTech Engine
 * 3 Core Languages: English, Bengali (বাংলা), Hindi (हिंदी)
 * e-Bijak Invoicing, 7/30-Day Price Intelligence, Role-Based Persona Hubs, and PWA Support
 */

document.addEventListener('DOMContentLoaded', async () => {
    // 0. Load Common Header & Footer Components
    await HeaderComponent.init();
    await FooterComponent.init();

    // 1. Initialize Core UI & Accessibility Managers
    AccessibilityManager.init();
    ThemeManager.init();
    NavigationModule.init();
    ModalManager.init();

    // 2. Load Data from JSON & Initialize Business Modules
    await DataLoader.init();
    I18nEngine.init();
    MandiRatesModule.init();
    QuickDiscoveryModule.init();
    PersonaHubModule.init();
    EBijakModule.init();
    FreightCalculatorModule.init();
    ColdStorageModule.init();
    MarketplaceModule.init();
    NumberCounterModule.init();
    ServicesSliderModule.init();
    GIShowcaseSliderModule.init();
    ServicesModule.init();
    SchemesSliderModule.init();
    NetRealisationModule.init();
    BackToTopModule.init();
    PWAModule.init();
});

/* ==========================================================================
   0. COMMON HEADER COMPONENT LOADER (ENGLISH, BENGALI, HINDI)
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

            <!-- 3-Language Switcher (English, Bengali, Hindi) -->
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

<!-- Main Brand Header & Navigation -->
<header class="main-header">
    <div class="container header-container">
        <a href="index.html" class="brand-section" aria-label="Agricultural Marketing Department, Government of West Bengal">
            <div class="brand-emblem-wrapper">
                <img src="./images/Logo.png" alt="Government of West Bengal Emblem" class="brand-logo-img">
            </div>
            <div class="brand-text-block">
                <span class="brand-title" data-i18n="dept_title">Agricultural Marketing Department</span>
                <span class="brand-subtitle" data-i18n="dept_gov_wb">Government of West Bengal</span>
            </div>
        </a>

        <nav class="nav-menu" id="navMenu" aria-label="Main Navigation">
            <!-- Mobile Drawer Header with Close Button -->
            <div class="nav-drawer-header">
                <div class="nav-drawer-brand">
                    <span class="nav-drawer-logo">🌾</span>
                    <span class="nav-drawer-title">Navigation</span>
                </div>
                <button type="button" class="nav-close-btn" id="navCloseBtn" aria-label="Close Navigation Menu">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <div class="nav-item"><a href="index.html" class="nav-link" data-i18n="nav_home">Home</a></div>
            
            <div class="nav-item">
                <a href="mandi-rates.html" class="nav-link">
                    <span data-i18n="nav_rates">Mandi Rates</span>
                </a>
            </div>

            <!-- Services & Infrastructure Dropdown -->
            <div class="nav-item has-dropdown">
                <button type="button" class="nav-link nav-dropdown-btn" aria-haspopup="true" aria-expanded="false">
                    <span data-i18n="nav_services">Services</span>
                    <span class="dropdown-arrow">▾</span>
                </button>
                <div class="nav-dropdown-menu">
                    <a href="services.html" class="dropdown-item">
                        <span class="dropdown-icon">🏛️</span>
                        <div>
                            <span class="dropdown-title" data-i18n="nav_services">Services & Infrastructure</span>
                            <span class="dropdown-subtitle">19 Core Strategic Domains</span>
                        </div>
                    </a>
                    <a href="logistics-freight.html" class="dropdown-item">
                        <span class="dropdown-icon">🚚</span>
                        <div>
                            <span class="dropdown-title" data-i18n="nav_logistics">Logistics & Freight</span>
                            <span class="dropdown-subtitle">Agri Fleet & Route Transit</span>
                        </div>
                    </a>
                    <a href="cold-storage.html" class="dropdown-item">
                        <span class="dropdown-icon">❄️</span>
                        <div>
                            <span class="dropdown-title" data-i18n="nav_cold_storage">Cold Storages & Silos</span>
                            <span class="dropdown-subtitle">WDRA Grid & e-NWR Financing</span>
                        </div>
                    </a>
                    <a href="schemes.html" class="dropdown-item">
                        <span class="dropdown-icon">🌾</span>
                        <div>
                            <span class="dropdown-title" data-i18n="nav_schemes">Schemes & Subsidies</span>
                            <span class="dropdown-subtitle">State Grants & Applications</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Digital Trade Dropdown -->
            <div class="nav-item has-dropdown">
                <button type="button" class="nav-link nav-dropdown-btn" aria-haspopup="true" aria-expanded="false">
                    <span data-i18n="nav_trade">Digital Trade</span>
                    <span class="dropdown-arrow">▾</span>
                </button>
                <div class="nav-dropdown-menu">
                    <a href="marketplace.html" class="dropdown-item">
                        <span class="dropdown-icon">🤝</span>
                        <div>
                            <span class="dropdown-title" data-i18n="nav_marketplace">Farm Connect Marketplace</span>
                            <span class="dropdown-subtitle">Verified Lots & Live e-Auctions</span>
                        </div>
                    </a>
                    <a href="ebijak-ledger.html" class="dropdown-item">
                        <span class="dropdown-icon">📑</span>
                        <div>
                            <span class="dropdown-title" data-i18n="nav_ebijak">e-Bijak Invoicing</span>
                            <span class="dropdown-subtitle">APMC Cess & Digital Ledgers</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- About Department Dropdown -->
            <div class="nav-item has-dropdown dropdown-right">
                <button type="button" class="nav-link nav-dropdown-btn" aria-haspopup="true" aria-expanded="false">
                    <span data-i18n="nav_about">About Us</span>
                    <span class="dropdown-arrow">▾</span>
                </button>
                <div class="nav-dropdown-menu">
                    <a href="about.html" class="dropdown-item">
                        <span class="dropdown-icon">🏛️</span>
                        <div>
                            <span class="dropdown-title" data-i18n="nav_about_dept">About Agricultural Marketing Department</span>
                        </div>
                    </a>
                    <a href="about.html#krishak-bazar" class="dropdown-item">
                        <span class="dropdown-icon">🏪</span>
                        <div>
                            <span class="dropdown-title" data-i18n="nav_krishak_bazar">Krishak Bazar</span>
                        </div>
                    </a>
                    <a href="about.html#paddy-procurement" class="dropdown-item">
                        <span class="dropdown-icon">🌾</span>
                        <div>
                            <span class="dropdown-title" data-i18n="nav_paddy_proc">Paddy Procurement</span>
                        </div>
                    </a>
                    <a href="schemes.html" class="dropdown-item">
                        <span class="dropdown-icon">📋</span>
                        <div>
                            <span class="dropdown-title" data-i18n="nav_proj_scheme">Project and Scheme</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="nav-item"><a href="contact.html" class="nav-link" data-i18n="nav_contact">Contact Us</a></div>
        </nav>

        <div class="header-actions">
            <button class="mobile-toggle-btn" id="mobileMenuToggle" aria-label="Toggle Navigation Menu">
                ☰
            </button>
        </div>
    </div>
</header>

<!-- Live AGMARKNET 2.0 / e-NAM Commodity Price Ticker -->
<div class="ticker-wrapper" aria-label="Live Mandi Price Ticker">
    <div class="ticker-label">
        <span class="ticker-source-badge">⚡ AGMARKNET 2.0 LIVE</span>
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

        if (window.location.protocol.startsWith('http')) {
            try {
                const res = await fetch('./components/header.html');
                if (res.ok) {
                    headerContainer.innerHTML = await res.text();
                    return;
                }
            } catch (err) { }
        }

        headerContainer.innerHTML = this.template;
    }
};

/* ==========================================================================
   0.1 COMMON FOOTER COMPONENT LOADER
   ========================================================================== */
const FooterComponent = {
    template: `
<section class="affiliated-bodies-strip" aria-label="Affiliated Bodies and Directorates">
    <div class="container affiliated-bodies-container">
        <a href="about.html#directorate" class="affiliated-body-card" title="Directorate of Agricultural Marketing, Govt. of West Bengal">
            <img src="./images/logo-sec/Directorate.jpg" alt="Directorate Agri.Mkt., Govt.of WB" class="affiliated-body-img">
        </a>
        <a href="about.html#wbsamb" class="affiliated-body-card" title="West Bengal State Agricultural Marketing Board (WBSAMB)">
            <img src="./images/logo-sec/WBSAMB.jpg" alt="WBSAMB" class="affiliated-body-img">
        </a>
        <a href="about.html#corporation" class="affiliated-body-card" title="Paschimbanga Agri Marketing Corporation Ltd.">
            <img src="./images/logo-sec/corporation.jpg" alt="Paschimbanga Agri Marketing Corporation Ltd." class="affiliated-body-img">
        </a>
        <a href="about.html#training-institute" class="affiliated-body-card" title="Netaji Subhas Training Institute of Agricultural Marketing (NSTIAM)">
            <img src="./images/logo-sec/nstiam-logo.jpg" alt="NSTIAM Enabling Employability" class="affiliated-body-img">
        </a>
        <!-- <a href="services.html" class="affiliated-body-card affiliated-card-text" title="Construction Permission">
            <span>Construction Permission</span>
        </a> -->
    </div>
</section>

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
                    <div class="f-help-label" data-i18n="farmer_helpline">Kisan Call Center / 24x7 Helpline:</div>
                    <span class="f-help-num">1800-180-1551</span>
                </div>
            </div>

            <div>
                <h4 class="footer-col-title" data-i18n="footer_quick_links">Quick Navigation</h4>
                <ul class="footer-links">
                    <li><a href="index.html">› <span data-i18n="nav_home">Home</span></a></li>
                    <li><a href="mandi-rates.html">› <span data-i18n="nav_rates">Daily Mandi Rates</span></a></li>
                    <li><a href="services.html">› <span data-i18n="nav_services">Services & Infrastructure</span></a></li>
                    <li><a href="ebijak-ledger.html">› <span data-i18n="nav_ebijak">e-Bijak & Ledgers</span></a></li>
                    <li><a href="logistics-freight.html">› <span data-i18n="nav_logistics">Logistics & Freight</span></a></li>
                    <li><a href="schemes.html">› <span data-i18n="nav_schemes">Schemes & Subsidies</span></a></li>
                    <li><a href="cold-storage.html">› <span data-i18n="nav_cold_storage">Cold Storage Network</span></a></li>
                    <li><a href="marketplace.html">› <span data-i18n="nav_marketplace">Farm Connect Hub</span></a></li>
                    <li><a href="about.html">› <span data-i18n="nav_about">About Us</span></a></li>
                    <li><a href="contact.html">› <span data-i18n="nav_contact">Contact Us</span></a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-col-title" data-i18n="footer_schemes_links">AgriTech & Schemes</h4>
                <ul class="footer-links">
                    <li><a href="ebijak-ledger.html">› <span>e-Bijak Invoicing (APMC Cess)</span></a></li>
                    <li><a href="logistics-freight.html">› <span>Freight Transport Calculator</span></a></li>
                    <li><a href="cold-storage.html">› <span>WDRA Cold Storage & e-NWR</span></a></li>
                    <li><a href="schemes.html">› <span>Amar Fasal Amar Gari</span></a></li>
                    <li><a href="schemes.html">› <span>Sufal Bangla Outlets</span></a></li>
                    <li><a href="marketplace.html">› <span>Live Mandi E-Auction Floor</span></a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-col-title">Headquarters</h4>
                <p style="font-size:0.88rem; color:#94a3b8; line-height:1.6; margin-bottom:1rem;">
                    Subhanna, 5th & 6th Floor, DF Block, Sector-I, Salt Lake, Kolkata - 700064
                </p>
                <div style="font-size:0.85rem; color:#cbd5e1; display:flex; flex-direction:column; gap:0.35rem;">
                    <div>📞 <strong>Helpline:</strong> 1800-180-1551</div>
                    <div>✉️ <strong>Email:</strong> agrimarketing@gov.in</div>
                    <div>🌐 <strong>Portal:</strong> agrimarketing.wb.gov.in</div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div data-i18n="footer_rights">
                © 2026 Agricultural Marketing Department. All Rights Reserved.
            </div>
            <div style="display:flex; gap:1.2rem; flex-wrap:wrap;">
                <a href="about.html" style="color:#94a3b8;">Privacy Policy</a>
                <a href="about.html" style="color:#94a3b8;">Terms of Trade</a>
                <a href="about.html" style="color:#94a3b8;">AGMARKNET 2.0 Compliance</a>
                <a href="about.html" style="color:#94a3b8;">Sitemap</a>
            </div>
        </div>
    </div>
</footer>

<!-- Floating Back to Top Button -->
<button type="button" class="back-to-top-btn" id="backToTopBtn" aria-label="Back to top" title="Back to top">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 15l-6-6-6 6"/>
    </svg>
</button>`,

    async init() {
        const footerContainer = document.getElementById('common-footer') || document.getElementById('site-footer');
        if (footerContainer) {
            if (window.location.protocol.startsWith('http')) {
                try {
                    const res = await fetch('./components/footer.html');
                    if (res.ok) {
                        footerContainer.innerHTML = await res.text();
                        BackToTopModule.init();
                        return;
                    }
                } catch (err) { }
            }
            footerContainer.innerHTML = this.template;
        }
        BackToTopModule.init();
    }
};

/* ==========================================================================
   0.2 BACK TO TOP MODULE
   ========================================================================== */
const BackToTopModule = {
    init() {
        const btn = document.getElementById('backToTopBtn');
        if (!btn || btn.dataset.initialized) return;
        btn.dataset.initialized = "true";

        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                btn.classList.add('visible');
            } else {
                btn.classList.remove('visible');
            }
        }, { passive: true });

        btn.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
};

/* ==========================================================================
   DATA LOADER
   ========================================================================== */
const DataLoader = {
    async init() {
        try {
            const [mandiRes, csRes, marketRes, noticesRes, schemesRes, transRes, servicesRes] = await Promise.allSettled([
                fetch('./data/mandi-rates.json').then(r => r.json()),
                fetch('./data/cold-storage.json').then(r => r.json()),
                fetch('./data/marketplace.json').then(r => r.json()),
                fetch('./data/notices.json').then(r => r.json()),
                fetch('./data/schemes.json').then(r => r.json()),
                fetch('./data/translations.json').then(r => r.json()),
                fetch('./data/services.json').then(r => r.json())
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
                if (typeof SchemesModule !== 'undefined') {
                    SchemesModule.data = schemesRes.value;
                }
            }
            if (transRes.status === 'fulfilled' && transRes.value) {
                I18nEngine.translations = transRes.value;
            }
            if (servicesRes.status === 'fulfilled' && Array.isArray(servicesRes.value)) {
                DataLoader.services = servicesRes.value;
            }
        } catch (e) {
            console.info("Using embedded datasets.");
        }
    }
};

/* ==========================================================================
   1. 3-LANGUAGE I18N ENGINE (ENGLISH, BENGALI, HINDI)
   ========================================================================== */
const I18nEngine = {
    currentLang: 'en',
    translations: {},

    langMap: {
        'en': 'English',
        'bn': 'বাংলা',
        'hi': 'हिंदी'
    },

    init() {
        const savedLang = localStorage.getItem('site_lang') || 'en';
        this.setLanguage(savedLang);
        this.bindEvents();
    },

    bindEvents() {
        document.querySelectorAll('.lang-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const lang = e.currentTarget.getAttribute('data-lang');
                if (lang) {
                    this.setLanguage(lang);
                }
            });
        });
    },

    _getDict(lang) {
        if (this.translations && this.translations[lang]) {
            return { ...this.translations['en'], ...this.translations[lang] };
        }
        return this.translations['en'] || {};
    },

    setLanguage(lang) {
        if (!this.langMap[lang]) lang = 'en';
        this.currentLang = lang;
        localStorage.setItem('site_lang', lang);
        document.documentElement.setAttribute('lang', lang);

        document.querySelectorAll('.lang-btn').forEach(btn => {
            btn.classList.toggle('active', btn.getAttribute('data-lang') === lang);
        });

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

        // Refresh UI components with translated text
        try { if (typeof MandiRatesModule !== 'undefined') { MandiRatesModule.renderTicker(); MandiRatesModule.renderTable(); } } catch (e) { }
        try { if (typeof QuickDiscoveryModule !== 'undefined') QuickDiscoveryModule.updateLocalizedOptions(); } catch (e) { }
        try { if (typeof EBijakModule !== 'undefined') EBijakModule.updateLocalizedLabels(); } catch (e) { }
        try { if (typeof FreightCalculatorModule !== 'undefined') FreightCalculatorModule.calculate(); } catch (e) { }
        try { if (typeof ColdStorageModule !== 'undefined') ColdStorageModule.render(); } catch (e) { }
        try { if (typeof MarketplaceModule !== 'undefined') MarketplaceModule.render(); } catch (e) { }
        try { if (typeof ServicesModule !== 'undefined') ServicesModule.render(); } catch (e) { }
    }
};

/* ==========================================================================
   2. MANDI RATES & 7/30-DAY HISTORICAL PRICE INTELLIGENCE MODULE
   ========================================================================== */
const MandiRatesModule = {
    data: [
        { id: 1, nameEn: "Potato (Jyoti)", nameBn: "আলু (জ্যোতি)", nameHi: "आलू (ज्योति)", category: "veg", icon: "🥔", variety: "Jyoti Grade-A", mandi: "Hooghly APMC", district: "Hooghly", state: "West Bengal", arrivals: 840, min: 1450, max: 1620, modal: 1540, trend: "+40", trendType: "up", lotId: "LOT-HGY-8841", assayQuality: { moisture: "11.2%", moistureRating: "Optimal (<12%)", foreignMatter: "0.3%", grainSize: "45-55 mm", defect: "0.5%", fssaiGrade: "FSSAI Grade-A", agmarkGrade: "AGMARK Grade-I", certId: "WB-QC-2026-8841", verified: true }, history7: [1420, 1450, 1480, 1500, 1510, 1500, 1540], history30: [1360, 1380, 1390, 1400, 1410, 1420, 1410, 1430, 1440, 1450, 1440, 1460, 1470, 1480, 1490, 1500, 1490, 1510, 1520, 1510, 1500, 1510, 1520, 1530, 1520, 1500, 1510, 1500, 1520, 1540] },
        { id: 2, nameEn: "Potato (Chandramukhi)", nameBn: "আলু (চন্দ্রমুখী)", nameHi: "आलू (चंद्रमुखी)", category: "veg", icon: "🥔", variety: "Chandramukhi Premium", mandi: "Burdwan Central", district: "Burdwan", state: "West Bengal", arrivals: 620, min: 1750, max: 1950, modal: 1880, trend: "+60", trendType: "up", lotId: "LOT-BWN-4102", assayQuality: { moisture: "10.9%", moistureRating: "Optimal (<12%)", foreignMatter: "0.2%", grainSize: "50-65 mm", defect: "0.4%", fssaiGrade: "FSSAI Grade-A", agmarkGrade: "AGMARK Grade-I", certId: "WB-QC-2026-4102", verified: true }, history7: [1700, 1720, 1760, 1800, 1820, 1850, 1880], history30: [1600, 1620, 1640, 1650, 1680, 1700, 1690, 1710, 1720, 1740, 1730, 1750, 1760, 1770, 1790, 1800, 1810, 1800, 1820, 1830, 1820, 1840, 1850, 1860, 1850, 1840, 1860, 1850, 1870, 1880] },
        { id: 3, nameEn: "Onion (Nashik Red)", nameBn: "পেঁয়াজ (নাসিক লাল)", nameHi: "प्याज (नासिक लाल)", category: "veg", icon: "🧅", variety: "Nashik Medium Red", mandi: "Kolkata (Koley Market)", district: "Kolkata", state: "West Bengal", arrivals: 1250, min: 2400, max: 2750, modal: 2600, trend: "-50", trendType: "down", lotId: "LOT-KOL-7731", assayQuality: { moisture: "12.5%", moistureRating: "Good (<14%)", foreignMatter: "0.5%", grainSize: "40-60 mm", defect: "1.2%", fssaiGrade: "FSSAI Grade-B+", agmarkGrade: "AGMARK Grade-II", certId: "WB-QC-2026-7731", verified: true }, history7: [2800, 2750, 2720, 2680, 2650, 2620, 2600], history30: [3100, 3050, 3000, 2980, 2950, 2920, 2900, 2880, 2850, 2840, 2820, 2800, 2780, 2760, 2750, 2730, 2720, 2700, 2690, 2680, 2660, 2650, 2640, 2630, 2620, 2620, 2610, 2610, 2605, 2600] },
        { id: 4, nameEn: "Tomato (Hybrid)", nameBn: "টমেটো (হাইব্রিড)", nameHi: "टमाटर (हाइब्रिड)", category: "veg", icon: "🍅", variety: "Hybrid Red Firm", mandi: "Nadia APMC", district: "Nadia", state: "West Bengal", arrivals: 580, min: 1800, max: 2200, modal: 2050, trend: "+80", trendType: "up", lotId: "LOT-NDA-9014", assayQuality: { moisture: "91.0%", moistureRating: "Fresh Harvest", foreignMatter: "0.1%", grainSize: "55-70 mm", defect: "0.3%", fssaiGrade: "FSSAI Grade-A", agmarkGrade: "AGMARK Grade-I", certId: "WB-QC-2026-9014", verified: true }, history7: [1750, 1820, 1880, 1920, 1950, 2000, 2050], history30: [1500, 1520, 1550, 1580, 1600, 1640, 1660, 1680, 1700, 1720, 1750, 1780, 1800, 1820, 1850, 1860, 1880, 1900, 1920, 1940, 1950, 1960, 1980, 2000, 2010, 2020, 2030, 2035, 2040, 2050] },
        { id: 5, nameEn: "Gobindobhog Rice", nameBn: "গোবিন্দভোগ চাল", nameHi: "गोविंदभोग चावल", category: "grain", icon: "🌾", variety: "Aromatic Special Grade", mandi: "Burdwan Regulated", district: "Burdwan", state: "West Bengal", arrivals: 950, min: 6200, max: 6800, modal: 6500, trend: "0", trendType: "stable", lotId: "LOT-BWN-5520", assayQuality: { moisture: "11.5%", moistureRating: "Safe Storage (<13%)", foreignMatter: "0.1%", grainSize: "4.8 mm", defect: "0.2%", fssaiGrade: "FSSAI Premium", agmarkGrade: "AGMARK Special", certId: "WB-QC-2026-5520", verified: true }, history7: [6450, 6500, 6500, 6480, 6500, 6500, 6500], history30: [6400, 6420, 6450, 6450, 6460, 6470, 6480, 6500, 6500, 6490, 6480, 6500, 6500, 6510, 6500, 6490, 6500, 6500, 6480, 6500, 6500, 6510, 6500, 6490, 6500, 6500, 6480, 6500, 6500, 6500] },
        { id: 6, nameEn: "Basmati Paddy (1121)", nameBn: "বাসমতী ধান (১১২১)", nameHi: "बासमती धान (1121)", category: "grain", icon: "🌾", variety: "Pusa 1121 Long Grain", mandi: "Murshidabad Market", district: "Murshidabad", state: "West Bengal", arrivals: 720, min: 3800, max: 4250, modal: 4100, trend: "+75", trendType: "up", lotId: "LOT-MSD-3391", assayQuality: { moisture: "12.0%", moistureRating: "Dry Milling Grade", foreignMatter: "0.3%", grainSize: "8.2 mm", defect: "0.4%", fssaiGrade: "FSSAI Grade-A", agmarkGrade: "AGMARK Grade-I", certId: "WB-QC-2026-3391", verified: true }, history7: [3900, 3950, 3980, 4020, 4050, 4080, 4100], history30: [3700, 3720, 3750, 3780, 3800, 3820, 3850, 3880, 3900, 3920, 3940, 3950, 3970, 3980, 4000, 4020, 4030, 4050, 4060, 4070, 4080, 4080, 4090, 4090, 4095, 4100, 4090, 4095, 4090, 4100] },
        { id: 7, nameEn: "Mustard (Yellow)", nameBn: "হলুদ সরিষা", nameHi: "पीली सरसों", category: "oilseed", icon: "🌻", variety: "Yellow Bold High-Oil", mandi: "Bankura Mandi", district: "Bankura", state: "West Bengal", arrivals: 410, min: 5400, max: 5850, modal: 5650, trend: "-30", trendType: "down", lotId: "LOT-BKR-6180", assayQuality: { moisture: "8.5%", moistureRating: "Optimal (<9%)", foreignMatter: "0.5%", grainSize: "2.1 mm", defect: "0.3%", fssaiGrade: "FSSAI Grade-A", agmarkGrade: "AGMARK Grade-I", certId: "WB-QC-2026-6180", verified: true }, history7: [5800, 5780, 5750, 5720, 5700, 5680, 5650], history30: [6100, 6080, 6050, 6000, 5980, 5950, 5920, 5900, 5880, 5860, 5850, 5830, 5800, 5790, 5780, 5760, 5750, 5740, 5720, 5710, 5700, 5690, 5680, 5670, 5670, 5660, 5660, 5655, 5650, 5650] },
        { id: 8, nameEn: "Raw Jute (TD-5)", nameBn: "কাঁচা পাট (টিডি-৫)", nameHi: "कच्चा जूट (TD-5)", category: "oilseed", icon: "🌿", variety: "Tossa TD-5 Grade", mandi: "North 24 Pgs (Barasat)", district: "North 24 Parganas", state: "West Bengal", arrivals: 890, min: 5100, max: 5500, modal: 5350, trend: "+120", trendType: "up", lotId: "LOT-N24-9122", assayQuality: { moisture: "14.2%", moistureRating: "Standard (<15%)", foreignMatter: "0.8%", grainSize: "High Fiber Strength", defect: "0.5%", fssaiGrade: "N/A (Fiber)", agmarkGrade: "JCI Grade-TD5", certId: "WB-QC-2026-9122", verified: true }, history7: [4950, 5050, 5120, 5200, 5250, 5300, 5350], history30: [4600, 4650, 4700, 4750, 4800, 4850, 4880, 4900, 4920, 4950, 4980, 5000, 5030, 5050, 5080, 5100, 5120, 5150, 5180, 5200, 5220, 5250, 5260, 5280, 5300, 5320, 5330, 5340, 5345, 5350] },
        { id: 9, nameEn: "Green Chili (Tejas)", nameBn: "কাঁচা লঙ্কা (তেজস)", nameHi: "开展 मिर्च (तेजस)", category: "veg", icon: "🌶️", variety: "Tejas Extra Pungent", mandi: "South 24 Pgs", district: "South 24 Parganas", state: "West Bengal", arrivals: 320, min: 3200, max: 3900, modal: 3600, trend: "-110", trendType: "down", lotId: "LOT-S24-1184", assayQuality: { moisture: "82.0%", moistureRating: "Fresh Green", foreignMatter: "0.2%", grainSize: "60-80 mm", defect: "1.0%", fssaiGrade: "FSSAI Grade-A", agmarkGrade: "AGMARK Grade-I", certId: "WB-QC-2026-1184", verified: true }, history7: [4100, 3950, 3850, 3800, 3720, 3650, 3600], history30: [4500, 4450, 4400, 4350, 4300, 4250, 4200, 4150, 4100, 4050, 4000, 3950, 3920, 3900, 3880, 3850, 3820, 3800, 3780, 3750, 3720, 3700, 3680, 3650, 3640, 3620, 3610, 3605, 3600, 3600] },
        { id: 10, nameEn: "Turmeric (Raw Finger)", nameBn: "কাঁচা হলুদ", nameHi: "कच्ची हल्दी", category: "spices", icon: "🫚", variety: "Lakadong High Curcumin", mandi: "Jalpaiguri APMC", district: "Jalpaiguri", state: "West Bengal", arrivals: 260, min: 7800, max: 8600, modal: 8300, trend: "+150", trendType: "up", lotId: "LOT-JPG-7801", assayQuality: { moisture: "10.1%", moistureRating: "Dry Finger (<11%)", foreignMatter: "0.3%", grainSize: "Curcumin 6.2%", defect: "0.4%", fssaiGrade: "FSSAI Grade-A+", agmarkGrade: "AGMARK Special", certId: "WB-QC-2026-7801", verified: true }, history7: [7900, 8000, 8050, 8120, 8200, 8250, 8300], history30: [7400, 7450, 7500, 7550, 7600, 7650, 7700, 7750, 7800, 7850, 7900, 7920, 7950, 7980, 8000, 8030, 8050, 8080, 8100, 8120, 8150, 8180, 8200, 8220, 8240, 8250, 8270, 8280, 8290, 8300] },
        { id: 11, nameEn: "Pointed Gourd (Potol)", nameBn: "পটল", nameHi: "परवल", category: "veg", icon: "🥒", variety: "Swarna Alaukik Green", mandi: "Hooghly APMC", district: "Hooghly", state: "West Bengal", arrivals: 470, min: 2800, max: 3400, modal: 3100, trend: "+45", trendType: "up", lotId: "LOT-HGY-6623", assayQuality: { moisture: "88.0%", moistureRating: "Fresh Harvest", foreignMatter: "0.1%", grainSize: "75-90 mm", defect: "0.6%", fssaiGrade: "FSSAI Grade-A", agmarkGrade: "AGMARK Grade-I", certId: "WB-QC-2026-6623", verified: true }, history7: [2900, 2950, 3000, 3020, 3050, 3080, 3100], history30: [2600, 2650, 2680, 2700, 2720, 2750, 2780, 2800, 2820, 2850, 2880, 2900, 2920, 2940, 2960, 2980, 3000, 3010, 3020, 3030, 3040, 3050, 3060, 3070, 3080, 3080, 3090, 3095, 3100, 3100] },
        { id: 12, nameEn: "Mango (Himsagar)", nameBn: "আম (হিমসাগর)", nameHi: "आम (हिमसागर)", category: "fruits", icon: "🥭", variety: "GI Tagged Himsagar", mandi: "Malda English Bazar", district: "Malda", state: "West Bengal", arrivals: 780, min: 4500, max: 5500, modal: 5000, trend: "-80", trendType: "down", lotId: "LOT-MLD-9902", assayQuality: { moisture: "84.0%", moistureRating: "Optimal Brix (18.5°)", foreignMatter: "0.0%", grainSize: "220-260 gm", defect: "0.2%", fssaiGrade: "FSSAI Grade-A+", agmarkGrade: "GI Certified Himsagar", certId: "WB-QC-2026-9902", verified: true }, history7: [5400, 5350, 5280, 5200, 5150, 5080, 5000], history30: [5800, 5750, 5700, 5650, 5600, 5550, 5500, 5450, 5400, 5380, 5350, 5320, 5300, 5280, 5250, 5220, 5200, 5180, 5160, 5140, 5120, 5100, 5080, 5060, 5040, 5030, 5020, 5010, 5005, 5000] }
    ],

    activeCategory: 'all',
    searchQuery: '',
    selectedDistrict: 'all',
    selectedTimeframe: 7,
    activeCommodityForChart: null,
    currentPage: 1,
    pageSize: 6,

    init() {
        this.activeCommodityForChart = this.data[0];
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

        document.querySelectorAll('.timeframe-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                document.querySelectorAll('.timeframe-btn').forEach(b => b.classList.remove('active'));
                e.currentTarget.classList.add('active');
                this.selectedTimeframe = parseInt(e.currentTarget.getAttribute('data-days'), 10) || 7;
                if (this.activeCommodityForChart) {
                    this.drawCanvasChart(this.activeCommodityForChart, this.selectedTimeframe);
                }
            });
        });
    },

    getFilteredData() {
        const lang = I18nEngine.currentLang;
        return this.data.filter(item => {
            const matchesCat = this.activeCategory === 'all' || item.category === this.activeCategory;
            const matchesDist = this.selectedDistrict === 'all' || item.district === this.selectedDistrict;
            const cropName = (lang === 'bn' ? item.nameBn : lang === 'hi' ? item.nameHi : item.nameEn).toLowerCase();
            const matchesSearch = !this.searchQuery || cropName.includes(this.searchQuery) || item.mandi.toLowerCase().includes(this.searchQuery) || item.variety.toLowerCase().includes(this.searchQuery);
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
                    <span class="ticker-arrivals">${item.arrivals} Qtl</span>
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
                                <span class="crop-variety">${item.variety} (${item.lotId})</span>
                            </div>
                        </div>
                    </td>
                    <td><strong>${item.district}</strong><br><span style="font-size:0.75rem; color:var(--text-muted);">${item.mandi}</span></td>
                    <td>₹${item.min.toLocaleString('en-IN')}</td>
                    <td>₹${item.max.toLocaleString('en-IN')}</td>
                    <td><span class="price-modal-badge">₹${item.modal.toLocaleString('en-IN')}</span></td>
                    <td>${trendBadge}<br><span style="font-size:0.75rem; color:var(--text-muted);">📦 ${item.arrivals} Qtl</span></td>
                    <td>
                        <div class="table-actions-cell">
                            <button type="button" class="btn-table-icon btn-table-trend" onclick="MandiRatesModule.openChartModal(${item.id})" title="View 7/30-Day Price Trend Chart" aria-label="View Price Trend Chart">
                                📈
                            </button>
                            <button type="button" class="btn-table-icon btn-table-assay" onclick="MandiRatesModule.openAssayModal(${item.id})" title="View Quality Assaying Certificate" aria-label="View Quality Assaying Certificate">
                                🧪
                            </button>
                        </div>
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

        this.activeCommodityForChart = item;
        const lang = I18nEngine.currentLang;
        const cropName = lang === 'bn' ? item.nameBn : lang === 'hi' ? item.nameHi : item.nameEn;

        const modalTitle = document.getElementById('modalCropTitle');
        const modalCurPrice = document.getElementById('modalCurrentPrice');
        const modalMinMax = document.getElementById('modalMinMax');
        const modalLotBadge = document.getElementById('modalLotBadge');

        if (modalTitle) modalTitle.textContent = `${item.icon} ${cropName} - ${item.mandi}`;
        if (modalCurPrice) modalCurPrice.textContent = `₹${item.modal.toLocaleString('en-IN')} / Quintal`;
        if (modalMinMax) modalMinMax.textContent = `Min: ₹${item.min} | Max: ₹${item.max} | Arrivals: ${item.arrivals} Qtl`;
        if (modalLotBadge) modalLotBadge.textContent = item.lotId;

        ModalManager.open('chartModal');
        setTimeout(() => this.drawCanvasChart(item, this.selectedTimeframe), 150);
    },

    openAssayModal(commodityId) {
        const item = this.data.find(d => d.id === commodityId);
        if (!item) return;

        const lang = I18nEngine.currentLang;
        const cropName = lang === 'bn' ? item.nameBn : lang === 'hi' ? item.nameHi : item.nameEn;

        const titleEl = document.getElementById('assayCropTitle');
        const lotEl = document.getElementById('assayLotId');
        const certEl = document.getElementById('assayCertId');
        const moistureEl = document.getElementById('assayMoisture');
        const foreignEl = document.getElementById('assayForeign');
        const grainEl = document.getElementById('assayGrain');
        const defectEl = document.getElementById('assayDefect');
        const fssaiEl = document.getElementById('assayFssaiBadge');
        const agmarkEl = document.getElementById('assayAgmarkBadge');

        if (titleEl) titleEl.textContent = `${item.icon} ${cropName} (${item.variety})`;
        if (lotEl) lotEl.textContent = item.lotId;
        if (certEl) certEl.textContent = item.assayQuality.certId;
        if (moistureEl) moistureEl.textContent = item.assayQuality.moisture;
        if (foreignEl) foreignEl.textContent = item.assayQuality.foreignMatter;
        if (grainEl) grainEl.textContent = item.assayQuality.grainSize;
        if (defectEl) defectEl.textContent = item.assayQuality.defect;
        if (fssaiEl) fssaiEl.textContent = item.assayQuality.fssaiGrade;
        if (agmarkEl) agmarkEl.textContent = item.assayQuality.agmarkGrade;

        ModalManager.open('assayModal');
    },

    drawCanvasChart(item, daysCount = 7) {
        const canvas = document.getElementById('priceTrendChart');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        const dpr = window.devicePixelRatio || 1;

        canvas.width = canvas.parentElement.clientWidth * dpr;
        canvas.height = 280 * dpr;
        ctx.scale(dpr, dpr);

        const width = canvas.parentElement.clientWidth;
        const height = 280;
        const padding = { top: 25, right: 30, bottom: 45, left: 60 };

        ctx.clearRect(0, 0, width, height);

        const prices = (daysCount === 30 && item.history30) ? item.history30 : item.history7;
        const minP = Math.floor(Math.min(...prices) * 0.94);
        const maxP = Math.ceil(Math.max(...prices) * 1.06);

        const getX = index => padding.left + (index / (prices.length - 1)) * (width - padding.left - padding.right);
        const getY = price => height - padding.bottom - ((price - minP) / (maxP - minP)) * (height - padding.top - padding.bottom);

        // Grid lines
        ctx.strokeStyle = 'rgba(255, 147, 1, 0.15)';
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

        // Fill area gradient
        const grad = ctx.createLinearGradient(0, padding.top, 0, height - padding.bottom);
        grad.addColorStop(0, 'rgba(255, 147, 1, 0.38)');
        grad.addColorStop(1, 'rgba(255, 147, 1, 0.00)');

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

        // Line Stroke
        ctx.beginPath();
        ctx.moveTo(getX(0), getY(prices[0]));
        for (let i = 1; i < prices.length; i++) {
            ctx.lineTo(getX(i), getY(prices[i]));
        }
        ctx.strokeStyle = '#ff9301';
        ctx.lineWidth = 3;
        ctx.stroke();

        // Data Points & X-Labels
        ctx.textAlign = 'center';
        const step = daysCount === 30 ? 5 : 1;
        for (let i = 0; i < prices.length; i++) {
            const x = getX(i);
            const y = getY(prices[i]);

            if (i % step === 0 || i === prices.length - 1) {
                ctx.beginPath();
                ctx.arc(x, y, 4.5, 0, Math.PI * 2);
                ctx.fillStyle = '#ffffff';
                ctx.fill();
                ctx.strokeStyle = '#ff9301';
                ctx.lineWidth = 2.5;
                ctx.stroke();

                ctx.beginPath();
                ctx.arc(x, y, 2.2, 0, Math.PI * 2);
                ctx.fillStyle = '#ff9301';
                ctx.fill();

                ctx.fillStyle = '#64748b';
                const label = daysCount === 30 ? `D-${30 - i}` : (i === prices.length - 1 ? 'Today' : `D${i + 1}`);
                ctx.fillText(label, x, height - padding.bottom + 18);
            }
        }
    },

    exportCSV() {
        let csv = "Lot_ID,Commodity,Variety,Market,District,Min_Price,Max_Price,Modal_Price,Arrivals_Qtl,Quality_Grade,Trend\n";
        this.data.forEach(d => {
            csv += `"${d.lotId}","${d.nameEn}","${d.variety}","${d.mandi}","${d.district}",${d.min},${d.max},${d.modal},${d.arrivals},"${d.assayQuality.agmarkGrade}","${d.trend}"\n`;
        });
        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.setAttribute("download", `AGMARKNET_WB_Mandi_Rates_${new Date().toISOString().slice(0, 10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        showToast('AGMARKNET 2.0 Mandi rates exported successfully as CSV file!', 'success');
    }
};

/* ==========================================================================
   3. QUICK PRICE DISCOVERY MODULE (HERO SECTION)
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
            const cropPh = dict.select_crop_ph || 'Select Commodity...';
            let optionsHtml = `<option value="">${cropPh}</option>`;
            MandiRatesModule.data.forEach(item => {
                const name = lang === 'bn' ? item.nameBn : lang === 'hi' ? item.nameHi : item.nameEn;
                optionsHtml += `<option value="${item.id}">${item.icon} ${name} (${item.variety})</option>`;
            });
            cropSelect.innerHTML = optionsHtml;
            if (curVal) cropSelect.value = curVal;
        }

        if (distSelect) {
            const curDist = distSelect.value || 'all';
            const allDistText = dict.all_districts || 'All Districts';
            const districts = [
                { val: "all", label: allDistText },
                { val: "Hooghly", label: "Hooghly (হুগলি)" },
                { val: "Burdwan", label: "Burdwan (পূর্ব ও পশ্চিম বর্ধমান)" },
                { val: "Nadia", label: "Nadia (নদিয়া)" },
                { val: "Kolkata", label: "Kolkata (কলকাতা)" },
                { val: "Murshidabad", label: "Murshidabad (মুর্শিদাবাদ)" },
                { val: "Bankura", label: "Bankura (বাঁকুড়া)" },
                { val: "Jalpaiguri", label: "Jalpaiguri (জলপাইগুড়ি)" },
                { val: "Malda", label: "Malda (মালদা)" }
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

        document.getElementById('qrCropName').textContent = `${item.icon} ${cropName} (${item.variety})`;
        document.getElementById('qrModalPrice').textContent = `₹${item.modal.toLocaleString('en-IN')}/Qtl`;
        document.getElementById('qrRange').textContent = `₹${item.min} - ₹${item.max} | Arrivals: ${item.arrivals} Qtl`;
        document.getElementById('qrTrend').textContent = `${item.trendType === 'up' ? '▲ +' : item.trendType === 'down' ? '▼ -' : '━ '}₹${item.trend.replace('-', '')}`;

        resCard.classList.add('active');
    }
};

/* ==========================================================================
   4. ROLE-BASED PERSONA HUBS MODULE (FARMER, TRADER, AGENT)
   ========================================================================== */
const PersonaHubModule = {
    activePersona: 'farmer',

    init() {
        document.querySelectorAll('.persona-tab-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                document.querySelectorAll('.persona-tab-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.persona-hub-pane').forEach(p => p.classList.remove('active'));

                e.currentTarget.classList.add('active');
                const persona = e.currentTarget.getAttribute('data-persona');
                this.activePersona = persona;

                const pane = document.getElementById(`pane-${persona}`);
                if (pane) pane.classList.add('active');
            });
        });

        // Advance Gate Entry Form Submission
        const gateForm = document.getElementById('advanceGateEntryForm');
        if (gateForm) {
            gateForm.addEventListener('submit', (e) => {
                e.preventDefault();
                this.generateGatePass();
            });
        }

        // DBT Payment Status Form Submission
        const dbtForm = document.getElementById('dbtStatusForm');
        if (dbtForm) {
            dbtForm.addEventListener('submit', (e) => {
                e.preventDefault();
                this.checkDbtStatus();
            });
        }

        // Live E-Auction Simulator Timer
        this.initAuctionSimulator();

        // Mobile Slider Controls for Persona Panes
        this.initPersonaSliders();
    },

    initPersonaSliders() {
        document.querySelectorAll('.persona-hub-pane').forEach(pane => {
            const grid = pane.querySelector('.persona-grid');
            const footer = pane.querySelector('.persona-slider-footer');
            if (!grid || !footer) return;

            const cards = Array.from(grid.querySelectorAll('.persona-feature-card'));
            const prevBtn = footer.querySelector('.persona-prev-btn');
            const nextBtn = footer.querySelector('.persona-next-btn');
            const dots = footer.querySelectorAll('.persona-slider-dot');

            let currentIdx = 0;

            const updateControls = () => {
                if (prevBtn) {
                    prevBtn.disabled = currentIdx <= 0;
                    prevBtn.style.opacity = currentIdx <= 0 ? '0.35' : '1';
                    prevBtn.style.cursor = currentIdx <= 0 ? 'not-allowed' : 'pointer';
                }
                if (nextBtn) {
                    nextBtn.disabled = currentIdx >= cards.length - 1;
                    nextBtn.style.opacity = currentIdx >= cards.length - 1 ? '0.35' : '1';
                    nextBtn.style.cursor = currentIdx >= cards.length - 1 ? 'not-allowed' : 'pointer';
                }
                dots.forEach((dot, idx) => {
                    dot.classList.toggle('active', idx === currentIdx);
                });
            };

            const scrollToCard = (index) => {
                if (index < 0 || index >= cards.length) return;
                currentIdx = index;
                const card = cards[index];
                if (card) {
                    grid.scrollTo({
                        left: card.offsetLeft - grid.offsetLeft,
                        behavior: 'smooth'
                    });
                }
                updateControls();
            };

            if (prevBtn) {
                prevBtn.addEventListener('click', () => scrollToCard(currentIdx - 1));
            }
            if (nextBtn) {
                nextBtn.addEventListener('click', () => scrollToCard(currentIdx + 1));
            }

            // Sync dots on scroll
            grid.addEventListener('scroll', () => {
                const scrollLeft = grid.scrollLeft;
                const cardWidth = grid.offsetWidth;
                if (cardWidth > 0) {
                    const newIdx = Math.round(scrollLeft / cardWidth);
                    if (newIdx !== currentIdx && newIdx >= 0 && newIdx < cards.length) {
                        currentIdx = newIdx;
                        updateControls();
                    }
                }
            }, { passive: true });

            updateControls();
        });
    },

    generateGatePass() {
        const name = document.getElementById('gateFarmerName')?.value || 'Subhash Mondal';
        const mobile = document.getElementById('gateFarmerMobile')?.value || '9830112233';
        const crop = document.getElementById('gateCropSelect')?.value || 'Potato (Jyoti)';
        const qty = document.getElementById('gateQtyInput')?.value || '50';
        const vehicle = document.getElementById('gateVehicleNum')?.value || 'WB-15-B-4412';

        const lotId = 'LOT-WB-' + Math.floor(1000 + Math.random() * 9000);
        const slipEl = document.getElementById('gatePassResult');
        if (slipEl) {
            slipEl.innerHTML = `
                <div style="background:var(--primary-soft); border:2px dashed var(--primary); padding:1.25rem; border-radius:var(--radius-lg); margin-top:1.5rem;">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <span class="badge-apmc-licensed">✅ Advance Gate Slip Generated</span>
                        <strong style="color:var(--primary); font-family:'Outfit'; font-size:1.1rem;">${lotId}</strong>
                    </div>
                    <div style="margin-top:0.75rem; font-size:0.9rem; line-height:1.6;">
                        <div><strong>Farmer:</strong> ${name} (${mobile})</div>
                        <div><strong>Commodity:</strong> ${crop} - <strong>Qty:</strong> ${qty} Quintals</div>
                        <div><strong>Vehicle No:</strong> ${vehicle}</div>
                        <div><strong>Allocated APMC Yard:</strong> Hooghly Central Mandi (Gate-2)</div>
                    </div>
                    <div class="weighbridge-stepper">
                        <div class="step-node completed">
                            <div class="step-node-icon">✓</div>
                            <span class="step-node-label">Gate In</span>
                        </div>
                        <div class="step-node active">
                            <div class="step-node-icon">⚖️</div>
                            <span class="step-node-label">Weighbridge</span>
                        </div>
                        <div class="step-node">
                            <div class="step-node-icon">🧪</div>
                            <span class="step-node-label">Assay Lab</span>
                        </div>
                        <div class="step-node">
                            <div class="step-node-icon">🏷️</div>
                            <span class="step-node-label">E-Auction</span>
                        </div>
                        <div class="step-node">
                            <div class="step-node-icon">💳</div>
                            <span class="step-node-label">DBT Pay</span>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary" style="width:100%; margin-top:1rem;" onclick="window.print()">
                        🖨️ Print Advance Gate Pass
                    </button>
                </div>
            `;
            showToast(`Gate Entry Slip ${lotId} Created Successfully!`, 'success');
        }
    },

    checkDbtStatus() {
        const utr = document.getElementById('dbtUtrInput')?.value || 'UTR-2026-WB-8819';
        const resEl = document.getElementById('dbtStatusResult');
        if (resEl) {
            resEl.innerHTML = `
                <div style="background:var(--bg-subtle); border:1px solid var(--border-color); padding:1.25rem; border-radius:var(--radius-lg); margin-top:1.25rem;">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <span class="badge-verified-kyc">⚡ Direct DBT Settlement</span>
                        <span style="font-weight:800; color:var(--success);">Settlement Completed</span>
                    </div>
                    <div style="margin:0.75rem 0; font-size:0.88rem; line-height:1.6;">
                        <div><strong>Reference / UTR:</strong> ${utr}</div>
                        <div><strong>Amount Credited:</strong> <span style="color:var(--primary); font-size:1.1rem; font-weight:800;">₹77,000.00</span></div>
                        <div><strong>Beneficiary:</strong> Subhash Mondal (A/C: ******4819)</div>
                        <div><strong>Clearing Bank:</strong> State Cooperative Bank (IFSC: WBSC000104)</div>
                        <div><strong>Timestamp:</strong> ${new Date().toLocaleDateString('en-IN', { day: 'numeric', month: 'short', year: 'numeric' })} at 11:24 AM</div>
                    </div>
                </div>
            `;
            showToast('DBT Escrow Payment Verified & Credited!', 'success');
        }
    },

    initAuctionSimulator() {
        let timeLeft = 145;
        let currentBid = 1540;
        const timerEl = document.getElementById('auctionTimerDisplay');
        const bidEl = document.getElementById('auctionCurrentBid');

        setInterval(() => {
            if (timeLeft > 0) {
                timeLeft--;
                const mins = Math.floor(timeLeft / 60);
                const secs = timeLeft % 60;
                if (timerEl) timerEl.textContent = `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
            }
        }, 1000);

        window.placeAuctionBid = (increment) => {
            currentBid += increment;
            if (bidEl) bidEl.textContent = `₹${currentBid.toLocaleString('en-IN')}`;
            showToast(`Bid Placed: ₹${currentBid}/Qtl! You are highest bidder.`, 'success');
        };
    }
};

/* ==========================================================================
   5. E-BIJAK DIGITAL INVOICING & APMC TAX LEDGER MODULE
   ========================================================================== */
const EBijakModule = {
    init() {
        const calcBtn = document.getElementById('ebijakCalculateBtn');
        if (calcBtn) {
            calcBtn.addEventListener('click', () => this.generateInvoice());
        }

        const cropSelect = document.getElementById('ebijakCropSelect');
        if (cropSelect) {
            cropSelect.addEventListener('change', (e) => {
                const item = MandiRatesModule.data.find(d => d.id === parseInt(e.target.value));
                if (item) {
                    const rateInput = document.getElementById('ebijakRateInput');
                    if (rateInput) rateInput.value = item.modal;
                }
            });
        }
    },

    updateLocalizedLabels() {
        const cropSelect = document.getElementById('ebijakCropSelect');
        if (cropSelect && MandiRatesModule.data) {
            const lang = I18nEngine.currentLang;
            let html = '';
            MandiRatesModule.data.forEach(item => {
                const name = lang === 'bn' ? item.nameBn : lang === 'hi' ? item.nameHi : item.nameEn;
                html += `<option value="${item.id}">${item.icon} ${name} (${item.variety})</option>`;
            });
            cropSelect.innerHTML = html;
        }
    },

    generateInvoice() {
        const farmerName = document.getElementById('ebijakFarmerName')?.value || 'Subhash Mondal';
        const farmerKyc = document.getElementById('ebijakFarmerKyc')?.value || 'WB-KYC-994821';
        const traderName = document.getElementById('ebijakTraderName')?.value || 'Bengal Agro Wholesale Traders';
        const traderLic = document.getElementById('ebijakTraderLic')?.value || 'APMC-LIC-HGY-2026-441';
        const cropId = parseInt(document.getElementById('ebijakCropSelect')?.value) || 1;
        const qty = parseFloat(document.getElementById('ebijakQtyInput')?.value) || 100;
        const rate = parseFloat(document.getElementById('ebijakRateInput')?.value) || 1540;

        const cropItem = MandiRatesModule.data.find(d => d.id === cropId) || MandiRatesModule.data[0];

        // Itemized Statutory Fee Calculations
        const baseProduceValue = qty * rate;
        const apmcCess = baseProduceValue * 0.015; // 1.5% APMC Statutory Cess
        const agentCommission = baseProduceValue * 0.02; // 2.0% Commission Agent Fee
        const hamaliCharges = qty * 12.0; // ₹12 per Quintal handling & weighment
        const transportSurcharge = qty * 25.0; // ₹25 per Quintal logistics
        const totalStatutoryFees = apmcCess + agentCommission + hamaliCharges + transportSurcharge;
        const netInvoiceTotal = baseProduceValue + totalStatutoryFees;
        const netFarmerRealization = baseProduceValue - (hamaliCharges / 2);

        const voucherEl = document.getElementById('ebijakVoucherPreview');
        if (voucherEl) {
            const invoiceNum = 'EB-WB-' + Math.floor(100000 + Math.random() * 900000);
            const dateStr = new Date().toLocaleDateString('en-IN', { day: '2-digit', month: 'short', year: 'numeric' });

            voucherEl.innerHTML = `
                <div class="ebijak-voucher">
                    <div class="ebijak-stamp">APPROVED APMC VOUCHER</div>
                    <div class="ebijak-header-top">
                        <div>
                            <h3 style="font-size:1.3rem; font-weight:800; color:var(--primary); margin:0;">STATE AGRICULTURAL MARKETING BOARD</h3>
                            <div style="font-size:0.8rem; color:#64748b;">Directorate of Agricultural Marketing | Standard e-Bijak Format</div>
                        </div>
                        <div style="text-align:right;">
                            <strong style="color:var(--primary); font-size:1.1rem; font-family:'Outfit';">${invoiceNum}</strong>
                            <div style="font-size:0.8rem; color:#64748b;">Date: ${dateStr}</div>
                        </div>
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-bottom:1.5rem; font-size:0.85rem;">
                        <div style="background:rgba(255, 147, 1, 0.06); padding:0.85rem; border-radius:6px;">
                            <div style="font-weight:700; color:var(--primary-dark); margin-bottom:0.35rem;">👨‍🌾 SELLER / FARMER DETAILS</div>
                            <div><strong>Name:</strong> ${farmerName}</div>
                            <div><strong>KYC / Aadhaar Ref:</strong> ${farmerKyc}</div>
                            <div><strong>Market Yard:</strong> ${cropItem.mandi}</div>
                        </div>
                        <div style="background:rgba(217, 119, 6, 0.06); padding:0.85rem; border-radius:6px;">
                            <div style="font-weight:700; color:#b45309; margin-bottom:0.35rem;">💼 BUYER / TRADER DETAILS</div>
                            <div><strong>Trader Entity:</strong> ${traderName}</div>
                            <div><strong>APMC License No:</strong> ${traderLic}</div>
                            <div><strong>Payment Mode:</strong> Direct Escrow DBT</div>
                        </div>
                    </div>

                    <table style="width:100%; font-size:0.88rem; margin-bottom:1.25rem; border-collapse:collapse;">
                        <thead>
                            <tr style="background:#f1f5f9; border-bottom:2px solid #cbd5e1; text-align:left;">
                                <th style="padding:0.6rem;">Item Description</th>
                                <th style="padding:0.6rem;">Lot Ref</th>
                                <th style="padding:0.6rem;">Assay Grade</th>
                                <th style="padding:0.6rem; text-align:right;">Qty (Qtl)</th>
                                <th style="padding:0.6rem; text-align:right;">Rate (₹/Qtl)</th>
                                <th style="padding:0.6rem; text-align:right;">Base Amount (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom:1px solid #e2e8f0;">
                                <td style="padding:0.6rem;"><strong>${cropItem.icon} ${cropItem.nameEn}</strong> (${cropItem.variety})</td>
                                <td style="padding:0.6rem;">${cropItem.lotId}</td>
                                <td style="padding:0.6rem;"><span class="badge-verified-kyc">${cropItem.assayQuality.agmarkGrade}</span></td>
                                <td style="padding:0.6rem; text-align:right;">${qty.toLocaleString('en-IN')}</td>
                                <td style="padding:0.6rem; text-align:right;">₹${rate.toLocaleString('en-IN')}</td>
                                <td style="padding:0.6rem; text-align:right; font-weight:700;">₹${baseProduceValue.toLocaleString('en-IN', { minimumFractionDigits: 2 })}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div style="max-width:380px; margin-left:auto; margin-bottom:1.5rem;">
                        <div class="fee-breakdown-row">
                            <span>Produce Base Cost:</span>
                            <strong>₹${baseProduceValue.toLocaleString('en-IN', { minimumFractionDigits: 2 })}</strong>
                        </div>
                        <div class="fee-breakdown-row">
                            <span>APMC Market Cess (1.5%):</span>
                            <span>₹${apmcCess.toLocaleString('en-IN', { minimumFractionDigits: 2 })}</span>
                        </div>
                        <div class="fee-breakdown-row">
                            <span>Commission Agent Fee (2.0%):</span>
                            <span>₹${agentCommission.toLocaleString('en-IN', { minimumFractionDigits: 2 })}</span>
                        </div>
                        <div class="fee-breakdown-row">
                            <span>Weighbridge & Hamali (₹12/Qtl):</span>
                            <span>₹${hamaliCharges.toLocaleString('en-IN', { minimumFractionDigits: 2 })}</span>
                        </div>
                        <div class="fee-breakdown-row">
                            <span>Agricultural Logistics Surcharge:</span>
                            <span>₹${transportSurcharge.toLocaleString('en-IN', { minimumFractionDigits: 2 })}</span>
                        </div>
                        <div class="fee-breakdown-row total-row">
                            <span>Total Gross Payable (Buyer):</span>
                            <span>₹${netInvoiceTotal.toLocaleString('en-IN', { minimumFractionDigits: 2 })}</span>
                        </div>
                        <div style="font-size:0.85rem; color:#10b981; font-weight:700; margin-top:0.4rem; text-align:right;">
                            Net Farmer Direct Realization: ₹${netFarmerRealization.toLocaleString('en-IN', { minimumFractionDigits: 2 })}
                        </div>
                    </div>

                    <div style="display:flex; justify-content:space-between; align-items:flex-end; border-top:1px dashed #cbd5e1; padding-top:1rem; font-size:0.8rem; color:#64748b;">
                        <div>
                            <div>Digital Hash: SHA256-${Math.random().toString(36).substring(2, 10).toUpperCase()}</div>
                            <div>Generated via State e-Bijak Invoicing Portal</div>
                        </div>
                        <div style="text-align:right;">
                            <div style="font-family:'Courier New', monospace; font-size:1.1rem; letter-spacing:2px;">||| | |||| | ||||| || |</div>
                            <div>Authorized APMC Secretary Signature</div>
                        </div>
                    </div>
                </div>

                <div style="display:flex; gap:1rem; margin-top:1.5rem;">
                    <button class="btn btn-primary" onclick="window.print()" style="flex:1;">
                        🖨️ Print e-Bijak Tax Invoice
                    </button>
                    <button class="btn btn-outline" onclick="showToast('e-Bijak Invoice sent via WhatsApp & SMS to Farmer & Trader!', 'success')" style="flex:1;">
                        📲 Send WhatsApp Copy
                    </button>
                </div>
            `;
            showToast('e-Bijak Tax Invoice Generated Successfully!', 'success');
        }
    }
};

/* ==========================================================================
   6. INTEGRATED AGRI-FREIGHT TRANSPORT CALCULATOR
   ========================================================================== */
const FreightCalculatorModule = {
    selectedVehicle: 'ace',
    vehicleTariffs: {
        'ace': { name: 'Tata Ace / Small Pickup', capacity: 15, baseKmRate: 24, baseFixed: 600, speedKmH: 40 },
        'pickup': { name: 'Bolero Maxi Truck (2.5 MT)', capacity: 25, baseKmRate: 32, baseFixed: 850, speedKmH: 45 },
        'eicher': { name: 'Eicher 14ft Truck (4.5 MT)', capacity: 45, baseKmRate: 48, baseFixed: 1400, speedKmH: 45 },
        'truck6': { name: '6-Wheeler Heavy Truck (9 MT)', capacity: 90, baseKmRate: 72, baseFixed: 2200, speedKmH: 50 },
        'truck10': { name: '10-Wheeler Multi-Axle (16 MT)', capacity: 160, baseKmRate: 110, baseFixed: 3500, speedKmH: 45 },
        'reefer': { name: 'Reefer Cold Chain Van (6 MT)', capacity: 60, baseKmRate: 85, baseFixed: 2800, speedKmH: 45 }
    },

    init() {
        document.querySelectorAll('.vehicle-card-radio').forEach(card => {
            card.addEventListener('click', (e) => {
                document.querySelectorAll('.vehicle-card-radio').forEach(c => c.classList.remove('active'));
                e.currentTarget.classList.add('active');
                this.selectedVehicle = e.currentTarget.getAttribute('data-vehicle');
                this.calculate();
            });
        });

        const distInput = document.getElementById('freightDistanceInput');
        const weightInput = document.getElementById('freightWeightInput');
        const calcBtn = document.getElementById('freightCalculateBtn');

        if (distInput) distInput.addEventListener('input', () => this.calculate());
        if (weightInput) weightInput.addEventListener('input', () => this.calculate());
        if (calcBtn) calcBtn.addEventListener('click', () => this.calculate());

        this.calculate();
    },

    calculate() {
        const distance = parseFloat(document.getElementById('freightDistanceInput')?.value) || 85;
        const weightQtl = parseFloat(document.getElementById('freightWeightInput')?.value) || 40;

        const vInfo = this.vehicleTariffs[this.selectedVehicle] || this.vehicleTariffs['ace'];

        const distanceTariff = distance * vInfo.baseKmRate;
        const tollEstimates = Math.floor(distance / 50) * 140;
        const totalFreight = vInfo.baseFixed + distanceTariff + tollEstimates;
        const perQuintalRate = totalFreight / (weightQtl || 1);
        const transitHours = (distance / vInfo.speedKmH).toFixed(1);

        const totalEl = document.getElementById('freightTotalCost');
        const perQtlEl = document.getElementById('freightPerQtl');
        const timeEl = document.getElementById('freightTransitTime');
        const tollEl = document.getElementById('freightToll');
        const summaryVehicleEl = document.getElementById('freightVehicleName');

        if (totalEl) totalEl.textContent = `₹${Math.round(totalFreight).toLocaleString('en-IN')}`;
        if (perQtlEl) perQtlEl.textContent = `₹${perQuintalRate.toFixed(1)} / Qtl`;
        if (timeEl) timeEl.textContent = `${transitHours} Hours`;
        if (tollEl) tollEl.textContent = `₹${tollEstimates}`;
        if (summaryVehicleEl) summaryVehicleEl.textContent = vInfo.name;
    }
};


/* ==========================================================================
   8. COLD STORAGE & WDRA E-NWR LOCATOR MODULE
   ========================================================================== */
const ColdStorageModule = {
    units: [
        { id: 1, name: "Hooghly Agro Cold Storage Unit-1", district: "Hooghly", capacity: 12000, available: 3200, temp: "2°C - 4°C (Potato / Veg)", phone: "+91 98301 44551", wdraAccredited: true, eNwrEligible: true, status: "available" },
        { id: 2, name: "Burdwan Central Krishi Bhandar", district: "Burdwan", capacity: 15000, available: 1400, temp: "1°C - 3°C (Multi-Chamber)", phone: "+91 94340 77890", wdraAccredited: true, eNwrEligible: true, status: "limited" },
        { id: 3, name: "Nadia Kisan Cold Chain & Packhouse", district: "Nadia", capacity: 8500, available: 2800, temp: "0°C - 5°C (Horticulture)", phone: "+91 97321 66542", wdraAccredited: true, eNwrEligible: true, status: "available" },
        { id: 4, name: "Malda Mango & Fruit Preservation Hub", district: "Malda", capacity: 6000, available: 850, temp: "4°C - 8°C (Ripening & Storage)", phone: "+91 94741 22300", wdraAccredited: false, eNwrEligible: false, status: "limited" },
        { id: 5, name: "Bankura Multi-Commodity Cold Unit", district: "Bankura", capacity: 10000, available: 4100, temp: "2°C - 6°C (Seeds & Veg)", phone: "+91 96472 88910", wdraAccredited: true, eNwrEligible: true, status: "available" },
        { id: 6, name: "Siliguri Agri Logistic Cold Center", district: "Darjeeling / Siliguri", capacity: 14000, available: 5200, temp: "-2°C - 4°C (Export Hub)", phone: "+91 98002 11456", wdraAccredited: true, eNwrEligible: true, status: "available" }
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
            const eNwrBadge = unit.eNwrEligible
                ? `<span class="badge-verified-kyc" style="margin-left:0.5rem;">📜 e-NWR Loan Eligible</span>`
                : '';

            html += `
                <div class="facility-card">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.75rem;">
                        <span class="facility-badge-status ${badgeClass}">${badgeText}</span>
                        ${eNwrBadge}
                    </div>
                    <h3 class="facility-title">${unit.name}</h3>
                    <div class="facility-location">📍 ${unit.district} (WDRA Accredited: ${unit.wdraAccredited ? 'Yes' : 'No'})</div>
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
   9. E-MARKETPLACE & DIRECT FARM PRODUCE MODULE (DOC SEC 6, 7, 11, 16)
   ========================================================================== */
const MarketplaceModule = {
    produce: [
        { id: 1, category: "veg", crop: "Organic Jyoti Potato", icon: "🥔", farmer: "Subhash Mondal (FPO Member)", location: "Arambagh, Hooghly", qty: "450 Bags (50kg)", price: "₹780 / Bag", grade: "AGMARK Grade-I", lotId: "LOT-HGY-8841", rating: "4.9 ★ (KYC Verified)" },
        { id: 2, category: "grain", crop: "Premium Gobindobhog Rice", icon: "🌾", farmer: "Burdwan Progressive Farmers SHG", location: "Memari, Burdwan", qty: "120 Quintals", price: "₹6,400 / Qtl", grade: "AGMARK Special", lotId: "LOT-BWN-5520", rating: "5.0 ★ (APMC Licensed)" },
        { id: 3, category: "veg", crop: "Export Quality Fresh Ginger", icon: "🫚", farmer: "Tapan Roy (Hill Agro)", location: "Alipurduar, North Bengal", qty: "85 Quintals", price: "₹7,900 / Qtl", grade: "Pesticide Free", lotId: "LOT-JPG-7801", rating: "4.8 ★ (KYC Verified)" },
        { id: 4, category: "veg", crop: "Fresh Red Hybrid Tomato", icon: "🍅", farmer: "Pranab Ghosh", location: "Krishnanagar, Nadia", qty: "200 Crates", price: "₹420 / Crate", grade: "FSSAI Grade-A", lotId: "LOT-NDA-9014", rating: "4.9 ★ (Verified)" },
        { id: 5, category: "oilseed", crop: "Golden Mustard Seeds", icon: "🌻", farmer: "Bankura Krishi Bikash", location: "Kotulpur, Bankura", qty: "90 Quintals", price: "₹5,600 / Qtl", grade: "AGMARK Grade-I", lotId: "LOT-BKR-6180", rating: "4.9 ★ (KYC Verified)" },
        { id: 6, category: "gi", crop: "Malda Mango Pulp (Fazli)", icon: "🥭", farmer: "Malda Mango Producer Co.", location: "Ratua, Malda", qty: "300 Barrels", price: "₹4,800 / Barrel", grade: "GI Certified", lotId: "LOT-MLD-9902", rating: "5.0 ★ (APMC Licensed)" },
        { id: 7, category: "gi", crop: "Purba Medinipur Dried Chilli", icon: "🌶️", farmer: "Kanthi Spice Farmers FPO", location: "Purba Medinipur", qty: "60 Quintals", price: "₹8,400 / Qtl", grade: "Grade-A High Pungency", lotId: "LOT-MED-4412", rating: "4.9 ★ (FPO Verified)" },
        { id: 8, category: "fpo", crop: "Sundarbans Organic Forest Honey", icon: "🍯", farmer: "Sundarbans Bio-Reserve SHG (FPO)", location: "Canning, South 24 Pgs", qty: "500 Jars (1kg)", price: "₹450 / Jar", grade: "100% Wild Organic", lotId: "LOT-SND-1109", rating: "5.0 ★ (GI Certified)" }
    ],

    activeCat: 'all',

    init() {
        document.querySelectorAll('[data-mp-cat]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                document.querySelectorAll('[data-mp-cat]').forEach(b => b.classList.remove('active'));
                e.currentTarget.classList.add('active');
                this.activeCat = e.currentTarget.dataset.mpCat;
                this.render();
            });
        });
        this.render();
    },

    render() {
        const grid = document.getElementById('marketplaceGrid');
        if (!grid) return;

        let filtered = this.produce;
        if (this.activeCat !== 'all') {
            filtered = this.produce.filter(p => p.category === this.activeCat || (this.activeCat === 'fpo' && p.farmer.includes('FPO')));
        }

        let html = '';
        filtered.forEach(p => {
            html += `
                <div class="produce-card">
                    <div class="produce-card-header">
                        <span class="produce-grade-tag">${p.grade}</span>
                        <span class="badge-verified-kyc">${p.rating}</span>
                    </div>
                    <h3 class="produce-title">${p.crop}</h3>
                    <div class="produce-farmer">${p.farmer} <span style="font-size:0.75rem; color:var(--text-muted);">(${p.lotId})</span></div>
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
                    <div class="produce-location">${p.location}</div>
                    <div class="produce-actions-row">
                        <button class="btn btn-sm btn-primary" style="flex:1" onclick="ModalManager.openProduceInquiry('${p.crop}', '${p.farmer}')">
                            Send Bid
                        </button>
                        <button class="btn btn-sm btn-outline" style="padding:0.35rem 0.65rem; font-size:0.78rem;" onclick="MandiRatesModule.openAssayModal(1)" title="View Quality Assaying Certificate">
                            Assay Cert
                        </button>
                    </div>
                </div>
            `;
        });

        grid.innerHTML = html;
    }
};

/* ==========================================================================
   9.1 NET FARMER REALISATION & CORRIDOR ADVISORY ENGINE (DOC SEC 8 & 9)
   ========================================================================== */
const NetRealisationModule = {
    init() {
        const cropSelect = document.getElementById('nrCropSelect');
        const qtyInput = document.getElementById('nrQuantity');
        const localInput = document.getElementById('nrLocalPrice');
        const termInput = document.getElementById('nrTermPrice');
        const transInput = document.getElementById('nrTransport');
        const handleInput = document.getElementById('nrHandling');
        const commInput = document.getElementById('nrCommission');

        if (!cropSelect) return;

        cropSelect.addEventListener('change', () => {
            const opt = cropSelect.selectedOptions[0];
            if (opt) {
                if (localInput && opt.dataset.priceLocal) localInput.value = opt.dataset.priceLocal;
                if (termInput && opt.dataset.priceTerm) termInput.value = opt.dataset.priceTerm;
            }
            this.calculate();
        });

        [qtyInput, localInput, termInput, transInput, handleInput, commInput].forEach(inp => {
            if (inp) inp.addEventListener('input', () => this.calculate());
        });

        this.calculate();
    },

    calculate() {
        const qty = parseFloat(document.getElementById('nrQuantity')?.value) || 100;
        const localGross = parseFloat(document.getElementById('nrLocalPrice')?.value) || 1540;
        const termGross = parseFloat(document.getElementById('nrTermPrice')?.value) || 1780;
        const transport = parseFloat(document.getElementById('nrTransport')?.value) || 85;
        const handling = parseFloat(document.getElementById('nrHandling')?.value) || 25;
        const commission = parseFloat(document.getElementById('nrCommission')?.value) || 30;

        const localCess = 25;
        const localNet = Math.max(0, localGross - localCess);
        const termDeductions = transport + handling + commission;
        const termNet = Math.max(0, termGross - termDeductions);

        const localNetEl = document.getElementById('nrLocalNet');
        const termNetEl = document.getElementById('nrTermNet');
        const verdictBox = document.getElementById('nrVerdictBox');
        const gainText = document.getElementById('nrGainText');

        if (localNetEl) localNetEl.innerHTML = `₹${localNet.toLocaleString('en-IN')} <small>/Qtl</small>`;
        if (termNetEl) termNetEl.innerHTML = `₹${termNet.toLocaleString('en-IN')} <small>/Qtl</small>`;

        const diffPerQtl = termNet - localNet;
        const totalGain = Math.round(diffPerQtl * qty);
        const pctGain = ((diffPerQtl / localNet) * 100).toFixed(1);

        if (gainText && verdictBox) {
            const tagEl = verdictBox.querySelector('.verdict-tag');
            if (diffPerQtl > 0) {
                gainText.innerHTML = `Farmer gains additional <strong style="color:var(--success);">+₹${totalGain.toLocaleString('en-IN')} (+${pctGain}%)</strong> Net Realisation on ${qty} Qtl lot!`;
                if (tagEl) {
                    tagEl.className = 'verdict-tag recommended';
                    tagEl.removeAttribute('style');
                    tagEl.innerHTML = '✅ Recommended: Dispatch to Terminal Market';
                }
            } else {
                gainText.innerHTML = `Local Mandi offers <strong style="color:var(--primary);">+₹${Math.abs(totalGain).toLocaleString('en-IN')}</strong> higher net return due to transit deductions.`;
                if (tagEl) {
                    tagEl.className = 'verdict-tag warning';
                    tagEl.removeAttribute('style');
                    tagEl.innerHTML = '⚠️ Recommended: Sell in Local Mandi Yard';
                }
            }
        }
    }
};

/* ==========================================================================
   10. NOTICES & SCHEMES MODULE
   ========================================================================== */
const SchemesModule = { data: [] };
const NoticesModule = {
    data: {
        tenders: [
            { id: "T1", day: "28", month: "Aug", title: "Expression of Interest (EOI) for installation of Solar Powered Micro Cold Rooms in Hooghly and Burdwan APMC premises.", ref: "Ref: WBSAMB/NIT-14/2026", fileSize: "1.2 MB" },
            { id: "T2", day: "25", month: "Aug", title: "Revised Daily Price Bulletin & Arrival Report for Agricultural and Horticultural Commodities for Kharif Season.", ref: "Ref: AMD/PB/AUG-2026/08", fileSize: "850 KB" },
            { id: "T3", day: "20", month: "Aug", title: "Notification regarding Minimum Support Price (MSP) and procurement centers for Paddy and Jute for Kharif Marketing Season.", ref: "Ref: GO-WB-AGRI-552/2026", fileSize: "2.1 MB" }
        ]
    },
    init() {}
};

/* ==========================================================================
   11. MODAL & DIALOG MANAGER
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
   12. ACCESSIBILITY CONTROLLER (Continuous Font Scaling)
   ========================================================================== */
const AccessibilityManager = {
    currentScale: 1.0,
    minScale: 0.75,
    maxScale: 1.40,
    step: 0.05,

    init() {
        const saved = localStorage.getItem('font_scale');
        let initialScale = 1.0;
        if (saved) {
            const parsed = parseFloat(saved);
            if (!isNaN(parsed)) initialScale = parsed;
        }
        this.setScale(initialScale);

        document.querySelectorAll('.font-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const action = e.currentTarget.getAttribute('data-size');
                if (action === 'std') this.setScale(1.0);
                else if (action === 'inc') this.setScale(this.currentScale + this.step);
                else if (action === 'dec') this.setScale(this.currentScale - this.step);
            });
        });
    },

    setScale(scaleVal) {
        const numericVal = typeof scaleVal === 'number' ? scaleVal : parseFloat(scaleVal);
        const clamped = Math.min(this.maxScale, Math.max(this.minScale, isNaN(numericVal) ? 1.0 : numericVal));
        this.currentScale = parseFloat(clamped.toFixed(2));
        document.documentElement.style.setProperty('--font-scale', this.currentScale);
        localStorage.setItem('font_scale', this.currentScale.toString());
    }
};

/* ==========================================================================
   13. THEME MANAGER (Dark / Light Theme)
   ========================================================================== */
const ThemeManager = {
    init() {
        const savedTheme = localStorage.getItem('theme_mode') || 'light';
        this.setTheme(savedTheme);

        const toggleBtn = document.getElementById('themeToggleBtn');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                const current = document.documentElement.getAttribute('data-theme') || 'light';
                this.setTheme(current === 'light' ? 'dark' : 'light');
            });
        }
    },

    setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme_mode', theme);
        const iconSpan = document.getElementById('themeIcon');
        const textSpan = document.getElementById('themeText');
        if (iconSpan) iconSpan.textContent = theme === 'light' ? '🌙' : '☀️';
        if (textSpan) textSpan.textContent = theme === 'light' ? 'Dark' : 'Light';
    }
};

/* ==========================================================================
   14. NUMBER COUNTER & SLIDER MODULES
   ========================================================================== */
const NumberCounterModule = {
    init() {
        const counters = document.querySelectorAll('[data-counter-target]');
        if (!counters.length) return;

        counters.forEach(el => {
            const target = parseFloat(el.getAttribute('data-counter-target')) || 0;
            const prefix = el.getAttribute('data-counter-prefix') || '';
            const suffix = el.getAttribute('data-counter-suffix') || '';
            const decimals = parseInt(el.getAttribute('data-counter-decimals'), 10) || 0;
            const finalVal = decimals > 0 ? target.toFixed(decimals) : target.toLocaleString('en-IN');
            el.textContent = `${prefix}${finalVal}${suffix}`;
        });
    }
};

const ServicesSliderModule = {
    currentIndex: 0,
    init() {
        const prevBtn = document.getElementById('servicesPrevBtn');
        const nextBtn = document.getElementById('servicesNextBtn');
        const track = document.getElementById('servicesSliderTrack');
        if (!track) return;

        const update = () => {
            const items = document.querySelectorAll('.service-slide-item');
            if (items.length) {
                const width = items[0].getBoundingClientRect().width + 24;
                track.style.transform = `translateX(-${this.currentIndex * width}px)`;
            }
        };

        const getMax = () => {
            const items = document.querySelectorAll('.service-slide-item');
            const visible = window.innerWidth <= 680 ? 1 : (window.innerWidth <= 1024 ? 2 : 3);
            return Math.max(0, items.length - visible);
        };

        if (prevBtn) prevBtn.addEventListener('click', () => {
            if (this.currentIndex > 0) this.currentIndex--;
            else this.currentIndex = getMax();
            update();
        });

        if (nextBtn) nextBtn.addEventListener('click', () => {
            const max = getMax();
            if (this.currentIndex < max) this.currentIndex++;
            else this.currentIndex = 0;
            update();
        });

        window.addEventListener('resize', () => {
            const max = getMax();
            if (this.currentIndex > max) this.currentIndex = max;
            update();
        });
    }
};

/* ==========================================================================
   GI COMMODITY SHOWCASE SLIDER MODULE (ONE-BY-ONE MOBILE SLIDER)
   ========================================================================== */
const GIShowcaseSliderModule = {
    currentIndex: 0,
    track: null,
    cards: [],
    dotsContainer: null,
    counter: null,

    init() {
        this.track = document.getElementById('giShowcaseGrid') || document.querySelector('.gi-showcase-grid');
        if (!this.track) return;

        this.cards = Array.from(this.track.querySelectorAll('.gi-card'));
        if (!this.cards.length) return;

        this.dotsContainer = document.getElementById('giSliderDots');
        this.counter = document.getElementById('giSliderCounter');

        this.renderDots();
        this.bindEvents();
        this.update();
    },

    renderDots() {
        if (!this.dotsContainer) return;
        this.dotsContainer.innerHTML = '';
        this.cards.forEach((_, idx) => {
            const dot = document.createElement('button');
            dot.type = 'button';
            dot.className = `slider-dot ${idx === this.currentIndex ? 'active' : ''}`;
            dot.setAttribute('aria-label', `Go to slide ${idx + 1}`);
            dot.addEventListener('click', () => this.goTo(idx));
            this.dotsContainer.appendChild(dot);
        });
    },

    bindEvents() {
        // Wire up all prev buttons (both in header and in footer)
        const prevButtons = [
            document.getElementById('giPrevBtn'),
            document.getElementById('giFooterPrevBtn')
        ].filter(Boolean);
        prevButtons.forEach(btn => btn.addEventListener('click', () => this.prev()));

        // Wire up all next buttons (both in header and in footer)
        const nextButtons = [
            document.getElementById('giNextBtn'),
            document.getElementById('giFooterNextBtn')
        ].filter(Boolean);
        nextButtons.forEach(btn => btn.addEventListener('click', () => this.next()));

        // Touch swipe gestures
        let touchStartX = 0;
        let touchStartY = 0;
        let touchEndX = 0;
        let touchEndY = 0;

        this.track.addEventListener('touchstart', (e) => {
            if (window.innerWidth > 768) return;
            touchStartX = e.changedTouches[0].screenX;
            touchStartY = e.changedTouches[0].screenY;
        }, { passive: true });

        this.track.addEventListener('touchend', (e) => {
            if (window.innerWidth > 768) return;
            touchEndX = e.changedTouches[0].screenX;
            touchEndY = e.changedTouches[0].screenY;
            const diffX = touchStartX - touchEndX;
            const diffY = touchStartY - touchEndY;
            // Only trigger if horizontal swipe is dominant and passes threshold
            if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 35) {
                if (diffX > 0) this.next();
                else this.prev();
            }
        }, { passive: true });

        // Mouse drag swipe support for desktop responsive emulation
        let isMouseDown = false;
        let mouseStartX = 0;

        this.track.addEventListener('mousedown', (e) => {
            if (window.innerWidth > 768) return;
            isMouseDown = true;
            mouseStartX = e.clientX;
            this.track.style.cursor = 'grabbing';
        });

        window.addEventListener('mouseup', (e) => {
            if (!isMouseDown) return;
            isMouseDown = false;
            this.track.style.cursor = '';
            const diff = mouseStartX - e.clientX;
            if (Math.abs(diff) > 40) {
                if (diff > 0) this.next();
                else this.prev();
            }
        });

        window.addEventListener('resize', () => {
            this.update();
        });
    },

    next() {
        this.currentIndex = (this.currentIndex < this.cards.length - 1) ? this.currentIndex + 1 : 0;
        this.update();
    },

    prev() {
        this.currentIndex = (this.currentIndex > 0) ? this.currentIndex - 1 : this.cards.length - 1;
        this.update();
    },

    goTo(idx) {
        if (idx < 0) idx = 0;
        if (idx >= this.cards.length) idx = this.cards.length - 1;
        this.currentIndex = idx;
        this.update();
    },

    update() {
        if (window.innerWidth > 768) {
            if (this.track) this.track.style.transform = '';
            return;
        }

        if (this.track) {
            this.track.style.transform = `translateX(-${this.currentIndex * 100}%)`;
        }
        this.updateUI();
    },

    updateUI() {
        if (this.dotsContainer) {
            const dots = this.dotsContainer.querySelectorAll('.slider-dot');
            dots.forEach((dot, idx) => {
                dot.classList.toggle('active', idx === this.currentIndex);
            });
        }
        if (this.counter) {
            this.counter.textContent = `${this.currentIndex + 1} / ${this.cards.length}`;
        }
    }
};

/* ==========================================================================
   SERVICES DIRECTORY MODULE (19 DOCUMENT DOMAINS)
   ========================================================================== */
const ServicesModule = {
    data: [],
    activeCategory: 'all',
    searchQuery: '',
    currentIndex: 0,
    totalCards: 0,
    sliderInitialized: false,
    touchStartX: 0,
    touchEndX: 0,

    async init() {
        const container = document.getElementById('servicesMasterGrid');
        if (!container) return;

        if (DataLoader.services && DataLoader.services.length) {
            this.data = DataLoader.services;
        } else {
            try {
                const res = await fetch('./data/services.json');
                if (res.ok) {
                    this.data = await res.json();
                }
            } catch (err) {
                console.warn('Could not fetch services.json, checking DataLoader', err);
            }
        }

        this.setupFilterTabs();
        this.setupSearch();
        this.setupInquiryForm();
        this.render();
    },

    setupFilterTabs() {
        const tabs = document.querySelectorAll('.service-tab-btn');
        tabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                this.activeCategory = tab.dataset.category || 'all';
                this.render();
            });
        });
    },

    setupSearch() {
        const searchInput = document.getElementById('servicesSearchInput');
        const clearBtn = document.getElementById('servicesSearchClear');
        if (!searchInput) return;

        searchInput.addEventListener('input', (e) => {
            this.searchQuery = e.target.value.trim().toLowerCase();
            if (clearBtn) {
                clearBtn.style.display = this.searchQuery ? 'block' : 'none';
            }
            this.render();
        });

        if (clearBtn) {
            clearBtn.addEventListener('click', () => {
                searchInput.value = '';
                this.searchQuery = '';
                clearBtn.style.display = 'none';
                this.render();
                searchInput.focus();
            });
        }
    },

    setupInquiryForm() {
        const form = document.getElementById('serviceInquiryForm');
        if (!form) return;

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const serviceName = document.getElementById('inquiryServiceName')?.value || 'Agricultural Marketing Service';
            const applicantName = document.getElementById('inquiryApplicantName')?.value || 'Applicant';
            const refCode = 'WB-SERV-' + Math.floor(1000 + Math.random() * 9000);

            showToast(`Thank you ${applicantName}! Inquiry for "${serviceName}" submitted. Reference ID: ${refCode}`, 'success');
            ModalManager.close('serviceInquiryModal');
            form.reset();
        });
    },

    openInquiry(serviceNumber, serviceTitle) {
        const numInput = document.getElementById('inquiryServiceNumber');
        const nameInput = document.getElementById('inquiryServiceName');
        const targetLabel = document.getElementById('modalServiceTarget');

        if (numInput) numInput.value = serviceNumber;
        if (nameInput) nameInput.value = `#${serviceNumber} - ${serviceTitle}`;
        if (targetLabel) targetLabel.textContent = `Official State Department Assistance for Domain ${serviceNumber}`;

        ModalManager.open('serviceInquiryModal');
    },

    render() {
        const grid = document.getElementById('servicesMasterGrid');
        const countDisplay = document.getElementById('servicesCountDisplay');
        if (!grid) return;

        let filtered = this.data;

        // Category filter
        if (this.activeCategory !== 'all') {
            filtered = filtered.filter(s => s.category === this.activeCategory);
        }

        // Search query filter
        if (this.searchQuery) {
            const q = this.searchQuery;
            filtered = filtered.filter(s => {
                const title = (s.title || '').toLowerCase();
                const titleBn = (s.titleBn || '').toLowerCase();
                const titleHi = (s.titleHi || '').toLowerCase();
                const desc = (s.desc || '').toLowerCase();
                const subs = (s.subServices || []).join(' ').toLowerCase();
                const clusters = (s.regionalClusters || []).join(' ').toLowerCase();
                const commodities = (s.targetCommodities || []).join(' ').toLowerCase();
                return title.includes(q) || titleBn.includes(q) || titleHi.includes(q) || desc.includes(q) || subs.includes(q) || clusters.includes(q) || commodities.includes(q);
            });
        }

        if (countDisplay) {
            countDisplay.innerHTML = `Showing <strong>${filtered.length}</strong> of <strong>${this.data.length}</strong> Services & Infrastructure Pillars`;
        }

        if (!filtered.length) {
            grid.innerHTML = `
                <div class="services-empty-state" style="grid-column:1/-1; text-align:center; padding:4rem 1rem;">
                    <div style="font-size:3.5rem; margin-bottom:1rem;">🔍</div>
                    <h3 style="font-size:1.4rem; font-weight:700; color:var(--text-main); margin-bottom:0.5rem;">No matching services found</h3>
                    <p style="color:var(--text-muted); max-width:450px; margin:0 auto;">No services match "${this.searchQuery}". Try searching for terms like "Mandi", "Cold storage", "Rice", "Malda", or "FPO".</p>
                </div>
            `;
            this.totalCards = 0;
            this.currentIndex = 0;
            this.updateSlider();
            return;
        }

        const currentLang = (typeof I18nEngine !== 'undefined') ? I18nEngine.currentLang : 'en';

        let html = '';
        filtered.forEach(s => {
            let displayTitle = s.title;
            if (currentLang === 'bn' && s.titleBn) displayTitle = s.titleBn;
            if (currentLang === 'hi' && s.titleHi) displayTitle = s.titleHi;

            // Sub-services checklist
            let subListHtml = '';
            if (s.subServices && s.subServices.length) {
                subListHtml = `
                    <div class="service-subitems-wrapper">
                        <div class="service-subitems-header">
                            <span>Key Operational Capabilities (${s.subServices.length}):</span>
                        </div>
                        <ul class="service-subitems-list">
                            ${s.subServices.map(item => `<li><span class="chk">✓</span> <span>${item}</span></li>`).join('')}
                        </ul>
                    </div>
                `;
            }

            // Workflow trail
            let workflowHtml = '';
            if (s.workflow && s.workflow.length) {
                workflowHtml = `
                    <div class="service-extra-block">
                        <div class="extra-block-label">Operational Workflow:</div>
                        <div class="service-workflow-trail">
                            ${s.workflow.map((step, idx) => `
                                <span class="wf-step">${step}</span>
                                ${idx < s.workflow.length - 1 ? '<span class="wf-arrow">→</span>' : ''}
                            `).join('')}
                        </div>
                    </div>
                `;
            }

            // Formula box
            let formulaHtml = '';
            if (s.formula) {
                formulaHtml = `
                    <div class="service-extra-block">
                        <div class="extra-block-label">Advisory Calculation:</div>
                        <div class="service-formula-box">
                            <code>${s.formula}</code>
                        </div>
                    </div>
                `;
            }

            // Regional clusters
            let clustersHtml = '';
            if (s.regionalClusters && s.regionalClusters.length) {
                clustersHtml = `
                    <div class="service-extra-block">
                        <div class="extra-block-label">West Bengal Regional GI Hubs:</div>
                        <div class="service-tags-wrap">
                            ${s.regionalClusters.map(c => `<span class="service-cluster-tag">📍 ${c}</span>`).join('')}
                        </div>
                    </div>
                `;
            }

            // Processing flows
            let processingHtml = '';
            if (s.processingFlows && s.processingFlows.length) {
                processingHtml = `
                    <div class="service-extra-block">
                        <div class="extra-block-label">Value Addition Processing Lines:</div>
                        <div class="service-proc-lines">
                            ${s.processingFlows.map(p => `
                                <div class="proc-line-item">
                                    <strong>${p.crop}:</strong> ${p.steps.join(' → ')}
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `;
            }

            // Export flow
            let exportHtml = '';
            if (s.exportFlow && s.exportFlow.length) {
                exportHtml = `
                    <div class="service-extra-block">
                        <div class="extra-block-label">Export Corridor Pipeline:</div>
                        <div class="service-workflow-trail">
                            ${s.exportFlow.map((step, idx) => `
                                <span class="wf-step export-step">${step}</span>
                                ${idx < s.exportFlow.length - 1 ? '<span class="wf-arrow">→</span>' : ''}
                            `).join('')}
                        </div>
                    </div>
                `;
            }

            // Target commodities
            let commoditiesHtml = '';
            if (s.targetCommodities && s.targetCommodities.length) {
                commoditiesHtml = `
                    <div class="service-extra-block">
                        <div class="extra-block-label">Key Export Commodities:</div>
                        <div class="service-tags-wrap">
                            ${s.targetCommodities.map(tc => `<span class="service-tag-pill">${tc}</span>`).join('')}
                        </div>
                    </div>
                `;
            }

            // Potential buyers
            let buyersHtml = '';
            if (s.potentialBuyers && s.potentialBuyers.length) {
                buyersHtml = `
                    <div class="service-extra-block">
                        <div class="extra-block-label">Potential Institutional Buyers:</div>
                        <div class="service-tags-wrap">
                            ${s.potentialBuyers.map(pb => `<span class="service-tag-pill">🏢 ${pb}</span>`).join('')}
                        </div>
                    </div>
                `;
            }

            // GIS layers
            let gisHtml = '';
            if (s.gisMappedLayers && s.gisMappedLayers.length) {
                gisHtml = `
                    <div class="service-extra-block">
                        <div class="extra-block-label">GIS Spatial Asset Layers:</div>
                        <div class="service-tags-wrap">
                            ${s.gisMappedLayers.map(l => `<span class="service-gis-tag">🗺️ ${l}</span>`).join('')}
                        </div>
                    </div>
                `;
            }

            html += `
                <div class="service-domain-card" data-domain="${s.number}" data-category="${s.category}">
                    <div class="domain-card-header">
                        <div class="domain-num-badge">Domain ${String(s.number).padStart(2, '0')}</div>
                        <div class="domain-cat-badge">${s.categoryLabel || s.category}</div>
                    </div>

                    <div class="domain-main-row">
                        <div class="domain-icon">${s.icon || '🌾'}</div>
                        <div class="domain-title-wrap">
                            <h3 class="domain-title">${displayTitle}</h3>
                            <p class="domain-desc">${s.desc}</p>
                        </div>
                    </div>

                    ${workflowHtml}
                    ${formulaHtml}
                    ${clustersHtml}
                    ${processingHtml}
                    ${exportHtml}
                    ${commoditiesHtml}
                    ${buyersHtml}
                    ${gisHtml}
                    ${subListHtml}

                    <div class="domain-card-footer">
                        <a href="${s.actionUrl || '#'}" class="btn btn-outline btn-sm">
                            ${s.actionText || 'Explore Facility'} →
                        </a>
                        <button type="button" class="btn btn-primary btn-sm" onclick="ServicesModule.openInquiry('${s.number}', '${s.title.replace(/'/g, "\\'")}')">
                            📋 Inquire / Onboard
                        </button>
                    </div>
                </div>
            `;
        });

        grid.innerHTML = html;
        this.totalCards = filtered.length;
        this.currentIndex = 0;
        this.setupSlider();
        this.updateSlider();
    },

    setupSlider() {
        if (this.sliderInitialized) return;
        const prevBtn = document.getElementById('srvSliderPrevBtn');
        const nextBtn = document.getElementById('srvSliderNextBtn');
        const grid = document.getElementById('servicesMasterGrid');

        if (prevBtn) {
            prevBtn.addEventListener('click', () => this.prev());
        }
        if (nextBtn) {
            nextBtn.addEventListener('click', () => this.next());
        }

        if (grid) {
            let touchStartX = 0;
            let touchStartY = 0;
            let touchEndX = 0;
            let touchEndY = 0;

            grid.addEventListener('touchstart', (e) => {
                if (e.touches && e.touches.length) {
                    touchStartX = e.touches[0].clientX;
                    touchStartY = e.touches[0].clientY;
                }
            }, { passive: true });

            grid.addEventListener('touchend', (e) => {
                if (e.changedTouches && e.changedTouches.length) {
                    touchEndX = e.changedTouches[0].clientX;
                    touchEndY = e.changedTouches[0].clientY;
                    const diffX = touchStartX - touchEndX;
                    const diffY = touchStartY - touchEndY;
                    if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 35) {
                        if (diffX > 0) this.next();
                        else this.prev();
                    }
                }
            }, { passive: true });

            // Mouse drag gesture for browser emulation testing
            let isMouseDown = false;
            let mouseStartX = 0;
            grid.addEventListener('mousedown', (e) => {
                if (window.innerWidth > 768) return;
                isMouseDown = true;
                mouseStartX = e.clientX;
            });
            window.addEventListener('mouseup', (e) => {
                if (!isMouseDown) return;
                isMouseDown = false;
                const diffX = mouseStartX - e.clientX;
                if (Math.abs(diffX) > 40) {
                    if (diffX > 0) this.next();
                    else this.prev();
                }
            });
        }

        window.addEventListener('resize', () => {
            const g = document.getElementById('servicesMasterGrid');
            const controls = document.getElementById('servicesSliderControls');
            if (window.innerWidth > 768) {
                if (g) g.style.transform = '';
                if (controls) controls.style.display = '';
            } else {
                this.updateSlider();
            }
        });

        this.sliderInitialized = true;
    },

    prev() {
        if (this.currentIndex > 0) {
            this.currentIndex--;
            this.updateSlider();
        }
    },

    next() {
        if (this.currentIndex < this.totalCards - 1) {
            this.currentIndex++;
            this.updateSlider();
        }
    },

    goTo(index) {
        if (index >= 0 && index < this.totalCards) {
            this.currentIndex = index;
            this.updateSlider();
        }
    },

    updateSlider() {
        const grid = document.getElementById('servicesMasterGrid');
        const counter = document.getElementById('srvSliderCounter');
        const prevBtn = document.getElementById('srvSliderPrevBtn');
        const nextBtn = document.getElementById('srvSliderNextBtn');
        const controls = document.getElementById('servicesSliderControls');

        if (!grid) return;

        if (window.innerWidth <= 768) {
            grid.style.transform = `translateX(-${this.currentIndex * 100}%)`;
            if (controls) {
                controls.style.display = this.totalCards > 1 ? 'flex' : 'none';
            }
            const currentNum = this.totalCards === 0 ? 0 : this.currentIndex + 1;
            if (counter) {
                counter.textContent = `${currentNum} / ${this.totalCards}`;
            }
            if (prevBtn) {
                const isFirst = this.currentIndex <= 0;
                prevBtn.disabled = isFirst;
                prevBtn.style.opacity = isFirst ? '0.35' : '1';
                prevBtn.style.cursor = isFirst ? 'not-allowed' : 'pointer';
            }
            if (nextBtn) {
                const isLast = this.currentIndex >= this.totalCards - 1;
                nextBtn.disabled = isLast;
                nextBtn.style.opacity = isLast ? '0.35' : '1';
                nextBtn.style.cursor = isLast ? 'not-allowed' : 'pointer';
            }
        } else {
            grid.style.transform = '';
            if (controls) controls.style.display = 'none';
        }
    }
};

const SchemesSliderModule = {
    currentIndex: 0,
    timer: null,

    init() {
        const prevBtn = document.getElementById('schemesPrevBtn');
        const nextBtn = document.getElementById('schemesNextBtn');
        const track = document.getElementById('schemesSliderTrack');
        const container = document.getElementById('schemesSliderContainer');
        const dotsContainer = document.getElementById('schemesSliderDots');
        if (!track || !container) return;

        const items = track.querySelectorAll('.initiative-slide-item');
        if (!items.length) return;

        const getVisibleCount = () => {
            if (window.innerWidth <= 680) return 1;
            if (window.innerWidth <= 1024) return 2;
            return 3;
        };

        const getMaxIndex = () => {
            return Math.max(0, items.length - getVisibleCount());
        };

        const restartAutoplay = () => {
            if (this.timer) clearInterval(this.timer);
            const max = getMaxIndex();
            if (max > 0) {
                this.timer = setInterval(() => {
                    const currentMax = getMaxIndex();
                    if (currentMax > 0) {
                        this.currentIndex = (this.currentIndex < currentMax) ? this.currentIndex + 1 : 0;
                        update();
                    }
                }, 5000);
            }
        };

        const renderDots = () => {
            if (!dotsContainer) return;
            dotsContainer.innerHTML = '';
            const maxIdx = getMaxIndex();
            const totalDots = maxIdx + 1;
            if (totalDots <= 1) {
                dotsContainer.style.display = 'none';
                return;
            }
            dotsContainer.style.display = 'flex';

            for (let i = 0; i < totalDots; i++) {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = `slider-dot ${i === this.currentIndex ? 'active' : ''}`;
                dot.setAttribute('aria-label', `Go to slide ${i + 1}`);
                dot.addEventListener('click', () => {
                    this.currentIndex = i;
                    update();
                    restartAutoplay();
                });
                dotsContainer.appendChild(dot);
            }
        };

        const update = () => {
            const max = getMaxIndex();
            if (this.currentIndex > max) this.currentIndex = max;
            if (this.currentIndex < 0) this.currentIndex = 0;

            const firstItem = items[0];
            if (!firstItem) return;

            const itemWidth = firstItem.getBoundingClientRect().width;
            const gap = 24; // 1.5rem gap
            const offset = this.currentIndex * (itemWidth + gap);
            track.style.transform = `translateX(-${offset}px)`;

            if (dotsContainer) {
                const dots = dotsContainer.querySelectorAll('.slider-dot');
                dots.forEach((d, idx) => d.classList.toggle('active', idx === this.currentIndex));
            }

            // Toggle arrow buttons visibility / disabled state
            if (prevBtn && nextBtn) {
                if (max <= 0) {
                    prevBtn.style.opacity = '0.35';
                    nextBtn.style.opacity = '0.35';
                    prevBtn.style.pointerEvents = 'none';
                    nextBtn.style.pointerEvents = 'none';
                } else {
                    prevBtn.style.opacity = '1';
                    nextBtn.style.opacity = '1';
                    prevBtn.style.pointerEvents = 'auto';
                    nextBtn.style.pointerEvents = 'auto';
                }
            }
        };

        renderDots();
        update();

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                const max = getMaxIndex();
                this.currentIndex = (this.currentIndex > 0) ? this.currentIndex - 1 : max;
                update();
                restartAutoplay();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                const max = getMaxIndex();
                this.currentIndex = (this.currentIndex < max) ? this.currentIndex + 1 : 0;
                update();
                restartAutoplay();
            });
        }

        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                renderDots();
                update();
            }, 100);
        });

        // Touch & Swipe Support
        let startX = 0;
        let isDragging = false;

        container.addEventListener('touchstart', (e) => {
            if (e.touches && e.touches.length) {
                startX = e.touches[0].clientX;
                isDragging = true;
            }
        }, { passive: true });

        container.addEventListener('touchend', (e) => {
            if (!isDragging) return;
            if (e.changedTouches && e.changedTouches.length) {
                const diff = startX - e.changedTouches[0].clientX;
                if (Math.abs(diff) > 40) {
                    const max = getMaxIndex();
                    if (diff > 0) {
                        this.currentIndex = (this.currentIndex < max) ? this.currentIndex + 1 : 0;
                    } else {
                        this.currentIndex = (this.currentIndex > 0) ? this.currentIndex - 1 : max;
                    }
                    update();
                    restartAutoplay();
                }
            }
            isDragging = false;
        });

        container.addEventListener('mouseenter', () => {
            if (this.timer) clearInterval(this.timer);
        });
        container.addEventListener('mouseleave', restartAutoplay);

        restartAutoplay();
    }
};

const NavigationModule = {
    _overlay: null,

    init() {
        const navMenu = document.getElementById('navMenu');

        // ── Ensure overlay element exists in DOM ─────────────────────────
        if (!document.querySelector('.mobile-nav-overlay')) {
            const overlay = document.createElement('div');
            overlay.className = 'mobile-nav-overlay';
            overlay.setAttribute('aria-hidden', 'true');
            document.body.appendChild(overlay);
            this._overlay = overlay;
        } else {
            this._overlay = document.querySelector('.mobile-nav-overlay');
        }

        // ── Ensure drawer header exists inside nav ──────────────────────
        if (navMenu && !navMenu.querySelector('.nav-close-btn')) {
            const headerDiv = document.createElement('div');
            headerDiv.className = 'nav-drawer-header';
            headerDiv.innerHTML = `
                <div class="nav-drawer-brand">
                    <span class="nav-drawer-logo">🌾</span>
                    <span class="nav-drawer-title">Navigation</span>
                </div>
                <button type="button" class="nav-close-btn" id="navCloseBtn" aria-label="Close Navigation Menu">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            `;
            navMenu.insertBefore(headerDiv, navMenu.firstChild);
        }

        // ── Delegated Document Click Handler (Bulletproof) ───────────────
        document.addEventListener('click', (e) => {
            // 1. Mobile Menu Toggle Button
            const toggleBtn = e.target.closest('#mobileMenuToggle, .mobile-toggle-btn');
            if (toggleBtn) {
                e.preventDefault();
                e.stopPropagation();
                const menu = document.getElementById('navMenu');
                if (menu && menu.classList.contains('active')) {
                    NavigationModule._closeMenu();
                } else {
                    NavigationModule._openMenu();
                }
                return;
            }

            // 2. Drawer Close Button (✕)
            if (e.target.closest('.nav-close-btn')) {
                e.preventDefault();
                e.stopPropagation();
                NavigationModule._closeMenu();
                return;
            }

            // 3. Shaded Backdrop Overlay Click
            if (e.target.classList.contains('mobile-nav-overlay')) {
                e.preventDefault();
                NavigationModule._closeMenu();
                return;
            }

            // 4. Dropdown Accordion Toggle (Inside nav)
            const dropdownBtn = e.target.closest('.nav-dropdown-btn');
            if (dropdownBtn) {
                const navItem = dropdownBtn.closest('.has-dropdown');
                if (navItem) {
                    e.preventDefault();
                    e.stopPropagation();
                    const isOpen = navItem.classList.contains('open');

                    // Close any other open dropdowns
                    document.querySelectorAll('.has-dropdown').forEach(other => {
                        if (other !== navItem) {
                            other.classList.remove('open');
                            const otherBtn = other.querySelector('.nav-dropdown-btn');
                            if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
                        }
                    });

                    navItem.classList.toggle('open', !isOpen);
                    dropdownBtn.setAttribute('aria-expanded', !isOpen ? 'true' : 'false');
                }
                return;
            }

            // 5. Nav links (non-dropdown links and dropdown menu links) close drawer
            const navLink = e.target.closest('a.nav-link, a.dropdown-item');
            if (navLink && document.getElementById('navMenu')?.classList.contains('active')) {
                NavigationModule._closeMenu();
                return;
            }

            // 6. Click outside dropdowns closes open dropdowns on desktop
            if (!e.target.closest('.has-dropdown')) {
                document.querySelectorAll('.has-dropdown.open').forEach(item => {
                    item.classList.remove('open');
                    const btn = item.querySelector('.nav-dropdown-btn');
                    if (btn) btn.setAttribute('aria-expanded', 'false');
                });
            }
        });

        // ── Close on Escape key ───────────────────────────────────────────
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                NavigationModule._closeMenu();
                document.querySelectorAll('.has-dropdown.open').forEach(item => {
                    item.classList.remove('open');
                    const btn = item.querySelector('.nav-dropdown-btn');
                    if (btn) btn.setAttribute('aria-expanded', 'false');
                });
            }
        });

        // ── Header scroll effect ──────────────────────────────────────────
        const mainHeader = document.querySelector('.main-header');
        if (mainHeader) {
            window.addEventListener('scroll', () => {
                mainHeader.classList.toggle('header-scrolled', window.scrollY > 10);
            }, { passive: true });
        }

        this.highlightActiveLink();
    },

    _openMenu() {
        const navMenu = document.getElementById('navMenu');
        const overlay = document.querySelector('.mobile-nav-overlay') || this._overlay;
        if (navMenu) navMenu.classList.add('active');
        if (overlay) overlay.classList.add('active');
        document.body.classList.add('nav-open');
        const toggleBtn = document.getElementById('mobileMenuToggle');
        if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'true');
    },

    _closeMenu() {
        const navMenu = document.getElementById('navMenu');
        const overlay = document.querySelector('.mobile-nav-overlay') || this._overlay;
        if (navMenu) navMenu.classList.remove('active');
        if (overlay) overlay.classList.remove('active');
        document.body.classList.remove('nav-open');
        const toggleBtn = document.getElementById('mobileMenuToggle');
        if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'false');
    },

    highlightActiveLink() {
        const navMenu = document.getElementById('navMenu');
        if (!navMenu) return;

        const currentUrl = new URL(window.location.href);
        const currentPath = currentUrl.pathname.toLowerCase().replace(/\/index\.(html|php)$/, '').replace(/\/$/, '') || '/';

        const isHomePage = (
            currentPath === '' ||
            currentPath === '/' ||
            currentPath.endsWith('/agricultural_marketing_wordpress') ||
            currentPath.endsWith('/theme')
        );

        // Clear all active classes first to ensure clean state
        navMenu.querySelectorAll('.active').forEach(el => el.classList.remove('active'));

        if (isHomePage) {
            const homeLink = navMenu.querySelector('a[data-i18n="nav_home"]') || navMenu.querySelector('a[href="index.html"]');
            if (homeLink) homeLink.classList.add('active');
            return;
        }

        // Only highlight direct top-level links (Home, Mandi Rates, Contact Us)
        // Do NOT select dropdowns or dropdown items under the menu
        const topLinks = navMenu.querySelectorAll('.nav-item:not(.has-dropdown) > .nav-link');
        topLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (!href) return;

            const linkUrl = new URL(href, window.location.href);
            const linkPath = linkUrl.pathname.toLowerCase().replace(/\/index\.(html|php)$/, '').replace(/\/$/, '') || '/';

            if (currentPath === linkPath || (linkPath !== '/' && currentPath.endsWith(linkPath))) {
                link.classList.add('active');
            }
        });
    }
};

/* ==========================================================================
   15. PWA & TOAST ENGINE
   ========================================================================== */
const PWAModule = {
    init() {
        if ('serviceWorker' in navigator && (window.location.protocol === 'https:' || window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1')) {
            navigator.serviceWorker.register('./sw.js').then(() => {
                console.info('AgriMarketing PWA Service Worker Registered');
            }).catch(e => console.info('SW registration bypassed in file/dev mode'));
        }

        window.addEventListener('online', () => showToast('🌐 Online: Mandi rate feed synced with AGMARKNET 2.0', 'success'));
        window.addEventListener('offline', () => showToast('📶 Offline Mode: Using cached commodity price bulletins', 'info'));
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
