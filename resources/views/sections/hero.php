<?php

/**
 * Hero slider section.
 *
 * @package beit
 */

$args = wp_parse_args(
    $args ?? [],
    [
        'slides'                => [],
        'settings'              => [],
        'content_alignment'     => '',
        'video_button_position' => '',
        'hero_prev_icon'        => 'fa-solid fa-arrow-left',
        'hero_next_icon'        => 'fa-solid fa-arrow-right',
    ]
);

$slides                = $args['slides'];
$settings              = $args['settings'];
$content_alignment     = $args['content_alignment'];
$video_button_position = $args['video_button_position'];
$hero_prev_icon        = $args['hero_prev_icon'];
$hero_next_icon        = $args['hero_next_icon'];

if (empty($slides)) {
    return;
}

?>

<section class="relative overflow-hidden bg-slate-950 text-white">
    <div
        class="swiper hero-slider"
        data-autoplay="<?php echo esc_attr($settings['autoplay'] ?? 0); ?>"
        data-loop="<?php echo !empty($settings['loop']) ? 'true' : 'false'; ?>"
        data-has-navigation="<?php echo !empty($settings['show_navigation']) ? 'true' : 'false'; ?>"
        data-has-pagination="<?php echo !empty($settings['show_pagination']) ? 'true' : 'false'; ?>"
    >
        <div class="swiper-wrapper">
            <?php foreach ($slides as $slide) :
                $background_image = $slide['background_image'] ?? '';
                $background_style = $background_image
                    ? sprintf(
                        "background-image: url('%s'); background-size: cover; background-position: center; background-repeat: no-repeat;",
                        esc_url($background_image)
                    )
                    : '';
                $primary_button   = is_array($slide['primary_button'] ?? null) ? $slide['primary_button'] : [];
                $secondary_button = is_array($slide['secondary_button'] ?? null) ? $slide['secondary_button'] : [];
                ?>
                <div class="swiper-slide">
                    <div
                        class="relative flex min-h-[80vh] items-center justify-center overflow-hidden"
                        <?php if ($background_style) : ?>
                            style="<?php echo esc_attr($background_style); ?>"
                        <?php endif; ?>
                    >
                        <div class="absolute inset-0">
                            <span class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-transparent"></span>
                            <span class="absolute inset-0 bg-black/35 mix-blend-multiply"></span>
                        </div>

                        <div class="relative z-10 container mx-auto px-4 py-20 md:px-6">
                            <div class="max-w-2xl space-y-6 text-white <?php echo esc_attr($content_alignment); ?>">
                                <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                                    <?php esc_html_e('Because Every Child Matters', 'beit'); ?>
                                </div>

                                <?php if (!empty($slide['title_prefix']) || !empty($slide['title_highlight']) || !empty($slide['title_suffix'])) : ?>
                                    <h1 class="space-y-2 text-3xl font-bold leading-tight md:text-5xl">
                                        <?php if (!empty($slide['title_prefix'])) : ?>
                                            <span class="block font-light text-white/80"><?php echo esc_html($slide['title_prefix']); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($slide['title_highlight'])) : ?>
                                            <span class="block text-4xl font-black text-red-500 md:text-6xl">
                                                <?php echo esc_html($slide['title_highlight']); ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php if (!empty($slide['title_suffix'])) : ?>
                                            <span class="block font-semibold text-white/90"><?php echo esc_html($slide['title_suffix']); ?></span>
                                        <?php endif; ?>
                                    </h1>
                                <?php endif; ?>

                                <?php if (!empty($slide['description'])) : ?>
                                    <p class="max-w-xl text-base text-white/80 md:text-lg">
                                        <?php echo esc_html($slide['description']); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if (!empty($primary_button['title']) || !empty($secondary_button['title'])) : ?>
                                    <div class="flex flex-wrap items-center gap-4">
                                        <?php if (!empty($primary_button['title'])) : ?>
                                            <a
                                                class="inline-flex items-center rounded-full bg-red-600 px-8 py-3 text-sm font-semibold uppercase tracking-wide text-white transition hover:bg-red-700"
                                                href="<?php echo esc_url($primary_button['url'] ?? '#'); ?>"
                                                target="<?php echo esc_attr($primary_button['target'] ?? '_self'); ?>"
                                                rel="noopener"
                                            >
                                                <?php echo esc_html($primary_button['title']); ?>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (!empty($secondary_button['title'])) : ?>
                                            <a
                                                class="inline-flex items-center gap-2 rounded-full border border-white/40 px-8 py-3 text-sm font-semibold uppercase tracking-wide text-white transition hover:border-white hover:text-white"
                                                href="<?php echo esc_url($secondary_button['url'] ?? '#'); ?>"
                                                target="<?php echo esc_attr($secondary_button['target'] ?? '_self'); ?>"
                                                rel="noopener"
                                            >
                                                <i class="fa-solid fa-play text-xs"></i>
                                                <?php echo esc_html($secondary_button['title']); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if (!empty($slide['video_url']) && '#' !== $slide['video_url']) : ?>
                            <a
                                class="absolute <?php echo esc_attr($video_button_position); ?> hidden items-center gap-3 rounded-full bg-white/15 px-5 py-3 text-sm font-semibold text-white backdrop-blur transition hover:bg-white/25 md:flex"
                                href="<?php echo esc_url($slide['video_url']); ?>"
                            >
                                <span class="flex h-10 w-10 items-center justify-center rounded-full border border-white/40">
                                    <i class="fa-solid fa-play"></i>
                                </span>
                                <span class="leading-tight">
                                    <span class="block text-xs uppercase tracking-wide text-white/60"><?php esc_html_e('See the change', 'beit'); ?></span>
                                    <span class="block text-sm font-semibold"><?php esc_html_e('Watch the story', 'beit'); ?></span>
                                </span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (!empty($settings['show_navigation'])) : ?>
            <button class="hero-slider-nav hero-slider-prev swiper-button-prev" type="button" aria-label="<?php esc_attr_e('Previous slide', 'beit'); ?>">
                <i class="<?php echo esc_attr($hero_prev_icon); ?>"></i>
            </button>
            <button class="hero-slider-nav hero-slider-next swiper-button-next" type="button" aria-label="<?php esc_attr_e('Next slide', 'beit'); ?>">
                <i class="<?php echo esc_attr($hero_next_icon); ?>"></i>
            </button>
        <?php endif; ?>

        <?php if (!empty($settings['show_pagination'])) : ?>
            <div class="hero-slider-pagination swiper-pagination"></div>
        <?php endif; ?>
    </div>
</section>
