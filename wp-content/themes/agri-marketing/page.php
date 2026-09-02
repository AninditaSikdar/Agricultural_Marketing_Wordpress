<?php
/**
 * The template for displaying all standard pages
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
        </div>
    </div>
</section>

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
