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
        'key'    => 'group_page_media_center_hero',
        'title'  => __('Media Center Page Settings', 'beit'),
        'fields' => [
            [
                'key'        => 'field_media_center_hero',
                'label'      => __('Hero Section', 'beit'),
                'name'       => 'media_center_hero',
                'type'       => 'group',
                'layout'     => 'row',
                'sub_fields' => [
                    [
                        'key'   => 'field_media_center_hero_custom_title',
                        'label' => __('Custom Hero Title', 'beit'),
                        'name'  => 'custom_title',
                        'type'  => 'text',
                        'instructions' => __('Optional custom title for hero section. If left empty, the page title will be used.', 'beit'),
                    ],
                ],
            ],
            [
                'key'          => 'field_media_center_voices',
                'label'        => __('Voice Items', 'beit'),
                'name'         => 'media_center_voices',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => __('Add voice item', 'beit'),
                'sub_fields'   => [
                    [
                        'key'   => 'field_media_center_voice_title',
                        'label' => __('Title', 'beit'),
                        'name'  => 'title',
                        'type'  => 'text',
                        'instructions' => __('Title for this voice item.', 'beit'),
                    ],
                    [
                        'key'     => 'field_media_center_voice_media_type',
                        'label'   => __('Media Type', 'beit'),
                        'name'    => 'media_type',
                        'type'    => 'button_group',
                        'choices' => [
                            'image' => __('Image', 'beit'),
                            'video' => __('Video', 'beit'),
                        ],
                        'default_value' => 'image',
                    ],
                    [
                        'key'               => 'field_media_center_voice_image',
                        'label'             => __('Image', 'beit'),
                        'name'              => 'image',
                        'type'              => 'image',
                        'return_format'     => 'id',
                        'preview_size'      => 'medium',
                        'library'           => 'all',
                        'conditional_logic' => [
                            [
                                [
                                    'field'    => 'field_media_center_voice_media_type',
                                    'operator' => '==',
                                    'value'    => 'image',
                                ],
                            ],
                        ],
                    ],
                    [
                        'key'               => 'field_media_center_voice_video_file',
                        'label'             => __('Video File', 'beit'),
                        'name'              => 'video_file',
                        'type'              => 'file',
                        'return_format'     => 'url',
                        'library'           => 'all',
                        'mime_types'        => 'mp4,webm,ogg',
                        'conditional_logic' => [
                            [
                                [
                                    'field'    => 'field_media_center_voice_media_type',
                                    'operator' => '==',
                                    'value'    => 'video',
                                ],
                            ],
                        ],
                    ],
                    [
                        'key'               => 'field_media_center_voice_video_url',
                        'label'             => __('Video URL (YouTube/Vimeo)', 'beit'),
                        'name'              => 'video_url',
                        'type'              => 'url',
                        'instructions'      => __('If video file is not provided, use external URL.', 'beit'),
                        'conditional_logic' => [
                            [
                                [
                                    'field'    => 'field_media_center_voice_media_type',
                                    'operator' => '==',
                                    'value'    => 'video',
                                ],
                            ],
                        ],
                    ],
                    [
                        'key'               => 'field_media_center_voice_video_thumbnail',
                        'label'             => __('Video Thumbnail', 'beit'),
                        'name'              => 'video_thumbnail',
                        'type'              => 'image',
                        'return_format'     => 'id',
                        'preview_size'      => 'medium',
                        'library'           => 'all',
                        'instructions'      => __('Thumbnail image for video preview.', 'beit'),
                        'conditional_logic' => [
                            [
                                [
                                    'field'    => 'field_media_center_voice_media_type',
                                    'operator' => '==',
                                    'value'    => 'video',
                                ],
                            ],
                        ],
                    ],
                    [
                        'key'   => 'field_media_center_voice_excerpt',
                        'label' => __('Excerpt/Description', 'beit'),
                        'name'  => 'excerpt',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-media-center.php',
                ],
            ],
        ],
    ]
);
