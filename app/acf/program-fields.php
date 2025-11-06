<?php

/**
 * ACF fields for programs custom post type.
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
        'key'    => 'group_program_fields',
        'title'  => __('Program Presentation', 'beit'),
        'fields' => [
            [
                'key'     => 'field_program_layout',
                'label'   => __('Layout Style', 'beit'),
                'name'    => 'program_layout',
                'type'    => 'button_group',
                'choices' => [
                    'image-left'  => __('Image left / content right', 'beit'),
                    'image-right' => __('Content left / image right', 'beit'),
                ],
                'default_value' => 'image-left',
                'return_format' => 'value',
            ],
            [
                'key'   => 'field_program_eyebrow',
                'label' => __('Eyebrow Text', 'beit'),
                'name'  => 'program_eyebrow',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_program_heading',
                'label' => __('Heading', 'beit'),
                'name'  => 'program_heading',
                'type'  => 'textarea',
                'rows'  => 2,
                'instructions' => __('Use <br> to force line breaks.', 'beit'),
            ],
            [
                'key'   => 'field_program_overlay_heading',
                'label' => __('Overlay Heading', 'beit'),
                'name'  => 'program_overlay_heading',
                'type'  => 'text',
                'instructions' => __('Displayed on top of the image (e.g., WATER, HEALTH).', 'beit'),
            ],
            [
                'key'   => 'field_program_overlay_subheading',
                'label' => __('Overlay Subheading', 'beit'),
                'name'  => 'program_overlay_subheading',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_program_description',
                'label' => __('Body Description', 'beit'),
                'name'  => 'program_description',
                'type'  => 'textarea',
                'rows'  => 4,
            ],
            [
                'key'   => 'field_program_button',
                'label' => __('Primary Button', 'beit'),
                'name'  => 'program_button',
                'type'  => 'link',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'beit_program',
                ],
            ],
        ],
    ]
);
