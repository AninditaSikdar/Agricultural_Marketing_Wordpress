<?php
/**
 * The template for displaying all single posts & custom post types
 *
 * @package AgriMarketing
 */
get_header();
?>

<section class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <div class="breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>" data-i18n="nav_home">Home</a>
                <span class="separator">/</span>
                <span class="current"><?php the_title(); ?></span>
            </div>
            <h1 class="page-banner-title"><?php the_title(); ?></h1>
            <div style="margin-top:0.5rem; font-size:0.88rem; opacity:0.85;">
                Published: <?php echo get_the_date('d M Y'); ?>
            </div>
        </div>
    </div>
</section>

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
