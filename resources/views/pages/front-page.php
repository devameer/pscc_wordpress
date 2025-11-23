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

$hero_defaults        = beit_front_default_hero();
$initiatives_defaults = beit_front_default_initiatives();
$news_defaults        = beit_front_default_news();
$facts_defaults       = beit_front_default_facts();
$partners_defaults    = beit_front_default_partners();
$voices_defaults      = beit_front_default_voices();
$our_story_defaults   = beit_front_default_our_story();

$has_acf = function_exists('get_field');
$is_rtl  = is_rtl();

$content_alignment     = $is_rtl ? 'md:text-right' : 'md:text-left';
$video_button_position = $is_rtl ? 'bottom-16 left-12' : 'bottom-16 right-12';
$hero_prev_icon        = $is_rtl ? 'fa fa-angle-right' : 'fa fa-angle-left';
$hero_next_icon        = $is_rtl ? 'fa fa-angle-left' : 'fa fa-angle-right';

$hero_settings = [
    'autoplay'        => $hero_defaults['autoplay'],
    'loop'            => $hero_defaults['loop'],
    'show_navigation' => $hero_defaults['show_navigation'],
    'show_pagination' => $hero_defaults['show_pagination'],
];

$hero_slides = [];

$hero_query = new WP_Query(
    [
        'post_type'      => 'beit_hero_slide',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => [
            'menu_order' => 'ASC',
            'date'       => 'DESC',
        ],
    ]
);

if ($hero_query->have_posts()) {
    while ($hero_query->have_posts()) {
        $hero_query->the_post();

        $slide_id = get_the_ID();
        $title = $has_acf ? (string) get_field('hero_slide_title', $slide_id) : '';
        $description = $has_acf ? (string) get_field('hero_slide_description', $slide_id) : '';
        $background_image = get_the_post_thumbnail_url($slide_id, 'full') ?: '';
        $video_url = $has_acf ? (string) get_field('hero_slide_video_url', $slide_id) : '';
        $primary_button_field = $has_acf ? get_field('hero_slide_primary_button', $slide_id) : null;
        $secondary_button_field = $has_acf ? get_field('hero_slide_secondary_button', $slide_id) : null;

        $primary_button = is_array($primary_button_field) ? $primary_button_field : [];
        $secondary_button = is_array($secondary_button_field) ? $secondary_button_field : [];

        if ('' === $description) {
            $description = has_excerpt($slide_id) ? get_the_excerpt() : wp_strip_all_tags(get_the_content(null, false, $slide_id));
        }

        $hero_slides[] = [
            'title'     => $title,

            'description'      => $description,
            'background_image' => $background_image,
            'video_url'        => $video_url,
            'primary_button'   => $primary_button,
            'secondary_button' => $secondary_button,
        ];
    }

    wp_reset_postdata();
}

if (empty($hero_slides)) {
    $hero_slides = $hero_defaults['slides'];
}

$initiatives = $initiatives_defaults;
$initiatives_field = $has_acf ? get_field('front_initiatives') : null;
if (is_array($initiatives_field)) {
    $initiatives = array_merge($initiatives, array_filter($initiatives_field));
    if (!empty($initiatives_field['items']) && is_array($initiatives_field['items'])) {
        $initiatives['items'] = $initiatives_field['items'];
    }
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
            'post_type'      => 'beit_news',
            'posts_per_page' => 3,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]
    );

    if ($news_query->have_posts()) {
        while ($news_query->have_posts()) {
            $news_query->the_post();

            $news_posts[] = [
                'title'   => get_the_title(),
                'excerpt' => get_the_excerpt(),
                'image'   => get_post_thumbnail_id(get_the_ID()),
                'link'    => get_permalink(),
            ];
        }

        wp_reset_postdata();
    }

    $archive_link = get_post_type_archive_link('beit_news');
    if (!empty($archive_link)) {
        $news['cta']['url'] = $archive_link;
    }
}

$facts = $facts_defaults;
$facts_field = $has_acf ? get_field('front_facts') : null;
if (is_array($facts_field)) {
    $facts = array_merge($facts, array_filter($facts_field));
    if (!empty($facts_field['filters']) && is_array($facts_field['filters'])) {
        $facts['filters'] = $facts_field['filters'];
    }
    if (!empty($facts_field['items']) && is_array($facts_field['items'])) {
        $facts['items'] = $facts_field['items'];
    }
    if (!empty($facts_field['background_image'])) {
        $facts['background_image'] = $facts_field['background_image'];
    }
}

$partners = $partners_defaults;
$partners_field = $has_acf ? get_field('front_partners') : null;
if (is_array($partners_field)) {
    $partners = array_merge($partners, array_filter($partners_field));
    if (!empty($partners_field['items']) && is_array($partners_field['items'])) {
        $partners['items'] = $partners_field['items'];
    }
}

$voices = [
    'title'    => $voices_defaults['title'] ?? __('Voices & Visions', 'beit'),
    'subtitle' => $voices_defaults['subtitle'] ?? '',
    'items'    => [],
];

$voices_field = $has_acf ? get_field('front_voices') : null;
if (is_array($voices_field)) {
    $voices = array_merge($voices, array_filter($voices_field));
}

$voices_query = new WP_Query(
    [
        'post_type'      => 'beit_voice',
        'posts_per_page' => 6,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]
);

if ($voices_query->have_posts()) {
    $index = 0;
    while ($voices_query->have_posts()) {
        $voices_query->the_post();

        $voices['items'][] = [
            'id'      => get_the_ID(),
            'title'   => get_the_title(),
            'excerpt' => get_the_excerpt(),
            'image'   => get_post_thumbnail_id() ?: '',
            'link'    => get_permalink(),
            'span'    => $index === 0 ? 'double' : 'single',
        ];

        $index++;
    }
}

wp_reset_postdata();

$our_story = $our_story_defaults;
$our_story_field = $has_acf ? get_field('front_our_story') : null;
if (is_array($our_story_field)) {
    $our_story = array_merge($our_story, array_filter($our_story_field));
}

$display_news     = $news_posts;

?>

<main class="bg-white text-slate-900">
    <?php
    get_template_part(
        'resources/views/sections/hero',
        null,
        [
            'slides'                => $hero_slides,
            'settings'              => $hero_settings,
            'content_alignment'     => $content_alignment,
            'video_button_position' => $video_button_position,
            'hero_prev_icon'        => $hero_prev_icon,
            'hero_next_icon'        => $hero_next_icon,
        ]
    );

    if (!empty($initiatives['items'])) {
        get_template_part(
            'resources/views/sections/initiatives',
            null,
            [
                'data'              => $initiatives,
                'hero_prev_icon'    => $hero_prev_icon,
                'hero_next_icon'    => $hero_next_icon,
            ]
        );
    }

    get_template_part(
        'resources/views/sections/news',
        null,
        [
            'heading' => [
                'title'    => $news['title'] ?? '',
                'subtitle' => $news['subtitle'] ?? '',
                'cta'      => $news['cta'] ?? [],
            ],
            'items'          => $display_news,
            'is_rtl'         => $is_rtl,
            'empty_message'  => __('No news items found yet. Check back soon for updates.', 'beit'),
        ]
    );

    if (!empty($voices['items'])) {
        get_template_part(
            'resources/views/sections/voices',
            null,
            [
                'voices'      => $voices,
                'lightbox_id' => 'home-voices-lightbox',
            ]
        );
    }

    get_template_part(
        'resources/views/sections/our-story',
        null,
        [
            'data'              => $our_story,
            'content_alignment' => $content_alignment,
        ]
    );

    if (!empty($facts['items'])) {
        get_template_part(
            'resources/views/sections/facts',
            null,
            [
                'facts' => $facts,
            ]
        );
    }

    if (!empty($partners['items'])) {
        get_template_part(
            'resources/views/sections/partners',
            null,
            [
                'partners'       => $partners,
                'hero_prev_icon' => $hero_prev_icon,
                'hero_next_icon' => $hero_next_icon,
            ]
        );
    }
    ?>
</main>