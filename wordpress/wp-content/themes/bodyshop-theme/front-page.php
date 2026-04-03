<?php get_header(); ?>

<section class="hero">
    <div class="container">
        <h1><?php echo esc_html(get_bloginfo('name')); ?> Body & Paint Experts</h1>
        <p>Collision repair, refinishing, detailing, and restoration with trusted craftsmanship.</p>
        <a href="#contact" class="btn">Get a Quote</a>
    </div>
</section>

<section id="services">
    <div class="container">
        <h2>Our Services</h2>
        <div class="grid">
            <article class="card">
                <h3>Collision Repair</h3>
                <p>Frame and panel repair to restore factory standards.</p>
            </article>
            <article class="card">
                <h3>Paint & Refinish</h3>
                <p>Color matching and premium paint finish for long-term durability.</p>
            </article>
            <article class="card">
                <h3>Dent Removal</h3>
                <p>Efficient dent correction and panel restoration services.</p>
            </article>
            <article class="card">
                <h3>Detailing</h3>
                <p>Interior and exterior detailing to keep your vehicle showroom-ready.</p>
            </article>
        </div>
    </div>
</section>

<section class="section-dark">
    <div class="container">
        <h2>Recent Transformations</h2>
        <p class="meta">Visit the gallery for full before/after project history.</p>
        <a class="btn" href="<?php echo esc_url(get_post_type_archive_link('gallery_item')); ?>">View Gallery</a>
    </div>
</section>

<section id="contact">
    <div class="container">
        <h2>Contact Us</h2>
        <p>Phone: (000) 000-0000</p>
        <p>Email: info@example.com</p>
        <p>Address: 123 Repair Lane, Your City</p>
    </div>
</section>

<?php get_footer(); ?>
