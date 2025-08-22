# Imagine Your Home - Professional House Planning Website

## Features
- **Responsive Design**: Mobile, tablet, and desktop compatible
- **Professional Theme**: Blue, white, and green color scheme
- **Animated Elements**: Smooth animations and micro-interactions
- **House Plan Form**: Comprehensive form with accordion layout
- **Admin Panel**: Full data management with export functionality
- **UPI Payment**: Integrated payment gateway
- **SEO Optimized**: Meta tags and search engine friendly
- **Visitor Counter**: Track website visits
- **Database Ready**: MySQL compatible with shared hosting

## Installation Instructions

### For Hostinger or Shared Hosting:

1. **Database Setup**:
   - Create a new MySQL database in your hosting panel
   - Update database credentials in `db.php`:
     ```php
     $servername = "localhost";
     $username = "your_db_username";
     $password = "your_db_password";
     $dbname = "your_db_name";
     ```

2. **File Upload**:
   - Upload all files to your domain's public_html folder
   - Ensure proper file permissions (755 for folders, 644 for files)

3. **Access**:
   - Website: `https://yourdomain.com`
   - Admin Panel: `https://yourdomain.com/admin.php`
   - Emergency Admin: `https://yourdomain.com/bypass.php?token=emergency_access_2025`

### Default Admin Credentials:
- **Username**: `admin`
- **Emergency Token**: `emergency_access_2025`

### WhatsApp Configuration:
Update the WhatsApp number in `index.php`:
```php
href="https://wa.me/919999999999?text=Hello, I need help with house planning"
```

### UPI Configuration:
Update UPI ID in `index.php`:
```php
<p><strong>UPI ID:</strong> imaginehome@upi</p>
```

## File Structure
```
/
├── index.php          # Main website
├── admin.php          # Admin panel
├── login.php          # Admin login
├── bypass.php         # Emergency admin access
├── submit.php         # Form submission handler
├── get_details.php    # Admin detail viewer
├── export.php         # Excel export
├── logout.php         # Admin logout
├── counter.php        # Visitor counter
├── db.php            # Database connection
├── style.css         # Website styling
├── script.js         # Website JavaScript
├── admin.js          # Admin panel JavaScript
└── README.md         # This file
```

## Database Tables
The system automatically creates the following tables:
- `house_plans`: Customer submissions
- `admins`: Admin users
- `visitor_count`: Website visitor tracking

## Features Overview

### Website Features:
- ✅ Professional blue/white/green theme
- ✅ Fully responsive design
- ✅ Animated WhatsApp help button
- ✅ Comprehensive house planning form
- ✅ UPI payment integration
- ✅ SEO optimized meta tags
- ✅ Visitor counter
- ✅ Form validation and submission

### Admin Features:
- ✅ Secure admin login
- ✅ Emergency bypass access
- ✅ View all submissions
- ✅ Filter by name, mobile, date
- ✅ Export data to Excel
- ✅ Change username/password
- ✅ Detailed submission viewer

### Technical Features:
- ✅ SQL injection protection
- ✅ Hostinger compatibility
- ✅ Mobile-first design
- ✅ Cross-browser compatibility
- ✅ Performance optimized

## Support
For technical support, contact: GTAi.in
Developed by: GalaxyTribes

## License
© 2025 All Rights Reserved By GTAi.in | Managed & Developed By GalaxyTribes