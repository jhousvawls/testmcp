<?php
/**
 * The main template file
 *
 * @package DIY_Home_Improvement
 * @since 1.0.0
 */

get_header(); ?>

<main id="primary" class="site-main bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        
        <?php if (have_posts()) : ?>
            
            <!-- Page Header -->
            <header class="page-header mb-12 text-center">
                <?php if (is_home() && !is_front_page()) : ?>
                    <h1 class="page-title text-4xl font-bold text-gradient mb-4">
                        <?php single_post_title(); ?>
                    </h1>
                <?php elseif (is_archive()) : ?>
                    <h1 class="page-title text-4xl font-bold text-gradient mb-4">
                        <?php the_archive_title(); ?>
                    </h1>
                    <?php if (get_the_archive_description()) : ?>
                        <div class="archive-description text-lg text-gray-600 max-w-3xl mx-auto">
                            <?php echo wp_kses_post(get_the_archive_description()); ?>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <h1 class="page-title text-4xl font-bold text-gradient mb-4">
                        Latest DIY Projects & Home Improvement Tips
                    </h1>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Discover step-by-step guides, expert tips, and everything you need to tackle your next home improvement project with confidence.
                    </p>
                <?php endif; ?>
            </header>

            <!-- Posts Grid -->
            <div class="posts-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                
                <?php while (have_posts()) : the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-card bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden'); ?>>
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>" class="block">
                                    <?php the_post_thumbnail('medium_large', array(
                                        'class' => 'w-full h-48 object-cover',
                                        'alt' => get_the_title()
                                    )); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="post-content p-6">
                            
                            <!-- Categories -->
                            <?php $categories = get_the_category(); ?>
                            <?php if (!empty($categories)) : ?>
                                <div class="post-categories mb-3">
                                    <?php foreach ($categories as $category) : ?>
                                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                                           class="inline-block bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full mr-2 hover:bg-blue-200 transition-colors">
                                            <?php echo esc_html($category->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Title -->
                            <h2 class="post-title mb-3">
                                <a href="<?php the_permalink(); ?>" class="text-xl font-semibold text-gray-900 hover:text-blue-600 transition-colors line-clamp-2">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            
                            <!-- Excerpt -->
                            <div class="post-excerpt text-gray-600 mb-4 line-clamp-3">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <!-- Meta -->
                            <div class="post-meta flex items-center justify-between text-sm text-gray-500">
                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="published">
                                    <?php echo esc_html(get_the_date()); ?>
                                </time>
                                
                                <a href="<?php the_permalink(); ?>" class="read-more text-blue-600 hover:text-blue-800 font-medium">
                                    Read More →
                                </a>
                            </div>
                            
                        </div>
                        
                    </article>
                    
                <?php endwhile; ?>
                
            </div>

            <!-- Pagination -->
            <?php
            $pagination = paginate_links(array(
                'mid_size' => 2,
                'prev_text' => '← Previous',
                'next_text' => 'Next →',
                'type' => 'array'
            ));
            
            if ($pagination) : ?>
                <nav class="pagination-nav" aria-label="Posts pagination">
                    <ul class="pagination flex flex-wrap justify-center items-center space-x-2">
                        <?php foreach ($pagination as $page) : ?>
                            <li class="page-item">
                                <?php echo str_replace(
                                    array('page-numbers', 'current'),
                                    array('px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-700 transition-colors', 'px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-md'),
                                    $page
                                ); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endif; ?>

        <?php else : ?>
            
            <!-- No Posts Found -->
            <div class="no-posts-found text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="text-6xl mb-6">🔧</div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">No Projects Found</h2>
                    <p class="text-gray-600 mb-6">
                        We couldn't find any DIY projects or home improvement guides. 
                        Check back soon for new content!
                    </p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" 
                       class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        Return Home
                    </a>
                </div>
            </div>
            
        <?php endif; ?>
        
    </div>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<style>
/* Line clamp utilities for text truncation */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Hover effects for post cards */
.post-card:hover {
    transform: translateY(-2px);
}

/* Smooth transitions */
.post-card,
.post-card a,
.pagination a {
    transition: all 0.3s ease;
}

/* Focus styles for accessibility */
.post-card:focus-within {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .posts-grid {
        grid-template-columns: 1fr;
    }
    
    .pagination {
        flex-direction: column;
        space-x: 0;
        gap: 0.5rem;
    }
}
</style>
