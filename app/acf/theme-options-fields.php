<?php

/**
 * ACF options page field definitions.
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
        'key'    => 'group_theme_header_options',
        'title'  => __('Theme Header Settings', 'beit'),
        'fields' => [
            [
                'key'   => 'field_topbar_email',
                'label' => __('Topbar Email', 'beit'),
                'name'  => 'topbar_email',
                'type'  => 'email',
            ],
            [
                'key'   => 'field_topbar_phone',
                'label' => __('Topbar Phone Number', 'beit'),
                'name'  => 'topbar_phone',
                'type'  => 'text',
            ],
            [
                'key'          => 'field_topbar_social_links',
                'label'        => __('Topbar Social Links', 'beit'),
                'name'         => 'topbar_social_links',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => __('Add social link', 'beit'),
                'sub_fields'   => [
                    [
                        'key'     => 'field_topbar_social_network',
                        'label'   => __('Network', 'beit'),
                        'name'    => 'network',
                        'type'    => 'select',
                        'choices' => [
                            'facebook'  => __('Facebook', 'beit'),
                            'twitter'   => __('X (Twitter)', 'beit'),
                            'instagram' => __('Instagram', 'beit'),
                            'youtube'   => __('YouTube', 'beit'),
                            'linkedin'  => __('LinkedIn', 'beit'),
                            'other'     => __('Other', 'beit'),
                        ],
                        'allow_null' => 0,
                    ],
                    [
                        'key'   => 'field_topbar_social_url',
                        'label' => __('Profile URL', 'beit'),
                        'name'  => 'url',
                        'type'  => 'url',
                    ],
                ],
            ],
            [
                'key'           => 'field_topbar_search_label',
                'label'         => __('Search Label', 'beit'),
                'name'          => 'topbar_search_label',
                'type'          => 'text',
                'default_value' => __('Search', 'beit'),
            ],
            [
                'key'   => 'field_donate_link',
                'label' => __('header action btn', 'beit'),
                'name'  => 'donate_link',
                'type'  => 'link',
            ],
            [
                'key'   => 'field_faq_link',
                'label' => __('FAQ Link', 'beit'),
                'name'  => 'faq_link',
                'type'  => 'link',
                'instructions' => __('Link to FAQs page displayed in topbar.', 'beit'),
            ],
            [
                'key'           => 'field_site_logo',
                'label'         => __('Site Logo (Regular)', 'beit'),
                'name'          => 'site_logo',
                'type'          => 'image',
                'return_format' => 'id',
                'preview_size'  => 'medium',
                'library'       => 'all',
                'instructions'  => __('Default logo displayed in header.', 'beit'),
            ],
            [
                'key'           => 'field_site_logo_horizontal',
                'label'         => __('Horizontal Logo (Scroll)', 'beit'),
                'name'          => 'site_logo_horizontal',
                'type'          => 'image',
                'return_format' => 'id',
                'preview_size'  => 'medium',
                'library'       => 'all',
                'instructions'  => __('Logo displayed when scrolling down (smaller horizontal version).', 'beit'),
            ],
            [
                'key'           => 'field_footer_logo',
                'label'         => __('Footer Logo (White)', 'beit'),
                'name'          => 'footer_logo',
                'type'          => 'image',
                'return_format' => 'id',
                'preview_size'  => 'medium',
                'library'       => 'all',
                'instructions'  => __('White logo for dark footer background.', 'beit'),
            ],
            [
                'key'           => 'field_site_favicon',
                'label'         => __('Favicon', 'beit'),
                'name'          => 'site_favicon',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'thumbnail',
                'library'       => 'all',
                'instructions'  => __('Site favicon (32x32px or 64x64px recommended).', 'beit'),
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'beit-theme-settings',
                ],
            ],
        ],
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'active'                => true,
    ]
);
