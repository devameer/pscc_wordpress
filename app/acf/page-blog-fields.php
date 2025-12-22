<?php

/**
 * ACF fields for Blog page template.
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
        'key'    => 'group_page_blog',
        'title'  => __('Blog Page Settings', 'beit'),
        'fields' => [
            [
                'key'   => 'field_blog_hero',
                'label' => __('Hero Section', 'beit'),
                'name'  => 'blog_hero',
                'type'  => 'group',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key'   => 'field_blog_hero_custom_title',
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
                    'value'    => 'page-blog.php',
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
