<?php

/**
 * Hero slider section.
 *
 * @package beit
 */

$args = wp_parse_args(
    $args ?? [],
    [
        'slides' => [],
        'settings' => [],
        'content_alignment' => '',
        'video_button_position' => '',
        'hero_prev_icon' => 'fa fa-facebook',
        'hero_next_icon' => 'fa fa-arrow-right',
    ]
);

$slides = $args['slides'];
$settings = $args['settings'];
$content_alignment = $args['content_alignment'];
$video_button_position = $args['video_button_position'];
$hero_prev_icon = $args['hero_prev_icon'];
$hero_next_icon = $args['hero_next_icon'];

if (empty($slides)) {
    return;
}

?>

<section class="relative overflow-hidden bg-slate-950 text-white">
    <div class="swiper hero-slider" data-autoplay="<?php echo esc_attr($settings['autoplay'] ?? 0); ?>"
        data-loop="<?php echo !empty($settings['loop']) ? 'true' : 'false'; ?>"
        data-has-navigation="<?php echo !empty($settings['show_navigation']) ? 'true' : 'false'; ?>"
        data-has-pagination="<?php echo !empty($settings['show_pagination']) ? 'true' : 'false'; ?>">
        <div class="swiper-wrapper">
            <?php foreach ($slides as $slide):
                $background_image = $slide['background_image'] ?? '';
                $background_style = $background_image
                    ? sprintf(
                        "background-image: url('%s'); background-size: cover; background-position: center; background-repeat: no-repeat;",
                        esc_url($background_image)
                    )
                    : '';
                $primary_button = is_array($slide['primary_button'] ?? null) ? $slide['primary_button'] : [];
            ?>
                <div class="swiper-slide">
                    <div class="relative flex min-h-[95vh] items-center justify-center overflow-hidden" <?php if ($background_style): ?> style="<?php echo esc_attr($background_style); ?>" <?php endif; ?>>
                        <div class="absolute inset-0">
                            <!-- Gradient overlay - direction changes based on RTL/LTR -->
                            <span
                                class="absolute inset-0 bg-gradient-to-r ltr:bg-gradient-to-r rtl:bg-gradient-to-l from-black/80 via-black/60 to-transparent"></span>
                            <span class="absolute inset-0 bg-black/20 mix-blend-multiply"></span>
                        </div>

                        <div class="relative z-10 container mx-auto px-4 pt-24 md:px-6">
                            <div
                                class="max-w-2xl space-y-6 text-white ltr:text-left rtl:text-right <?php echo esc_attr($content_alignment); ?>">

                                <!-- ho -->
                                <?php if (!empty($slide['title'])): ?>
                                    <h1 class="space-y-2 text-3xl font-bold leading-tight md:text-5xl hero-title-animate">
                                        <?php if (!empty($slide['title'])): ?>
                                            <span
                                                class="block font-normal text-white slider-title wp-base"><?php echo wp_kses_post($slide['title']); ?></span>
                                        <?php endif; ?>

                                    </h1>
                                <?php endif; ?>

                                <?php if (!empty($slide['description'])): ?>
                                    <p class="max-w-xl text-base text-white md:text-lg font-normal hero-description-animate">
                                        <?php echo esc_html($slide['description']); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if (!empty($primary_button['title']) || !empty($secondary_button['title'])): ?>
                                    <div class="flex flex-wrap items-center gap-4 hero-buttons-animate justify-start ">
                                        <?php if (!empty($primary_button['title'])): ?>
                                            <a class="font-normal inline-flex items-center  bg-primary px-8 py-2  text-lg uppercase tracking-wide text-white transition hover:bg-primary hover:scale-105 hover:shadow-lg rounded-full"
                                                href="<?php echo esc_url($primary_button['url'] ?? '#'); ?>"
                                                target="<?php echo esc_attr($primary_button['target'] ?? '_self'); ?>"
                                                rel="noopener">
                                                <?php echo esc_html($primary_button['title']); ?>
                                            </a>
                                        <?php endif; ?>


                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>


                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (!empty($settings['show_navigation'])): ?>
            <button class="hero-slider-nav hero-slider-prev swiper-button-prev" type="button"
                aria-label="<?php esc_attr_e('Previous slide', 'beit'); ?>">
                <i class="<?php echo esc_attr($hero_prev_icon); ?>"></i>
            </button>
            <button class="hero-slider-nav hero-slider-next swiper-button-next" type="button"
                aria-label="<?php esc_attr_e('Next slide', 'beit'); ?>">
                <i class="<?php echo esc_attr($hero_next_icon); ?>"></i>
            </button>
        <?php endif; ?>

        <?php if (!empty($settings['show_pagination'])): ?>
            <div class="hero-slider-pagination swiper-pagination"></div>
        <?php endif; ?>
    </div>
</section>