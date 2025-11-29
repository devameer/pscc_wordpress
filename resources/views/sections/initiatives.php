<?php

/**
 * Initiatives carousel section.
 *
 * @package beit
 */

$args = wp_parse_args(
    $args ?? [],
    [
        'data'              => [],
        'heading_alignment' => 'text-center',
        'hero_prev_icon'    => 'fa fa-arrow-left',
        'hero_next_icon'    => 'fa fa-arrow-right',
    ]
);

$data              = $args['data'];
$heading_alignment = $args['heading_alignment'];
$hero_prev_icon    = $args['hero_prev_icon'];
$hero_next_icon    = $args['hero_next_icon'];

$items = $data['items'] ?? [];

if (empty($items)) {
    return;
}

?>

<section class="bg-[#282828] py-12 md:py-16 lg:py-20 text-white">
    <div class="container mx-auto px-4 md:px-6">
        <div class="mb-8 md:mb-12 space-y-3 md:space-y-4 <?php echo esc_attr($heading_alignment); ?>" data-aos="fade-up">
            <?php if (!empty($data['title'])) : ?>
                <h2 class="text-3xl font-light md:text-5xl"><?php echo wp_kses_post($data['title']); ?></h2>
            <?php endif; ?>
            <?php if (!empty($data['subtitle'])) : ?>
                <p class="text-md font-light text-white md:text-lg max-w-xs md:mx-auto lg:max-w-md">

                    <?php echo esc_html($data['subtitle']); ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="relative" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper initiatives-slider" data-slider="initiatives">
                <div class="swiper-wrapper">
                    <?php foreach ($items as $item) : ?>
                        <div class="swiper-slide">
                            <article class="group relative h-full overflow-hidden rounded-xs bg-slate-800/60">
                                <?php if (!empty($item['image'])) : ?>
                                    <?php if (is_numeric($item['image'])) : ?>
                                        <?php echo wp_get_attachment_image((int) $item['image'], 'large', false, ['class' => 'h-64 w-full object-cover transition-transform duration-300 group-hover:scale-105', 'loading' => 'lazy', 'decoding' => 'async']); ?>
                                    <?php else : ?>
                                        <img class="h-64 w-full object-cover transition-transform duration-300 group-hover:scale-105"
                                            src="<?php echo esc_url((string) $item['image']); ?>" alt="" loading="lazy" decoding="async">
                                    <?php endif; ?>
                                <?php else : ?>
                                    <div class="h-64 w-full bg-gradient-to-br from-red-500/40 to-red-700/40"></div>
                                <?php endif; ?>

                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                                </div>

                                <div class="absolute inset-0 flex flex-col  p-6 pt-24   ">
                                    <?php
                                    $icon_output = '';
                                    if (!empty($item['icon'])) {
                                        $icon_value = $item['icon'];

                                        if (is_string($icon_value) && strpos($icon_value, '<svg') !== false) {
                                            $icon_output = wp_kses_post($icon_value);
                                        } else {
                                            $icon_url = '';
                                            if (is_numeric($icon_value)) {
                                                $icon_url = wp_get_attachment_url((int) $icon_value) ?: '';
                                            } elseif (is_string($icon_value)) {
                                                $icon_url = $icon_value;
                                            }

                                            if ($icon_url) {
                                                $icon_output = sprintf(
                                                    '<img src="%s" class="h-12 w-12 object-contain" alt="" aria-hidden="true" loading="lazy" decoding="async" />',
                                                    esc_url($icon_url)
                                                );
                                            }
                                        }
                                    }

                                    if ($icon_output) {
                                        echo '<span class="mb-3 inline-flex" style="filter:invert(100%) sepia(0%) saturate(7469%) hue-rotate(13deg) brightness(112%) contrast(112%)">' . $icon_output . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    }
                                    ?>

                                    <?php if (!empty($item['title'])) : ?>
                                        <h3 class="text-xl font-light leading-tight">
                                            <?php echo wp_kses_post($item['title']); ?>
                                        </h3>
                                    <?php endif; ?>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="pointer-events-none absolute inset-y-0 left-0 right-0 flex items-center justify-between px-2">
                <button
                    class="initiatives-button-prev pointer-events-auto inline-flex h-12 w-12 items-center justify-center rounded-full border border-white/25 bg-white/10 text-white transition hover:bg-white/20"
                    type="button" aria-label="<?php esc_attr_e('Previous initiatives', 'beit'); ?>">
                    <i class="<?php echo esc_attr($hero_prev_icon); ?>"></i>
                </button>
                <button
                    class="initiatives-button-next pointer-events-auto inline-flex h-12 w-12 items-center justify-center rounded-full border border-white/25 bg-white/10 text-white transition hover:bg-white/20"
                    type="button" aria-label="<?php esc_attr_e('Next initiatives', 'beit'); ?>">
                    <i class="<?php echo esc_attr($hero_next_icon); ?>"></i>
                </button>
            </div>
        </div>

        <?php if (!empty($data['cta']['title'])) : ?>
            <div class="mt-10 text-center">
                <a class="btn-more"
                    href="<?php echo esc_url($data['cta']['url']); ?>"
                    target="<?php echo esc_attr($data['cta']['target'] ?? '_self'); ?>" rel="noopener">
                    <?php echo esc_html($data['cta']['title']); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>