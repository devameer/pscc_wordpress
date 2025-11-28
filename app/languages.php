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

/**
 * Enqueue RTL stylesheet for Arabic.
 */
function beit_enqueue_rtl_styles(): void
{
    if (function_exists('pll_current_language')) {
        $current_lang = pll_current_language('slug');

        if ($current_lang === 'ar' || is_rtl()) {
            wp_enqueue_style(
                'beit-rtl',
                BEIT_THEME_URI . '/public/css/rtl.css',
                ['beit-main'],
                BEIT_THEME_VERSION
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'beit_enqueue_rtl_styles', 20);

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
        'dropdown'               => 0,
        'show_names'             => 1,
        'show_flags'             => 0,
        'hide_if_empty'          => 1,
        'force_home'             => 0,
        'echo'                   => 0,
        'hide_if_no_translation' => 0,
        'display_names_as'       => 'name', // 'name' or 'slug'
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
