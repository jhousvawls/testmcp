<?php
/**
 * Search form template
 *
 * @package DIY_Home_Improvement
 * @since 1.0.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="search-form-wrapper relative">
        <label for="search-field-<?php echo uniqid(); ?>" class="sr-only">
            <?php esc_html_e('Search for DIY projects and guides', 'diy-home-improvement'); ?>
        </label>
        
        <input type="search" 
               id="search-field-<?php echo uniqid(); ?>"
               class="search-field w-full px-4 py-2 pr-12 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white"
               placeholder="<?php esc_attr_e('Search DIY projects, tools, techniques...', 'diy-home-improvement'); ?>" 
               value="<?php echo get_search_query(); ?>" 
               name="s" 
               autocomplete="off"
               aria-describedby="search-description-<?php echo uniqid(); ?>">
        
        <button type="submit" 
                class="search-submit absolute right-2 top-1/2 transform -translate-y-1/2 p-2 text-gray-400 hover:text-blue-600 transition-colors focus:outline-none focus:text-blue-600"
                aria-label="<?php esc_attr_e('Submit search', 'diy-home-improvement'); ?>">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </button>
        
        <div id="search-description-<?php echo uniqid(); ?>" class="sr-only">
            <?php esc_html_e('Search through our collection of DIY projects, home improvement guides, tool reviews, and step-by-step tutorials.', 'diy-home-improvement'); ?>
        </div>
    </div>
    
    <!-- Search suggestions (hidden by default, can be shown with JavaScript) -->
    <div class="search-suggestions hidden absolute top-full left-0 right-0 bg-white border border-gray-200 rounded-b-lg shadow-lg z-10 mt-1">
        <div class="search-suggestions-content p-4">
            <h4 class="text-sm font-semibold text-gray-900 mb-3">
                <?php esc_html_e('Popular Searches:', 'diy-home-improvement'); ?>
            </h4>
            <div class="popular-searches flex flex-wrap gap-2">
                <?php
                // Get popular search terms (this could be dynamic based on actual search data)
                $popular_searches = array(
                    'drywall repair',
                    'leaky faucet',
                    'painting tips',
                    'woodworking',
                    'smart home',
                    'garden projects'
                );
                
                foreach ($popular_searches as $search_term) :
                ?>
                    <a href="<?php echo esc_url(home_url('/?s=' . urlencode($search_term))); ?>" 
                       class="inline-block bg-gray-100 text-gray-700 text-xs px-3 py-1 rounded-full hover:bg-blue-100 hover:text-blue-700 transition-colors">
                        <?php echo esc_html($search_term); ?>
                    </a>
                <?php endforeach; ?>
            </div>
            
            <div class="search-categories mt-4">
                <h4 class="text-sm font-semibold text-gray-900 mb-3">
                    <?php esc_html_e('Browse by Category:', 'diy-home-improvement'); ?>
                </h4>
                <div class="category-links grid grid-cols-2 gap-2">
                    <?php
                    $categories = get_categories(array(
                        'orderby' => 'count',
                        'order'   => 'DESC',
                        'number'  => 6,
                        'hide_empty' => true,
                    ));
                    
                    foreach ($categories as $category) :
                    ?>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                           class="flex items-center text-sm text-gray-600 hover:text-blue-600 transition-colors">
                            <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <?php echo esc_html($category->name); ?>
                            <span class="ml-auto text-xs text-gray-400">(<?php echo $category->count; ?>)</span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
/* Search form specific styles */
.search-form {
    position: relative;
}

.search-form-wrapper {
    position: relative;
}

.search-field:focus {
    outline: none;
}

.search-submit:focus {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}

/* Search suggestions styling */
.search-suggestions {
    max-height: 300px;
    overflow-y: auto;
}

.search-suggestions.show {
    display: block;
}

/* Responsive adjustments */
@media (max-width: 640px) {
    .search-suggestions .category-links {
        grid-template-columns: 1fr;
    }
    
    .search-field {
        font-size: 16px; /* Prevents zoom on iOS */
    }
}

/* Animation for search suggestions */
.search-suggestions {
    opacity: 0;
    transform: translateY(-10px);
    transition: all 0.2s ease;
}

.search-suggestions.show {
    opacity: 1;
    transform: translateY(0);
}

/* Loading state */
.search-form.loading .search-submit {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>

<script>
// Enhanced search functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchForms = document.querySelectorAll('.search-form');
    
    searchForms.forEach(form => {
        const searchField = form.querySelector('.search-field');
        const suggestions = form.querySelector('.search-suggestions');
        
        if (searchField && suggestions) {
            // Show suggestions on focus
            searchField.addEventListener('focus', function() {
                if (this.value.length === 0) {
                    suggestions.classList.remove('hidden');
                    suggestions.classList.add('show');
                }
            });
            
            // Hide suggestions when clicking outside
            document.addEventListener('click', function(e) {
                if (!form.contains(e.target)) {
                    suggestions.classList.add('hidden');
                    suggestions.classList.remove('show');
                }
            });
            
            // Hide suggestions on escape key
            searchField.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    suggestions.classList.add('hidden');
                    suggestions.classList.remove('show');
                    this.blur();
                }
            });
            
            // Handle popular search clicks
            const popularSearches = suggestions.querySelectorAll('.popular-searches a');
            popularSearches.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    searchField.value = this.textContent.trim();
                    form.submit();
                });
            });
        }
        
        // Add loading state on form submission
        form.addEventListener('submit', function() {
            this.classList.add('loading');
            const submitButton = this.querySelector('.search-submit');
            if (submitButton) {
                submitButton.disabled = true;
            }
        });
    });
});
</script>
