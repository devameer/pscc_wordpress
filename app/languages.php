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
        pll_register_string('menu', 'Menu', 'beit');

        // Register hero section strings
        pll_register_string('or', 'OR', 'beit');
        pll_register_string('watch', 'Watch', 'beit');
        pll_register_string('the_story', 'the story', 'beit');
        pll_register_string('see_the_change', 'See the change', 'beit');

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
        pll_register_string('recent_programs', 'Recent Programs', 'beit');

        // Register media library strings
        pll_register_string('photo_gallery', 'Photo Gallery', 'beit');
        pll_register_string('video_gallery', 'Video Gallery', 'beit');
        pll_register_string('photos_count', '%d photos available', 'beit');
        pll_register_string('videos_count', '%d videos available', 'beit');
        pll_register_string('watch_video', 'Watch Video', 'beit');

        // Empty state messages (unified)
        pll_register_string('no_items_found', 'No items found', 'beit');
        pll_register_string('no_news_found', 'No news items found', 'beit');
        pll_register_string('no_photos_found', 'No photos found', 'beit');
        pll_register_string('no_videos_found', 'No videos found', 'beit');
        pll_register_string('no_media_found', 'No media items found', 'beit');
        pll_register_string('no_programs_found', 'No programs found. Please add some via the dashboard.', 'beit');
        pll_register_string('check_back_soon', 'Check back soon for the latest updates.', 'beit');
        pll_register_string('check_back_photos', 'Please check back soon for new photos.', 'beit');
        pll_register_string('check_back_videos', 'Please check back soon for new videos.', 'beit');
        pll_register_string('check_back_media', 'Please check back soon for new stories and media highlights.', 'beit');

        // Contact page strings
        pll_register_string('share_your_thoughts', 'Share Your Thoughts Here', 'beit');
        pll_register_string('our_offices', 'Our Offices', 'beit');
        pll_register_string('warehouses', 'Warehouses', 'beit');

        // Footer strings
        pll_register_string('copyright_text', '© %1$s %2$s. All rights reserved.', 'beit');

        // Annual Reports and Publications strings
        pll_register_string('year_label', 'Year', 'beit');
        pll_register_string('download_report', 'Download Report', 'beit');
        pll_register_string('download_publication', 'Download Publication', 'beit');
        pll_register_string('no_annual_reports_found', 'No Annual Reports Found', 'beit');
        pll_register_string('no_publications_found', 'No Publications Found', 'beit');
        pll_register_string('check_back_reports', 'Check back soon for the latest reports.', 'beit');
        pll_register_string('check_back_publications', 'Check back soon for the latest publications.', 'beit');
        pll_register_string('reports_pagination', 'Reports pagination', 'beit');
        pll_register_string('publications_pagination', 'Publications pagination', 'beit');
        pll_register_string('no_reports_dashboard', 'No annual reports found. Please add some via the dashboard.', 'beit');
        pll_register_string('no_publications_dashboard', 'No publications found. Please add some via the dashboard.', 'beit');

        // Search page strings
        pll_register_string('search', 'Search', 'beit');
        pll_register_string('search_results_for', 'Search Results for: %s', 'beit');
        pll_register_string('result_found_singular', '%d result found', 'beit');
        pll_register_string('results_found_plural', '%d results found', 'beit');
        pll_register_string('find_what_looking_for', 'Find what you\'re looking for', 'beit');
        pll_register_string('filter_by', 'Filter by:', 'beit');
        pll_register_string('all', 'All', 'beit');
        pll_register_string('posts', 'Posts', 'beit');
        pll_register_string('pages', 'Pages', 'beit');
        pll_register_string('news', 'News', 'beit');
        pll_register_string('media', 'Media', 'beit');
        pll_register_string('programs_projects', 'Programs & Projects', 'beit');
        pll_register_string('annual_reports', 'Annual Reports', 'beit');
        pll_register_string('publications', 'Publications', 'beit');
        pll_register_string('annual_report', 'Annual Report', 'beit');
        pll_register_string('publication', 'Publication', 'beit');
        pll_register_string('view_details', 'View Details', 'beit');
        pll_register_string('no_results_found', 'No Results Found', 'beit');
        pll_register_string('no_results_message', 'Sorry, we couldn\'t find any results for "%s". Please try again with different keywords.', 'beit');
        pll_register_string('enter_search_term', 'Please enter a search term to find content.', 'beit');
        pll_register_string('search_tips', 'Search Tips:', 'beit');
        pll_register_string('check_spelling', 'Check your spelling', 'beit');
        pll_register_string('try_different_keywords', 'Try different keywords', 'beit');
        pll_register_string('use_general_terms', 'Use more general terms', 'beit');
        pll_register_string('browse_main_sections', 'Browse our main sections', 'beit');
        pll_register_string('add_featured_image', 'Add a featured image to display here.', 'beit');
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
    $post_types['beit_annual_report'] = 'beit_annual_report';
    $post_types['beit_publication'] = 'beit_publication';

    return $post_types;
}
add_filter('pll_get_post_types', 'beit_polylang_post_types', 10, 2);
