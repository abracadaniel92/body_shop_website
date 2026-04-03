<?php
/*
Template Name: Gallery Landing
*/
get_header();
?>

<section>
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <p class="meta">This page can be used as gallery intro text managed by admin.</p>
        <p><a class="btn" href="<?php echo esc_url(get_post_type_archive_link('gallery_item')); ?>">Open Before/After Gallery</a></p>
        <?php
        while (have_posts()) {
            the_post();
            the_content();
        }
        ?>
    </div>
</section>

<?php get_footer(); ?>
