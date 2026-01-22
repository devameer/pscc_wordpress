<?php

/**
 * Site texts and RTL support with Polylang integration.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get current language code.
 *
 * @return string Language code (e.g., 'ar', 'en')
 */
function beit_get_current_language(): string
{
    if (function_exists('pll_current_language')) {
        return pll_current_language('slug') ?: 'ar';
    }
    return 'ar'; // Default to Arabic
}

/**
 * Load language texts from file.
 *
 * @param string $lang Language code
 * @return array
 */
function beit_load_language_file(string $lang): array
{
    $lang_file = get_template_directory() . '/resources/languages/' . $lang . '.php';

    if (file_exists($lang_file)) {
        return include $lang_file;
    }

    // Fallback to Arabic
    $fallback_file = get_template_directory() . '/resources/languages/ar.php';
    if (file_exists($fallback_file)) {
        return include $fallback_file;
    }

    return [];
}

/**
 * Get site text based on current language (Polylang).
 *
 * @param string $key The text key (e.g., 'menu', 'search', 'read_more')
 * @param string $default Default value if not set
 * @return string
 */
function beit_get_text(string $key, string $default = ''): string
{
    static $texts = null;
    static $cached_lang = null;

    // Get current language
    $current_lang = beit_get_current_language();

    // Reload texts if language changed
    if ($cached_lang !== $current_lang) {
        $texts = beit_load_language_file($current_lang);
        $cached_lang = $current_lang;
    }

    return $texts[$key] ?? $default;
}

/**
 * Check if current language is RTL.
 *
 * @return bool
 */
function beit_is_rtl(): bool
{
    $rtl_languages = ['ar', 'he', 'fa', 'ur'];
    return in_array(beit_get_current_language(), $rtl_languages, true);
}

/**
 * Get available languages for language switcher.
 *
 * @return array
 */
function beit_get_languages(): array
{
    if (!function_exists('pll_the_languages')) {
        return [];
    }

    return pll_the_languages([
        'raw' => true,
        'hide_current' => false,
    ]);
}
