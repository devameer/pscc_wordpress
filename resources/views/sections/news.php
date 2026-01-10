<?php

/**
 * Latest news cards section.
 *
 * @package beit
 */

$args = wp_parse_args(
    $args ?? [],
    [
        'heading' => [
            'title' => '',
            'subtitle' => '',
            'cta' => [],
        ],
        'items' => [],
        'is_rtl' => false,
        'empty_message' => '',
    ]
);

$heading = $args['heading'];
$items = $args['items'];
$is_rtl = (bool) $args['is_rtl'];
$empty_message = $args['empty_message'];

?>

<section class="bg-white py-12 md:py-16 lg:py-20">
    <div class="container mx-auto px-4 md:px-6">
        <div class="mb-8 md:mb-12 space-y-2 md:space-y-3 text-center" data-aos="fade-up">
            <?php if (!empty($heading['title'])): ?>
                <h2 class="text-2xl md:text-3xl lg:text-5xl font-light text-slate-900">
                    asdasd<?php echo wp_kses_post($heading['title']); ?></h2>
            <?php endif; ?>
            <?php if (!empty($heading['subtitle'])): ?>
                <p class="text-sm md:text-base lg:text-lg font-light max-w-sm mx-auto">
                    <?php echo wp_kses_post($heading['subtitle']); ?></p>
            <?php endif; ?>
        </div>

        <?php if (!empty($items)): ?>
            <div class="grid gap-6 sm:grid-cols-2 md:gap-8 lg:grid-cols-3">
                <?php
                $news_index = 0;
                foreach ($items as $item):
                    $news_delay = 100 + ($news_index * 150);
                    $item_title = $item['title'] ?? '';
                    $item_excerpt = $item['excerpt'] ?? '';
                    $item_link = $item['link'] ?? '#';
                    $item_image = $item['image'] ?? '';
                    ?>
                    <article class="overflow-hidden transition hover:-translate-y-1" data-aos="fade-up"
                        data-aos-delay="<?php echo esc_attr($news_delay); ?>">
                        <?php if ($item_image): ?>
                            <a href="<?php echo esc_url($item_link); ?>"
                                class="h-64 md:h-72 lg:h-80 w-full overflow-hidden relative block">
                                <?php if (is_numeric($item_image)): ?>
                                    <?php echo wp_get_attachment_image((int) $item_image, 'large', false, ['class' => 'h-full w-full object-cover']); ?>
                                <?php else: ?>
                                    <img class="h-full w-full object-cover" src="<?php echo esc_url((string) $item_image); ?>" alt=""
                                        loading="lazy" decoding="async">
                                <?php endif; ?>
                                <span class="absolute inset-0 z-10 flex items-center justify-center group">
                                    <div
                                        class="bg-black/30 w-full h-0 transition-all duration-700 absolute top-0 group-hover:h-full">
                                    </div>
                                    <span
                                        class="inline-flex h-20 w-20 items-center justify-center  text-3xl
                                text-white  transition-all duration-700 relative z-10  top-60 group-hover:top-0 opacity-0 group-hover:opacity-100">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </span>
                            </a>
                        <?php endif; ?>

                        <div class="py-3 md:py-4">
                            <?php if ($item_title): ?>
                                <a href="<?php echo esc_url($item_link); ?>">
                                    <h3 class="text-base md:text-xl text-slate-900 font-light">
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
        <?php elseif ($empty_message): ?>
            <div class=" border border-slate-200 bg-white p-12 text-center shadow-sm">
                <p class="text-base text-slate-600"><?php echo esc_html($empty_message); ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($heading['cta']['title']) && !empty($heading['cta']['url'])): ?>
            <div class="mt-8 md:mt-10 text-center" data-aos="fade-up" data-aos-delay="500">
                <a class="btn-more" href="<?php echo esc_url($heading['cta']['url']); ?>">
                    <?php echo esc_html($heading['cta']['title']); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>
</section>