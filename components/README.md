# Components

This directory contains reusable PHP components that are included across multiple pages of the [PROJECT] website.

## Overview

Components are modular, reusable pieces of UI that maintain consistency across the application. They are included using PHP's `include_once` or `require_once` statements.

## Available Components

### navbar.php
The main navigation bar component used across all pages of the website.

**Features:**
- Responsive Bootstrap navbar
- Dropdown menus for content sections
- Hover effects on desktop (min-width: 576px)
- Mobile-friendly collapsed menu
- Consistent branding with [PROJECT] logo
- Active page highlighting

**Usage:**
```php
<?php include_once '../components/navbar.php'; ?>
```

**Note:** Adjust the path based on your file's location:
- From root: `components/navbar.php`
- From pages/: `../components/navbar.php`
- From pages/admin/: `../../components/navbar.php`

## Creating New Components

When creating new components, follow these guidelines:

### 1. **File Naming Convention**
- Use lowercase with underscores: `component_name.php`
- Be descriptive but concise
- Examples: `footer.php`, `sidebar.php`, `breadcrumb.php`

### 2. **Component Structure**
```php
<?php
// Component logic (if needed)
// Database queries, data processing, etc.
?>

<!-- HTML markup -->
<div class="component-wrapper">
    <!-- Component content -->
</div>
```

### 3. **Path Considerations**
Components may be included from different directory levels. Consider:
- Using absolute paths when possible
- Documenting required path adjustments
- Testing from all pages that use the component

### 4. **Dependencies**
Document any dependencies:
- Bootstrap classes used
- JavaScript requirements
- CSS files needed
- Other components required

### 5. **Customization**
If a component accepts parameters:
```php
<?php
// In the component file
$title = $title ?? 'Default Title';
$class = $class ?? '';
?>

<!-- Usage in pages -->
<?php
$title = 'Custom Title';
$class = 'custom-class';
include_once '../components/custom_component.php';
?>
```

## Best Practices

1. **Keep Components Focused**
   - Each component should have a single, clear purpose
   - Avoid mixing unrelated functionality

2. **Make Components Reusable**
   - Avoid hardcoding values
   - Use parameters for customization
   - Keep styling flexible with CSS classes

3. **Maintain Consistency**
   - Follow the existing code style
   - Use Bootstrap classes when possible
   - Match the site's design patterns

4. **Documentation**
   - Comment complex logic
   - Document required parameters
   - Provide usage examples

5. **Testing**
   - Test component on all pages where it's used
   - Verify responsive behavior
   - Check browser compatibility

## Component Styling

### Bootstrap Integration
Components use Bootstrap 5 classes for styling:
- `navbar`, `navbar-expand-*` for navigation
- `container`, `row`, `col-*` for layout
- `btn`, `card`, `badge` for UI elements

### Custom Styles
Custom styles are defined in:
- `css/bs-custom.css` (compiled from SCSS)
- `css/scss/_variables.scss` (Bootstrap variable overrides)
- `css/scss/_utilities.scss` (custom utility classes)

### Icons
Components use Bootstrap Icons:
```html
<i class="bi bi-icon-name"></i>
```

## Common Includes

### From Root Level (index.php)
```php
<?php include_once 'components/navbar.php'; ?>
```

### From Pages Directory
```php
<?php include_once '../components/navbar.php'; ?>
```

### From Admin Pages
```php
<?php include_once '../../components/navbar.php'; ?>
```

## Future Components

Planned components for development:
- `footer.php` - Site footer with funding information
- `breadcrumb.php` - Breadcrumb navigation
- `sidebar.php` - Admin sidebar navigation
- `alert.php` - Reusable alert messages
- `card_template.php` - Card templates for events/news/articles
- `pagination.php` - Pagination controls
- `search_bar.php` - Search functionality
- `loading_spinner.php` - Loading indicators

## Troubleshooting

### Common Issues

**Component not displaying:**
- Check the include path is correct
- Verify file permissions
- Check for PHP errors in logs

**Styling issues:**
- Ensure Bootstrap CSS is loaded
- Check custom CSS is compiled and linked
- Verify class names are correct

**JavaScript not working:**
- Confirm jQuery and Bootstrap JS are loaded
- Check script load order
- Verify no JavaScript errors in console

## Related Files
- `/css/scss/bs-custom.scss` - Custom Bootstrap styles
- `/pages/` - Pages using components
- `/actions/` - Server-side actions for components

---

For more information about the [PROJECT] project, see the main [README.md](../README.md).

