# Task 3.2: Advanced Theme Development

## 📋 Task Description
Build a custom theme from scratch or child theme using HTML, CSS, and PHP. Create custom theme templates for different content types.

## ⏳ Status: NOT STARTED

## 🎯 Objectives
- [ ] Create custom WordPress theme or child theme
- [ ] Use HTML, CSS, and PHP
- [ ] Create custom templates (single post, archive page)
- [ ] Implement WordPress template hierarchy
- [ ] Add theme customization options

## 🛠️ Tools Used
- Text editor (VS Code)
- WordPress Template Tags
- WordPress Functions
- CSS3 and HTML5
- PHP

## 📝 Implementation Steps

### Step 1: Create Child Theme Structure

Create folder: `wp-content/themes/astra-child/`

**style.css:**
```css
/*
Theme Name: Astra Child - YoungDevInterns
Theme URI: https://youngdevinterns.com
Description: Custom child theme for WordPress internship project
Author: [Your Name]
Author URI: https://youngdevinterns.com
Template: astra
Version: 1.0.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: astra-child
*/

/* Import parent theme styles */
@import url('../astra/style.css');

/* ===========================
   Custom Styles
   =========================== */

/* Typography */
body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    font-size: 16px;
    line-height: 1.7;
    color: #333;
}

h1, h2, h3, h4, h5, h6 {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    line-height: 1.3;
    margin-bottom: 1rem;
}

/* Color Scheme */
:root {
    --primary-color: #2563eb;
    --secondary-color: #10b981;
    --accent-color: #f59e0b;
    --text-color: #1f2937;
    --light-bg: #f9fafb;
    --border-color: #e5e7eb;
}

/* Header Customization */
.site-header {
    background: linear-gradient(135deg, var(--primary-color), #1e40af);
    padding: 1rem 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.site-title a {
    color: #fff;
    font-size: 1.8rem;
    font-weight: 700;
    text-decoration: none;
}

/* Navigation */
.main-navigation a {
    color: #fff;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
}

.main-navigation a:hover {
    background: rgba(255,255,255,0.1);
    border-radius: 5px;
}

/* Content Area */
.site-content {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 20px;
}

/* Post Styles */
.post {
    background: #fff;
    padding: 2rem;
    margin-bottom: 2rem;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.entry-title {
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.entry-meta {
    color: #6b7280;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

/* Buttons */
.button, .btn {
    background: var(--primary-color);
    color: #fff;
    padding: 0.75rem 1.5rem;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
}

.button:hover, .btn:hover {
    background: #1e40af;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37,99,235,0.3);
}

/* Footer */
.site-footer {
    background: #1f2937;
    color: #fff;
    padding: 3rem 0 1rem;
    margin-top: 4rem;
}

/* Responsive */
@media (max-width: 768px) {
    .site-content {
        padding: 0 15px;
    }
    
    .post {
        padding: 1.5rem;
    }
}
```

**functions.php:**
```php
<?php
/**
 * Astra Child Theme Functions
 */

// Enqueue parent and child theme styles
function astra_child_enqueue_styles() {
    // Parent theme style
    wp_enqueue_style('astra-parent-style', get_template_directory_uri() . '/style.css');
    
    // Child theme style
    wp_enqueue_style('astra-child-style', 
        get_stylesheet_directory_uri() . '/style.css',
        array('astra-parent-style'),
        wp_get_theme()->get('Version')
    );
    
    // Google Fonts
    wp_enqueue_style('google-fonts', 
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@700&display=swap',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'astra_child_enqueue_styles');

// Theme Support
function astra_child_setup() {
    // Add theme support for various features
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'astra-child'),
        'footer'  => __('Footer Menu', 'astra-child'),
    ));
}
add_action('after_setup_theme', 'astra_child_setup');

// Register Widget Areas
function astra_child_widgets_init() {
    register_sidebar(array(
        'name'          => __('Custom Sidebar', 'astra-child'),
        'id'            => 'custom-sidebar',
        'description'   => __('Custom sidebar widget area', 'astra-child'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'astra_child_widgets_init');

// Custom excerpt length
function astra_child_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'astra_child_excerpt_length');

// Custom "Read More" link
function astra_child_excerpt_more($more) {
    return '... <a href="' . get_permalink() . '" class="read-more">Read More</a>';
}
add_filter('excerpt_more', 'astra_child_excerpt_more');

// Add custom body classes
function astra_child_body_classes($classes) {
    if (is_single()) {
        $classes[] = 'single-post-custom';
    }
    if (is_archive()) {
        $classes[] = 'archive-custom';
    }
    return $classes;
}
add_filter('body_class', 'astra_child_body_classes');
?>
```

### Step 2: Create Custom Templates

**single.php** (Single Post Template):
```php
<?php
/**
 * Single Post Template
 */
get_header();
?>

<div class="single-post-container">
    <?php
    while (have_posts()) : the_post();
    ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                
                <div class="entry-meta">
                    <span class="posted-on">
                        <i class="dashicons dashicons-calendar"></i>
                        <?php echo get_the_date(); ?>
                    </span>
                    <span class="author">
                        <i class="dashicons dashicons-admin-users"></i>
                        <?php the_author(); ?>
                    </span>
                    <span class="categories">
                        <i class="dashicons dashicons-category"></i>
                        <?php the_category(', '); ?>
                    </span>
                </div>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <footer class="entry-footer">
                <?php
                the_tags('<div class="tags"><i class="dashicons dashicons-tag"></i> ', ', ', '</div>');
                ?>
            </footer>
        </article>

        <?php
        // Comments
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>

    <?php endwhile; ?>
</div>

<?php
get_sidebar();
get_footer();
?>
```

**archive.php** (Archive Template):
```php
<?php
/**
 * Archive Template
 */
get_header();
?>

<div class="archive-container">
    <header class="archive-header">
        <?php
        the_archive_title('<h1 class="archive-title">', '</h1>');
        the_archive_description('<div class="archive-description">', '</div>');
        ?>
    </header>

    <div class="posts-grid">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
        ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="post-content">
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>

                        <div class="entry-meta">
                            <span><?php echo get_the_date(); ?></span>
                            <span>By <?php the_author(); ?></span>
                        </div>

                        <div class="entry-excerpt">
                            <?php the_excerpt(); ?>
                        </div>

                        <a href="<?php the_permalink(); ?>" class="read-more-btn">
                            Read More →
                        </a>
                    </div>
                </article>
        <?php
            endwhile;

            // Pagination
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => __('← Previous', 'astra-child'),
                'next_text' => __('Next →', 'astra-child'),
            ));

        else :
            echo '<p>No posts found.</p>';
        endif;
        ?>
    </div>
</div>

<?php
get_sidebar();
get_footer();
?>
```

**page.php** (Page Template):
```php
<?php
/**
 * Page Template
 */
get_header();
?>

<div class="page-container">
    <?php
    while (have_posts()) : the_post();
    ?>
        <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="page-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </header>

            <div class="page-content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; ?>
</div>

<?php
get_footer();
?>
```

### Step 3: Create Custom Page Templates

**template-fullwidth.php:**
```php
<?php
/**
 * Template Name: Full Width Page
 * Description: Page template without sidebar
 */
get_header();
?>

<div class="fullwidth-container">
    <?php
    while (have_posts()) : the_post();
        the_content();
    endwhile;
    ?>
</div>

<?php get_footer(); ?>
```

## 📸 Screenshots
- [ ] Child theme activated
- [ ] Custom single post layout
- [ ] Custom archive layout
- [ ] Full-width page template
- [ ] Theme customizer options

## 🎓 Key Learnings
- WordPress template hierarchy
- Child theme development
- Custom template creation
- PHP template tags
- Theme functions and hooks

## 🌐 Social Media Post
```
🎨 Task 8 Completed: Custom Theme Development!

Built a complete custom WordPress child theme from scratch as part of @YoungDevInterns internship!

✅ Created child theme structure
✅ Custom single & archive templates
✅ Responsive design with modern CSS
✅ Custom functions and hooks
✅ Professional theme customization

Theme development is where WordPress truly shines! 🚀

#WordPress #ThemeDevelopment #PHP #WebDevelopment #YoungDevInterns
```

## ⏭️ Next Steps
- Set up WooCommerce
- Create product pages
- Complete internship

---

**Task Status:** Not Started  
**Planned Date:** Week 4
