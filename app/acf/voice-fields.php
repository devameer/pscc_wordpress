<?php

/**
 * ACF fields for the Voices & Visions custom post type.
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
        'key'    => 'group_voice_media',
        'title'  => __('Voice Media Settings', 'beit'),
        'fields' => [
            [
                'key'   => 'field_voice_custom_title',
                'label' => __('Custom Title (English)', 'beit'),
                'name'  => 'voice_custom_title',
                'type'  => 'text',
                'instructions' => __('Optional custom title for this voice in English. If left empty, the post title will be used.', 'beit'),
            ],
            [
                'key'   => 'field_voice_custom_title_ar',
                'label' => __('العنوان المخصص (عربي)', 'beit'),
                'name'  => 'voice_custom_title_ar',
                'type'  => 'text',
                'instructions' => __('العنوان المخصص باللغة العربية. إذا ترك فارغاً، سيتم استخدام عنوان المقال.', 'beit'),
            ],
            [
                'key'     => 'field_voice_media_type',
                'label'   => __('Media Type', 'beit'),
                'name'    => 'voice_media_type',
                'type'    => 'button_group',
                'choices' => [
                    'image' => __('Image (uses featured image)', 'beit'),
                    'video' => __('Video', 'beit'),
                ],
                'default_value' => 'image',
                'return_format' => 'value',
            ],
            [
                'key'               => 'field_voice_media_video_file',
                'label'             => __('Video File', 'beit'),
                'name'              => 'voice_media_video_file',
                'type'              => 'file',
                'return_format'     => 'url',
                'library'           => 'all',
                'mime_types'        => 'mp4,webm,ogg',
                'instructions'      => __('Upload an MP4/WEBM/OGG file. If provided, it takes priority over the external URL.', 'beit'),
                'conditional_logic' => [
                    [
                        [
                            'field'    => 'field_voice_media_type',
                            'operator' => '==',
                            'value'    => 'video',
                        ],
                    ],
                ],
            ],
            [
                'key'               => 'field_voice_media_video',
                'label'             => __('Video URL', 'beit'),
                'name'              => 'voice_media_video',
                'type'              => 'url',
                'conditional_logic' => [
                    [
                        [
                            'field'    => 'field_voice_media_type',
                            'operator' => '==',
                            'value'    => 'video',
                        ],
                    ],
                ],
            ],
            [
                'key'   => 'field_voice_media_caption',
                'label' => __('Lightbox Caption', 'beit'),
                'name'  => 'voice_media_caption',
                'type'  => 'textarea',
                'rows'  => 3,
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'beit_voice',
                ],
            ],
        ],
    ]
);
