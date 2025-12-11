<?php
/**
 * Template Name: Full Width Page
 * Description: A full-width page template without sidebar
 * 
 * @package Astra Child - YoungDevInterns
 */

get_header();
?>

<style>
    .fullwidth-container {
        max-width: 100%;
        margin: 0;
        padding: 0;
    }

    .fullwidth-hero {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: #fff;
        padding: 80px 20px;
        text-align: center;
    }

    .fullwidth-hero-title {
        font-size: 3.5rem;
        margin-bottom: 20px;
        color: #fff;
    }

    .fullwidth-hero-subtitle {
        font-size: 1.3rem;
        opacity: 0.9;
        max-width: 700px;
        margin: 0 auto;
    }

    .fullwidth-content {
        max-width: 1400px;
        margin: 60px auto;
        padding: 0 40px;
    }

    .fullwidth-content-inner {
        font-size: 1.1rem;
        line-height: 1.8;
    }

    .fullwidth-section {
        margin-bottom: 60px;
    }

    .fullwidth-section h2 {
        font-size: 2.5rem;
        text-align: center;
        margin-bottom: 40px;
        color: var(--heading-color);
    }

    .fullwidth-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin: 40px 0;
    }

    .fullwidth-card {
        background: #fff;
        padding: 30px;
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
    }

    .fullwidth-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .fullwidth-card h3 {
        color: var(--primary-color);
        margin-bottom: 15px;
    }

    .fullwidth-cta {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: #fff;
        padding: 60px 20px;
        text-align: center;
        margin-top: 60px;
    }

    .fullwidth-cta h2 {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: #fff;
    }

    .fullwidth-cta p {
        font-size: 1.2rem;
        margin-bottom: 30px;
        opacity: 0.9;
    }

    .fullwidth-cta-button {
        background: #fff;
        color: var(--primary-color);
        padding: 15px 40px;
        border-radius: var(--radius-md);
        text-decoration: none;
        font-weight: 700;
        font-size: 1.1rem;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .fullwidth-cta-button:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-xl);
        text-decoration: none;
        color: var(--primary-color);
    }

    @media (max-width: 768px) {
        .fullwidth-hero-title {
            font-size: 2.5rem;
        }

        .fullwidth-content {
            padding: 0 20px;
        }

        .fullwidth-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="fullwidth-container">
    <?php
    while (have_posts()):
        the_post();
        ?>
        <!-- Hero Section -->
        <div class="fullwidth-hero">
            <h1 class="fullwidth-hero-title"><?php the_title(); ?></h1>
            <?php if (has_excerpt()): ?>
                <p class="fullwidth-hero-subtitle"><?php the_excerpt(); ?></p>
            <?php endif; ?>
        </div>

        <!-- Main Content -->
        <div class="fullwidth-content">
            <div class="fullwidth-content-inner">
                <?php the_content(); ?>
            </div>
        </div>

        <!-- Call to Action Section (Optional) -->
        <div class="fullwidth-cta">
            <h2>Ready to Get Started?</h2>
            <p>Join us today and take your skills to the next level!</p>
            <a href="#contact" class="fullwidth-cta-button">Contact Us →</a>
        </div>

    <?php endwhile; ?>
</div>

<?php get_footer(); ?>