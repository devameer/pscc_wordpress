<?php

/**
 * Local ACF field definitions for the donate page template.
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
        'key'    => 'group_page_donate_fields',
        'title'  => __('Donate Page Settings', 'beit'),
        'fields' => [
            [
                'key'        => 'field_donate_hero',
                'label'      => __('Hero Section', 'beit'),
                'name'       => 'donate_hero',
                'type'       => 'group',
                'layout'     => 'block',
                'sub_fields' => [
                    [
                        'key'   => 'field_donate_hero_eyebrow',
                        'label' => __('Eyebrow Text', 'beit'),
                        'name'  => 'eyebrow',
                        'type'  => 'text',
                        'default_value' => __('Donate Information', 'beit'),
                    ],
                    [
                        'key'   => 'field_donate_hero_title',
                        'label' => __('Headline', 'beit'),
                        'name'  => 'title',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_donate_hero_subtitle',
                        'label' => __('Subtitle', 'beit'),
                        'name'  => 'subtitle',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ],
                    [
                        'key'           => 'field_donate_hero_background',
                        'label'         => __('Background Image', 'beit'),
                        'name'          => 'background',
                        'type'          => 'image',
                        'return_format' => 'url',
                        'preview_size'  => 'large',
                        'library'       => 'all',
                        'instructions'  => __('Optional hero background image (a gradient overlay will be applied automatically).', 'beit'),
                    ],
                ],
            ],
            [
                'key'          => 'field_donation_accounts',
                'label'        => __('Bank Accounts', 'beit'),
                'name'         => 'donation_accounts',
                'type'         => 'repeater',
                'layout'       => 'row',
                'button_label' => __('Add bank account', 'beit'),
                'sub_fields'   => [
                    [
                        'key'   => 'field_donation_bank_name',
                        'label' => __('Bank Name', 'beit'),
                        'name'  => 'bank_name',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_donation_account_name',
                        'label' => __('Account Name', 'beit'),
                        'name'  => 'account_name',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_donation_account_number',
                        'label' => __('Account Number', 'beit'),
                        'name'  => 'account_number',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_donation_account_iban',
                        'label' => __('IBAN', 'beit'),
                        'name'  => 'iban',
                        'type'  => 'text',
                        'instructions' => __('Optional IBAN or routing number.', 'beit'),
                    ],
                    [
                        'key'   => 'field_donation_account_notes',
                        'label' => __('Notes', 'beit'),
                        'name'  => 'notes',
                        'type'  => 'textarea',
                        'rows'  => 2,
                        'instructions' => __('Additional instructions for this account (optional).', 'beit'),
                    ],
                ],
            ],

            [
                'key'   => 'field_donation_story_title',
                'label' => __('Impact Section Title', 'beit'),
                'name'  => 'donation_story_title',
                'type'  => 'text',
                'default_value' => __('Why Your Donation Matters', 'beit'),
            ],
            [
                'key'   => 'field_donation_story_intro',
                'label' => __('Impact Intro Text', 'beit'),
                'name'  => 'donation_story_intro',
                'type'  => 'textarea',
                'rows'  => 4,
            ],
            [
                'key'          => 'field_donation_highlight_cards',
                'label'        => __('Highlight Cards', 'beit'),
                'name'         => 'donation_highlight_cards',
                'type'         => 'repeater',
                'layout'       => 'row',
                'button_label' => __('Add highlight card', 'beit'),
                'sub_fields'   => [
                    [
                        'key'   => 'field_donation_card_icon',
                        'label' => __('Icon class', 'beit'),
                        'name'  => 'icon',
                        'type'  => 'text',
                        'instructions' => __('Font Awesome class, e.g. "fa fa-hands-holding-heart".', 'beit'),
                    ],
                    [
                        'key'   => 'field_donation_card_title',
                        'label' => __('Title', 'beit'),
                        'name'  => 'title',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_donation_card_text',
                        'label' => __('Description', 'beit'),
                        'name'  => 'description',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ],
                ],
            ],
            [
                'key'        => 'field_donation_callout',
                'label'      => __('Call to Action', 'beit'),
                'name'       => 'donation_callout',
                'type'       => 'group',
                'layout'     => 'block',
                'sub_fields' => [
                    [
                        'key'   => 'field_donation_callout_title',
                        'label' => __('Callout Title', 'beit'),
                        'name'  => 'title',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_donation_callout_text',
                        'label' => __('Callout Description', 'beit'),
                        'name'  => 'description',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ],
                    [
                        'key'   => 'field_donation_callout_button',
                        'label' => __('Callout Button', 'beit'),
                        'name'  => 'button',
                        'type'  => 'link',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-donate.php',
                ],
            ],
        ],
    ]
);
