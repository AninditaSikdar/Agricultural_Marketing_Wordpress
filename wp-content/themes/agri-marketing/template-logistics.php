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
