<?php
/**
 * DIY Home Improvement Theme Functions
 *
 * @package DIY_Home_Improvement
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup function
 */
function diy_theme_setup() {
    // Add theme support for various WordPress features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    
    // Add custom logo support
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'diy-home-improvement'),
        'footer'  => __('Footer Menu', 'diy-home-improvement'),
    ));

    // Add support for custom background
    add_theme_support('custom-background', array(
        'default-color' => 'f8fafc',
    ));

    // Set content width
    if (!isset($content_width)) {
        $content_width = 1200;
    }
}
add_action('after_setup_theme', 'diy_theme_setup');

/**
 * Enqueue scripts and styles
 */
function diy_theme_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style(
        'diy-theme-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );

    // Enqueue custom JavaScript
    wp_enqueue_script(
        'diy-theme-script',
        get_template_directory_uri() . '/assets/js/theme.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );

    // Add inline script for mobile menu toggle
    wp_add_inline_script('diy-theme-script', '
        document.addEventListener("DOMContentLoaded", function() {
            const mobileMenuButton = document.getElementById("mobile-menu-button");
            const mobileMenu = document.getElementById("mobile-menu");
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener("click", function() {
                    mobileMenu.classList.toggle("hidden");
                    const expanded = mobileMenuButton.getAttribute("aria-expanded") === "true";
                    mobileMenuButton.setAttribute("aria-expanded", !expanded);
                });
            }
        });
    ');

    // Enqueue comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'diy_theme_scripts');

/**
 * Register widget areas
 */
function diy_theme_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'diy-home-improvement'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'diy-home-improvement'),
        'before_widget' => '<section id="%1$s" class="widget bg-white rounded-lg shadow-sm p-6 mb-6 %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title text-lg font-semibold text-gray-900 mb-4">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'diy-home-improvement'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'diy-home-improvement'),
        'before_widget' => '<div id="%1$s" class="footer-widget mb-6 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-lg font-semibold text-white mb-4">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'diy_theme_widgets_init');

/**
 * Custom excerpt length
 */
function diy_theme_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'diy_theme_excerpt_length');

/**
 * Custom excerpt more text
 */
function diy_theme_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'diy_theme_excerpt_more');

/**
 * Add custom body classes
 */
function diy_theme_body_classes($classes) {
    // Add class for JavaScript detection
    $classes[] = 'no-js';
    
    // Add class for page layout
    if (is_singular()) {
        $classes[] = 'single-post-layout';
    }
    
    if (is_home() || is_archive()) {
        $classes[] = 'archive-layout';
    }
    
    return $classes;
}
add_filter('body_class', 'diy_theme_body_classes');

/**
 * Smart Page Builder integration functions
 */

/**
 * Add Smart Page Builder placeholder
 */
function diy_smart_page_builder_placeholder($title = 'Related Content') {
    echo '<div class="smart-page-builder-placeholder" data-spb-area="' . esc_attr(strtolower(str_replace(' ', '-', $title))) . '">';
    echo '<p>' . esc_html($title) . ' will be dynamically inserted here by Smart Page Builder</p>';
    echo '</div>';
}

/**
 * Get post categories for Smart Page Builder context
 */
function diy_get_post_context() {
    if (!is_singular('post')) {
        return array();
    }
    
    $categories = get_the_category();
    $tags = get_the_tags();
    
    $context = array(
        'post_id' => get_the_ID(),
        'categories' => array(),
        'tags' => array(),
        'post_type' => get_post_type(),
    );
    
    if ($categories) {
        foreach ($categories as $category) {
            $context['categories'][] = $category->slug;
        }
    }
    
    if ($tags) {
        foreach ($tags as $tag) {
            $context['tags'][] = $tag->slug;
        }
    }
    
    return $context;
}

/**
 * Add structured data for better SEO and AI analysis
 */
function diy_add_structured_data() {
    if (is_singular('post')) {
        $post_id = get_the_ID();
        $categories = get_the_category();
        $tags = get_the_tags();
        
        $structured_data = array(
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => get_the_title(),
            'description' => get_the_excerpt(),
            'author' => array(
                '@type' => 'Person',
                'name' => get_the_author(),
            ),
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
        );
        
        if ($categories) {
            $structured_data['articleSection'] = $categories[0]->name;
        }
        
        if (has_post_thumbnail()) {
            $structured_data['image'] = get_the_post_thumbnail_url($post_id, 'large');
        }
        
        echo '<script type="application/ld+json">' . wp_json_encode($structured_data) . '</script>';
    }
}
add_action('wp_head', 'diy_add_structured_data');

/**
 * Customize WordPress admin for better content management
 */
function diy_admin_customizations() {
    // Add custom CSS for admin
    echo '<style>
        .post-type-post .postbox-header h2 {
            color: #3b82f6;
        }
        .diy-admin-notice {
            background: linear-gradient(to right, #3b82f6, #1d4ed8);
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>';
}
add_action('admin_head', 'diy_admin_customizations');

/**
 * Add custom post meta for Smart Page Builder
 */
function diy_add_post_meta_boxes() {
    add_meta_box(
        'diy-smart-builder-settings',
        'Smart Page Builder Settings',
        'diy_smart_builder_meta_box_callback',
        'post',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'diy_add_post_meta_boxes');

/**
 * Smart Page Builder meta box callback
 */
function diy_smart_builder_meta_box_callback($post) {
    wp_nonce_field('diy_smart_builder_meta_box', 'diy_smart_builder_meta_box_nonce');
    
    $enable_related = get_post_meta($post->ID, '_diy_enable_related_content', true);
    $enable_tools = get_post_meta($post->ID, '_diy_enable_tool_recommendations', true);
    
    echo '<p><label>';
    echo '<input type="checkbox" name="diy_enable_related_content" value="1" ' . checked($enable_related, '1', false) . '>';
    echo ' Enable Related Content';
    echo '</label></p>';
    
    echo '<p><label>';
    echo '<input type="checkbox" name="diy_enable_tool_recommendations" value="1" ' . checked($enable_tools, '1', false) . '>';
    echo ' Enable Tool Recommendations';
    echo '</label></p>';
    
    echo '<p><small>These settings control which Smart Page Builder features are active for this post.</small></p>';
}

/**
 * Save Smart Page Builder meta box data
 */
function diy_save_smart_builder_meta_box($post_id) {
    if (!isset($_POST['diy_smart_builder_meta_box_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['diy_smart_builder_meta_box_nonce'], 'diy_smart_builder_meta_box')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $enable_related = isset($_POST['diy_enable_related_content']) ? '1' : '0';
    $enable_tools = isset($_POST['diy_enable_tool_recommendations']) ? '1' : '0';
    
    update_post_meta($post_id, '_diy_enable_related_content', $enable_related);
    update_post_meta($post_id, '_diy_enable_tool_recommendations', $enable_tools);
}
add_action('save_post', 'diy_save_smart_builder_meta_box');

/**
 * Add theme customizer options
 */
function diy_customize_register($wp_customize) {
    // Add section for theme options
    $wp_customize->add_section('diy_theme_options', array(
        'title'    => __('DIY Theme Options', 'diy-home-improvement'),
        'priority' => 30,
    ));
    
    // Add setting for header text color
    $wp_customize->add_setting('diy_header_text_color', array(
        'default'           => '#1f2937',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'diy_header_text_color', array(
        'label'    => __('Header Text Color', 'diy-home-improvement'),
        'section'  => 'diy_theme_options',
        'settings' => 'diy_header_text_color',
    )));
}
add_action('customize_register', 'diy_customize_register');
