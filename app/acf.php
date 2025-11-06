<?php

/**
 * Advanced Custom Fields helpers.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register global options pages once ACF is ready.
 */
function beit_acf_register_options_pages(): void
{
    if (!function_exists('acf_add_options_page')) {
        return;
    }

    acf_add_options_page(
        [
            'page_title' => __('Theme Settings', 'beit'),
            'menu_title' => __('Theme Settings', 'beit'),
            'menu_slug'  => 'beit-theme-settings',
            'capability' => 'manage_options',
            'redirect'   => false,
            'position'   => 61,
            'icon_url'   => 'dashicons-admin-generic',
        ]
    );
}
add_action('acf/init', 'beit_acf_register_options_pages');

/**
 * Configure local JSON storage for field groups.
 *
 * Using local JSON keeps field definitions within the theme for version control.
 */
function beit_acf_json_save_path(string $path): string
{
    $custom_path = BEIT_THEME_DIR . '/resources/acf-json';

    if (!file_exists($custom_path)) {
        wp_mkdir_p($custom_path);
    }

    return $custom_path;
}
add_filter('acf/settings/save_json', 'beit_acf_json_save_path');

/**
 * Include local JSON files when loading field groups.
 */
function beit_acf_json_load_paths(array $paths): array
{
    $paths[] = BEIT_THEME_DIR . '/resources/acf-json';

    return $paths;
}
add_filter('acf/settings/load_json', 'beit_acf_json_load_paths');

$acf_field_files = [
    BEIT_THEME_DIR . '/app/acf/theme-options-fields.php',
    BEIT_THEME_DIR . '/app/acf/hero-slide-fields.php',
    BEIT_THEME_DIR . '/app/acf/front-page-fields.php',
];

foreach ($acf_field_files as $acf_field_file) {
    if (file_exists($acf_field_file)) {
        require_once $acf_field_file;
    }
}
