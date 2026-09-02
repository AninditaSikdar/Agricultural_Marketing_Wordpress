<?php
/**
 * The template for displaying all standard pages
 *
 * @package AgriMarketing
 */
get_header();
$theme_uri = get_template_directory_uri();
?>

<?php
agri_render_inner_banner(array(
    'title'       => get_the_title(),
    'subtitle'    => get_the_excerpt() ?: 'State Agricultural Marketing Department official resource and documentation portal.',
    'tag'         => '🏛️ State Agricultural Portal',
    'image'       => $theme_uri . '/images/banner-default.jpg',
    'badge_label' => 'Official Portal Service',
    'badge_val'   => 'Active & Verified',
    'meta_pills'  => array('⚡ Verified Service', '🛡️ Directorate of Agricultural Marketing', '📞 1800-180-1551')
));
?>

<section class="section">
    <div class="container">
        <div class="content-container" style="background:var(--bg-surface); padding:2.5rem; border-radius:var(--radius-xl); border:1px solid var(--border-color); box-shadow:var(--shadow-sm); line-height:1.8;">
            <?php
            while (have_posts()) :
                the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</section>

<?php
get_footer();
