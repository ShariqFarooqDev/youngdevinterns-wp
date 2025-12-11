# Task 2.1: Theme Customization

## 📋 Task Description
Modify existing theme's CSS to change fonts, colors, and layout. Add custom logo and favicon.

## ⏳ Status: NOT STARTED

## 🎯 Objectives
- [ ] Modify theme CSS (fonts, colors, layout)
- [ ] Add custom logo
- [ ] Add custom favicon
- [ ] Create child theme (optional but recommended)

## 🛠️ Tools Used
- WordPress Customizer
- Custom CSS editor
- Child theme (recommended)
- Image editing software for logo/favicon

## 📝 Implementation Steps

### Step 1: Create Child Theme (Recommended)

Create a child theme to preserve customizations:

```php
// style.css
/*
Theme Name: Astra Child
Template: astra
*/

@import url('../astra/style.css');

/* Custom CSS below */
```

```php
// functions.php
<?php
function astra_child_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'astra_child_enqueue_styles');
?>
```

### Step 2: Customize CSS

#### Font Customization:
```css
/* Import Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    font-size: 16px;
    line-height: 1.6;
}

h1, h2, h3, h4, h5, h6 {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
}
```

#### Color Customization:
```css
/* Primary Color Scheme */
:root {
    --primary-color: #3498db;
    --secondary-color: #2ecc71;
    --accent-color: #e74c3c;
    --text-color: #333;
    --bg-color: #f8f9fa;
}

/* Apply colors */
a {
    color: var(--primary-color);
}

.site-header {
    background-color: var(--primary-color);
}

.button, .btn {
    background-color: var(--secondary-color);
}
```

#### Layout Customization:
```css
/* Container width */
.site-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Sidebar width */
.sidebar {
    width: 300px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .sidebar {
        width: 100%;
    }
}
```

### Step 3: Add Custom Logo

1. Go to **Appearance → Customize → Site Identity**
2. Click **Select Logo**
3. Upload logo image (recommended: PNG, 250x100px)
4. Adjust logo size if needed
5. Publish changes

**Logo Design Guidelines:**
- Format: PNG with transparency
- Size: 250x100px (or proportional)
- File size: Under 100KB
- High resolution for retina displays

### Step 4: Add Custom Favicon

1. Go to **Appearance → Customize → Site Identity**
2. Click **Select Site Icon**
3. Upload favicon (512x512px minimum)
4. WordPress will auto-generate sizes
5. Publish changes

**Favicon Guidelines:**
- Format: PNG or ICO
- Size: 512x512px
- Simple, recognizable design
- Works at small sizes (16x16px)

## 📸 Screenshots to Capture

- [ ] Before customization
- [ ] Custom CSS in editor
- [ ] Font changes on frontend
- [ ] Color scheme changes
- [ ] Custom logo in header
- [ ] Favicon in browser tab
- [ ] Mobile responsive view

## 🎓 Key Learnings

### CSS Customization Methods:
1. **WordPress Customizer** - Simple changes
2. **Child Theme** - Permanent, update-safe
3. **Custom CSS Plugin** - Quick additions
4. **Theme Options** - Built-in settings

### Best Practices:
- Always use child theme for major changes
- Test on multiple browsers
- Ensure mobile responsiveness
- Keep CSS organized with comments
- Use CSS variables for consistency

### Design Principles:
- Consistent color scheme (3-5 colors max)
- Readable font sizes (16px+ for body)
- Sufficient contrast for accessibility
- Whitespace for breathing room

## 🌐 Social Media Post Template

```
🎨 Task 4 Completed: Theme Customization!

Transformed my WordPress site with custom styling as part of @YoungDevInterns internship!

✅ Created child theme for safe customizations
✅ Customized fonts using Google Fonts
✅ Implemented custom color scheme
✅ Added professional logo and favicon
✅ Optimized layout for better UX

Design matters! A well-styled site makes all the difference.

#WordPress #WebDesign #CSS #ThemeCustomization #YoungDevInterns #WebDevelopment
```

## 🔗 Resources

- [WordPress Child Themes](https://developer.wordpress.org/themes/advanced-topics/child-themes/)
- [CSS Customization Guide](https://wordpress.org/support/article/css/)
- [Google Fonts](https://fonts.google.com/)
- [Favicon Generator](https://realfavicongenerator.net/)

## ⏭️ Next Steps
- Install and configure essential plugins
- Set up SEO with Yoast
- Add contact forms

---

**Task Status:** Not Started  
**Planned Date:** Week 2
