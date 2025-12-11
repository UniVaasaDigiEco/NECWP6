# InnoWind

**Innovative Offshore Wind Power Infrastructure Service and Maintenance Business**

## Project Overview

InnoWind is a web platform for a project aimed at developing an innovative service and maintenance business for offshore wind power. The project focuses on integrating cutting-edge satellite technology with sustainable power generation to revolutionize how we assess, design, and monitor wind resources in challenging maritime environments.

## About the Project

InnoWind pioneers the development of expertise in:
- Utilizing satellite data for assessing wind resources and ice conditions
- Designing cost-effective offshore wind farms
- Real-time monitoring and predictive maintenance
- AI-powered analysis of satellite and IoT data from wind turbines

The project aims to optimize the efficiency, safety, and performance of wind power infrastructure while minimizing environmental impact.

### Cooperation Partners
- Etha Oy
- Infra Pohjanmaa ry
- Starsview Oy
- EPV Energia Oy
- OX2 Suomi Oy
- Suomen Hyötytuuli Oy

### Funding
This project is co-funded by the European Union, with support from:
- The Council of Ostrobothnia
- University of Vaasa
- Vaasa University of Applied Sciences

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
InnoWind/
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
   cd InnoWind
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
   - For XAMPP: Place in `htdocs/InnoWind`

6. **Access the application**
   - Navigate to `http://localhost/InnoWind/` in your browser

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
This is a research project with specific cooperation partners. For inquiries about collaboration, please contact the project coordinator.

## License
All rights reserved. This project is funded by the European Union and managed by the University of Vaasa and Vaasa University of Applied Sciences.

## Contact
**Aino Koskinen**  
Project Coordinator  
University of Vaasa

For detailed contact information, visit the Contact page on the website.

## Acknowledgments
This project is co-funded by the European Union and supported by regional and academic partners in Finland's Ostrobothnia region.

---

© 2025 InnoWind. All rights reserved.

