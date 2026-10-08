# University Programs Practical Assessment

## Overview

This project is a custom WordPress implementation for the University Programs practical assessment.

It includes:
- University website frontend based on the provided Figma design.
- Custom `program` post type.
- Custom hierarchical `program-type` taxonomy.
- 10 sample programs: 5 Undergraduate and 5 Postgraduate.
- Custom program metadata.
- React-based admin UI for program information and repeater content sections.
- Custom frontend routing for program archives, taxonomy pages and single programs.
- Reusable program cards.
- Frontend program filtering without page reload.
- Click tracking with REST API and JSON log file.
- Responsive layouts.

## Technology

- WordPress
- PHP
- HTML5
- CSS3
- JavaScript
- WordPress Interactivity API
- React
- `@wordpress/scripts`
- WordPress REST API
- XAMPP / MySQL

No third-party page builder or custom-field plugin is required for the Programs module.

## Project Structure

```text
university-theme/
├── src/
│   ├── program-admin.js
│   └── programs-interactivity.js
├── build/
│   ├── program-admin.js
│   ├── program-admin.css
│   └── programs-interactivity.js
├── archive-program.php
├── taxonomy-program-type.php
├── single-program.php
├── functions.php
├── style.css
├── package.json
└── README.md
```

## Programs Module

### Custom Post Type

Post type:

```text
program
```

Public archive:

```text
/programmes/
```

### Taxonomy

Taxonomy:

```text
program-type
```

Terms:

```text
Undergraduate
Postgraduate
```

### Sample Data

There are 10 published programs:

- 5 Undergraduate programs
- 5 Postgraduate programs

Each program contains:
- Featured image
- Title
- Academic Year
- Duration
- Content Sections

## Program URLs

### All Programs

```text
/programmes/
```

### Undergraduate

```text
/programmes/undergraduate/
```

### Postgraduate

```text
/programmes/postgraduate/
```

### Single Program

```text
/programmes/{program-slug}/
```

## Frontend Filter

The Programs archive contains:

- All
- Undergraduate
- Postgraduate

The filter works without a page reload.

When JavaScript is enabled:
- Cards are filtered on the same page.
- The browser URL is updated using `history.pushState()`.
- Browser Back/Forward navigation is supported.

The filter also contains normal links so the routes continue to work if JavaScript is unavailable.

## React Admin UI

The Program edit screen contains a custom React interface for:

- Academic Year
- Duration
- Content Sections
- Add section
- Remove section
- Reorder sections
- Expand/collapse sections
- Select section images from the WordPress Media Library

The React code is located in:

```text
src/program-admin.js
```

The compiled files are generated in:

```text
build/
```

## Build

Install dependencies:

```bash
npm install
```

Build the React assets:

```bash
npm run build
```

The project uses:

```json
"build": "wp-scripts build src/program-admin.js src/programs-interactivity.js --output-path=build --experimental-modules"
```

## Metadata

The following program metadata is registered with `register_post_meta()`:

### Academic Year

```text
academic_year
```

### Duration

```text
duration
```

### Content Sections

```text
content_sections
```

The metadata is exposed through the WordPress REST API using `show_in_rest`.

## Frontend Templates

### `archive-program.php`

Displays all programs grouped by:

- Undergraduate Programs
- Postgraduate Programs

It also provides the frontend filter.

### `taxonomy-program-type.php`

Displays the program type archive pages.

### `single-program.php`

Displays the individual program detail page including:

- Featured image
- Program title
- Program type
- Academic Year
- Duration
- Main content
- Content Sections
- Apply Now
- Enquire Now

## Click Tracking

Program interactions are tracked through a WordPress REST endpoint.

Example endpoint:

```text
/wp-json/university/v1/track-click
```

Tracked program actions include:

- Apply Now
- Enquire Now

Tracking data is written as JSON lines to:

```text
wp-content/uploads/logs/data-track.log
```

The log file is not committed to Git.

## Rewrite Rules

Program rewrite rules are flushed when the theme is activated.

After changing rewrite rules, WordPress Permalinks can also be saved from:

```text
Settings → Permalinks
```

## Development Workflow

The required Git workflow is:

```text
main
  ↓
uat
  ↓
dev
  ↓
feature/*
```

Feature work is developed on feature branches and promoted through:

```text
feature → dev → uat → main
```

Direct development commits should not be made to protected branches.

## Plan vs Actual

The original plan was to build the Programs module in separate stages:

1. CPT and taxonomy
2. Custom metadata
3. React admin interface
4. Frontend routing
5. Program cards
6. Single program page
7. Interactivity filter
8. Click tracking
9. Documentation

During implementation, the frontend filter was adjusted so that Undergraduate and Postgraduate filtering happens on the same `/programmes/` page without a page reload, while the URL is updated using `history.pushState()` and the corresponding routes remain available as fallback links.

## Setup

1. Install XAMPP with Apache and MySQL.
2. Install WordPress.
3. Copy the theme into:

```text
wp-content/themes/university-theme/
```

4. Activate the theme.
5. Open:

```text
Settings → Permalinks
```

6. Save the permalink settings.
7. Confirm the Programs post type and taxonomy are available.
8. Add/import the sample program data.
9. From the theme directory run:

```bash
npm install
npm run build
```

10. Open:

```text
/programmes/
```

## Testing Checklist

- [x] Programs CPT works.
- [x] Program taxonomy works.
- [x] Undergraduate term works.
- [x] Postgraduate term works.
- [x] 10 programs created.
- [x] Featured images added.
- [x] Academic Year added.
- [x] Duration added.
- [x] React admin UI works.
- [x] Content Sections repeater works.
- [x] Media Library image selection works.
- [x] Program archive works.
- [x] Undergraduate archive works.
- [x] Postgraduate archive works.
- [x] Single program page works.
- [x] Frontend filter works without reload.
- [x] URL updates with `history.pushState()`.
- [x] Program click tracking works.
- [x] Tracking log is generated.

## AI Disclosure

AI tools were used during development for assistance with:
- WordPress/PHP implementation guidance
- JavaScript and React implementation
- Debugging
- Documentation
- Code review and troubleshooting

All generated code was reviewed, tested and integrated into the project manually.
