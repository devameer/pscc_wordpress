(() => {
    const initializeHeroSlider = (slider) => {
        if (!window.Swiper || !slider) {
            return;
        }

        const autoplayDelay = parseInt(slider.dataset.autoplay || '0', 10);
        const hasNavigation = slider.dataset.hasNavigation === 'true';
        const hasPagination = slider.dataset.hasPagination === 'true';
        const loop = slider.dataset.loop === 'true';

        const config = {
            loop,
            speed: 600,
            slidesPerView: 1,
            spaceBetween: 32,
            autoplay: autoplayDelay > 0 ? { delay: autoplayDelay, disableOnInteraction: false } : false,
            pagination: hasPagination
                ? {
                    el: slider.querySelector('.swiper-pagination'),
                    clickable: true,
                }
                : undefined,
            navigation: hasNavigation
                ? {
                    nextEl: slider.querySelector('.swiper-button-next'),
                    prevEl: slider.querySelector('.swiper-button-prev'),
                }
                : undefined,
            on: {
                slideChangeTransitionStart: function () {
                    // Reset animations on all slides
                    const allSlides = slider.querySelectorAll('.swiper-slide');
                    allSlides.forEach((slide) => {
                        const animatedElements = slide.querySelectorAll(
                            '.hero-title-animate, .hero-description-animate, .hero-buttons-animate, .hero-or-animate, .hero-video-button'
                        );
                        animatedElements.forEach((el) => {
                            el.style.animation = 'none';
                        });
                    });
                },
                slideChangeTransitionEnd: function () {
                    // Re-trigger animations on active slide
                    const activeSlide = slider.querySelector('.swiper-slide-active');
                    if (activeSlide) {
                        const animatedElements = activeSlide.querySelectorAll(
                            '.hero-title-animate, .hero-description-animate, .hero-buttons-animate, .hero-or-animate, .hero-video-button'
                        );

                        // Force reflow to restart animation
                        animatedElements.forEach((el) => {
                            el.style.animation = 'none';
                            el.offsetHeight; // Trigger reflow
                            el.style.animation = '';
                        });
                    }
                },
            },
        };

        return new window.Swiper(slider, config);
    };

    const initializeCarousel = (slider, config) => {
        if (!window.Swiper || !slider) {
            return null;
        }

        return new window.Swiper(slider, config);
    };

    const onReady = () => {
        if (!window.Swiper) {
            return;
        }

        document.querySelectorAll('.hero-slider').forEach((slider) => initializeHeroSlider(slider));

        document.querySelectorAll('.members-slider').forEach((slider) => {
            const wrapper = slider.parentElement;
            const nextEl = wrapper ? wrapper.querySelector('.members-button-next') : null;
            const prevEl = wrapper ? wrapper.querySelector('.members-button-prev') : null;

            initializeCarousel(
                slider,
                {
                    loop: true,
                    speed: 500,
                    spaceBetween: 30,
                    slidesPerView: 1,
                    autoplay: true, 
                
                    navigation: nextEl && prevEl ? { nextEl, prevEl } : undefined,
                    breakpoints: {
                        640: {
                            slidesPerView: 2,
                        },
                        768: {
                            slidesPerView: 3,
                        },
                        1024: {
                            slidesPerView: 4,
                        },
                        1280: {
                            slidesPerView: 5,
                        },
                    },
                }
            );
        });
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', onReady);
    } else {
        onReady();
    }
})();

// Mobile menu toggle
(() => {
    const toggleButtons = document.querySelectorAll('[data-menu-toggle="mobile"]');

    toggleButtons.forEach((button) => {
        const targetId = button.getAttribute('aria-controls');
        const target = document.getElementById(targetId);

        if (!target) {
            return;
        }

        button.addEventListener('click', () => {
            const isExpanded = button.getAttribute('aria-expanded') === 'true';
            button.setAttribute('aria-expanded', String(!isExpanded));
            target.classList.toggle('hidden', isExpanded);
        });
    });
})();

// Mobile dropdown menu toggle
(() => {
    const mobileMenu = document.getElementById('mobile-menu');
    if (!mobileMenu) return;

    const dropdownParents = mobileMenu.querySelectorAll('.has-dropdown');

    dropdownParents.forEach((parent) => {
        const link = parent.querySelector('a');
        if (!link) return;

        // Prevent default click on parent link
        link.addEventListener('click', (e) => {
            // Only prevent default if it has a submenu
            if (parent.querySelector('.dropdown-menu')) {
                e.preventDefault();
                parent.classList.toggle('mobile-dropdown-open');
            }
        });
    });
})();

// Sticky header and topbar on scroll
(() => {
    const header = document.querySelector('[data-scroll-header]');
    const topbar = document.querySelector('.topbar-section');
    const siteContent = document.getElementById('content');

    if (!header) {
        return;
    }

    // Calculate total header height for placeholder
    const getHeaderHeight = () => {
        const topbarHeight = topbar ? topbar.offsetHeight : 0;
        const headerHeight = header.offsetHeight;
        return topbarHeight + headerHeight;
    };

    // Create placeholder to prevent content jump when header becomes fixed
    let placeholder = document.getElementById('header-placeholder');
    if (!placeholder) {
        placeholder = document.createElement('div');
        placeholder.id = 'header-placeholder';
        placeholder.style.display = 'none';
        if (topbar) {
            topbar.parentNode.insertBefore(placeholder, topbar);
        } else {
            header.parentNode.insertBefore(placeholder, header);
        }
    }

    const thresholdAttr = parseInt(header.getAttribute('data-scroll-threshold') || '48', 10);
    const threshold = Number.isNaN(thresholdAttr) ? 48 : thresholdAttr;
    const logoDefault = header.querySelector('.logo-default');
    const logoScroll = header.querySelector('.logo-scroll');

    const applyState = () => {
        const isScrolled = window.scrollY > threshold;
        const hasClass = header.classList.contains('is-scrolled');

        if (isScrolled === hasClass) {
            return;
        }

        header.classList.toggle('is-scrolled', isScrolled);

        if (isScrolled) {
            // Show placeholder to prevent content jump
            placeholder.style.display = 'block';
            placeholder.style.height = getHeaderHeight() + 'px';

            // Make topbar fixed
            if (topbar) {
                topbar.style.position = 'fixed';
                topbar.style.top = '0';
                topbar.style.left = '0';
                topbar.style.right = '0';
                topbar.style.zIndex = '51';
            }

            // Make navbar fixed below topbar
            const topbarHeight = topbar ? topbar.offsetHeight : 0;
            header.style.position = 'fixed';
            header.style.top = topbarHeight + 'px';
            header.style.left = '0';
            header.style.right = '0';
            header.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.15)';

            // Switch logos using opacity
            if (logoDefault && logoScroll) {
                logoDefault.style.opacity = '0';
                logoScroll.style.opacity = '1';
            }
        } else {
            // Hide placeholder
            placeholder.style.display = 'none';

            // Reset topbar position
            if (topbar) {
                topbar.style.position = '';
                topbar.style.top = '';
                topbar.style.left = '';
                topbar.style.right = '';
                topbar.style.zIndex = '';
            }

            // Reset navbar position
            header.style.position = '';
            header.style.top = '';
            header.style.left = '';
            header.style.right = '';
            header.style.boxShadow = '';

            // Switch logos back using opacity
            if (logoDefault && logoScroll) {
                logoDefault.style.opacity = '1';
                logoScroll.style.opacity = '0';
            }
        }
    };

    let ticking = false;

    const handle = () => {
        if (ticking) {
            return;
        }

        window.requestAnimationFrame(() => {
            ticking = false;
            applyState();
        });

        ticking = true;
    };

    window.addEventListener('scroll', handle, { passive: true });
    window.addEventListener('resize', handle);
    applyState();
})();

// Menu "Other" dropdown functionality
(() => {
    const initMenuOtherDropdown = () => {
        const primaryMenu = document.getElementById('primary-menu');

        if (!primaryMenu) {
            return;
        }

        const menuItems = Array.from(primaryMenu.children);
        const itemCount = menuItems.length;

        // Only proceed if there are more than 3 items
        if (itemCount <= 4) {
            return;
        }

        // Get the last 3 items
        const itemsToHide = menuItems.slice(-4);

        // Create "Other" dropdown container
        const menuLabel = (typeof beitStrings !== 'undefined' && beitStrings.menu) ? beitStrings.menu : 'Menu';
        const otherDropdown = document.createElement('li');
        otherDropdown.className = 'menu-other-dropdown relative';
        otherDropdown.innerHTML = `
            <a href="#" class="menu-other-trigger flex items-center gap-1">
                            <i class="fa fa-bars  transition-transform duration-300"></i>

                <span>${menuLabel}</span>
            </a>
            <ul class="menu-other-list opacity-0 invisible transition-all duration-300 pointer-events-none">
            </ul>
        `;

        // Move hidden items to dropdown
        const otherList = otherDropdown.querySelector('.menu-other-list');
        itemsToHide.forEach((item) => {
            const clonedItem = item.cloneNode(true);
            clonedItem.className = 'border-b border-white/10 last:border-0';

            const link = clonedItem.querySelector('a');
            if (link) {
                link.className = 'block px-4 py-3 text-white transition hover:bg-primary';
            }

            otherList.appendChild(clonedItem);
            item.remove();
        });

        // Add dropdown to menu
        primaryMenu.appendChild(otherDropdown);

        // Handle dropdown toggle
        const trigger = otherDropdown.querySelector('.menu-other-trigger');
        const list = otherDropdown.querySelector('.menu-other-list');
        const icon = trigger.querySelector('i');
        let isOpen = false;

        const openDropdown = () => {
            if (isOpen) return;
            isOpen = true;
            list.classList.remove('opacity-0', 'invisible', 'pointer-events-none');
            list.classList.add('opacity-100', 'visible', 'pointer-events-auto');
            icon.style.transform = 'rotate(180deg)';
        };

        const closeDropdown = () => {
            if (!isOpen) return;
            isOpen = false;
            list.classList.add('opacity-0', 'invisible', 'pointer-events-none');
            list.classList.remove('opacity-100', 'visible', 'pointer-events-auto');
            icon.style.transform = 'rotate(0deg)';
        };

        // Mouse enter/leave events
        otherDropdown.addEventListener('mouseenter', openDropdown);
        otherDropdown.addEventListener('mouseleave', closeDropdown);

        // Prevent default click on trigger
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            if (isOpen) {
                closeDropdown();
            } else {
                openDropdown();
            }
        });

        // Close on click outside
        document.addEventListener('click', (e) => {
            if (!otherDropdown.contains(e.target)) {
                closeDropdown();
            }
        });
    };

    // Initialize on DOM ready
    // if (document.readyState === 'loading') {
    //     document.addEventListener('DOMContentLoaded', initMenuOtherDropdown);
    // } else {
    //     initMenuOtherDropdown();
    // }
})();

// Lazy background images on scroll
(() => {
    const lazyBgElements = document.querySelectorAll('[data-bg]');
    if (lazyBgElements.length === 0) return;

    const loadBg = (el) => {
        if (el.dataset.bgLoaded === 'true') return;
        const src = el.getAttribute('data-bg');
        if (!src) return;
        el.dataset.bgLoaded = 'true';
        const img = new Image();
        img.onload = () => {
            el.style.backgroundImage = `url(${src})`;
            el.classList.add('bg-loaded');
        };
        img.src = src;
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                loadBg(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    lazyBgElements.forEach((el) => {
        observer.observe(el);
    });
})();

// Search page client-side filters
(() => {
    const container = document.querySelector('section.container');
    if (!container) return;

    const filterLinks = container.querySelectorAll('[data-filter]');
    const cards = container.querySelectorAll('[data-type]');
    if (filterLinks.length === 0 || cards.length === 0) return;

    const setActive = (type) => {
        filterLinks.forEach((a) => {
            const current = a.dataset.filter || 'all';
            const isActive = type === 'all' ? current === 'all' : current === type;
            a.classList.toggle('bg-primary', isActive);
            a.classList.toggle('text-white', isActive);
            a.classList.toggle('bg-slate-100', !isActive);
            a.classList.toggle('text-slate-700', !isActive);
        });
    };

    const applyFilter = (type) => {
        cards.forEach((card) => {
            const show = type === 'all' || (card.dataset.type || '') === type;
            card.style.display = show ? '' : 'none';
        });
        setActive(type);
    };

    filterLinks.forEach((a) => {
        a.addEventListener('click', (e) => {
            e.preventDefault();
            const type = a.dataset.filter || 'all';
            applyFilter(type);
        });
    });

    const url = new URL(window.location.href);
    const type = url.searchParams.get('post_type') || 'all';
    applyFilter(type);
})();

// Back-to-top button
(() => {
    const btn = document.getElementById('back-to-top');
    if (!btn) return;
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
})();

// FSLightbox - Add captions manually
(() => {
    const addCaptionToLightbox = () => {
        // Find the FSLightbox slide
        const slideImage = document.querySelector('.fslightbox-slide-number-container');
        if (!slideImage) return;

        // Get the current lightbox instance
        const container = document.querySelector('.fslightbox-container');
        if (!container) return;

        // Find or create caption element
        let captionEl = container.querySelector('.fslightbox-custom-caption');

        if (!captionEl) {
            captionEl = document.createElement('div');
            captionEl.className = 'fslightbox-custom-caption';
            captionEl.style.cssText = `
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                width: 100%;
                background: linear-gradient(to top, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.7) 50%, transparent);
                padding: 40px 20px 25px;
                font-size: 20px;
                font-weight: 600;
                color: white;
                text-align: center;
                text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8);
                font-family: 'Montserrat', system-ui, -apple-system, sans-serif;
                z-index: 2147483647;
                pointer-events: none;
            `;
            container.appendChild(captionEl);
        }

        // Get caption from current active link
        const activeLinks = document.querySelectorAll('a[data-fslightbox]');
        activeLinks.forEach(link => {
            link.addEventListener('click', function () {
                const caption = this.getAttribute('data-caption');
                setTimeout(() => {
                    const captionElement = document.querySelector('.fslightbox-custom-caption');
                    if (captionElement && caption) {
                        captionElement.textContent = caption;
                        captionElement.style.display = 'block';
                    }
                }, 100);
            });
        });
    };

    // Watch for FSLightbox opening
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            mutation.addedNodes.forEach((node) => {
                if (node.nodeType === 1 && node.classList) {
                    if (node.classList.contains('fslightbox-container')) {
                        addCaptionToLightbox();
                    }
                }
            });
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: false
    });

    // Also initialize captions on all lightbox links
    document.addEventListener('click', (e) => {
        const link = e.target.closest('a[data-fslightbox]');
        if (link) {
            const caption = link.getAttribute('data-caption');
            setTimeout(() => {
                let captionEl = document.querySelector('.fslightbox-custom-caption');
                const container = document.querySelector('.fslightbox-container');

                if (container && !captionEl) {
                    captionEl = document.createElement('div');
                    captionEl.className = 'fslightbox-custom-caption';
                    captionEl.style.cssText = `
                        position: fixed;
                        bottom: 0;
                        left: 0;
                        right: 0;
                        width: 100%;
                        background: linear-gradient(to top, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.7) 50%, transparent);
                        padding: 40px 20px 25px;
                        font-size: 20px;
                        font-weight: 600;
                        color: white;
                        text-align: center;
                        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8);
                        font-family: 'Montserrat', system-ui, -apple-system, sans-serif;
                        z-index: 2147483647;
                        pointer-events: none;
                    `;
                    container.appendChild(captionEl);
                }

                if (captionEl && caption) {
                    captionEl.textContent = caption;
                    captionEl.style.display = 'block';
                }
            }, 150);
        }
    });

    console.log('FSLightbox custom captions initialized');
})();