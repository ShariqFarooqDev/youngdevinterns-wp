<?php
/**
 * The template for displaying single events
 * 
 * @package Astra Child - YoungDevInterns
 */

get_header();
?>

<style>
    .single-event-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .single-event-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .single-event-title {
        font-size: 3rem;
        color: var(--heading-color);
        margin-bottom: 20px;
    }

    .single-event-featured {
        width: 100%;
        height: 400px;
        border-radius: var(--radius-lg);
        overflow: hidden;
        margin-bottom: 40px;
        box-shadow: var(--shadow-xl);
    }

    .single-event-featured img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .event-details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
        background: var(--bg-light);
        padding: 30px;
        border-radius: var(--radius-md);
    }

    .event-detail-item {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .event-detail-icon {
        width: 50px;
        height: 50px;
        background: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .event-detail-icon svg {
        width: 24px;
        height: 24px;
        fill: #fff;
    }

    .event-detail-content h3 {
        margin: 0 0 5px 0;
        font-size: 0.9rem;
        color: var(--text-light);
        font-weight: 500;
    }

    .event-detail-content p {
        margin: 0;
        font-size: 1.1rem;
        color: var(--heading-color);
        font-weight: 600;
    }

    .event-price-badge {
        display: inline-block;
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--secondary-dark) 100%);
        color: #fff;
        padding: 15px 30px;
        border-radius: var(--radius-md);
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 30px;
    }

    .event-price-badge.paid {
        background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-dark) 100%);
    }

    .single-event-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--text-color);
        margin-bottom: 40px;
    }

    .single-event-content h2,
    .single-event-content h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: var(--heading-color);
    }

    .single-event-content ul,
    .single-event-content ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }

    .single-event-content li {
        margin-bottom: 0.5rem;
    }

    .event-registration-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: #fff;
        padding: 40px;
        border-radius: var(--radius-lg);
        text-align: center;
        margin: 40px 0;
    }

    .event-registration-section h2 {
        color: #fff;
        margin-bottom: 20px;
        font-size: 2rem;
    }

    .event-registration-section p {
        font-size: 1.1rem;
        margin-bottom: 30px;
        opacity: 0.9;
    }

    .register-button {
        background: #fff;
        color: var(--primary-color);
        padding: 15px 40px;
        border-radius: var(--radius-md);
        text-decoration: none;
        font-weight: 700;
        font-size: 1.2rem;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .register-button:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-xl);
        text-decoration: none;
        color: var(--primary-color);
    }

    .back-to-events {
        text-align: center;
        margin: 40px 0;
    }

    .back-to-events a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .back-to-events a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .single-event-title {
            font-size: 2rem;
        }

        .single-event-featured {
            height: 250px;
        }

        .event-details-grid {
            grid-template-columns: 1fr;
        }

        .event-price-badge {
            font-size: 1.5rem;
            padding: 10px 20px;
        }
    }
</style>

<div class="single-event-container">
    <?php
    while (have_posts()):
        the_post();
        // Get custom fields
        $event_date = get_post_meta(get_the_ID(), '_event_date', true);
        $event_time = get_post_meta(get_the_ID(), '_event_time', true);
        $event_location = get_post_meta(get_the_ID(), '_event_location', true);
        $event_address = get_post_meta(get_the_ID(), '_event_address', true);
        $event_price = get_post_meta(get_the_ID(), '_event_price', true);
        $registration_link = get_post_meta(get_the_ID(), '_registration_link', true);

        $is_free = (!$event_price || $event_price == 0);
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="single-event-header">
                <h1 class="single-event-title"><?php the_title(); ?></h1>

                <div class="event-price-badge <?php echo $is_free ? 'free' : 'paid'; ?>">
                    <?php echo $is_free ? 'Free Event' : '$' . number_format($event_price, 2); ?>
                </div>
            </header>

            <?php if (has_post_thumbnail()): ?>
                <div class="single-event-featured">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <!-- Event Details Grid -->
            <div class="event-details-grid">
                <?php if ($event_date): ?>
                    <div class="event-detail-item">
                        <div class="event-detail-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm-8 4H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2z" />
                            </svg>
                        </div>
                        <div class="event-detail-content">
                            <h3>Date</h3>
                            <p><?php echo date('F j, Y', strtotime($event_date)); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($event_time): ?>
                    <div class="event-detail-item">
                        <div class="event-detail-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z" />
                            </svg>
                        </div>
                        <div class="event-detail-content">
                            <h3>Time</h3>
                            <p><?php echo date('g:i A', strtotime($event_time)); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($event_location): ?>
                    <div class="event-detail-item">
                        <div class="event-detail-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                            </svg>
                        </div>
                        <div class="event-detail-content">
                            <h3>Location</h3>
                            <p><?php echo esc_html($event_location); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($event_address): ?>
                    <div class="event-detail-item">
                        <div class="event-detail-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                            </svg>
                        </div>
                        <div class="event-detail-content">
                            <h3>Address</h3>
                            <p><?php echo esc_html($event_address); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Event Content -->
            <div class="single-event-content">
                <?php the_content(); ?>
            </div>

            <!-- Registration Section -->
            <?php if ($registration_link || !$is_free): ?>
                <div class="event-registration-section">
                    <h2>Ready to Join Us?</h2>
                    <p>Don't miss out on this amazing event! Register now to secure your spot.</p>
                    <a href="<?php echo $registration_link ? esc_url($registration_link) : '#'; ?>" class="register-button"
                        <?php echo $registration_link ? 'target="_blank"' : ''; ?>>
                        Register Now →
                    </a>
                </div>
            <?php endif; ?>

            <!-- Back to Events -->
            <div class="back-to-events">
                <a href="<?php echo home_url('/events'); ?>">← Back to All Events</a>
            </div>
        </article>

    <?php endwhile; ?>
</div>

<?php get_footer(); ?>