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
        'key' => 'group_page_contact_details',
        'title' => __('Contact Page Settings', 'beit'),
        'fields' => [
            [
                'key' => 'field_contact_hero',
                'label' => __('Hero Area', 'beit'),
                'name' => 'contact_hero',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_contact_hero_custom_title',
                        'label' => __('Custom Hero Title', 'beit'),
                        'name' => 'custom_title',
                        'type' => 'text',
                        'instructions' => __('Optional custom title for hero section. If left empty, the page title will be used.', 'beit'),
                    ],
                ],
            ],
            [
                'key' => 'field_contact_offices',
                'label' => __('Office Locations', 'beit'),
                'name' => 'contact_offices',
                'type' => 'repeater',
                'layout' => 'row',
                'button_label' => __('Add office', 'beit'),
                'instructions' => __('Additional office locations for "Our Offices" section.', 'beit'),
                'sub_fields' => [
                    [
                        'key' => 'field_contact_office_name',
                        'label' => __('Office Name', 'beit'),
                        'name' => 'name',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_contact_office_address',
                        'label' => __('Address', 'beit'),
                        'name' => 'address',
                        'type' => 'textarea',
                        'rows' => 2,
                    ],
                    [
                        'key' => 'field_contact_office_map',
                        'label' => __('Map Link', 'beit'),
                        'name' => 'map_link',
                        'type' => 'url',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-contact.php',
                ],
            ],
        ],
    ]
);
