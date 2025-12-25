/**
 * PhotoSwipe Gallery Initialization
 * Handles image galleries with thumbnail navigation
 */

document.addEventListener('DOMContentLoaded', function() {
    // Check if PhotoSwipe is loaded
    if (typeof PhotoSwipeLightbox === 'undefined' || typeof PhotoSwipe === 'undefined') {
        console.error('PhotoSwipe not loaded');
        return;
    }

    console.log('PhotoSwipe loaded successfully');

    // Get all gallery links
    const galleryLinks = document.querySelectorAll('a[data-pswp-gallery]');
    console.log('Found ' + galleryLinks.length + ' gallery links');

    if (galleryLinks.length === 0) {
        console.log('No PhotoSwipe galleries found');
        return;
    }

    // Get unique gallery IDs
    const galleries = new Set();
    galleryLinks.forEach(el => {
        const galleryId = el.getAttribute('data-pswp-gallery');
        if (galleryId) {
            galleries.add(galleryId);
        }
    });

    console.log('Found ' + galleries.size + ' unique galleries');

    // Initialize each gallery
    galleries.forEach(galleryId => {
        console.log('Initializing gallery: ' + galleryId);

        const options = {
            gallerySelector: null,  // We'll handle clicks manually
            pswpModule: PhotoSwipe,
            paddingFn: (viewportSize) => {
                return {
                    top: 50,
                    bottom: 50,
                    left: Math.max(100, viewportSize.x * 0.1),
                    right: Math.max(100, viewportSize.x * 0.1)
                };
            },
            bgOpacity: 0.9,
            showHideAnimationType: 'zoom',
        };

        const lightbox = new PhotoSwipeLightbox(options);

        // Add UI elements
        lightbox.on('uiRegister', function() {
            // Custom caption
            lightbox.pswp.ui.registerElement({
                name: 'custom-caption',
                order: 9,
                isButton: false,
                appendTo: 'root',
                html: '',
                onInit: (el, pswp) => {
                    const updateCaption = () => {
                        const currSlide = pswp.currSlide;
                        if (!currSlide || !currSlide.data || !currSlide.data.element) return;

                        const captionEl = currSlide.data.element.querySelector('.pswp-caption-content');
                        if (captionEl && captionEl.textContent.trim()) {
                            el.innerHTML = '<div style="position:absolute;bottom:0;left:0;right:0;background:linear-gradient(to top,rgba(0,0,0,0.9),rgba(0,0,0,0.7) 50%,transparent);padding:40px 20px 25px;font-size:18px;font-weight:600;color:white;text-align:center;text-shadow:0 2px 8px rgba(0,0,0,0.8);z-index:1050;">' + captionEl.textContent + '</div>';
                        }
                    };

                    pswp.on('change', updateCaption);
                    updateCaption();
                }
            });

            // Thumbnails strip
            lightbox.pswp.ui.registerElement({
                name: 'thumbnails',
                order: 10,
                isButton: false,
                appendTo: 'wrapper',
                html: '',
                onInit: (el, pswp) => {
                    el.style.cssText = 'position:absolute;bottom:80px;left:50%;transform:translateX(-50%);display:flex;gap:8px;padding:10px;background:rgba(0,0,0,0.7);border-radius:8px;max-width:90%;overflow-x:auto;z-index:1040;scrollbar-width:thin;';

                    const updateThumbnails = () => {
                        el.innerHTML = '';

                        const items = pswp.options.dataSource;
                        if (!items || !items.length) return;

                        items.forEach((item, index) => {
                            const thumbEl = item.element?.querySelector('.pswp-thumbnail');
                            if (thumbEl && thumbEl.src) {
                                const isActive = index === pswp.currIndex;
                                const thumb = document.createElement('div');
                                thumb.style.cssText = 'width:60px;height:60px;cursor:pointer;border:2px solid ' + (isActive ? '#fff' : 'rgba(255,255,255,0.3)') + ';border-radius:4px;overflow:hidden;transition:all 0.2s;flex-shrink:0;';
                                thumb.innerHTML = '<img src="' + thumbEl.src + '" style="width:100%;height:100%;object-fit:cover;" />';
                                thumb.onclick = () => pswp.goTo(index);

                                // Scroll active thumbnail into view
                                if (isActive) {
                                    setTimeout(() => {
                                        thumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                                    }, 100);
                                }

                                el.appendChild(thumb);
                            }
                        });
                    };

                    pswp.on('change', updateThumbnails);
                    updateThumbnails();
                }
            });
        });

        lightbox.init();

        // Get all links for this specific gallery
        const links = document.querySelectorAll('a[data-pswp-gallery="' + galleryId + '"]');
        console.log('Gallery ' + galleryId + ' has ' + links.length + ' images');

        // Add click handlers
        links.forEach((link, index) => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                console.log('Opening gallery: ' + galleryId + ' at index: ' + index);

                // Prepare data source for PhotoSwipe
                const dataSource = Array.from(links).map(item => {
                    const thumbEl = item.querySelector('.pswp-thumbnail');
                    return {
                        src: item.href,
                        width: parseInt(item.getAttribute('data-pswp-width')) || 1920,
                        height: parseInt(item.getAttribute('data-pswp-height')) || 1080,
                        alt: thumbEl ? thumbEl.alt : '',
                        element: item
                    };
                });

                // Open PhotoSwipe
                lightbox.loadAndOpen(index, dataSource);
            });
        });

        console.log('Gallery initialized: ' + galleryId);
    });

    console.log('All galleries initialized successfully');
});
