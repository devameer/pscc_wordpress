<?php

/**
 * Partners carousel section.
 *
 * @package beit
 */

$args = wp_parse_args(
    $args ?? [],
    [
        'partners'       => [
            'title'    => '',
            'subtitle' => '',
            'items'    => [],
        ],
        'hero_prev_icon' => 'fa-solid fa-arrow-left',
        'hero_next_icon' => 'fa-solid fa-arrow-right',
    ]
);

$partners       = $args['partners'];
$hero_prev_icon = $args['hero_prev_icon'];
$hero_next_icon = $args['hero_next_icon'];

$items = $partners['items'] ?? [];

if (empty($items)) {
    return;
}

?>

<section class="bg-[#F9F9F9] py-20">
    <div class="container mx-auto px-4 md:px-6">
        <div class="mb-12 space-y-3 text-center" data-aos="fade-up">
            <?php if (!empty($partners['title'])) : ?>
                <h2 class="text-3xl font-bold text-slate-900 md:text-4xl"><?php echo esc_html($partners['title']); ?></h2>
            <?php endif; ?>
            <?php if (!empty($partners['subtitle'])) : ?>
                <p class="text-base text-slate-600 md:text-lg"><?php echo esc_html($partners['subtitle']); ?></p>
            <?php endif; ?>
        </div>

        <div class="relative" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper partners-slider" data-slider="partners">
                <div class="swiper-wrapper items-center">
                    <?php foreach ($items as $partner) :
                        $logo = $partner['logo'] ?? '';
                        if (!$logo) {
                            continue;
                        }
                    ?>
                        <div class="swiper-slide">
                            <div class="flex h-56 items-center justify-center border border-gray-200 bg-white p-4 transition hover:bg-slate-200">
                                <?php if (is_numeric($logo)) : ?>
                                    <?php echo wp_get_attachment_image((int) $logo, 'medium', false, ['class' => 'max-h-16 object-contain']); ?>
                                <?php else : ?>
                                    <img class="object-contain" src="<?php echo esc_url((string) $logo); ?>" alt="<?php echo esc_attr($partner['name'] ?? ''); ?>" loading="lazy" decoding="async">
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="pointer-events-none absolute inset-y-0 left-0 right-0 flex items-center justify-between px-2">
                <button class="pointer-events-auto inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-300 bg-white text-slate-700 shadow hover:bg-slate-100 partners-button-prev" type="button" aria-label="<?php esc_attr_e('Previous partners', 'beit'); ?>">
                    <i class="<?php echo esc_attr($hero_prev_icon); ?>"></i>
                </button>
                <button class="pointer-events-auto inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-300 bg-white text-slate-700 shadow hover:bg-slate-100 partners-button-next" type="button" aria-label="<?php esc_attr_e('Next partners', 'beit'); ?>">
                    <i class="<?php echo esc_attr($hero_next_icon); ?>"></i>
                </button>
            </div>
        </div>
    </div>
</section>