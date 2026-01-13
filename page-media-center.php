<?php

/**
 * Media Center landing page template.
 *
 * @package beit
 *
 * Template Name: Media Center
 * Template Post Type: page
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$is_rtl = is_rtl();
$lightbox_id = 'media-center-lightbox';

$current_page_id = get_the_ID();
$has_acf = function_exists('get_field');

// Get hero data
$hero_data = $has_acf ? (get_field('media_center_hero', $current_page_id) ?: []) : [];
$hero_custom_title = $hero_data['custom_title'] ?? '';
$hero_title = $hero_custom_title ?: get_the_title($current_page_id);
$hero_subtitle = get_the_content();
$hero_description = get_post_meta($current_page_id, '_yoast_wpseo_metadesc', true) ?: get_post_field('post_excerpt', $current_page_id);

get_template_part(
    'resources/views/components/page-hero',
    null,
    [
        'title' => $hero_title,
        'subtitle' => $hero_subtitle,
        'description' => $hero_description,
        'background_classes' => 'bg-gradient-to-br from-slate-950 via-slate-800 to-red-900',
    ]
);

// Query for all media items
$media_query = new WP_Query([
    'post_type' => 'beit_media',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
]);

?>

<main class="bg-white text-slate-900">
    <section class="container mx-auto px-4 py-16">
        <?php if ($media_query->have_posts()) : ?>
     

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <?php
                $delay = 0;
                while ($media_query->have_posts()) :
                    $media_query->the_post();
                    $post_id = get_the_ID();
                    $media_type = $has_acf ? get_field('media_type', $post_id) : 'image';
                    $title = get_the_title();

                    if ($media_type === 'image') :
                        // Image handling with gallery support
                        $thumbnail_id = get_post_thumbnail_id();
                        
                        // Get gallery images
                        $gallery_images = get_post_meta($post_id, 'media_gallery', true);
                        if (!is_array($gallery_images)) {
                            $gallery_images = false;
                        }

                        // Combine featured image with gallery images
                        $all_images = [];
                        if ($thumbnail_id) {
                            $all_images[] = $thumbnail_id;
                        }
                        if ($gallery_images && is_array($gallery_images)) {
                            $all_images = array_merge($all_images, $gallery_images);
                        }
                        $all_images = array_unique($all_images);
                        $image_count = count($all_images);

                        if ($thumbnail_id) :
                            $thumb_url = wp_get_attachment_image_url($thumbnail_id, 'large');
                            $image_url = wp_get_attachment_image_url($thumbnail_id, 'full');

                            // Get image dimensions for PhotoSwipe
                            $image_meta = wp_get_attachment_metadata($thumbnail_id);
                            $image_width = $image_meta['width'] ?? 1920;
                            $image_height = $image_meta['height'] ?? 1080;

                            // Unique lightbox group ID for this media item
                            $gallery_id = 'gallery-' . $post_id;
                ?>
                            <article class="overflow-hidden transition hover:-translate-y-1 mb-6 <?php echo $is_rtl ? 'rtl:text-right' : 'ltr:text-left'; ?>" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                                <a
                                    class="group relative block w-full pswp-gallery-item"
                                    data-pswp-gallery="<?php echo esc_attr($gallery_id); ?>"
                                    data-pswp-width="<?php echo esc_attr($image_width); ?>"
                                    data-pswp-height="<?php echo esc_attr($image_height); ?>"
                                    href="<?php echo esc_url($image_url); ?>"
                                    aria-label="<?php echo esc_attr(sprintf(__('View %s', 'beit'), $title)); ?>">
                                    <img class="pswp-thumbnail" src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($title); ?>" style="display:none;">
                                    <span class="pswp-caption-content" style="display:none;"><?php echo esc_html($title); ?></span>
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
                                        if ($gallery_image_id == $thumbnail_id) continue;

                                        $gallery_image_url = wp_get_attachment_image_url($gallery_image_id, 'full');
                                        $gallery_thumb_url = wp_get_attachment_image_url($gallery_image_id, 'medium');
                                        $gallery_image_caption = wp_get_attachment_caption($gallery_image_id);
                                        $caption = $title;
                                        if ($gallery_image_caption) {
                                            $caption .= ' - ' . $gallery_image_caption;
                                        }

                                        $gallery_meta = wp_get_attachment_metadata($gallery_image_id);
                                        $gallery_width = $gallery_meta['width'] ?? 1920;
                                        $gallery_height = $gallery_meta['height'] ?? 1080;
                                ?>
                                        <a
                                            class="hidden pswp-gallery-item"
                                            data-pswp-gallery="<?php echo esc_attr($gallery_id); ?>"
                                            data-pswp-width="<?php echo esc_attr($gallery_width); ?>"
                                            data-pswp-height="<?php echo esc_attr($gallery_height); ?>"
                                            href="<?php echo esc_url($gallery_image_url); ?>">
                                            <img class="pswp-thumbnail" src="<?php echo esc_url($gallery_thumb_url); ?>" alt="<?php echo esc_attr($caption); ?>" style="display:none;">
                                            <span class="pswp-caption-content" style="display:none;"><?php echo esc_html($caption); ?></span>
                                        </a>
                                <?php endforeach;
                                endif;
                                ?>

                                <h3 class="text-base font-medium md:text-lg pt-3"><?php the_title(); ?></h3>
                            </article>
                <?php
                        endif;

                    elseif ($media_type === 'video') :
                        // Video handling with YouTube/Vimeo support
                        $video_source_type = $has_acf ? get_field('media_video_source_type', $post_id) : '';
                        $video_file = $has_acf ? get_field('media_video_file', $post_id) : '';
                        $video_url = $has_acf ? get_field('media_video_url', $post_id) : '';
                        $video_thumbnail_id = $has_acf ? get_field('media_video_thumbnail', $post_id) : '';

                        // Determine video source
                        $video_src = '';
                        $is_external_video = false;
                        if (!empty($video_file)) {
                            $video_src = $video_file;
                            $is_external_video = false;
                        } elseif (!empty($video_url)) {
                            $video_src = function_exists('beit_get_video_embed_url') 
                                ? beit_get_video_embed_url($video_url) 
                                : $video_url;
                            $is_external_video = true;
                        }

                        // Get thumbnail: video thumbnail first, then featured image
                        if ($video_thumbnail_id) {
                            $thumbnail_url = wp_get_attachment_image_url($video_thumbnail_id, 'large');
                        } else {
                            $featured_image_id = get_post_thumbnail_id();
                            $thumbnail_url = $featured_image_id ? wp_get_attachment_image_url($featured_image_id, 'large') : '';
                        }

                        if ($video_src && $thumbnail_url) :
                            $data_type = $is_external_video ? '' : 'data-type="video"';
                ?>
                            <article class="overflow-hidden transition hover:-translate-y-1 mb-6 <?php echo $is_rtl ? 'rtl:text-right' : 'ltr:text-left'; ?>" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
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
                                <h3 class="text-base font-medium md:text-lg pt-3"><?php the_title(); ?></h3>
                            </article>
                <?php
                        endif;
                    endif;

                    $delay = ($delay + 50) % 500;
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php else : ?>
            <div class="bg-slate-50 p-12 text-center shadow-inner" data-aos="fade-up">
                <i class="fa fa-photo-video mb-4 text-6xl text-slate-300"></i>
                <h2 class="text-2xl font-bold text-slate-900">
                    <?php echo esc_html(beit_translate('No media items found', 'no_media_found')); ?>
                </h2>
                <p class="mt-2 text-sm text-slate-600">
                    <?php echo esc_html(beit_translate('Please check back soon for new stories and media highlights.', 'check_back_media')); ?>
                </p>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php
get_footer();
