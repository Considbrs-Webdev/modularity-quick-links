# Modularity Quick Links

A Modularity module that creates a responsive grid of link cards for quick navigation to important pages. Perfect for creating service menus, feature highlights, or navigation shortcuts.

## Description

This plugin provides a Quick Links module for the Modularity plugin ecosystem. It allows editors to create visually appealing grids of clickable cards that link to important pages, with flexible options for icons, descriptions, and layout configuration.

## Features

- **Flexible Grid Layout**: Display links in a responsive grid with configurable items per row
- **Optional Icons**: Add icons to each link card for visual recognition
- **Icon Sizes**: Choose between small or large icon display
- **Short Descriptions**: Optionally add descriptions to provide context for each link
- **Configurable Gap**: Set spacing between cards from 0 to 5rem
- **Responsive Design**: Automatically adapts to different screen sizes
- **Highly Customizable**: Extend styling via CSS custom properties

## Configuration Options

### Module Settings

Each Quick Links module instance can be configured with:

1. **Max items per row**: Control the grid layout (2, 4, 6, or 8 items per row)
2. **Icons**: Toggle icon display on/off
3. **Large icons**: When icons are enabled, choose between small (inline with title) or large (above title, centered)
4. **Short description**: Toggle description display on/off
5. **Link gap**: Set spacing between cards:
   - 0: No gap (1px border style between cards)
   - 1-10: Gap from 0.5rem to 5rem

### Link Items

For each link you can configure:

- **Icon**: Select an icon (when icons are enabled)
- **Title**: The link text/heading
- **Link**: The destination URL
- **Description**: A short description (when descriptions are enabled)

## CSS Variables

The module uses CSS custom properties that can be customized in your theme:

### Card Appearance
- `--quick-links-card-min-width`: Minimum card width (default: `250px`, or `175px` without descriptions)
- `--quick-links-card-padding-x`: Horizontal padding (default: `1.5rem`)
- `--quick-links-card-padding-y`: Vertical padding (default: `1.5rem`)
- `--quick-links-background-color`: Card background (default: `#ffffff`)
- `--quick-links-border-color`: Border color (default: `#e0e0e0`)
- `--quick-links-border-width`: Outer border width (default: `1px`)
- `--quick-links-inner-border-width`: Border between cards when gap is 0 (default: `1px`)
- `--quick-links-border-radius`: Border radius (default: `0`)

### Hover Effects
- `--quick-links-hover-amount`: Hover overlay opacity (default: `0.1`)
- `--quick-links-hover-color`: Hover overlay color (default: `rgba(0, 0, 0, var(--quick-links-hover-amount))`)
- `--quick-links-transition`: Transition timing (default: `background-color 0.2s ease`)

### Icons
- `--quick-links-icon-size`: Small icon size (default: `1.5rem`)
- `--quick-links-icon-size-large`: Large icon size (default: `3rem`)
- `--quick-links-icon-gap`: Gap between icon and text (default: `1rem`)
- `--quick-links-icon-color`: Icon color (default: `#1a1a1a`)

### Typography
- `--quick-links-title-color`: Title text color (default: `#1a1a1a`)
- `--quick-links-description-color`: Description text color (default: `#1a1a1a`)
- `--quick-links-item-row-gap`: Gap between title and description (default: `1rem`)

### Spacing
- `--quick-links-gap`: Gap between cards (automatically set based on `link_gap` setting)

## Example CSS Customization

```css
/* Custom theme styling for Quick Links */
.modularity-quick-links {
    --quick-links-background-color: #f5f5f5;
    --quick-links-border-color: #0073aa;
    --quick-links-border-radius: 8px;
    --quick-links-icon-color: #0073aa;
    --quick-links-hover-color: rgba(0, 115, 170, 0.1);
}

/* Make icons larger */
.modularity-quick-links {
    --quick-links-icon-size: 2rem;
    --quick-links-icon-size-large: 4rem;
}

/* Add more padding */
.modularity-quick-links {
    --quick-links-card-padding-x: 2rem;
    --quick-links-card-padding-y: 2rem;
}
```

## Responsive Behavior

The grid automatically adapts to screen sizes:

- **Desktop**: Displays configured number of items per row
- **Tablet** (< 768px): Reduces columns (e.g., 4 → 2)
- **Mobile** (< 480px): Single column layout

## Requirements

- WordPress
- [Modularity](https://github.com/helsingborg-stad/modularity) plugin
- [Municipio](https://github.com/helsingborg-stad/municipio) theme (for icon component)
- Advanced Custom Fields (ACF) Pro

## Installation

1. Clone or download this repository to your WordPress plugins directory
2. Run `composer install` to install dependencies
3. Run `npm install && npm run build` to build assets
4. Activate the plugin through the WordPress admin panel
5. The "Quick Links" module will now be available in Modularity

## Usage

1. Edit a page or post where Modularity is enabled
2. Add a new module and select "Quick Links"
3. Configure the display options (icons, descriptions, items per row, gap)
4. Add your links with titles, URLs, and optionally icons and descriptions
5. Publish or update the page

## Development

### Build Assets

```bash
npm install
npm run build
```

### Watch for Changes

```bash
npm run dev
```

## License

MIT
