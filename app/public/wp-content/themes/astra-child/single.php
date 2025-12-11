<?php
/**
 * The template for displaying single posts
 * 
 * @package Astra Child - YoungDevInterns
 */

get_header();
?>

<style>
    .single-post-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .single-post-header {
        margin-bottom: 30px;
    }

    .single-post-title {
        font-size: 2.5rem;
        color: var(--heading-color);
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .single-post-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        padding: 15px 0;
        border-top: 2px solid var(--border-color);
        border-bottom: 2px solid var(--border-color);
        margin-bottom: 30px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--text-light);
        font-size: 0.95rem;
    }

    .meta-item svg {
        width: 18px;
        height: 18px;
        fill: var(--primary-color);
    }

    .meta-item a {
        color: var(--text-light);
        text-decoration: none;
    }

    .meta-item a:hover {
        color: var(--primary-color);
    }

    .single-featured-image {
        margin-bottom: 40px;
        border-radius: var(--radius-md);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .single-featured-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    .single-post-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--text-color);
    }

    .single-post-content h2,
    .single-post-content h3,
    .single-post-content h4 {
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .single-post-content p {
        margin-bottom: 1.5rem;
    }

    .single-post-content img {
        border-radius: var(--radius-md);
        margin: 2rem 0;
    }

    .single-post-footer {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 2px solid var(--border-color);
    }

    .post-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }

    .post-tags span {
        font-weight: 600;
        color: var(--heading-color);
        margin-right: 10px;
    }

    .post-tags a {
        background: var(--bg-light);
        color: var(--text-color);
        padding: 5px 15px;
        border-radius: 20px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .post-tags a:hover {
        background: var(--primary-color);
        color: #fff;
    }

    .post-navigation {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin: 25px 0;
    }

    .nav-link {
        padding: 15px;
        background: var(--bg-light);
        border-radius: var(--radius-md);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        background: var(--primary-color);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .nav-link span {
        display: block;
        font-size: 0.8rem;
        opacity: 0.7;
        margin-bottom: 5px;
    }

    .nav-link strong {
        display: block;
        font-size: 0.95rem;
    }

    .author-box {
        background: var(--bg-light);
        padding: 20px;
        border-radius: var(--radius-md);
        margin: 25px 0;
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .author-avatar {
        flex-shrink: 0;
    }

    .author-avatar img {
        border-radius: 50%;
        width: 60px;
        height: 60px;
    }

    .author-info h3 {
        margin: 0 0 5px 0;
        color: var(--heading-color);
        font-size: 1.1rem;
    }

    .author-info p {
        margin: 0;
        color: var(--text-light);
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .single-post-title {
            font-size: 2rem;
        }

        .post-navigation {
            grid-template-columns: 1fr;
        }

        .author-box {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<div class="single-post-container">
    <?php
    while (have_posts()):
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="single-post-header">
                <h1 class="single-post-title"><?php the_title(); ?></h1>

                <div class="single-post-meta">
                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10z" />
                        </svg>
                        <time datetime="<?php echo get_the_date('c'); ?>">
                            <?php echo get_the_date(); ?>
                        </time>
                    </div>

                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                        <span>By <?php the_author_posts_link(); ?></span>
                    </div>

                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                        <span><?php the_category(', '); ?></span>
                    </div>

                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z" />
                        </svg>
                        <a href="#comments"><?php comments_number('0 Comments', '1 Comment', '% Comments'); ?></a>
                    </div>
                </div>
            </header>

            <?php if (has_post_thumbnail()): ?>
                <div class="single-featured-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="single-post-content">
                <?php the_content(); ?>
            </div>

            <footer class="single-post-footer">
                <?php if (has_tag()): ?>
                    <div class="post-tags">
                        <span>Tags:</span>
                        <?php the_tags('', '', ''); ?>
                    </div>
                <?php endif; ?>

                <!-- Author Box -->
                <div class="author-box">
                    <div class="author-avatar">
                        <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                    </div>
                    <div class="author-info">
                        <h3>About <?php the_author(); ?></h3>
                        <p><?php the_author_meta('description') ? the_author_meta('description') : 'WordPress Developer and Content Creator'; ?>
                        </p>
                    </div>
                </div>

                <!-- Post Navigation -->
                <nav class="post-navigation">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>
                    <?php if ($prev_post): ?>
                        <a href="<?php echo get_permalink($prev_post); ?>" class="nav-link">
                            <span>← Previous Post</span>
                            <strong><?php echo get_the_title($prev_post); ?></strong>
                        </a>
                    <?php else: ?>
                        <div></div>
                    <?php endif; ?>

                    <?php if ($next_post): ?>
                        <a href="<?php echo get_permalink($next_post); ?>" class="nav-link" style="text-align: right;">
                            <span>Next Post →</span>
                            <strong><?php echo get_the_title($next_post); ?></strong>
                        </a>
                    <?php endif; ?>
                </nav>
            </footer>
        </article>

        <?php
        // Comments
        if (comments_open() || get_comments_number()):
            comments_template();
        endif;
        ?>

    <?php endwhile; ?>
</div>

<?php get_footer(); ?>