<?php
/**
 * Agricultural Marketing Department Theme Functions & Definitions
 *
 * @package AgriMarketing
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define Theme Constants
define('AGRI_THEME_VERSION', '1.2.1');
define('AGRI_THEME_DIR', get_template_directory());
define('AGRI_THEME_URI', get_template_directory_uri());

/**
 * 1. Theme Setup
 */
function agri_theme_setup() {
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    register_nav_menus(array(
        'primary' => __('Primary Navigation Menu', 'agri-marketing'),
        'footer'  => __('Footer Quick Links', 'agri-marketing'),
    ));
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('editor-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'agri_theme_setup');

/**
 * 2. Enqueue Styles & Scripts
 */
function agri_enqueue_assets() {
    wp_enqueue_style(
        'agri-google-fonts',
        'https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700;800&family=Noto+Sans+Bengali:wght@400;500;600;700&family=Outfit:wght@400;600;700;800&display=swap',
        array(),
        null
    );
    wp_enqueue_style('agri-main-css', AGRI_THEME_URI . '/css/main.css', array(), AGRI_THEME_VERSION);
    wp_enqueue_style('agri-button-css', AGRI_THEME_URI . '/css/button.css', array('agri-main-css'), AGRI_THEME_VERSION);
    wp_enqueue_style('agri-theme-style', get_stylesheet_uri(), array('agri-main-css'), AGRI_THEME_VERSION);

    wp_enqueue_script('agri-app-js', AGRI_THEME_URI . '/js/app.js', array(), AGRI_THEME_VERSION, true);

    $site_data = agri_get_cms_data();
    wp_localize_script('agri-app-js', 'AgriServerData', array(
        'siteUrl'      => home_url('/'),
        'themeUrl'     => AGRI_THEME_URI,
        'restUrl'      => esc_url_raw(rest_url('agri/v1/data')),
        'inquiryUrl'   => esc_url_raw(rest_url('agri/v1/inquiry')),
        'bookingUrl'   => esc_url_raw(rest_url('agri/v1/booking')),
        'bidUrl'       => esc_url_raw(rest_url('agri/v1/bid')),
        'nonce'        => wp_create_nonce('wp_rest'),
        'mandiRates'   => $site_data['mandiRates'],
        'coldStorage'  => $site_data['coldStorage'],
        'marketplace'  => $site_data['marketplace'],
        'notices'      => $site_data['notices'],
        'schemes'      => $site_data['schemes'],
        'advisories'   => $site_data['advisories'],
        'translations' => $site_data['translations'],
        'settings'     => $site_data['settings']
    ));
}
add_action('wp_enqueue_scripts', 'agri_enqueue_assets');

/**
 * Enqueue Admin Scripts & Media Uploader for CMS
 */
function agri_enqueue_admin_assets($hook) {
    wp_enqueue_media();
    wp_add_inline_script('jquery', "
        jQuery(document).ready(function($){
            $(document).on('click', '.agri-media-upload-btn', function(e){
                e.preventDefault();
                var button = $(this);
                var targetSelector = button.data('target');
                var previewSelector = button.data('preview');
                var removeSelector = button.data('remove');
                var placeholderSelector = button.data('placeholder');

                var customUploader = wp.media({
                    title: 'Select or Upload Media File',
                    button: { text: 'Use This Image' },
                    multiple: false
                }).on('select', function(){
                    var attachment = customUploader.state().get('selection').first().toJSON();
                    $(targetSelector).val(attachment.url).trigger('change');
                    if($(previewSelector).length) {
                        $(previewSelector).attr('src', attachment.url).show();
                    }
                    if($(placeholderSelector).length) {
                        $(placeholderSelector).hide();
                    }
                    if($(removeSelector).length) {
                        $(removeSelector).show();
                    }
                }).open();
            });

            $(document).on('click', '.agri-media-remove-btn', function(e){
                e.preventDefault();
                var button = $(this);
                var targetSelector = button.data('target');
                var previewSelector = button.data('preview');
                var placeholderSelector = button.data('placeholder');

                $(targetSelector).val('').trigger('change');
                if($(previewSelector).length) {
                    $(previewSelector).attr('src', '').hide();
                }
                if($(placeholderSelector).length) {
                    $(placeholderSelector).show();
                }
                button.hide();
            });
        });
    ");
}
add_action('admin_enqueue_scripts', 'agri_enqueue_admin_assets');

/**
 * Reusable Media Uploader Field Component
 */
function agri_render_image_uploader_field($field_name, $current_value, $label = 'Image', $default_fallback = '') {
    $img_src = !empty($current_value) ? $current_value : $default_fallback;
    $has_val = !empty($current_value);
    ?>
    <div class="agri-media-field-wrapper" style="display:flex; align-items:flex-start; gap:15px; margin:8px 0;">
        <div style="width:130px; height:85px; border-radius:6px; overflow:hidden; border:1px solid #cbd5e1; background:#f8fafc; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <img id="<?php echo esc_attr($field_name); ?>_preview" 
                 src="<?php echo esc_url($img_src); ?>" 
                 style="width:100%; height:100%; object-fit:cover; display:<?php echo !empty($img_src) ? 'block' : 'none'; ?>;" 
                 alt="Image Preview">
            <span id="<?php echo esc_attr($field_name); ?>_placeholder" style="display:<?php echo empty($img_src) ? 'block' : 'none'; ?>; font-size:11px; color:#94a3b8; text-align:center;">No Image Selected</span>
        </div>
        <div style="flex:1;">
            <input type="text" 
                   id="<?php echo esc_attr($field_name); ?>" 
                   name="<?php echo esc_attr($field_name); ?>" 
                   value="<?php echo esc_attr($current_value); ?>" 
                   class="large-text" 
                   placeholder="https://... or click Choose / Upload Image" 
                   style="margin-bottom:8px;">
            <div style="display:flex; gap:8px; align-items:center;">
                <button type="button" 
                        class="button button-secondary agri-media-upload-btn" 
                        data-target="#<?php echo esc_attr($field_name); ?>" 
                        data-preview="#<?php echo esc_attr($field_name); ?>_preview" 
                        data-placeholder="#<?php echo esc_attr($field_name); ?>_placeholder" 
                        data-remove="#<?php echo esc_attr($field_name); ?>_remove_btn">
                    🖼️ Choose / Upload Image
                </button>
                <button type="button" 
                        id="<?php echo esc_attr($field_name); ?>_remove_btn" 
                        class="button agri-media-remove-btn" 
                        data-target="#<?php echo esc_attr($field_name); ?>" 
                        data-preview="#<?php echo esc_attr($field_name); ?>_preview" 
                        data-placeholder="#<?php echo esc_attr($field_name); ?>_placeholder" 
                        style="color:#b32d2e; border-color:#d63638; display:<?php echo $has_val ? 'inline-block' : 'none'; ?>;">
                    ❌ Remove Image
                </button>
            </div>
            <?php if (!empty($default_fallback)) : ?>
                <p class="description" style="margin-top:5px; font-size:11px; color:#64748b;">
                    Default fallback: <code><?php echo esc_html(basename($default_fallback)); ?></code>
                </p>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

/**
 * 3. Register Custom Post Types for CMS Management
 */
function agri_register_custom_post_types() {
    register_post_type('mandi_rate', array(
        'labels' => array(
            'name'          => __('Mandi Rates', 'agri-marketing'),
            'singular_name' => __('Mandi Rate', 'agri-marketing'),
            'add_new'       => __('Add Commodity Rate', 'agri-marketing'),
            'add_new_item'  => __('Add New Mandi Commodity Rate', 'agri-marketing'),
            'edit_item'     => __('Edit Mandi Rate', 'agri-marketing'),
            'all_items'     => __('All Mandi Rates', 'agri-marketing'),
        ),
        'public'        => true,
        'has_archive'   => false,
        'menu_icon'     => 'dashicons-chart-area',
        'supports'      => array('title'),
        'show_in_rest'  => true,
    ));

    register_post_type('notice_item', array(
        'labels' => array(
            'name'          => __('Notices & Tenders', 'agri-marketing'),
            'singular_name' => __('Notice / Tender', 'agri-marketing'),
            'add_new'       => __('Add Notice / Tender', 'agri-marketing'),
            'add_new_item'  => __('Add New Notice or Tender', 'agri-marketing'),
            'edit_item'     => __('Edit Notice', 'agri-marketing'),
            'all_items'     => __('All Notices & Tenders', 'agri-marketing'),
        ),
        'public'        => true,
        'has_archive'   => false,
        'menu_icon'     => 'dashicons-media-document',
        'supports'      => array('title', 'editor'),
        'show_in_rest'  => true,
    ));

    register_post_type('agri_scheme', array(
        'labels' => array(
            'name'          => __('Govt Schemes', 'agri-marketing'),
            'singular_name' => __('Scheme', 'agri-marketing'),
            'add_new'       => __('Add Scheme', 'agri-marketing'),
            'add_new_item'  => __('Add New Govt Scheme', 'agri-marketing'),
            'edit_item'     => __('Edit Scheme', 'agri-marketing'),
            'all_items'     => __('All Schemes & Subsidies', 'agri-marketing'),
        ),
        'public'        => true,
        'has_archive'   => false,
        'menu_icon'     => 'dashicons-awards',
        'supports'      => array('title', 'editor', 'thumbnail'),
        'show_in_rest'  => true,
    ));

    register_post_type('cold_storage', array(
        'labels' => array(
            'name'          => __('Cold Storages', 'agri-marketing'),
            'singular_name' => __('Cold Storage Unit', 'agri-marketing'),
            'add_new'       => __('Add Cold Storage', 'agri-marketing'),
            'add_new_item'  => __('Add New Cold Storage Facility', 'agri-marketing'),
            'edit_item'     => __('Edit Cold Storage', 'agri-marketing'),
            'all_items'     => __('All Cold Storages', 'agri-marketing'),
        ),
        'public'        => true,
        'has_archive'   => false,
        'menu_icon'     => 'dashicons-building',
        'supports'      => array('title', 'thumbnail'),
        'show_in_rest'  => true,
    ));

    register_post_type('market_produce', array(
        'labels' => array(
            'name'          => __('Farm Connect / Hubs', 'agri-marketing'),
            'singular_name' => __('Produce / Hub', 'agri-marketing'),
            'add_new'       => __('Add Produce / Hub', 'agri-marketing'),
            'add_new_item'  => __('Add New Produce or Retail Hub', 'agri-marketing'),
            'edit_item'     => __('Edit Produce / Hub', 'agri-marketing'),
            'all_items'     => __('All Produce & Hubs', 'agri-marketing'),
        ),
        'public'        => true,
        'has_archive'   => false,
        'menu_icon'     => 'dashicons-cart',
        'supports'      => array('title', 'thumbnail'),
        'show_in_rest'  => true,
    ));

    register_post_type('market_advisory', array(
        'labels' => array(
            'name'          => __('Market Advisories', 'agri-marketing'),
            'singular_name' => __('Market Advisory', 'agri-marketing'),
            'add_new'       => __('Add Advisory', 'agri-marketing'),
            'add_new_item'  => __('Add New Market Advisory', 'agri-marketing'),
            'edit_item'     => __('Edit Advisory', 'agri-marketing'),
            'all_items'     => __('All Market Advisories', 'agri-marketing'),
        ),
        'public'        => true,
        'has_archive'   => false,
        'menu_icon'     => 'dashicons-megaphone',
        'supports'      => array('title', 'editor'),
        'show_in_rest'  => true,
    ));

    register_post_type('citizen_inquiry', array(
        'labels' => array(
            'name'          => __('Citizen Inquiries', 'agri-marketing'),
            'singular_name' => __('Inquiry / Feedback', 'agri-marketing'),
            'add_new'       => __('Add Record', 'agri-marketing'),
            'add_new_item'  => __('Add New Citizen Record', 'agri-marketing'),
            'edit_item'     => __('View / Edit Inquiry', 'agri-marketing'),
            'all_items'     => __('All Citizen Inquiries', 'agri-marketing'),
        ),
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => false,
        'supports'      => array('title', 'editor'),
        'show_in_rest'  => false,
    ));
}
add_action('init', 'agri_register_custom_post_types');

/**
 * 4. Helper Function: Get Post Meta with Default Fallback
 */
function agri_get_meta($post_id, $key, $default = '') {
    $val = get_post_meta($post_id, '_' . $key, true);
    return !empty($val) ? $val : $default;
}

/**
 * 5. Add Custom Meta Boxes to CPTs and Page Templates
 */
function agri_add_custom_meta_boxes() {
    // 5.1 Mandi Rate Details
    add_meta_box(
        'agri_mandi_meta',
        __('📊 Mandi Commodity Rate & Market Details', 'agri-marketing'),
        'agri_render_mandi_meta_box',
        'mandi_rate',
        'normal',
        'high'
    );

    // 5.2 Notice / Tender Metadata
    add_meta_box(
        'agri_notice_meta',
        __('📄 Notice / Document Specification', 'agri-marketing'),
        'agri_render_notice_meta_box',
        'notice_item',
        'normal',
        'high'
    );

    // 5.3 Scheme Details
    add_meta_box(
        'agri_scheme_meta',
        __('🧮 Scheme Eligibility & Subsidy Details', 'agri-marketing'),
        'agri_render_scheme_meta_box',
        'agri_scheme',
        'normal',
        'high'
    );

    // 5.4 Cold Storage Details
    add_meta_box(
        'agri_cold_storage_meta',
        __('❄️ Cold Storage Facility Specification', 'agri-marketing'),
        'agri_render_cold_storage_meta_box',
        'cold_storage',
        'normal',
        'high'
    );

    // 5.5 Produce & Marketplace Details
    add_meta_box(
        'agri_produce_meta',
        __('🌾 Farm Produce & Lot Information', 'agri-marketing'),
        'agri_render_produce_meta_box',
        'market_produce',
        'normal',
        'high'
    );

    // 5.6 Market Advisory Details
    add_meta_box(
        'agri_advisory_meta',
        __('📢 Market Advisory & Alert Data', 'agri-marketing'),
        'agri_render_advisory_meta_box',
        'market_advisory',
        'normal',
        'high'
    );

    // 5.7 Citizen Inquiry Review Box
    add_meta_box(
        'agri_inquiry_meta',
        __('📬 Citizen Inquiry & Grievance Details', 'agri-marketing'),
        'agri_render_inquiry_meta_box',
        'citizen_inquiry',
        'normal',
        'high'
    );

    // 5.8 Page CMS Settings
    add_meta_box(
        'agri_page_cms_meta',
        __('⚙️ Department Portal - Page CMS Content Editor', 'agri-marketing'),
        'agri_render_page_cms_meta_box',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'agri_add_custom_meta_boxes');

// 5.1 Mandi Rate Meta Box HTML
function agri_render_mandi_meta_box($post) {
    wp_nonce_field('agri_save_meta', 'agri_meta_nonce');
    $commodity_bn = get_post_meta($post->ID, '_commodity_bn', true);
    $variety      = get_post_meta($post->ID, '_variety', true);
    $market       = get_post_meta($post->ID, '_market', true);
    $district     = get_post_meta($post->ID, '_district', true);
    $min_price    = get_post_meta($post->ID, '_min_price', true);
    $max_price    = get_post_meta($post->ID, '_max_price', true);
    $modal_price  = get_post_meta($post->ID, '_modal_price', true);
    $trend        = get_post_meta($post->ID, '_trend', true);
    $arrival_date = get_post_meta($post->ID, '_arrival_date', true) ?: date('Y-m-d');
    ?>
    <table class="form-table" style="width:100%;">
        <tr>
            <th><label for="commodity_bn">Bengali Name (বাংলা নাম):</label></th>
            <td><input type="text" id="commodity_bn" name="commodity_bn" value="<?php echo esc_attr($commodity_bn); ?>" class="regular-text" placeholder="e.g. আলু (জ্যোতি)"></td>
        </tr>
        <tr>
            <th><label for="variety">Crop Variety / Grade:</label></th>
            <td><input type="text" id="variety" name="variety" value="<?php echo esc_attr($variety); ?>" class="regular-text" placeholder="e.g. Jyoti / FAQ / Super Fine"></td>
        </tr>
        <tr>
            <th><label for="market">APMC Market / Checkpost:</label></th>
            <td><input type="text" id="market" name="market" value="<?php echo esc_attr($market); ?>" class="regular-text" placeholder="e.g. Hooghly APMC"></td>
        </tr>
        <tr>
            <th><label for="district">District:</label></th>
            <td><input type="text" id="district" name="district" value="<?php echo esc_attr($district); ?>" class="regular-text" placeholder="e.g. Hooghly, Nadia, Burdwan"></td>
        </tr>
        <tr>
            <th><label for="min_price">Minimum Price (₹/Quintal):</label></th>
            <td><input type="number" step="0.01" id="min_price" name="min_price" value="<?php echo esc_attr($min_price); ?>" class="regular-text" placeholder="e.g. 1450"></td>
        </tr>
        <tr>
            <th><label for="max_price">Maximum Price (₹/Quintal):</label></th>
            <td><input type="number" step="0.01" id="max_price" name="max_price" value="<?php echo esc_attr($max_price); ?>" class="regular-text" placeholder="e.g. 1620"></td>
        </tr>
        <tr>
            <th><label for="modal_price">Modal / Prevailing Price (₹/Quintal):</label></th>
            <td><input type="number" step="0.01" id="modal_price" name="modal_price" value="<?php echo esc_attr($modal_price); ?>" class="regular-text" placeholder="e.g. 1540"></td>
        </tr>
        <tr>
            <th><label for="trend">24h Price Trend:</label></th>
            <td><input type="text" id="trend" name="trend" value="<?php echo esc_attr($trend); ?>" class="regular-text" placeholder="e.g. +40 or -20 or 0"></td>
        </tr>
        <tr>
            <th><label for="arrival_date">Arrival Date:</label></th>
            <td><input type="date" id="arrival_date" name="arrival_date" value="<?php echo esc_attr($arrival_date); ?>" class="regular-text"></td>
        </tr>
    </table>
    <?php
}

// 5.2 Notice Meta Box HTML
function agri_render_notice_meta_box($post) {
    wp_nonce_field('agri_save_meta', 'agri_meta_nonce');
    $ref_no       = get_post_meta($post->ID, '_ref_no', true);
    $category     = get_post_meta($post->ID, '_category', true) ?: 'tenders';
    $file_url     = get_post_meta($post->ID, '_file_url', true);
    $file_size    = get_post_meta($post->ID, '_file_size', true);
    $publish_date = get_post_meta($post->ID, '_publish_date', true) ?: date('Y-m-d');
    $is_new       = get_post_meta($post->ID, '_is_new', true);
    ?>
    <table class="form-table" style="width:100%;">
        <tr>
            <th><label for="ref_no">Memo / Ref Number:</label></th>
            <td><input type="text" id="ref_no" name="ref_no" value="<?php echo esc_attr($ref_no); ?>" class="regular-text" placeholder="e.g. WB/AGRI-MKT/NIT-2026/04"></td>
        </tr>
        <tr>
            <th><label for="category">Category Tab:</label></th>
            <td>
                <select id="category" name="category">
                    <option value="tenders" <?php selected($category, 'tenders'); ?>>Tenders & EOIs</option>
                    <option value="bulletins" <?php selected($category, 'bulletins'); ?>>Daily Price Bulletins</option>
                    <option value="circulars" <?php selected($category, 'circulars'); ?>>MSP & Govt Orders</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="file_url">PDF Download URL / File:</label></th>
            <td><input type="text" id="file_url" name="file_url" value="<?php echo esc_attr($file_url); ?>" class="regular-text" placeholder="e.g. # or /wp-content/uploads/notice.pdf"></td>
        </tr>
        <tr>
            <th><label for="file_size">File Size Display:</label></th>
            <td><input type="text" id="file_size" name="file_size" value="<?php echo esc_attr($file_size); ?>" class="regular-text" placeholder="e.g. 1.2 MB"></td>
        </tr>
        <tr>
            <th><label for="publish_date">Notice Date:</label></th>
            <td><input type="date" id="publish_date" name="publish_date" value="<?php echo esc_attr($publish_date); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="is_new">Show 'NEW' Pill Badge:</label></th>
            <td><input type="checkbox" id="is_new" name="is_new" value="1" <?php checked($is_new, '1'); ?>> Highlight this notice as new</td>
        </tr>
    </table>
    <?php
}

// 5.3 Scheme Meta Box HTML
function agri_render_scheme_meta_box($post) {
    wp_nonce_field('agri_save_meta', 'agri_meta_nonce');
    $scheme_code  = get_post_meta($post->ID, '_scheme_code', true);
    $category     = get_post_meta($post->ID, '_category', true) ?: 'infrastructure';
    $subsidy_pct  = get_post_meta($post->ID, '_subsidy_pct', true);
    $max_subsidy  = get_post_meta($post->ID, '_max_subsidy', true);
    $eligibility  = get_post_meta($post->ID, '_eligibility', true);
    $key_benefits = get_post_meta($post->ID, '_key_benefits', true);
    $apply_url    = get_post_meta($post->ID, '_apply_url', true);
    $scheme_image = get_post_meta($post->ID, '_scheme_image', true);
    ?>
    <table class="form-table" style="width:100%;">
        <tr>
            <th><label for="scheme_image">Scheme Showcase Image:</label></th>
            <td>
                <?php agri_render_image_uploader_field('scheme_image', $scheme_image, 'Scheme Image', get_template_directory_uri() . '/images/hero-farmer.jpg'); ?>
            </td>
        </tr>
        <tr>
            <th><label for="scheme_code">Scheme Code / Key:</label></th>
            <td><input type="text" id="scheme_code" name="scheme_code" value="<?php echo esc_attr($scheme_code); ?>" class="regular-text" placeholder="e.g. AFAG, SUFAL, COLD_CHAIN"></td>
        </tr>
        <tr>
            <th><label for="category">Category:</label></th>
            <td>
                <select id="category" name="category">
                    <option value="infrastructure" <?php selected($category, 'infrastructure'); ?>>Infrastructure & Cold Storage</option>
                    <option value="machinery" <?php selected($category, 'machinery'); ?>>Machinery & Transport (Amar Fasal Amar Gari)</option>
                    <option value="retail" <?php selected($category, 'retail'); ?>>Direct Marketing & Sufal Bangla</option>
                    <option value="organic" <?php selected($category, 'organic'); ?>>Organic & Quality Certification</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="subsidy_pct">Subsidy Percentage (%):</label></th>
            <td><input type="number" step="1" id="subsidy_pct" name="subsidy_pct" value="<?php echo esc_attr($subsidy_pct); ?>" class="regular-text" placeholder="e.g. 50"></td>
        </tr>
        <tr>
            <th><label for="max_subsidy">Max Subsidy Cap:</label></th>
            <td><input type="text" id="max_subsidy" name="max_subsidy" value="<?php echo esc_attr($max_subsidy); ?>" class="regular-text" placeholder="e.g. ₹50,00,000 or ₹2.5 Lakh"></td>
        </tr>
        <tr>
            <th><label for="eligibility">Eligibility Summary:</label></th>
            <td><textarea id="eligibility" name="eligibility" rows="3" class="large-text"><?php echo esc_textarea($eligibility); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="key_benefits">Key Benefits (one per line):</label></th>
            <td><textarea id="key_benefits" name="key_benefits" rows="3" class="large-text"><?php echo esc_textarea($key_benefits); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="apply_url">Online Application Link:</label></th>
            <td><input type="text" id="apply_url" name="apply_url" value="<?php echo esc_attr($apply_url); ?>" class="regular-text" placeholder="e.g. https://edistrict.wb.gov.in"></td>
        </tr>
    </table>
    <?php
}

// 5.4 Cold Storage Meta Box HTML
function agri_render_cold_storage_meta_box($post) {
    wp_nonce_field('agri_save_meta', 'agri_meta_nonce');
    $district      = get_post_meta($post->ID, '_district', true);
    $location      = get_post_meta($post->ID, '_location', true);
    $capacity      = get_post_meta($post->ID, '_capacity', true);
    $available     = get_post_meta($post->ID, '_available', true);
    $type          = get_post_meta($post->ID, '_type', true) ?: 'Multi-Commodity';
    $contact       = get_post_meta($post->ID, '_contact', true);
    $status        = get_post_meta($post->ID, '_status', true) ?: 'Available';
    $storage_image = get_post_meta($post->ID, '_storage_image', true);
    ?>
    <table class="form-table" style="width:100%;">
        <tr>
            <th><label for="storage_image">Storage Facility Photo:</label></th>
            <td>
                <?php agri_render_image_uploader_field('storage_image', $storage_image, 'Storage Photo', get_template_directory_uri() . '/images/cold-storage.jpg'); ?>
            </td>
        </tr>
        <tr>
            <th><label for="district">District:</label></th>
            <td><input type="text" id="district" name="district" value="<?php echo esc_attr($district); ?>" class="regular-text" placeholder="e.g. Hooghly, Purba Bardhaman, Nadia"></td>
        </tr>
        <tr>
            <th><label for="location">Location / Block / Address:</label></th>
            <td><input type="text" id="location" name="location" value="<?php echo esc_attr($location); ?>" class="regular-text" placeholder="e.g. Singur, NH-19 Bypass"></td>
        </tr>
        <tr>
            <th><label for="capacity">Total Capacity (MT):</label></th>
            <td><input type="number" id="capacity" name="capacity" value="<?php echo esc_attr($capacity); ?>" class="regular-text" placeholder="e.g. 12000"></td>
        </tr>
        <tr>
            <th><label for="available">Available Space (MT):</label></th>
            <td><input type="number" id="available" name="available" value="<?php echo esc_attr($available); ?>" class="regular-text" placeholder="e.g. 2400"></td>
        </tr>
        <tr>
            <th><label for="type">Storage Chamber Type:</label></th>
            <td><input type="text" id="type" name="type" value="<?php echo esc_attr($type); ?>" class="regular-text" placeholder="e.g. Potato Cold Store / CA Chamber / Multi-Commodity"></td>
        </tr>
        <tr>
            <th><label for="contact">Manager Phone / Contact:</label></th>
            <td><input type="text" id="contact" name="contact" value="<?php echo esc_attr($contact); ?>" class="regular-text" placeholder="e.g. +91 98301 23456"></td>
        </tr>
        <tr>
            <th><label for="status">Booking Status:</label></th>
            <td>
                <select id="status" name="status">
                    <option value="Available" <?php selected($status, 'Available'); ?>>🟢 Available</option>
                    <option value="Filling Fast" <?php selected($status, 'Filling Fast'); ?>>🟡 Filling Fast</option>
                    <option value="Full" <?php selected($status, 'Full'); ?>>🔴 Full</option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

// 5.5 Farm Connect Meta Box HTML
function agri_render_produce_meta_box($post) {
    wp_nonce_field('agri_save_meta', 'agri_meta_nonce');
    $district      = get_post_meta($post->ID, '_district', true);
    $location      = get_post_meta($post->ID, '_location', true);
    $quantity      = get_post_meta($post->ID, '_quantity', true);
    $price         = get_post_meta($post->ID, '_price', true);
    $category      = get_post_meta($post->ID, '_category', true) ?: 'vegetables';
    $contact       = get_post_meta($post->ID, '_contact', true);
    $farmer        = get_post_meta($post->ID, '_farmer', true);
    $grade         = get_post_meta($post->ID, '_grade', true) ?: 'Agmark Grade-A';
    $produce_image = get_post_meta($post->ID, '_produce_image', true);
    ?>
    <table class="form-table" style="width:100%;">
        <tr>
            <th><label for="produce_image">Produce / Crop Photo:</label></th>
            <td>
                <?php agri_render_image_uploader_field('produce_image', $produce_image, 'Produce Photo', get_template_directory_uri() . '/images/hero-farmer.jpg'); ?>
            </td>
        </tr>
        <tr>
            <th><label for="farmer">Farmer / FPO Name:</label></th>
            <td><input type="text" id="farmer" name="farmer" value="<?php echo esc_attr($farmer); ?>" class="regular-text" placeholder="e.g. Subhash Mondal / Ranaghat FPO"></td>
        </tr>
        <tr>
            <th><label for="category">Produce Category:</label></th>
            <td>
                <select id="category" name="category">
                    <option value="vegetables" <?php selected($category, 'vegetables'); ?>>Vegetables</option>
                    <option value="fruits" <?php selected($category, 'fruits'); ?>>Fruits</option>
                    <option value="grains" <?php selected($category, 'grains'); ?>>Grains & Pulses</option>
                    <option value="spices" <?php selected($category, 'spices'); ?>>Spices & Flowers</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="grade">Assay Quality Grade:</label></th>
            <td><input type="text" id="grade" name="grade" value="<?php echo esc_attr($grade); ?>" class="regular-text" placeholder="e.g. Agmark Grade-A / Organic"></td>
        </tr>
        <tr>
            <th><label for="district">District:</label></th>
            <td><input type="text" id="district" name="district" value="<?php echo esc_attr($district); ?>" class="regular-text" placeholder="e.g. Nadia"></td>
        </tr>
        <tr>
            <th><label for="location">Farmer / FPO / Hub Name:</label></th>
            <td><input type="text" id="location" name="location" value="<?php echo esc_attr($location); ?>" class="regular-text" placeholder="e.g. Ranaghat FPO Hub"></td>
        </tr>
        <tr>
            <th><label for="quantity">Available Quantity:</label></th>
            <td><input type="text" id="quantity" name="quantity" value="<?php echo esc_attr($quantity); ?>" class="regular-text" placeholder="e.g. 50 Quintals / 20 Boxes"></td>
        </tr>
        <tr>
            <th><label for="price">Indicative Price:</label></th>
            <td><input type="text" id="price" name="price" value="<?php echo esc_attr($price); ?>" class="regular-text" placeholder="e.g. ₹1,800/Qtl"></td>
        </tr>
        <tr>
            <th><label for="contact">Contact Phone:</label></th>
            <td><input type="text" id="contact" name="contact" value="<?php echo esc_attr($contact); ?>" class="regular-text" placeholder="e.g. +91 98310 99887"></td>
        </tr>
    </table>
    <?php
}

// 5.6 Market Advisory Meta Box HTML
function agri_render_advisory_meta_box($post) {
    wp_nonce_field('agri_save_meta', 'agri_meta_nonce');
    $crop_name  = get_post_meta($post->ID, '_crop_name', true);
    $crop_icon  = get_post_meta($post->ID, '_crop_icon', true) ?: '🌾';
    $urgency    = get_post_meta($post->ID, '_urgency', true) ?: 'normal';
    ?>
    <table class="form-table" style="width:100%;">
        <tr>
            <th><label for="crop_icon">Crop Emoji / Icon:</label></th>
            <td><input type="text" id="crop_icon" name="crop_icon" value="<?php echo esc_attr($crop_icon); ?>" class="small-text" placeholder="🥔"></td>
        </tr>
        <tr>
            <th><label for="crop_name">Crop & Variety Label:</label></th>
            <td><input type="text" id="crop_name" name="crop_name" value="<?php echo esc_attr($crop_name); ?>" class="regular-text" placeholder="e.g. Potato (Jyoti / Chandramukhi)"></td>
        </tr>
        <tr>
            <th><label for="urgency">Advisory Priority:</label></th>
            <td>
                <select id="urgency" name="urgency">
                    <option value="normal" <?php selected($urgency, 'normal'); ?>>Standard Advisory</option>
                    <option value="high" <?php selected($urgency, 'high'); ?>>⚡ Urgent Market Advisory</option>
                </select>
            </td>
        </tr>
    </table>
    <p class="description">Write the detailed crop advisory recommendation in the main post editor above.</p>
    <?php
}

// 5.7 Citizen Inquiry Meta Box HTML
function agri_render_inquiry_meta_box($post) {
    $phone       = get_post_meta($post->ID, '_phone', true);
    $district    = get_post_meta($post->ID, '_district', true);
    $category    = get_post_meta($post->ID, '_category', true);
    $tracking_id = get_post_meta($post->ID, '_tracking_id', true);
    $status      = get_post_meta($post->ID, '_status', true) ?: 'pending';
    ?>
    <table class="form-table" style="width:100%;">
        <tr>
            <th>Tracking ID:</th>
            <td><strong style="color:#2e7d32; font-size:1.1rem;"><?php echo esc_html($tracking_id); ?></strong></td>
        </tr>
        <tr>
            <th>Citizen Phone:</th>
            <td><a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a></td>
        </tr>
        <tr>
            <th>District:</th>
            <td><?php echo esc_html($district); ?></td>
        </tr>
        <tr>
            <th>Category:</th>
            <td><?php echo esc_html(ucwords(str_replace('_', ' ', $category))); ?></td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>
                <select name="inquiry_status">
                    <option value="pending" <?php selected($status, 'pending'); ?>>🟡 Pending Review</option>
                    <option value="in_progress" <?php selected($status, 'in_progress'); ?>>🔵 In Progress</option>
                    <option value="resolved" <?php selected($status, 'resolved'); ?>>🟢 Resolved</option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * 6. Dedicated Context-Aware Page CMS Meta Box with Complete Section Controls
 */
function agri_render_page_cms_meta_box($post) {
    wp_nonce_field('agri_save_meta', 'agri_meta_nonce');
    $template = get_page_template_slug($post->ID);
    $slug = $post->post_name;

    $is_about        = ($template === 'template-about.php' || $slug === 'about' || $slug === 'about-us');
    $is_contact      = ($template === 'template-contact.php' || $slug === 'contact' || $slug === 'contact-us');
    $is_schemes      = ($template === 'template-schemes.php' || $slug === 'schemes' || $slug === 'schemes-subsidies');
    $is_cold_storage = ($template === 'template-cold-storage.php' || $slug === 'cold-storage');
    $is_marketplace  = ($template === 'template-marketplace.php' || $slug === 'marketplace' || $slug === 'farm-connect');
    $is_rates        = ($template === 'template-mandi-rates.php' || $slug === 'mandi-rates' || $slug === 'rates');
    $is_notices      = ($template === 'template-notices.php' || $slug === 'notices' || $slug === 'tenders');
    $is_home         = ($template === 'front-page.php' || $slug === 'home' || $slug === 'front-page');

    $banner_subtitle = get_post_meta($post->ID, '_banner_subtitle', true);
    ?>
    <div style="background:#f8fafc; padding:15px; border-radius:8px; border:1px solid #e2e8f0; margin-bottom:15px;">
        <h4 style="margin-top:0; color:#1e293b;">📋 Banner Header Subtitle</h4>
        <p style="font-size:12px; color:#64748b; margin-top:0;">Custom subtitle displayed beneath the page title on the banner.</p>
        <textarea name="banner_subtitle" rows="2" class="large-text" placeholder="Enter page banner subtitle text..."><?php echo esc_textarea($banner_subtitle); ?></textarea>
    </div>

    <?php if ($is_home) : ?>
        <!-- ==================== HOMEPAGE SECTION ==================== -->
        <div style="background:#fff; border:1px solid #cbd5e1; border-radius:8px; padding:20px; margin-bottom:20px;">
            <h3 style="color:#2e7d32; border-bottom:2px solid #2e7d32; padding-bottom:8px; margin-top:0;">🏠 Homepage Hero & Showcase</h3>
            <table class="form-table">
                <tr>
                    <th scope="row"><label>Hero Showcase Image:</label></th>
                    <td>
                        <?php agri_render_image_uploader_field('hero_image', get_post_meta($post->ID, '_hero_image', true), 'Hero Image', get_template_directory_uri() . '/images/hero-farmer.jpg'); ?>
                    </td>
                </tr>
            </table>
        </div>
    <?php endif; ?>

    <?php if ($is_about || (!$template && !$is_contact && !$is_schemes && !$is_cold_storage && !$is_marketplace && !$is_rates && !$is_notices && !$is_home)) : ?>
        <!-- ==================== ABOUT US SECTION ==================== -->
        <div style="background:#fff; border:1px solid #cbd5e1; border-radius:8px; padding:20px; margin-bottom:20px;">
            <h3 style="color:#2e7d32; border-bottom:2px solid #2e7d32; padding-bottom:8px; margin-top:0;">🏛️ About Us Page Configuration</h3>
            
            <table class="form-table">
                <tr>
                    <th scope="row"><label>Mandate & Vision Showcase Image:</label></th>
                    <td>
                        <?php agri_render_image_uploader_field('about_image', get_post_meta($post->ID, '_about_image', true), 'About Showcase Image', get_template_directory_uri() . '/images/sufal-market.jpg'); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="about_mandate_tag">Mandate Section Tag:</label></th>
                    <td><input type="text" id="about_mandate_tag" name="about_mandate_tag" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_mandate_tag', true)); ?>" class="regular-text" placeholder="🏛️ Department Mandate"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="about_mandate_title">Mandate Section Heading:</label></th>
                    <td><input type="text" id="about_mandate_title" name="about_mandate_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_mandate_title', true)); ?>" class="large-text" placeholder="Empowering Agricultural Trade & Fair Price Realization"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="about_mandate_p1">Mandate Paragraph 1:</label></th>
                    <td><textarea id="about_mandate_p1" name="about_mandate_p1" rows="3" class="large-text"><?php echo esc_textarea(get_post_meta($post->ID, '_about_mandate_p1', true)); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><label for="about_mandate_p2">Mandate Paragraph 2:</label></th>
                    <td><textarea id="about_mandate_p2" name="about_mandate_p2" rows="3" class="large-text"><?php echo esc_textarea(get_post_meta($post->ID, '_about_mandate_p2', true)); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><label for="about_vision_title">Vision Card Title & Text:</label></th>
                    <td>
                        <input type="text" id="about_vision_title" name="about_vision_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_vision_title', true)); ?>" class="regular-text" placeholder="🎯 Vision" style="margin-bottom:6px;"><br>
                        <textarea id="about_vision_desc" name="about_vision_desc" rows="2" class="large-text" placeholder="Vision description..."><?php echo esc_textarea(get_post_meta($post->ID, '_about_vision_desc', true)); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="about_quality_title">Quality Standards Title & Text:</label></th>
                    <td>
                        <input type="text" id="about_quality_title" name="about_quality_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_quality_title', true)); ?>" class="regular-text" placeholder="🛡️ Quality Standards" style="margin-bottom:6px;"><br>
                        <textarea id="about_quality_desc" name="about_quality_desc" rows="2" class="large-text" placeholder="Quality standards description..."><?php echo esc_textarea(get_post_meta($post->ID, '_about_quality_desc', true)); ?></textarea>
                    </td>
                </tr>
            </table>

            <h4 style="color:#1e293b; border-bottom:1px solid #e2e8f0; padding-bottom:6px; margin-top:25px;">📊 Key Impact Metrics Counters (4 Stats)</h4>
            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:15px;">
                <div style="background:#f1f5f9; padding:12px; border-radius:6px;">
                    <strong>Stat 1:</strong><br>
                    <input type="text" name="about_stat1_icon" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_stat1_icon', true)); ?>" placeholder="Icon: 🏢" style="width:100%; margin:4px 0;">
                    <input type="text" name="about_stat1_num" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_stat1_num', true)); ?>" placeholder="Target: 650" style="width:100%; margin:4px 0;">
                    <input type="text" name="about_stat1_suffix" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_stat1_suffix', true)); ?>" placeholder="Suffix: +" style="width:100%; margin:4px 0;">
                    <input type="text" name="about_stat1_label" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_stat1_label', true)); ?>" placeholder="Label: Regulated APMC Mandis" style="width:100%;">
                </div>
                <div style="background:#f1f5f9; padding:12px; border-radius:6px;">
                    <strong>Stat 2:</strong><br>
                    <input type="text" name="about_stat2_icon" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_stat2_icon', true)); ?>" placeholder="Icon: 🌾" style="width:100%; margin:4px 0;">
                    <input type="text" name="about_stat2_num" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_stat2_num', true)); ?>" placeholder="Target: 1.6" style="width:100%; margin:4px 0;">
                    <input type="text" name="about_stat2_suffix" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_stat2_suffix', true)); ?>" placeholder="Suffix: M+" style="width:100%; margin:4px 0;">
                    <input type="text" name="about_stat2_label" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_stat2_label', true)); ?>" placeholder="Label: Registered Farmers" style="width:100%;">
                </div>
                <div style="background:#f1f5f9; padding:12px; border-radius:6px;">
                    <strong>Stat 3:</strong><br>
                    <input type="text" name="about_stat3_icon" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_stat3_icon', true)); ?>" placeholder="Icon: 🛒" style="width:100%; margin:4px 0;">
                    <input type="text" name="about_stat3_num" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_stat3_num', true)); ?>" placeholder="Target: 450" style="width:100%; margin:4px 0;">
                    <input type="text" name="about_stat3_suffix" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_stat3_suffix', true)); ?>" placeholder="Suffix: +" style="width:100%; margin:4px 0;">
                    <input type="text" name="about_stat3_label" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_stat3_label', true)); ?>" placeholder="Label: Sufal Bangla Centers" style="width:100%;">
                </div>
                <div style="background:#f1f5f9; padding:12px; border-radius:6px;">
                    <strong>Stat 4:</strong><br>
                    <input type="text" name="about_stat4_icon" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_stat4_icon', true)); ?>" placeholder="Icon: 🧪" style="width:100%; margin:4px 0;">
                    <input type="text" name="about_stat4_num" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_stat4_num', true)); ?>" placeholder="Target: 100" style="width:100%; margin:4px 0;">
                    <input type="text" name="about_stat4_suffix" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_stat4_suffix', true)); ?>" placeholder="Suffix: %" style="width:100%; margin:4px 0;">
                    <input type="text" name="about_stat4_label" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_stat4_label', true)); ?>" placeholder="Label: Agmark Quality Tested" style="width:100%;">
                </div>
            </div>

            <h4 style="color:#1e293b; border-bottom:1px solid #e2e8f0; padding-bottom:6px; margin-top:25px;">🌟 Core Strategic Pillars Section</h4>
            <table class="form-table" style="margin-bottom:15px;">
                <tr>
                    <th scope="row">Pillars Section Tag:</th>
                    <td><input type="text" name="about_pillars_tag" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_pillars_tag', true)); ?>" class="regular-text" placeholder="🌟 Core Pillars"></td>
                </tr>
                <tr>
                    <th scope="row">Pillars Heading:</th>
                    <td><input type="text" name="about_pillars_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_pillars_title', true)); ?>" class="large-text" placeholder="Strategic Objectives & Key Functions"></td>
                </tr>
                <tr>
                    <th scope="row">Pillars Subtitle:</th>
                    <td><textarea name="about_pillars_subtitle" rows="2" class="large-text" placeholder="Transforming primary agricultural marketing into a resilient, technology-driven ecosystem."><?php echo esc_textarea(get_post_meta($post->ID, '_about_pillars_subtitle', true)); ?></textarea></td>
                </tr>
            </table>

            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:15px;">
                <div style="background:#f8fafc; border:1px solid #e2e8f0; padding:12px; border-radius:6px;">
                    <strong>Pillar 1:</strong>
                    <input type="text" name="about_p1_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_p1_title', true)); ?>" placeholder="Regulated Market Oversight" style="width:100%; margin:4px 0;">
                    <textarea name="about_p1_desc" rows="3" style="width:100%;" placeholder="Pillar 1 description..."><?php echo esc_textarea(get_post_meta($post->ID, '_about_p1_desc', true)); ?></textarea>
                </div>
                <div style="background:#f8fafc; border:1px solid #e2e8f0; padding:12px; border-radius:6px;">
                    <strong>Pillar 2:</strong>
                    <input type="text" name="about_p2_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_p2_title', true)); ?>" placeholder="Direct Retail Outlets" style="width:100%; margin:4px 0;">
                    <textarea name="about_p2_desc" rows="3" style="width:100%;" placeholder="Pillar 2 description..."><?php echo esc_textarea(get_post_meta($post->ID, '_about_p2_desc', true)); ?></textarea>
                </div>
                <div style="background:#f8fafc; border:1px solid #e2e8f0; padding:12px; border-radius:6px;">
                    <strong>Pillar 3:</strong>
                    <input type="text" name="about_p3_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_p3_title', true)); ?>" placeholder="Cold Storage & Logistics" style="width:100%; margin:4px 0;">
                    <textarea name="about_p3_desc" rows="3" style="width:100%;" placeholder="Pillar 3 description..."><?php echo esc_textarea(get_post_meta($post->ID, '_about_p3_desc', true)); ?></textarea>
                </div>
                <div style="background:#f8fafc; border:1px solid #e2e8f0; padding:12px; border-radius:6px;">
                    <strong>Pillar 4:</strong>
                    <input type="text" name="about_p4_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_p4_title', true)); ?>" placeholder="Agmark Certification" style="width:100%; margin:4px 0;">
                    <textarea name="about_p4_desc" rows="3" style="width:100%;" placeholder="Pillar 4 description..."><?php echo esc_textarea(get_post_meta($post->ID, '_about_p4_desc', true)); ?></textarea>
                </div>
            </div>

            <h4 style="color:#1e293b; border-bottom:1px solid #e2e8f0; padding-bottom:6px; margin-top:25px;">📞 Bottom Reach Out Call-To-Action</h4>
            <table class="form-table">
                <tr>
                    <th scope="row">CTA Title:</th>
                    <td><input type="text" name="about_cta_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_cta_title', true)); ?>" class="large-text" placeholder="Need District Office Details or Have an Inquiry?"></td>
                </tr>
                <tr>
                    <th scope="row">CTA Subtitle:</th>
                    <td><textarea name="about_cta_desc" rows="2" class="large-text" placeholder="Access the complete district APMC office directory..."><?php echo esc_textarea(get_post_meta($post->ID, '_about_cta_desc', true)); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row">Button Text & Link:</th>
                    <td>
                        <input type="text" name="about_cta_btn" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_cta_btn', true)); ?>" class="regular-text" placeholder="📞 Go to Contact & Helpdesk Directory →">
                        <input type="text" name="about_cta_url" value="<?php echo esc_attr(get_post_meta($post->ID, '_about_cta_url', true)); ?>" class="regular-text" placeholder="/contact/">
                    </td>
                </tr>
            </table>
        </div>
    <?php endif; ?>

    <?php if ($is_contact) : ?>
        <!-- ==================== CONTACT US SECTION ==================== -->
        <div style="background:#fff; border:1px solid #cbd5e1; border-radius:8px; padding:20px; margin-bottom:20px;">
            <h3 style="color:#2e7d32; border-bottom:2px solid #2e7d32; padding-bottom:8px; margin-top:0;">📍 Contact Page Specific Settings</h3>
            <table class="form-table">
                <tr>
                    <th scope="row">Headquarters Card Title:</th>
                    <td><input type="text" name="contact_hq_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_contact_hq_title', true)); ?>" class="regular-text" placeholder="State Headquarters"></td>
                </tr>
                <tr>
                    <th scope="row">Kisan Desk Card Title:</th>
                    <td><input type="text" name="contact_kisan_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_contact_kisan_title', true)); ?>" class="regular-text" placeholder="Kisan Toll-Free Support Desk"></td>
                </tr>
                <tr>
                    <th scope="row">Kisan Desk Description:</th>
                    <td><textarea name="contact_kisan_desc" rows="2" class="large-text" placeholder="Available 24x7 in Bengali, English, and Hindi..."><?php echo esc_textarea(get_post_meta($post->ID, '_contact_kisan_desc', true)); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row">Regional Offices Card Title:</th>
                    <td><input type="text" name="contact_apmc_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_contact_apmc_title', true)); ?>" class="regular-text" placeholder="Regional APMC Administrative Offices"></td>
                </tr>
                <tr>
                    <th scope="row">Regional APMC Offices Directory:</th>
                    <td>
                        <p class="description">Enter each regional office on a new line in the format: <code>District Name | Yard Address | Phone Number</code></p>
                        <textarea name="contact_apmc_offices" rows="6" class="large-text"><?php echo esc_textarea(get_post_meta($post->ID, '_contact_apmc_offices', true)); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Feedback Form Title:</th>
                    <td><input type="text" name="contact_form_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_contact_form_title', true)); ?>" class="regular-text" placeholder="Citizen Feedback & Inquiries"></td>
                </tr>
                <tr>
                    <th scope="row">Feedback Form Subtitle:</th>
                    <td><textarea name="contact_form_desc" rows="2" class="large-text" placeholder="Submit feedback, rate dispute issues, or general inquiries..."><?php echo esc_textarea(get_post_meta($post->ID, '_contact_form_desc', true)); ?></textarea></td>
                </tr>
            </table>
        </div>
    <?php endif; ?>

    <?php if ($is_schemes) : ?>
        <!-- ==================== SCHEMES WORKFLOW ==================== -->
        <div style="background:#fff; border:1px solid #cbd5e1; border-radius:8px; padding:20px; margin-bottom:20px;">
            <h3 style="color:#2e7d32; border-bottom:2px solid #2e7d32; padding-bottom:8px; margin-top:0;">📑 Schemes & Calculator Configuration</h3>
            
            <h4 style="color:#1e293b; border-bottom:1px solid #e2e8f0; padding-bottom:6px; margin-top:10px;">🖼️ Featured Scheme / Initiative Cards Images</h4>
            <table class="form-table" style="margin-bottom:20px;">
                <tr>
                    <th scope="row"><label>Card 1 Image (Sufal Bangla):</label></th>
                    <td>
                        <?php agri_render_image_uploader_field('scheme_card1_image', get_post_meta($post->ID, '_scheme_card1_image', true), 'Sufal Bangla Image', get_template_directory_uri() . '/images/scheme-sufal-bangla.jpg'); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label>Card 2 Image (Amar Fasal Amar Gari):</label></th>
                    <td>
                        <?php agri_render_image_uploader_field('scheme_card2_image', get_post_meta($post->ID, '_scheme_card2_image', true), 'Amar Fasal Image', get_template_directory_uri() . '/images/scheme-amar-fasal.jpg'); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label>Card 3 Image (Cold Storage Grid):</label></th>
                    <td>
                        <?php agri_render_image_uploader_field('scheme_card3_image', get_post_meta($post->ID, '_scheme_card3_image', true), 'Cold Storage Grid Image', get_template_directory_uri() . '/images/scheme-cold-storage.jpg'); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label>Card 4 Image (AMI Packhouse):</label></th>
                    <td>
                        <?php agri_render_image_uploader_field('scheme_card4_image', get_post_meta($post->ID, '_scheme_card4_image', true), 'AMI Packhouse Image', get_template_directory_uri() . '/images/scheme-ami-packhouse.jpg'); ?>
                    </td>
                </tr>
            </table>

            <table class="form-table">
                <tr>
                    <th scope="row">Calculator Section Tag:</th>
                    <td><input type="text" name="schemes_calc_tag" value="<?php echo esc_attr(get_post_meta($post->ID, '_schemes_calc_tag', true)); ?>" class="regular-text" placeholder="🧮 Interactive Subsidy Tool"></td>
                </tr>
                <tr>
                    <th scope="row">Calculator Section Heading:</th>
                    <td><input type="text" name="schemes_calc_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_schemes_calc_title', true)); ?>" class="large-text" placeholder="Agri-Marketing Subsidy & Scheme Calculator"></td>
                </tr>
                <tr>
                    <th scope="row">Calculator Subtitle:</th>
                    <td><textarea name="schemes_calc_subtitle" rows="2" class="large-text" placeholder="Calculate your estimated government grant eligibility in 3 easy clicks."><?php echo esc_textarea(get_post_meta($post->ID, '_schemes_calc_subtitle', true)); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row">Workflow Section Heading:</th>
                    <td><input type="text" name="schemes_wf_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_schemes_wf_title', true)); ?>" class="large-text" placeholder="How to Apply for Agricultural Subsidies"></td>
                </tr>
                <tr>
                    <th scope="row">Workflow Subtitle:</th>
                    <td><textarea name="schemes_wf_subtitle" rows="2" class="large-text" placeholder="Simplified 4-step digital onboarding process for individual growers and FPOs."><?php echo esc_textarea(get_post_meta($post->ID, '_schemes_wf_subtitle', true)); ?></textarea></td>
                </tr>
            </table>

            <h4 style="color:#1e293b; border-bottom:1px solid #e2e8f0; padding-bottom:6px; margin-top:20px;">4-Step Application Workflow Steps</h4>
            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:15px;">
                <div style="background:#f8fafc; padding:12px; border-radius:6px;">
                    <strong>Step 1:</strong>
                    <input type="text" name="scheme_s1_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_scheme_s1_title', true)); ?>" placeholder="Online Application" style="width:100%; margin:4px 0;">
                    <textarea name="scheme_s1_desc" rows="3" style="width:100%;"><?php echo esc_textarea(get_post_meta($post->ID, '_scheme_s1_desc', true)); ?></textarea>
                </div>
                <div style="background:#f8fafc; padding:12px; border-radius:6px;">
                    <strong>Step 2:</strong>
                    <input type="text" name="scheme_s2_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_scheme_s2_title', true)); ?>" placeholder="Document Verification" style="width:100%; margin:4px 0;">
                    <textarea name="scheme_s2_desc" rows="3" style="width:100%;"><?php echo esc_textarea(get_post_meta($post->ID, '_scheme_s2_desc', true)); ?></textarea>
                </div>
                <div style="background:#f8fafc; padding:12px; border-radius:6px;">
                    <strong>Step 3:</strong>
                    <input type="text" name="scheme_s3_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_scheme_s3_title', true)); ?>" placeholder="Administrative Sanction" style="width:100%; margin:4px 0;">
                    <textarea name="scheme_s3_desc" rows="3" style="width:100%;"><?php echo esc_textarea(get_post_meta($post->ID, '_scheme_s3_desc', true)); ?></textarea>
                </div>
                <div style="background:#f8fafc; padding:12px; border-radius:6px;">
                    <strong>Step 4:</strong>
                    <input type="text" name="scheme_s4_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_scheme_s4_title', true)); ?>" placeholder="Direct Bank Transfer (DBT)" style="width:100%; margin:4px 0;">
                    <textarea name="scheme_s4_desc" rows="3" style="width:100%;"><?php echo esc_textarea(get_post_meta($post->ID, '_scheme_s4_desc', true)); ?></textarea>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($is_cold_storage) : ?>
        <!-- ==================== COLD STORAGE PROTOCOLS ==================== -->
        <div style="background:#fff; border:1px solid #cbd5e1; border-radius:8px; padding:20px; margin-bottom:20px;">
            <h3 style="color:#2e7d32; border-bottom:2px solid #2e7d32; padding-bottom:8px; margin-top:0;">❄️ Recommended Cold Preservation Protocols</h3>
            <table class="form-table">
                <tr>
                    <th scope="row">Protocols Section Heading:</th>
                    <td><input type="text" name="cs_protocols_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_cs_protocols_title', true)); ?>" class="large-text" placeholder="Recommended Cold Preservation Protocols"></td>
                </tr>
                <tr>
                    <th scope="row">Protocols Subtitle:</th>
                    <td><textarea name="cs_protocols_subtitle" rows="2" class="large-text" placeholder="Official state standards for optimum storage life and quality maintenance."><?php echo esc_textarea(get_post_meta($post->ID, '_cs_protocols_subtitle', true)); ?></textarea></td>
                </tr>
            </table>

            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:15px;">
                <div style="background:#f8fafc; padding:12px; border-radius:6px;">
                    <strong>Card 1:</strong>
                    <input type="text" name="cs_p1_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_cs_p1_title', true)); ?>" placeholder="🥔 Potato (Table & Seed)" style="width:100%; margin:4px 0;">
                    <textarea name="cs_p1_desc" rows="3" style="width:100%;"><?php echo esc_textarea(get_post_meta($post->ID, '_cs_p1_desc', true)); ?></textarea>
                </div>
                <div style="background:#f8fafc; padding:12px; border-radius:6px;">
                    <strong>Card 2:</strong>
                    <input type="text" name="cs_p2_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_cs_p2_title', true)); ?>" placeholder="🧅 Onion & Garlic" style="width:100%; margin:4px 0;">
                    <textarea name="cs_p2_desc" rows="3" style="width:100%;"><?php echo esc_textarea(get_post_meta($post->ID, '_cs_p2_desc', true)); ?></textarea>
                </div>
                <div style="background:#f8fafc; padding:12px; border-radius:6px;">
                    <strong>Card 3:</strong>
                    <input type="text" name="cs_p3_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_cs_p3_title', true)); ?>" placeholder="🥭 Fruits & Vegetables" style="width:100%; margin:4px 0;">
                    <textarea name="cs_p3_desc" rows="3" style="width:100%;"><?php echo esc_textarea(get_post_meta($post->ID, '_cs_p3_desc', true)); ?></textarea>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($is_marketplace) : ?>
        <!-- ==================== MARKETPLACE SAFEGUARDS ==================== -->
        <div style="background:#fff; border:1px solid #cbd5e1; border-radius:8px; padding:20px; margin-bottom:20px;">
            <h3 style="color:#2e7d32; border-bottom:2px solid #2e7d32; padding-bottom:8px; margin-top:0;">🛡️ Direct Marketing & Assurance Safeguards</h3>
            <table class="form-table">
                <tr>
                    <th scope="row">Safeguards Section Heading:</th>
                    <td><input type="text" name="mp_safeguards_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_mp_safeguards_title', true)); ?>" class="large-text" placeholder="Direct Marketing & Assurance Safeguards"></td>
                </tr>
                <tr>
                    <th scope="row">Safeguards Subtitle:</th>
                    <td><textarea name="mp_safeguards_subtitle" rows="2" class="large-text" placeholder="How the State Agricultural Marketing Board guarantees secure trade."><?php echo esc_textarea(get_post_meta($post->ID, '_mp_safeguards_subtitle', true)); ?></textarea></td>
                </tr>
            </table>

            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:15px;">
                <div style="background:#f8fafc; padding:12px; border-radius:6px;">
                    <strong>Safeguard 1:</strong>
                    <input type="text" name="mp_s1_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_mp_s1_title', true)); ?>" placeholder="🌿 Quality Assay & Agmark" style="width:100%; margin:4px 0;">
                    <textarea name="mp_s1_desc" rows="3" style="width:100%;"><?php echo esc_textarea(get_post_meta($post->ID, '_mp_s1_desc', true)); ?></textarea>
                </div>
                <div style="background:#f8fafc; padding:12px; border-radius:6px;">
                    <strong>Safeguard 2:</strong>
                    <input type="text" name="mp_s2_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_mp_s2_title', true)); ?>" placeholder="💳 Direct Digital Settlement" style="width:100%; margin:4px 0;">
                    <textarea name="mp_s2_desc" rows="3" style="width:100%;"><?php echo esc_textarea(get_post_meta($post->ID, '_mp_s2_desc', true)); ?></textarea>
                </div>
                <div style="background:#f8fafc; padding:12px; border-radius:6px;">
                    <strong>Safeguard 3:</strong>
                    <input type="text" name="mp_s3_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_mp_s3_title', true)); ?>" placeholder="🚛 Logistics & Weighing" style="width:100%; margin:4px 0;">
                    <textarea name="mp_s3_desc" rows="3" style="width:100%;"><?php echo esc_textarea(get_post_meta($post->ID, '_mp_s3_desc', true)); ?></textarea>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($is_rates) : ?>
        <!-- ==================== MANDI RATES GUIDANCE ==================== -->
        <div style="background:#fff; border:1px solid #cbd5e1; border-radius:8px; padding:20px; margin-bottom:20px;">
            <h3 style="color:#2e7d32; border-bottom:2px solid #2e7d32; padding-bottom:8px; margin-top:0;">📊 Market Advisory & Rate Guidelines</h3>
            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:15px;">
                <div style="background:#f8fafc; padding:12px; border-radius:6px;">
                    <strong>Guide 1:</strong>
                    <input type="text" name="rate_g1_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_rate_g1_title', true)); ?>" placeholder="Daily Modal Rate Formula" style="width:100%; margin:4px 0;">
                    <textarea name="rate_g1_desc" rows="3" style="width:100%;"><?php echo esc_textarea(get_post_meta($post->ID, '_rate_g1_desc', true)); ?></textarea>
                </div>
                <div style="background:#f8fafc; padding:12px; border-radius:6px;">
                    <strong>Guide 2:</strong>
                    <input type="text" name="rate_g2_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_rate_g2_title', true)); ?>" placeholder="Transparent Electronic Auctions" style="width:100%; margin:4px 0;">
                    <textarea name="rate_g2_desc" rows="3" style="width:100%;"><?php echo esc_textarea(get_post_meta($post->ID, '_rate_g2_desc', true)); ?></textarea>
                </div>
                <div style="background:#f8fafc; padding:12px; border-radius:6px;">
                    <strong>Guide 3:</strong>
                    <input type="text" name="rate_g3_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_rate_g3_title', true)); ?>" placeholder="Grievance Redressal & Support" style="width:100%; margin:4px 0;">
                    <textarea name="rate_g3_desc" rows="3" style="width:100%;"><?php echo esc_textarea(get_post_meta($post->ID, '_rate_g3_desc', true)); ?></textarea>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php
}

/**
 * 7. Save All Post & Page Meta Data
 */
function agri_save_post_meta($post_id) {
    if (!isset($_POST['agri_meta_nonce']) || !wp_verify_nonce($_POST['agri_meta_nonce'], 'agri_save_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = array(
        // CPT fields
        'commodity_bn', 'variety', 'market', 'district', 'min_price', 'max_price', 'modal_price', 'trend', 'arrival_date',
        'ref_no', 'category', 'file_url', 'file_size', 'publish_date', 'is_new',
        'scheme_code', 'subsidy_pct', 'max_subsidy', 'eligibility', 'key_benefits', 'apply_url', 'scheme_image',
        'location', 'capacity', 'available', 'type', 'contact', 'status', 'quantity', 'price', 'farmer', 'grade',
        'crop_name', 'crop_icon', 'urgency', 'inquiry_status', 'storage_image', 'produce_image',

        // Page CMS fields
        'banner_subtitle', 'hero_image', 'about_image',
        'scheme_card1_image', 'scheme_card2_image', 'scheme_card3_image',
        'about_mandate_tag', 'about_mandate_title', 'about_mandate_p1', 'about_mandate_p2',
        'about_vision_title', 'about_vision_desc', 'about_quality_title', 'about_quality_desc',
        'about_stat1_icon', 'about_stat1_num', 'about_stat1_suffix', 'about_stat1_label',
        'about_stat2_icon', 'about_stat2_num', 'about_stat2_suffix', 'about_stat2_label',
        'about_stat3_icon', 'about_stat3_num', 'about_stat3_suffix', 'about_stat3_label',
        'about_stat4_icon', 'about_stat4_num', 'about_stat4_suffix', 'about_stat4_label',
        'about_pillars_tag', 'about_pillars_title', 'about_pillars_subtitle',
        'about_p1_title', 'about_p1_desc', 'about_p2_title', 'about_p2_desc',
        'about_p3_title', 'about_p3_desc', 'about_p4_title', 'about_p4_desc',
        'about_cta_title', 'about_cta_desc', 'about_cta_btn', 'about_cta_url',
        'contact_hq_title', 'contact_kisan_title', 'contact_kisan_desc', 'contact_apmc_title',
        'contact_form_title', 'contact_form_desc', 'contact_hours', 'contact_apmc_offices',
        'schemes_calc_tag', 'schemes_calc_title', 'schemes_calc_subtitle', 'schemes_wf_title', 'schemes_wf_subtitle',
        'scheme_s1_title', 'scheme_s1_desc', 'scheme_s2_title', 'scheme_s2_desc',
        'scheme_s3_title', 'scheme_s3_desc', 'scheme_s4_title', 'scheme_s4_desc',
        'cs_protocols_title', 'cs_protocols_subtitle',
        'cs_p1_title', 'cs_p1_desc', 'cs_p2_title', 'cs_p2_desc', 'cs_p3_title', 'cs_p3_desc',
        'mp_safeguards_title', 'mp_safeguards_subtitle',
        'mp_s1_title', 'mp_s1_desc', 'mp_s2_title', 'mp_s2_desc', 'mp_s3_title', 'mp_s3_desc',
        'rate_g1_title', 'rate_g1_desc', 'rate_g2_title', 'rate_g2_desc', 'rate_g3_title', 'rate_g3_desc'
    );

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            if (in_array($field, array('about_mandate_p1', 'about_mandate_p2', 'about_vision_desc', 'about_quality_desc', 'about_pillars_subtitle', 'about_p1_desc', 'about_p2_desc', 'about_p3_desc', 'about_p4_desc', 'about_cta_desc', 'contact_kisan_desc', 'contact_apmc_offices', 'contact_form_desc', 'schemes_calc_subtitle', 'schemes_wf_subtitle', 'scheme_s1_desc', 'scheme_s2_desc', 'scheme_s3_desc', 'scheme_s4_desc', 'cs_protocols_subtitle', 'cs_p1_desc', 'cs_p2_desc', 'cs_p3_desc', 'mp_safeguards_subtitle', 'mp_s1_desc', 'mp_s2_desc', 'mp_s3_desc', 'rate_g1_desc', 'rate_g2_desc', 'rate_g3_desc', 'eligibility', 'key_benefits', 'banner_subtitle'))) {
                update_post_meta($post_id, '_' . $field, sanitize_textarea_field($_POST[$field]));
            } elseif (in_array($field, array('hero_image', 'about_image', 'scheme_card1_image', 'scheme_card2_image', 'scheme_card3_image', 'scheme_image', 'storage_image', 'produce_image', 'file_url', 'apply_url', 'about_cta_url'))) {
                update_post_meta($post_id, '_' . $field, esc_url_raw($_POST[$field]));
            } else {
                update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
            }
        }
    }
}
add_action('save_post', 'agri_save_post_meta');

/**
 * 8. Unified Department Portal Settings Page in WP Admin
 */
function agri_register_theme_settings_page() {
    add_menu_page(
        __('Department Portal Hub', 'agri-marketing'),
        __('Portal Hub & CMS', 'agri-marketing'),
        'manage_options',
        'agri-portal-settings',
        'agri_render_theme_settings_page',
        'dashicons-admin-site-alt3',
        25
    );
}
add_action('admin_menu', 'agri_register_theme_settings_page');

function agri_register_settings() {
    register_setting('agri_settings_group', 'agri_logo_image');
    register_setting('agri_settings_group', 'agri_helpline');
    register_setting('agri_settings_group', 'agri_alt_helpline');
    register_setting('agri_settings_group', 'agri_email');
    register_setting('agri_settings_group', 'agri_address');
    register_setting('agri_settings_group', 'agri_office_hours');

    register_setting('agri_settings_group', 'agri_hero_image');
    register_setting('agri_settings_group', 'agri_hero_badge');
    register_setting('agri_settings_group', 'agri_hero_title');
    register_setting('agri_settings_group', 'agri_hero_desc');
    register_setting('agri_settings_group', 'agri_stat_farmers');
    register_setting('agri_settings_group', 'agri_stat_mandis');
    register_setting('agri_settings_group', 'agri_stat_cold_storage');
    register_setting('agri_settings_group', 'agri_stat_subsidy');
}
add_action('admin_init', 'agri_register_settings');

function agri_render_theme_settings_page() {
    $active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'general';
    ?>
    <div class="wrap" style="max-width:1100px;">
        <h1 style="display:flex; align-items:center; gap:10px; font-weight:700;">
            🌾 Agricultural Marketing Department - CMS Portal Hub
        </h1>
        <p style="color:#64748b; font-size:14px; margin-bottom:20px;">
            Central management dashboard for department portal configuration, contact directories, and citizen inquiries.
        </p>

        <!-- Navigation Tabs -->
        <h2 class="nav-tab-wrapper" style="margin-bottom:20px;">
            <a href="?page=agri-portal-settings&tab=general" class="nav-tab <?php echo $active_tab === 'general' ? 'nav-tab-active' : ''; ?>">📞 General & Helpline</a>
            <a href="?page=agri-portal-settings&tab=home" class="nav-tab <?php echo $active_tab === 'home' ? 'nav-tab-active' : ''; ?>">🏠 Homepage Hero & Stats</a>
            <a href="?page=agri-portal-settings&tab=inquiries" class="nav-tab <?php echo $active_tab === 'inquiries' ? 'nav-tab-active' : ''; ?>">📬 Citizen Inquiries & Feedback</a>
        </h2>

        <?php if ($active_tab === 'general') : ?>
            <form method="post" action="options.php" style="background:#fff; padding:25px; border-radius:8px; border:1px solid #ccd0d4;">
                <?php
                settings_fields('agri_settings_group');
                do_settings_sections('agri_settings_group');
                ?>
                <h3 style="border-bottom:2px solid #2e7d32; padding-bottom:8px; color:#2e7d32; margin-top:0;">🏛️ Department Branding & Insignia</h3>
                <table class="form-table" style="margin-bottom:20px;">
                    <tr>
                        <th scope="row">Department Brand Logo:</th>
                        <td>
                            <?php agri_render_image_uploader_field('agri_logo_image', get_option('agri_logo_image'), 'Portal Logo', get_template_directory_uri() . '/images/Logo.png'); ?>
                        </td>
                    </tr>
                </table>

                <h3 style="border-bottom:2px solid #2e7d32; padding-bottom:8px; color:#2e7d32; margin-top:0;">📞 State Helpline & Contact Information</h3>
                <table class="form-table">
                    <tr>
                        <th scope="row">Farmer Toll-Free Helpline:</th>
                        <td><input type="text" name="agri_helpline" value="<?php echo esc_attr(get_option('agri_helpline', '1800-180-1551')); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row">Emergency / Control Room:</th>
                        <td><input type="text" name="agri_alt_helpline" value="<?php echo esc_attr(get_option('agri_alt_helpline', '033-2225-8888')); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row">Department Email:</th>
                        <td><input type="email" name="agri_email" value="<?php echo esc_attr(get_option('agri_email', 'agrimarketing-wb@nic.in')); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row">Head Office Address:</th>
                        <td><textarea name="agri_address" rows="3" class="large-text"><?php echo esc_textarea(get_option('agri_address', 'Khadyashree Bhavan, 11A Mirza Ghalib Street, Block-A, 4th Floor, Kolkata - 700087')); ?></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row">Office Working Hours:</th>
                        <td><input type="text" name="agri_office_hours" value="<?php echo esc_attr(get_option('agri_office_hours', 'Monday – Friday (10:00 AM – 5:30 PM)')); ?>" class="regular-text" /></td>
                    </tr>
                </table>
                <?php submit_button(__('Save Contact Settings', 'agri-marketing')); ?>
            </form>

        <?php elseif ($active_tab === 'home') : ?>
            <form method="post" action="options.php" style="background:#fff; padding:25px; border-radius:8px; border:1px solid #ccd0d4;">
                <?php
                settings_fields('agri_settings_group');
                do_settings_sections('agri_settings_group');
                ?>
                <h3 style="border-bottom:2px solid #2e7d32; padding-bottom:8px; color:#2e7d32; margin-top:0;">🏠 Homepage Hero Showcase</h3>
                <table class="form-table">
                    <tr>
                        <th scope="row">Hero Showcase Image:</th>
                        <td>
                            <?php agri_render_image_uploader_field('agri_hero_image', get_option('agri_hero_image'), 'Hero Image', get_template_directory_uri() . '/images/hero-farmer.jpg'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Hero Pill Badge:</th>
                        <td><input type="text" name="agri_hero_badge" value="<?php echo esc_attr(get_option('agri_hero_badge', 'Agricultural Price Discovery & Market Intelligence')); ?>" class="large-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row">Hero Headline:</th>
                        <td><input type="text" name="agri_hero_title" value="<?php echo esc_attr(get_option('agri_hero_title', 'Empowering Farmers with Fair Prices & Smart Markets')); ?>" class="large-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row">Hero Subtitle:</th>
                        <td><textarea name="agri_hero_desc" rows="3" class="large-text"><?php echo esc_textarea(get_option('agri_hero_desc', 'Connecting 1.6M+ farmers directly with regulated mandis, Sufal Bangla retail hubs, modern cold chains, and transparent electronic trading across the state.')); ?></textarea></td>
                    </tr>
                </table>

                <h3 style="border-bottom:2px solid #2e7d32; padding-bottom:8px; color:#2e7d32; margin-top:30px;">📊 Statistics Ribbon Counters</h3>
                <table class="form-table">
                    <tr>
                        <th scope="row">Regulated APMC Mandis:</th>
                        <td><input type="text" name="agri_stat_mandis" value="<?php echo esc_attr(get_option('agri_stat_mandis', '650+')); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row">Registered Farmers:</th>
                        <td><input type="text" name="agri_stat_farmers" value="<?php echo esc_attr(get_option('agri_stat_farmers', '1.6M+')); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row">Cold Storage Outlets / Grid:</th>
                        <td><input type="text" name="agri_stat_cold_storage" value="<?php echo esc_attr(get_option('agri_stat_cold_storage', '480+')); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row">Subsidies Disbursed:</th>
                        <td><input type="text" name="agri_stat_subsidy" value="<?php echo esc_attr(get_option('agri_stat_subsidy', '₹1,250 Cr')); ?>" class="regular-text" /></td>
                    </tr>
                </table>
                <?php submit_button(__('Save Homepage Settings', 'agri-marketing')); ?>
            </form>

        <?php elseif ($active_tab === 'inquiries') : ?>
            <div style="background:#fff; padding:25px; border-radius:8px; border:1px solid #ccd0d4;">
                <h3 style="border-bottom:2px solid #2e7d32; padding-bottom:8px; color:#2e7d32; margin-top:0;">📬 Citizen Inquiries & Grievances Received</h3>
                
                <?php
                $inquiries = get_posts(array(
                    'post_type'      => 'citizen_inquiry',
                    'posts_per_page' => 20,
                    'post_status'    => 'any'
                ));

                if (!empty($inquiries)) :
                ?>
                    <table class="wp-list-table widefat fixed striped">
                        <thead>
                            <tr>
                                <th style="width:130px;">Tracking ID</th>
                                <th style="width:160px;">Citizen Name</th>
                                <th style="width:120px;">Mobile Phone</th>
                                <th style="width:110px;">District</th>
                                <th style="width:140px;">Category</th>
                                <th>Message / Feedback</th>
                                <th style="width:120px;">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($inquiries as $inq) : 
                                $tid = get_post_meta($inq->ID, '_tracking_id', true);
                                $phone = get_post_meta($inq->ID, '_phone', true);
                                $district = get_post_meta($inq->ID, '_district', true);
                                $cat = get_post_meta($inq->ID, '_category', true);
                            ?>
                                <tr>
                                    <td><strong style="color:#2e7d32;"><?php echo esc_html($tid ?: 'AGRI-' . $inq->ID); ?></strong></td>
                                    <td><strong><?php echo esc_html($inq->post_title); ?></strong></td>
                                    <td><a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a></td>
                                    <td><?php echo esc_html($district); ?></td>
                                    <td><?php echo esc_html(ucwords(str_replace('_', ' ', $cat))); ?></td>
                                    <td><?php echo esc_html(wp_trim_words($inq->post_content, 20)); ?></td>
                                    <td><?php echo esc_html(get_the_date('d M Y, h:i A', $inq->ID)); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p style="color:#64748b; font-size:14px; padding:20px; text-align:center; background:#f8fafc; border-radius:6px;">
                        No citizen inquiries received yet. Submissions through the Contact Us form will appear here with SMS tracking IDs.
                    </p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * 9. Dynamic Data Aggregator
 */
function agri_get_cms_data() {
    // 9.1 Mandi Rates
    $mandi_rates = array();
    $rates_query = new WP_Query(array('post_type' => 'mandi_rate', 'posts_per_page' => -1, 'post_status' => 'publish'));
    if ($rates_query->have_posts()) {
        while ($rates_query->have_posts()) {
            $rates_query->the_post();
            $id = get_the_ID();
            $min_val = (int)get_post_meta($id, '_min_price', true);
            $max_val = (int)get_post_meta($id, '_max_price', true);
            $modal_val = (int)get_post_meta($id, '_modal_price', true);
            $mandi_rates[] = array(
                'id'            => $id,
                'nameEn'        => get_the_title(),
                'nameBn'        => get_post_meta($id, '_commodity_bn', true) ?: get_the_title(),
                'nameHi'        => get_post_meta($id, '_commodity_hi', true) ?: get_the_title(),
                'category'      => get_post_meta($id, '_category', true) ?: 'veg',
                'icon'          => get_post_meta($id, '_icon', true) ?: '🌾',
                'mandi'         => get_post_meta($id, '_market', true) ?: 'Central Mandi',
                'district'      => get_post_meta($id, '_district', true) ?: 'Kolkata',
                'min'           => $min_val,
                'max'           => $max_val,
                'modal'         => $modal_val,
                'trend'         => get_post_meta($id, '_trend_val', true) ?: '+20',
                'trendType'     => get_post_meta($id, '_trend', true) ?: 'up',
                'history'       => array($min_val, $min_val + 20, $modal_val - 10, $modal_val, $modal_val + 10, $modal_val - 5, $modal_val)
            );
        }
        wp_reset_postdata();
    }
    if (empty($mandi_rates)) {
        $json_file = AGRI_THEME_DIR . '/data/mandi-rates.json';
        if (file_exists($json_file)) {
            $mandi_rates = json_decode(file_get_contents($json_file), true);
        }
    }

    // 9.2 Cold Storage
    $cold_storage = array();
    $cs_query = new WP_Query(array('post_type' => 'cold_storage', 'posts_per_page' => -1, 'post_status' => 'publish'));
    if ($cs_query->have_posts()) {
        while ($cs_query->have_posts()) {
            $cs_query->the_post();
            $id = get_the_ID();
            $cold_storage[] = array(
                'id'         => $id,
                'name'       => get_the_title(),
                'district'   => get_post_meta($id, '_district', true),
                'location'   => get_post_meta($id, '_location', true),
                'capacity'   => (int)get_post_meta($id, '_capacity', true),
                'available'  => (int)get_post_meta($id, '_available', true),
                'temp'       => get_post_meta($id, '_type', true) ?: '2°C - 4°C (Potato / Veg)',
                'phone'      => get_post_meta($id, '_contact', true),
                'status'     => strtolower(get_post_meta($id, '_status', true) ?: 'available'),
                'image'      => get_post_meta($id, '_storage_image', true) ?: (get_the_post_thumbnail_url($id, 'medium') ?: (AGRI_THEME_URI . '/images/cold-storage.jpg')),
                'address'    => get_post_meta($id, '_location', true) ?: ''
            );
        }
        wp_reset_postdata();
    }
    if (empty($cold_storage)) {
        $json_file = AGRI_THEME_DIR . '/data/cold-storage.json';
        if (file_exists($json_file)) {
            $cold_storage = json_decode(file_get_contents($json_file), true);
        }
    }

    // 9.3 Marketplace / Produce
    $marketplace = array();
    $market_query = new WP_Query(array('post_type' => 'market_produce', 'posts_per_page' => -1, 'post_status' => 'publish'));
    if ($market_query->have_posts()) {
        while ($market_query->have_posts()) {
            $market_query->the_post();
            $id = get_the_ID();
            $marketplace[] = array(
                'id'          => $id,
                'crop'        => get_the_title(),
                'icon'        => '🌾',
                'farmer'      => get_post_meta($id, '_farmer', true) ?: 'Local Farmer',
                'location'    => get_post_meta($id, '_location', true),
                'qty'         => get_post_meta($id, '_quantity', true),
                'price'       => get_post_meta($id, '_price', true),
                'grade'       => get_post_meta($id, '_grade', true) ?: 'Agmark Grade-A',
                'image'       => get_post_meta($id, '_produce_image', true) ?: (get_the_post_thumbnail_url($id, 'medium') ?: (AGRI_THEME_URI . '/images/hero-farmer.jpg')),
                'harvestDate' => date('M Y'),
                'contact'     => get_post_meta($id, '_contact', true)
            );
        }
        wp_reset_postdata();
    }
    if (empty($marketplace)) {
        $json_file = AGRI_THEME_DIR . '/data/marketplace.json';
        if (file_exists($json_file)) {
            $marketplace = json_decode(file_get_contents($json_file), true);
        }
    }

    // 9.4 Notices
    $notices = array();
    $notice_query = new WP_Query(array('post_type' => 'notice_item', 'posts_per_page' => -1, 'post_status' => 'publish'));
    if ($notice_query->have_posts()) {
        $tenders = array();
        $bulletins = array();
        $circulars = array();
        while ($notice_query->have_posts()) {
            $notice_query->the_post();
            $id = get_the_ID();
            $cat = get_post_meta($id, '_category', true) ?: 'tenders';
            $p_date = get_post_meta($id, '_publish_date', true) ?: get_the_date('Y-m-d');
            $timestamp = strtotime($p_date);
            $item = array(
                'id'       => (string)$id,
                'title'    => get_the_title(),
                'ref'      => get_post_meta($id, '_ref_no', true),
                'day'      => date('d', $timestamp),
                'month'    => date('M', $timestamp),
                'fileSize' => get_post_meta($id, '_file_size', true) ?: '1.2 MB',
                'lastDate' => date('d M Y', strtotime('+15 days', $timestamp)),
                'file_url' => get_post_meta($id, '_file_url', true) ?: '#'
            );
            if ($cat === 'bulletins') {
                $bulletins[] = $item;
            } elseif ($cat === 'circulars') {
                $circulars[] = $item;
            } else {
                $tenders[] = $item;
            }
        }
        wp_reset_postdata();
        $notices = array('tenders' => $tenders, 'bulletins' => $bulletins, 'circulars' => $circulars);
    }
    if (empty($notices)) {
        $json_file = AGRI_THEME_DIR . '/data/notices.json';
        if (file_exists($json_file)) {
            $notices = json_decode(file_get_contents($json_file), true);
        }
    }

    // 9.5 Schemes
    $schemes = array();
    $scheme_query = new WP_Query(array('post_type' => 'agri_scheme', 'posts_per_page' => -1, 'post_status' => 'publish'));
    if ($scheme_query->have_posts()) {
        while ($scheme_query->have_posts()) {
            $scheme_query->the_post();
            $id = get_the_ID();
            $title_l = strtolower(get_the_title());
            $default_img = AGRI_THEME_URI . '/images/scheme-amar-fasal.jpg';
            if (strpos($title_l, 'amar fasal') !== false || strpos($title_l, 'gari') !== false) {
                $default_img = AGRI_THEME_URI . '/images/scheme-amar-fasal.jpg';
            } elseif (strpos($title_l, 'sufal') !== false || strpos($title_l, 'retail') !== false) {
                $default_img = AGRI_THEME_URI . '/images/scheme-sufal-bangla.jpg';
            } elseif (strpos($title_l, 'cold') !== false || strpos($title_l, 'storage') !== false || strpos($title_l, 'warehous') !== false) {
                $default_img = AGRI_THEME_URI . '/images/scheme-cold-storage.jpg';
            } elseif (strpos($title_l, 'ami') !== false || strpos($title_l, 'packhouse') !== false || strpos($title_l, 'infra') !== false) {
                $default_img = AGRI_THEME_URI . '/images/scheme-ami-packhouse.jpg';
            }

            $s_img = get_post_meta($id, '_scheme_image', true);
            if (empty($s_img) || strpos($s_img, 'hero-farmer') !== false || strpos($s_img, 'banner-schemes') !== false) {
                $s_img = get_the_post_thumbnail_url($id, 'large') ?: $default_img;
            }

            $schemes[] = array(
                'id'          => get_post_meta($id, '_scheme_code', true) ?: ('scheme_' . $id),
                'titleEn'     => get_the_title(),
                'titleBn'     => get_post_meta($id, '_title_bn', true) ?: get_the_title(),
                'titleHi'     => get_post_meta($id, '_title_hi', true) ?: get_the_title(),
                'badge'       => (get_post_meta($id, '_subsidy_pct', true) ? get_post_meta($id, '_subsidy_pct', true) . '% Subsidy' : 'Subsidy Scheme'),
                'image'       => $s_img,
                'descEn'      => get_the_content() ?: 'Government financial and technical assistance scheme.',
                'descBn'      => get_post_meta($id, '_desc_bn', true) ?: get_the_content(),
                'descHi'      => get_post_meta($id, '_desc_hi', true) ?: get_the_content(),
                'features'    => explode("\n", str_replace("\r", "", get_post_meta($id, '_key_benefits', true))),
                'maxSubsidy'  => get_post_meta($id, '_max_subsidy', true) ?: '₹1.5 Lakhs',
                'target'      => get_post_meta($id, '_eligibility', true) ?: 'Farmers & SHGs'
            );
        }
        wp_reset_postdata();
    }
    if (empty($schemes)) {
        $json_file = AGRI_THEME_DIR . '/data/schemes.json';
        if (file_exists($json_file)) {
            $schemes = json_decode(file_get_contents($json_file), true);
        }
    }

    // 9.6 Advisories
    $advisories = array();
    $adv_query = new WP_Query(array('post_type' => 'market_advisory', 'posts_per_page' => 10, 'post_status' => 'publish'));
    if ($adv_query->have_posts()) {
        while ($adv_query->have_posts()) {
            $adv_query->the_post();
            $id = get_the_ID();
            $advisories[] = array(
                'id'       => $id,
                'title'    => get_the_title(),
                'crop'     => get_post_meta($id, '_crop_name', true) ?: get_the_title(),
                'icon'     => get_post_meta($id, '_crop_icon', true) ?: '🌾',
                'text'     => get_the_content(),
                'urgency'  => get_post_meta($id, '_urgency', true) ?: 'normal',
                'date'     => get_the_date('d M Y')
            );
        }
        wp_reset_postdata();
    }

    // 9.7 Translations
    $translations = array();
    $trans_file = AGRI_THEME_DIR . '/data/translations.json';
    if (file_exists($trans_file)) {
        $translations = json_decode(file_get_contents($trans_file), true);
    }

    // 9.8 Department Settings
    $settings = array(
        'logo_image'        => get_option('agri_logo_image', AGRI_THEME_URI . '/images/Logo.png'),
        'hero_image'        => get_option('agri_hero_image', AGRI_THEME_URI . '/images/hero-farmer.jpg'),
        'helpline'          => get_option('agri_helpline', '1800-180-1551'),
        'alt_helpline'      => get_option('agri_alt_helpline', '033-2225-8888'),
        'email'             => get_option('agri_email', 'agrimarketing-wb@nic.in'),
        'address'           => get_option('agri_address', 'Khadyashree Bhavan, 11A Mirza Ghalib Street, Block-A, 4th Floor, Kolkata - 700087'),
        'office_hours'      => get_option('agri_office_hours', 'Monday – Friday (10:00 AM – 5:30 PM)'),
        'hero_badge'        => get_option('agri_hero_badge', 'Agricultural Price Discovery & Market Intelligence'),
        'hero_title'        => get_option('agri_hero_title', 'Empowering Farmers with Fair Prices & Smart Markets'),
        'hero_desc'         => get_option('agri_hero_desc', 'Connecting 1.6M+ farmers directly with regulated mandis, Sufal Bangla retail hubs, modern cold chains, and transparent electronic trading across the state.'),
        'stat_farmers'      => get_option('agri_stat_farmers', '1.6M+'),
        'stat_mandis'       => get_option('agri_stat_mandis', '650+'),
        'stat_cold_storage' => get_option('agri_stat_cold_storage', '480+'),
        'stat_subsidy'      => get_option('agri_stat_subsidy', '₹1,250 Cr')
    );

    return array(
        'mandiRates'   => $mandi_rates,
        'coldStorage'  => $cold_storage,
        'marketplace'  => $marketplace,
        'notices'      => $notices,
        'schemes'      => $schemes,
        'advisories'   => $advisories,
        'translations' => $translations,
        'settings'     => $settings
    );
}

/**
 * 10. REST API Endpoints for Front-End Fetching & Citizen Forms
 */
function agri_register_rest_routes() {
    register_rest_route('agri/v1', '/data', array(
        'methods'             => 'GET',
        'callback'            => 'agri_get_cms_data_rest',
        'permission_callback' => '__return_true'
    ));

    register_rest_route('agri/v1', '/inquiry', array(
        'methods'             => 'POST',
        'callback'            => 'agri_handle_citizen_inquiry_rest',
        'permission_callback' => '__return_true'
    ));

    register_rest_route('agri/v1', '/booking', array(
        'methods'             => 'POST',
        'callback'            => 'agri_handle_storage_booking_rest',
        'permission_callback' => '__return_true'
    ));

    register_rest_route('agri/v1', '/bid', array(
        'methods'             => 'POST',
        'callback'            => 'agri_handle_produce_bid_rest',
        'permission_callback' => '__return_true'
    ));
}
add_action('rest_api_init', 'agri_register_rest_routes');

function agri_get_cms_data_rest() {
    return rest_ensure_response(agri_get_cms_data());
}

function agri_handle_citizen_inquiry_rest($request) {
    $params = $request->get_json_params() ?: $request->get_params();

    $name     = sanitize_text_field($params['name'] ?? '');
    $phone    = sanitize_text_field($params['phone'] ?? '');
    $district = sanitize_text_field($params['district'] ?? '');
    $category = sanitize_text_field($params['category'] ?? 'general');
    $message  = sanitize_textarea_field($params['message'] ?? '');

    if (empty($name) || empty($phone)) {
        return new WP_Error('missing_fields', 'Name and phone number are required.', array('status' => 400));
    }

    $tracking_id = 'WB-AGRI-' . date('Y') . '-' . strtoupper(wp_generate_password(5, false));

    $post_id = wp_insert_post(array(
        'post_title'   => $name . ' (' . $district . ')',
        'post_content' => $message,
        'post_type'    => 'citizen_inquiry',
        'post_status'  => 'publish'
    ));

    if (is_wp_error($post_id)) {
        return new WP_Error('db_error', 'Could not save inquiry.', array('status' => 500));
    }

    update_post_meta($post_id, '_phone', $phone);
    update_post_meta($post_id, '_district', $district);
    update_post_meta($post_id, '_category', $category);
    update_post_meta($post_id, '_tracking_id', $tracking_id);
    update_post_meta($post_id, '_status', 'pending');

    return rest_ensure_response(array(
        'success'    => true,
        'trackingId' => $tracking_id,
        'message'    => 'Your inquiry has been registered successfully. Tracking ID: ' . $tracking_id
    ));
}

function agri_handle_storage_booking_rest($request) {
    $params = $request->get_json_params() ?: $request->get_params();
    $name = sanitize_text_field($params['name'] ?? '');
    $phone = sanitize_text_field($params['phone'] ?? '');
    $facility = sanitize_text_field($params['facility'] ?? 'Cold Storage Facility');
    $details = sanitize_text_field($params['details'] ?? '');

    $tracking_id = 'CS-SLOT-' . date('Y') . '-' . strtoupper(wp_generate_password(4, false));

    wp_insert_post(array(
        'post_title'   => 'Storage Booking: ' . $name . ' - ' . $facility,
        'post_content' => "Farmer/FPO: $name\nPhone: $phone\nFacility: $facility\nDetails: $details\nTracking ID: $tracking_id",
        'post_type'    => 'citizen_inquiry',
        'post_status'  => 'publish'
    ));

    return rest_ensure_response(array(
        'success'    => true,
        'trackingId' => $tracking_id,
        'message'    => 'Storage reservation request sent. Ref ID: ' . $tracking_id
    ));
}

function agri_handle_produce_bid_rest($request) {
    $params = $request->get_json_params() ?: $request->get_params();
    $buyer = sanitize_text_field($params['buyer_name'] ?? '');
    $phone = sanitize_text_field($params['phone'] ?? '');
    $bid_price = sanitize_text_field($params['bid_price'] ?? '');
    $crop = sanitize_text_field($params['crop'] ?? 'Produce');

    $tracking_id = 'BID-' . date('Y') . '-' . strtoupper(wp_generate_password(4, false));

    wp_insert_post(array(
        'post_title'   => 'Produce Bid: ' . $buyer . ' for ' . $crop,
        'post_content' => "Buyer: $buyer\nPhone: $phone\nCrop: $crop\nBid Price: $bid_price\nTracking ID: $tracking_id",
        'post_type'    => 'citizen_inquiry',
        'post_status'  => 'publish'
    ));

    return rest_ensure_response(array(
        'success'    => true,
        'trackingId' => $tracking_id,
        'message'    => 'Purchase quote submitted successfully to the seller. Ref ID: ' . $tracking_id
    ));
}

/**
 * Auto-create required benchmark pages if not already existing
 */
function agri_create_default_pages() {
    $pages = array(
        'ebijak-ledger' => array(
            'title'    => 'e-Bijak & Digital Ledgers',
            'template' => 'template-ebijak.php',
            'content'  => 'e-Bijak digital invoicing and commission agent ledger engine.'
        ),
        'logistics-freight' => array(
            'title'    => 'Logistics & Freight Transport',
            'template' => 'template-logistics.php',
            'content'  => 'Agri-freight transport estimator and WDRA-accredited warehouse directory.'
        )
    );

    foreach ($pages as $slug => $data) {
        $existing = get_page_by_path($slug);
        if (!$existing) {
            $page_id = wp_insert_post(array(
                'post_title'   => $data['title'],
                'post_name'    => $slug,
                'post_content' => $data['content'],
                'post_status'  => 'publish',
                'post_type'    => 'page'
            ));
            if ($page_id && !empty($data['template'])) {
                update_post_meta($page_id, '_wp_page_template', $data['template']);
            }
        }
    }
}
add_action('after_switch_theme', 'agri_create_default_pages');

/**
 * 15. Creative Inner Page Banner Renderer with Visual Media & Floating Chips
 */
function agri_render_inner_banner($args = array()) {
    $theme_uri = get_template_directory_uri();
    
    // Auto-fix any relative or missing theme uri paths in image arg
    if (!empty($args['image']) && is_string($args['image'])) {
        if (strpos($args['image'], 'http://') === false && strpos($args['image'], 'https://') === false) {
            $img_clean = ltrim($args['image'], '.');
            $img_clean = ltrim($img_clean, '/');
            if (strpos($img_clean, 'images/') === 0) {
                $args['image'] = $theme_uri . '/' . $img_clean;
            } else {
                $args['image'] = $theme_uri . '/images/' . $img_clean;
            }
        }
    }

    $defaults = array(
        'title'        => get_the_title(),
        'subtitle'     => '',
        'tag'          => '🏛️ State AgriTech Portal',
        'image'        => $theme_uri . '/images/banner-default.jpg',
        'badge_label'  => 'Official Portal Service',
        'badge_val'    => 'Active & Verified',
        'i18n_title'   => '',
        'i18n_sub'     => '',
        'i18n_crumb'   => '',
        'meta_pills'   => array(
            '⚡ AGMARKNET 2.0 Live',
            '🛡️ Directorate Verified',
            '📞 Helpline: 1800-180-1551'
        )
    );
    
    $params = wp_parse_args($args, $defaults);
    
    // Check if custom hero/banner image was uploaded on page meta
    $meta_img = get_post_meta(get_the_ID(), '_hero_image', true);
    if (!empty($meta_img)) {
        $params['image'] = $meta_img;
    } elseif (has_post_thumbnail()) {
        $params['image'] = get_the_post_thumbnail_url(null, 'full');
    }
    
    ?>
    <section class="page-banner">
        <div class="banner-ambient-glow"></div>
        <div class="container">
            <div class="page-banner-grid">
                <div class="page-banner-content">
                    <div class="page-banner-badge">
                        <span class="pulse-dot"></span>
                        <span><?php echo esc_html($params['tag']); ?></span>
                    </div>

                    <div class="breadcrumb">
                        <a href="<?php echo esc_url(home_url('/')); ?>" data-i18n="nav_home">Home</a>
                        <span class="separator">/</span>
                        <span class="current" <?php echo !empty($params['i18n_crumb']) ? 'data-i18n="' . esc_attr($params['i18n_crumb']) . '"' : (!empty($params['i18n_title']) ? 'data-i18n="' . esc_attr($params['i18n_title']) . '"' : ''); ?>><?php echo esc_html($params['title']); ?></span>
                    </div>

                    <h1 class="page-banner-title" <?php echo !empty($params['i18n_title']) ? 'data-i18n="' . esc_attr($params['i18n_title']) . '"' : ''; ?>>
                        <?php echo esc_html($params['title']); ?>
                    </h1>

                    <?php if (!empty($params['subtitle'])) : ?>
                        <p class="page-banner-desc" <?php echo !empty($params['i18n_sub']) ? 'data-i18n="' . esc_attr($params['i18n_sub']) . '"' : ''; ?>>
                            <?php echo esc_html($params['subtitle']); ?>
                        </p>
                    <?php endif; ?>

                    <?php if (!empty($params['meta_pills']) && is_array($params['meta_pills'])) : ?>
                        <div class="page-banner-meta-pills">
                            <?php foreach ($params['meta_pills'] as $pill) : ?>
                                <span class="meta-pill"><?php echo esc_html($pill); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="page-banner-visual">
                    <div class="banner-image-frame">
                        <img src="<?php echo esc_url($params['image']); ?>" alt="<?php echo esc_attr($params['title']); ?>" class="banner-main-img">
                        <div class="banner-floating-chip">
                            <span class="chip-icon">✨</span>
                            <div>
                                <div class="chip-label"><?php echo esc_html($params['badge_label']); ?></div>
                                <div class="chip-val"><?php echo esc_html($params['badge_val']); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
