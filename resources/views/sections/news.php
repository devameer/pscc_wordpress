<?php

/**
 * Latest news cards section.
 *
 * @package beit
 */

$args = wp_parse_args(
    $args ?? [],
    [
        'heading'       => [
            'title'    => '',
            'subtitle' => '',
            'cta'      => [],
        ],
        'items'         => [],
        'is_rtl'        => false,
        'empty_message' => '',
    ]
);

$heading = $args['heading'];
$items   = $args['items'];
$is_rtl  = (bool) $args['is_rtl'];
$empty_message = $args['empty_message'];

?>

<section class="bg-white py-12 md:py-16 lg:py-20">
    <div class="container mx-auto px-4 md:px-6">
        <div class="mb-8 md:mb-12 space-y-2 md:space-y-3 text-center" data-aos="fade-up">
            <?php if (!empty($heading['title'])) : ?>
                <h2 class="text-2xl md:text-3xl lg:text-5xl font-light text-slate-900"><?php echo wp_kses_post($heading['title']); ?></h2>
            <?php endif; ?>
            <?php if (!empty($heading['subtitle'])) : ?>
                <p class="text-sm md:text-base lg:text-lg font-light max-w-sm mx-auto"><?php echo wp_kses_post($heading['subtitle']); ?></p>
            <?php endif; ?>
        </div>

        <?php if (!empty($items)) : ?>
            <div class="grid gap-6 sm:grid-cols-2 md:gap-8 lg:grid-cols-3">
                <?php
                $news_index = 0;
                foreach ($items as $item) :
                    $news_delay = 100 + ($news_index * 150);
                    $item_title   = $item['title'] ?? '';
                    $item_excerpt = $item['excerpt'] ?? '';
                    $item_link    = $item['link'] ?? '#';
                    $item_image   = $item['image'] ?? '';
                ?>
                    <article class="overflow-hidden transition hover:-translate-y-1" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($news_delay); ?>">
                        <?php if ($item_image) : ?>
                            <div class="h-64 md:h-72 lg:h-80 w-full overflow-hidden">
                                <?php if (is_numeric($item_image)) : ?>
                                    <?php echo wp_get_attachment_image((int) $item_image, 'large', false, ['class' => 'h-full w-full object-cover']); ?>
                                <?php else : ?>
                                    <img class="h-full w-full object-cover" src="<?php echo esc_url((string) $item_image); ?>" alt="" loading="lazy" decoding="async">
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="py-3 md:py-4">
                            <?php if ($item_title) : ?>
                                <a href="<?php echo esc_url($item_link); ?>">
                                <h3 class="text-base md:text-lg text-slate-900">
                                    <?php echo esc_html($item_title); ?>
                                </h3>
                                </a>
                            <?php endif; ?>




                        </div>
                    </article>
                <?php
                    $news_index++;
                endforeach; ?>
            </div>
        <?php elseif ($empty_message) : ?>
            <div class="rounded-2xl border border-slate-200 bg-white p-12 text-center shadow-sm">
                <p class="text-base text-slate-600"><?php echo esc_html($empty_message); ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($heading['cta']['title']) && !empty($heading['cta']['url'])) : ?>
            <div class="mt-8 md:mt-10 text-center" data-aos="fade-up" data-aos-delay="500">
                <a class="inline-flex items-center gap-2 rounded-xs bg-primary px-4 py-2 md:px-6 text-xs md:text-sm font-semibold uppercase tracking-wide text-white transition hover:bg-red-700"
                    href="<?php echo esc_url($heading['cta']['url']); ?>">
                    <?php echo esc_html($heading['cta']['title']); ?>
                    <i class="fa-solid fa-arrow-<?php echo $is_rtl ? 'left' : 'right'; ?> text-xs"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>