<?php
/**
 * The template for displaying pages
 * 
 * @package Astra Child - YoungDevInterns
 */

get_header();
?>

<style>
    .page-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .page-header {
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 30px;
        border-bottom: 3px solid var(--primary-color);
    }

    .page-title {
        font-size: 3rem;
        color: var(--heading-color);
        margin-bottom: 15px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .page-featured-image {
        margin-bottom: 40px;
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-xl);
    }

    .page-featured-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    .page-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--text-color);
    }

    .page-content h2 {
        font-size: 2rem;
        color: var(--heading-color);
        margin-top: 2.5rem;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--border-color);
    }

    .page-content h3 {
        font-size: 1.5rem;
        color: var(--heading-color);
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .page-content p {
        margin-bottom: 1.5rem;
    }

    .page-content ul,
    .page-content ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }

    .page-content li {
        margin-bottom: 0.5rem;
    }

    .page-content img {
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        margin: 2rem 0;
    }

    .page-content blockquote {
        border-left: 4px solid var(--primary-color);
        padding-left: 20px;
        margin: 2rem 0;
        font-style: italic;
        color: var(--text-light);
        background: var(--bg-light);
        padding: 20px;
        border-radius: var(--radius-sm);
    }

    .page-content a {
        color: var(--primary-color);
        text-decoration: underline;
        font-weight: 500;
    }

    .page-content a:hover {
        color: var(--primary-dark);
    }

    .page-footer {
        margin-top: 50px;
        padding-top: 30px;
        border-top: 2px solid var(--border-color);
        text-align: center;
        color: var(--text-light);
    }

    .page-meta {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
        font-size: 0.9rem;
    }

    .page-meta span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .page-content {
            font-size: 1rem;
        }
    }
</style>

<div class="page-container">
    <?php
    while (have_posts()):
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="page-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </header>

            <?php if (has_post_thumbnail()): ?>
                <div class="page-featured-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="page-content">
                <?php the_content(); ?>
            </div>

            <footer class="page-footer">
                <div class="page-meta">
                    <span>📅 Last Updated: <?php echo get_the_modified_date(); ?></span>
                    <span>👤 By <?php the_author(); ?></span>
                </div>
            </footer>
        </article>

        <?php
        // Comments (if enabled for pages)
        if (comments_open() || get_comments_number()):
            comments_template();
        endif;
        ?>

    <?php endwhile; ?>
</div>

<?php get_footer(); ?>