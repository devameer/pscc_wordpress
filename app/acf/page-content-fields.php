<?php

/**
 * Local ACF field definitions for the custom content page template.
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
        'key'    => 'group_page_custom_content',
        'title'  => __('Custom Content Page Settings', 'beit'),
        'fields' => [
            [
                'key'        => 'field_custom_content_hero',
                'label'      => __('Hero Section', 'beit'),
                'name'       => 'custom_content_hero',
                'type'       => 'group',
                'layout'     => 'block',
                'sub_fields' => [
                    [
                        'key'   => 'field_custom_content_hero_title',
                        'label' => __('Custom Hero Title', 'beit'),
                        'name'  => 'custom_title',
                        'type'  => 'text',
                        'instructions' => __('Optional custom title. If empty, page title will be used.', 'beit'),
                    ],
                    [
                        'key'   => 'field_custom_content_hero_subtitle',
                        'label' => __('Hero Subtitle', 'beit'),
                        'name'  => 'subtitle',
                        'type'  => 'text',
                        'instructions' => __('Optional subtitle for hero section.', 'beit'),
                    ],
                    [
                        'key'   => 'field_custom_content_hero_description',
                        'label' => __('Hero Description', 'beit'),
                        'name'  => 'description',
                        'type'  => 'textarea',
                        'rows'  => 3,
                        'instructions' => __('Optional description text for hero section.', 'beit'),
                    ],
                    [
                        'key'   => 'field_custom_content_hero_bg_color',
                        'label' => __('Background Color Style', 'beit'),
                        'name'  => 'background_style',
                        'type'  => 'select',
                        'choices' => [
                            'bg-gradient-to-br from-red-800 via-slate-900 to-red-950' => __('Red Gradient (Default)', 'beit'),
                            'bg-gradient-to-br from-blue-800 via-slate-900 to-blue-950' => __('Blue Gradient', 'beit'),
                            'bg-gradient-to-br from-green-800 via-slate-900 to-green-950' => __('Green Gradient', 'beit'),
                            'bg-slate-950' => __('Dark Gray', 'beit'),
                            'bg-red-900' => __('Dark Red', 'beit'),
                        ],
                        'default_value' => 'bg-gradient-to-br from-red-800 via-slate-900 to-red-950',
                        'instructions' => __('Choose background color style for hero section.', 'beit'),
                    ],
                ],
            ],
            [
                'key'           => 'field_custom_content_sections',
                'label'         => __('Content Sections', 'beit'),
                'name'          => 'content_sections',
                'type'          => 'repeater',
                'instructions'  => __('Add custom content sections to your page. Each section can have different layouts.', 'beit'),
                'layout'        => 'block',
                'button_label'  => __('Add Section', 'beit'),
                'sub_fields'    => [
                    [
                        'key'   => 'field_section_type',
                        'label' => __('Section Type', 'beit'),
                        'name'  => 'section_type',
                        'type'  => 'select',
                        'choices' => [
                            'text'           => __('Text Content', 'beit'),
                            'text_image'     => __('Text with Image', 'beit'),
                            'full_width'     => __('Full Width Content', 'beit'),
                            'two_columns'    => __('Two Columns', 'beit'),
                            'cards'          => __('Cards Grid', 'beit'),
                        ],
                        'default_value' => 'text',
                        'required' => 1,
                    ],
                    [
                        'key'   => 'field_section_title',
                        'label' => __('Section Title', 'beit'),
                        'name'  => 'title',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_section_content',
                        'label' => __('Content', 'beit'),
                        'name'  => 'content',
                        'type'  => 'wysiwyg',
                        'tabs'  => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 1,
                    ],
                    [
                        'key'   => 'field_section_image',
                        'label' => __('Image', 'beit'),
                        'name'  => 'image',
                        'type'  => 'image',
                        'return_format' => 'id',
                        'preview_size'  => 'medium',
                        'conditional_logic' => [
                            [
                                [
                                    'field'    => 'field_section_type',
                                    'operator' => '==',
                                    'value'    => 'text_image',
                                ],
                            ],
                        ],
                    ],
                    [
                        'key'   => 'field_section_image_position',
                        'label' => __('Image Position', 'beit'),
                        'name'  => 'image_position',
                        'type'  => 'select',
                        'choices' => [
                            'left'  => __('Left', 'beit'),
                            'right' => __('Right', 'beit'),
                        ],
                        'default_value' => 'right',
                        'conditional_logic' => [
                            [
                                [
                                    'field'    => 'field_section_type',
                                    'operator' => '==',
                                    'value'    => 'text_image',
                                ],
                            ],
                        ],
                    ],
                    [
                        'key'   => 'field_section_column_left',
                        'label' => __('Left Column Content', 'beit'),
                        'name'  => 'column_left',
                        'type'  => 'wysiwyg',
                        'tabs'  => 'all',
                        'toolbar' => 'full',
                        'conditional_logic' => [
                            [
                                [
                                    'field'    => 'field_section_type',
                                    'operator' => '==',
                                    'value'    => 'two_columns',
                                ],
                            ],
                        ],
                    ],
                    [
                        'key'   => 'field_section_column_right',
                        'label' => __('Right Column Content', 'beit'),
                        'name'  => 'column_right',
                        'type'  => 'wysiwyg',
                        'tabs'  => 'all',
                        'toolbar' => 'full',
                        'conditional_logic' => [
                            [
                                [
                                    'field'    => 'field_section_type',
                                    'operator' => '==',
                                    'value'    => 'two_columns',
                                ],
                            ],
                        ],
                    ],
                    [
                        'key'   => 'field_section_cards',
                        'label' => __('Cards', 'beit'),
                        'name'  => 'cards',
                        'type'  => 'repeater',
                        'layout' => 'block',
                        'button_label' => __('Add Card', 'beit'),
                        'conditional_logic' => [
                            [
                                [
                                    'field'    => 'field_section_type',
                                    'operator' => '==',
                                    'value'    => 'cards',
                                ],
                            ],
                        ],
                        'sub_fields' => [
                            [
                                'key'   => 'field_card_icon',
                                'label' => __('Icon (Font Awesome)', 'beit'),
                                'name'  => 'icon',
                                'type'  => 'text',
                                'instructions' => __('Example: fa fa-heart', 'beit'),
                            ],
                            [
                                'key'   => 'field_card_title',
                                'label' => __('Card Title', 'beit'),
                                'name'  => 'title',
                                'type'  => 'text',
                            ],
                            [
                                'key'   => 'field_card_description',
                                'label' => __('Description', 'beit'),
                                'name'  => 'description',
                                'type'  => 'textarea',
                                'rows'  => 3,
                            ],
                        ],
                    ],
                    [
                        'key'   => 'field_section_background',
                        'label' => __('Background Color', 'beit'),
                        'name'  => 'background_color',
                        'type'  => 'select',
                        'choices' => [
                            'bg-white'    => __('White', 'beit'),
                            'bg-gray-50'  => __('Light Gray', 'beit'),
                            'bg-gray-100' => __('Gray', 'beit'),
                            'bg-red-50'   => __('Light Red', 'beit'),
                        ],
                        'default_value' => 'bg-white',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'template-custom-content.php',
                ],
            ],
        ],
    ]
);
