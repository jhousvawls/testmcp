/**
 * DIY Home Improvement Theme JavaScript
 * 
 * @package DIY_Home_Improvement
 * @since 1.0.0
 */

(function() {
    'use strict';

    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        
        // Initialize all functionality
        initMobileMenu();
        initSearchToggle();
        initBackToTop();
        initSmoothScrolling();
        initNewsletterForms();
        initTableOfContents();
        initImageLazyLoading();
        initAccessibilityEnhancements();
        initSmartPageBuilderPlaceholders();
        
    });

    /**
     * Mobile Menu Functionality
     */
    function initMobileMenu() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
                
                // Toggle menu visibility
                mobileMenu.classList.toggle('hidden');
                
                // Update ARIA attributes
                mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
                
                // Update button icon (hamburger to X)
                const icon = mobileMenuButton.querySelector('svg');
                if (icon) {
                    if (isExpanded) {
                        // Show hamburger icon
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                    } else {
                        // Show X icon
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                    }
                }
                
                // Trap focus within menu when open
                if (!isExpanded) {
                    trapFocus(mobileMenu);
                }
            });
            
            // Close menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                    mobileMenu.classList.add('hidden');
                    mobileMenuButton.setAttribute('aria-expanded', 'false');
                }
            });
            
            // Close menu on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    mobileMenuButton.setAttribute('aria-expanded', 'false');
                    mobileMenuButton.focus();
                }
            });
        }
    }

    /**
     * Search Toggle Functionality
     */
    function initSearchToggle() {
        const searchToggle = document.getElementById('search-toggle');
        const searchContainer = document.getElementById('search-form-container');
        
        if (searchToggle && searchContainer) {
            searchToggle.addEventListener('click', function() {
                const isExpanded = searchToggle.getAttribute('aria-expanded') === 'true';
                
                // Toggle search form visibility
                searchContainer.classList.toggle('hidden');
                searchToggle.setAttribute('aria-expanded', !isExpanded);
                
                // Focus on search field when opened
                if (!isExpanded) {
                    const searchField = searchContainer.querySelector('.search-field, input[type="search"]');
                    if (searchField) {
                        setTimeout(() => searchField.focus(), 100);
                    }
                }
            });
            
            // Close search on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !searchContainer.classList.contains('hidden')) {
                    searchContainer.classList.add('hidden');
                    searchToggle.setAttribute('aria-expanded', 'false');
                    searchToggle.focus();
                }
            });
        }
    }

    /**
     * Back to Top Button
     */
    function initBackToTop() {
        const backToTopButton = document.getElementById('back-to-top');
        
        if (backToTopButton) {
            // Show/hide button based on scroll position
            window.addEventListener('scroll', throttle(function() {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.remove('opacity-0', 'invisible');
                    backToTopButton.classList.add('opacity-100', 'visible');
                } else {
                    backToTopButton.classList.add('opacity-0', 'invisible');
                    backToTopButton.classList.remove('opacity-100', 'visible');
                }
            }, 100));
            
            // Smooth scroll to top
            backToTopButton.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
    }

    /**
     * Smooth Scrolling for Anchor Links
     */
    function initSmoothScrolling() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                const target = document.querySelector(targetId);
                
                if (target && targetId !== '#') {
                    e.preventDefault();
                    
                    // Calculate offset for sticky header
                    const headerHeight = document.querySelector('.site-header')?.offsetHeight || 0;
                    const targetPosition = target.offsetTop - headerHeight - 20;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                    
                    // Update focus for accessibility
                    target.focus();
                }
            });
        });
    }

    /**
     * Newsletter Form Handling
     */
    function initNewsletterForms() {
        const newsletterForms = document.querySelectorAll('.newsletter-form, .newsletter-signup form');
        
        newsletterForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const emailInput = this.querySelector('input[type="email"]');
                const submitButton = this.querySelector('button[type="submit"]');
                
                if (emailInput && emailInput.value) {
                    // Disable form during submission
                    submitButton.disabled = true;
                    submitButton.textContent = 'Subscribing...';
                    
                    // Simulate API call (replace with actual implementation)
                    setTimeout(() => {
                        showNotification('Thank you for subscribing! You\'ll receive our next newsletter soon.', 'success');
                        emailInput.value = '';
                        submitButton.disabled = false;
                        submitButton.textContent = 'Subscribe';
                    }, 1000);
                }
            });
        });
    }

    /**
     * Table of Contents Functionality
     */
    function initTableOfContents() {
        const tocContainer = document.querySelector('.table-of-contents');
        const contentArea = document.querySelector('.entry-content');
        
        if (tocContainer && contentArea) {
            // Add IDs to headings for anchor links
            const headings = contentArea.querySelectorAll('h2, h3, h4, h5, h6');
            headings.forEach(heading => {
                if (!heading.id) {
                    heading.id = generateSlug(heading.textContent);
                }
            });
            
            // Highlight current section in TOC
            const tocLinks = tocContainer.querySelectorAll('a[href^="#"]');
            
            if (tocLinks.length > 0) {
                window.addEventListener('scroll', throttle(function() {
                    let current = '';
                    
                    headings.forEach(heading => {
                        const rect = heading.getBoundingClientRect();
                        if (rect.top <= 100) {
                            current = heading.id;
                        }
                    });
                    
                    tocLinks.forEach(link => {
                        link.classList.remove('font-bold', 'text-blue-800');
                        if (link.getAttribute('href') === '#' + current) {
                            link.classList.add('font-bold', 'text-blue-800');
                        }
                    });
                }, 100));
            }
        }
    }

    /**
     * Image Lazy Loading (for browsers that don't support native lazy loading)
     */
    function initImageLazyLoading() {
        if ('loading' in HTMLImageElement.prototype) {
            // Native lazy loading is supported
            return;
        }
        
        const images = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    observer.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    }

    /**
     * Accessibility Enhancements
     */
    function initAccessibilityEnhancements() {
        // Skip link functionality
        const skipLink = document.querySelector('.skip-link');
        if (skipLink) {
            skipLink.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.focus();
                    target.scrollIntoView();
                }
            });
        }
        
        // Keyboard navigation for dropdowns
        const dropdownToggles = document.querySelectorAll('[aria-haspopup="true"]');
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });
        
        // Focus management for modals and overlays
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                const focusableElements = getFocusableElements();
                const firstElement = focusableElements[0];
                const lastElement = focusableElements[focusableElements.length - 1];
                
                if (e.shiftKey && document.activeElement === firstElement) {
                    e.preventDefault();
                    lastElement.focus();
                } else if (!e.shiftKey && document.activeElement === lastElement) {
                    e.preventDefault();
                    firstElement.focus();
                }
            }
        });
    }

    /**
     * Smart Page Builder Placeholder Enhancements
     */
    function initSmartPageBuilderPlaceholders() {
        const placeholders = document.querySelectorAll('.smart-page-builder-placeholder');
        
        placeholders.forEach(placeholder => {
            // Add loading animation
            placeholder.classList.add('animate-pulse');
            
            // Simulate content loading (replace with actual Smart Page Builder integration)
            setTimeout(() => {
                placeholder.classList.remove('animate-pulse');
                
                // Add a subtle indicator that this is where dynamic content will appear
                const indicator = document.createElement('div');
                indicator.className = 'text-xs text-gray-500 mt-2';
                indicator.textContent = 'Dynamic content will be loaded here by Smart Page Builder';
                placeholder.appendChild(indicator);
            }, 2000);
        });
    }

    /**
     * Utility Functions
     */
    
    // Throttle function for performance
    function throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }
    
    // Generate URL-friendly slug from text
    function generateSlug(text) {
        return text
            .toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }
    
    // Get all focusable elements
    function getFocusableElements() {
        return Array.from(document.querySelectorAll(
            'a[href], button, input, textarea, select, details, [tabindex]:not([tabindex="-1"])'
        )).filter(el => !el.disabled && !el.hidden);
    }
    
    // Trap focus within an element
    function trapFocus(element) {
        const focusableElements = element.querySelectorAll(
            'a[href], button, input, textarea, select, details, [tabindex]:not([tabindex="-1"])'
        );
        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];
        
        element.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                if (e.shiftKey && document.activeElement === firstElement) {
                    e.preventDefault();
                    lastElement.focus();
                } else if (!e.shiftKey && document.activeElement === lastElement) {
                    e.preventDefault();
                    firstElement.focus();
                }
            }
        });
        
        // Focus first element
        if (firstElement) {
            firstElement.focus();
        }
    }
    
    // Show notification message
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm transition-all duration-300 transform translate-x-full`;
        
        // Set notification style based on type
        switch (type) {
            case 'success':
                notification.classList.add('bg-green-500', 'text-white');
                break;
            case 'error':
                notification.classList.add('bg-red-500', 'text-white');
                break;
            case 'warning':
                notification.classList.add('bg-yellow-500', 'text-black');
                break;
            default:
                notification.classList.add('bg-blue-500', 'text-white');
        }
        
        notification.innerHTML = `
            <div class="flex items-center justify-between">
                <span>${message}</span>
                <button class="ml-4 text-white hover:text-gray-200" onclick="this.parentElement.parentElement.remove()">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 300);
        }, 5000);
    }

    /**
     * Performance Monitoring
     */
    function initPerformanceMonitoring() {
        // Monitor Core Web Vitals
        if ('web-vital' in window) {
            // This would integrate with actual performance monitoring
            console.log('Performance monitoring initialized');
        }
        
        // Log page load time
        window.addEventListener('load', function() {
            const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart;
            console.log(`Page load time: ${loadTime}ms`);
        });
    }

    /**
     * Initialize performance monitoring
     */
    initPerformanceMonitoring();

})();

/**
 * WordPress Customizer Live Preview Support
 */
if (typeof wp !== 'undefined' && wp.customize) {
    wp.customize('diy_header_text_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--header-text-color', newval);
        });
    });
}

/**
 * Service Worker Registration (for future PWA features)
 */
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        // Uncomment when service worker is implemented
        // navigator.serviceWorker.register('/sw.js');
    });
}
