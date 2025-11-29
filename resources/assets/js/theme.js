// Wait for Swiper to be loaded
const waitForSwiper = (callback) => {
    if (window.Swiper) {
        callback();
    } else {
        setTimeout(() => waitForSwiper(callback), 50);
    }
};

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
            // autoplay: autoplayDelay > 0 ? { delay: autoplayDelay } : false,
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
        waitForSwiper(() => {
            document.querySelectorAll('.hero-slider').forEach((slider) => initializeHeroSlider(slider));

            document.querySelectorAll('.initiatives-slider').forEach((slider) => {
                const wrapper = slider.parentElement;
                const nextEl = wrapper ? wrapper.querySelector('.initiatives-button-next') : null;
                const prevEl = wrapper ? wrapper.querySelector('.initiatives-button-prev') : null;

                initializeCarousel(slider, {
                  loop: true,
                  speed: 600,
                  spaceBetween: 24,
                  slidesPerView: 1,
                  navigation: nextEl && prevEl ? { nextEl, prevEl } : undefined,
                  breakpoints: {
                    500: {
                      slidesPerView: 2,
                    },
                    600: {
                      slidesPerView: 3,
                    },
                    1000: {
                      slidesPerView: 4,
                    },
                    1024: {
                      slidesPerView: 5,
                    },
                    1280: {
                      slidesPerView: 6,
                    },
                  },
                });
            });

            document.querySelectorAll('.partners-slider').forEach((slider) => {
                const wrapper = slider.parentElement;
                const nextEl = wrapper ? wrapper.querySelector('.partners-button-next') : null;
                const prevEl = wrapper ? wrapper.querySelector('.partners-button-prev') : null;

                initializeCarousel(
                    slider,
                    {
                        loop: true,
                        speed: 500,
                        spaceBetween: 30,
                        slidesPerView: 1,
                        autoplay: {
                            delay: 3500,
                            disableOnInteraction: false,
                        },
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

    if (!header) {
        return;
    }

    // Set initial topbar height as CSS variable and position header
    const setTopbarHeight = () => {
        if (topbar) {
            const topbarHeight = topbar.offsetHeight;
            document.documentElement.style.setProperty('--topbar-height', topbarHeight + 'px');
            if (!header.classList.contains('is-scrolled')) {
                header.style.top = topbarHeight + 'px';
            }
        }
    };

    setTopbarHeight();
    window.addEventListener('resize', setTopbarHeight);

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
            // Make topbar and navbar fixed and sticky
            if (topbar) {
                topbar.style.position = 'fixed';
                topbar.style.top = '0';
                topbar.style.left = '0';
                topbar.style.right = '0';
                topbar.style.zIndex = '51';
                topbar.style.background = 'rgba(17, 19, 21, 0.92)';
            }
            
            // Adjust navbar position to be below topbar
            const topbarHeight = topbar ? topbar.offsetHeight : 0;
            header.style.position = 'fixed';
            header.style.top = topbarHeight + 'px';
            header.style.backgroundColor = 'rgba(17, 19, 21, 0.92)';
            header.style.boxShadow = '0 16px 32px rgba(0, 0, 0, 0.25)';
            header.style.backdropFilter = 'blur(8px)';
            header.style.webkitBackdropFilter = 'blur(8px)';
            
            // Switch logos using opacity
            if (logoDefault && logoScroll) {
                logoDefault.style.opacity = '0';
                logoScroll.style.opacity = '1';
            }
        } else {
            // Reset topbar position
            if (topbar) {
                topbar.style.position = '';
                topbar.style.top = '';
                topbar.style.left = '';
                topbar.style.right = '';
                topbar.style.zIndex = '';
                topbar.style.background = '';
            }
            
            // Reset navbar position to below topbar
            const topbarHeight = topbar ? topbar.offsetHeight : 0;
            header.style.top = topbarHeight + 'px';
            header.style.backgroundColor = '';
            header.style.boxShadow = '';
            header.style.backdropFilter = '';
            header.style.webkitBackdropFilter = '';
            
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
        const otherDropdown = document.createElement('li');
        otherDropdown.className = 'menu-other-dropdown relative';
        otherDropdown.innerHTML = `
            <a href="#" class="menu-other-trigger flex items-center gap-1">
                            <i class="fa fa-bars  transition-transform duration-300"></i>

                <span>Menu</span>
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
                link.className = 'block px-4 py-3 text-white transition hover:bg-red-600';
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
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMenuOtherDropdown);
    } else {
        initMenuOtherDropdown();
    }
})();

// Contact Map with Tabs functionality
window.initContactMap = function() {
    const mapContainer = document.getElementById('contact-map');

    if (!mapContainer || !window.contactMapData || !window.google) {
        return;
    }

    const data = window.contactMapData;
    let map;
    let officeMarkers = [];
    let warehouseMarkers = [];
    let currentTab = '';

    // Initialize the map
    map = new google.maps.Map(mapContainer, {
        center: data.defaultCenter,
        zoom: data.defaultZoom,
        styles: [
            {
                featureType: 'poi',
                elementType: 'labels',
                stylers: [{ visibility: 'off' }]
            }
        ]
    });

    // Create custom marker icons
    const createMarkerIcon = (color) => {
        return {
            path: 'M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z',
            fillColor: color,
            fillOpacity: 1,
            strokeColor: '#ffffff',
            strokeWeight: 2,
            scale: 1.5,
            anchor: new google.maps.Point(12, 22)
        };
    };

    // Function to create markers for a location type
    const createMarkers = (locations, type) => {
        const markers = [];
        const color = type === 'offices' ? '#CB0B29' : '#4E4E4E';
        const bounds = new google.maps.LatLngBounds();

        locations.forEach((location) => {
            if (!location.lat || !location.lng) {
                return;
            }

            const position = {
                lat: location.lat,
                lng: location.lng
            };

            // Create marker with map-marker icon
            const marker = new google.maps.Marker({
                position: position,
                map: map,
                title: location.name,
                animation: google.maps.Animation.DROP,
                icon: createMarkerIcon(color)
            });

            // Create info window
            const infoContent = `
                <div style="padding: 10px; max-width: 200px;">
                    <h3 style="margin: 0 0 8px 0; font-size: 16px; font-weight: bold; color: #1f2937;">
                        ${location.name || ''}
                    </h3>
                    ${location.address ? `<p style="margin: 0; font-size: 14px; color: #6b7280;">${location.address}</p>` : ''}
                </div>
            `;

            const infoWindow = new google.maps.InfoWindow({
                content: infoContent
            });

            marker.addListener('click', () => {
                // Close all other info windows
                officeMarkers.concat(warehouseMarkers).forEach(m => {
                    if (m.infoWindow) {
                        m.infoWindow.close();
                    }
                });
                infoWindow.open(map, marker);
            });

            marker.infoWindow = infoWindow;
            marker.locationType = type;
            markers.push(marker);
            bounds.extend(position);
        });

        return {
            markers,
            bounds
        };
    };

    // Create all markers
    const officeResult = createMarkers(data.offices || [], 'offices');
    const warehouseResult = createMarkers(data.warehouses || [], 'warehouses');

    officeMarkers = officeResult.markers;
    warehouseMarkers = warehouseResult.markers;

    // Combine bounds
    const combinedBounds = new google.maps.LatLngBounds();
    officeMarkers.concat(warehouseMarkers).forEach(marker => {
        combinedBounds.extend(marker.getPosition());
    });

    // Fit map to show all markers
    if (officeMarkers.length > 0 || warehouseMarkers.length > 0) {
        map.fitBounds(combinedBounds);
    }

    // Function to show/hide markers based on tab
    const updateMarkerVisibility = (tabName) => {
        if (tabName === 'all') {
            officeMarkers.forEach(m => m.setVisible(true));
            warehouseMarkers.forEach(m => m.setVisible(true));
        } else if (tabName === 'offices') {
            officeMarkers.forEach(m => m.setVisible(true));
            warehouseMarkers.forEach(m => m.setVisible(false));
        } else if (tabName === 'warehouses') {
            officeMarkers.forEach(m => m.setVisible(false));
            warehouseMarkers.forEach(m => m.setVisible(true));
        }
    };

    // Function to switch tabs
    const switchTab = (tabName) => {
        if (currentTab === tabName) {
            return;
        }

        currentTab = tabName;

        // Update tab buttons
        document.querySelectorAll('.map-tab-button').forEach(button => {
            const isActive = button.dataset.tab === tabName;
            button.dataset.active = isActive ? 'true' : 'false';

            if (isActive) {
                button.classList.add('border-red-600', 'text-red-600', 'bg-red-50');
                button.classList.remove('border-transparent');
            } else {
                button.classList.remove('border-red-600', 'text-red-600', 'bg-red-50');
                button.classList.add('border-transparent');
            }
        });

        // Update marker visibility
        updateMarkerVisibility(tabName);
    };

    // Add click listeners to tab buttons
    document.querySelectorAll('.map-tab-button').forEach(button => {
        button.addEventListener('click', () => {
            switchTab(button.dataset.tab);
        });
    });

    // Location item click - highlight on map
    const locationItems = document.querySelectorAll('.map-location-item');
    console.log('Found location items:', locationItems.length);
    
    locationItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const tabName = this.dataset.tab;
            const locationIndex = parseInt(this.dataset.locationIndex);
            
            console.log('Clicked location:', tabName, locationIndex);
            
            // Switch to the tab if not already active
            if (currentTab !== tabName) {
                switchTab(tabName);
            }
            
            // Get the corresponding marker
            let targetMarker;
            if (tabName === 'offices' && officeMarkers[locationIndex]) {
                targetMarker = officeMarkers[locationIndex];
            } else if (tabName === 'warehouses' && warehouseMarkers[locationIndex]) {
                targetMarker = warehouseMarkers[locationIndex];
            }
            
            console.log('Target marker:', targetMarker);
            
            if (targetMarker) {
                // Close all info windows
                officeMarkers.concat(warehouseMarkers).forEach(m => {
                    if (m.infoWindow) {
                        m.infoWindow.close();
                    }
                });
                
                // Center map on marker
                map.setCenter(targetMarker.getPosition());
                map.setZoom(15);
                
                // Bounce animation
                targetMarker.setAnimation(google.maps.Animation.BOUNCE);
                setTimeout(() => {
                    targetMarker.setAnimation(null);
                }, 2000);
                
                // Open info window
                if (targetMarker.infoWindow) {
                    targetMarker.infoWindow.open(map, targetMarker);
                }
            }
            
            // Hide dropdown
            document.querySelectorAll('.map-tab-dropdown').forEach(d => d.classList.add('hidden'));
        });
    });

    // Initialize showing all markers
    switchTab('all');
};

// Facts counters on scroll
(() => {
    const counters = document.querySelectorAll('[data-counter]');
    if (counters.length === 0) return;

    // Make animateCounter global for tabs
    window.animateCounter = (el) => {
        if (el.dataset.counted === 'true') return;
        el.dataset.counted = 'true';

        const raw = el.getAttribute('data-target') || el.textContent || '0';
        const match = raw.match(/[\d,.]+/);
        const target = match ? parseFloat(match[0].replace(/,/g, '')) : 0;

        // Derive prefix/suffix from raw, keep them in output
        const numberIndex = raw.indexOf(match ? match[0] : '');
        const prefix = numberIndex > 0 ? raw.slice(0, numberIndex) : '';
        const suffix = match ? raw.slice(numberIndex + match[0].length) : '';

        const duration = parseInt(el.getAttribute('data-duration') || '2500', 10);
        const start = performance.now();

        const format = (n) => `${prefix}${Math.round(n).toLocaleString()}${suffix}`;

        const step = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3); // easeOutCubic
            el.textContent = format(target * eased);
            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                el.textContent = format(target);
            }
        };

        // Start from 0
        el.textContent = format(0);
        requestAnimationFrame(step);
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                window.animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.35 });

    counters.forEach((el) => {
        observer.observe(el);
    });
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
      a.classList.toggle('bg-red-600', isActive);
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

// Facts section year tabs
(() => {
  const tabButtons = document.querySelectorAll('.facts-tab-button');
  const yearContents = document.querySelectorAll('.facts-year-content');
  
  if (tabButtons.length === 0 || yearContents.length === 0) return;
  
  tabButtons.forEach(button => {
    button.addEventListener('click', () => {
      const targetYear = button.getAttribute('data-year');
      
      // Update button states
      tabButtons.forEach(btn => {
        const isActive = btn.getAttribute('data-year') === targetYear;
        btn.setAttribute('data-active', isActive ? 'true' : 'false');
        
        if (isActive) {
          btn.classList.remove('bg-white/10', 'text-white/70', 'hover:bg-white/20');
          btn.classList.add('bg-primary', 'text-white');
        } else {
          btn.classList.remove('bg-primary', 'text-white');
          btn.classList.add('bg-white/10', 'text-white/70', 'hover:bg-white/20');
        }
      });
      
      // Update content visibility
      yearContents.forEach(content => {
        const contentYear = content.getAttribute('data-year');
        if (contentYear === targetYear) {
          content.classList.remove('hidden');
          // Re-trigger counter animations
          const counters = content.querySelectorAll('[data-counter]');
          counters.forEach(counter => {
            counter.setAttribute('data-counted', 'false');
            // Trigger animation if in viewport
            const rect = counter.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
              animateCounter(counter);
            }
          });
        } else {
          content.classList.add('hidden');
        }
      });
    });
  });
})();