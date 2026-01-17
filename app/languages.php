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
 * Get site text from theme options.
 *
 * @param string $key The text key (e.g., 'menu', 'search', 'read_more')
 * @param string $default Default value if not set
 * @return string
 */
function beit_get_text(string $key, string $default = ''): string
{
    static $texts = null;

    // Cache texts on first call
    if ($texts === null) {
        $texts = [
            'menu' => get_field('text_menu', 'option') ?: 'القائمة',
            'search' => get_field('text_search', 'option') ?: 'بحث',
            'search_placeholder' => get_field('text_search_placeholder', 'option') ?: 'ابحث عن الأخبار والبرامج والقصص...',
            'read_more' => get_field('text_read_more', 'option') ?: 'اقرأ المزيد',
            'view_all' => get_field('text_view_all', 'option') ?: 'عرض الكل',
            'previous' => get_field('text_previous', 'option') ?: 'السابق',
            'next' => get_field('text_next', 'option') ?: 'التالي',
            'share_thoughts' => get_field('text_share_thoughts', 'option') ?: 'شارك أفكارك هنا',
            'contact_info' => get_field('text_contact_info', 'option') ?: 'معلومات الاتصال',
            'send_message' => get_field('text_send_message', 'option') ?: 'أرسل لنا رسالة',
            'phone' => get_field('text_phone', 'option') ?: 'الهاتف',
            'email' => get_field('text_email', 'option') ?: 'البريد الإلكتروني',
            'address' => get_field('text_address', 'option') ?: 'العنوان',
            'latest_articles' => get_field('text_latest_articles', 'option') ?: 'أحدث المقالات',
            'stay_updated' => get_field('text_stay_updated', 'option') ?: 'ابق على اطلاع بآخر الأخبار',
            'categories' => get_field('text_categories', 'option') ?: 'التصنيفات',
            'recent_news' => get_field('text_recent_news', 'option') ?: 'آخر الأخبار',
            'share_article' => get_field('text_share_article', 'option') ?: 'شارك هذا المقال',
            'share_social' => get_field('text_share_social', 'option') ?: 'شارك على وسائل التواصل الاجتماعي المفضلة لديك',
            'copy_link' => get_field('text_copy_link', 'option') ?: 'نسخ الرابط',
            'copy_failed' => get_field('text_copy_failed', 'option') ?: 'فشل نسخ الرابط',
            'no_news' => get_field('text_no_news', 'option') ?: 'لا توجد أخبار حالياً',
            'check_back' => get_field('text_check_back', 'option') ?: 'تابعنا قريباً لآخر التحديثات',
            'no_media' => get_field('text_no_media', 'option') ?: 'لا توجد وسائط حالياً',
            'check_back_media' => get_field('text_check_back_media', 'option') ?: 'تابعنا قريباً لمزيد من القصص والوسائط',
            'copyright' => get_field('text_copyright', 'option') ?: '© %1$s %2$s. جميع الحقوق محفوظة.',
        ];
    }

    return $texts[$key] ?? $default;
}
