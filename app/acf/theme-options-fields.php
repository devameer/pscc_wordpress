<?php

/**
 * ACF options page field definitions.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

// Site Texts Settings for Theme Options
if (function_exists('acf_add_local_field_group')) {

    // نصوص الموقع
    acf_add_local_field_group([
        'key' => 'group_theme_site_texts',
        'title' => 'نصوص الموقع',
        'fields' => [
            // Tab - General
            [
                'key' => 'field_texts_general_tab',
                'label' => 'نصوص عامة',
                'type' => 'tab',
                'placement' => 'left',
            ],
            [
                'key' => 'field_text_menu',
                'label' => 'القائمة',
                'name' => 'text_menu',
                'type' => 'text',
                'default_value' => 'القائمة',
            ],
            [
                'key' => 'field_text_search',
                'label' => 'بحث',
                'name' => 'text_search',
                'type' => 'text',
                'default_value' => 'بحث',
            ],
            [
                'key' => 'field_text_search_placeholder',
                'label' => 'نص حقل البحث',
                'name' => 'text_search_placeholder',
                'type' => 'text',
                'default_value' => 'ابحث عن الأخبار والبرامج والقصص...',
            ],
            [
                'key' => 'field_text_read_more',
                'label' => 'اقرأ المزيد',
                'name' => 'text_read_more',
                'type' => 'text',
                'default_value' => 'اقرأ المزيد',
            ],
            [
                'key' => 'field_text_view_all',
                'label' => 'عرض الكل',
                'name' => 'text_view_all',
                'type' => 'text',
                'default_value' => 'عرض الكل',
            ],
            [
                'key' => 'field_text_previous',
                'label' => 'السابق',
                'name' => 'text_previous',
                'type' => 'text',
                'default_value' => 'السابق',
            ],
            [
                'key' => 'field_text_next',
                'label' => 'التالي',
                'name' => 'text_next',
                'type' => 'text',
                'default_value' => 'التالي',
            ],

            // Tab - Contact Page
            [
                'key' => 'field_texts_contact_tab',
                'label' => 'صفحة الاتصال',
                'type' => 'tab',
                'placement' => 'left',
            ],
            [
                'key' => 'field_text_share_thoughts',
                'label' => 'شارك أفكارك',
                'name' => 'text_share_thoughts',
                'type' => 'text',
                'default_value' => 'شارك أفكارك هنا',
            ],
            [
                'key' => 'field_text_contact_info',
                'label' => 'معلومات الاتصال',
                'name' => 'text_contact_info',
                'type' => 'text',
                'default_value' => 'معلومات الاتصال',
            ],
            [
                'key' => 'field_text_send_message',
                'label' => 'أرسل رسالة',
                'name' => 'text_send_message',
                'type' => 'text',
                'default_value' => 'أرسل لنا رسالة',
            ],
            [
                'key' => 'field_text_phone',
                'label' => 'الهاتف',
                'name' => 'text_phone',
                'type' => 'text',
                'default_value' => 'الهاتف',
            ],
            [
                'key' => 'field_text_email',
                'label' => 'البريد الإلكتروني',
                'name' => 'text_email',
                'type' => 'text',
                'default_value' => 'البريد الإلكتروني',
            ],
            [
                'key' => 'field_text_address',
                'label' => 'العنوان',
                'name' => 'text_address',
                'type' => 'text',
                'default_value' => 'العنوان',
            ],

            // Tab - News & Articles
            [
                'key' => 'field_texts_news_tab',
                'label' => 'الأخبار والمقالات',
                'type' => 'tab',
                'placement' => 'left',
            ],
            [
                'key' => 'field_text_latest_articles',
                'label' => 'أحدث المقالات',
                'name' => 'text_latest_articles',
                'type' => 'text',
                'default_value' => 'أحدث المقالات',
            ],
            [
                'key' => 'field_text_stay_updated',
                'label' => 'ابق على اطلاع',
                'name' => 'text_stay_updated',
                'type' => 'text',
                'default_value' => 'ابق على اطلاع بآخر الأخبار',
            ],
            [
                'key' => 'field_text_categories',
                'label' => 'التصنيفات',
                'name' => 'text_categories',
                'type' => 'text',
                'default_value' => 'التصنيفات',
            ],
            [
                'key' => 'field_text_recent_news',
                'label' => 'آخر الأخبار',
                'name' => 'text_recent_news',
                'type' => 'text',
                'default_value' => 'آخر الأخبار',
            ],

            // Tab - Share
            [
                'key' => 'field_texts_share_tab',
                'label' => 'المشاركة',
                'type' => 'tab',
                'placement' => 'left',
            ],
            [
                'key' => 'field_text_share_article',
                'label' => 'شارك هذا المقال',
                'name' => 'text_share_article',
                'type' => 'text',
                'default_value' => 'شارك هذا المقال',
            ],
            [
                'key' => 'field_text_share_social',
                'label' => 'شارك على وسائل التواصل',
                'name' => 'text_share_social',
                'type' => 'text',
                'default_value' => 'شارك على وسائل التواصل الاجتماعي المفضلة لديك',
            ],
            [
                'key' => 'field_text_copy_link',
                'label' => 'نسخ الرابط',
                'name' => 'text_copy_link',
                'type' => 'text',
                'default_value' => 'نسخ الرابط',
            ],
            [
                'key' => 'field_text_copy_failed',
                'label' => 'فشل نسخ الرابط',
                'name' => 'text_copy_failed',
                'type' => 'text',
                'default_value' => 'فشل نسخ الرابط',
            ],

            // Tab - Empty States
            [
                'key' => 'field_texts_empty_tab',
                'label' => 'رسائل فارغة',
                'type' => 'tab',
                'placement' => 'left',
            ],
            [
                'key' => 'field_text_no_news',
                'label' => 'لا توجد أخبار',
                'name' => 'text_no_news',
                'type' => 'text',
                'default_value' => 'لا توجد أخبار حالياً',
            ],
            [
                'key' => 'field_text_check_back',
                'label' => 'تابعنا قريباً',
                'name' => 'text_check_back',
                'type' => 'text',
                'default_value' => 'تابعنا قريباً لآخر التحديثات',
            ],
            [
                'key' => 'field_text_no_media',
                'label' => 'لا توجد وسائط',
                'name' => 'text_no_media',
                'type' => 'text',
                'default_value' => 'لا توجد وسائط حالياً',
            ],
            [
                'key' => 'field_text_check_back_media',
                'label' => 'تابعنا للوسائط',
                'name' => 'text_check_back_media',
                'type' => 'text',
                'default_value' => 'تابعنا قريباً لمزيد من القصص والوسائط',
            ],

            // Tab - Footer
            [
                'key' => 'field_texts_footer_tab',
                'label' => 'الفوتر',
                'type' => 'tab',
                'placement' => 'left',
            ],
            [
                'key' => 'field_text_copyright',
                'label' => 'نص حقوق النشر',
                'name' => 'text_copyright',
                'type' => 'text',
                'default_value' => '© %1$s %2$s. جميع الحقوق محفوظة.',
                'instructions' => 'استخدم %1$s للسنة و %2$s لاسم الموقع',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'beit-theme-settings',
                ],
            ],
        ],
        'menu_order' => 5,
    ]);

    // Contact Information & Map Settings for Theme Options
    acf_add_local_field_group([
        'key' => 'group_theme_contact_settings',
        'title' => 'معلومات الاتصال والخريطة',
        'fields' => [
            // Tab - Contact Details
            [
                'key' => 'field_theme_contact_tab',
                'label' => 'معلومات الاتصال',
                'type' => 'tab',
                'placement' => 'left',
            ],
            // Contact Details
            [
                'key' => 'field_theme_contact_details',
                'label' => 'بيانات الاتصال',
                'name' => 'theme_contact_details',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_theme_contact_email',
                        'label' => 'البريد الإلكتروني',
                        'name' => 'email',
                        'type' => 'email',
                    ],
                    [
                        'key' => 'field_theme_contact_phone',
                        'label' => 'رقم الهاتف',
                        'name' => 'phone',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_theme_contact_address',
                        'label' => 'العنوان',
                        'name' => 'address',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                ],
            ],
            // Contact Form Shortcode
            [
                'key' => 'field_theme_contact_form_shortcode',
                'label' => 'كود نموذج الاتصال (Shortcode)',
                'name' => 'theme_contact_form_shortcode',
                'type' => 'text',
                'instructions' => 'أدخل shortcode نموذج الاتصال مثل: [contact-form-7 id="123"]',
                'placeholder' => '[contact-form-7 id="123" title="Contact Form"]',
            ],
            // Tab - Map Settings
            [
                'key' => 'field_theme_map_tab',
                'label' => 'إعدادات الخريطة',
                'type' => 'tab',
                'placement' => 'left',
            ],
            // Google Maps Settings
            [
                'key' => 'field_theme_google_maps_api_key',
                'label' => 'مفتاح Google Maps API',
                'name' => 'theme_google_maps_api_key',
                'type' => 'text',
                'instructions' => 'أدخل مفتاح Google Maps API لعرض الخريطة',
            ],
            [
                'key' => 'field_theme_map_location',
                'label' => 'موقع الخريطة',
                'name' => 'theme_map_location',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_theme_map_location_name',
                        'label' => 'اسم الموقع',
                        'name' => 'name',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_theme_map_location_address',
                        'label' => 'العنوان',
                        'name' => 'address',
                        'type' => 'textarea',
                        'rows' => 2,
                    ],
                    [
                        'key' => 'field_theme_map_location_lat',
                        'label' => 'خط العرض (Latitude)',
                        'name' => 'latitude',
                        'type' => 'text',
                        'instructions' => 'أدخل إحداثية خط العرض',
                        'wrapper' => ['width' => '50'],
                    ],
                    [
                        'key' => 'field_theme_map_location_lng',
                        'label' => 'خط الطول (Longitude)',
                        'name' => 'longitude',
                        'type' => 'text',
                        'instructions' => 'أدخل إحداثية خط الطول',
                        'wrapper' => ['width' => '50'],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'beit-theme-settings',
                ],
            ],
        ],
    ]);
}
