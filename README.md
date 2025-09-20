# DIY Home Improvement WordPress Theme

A modern, responsive WordPress theme designed specifically for DIY and home improvement content, optimized for the Smart Page Builder plugin and WP Engine hosting.

## Overview

This theme provides a clean, professional foundation for DIY and home improvement websites with built-in support for Smart Page Builder plugin integration. It features a minimalist design using Tailwind CSS, comprehensive accessibility features, and optimized performance for WP Engine hosting.

## Features

### Design & Layout
- **Modern Minimalist Design**: Clean, uncluttered interface that puts content first
- **Responsive Design**: Mobile-first approach with seamless adaptation across all devices
- **Tailwind CSS Framework**: Utility-first CSS framework for consistent styling
- **Custom Gradient Text**: Eye-catching gradient text effects for headings
- **Inter Font Family**: Modern, highly readable typography

### Smart Page Builder Integration
- **Placeholder Areas**: Pre-built areas for dynamic content injection
- **Context-Aware**: Provides post context for AI-powered recommendations
- **Tool Recommendations**: Dedicated sections for tool and material suggestions
- **Related Content**: Dynamic related post recommendations
- **Video Integration**: Areas for tutorial video embedding

### Performance & SEO
- **WP Engine Optimized**: Built specifically for WP Engine hosting environment
- **Fast Loading**: Optimized CSS and JavaScript for quick page loads
- **SEO Friendly**: Structured data markup and semantic HTML
- **Core Web Vitals**: Optimized for Google's Core Web Vitals metrics
- **Lazy Loading**: Built-in image lazy loading support

### Accessibility
- **WCAG 2.1 AA Compliant**: Meets accessibility standards
- **Keyboard Navigation**: Full keyboard accessibility support
- **Screen Reader Friendly**: Proper ARIA labels and semantic markup
- **Focus Management**: Proper focus handling for interactive elements
- **Skip Links**: Navigation skip links for screen readers

### Content Features
- **Structured Post Templates**: Consistent layout for DIY project posts
- **Table of Contents**: Auto-generated TOC for long posts
- **Reading Time**: Calculated reading time display
- **Category Navigation**: Easy category browsing
- **Tag System**: Comprehensive tagging for content discovery
- **Author Bios**: Rich author information display

## Installation

### Requirements
- WordPress 6.0 or higher
- PHP 8.0 or higher
- WP Engine hosting (recommended)

### Installation Steps

1. **Download the Theme**
   ```bash
   # Clone or download the theme files
   git clone [repository-url] diy-home-improvement-theme
   ```

2. **Upload to WordPress**
   - Upload the `diy-home-improvement-theme` folder to `/wp-content/themes/`
   - Or zip the folder and upload via WordPress admin

3. **Activate the Theme**
   - Go to Appearance > Themes in WordPress admin
   - Find "DIY Home Improvement" and click "Activate"

4. **Configure Theme Settings**
   - Go to Appearance > Customize
   - Configure theme options and colors
   - Set up navigation menus

## Configuration

### Navigation Menus
The theme supports two menu locations:
- **Primary Menu**: Main navigation in header
- **Footer Menu**: Links in footer area

To set up menus:
1. Go to Appearance > Menus
2. Create menus and assign to locations
3. Add pages, categories, and custom links

### Widget Areas
The theme includes two widget areas:
- **Sidebar**: Main sidebar widget area
- **Footer**: Footer widget area

### Customizer Options
Available in Appearance > Customize:
- **Site Identity**: Logo, site title, tagline
- **Colors**: Header text color customization
- **Menus**: Navigation menu assignment
- **Widgets**: Widget area management

## Smart Page Builder Integration

### Placeholder Areas
The theme includes several Smart Page Builder integration points:

1. **Tool Recommendations**: `diy_smart_page_builder_placeholder('Tool Recommendations')`
2. **Related Projects**: `diy_smart_page_builder_placeholder('Related Projects')`
3. **Video Tutorials**: `diy_smart_page_builder_placeholder('Video Tutorials')`
4. **Sidebar Recommendations**: `diy_smart_page_builder_placeholder('Sidebar Recommendations')`
5. **Footer Recommendations**: `diy_smart_page_builder_placeholder('Footer Recommendations')`

### Post Meta Fields
Each post includes Smart Page Builder settings:
- **Enable Related Content**: Toggle related content recommendations
- **Enable Tool Recommendations**: Toggle tool and material suggestions

### Context Data
The theme provides rich context data for Smart Page Builder:
- Post categories and tags
- Post content analysis
- User behavior tracking
- Structured data markup

## Content Structure

### Post Template
All DIY posts should follow this structure:

1. **Title**: Clear, problem-solving title
2. **Excerpt**: Brief project overview
3. **Required Tools & Materials**: Bulleted list
4. **Step-by-Step Instructions**: Numbered instructions
5. **Tips & Tricks**: Pro tips and advice
6. **Smart Page Builder Areas**: Dynamic content sections

### Categories
Recommended categories:
- Home Repair
- Plumbing
- Electrical
- Woodworking
- Painting
- Gardening

### Tags
Use specific, searchable tags:
- Tool names (e.g., "drill", "saw")
- Materials (e.g., "drywall", "paint")
- Techniques (e.g., "sanding", "measuring")
- Problem types (e.g., "leak", "crack", "hole")

## Customization

### CSS Customization
The theme uses Tailwind CSS. To customize:

1. **Modify Tailwind Config** (if using build process):
   ```javascript
   // tailwind.config.js
   module.exports = {
     theme: {
       extend: {
         colors: {
           'custom-blue': '#your-color'
         }
       }
     }
   }
   ```

2. **Add Custom CSS**:
   ```css
   /* Add to style.css or child theme */
   .custom-class {
     /* Your custom styles */
   }
   ```

### PHP Customization
Key functions for customization:

- `diy_smart_page_builder_placeholder()`: Add Smart Page Builder areas
- `diy_get_post_context()`: Get post context data
- `diy_get_reading_time()`: Calculate reading time
- `diy_generate_toc()`: Generate table of contents

### JavaScript Customization
The theme includes modular JavaScript in `assets/js/theme.js`:

- Mobile menu functionality
- Search toggle
- Back to top button
- Smooth scrolling
- Newsletter forms
- Accessibility enhancements

## File Structure

```
diy-home-improvement-theme/
├── style.css                 # Main stylesheet with theme info
├── functions.php            # Theme functions and setup
├── index.php               # Main template file
├── header.php              # Header template
├── footer.php              # Footer template
├── single.php              # Single post template
├── sidebar.php             # Sidebar template
├── searchform.php          # Search form template
├── assets/
│   ├── css/               # Additional stylesheets
│   ├── js/
│   │   └── theme.js       # Theme JavaScript
│   └── images/            # Theme images
├── inc/                   # Include files
├── template-parts/        # Template parts
├── sample-content/        # Sample content files
└── README.md             # This file
```

## Browser Support

- Chrome (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Edge (latest 2 versions)
- iOS Safari (latest 2 versions)
- Android Chrome (latest 2 versions)

## Performance

### Optimization Features
- Minified CSS and JavaScript
- Optimized images
- Lazy loading
- Efficient database queries
- Caching-friendly markup

### WP Engine Integration
- EverCache compatibility
- CDN optimization
- Database optimization
- Security enhancements

## Accessibility

### WCAG 2.1 AA Compliance
- Proper heading hierarchy
- Sufficient color contrast
- Keyboard navigation
- Screen reader support
- Focus indicators
- Alternative text for images

### Testing
Test accessibility with:
- WAVE Web Accessibility Evaluator
- axe DevTools
- Lighthouse accessibility audit
- Screen reader testing

## SEO Features

### Built-in SEO
- Semantic HTML structure
- Structured data markup
- Open Graph meta tags
- Twitter Card support
- Breadcrumb navigation
- XML sitemap compatibility

### Recommended Plugins
- Yoast SEO or RankMath
- Schema Pro
- Google Analytics
- Google Search Console

## Development

### Local Development Setup
1. Set up local WordPress environment
2. Install theme in `/wp-content/themes/`
3. Activate theme
4. Import sample content
5. Configure Smart Page Builder (when available)

### Build Process (Optional)
For Tailwind CSS compilation:
```bash
# Install dependencies
npm install

# Build CSS
npm run build

# Watch for changes
npm run watch
```

## Troubleshooting

### Common Issues

**Theme not displaying correctly:**
- Check WordPress and PHP version requirements
- Ensure all theme files are uploaded
- Clear any caching

**Smart Page Builder not working:**
- Verify plugin is installed and activated
- Check post meta settings
- Ensure proper placeholder placement

**Performance issues:**
- Enable caching
- Optimize images
- Check for plugin conflicts

### Support

For theme support:
1. Check documentation
2. Review sample content
3. Test with default WordPress themes
4. Contact theme developer

## Changelog

### Version 1.0.0
- Initial release
- Smart Page Builder integration
- Responsive design
- Accessibility features
- WP Engine optimization

## License

This theme is licensed under the GPL v2 or later.

## Credits

- **Tailwind CSS**: Utility-first CSS framework
- **Inter Font**: Google Fonts
- **Heroicons**: SVG icons
- **WordPress**: Content management system

## Contributing

To contribute to this theme:
1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## Future Enhancements

Planned features for future versions:
- Dark mode support
- Additional Smart Page Builder integrations
- Enhanced customizer options
- Block editor patterns
- PWA features
- Advanced search functionality

---

For more information about Smart Page Builder integration and WP Engine hosting, please refer to the development documentation.
