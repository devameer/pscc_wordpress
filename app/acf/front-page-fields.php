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
        'key' => 'group_front_page_sections',
        'title' => __('Front Page Sections', 'beit'),
        'fields' => [
            [
                'key' => 'field_front_our_story',
                'label' => __('Our Story', 'beit'),
                'name' => 'front_our_story',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_front_our_story_title',
                        'label' => __('Title', 'beit'),
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_front_our_story_tagline',
                        'label' => __('Tagline', 'beit'),
                        'name' => 'tagline',
                        'type' => 'textarea',
                        'rows' => 4,
                        'instructions' => __('Use &lt;br&gt; tags to control line breaks.', 'beit'),
                    ],
                    [
                        'key' => 'field_front_our_story_description',
                        'label' => __('Description', 'beit'),
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 6,
                    ],
                    [
                        'key' => 'field_front_our_story_image',
                        'label' => __('Image', 'beit'),
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'id',
                        'preview_size' => 'large',
                        'library' => 'all',
                    ],
                    [
                        'key' => 'field_front_our_story_button',
                        'label' => __('CTA Button', 'beit'),
                        'name' => 'button',
                        'type' => 'link',
                    ],
                ],
            ],
            [
                'key' => 'field_front_facts',
                'label' => __('Facts & Figures', 'beit'),
                'name' => 'front_facts',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_front_facts_title',
                        'label' => __('Title', 'beit'),
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_front_facts_subtitle',
                        'label' => __('Subtitle', 'beit'),
                        'name' => 'subtitle',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                    [
                        'key' => 'field_front_facts_background_image',
                        'label' => __('Background Image', 'beit'),
                        'name' => 'background_image',
                        'type' => 'image',
                        'instructions' => __('Background image for the Facts section (a dark overlay will be applied)', 'beit'),
                        'return_format' => 'url',
                        'preview_size' => 'large',
                        'library' => 'all',
                    ],
                    [
                        'key' => 'field_front_facts_years',
                        'label' => __('Years Tabs', 'beit'),
                        'name' => 'years',
                        'type' => 'repeater',
                        'layout' => 'block',
                        'button_label' => __('Add year', 'beit'),
                        'instructions' => __('Add different years with their statistics. Each year will appear as a tab.', 'beit'),
                        'sub_fields' => [
                            [
                                'key' => 'field_front_facts_year_label',
                                'label' => __('Year Label', 'beit'),
                                'name' => 'label',
                                'type' => 'text',
                                'instructions' => __('e.g., "2024" or "2023"', 'beit'),
                                'required' => 1,
                            ],
                            [
                                'key' => 'field_front_facts_year_active',
                                'label' => __('Active by Default', 'beit'),
                                'name' => 'active',
                                'type' => 'true_false',
                                'ui' => 1,
                                'default_value' => 0,
                                'instructions' => __('Show this year\'s data by default when page loads.', 'beit'),
                            ],
                            [
                                'key' => 'field_front_facts_year_items',
                                'label' => __('Metric Cards', 'beit'),
                                'name' => 'items',
                                'type' => 'repeater',
                                'layout' => 'table',
                                'button_label' => __('Add metric', 'beit'),
                                'sub_fields' => [
                                    [
                                        'key' => 'field_front_facts_year_item_value',
                                        'label' => __('Value', 'beit'),
                                        'name' => 'value',
                                        'type' => 'text',
                                        'instructions' => __('The number to display (e.g., "500" or "1,200+")', 'beit'),
                                    ],
                                    [
                                        'key' => 'field_front_facts_year_item_label',
                                        'label' => __('Label', 'beit'),
                                        'name' => 'label',
                                        'type' => 'text',
                                        'instructions' => __('Description of the metric', 'beit'),
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_front_members',
                'label' => __('Members', 'beit'),
                'name' => 'front_members',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_front_members_title',
                        'label' => __('Title', 'beit'),
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_front_members_subtitle',
                        'label' => __('Subtitle', 'beit'),
                        'name' => 'subtitle',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                    [
                        'key' => 'field_front_members_items',
                        'label' => __('Member Logos', 'beit'),
                        'name' => 'items',
                        'type' => 'repeater',
                        'layout' => 'row',
                        'button_label' => __('Add member', 'beit'),
                        'sub_fields' => [
                            [
                                'key' => 'field_front_members_item_name',
                                'label' => __('Name', 'beit'),
                                'name' => 'name',
                                'type' => 'text',
                            ],
                            [
                                'key' => 'field_front_members_item_logo',
                                'label' => __('Logo', 'beit'),
                                'name' => 'logo',
                                'type' => 'image',
                                'return_format' => 'id',
                                'preview_size' => 'medium',
                                'library' => 'all',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_front_voices',
                'label' => __('Voices', 'beit'),
                'name' => 'front_voices',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_front_voices_title',
                        'label' => __('Title', 'beit'),
                        'name' => 'title',
                        'type' => 'textarea',
                        'rows' => 2,
                    ],
                    [
                        'key' => 'field_front_voices_subtitle',
                        'label' => __('Subtitle', 'beit'),
                        'name' => 'subtitle',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],

                ],
            ],
            [
                'key' => 'field_front_news',
                'label' => __('Latest News', 'beit'),
                'name' => 'front_news',
                'type' => 'group',
                'sub_fields' => [
                    [
                        'key' => 'field_front_news_title',
                        'label' => __('Title', 'beit'),
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_front_news_subtitle',
                        'label' => __('Subtitle', 'beit'),
                        'name' => 'subtitle',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                    [
                        'key' => 'field_front_news_cta',
                        'label' => __('CTA Link', 'beit'),
                        'name' => 'cta',
                        'type' => 'link',
                    ],
                ],
            ],

        ],
        'location' => [
            [
                [
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ],
            ],
        ],
        'position' => 'acf_after_title',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ]
);
