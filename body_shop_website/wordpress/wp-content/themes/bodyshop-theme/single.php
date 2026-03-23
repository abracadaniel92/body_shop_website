<?php get_header(); ?>

<section>
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article>
                <h1><?php the_title(); ?></h1>
                <p class="meta">Published on <?php echo esc_html(get_the_date()); ?></p>
                <div class="post-thumb">
                    <?php if (has_post_thumbnail()) : the_post_thumbnail('large'); endif; ?>
                </div>
                <?php the_content(); ?>
            </article>
        <?php endwhile; endif; ?>
    </div>
</section>

<?php get_footer(); ?>
