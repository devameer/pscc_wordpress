<?php

/**
 * Voices & Visions gallery section.
 *
 * @package beit
 */

$voices = wp_parse_args(
    $args['voices'] ?? [],
    [
        'title'    => '',
        'subtitle' => '',
        'items'    => [],
    ]
);

$items = $voices['items'];

if (empty($items)) {
    return;
}

?>

<section class="bg-slate-100 py-20">
    <div class="container mx-auto px-4 md:px-6">
        <div class="mb-12 space-y-3 text-center">
            <?php if (!empty($voices['title'])) : ?>
                <h2 class="text-3xl font-bold text-slate-900 md:text-4xl"><?php echo esc_html($voices['title']); ?></h2>
            <?php endif; ?>
            <?php if (!empty($voices['subtitle'])) : ?>
                <p class="text-base text-slate-600 md:text-lg"><?php echo esc_html($voices['subtitle']); ?></p>
            <?php endif; ?>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($items as $index => $item) :
                $image = $item['image'] ?? '';
                if (!$image) {
                    continue;
                }

                $classes = 'rounded-2xl object-cover w-full h-full';
                $wrapper_classes = 'overflow-hidden';

                if (($item['span'] ?? '') === 'double' && 0 === $index) {
                    $wrapper_classes .= ' lg:col-span-2 lg:row-span-2';
                }
                ?>
                <div class="<?php echo esc_attr($wrapper_classes); ?>">
                    <a href="<?php echo esc_url($item['link'] ?? '#'); ?>" class="block">
                        <?php if (is_numeric($image)) : ?>
                            <?php echo wp_get_attachment_image((int) $image, 'large', false, ['class' => $classes]); ?>
                        <?php else : ?>
                            <img class="<?php echo esc_attr($classes); ?>" src="<?php echo esc_url((string) $image); ?>" alt="">
                        <?php endif; ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <?php $archive_link = get_post_type_archive_link('beit_voice'); ?>
        <?php if ($archive_link) : ?>
            <div class="mt-10 text-center">
                <a class="inline-flex items-center gap-2 text-sm font-semibold text-red-600 transition hover:text-red-700" href="<?php echo esc_url($archive_link); ?>">
                    <?php esc_html_e('View All Voices', 'beit'); ?>
                    <i class="fa-solid fa-arrow-<?php echo is_rtl() ? 'left' : 'right'; ?> text-xs"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>
