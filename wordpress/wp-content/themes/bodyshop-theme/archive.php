<?php get_header(); ?>

<section>
    <div class="container">
        <h1><?php single_post_title(); ?></h1>
        <?php if (have_posts()) : ?>
            <div class="grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="card">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p class="meta"><?php echo esc_html(get_the_date()); ?></p>
                        <div class="post-thumb">
                            <?php if (has_post_thumbnail()) : the_post_thumbnail('medium'); endif; ?>
                        </div>
                        <?php the_excerpt(); ?>
                    </article>
                <?php endwhile; ?>
            </div>
            <div>
                <?php the_posts_pagination(); ?>
            </div>
        <?php else : ?>
            <p>No posts available.</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
