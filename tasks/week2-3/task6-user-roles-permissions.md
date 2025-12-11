# Task 2.3: User Roles and Permissions

## 📋 Task Description
Create different user roles (Administrator, Editor, Author) and manage permissions and access for each role.

## ⏳ Status: NOT STARTED

## 🎯 Objectives
- [ ] Create users with different roles
- [ ] Understand WordPress user role hierarchy
- [ ] Manage permissions for each role
- [ ] Test role capabilities

## 🛠️ Tools Used
- WordPress User Management
- User Role Editor (optional plugin)
- WordPress Dashboard access levels

## 📝 Implementation Steps

### Step 1: Understanding WordPress User Roles

#### Default WordPress Roles:

**1. Administrator**
- Full access to all features
- Can install/delete plugins and themes
- Can manage all users
- Can modify site settings
- Can delete any content

**2. Editor**
- Can publish and manage posts (own and others')
- Can moderate comments
- Can manage categories and tags
- Cannot access plugins, themes, or settings
- Cannot manage users

**3. Author**
- Can publish and manage own posts
- Can upload files
- Cannot publish others' posts
- Cannot moderate comments
- Cannot manage categories

**4. Contributor**
- Can write and manage own posts
- Cannot publish posts (needs approval)
- Cannot upload files

**5. Subscriber**
- Can only manage own profile
- Can read content
- Can leave comments

### Step 2: Create Users with Different Roles

#### Create Administrator User:
1. Go to **Users → Add New**
2. Fill in details:
   ```
   Username: admin_user
   Email: admin@youngdevinterns.com
   First Name: Admin
   Last Name: User
   Role: Administrator
   Password: [Strong password]
   ```
3. Click **Add New User**

#### Create Editor User:
```
Username: editor_user
Email: editor@youngdevinterns.com
First Name: Editor
Last Name: User
Role: Editor
Password: [Strong password]
```

#### Create Author User:
```
Username: author_user
Email: author@youngdevinterns.com
First Name: Author
Last Name: User
Role: Author
Password: [Strong password]
```

#### Create Contributor User:
```
Username: contributor_user
Email: contributor@youngdevinterns.com
First Name: Contributor
Last Name: User
Role: Contributor
Password: [Strong password]
```

#### Create Subscriber User:
```
Username: subscriber_user
Email: subscriber@youngdevinterns.com
First Name: Subscriber
Last Name: User
Role: Subscriber
Password: [Strong password]
```

### Step 3: Test User Capabilities

#### Testing Checklist:

**Administrator Test:**
- [ ] Access all admin menus
- [ ] Install a plugin
- [ ] Change theme
- [ ] Create/edit/delete any post
- [ ] Manage other users

**Editor Test:**
- [ ] Create and publish post
- [ ] Edit others' posts
- [ ] Moderate comments
- [ ] Manage categories
- [ ] Verify NO access to plugins/themes

**Author Test:**
- [ ] Create and publish own post
- [ ] Upload media
- [ ] Edit own posts only
- [ ] Verify CANNOT edit others' posts

**Contributor Test:**
- [ ] Write post (pending review)
- [ ] Verify CANNOT publish
- [ ] Verify CANNOT upload media

**Subscriber Test:**
- [ ] View profile
- [ ] Verify limited dashboard access
- [ ] Verify CANNOT create posts

### Step 4: Customize User Permissions (Optional)

#### Using User Role Editor Plugin:

1. Install "User Role Editor" plugin
2. Go to **Users → User Role Editor**
3. Select role to customize
4. Check/uncheck capabilities:
   ```
   Custom Editor Capabilities:
   - read
   - edit_posts
   - delete_posts
   - publish_posts
   - upload_files
   - edit_published_posts
   - delete_published_posts
   - edit_others_posts
   - delete_others_posts
   - moderate_comments
   ```

### Step 5: Document User Management Workflow

#### User Management Best Practices:
1. Use strong passwords (12+ characters)
2. Assign minimum necessary permissions
3. Regular user audit (remove inactive users)
4. Use two-factor authentication (2FA)
5. Monitor user activity logs

## 📸 Screenshots to Capture

- [ ] User list showing all roles
- [ ] Add new user screen
- [ ] Administrator dashboard view
- [ ] Editor dashboard view (limited access)
- [ ] Author dashboard view
- [ ] User role comparison chart

## 🎓 Key Learnings

### User Role Hierarchy:
```
Administrator (Full Control)
    ↓
Editor (Content Management)
    ↓
Author (Own Content)
    ↓
Contributor (Submit for Review)
    ↓
Subscriber (Read Only)
```

### Capabilities Matrix:

| Capability | Admin | Editor | Author | Contributor | Subscriber |
|------------|-------|--------|--------|-------------|------------|
| Manage Settings | ✅ | ❌ | ❌ | ❌ | ❌ |
| Manage Plugins | ✅ | ❌ | ❌ | ❌ | ❌ |
| Manage Users | ✅ | ❌ | ❌ | ❌ | ❌ |
| Publish Posts | ✅ | ✅ | ✅ | ❌ | ❌ |
| Edit Others' Posts | ✅ | ✅ | ❌ | ❌ | ❌ |
| Upload Files | ✅ | ✅ | ✅ | ❌ | ❌ |
| Moderate Comments | ✅ | ✅ | ❌ | ❌ | ❌ |
| Read Content | ✅ | ✅ | ✅ | ✅ | ✅ |

### Security Considerations:
- Limit number of administrators
- Use unique usernames (not "admin")
- Implement strong password policy
- Enable two-factor authentication
- Regular security audits
- Monitor user login activity

## 🌐 Social Media Post Template

```
👥 Task 6 Completed: User Roles & Permissions Mastered!

Implemented comprehensive user management system as part of @YoungDevInterns internship!

✅ Created 5 different user roles
✅ Configured permissions for each role
✅ Tested all capability levels
✅ Implemented security best practices
✅ Documented user management workflow

Security and proper access control are crucial for WordPress sites! 🔐

#WordPress #UserManagement #WebSecurity #YoungDevInterns #WebDevelopment #AccessControl
```

## 🔗 Resources

- [WordPress User Roles](https://wordpress.org/support/article/roles-and-capabilities/)
- [User Role Editor Plugin](https://wordpress.org/plugins/user-role-editor/)
- [WordPress Security Best Practices](https://wordpress.org/support/article/hardening-wordpress/)

## ⏭️ Next Steps
- Move to Week 4: Expert Tasks
- Create custom post types
- Build custom theme
- Set up WooCommerce

---

**Task Status:** Not Started  
**Planned Date:** Week 2-3
