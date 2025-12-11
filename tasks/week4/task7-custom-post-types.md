# Task 3.1: Custom Post Types

## 📋 Task Description
Create a custom post type (e.g., "Events") with custom fields (event date, location) and display on a dedicated page template.

## ⏳ Status: NOT STARTED

## 🎯 Objectives
- [ ] Create custom post type "Events"
- [ ] Add custom fields (event date, location, etc.)
- [ ] Create custom page template to display events
- [ ] Style the events display

## 🛠️ Tools Used
- functions.php (or custom plugin)
- Advanced Custom Fields (ACF) plugin
- Custom page templates
- WordPress Loop

## 📝 Implementation Steps

### Step 1: Register Custom Post Type

Add to `functions.php` or create a custom plugin:

```php
<?php
/**
 * Register Custom Post Type: Events
 */
function create_events_post_type() {
    $labels = array(
        'name'                  => 'Events',
        'singular_name'         => 'Event',
        'menu_name'             => 'Events',
        'add_new'               => 'Add New Event',
        'add_new_item'          => 'Add New Event',
        'edit_item'             => 'Edit Event',
        'new_item'              => 'New Event',
        'view_item'             => 'View Event',
        'search_items'          => 'Search Events',
        'not_found'             => 'No events found',
        'not_found_in_trash'    => 'No events found in trash',
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'has_archive'           => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_admin_bar'     => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-calendar-alt',
        'capability_type'       => 'post',
        'hierarchical'          => false,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite'               => array('slug' => 'events'),
        'show_in_rest'          => true, // Gutenberg support
    );

    register_post_type('event', $args);
}
add_action('init', 'create_events_post_type');
?>
```

### Step 2: Add Custom Fields

#### Method 1: Using Advanced Custom Fields (ACF) Plugin

1. Install ACF plugin
2. Go to **Custom Fields → Add New**
3. Create field group: "Event Details"
4. Add fields:

```
Field Group: Event Details
Location: Post Type is equal to Event

Fields:
1. Event Date
   - Field Type: Date Picker
   - Field Name: event_date
   - Display Format: d/m/Y
   - Return Format: Ymd
   - Required: Yes

2. Event Time
   - Field Type: Time Picker
   - Field Name: event_time
   - Display Format: g:i a
   - Required: Yes

3. Event Location
   - Field Type: Text
   - Field Name: event_location
   - Placeholder: Enter venue name
   - Required: Yes

4. Event Address
   - Field Type: Text Area
   - Field Name: event_address
   - Rows: 3
   - Required: No

5. Event Price
   - Field Type: Number
   - Field Name: event_price
   - Prepend: $
   - Required: No

6. Registration Link
   - Field Type: URL
   - Field Name: registration_link
   - Required: No
```

#### Method 2: Using Custom Meta Boxes (Code)

```php
<?php
/**
 * Add Event Meta Box
 */
function add_event_meta_boxes() {
    add_meta_box(
        'event_details',
        'Event Details',
        'render_event_meta_box',
        'event',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_event_meta_boxes');

/**
 * Render Event Meta Box
 */
function render_event_meta_box($post) {
    wp_nonce_field('event_meta_box', 'event_meta_box_nonce');
    
    $event_date = get_post_meta($post->ID, '_event_date', true);
    $event_location = get_post_meta($post->ID, '_event_location', true);
    $event_price = get_post_meta($post->ID, '_event_price', true);
    ?>
    <p>
        <label for="event_date">Event Date:</label>
        <input type="date" id="event_date" name="event_date" 
               value="<?php echo esc_attr($event_date); ?>" />
    </p>
    <p>
        <label for="event_location">Event Location:</label>
        <input type="text" id="event_location" name="event_location" 
               value="<?php echo esc_attr($event_location); ?>" style="width: 100%;" />
    </p>
    <p>
        <label for="event_price">Event Price ($):</label>
        <input type="number" id="event_price" name="event_price" 
               value="<?php echo esc_attr($event_price); ?>" step="0.01" />
    </p>
    <?php
}

/**
 * Save Event Meta Data
 */
function save_event_meta($post_id) {
    if (!isset($_POST['event_meta_box_nonce']) || 
        !wp_verify_nonce($_POST['event_meta_box_nonce'], 'event_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['event_date'])) {
        update_post_meta($post_id, '_event_date', sanitize_text_field($_POST['event_date']));
    }

    if (isset($_POST['event_location'])) {
        update_post_meta($post_id, '_event_location', sanitize_text_field($_POST['event_location']));
    }

    if (isset($_POST['event_price'])) {
        update_post_meta($post_id, '_event_price', sanitize_text_field($_POST['event_price']));
    }
}
add_action('save_post_event', 'save_event_meta');
?>
```

### Step 3: Create Custom Page Template

Create `template-events.php` in your theme:

```php
<?php
/**
 * Template Name: Events Page
 * Description: Displays all upcoming events
 */

get_header();
?>

<div class="events-page-container">
    <h1>Upcoming Events</h1>
    
    <?php
    // Query upcoming events
    $args = array(
        'post_type'      => 'event',
        'posts_per_page' => -1,
        'meta_key'       => 'event_date', // or '_event_date' if using custom meta
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_query'     => array(
            array(
                'key'     => 'event_date',
                'value'   => date('Ymd'),
                'compare' => '>=',
                'type'    => 'DATE'
            )
        )
    );

    $events_query = new WP_Query($args);

    if ($events_query->have_posts()) :
        echo '<div class="events-grid">';
        
        while ($events_query->have_posts()) : $events_query->the_post();
            // Get custom fields
            $event_date = get_field('event_date'); // ACF method
            $event_time = get_field('event_time');
            $event_location = get_field('event_location');
            $event_price = get_field('event_price');
            ?>
            
            <div class="event-card">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="event-thumbnail">
                        <?php the_post_thumbnail('medium'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="event-content">
                    <h2 class="event-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    
                    <div class="event-meta">
                        <?php if ($event_date) : ?>
                            <p class="event-date">
                                <span class="dashicons dashicons-calendar"></span>
                                <?php echo date('F j, Y', strtotime($event_date)); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if ($event_time) : ?>
                            <p class="event-time">
                                <span class="dashicons dashicons-clock"></span>
                                <?php echo $event_time; ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if ($event_location) : ?>
                            <p class="event-location">
                                <span class="dashicons dashicons-location"></span>
                                <?php echo esc_html($event_location); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if ($event_price) : ?>
                            <p class="event-price">
                                <span class="dashicons dashicons-tickets-alt"></span>
                                $<?php echo number_format($event_price, 2); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="event-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    
                    <a href="<?php the_permalink(); ?>" class="event-button">
                        View Details
                    </a>
                </div>
            </div>
            
        <?php endwhile;
        
        echo '</div>';
        
        wp_reset_postdata();
    else :
        echo '<p>No upcoming events found.</p>';
    endif;
    ?>
</div>

<?php get_footer(); ?>
```

### Step 4: Style Events Display

Add to your theme's CSS:

```css
/* Events Page Styles */
.events-page-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
}

.events-page-container h1 {
    font-size: 2.5em;
    margin-bottom: 40px;
    text-align: center;
    color: #333;
}

.events-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
}

.event-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 12px rgba(0,0,0,0.15);
}

.event-thumbnail img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.event-content {
    padding: 20px;
}

.event-title {
    font-size: 1.5em;
    margin-bottom: 15px;
}

.event-title a {
    color: #333;
    text-decoration: none;
}

.event-title a:hover {
    color: #3498db;
}

.event-meta {
    margin-bottom: 15px;
}

.event-meta p {
    margin: 5px 0;
    color: #666;
    display: flex;
    align-items: center;
}

.event-meta .dashicons {
    margin-right: 8px;
    color: #3498db;
}

.event-excerpt {
    margin-bottom: 20px;
    color: #555;
    line-height: 1.6;
}

.event-button {
    display: inline-block;
    background: #3498db;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    transition: background 0.3s ease;
}

.event-button:hover {
    background: #2980b9;
}

/* Responsive */
@media (max-width: 768px) {
    .events-grid {
        grid-template-columns: 1fr;
    }
}
```

### Step 5: Create Sample Events

Create at least 3 sample events:

1. **WordPress Workshop**
   - Date: Next month
   - Location: Online
   - Price: Free

2. **Web Development Meetup**
   - Date: Two weeks from now
   - Location: Tech Hub Downtown
   - Price: $10

3. **Advanced PHP Training**
   - Date: Next quarter
   - Location: Training Center
   - Price: $99

## 📸 Screenshots to Capture

- [ ] Custom post type in admin menu
- [ ] Add new event screen with custom fields
- [ ] Events archive page
- [ ] Single event page
- [ ] Events grid layout
- [ ] Mobile responsive view

## 🎓 Key Learnings

### Custom Post Types:
- Extend WordPress beyond posts and pages
- Organize different content types
- Custom taxonomies and fields
- Archive and single templates

### Custom Fields:
- Store additional metadata
- Different field types
- Validation and sanitization
- Display in templates

### Template Hierarchy:
```
single-event.php (single event)
archive-event.php (events archive)
template-events.php (custom template)
```

## 🌐 Social Media Post Template

```
🎯 Task 7 Completed: Custom Post Types Mastered!

Built a complete Events system with custom fields as part of @YoungDevInterns internship!

✅ Created custom "Events" post type
✅ Added custom fields (date, location, price)
✅ Built custom page template
✅ Styled responsive events grid
✅ Implemented event filtering

WordPress is so much more than just blogging! 🚀

#WordPress #CustomPostTypes #WebDevelopment #YoungDevInterns #PHP #WebDesign
```

## 🔗 Resources

- [WordPress Custom Post Types](https://developer.wordpress.org/plugins/post-types/)
- [Advanced Custom Fields](https://www.advancedcustomfields.com/)
- [Template Hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/)

## ⏭️ Next Steps
- Build custom theme from scratch
- Create more custom templates
- Add custom taxonomies

---

**Task Status:** Not Started  
**Planned Date:** Week 4
