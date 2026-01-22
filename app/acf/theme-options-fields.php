<?php

/**
 * ACF options page field definitions.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

// Site Texts Settings removed - now managed via language files in resources/languages/

if (function_exists('acf_add_local_field_group')) {

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
