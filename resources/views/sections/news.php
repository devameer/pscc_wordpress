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

<section class="bg-white py-20">
    <div class="container mx-auto px-4 md:px-6">
        <div class="mb-12 space-y-3 text-center">
            <?php if (!empty($heading['title'])) : ?>
                <h2 class="text-3xl font-bold text-slate-900 md:text-4xl"><?php echo esc_html($heading['title']); ?></h2>
            <?php endif; ?>
            <?php if (!empty($heading['subtitle'])) : ?>
                <p class="text-base text-slate-600 md:text-lg"><?php echo esc_html($heading['subtitle']); ?></p>
            <?php endif; ?>
        </div>

        <?php if (!empty($items)) : ?>
            <div class="grid gap-8 md:grid-cols-3">
                <?php foreach ($items as $item) :
                $item_title   = $item['title'] ?? '';
                $item_excerpt = $item['excerpt'] ?? '';
                $item_link    = $item['link'] ?? '#';
                $item_image   = $item['image'] ?? '';
                ?>
                <article class="overflow-hidden rounded-2xl bg-white shadow-lg transition hover:-translate-y-1 hover:shadow-xl">
                    <?php if ($item_image) : ?>
                        <div class="h-48 w-full overflow-hidden">
                            <?php if (is_numeric($item_image)) : ?>
                                <?php echo wp_get_attachment_image((int) $item_image, 'large', false, ['class' => 'h-full w-full object-cover']); ?>
                            <?php else : ?>
                                <img class="h-full w-full object-cover" src="<?php echo esc_url((string) $item_image); ?>" alt="">
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="p-6">
                        <?php if ($item_title) : ?>
                            <h3 class="text-lg font-semibold text-slate-900">
                                <?php echo esc_html($item_title); ?>
                            </h3>
                        <?php endif; ?>

                        <?php if ($item_excerpt) : ?>
                            <p class="mt-3 text-sm text-slate-600">
                                <?php echo esc_html(wp_trim_words($item_excerpt, 24, '…')); ?>
                            </p>
                        <?php endif; ?>

                        <a class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-red-600 hover:text-red-700" href="<?php echo esc_url($item_link); ?>">
                            <?php esc_html_e('Read More', 'beit'); ?>
                            <i class="fa-solid fa-arrow-<?php echo $is_rtl ? 'left' : 'right'; ?> text-xs"></i>
                        </a>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        <?php elseif ($empty_message) : ?>
            <div class="rounded-2xl border border-slate-200 bg-white p-12 text-center shadow-sm">
                <p class="text-base text-slate-600"><?php echo esc_html($empty_message); ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($heading['cta']['title']) && !empty($heading['cta']['url'])) : ?>
            <div class="mt-10 text-center">
                <a class="inline-flex items-center gap-2 text-sm font-semibold text-red-600 hover:text-red-700" href="<?php echo esc_url($heading['cta']['url']); ?>">
                    <?php echo esc_html($heading['cta']['title']); ?>
                    <i class="fa-solid fa-arrow-<?php echo $is_rtl ? 'left' : 'right'; ?> text-xs"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>
