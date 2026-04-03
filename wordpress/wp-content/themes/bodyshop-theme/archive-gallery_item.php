<?php get_header(); ?>

<section>
    <div class="container">
        <h1>Before & After Gallery</h1>
        <p class="meta">Browse completed repair transformations.</p>

        <?php if (have_posts()) : ?>
            <div class="grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="card">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <?php
                        $before_image_id = get_post_meta(get_the_ID(), '_before_image_id', true);
                        $after_image_id = get_post_meta(get_the_ID(), '_after_image_id', true);
                        $before_url = $before_image_id ? wp_get_attachment_image_url($before_image_id, 'large') : '';
                        $after_url = $after_image_id ? wp_get_attachment_image_url($after_image_id, 'large') : '';
                        ?>
                        <div class="gallery-pair">
                            <div>
                                <p><strong>Before</strong></p>
                                <?php if ($before_url) : ?>
                                    <img src="<?php echo esc_url($before_url); ?>" alt="Before image">
                                <?php else : ?>
                                    <p class="meta">Before image not uploaded.</p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <p><strong>After</strong></p>
                                <?php if ($after_url) : ?>
                                    <img src="<?php echo esc_url($after_url); ?>" alt="After image">
                                <?php else : ?>
                                    <p class="meta">After image not uploaded.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p>No gallery items yet.</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
