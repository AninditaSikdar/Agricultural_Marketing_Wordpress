<?php
/**
 * The template for displaying all single posts & custom post types
 *
 * @package AgriMarketing
 */
get_header();
?>

<?php
agri_render_inner_banner(array(
    'title'       => get_the_title(),
    'subtitle'    => 'Published: ' . get_the_date('d F Y'),
    'tag'         => '🏛️ Official Publication & Notice',
    'image'       => has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'large') : ($theme_uri . '/images/banner-notices.jpg'),
    'badge_label' => 'Government Circular',
    'badge_val'   => 'Official Release',
    'meta_pills'  => array('📅 ' . get_the_date('d M Y'), '🏛️ Directorate Verified')
));
?>

<section class="section">
    <div class="container">
        <div class="content-container" style="background:var(--bg-surface); padding:2.5rem; border-radius:var(--radius-xl); border:1px solid var(--border-color); box-shadow:var(--shadow-sm); line-height:1.8; max-width:900px; margin:0 auto;">
            <?php
            while (have_posts()) :
                the_post();
                if (has_post_thumbnail()) {
                    echo '<div style="margin-bottom:1.5rem; border-radius:var(--radius-lg); overflow:hidden;">';
                    the_post_thumbnail('large', array('style' => 'width:100%; height:auto; display:block;'));
                    echo '</div>';
                }
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</section>

<?php
get_footer();
