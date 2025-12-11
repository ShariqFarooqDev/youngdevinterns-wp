<?php
/**
 * Astra Child Theme Functions
 * 
 * @package Astra Child - YoungDevInterns
 * @author YoungDevInterns Student
 * @version 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue Parent and Child Theme Styles
 */
function astra_child_enqueue_styles()
{
    // Parent theme stylesheet
    wp_enqueue_style(
        'astra-parent-style',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme()->parent()->get('Version')
    );

    // Child theme stylesheet
    wp_enqueue_style(
        'astra-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('astra-parent-style'),
        wp_get_theme()->get('Version')
    );

    // Google Fonts (already in CSS @import, but can also be enqueued here)
    wp_enqueue_style(
        'astra-child-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700;800&display=swap',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'astra_child_enqueue_styles', 15);

/**
 * Theme Setup
 */
function astra_child_setup()
{
    // Add theme support for various features
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
    ));

    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));

    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Add support for wide and full alignment
    add_theme_support('align-wide');
}
add_action('after_setup_theme', 'astra_child_setup');

/**
 * Register Widget Areas
 */
function astra_child_widgets_init()
{
    // Custom sidebar widget area
    register_sidebar(array(
        'name' => __('Custom Sidebar', 'astra-child'),
        'id' => 'custom-sidebar',
        'description' => __('Custom sidebar widget area for additional content', 'astra-child'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'astra_child_widgets_init');

/**
 * Custom Excerpt Length
 */
function astra_child_excerpt_length($length)
{
    return 30; // Number of words
}
add_filter('excerpt_length', 'astra_child_excerpt_length', 999);

/**
 * Custom Excerpt More Link
 */
function astra_child_excerpt_more($more)
{
    if (!is_single()) {
        $more = sprintf(
            '... <a class="read-more" href="%1$s">%2$s</a>',
            get_permalink(get_the_ID()),
            __('Read More →', 'astra-child')
        );
    }
    return $more;
}
add_filter('excerpt_more', 'astra_child_excerpt_more');

/**
 * Add Custom Body Classes
 */
function astra_child_body_classes($classes)
{
    // Add class for single posts
    if (is_single()) {
        $classes[] = 'single-post-custom';
    }

    // Add class for archive pages
    if (is_archive()) {
        $classes[] = 'archive-custom';
    }

    // Add class for pages
    if (is_page()) {
        $classes[] = 'page-custom';
    }

    // Add class for home page
    if (is_front_page()) {
        $classes[] = 'front-page-custom';
    }

    return $classes;
}
add_filter('body_class', 'astra_child_body_classes');

/**
 * Customize Comment Form
 */
function astra_child_comment_form_fields($fields)
{
    // Customize comment form fields if needed
    return $fields;
}
add_filter('comment_form_default_fields', 'astra_child_comment_form_fields');

/**
 * Add Custom Navigation Menu Locations
 */
function astra_child_register_menus()
{
    register_nav_menus(array(
        'footer-menu' => __('Footer Menu', 'astra-child'),
    ));
}
add_action('after_setup_theme', 'astra_child_register_menus');

/**
 * Customize WordPress Login Page (Optional)
 */
function astra_child_login_logo()
{
    if (has_custom_logo()) {
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        ?>
        <style type="text/css">
            #login h1 a,
            .login h1 a {
                background-image: url(<?php echo esc_url($logo[0]); ?>);
                height: 80px;
                width: 320px;
                background-size: contain;
                background-repeat: no-repeat;
                padding-bottom: 30px;
            }
        </style>
        <?php
    }
}
add_action('login_enqueue_scripts', 'astra_child_login_logo');

/**
 * Change Login Logo URL
 */
function astra_child_login_logo_url()
{
    return home_url();
}
add_filter('login_headerurl', 'astra_child_login_logo_url');

/**
 * Change Login Logo Title
 */
function astra_child_login_logo_url_title()
{
    return get_bloginfo('name');
}
add_filter('login_headertext', 'astra_child_login_logo_url_title');

/**
 * Add Custom Image Sizes
 */
function astra_child_custom_image_sizes()
{
    add_image_size('post-thumbnail-large', 1200, 600, true);
    add_image_size('post-thumbnail-medium', 800, 400, true);
    add_image_size('post-thumbnail-small', 400, 200, true);
}
add_action('after_setup_theme', 'astra_child_custom_image_sizes');

/**
 * Disable Emojis (Performance Optimization)
 */
function astra_child_disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'astra_child_disable_emojis');

/**
 * Custom Functions Below
 * Add your custom functions here
 */

// Example: Add a custom shortcode
function astra_child_button_shortcode($atts, $content = null)
{
    $atts = shortcode_atts(array(
        'url' => '#',
        'style' => 'primary',
        'target' => '_self',
    ), $atts);

    return sprintf(
        '<a href="%s" class="button %s" target="%s">%s</a>',
        esc_url($atts['url']),
        esc_attr($atts['style']),
        esc_attr($atts['target']),
        esc_html($content)
    );
}
add_shortcode('button', 'astra_child_button_shortcode');

/**
 * Security: Remove WordPress Version Number
 */
function astra_child_remove_version()
{
    return '';
}
add_filter('the_generator', 'astra_child_remove_version');

/**
 * Performance: Defer JavaScript Loading
 */
function astra_child_defer_scripts($tag, $handle, $src)
{
    // List of scripts to defer
    $defer_scripts = array(
        // Add script handles here
    );

    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'astra_child_defer_scripts', 10, 3);

/**
 * Add Custom Post Meta Information
 */
function astra_child_post_meta()
{
    if (is_single()) {
        ?>
        <div class="custom-post-meta">
            <span class="post-date">
                <i class="dashicons dashicons-calendar"></i>
                <?php echo get_the_date(); ?>
            </span>
            <span class="post-author">
                <i class="dashicons dashicons-admin-users"></i>
                <?php the_author(); ?>
            </span>
            <span class="post-comments">
                <i class="dashicons dashicons-admin-comments"></i>
                <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
            </span>
        </div>
        <?php
    }
}

/**
 * Customizer Additions (Optional)
 */
function astra_child_customize_register($wp_customize)
{
    // Add custom settings to WordPress Customizer
    // Example: Add a custom color option

    $wp_customize->add_section('astra_child_colors', array(
        'title' => __('Child Theme Colors', 'astra-child'),
        'priority' => 30,
    ));

    // Add more customizer options as needed
}
add_action('customize_register', 'astra_child_customize_register');

/**
 * ===========================
 * CUSTOM POST TYPES
 * ===========================
 */

/**
 * Register Custom Post Type: Events
 */
function create_events_post_type()
{
    $labels = array(
        'name' => _x('Events', 'Post Type General Name', 'astra-child'),
        'singular_name' => _x('Event', 'Post Type Singular Name', 'astra-child'),
        'menu_name' => __('Events', 'astra-child'),
        'name_admin_bar' => __('Event', 'astra-child'),
        'archives' => __('Event Archives', 'astra-child'),
        'attributes' => __('Event Attributes', 'astra-child'),
        'parent_item_colon' => __('Parent Event:', 'astra-child'),
        'all_items' => __('All Events', 'astra-child'),
        'add_new_item' => __('Add New Event', 'astra-child'),
        'add_new' => __('Add New', 'astra-child'),
        'new_item' => __('New Event', 'astra-child'),
        'edit_item' => __('Edit Event', 'astra-child'),
        'update_item' => __('Update Event', 'astra-child'),
        'view_item' => __('View Event', 'astra-child'),
        'view_items' => __('View Events', 'astra-child'),
        'search_items' => __('Search Event', 'astra-child'),
        'not_found' => __('No events found', 'astra-child'),
        'not_found_in_trash' => __('No events found in Trash', 'astra-child'),
        'featured_image' => __('Event Image', 'astra-child'),
        'set_featured_image' => __('Set event image', 'astra-child'),
        'remove_featured_image' => __('Remove event image', 'astra-child'),
        'use_featured_image' => __('Use as event image', 'astra-child'),
        'insert_into_item' => __('Insert into event', 'astra-child'),
        'uploaded_to_this_item' => __('Uploaded to this event', 'astra-child'),
        'items_list' => __('Events list', 'astra-child'),
        'items_list_navigation' => __('Events list navigation', 'astra-child'),
        'filter_items_list' => __('Filter events list', 'astra-child'),
    );

    $args = array(
        'label' => __('Event', 'astra-child'),
        'description' => __('Events and workshops', 'astra-child'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'taxonomies' => array('category', 'post_tag'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-calendar-alt',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true, // Enable Gutenberg editor
        'rewrite' => array('slug' => 'events'),
    );

    register_post_type('event', $args);
}
add_action('init', 'create_events_post_type', 0);

/**
 * Add Custom Meta Boxes for Events
 */
function add_event_meta_boxes()
{
    add_meta_box(
        'event_details',
        __('Event Details', 'astra-child'),
        'render_event_meta_box',
        'event',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_event_meta_boxes');

/**
 * Render Event Meta Box Content
 */
function render_event_meta_box($post)
{
    // Add nonce for security
    wp_nonce_field('event_meta_box', 'event_meta_box_nonce');

    // Get existing values
    $event_date = get_post_meta($post->ID, '_event_date', true);
    $event_time = get_post_meta($post->ID, '_event_time', true);
    $event_location = get_post_meta($post->ID, '_event_location', true);
    $event_address = get_post_meta($post->ID, '_event_address', true);
    $event_price = get_post_meta($post->ID, '_event_price', true);
    $registration_link = get_post_meta($post->ID, '_registration_link', true);
    ?>
    <style>
        .event-meta-box {
            display: grid;
            gap: 15px;
        }

        .event-meta-field {
            display: flex;
            flex-direction: column;
        }

        .event-meta-field label {
            font-weight: 600;
            margin-bottom: 5px;
            color: #1f2937;
        }

        .event-meta-field input,
        .event-meta-field textarea {
            padding: 8px;
            border: 1px solid #e5e7eb;
            border-radius: 5px;
            font-size: 14px;
        }

        .event-meta-field input:focus,
        .event-meta-field textarea:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .event-meta-field small {
            color: #6b7280;
            margin-top: 3px;
        }
    </style>

    <div class="event-meta-box">
        <div class="event-meta-field">
            <label for="event_date"><?php _e('Event Date *', 'astra-child'); ?></label>
            <input type="date" id="event_date" name="event_date" value="<?php echo esc_attr($event_date); ?>" required />
            <small><?php _e('Select the date of the event', 'astra-child'); ?></small>
        </div>

        <div class="event-meta-field">
            <label for="event_time"><?php _e('Event Time *', 'astra-child'); ?></label>
            <input type="time" id="event_time" name="event_time" value="<?php echo esc_attr($event_time); ?>" required />
            <small><?php _e('Select the start time of the event', 'astra-child'); ?></small>
        </div>

        <div class="event-meta-field">
            <label for="event_location"><?php _e('Event Location *', 'astra-child'); ?></label>
            <input type="text" id="event_location" name="event_location" value="<?php echo esc_attr($event_location); ?>"
                placeholder="e.g., Tech Hub Downtown" required />
            <small><?php _e('Enter the venue name', 'astra-child'); ?></small>
        </div>

        <div class="event-meta-field">
            <label for="event_address"><?php _e('Event Address', 'astra-child'); ?></label>
            <textarea id="event_address" name="event_address" rows="3"
                placeholder="123 Main Street, City, State, ZIP"><?php echo esc_textarea($event_address); ?></textarea>
            <small><?php _e('Full address of the venue (optional)', 'astra-child'); ?></small>
        </div>

        <div class="event-meta-field">
            <label for="event_price"><?php _e('Event Price ($)', 'astra-child'); ?></label>
            <input type="number" id="event_price" name="event_price" value="<?php echo esc_attr($event_price); ?>"
                step="0.01" min="0" placeholder="0.00" />
            <small><?php _e('Enter 0 for free events', 'astra-child'); ?></small>
        </div>

        <div class="event-meta-field">
            <label for="registration_link"><?php _e('Registration Link', 'astra-child'); ?></label>
            <input type="url" id="registration_link" name="registration_link"
                value="<?php echo esc_url($registration_link); ?>" placeholder="https://example.com/register" />
            <small><?php _e('Link to event registration page (optional)', 'astra-child'); ?></small>
        </div>
    </div>
    <?php
}

/**
 * Save Event Meta Data
 */
function save_event_meta($post_id)
{
    // Check nonce
    if (!isset($_POST['event_meta_box_nonce']) || !wp_verify_nonce($_POST['event_meta_box_nonce'], 'event_meta_box')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save event date
    if (isset($_POST['event_date'])) {
        update_post_meta($post_id, '_event_date', sanitize_text_field($_POST['event_date']));
    }

    // Save event time
    if (isset($_POST['event_time'])) {
        update_post_meta($post_id, '_event_time', sanitize_text_field($_POST['event_time']));
    }

    // Save event location
    if (isset($_POST['event_location'])) {
        update_post_meta($post_id, '_event_location', sanitize_text_field($_POST['event_location']));
    }

    // Save event address
    if (isset($_POST['event_address'])) {
        update_post_meta($post_id, '_event_address', sanitize_textarea_field($_POST['event_address']));
    }

    // Save event price
    if (isset($_POST['event_price'])) {
        update_post_meta($post_id, '_event_price', sanitize_text_field($_POST['event_price']));
    }

    // Save registration link
    if (isset($_POST['registration_link'])) {
        update_post_meta($post_id, '_registration_link', esc_url_raw($_POST['registration_link']));
    }
}
add_action('save_post_event', 'save_event_meta');

/**
 * Add custom columns to Events admin list
 */
function set_custom_event_columns($columns)
{
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = $columns['title'];
    $new_columns['event_date'] = __('Event Date', 'astra-child');
    $new_columns['event_location'] = __('Location', 'astra-child');
    $new_columns['event_price'] = __('Price', 'astra-child');
    $new_columns['date'] = $columns['date'];

    return $new_columns;
}
add_filter('manage_event_posts_columns', 'set_custom_event_columns');

/**
 * Display custom column content
 */
function custom_event_column_content($column, $post_id)
{
    switch ($column) {
        case 'event_date':
            $event_date = get_post_meta($post_id, '_event_date', true);
            $event_time = get_post_meta($post_id, '_event_time', true);
            if ($event_date) {
                echo date('F j, Y', strtotime($event_date));
                if ($event_time) {
                    echo '<br><small>' . date('g:i A', strtotime($event_time)) . '</small>';
                }
            } else {
                echo '—';
            }
            break;

        case 'event_location':
            $location = get_post_meta($post_id, '_event_location', true);
            echo $location ? esc_html($location) : '—';
            break;

        case 'event_price':
            $price = get_post_meta($post_id, '_event_price', true);
            if ($price && $price > 0) {
                echo '$' . number_format($price, 2);
            } else {
                echo '<span style="color: #10b981; font-weight: 600;">Free</span>';
            }
            break;
    }
}
add_action('manage_event_posts_custom_column', 'custom_event_column_content', 10, 2);

/**
 * Make event columns sortable
 */
function set_sortable_event_columns($columns)
{
    $columns['event_date'] = 'event_date';
    $columns['event_price'] = 'event_price';
    return $columns;
}
add_filter('manage_edit-event_sortable_columns', 'set_sortable_event_columns');

/**
 * Shortcode to Display Events List
 * Usage: [events_list]
 */
function events_list_shortcode($atts)
{
    // Set default attributes
    $atts = shortcode_atts(array(
        'count' => -1, // Show all events by default
    ), $atts);

    ob_start();

    // Include the same styles from the template
    ?>
    <style>
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin: 40px 0;
        }

        .event-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
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
        }

        .event-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #10b981;
            color: #fff;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .event-badge.paid {
            background: #f59e0b;
        }

        .event-content {
            padding: 25px;
        }

        .event-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #1f2937;
        }

        .event-title a {
            color: #1f2937;
            text-decoration: none;
        }

        .event-title a:hover {
            color: #2563eb;
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
            color: #6b7280;
            font-size: 0.95rem;
        }

        .event-excerpt {
            color: #374151;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .event-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
        }

        .event-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2563eb;
        }

        .event-price.free {
            color: #10b981;
        }

        .event-button {
            background: #2563eb;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .event-button:hover {
            background: #1e40af;
            text-decoration: none;
            color: #fff;
        }

        @media (max-width: 768px) {
            .events-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <?php
    // Query upcoming events
    $today = date('Y-m-d');
    $args = array(
        'post_type' => 'event',
        'posts_per_page' => $atts['count'],
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
                                class="event-button">
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
        <p style="text-align: center; padding: 40px; background: #f9fafb; border-radius: 10px;">
            No upcoming events found. Check back soon!
        </p>
    <?php endif;

    return ob_get_clean();
}
add_shortcode('events_list', 'events_list_shortcode');

/**
 * End of Child Theme Functions
 * 
 * All customizations above this line
 */
