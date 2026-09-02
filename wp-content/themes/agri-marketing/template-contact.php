<?php
/**
 * Template Name: Contact Us
 *
 * @package AgriMarketing
 */
get_header();
$post_id  = get_the_ID();
$helpline = get_option('agri_helpline', '1800-180-1551');
$alt_help = get_option('agri_alt_helpline', '033-2225-8888');
$email    = get_option('agri_email', 'agrimarketing-wb@nic.in');
$address  = get_option('agri_address', 'Khadyashree Bhavan, 11A Mirza Ghalib Street, Block-A, 4th Floor, Kolkata - 700087');
$hours    = agri_get_meta($post_id, 'contact_hours', get_option('agri_office_hours', 'Monday – Friday (10:00 AM – 5:30 PM)'));
$banner_subtitle = agri_get_meta($post_id, 'banner_subtitle', '24x7 Kisan helpline, district APMC market directories, grievance redressal, and feedback portal.');

$hq_title     = agri_get_meta($post_id, 'contact_hq_title', 'State Headquarters');
$kisan_title  = agri_get_meta($post_id, 'contact_kisan_title', 'Kisan Toll-Free Support Desk');
$kisan_desc   = agri_get_meta($post_id, 'contact_kisan_desc', 'Available 24x7 in Bengali, English, and Hindi for live Mandi rates, dispute reporting, and subsidy guidance.');
$apmc_title   = agri_get_meta($post_id, 'contact_apmc_title', 'Regional APMC Administrative Offices');
$form_title   = agri_get_meta($post_id, 'contact_form_title', 'Citizen Feedback & Inquiries');
$form_desc    = agri_get_meta($post_id, 'contact_form_desc', 'Submit feedback, rate dispute issues, or general inquiries. You will receive an instant SMS tracking ID registered in the department portal.');

$raw_apmc = agri_get_meta($post_id, 'contact_apmc_offices', '');
$apmc_list = array();
if (!empty(trim($raw_apmc))) {
    $lines = explode("\n", str_replace("\r", "", $raw_apmc));
    foreach ($lines as $line) {
        if (!empty(trim($line))) {
            $parts = explode("|", $line);
            $apmc_list[] = array(
                'name'    => trim($parts[0] ?? ''),
                'address' => trim($parts[1] ?? ''),
                'phone'   => trim($parts[2] ?? '')
            );
        }
    }
}
if (empty($apmc_list)) {
    $apmc_list = array(
        array('name' => 'Hooghly APMC', 'address' => 'Dhaniakhali Market Yard', 'phone' => '033-2680-1122'),
        array('name' => 'Burdwan Central', 'address' => 'Memari GT Road Complex', 'phone' => '0342-265-4433'),
        array('name' => 'Nadia APMC', 'address' => 'Krishnanagar Station Road', 'phone' => '03472-251-889'),
        array('name' => 'Siliguri North Bengal', 'address' => 'Matigara Regulated Yard', 'phone' => '0353-257-2200'),
        array('name' => 'Malda Regional', 'address' => 'English Bazar APMC Compound', 'phone' => '03512-252-114'),
        array('name' => 'Murshidabad Market', 'address' => 'Berhampore Station Road', 'phone' => '03482-250-990'),
    );
}
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
                <span class="current" data-i18n="nav_contact"><?php the_title(); ?></span>
            </div>
            <h1 class="page-banner-title"><?php the_title(); ?></h1>
            <p class="page-banner-desc">
                <?php echo esc_html($banner_subtitle); ?>
            </p>
        </div>
    </div>
</section>

<!-- ==========================================================================
   CONTACT INFORMATION & CITIZEN FEEDBACK FORM
   ========================================================================== -->
<section class="section">
    <div class="container">
        <div class="contact-layout-grid">
            <!-- Left Side: Directory & Office Stack -->
            <div class="info-cards-stack">
                <div class="contact-info-card">
                    <div class="cic-icon">🏢</div>
                    <div>
                        <h3 style="font-size:1.15rem; font-weight:700; color:var(--text-main); margin-bottom:0.35rem;">
                            <?php echo esc_html($hq_title); ?>
                        </h3>
                        <p style="font-size:0.88rem; color:var(--text-muted); line-height:1.5; margin-bottom:0.6rem;">
                            <?php echo esc_html($address); ?>
                        </p>
                        <div style="font-size:0.85rem; color:var(--text-main); display:flex; flex-direction:column; gap:0.25rem;">
                            <div>📞 <strong>Phone:</strong> <?php echo esc_html($alt_help); ?></div>
                            <div>✉️ <strong>Email:</strong> <a href="mailto:<?php echo esc_attr($email); ?>" style="color:inherit;"><?php echo esc_html($email); ?></a></div>
                            <div>⏰ <strong>Office Hours:</strong> <?php echo esc_html($hours); ?></div>
                        </div>
                    </div>
                </div>

                <div class="contact-info-card">
                    <div class="cic-icon" style="background:var(--accent-soft); color:var(--accent-dark);">📞</div>
                    <div>
                        <h3 style="font-size:1.15rem; font-weight:700; color:var(--text-main); margin-bottom:0.35rem;">
                            <?php echo esc_html($kisan_title); ?>
                        </h3>
                        <p style="font-size:0.88rem; color:var(--text-muted); line-height:1.5; margin-bottom:0.6rem;">
                            <?php echo esc_html($kisan_desc); ?>
                        </p>
                        <a href="tel:<?php echo esc_attr(str_replace('-', '', $helpline)); ?>" style="font-size:1.35rem; font-weight:800; color:var(--primary); font-family:'Outfit'; text-decoration:none;">
                            <?php echo esc_html($helpline); ?>
                        </a>
                    </div>
                </div>

                <div class="contact-info-card">
                    <div class="cic-icon" style="background:rgba(2, 132, 199, 0.15); color:var(--info);">📍</div>
                    <div>
                        <h3 style="font-size:1.15rem; font-weight:700; color:var(--text-main); margin-bottom:0.35rem;">
                            <?php echo esc_html($apmc_title); ?>
                        </h3>
                        <ul style="font-size:0.85rem; color:var(--text-muted); list-style:none; line-height:1.8;">
                            <?php foreach ($apmc_list as $off) : ?>
                                <li>• <strong><?php echo esc_html($off['name']); ?>:</strong> <?php echo esc_html($off['address']); ?><?php echo !empty($off['phone']) ? ' | ' . esc_html($off['phone']) : ''; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Side: Online Inquiry & Feedback Form -->
            <div class="contact-form-card">
                <h3 style="font-size:1.3rem; font-weight:800; color:var(--text-main); margin-bottom:0.4rem;">
                    <?php echo esc_html($form_title); ?>
                </h3>
                <p style="font-size:0.88rem; color:var(--text-muted); margin-bottom:1.5rem;">
                    <?php echo esc_html($form_desc); ?>
                </p>

                <form id="citizenContactForm">
                    <div class="form-grid-2">
                        <div class="calc-group">
                            <label class="calc-label">Your Full Name:</label>
                            <input type="text" id="citizenName" name="name" class="form-input" placeholder="e.g. Ramesh Chandra Das" required>
                        </div>
                        <div class="calc-group">
                            <label class="calc-label">Mobile Number (for SMS Tracking):</label>
                            <input type="tel" id="citizenPhone" name="phone" class="form-input" placeholder="10-digit mobile" required pattern="[0-9]{10}">
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="calc-group">
                            <label class="calc-label">Your District:</label>
                            <select id="citizenDistrict" name="district" class="form-select" required>
                                <option value="">Select District...</option>
                                <option>Hooghly</option>
                                <option>Burdwan</option>
                                <option>Nadia</option>
                                <option>Kolkata</option>
                                <option>Murshidabad</option>
                                <option>Bankura</option>
                                <option>Jalpaiguri</option>
                                <option>Malda</option>
                                <option>North 24 Parganas</option>
                                <option>South 24 Parganas</option>
                                <option>Other District</option>
                            </select>
                        </div>
                        <div class="calc-group">
                            <label class="calc-label">Category of Inquiry:</label>
                            <select id="citizenCategory" name="category" class="form-select" required>
                                <option value="rate_dispute">Mandi Rate Dispute / Query</option>
                                <option value="subsidy_status">Subsidy Application Status</option>
                                <option value="cold_storage">Cold Storage Slot Issue</option>
                                <option value="sufal_bangla">Sufal Bangla Retail Feedback</option>
                                <option value="general">General Administrative Inquiry</option>
                            </select>
                        </div>
                    </div>

                    <div class="calc-group" style="margin-bottom:1.2rem;">
                        <label class="calc-label">Description / Inquiry Details:</label>
                        <textarea id="citizenMessage" name="message" class="form-input" rows="4" placeholder="Provide specific details about your query or feedback..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" id="citizenSubmitBtn" style="width:100%;">
                        🚀 Submit Inquiry / Feedback
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>

<?php
get_footer();
