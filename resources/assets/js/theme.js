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
            autoplay: autoplayDelay > 0 ? { delay: autoplayDelay } : false,
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

        document.querySelectorAll('.initiatives-slider').forEach((slider) => {
            const wrapper = slider.parentElement;
            const nextEl = wrapper ? wrapper.querySelector('.initiatives-button-next') : null;
            const prevEl = wrapper ? wrapper.querySelector('.initiatives-button-prev') : null;

            initializeCarousel(
                slider,
                {
                    loop: true,
                    speed: 600,
                    spaceBetween: 24,
                    slidesPerView: 1,
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
                    slidesPerView: 2,
                    autoplay: {
                        delay: 3500,
                        disableOnInteraction: false,
                    },
                    navigation: nextEl && prevEl ? { nextEl, prevEl } : undefined,
                    breakpoints: {
                        640: {
                            slidesPerView: 3,
                        },
                        768: {
                            slidesPerView: 4,
                        },
                        1024: {
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

(() => {
    const header = document.querySelector('[data-scroll-header]');

    if (!header) {
        return;
    }

    const thresholdAttr = parseInt(header.getAttribute('data-scroll-threshold') || '48', 10);
    const threshold = Number.isNaN(thresholdAttr) ? 48 : thresholdAttr;

    const applyState = () => {
        const isScrolled = window.scrollY > threshold;
        const hasClass = header.classList.contains('is-scrolled');

        if (isScrolled === hasClass) {
            return;
        }

        header.classList.toggle('is-scrolled', isScrolled);

        if (isScrolled) {
            header.style.top = '0';
            header.style.backgroundColor = 'rgba(17, 19, 21, 0.92)';
            header.style.boxShadow = '0 16px 32px rgba(0, 0, 0, 0.25)';
            header.style.backdropFilter = 'blur(8px)';
            header.style.webkitBackdropFilter = 'blur(8px)';
        } else {
            header.style.top = '';
            header.style.backgroundColor = '';
            header.style.boxShadow = '';
            header.style.backdropFilter = '';
            header.style.webkitBackdropFilter = '';
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
