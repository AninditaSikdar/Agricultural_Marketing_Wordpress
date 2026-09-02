<?php
/**
 * Template Name: Logistics & Freight Transport
 *
 * @package AgriMarketing
 */
get_header();
$theme_uri = get_template_directory_uri();
?>

<?php
agri_render_inner_banner(array(
    'title'       => 'Integrated Agri-Freight Transport Calculator',
    'subtitle'    => 'Calculate payload transit costs, distance tariffs, vehicle types, and explore WDRA cold chain warehouses with e-NWR pledge financing.',
    'tag'         => '🚛 Farm-to-Mandi Freight Logistics',
    'image'       => $theme_uri . '/images/banner-cold-storage.jpg',
    'badge_label' => 'Logistics Estimator',
    'badge_val'   => 'Live Distance & Fare Engine',
    'i18n_title'  => 'freight_heading',
    'i18n_sub'    => 'freight_subheading',
    'i18n_crumb'  => 'nav_logistics',
    'meta_pills'  => array('🗺️ Mandi Routes', '🚚 Multi-Ton Fleet', '❄️ Reefer Vans Available')
));
?>

<!-- Main Freight Calculator & Route Section -->
<section class="section">
    <div class="container">
        <div style="display:grid; grid-template-columns: 1.2fr 1fr; gap:2.5rem; align-items:start;">
            <!-- Left: Interactive Freight Form -->
            <div class="freight-calc-card">
                <h2 style="font-size:1.3rem; font-weight:800; color:var(--text-main); margin-bottom:1.25rem;">
                    🚛 Transport Route & Cargo Parameters
                </h2>

                <div class="form-grid-2">
                    <div class="calc-group">
                        <label class="calc-label">Origin APMC / Mandi:</label>
                        <select id="freightOriginMandi" class="form-select">
                            <option value="Hooghly">Hooghly APMC Yard</option>
                            <option value="Burdwan">Burdwan Central Mandi</option>
                            <option value="Nadia">Nadia Kisan Hub</option>
                            <option value="Malda">Malda English Bazar</option>
                            <option value="Bankura">Bankura Mandi</option>
                            <option value="Jalpaiguri">Jalpaiguri Regulated</option>
                        </select>
                    </div>

                    <div class="calc-group">
                        <label class="calc-label">Destination Market / Hub:</label>
                        <select id="freightDestMandi" class="form-select">
                            <option value="Kolkata">Kolkata (Koley / Posta Wholesale)</option>
                            <option value="Siliguri">Siliguri North Bengal Terminal</option>
                            <option value="Durgapur">Durgapur Commercial Yard</option>
                            <option value="Howrah">Howrah Wholesale Terminal</option>
                        </select>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="calc-group">
                        <label class="calc-label">Estimated Transit Distance (KM):</label>
                        <input type="number" id="freightDistanceInput" class="form-input" value="85" min="5" max="1200" required>
                    </div>
                    <div class="calc-group">
                        <label class="calc-label">Cargo Weight (in Quintals):</label>
                        <input type="number" id="freightWeightInput" class="form-input" value="40" min="1" max="500" required>
                    </div>
                </div>

                <div class="calc-group">
                    <label class="calc-label" style="font-weight:700;">Select Commercial Vehicle Type:</label>
                    <div class="vehicle-selector-grid">
                        <div class="vehicle-card-radio active" data-vehicle="ace">
                            <div class="v-icon">🛻</div>
                            <div class="v-name">Tata Ace</div>
                            <div class="v-cap">Up to 1.5 MT (15 Qtl)</div>
                        </div>
                        <div class="vehicle-card-radio" data-vehicle="pickup">
                            <div class="v-icon">🚛</div>
                            <div class="v-name">Pickup 407</div>
                            <div class="v-cap">Up to 2.5 MT (25 Qtl)</div>
                        </div>
                        <div class="vehicle-card-radio" data-vehicle="eicher">
                            <div class="v-icon">🚚</div>
                            <div class="v-name">Eicher 14ft</div>
                            <div class="v-cap">Up to 4.5 MT (45 Qtl)</div>
                        </div>
                        <div class="vehicle-card-radio" data-vehicle="truck6">
                            <div class="v-icon">🚛</div>
                            <div class="v-name">6-Wheeler</div>
                            <div class="v-cap">Up to 9.0 MT (90 Qtl)</div>
                        </div>
                        <div class="vehicle-card-radio" data-vehicle="truck10">
                            <div class="v-icon">🚛</div>
                            <div class="v-name">10-Wheeler</div>
                            <div class="v-cap">Up to 16.0 MT (160 Qtl)</div>
                        </div>
                        <div class="vehicle-card-radio" data-vehicle="reefer">
                            <div class="v-icon">❄️</div>
                            <div class="v-name">Reefer Cold Van</div>
                            <div class="v-cap">Up to 6.0 MT (Temp Control)</div>
                        </div>
                    </div>
                </div>

                <button type="button" id="freightCalculateBtn" class="btn btn-primary" style="width:100%;">
                    ⚡ <span data-i18n="btn_calc_freight">Estimate Freight Cost</span>
                </button>
            </div>

            <!-- Right: Estimated Cost Summary Card -->
            <div class="ebijak-container">
                <h2 style="font-size:1.3rem; font-weight:800; color:var(--text-main); margin-bottom:1rem;">
                    📊 Freight Estimate Breakdown
                </h2>

                <div style="background:var(--primary-soft); padding:1.5rem; border-radius:var(--radius-lg); text-align:center; margin-bottom:1.5rem; border:1px solid rgba(15, 104, 56, 0.2);">
                    <div style="font-size:0.85rem; color:var(--text-muted); text-transform:uppercase;">Estimated Total Freight Cost</div>
                    <div style="font-size:2.4rem; font-weight:800; color:var(--primary); font-family:'Outfit';" id="freightTotalCost">₹2,640</div>
                    <div style="font-size:0.9rem; color:var(--text-muted); margin-top:0.35rem;">
                        Rate: <strong id="freightPerQtl" style="color:var(--primary);">₹66.0 / Qtl</strong>
                    </div>
                </div>

                <div style="font-size:0.9rem; line-height:1.8; margin-bottom:1.5rem;">
                    <div class="fee-breakdown-row">
                        <span>Selected Vehicle:</span>
                        <strong id="freightVehicleName">Tata Ace / Small Pickup</strong>
                    </div>
                    <div class="fee-breakdown-row">
                        <span>Estimated Transit Duration:</span>
                        <strong id="freightTransitTime">2.1 Hours</strong>
                    </div>
                    <div class="fee-breakdown-row">
                        <span>Estimated Toll / NH Charges:</span>
                        <strong id="freightToll">₹140</strong>
                    </div>
                    <div class="fee-breakdown-row">
                        <span>Govt Transit Subsidy (Amar Fasal):</span>
                        <strong style="color:var(--success);">Applicable (Up to 50%)</strong>
                    </div>
                </div>

                <button type="button" class="btn btn-accent" style="width:100%;" onclick="showToast('Transport dispatch request submitted! Local mandi logistics coordinator will call you within 15 minutes.', 'success')">
                    🤝 <span data-i18n="btn_book_transport">Request Transport Booking</span>
                </button>
            </div>
        </div>

        <!-- 4-Tier Agricultural Logistics Chain (Doc Section 5) -->
        <div style="margin-top:4.5rem;">
            <div class="section-header">
                <div class="section-tag">🔄 End-to-End Agri Logistics</div>
                <h2 class="section-title">4-Tier Farm-to-Consumer Supply Chain Architecture</h2>
                <p class="section-subtitle">
                    Seamless transit infrastructure connecting smallholder farms to regional mandis, commercial food processors, and urban consumer markets.
                </p>
            </div>

            <div class="supply-chain-tiers-grid">
                <!-- Tier 1 -->
                <div class="tier-card">
                    <div class="tier-badge">Tier 1: Farm Gate</div>
                    <div class="tier-icon">🚜</div>
                    <h3 class="tier-title">Farm → Collection Centre</h3>
                    <ul class="tier-features">
                        <li><span>✔</span> Farmer pickup & tractor dispatch</li>
                        <li><span>✔</span> Mini-truck aggregation routes</li>
                        <li><span>✔</span> FPO aggregation centre intake</li>
                        <li><span>✔</span> Digital weighing & moisture test</li>
                    </ul>
                </div>

                <!-- Tier 2 -->
                <div class="tier-card">
                    <div class="tier-badge">Tier 2: Consolidation</div>
                    <div class="tier-icon">🚚</div>
                    <h3 class="tier-title">Collection Hub → APMC Market</h3>
                    <ul class="tier-features">
                        <li><span>✔</span> Scheduled bulk transportation</li>
                        <li><span>✔</span> Consolidated produce vehicle pooling</li>
                        <li><span>✔</span> Digital Gate Entry Pass & Lot ID</li>
                        <li><span>✔</span> Real-time electronic weighbridge queue</li>
                    </ul>
                </div>

                <!-- Tier 3 -->
                <div class="tier-card">
                    <div class="tier-badge">Tier 3: Commercial</div>
                    <div class="tier-icon">🏭</div>
                    <h3 class="tier-title">Market → Food Processor</h3>
                    <ul class="tier-features">
                        <li><span>✔</span> Bulk commercial transportation</li>
                        <li><span>✔</span> Contract logistics & freight guarantee</li>
                        <li><span>✔</span> Direct delivery to Dal & Rice Mills</li>
                        <li><span>✔</span> Automated statutory cess reconciliation</li>
                    </ul>
                </div>

                <!-- Tier 4 -->
                <div class="tier-card">
                    <div class="tier-badge">Tier 4: Distribution</div>
                    <div class="tier-icon">❄️</div>
                    <h3 class="tier-title">Processor → Retailer & Export</h3>
                    <ul class="tier-features">
                        <li><span>✔</span> Reefer cold chain transit vans</li>
                        <li><span>✔</span> Sufal Bangla direct kiosk supply</li>
                        <li><span>✔</span> Last-mile urban grocery delivery</li>
                        <li><span>✔</span> Port / Air cargo container freight</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Logistics Technology & Digital Compliance Suite (Doc Section 5) -->
        <div style="margin-top:4rem; background:var(--bg-surface); border:1px solid var(--border-color); border-radius:var(--radius-xl); padding:2.5rem; box-shadow:var(--shadow-md);">
            <div class="section-header" style="margin-bottom:2rem; text-align:left;">
                <div class="section-tag">⚡ Digital Supply Chain Tech</div>
                <h3 class="section-title" style="font-size:1.45rem;">Digital Freight Management & Fleet Compliance Suite</h3>
                <p class="section-subtitle" style="margin:0;">Technology tools powering transparency, vehicle scheduling, and paperless logistics operations.</p>
            </div>

            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem;">
                <div class="tech-item-card">
                    <div style="font-size:1.6rem; margin-bottom:0.4rem;">🛰️</div>
                    <h4 style="font-size:1rem; font-weight:700; color:var(--text-main); margin-bottom:0.25rem;">GPS Vehicle Tracking</h4>
                    <p style="font-size:0.82rem; color:var(--text-muted); margin:0;">Live route tracking with driver speed, trip milestones, and checkpoint geofencing.</p>
                </div>
                <div class="tech-item-card">
                    <div style="font-size:1.6rem; margin-bottom:0.4rem;">📑</div>
                    <h4 style="font-size:1rem; font-weight:700; color:var(--text-main); margin-bottom:0.25rem;">Digital Challan & LR</h4>
                    <p style="font-size:0.82rem; color:var(--text-muted); margin:0;">Instant digital Lorry Receipts (LR) and APMC transport challans with QR verification.</p>
                </div>
                <div class="tech-item-card">
                    <div style="font-size:1.6rem; margin-bottom:0.4rem;">🧭</div>
                    <h4 style="font-size:1rem; font-weight:700; color:var(--text-main); margin-bottom:0.25rem;">Route & Load Optimisation</h4>
                    <p style="font-size:0.82rem; color:var(--text-muted); margin:0;">AI route planning minimizing fuel consumption and preventing transit cargo spoilage.</p>
                </div>
                <div class="tech-item-card">
                    <div style="font-size:1.6rem; margin-bottom:0.4rem;">💳</div>
                    <h4 style="font-size:1rem; font-weight:700; color:var(--text-main); margin-bottom:0.25rem;">Direct Freight Settlement</h4>
                    <p style="font-size:0.82rem; color:var(--text-muted); margin:0;">Electronic bank transfer for transporter freight charges with GST & toll reconciliation.</p>
                </div>
            </div>
        </div>

        <!-- Inter-Mandi Price Arbitrage Matrix (Module D.3) -->
        <div style="margin-top:4.5rem;">
            <div class="section-header">
                <div class="section-tag">🗺️ Price Intelligence Arbitrage</div>
                <h2 class="section-title" data-i18n="arbitrage_title">Inter-Mandi Price Comparison & Arbitrage Matrix</h2>
                <p class="section-subtitle" data-i18n="arbitrage_sub">
                    Compare price spread between mandis net of transportation costs to find profitable trade routes.
                </p>
            </div>

            <div class="mandi-table-container">
                <table class="mandi-table arbitrage-table">
                    <thead>
                        <tr>
                            <th>Commodity & Variety</th>
                            <th>Origin Mandi (Local Price)</th>
                            <th>Destination Mandi (Target Price)</th>
                            <th>Gross Spread (₹/Qtl)</th>
                            <th>Est. Transport Cost (₹/Qtl)</th>
                            <th>Net Arbitrage Margin (₹/Qtl)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>🥔 <strong>Potato (Jyoti)</strong></td>
                            <td>Hooghly APMC (₹1,540)</td>
                            <td>Kolkata Koley (₹1,720)</td>
                            <td>+₹180 / Qtl</td>
                            <td>₹45 / Qtl</td>
                            <td><span class="arbitrage-gain">▲ +₹135 / Qtl Profit</span></td>
                            <td><button class="btn btn-sm btn-primary" onclick="showToast('Route Hooghly ➔ Kolkata booked for dispatch', 'success')">Book Route</button></td>
                        </tr>
                        <tr>
                            <td>🧅 <strong>Onion (Nashik Red)</strong></td>
                            <td>Nadia APMC (₹2,350)</td>
                            <td>Kolkata Posta (₹2,600)</td>
                            <td>+₹250 / Qtl</td>
                            <td>₹60 / Qtl</td>
                            <td><span class="arbitrage-gain">▲ +₹190 / Qtl Profit</span></td>
                            <td><button class="btn btn-sm btn-primary" onclick="showToast('Route Nadia ➔ Kolkata booked for dispatch', 'success')">Book Route</button></td>
                        </tr>
                        <tr>
                            <td>🌾 <strong>Gobindobhog Rice</strong></td>
                            <td>Burdwan Regulated (₹6,500)</td>
                            <td>Siliguri Hub (₹7,100)</td>
                            <td>+₹600 / Qtl</td>
                            <td>₹180 / Qtl</td>
                            <td><span class="arbitrage-gain">▲ +₹420 / Qtl Profit</span></td>
                            <td><button class="btn btn-sm btn-primary" onclick="showToast('Route Burdwan ➔ Siliguri booked for dispatch', 'success')">Book Route</button></td>
                        </tr>
                        <tr>
                            <td>🍅 <strong>Tomato (Hybrid)</strong></td>
                            <td>Bankura Mandi (₹1,850)</td>
                            <td>Durgapur Hub (₹2,100)</td>
                            <td>+₹250 / Qtl</td>
                            <td>₹55 / Qtl</td>
                            <td><span class="arbitrage-gain">▲ +₹195 / Qtl Profit</span></td>
                            <td><button class="btn btn-sm btn-primary" onclick="showToast('Route Bankura ➔ Durgapur booked for dispatch', 'success')">Book Route</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
