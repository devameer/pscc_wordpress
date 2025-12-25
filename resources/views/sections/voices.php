<?php
/**
 * Voices & Visions gallery section.
 *
 * @package beit
 */

$has_acf = function_exists('get_field');

$voices = wp_parse_args(
    $args['voices'] ?? [],
    [
        'title' => '',
        'subtitle' => '',
        'items' => [],
    ]
);
$lightbox_id = $args['lightbox_id'] ?? 'voices-lightbox';

// Fetch items from Media Library post type instead of ACF
$items = [];
$media_query = new WP_Query([
    'post_type' => 'beit_media',
    'posts_per_page' => 6,
    'post_status' => 'publish',
    'meta_query' => [
        [
            'key' => 'show_on_homepage',
            'value' => '1',
            'compare' => '=',
        ],
    ],
    'meta_key' => 'homepage_order',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
]);

if ($media_query->have_posts()) {
    $index = 0;
    while ($media_query->have_posts()) {
        $media_query->the_post();
        $media_id = get_the_ID();
        $media_type = $has_acf ? (get_field('media_type', $media_id) ?: 'image') : 'image';

        $item = [
            'span' => $index === 0 ? 'double' : 'single',
            'title' => get_the_title(),
            'post_id' => $media_id,
        ];

        if ($media_type === 'image') {
            $thumb_id = get_post_thumbnail_id($media_id);
            // Use get_post_meta instead of get_field for gallery images
            $gallery_images = get_post_meta($media_id, 'media_gallery', true);
            if (!is_array($gallery_images)) {
                $gallery_images = [];
            }

            // Combine featured image with gallery images
            $all_images = [];
            if ($thumb_id) {
                $all_images[] = $thumb_id;
            }
            if ($gallery_images && is_array($gallery_images)) {
                $all_images = array_merge($all_images, $gallery_images);
            }
            $all_images = array_unique($all_images);

            $item['image'] = $thumb_id;
            $item['all_images'] = $all_images;
            $item['media'] = [
                'type' => 'image',
                'src' => wp_get_attachment_image_url($thumb_id, 'full'),
                'thumbnail_url' => wp_get_attachment_image_url($thumb_id, 'large'),
                'caption' => get_the_title(),
            ];
        } else {
            // Get both video sources - same logic as page-videos-gallery.php
            $video_file = $has_acf ? get_field('media_video_file', $media_id) : '';
            $video_url = $has_acf ? get_field('media_video_url', $media_id) : '';
            $thumbnail_id = $has_acf ? get_field('media_video_thumbnail', $media_id) : 0;
            if (!$thumbnail_id) {
                $thumbnail_id = get_post_thumbnail_id($media_id);
            }
            $thumbnail_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'large') : '';

            // Determine video source - prioritize file if available, otherwise use URL
            $video_src = '';
            $is_external_video = false;
            if (!empty($video_file)) {
                $video_src = $video_file;
                $is_external_video = false;
            } elseif (!empty($video_url)) {
                // Convert YouTube/Vimeo URLs to embed format
                $video_src = beit_get_video_embed_url($video_url);
                $is_external_video = true;
            }

            // Set the lightbox type based on video source
            $lightbox_type = $is_external_video ? '' : 'video';

            $item['media'] = [
                'type' => $lightbox_type,
                'src' => $video_src,
                'thumbnail_url' => $thumbnail_url,
                'caption' => get_the_title(),
                'is_external' => $is_external_video,
            ];
        }

        $items[] = $item;
        $index++;
    }
    wp_reset_postdata();
}

if (empty($items)) {
    return;
}

?>

<section class="pb-20">
    <div class="container mx-auto px-4 md:px-6">
        <div class="mb-12 space-y-3 text-center" data-aos="fade-up">
            <?php if (!empty($voices['title'])): ?>
                <h2 class="text-3xl font-light text-slate-900 md:text-5xl"><?php echo wp_kses_post($voices['title']); ?>
                </h2>
            <?php endif; ?>
            <?php if (!empty($voices['subtitle'])): ?>
                <p class="text-base text-black md:text-lg font-light"><?php echo wp_kses_post($voices['subtitle']); ?></p>
            <?php endif; ?>
        </div>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            <?php
            $voice_anim_index = 0;
            foreach ($items as $index => $item):
                $media = $item['media'];
                $thumb_url = $media['thumbnail_url'];
                $lightbox_src = $media['src'];
                $lightbox_type = $media['type'];
                $caption = $media['caption'] ?? ($item['title'] ?? '');
                $is_external_video = $media['is_external'] ?? false;
                $is_video = $lightbox_type === 'video' || $is_external_video;

                // Get all images for this item (for gallery support)
                $all_images = $item['all_images'] ?? [];
                $post_id = $item['post_id'] ?? 0;
                $gallery_id = $post_id ? 'homepage-gallery-' . $post_id : $lightbox_id;

                if (!$thumb_url) {
                    continue;
                }

                $classes = ' object-cover w-full h-full';
                $wrapper_classes = 'overflow-hidden';

                if (($item['span'] ?? '') === 'double' && 0 === $index) {
                    $wrapper_classes .= ' lg:col-span-2 lg:row-span-2';
                }
                $voice_delay = 100 + ($voice_anim_index * 100);

                // Use appropriate data-type attribute based on media type (same as page-videos-gallery.php)
                $data_type_attr = '';
                if ($lightbox_type === 'image') {
                    $data_type_attr = 'data-type="image"';
                } elseif ($lightbox_type === 'video') {
                    $data_type_attr = 'data-type="video"';
                }
                // For external videos (YouTube/Vimeo), don't set data-type - fslightbox will auto-detect
                ?>
                <div class="<?php echo esc_attr($wrapper_classes); ?>" data-aos="zoom-in"
                    data-aos-delay="<?php echo esc_attr($voice_delay); ?>">
                    <a class="group relative block w-full h-full" data-fslightbox="<?php echo esc_attr($gallery_id); ?>"
                        <?php echo $data_type_attr; ?> data-caption="<?php echo esc_attr($caption); ?>"
                        href="<?php echo esc_url($lightbox_src); ?>"
                        aria-label="<?php esc_attr_e('Open media', 'beit'); ?>">
                        <?php if ($is_video): ?>
                            <span class="absolute inset-0 z-10 flex items-center justify-center group">
                                <div
                                    class="bg-black/40 w-full h-0 transition-all duration-700 absolute top-0 group-hover:h-full">
                                </div>
                                <span class="inline-flex h-20 w-20 items-center justify-center bg-white/50 backdrop-blur-sm text-3xl
                                text-white group-hover:bg-primary transition-all duration-300 relative z-10">
                                    <i class="fa fa-play"></i>
                                </span>
                            </span>

                        <?php elseif ($lightbox_type === 'image'): ?>
                            <span class="absolute inset-0 z-10 flex items-center justify-center group">
                                <div
                                    class="bg-black/40 w-full h-0 transition-all duration-700 absolute top-0 group-hover:h-full">
                                </div>

                                <span
                                    class="inline-flex h-12 w-12 items-center justify-center bg-white/50 backdrop-blur-sm text-xl
                                text-white group-hover:bg-primary transition-all duration-300 relative z-10 opacity-0 group-hover:opacity-100">
                                    <i class="fa fa-search"></i>
                                </span>
                            </span>
                        <?php endif; ?>
                        <img class="<?php echo esc_attr($classes); ?>" src="<?php echo esc_url($thumb_url); ?>"
                            alt="<?php echo esc_attr($item['title'] ?? ''); ?>" loading="lazy" decoding="async">
                    </a>

                    <?php
                    // Add hidden links for gallery images to enable lightbox navigation
                    if ($lightbox_type === 'image' && !empty($all_images) && count($all_images) > 1):
                        // Skip first image (already displayed above)
                        $gallery_images = array_slice($all_images, 1);
                        foreach ($gallery_images as $gallery_image_id):
                            $gallery_image_url = wp_get_attachment_image_url($gallery_image_id, 'full');
                            $gallery_image_caption = wp_get_attachment_caption($gallery_image_id);
                            $gallery_caption = $item['title'];
                            if ($gallery_image_caption) {
                                $gallery_caption .= ' - ' . $gallery_image_caption;
                            }
                            ?>
                            <a
                                class="hidden"
                                data-fslightbox="<?php echo esc_attr($gallery_id); ?>"
                                data-type="image"
                                data-caption="<?php echo esc_attr($gallery_caption); ?>"
                                href="<?php echo esc_url($gallery_image_url); ?>"></a>
                        <?php endforeach;
                    endif;
                    ?>
                </div>
                <?php
                $voice_anim_index++;
            endforeach; ?>
        </div>


    </div>
</section>

<script>
    // Refresh fslightbox to ensure it works with dynamically loaded content
    if (typeof refreshFsLightbox === 'function') {
        refreshFsLightbox();
    }

    // Add captions to FSLightbox - Inline implementation
    (function() {
        let captionUpdateInterval = null;

        document.addEventListener('click', function(e) {
            const link = e.target.closest('a[data-fslightbox]');
            if (link) {
                const caption = link.getAttribute('data-caption');

                // Clear any existing interval
                if (captionUpdateInterval) {
                    clearInterval(captionUpdateInterval);
                }

                // Try to add caption multiple times to ensure it works
                let attempts = 0;
                captionUpdateInterval = setInterval(function() {
                    attempts++;

                    const container = document.querySelector('.fslightbox-container');
                    if (container) {
                        let captionEl = container.querySelector('.fslightbox-custom-caption');

                        if (!captionEl) {
                            captionEl = document.createElement('div');
                            captionEl.className = 'fslightbox-custom-caption';
                            captionEl.style.cssText = 'position:fixed;bottom:0;left:0;right:0;width:100%;background:linear-gradient(to top,rgba(0,0,0,0.9),rgba(0,0,0,0.7) 50%,transparent);padding:40px 20px 25px;font-size:20px;font-weight:600;color:white;text-align:center;text-shadow:0 2px 8px rgba(0,0,0,0.8);font-family:Montserrat,sans-serif;z-index:2147483647;pointer-events:none;';
                            container.appendChild(captionEl);
                        }

                        if (caption) {
                            captionEl.textContent = caption;
                            captionEl.style.display = 'block';
                        }
                    }

                    // Stop after 10 attempts or 2 seconds
                    if (attempts >= 10) {
                        clearInterval(captionUpdateInterval);
                    }
                }, 200);
            }
        });
    })();
</script>