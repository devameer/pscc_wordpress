<?php

/**
 * ACF fields for Publications custom post type.
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
        'key'    => 'group_publication_fields',
        'title'  => __('Publication Details', 'beit'),
        'fields' => [
            [
                'key'   => 'field_publication_year',
                'label' => __('Publication Year', 'beit'),
                'name'  => 'publication_year',
                'type'  => 'text',
                'instructions' => __('Enter the year of this publication (e.g., 2024).', 'beit'),
                'required' => 0,
                'placeholder' => '2024',
            ],
            [
                'key'   => 'field_publication_pdf_url',
                'label' => __('PDF File URL', 'beit'),
                'name'  => 'publication_pdf_url',
                'type'  => 'text',
                'instructions' => __('Paste any download URL for the PDF file.', 'beit'),
                'required' => 1,
                'placeholder' => 'https://example.com/file.pdf',
            ],
            [
                'key'   => 'field_publication_file_name',
                'label' => __('File Name', 'beit'),
                'name'  => 'publication_file_name',
                'type'  => 'text',
                'instructions' => __('Enter the display name for the download file (e.g., "Publication 2024").', 'beit'),
                'required' => 0,
                'placeholder' => 'Publication 2024',
            ],
            [
                'key'   => 'field_publication_file_size',
                'label' => __('File Size', 'beit'),
                'name'  => 'publication_file_size',
                'type'  => 'text',
                'instructions' => __('Enter the file size (e.g., "2.5 MB").', 'beit'),
                'required' => 0,
                'placeholder' => '2.5 MB',
            ],
            [
                'key'   => 'field_publication_download_text',
                'label' => __('Download Button Text', 'beit'),
                'name'  => 'publication_download_text',
                'type'  => 'text',
                'instructions' => __('Custom text for the download button.', 'beit'),
                'required' => 0,
                'default_value' => __('Download Publication', 'beit'),
                'placeholder' => __('Download Publication', 'beit'),
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'beit_publication',
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
