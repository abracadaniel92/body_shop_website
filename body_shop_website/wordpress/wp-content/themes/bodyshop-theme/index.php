<?php get_header(); ?>

<section>
    <div class="container">
        <h1>Latest Content</h1>
        <?php if (have_posts()) : ?>
            <div class="grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="card">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p class="meta"><?php echo esc_html(get_the_date()); ?></p>
                        <?php the_excerpt(); ?>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p>No content found.</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
