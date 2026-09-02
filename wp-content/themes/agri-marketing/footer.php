<?php
/**
 * The Footer for Agricultural Marketing Department Theme
 *
 * @package AgriMarketing
 */
$helpline = get_option('agri_helpline', '1800-180-1551');
$email = get_option('agri_email', 'agrimarketing-wb@nic.in');
$address = get_option('agri_address', 'Khadyashree Bhavan, 11A Mirza Ghalib Street, Block-A, 4th Floor, Kolkata - 700087');
?>
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <h3 class="footer-brand-title" data-i18n="footer_about_title">Agricultural Marketing Department</h3>
                <p class="footer-desc" data-i18n="footer_about_desc">
                    Committed to empowering farmers, stabilizing food prices, providing state-of-the-art agricultural logistics, and building transparent market mechanisms.
                </p>
                <div class="footer-helpline-box">
                    <div class="f-help-label" data-i18n="footer_helpline_label">Kisan Call Center / 24x7 Helpline:</div>
                    <span class="f-help-num"><?php echo esc_html($helpline); ?></span>
                </div>
            </div>

            <div>
                <h4 class="footer-col-title" data-i18n="footer_quick_links">Quick Navigation</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">› <span data-i18n="nav_home">Home</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/mandi-rates/')); ?>">› <span data-i18n="nav_rates">Daily Mandi Rates</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/schemes/')); ?>">› <span data-i18n="nav_schemes">Schemes & Subsidies</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/cold-storage/')); ?>">› <span data-i18n="nav_cold_storage">Cold Storage Network</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/marketplace/')); ?>">› <span data-i18n="nav_marketplace">Farm Connect Hub</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/about/')); ?>">› <span data-i18n="nav_about">About Us</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/notices/')); ?>">› <span data-i18n="nav_tenders">Tenders & Notices</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">› <span data-i18n="nav_contact">Contact Us</span></a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-col-title" data-i18n="footer_schemes_links">Important Schemes</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/schemes/')); ?>">› <span data-i18n="footer_scheme_amar">Amar Fasal Amar Gari</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/schemes/')); ?>">› <span data-i18n="footer_scheme_sufal">Sufal Bangla Outlets</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/schemes/')); ?>">› <span data-i18n="footer_scheme_solar">Solar Cold Chain Assistance</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/schemes/')); ?>">› <span data-i18n="footer_scheme_krishak">Krishak Bandhu Linkage</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/schemes/')); ?>">› <span data-i18n="footer_scheme_enam">e-NAM Inter-state Trade</span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/schemes/')); ?>">› <span data-i18n="footer_scheme_agmark">Agmark Quality Certification</span></a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-col-title" data-i18n="footer_contact_title">Headquarters</h4>
                <p style="font-size:0.88rem; color:#94a3b8; line-height:1.6; margin-bottom:1rem;" data-i18n="footer_address">
                    <?php echo esc_html($address); ?>
                </p>
                <div style="font-size:0.85rem; color:#cbd5e1; display:flex; flex-direction:column; gap:0.35rem;">
                    <div>📞 <strong data-i18n="footer_lbl_helpline">Helpline:</strong> <?php echo esc_html($helpline); ?></div>
                    <div>✉️ <strong data-i18n="footer_lbl_email">Email:</strong> <?php echo esc_html($email); ?></div>
                    <div>🌐 <strong data-i18n="footer_lbl_website">Website:</strong> <?php echo esc_html($_SERVER['HTTP_HOST'] ?? 'localhost'); ?></div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div data-i18n="footer_rights">
                © <?php echo date('Y'); ?> Agricultural Marketing Department. All Rights Reserved.
            </div>
            <div style="display:flex; gap:1.2rem; flex-wrap:wrap;">
                <a href="<?php echo esc_url(home_url('/about/')); ?>" style="color:#94a3b8;" data-i18n="footer_privacy">Privacy Policy</a>
                <a href="<?php echo esc_url(home_url('/about/')); ?>" style="color:#94a3b8;" data-i18n="footer_terms">Terms of Use</a>
                <a href="<?php echo esc_url(home_url('/about/')); ?>" style="color:#94a3b8;" data-i18n="footer_accessibility">Accessibility Statement</a>
                <a href="<?php echo esc_url(home_url('/about/')); ?>" style="color:#94a3b8;" data-i18n="footer_sitemap">Sitemap</a>
            </div>
        </div>
    </div>
</footer>

<!-- Modal Container for dynamic previews -->
<div class="modal-overlay" id="globalModalOverlay">
    <div class="modal-card" id="globalModalCard">
        <button class="modal-close-btn" id="globalModalClose">&times;</button>
        <div class="modal-body" id="globalModalBody"></div>
    </div>
</div>

<!-- Toast notification box -->
<div class="toast-container" id="toastContainer"></div>

<?php wp_footer(); ?>
</body>
</html>
