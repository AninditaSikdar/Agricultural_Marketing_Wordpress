<?php
/**
 * The main template file
 *
 * @package AgriMarketing
 */
get_header();
?>

<section class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <h1 class="page-banner-title"><?php bloginfo('name'); ?></h1>
            <p class="page-banner-desc"><?php bloginfo('description'); ?></p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="workflow-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('workflow-step-card'); ?>>
                        <h2 class="step-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="step-desc"><?php the_excerpt(); ?></div>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <div style="background:var(--bg-surface); padding:2rem; border-radius:var(--radius-lg); text-align:center;">
                <p>No content found.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
get_footer();
