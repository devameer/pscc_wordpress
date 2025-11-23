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

<section class="pb-20">
    <div class="container mx-auto px-4 md:px-6">
        <div class="mb-12 space-y-3 text-center" data-aos="fade-up">
            <?php if (!empty($voices['title'])) : ?>
                <h2 class="text-3xl font-light text-slate-900 md:text-5xl"><?php echo wp_kses_post($voices['title']); ?></h2>
            <?php endif; ?>
            <?php if (!empty($voices['subtitle'])) : ?>
                <p class="text-base text-black md:text-lg font-light"><?php echo wp_kses_post($voices['subtitle']); ?></p>
            <?php endif; ?>
        </div>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            <?php
            $voice_anim_index = 0;
            foreach ($items as $index => $item) :
                $media = isset($item['media']) ? $item['media'] : beit_get_voice_media_data($item['id'] ?? 0, $item['image'] ?? null);
                $thumb_url = $media['thumbnail_url'];
                $lightbox_src = $media['src'];
                $lightbox_type = $media['type'];
                $caption = $media['caption'] ?? ($item['title'] ?? '');

                if (!$thumb_url) {
                    continue;
                }

                $classes = ' object-cover w-full h-full';
                $wrapper_classes = 'overflow-hidden';

                if (($item['span'] ?? '') === 'double' && 0 === $index) {
                    $wrapper_classes .= ' lg:col-span-2 lg:row-span-2';
                }
                $voice_delay = 100 + ($voice_anim_index * 100);
            ?>
                <div class="<?php echo esc_attr($wrapper_classes); ?>" data-aos="zoom-in" data-aos-delay="<?php echo esc_attr($voice_delay); ?>">
                    <a class="group relative block w-full" data-fslightbox="<?php echo esc_attr($lightbox_id); ?>"
                        data-type="<?php echo esc_attr($lightbox_type); ?>" data-caption="<?php echo esc_attr($caption); ?>"
                        href="<?php echo esc_url($lightbox_src); ?>"
                        aria-label="<?php esc_attr_e('Open media', 'beit'); ?>">
                        <?php if ('video' === $lightbox_type) : ?>
                        <span
                            class="absolute inset-0 z-10 flex items-center justify-center group">
                            <div class="bg-black/40 w-full h-0 transition-all duration-700 absolute top-0 group-hover:h-full"></div>
                            <span
                                class="inline-flex h-20 w-20 items-center justify-center bg-white/50 backdrop-blur-sm text-3xl
                                text-white group-hover:bg-primary transition-all duration-300 relative z-10">
                                <i
                                    class="fa fa-play"></i>
                            </span>
                        </span>
                        
                        <?php elseif ('image' === $lightbox_type) : ?>
                        <span
                            class="absolute inset-0 z-10 flex items-center justify-center group">
                                                        <div class="bg-black/40 w-full h-0 transition-all duration-700 absolute top-0 group-hover:h-full"></div>

                            <span
                                class="inline-flex h-12 w-12 items-center justify-center bg-white/50 backdrop-blur-sm text-xl
                                text-white group-hover:bg-primary transition-all duration-300 relative z-10 opacity-0 group-hover:opacity-100">
                                <i
                                    class="fa fa-search"></i>
                            </span>
                        </span>
                        <?php endif; ?>
                        <img class="<?php echo esc_attr($classes); ?>" src="<?php echo esc_url($thumb_url); ?>"
                            alt="<?php echo esc_attr($item['title'] ?? ''); ?>" loading="lazy" decoding="async">
                    </a>
                </div>
            <?php
                $voice_anim_index++;
            endforeach; ?>
        </div>

   
    </div>
</section>