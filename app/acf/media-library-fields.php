<?php

/**
 * Local ACF field definitions for the media library post type.
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
        'key'    => 'group_media_library',
        'title'  => __('Media Settings', 'beit'),
        'fields' => [
            [
                'key'     => 'field_media_type',
                'label'   => __('Media Type', 'beit'),
                'name'    => 'media_type',
                'type'    => 'button_group',
                'choices' => [
                    'image' => __('Photo', 'beit'),
                    'video' => __('Video', 'beit'),
                ],
                'default_value' => 'image',
                'required'      => 1,
            ],
            [
                'key'               => 'field_media_video_source_type',
                'label'             => __('Video Source', 'beit'),
                'name'              => 'media_video_source_type',
                'type'              => 'button_group',
                'choices'           => [
                    'file' => __('Upload File', 'beit'),
                    'url'  => __('External URL', 'beit'),
                ],
                'default_value'     => 'url',
                'instructions'      => __('Choose whether to upload a video file or use an external URL (YouTube, Vimeo, etc.).', 'beit'),
                'conditional_logic' => [
                    [
                        [
                            'field'    => 'field_media_type',
                            'operator' => '==',
                            'value'    => 'video',
                        ],
                    ],
                ],
            ],
            [
                'key'               => 'field_media_video_file',
                'label'             => __('Upload Video File', 'beit'),
                'name'              => 'media_video_file',
                'type'              => 'file',
                'return_format'     => 'url',
                'library'           => 'all',
                'mime_types'        => 'mp4,webm,ogg',
                'instructions'      => __('Upload a video file (MP4, WebM, or OGG). Recommended for better control and offline playback.', 'beit'),
                'conditional_logic' => [
                    [
                        [
                            'field'    => 'field_media_type',
                            'operator' => '==',
                            'value'    => 'video',
                        ],
                        [
                            'field'    => 'field_media_video_source_type',
                            'operator' => '==',
                            'value'    => 'file',
                        ],
                    ],
                ],
            ],
            [
                'key'               => 'field_media_video_url',
                'label'             => __('Video URL', 'beit'),
                'name'              => 'media_video_url',
                'type'              => 'url',
                'placeholder'       => 'https://www.youtube.com/watch?v=...',
                'instructions'      => __('Enter the video URL from YouTube, Vimeo, or other video platforms. The video will be embedded using the platform\'s player.', 'beit'),
                'conditional_logic' => [
                    [
                        [
                            'field'    => 'field_media_type',
                            'operator' => '==',
                            'value'    => 'video',
                        ],
                        [
                            'field'    => 'field_media_video_source_type',
                            'operator' => '==',
                            'value'    => 'url',
                        ],
                    ],
                ],
            ],
            [
                'key'               => 'field_media_video_thumbnail',
                'label'             => __('Video Thumbnail', 'beit'),
                'name'              => 'media_video_thumbnail',
                'type'              => 'image',
                'return_format'     => 'id',
                'preview_size'      => 'medium',
                'library'           => 'all',
                'instructions'      => __('Thumbnail image for video preview.', 'beit'),
                'conditional_logic' => [
                    [
                        [
                            'field'    => 'field_media_type',
                            'operator' => '==',
                            'value'    => 'video',
                        ],
                    ],
                ],
            ],
            [
                'key'               => 'field_media_gallery',
                'label'             => __('Gallery Images', 'beit'),
                'name'              => 'media_gallery',
                'type'              => 'gallery',
                'return_format'     => 'id',
                'preview_size'      => 'medium',
                'library'           => 'all',
                'min'               => 0,
                'instructions'      => __('Add multiple images to create a photo gallery. These images will be displayed with the featured image in a lightbox.', 'beit'),
                'conditional_logic' => [
                    [
                        [
                            'field'    => 'field_media_type',
                            'operator' => '==',
                            'value'    => 'image',
                        ],
                    ],
                ],
            ],
            [
                'key'          => 'field_media_show_on_homepage',
                'label'        => __('Show on Homepage', 'beit'),
                'name'         => 'show_on_homepage',
                'type'         => 'true_false',
                'default_value' => 0,
                'ui'           => 1,
                'ui_on_text'   => __('Yes', 'beit'),
                'ui_off_text'  => __('No', 'beit'),
                'instructions' => __('Enable this to display this media item on the homepage.', 'beit'),
            ],
            [
                'key'               => 'field_media_homepage_order',
                'label'             => __('Homepage Order', 'beit'),
                'name'              => 'homepage_order',
                'type'              => 'number',
                'default_value'     => 0,
                'min'               => 0,
                'step'              => 1,
                'instructions'      => __('Set the display order on the homepage. Lower numbers appear first.', 'beit'),
                'conditional_logic' => [
                    [
                        [
                            'field'    => 'field_media_show_on_homepage',
                            'operator' => '==',
                            'value'    => '1',
                        ],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'beit_media',
                ],
            ],
        ],
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
    ]
);
