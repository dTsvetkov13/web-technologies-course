# PHP Includes — Code Reusability

## Overview
This demo shows how to use PHP includes to reuse common HTML elements
(header, footer) across multiple pages, instead of copying the same
markup into every file.

## Key Concepts
- **PHP Includes**: Using `include` or `require` to reuse code
- **Separation of Concerns**: Header and footer in separate files
- **Code Reusability**: Write once, use everywhere
- **Maintainability**: Update header/footer in one place

## Structure
```
php-includes/
├── index.php           # Main page
├── about.php           # Second page, reuses the same header/footer
├── includes/
│   ├── header.php      # Reusable header
│   └── footer.php      # Reusable footer
├── api/
│   └── process.php     # Endpoint called from the page via fetch
├── css/
│   └── styles.css
└── js/
    └── app.js
```

## How to Run
1. Place the course folder in XAMPP's `htdocs`
2. Start Apache
3. Open `http://localhost/web-technologies-course/demos/php-includes/`

## What to look at
- `index.php` and `about.php` both pull in the same header and footer
- Changing `includes/header.php` changes both pages at once
- The page talks to `api/process.php` with `fetch`, without reloading
