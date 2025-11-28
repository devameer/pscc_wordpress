<?php

/**
 * Programs & Projects landing page template.
 *
 * @package beit
 *
 * Template Name: Programs & Projects Page
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) {
    the_post();

    $hero_title = get_the_title();
    $hero_subtitle = get_the_content(); // Get content as subtitle
    $hero_description = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true) ?: get_post_field('post_excerpt', get_the_ID());

    get_template_part(
        'resources/views/components/page-hero',
        null,
        [
            'title'       => $hero_title,
            'subtitle'    => $hero_subtitle,
            'description' => $hero_description,
            'background_classes' => 'bg-gradient-to-br from-red-900 via-slate-900 to-slate-950',
        ]
    );
}

$programs_query = new WP_Query(
    [
        'post_type'      => 'beit_program',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => ['menu_order' => 'ASC', 'date' => 'ASC'],
    ]
);

if (!$programs_query->have_posts()) {
    echo '<main class="container mx-auto px-4 py-16 text-center text-slate-600">' . esc_html__('No programs found. Please add some via the dashboard.', 'beit') . '</main>';
    get_footer();
    return;
}

?>

<main class="bg-white text-slate-900">
    <section class="container mx-auto px-3 py-8 sm:px-4 sm:py-10 md:px-6 md:py-16">
        <?php
        $index = 0;
        while ($programs_query->have_posts()) {
            $programs_query->the_post();

            $layout = function_exists('get_field') ? get_field('program_layout') : 'image-left';
            if (!in_array($layout, ['image-left', 'image-right'], true)) {
                $layout = 'image-left';
            }

            $heading          = function_exists('get_field') ? get_field('program_heading') : '';
            $overlay_heading  = function_exists('get_field') ? get_field('program_overlay_heading') : '';
            $overlay_sub      = function_exists('get_field') ? get_field('program_overlay_subheading') : '';
            $description      = function_exists('get_field') ? get_field('program_description') : '';
            $button           = function_exists('get_field') ? get_field('program_button') : null;

            $image_id  = get_post_thumbnail_id();
            $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'large') : '';

            $content_background = 'image-left' === $layout ? 'p-4 sm:p-6 md:p-8 lg:p-12' : 'py-4 px-4 sm:py-6 sm:px-6 md:py-8 md:px-0 ltr:md:pe-8 rtl:md:ps-8 ltr:lg:pe-12 rtl:lg:ps-12';
            $content_html = '';
            $content_html .= '<div class="' . esc_attr($content_background) . ' flex flex-col justify-center gap-3 sm:gap-4 md:gap-6 transition-transform duration-300 ltr:text-left rtl:text-right">';

            $content_html .= '<h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-normal leading-tight">' . ($heading ? wp_kses_post($heading) : esc_html(get_the_title())) . '</h2>';
            $content_html .= '<p class="text-xs sm:text-sm md:text-base text-gray-700 leading-relaxed">' . esc_html($description ?: get_the_excerpt()) . '</p>';

            // Read More button (links to single program page)
            $content_html .= sprintf(
                '<div class="flex ltr:justify-start rtl:justify-start ltr:sm:justify-end rtl:sm:justify-start"><a class="btn-more text-xs sm:text-sm px-4 py-2.5 sm:px-6 sm:py-3 md:px-8 md:py-3.5" href="%s">%s</a></div>',
                esc_url(get_permalink()),
                esc_html__('Read More', 'beit')
            );

            // Keep custom button if exists (optional additional button)
            if (!empty($button['title']) && !empty($button['url'])) {
                $content_html .= sprintf(
                    '<a class="bg-slate-600 hover:bg-slate-700 text-white px-4 py-2.5 sm:px-6 sm:py-2.5 md:px-8 md:py-3 text-xs sm:text-sm md:text-base self-start transition inline-block ltr:ml-2 rtl:mr-2 ltr:md:ml-3 rtl:md:mr-3 mt-2 sm:mt-0" href="%s" target="%s" rel="noopener">%s</a>',
                    esc_url($button['url']),
                    esc_attr($button['target'] ?? '_self'),
                    esc_html($button['title'])
                );
            }
            $content_html .= '</div>';

            $image_html = '';
            if ($image_url) {
                $image_html .= '<div class="relative h-[250px] sm:h-[300px] md:h-[400px] overflow-hidden">';
                $image_html .= '<img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . '" loading="lazy" decoding="async">';
                $image_html .= '<div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent duration-300"></div>';
                $image_html .= '<div class="absolute bottom-0 ltr:left-0 rtl:right-0 p-3 sm:p-4 md:p-6 lg:p-8 text-white ltr:text-left rtl:text-right">';
                if ($overlay_heading) {
                    $image_html .= '<h2 class="text-lg sm:text-xl md:text-2xl lg:text-3xl xl:text-4xl font-bold">' . esc_html($overlay_heading) . '</h2>';
                }
                if ($overlay_sub) {
                    $image_html .= '<p class="text-sm sm:text-base md:text-lg lg:text-xl font-light">' . esc_html($overlay_sub) . '</p>';
                }
                $image_html .= '</div></div>';
            } else {
                $image_html .= '<div class="flex h-[250px] sm:h-[300px] md:h-[400px] items-center justify-center bg-slate-100 p-4 sm:p-6 md:p-8 text-center text-xs sm:text-sm md:text-base text-slate-500">' . esc_html__('Add a featured image to display here.', 'beit') . '</div>';
            }

            // Animation attributes - alternate between slide directions (RTL-aware)
            $animation_delay = $index * 100;
            $is_rtl = is_rtl();

            // For RTL, reverse the animation directions
            if ('image-left' === $layout) {
                $image_animation = $is_rtl ? 'fade-right' : 'fade-left';
                $content_animation = $is_rtl ? 'fade-left' : 'fade-right';
            } else {
                $image_animation = $is_rtl ? 'fade-left' : 'fade-right';
                $content_animation = $is_rtl ? 'fade-right' : 'fade-left';
            }

            $row_classes = 'grid md:grid-cols-2 gap-0 mb-4 sm:mb-6 md:mb-8 lg:mb-0 overflow-hidden rounded-lg md:rounded-none shadow-md md:shadow-none transition hover:-translate-y-1';
            echo '<div class="' . esc_attr($row_classes) . '" data-aos="fade-up" data-aos-delay="' . esc_attr($animation_delay) . '">';

            // On mobile, always show image first, then content
            // On desktop (md+), respect the layout setting
            if ('image-left' === $layout) {
                // Mobile: image first, Desktop: image left
                echo '<div class="md:order-1" data-aos="' . esc_attr($image_animation) . '" data-aos-delay="' . esc_attr($animation_delay + 100) . '">' . $image_html . '</div>';
                echo '<div class="md:order-2" data-aos="' . esc_attr($content_animation) . '" data-aos-delay="' . esc_attr($animation_delay + 200) . '">' . $content_html . '</div>';
            } else {
                // Mobile: image first, Desktop: content left, image right
                echo '<div class="order-1 md:order-2" data-aos="' . esc_attr($image_animation) . '" data-aos-delay="' . esc_attr($animation_delay + 200) . '">' . $image_html . '</div>';
                echo '<div class="order-2 md:order-1" data-aos="' . esc_attr($content_animation) . '" data-aos-delay="' . esc_attr($animation_delay + 100) . '">' . $content_html . '</div>';
            }

            echo '</div>';

            $index++;
        }
        wp_reset_postdata();
        ?>
    </section>
</main>

<?php
get_footer();