/**
 * Putar - Music Playlist App
 * Interactive JavaScript Enhancements
 */

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    
    // ===== Navigation Menu Toggle =====
    initMobileMenu();
    
    // ===== Smooth Scrolling =====
    initSmoothScroll();
    
    // ===== Keyboard Shortcuts =====
    initKeyboardShortcuts();
    
    // ===== Form Enhancements =====
    initFormEnhancements();
    
    // ===== Intersection Observer for Animations =====
    initAnimationObserver();
    
    // ===== Vinyl Disc Click to Play/Pause =====
    initVinylInteraction();
    
    // ===== Progress Bar Animation =====
    initProgressBar();
    
    // ===== Table Row Highlight =====
    initTableInteraction();
    
    // ===== Playlist Card Click =====
    initPlaylistCards();
    
    // ===== Search Enhancement =====
    initSearchEnhancement();
    
    // ===== Toast Notifications (for future use) =====
    window.showToast = showToast;
});

/**
 * Mobile Menu Toggle
 */
function initMobileMenu() {
    const toggle = document.getElementById('nav-toggle');
    const menu = document.getElementById('nav-menu');
    
    if (toggle && menu) {
        toggle.addEventListener('click', function() {
            const isOpen = menu.classList.toggle('open');
            toggle.setAttribute('aria-expanded', isOpen);
            toggle.textContent = isOpen ? 'Tutup' : 'Menu';
            
            // Close menu when clicking outside
            if (isOpen) {
                document.addEventListener('click', closeMenuOutside);
            } else {
                document.removeEventListener('click', closeMenuOutside);
            }
        });
        
        function closeMenuOutside(e) {
            if (!menu.contains(e.target) && !toggle.contains(e.target)) {
                menu.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
                toggle.textContent = 'Menu';
                document.removeEventListener('click', closeMenuOutside);
            }
        }
    }
}

/**
 * Smooth Scrolling for Anchor Links
 */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            e.preventDefault();
            const target = document.querySelector(href);
            
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Update URL without triggering scroll
                if (history.pushState) {
                    history.pushState(null, null, href);
                }
            }
        });
    });
}

/**
 * Keyboard Shortcuts
 */
function initKeyboardShortcuts() {
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + K: Focus search input
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            const searchInput = document.querySelector('.search-input, input[name="username"], input[type="text"]');
            if (searchInput) {
                searchInput.focus();
                searchInput.select();
            }
        }
        
        // Escape: Clear search or close mobile menu
        if (e.key === 'Escape') {
            // Clear search if focused
            const searchInput = document.querySelector('.search-input');
            if (searchInput && document.activeElement === searchInput) {
                if (searchInput.value) {
                    searchInput.value = '';
                    searchInput.blur();
                }
                return;
            }
            
            // Close mobile menu
            const menu = document.getElementById('nav-menu');
            const toggle = document.getElementById('nav-toggle');
            if (menu && menu.classList.contains('open')) {
                menu.classList.remove('open');
                if (toggle) {
                    toggle.setAttribute('aria-expanded', 'false');
                    toggle.textContent = 'Menu';
                }
            }
        }
    });
}

/**
 * Form Enhancements
 */
function initFormEnhancements() {
    // Add loading state to forms
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const btn = this.querySelector('.btn');
            if (btn && !btn.disabled) {
                btn.disabled = true;
                btn.style.opacity = '0.7';
                const originalText = btn.innerHTML;
                btn.innerHTML = '<span>⏳ Memproses...</span>';
                
                // Prevent multiple submits
                setTimeout(() => {
                    if (this.checkValidity()) {
                        // Form is valid, will submit
                    } else {
                        // Form is invalid, restore button
                        btn.disabled = false;
                        btn.style.opacity = '1';
                        btn.innerHTML = originalText;
                    }
                }, 100);
            }
        });
    });
    
    // Real-time validation feedback
    document.querySelectorAll('input[required]').forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.style.borderColor = '#ff4d8a';
            } else {
                this.style.borderColor = '#4ee8ff';
            }
        });
        
        input.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.style.borderColor = '';
            }
        });
    });
}

/**
 * Intersection Observer for Fade-in Animations
 */
function initAnimationObserver() {
    if (!('IntersectionObserver' in window)) return;
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    // Observe cards and stats
    document.querySelectorAll('.card, .stat, .grid > *').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
}

/**
 * Vinyl Disc Interaction
 */
function initVinylInteraction() {
    const discs = document.querySelectorAll('.disc');
    
    discs.forEach(disc => {
        disc.addEventListener('click', function() {
            if (this.classList.contains('spin')) {
                this.style.animationPlayState = 
                    this.style.animationPlayState === 'paused' ? 'running' : 'paused';
            }
        });
        
        disc.style.cursor = 'pointer';
        disc.setAttribute('role', 'button');
        disc.setAttribute('aria-label', 'Animation control');
    });
}

/**
 * Progress Bar Animation
 */
function initProgressBar() {
    const progressBars = document.querySelectorAll('.progress span');
    
    progressBars.forEach(bar => {
        const targetWidth = bar.style.width || '38%';
        bar.style.width = '0';
        
        setTimeout(() => {
            bar.style.transition = 'width 1.5s ease';
            bar.style.width = targetWidth;
        }, 500);
    });
}

/**
 * Table Row Interaction
 */
function initTableInteraction() {
    const tableRows = document.querySelectorAll('tbody tr');
    
    tableRows.forEach(row => {
        row.addEventListener('click', function() {
            // Remove active class from all rows
            tableRows.forEach(r => r.classList.remove('active-row'));
            
            // Add active class to clicked row
            this.classList.add('active-row');
            
            // Add style for active row
            const style = document.createElement('style');
            style.textContent = `
                .active-row {
                    background: rgba(163,133,255,0.2) !important;
                    border-left: 3px solid #a385ff !important;
                }
            `;
            if (!document.getElementById('active-row-style')) {
                style.id = 'active-row-style';
                document.head.appendChild(style);
            }
        });
        
        row.style.cursor = 'pointer';
    });
}

/**
 * Playlist Card Interaction
 */
function initPlaylistCards() {
    const playlistCards = document.querySelectorAll('.playlist');
    
    playlistCards.forEach(card => {
        // Add ripple effect on click
        card.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.classList.add('ripple-effect');
            
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            ripple.style.cssText = `
                position: absolute;
                width: 10px;
                height: 10px;
                border-radius: 50%;
                background: rgba(255,255,255,0.5);
                transform: translate(-50%, -50%) scale(0);
                animation: ripple-animation 0.6s ease-out;
                pointer-events: none;
                left: ${x}px;
                top: ${y}px;
            `;
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            // Add ripple animation if not exists
            if (!document.getElementById('ripple-style')) {
                const style = document.createElement('style');
                style.id = 'ripple-style';
                style.textContent = `
                    @keyframes ripple-animation {
                        to {
                            transform: translate(-50%, -50%) scale(40);
                            opacity: 0;
                        }
                    }
                `;
                document.head.appendChild(style);
            }
            
            setTimeout(() => ripple.remove(), 600);
        });
    });
}

/**
 * Search Enhancement
 */
function initSearchEnhancement() {
    const searchInput = document.querySelector('.search-input');
    
    if (!searchInput) return;
    
    // Auto-focus on page load if search parameter exists
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('search')) {
        setTimeout(() => {
            searchInput.focus();
            // Move cursor to end
            searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
        }, 300);
    }
    
    // Real-time character counter (optional)
    searchInput.addEventListener('input', function() {
        const value = this.value.trim();
        
        // Optional: Add min length hint
        if (value.length > 0 && value.length < 2) {
            this.style.borderColor = 'var(--amber)';
        } else if (value.length >= 2) {
            this.style.borderColor = 'var(--cyan)';
        } else {
            this.style.borderColor = '';
        }
    });
    
    // Submit on Enter
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            this.closest('form').submit();
        }
    });
}

/**
 * Toast Notification (for future use)
 */
function showToast(message, type = 'info', duration = 3000) {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.textContent = message;
    
    // Add toast styles if not exists
    if (!document.getElementById('toast-style')) {
        const style = document.createElement('style');
        style.id = 'toast-style';
        style.textContent = `
            .toast {
                position: fixed;
                bottom: 2rem;
                right: 2rem;
                padding: 1rem 1.5rem;
                background: rgba(26,18,48,0.95);
                border: 1px solid rgba(163,133,255,0.3);
                border-radius: 12px;
                color: white;
                font-weight: 500;
                box-shadow: 0 8px 32px rgba(0,0,0,0.5);
                animation: toast-slide-in 0.3s ease;
                z-index: 9999;
                max-width: 300px;
            }
            .toast-success {
                border-left: 4px solid #4dff88;
            }
            .toast-error {
                border-left: 4px solid #ff4d8a;
            }
            .toast-info {
                border-left: 4px solid #4ee8ff;
            }
            @keyframes toast-slide-in {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes toast-slide-out {
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }
    
    document.body.appendChild(toast);
    
    // Remove toast after duration
    setTimeout(() => {
        toast.style.animation = 'toast-slide-out 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, duration);
}

/**
 * Performance: Debounce function
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

/**
 * Utility: Check if element is in viewport
 */
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Expose utilities to global scope
window.PutarApp = {
    showToast,
    debounce,
    isInViewport
};

console.log('🎵 Putar App Loaded Successfully!');
