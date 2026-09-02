<?php
/**
 * The Header for Agricultural Marketing Department Theme
 *
 * @package AgriMarketing
 */
$helpline = get_option('agri_helpline', '1800-180-1551');
$theme_uri = get_template_directory_uri();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="light">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Agricultural Marketing Department - Official Website for Real-Time Mandi Rates, Sufal Bangla Outlets, Cold Storage Network, Subsidies & Marketing Services.">
    <meta name="keywords" content="Agricultural Marketing Department, Mandi Rates, Agriculture, Sufal Bangla, Amar Fasal Amar Gari, APMC, Cold Storage, Krishak Bandhu, Agri Marketing">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Top Accessibility & Utility Bar -->
<aside class="top-util-bar" aria-label="Accessibility & Quick Utility Bar">
    <div class="container top-util-container">
        <div class="util-left">
            <span class="helpline-pill">
                <span class="pulse-dot"></span>
                <span data-i18n="farmer_helpline">Farmer Helpline (Toll-Free):</span>
                <strong><?php echo esc_html($helpline); ?></strong>
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
        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-section" aria-label="Agricultural Marketing Department">
            <div class="brand-emblem-wrapper">
                <?php 
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<img src="' . esc_url($theme_uri . '/images/Logo.png') . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="brand-logo-img">';
                }
                ?>
            </div>
        </a>

        <nav class="nav-menu" id="navMenu" aria-label="Main Navigation">
            <div class="nav-item"><a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link" data-i18n="nav_home">Home</a></div>
            <div class="nav-item"><a href="<?php echo esc_url(home_url('/mandi-rates/')); ?>" class="nav-link"><span data-i18n="nav_rates">Mandi Rates</span></a></div>
            <div class="nav-item"><a href="<?php echo esc_url(home_url('/schemes/')); ?>" class="nav-link" data-i18n="nav_schemes">Schemes & Subsidies</a></div>
            <div class="nav-item"><a href="<?php echo esc_url(home_url('/cold-storage/')); ?>" class="nav-link" data-i18n="nav_cold_storage">Cold Storages</a></div>
            <div class="nav-item"><a href="<?php echo esc_url(home_url('/marketplace/')); ?>" class="nav-link" data-i18n="nav_marketplace">Farm Connect</a></div>
            <div class="nav-item"><a href="<?php echo esc_url(home_url('/about/')); ?>" class="nav-link" data-i18n="nav_about">About Us</a></div>
            <div class="nav-item"><a href="<?php echo esc_url(home_url('/notices/')); ?>" class="nav-link" data-i18n="nav_tenders">Tenders & Notices</a></div>
            <div class="nav-item"><a href="<?php echo esc_url(home_url('/contact/')); ?>" class="nav-link" data-i18n="nav_contact">Contact Us</a></div>
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
</div>
