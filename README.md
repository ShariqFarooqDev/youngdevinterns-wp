# YoungDevInterns WordPress Development Project

A comprehensive WordPress development project showcasing custom theme development, custom post types, and e-commerce integration.

![WordPress](https://img.shields.io/badge/WordPress-6.8-blue)
![WooCommerce](https://img.shields.io/badge/WooCommerce-8.0-purple)
![PHP](https://img.shields.io/badge/PHP-8.0-777BB4)
![License](https://img.shields.io/badge/License-MIT-green)

---

## 🚀 Project Overview

This is a fully-featured WordPress website built from scratch, demonstrating advanced WordPress development skills including custom theme development, custom post types, and complete e-commerce functionality.

**Live Demo:** `youngdevinterns-wp.local` (Local development)

---

## ✨ Features

### 🎨 Custom Theme Development
- **Astra Child Theme** with 9 custom template files
- Professional CSS with custom color scheme and typography
- Responsive design for all devices
- Custom navigation with gradient header
- 886 lines of custom PHP code
- 493 lines of custom CSS

### 📅 Custom Post Types
- **Events System** with full CRUD functionality
- 6 custom fields (date, time, location, address, price, registration link)
- Custom archive and single templates
- Events shortcode `[events_list]`
- Custom admin columns and sorting

### 🛍️ E-Commerce Store
- **WooCommerce** integration
- 4 digital products (courses and themes)
- Payment gateway configuration
- Shipping zone setup
- Complete checkout process

### 📝 Content Management
- Blog with custom post templates
- Static pages with custom layouts
- Widget areas (sidebar and footer)
- SEO optimization with Yoast SEO
- Contact forms with Contact Form 7

### ⚡ Performance & SEO
- W3 Total Cache integration
- Optimized images and assets
- SEO-friendly URLs
- Meta tags and descriptions
- Performance optimizations

---

## 🛠️ Tech Stack

| Technology | Purpose |
|------------|---------|
| **WordPress** | Content Management System |
| **PHP** | Backend development |
| **MySQL** | Database |
| **HTML/CSS** | Frontend structure and styling |
| **JavaScript** | Interactive elements |
| **WooCommerce** | E-commerce functionality |
| **Astra Theme** | Parent theme framework |

---

## 📁 Project Structure

```
youngdevinterns-wp/
├── app/public/
│   └── wp-content/
│       ├── themes/
│       │   └── astra-child/           # Custom child theme
│       │       ├── style.css          # 493 lines of custom CSS
│       │       ├── functions.php      # 886 lines of custom PHP
│       │       ├── single.php         # Custom single post template
│       │       ├── archive.php        # Custom archive template
│       │       ├── page.php           # Custom page template
│       │       ├── single-event.php   # Custom event template
│       │       ├── archive-event.php  # Events archive template
│       │       ├── template-events.php # Events page template
│       │       └── template-fullwidth.php # Full-width template
│       └── plugins/
│           ├── woocommerce/           # E-commerce plugin
│           ├── wordpress-seo/         # Yoast SEO
│           ├── contact-form-7/        # Contact forms
│           └── w3-total-cache/        # Performance optimization
├── tasks/                             # Task documentation
│   ├── week1/                         # Basic tasks
│   ├── week2-3/                       # Intermediate tasks
│   └── week4/                         # Expert tasks
├── screenshots/                       # Project screenshots
├── .gitignore                         # Git ignore rules
└── README.md                          # This file
```

---

## 🎯 Key Accomplishments

### Custom Theme Development
- ✅ Created professional child theme with 9 custom files
- ✅ Implemented custom color scheme and typography
- ✅ Built responsive layouts for all screen sizes
- ✅ Added custom widgets and widget areas
- ✅ Created 4 different page templates

### Custom Post Types
- ✅ Developed complete Events management system
- ✅ Implemented 6 custom meta fields with validation
- ✅ Created custom admin interface with sortable columns
- ✅ Built custom archive and single templates
- ✅ Added shortcode support for flexible display

### E-Commerce Integration
- ✅ Configured WooCommerce from scratch
- ✅ Created 4 digital products with descriptions
- ✅ Set up payment gateways
- ✅ Configured shipping zones
- ✅ Customized product pages

### Performance & SEO
- ✅ Integrated caching system
- ✅ Optimized for search engines
- ✅ Implemented SEO best practices
- ✅ Added contact form functionality

---

## 💻 Code Highlights

### Custom Post Type Registration
```php
// Register Events custom post type with 6 custom fields
function create_events_post_type() {
    register_post_type('event', array(
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-calendar-alt',
        'rewrite' => array('slug' => 'events'),
    ));
}
```

### Custom CSS Variables
```css
:root {
    --primary-color: #2563eb;
    --secondary-color: #10b981;
    --accent-color: #f59e0b;
    /* + 20 more custom properties */
}
```

### Events Shortcode
```php
// Display events anywhere with [events_list]
function events_list_shortcode($atts) {
    // Query and display upcoming events
    // Supports custom attributes
}
add_shortcode('events_list', 'events_list_shortcode');
```

---

## 📊 Project Statistics

| Metric | Count |
|--------|-------|
| **Custom PHP Code** | 886 lines |
| **Custom CSS Code** | 493 lines |
| **Custom Templates** | 9 files |
| **Custom Post Types** | 1 (Events) |
| **Custom Fields** | 6 fields |
| **Products Created** | 4 products |
| **Plugins Integrated** | 4 plugins |
| **Total Development Time** | 4 weeks |

---

## 🚀 Installation & Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- WordPress 6.0 or higher
- Local development environment (Local by Flywheel, XAMPP, or MAMP)

### Installation Steps

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/youngdevinterns-wp.git
cd youngdevinterns-wp
```

2. **Import the database**
- Import the SQL file from `app/sql/` directory
- Update `wp-config.php` with your database credentials

3. **Activate the child theme**
- Go to Appearance → Themes
- Activate "Astra Child - YoungDevInterns"

4. **Install required plugins**
- WooCommerce
- Yoast SEO
- Contact Form 7
- W3 Total Cache

5. **Configure permalinks**
- Go to Settings → Permalinks
- Select "Post name" structure
- Save changes

---

## 🎨 Design System

### Color Palette
- **Primary:** #2563eb (Blue)
- **Secondary:** #10b981 (Green)
- **Accent:** #f59e0b (Orange)
- **Text:** #1f2937 (Dark Gray)
- **Background:** #ffffff (White)

### Typography
- **Headings:** Poppins (Google Fonts)
- **Body:** Inter (Google Fonts)
- **Code:** Monospace

### Responsive Breakpoints
- **Mobile:** < 480px
- **Tablet:** 481px - 768px
- **Desktop:** > 768px

---

## 📸 Screenshots

### Homepage
![Homepage](screenshots/homepage.png)

### Events Page
![Events](screenshots/events.png)

### Shop Page
![Shop](screenshots/shop.png)

### Product Page
![Product](screenshots/product.png)

---

## 🔧 Customization

### Adding New Events
1. Go to Events → Add New
2. Fill in event details
3. Add custom fields (date, time, location, etc.)
4. Set featured image
5. Publish

### Creating New Products
1. Go to Products → Add New
2. Add product details and pricing
3. Configure product type (virtual/downloadable)
4. Set product image
5. Publish

### Modifying Theme Styles
Edit `wp-content/themes/astra-child/style.css` to customize:
- Colors (CSS variables)
- Typography
- Layout
- Spacing
- Animations

---

## 🤝 Contributing

This is a personal portfolio project, but suggestions and feedback are welcome!

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Open a Pull Request

---

## 📝 License

This project is created for educational purposes as part of the YoungDevInterns internship program.

---

## 👨‍💻 Developer

**Developed by:** YoungDevInterns Student  
**Program:** WordPress Development Internship  
**Company:** [YoungDevInterns](https://youngdevinterns.com)  
**Duration:** 4 Weeks  
**Completion Date:** December 2025

---

## 🙏 Acknowledgments

- **YoungDevInterns** for the internship opportunity
- **WordPress Community** for excellent documentation
- **Astra Theme** for the solid parent theme foundation
- **WooCommerce** for e-commerce functionality

---

## 📞 Contact

For questions or feedback about this project:

- **LinkedIn:** [Your LinkedIn Profile]
- **Email:** your.email@example.com
- **Portfolio:** [Your Portfolio Website]

---

## 🎓 Skills Demonstrated

✅ WordPress Theme Development  
✅ Custom Post Types & Fields  
✅ PHP & MySQL  
✅ HTML/CSS/JavaScript  
✅ WooCommerce Integration  
✅ Responsive Design  
✅ SEO Optimization  
✅ Performance Optimization  
✅ Git Version Control  
✅ Plugin Integration  

---

**⭐ If you found this project helpful, please consider giving it a star!**

---

*Last Updated: December 2025*
