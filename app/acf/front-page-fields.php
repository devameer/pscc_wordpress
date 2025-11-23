<?php

/**
 * Local ACF field definitions for the home page sections.
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
        'key'    => 'group_front_page_sections',
        'title'  => __('Front Page Sections', 'beit'),
        'fields' => [
            [
                'key'        => 'field_front_initiatives',
                'label'      => __('Initiatives', 'beit'),
                'name'       => 'front_initiatives',
                'type'       => 'group',
                'layout'     => 'row',
                'sub_fields' => [
                    [
                        'key'          => 'field_front_initiatives_title',
                        'label'        => __('Title', 'beit'),
                        'name'         => 'title',
                        'type'         => 'textarea',
                        'rows'         => 2,
                        'instructions' => __('You can wrap words with HTML (e.g., &lt;span class="font-bold"&gt;).', 'beit'),
                    ],
                    [
                        'key'   => 'field_front_initiatives_subtitle',
                        'label' => __('Subtitle', 'beit'),
                        'name'  => 'subtitle',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ],
                    [
                        'key'   => 'field_front_initiatives_cta',
                        'label' => __('CTA Link', 'beit'),
                        'name'  => 'cta',
                        'type'  => 'link',
                    ],
                    [
                        'key'          => 'field_front_initiatives_items',
                        'label'        => __('Initiative Items', 'beit'),
                        'name'         => 'items',
                        'type'         => 'repeater',
                        'layout'       => 'row',
                        'button_label' => __('Add initiative', 'beit'),
                        'sub_fields'   => [
                            [
                                'key'          => 'field_front_initiatives_item_title',
                                'label'        => __('Title', 'beit'),
                                'name'         => 'title',
                                'type'         => 'textarea',
                                'rows'         => 2,
                                'instructions' => __('Use &lt;br&gt; for line breaks.', 'beit'),
                            ],
                            [
                                'key'           => 'field_front_initiatives_item_image',
                                'label'         => __('Image', 'beit'),
                                'name'          => 'image',
                                'type'          => 'image',
                                'return_format' => 'url',
                                'preview_size'  => 'medium',
                                'library'       => 'all',
                            ],
                            [
                                'key'           => 'field_front_initiatives_item_icon',
                                'label'         => __('Icon (SVG)', 'beit'),
                                'name'          => 'icon',
                                'type'          => 'file',
                                'return_format' => 'url',
                                'library'       => 'all',
                                'mime_types'    => 'svg',
                                'instructions'  => __('Upload an SVG icon that will overlay the image.', 'beit'),
                            ],
                        ],
                    ],
                ],
            ],
            [
                'key'        => 'field_front_programs',
                'label'      => __('Programs & Projects', 'beit'),
                'name'       => 'front_programs',
                'type'       => 'group',
                'sub_fields' => [
                    [
                        'key'   => 'field_front_programs_title',
                        'label' => __('Title', 'beit'),
                        'name'  => 'title',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_front_programs_subtitle',
                        'label' => __('Subtitle', 'beit'),
                        'name'  => 'subtitle',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ],
                    [
                        'key'   => 'field_front_programs_cta',
                        'label' => __('CTA Link', 'beit'),
                        'name'  => 'cta',
                        'type'  => 'link',
                    ],
                    [
                        'key'          => 'field_front_programs_items',
                        'label'        => __('Programs & Projects', 'beit'),
                        'name'         => 'items',
                        'type'         => 'repeater',
                        'layout'       => 'row',
                        'button_label' => __('Add program', 'beit'),
                        'sub_fields'   => [
                            [
                                'key'   => 'field_front_program_item_category',
                                'label' => __('Category', 'beit'),
                                'name'  => 'category',
                                'type'  => 'text',
                            ],
                            [
                                'key'   => 'field_front_program_item_title',
                                'label' => __('Title', 'beit'),
                                'name'  => 'title',
                                'type'  => 'text',
                            ],
                            [
                                'key'   => 'field_front_program_item_description',
                                'label' => __('Description', 'beit'),
                                'name'  => 'description',
                                'type'  => 'textarea',
                                'rows'  => 3,
                            ],
                            [
                                'key'           => 'field_front_program_item_image',
                                'label'         => __('Image', 'beit'),
                                'name'          => 'image',
                                'type'          => 'image',
                                'return_format' => 'url',
                                'preview_size'  => 'large',
                            ],
                            [
                                'key'   => 'field_front_program_item_link',
                                'label' => __('Link', 'beit'),
                                'name'  => 'link',
                                'type'  => 'url',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'key'        => 'field_front_our_story',
                'label'      => __('Our Story', 'beit'),
                'name'       => 'front_our_story',
                'type'       => 'group',
                'layout'     => 'block',
                'sub_fields' => [
                    [
                        'key'   => 'field_front_our_story_title',
                        'label' => __('Title', 'beit'),
                        'name'  => 'title',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_front_our_story_tagline',
                        'label' => __('Tagline', 'beit'),
                        'name'  => 'tagline',
                        'type'  => 'textarea',
                        'rows'  => 4,
                        'instructions' => __('Use &lt;br&gt; tags to control line breaks.', 'beit'),
                    ],
                    [
                        'key'   => 'field_front_our_story_description',
                        'label' => __('Description', 'beit'),
                        'name'  => 'description',
                        'type'  => 'textarea',
                        'rows'  => 6,
                    ],
                    [
                        'key'           => 'field_front_our_story_image',
                        'label'         => __('Image', 'beit'),
                        'name'          => 'image',
                        'type'          => 'image',
                        'return_format' => 'id',
                        'preview_size'  => 'large',
                        'library'       => 'all',
                    ],
                    [
                        'key'   => 'field_front_our_story_button',
                        'label' => __('CTA Button', 'beit'),
                        'name'  => 'button',
                        'type'  => 'link',
                    ],
                ],
            ],
            [
                'key'        => 'field_front_facts',
                'label'      => __('Facts & Figures', 'beit'),
                'name'       => 'front_facts',
                'type'       => 'group',
                'layout'     => 'block',
                'sub_fields' => [
                    [
                        'key'   => 'field_front_facts_title',
                        'label' => __('Title', 'beit'),
                        'name'  => 'title',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_front_facts_subtitle',
                        'label' => __('Subtitle', 'beit'),
                        'name'  => 'subtitle',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ],
                    [
                        'key'           => 'field_front_facts_background_image',
                        'label'         => __('Background Image', 'beit'),
                        'name'          => 'background_image',
                        'type'          => 'image',
                        'instructions'  => __('Background image for the Facts section (a dark overlay will be applied)', 'beit'),
                        'return_format' => 'url',
                        'preview_size'  => 'large',
                        'library'       => 'all',
                    ],
                    [
                        'key'          => 'field_front_facts_years',
                        'label'        => __('Years Tabs', 'beit'),
                        'name'         => 'years',
                        'type'         => 'repeater',
                        'layout'       => 'block',
                        'button_label' => __('Add year', 'beit'),
                        'instructions' => __('Add different years with their statistics. Each year will appear as a tab.', 'beit'),
                        'sub_fields'   => [
                            [
                                'key'   => 'field_front_facts_year_label',
                                'label' => __('Year Label', 'beit'),
                                'name'  => 'label',
                                'type'  => 'text',
                                'instructions' => __('e.g., "2024" or "2023"', 'beit'),
                                'required' => 1,
                            ],
                            [
                                'key'           => 'field_front_facts_year_active',
                                'label'         => __('Active by Default', 'beit'),
                                'name'          => 'active',
                                'type'          => 'true_false',
                                'ui'            => 1,
                                'default_value' => 0,
                                'instructions'  => __('Show this year\'s data by default when page loads.', 'beit'),
                            ],
                            [
                                'key'          => 'field_front_facts_year_items',
                                'label'        => __('Metric Cards', 'beit'),
                                'name'         => 'items',
                                'type'         => 'repeater',
                                'layout'       => 'table',
                                'button_label' => __('Add metric', 'beit'),
                                'sub_fields'   => [
                                    [
                                        'key'   => 'field_front_facts_year_item_value',
                                        'label' => __('Value', 'beit'),
                                        'name'  => 'value',
                                        'type'  => 'text',
                                        'instructions' => __('The number to display (e.g., "500" or "1,200+")', 'beit'),
                                    ],
                                    [
                                        'key'   => 'field_front_facts_year_item_label',
                                        'label' => __('Label', 'beit'),
                                        'name'  => 'label',
                                        'type'  => 'text',
                                        'instructions' => __('Description of the metric', 'beit'),
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'key'        => 'field_front_partners',
                'label'      => __('Partners', 'beit'),
                'name'       => 'front_partners',
                'type'       => 'group',
                'layout'     => 'block',
                'sub_fields' => [
                    [
                        'key'   => 'field_front_partners_title',
                        'label' => __('Title', 'beit'),
                        'name'  => 'title',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_front_partners_subtitle',
                        'label' => __('Subtitle', 'beit'),
                        'name'  => 'subtitle',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ],
                    [
                        'key'          => 'field_front_partners_items',
                        'label'        => __('Partner Logos', 'beit'),
                        'name'         => 'items',
                        'type'         => 'repeater',
                        'layout'       => 'row',
                        'button_label' => __('Add partner', 'beit'),
                        'sub_fields'   => [
                            [
                                'key'   => 'field_front_partners_item_name',
                                'label' => __('Name', 'beit'),
                                'name'  => 'name',
                                'type'  => 'text',
                            ],
                            [
                                'key'           => 'field_front_partners_item_logo',
                                'label'         => __('Logo', 'beit'),
                                'name'          => 'logo',
                                'type'          => 'image',
                                'return_format' => 'id',
                                'preview_size'  => 'medium',
                                'library'       => 'all',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'key'        => 'field_front_voices',
                'label'      => __('Voices', 'beit'),
                'name'       => 'front_voices',
                'type'       => 'group',
                'layout'     => 'block',
                'sub_fields' => [
                    [
                        'key'   => 'field_front_voices_title',
                        'label' => __('Title', 'beit'),
                        'name'  => 'title',
                        'type'  => 'textarea',
                        'rows'  => 2,
                    ],
                    [
                        'key'   => 'field_front_voices_subtitle',
                        'label' => __('Subtitle', 'beit'),
                        'name'  => 'subtitle',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ],
                    [
                        'key'          => 'field_front_voices_items',
                        'label'        => __('Voice Items', 'beit'),
                        'name'         => 'items',
                        'type'         => 'repeater',
                        'layout'       => 'block',
                        'button_label' => __('Add voice item', 'beit'),
                        'max'          => 6,
                        'instructions' => __('Add up to 6 voice items. First item will be displayed as double size.', 'beit'),
                        'sub_fields'   => [
                            [
                                'key'     => 'field_front_voices_item_media_type',
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
                                'key'               => 'field_front_voices_item_image',
                                'label'             => __('Image', 'beit'),
                                'name'              => 'image',
                                'type'              => 'image',
                                'return_format'     => 'id',
                                'preview_size'      => 'medium',
                                'library'           => 'all',
                                'conditional_logic' => [
                                    [
                                        [
                                            'field'    => 'field_front_voices_item_media_type',
                                            'operator' => '==',
                                            'value'    => 'image',
                                        ],
                                    ],
                                ],
                            ],
                            [
                                'key'               => 'field_front_voices_item_video_file',
                                'label'             => __('Video File', 'beit'),
                                'name'              => 'video_file',
                                'type'              => 'file',
                                'return_format'     => 'url',
                                'library'           => 'all',
                                'mime_types'        => 'mp4,webm,ogg',
                                'conditional_logic' => [
                                    [
                                        [
                                            'field'    => 'field_front_voices_item_media_type',
                                            'operator' => '==',
                                            'value'    => 'video',
                                        ],
                                    ],
                                ],
                            ],
                            [
                                'key'               => 'field_front_voices_item_video_url',
                                'label'             => __('Video URL (YouTube/Vimeo)', 'beit'),
                                'name'              => 'video_url',
                                'type'              => 'url',
                                'instructions'      => __('If video file is not provided, use external URL.', 'beit'),
                                'conditional_logic' => [
                                    [
                                        [
                                            'field'    => 'field_front_voices_item_media_type',
                                            'operator' => '==',
                                            'value'    => 'video',
                                        ],
                                    ],
                                ],
                            ],
                            [
                                'key'               => 'field_front_voices_item_video_thumbnail',
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
                                            'field'    => 'field_front_voices_item_media_type',
                                            'operator' => '==',
                                            'value'    => 'video',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'key'        => 'field_front_news',
                'label'      => __('Latest News', 'beit'),
                'name'       => 'front_news',
                'type'       => 'group',
                'sub_fields' => [
                    [
                        'key'   => 'field_front_news_title',
                        'label' => __('Title', 'beit'),
                        'name'  => 'title',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_front_news_subtitle',
                        'label' => __('Subtitle', 'beit'),
                        'name'  => 'subtitle',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ],
                    [
                        'key'   => 'field_front_news_cta',
                        'label' => __('CTA Link', 'beit'),
                        'name'  => 'cta',
                        'type'  => 'link',
                    ],
                ],
            ],
            [
                'key'        => 'field_front_newsletter',
                'label'      => __('Newsletter', 'beit'),
                'name'       => 'front_newsletter',
                'type'       => 'group',
                'sub_fields' => [
                    [
                        'key'   => 'field_front_newsletter_title',
                        'label' => __('Title', 'beit'),
                        'name'  => 'title',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_front_newsletter_description',
                        'label' => __('Description', 'beit'),
                        'name'  => 'description',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ],
                    [
                        'key'   => 'field_front_newsletter_placeholder',
                        'label' => __('Placeholder', 'beit'),
                        'name'  => 'placeholder',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_front_newsletter_button',
                        'label' => __('Button Label', 'beit'),
                        'name'  => 'button',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_front_newsletter_privacy',
                        'label' => __('Privacy note', 'beit'),
                        'name'  => 'privacy',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                ],
            ],
        ],
        'position'              => 'acf_after_title',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'active'                => true,
    ]
);
