<?php
/**
 * The template for displaying archive pages
 * 
 * @package Astra Child - YoungDevInterns
 */

get_header();
?>

<style>
    .archive-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .archive-header {
        text-align: center;
        margin-bottom: 50px;
        padding: 40px 20px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border-radius: var(--radius-lg);
        color: #fff;
    }

    .archive-title {
        font-size: 2.5rem;
        margin-bottom: 10px;
        color: #fff;
    }

    .archive-description {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }

    .archive-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    .archive-post-card {
        background: #fff;
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .archive-post-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .archive-post-thumbnail {
        width: 100%;
        height: 220px;
        overflow: hidden;
        position: relative;
    }

    .archive-post-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .archive-post-card:hover .archive-post-thumbnail img {
        transform: scale(1.05);
    }

    .archive-post-content {
        padding: 25px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .archive-post-title {
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .archive-post-title a {
        color: var(--heading-color);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .archive-post-title a:hover {
        color: var(--primary-color);
    }

    .archive-post-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 15px;
        font-size: 0.9rem;
        color: var(--text-light);
    }

    .archive-post-meta span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .archive-post-excerpt {
        color: var(--text-color);
        line-height: 1.6;
        margin-bottom: 20px;
        flex: 1;
    }

    .archive-read-more {
        background: var(--primary-color);
        color: #fff;
        padding: 10px 20px;
        border-radius: var(--radius-sm);
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
        transition: all 0.3s ease;
        align-self: flex-start;
    }

    .archive-read-more:hover {
        background: var(--primary-dark);
        transform: translateX(5px);
        text-decoration: none;
        color: #fff;
    }

    .archive-pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin: 40px 0;
    }

    .archive-pagination a,
    .archive-pagination span {
        padding: 10px 15px;
        background: var(--bg-light);
        border-radius: var(--radius-sm);
        text-decoration: none;
        color: var(--text-color);
        transition: all 0.3s ease;
    }

    .archive-pagination a:hover,
    .archive-pagination .current {
        background: var(--primary-color);
        color: #fff;
    }

    .no-posts {
        text-align: center;
        padding: 60px 20px;
        background: var(--bg-light);
        border-radius: var(--radius-md);
    }

    @media (max-width: 768px) {
        .archive-grid {
            grid-template-columns: 1fr;
        }

        .archive-title {
            font-size: 2rem;
        }
    }
</style>

<div class="archive-container">
    <header class="archive-header">
        <h1 class="archive-title">
            <?php
            if (is_category()) {
                single_cat_title();
            } elseif (is_tag()) {
                single_tag_title();
            } elseif (is_author()) {
                echo 'Author: ' . get_the_author();
            } elseif (is_day()) {
                echo 'Daily Archives: ' . get_the_date();
            } elseif (is_month()) {
                echo 'Monthly Archives: ' . get_the_date('F Y');
            } elseif (is_year()) {
                echo 'Yearly Archives: ' . get_the_date('Y');
            } else {
                echo 'Archives';
            }
            ?>
        </h1>
        <?php if (category_description() || tag_description()): ?>
            <div class="archive-description">
                <?php echo category_description() . tag_description(); ?>
            </div>
        <?php endif; ?>
    </header>

    <?php if (have_posts()): ?>
        <div class="archive-grid">
            <?php while (have_posts()):
                the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('archive-post-card'); ?>>
                    <?php if (has_post_thumbnail()): ?>
                        <div class="archive-post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('large'); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="archive-post-content">
                        <h2 class="archive-post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>

                        <div class="archive-post-meta">
                            <span>📅 <?php echo get_the_date(); ?></span>
                            <span>👤 <?php the_author(); ?></span>
                            <span>💬 <?php comments_number('0', '1', '%'); ?></span>
                        </div>

                        <div class="archive-post-excerpt">
                            <?php the_excerpt(); ?>
                        </div>

                        <a href="<?php the_permalink(); ?>" class="archive-read-more">
                            Read More →
                        </a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="archive-pagination">
            <?php
            echo paginate_links(array(
                'prev_text' => '← Previous',
                'next_text' => 'Next →',
                'type' => 'plain',
            ));
            ?>
        </div>

    <?php else: ?>
        <div class="no-posts">
            <h2>No Posts Found</h2>
            <p>Sorry, no posts were found in this archive.</p>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>