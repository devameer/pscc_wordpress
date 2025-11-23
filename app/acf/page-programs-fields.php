<?php

/**
 * Local ACF field definitions for the programs page template.
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
        'key'    => 'group_page_programs_hero',
        'title'  => __('Programs Page Hero Settings', 'beit'),
        'fields' => [
            [
                'key'        => 'field_programs_hero',
                'label'      => __('Hero Section', 'beit'),
                'name'       => 'programs_hero',
                'type'       => 'group',
                'layout'     => 'block',
                'sub_fields' => [
                    [
                        'key'   => 'field_programs_hero_custom_title',
                        'label' => __('Custom Hero Title', 'beit'),
                        'name'  => 'custom_title',
                        'type'  => 'text',
                        'instructions' => __('Optional custom title for hero section. If left empty, the page title will be used.', 'beit'),
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-programs.php',
                ],
            ],
        ],
    ]
);
