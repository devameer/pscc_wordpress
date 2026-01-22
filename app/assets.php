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

    // Load Font Awesome first to avoid conflicts
    wp_enqueue_style(
        'beit-fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css',
        [],
        '4.7.0'
    );

    // Load custom fonts after Font Awesome
    wp_enqueue_style(
        'beit-fonts',
        BEIT_THEME_URI . '/public/css/fonts.css',
        ['beit-fontawesome'],
        2
    );
    wp_enqueue_style(
        'beit-wp-content',
        BEIT_THEME_URI . '/resources/assets/css/wp-content-styles.css',
        ['beit-fonts'],
        beit_theme_asset_version()
    );
    wp_enqueue_style(
        'beit-base',
        get_stylesheet_uri(),
        ['beit-fonts'],
        beit_theme_asset_version()
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
            'beit-main',
            BEIT_THEME_URI . '/' . $compiled_css . '?v=' . beit_theme_asset_version(),
            ['beit-base'],
            beit_theme_asset_version()
        );

        // Load RTL stylesheet for Arabic language
        if (function_exists('pll_current_language')) {
            $current_lang = pll_current_language('slug');
            if ($current_lang === 'ar' || is_rtl()) {
                $rtl_file = BEIT_THEME_DIR . '/public/css/rtl.css';

                wp_enqueue_style(
                    'beit-rtl',
                    BEIT_THEME_URI . '/public/css/rtl.css?v=' . beit_theme_asset_version(),
                    ['beit-main'],
                    beit_theme_asset_version()
                );
            }
        }
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

    // Pass translations to JavaScript
    wp_localize_script('beit-theme', 'beitStrings', [
        'menu' => beit_translate('Menu'),
    ]);

    // PhotoSwipe CSS
    wp_enqueue_style(
        'photoswipe',
        'https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/photoswipe.css',
        [],
        '5.4.3'
    );

    // PhotoSwipe JS
    wp_enqueue_script(
        'photoswipe',
        'https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe.umd.min.js',
        [],
        '5.4.3',
        true
    );

    wp_enqueue_script(
        'photoswipe-lightbox',
        'https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe-lightbox.umd.min.js',
        ['photoswipe'],
        '5.4.3',
        true
    );

    // PhotoSwipe initialization script
    wp_enqueue_script(
        'photoswipe-init',
        BEIT_THEME_URI . '/resources/assets/js/photoswipe-init.js',
        ['photoswipe', 'photoswipe-lightbox'],
        beit_theme_asset_version(),
        true
    );

    // FSLightbox for videos (PhotoSwipe doesn't support videos well)
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
 * Excludes rtl.css to allow proper cache busting with filemtime.
 */
function beit_remove_script_version($src): string
{
    // Don't remove version from RTL css - we need it for cache busting
    if ($src && strpos($src, 'rtl.css') !== false) {
        return $src;
    }

    if ($src && strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'beit_remove_script_version', 15, 1);
add_filter('style_loader_src', 'beit_remove_script_version', 15, 1);

/**
 * Configure TinyMCE editor for RTL Arabic.
 */
function beit_tinymce_rtl_settings($settings): array
{
    $settings['directionality'] = 'rtl';
    $settings['plugins'] = isset($settings['plugins']) ? $settings['plugins'] . ',directionality' : 'directionality';

    return $settings;
}
add_filter('tiny_mce_before_init', 'beit_tinymce_rtl_settings');

/**
 * Add RTL styles to TinyMCE editor.
 */
function beit_tinymce_rtl_styles($mce_css): string
{
    if (!empty($mce_css)) {
        $mce_css .= ',';
    }
    $mce_css .= BEIT_THEME_URI . '/resources/assets/css/editor-rtl.css';

    return $mce_css;
}
add_filter('mce_css', 'beit_tinymce_rtl_styles');
