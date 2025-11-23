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
                'key'   => 'field_contact_google_maps_api_key',
                'label' => __('Google Maps API Key', 'beit'),
                'name'  => 'contact_google_maps_api_key',
                'type'  => 'text',
                'instructions' => __('Enter your Google Maps API key to display the interactive map.', 'beit'),
            ],
            [
                'key'        => 'field_contact_map_default_center',
                'label'      => __('Map Default Center', 'beit'),
                'name'       => 'contact_map_default_center',
                'type'       => 'group',
                'layout'     => 'block',
                'instructions' => __('Set the default center point for the map.', 'beit'),
                'sub_fields' => [
                    [
                        'key'           => 'field_contact_map_default_lat',
                        'label'         => __('Latitude', 'beit'),
                        'name'          => 'latitude',
                        'type'          => 'number',
                        'default_value' => 31.9522,
                        'step'          => 'any',
                    ],
                    [
                        'key'           => 'field_contact_map_default_lng',
                        'label'         => __('Longitude', 'beit'),
                        'name'          => 'longitude',
                        'type'          => 'number',
                        'default_value' => 35.2332,
                        'step'          => 'any',
                    ],
                    [
                        'key'           => 'field_contact_map_default_zoom',
                        'label'         => __('Default Zoom Level', 'beit'),
                        'name'          => 'zoom',
                        'type'          => 'number',
                        'default_value' => 8,
                        'min'           => 1,
                        'max'           => 20,
                    ],
                ],
            ],
            [
                'key'          => 'field_contact_map_offices',
                'label'        => __('Our Offices (Map Locations)', 'beit'),
                'name'         => 'contact_map_offices',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => __('Add Office Location', 'beit'),
                'instructions' => __('Add office locations to display on the map under "Our Offices" tab.', 'beit'),
                'sub_fields'   => [
                    [
                        'key'   => 'field_contact_map_office_name',
                        'label' => __('Office Name', 'beit'),
                        'name'  => 'name',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_contact_map_office_address',
                        'label' => __('Address', 'beit'),
                        'name'  => 'address',
                        'type'  => 'textarea',
                        'rows'  => 2,
                    ],
                    [
                        'key'   => 'field_contact_map_office_lat',
                        'label' => __('Latitude', 'beit'),
                        'name'  => 'latitude',
                        'type'  => 'number',
                        'step'  => 'any',
                        'required' => 1,
                    ],
                    [
                        'key'   => 'field_contact_map_office_lng',
                        'label' => __('Longitude', 'beit'),
                        'name'  => 'longitude',
                        'type'  => 'number',
                        'step'  => 'any',
                        'required' => 1,
                    ],
                ],
            ],
            [
                'key'          => 'field_contact_map_warehouses',
                'label'        => __('Warehouses (Map Locations)', 'beit'),
                'name'         => 'contact_map_warehouses',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => __('Add Warehouse Location', 'beit'),
                'instructions' => __('Add warehouse locations to display on the map under "Warehouses" tab.', 'beit'),
                'sub_fields'   => [
                    [
                        'key'   => 'field_contact_map_warehouse_name',
                        'label' => __('Warehouse Name', 'beit'),
                        'name'  => 'name',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_contact_map_warehouse_address',
                        'label' => __('Address', 'beit'),
                        'name'  => 'address',
                        'type'  => 'textarea',
                        'rows'  => 2,
                    ],
                    [
                        'key'   => 'field_contact_map_warehouse_lat',
                        'label' => __('Latitude', 'beit'),
                        'name'  => 'latitude',
                        'type'  => 'number',
                        'step'  => 'any',
                        'required' => 1,
                    ],
                    [
                        'key'   => 'field_contact_map_warehouse_lng',
                        'label' => __('Longitude', 'beit'),
                        'name'  => 'longitude',
                        'type'  => 'number',
                        'step'  => 'any',
                        'required' => 1,
                    ],
                ],
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
