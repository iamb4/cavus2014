

## Project Structure

- `app/` - Source files for the website
  - `index.html` - Homepage
  - `about.html` - About page
  - `vintage-notes.html` - Vintage information
  - `styles/` - SCSS stylesheets
  - `scripts/` - JavaScript files
  - `images/` - Website images and assets
- `dist/` - Built/production files
- `test/` - Test files

## Technology Stack

- **Build Tool**: Grunt
- **CSS Preprocessor**: Sass/SCSS
- **Framework**: Bootstrap
- **JavaScript**: jQuery
- **Package Management**: Bower & npm

## Development

### Prerequisites

- Node.js (>= 0.10.0)
- npm

### Setup

```bash
npm install
bower install
```

### Development Server

```bash
grunt serve
```

This will start a development server at `http://localhost:9000` with live reload.

### Build

```bash
grunt build
```

Builds the project for production in the `dist/` directory.

### Testing

```bash
grunt test
```

## Features

- Responsive design with Bootstrap
- Image optimization
- CSS/JS minification and concatenation
- Live reload during development
- Sass compilation with autoprefixer
