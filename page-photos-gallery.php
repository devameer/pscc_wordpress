<?php

/**
 * Photos Gallery template - displays only photo media items.
 *
 * @package beit
 *
 * Template Name: Photos Gallery
 * Template Post Type: page
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) {
    the_post();

    $is_rtl = is_rtl();
    $lightbox_id = 'photos-gallery-lightbox';

    $hero_title = get_the_title();
    $hero_description = get_the_content();

    get_template_part(
        'resources/views/components/page-hero',
        null,
        [
            'title'       => $hero_title,
            'description' => $hero_description,
            'background_classes' => 'bg-gradient-to-br from-blue-900 via-slate-800 to-blue-950',
        ]
    );

    // Query for photo media items
    $photos_query = new WP_Query(
        [
            'post_type'      => 'beit_media',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'meta_query'     => [
                [
                    'key'     => 'media_type',
                    'value'   => 'image',
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
            <?php if ($photos_query->have_posts()) : ?>
                <div class="mb-12 text-center" data-aos="fade-up">
                    <h2 class="text-3xl font-bold text-slate-900">
                        <?php echo esc_html(beit_translate('Photo Gallery', 'photo_gallery')); ?>
                    </h2>
                    <p class="mt-2 text-slate-600">
                        <?php echo esc_html(sprintf(beit_translate('%d photos available', 'photos_count'), $photos_query->found_posts)); ?>
                    </p>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    <?php
                    $delay = 0;
                    while ($photos_query->have_posts()) :
                        $photos_query->the_post();
                        $thumbnail_id = get_post_thumbnail_id();
                        $title = get_the_title();

                        if ($thumbnail_id) :
                            $image_url = wp_get_attachment_image_url($thumbnail_id, 'full');
                            $thumb_url = wp_get_attachment_image_url($thumbnail_id, 'large');
                            ?>
                            <article class="overflow-hidden transition hover:-translate-y-1 mb-6 <?php echo $is_rtl ? 'rtl:text-right' : 'ltr:text-left'; ?>" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                                <a
                                    class="group relative block w-full"
                                    data-fslightbox="<?php echo esc_attr($lightbox_id); ?>"
                                    data-type="image"
                                    data-caption="<?php echo esc_attr($title); ?>"
                                    href="<?php echo esc_url($image_url); ?>"
                                    aria-label="<?php echo esc_attr(sprintf(__('View %s', 'beit'), $title)); ?>">
                                    <span class="absolute inset-0 z-10 flex items-center justify-center bg-black/40">
                                        <img class="h-20 w-20" src="<?php echo esc_url(get_template_directory_uri() . '/resources/assets/images/galleryIcon.svg'); ?>" alt="<?php esc_attr_e('View Image', 'beit'); ?>" loading="lazy" decoding="async">
                                    </span>
                                    <img class="h-64 w-full object-cover" src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy" decoding="async">
                                </a>
                                <h3 class="text-base font-medium md:text-lg pt-3"><?php echo esc_html($title); ?></h3>
                            </article>
                            <?php
                            $delay = ($delay + 50) % 500;
                        endif;
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php else : ?>
                <div class=" bg-slate-50 p-12 text-center shadow-inner" data-aos="fade-up">
                    <i class="fa fa-images mb-4 text-6xl text-slate-300"></i>
                    <h2 class="text-2xl font-semibold text-slate-900">
                        <?php echo esc_html(beit_translate('No photos found', 'no_photos_found')); ?>
                    </h2>
                    <p class="mt-2 text-sm text-slate-600">
                        <?php echo esc_html(beit_translate('Please check back soon for new photos.', 'check_back_photos')); ?>
                    </p>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <?php
}

get_footer();
