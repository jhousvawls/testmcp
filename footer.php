<?php
/**
 * The template for displaying the footer
 *
 * @package DIY_Home_Improvement
 * @since 1.0.0
 */
?>

    <footer id="colophon" class="site-footer bg-gray-900 text-white mt-auto">
        <div class="container mx-auto px-4 max-w-7xl">
            
            <!-- Footer Widgets -->
            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="footer-widgets py-12 border-b border-gray-800">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Footer Content -->
            <div class="footer-content py-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
                    
                    <!-- Site Info -->
                    <div class="site-info text-center lg:text-left">
                        <h3 class="text-xl font-bold text-gradient mb-2">
                            <?php bloginfo('name'); ?>
                        </h3>
                        <p class="text-gray-400 text-sm">
                            <?php
                            $description = get_bloginfo('description', 'display');
                            if ($description) {
                                echo esc_html($description);
                            } else {
                                esc_html_e('Your trusted source for DIY projects and home improvement guides.', 'diy-home-improvement');
                            }
                            ?>
                        </p>
                    </div>

                    <!-- Footer Navigation -->
                    <nav class="footer-navigation text-center" aria-label="<?php esc_attr_e('Footer menu', 'diy-home-improvement'); ?>">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_id'        => 'footer-menu',
                            'menu_class'     => 'footer-menu flex flex-wrap justify-center items-center space-x-6 text-sm',
                            'container'      => false,
                            'fallback_cb'    => 'diy_footer_menu_fallback',
                            'depth'          => 1,
                        ));
                        ?>
                    </nav>

                    <!-- Social Links & Search -->
                    <div class="footer-actions text-center lg:text-right">
                        <div class="social-links mb-4">
                            <!-- Add social media links here -->
                            <a href="#" class="inline-block p-2 text-gray-400 hover:text-white transition-colors mr-2" aria-label="<?php esc_attr_e('Follow us on Facebook', 'diy-home-improvement'); ?>">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="inline-block p-2 text-gray-400 hover:text-white transition-colors mr-2" aria-label="<?php esc_attr_e('Follow us on Twitter', 'diy-home-improvement'); ?>">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="#" class="inline-block p-2 text-gray-400 hover:text-white transition-colors" aria-label="<?php esc_attr_e('Follow us on YouTube', 'diy-home-improvement'); ?>">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                        </div>
                        
                        <!-- Newsletter Signup -->
                        <div class="newsletter-signup">
                            <p class="text-sm text-gray-400 mb-2"><?php esc_html_e('Get DIY tips in your inbox', 'diy-home-improvement'); ?></p>
                            <form class="flex max-w-sm mx-auto lg:mx-0 lg:ml-auto">
                                <input type="email" placeholder="<?php esc_attr_e('Your email', 'diy-home-improvement'); ?>" 
                                       class="flex-1 px-3 py-2 text-sm bg-gray-800 border border-gray-700 rounded-l-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-gray-400">
                                <button type="submit" class="px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 rounded-r-md transition-colors">
                                    <?php esc_html_e('Subscribe', 'diy-home-improvement'); ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="footer-bottom py-6 border-t border-gray-800">
                <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                    <div class="copyright mb-4 md:mb-0">
                        <p>
                            <?php
                            printf(
                                esc_html__('© %1$s %2$s. All rights reserved.', 'diy-home-improvement'),
                                date('Y'),
                                get_bloginfo('name')
                            );
                            ?>
                        </p>
                    </div>
                    
                    <div class="footer-links">
                        <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" class="hover:text-white transition-colors mr-4">
                            <?php esc_html_e('Privacy Policy', 'diy-home-improvement'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/terms-of-service/')); ?>" class="hover:text-white transition-colors mr-4">
                            <?php esc_html_e('Terms of Service', 'diy-home-improvement'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="hover:text-white transition-colors">
                            <?php esc_html_e('Contact', 'diy-home-improvement'); ?>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Smart Page Builder Footer Integration -->
            <div class="smart-builder-footer">
                <?php
                // Hook for Smart Page Builder to inject footer content
                if (function_exists('diy_smart_page_builder_placeholder')) {
                    diy_smart_page_builder_placeholder('Footer Recommendations');
                }
                ?>
            </div>
        </div>
    </footer>

</div><!-- #page -->

<!-- Back to Top Button -->
<button id="back-to-top" class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg transition-all duration-300 opacity-0 invisible z-50" aria-label="<?php esc_attr_e('Back to top', 'diy-home-improvement'); ?>">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
    </svg>
</button>

<?php wp_footer(); ?>

<!-- JavaScript for enhanced functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search toggle functionality
    const searchToggle = document.getElementById('search-toggle');
    const searchContainer = document.getElementById('search-form-container');
    
    if (searchToggle && searchContainer) {
        searchToggle.addEventListener('click', function() {
            searchContainer.classList.toggle('hidden');
            const expanded = searchToggle.getAttribute('aria-expanded') === 'true';
            searchToggle.setAttribute('aria-expanded', !expanded);
            
            if (!searchContainer.classList.contains('hidden')) {
                const searchField = searchContainer.querySelector('.search-field');
                if (searchField) {
                    searchField.focus();
                }
            }
        });
    }
    
    // Back to top button functionality
    const backToTopButton = document.getElementById('back-to-top');
    
    if (backToTopButton) {
        // Show/hide button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.add('opacity-0', 'invisible');
                backToTopButton.classList.remove('opacity-100', 'visible');
            }
        });
        
        // Smooth scroll to top
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Newsletter form handling
    const newsletterForm = document.querySelector('.newsletter-signup form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            if (email) {
                // Here you would typically send the email to your newsletter service
                alert('Thank you for subscribing! (This is a demo - no actual subscription was created)');
                this.querySelector('input[type="email"]').value = '';
            }
        });
    }
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>

<?php
/**
 * Fallback function for footer menu
 */
function diy_footer_menu_fallback() {
    echo '<ul class="footer-menu flex flex-wrap justify-center items-center space-x-6 text-sm">';
    echo '<li><a href="' . esc_url(home_url('/')) . '" class="text-gray-400 hover:text-white transition-colors">Home</a></li>';
    echo '<li><a href="' . esc_url(home_url('/about/')) . '" class="text-gray-400 hover:text-white transition-colors">About</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact/')) . '" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>';
    echo '<li><a href="' . esc_url(home_url('/privacy-policy/')) . '" class="text-gray-400 hover:text-white transition-colors">Privacy</a></li>';
    echo '</ul>';
}
?>

<style>
/* Footer specific styles */
.footer-menu a {
    @apply text-gray-400 hover:text-white transition-colors;
}

.footer-widgets .widget {
    @apply bg-transparent shadow-none p-0;
}

.footer-widgets .widget-title {
    @apply text-white text-lg font-semibold mb-4;
}

.footer-widgets .widget ul {
    @apply space-y-2;
}

.footer-widgets .widget ul li a {
    @apply text-gray-400 hover:text-white transition-colors text-sm;
}

/* Social links hover effects */
.social-links a:hover {
    transform: translateY(-2px);
}

/* Newsletter form styling */
.newsletter-signup input:focus {
    @apply outline-none;
}

/* Back to top button animations */
#back-to-top {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

#back-to-top:hover {
    transform: translateY(-2px);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .footer-content {
        text-align: center;
    }
    
    .footer-menu {
        @apply flex-col space-x-0 space-y-2;
    }
    
    .social-links {
        @apply mb-6;
    }
}

/* Print styles */
@media print {
    .site-footer,
    #back-to-top {
        display: none !important;
    }
}
</style>

</body>
</html>
