<?php

/**
 * Local ACF field definitions for the contact page template.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('acf_add_local_field_group')) {
    return;
}

acf_add_local_field_group(
    [
        'key'    => 'group_page_contact_details',
        'title'  => __('Contact Page Settings', 'beit'),
        'fields' => [
            [
                'key'        => 'field_contact_hero',
                'label'      => __('Hero Area', 'beit'),
                'name'       => 'contact_hero',
                'type'       => 'group',
                'layout'     => 'block',
                'sub_fields' => [
                    [
                        'key'   => 'field_contact_hero_subtitle',
                        'label' => __('Hero Subtitle', 'beit'),
                        'name'  => 'subtitle',
                        'type'  => 'text',
                    ],
                    [
                        'key'           => 'field_contact_hero_background',
                        'label'         => __('Background Image', 'beit'),
                        'name'          => 'background',
                        'type'          => 'image',
                        'return_format' => 'url',
                        'preview_size'  => 'large',
                        'library'       => 'all',
                        'instructions'  => __('Optional hero background image. A gradient overlay will be applied automatically.', 'beit'),
                    ],
                ],
            ],
            [
                'key'        => 'field_contact_details',
                'label'      => __('Main Contact Details', 'beit'),
                'name'       => 'contact_details',
                'type'       => 'group',
                'layout'     => 'block',
                'sub_fields' => [
                    [
                        'key'   => 'field_contact_details_email',
                        'label' => __('Email', 'beit'),
                        'name'  => 'email',
                        'type'  => 'email',
                    ],
                    [
                        'key'   => 'field_contact_details_phone',
                        'label' => __('Phone', 'beit'),
                        'name'  => 'phone',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_contact_details_address',
                        'label' => __('Address', 'beit'),
                        'name'  => 'address',
                        'type'  => 'textarea',
                        'rows'  => 2,
                    ],
                    [
                        'key'   => 'field_contact_details_hours',
                        'label' => __('Working Hours', 'beit'),
                        'name'  => 'hours',
                        'type'  => 'textarea',
                        'rows'  => 2,
                    ],
                ],
            ],
            [
                'key'          => 'field_contact_social_links',
                'label'        => __('Social Links', 'beit'),
                'name'         => 'contact_social_links',
                'type'         => 'repeater',
                'layout'       => 'row',
                'button_label' => __('Add social link', 'beit'),
                'sub_fields'   => [
                    [
                        'key'   => 'field_contact_social_icon',
                        'label' => __('Icon class', 'beit'),
                        'name'  => 'icon',
                        'type'  => 'text',
                        'instructions' => __('Font Awesome class, e.g. "fa-brands fa-facebook".', 'beit'),
                    ],
                    [
                        'key'   => 'field_contact_social_url',
                        'label' => __('Profile URL', 'beit'),
                        'name'  => 'url',
                        'type'  => 'url',
                    ],
                ],
            ],
            [
                'key'          => 'field_contact_offices',
                'label'        => __('Office Locations', 'beit'),
                'name'         => 'contact_offices',
                'type'         => 'repeater',
                'layout'       => 'row',
                'button_label' => __('Add office', 'beit'),
                'sub_fields'   => [
                    [
                        'key'   => 'field_contact_office_name',
                        'label' => __('Office Name', 'beit'),
                        'name'  => 'name',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_contact_office_address',
                        'label' => __('Address', 'beit'),
                        'name'  => 'address',
                        'type'  => 'textarea',
                        'rows'  => 2,
                    ],
                    [
                        'key'   => 'field_contact_office_map',
                        'label' => __('Map Link', 'beit'),
                        'name'  => 'map_link',
                        'type'  => 'url',
                    ],
                ],
            ],
            [
                'key'   => 'field_contact_map_embed',
                'label' => __('Map Embed Code', 'beit'),
                'name'  => 'contact_map_embed',
                'type'  => 'textarea',
                'rows'  => 5,
                'instructions' => __('Paste an iframe embed code from Google Maps or similar service.', 'beit'),
            ],
            [
                'key'   => 'field_contact_form_shortcode',
                'label' => __('Contact Form Shortcode', 'beit'),
                'name'  => 'contact_form_shortcode',
                'type'  => 'text',
                'instructions' => __('Paste a form shortcode (e.g., from Contact Form 7). If empty, a static form will display.', 'beit'),
            ],

        ],
        'location' => [
            [
                [
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-contact.php',
                ],
            ],
        ],
    ]
);
