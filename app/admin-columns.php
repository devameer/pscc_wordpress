<?php

/**
 * Admin columns customizations for post types.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Post types that should have thumbnail column in admin.
 */
function beit_get_post_types_with_thumbnails(): array
{
    return ['beit_news', 'beit_program', 'beit_media', 'beit_hero_slide', 'post'];
}

/**
 * Add thumbnail column to post type list tables.
 */
function beit_add_thumbnail_column($columns): array
{
    $new_columns = [];

    foreach ($columns as $key => $value) {
        // Add thumbnail after checkbox
        if ($key === 'cb') {
            $new_columns[$key] = $value;
            $new_columns['thumbnail'] = __('Image', 'beit');
        } else {
            $new_columns[$key] = $value;
        }
    }

    return $new_columns;
}

/**
 * Display thumbnail in the custom column.
 */
function beit_display_thumbnail_column($column_name, $post_id): void
{
    if ($column_name !== 'thumbnail') {
        return;
    }

    $post_type = get_post_type($post_id);

    // For beit_media post type, check media type first
    if ($post_type === 'beit_media') {
        $media_type = get_field('media_type', $post_id);

        if ($media_type === 'video') {
            // Get video thumbnail
            $thumbnail_id = get_field('media_video_thumbnail', $post_id);
            if ($thumbnail_id) {
                echo wp_get_attachment_image($thumbnail_id, [60, 60], false, [
                    'style' => 'width: 60px; height: 60px; object-fit: cover; border-radius: 4px;',
                    'class' => 'no-lazy'
                ]);
                echo '<span class="dashicons dashicons-video-alt3" style="position: absolute; bottom: 2px; right: 2px; background: rgba(0,0,0,0.7); color: #fff; border-radius: 2px; font-size: 14px; width: 18px; height: 18px; line-height: 18px; text-align: center;"></span>';
                return;
            } else {
                // Show video icon placeholder
                echo '<div style="width: 60px; height: 60px; background: #f0f0f1; display: flex; align-items: center; justify-content: center; border-radius: 4px;">';
                echo '<span class="dashicons dashicons-video-alt3" style="font-size: 24px; color: #787c82;"></span>';
                echo '</div>';
                return;
            }
        }
    }

    // Check for featured image (standard WordPress thumbnail)
    if (has_post_thumbnail($post_id)) {
        echo '<div style="position: relative; display: inline-block;">';
        echo get_the_post_thumbnail($post_id, [60, 60], [
            'style' => 'width: 60px; height: 60px; object-fit: cover; border-radius: 4px;',
            'class' => 'no-lazy'
        ]);

        // Add video icon overlay for video media items
        if ($post_type === 'beit_media') {
            $media_type = get_field('media_type', $post_id);
            if ($media_type === 'video') {
                echo '<span class="dashicons dashicons-video-alt3" style="position: absolute; bottom: 2px; right: 2px; background: rgba(0,0,0,0.7); color: #fff; border-radius: 2px; font-size: 14px; width: 18px; height: 18px; line-height: 18px; text-align: center;"></span>';
            }
        }

        echo '</div>';
    } else {
        // Show placeholder
        echo '<div style="width: 60px; height: 60px; background: #f0f0f1; display: flex; align-items: center; justify-content: center; border-radius: 4px;">';
        echo '<span class="dashicons dashicons-format-image" style="font-size: 24px; color: #787c82;"></span>';
        echo '</div>';
    }
}

/**
 * Set the thumbnail column width.
 */
function beit_admin_thumbnail_column_styles(): void
{
    $screen = get_current_screen();

    if (!$screen) {
        return;
    }

    $post_types = beit_get_post_types_with_thumbnails();

    if (in_array($screen->post_type, $post_types, true) && $screen->base === 'edit') {
        ?>
        <style>
            .column-thumbnail {
                width: 70px !important;
            }

            .column-thumbnail img {
                display: block;
            }
        </style>
        <?php
    }
}
add_action('admin_head', 'beit_admin_thumbnail_column_styles');

/**
 * Register columns and display callbacks for each post type.
 */
foreach (beit_get_post_types_with_thumbnails() as $post_type) {
    add_filter("manage_{$post_type}_posts_columns", 'beit_add_thumbnail_column');
    add_action("manage_{$post_type}_posts_custom_column", 'beit_display_thumbnail_column', 10, 2);
}

/**
 * Make the thumbnail column sortable (optional - sorts by thumbnail ID).
 */
function beit_thumbnail_column_sortable($columns): array
{
    $columns['thumbnail'] = 'thumbnail';
    return $columns;
}

/**
 * Handle thumbnail column sorting.
 */
function beit_thumbnail_column_orderby($query): void
{
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    if ($query->get('orderby') === 'thumbnail') {
        $query->set('meta_key', '_thumbnail_id');
        $query->set('orderby', 'meta_value_num');
    }
}
add_action('pre_get_posts', 'beit_thumbnail_column_orderby');

// Add sortable columns for each post type
foreach (beit_get_post_types_with_thumbnails() as $post_type) {
    add_filter("manage_edit-{$post_type}_sortable_columns", 'beit_thumbnail_column_sortable');
}
