<?php

/**
 * Theme setup hooks.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Initialize theme defaults and register support for WordPress features.
 */
function beit_theme_setup(): void
{
    load_theme_textdomain('beit', BEIT_THEME_DIR . '/resources/languages');

    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_editor_style('public/css/app.css');

    register_nav_menus(
        [
            'primary' => __('Primary Menu', 'beit'),
            'footer'  => __('Footer Menu', 'beit'),
        ]
    );

    add_theme_support(
        'html5',
        [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style',
        ]
    );

    add_theme_support(
        'custom-logo',
        [
            'height'      => 80,
            'width'       => 240,
            'flex-height' => true,
            'flex-width'  => true,
        ]
    );

    add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'beit_theme_setup');
