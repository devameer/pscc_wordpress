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
function beit_flush_rewrite_rules() {
    beit_register_post_types();
    flush_rewrite_rules();
}

add_filter('language_attributes', function ($output) {
    if (is_admin()) {
        // إزالة أي dir="rtl"
        $output = preg_replace('/dir=("|\')rtl("|\')/i', '', $output);
        // إضافة dir="ltr"
        if (strpos($output, 'dir=') === false) {
            $output .= ' dir="ltr"';
        }
    }

    return $output;
});

// إزالة كلاسات Polylang من body في لوحة الإدارة فقط
add_filter('admin_body_class', function ($classes) {
    // إزالة الكلاسات التي تبدأ بـ pll-lang
    $classes = preg_replace('/\bpll-lang-\S+\b/', '', $classes);
    return trim($classes);
}, 999);