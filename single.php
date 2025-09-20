<?php
/**
 * The template for displaying all single posts
 *
 * @package DIY_Home_Improvement
 * @since 1.0.0
 */

get_header(); ?>

<main id="primary" class="site-main bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post bg-white rounded-lg shadow-sm overflow-hidden'); ?>>
                
                <!-- Post Header -->
                <header class="post-header">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-featured-image">
                            <?php the_post_thumbnail('large', array(
                                'class' => 'w-full h-64 md:h-80 object-cover',
                                'alt' => get_the_title()
                            )); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="post-header-content p-6 md:p-8">
                        <!-- Categories -->
                        <?php $categories = get_the_category(); ?>
                        <?php if (!empty($categories)) : ?>
                            <div class="post-categories mb-4">
                                <?php foreach ($categories as $category) : ?>
                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                                       class="inline-block bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full mr-2 hover:bg-blue-200 transition-colors">
                                        <?php echo esc_html($category->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Title -->
                        <h1 class="post-title text-3xl md:text-4xl font-bold text-gradient mb-4">
                            <?php the_title(); ?>
                        </h1>
                        
                        <!-- Post Meta -->
                        <div class="post-meta flex flex-wrap items-center text-sm text-gray-600 mb-6">
                            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="published mr-6">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <?php echo esc_html(get_the_date()); ?>
                            </time>
                            
                            <span class="author mr-6">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <?php esc_html_e('By', 'diy-home-improvement'); ?> <?php the_author(); ?>
                            </span>
                            
                            <span class="reading-time">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <?php echo diy_get_reading_time(); ?> <?php esc_html_e('min read', 'diy-home-improvement'); ?>
                            </span>
                        </div>
                        
                        <!-- Post Excerpt/Introduction -->
                        <?php if (has_excerpt()) : ?>
                            <div class="post-excerpt text-lg text-gray-700 leading-relaxed mb-6 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </header>

                <!-- Post Content -->
                <div class="post-content p-6 md:p-8 pt-0">
                    
                    <!-- Table of Contents (if post is long) -->
                    <?php if (diy_should_show_toc()) : ?>
                        <div class="table-of-contents bg-gray-50 rounded-lg p-6 mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                                <?php esc_html_e('Table of Contents', 'diy-home-improvement'); ?>
                            </h3>
                            <?php echo diy_generate_toc(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Main Content -->
                    <div class="entry-content prose prose-lg max-w-none">
                        <?php
                        the_content(sprintf(
                            wp_kses(
                                __('Continue reading<span class="sr-only"> "%s"</span>', 'diy-home-improvement'),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            wp_kses_post(get_the_title())
                        ));
                        ?>
                    </div>

                    <!-- Smart Page Builder: Tool Recommendations -->
                    <?php if (get_post_meta(get_the_ID(), '_diy_enable_tool_recommendations', true)) : ?>
                        <div class="smart-builder-section mt-12">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">
                                🔧 <?php esc_html_e('Recommended Tools & Materials', 'diy-home-improvement'); ?>
                            </h3>
                            <?php diy_smart_page_builder_placeholder('Tool Recommendations'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Smart Page Builder: Related Content -->
                    <?php if (get_post_meta(get_the_ID(), '_diy_enable_related_content', true)) : ?>
                        <div class="smart-builder-section mt-12">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">
                                📚 <?php esc_html_e('Related Projects', 'diy-home-improvement'); ?>
                            </h3>
                            <?php diy_smart_page_builder_placeholder('Related Projects'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Post Tags -->
                    <?php $tags = get_the_tags(); ?>
                    <?php if ($tags) : ?>
                        <div class="post-tags mt-12 pt-8 border-t border-gray-200">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">
                                <?php esc_html_e('Tags:', 'diy-home-improvement'); ?>
                            </h4>
                            <div class="tags-list flex flex-wrap gap-2">
                                <?php foreach ($tags as $tag) : ?>
                                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" 
                                       class="inline-block bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full hover:bg-gray-200 transition-colors">
                                        #<?php echo esc_html($tag->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Post Navigation -->
                    <nav class="post-navigation mt-12 pt-8 border-t border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php
                            $prev_post = get_previous_post();
                            $next_post = get_next_post();
                            ?>
                            
                            <?php if ($prev_post) : ?>
                                <div class="nav-previous">
                                    <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" 
                                       class="block p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group">
                                        <span class="text-sm text-gray-600 mb-2 block">
                                            ← <?php esc_html_e('Previous Project', 'diy-home-improvement'); ?>
                                        </span>
                                        <span class="font-medium text-gray-900 group-hover:text-blue-600 transition-colors">
                                            <?php echo esc_html(get_the_title($prev_post)); ?>
                                        </span>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($next_post) : ?>
                                <div class="nav-next <?php echo !$prev_post ? 'md:col-start-2' : ''; ?>">
                                    <a href="<?php echo esc_url(get_permalink($next_post)); ?>" 
                                       class="block p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group text-right">
                                        <span class="text-sm text-gray-600 mb-2 block">
                                            <?php esc_html_e('Next Project', 'diy-home-improvement'); ?> →
                                        </span>
                                        <span class="font-medium text-gray-900 group-hover:text-blue-600 transition-colors">
                                            <?php echo esc_html(get_the_title($next_post)); ?>
                                        </span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </nav>

                    <!-- Smart Page Builder: Video Tutorials -->
                    <div class="smart-builder-section mt-12">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">
                            🎥 <?php esc_html_e('Video Tutorials', 'diy-home-improvement'); ?>
                        </h3>
                        <?php diy_smart_page_builder_placeholder('Video Tutorials'); ?>
                    </div>

                    <!-- Author Bio -->
                    <div class="author-bio mt-12 pt-8 border-t border-gray-200">
                        <div class="flex items-start space-x-4">
                            <div class="author-avatar flex-shrink-0">
                                <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', array('class' => 'rounded-full')); ?>
                            </div>
                            <div class="author-info flex-1">
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">
                                    <?php esc_html_e('About', 'diy-home-improvement'); ?> <?php the_author(); ?>
                                </h4>
                                <div class="author-description text-gray-600">
                                    <?php
                                    $author_bio = get_the_author_meta('description');
                                    if ($author_bio) {
                                        echo wp_kses_post($author_bio);
                                    } else {
                                        esc_html_e('DIY enthusiast and home improvement expert sharing practical tips and step-by-step guides.', 'diy-home-improvement');
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Comments Section -->
            <?php if (comments_open() || get_comments_number()) : ?>
                <div class="comments-section mt-8 bg-white rounded-lg shadow-sm p-6 md:p-8">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>

        <?php endwhile; ?>
        
    </div>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php
/**
 * Calculate reading time for post
 */
function diy_get_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed: 200 words per minute
    return max(1, $reading_time); // Minimum 1 minute
}

/**
 * Check if table of contents should be shown
 */
function diy_should_show_toc() {
    $content = get_post_field('post_content', get_the_ID());
    $heading_count = preg_match_all('/<h[2-6][^>]*>/', $content);
    return $heading_count >= 3; // Show TOC if 3 or more headings
}

/**
 * Generate table of contents
 */
function diy_generate_toc() {
    $content = get_post_field('post_content', get_the_ID());
    
    // Extract headings
    preg_match_all('/<h([2-6])[^>]*>(.*?)<\/h[2-6]>/i', $content, $matches, PREG_SET_ORDER);
    
    if (empty($matches)) {
        return '';
    }
    
    $toc = '<ol class="toc-list space-y-2 text-sm">';
    
    foreach ($matches as $heading) {
        $level = $heading[1];
        $text = strip_tags($heading[2]);
        $id = sanitize_title($text);
        
        $indent = ($level - 2) * 20; // Indent based on heading level
        
        $toc .= sprintf(
            '<li style="margin-left: %dpx;"><a href="#%s" class="text-blue-600 hover:text-blue-800 transition-colors">%s</a></li>',
            $indent,
            esc_attr($id),
            esc_html($text)
        );
    }
    
    $toc .= '</ol>';
    
    return $toc;
}
?>

<style>
/* Single post specific styles */
.single-post .entry-content {
    line-height: 1.8;
}

.single-post .entry-content h2,
.single-post .entry-content h3,
.single-post .entry-content h4,
.single-post .entry-content h5,
.single-post .entry-content h6 {
    @apply font-bold text-gray-900 mt-8 mb-4;
}

.single-post .entry-content h2 {
    @apply text-2xl;
}

.single-post .entry-content h3 {
    @apply text-xl;
}

.single-post .entry-content h4 {
    @apply text-lg;
}

.single-post .entry-content p {
    @apply mb-6 text-gray-700;
}

.single-post .entry-content ul,
.single-post .entry-content ol {
    @apply mb-6 pl-6;
}

.single-post .entry-content ul li {
    @apply list-disc mb-2;
}

.single-post .entry-content ol li {
    @apply list-decimal mb-2;
}

.single-post .entry-content blockquote {
    @apply border-l-4 border-blue-500 pl-6 py-4 my-6 bg-blue-50 rounded-r-lg italic text-gray-700;
}

.single-post .entry-content img {
    @apply rounded-lg shadow-sm my-6;
}

.single-post .entry-content code {
    @apply bg-gray-100 px-2 py-1 rounded text-sm font-mono;
}

.single-post .entry-content pre {
    @apply bg-gray-900 text-white p-4 rounded-lg overflow-x-auto my-6;
}

.single-post .entry-content pre code {
    @apply bg-transparent p-0;
}

/* Table of contents styling */
.toc-list a {
    @apply hover:underline;
}

/* Smart Page Builder sections */
.smart-builder-section {
    @apply border-t border-gray-200 pt-8;
}

/* Author bio styling */
.author-bio .author-avatar img {
    @apply border-2 border-gray-200;
}

/* Post navigation hover effects */
.post-navigation a:hover {
    transform: translateY(-2px);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .post-header-content {
        @apply p-4;
    }
    
    .post-content {
        @apply p-4;
    }
    
    .post-title {
        @apply text-2xl;
    }
    
    .post-meta {
        @apply flex-col items-start space-y-2;
    }
    
    .post-meta > * {
        @apply mr-0;
    }
}

/* Print styles */
@media print {
    .post-navigation,
    .smart-builder-section,
    .comments-section {
        display: none !important;
    }
}
</style>
