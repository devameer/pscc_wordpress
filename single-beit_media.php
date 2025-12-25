<?php

/**
 * Single Media Item Template - displays media with gallery support.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) {
    the_post();

    $is_rtl = is_rtl();
    $media_type = get_field('media_type') ?: 'image';
    $title = get_the_title();
    $content = get_the_content();

    get_template_part(
        'resources/views/components/page-hero',
        null,
        [
            'title'       => $title,
            'description' => '',
            'background_classes' => 'bg-gradient-to-br from-blue-900 via-slate-800 to-blue-950',
        ]
    );
    ?>

    <main class="bg-white text-slate-900">
        <section class="container mx-auto px-4 py-16">
            <div class="mx-auto max-w-6xl">
                <?php if ($media_type === 'image') : ?>
                    <?php
                    // Get featured image
                    $thumbnail_id = get_post_thumbnail_id();
                    // Get gallery images - use get_post_meta instead of get_field
                    $gallery_images = get_post_meta(get_the_ID(), 'media_gallery', true);
                    if (!is_array($gallery_images)) {
                        $gallery_images = [];
                    }

                    // Combine featured image with gallery images
                    $all_images = [];
                    if ($thumbnail_id) {
                        $all_images[] = $thumbnail_id;
                    }
                    if ($gallery_images && is_array($gallery_images)) {
                        $all_images = array_merge($all_images, $gallery_images);
                    }

                    // Remove duplicates
                    $all_images = array_unique($all_images);
                    ?>

                    <?php if (!empty($all_images)) : ?>
                        <div class="mb-8" data-aos="fade-up">
                            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                <?php
                                $delay = 0;
                                foreach ($all_images as $index => $image_id) :
                                    $image_url = wp_get_attachment_image_url($image_id, 'full');
                                    $thumb_url = wp_get_attachment_image_url($image_id, 'large');
                                    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: $title;
                                    $image_caption = wp_get_attachment_caption($image_id);

                                    // Create caption with title and image caption
                                    $caption = $title;
                                    if ($image_caption) {
                                        $caption .= ' - ' . $image_caption;
                                    }
                                    ?>
                                    <article class="overflow-hidden transition hover:-translate-y-1" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                                        <a
                                            class="group relative block w-full cursor-pointer"
                                            data-fslightbox="media-gallery"
                                            data-type="image"
                                            data-caption="<?php echo esc_attr($caption); ?>"
                                            href="<?php echo esc_url($image_url); ?>"
                                            aria-label="<?php echo esc_attr(sprintf(__('View image %d', 'beit'), $index + 1)); ?>">
                                            <span class="absolute inset-0 z-10 flex items-center justify-center bg-black/40 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                                <img class="h-16 w-16" src="<?php echo esc_url(get_template_directory_uri() . '/resources/assets/images/galleryIcon.svg'); ?>" alt="<?php esc_attr_e('View Image', 'beit'); ?>" loading="lazy" decoding="async">
                                            </span>
                                            <img class="h-64 w-full object-cover" src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" loading="lazy" decoding="async">
                                        </a>
                                    </article>
                                    <?php
                                    $delay = ($delay + 50) % 500;
                                endforeach;
                                ?>
                            </div>
                        </div>

                        <div class="text-center">
                            <p class="text-sm text-slate-600">
                                <?php echo esc_html(sprintf(__('%d images in this gallery', 'beit'), count($all_images))); ?>
                            </p>
                        </div>
                    <?php else : ?>
                        <div class="bg-slate-50 p-12 text-center shadow-inner" data-aos="fade-up">
                            <i class="fa fa-image mb-4 text-6xl text-slate-300"></i>
                            <h2 class="text-2xl font-semibold text-slate-900">
                                <?php echo esc_html(__('No images found', 'beit')); ?>
                            </h2>
                        </div>
                    <?php endif; ?>

                <?php elseif ($media_type === 'video') : ?>
                    <?php
                    $video_source_type = get_field('media_video_source_type') ?: 'url';
                    $video_thumbnail_id = get_field('media_video_thumbnail');

                    if ($video_source_type === 'file') {
                        $video_url = get_field('media_video_file');
                    } else {
                        $video_url = get_field('media_video_url');
                    }
                    ?>

                    <?php if ($video_url) : ?>
                        <div class="mb-8" data-aos="fade-up">
                            <div class="aspect-video overflow-hidden rounded-lg shadow-lg">
                                <?php if ($video_source_type === 'file') : ?>
                                    <video class="h-full w-full" controls<?php echo $video_thumbnail_id ? ' poster="' . esc_url(wp_get_attachment_image_url($video_thumbnail_id, 'full')) . '"' : ''; ?>>
                                        <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                                        <?php esc_html_e('Your browser does not support the video tag.', 'beit'); ?>
                                    </video>
                                <?php else : ?>
                                    <?php
                                    // Use WordPress oEmbed for external URLs
                                    echo wp_oembed_get($video_url);
                                    ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="bg-slate-50 p-12 text-center shadow-inner" data-aos="fade-up">
                            <i class="fa fa-video-camera mb-4 text-6xl text-slate-300"></i>
                            <h2 class="text-2xl font-semibold text-slate-900">
                                <?php echo esc_html(__('No video found', 'beit')); ?>
                            </h2>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($content) : ?>
                    <div class="prose prose-slate mx-auto mt-12 max-w-3xl <?php echo $is_rtl ? 'text-right' : 'text-left'; ?>" data-aos="fade-up">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                <?php endif; ?>

                <div class="mt-12 text-center" data-aos="fade-up">
                    <a href="<?php echo esc_url(home_url('/media-center')); ?>" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-6 py-3 text-white transition hover:bg-blue-700">
                        <?php if ($is_rtl) : ?>
                            <i class="fa fa-arrow-right"></i>
                        <?php else : ?>
                            <i class="fa fa-arrow-left"></i>
                        <?php endif; ?>
                        <span><?php echo esc_html(__('Back to Media Center', 'beit')); ?></span>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <?php
}

get_footer();
