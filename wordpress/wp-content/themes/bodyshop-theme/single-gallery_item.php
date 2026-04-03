<?php get_header(); ?>

<section>
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article>
                <h1><?php the_title(); ?></h1>
                <?php
                $before_image_id = get_post_meta(get_the_ID(), '_before_image_id', true);
                $after_image_id = get_post_meta(get_the_ID(), '_after_image_id', true);
                $service_type = get_post_meta(get_the_ID(), '_service_type', true);
                $vehicle_info = get_post_meta(get_the_ID(), '_vehicle_info', true);
                $before_url = $before_image_id ? wp_get_attachment_image_url($before_image_id, 'large') : '';
                $after_url = $after_image_id ? wp_get_attachment_image_url($after_image_id, 'large') : '';
                ?>

                <p class="meta">
                    <?php if ($service_type) : ?>Service: <?php echo esc_html($service_type); ?><?php endif; ?>
                    <?php if ($vehicle_info) : ?> | Vehicle: <?php echo esc_html($vehicle_info); ?><?php endif; ?>
                </p>

                <div class="gallery-pair">
                    <div>
                        <p><strong>Before</strong></p>
                        <?php if ($before_url) : ?>
                            <img src="<?php echo esc_url($before_url); ?>" alt="Before image">
                        <?php endif; ?>
                    </div>
                    <div>
                        <p><strong>After</strong></p>
                        <?php if ($after_url) : ?>
                            <img src="<?php echo esc_url($after_url); ?>" alt="After image">
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
</section>

<?php get_footer(); ?>
