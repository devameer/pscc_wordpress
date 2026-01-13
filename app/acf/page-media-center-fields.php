<?php

/**
 * Local ACF field definitions for the media center page template.
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
        'key' => 'group_page_media_center_hero',
        'title' => __('Media Center Page Settings', 'beit'),
        'fields' => [
            [
                'key' => 'field_media_center_hero',
                'label' => __('Hero Section', 'beit'),
                'name' => 'media_center_hero',
                'type' => 'group',
                'layout' => 'row',
                'sub_fields' => [
                    [
                        'key' => 'field_media_center_hero_custom_title',
                        'label' => __('Custom Hero Title', 'beit'),
                        'name' => 'custom_title',
                        'type' => 'text',
                        'instructions' => __('Optional custom title for hero section. If left empty, the page title will be used.', 'beit'),
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-media-center.php',
                ],
            ],
        ],
    ]
);
