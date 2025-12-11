<?php
/**
 * The template for displaying event archives
 * 
 * @package Astra Child - YoungDevInterns
 */

get_header();
?>

<style>
    .events-archive-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .events-archive-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .events-archive-title {
        font-size: 3rem;
        color: #2563eb;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .events-archive-description {
        font-size: 1.1rem;
        color: #6b7280;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    .event-card {
        background: #fff;
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .event-thumbnail {
        width: 100%;
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .event-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .event-card:hover .event-thumbnail img {
        transform: scale(1.05);
    }

    .event-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--secondary-color);
        color: #fff;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .event-badge.paid {
        background: var(--accent-color);
    }

    .event-content {
        padding: 25px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .event-title {
        font-size: 1.5rem;
        margin-bottom: 15px;
        color: var(--heading-color);
    }

    .event-title a {
        color: var(--heading-color);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .event-title a:hover {
        color: var(--primary-color);
    }

    .event-meta {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 15px;
    }

    .event-meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--text-light);
        font-size: 0.95rem;
    }

    .event-excerpt {
        color: var(--text-color);
        line-height: 1.6;
        margin-bottom: 20px;
        flex: 1;
    }

    .event-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid var(--border-color);
    }

    .event-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .event-price.free {
        color: var(--secondary-color);
    }

    .event-button {
        background: var(--primary-color);
        color: #fff;
        padding: 10px 20px;
        border-radius: var(--radius-sm);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .event-button:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        text-decoration: none;
        color: #fff;
    }

    .no-events {
        text-align: center;
        padding: 60px 20px;
        background: var(--bg-light);
        border-radius: var(--radius-md);
    }

    @media (max-width: 768px) {
        .events-grid {
            grid-template-columns: 1fr;
        }

        .events-archive-title {
            font-size: 2rem;
        }
    }
</style>

<div class="events-archive-container">
    <header class="events-archive-header">
        <h1 class="events-archive-title">📅 Upcoming Events</h1>
        <p class="events-archive-description">
            Join us for exciting workshops, meetups, and training sessions. Expand your skills and network with fellow
            developers!
        </p>
    </header>

    <?php if (have_posts()): ?>
        <div class="events-grid">
            <?php
            while (have_posts()):
                the_post();
                // Get custom fields
                $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                $event_time = get_post_meta(get_the_ID(), '_event_time', true);
                $event_location = get_post_meta(get_the_ID(), '_event_location', true);
                $event_price = get_post_meta(get_the_ID(), '_event_price', true);
                $registration_link = get_post_meta(get_the_ID(), '_registration_link', true);

                $is_free = (!$event_price || $event_price == 0);
                ?>
                <article class="event-card">
                    <?php if (has_post_thumbnail()): ?>
                        <div class="event-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('large'); ?>
                            </a>
                            <span class="event-badge <?php echo $is_free ? 'free' : 'paid'; ?>">
                                <?php echo $is_free ? 'Free' : '$' . number_format($event_price, 2); ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <div class="event-content">
                        <h2 class="event-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>

                        <div class="event-meta">
                            <?php if ($event_date): ?>
                                <div class="event-meta-item">
                                    📅 <?php echo date('F j, Y', strtotime($event_date)); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($event_time): ?>
                                <div class="event-meta-item">
                                    🕐 <?php echo date('g:i A', strtotime($event_time)); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($event_location): ?>
                                <div class="event-meta-item">
                                    📍 <?php echo esc_html($event_location); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="event-excerpt">
                            <?php the_excerpt(); ?>
                        </div>

                        <div class="event-footer">
                            <div class="event-price <?php echo $is_free ? 'free' : ''; ?>">
                                <?php echo $is_free ? 'Free' : '$' . number_format($event_price, 2); ?>
                            </div>
                            <a href="<?php echo $registration_link ? esc_url($registration_link) : get_permalink(); ?>"
                                class="event-button" <?php echo $registration_link ? 'target="_blank"' : ''; ?>>
                                <?php echo $registration_link ? 'Register Now →' : 'View Details →'; ?>
                            </a>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <?php if (paginate_links()): ?>
            <div class="archive-pagination" style="display: flex; justify-content: center; gap: 10px; margin: 40px 0;">
                <?php
                echo paginate_links(array(
                    'prev_text' => '← Previous',
                    'next_text' => 'Next →',
                    'type' => 'plain',
                ));
                ?>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <div class="no-events">
            <h2>No Events Found</h2>
            <p>Check back soon for exciting workshops and meetups!</p>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>