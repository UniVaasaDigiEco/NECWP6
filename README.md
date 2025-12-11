# PHP Website Template

A modern, customizable PHP website template with Bootstrap 5, featuring an admin panel for content management. Perfect for building content-driven websites with news, articles, events, and more.

[![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=flat&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

## ✨ Features

### Frontend
- 🎨 **Modern UI** - Built with Bootstrap 5 and custom SCSS theming
- 📱 **Responsive Design** - Mobile-first approach, works on all devices
- 🎯 **Reusable Components** - Modular navbar, footer, and more
- 🖼️ **Image Management** - Summernote WYSIWYG editor with image upload and browser
- 🎭 **Bootstrap Icons** - Comprehensive icon library included

### Backend
- 🔐 **Secure Authentication** - User login system with password hashing
- 👥 **User Management** - User roles and permissions
- 📝 **Content Management** - Admin panel for managing site content
- 🔒 **Security Features** - CSRF protection, input validation, XSS prevention
- 📦 **UUID Support** - Using `ramsey/uuid` for unique identifiers

### Developer Experience
- 🛠️ **Composer & NPM** - Modern dependency management
- 🎨 **SCSS/SASS** - Custom Bootstrap theming with variables
- 📁 **Organized Structure** - Clean separation of concerns
- 📚 **Well Documented** - Comprehensive code comments and documentation

## 🚀 Quick Start

### Prerequisites

- **PHP 8.0+** with PDO extension
- **MySQL/MariaDB** database
- **Composer** - [Install Composer](https://getcomposer.com/)
- **Node.js & npm** - [Install Node.js](https://nodejs.org/)
- **Web Server** - Apache/Nginx (or XAMPP/WAMP for local development)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/php-website-template.git
   cd php-website-template
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Configure environment**
   ```bash
   # Copy the example environment file
   cp .env.example.php .env.php
   
   # Edit .env.php with your database credentials
   ```

5. **Set up the database**
   ```bash
   # Import the database schema (if provided)
   # Or use your preferred method to create the database
   ```

6. **Configure web server**
   - Point document root to the project directory
   - Ensure `.htaccess` is enabled (for Apache)
   - For XAMPP: Place in `htdocs/` folder

7. **Compile SCSS (optional)**
   ```bash
   # If you modify SCSS files, recompile:
   sass css/scss/bs-custom.scss css/bs-custom.css
   
   # Or use watch mode:
   sass --watch css/scss:css
   ```

8. **Access the application**
   - Navigate to `http://localhost/your-project-name/` in your browser

## 📁 Project Structure

```
.
├── index.php                 # Homepage
├── pages/                    # Application pages
│   ├── about.php            # About page
│   ├── contact.php          # Contact page
│   ├── login.php            # Admin login
│   └── admin/               # Admin section
│       └── admin_main.php   # Admin dashboard
├── components/              # Reusable PHP components
│   ├── navbar.php           # Navigation bar
│   └── footer.php           # Footer
├── actions/                 # Server-side action handlers
│   ├── login.php            # Login processing
│   ├── logout.php           # Logout handler
│   ├── summernote_image_upload.php
│   └── get_summernote_images.php
├── classes/                 # PHP classes
│   ├── security.class.php   # Security utilities
│   ├── tools.class.php      # Helper functions
│   └── user.class.php       # User management
├── config/                  # Configuration files
│   └── constants.php        # Application constants
├── css/                     # Stylesheets
│   ├── bs-custom.css        # Compiled Bootstrap
│   └── scss/                # SCSS source files
│       ├── bs-custom.scss   # Main SCSS file
│       └── _variables.scss  # Bootstrap overrides
├── images/                  # Image assets
│   ├── logos/               # Logo files
│   └── summernote_uploads/  # Uploaded images
├── uploads/                 # File uploads
├── vendor/                  # Composer dependencies
├── node_modules/            # npm dependencies
├── composer.json            # PHP dependencies
├── package.json             # Node dependencies
└── .env.example.php         # Environment config example
```

## 🎨 Customization

### Change Branding

Replace `[PROJECT]` placeholders throughout the codebase:
- `components/navbar.php` - Site name and logo
- `components/footer.php` - Copyright notice
- `pages/contact.php` - Contact information
- Update logo files in `images/logos/`

### Custom Styling

1. Edit SCSS variables in `css/scss/_variables.scss`
2. Modify `css/scss/bs-custom.scss` for custom styles
3. Recompile: `sass css/scss/bs-custom.scss css/bs-custom.css`

### Add New Pages

1. Create new PHP file in `pages/` directory
2. Include navbar and footer components
3. Add navigation link in `components/navbar.php`

## 🔐 Security

This template includes several security features:

- ✅ Password hashing with PHP's `password_hash()`
- ✅ Prepared SQL statements (PDO)
- ✅ Input validation and sanitization
- ✅ CSRF token protection
- ✅ XSS prevention
- ✅ Secure session handling
- ✅ `.htaccess` protection for sensitive directories

**Important:** Always review and test security measures before deploying to production.

## 🛠️ Development

### Compile SCSS

```bash
# One-time compilation
sass css/scss/bs-custom.scss css/bs-custom.css

# Watch for changes
sass --watch css/scss:css
```

### Database Setup

Configure your database connection in `.env.php`:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_database');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
```

## 📦 Dependencies

### PHP (Composer)
- `ramsey/uuid` - UUID generation
- `brick/math` - Arbitrary precision mathematics

### JavaScript (npm)
- `bootstrap` - Frontend framework
- `bootstrap-icons` - Icon library
- `jquery` - DOM manipulation
- `summernote` - WYSIWYG editor
- `flatpickr` - Date/time picker

## 🌐 Browser Support

- ✅ Chrome (latest)
- ✅ Firefox (latest)
- ✅ Safari (latest)
- ✅ Edge (latest)
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)

## 📝 License

This project is open source and available under the [MIT License](LICENSE).

## 🤝 Contributing

Contributions, issues, and feature requests are welcome! Feel free to fork this project and customize it for your needs.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 💡 Usage Tips

- **Admin Panel**: Access at `/pages/admin/admin_main.php` after logging in
- **Image Upload**: Uses Summernote with server-side upload to `images/summernote_uploads/`
- **Components**: Reusable components in `/components/` - easy to maintain
- **Security**: Remember to change default credentials and secure your `.env.php` file

## 📧 Support

For questions or support, please open an issue on GitHub.

## 🙏 Acknowledgments

- Built with [Bootstrap 5](https://getbootstrap.com/)
- Icons by [Bootstrap Icons](https://icons.getbootstrap.com/)
- WYSIWYG editor by [Summernote](https://summernote.org/)

---

**Made with ❤️ by the community**

Replace `[PROJECT]` with your project name and customize to fit your needs!

