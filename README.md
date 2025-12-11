# [PROJECT] Website Template

**PHP Website Template with Admin Panel**

## Project Overview

This is a customizable PHP website template with an admin panel for managing content. It provides a foundation for building content-driven websites with news, articles, events, and more.

## Technology Stack

### Frontend
- **HTML5** - Semantic markup
- **Bootstrap 5** - Responsive UI framework with custom theming
- **Custom SCSS** - Custom Bootstrap variables and utilities
- **jQuery** - DOM manipulation and AJAX
- **Bootstrap Icons** - Icon library

### Backend
- **PHP** - Server-side scripting
- **Composer** - PHP dependency management
  - `ramsey/uuid` - UUID generation
  - `brick/math` - Arbitrary precision mathematics

### Build Tools
- **SCSS** - CSS preprocessing
- **npm** - Package management for frontend dependencies

## Project Structure

```
[PROJECT]/
├── index.php              # Homepage
├── pages/                 # Application pages
│   ├── about.php         # About the project
│   ├── contact.php       # Contact information
│   ├── events.php        # Events listing
│   ├── articles.php      # Articles/publications
│   ├── news.php          # News updates
│   ├── latest.php        # Latest updates (combined feed)
│   ├── login.php         # Admin login
│   └── admin/            # Admin section
│       └── main.php      # Admin dashboard
├── components/           # Reusable PHP components
│   └── navbar.php        # Navigation bar
├── actions/              # Server-side action handlers
│   ├── login.php         # Login processing
│   └── temp.php          # Temporary actions
├── classes/              # PHP classes
│   ├── security.class.php   # Security utilities
│   └── tools.class.php      # Helper tools
├── config/               # Configuration files
│   └── constants.php     # Application constants
├── css/                  # Stylesheets
│   ├── bs-custom.css     # Compiled Bootstrap
│   └── scss/             # SCSS source files
│       ├── bs-custom.scss      # Main SCSS file
│       ├── _variables.scss     # Bootstrap variable overrides
│       └── _utilities.scss     # Custom utility classes
├── images/               # Image assets
│   ├── bg/              # Background images
│   ├── content/         # Content images
│   ├── header/          # Header images
│   └── logos/           # Logo files
├── video/                # Video assets
├── vendor/               # Composer dependencies
└── node_modules/         # npm dependencies

```

## Installation

### Prerequisites
- PHP 8 or higher
- Composer
- Node.js and npm
- Web server (Apache/Nginx)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd [PROJECT]
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Compile SCSS to CSS**
   ```bash
   # If using sass compiler
   sass css/scss/bs-custom.scss css/bs-custom.css
   ```

5. **Configure web server**
   - Point document root to the project directory
   - Ensure PHP is enabled
   - For XAMPP: Place in `htdocs/[PROJECT]`

6. **Access the application**
   - Navigate to `http://localhost/[PROJECT]/` in your browser

## Features

### Public Pages
- **Home** - Project overview and key information
- **About** - Detailed project description and objectives
- **News** - Latest news and updates
- **Articles** - Research articles and publications
- **Events** - Upcoming events and registration
- **Latest** - Combined feed of recent updates
- **Contact** - Contact information for project coordinator

### Admin Features
- **Login System** - Secure admin authentication (in development)
- **Admin Dashboard** - Content management interface
- **Content Management** - Add/edit events, articles, and news

## Development

### Custom Bootstrap Theme
The project uses a custom Bootstrap theme with:
- Custom color variables (primary, secondary)
- Custom gradient backgrounds
- Responsive navbar with hover dropdowns
- Custom HR styling with gradient effects
- Background image overlays

### SCSS Compilation
To compile SCSS changes:
```bash
sass --watch css/scss:css
```

### File Organization
- Place new pages in the `pages/` directory
- Reusable components go in `components/`
- Backend logic in `actions/` and `classes/`
- Images organized by type in `images/` subdirectories

## Browser Support
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Security
- Input validation and sanitization (in development)
- Secure password handling
- CSRF protection (planned)
- XSS prevention

## Contributing
Feel free to fork this template and customize it for your own projects. This is a starting point for building content-driven websites.

## License
This template is provided as-is. Customize and use as needed for your projects.

## Contact
For questions or support, update the contact information in the `pages/contact.php` file.

---

© 2025 [PROJECT]. All rights reserved.

