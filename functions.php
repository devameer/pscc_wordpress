<?php

/**
 * Theme bootstrap for Beit.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('BEIT_THEME_VERSION', '1.1.0');
define('BEIT_THEME_DIR', get_template_directory());
define('BEIT_THEME_URI', get_template_directory_uri());

$beit_theme_includes = [
    'app/helpers.php',
    'app/setup.php',
    'app/assets.php',
    'app/widgets.php',
    'app/post-types.php',
    'app/acf.php',
    'app/nav-walker.php',
    'app/languages.php',
    'app/maintenance-mode.php',
    'app/media-library-admin.php',
    'app/admin-columns.php',
];

foreach ($beit_theme_includes as $relative_path) {
    $path = BEIT_THEME_DIR . '/' . $relative_path;

    if (file_exists($path)) {
        require_once $path;
    }
}

// Temporary: Flush rewrite rules on theme activation/update
// Remove this after permalinks are working
add_action('after_switch_theme', 'beit_flush_rewrite_rules');
function beit_flush_rewrite_rules()
{
    beit_register_post_types();
    flush_rewrite_rules();
}

// Set site to RTL Arabic by default
add_filter('language_attributes', function ($output) {
    if (is_admin()) {
        // Keep admin LTR
        $output = preg_replace('/dir=("|\')rtl("|\')/i', '', $output);
        if (strpos($output, 'dir=') === false) {
            $output .= ' dir="ltr"';
        }
    } else {
        // Frontend: Always RTL Arabic
        $output = preg_replace('/dir=("|\')ltr("|\')/i', '', $output);
        if (strpos($output, 'dir=') === false) {
            $output .= ' dir="rtl"';
        }
        // Add Arabic language attribute
        if (strpos($output, 'lang=') === false) {
            $output .= ' lang="ar"';
        } else {
            $output = preg_replace('/lang=("|\')[^"\']*("|\')/', 'lang="ar"', $output);
        }
    }

    return $output;
});

// Force RTL body class on frontend
add_filter('body_class', function ($classes) {
    if (!is_admin()) {
        $classes[] = 'rtl';
    }
    return $classes;
});

add_action('admin_enqueue_scripts', function ($hook) {
    wp_enqueue_style(
        'my-admin-css',
        get_stylesheet_directory_uri() . '/resources/assets/css/admin.css',
        [],
        '2.0'
    );
});