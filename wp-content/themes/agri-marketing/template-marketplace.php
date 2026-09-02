<?php
/**
 * Template Name: Farm Connect Marketplace
 *
 * @package AgriMarketing
 */
get_header();
$theme_uri = get_template_directory_uri();
$post_id = get_the_ID();
$banner_subtitle     = agri_get_meta($post_id, 'banner_subtitle', 'Direct verified farm listings from agricultural cooperatives, FPOs, and progressive producers with standardized quality assaying.');
$safeguards_title    = agri_get_meta($post_id, 'mp_safeguards_title', 'Direct Marketing & Quality Safeguards');
$safeguards_subtitle = agri_get_meta($post_id, 'mp_safeguards_subtitle', 'How the State Agricultural Marketing Board guarantees secure trade and transaction transparency.');

// 3 Assurance Safeguards
$s1_title = agri_get_meta($post_id, 'mp_s1_title', 'Quality Assay & Agmark Standards');
$s1_desc  = agri_get_meta($post_id, 'mp_s1_desc', 'All listed crops undergo scientific moisture, size uniformity, and purity checks at designated APMC testing labs with QR certificates.');

$s2_title = agri_get_meta($post_id, 'mp_s2_title', 'Direct Digital Escrow Settlement');
$s2_desc  = agri_get_meta($post_id, 'mp_s2_desc', 'Trade payments are protected via state-monitored escrow and transferred directly to the farmer\'s bank account with UTR tracking.');

$s3_title = agri_get_meta($post_id, 'mp_s3_title', 'Integrated Freight & Weighing');
$s3_desc  = agri_get_meta($post_id, 'mp_s3_desc', 'Standardized e-weighbridges at checkposts with subsidized transit vehicles under Amar Fasal Amar Gari.');
?>

<?php
agri_render_inner_banner(array(
    'title'       => get_the_title(),
    'subtitle'    => $banner_subtitle,
    'tag'         => 'Direct Farm-to-Buyer Marketplace',
    'image'       => $theme_uri . '/images/banner-marketplace.jpg',
    'badge_label' => 'Verified Farm Produce',
    'badge_val'   => '0% Middleman Margin',
    'i18n_title'  => 'market_title',
    'i18n_sub'    => 'market_subtitle',
    'i18n_crumb'  => 'nav_marketplace',
    'meta_pills'  => array('Verified Lots', 'FSSAI / AGMARK Assayed', 'Live e-Auction')
));
?>

<!-- Produce Marketplace Listings -->
<section class="section" style="padding: 2.5rem 0;">
    <div class="container">
        <!-- Header Actions -->
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem; margin-bottom:1.5rem;">
            <div>
                <h2 style="font-size:1.4rem; font-weight:800; color:var(--text-main); margin-bottom:0.2rem;">Live Verified Farm Stocks & Active Lots</h2>
                <p style="font-size:0.88rem; color:var(--text-muted); margin:0;">Direct farm-gate and FPO aggregation offers with certified lab quality parameters and zero middleman commissions.</p>
            </div>
            <div style="display:flex; gap:0.6rem; flex-wrap:wrap;">
                <button class="btn btn-accent" onclick="ModalManager.open('sellRequestModal')">
                    ➕ Post Farmer Sell Offer
                </button>
                <button class="btn btn-primary" onclick="ModalManager.open('liveAuctionModal')">
                    ⚡ Enter E-Auction Floor
                </button>
                <button class="btn btn-outline" onclick="ModalManager.open('bulkRfpModal')">
                    🏢 Post Institutional RFP
                </button>
            </div>
        </div>

        <!-- Marketplace Category Filter Tabs (Doc Section 6 & 11) -->
        <div class="marketplace-category-tabs" style="display:flex; gap:0.5rem; flex-wrap:wrap; margin-bottom:1.75rem;">
            <button class="category-pill active" data-mp-cat="all">All Produce (সকল ফসল)</button>
            <button class="category-pill" data-mp-cat="grain">🌾 Cereals & Rice</button>
            <button class="category-pill" data-mp-cat="veg">🥔 Vegetables</button>
            <button class="category-pill" data-mp-cat="gi">🏷️ GI & Speciality (Malda/Sundarbans)</button>
            <button class="category-pill" data-mp-cat="oilseed">🌻 Oilseeds & Spices</button>
            <button class="category-pill" data-mp-cat="fpo">👥 FPO Aggregated Lots</button>
        </div>

        <!-- Dynamic Produce Grid -->
        <div class="produce-grid" id="marketplaceGrid">
            <!-- Populated dynamically via app.js -->
        </div>

        <!-- ==========================================================================
           INSTITUTIONAL BULK PROCUREMENT BOARD (DOC SECTION 16 & 7)
           ========================================================================== -->
        <div style="margin-top:4rem;">
            <div class="section-header-flex">
                <div>
                    <div class="section-tag">🏢 Institutional & Commercial Procurement</div>
                    <h3 class="section-title" style="font-size:1.4rem;">Institutional Buyer Tenders & Demand Notices</h3>
                    <p class="section-subtitle">
                        Direct procurement for Hotels, Restaurants, Hospitals, Hostels, Railways, Supermarket Chains, and Food Processors from certified FPOs.
                    </p>
                </div>
                <div>
                    <button class="btn btn-primary" onclick="ModalManager.open('bulkRfpModal')">
                        📢 Submit New Institutional Demand RFP
                    </button>
                </div>
            </div>

            <div class="mandi-table-container" style="margin-top:1rem;">
                <table class="mandi-table">
                    <thead>
                        <tr>
                            <th>Buyer Organization</th>
                            <th>Category</th>
                            <th>Commodity Required</th>
                            <th>Monthly Volume</th>
                            <th>Delivery Location</th>
                            <th>Target Spec</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Bengal State Food Supply Corp</strong></td>
                            <td><span class="badge-apmc-licensed">Govt Institution</span></td>
                            <td>🌾 Miniket / Gobindobhog Rice</td>
                            <td><strong>1,200 MT</strong></td>
                            <td>Burdwan Central Hub</td>
                            <td>Moisture &lt; 12%, AGMARK Grade-I</td>
                            <td><button class="btn btn-sm btn-primary" onclick="showToast('Quote submission form opened for WB Food Corp', 'success'); ModalManager.open('produceInquiryModal');">Submit FPO Quote</button></td>
                        </tr>
                        <tr>
                            <td><strong>Eastern Supermarket Chain Ltd</strong></td>
                            <td><span class="badge-verified-kyc">Retail Chain</span></td>
                            <td>🥔 Jyoti Potato (45mm+ Size)</td>
                            <td><strong>450 MT</strong></td>
                            <td>Kolkata Warehouse</td>
                            <td>Washed, Sorted, Graded</td>
                            <td><button class="btn btn-sm btn-primary" onclick="showToast('Quote submission form opened for Eastern Supermarkets', 'success'); ModalManager.open('produceInquiryModal');">Submit FPO Quote</button></td>
                        </tr>
                        <tr>
                            <td><strong>Sunrise Food Processors</strong></td>
                            <td><span class="badge-verified-kyc">Food Processor</span></td>
                            <td>🌶️ Dried Red Chilli (Stemless)</td>
                            <td><strong>180 MT</strong></td>
                            <td>Purba Medinipur Plant</td>
                            <td>High Oleoresin / Pungency</td>
                            <td><button class="btn btn-sm btn-primary" onclick="showToast('Quote submission form opened for Sunrise Processors', 'success'); ModalManager.open('produceInquiryModal');">Submit FPO Quote</button></td>
                        </tr>
                        <tr>
                            <td><strong>Railway Catering Division</strong></td>
                            <td><span class="badge-apmc-licensed">Public Catering</span></td>
                            <td>🧅 Nashik Red Onion</td>
                            <td><strong>300 MT</strong></td>
                            <td>Howrah Terminal Hub</td>
                            <td>50-60mm, Dry Skin</td>
                            <td><button class="btn btn-sm btn-primary" onclick="showToast('Quote submission form opened for Railway Catering', 'success'); ModalManager.open('produceInquiryModal');">Submit FPO Quote</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Trade Security & Quality Assurance Safeguards -->
        <div class="section-header" style="margin-top:4rem; margin-bottom:1.5rem;">
            <h3 class="section-title" style="font-size:1.35rem;"><?php echo esc_html($safeguards_title); ?></h3>
            <p class="section-subtitle" style="font-size:0.88rem;"><?php echo esc_html($safeguards_subtitle); ?></p>
        </div>

        <div class="workflow-grid">
            <div class="workflow-step-card">
                <span class="step-number" style="font-size:1rem; font-weight:800;">01</span>
                <h4 class="step-title"><?php echo esc_html($s1_title); ?></h4>
                <p class="step-desc"><?php echo esc_html($s1_desc); ?></p>
            </div>
            <div class="workflow-step-card">
                <span class="step-number" style="font-size:1rem; font-weight:800;">02</span>
                <h4 class="step-title"><?php echo esc_html($s2_title); ?></h4>
                <p class="step-desc"><?php echo esc_html($s2_desc); ?></p>
            </div>
            <div class="workflow-step-card">
                <span class="step-number" style="font-size:1rem; font-weight:800;">03</span>
                <h4 class="step-title"><?php echo esc_html($s3_title); ?></h4>
                <p class="step-desc"><?php echo esc_html($s3_desc); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Modals -->
<!-- 1. Send Purchase Inquiry Modal -->
<div class="modal-overlay" id="produceInquiryModal">
    <div class="modal-card" style="max-width:480px;">
        <div class="modal-header">
            <h3 class="modal-title">Send Direct Trade Inquiry / Bid</h3>
            <button type="button" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <div style="background:var(--bg-subtle); padding:0.85rem; border-radius:var(--radius-md); margin-bottom:1.25rem;">
                <div>Commodity: <strong id="inquiryCropName" style="color:var(--primary);">Potato</strong></div>
                <div>Seller / FPO: <span id="inquiryFarmerName">Subhash Mondal</span></div>
            </div>
            <form onsubmit="event.preventDefault(); showToast('Trade inquiry sent to farmer/FPO!', 'success'); ModalManager.close('produceInquiryModal');">
                <div class="calc-group">
                    <label class="calc-label">Your Name / Trading Company:</label>
                    <input type="text" class="form-input" placeholder="e.g. Bengal Agro Wholesale" required>
                </div>
                <div class="calc-group">
                    <label class="calc-label">WhatsApp / Contact Phone:</label>
                    <input type="tel" class="form-input" placeholder="e.g. 9830012345" required>
                </div>
                <div class="form-grid-2">
                    <div class="calc-group">
                        <label class="calc-label">Required Quantity (Qtl):</label>
                        <input type="number" class="form-input" placeholder="50" required>
                    </div>
                    <div class="calc-group">
                        <label class="calc-label">Bid Price (₹/Qtl):</label>
                        <input type="number" class="form-input" placeholder="1540" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%; margin-top:0.5rem;">
                    Submit Official Bid Offer
                </button>
            </form>
        </div>
    </div>
</div>

<!-- 2. Quality Assaying Modal -->
<div class="modal-overlay" id="assayModal">
    <div class="modal-card" style="max-width:620px;">
        <div class="modal-header">
            <div>
                <h3 class="modal-title" id="assayCropTitle">Quality Assaying Certificate</h3>
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
                Download Official Assaying Certificate (PDF)
            </button>
        </div>
    </div>
</div>

<!-- 3. Live E-Auction Simulator Modal -->
<div class="modal-overlay" id="liveAuctionModal">
    <div class="modal-card" style="max-width:540px;">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">Live APMC Electronic Auction Floor</h3>
                <div style="font-size:0.85rem; color:var(--text-muted);">Active Lot: <strong>LOT-HGY-8841 (Potato Jyoti - 100 Qtl)</strong></div>
            </div>
            <button type="button" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <div class="auction-card">
                <span class="auction-live-pill">LIVE BIDDING</span>
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

<!-- 4. Farmer Produce Sell Request Modal (Doc Sec 7) -->
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

<!-- 5. Institutional Bulk RFP Post Modal (Doc Sec 7 & 16) -->
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
