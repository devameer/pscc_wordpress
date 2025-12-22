<?php

/**
 * ACF fields for Annual Reports custom post type.
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
        'key'    => 'group_annual_report_fields',
        'title'  => __('Annual Report Details', 'beit'),
        'fields' => [
            [
                'key'   => 'field_annual_report_year',
                'label' => __('Report Year', 'beit'),
                'name'  => 'annual_report_year',
                'type'  => 'text',
                'instructions' => __('Enter the year of this report (e.g., 2024).', 'beit'),
                'required' => 0,
                'placeholder' => '2024',
            ],
            [
                'key'   => 'field_annual_report_pdf_url',
                'label' => __('PDF File URL', 'beit'),
                'name'  => 'annual_report_pdf_url',
                'type'  => 'text',
                'instructions' => __('Paste any download URL for the PDF file.', 'beit'),
                'required' => 1,
                'placeholder' => 'https://example.com/file.pdf',
            ],
            [
                'key'   => 'field_annual_report_file_name',
                'label' => __('File Name', 'beit'),
                'name'  => 'annual_report_file_name',
                'type'  => 'text',
                'instructions' => __('Enter the display name for the download file (e.g., "Annual Report 2024").', 'beit'),
                'required' => 0,
                'placeholder' => 'Annual Report 2024',
            ],
            [
                'key'   => 'field_annual_report_file_size',
                'label' => __('File Size', 'beit'),
                'name'  => 'annual_report_file_size',
                'type'  => 'text',
                'instructions' => __('Enter the file size (e.g., "2.5 MB").', 'beit'),
                'required' => 0,
                'placeholder' => '2.5 MB',
            ],
            [
                'key'   => 'field_annual_report_download_text',
                'label' => __('Download Button Text', 'beit'),
                'name'  => 'annual_report_download_text',
                'type'  => 'text',
                'instructions' => __('Custom text for the download button.', 'beit'),
                'required' => 0,
                'default_value' => __('Download Report', 'beit'),
                'placeholder' => __('Download Report', 'beit'),
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'beit_annual_report',
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
