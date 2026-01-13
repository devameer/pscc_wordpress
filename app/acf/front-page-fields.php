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
                'label' => __('Media Center', 'beit'),
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
            [
                'key' => 'field_front_contact',
                'label' => __('Contact Section', 'beit'),
                'name' => 'front_contact',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_front_contact_title',
                        'label' => __('Title', 'beit'),
                        'name' => 'title',
                        'type' => 'text',
                        'default_value' => __('Get In Touch', 'beit'),
                    ],
                    [
                        'key' => 'field_front_contact_subtitle',
                        'label' => __('Subtitle', 'beit'),
                        'name' => 'subtitle',
                        'type' => 'textarea',
                        'rows' => 2,
                        'default_value' => __('We would love to hear from you', 'beit'),
                    ],
                    [
                        'key' => 'field_front_contact_background_image',
                        'label' => __('Background Image', 'beit'),
                        'name' => 'background_image',
                        'type' => 'image',
                        'return_format' => 'id',
                        'preview_size' => 'large',
                        'library' => 'all',
                        'instructions' => __('Select a background image for the contact section.', 'beit'),
                    ],
                    [
                        'key' => 'field_front_contact_overlay_color',
                        'label' => __('Overlay Color', 'beit'),
                        'name' => 'overlay_color',
                        'type' => 'color_picker',
                        'default_value' => '#1e293b',
                        'instructions' => __('Select the overlay color.', 'beit'),
                    ],
                    [
                        'key' => 'field_front_contact_overlay_opacity',
                        'label' => __('Overlay Opacity', 'beit'),
                        'name' => 'overlay_opacity',
                        'type' => 'range',
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                        'default_value' => 85,
                        'instructions' => __('Set the overlay opacity (0-100).', 'beit'),
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
