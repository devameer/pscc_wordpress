<?php

/**
 * Register custom post types used in the theme.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register hero slide, feature, and news post types.
 */
function beit_register_post_types(): void
{
    $hero_labels = [
        'name' => __('Hero Slides', 'beit'),
        'singular_name' => __('Hero Slide', 'beit'),
        'menu_name' => __('Hero Slides', 'beit'),
        'name_admin_bar' => __('Hero Slide', 'beit'),
        'add_new' => __('Add New', 'beit'),
        'add_new_item' => __('Add New Hero Slide', 'beit'),
        'edit_item' => __('Edit Hero Slide', 'beit'),
        'new_item' => __('New Hero Slide', 'beit'),
        'view_item' => __('View Hero Slide', 'beit'),
        'search_items' => __('Search Hero Slides', 'beit'),
        'not_found' => __('No hero slides found', 'beit'),
        'not_found_in_trash' => __('No hero slides found in Trash', 'beit'),
        'all_items' => __('All Hero Slides', 'beit'),
    ];

    register_post_type(
        'beit_hero_slide',
        [
            'labels' => $hero_labels,
            'public' => true,
            'show_in_menu' => true,
            'menu_position' => 21,
            'menu_icon' => 'dashicons-images-alt2',
            'has_archive' => false,
            'rewrite' => ['slug' => 'hero-slide'],
            'supports' => ['title', 'thumbnail', 'page-attributes'],
            'show_in_rest' => true,
        ]
    );

    $feature_labels = [
        'name' => __('Features', 'beit'),
        'singular_name' => __('Feature', 'beit'),
        'menu_name' => __('Features', 'beit'),
        'name_admin_bar' => __('Feature', 'beit'),
        'add_new' => __('Add New', 'beit'),
        'add_new_item' => __('Add New Feature', 'beit'),
        'edit_item' => __('Edit Feature', 'beit'),
        'new_item' => __('New Feature', 'beit'),
        'view_item' => __('View Feature', 'beit'),
        'search_items' => __('Search Features', 'beit'),
        'not_found' => __('No features found', 'beit'),
        'not_found_in_trash' => __('No features found in Trash', 'beit'),
        'all_items' => __('All Features', 'beit'),
    ];



    $news_labels = [
        'name' => __('News', 'beit'),
        'singular_name' => __('News Item', 'beit'),
        'menu_name' => __('News', 'beit'),
        'name_admin_bar' => __('News Item', 'beit'),
        'add_new' => __('Add News', 'beit'),
        'add_new_item' => __('Add New News Item', 'beit'),
        'edit_item' => __('Edit News Item', 'beit'),
        'new_item' => __('New News Item', 'beit'),
        'view_item' => __('View News Item', 'beit'),
        'search_items' => __('Search News', 'beit'),
        'not_found' => __('No news items found', 'beit'),
        'not_found_in_trash' => __('No news items found in Trash', 'beit'),
        'all_items' => __('All News', 'beit'),
    ];

    register_post_type(
        'beit_news',
        [
            'labels' => $news_labels,
            'public' => true,
            'show_in_menu' => true,
            'menu_position' => 23,
            'menu_icon' => 'dashicons-megaphone',
            'has_archive' => true,
            'rewrite' => ['slug' => 'news'],
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
            'show_in_rest' => true,
            'taxonomies' => ['category', 'post_tag'],
        ]
    );


    // register_post_type(
    //     'beit_voice',
    //     [
    //         'labels'             => $voices_labels,
    //         'public'             => true,
    //         'show_in_menu'       => true,
    //         'menu_position'      => 24,
    //         'menu_icon'          => 'dashicons-format-gallery',
    //         'has_archive'        => true,
    //         'rewrite'            => ['slug' => 'voices'],
    //         'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
    //         'show_in_rest'       => true,
    //     ]
    // );



    $media_library_labels = [
        'name' => __('Media Library', 'beit'),
        'singular_name' => __('Media Item', 'beit'),
        'menu_name' => __('Media Library', 'beit'),
        'name_admin_bar' => __('Media Item', 'beit'),
        'add_new' => __('Add New', 'beit'),
        'add_new_item' => __('Add New Media Item', 'beit'),
        'edit_item' => __('Edit Media Item', 'beit'),
        'new_item' => __('New Media Item', 'beit'),
        'view_item' => __('View Media Item', 'beit'),
        'search_items' => __('Search Media', 'beit'),
        'not_found' => __('No media items found', 'beit'),
        'not_found_in_trash' => __('No media items found in Trash', 'beit'),
        'all_items' => __('All Media', 'beit'),
    ];

    register_post_type(
        'beit_media',
        [
            'labels' => $media_library_labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_in_menu' => true,
            'menu_position' => 26,
            'menu_icon' => 'dashicons-format-gallery',
            'has_archive' => true,
            'rewrite' => ['slug' => 'media-library'],
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'page-attributes'],
            'show_in_rest' => true,
            'taxonomies' => ['category'],
        ]
    );


    // Members Post Type
    $members_labels = [
        'name' => __('Members', 'beit'),
        'singular_name' => __('Member', 'beit'),
        'menu_name' => __('Members', 'beit'),
        'name_admin_bar' => __('Member', 'beit'),
        'add_new' => __('Add New', 'beit'),
        'add_new_item' => __('Add New Member', 'beit'),
        'edit_item' => __('Edit Member', 'beit'),
        'new_item' => __('New Member', 'beit'),
        'view_item' => __('View Member', 'beit'),
        'search_items' => __('Search Members', 'beit'),
        'not_found' => __('No members found', 'beit'),
        'not_found_in_trash' => __('No members found in Trash', 'beit'),
        'all_items' => __('All Members', 'beit'),
    ];

    register_post_type(
        'beit_member',
        [
            'labels' => $members_labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_in_menu' => true,
            'menu_position' => 27,
            'menu_icon' => 'dashicons-groups',
            'has_archive' => false,
            'rewrite' => ['slug' => 'members'],
            'supports' => ['title', 'thumbnail', 'page-attributes'],
            'show_in_rest' => true,
        ]
    );
}
add_action('init', 'beit_register_post_types');
