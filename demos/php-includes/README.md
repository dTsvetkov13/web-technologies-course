# Demo 4 - PHP Includes for Code Reusability

## Overview
This demo shows the same AJAX functionality as Demo 1, but demonstrates how to use PHP includes to reuse common HTML elements (header, footer) across multiple pages.

## Key Concepts
- **PHP Includes**: Using `include` or `require` to reuse code
- **Separation of Concerns**: Header and footer in separate files
- **Code Reusability**: Write once, use everywhere
- **Maintainability**: Update header/footer in one place

## Structure
```
demo-php-includes/
├── index.php           # Main page (converted from HTML)
├── about.php           # Example second page
├── includes/
│   ├── header.php      # Reusable header
│   └── footer.php      # Reusable footer
├── api/
│   └── process.php     # Same API as demo1
├── css/
│   └── styles.css      # Same styles as demo1
└── js/
    └── app.js          # Same JS as demo1
```

## How to Run
1. Place in XAMPP's `htdocs` folder
2. Start Apache
3. Navigate to `http://localhost/demo-php-includes/`

## What's Different from Demo 1?
- `index.html` → `index.php` (PHP file)
- Header extracted to `includes/header.php`
- Footer extracted to `includes/footer.php`
- Added `about.php` to show reusability across multiple pages
