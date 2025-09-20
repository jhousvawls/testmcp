<?php
/**
 * The header for our theme
 *
 * @package DIY_Home_Improvement
 * @since 1.0.0
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
    
    <!-- Preload critical fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"></noscript>
    
    <!-- Remove no-js class with JavaScript -->
    <script>
        document.documentElement.classList.remove('no-js');
        document.documentElement.classList.add('js');
    </script>
</head>

<body <?php body_class('bg-gray-50 font-inter'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site min-h-screen flex flex-col">
    <a class="skip-link sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:bg-blue-600 focus:text-white focus:px-4 focus:py-2 focus:rounded" href="#primary">
        <?php esc_html_e('Skip to main content', 'diy-home-improvement'); ?>
    </a>

    <header id="masthead" class="site-header bg-white shadow-sm sticky top-0 z-40">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="header-content flex items-center justify-between py-4">
                
                <!-- Site Branding -->
                <div class="site-branding flex items-center">
                    <?php if (has_custom_logo()) : ?>
                        <div class="site-logo mr-4">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="site-identity">
                        <?php if (is_front_page() && is_home()) : ?>
                            <h1 class="site-title text-2xl font-bold">
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="text-gradient hover:opacity-80 transition-opacity" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </h1>
                        <?php else : ?>
                            <p class="site-title text-2xl font-bold mb-0">
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="text-gradient hover:opacity-80 transition-opacity" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </p>
                        <?php endif; ?>
                        
                        <?php
                        $description = get_bloginfo('description', 'display');
                        if ($description || is_customize_preview()) :
                        ?>
                            <p class="site-description text-sm text-gray-600 mt-1">
                                <?php echo $description; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Primary Navigation -->
                <nav id="site-navigation" class="main-navigation hidden lg:block" aria-label="<?php esc_attr_e('Primary menu', 'diy-home-improvement'); ?>">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'primary-menu flex items-center space-x-8',
                        'container'      => false,
                        'fallback_cb'    => 'diy_primary_menu_fallback',
                        'link_before'    => '<span class="menu-link-text">',
                        'link_after'     => '</span>',
                    ));
                    ?>
                </nav>

                <!-- Search and Mobile Menu -->
                <div class="header-actions flex items-center space-x-4">
                    
                    <!-- Search Toggle -->
                    <button id="search-toggle" class="search-toggle p-2 text-gray-600 hover:text-blue-600 transition-colors" aria-label="<?php esc_attr_e('Open search', 'diy-home-improvement'); ?>" aria-expanded="false">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-button" class="mobile-menu-toggle lg:hidden p-2 text-gray-600 hover:text-blue-600 transition-colors" aria-label="<?php esc_attr_e('Open menu', 'diy-home-improvement'); ?>" aria-expanded="false">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Search Form -->
            <div id="search-form-container" class="search-form-container hidden border-t border-gray-200 py-4">
                <div class="max-w-md mx-auto">
                    <?php get_search_form(); ?>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <nav id="mobile-menu" class="mobile-navigation lg:hidden hidden border-t border-gray-200 py-4" aria-label="<?php esc_attr_e('Mobile menu', 'diy-home-improvement'); ?>">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'mobile-primary-menu',
                    'menu_class'     => 'mobile-menu-list space-y-2',
                    'container'      => false,
                    'fallback_cb'    => 'diy_mobile_menu_fallback',
                ));
                ?>
            </nav>
        </div>
    </header>

    <!-- Category Navigation Bar -->
    <?php if (is_home() || is_front_page() || is_archive()) : ?>
        <div class="category-nav bg-white border-b border-gray-200">
            <div class="container mx-auto px-4 max-w-7xl">
                <nav class="category-navigation py-3" aria-label="<?php esc_attr_e('Category navigation', 'diy-home-improvement'); ?>">
                    <ul class="category-menu flex flex-wrap items-center gap-4 text-sm">
                        <li>
                            <a href="<?php echo esc_url(home_url('/')); ?>" 
                               class="category-link px-3 py-2 rounded-full text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-colors <?php echo (is_home() || is_front_page()) ? 'bg-blue-100 text-blue-700' : ''; ?>">
                                All Projects
                            </a>
                        </li>
                        <?php
                        $categories = get_categories(array(
                            'orderby' => 'name',
                            'order'   => 'ASC',
                            'hide_empty' => true,
                        ));
                        
                        foreach ($categories as $category) :
                            $is_current = is_category($category->term_id);
                        ?>
                            <li>
                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                                   class="category-link px-3 py-2 rounded-full text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-colors <?php echo $is_current ? 'bg-blue-100 text-blue-700' : ''; ?>">
                                    <?php echo esc_html($category->name); ?>
                                    <span class="category-count ml-1 text-xs opacity-75">(<?php echo $category->count; ?>)</span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
        </div>
    <?php endif; ?>

<?php
/**
 * Fallback function for primary menu
 */
function diy_primary_menu_fallback() {
    echo '<ul class="primary-menu flex items-center space-x-8">';
    echo '<li><a href="' . esc_url(home_url('/')) . '" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Home</a></li>';
    echo '<li><a href="' . esc_url(home_url('/about/')) . '" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">About</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact/')) . '" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Contact</a></li>';
    echo '</ul>';
}

/**
 * Fallback function for mobile menu
 */
function diy_mobile_menu_fallback() {
    echo '<ul class="mobile-menu-list space-y-2">';
    echo '<li><a href="' . esc_url(home_url('/')) . '" class="block px-4 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors">Home</a></li>';
    echo '<li><a href="' . esc_url(home_url('/about/')) . '" class="block px-4 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors">About</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact/')) . '" class="block px-4 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors">Contact</a></li>';
    echo '</ul>';
}
?>

<style>
/* Custom styles for navigation */
.primary-menu a {
    @apply text-gray-700 hover:text-blue-600 transition-colors font-medium relative;
}

.primary-menu a:hover::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(to right, #3b82f6, #1d4ed8);
    border-radius: 1px;
}

.mobile-menu-list a {
    @apply block px-4 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors;
}

/* Search form styling */
.search-form-container .search-form {
    @apply relative;
}

.search-form-container .search-field {
    @apply w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500;
}

.search-form-container .search-submit {
    @apply absolute right-2 top-1/2 transform -translate-y-1/2 p-1 text-gray-400 hover:text-blue-600 transition-colors;
}

/* Category navigation responsive */
@media (max-width: 640px) {
    .category-menu {
        @apply justify-center;
    }
    
    .category-link {
        @apply text-xs px-2 py-1;
    }
}

/* Smooth transitions */
.search-form-container,
.mobile-navigation {
    transition: all 0.3s ease;
}

/* Focus styles for accessibility */
.skip-link:focus {
    @apply not-sr-only absolute top-4 left-4 z-50 bg-blue-600 text-white px-4 py-2 rounded;
}
</style>
