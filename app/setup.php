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

/**
 * Modify search query to include post type filter.
 */
function beit_modify_search_query($query): void
{
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $post_type_filter = isset($_GET['post_type']) ? sanitize_text_field($_GET['post_type']) : '';

        if ($post_type_filter && post_type_exists($post_type_filter)) {
            $query->set('post_type', $post_type_filter);
        }
    }
}
add_action('pre_get_posts', 'beit_modify_search_query');

/**
 * Add loading="lazy" attribute to all WordPress images.
 */
function beit_add_lazy_loading_to_images($attr, $attachment, $size): array
{
    // Skip for hero/featured images above the fold
    if (isset($attr['class']) && (
        strpos($attr['class'], 'no-lazy') !== false ||
        strpos($attr['class'], 'skip-lazy') !== false
    )) {
        return $attr;
    }

    $attr['loading'] = 'lazy';
    $attr['decoding'] = 'async';

    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'beit_add_lazy_loading_to_images', 10, 3);

/**
 * Add fetchpriority="high" to featured images above the fold.
 */
function beit_add_fetchpriority_to_hero_images($attr, $attachment, $size): array
{
    if (isset($attr['class']) && strpos($attr['class'], 'hero-image') !== false) {
        $attr['fetchpriority'] = 'high';
        $attr['loading'] = 'eager';
        unset($attr['loading']); // Remove lazy loading for hero images
    }

    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'beit_add_fetchpriority_to_hero_images', 5, 3);

/**
 * Add width and height attributes to images for better CLS.
 */
function beit_add_image_dimensions($attr, $attachment, $size): array
{
    if (!isset($attr['width']) || !isset($attr['height'])) {
        $image_meta = wp_get_attachment_metadata($attachment->ID);

        if (is_array($size)) {
            $attr['width'] = $size[0];
            $attr['height'] = $size[1];
        } elseif (isset($image_meta['sizes'][$size])) {
            $attr['width'] = $image_meta['sizes'][$size]['width'];
            $attr['height'] = $image_meta['sizes'][$size]['height'];
        } elseif (isset($image_meta['width']) && isset($image_meta['height'])) {
            $attr['width'] = $image_meta['width'];
            $attr['height'] = $image_meta['height'];
        }
    }

    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'beit_add_image_dimensions', 10, 3);

/**
 * Remove unnecessary WordPress head bloat for better performance.
 */
function beit_remove_head_bloat(): void
{
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    remove_action('wp_head', 'feed_links_extra', 3);
}
add_action('init', 'beit_remove_head_bloat');

/**
 * Optimize WordPress database queries by limiting post revisions.
 */
if (!defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', 3);
}

/**
 * Defer parsing of JavaScript files to improve page load time.
 */
function beit_add_defer_attribute($tag, $handle): string
{
    if (is_admin()) {
        return $tag;
    }

    // Don't defer jQuery as many scripts depend on it
    if ('jquery' === $handle || 'jquery-core' === $handle || 'jquery-migrate' === $handle) {
        return $tag;
    }

    // Add defer to all other scripts
    return str_replace(' src', ' defer src', $tag);
}
// Uncomment the line below if you want to defer ALL scripts (may break some plugins)
// add_filter('script_loader_tag', 'beit_add_defer_attribute', 10, 2);

/**
 * Enable Gzip compression for better performance.
 */
function beit_enable_gzip_compression(): void
{
    if (!headers_sent() && extension_loaded('zlib') && !ini_get('zlib.output_compression')) {
        if (strpos($_SERVER['HTTP_ACCEPT_ENCODING'] ?? '', 'gzip') !== false) {
            ini_set('zlib.output_compression', 'On');
            ini_set('zlib.output_compression_level', '6');
        }
    }
}
add_action('init', 'beit_enable_gzip_compression', 1);

/**
 * Disable WordPress heartbeat API on frontend to reduce server load.
 */
function beit_disable_heartbeat(): void
{
    if (!is_admin()) {
        wp_deregister_script('heartbeat');
    }
}
add_action('init', 'beit_disable_heartbeat', 1);

/**
 * Add browser caching headers for static assets.
 */
function beit_add_cache_headers(): void
{
    if (!is_admin() && !is_user_logged_in()) {
        header('Cache-Control: public, max-age=31536000');
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
    }
}
// Uncomment the line below to enable browser caching
// add_action('send_headers', 'beit_add_cache_headers');
