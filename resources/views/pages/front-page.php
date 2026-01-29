<?php

/**
 * Front-page layout aligned with the refreshed Beit Lahia design system.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once BEIT_THEME_DIR . '/app/front-page-defaults.php';

$hero_defaults = beit_front_default_hero();
$news_defaults = beit_front_default_news();
$members_defaults = beit_front_default_members();
$voices_defaults = beit_front_default_voices();
$our_story_defaults = beit_front_default_our_story();

$has_acf = function_exists('get_field');
$is_rtl = is_rtl();

$content_alignment = $is_rtl ? 'md:text-right' : 'md:text-left';
$video_button_position = $is_rtl ? 'bottom-16 left-12' : 'bottom-16 right-12';
$hero_prev_icon = $is_rtl ? 'fa fa-angle-right' : 'fa fa-angle-left';
$hero_next_icon = $is_rtl ? 'fa fa-angle-left' : 'fa fa-angle-right';

$hero_settings = [
    'autoplay' => $hero_defaults['autoplay'],
    'loop' => $hero_defaults['loop'],
    'show_navigation' => $hero_defaults['show_navigation'],
    'show_pagination' => $hero_defaults['show_pagination'],
];

$hero_slides = [];

$hero_query = new WP_Query(
    [
        'post_type' => 'beit_hero_slide',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'meta_key' => 'hero_slide_order',
        'orderby' => [
            'meta_value_num' => 'ASC',
            'date' => 'DESC',
        ],
    ]
);

if ($hero_query->have_posts()) {
    while ($hero_query->have_posts()) {
        $hero_query->the_post();

        $slide_id = get_the_ID();
        $slide_order = $has_acf ? (int) get_field('hero_slide_order', $slide_id) : 0;
        $title = $has_acf ? (string) get_field('hero_slide_title', $slide_id) : '';
        $description = $has_acf ? (string) get_field('hero_slide_description', $slide_id) : '';
        $background_image = get_the_post_thumbnail_url($slide_id, 'full') ?: '';
        $primary_button_field = $has_acf ? get_field('hero_slide_primary_button', $slide_id) : null;

        $primary_button = is_array($primary_button_field) ? $primary_button_field : [];

        if ('' === $description) {
            $description = has_excerpt($slide_id) ? get_the_excerpt() : wp_strip_all_tags(get_the_content(null, false, $slide_id));
        }

        $hero_slides[] = [
            'order' => $slide_order,
            'title' => $title,
            'description' => $description,
            'background_image' => $background_image,
            'primary_button' => $primary_button,
        ];
    }

    wp_reset_postdata();
}

if (empty($hero_slides)) {
    $hero_slides = $hero_defaults['slides'];
}

$news = $news_defaults;
$news_field = $has_acf ? get_field('front_news') : null;
if (is_array($news_field)) {
    $news = array_merge($news, array_filter($news_field));
}

$news_posts = [];

if (post_type_exists('beit_news')) {
    $news_query = new WP_Query(
        [
            'post_type' => 'beit_news',
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
        ]
    );

    if ($news_query->have_posts()) {
        while ($news_query->have_posts()) {
            $news_query->the_post();

            $news_posts[] = [
                'title' => get_the_title(),
                'excerpt' => get_the_excerpt(),
                'image' => get_post_thumbnail_id(get_the_ID()),
                'link' => get_permalink(),
            ];
        }

        wp_reset_postdata();
    }

    $archive_link = get_post_type_archive_link('beit_news');
    if (!empty($archive_link)) {
        $news['cta']['url'] = $archive_link;
    }
}

$members = $members_defaults;
$members_field = $has_acf ? get_field('front_members') : null;
if (is_array($members_field)) {
    $members = array_merge($members, array_filter($members_field));
    if (!empty($members_field['items']) && is_array($members_field['items'])) {
        $members['items'] = $members_field['items'];
    }
}

$voices = [
    'title' => $voices_defaults['title'] ?? __('Media Center', 'beit'),
    'subtitle' => $voices_defaults['subtitle'] ?? '',
    'items' => [],
];

$voices_field = $has_acf ? get_field('front_voices') : null;
if (is_array($voices_field)) {
    $voices = array_merge($voices, array_filter($voices_field));

    // Process ACF voices items if they exist
    if (!empty($voices_field['items']) && is_array($voices_field['items'])) {
        $processed_items = [];
        $index = 0;

        foreach ($voices_field['items'] as $item) {
            $media_type = $item['media_type'] ?? 'image';
            $processed_item = [
                'span' => $index === 0 ? 'double' : 'single',
            ];

            if ($media_type === 'image' && !empty($item['image'])) {
                $processed_item['image'] = $item['image'];
                $processed_item['media'] = [
                    'type' => 'image',
                    'src' => wp_get_attachment_image_url($item['image'], 'full'),
                    'thumbnail_url' => wp_get_attachment_image_url($item['image'], 'large'),
                    'caption' => '',
                ];
            } elseif ($media_type === 'video') {
                $video_src = $item['video_file'] ?? $item['video_url'] ?? '';
                $thumbnail_id = $item['video_thumbnail'] ?? 0;
                $thumbnail_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'large') : '';

                $processed_item['media'] = [
                    'type' => 'video',
                    'src' => $video_src,
                    'thumbnail_url' => $thumbnail_url,
                    'caption' => '',
                ];
            }

            $processed_items[] = $processed_item;
            $index++;
        }

        $voices['items'] = $processed_items;
    }
}

$our_story = $our_story_defaults;
$our_story_field = $has_acf ? get_field('front_our_story') : null;
if (is_array($our_story_field)) {
    $our_story = array_merge($our_story, array_filter($our_story_field));
}

$display_news = $news_posts;

// Contact Section Settings
$contact_section = [
    'title' => __('Get In Touch', 'beit'),
    'subtitle' => __('We would love to hear from you', 'beit'),
    'background_image' => '',
    'overlay_color' => '#1e293b',
    'overlay_opacity' => 85,
];
$contact_field = $has_acf ? get_field('front_contact') : null;
if (is_array($contact_field)) {
    $contact_section = array_merge($contact_section, array_filter($contact_field, function ($v) {
        return $v !== '' && $v !== null;
    }));
}

?>

<main class="bg-white text-slate-900">
    <?php
    get_template_part(
        'resources/views/sections/hero',
        null,
        [
            'slides' => $hero_slides,
            'settings' => $hero_settings,
            'content_alignment' => $content_alignment,
            'video_button_position' => $video_button_position,
            'hero_prev_icon' => $hero_prev_icon,
            'hero_next_icon' => $hero_next_icon,
        ]
    );

    if (!empty($display_news)) {
        get_template_part(
            'resources/views/sections/news',
            null,
            [
                'heading' => [
                    'title' => $news['title'] ?? '',
                    'subtitle' => $news['subtitle'] ?? '',
                    'cta' => $news['cta'] ?? [],
                ],
                'items' => $display_news,
                'is_rtl' => $is_rtl,
                'empty_message' => beit_get_text('no_news'),
            ]
        );
    }

    get_template_part(
        'resources/views/sections/voices',
        null,
        [
            'voices' => $voices,
            'lightbox_id' => 'home-voices-lightbox',
        ]
    );

    get_template_part(
        'resources/views/sections/our-story',
        null,
        [
            'data' => $our_story,
            'content_alignment' => $content_alignment,
        ]
    );

    if (!empty($members['items'])) {
        get_template_part(
            'resources/views/sections/members',
            null,
            [
                'members' => $members,
                'hero_prev_icon' => $hero_prev_icon,
                'hero_next_icon' => $hero_next_icon,
            ]
        );
    }

    // Contact Section
    get_template_part(
        'resources/views/sections/contact-section',
        null,
        [
            'title' => $contact_section['title'] ?? '',
            'subtitle' => $contact_section['subtitle'] ?? '',
            'background_image' => $contact_section['background_image'] ?? '',
            'overlay_color' => $contact_section['overlay_color'] ?? '#1e293b',
            'overlay_opacity' => $contact_section['overlay_opacity'] ?? 85,
        ]
    );
    ?>
</main>