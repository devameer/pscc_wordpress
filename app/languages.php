<?php

/**
 * Language and RTL/LTR support with Polylang.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Polylang support and RTL/LTR functionality.
 */
function beit_polylang_setup(): void
{
    // Add RTL support
    if (function_exists('pll_current_language')) {
        $current_lang = pll_current_language('slug');

        // Add dir attribute to html tag
        add_filter('language_attributes', 'beit_language_attributes');

        // Add body class for language
        add_filter('body_class', 'beit_language_body_class');
    }
}
add_action('after_setup_theme', 'beit_polylang_setup');

/**
 * Add dir attribute to html tag based on language.
 */
function beit_language_attributes($output): string
{
    if (function_exists('pll_current_language')) {
        $current_lang = pll_current_language('slug');

        // Add RTL for Arabic
        if ($current_lang === 'ar') {
            $output .= ' dir="rtl"';
        } else {
            $output .= ' dir="ltr"';
        }
    }

    return $output;
}

/**
 * Add language class to body.
 */
function beit_language_body_class($classes): array
{
    if (function_exists('pll_current_language')) {
        $current_lang = pll_current_language('slug');
        $classes[] = 'lang-' . $current_lang;

        if ($current_lang === 'ar') {
            $classes[] = 'rtl';
        } else {
            $classes[] = 'ltr';
        }
    }

    return $classes;
}

// RTL styles are now loaded from assets.php

/**
 * Register Polylang strings for translation.
 */
function beit_register_polylang_strings(): void
{
    if (function_exists('pll_register_string')) {
        // Register common strings
        pll_register_string('search_label', 'Search', 'beit');
        pll_register_string('donate_label', 'Donate', 'beit');
        pll_register_string('read_more', 'Read More', 'beit');
        pll_register_string('latest_news', 'Latest News', 'beit');
        pll_register_string('view_all', 'View All', 'beit');
        pll_register_string('contact_us', 'Contact Us', 'beit');
        pll_register_string('faqs', 'FAQs', 'beit');

        // Register hero section strings
        pll_register_string('or', 'OR', 'beit');
        pll_register_string('watch', 'Watch', 'beit');
        pll_register_string('the_story', 'the story', 'beit');

        // Register single news page strings
        pll_register_string('share_this_article', 'Share this article', 'beit');
        pll_register_string('share_on_social_media', 'Share on your favorite social media', 'beit');
        pll_register_string('copy_link', 'Copy link', 'beit');
        pll_register_string('failed_to_copy_link', 'Failed to copy link', 'beit');
        pll_register_string('previous', 'Previous', 'beit');
        pll_register_string('next', 'Next', 'beit');
        pll_register_string('latest_articles', 'Latest Articles', 'beit');
        pll_register_string('stay_updated_recent_news', 'Stay updated with our recent news', 'beit');
        pll_register_string('categories', 'Categories', 'beit');
        pll_register_string('recent_news', 'Recent News', 'beit');

        // Register media library strings
        pll_register_string('photo_gallery', 'Photo Gallery', 'beit');
        pll_register_string('video_gallery', 'Video Gallery', 'beit');
        pll_register_string('photos_count', '%d photos available', 'beit');
        pll_register_string('videos_count', '%d videos available', 'beit');
        pll_register_string('no_photos_found', 'No photos found', 'beit');
        pll_register_string('no_videos_found', 'No videos found', 'beit');
        pll_register_string('check_back_photos', 'Please check back soon for new photos.', 'beit');
        pll_register_string('check_back_videos', 'Please check back soon for new videos.', 'beit');
        pll_register_string('watch_video', 'Watch Video', 'beit');
    }
}
add_action('init', 'beit_register_polylang_strings');

/**
 * Get translated string from Polylang.
 */
function beit_translate($string, $name = null): string
{
    if (function_exists('pll__')) {
        return pll__($string);
    }

    return __($string, 'beit');
}

/**
 * Get language switcher HTML.
 */
function beit_get_language_switcher($args = []): string
{
    if (!function_exists('pll_the_languages')) {
        return '';
    }

    $defaults = [
        'dropdown' => 0,
        'show_names' => 1,
        'show_flags' => 0,
        'hide_if_empty' => 1,
        'force_home' => 0,
        'echo' => 0,
        'hide_if_no_translation' => 0,
        'display_names_as' => 'name', // 'name' or 'slug'
    ];

    $args = wp_parse_args($args, $defaults);

    return pll_the_languages($args);
}

/**
 * Get current language info.
 */
function beit_get_current_language(): array
{
    if (!function_exists('pll_current_language')) {
        return [
            'slug' => 'en',
            'name' => 'English',
            'locale' => 'en_US',
            'is_rtl' => false,
        ];
    }

    $slug = pll_current_language('slug');
    $name = pll_current_language('name');
    $locale = pll_current_language('locale');

    return [
        'slug' => $slug,
        'name' => $name,
        'locale' => $locale,
        'is_rtl' => ($slug === 'ar'),
    ];
}

/**
 * Get all available languages.
 */
function beit_get_languages(): array
{
    if (!function_exists('pll_the_languages')) {
        return [];
    }

    $languages = pll_the_languages([
        'raw' => 1,
        'echo' => 0,
    ]);

    return is_array($languages) ? $languages : [];
}

/**
 * Enable Polylang support for custom post types.
 */
function beit_polylang_post_types($post_types, $is_settings)
{
    if ($is_settings) {
        // Remove the default post types and add only ours
        unset($post_types['post']);
        unset($post_types['page']);
    }

    // Add custom post types
    $post_types['beit_hero_slide'] = 'beit_hero_slide';
    $post_types['beit_news'] = 'beit_news';
    $post_types['beit_program'] = 'beit_program';

    return $post_types;
}
add_filter('pll_get_post_types', 'beit_polylang_post_types', 10, 2);
