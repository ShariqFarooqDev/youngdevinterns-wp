<?php
/**
 * Template Name: Events Page
 * Description: Displays all upcoming events in a grid layout
 * 
 * @package Astra Child - YoungDevInterns
 */

get_header();
?>

<style>
    /* Events Page Styles */
    .events-page-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .events-page-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .events-page-header h1 {
        font-size: 3rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .events-page-header p {
        font-size: 1.2rem;
        color: var(--text-light);
        max-width: 600px;
        margin: 0 auto;
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

    .event-badge.free {
        background: var(--secondary-color);
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

    .event-meta-item svg {
        width: 18px;
        height: 18px;
        fill: var(--primary-color);
        flex-shrink: 0;
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

    .no-events h2 {
        color: var(--text-light);
        margin-bottom: 10px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .events-grid {
            grid-template-columns: 1fr;
        }

        .events-page-header h1 {
            font-size: 2rem;
        }

        .event-footer {
            flex-direction: column;
            gap: 15px;
            align-items: stretch;
        }

        .event-button {
            text-align: center;
        }
    }
</style>

<div class="events-page-container">
    <header class="events-page-header">
        <h1>📅 Upcoming Events</h1>
        <p>Join us for exciting workshops, meetups, and training sessions. Expand your skills and network with fellow
            developers!</p>
    </header>

    <?php
    // Query upcoming events
    $today = date('Y-m-d');
    $args = array(
        'post_type' => 'event',
        'posts_per_page' => -1,
        'meta_key' => '_event_date',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => '_event_date',
                'value' => $today,
                'compare' => '>=',
                'type' => 'DATE'
            )
        )
    );

    $events_query = new WP_Query($args);

    if ($events_query->have_posts()):
        ?>
        <div class="events-grid">
            <?php
            while ($events_query->have_posts()):
                $events_query->the_post();
                // Get custom fields
                $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                $event_time = get_post_meta(get_the_ID(), '_event_time', true);
                $event_location = get_post_meta(get_the_ID(), '_event_location', true);
                $event_address = get_post_meta(get_the_ID(), '_event_address', true);
                $event_price = get_post_meta(get_the_ID(), '_event_price', true);
                $registration_link = get_post_meta(get_the_ID(), '_registration_link', true);

                $is_free = (!$event_price || $event_price == 0);
                ?>
                <article class="event-card">
                    <?php if (has_post_thumbnail()): ?>
                        <div class="event-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm-8 4H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2z" />
                                    </svg>
                                    <span><?php echo date('F j, Y', strtotime($event_date)); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ($event_time): ?>
                                <div class="event-meta-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z" />
                                    </svg>
                                    <span><?php echo date('g:i A', strtotime($event_time)); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ($event_location): ?>
                                <div class="event-meta-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                    </svg>
                                    <span><?php echo esc_html($event_location); ?></span>
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
        <?php
        wp_reset_postdata();
    else:
        ?>
        <div class="no-events">
            <h2>No Upcoming Events</h2>
            <p>Check back soon for exciting workshops and meetups!</p>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>