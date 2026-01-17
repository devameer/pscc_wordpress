<?php

/**
 * Site texts and RTL support.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get default texts.
 *
 * @return array
 */
function beit_get_default_texts(): array
{
    return [
        'menu' => 'القائمة',
        'search' => 'بحث',
        'search_placeholder' => 'ابحث عن الأخبار والبرامج والقصص...',
        'read_more' => 'اقرأ المزيد',
        'view_all' => 'عرض الكل',
        'previous' => 'السابق',
        'next' => 'التالي',
        'share_thoughts' => 'شارك أفكارك هنا',
        'contact_info' => 'معلومات الاتصال',
        'send_message' => 'أرسل لنا رسالة',
        'phone' => 'الهاتف',
        'email' => 'البريد الإلكتروني',
        'address' => 'العنوان',
        'latest_articles' => 'أحدث المقالات',
        'stay_updated' => 'ابق على اطلاع بآخر الأخبار',
        'categories' => 'التصنيفات',
        'recent_news' => 'آخر الأخبار',
        'share_article' => 'شارك هذا المقال',
        'share_social' => 'شارك على وسائل التواصل الاجتماعي المفضلة لديك',
        'copy_link' => 'نسخ الرابط',
        'copy_failed' => 'فشل نسخ الرابط',
        'no_news' => 'لا توجد أخبار حالياً',
        'check_back' => 'تابعنا قريباً لآخر التحديثات',
        'no_media' => 'لا توجد وسائط حالياً',
        'check_back_media' => 'تابعنا قريباً لمزيد من القصص والوسائط',
        'copyright' => '© %1$s %2$s. جميع الحقوق محفوظة.',
    ];
}

/**
 * Get site text from theme options.
 *
 * @param string $key The text key (e.g., 'menu', 'search', 'read_more')
 * @param string $default Default value if not set
 * @return string
 */
function beit_get_text(string $key, string $default = ''): string
{
    static $texts = null;

    $defaults = beit_get_default_texts();

    // Return default if called too early or ACF not available
    if (!function_exists('get_field') || !did_action('init')) {
        return $defaults[$key] ?? $default;
    }

    // Cache texts on first call after init
    if ($texts === null) {
        $texts = [];
        foreach ($defaults as $text_key => $text_default) {
            $field_value = get_field('text_' . $text_key, 'option');
            $texts[$text_key] = $field_value ?: $text_default;
        }
    }

    return $texts[$key] ?? $default;
}
