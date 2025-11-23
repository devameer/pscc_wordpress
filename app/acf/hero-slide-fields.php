<?php

/**
 * Local ACF field definitions for the hero slide post type.
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
        'key'      => 'group_hero_slide_fields',
        'title'    => __('Hero Slide Details', 'beit'),
        'fields'   => [
            [
                'key'           => 'field_hero_slide_order',
                'label'         => __('Display Order', 'beit'),
                'name'          => 'hero_slide_order',
                'type'          => 'number',
                'instructions'  => __('Lower numbers appear first. If not set, slides will be ordered by date.', 'beit'),
                'default_value' => 0,
                'min'           => 0,
                'step'          => 1,
            ],
            [
                'key'   => 'field_hero_slide_title',
                'label' => __('Title Prefix', 'beit'),
                'name'  => 'hero_slide_title',
                'type'  => 'wysiwyg',
            ],
            
            [
                'key'   => 'field_hero_slide_description',
                'label' => __('Short Description', 'beit'),
                'name'  => 'hero_slide_description',
                'type'  => 'textarea',
                'rows'  => 4,
            ],
            [
                'key'   => 'field_hero_slide_primary_button',
                'label' => __('Primary Button', 'beit'),
                'name'  => 'hero_slide_primary_button',
                'type'  => 'link',
            ],
            [
                'key'   => 'field_hero_slide_secondary_button',
                'label' => __('Secondary Button', 'beit'),
                'name'  => 'hero_slide_secondary_button',
                'type'  => 'link',
            ],
            [
                'key'   => 'field_hero_slide_video_url',
                'label' => __('Video URL', 'beit'),
                'name'  => 'hero_slide_video_url',
                'type'  => 'url',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'beit_hero_slide',
                ],
            ],
        ],
        'position' => 'acf_after_title',
        'style'    => 'seamless',
    ]
);
