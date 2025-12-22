<?php

/**
 * ACF fields for Publications page template.
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
        'key'    => 'group_page_publications',
        'title'  => __('Publications Page Settings', 'beit'),
        'fields' => [
            [
                'key'   => 'field_publications_hero',
                'label' => __('Hero Section', 'beit'),
                'name'  => 'publications_hero',
                'type'  => 'group',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key'   => 'field_publications_hero_custom_title',
                        'label' => __('Custom Title', 'beit'),
                        'name'  => 'custom_title',
                        'type'  => 'text',
                        'instructions' => __('Leave blank to use the page title.', 'beit'),
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-publications.php',
                ],
            ],
        ],
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'active'                => true,
    ]
);
