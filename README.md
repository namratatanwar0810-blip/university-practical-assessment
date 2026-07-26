# University Practical Assessment

## Overview

This project is a custom WordPress theme developed as part of the University Practical Assessment

The website has been developed from the provided Figma design and follows WordPress development best practices. It includes a custom theme, responsive layout, a dynamic Courses section, custom post types, taxonomy, meta boxes, and a custom plugin.

---

## Features

### Custom WordPress Theme

- Fully responsive design (Desktop, Tablet & Mobile)
- Custom Header
- Custom Footer
- Homepage developed from the provided Figma design
- Dynamic Navigation Menu
- Custom Logo Support

---

## Dynamic Header

The header has been developed using WordPress dynamic features:

- Custom Logo Support
- Dynamic Primary Navigation Menu
- Responsive Mobile Navigation

---

## Dynamic Footer

The footer includes:

- Dynamic Custom Logo
- Dynamic Footer Navigation Menu
- Responsive Footer Layout
- Copyright generated using a custom shortcode

---

## Courses Custom Post Type

A custom **Courses** post type has been created to manage university programmes.

Each course supports:

- Title
- Featured Image
- Content
- Excerpt

---

## Programme Section

The **Our Programmes** section on the homepage is built dynamically using the **Courses** Custom Post Type.

Each programme displayed on the homepage is automatically fetched from the Courses post type and links to its respective **Single Course** page.

---

## Course Categories

A hierarchical taxonomy has been created for organising courses.

Example categories:

- Undergraduate
- Postgraduate

---

## Course Information Meta Box

Each Course includes custom fields for storing additional information.

Fields include:

- Course Duration
- Course Fee
- Course Level
- Admission Deadline
- Featured Course

These fields are displayed dynamically on the Single Course page.

---

## Single Course Page

A custom template (`single-courses.php`) has been created.

The page dynamically displays:

- Course Title
- Featured Image
- Course Description
- Course Duration
- Course Fee
- Course Level
- Admission Deadline
- Featured Course Status
- Course Category

---

## Custom Plugin

A custom plugin named **University Utilities** has been created.

### Shortcode

```
[university_year]
```

### Output

```
© 2026 University Website
```

The shortcode is used in the footer.

---

## Responsive Design

The website has been tested for:

- Desktop
- Tablet
- Mobile

Responsive layouts have been implemented according to the provided Figma design.

---

## Technologies Used

- WordPress
- PHP
- HTML5
- CSS3
- JavaScript
- WordPress Custom Post Types
- WordPress Custom Taxonomies
- WordPress Meta Boxes
- WordPress Shortcodes

---

## Installation

1. Clone the repository.

```bash
git clone <repository-url>
```

2. Copy the theme into:

```
wp-content/themes/
```

3. Copy the plugin into:

```
wp-content/plugins/
```

4. Activate the theme from:

```
Appearance → Themes
```

5. Activate the plugin:

```
Plugins → University Utilities
```

6. Assign the menus:

```
Appearance → Menus
```

- Primary Menu
- Footer Menu

7. Upload a Custom Logo:

```
Appearance → Customize → Site Identity
```

---

## Project Structure

```
university-theme/

├── assets/
│   ├── css/
│   ├── images/
│   └── js/
│
├── footer.php
├── front-page.php
├── functions.php
├── header.php
├── index.php
├── single-courses.php
├── style.css
└── screenshot.png

university-utilities/

└── university-utilities.php
```

---

## Notes

- Homepage sections are developed from the provided Figma design.
- The **Our Programmes** section is powered by the **Courses** Custom Post Type.
- Course information is managed using custom meta boxes.
- The footer copyright is generated using the custom shortcode provided by the **University Utilities** plugin.
- The project follows standard WordPress theme development practices.

---

## Author

**Namrata Tanwar