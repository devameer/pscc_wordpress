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
                        $post_id = get_the_ID();
                        $gallery_images = get_field('media_gallery');

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
                        $image_count = count($all_images);

                        if ($thumbnail_id) :
                            $thumb_url = wp_get_attachment_image_url($thumbnail_id, 'large');
                            $image_url = wp_get_attachment_image_url($thumbnail_id, 'full');

                            // Unique lightbox group ID for this media item
                            $gallery_id = 'gallery-' . $post_id;
                    ?>
                            <article class="overflow-hidden transition hover:-translate-y-1 mb-6 <?php echo $is_rtl ? 'rtl:text-right' : 'ltr:text-left'; ?>" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                                <a
                                    class="group relative block w-full"
                                    data-fslightbox="<?php echo esc_attr($gallery_id); ?>"
                                    data-type="image"
                                    data-caption="<?php echo esc_attr($title); ?>"
                                    href="<?php echo esc_url($image_url); ?>"
                                    aria-label="<?php echo esc_attr(sprintf(__('View %s', 'beit'), $title)); ?>">
                                    <span class="absolute inset-0 z-10 flex items-center justify-center bg-black/40 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                        <img class="h-20 w-20" src="<?php echo esc_url(get_template_directory_uri() . '/resources/assets/images/galleryIcon.svg'); ?>" alt="<?php esc_attr_e('View Image', 'beit'); ?>" loading="lazy" decoding="async">
                                    </span>
                                    <?php if ($image_count > 1) : ?>
                                        <span class="absolute right-2 top-2 z-20 rounded-full bg-blue-600 px-3 py-1 text-xs font-semibold text-white shadow-lg">
                                            <i class="fa fa-images"></i> <?php echo esc_html($image_count); ?>
                                        </span>
                                    <?php endif; ?>
                                    <img class="h-64 w-full object-cover" src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy" decoding="async">
                                </a>

                                <?php
                                // Add hidden links for gallery images to enable lightbox navigation
                                if ($gallery_images && is_array($gallery_images)) :
                                    foreach ($gallery_images as $gallery_image_id) :
                                        $gallery_image_url = wp_get_attachment_image_url($gallery_image_id, 'full');
                                        $gallery_image_caption = wp_get_attachment_caption($gallery_image_id);
                                        $caption = $title;
                                        if ($gallery_image_caption) {
                                            $caption .= ' - ' . $gallery_image_caption;
                                        }
                                ?>
                                        <a
                                            class="hidden"
                                            data-fslightbox="<?php echo esc_attr($gallery_id); ?>"
                                            data-type="image"
                                            data-caption="<?php echo esc_attr($caption); ?>"
                                            href="<?php echo esc_url($gallery_image_url); ?>"></a>
                                <?php endforeach;
                                endif;
                                ?>

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
?>

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

<?php
get_footer();
