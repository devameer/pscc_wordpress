<?php

/**
 * ACF options page field definitions.
 *
 * NOTE: Theme header settings have been moved to JSON file for better version control
 * and multilingual support. See: resources/acf-json/group_theme_options_multilingual.json
 *
 * This file is kept for reference and any additional custom field groups.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

// Theme header settings are now loaded from JSON file
// See: resources/acf-json/group_theme_options_multilingual.json

// Contact Information & Map Settings for Theme Options
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key'    => 'group_theme_contact_settings',
        'title'  => __('Contact Information & Map', 'beit'),
        'fields' => [
            // Contact Details
            [
                'key'        => 'field_theme_contact_details',
                'label'      => __('Contact Details', 'beit'),
                'name'       => 'theme_contact_details',
                'type'       => 'group',
                'layout'     => 'block',
                'sub_fields' => [
                    [
                        'key'   => 'field_theme_contact_email',
                        'label' => __('Email', 'beit'),
                        'name'  => 'email',
                        'type'  => 'email',
                    ],
                    [
                        'key'   => 'field_theme_contact_phone',
                        'label' => __('Phone', 'beit'),
                        'name'  => 'phone',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_theme_contact_address',
                        'label' => __('Address', 'beit'),
                        'name'  => 'address',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ],
                ],
            ],
            // Google Maps Settings
            [
                'key'   => 'field_theme_google_maps_api_key',
                'label' => __('Google Maps API Key', 'beit'),
                'name'  => 'theme_google_maps_api_key',
                'type'  => 'text',
                'instructions' => __('Enter your Google Maps API Key to display maps.', 'beit'),
            ],
            [
                'key'        => 'field_theme_map_location',
                'label'      => __('Map Location', 'beit'),
                'name'       => 'theme_map_location',
                'type'       => 'group',
                'layout'     => 'block',
                'sub_fields' => [
                    [
                        'key'   => 'field_theme_map_location_name',
                        'label' => __('Location Name', 'beit'),
                        'name'  => 'name',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_theme_map_location_address',
                        'label' => __('Address', 'beit'),
                        'name'  => 'address',
                        'type'  => 'textarea',
                        'rows'  => 2,
                    ],
                    [
                        'key'   => 'field_theme_map_location_lat',
                        'label' => __('Latitude', 'beit'),
                        'name'  => 'latitude',
                        'type'  => 'text',
                        'instructions' => __('Enter the latitude coordinate', 'beit'),
                    ],
                    [
                        'key'   => 'field_theme_map_location_lng',
                        'label' => __('Longitude', 'beit'),
                        'name'  => 'longitude',
                        'type'  => 'text',
                        'instructions' => __('Enter the longitude coordinate', 'beit'),
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'theme-general-settings',
                ],
            ],
        ],
    ]);
}
