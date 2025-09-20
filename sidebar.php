<?php
/**
 * The sidebar containing the main widget area
 *
 * @package DIY_Home_Improvement
 * @since 1.0.0
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area sidebar bg-transparent">
    <div class="sidebar-content max-w-sm mx-auto lg:mx-0">
        
        <!-- Search Widget (if not already in header) -->
        <?php if (!is_search()) : ?>
            <div class="widget search-widget bg-white rounded-lg shadow-sm p-6 mb-6">
                <h3 class="widget-title text-lg font-semibold text-gray-900 mb-4">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <?php esc_html_e('Search Projects', 'diy-home-improvement'); ?>
                </h3>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>

        <!-- Categories Widget -->
        <div class="widget categories-widget bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="widget-title text-lg font-semibold text-gray-900 mb-4">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <?php esc_html_e('Project Categories', 'diy-home-improvement'); ?>
            </h3>
            <ul class="categories-list space-y-2">
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
                           class="flex items-center justify-between p-2 rounded hover:bg-blue-50 transition-colors <?php echo $is_current ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:text-blue-600'; ?>">
                            <span><?php echo esc_html($category->name); ?></span>
                            <span class="text-xs bg-gray-200 text-gray-600 px-2 py-1 rounded-full"><?php echo $category->count; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Recent Posts Widget -->
        <div class="widget recent-posts-widget bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="widget-title text-lg font-semibold text-gray-900 mb-4">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <?php esc_html_e('Recent Projects', 'diy-home-improvement'); ?>
            </h3>
            <?php
            $recent_posts = wp_get_recent_posts(array(
                'numberposts' => 5,
                'post_status' => 'publish'
            ));
            
            if ($recent_posts) :
            ?>
                <ul class="recent-posts-list space-y-3">
                    <?php foreach ($recent_posts as $post) : ?>
                        <li>
                            <a href="<?php echo esc_url(get_permalink($post['ID'])); ?>" 
                               class="block group">
                                <h4 class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2 mb-1">
                                    <?php echo esc_html($post['post_title']); ?>
                                </h4>
                                <time class="text-xs text-gray-500">
                                    <?php echo esc_html(human_time_diff(strtotime($post['post_date']), current_time('timestamp')) . ' ago'); ?>
                                </time>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <!-- Popular Tags Widget -->
        <div class="widget tags-widget bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="widget-title text-lg font-semibold text-gray-900 mb-4">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                <?php esc_html_e('Popular Tags', 'diy-home-improvement'); ?>
            </h3>
            <?php
            $popular_tags = get_tags(array(
                'orderby' => 'count',
                'order' => 'DESC',
                'number' => 15,
                'hide_empty' => true,
            ));
            
            if ($popular_tags) :
            ?>
                <div class="tags-cloud flex flex-wrap gap-2">
                    <?php foreach ($popular_tags as $tag) : ?>
                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" 
                           class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded-full hover:bg-blue-100 hover:text-blue-700 transition-colors">
                            #<?php echo esc_html($tag->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Smart Page Builder Sidebar Integration -->
        <div class="widget smart-builder-widget bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="widget-title text-lg font-semibold text-gray-900 mb-4">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                <?php esc_html_e('Recommended for You', 'diy-home-improvement'); ?>
            </h3>
            <?php
            // Hook for Smart Page Builder to inject sidebar content
            if (function_exists('diy_smart_page_builder_placeholder')) {
                diy_smart_page_builder_placeholder('Sidebar Recommendations');
            }
            ?>
        </div>

        <!-- Newsletter Signup Widget -->
        <div class="widget newsletter-widget bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg shadow-sm p-6 mb-6 text-white">
            <h3 class="widget-title text-lg font-semibold text-white mb-4">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <?php esc_html_e('DIY Newsletter', 'diy-home-improvement'); ?>
            </h3>
            <p class="text-blue-100 text-sm mb-4">
                <?php esc_html_e('Get weekly DIY tips, project ideas, and exclusive guides delivered to your inbox.', 'diy-home-improvement'); ?>
            </p>
            <form class="newsletter-form">
                <div class="mb-3">
                    <input type="email" 
                           placeholder="<?php esc_attr_e('Your email address', 'diy-home-improvement'); ?>" 
                           class="w-full px-3 py-2 text-sm bg-white/20 border border-white/30 rounded-md focus:ring-2 focus:ring-white/50 focus:border-white/50 text-white placeholder-blue-200"
                           required>
                </div>
                <button type="submit" 
                        class="w-full bg-white text-blue-600 px-4 py-2 text-sm font-medium rounded-md hover:bg-blue-50 transition-colors">
                    <?php esc_html_e('Subscribe Now', 'diy-home-improvement'); ?>
                </button>
            </form>
        </div>

        <!-- Help & Support Widget -->
        <div class="widget help-widget bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="widget-title text-lg font-semibold text-gray-900 mb-4">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <?php esc_html_e('Need Help?', 'diy-home-improvement'); ?>
            </h3>
            <div class="help-links space-y-3">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" 
                   class="flex items-center text-sm text-gray-600 hover:text-blue-600 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <?php esc_html_e('Ask a Question', 'diy-home-improvement'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/safety-tips/')); ?>" 
                   class="flex items-center text-sm text-gray-600 hover:text-blue-600 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    <?php esc_html_e('Safety Guidelines', 'diy-home-improvement'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/tool-guides/')); ?>" 
                   class="flex items-center text-sm text-gray-600 hover:text-blue-600 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <?php esc_html_e('Tool Guides', 'diy-home-improvement'); ?>
                </a>
            </div>
        </div>

        <!-- Dynamic Sidebar Widgets -->
        <?php dynamic_sidebar('sidebar-1'); ?>
        
    </div>
</aside>

<style>
/* Sidebar specific styles */
.sidebar .widget {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.sidebar .widget:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

/* Search form in sidebar */
.search-widget .search-form {
    @apply relative;
}

.search-widget .search-field {
    @apply w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm;
}

.search-widget .search-submit {
    @apply absolute right-2 top-1/2 transform -translate-y-1/2 p-1 text-gray-400 hover:text-blue-600 transition-colors;
}

/* Categories list styling */
.categories-list a:hover {
    transform: translateX(4px);
}

/* Recent posts styling */
.recent-posts-list .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Newsletter form styling */
.newsletter-form input:focus {
    @apply outline-none;
}

.newsletter-form input::placeholder {
    @apply text-blue-200;
}

/* Help links hover effects */
.help-links a:hover svg {
    transform: scale(1.1);
}

/* Responsive adjustments */
@media (max-width: 1024px) {
    .sidebar {
        @apply mt-8;
    }
    
    .sidebar-content {
        @apply max-w-2xl mx-auto;
    }
    
    .sidebar .widget {
        @apply mb-4;
    }
}

@media (max-width: 768px) {
    .sidebar-content {
        @apply max-w-full;
    }
    
    .sidebar .widget {
        @apply p-4 mb-4;
    }
    
    .widget-title {
        @apply text-base;
    }
}

/* Print styles */
@media print {
    .sidebar {
        display: none !important;
    }
}
</style>
