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
        'hero_prev_icon'        => 'fa fa-arrow-left',
        'hero_next_icon'        => 'fa fa-arrow-right',
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
        data-has-pagination="<?php echo !empty($settings['show_pagination']) ? 'true' : 'false'; ?>">
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
                        <?php endif; ?>>
                        <div class="absolute inset-0">
                            <!-- <span class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-transparent"></span> -->
                            <span class="absolute inset-0 bg-black/35 mix-blend-multiply"></span>
                        </div>

                        <div class="relative z-10 container mx-auto px-4 py-20 md:px-6">
                            <div class="max-w-2xl space-y-6 text-white <?php echo esc_attr($content_alignment); ?>">


                                <?php if (!empty($slide['title'])) : ?>
                                    <h1 class="space-y-2 text-3xl font-bold leading-tight md:text-5xl hero-title-animate">
                                        <?php if (!empty($slide['title'])) : ?>
                                            <span class="block font-light text-white slider-title"><?php echo wp_kses_post($slide['title']); ?></span>
                                        <?php endif; ?>

                                    </h1>
                                <?php endif; ?>

                                <?php if (!empty($slide['description'])) : ?>
                                    <p class="max-w-xl text-base text-white md:text-lg font-normal hero-description-animate">
                                        <?php echo esc_html($slide['description']); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if (!empty($primary_button['title']) || !empty($secondary_button['title'])) : ?>
                                    <div class="flex flex-wrap items-center gap-4 hero-buttons-animate">
                                        <?php if (!empty($primary_button['title'])) : ?>
                                            <a
                                                class="font-normal inline-flex items-center rounded-xs bg-primary px-8 py-2  text-lg uppercase tracking-wide text-white transition hover:bg-red-700 hover:scale-105 hover:shadow-lg"
                                                href="<?php echo esc_url($primary_button['url'] ?? '#'); ?>"
                                                target="<?php echo esc_attr($primary_button['target'] ?? '_self'); ?>"
                                                rel="noopener">
                                                <?php echo esc_html($primary_button['title']); ?>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (!empty($secondary_button['title'])) : ?>
                                            <span class="hero-or-animate">OR</span>
                                            <a
                                                class="font-light inline-flex items-center gap-2 underline text-xl  capitalize tracking-wide text-white transition hover:border-white hover:text-white hover:translate-x-2"
                                                href="<?php echo esc_url($secondary_button['url'] ?? '#'); ?>"
                                                target="<?php echo esc_attr($secondary_button['target'] ?? '_self'); ?>"
                                                rel="noopener">
                                                <?php echo esc_html($secondary_button['title']); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if (!empty($slide['video_url']) && '#' !== $slide['video_url']) : ?>
                            <a
                                class="absolute <?php echo esc_attr($video_button_position); ?> hidden items-center gap-3   px-5 py-3 text-sm font-semibold text-white  transition  md:flex hero-video-button group"
                                href="<?php echo esc_url($slide['video_url']); ?>">
                                <span class="flex h-14 w-14 items-center justify-center rounded-xs text-2xl  bg-white/40 group-hover:bg-primary group-hover:scale-110 transition-all duration-300">
                                    <i class="fa fa-play group-hover:scale-125 transition-transform duration-300"></i>
                                </span>
                                <span class="leading-tight text-white text-2xl font-light border-l border-white/55 pl-4 group-hover:border-primary transition-colors duration-300">
                                    <span class="block  capitalize tracking-wide  "><?php esc_html_e('See the change', 'beit'); ?></span>
                                    <span class="block  capitalize"><span class="font-bold uppercase">Watch</span> the story</span>
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