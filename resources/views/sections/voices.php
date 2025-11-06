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

$lightbox_id = $args['lightbox_id'] ?? 'voices-lightbox';

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
                $media = isset($item['media']) ? $item['media'] : beit_get_voice_media_data($item['id'] ?? 0, $item['image'] ?? null);
                $thumb_url = $media['thumbnail_url'];
                $lightbox_src = $media['src'];
                $lightbox_type = $media['type'];
                $caption = $media['caption'] ?? ($item['title'] ?? '');

                if (!$thumb_url) {
                    continue;
                }

                $classes = 'rounded-2xl object-cover w-full h-full';
                $wrapper_classes = 'overflow-hidden';

                if (($item['span'] ?? '') === 'double' && 0 === $index) {
                    $wrapper_classes .= ' lg:col-span-2 lg:row-span-2';
                }
                ?>
                <div class="<?php echo esc_attr($wrapper_classes); ?>">
                    <a
                        class="group relative block w-full"
                        data-fslightbox="<?php echo esc_attr($lightbox_id); ?>"
                        data-type="<?php echo esc_attr($lightbox_type); ?>"
                        data-caption="<?php echo esc_attr($caption); ?>"
                        href="<?php echo esc_url($lightbox_src); ?>"
                        aria-label="<?php esc_attr_e('Open media', 'beit'); ?>"
                    >
                        <span class="absolute inset-0 z-10 flex items-center justify-center bg-black/40 opacity-0 transition group-hover:opacity-100">
                            <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-white/90 text-slate-900">
                                <i class="fa-solid <?php echo esc_attr('video' === $lightbox_type ? 'fa-play' : 'fa-magnifying-glass'); ?>"></i>
                            </span>
                        </span>
                        <img class="<?php echo esc_attr($classes); ?>" src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($item['title'] ?? ''); ?>">
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
