<?php
/**
 * The Footer for Agricultural Marketing Department Theme
 *
 * @package AgriMarketing
 */
$theme_uri = get_template_directory_uri();
$helpline = get_option('agri_helpline');
if (empty(trim((string)$helpline))) {
    $helpline = '1800-180-1551';
}
$email = get_option('agri_email');
if (empty(trim((string)$email))) {
    $email = 'agrimarketing-wb@nic.in';
}
?>
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
                    <span class="f-help-num"><?php echo esc_html($helpline); ?></span>
                </div>
            </div>

            <div>
                <h4 class="footer-col-title" data-i18n="footer_quick_links">Quick Navigation</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">› <span data-i18n="nav_home">Home</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/mandi-rates/')); ?>">› <span data-i18n="nav_rates">Daily Mandi Rates</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/ebijak-ledger/')); ?>">› <span data-i18n="nav_ebijak">e-Bijak & Ledgers</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/logistics-freight/')); ?>">› <span data-i18n="nav_logistics">Logistics & Freight</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/schemes/')); ?>">› <span data-i18n="nav_schemes">Schemes & Subsidies</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/cold-storage/')); ?>">› <span data-i18n="nav_cold_storage">Cold Storage Network</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/marketplace/')); ?>">› <span data-i18n="nav_marketplace">Farm Connect Hub</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/about/')); ?>">› <span data-i18n="nav_about">About Us</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">› <span data-i18n="nav_contact">Contact Us</span></a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-col-title" data-i18n="footer_schemes_links">AgriTech & Schemes</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/ebijak-ledger/')); ?>">› <span>e-Bijak Invoicing (APMC Cess)</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/logistics-freight/')); ?>">› <span>Freight Transport Calculator</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/cold-storage/')); ?>">› <span>WDRA Cold Storage & e-NWR</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/schemes/')); ?>">› <span>Amar Fasal Amar Gari</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/schemes/')); ?>">› <span>Sufal Bangla Outlets</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/marketplace/')); ?>">› <span>Live Mandi E-Auction Floor</span></a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-col-title">Headquarters</h4>
                <p style="font-size:0.88rem; color:#94a3b8; line-height:1.6; margin-bottom:1rem;">
                    Subhanna, 5th & 6th Floor, DF Block, Sector-I, Salt Lake, Kolkata - 700064
                </p>
                <div style="font-size:0.85rem; color:#cbd5e1; display:flex; flex-direction:column; gap:0.35rem;">
                    <div>📞 <strong>Helpline:</strong> <?php echo esc_html($helpline); ?></div>
                    <div>✉️ <strong>Email:</strong> <?php echo esc_html($email); ?></div>
                    <div>🌐 <strong>Portal:</strong> agrimarketing.wb.gov.in</div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div data-i18n="footer_rights">
                © <?php echo date('Y'); ?> Agricultural Marketing Department. All Rights Reserved.
            </div>
            <div style="display:flex; gap:1.2rem; flex-wrap:wrap;">
                <a href="<?php echo esc_url(home_url('/about/')); ?>" style="color:#94a3b8;">Privacy Policy</a>
                <a href="<?php echo esc_url(home_url('/about/')); ?>" style="color:#94a3b8;">Terms of Trade</a>
                <a href="<?php echo esc_url(home_url('/about/')); ?>" style="color:#94a3b8;">AGMARKNET 2.0 Compliance</a>
                <a href="<?php echo esc_url(home_url('/about/')); ?>" style="color:#94a3b8;">Sitemap</a>
            </div>
        </div>
    </div>
</footer>

<script src="<?php echo esc_url($theme_uri . '/js/app.js'); ?>"></script>
<?php wp_footer(); ?>
</body>
</html>
