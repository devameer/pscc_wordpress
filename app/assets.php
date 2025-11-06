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
function beit_theme_asset_version(string $relative_path): string
{
    $absolute_path = BEIT_THEME_DIR . '/' . ltrim($relative_path, '/');

    if (file_exists($absolute_path)) {
        return (string) filemtime($absolute_path);
    }

    return BEIT_THEME_VERSION;
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
        'beit-base',
        get_stylesheet_uri(),
        [],
        beit_theme_asset_version('style.css')
    );

    wp_enqueue_style(
        'beit-fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        [],
        '6.5.1'
    );

    $compiled_css = 'public/css/app.css';
    $compiled_css_path = BEIT_THEME_DIR . '/' . $compiled_css;

    if (file_exists($compiled_css_path)) {
        wp_enqueue_style(
            'beit-app',
            BEIT_THEME_URI . '/' . $compiled_css,
            ['beit-base'],
            beit_theme_asset_version($compiled_css)
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
        BEIT_THEME_URI . '/resources/assets/js/theme.js',
        ['swiper'],
        beit_theme_asset_version('resources/assets/js/theme.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'beit_theme_enqueue_assets');
