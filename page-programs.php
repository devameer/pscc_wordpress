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
    $hero_description = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true) ?: get_post_field('post_excerpt', get_the_ID());

    get_template_part(
        'resources/views/components/page-hero',
        null,
        [
            'title'       => $hero_title,
            'description' => $hero_description,
            'eyebrow'     => __('Programs & Projects', 'beit'),
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
    <section class="container mx-auto px-4 py-16">
        <?php
        $index = 0;
        while ($programs_query->have_posts()) {
            $programs_query->the_post();

            $layout = function_exists('get_field') ? get_field('program_layout') : 'image-left';
            if (!in_array($layout, ['image-left', 'image-right'], true)) {
                $layout = 'image-left';
            }

            $heading          = function_exists('get_field') ? get_field('program_heading') : '';
            $eyebrow          = function_exists('get_field') ? get_field('program_eyebrow') : '';
            $overlay_heading  = function_exists('get_field') ? get_field('program_overlay_heading') : '';
            $overlay_sub      = function_exists('get_field') ? get_field('program_overlay_subheading') : '';
            $description      = function_exists('get_field') ? get_field('program_description') : '';
            $button           = function_exists('get_field') ? get_field('program_button') : null;

            $image_id  = get_post_thumbnail_id();
            $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'large') : '';

            $content_background = 'image-left' === $layout ? 'bg-white' : 'bg-gray-50';
            $content_html = '';
            $content_html .= '<div class="' . esc_attr($content_background) . ' p-12 flex flex-col justify-center gap-6">';
            if ($eyebrow) {
                $content_html .= '<span class="text-sm uppercase tracking-[0.4em] text-red-500">' . esc_html($eyebrow) . '</span>';
            }
            $content_html .= '<h2 class="text-4xl font-normal leading-tight">' . ($heading ? wp_kses_post($heading) : esc_html(get_the_title())) . '</h2>';
            $content_html .= '<p class="text-gray-700 leading-relaxed">' . esc_html($description ?: get_the_excerpt()) . '</p>';

            // Read More button (links to single program page)
            $content_html .= sprintf(
                '<a class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded self-start transition inline-block" href="%s">%s</a>',
                esc_url(get_permalink()),
                esc_html__('Read More', 'beit')
            );

            // Keep custom button if exists (optional additional button)
            if (!empty($button['title']) && !empty($button['url'])) {
                $content_html .= sprintf(
                    '<a class="bg-slate-600 hover:bg-slate-700 text-white px-8 py-3 rounded self-start transition inline-block ml-3" href="%s" target="%s" rel="noopener">%s</a>',
                    esc_url($button['url']),
                    esc_attr($button['target'] ?? '_self'),
                    esc_html($button['title'])
                );
            }
            $content_html .= '</div>';

            $image_html = '';
            if ($image_url) {
                $image_html .= '<div class="relative h-[400px] overflow-hidden">';
                $image_html .= '<img class="w-full h-full object-cover" src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . '">';
                $image_html .= '<div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>';
                $image_html .= '<div class="absolute bottom-0 left-0 p-8 text-white">';
                if ($overlay_heading) {
                    $image_html .= '<h2 class="text-4xl font-bold">' . esc_html($overlay_heading) . '</h2>';
                }
                if ($overlay_sub) {
                    $image_html .= '<p class="text-xl font-light">' . esc_html($overlay_sub) . '</p>';
                }
                $image_html .= '</div></div>';
            } else {
                $image_html .= '<div class="flex h-[400px] items-center justify-center bg-slate-100 p-8 text-center text-slate-500">' . esc_html__('Add a featured image to display here.', 'beit') . '</div>';
            }

            $row_classes = 'grid md:grid-cols-2 gap-0 mb-0';
            echo '<div class="' . esc_attr($row_classes) . '">';
            echo 'image-left' === $layout ? $image_html . $content_html : $content_html . $image_html;
            echo '</div>';

            $index++;
        }
        wp_reset_postdata();
        ?>
    </section>
</main>

<?php
get_footer();
