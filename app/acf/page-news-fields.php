<?php

/**
 * Local ACF field definitions for the news page template.
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
        'key'    => 'group_page_news_hero',
        'title'  => __('News Page Hero Settings', 'beit'),
        'fields' => [
            [
                'key'        => 'field_news_hero',
                'label'      => __('Hero Section', 'beit'),
                'name'       => 'news_hero',
                'type'       => 'group',
                'layout'     => 'block',
                'sub_fields' => [
                    [
                        'key'   => 'field_news_hero_custom_title',
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
                    'value'    => 'page-news.php',
                ],
            ],
        ],
    ]
);
