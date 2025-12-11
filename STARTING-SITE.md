# 🚀 Starting Your Local WordPress Site

## ⚠️ Important: Site Must Be Running

Before we can work on WordPress tasks, the local site must be running in Local by Flywheel.

## 📋 Steps to Start Your Site

### Option 1: Using Local by Flywheel GUI
1. Open **Local by Flywheel** application
2. Find your site: `youngdevinterns-wp`
3. Click the **"Start"** button (green play icon)
4. Wait for the site to start (status will show "Running")
5. Click **"WP Admin"** button to access WordPress dashboard

### Option 2: Using Command Line
```powershell
# Navigate to Local sites directory
cd "C:\Users\shari\AppData\Local\Programs\Local\resources\extraResources\lightning-services"

# Start the site (if Local supports CLI)
# Note: This may vary based on Local version
```

## 🌐 Site URLs

Once the site is running, you can access:

- **Frontend:** http://youngdevinterns-wp.local
- **Admin Dashboard:** http://youngdevinterns-wp.local/wp-admin
- **Database:** Available through Local's Adminer tool

## 🔐 Login Credentials

Your WordPress admin credentials were set during initial setup. If you need to reset:

1. Open Local by Flywheel
2. Right-click on your site
3. Select "Open Site Shell"
4. Run: `wp user update admin --user_pass=newpassword`

## ✅ Verify Site is Running

You'll know the site is running when:
- Local shows green "Running" status
- You can access http://youngdevinterns-wp.local in browser
- No "Connection Refused" errors

## 🛠️ Troubleshooting

### Site Won't Start
- Check if ports 80/443 are available
- Restart Local by Flywheel
- Check Local logs for errors

### Can't Access Site
- Verify site is running in Local
- Clear browser cache
- Try different browser
- Check firewall settings

---

## 📝 Next Steps After Starting Site

Once your site is running, we'll continue with:
1. ✅ Creating blog posts with images
2. ✅ Creating "About Us" page
3. ✅ Setting homepage
4. ✅ Adding widgets

**Please start your Local by Flywheel site and let me know when it's running!**
