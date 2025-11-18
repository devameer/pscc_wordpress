<?php

/**
 * Theme asset registration.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return file modification time for cache busting.
 */
function beit_theme_asset_version(): string
{
    

    return rand(111111, 999999);
}

/**
 * Register front-end assets.
 */
function beit_theme_enqueue_assets(): void
{
    wp_enqueue_style(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        [],
        '11.1.0'
    );

    wp_enqueue_style(
        'beit-fonts',
        BEIT_THEME_URI . '/public/css/fonts.css',
        [],
    []
    );

    wp_enqueue_style(
        'beit-base',
        get_stylesheet_uri(),
        ['beit-fonts'],
        []
    );

    wp_enqueue_style(
        'beit-fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css',
        [],
        '4.7.0'
    );

    wp_enqueue_style(
        'aos',
        'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css',
        [],
        '2.3.4'
    );

    $compiled_css = 'public/css/app.css';
    $compiled_css_path = BEIT_THEME_DIR . '/' . $compiled_css;

    if (file_exists($compiled_css_path)) {
        wp_enqueue_style(
            'beit-app',
            BEIT_THEME_URI . '/' . $compiled_css . '?v=' . beit_theme_asset_version(),
            ['beit-base'],
            beit_theme_asset_version()
        );
    }

    wp_enqueue_script(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        [],
        '11.1.0',
        true
    );

    wp_enqueue_script(
        'beit-theme',
        BEIT_THEME_URI . '/resources/assets/js/theme.js?v=' . beit_theme_asset_version(),
        ['swiper'],
        [],
        true
    );

    wp_enqueue_script(
        'fslightbox',
        'https://cdn.jsdelivr.net/npm/fslightbox/index.js',
        [],
        '3.4.1',
        true
    );

    wp_enqueue_script(
        'aos',
        'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js',
        [],
        '2.3.4',
        true
    );

    wp_add_inline_script(
        'aos',
        'document.addEventListener("DOMContentLoaded", function() { AOS.init({ duration: 800, easing: "ease-in-out", once: true, offset: 50, disable: false }); });'
    );
}
add_action('wp_enqueue_scripts', 'beit_theme_enqueue_assets');

/**
 * Add defer attribute to non-critical scripts for better performance.
 */
function beit_defer_scripts($tag, $handle, $src): string
{
    // List of script handles that should be deferred
    $defer_scripts = [
        'swiper',
        'fslightbox',
        'aos',
        'beit-theme',
    ];

    if (in_array($handle, $defer_scripts, true)) {
        return str_replace(' src', ' defer src', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'beit_defer_scripts', 10, 3);

/**
 * Add preconnect and dns-prefetch for external resources.
 */
function beit_add_resource_hints($urls, $relation_type): array
{
    if ('preconnect' === $relation_type) {
        $urls[] = [
            'href' => 'https://cdn.jsdelivr.net',
            'crossorigin' => 'anonymous',
        ];
        $urls[] = [
            'href' => 'https://cdnjs.cloudflare.com',
            'crossorigin' => 'anonymous',
        ];
        $urls[] = [
            'href' => 'https://fonts.googleapis.com',
        ];
        $urls[] = [
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        ];
    }

    if ('dns-prefetch' === $relation_type) {
        $urls[] = 'https://cdn.jsdelivr.net';
        $urls[] = 'https://cdnjs.cloudflare.com';
        $urls[] = 'https://fonts.googleapis.com';
        $urls[] = 'https://fonts.gstatic.com';
    }

    return $urls;
}
add_filter('wp_resource_hints', 'beit_add_resource_hints', 10, 2);

/**
 * Optimize WordPress emoji scripts and remove unnecessary scripts.
 */
function beit_disable_emojis(): void
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'beit_disable_emojis');

/**
 * Remove query strings from static resources for better caching.
 */
function beit_remove_script_version($src): string
{
    if ($src && strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'beit_remove_script_version', 15, 1);
add_filter('style_loader_src', 'beit_remove_script_version', 15, 1);
