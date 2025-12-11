# Task 3.3: WooCommerce Setup

## 📋 Task Description
Install and configure WooCommerce to set up an online store. Create custom product pages and manage inventory, shipping, and payment methods.

## ⏳ Status: NOT STARTED

## 🎯 Objectives
- [ ] Install and configure WooCommerce
- [ ] Set up online store
- [ ] Create custom product pages
- [ ] Configure inventory management
- [ ] Set up shipping methods
- [ ] Configure payment gateways

## 🛠️ Tools Used
- WooCommerce Plugin
- Payment Gateway Plugins (Stripe, PayPal)
- WooCommerce Settings
- Product Management

## 📝 Implementation Steps

### Step 1: Install WooCommerce

1. Go to **Plugins → Add New**
2. Search for "WooCommerce"
3. Click **Install Now**
4. Click **Activate**
5. Run WooCommerce Setup Wizard

### Step 2: WooCommerce Setup Wizard

#### Store Details:
```
Store Address: [Your Address]
City: [Your City]
Country/Region: [Your Country]
Postcode: [Your Postcode]
Store Currency: USD ($)
```

#### Industry:
- Select: Education / Technology / Services

#### Product Types:
- [x] Physical products
- [x] Digital products
- [ ] Subscriptions (optional)

#### Business Details:
```
Number of products: 1-10
Currently selling: No
```

#### Theme:
- Keep current theme (Astra) - WooCommerce compatible

#### Payment Setup:
- Enable offline payments (for testing)
- Set up Stripe (recommended)
- Set up PayPal (optional)

### Step 3: Configure Store Settings

#### General Settings (WooCommerce → Settings):

**Store Address:**
```
Address Line 1: 123 Main Street
City: Your City
Postcode: 12345
Country: United States
```

**Currency Options:**
```
Currency: US Dollar ($)
Currency Position: Left ($99.99)
Thousand Separator: ,
Decimal Separator: .
Number of Decimals: 2
```

#### Products Settings:

**Shop Page:**
- Shop page: Select "Shop" page
- Products per page: 12
- Product rows: 4

**Measurements:**
```
Weight Unit: lbs
Dimensions Unit: in
```

**Inventory:**
- [x] Enable stock management
- [x] Hold stock (minutes): 60
- [x] Notifications: Enable low stock notifications
- Low stock threshold: 2
- Out of stock threshold: 0

#### Shipping Settings:

**Shipping Zones:**

**Zone 1: United States**
```
Zone Name: United States
Regions: United States

Shipping Methods:
1. Flat Rate
   - Cost: $5.00
   - Tax Status: Taxable

2. Free Shipping
   - Minimum order amount: $50.00

3. Local Pickup
   - Cost: $0.00
```

**Zone 2: International**
```
Zone Name: International
Regions: All other countries

Shipping Methods:
1. Flat Rate
   - Cost: $15.00
```

#### Payment Settings:

**Enable Payment Methods:**

1. **Direct Bank Transfer**
   - Title: Direct Bank Transfer
   - Description: Make payment directly into our bank account
   - Instructions: [Bank details]

2. **Check Payments**
   - Title: Check Payments
   - Description: Pay by check

3. **Cash on Delivery**
   - Title: Cash on Delivery
   - Description: Pay with cash upon delivery

4. **Stripe** (Recommended)
   - Install Stripe plugin
   - Get API keys from Stripe dashboard
   - Enable test mode for development

#### Tax Settings:

```
Enable Taxes: Yes
Prices Entered With Tax: No, I will enter prices exclusive of tax
Calculate Tax Based On: Customer shipping address
Shipping Tax Class: Standard
Rounding: No rounding

Standard Rate:
- Country: US
- State: [Your State]
- Rate: 7.5%
- Tax Name: Sales Tax
```

### Step 4: Create Products

#### Product 1: WordPress Course (Digital Product)

```
Product Name: Complete WordPress Development Course
Regular Price: $99.00
Sale Price: $79.00 (optional)
SKU: WP-COURSE-001

Product Description:
Master WordPress development from beginner to advanced level. 
Learn theme development, plugin creation, and more.

Short Description:
Complete WordPress course with 50+ hours of content

Product Data: Simple Product
- Virtual: Yes
- Downloadable: Yes
- Download Limit: Unlimited
- Download Expiry: Never

Categories: Courses, WordPress
Tags: wordpress, development, course, learning

Product Image: [Upload course thumbnail]
Product Gallery: [Upload additional images]
```

#### Product 2: Web Development eBook (Digital Product)

```
Product Name: Modern Web Development Guide
Regular Price: $29.00
SKU: EBOOK-001

Product Description:
Comprehensive guide to modern web development practices.

Product Data: Simple Product
- Virtual: Yes
- Downloadable: Yes
- File: [Upload PDF]

Categories: eBooks, Web Development
Tags: ebook, web development, guide
```

#### Product 3: WordPress Theme (Digital Product)

```
Product Name: Premium WordPress Theme
Regular Price: $59.00
SKU: THEME-001

Product Description:
Professional WordPress theme for business websites.

Product Data: Simple Product
- Virtual: Yes
- Downloadable: Yes
- File: [Upload theme ZIP]

Categories: Themes
Tags: theme, wordpress, premium
```

#### Product 4: Consulting Service (Service Product)

```
Product Name: WordPress Consultation (1 Hour)
Regular Price: $150.00
SKU: CONSULT-001

Product Description:
One-on-one WordPress consultation session.

Product Data: Simple Product
- Virtual: Yes

Categories: Services
Tags: consulting, wordpress, service
```

#### Product 5: Physical Product (Optional)

```
Product Name: WordPress Developer T-Shirt
Regular Price: $25.00
SKU: TSHIRT-001

Product Description:
Premium quality t-shirt for WordPress developers.

Product Data: Simple Product
- Weight: 0.5 lbs
- Dimensions: 10 x 8 x 1 in

Inventory:
- Stock: 100
- Allow backorders: No

Shipping:
- Shipping Class: Standard

Categories: Merchandise
Tags: tshirt, merchandise, apparel
```

### Step 5: Customize Product Pages

**Create custom product template** (`woocommerce/single-product.php`):

```php
<?php
/**
 * Custom Single Product Template
 */
get_header('shop');
?>

<div class="custom-product-page">
    <?php
    while (have_posts()) :
        the_post();
        wc_get_template_part('content', 'single-product');
    endwhile;
    ?>
</div>

<?php
get_footer('shop');
?>
```

**Add custom CSS for products:**

```css
/* Product Page Styles */
.woocommerce div.product {
    background: #fff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.woocommerce div.product .product_title {
    color: var(--primary-color);
    font-size: 2rem;
    margin-bottom: 1rem;
}

.woocommerce div.product p.price {
    color: var(--secondary-color);
    font-size: 1.8rem;
    font-weight: 700;
}

.woocommerce div.product .woocommerce-product-gallery {
    margin-bottom: 2rem;
}

.woocommerce div.product form.cart {
    margin: 2rem 0;
}

.woocommerce div.product form.cart .button {
    background: var(--primary-color);
    color: #fff;
    padding: 1rem 2rem;
    font-size: 1.1rem;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.woocommerce div.product form.cart .button:hover {
    background: var(--secondary-color);
    transform: translateY(-2px);
}

/* Shop Page Grid */
.woocommerce ul.products {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 2rem;
}

.woocommerce ul.products li.product {
    background: #fff;
    border-radius: 10px;
    padding: 1rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: transform 0.3s ease;
}

.woocommerce ul.products li.product:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Cart Page */
.woocommerce-cart table.cart {
    border-radius: 10px;
    overflow: hidden;
}

.woocommerce-cart .cart-collaterals {
    background: #fff;
    padding: 2rem;
    border-radius: 10px;
}
```

### Step 6: Test Store Functionality

**Testing Checklist:**

- [ ] Add product to cart
- [ ] Update cart quantities
- [ ] Remove items from cart
- [ ] Apply coupon code
- [ ] Proceed to checkout
- [ ] Fill shipping information
- [ ] Select shipping method
- [ ] Select payment method
- [ ] Place test order
- [ ] Verify order confirmation email
- [ ] Check order in admin panel
- [ ] Process order (mark as completed)
- [ ] Test refund process

### Step 7: Create Coupon Codes

Go to **Marketing → Coupons → Add Coupon**:

**Coupon 1: Welcome Discount**
```
Coupon Code: WELCOME10
Discount Type: Percentage discount
Coupon Amount: 10
Allow free shipping: Yes
Expiry Date: [1 month from now]
Usage Limit: 1 per user
```

**Coupon 2: First Purchase**
```
Coupon Code: FIRST20
Discount Type: Fixed cart discount
Coupon Amount: 20
Minimum Spend: $50
```

## 📸 Screenshots to Capture

- [ ] WooCommerce dashboard
- [ ] Product creation screen
- [ ] Shop page with products
- [ ] Single product page
- [ ] Shopping cart
- [ ] Checkout page
- [ ] Order confirmation
- [ ] Admin orders page

## 🎓 Key Learnings

### WooCommerce Basics:
- Product types (simple, variable, grouped)
- Inventory management
- Shipping zones and methods
- Payment gateways
- Tax configuration

### E-commerce Best Practices:
- Clear product descriptions
- High-quality product images
- Multiple payment options
- Transparent shipping costs
- Easy checkout process
- Mobile-responsive design

### Store Management:
- Order processing workflow
- Customer management
- Inventory tracking
- Sales reports and analytics
- Coupon and promotion management

## 🌐 Social Media Post Template

```
🛒 Task 9 Completed: WooCommerce Store Setup!

Built a complete e-commerce store with WooCommerce as part of @YoungDevInterns internship!

✅ Installed and configured WooCommerce
✅ Created 5+ products (digital & physical)
✅ Set up shipping zones and methods
✅ Configured payment gateways
✅ Customized product pages
✅ Tested complete checkout process

From learning to selling - WordPress + WooCommerce is powerful! 💪

#WooCommerce #Ecommerce #WordPress #OnlineStore #YoungDevInterns #WebDevelopment
```

## 🔗 Resources

- [WooCommerce Documentation](https://woocommerce.com/documentation/)
- [WooCommerce Theme Development](https://woocommerce.com/document/woocommerce-theme-developer-handbook/)
- [Stripe Integration](https://woocommerce.com/products/stripe/)
- [PayPal Integration](https://woocommerce.com/products/woocommerce-gateway-paypal-checkout/)

## 🎉 Internship Completion

**Congratulations!** This is the final task of the WordPress Development Internship.

### What You've Accomplished:
✅ Week 1: WordPress setup, content management, widgets  
✅ Week 2-3: Theme customization, plugins, user management  
✅ Week 4: Custom post types, theme development, WooCommerce  

### Next Steps:
1. Review all completed tasks
2. Create final portfolio showcase
3. Share internship completion on LinkedIn/Facebook
4. Request internship certificate
5. Continue building WordPress projects!

---

**Task Status:** Not Started  
**Planned Date:** Week 4  
**Final Task:** Yes ✨
