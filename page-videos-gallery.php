<?php

/**
 * Videos Gallery template - displays only video media items.
 *
 * @package beit
 *
 * Template Name: Videos Gallery
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) {
    the_post();

    $is_rtl = is_rtl();
    $lightbox_id = 'videos-gallery-lightbox';

    $hero_title = get_the_title();
    $hero_description = get_the_content();

    get_template_part(
        'resources/views/components/page-hero',
        null,
        [
            'title'       => $hero_title,
            'description' => $hero_description,
            'background_classes' => 'bg-gradient-to-br from-red-900 via-slate-800 to-red-950',
        ]
    );

    // Query for video media items
    $videos_query = new WP_Query(
        [
            'post_type'      => 'beit_media',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'meta_query'     => [
                [
                    'key'     => 'media_type',
                    'value'   => 'video',
                    'compare' => '=',
                ],
            ],
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]
    );
    ?>

    <main class="bg-white text-slate-900">
        <section class="container mx-auto px-4 py-16">
            <?php if ($videos_query->have_posts()) : ?>
                <div class="mb-12 text-center" data-aos="fade-up">
                    <h2 class="text-3xl font-bold text-slate-900">
                        <?php echo esc_html(beit_translate('Video Gallery', 'video_gallery')); ?>
                    </h2>
                    <p class="mt-2 text-slate-600">
                        <?php echo esc_html(sprintf(beit_translate('%d videos available', 'videos_count'), $videos_query->found_posts)); ?>
                    </p>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    <?php
                    while ($videos_query->have_posts()) :
                        $videos_query->the_post();
                        $video_source_type = get_field('media_video_source_type');
                        $video_file = get_field('media_video_file');
                        $video_url = get_field('media_video_url');
                        $video_thumbnail_id = get_field('media_video_thumbnail');
                        $title = get_the_title();

                        // Determine video source - prioritize URL if file is empty, or file if URL is empty
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

                        // Get thumbnail: use video thumbnail first, then featured image as fallback
                        if ($video_thumbnail_id) {
                            $thumbnail_url = wp_get_attachment_image_url($video_thumbnail_id, 'large');
                        } else {
                            $featured_image_id = get_post_thumbnail_id();
                            $thumbnail_url = $featured_image_id ? wp_get_attachment_image_url($featured_image_id, 'large') : '';
                        }

                        if ($video_src && $thumbnail_url) :
                            // Use appropriate data attributes based on video type
                            $data_type = $is_external_video ? '' : 'data-type="video"';
                            ?>
                            <article class="overflow-hidden transition hover:-translate-y-1 mb-6 <?php echo $is_rtl ? 'rtl:text-right' : 'ltr:text-left'; ?>" data-aos="fade-up" data-aos-delay="<?php echo 100 + ($videos_query->current_post * 50); ?>">
                                <a
                                    class="group relative block w-full"
                                    data-fslightbox="<?php echo esc_attr($lightbox_id); ?>"
                                    <?php echo $data_type; ?>
                                    data-caption="<?php echo esc_attr($title); ?>"
                                    href="<?php echo esc_url($video_src); ?>"
                                    aria-label="<?php echo esc_attr(sprintf(__('Play %s', 'beit'), $title)); ?>">
                                    <span class="absolute inset-0 z-10 flex items-center justify-center bg-black/40">
                                        <img class="h-20 w-20" src="<?php echo esc_url(get_template_directory_uri() . '/resources/assets/images/videoIcon.svg'); ?>" alt="<?php esc_attr_e('Play Video', 'beit'); ?>" loading="lazy" decoding="async">
                                    </span>
                                    <img class="h-64 w-full object-cover" src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy" decoding="async">
                                </a>
                                <h3 class="text-base font-medium md:text-lg pt-3"><?php echo esc_html($title); ?></h3>
                            </article>
                            <?php
                        endif;
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php else : ?>
                <div class="rounded-3xl bg-slate-50 p-12 text-center shadow-inner" data-aos="fade-up">
                    <i class="fa fa-video mb-4 text-6xl text-slate-300"></i>
                    <h2 class="text-2xl font-semibold text-slate-900">
                        <?php echo esc_html(beit_translate('No videos found', 'no_videos_found')); ?>
                    </h2>
                    <p class="mt-2 text-sm text-slate-600">
                        <?php echo esc_html(beit_translate('Please check back soon for new videos.', 'check_back_videos')); ?>
                    </p>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <?php
}

get_footer();
