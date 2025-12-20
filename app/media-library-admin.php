<?php

/**
 * Media Library admin customizations.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add custom submenu pages for adding photos and videos separately.
 */
function beit_media_library_add_submenu_pages(): void
{
    // Remove default "Add New" submenu
    remove_submenu_page('edit.php?post_type=beit_media', 'post-new.php?post_type=beit_media');

    // Add "Add Photo" submenu
    add_submenu_page(
        'edit.php?post_type=beit_media',
        __('Add Photo', 'beit'),
        __('Add Photo', 'beit'),
        'edit_posts',
        'post-new.php?post_type=beit_media&media_type=image',
        ''
    );

    // Add "Add Video" submenu
    add_submenu_page(
        'edit.php?post_type=beit_media',
        __('Add Video', 'beit'),
        __('Add Video', 'beit'),
        'edit_posts',
        'post-new.php?post_type=beit_media&media_type=video',
        ''
    );
}
add_action('admin_menu', 'beit_media_library_add_submenu_pages', 999);

/**
 * Set default media type based on URL parameter.
 */
function beit_media_library_set_default_type($value, $post_id, $field)
{
    // Only apply to new posts (check both 'new' and empty/null post_id)
    if ($post_id && $post_id !== 'new' && !empty(get_post_status($post_id))) {
        return $value;
    }

    // Check if media_type parameter is set in URL
    if (isset($_GET['media_type'])) {
        $media_type = sanitize_text_field($_GET['media_type']);
        if (in_array($media_type, ['image', 'video'], true)) {
            return $media_type;
        }
    }

    return $value;
}
add_filter('acf/load_value/name=media_type', 'beit_media_library_set_default_type', 10, 3);

/**
 * Prepare field with default value from URL.
 */
function beit_media_library_prepare_field($field): array
{
    // Check if we're adding a new post and have media_type in URL
    global $pagenow;
    if ($pagenow === 'post-new.php' && isset($_GET['media_type']) && isset($_GET['post_type']) && $_GET['post_type'] === 'beit_media') {
        $media_type = sanitize_text_field($_GET['media_type']);
        if (in_array($media_type, ['image', 'video'], true)) {
            $field['default_value'] = $media_type;
            $field['value'] = $media_type;
        }
    }
    return $field;
}
add_filter('acf/prepare_field/name=media_type', 'beit_media_library_prepare_field');

/**
 * Customize the "Add New" button in the media library list page.
 */
function beit_media_library_custom_add_new_button(): void
{
    global $typenow;

    if ($typenow === 'beit_media') {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                // Find the "Add New" button
                var addNewBtn = $('.page-title-action').first();

                if (addNewBtn.length) {
                    // Replace with dropdown
                    var dropdown = $('<div class="beit-media-add-new-dropdown" style="display: inline-block; position: relative; margin-left: 10px;"></div>');
                    var button = $('<button type="button" class="page-title-action" style="padding-right: 25px;"><?php echo esc_js(__('Add New', 'beit')); ?> <span class="dashicons dashicons-arrow-down-alt2" style="font-size: 14px; vertical-align: middle;"></span></button>');
                    var menu = $('<div class="beit-media-dropdown-menu" style="display: none; position: absolute; top: 100%; left: 0; background: #fff; border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0,0,0,0.1); z-index: 1000; min-width: 150px; margin-top: 5px;"></div>');

                    menu.append('<a href="post-new.php?post_type=beit_media&media_type=image" style="display: block; padding: 10px 15px; text-decoration: none; color: #333; border-bottom: 1px solid #eee;"><span class="dashicons dashicons-format-image" style="margin-right: 5px;"></span><?php echo esc_js(__('Add Photo', 'beit')); ?></a>');
                    menu.append('<a href="post-new.php?post_type=beit_media&media_type=video" style="display: block; padding: 10px 15px; text-decoration: none; color: #333;"><span class="dashicons dashicons-video-alt3" style="margin-right: 5px;"></span><?php echo esc_js(__('Add Video', 'beit')); ?></a>');

                    dropdown.append(button);
                    dropdown.append(menu);

                    // Replace original button
                    addNewBtn.replaceWith(dropdown);

                    // Toggle menu on button click
                    button.on('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        menu.toggle();
                    });

                    // Close menu when clicking outside
                    $(document).on('click', function (e) {
                        if (!$(e.target).closest('.beit-media-add-new-dropdown').length) {
                            menu.hide();
                        }
                    });

                    // Hover effects
                    menu.find('a').hover(
                        function () { $(this).css('background-color', '#f0f0f1'); },
                        function () { $(this).css('background-color', '#fff'); }
                    );
                }
            });
        </script>
        <style>
            .beit-media-dropdown-menu a {
                transition: background-color 0.2s ease;
            }
        </style>
        <?php
    }
}
add_action('admin_footer', 'beit_media_library_custom_add_new_button');

/**
 * Customize the post title based on media type when adding new.
 */
function beit_media_library_custom_title($translation, $text, $domain): string
{
    global $typenow, $pagenow;

    if ($typenow === 'beit_media' && $pagenow === 'post-new.php') {
        if (isset($_GET['media_type'])) {
            $media_type = sanitize_text_field($_GET['media_type']);

            if ($text === 'Add New Media Item') {
                if ($media_type === 'image') {
                    return __('Add New Photo', 'beit');
                } elseif ($media_type === 'video') {
                    return __('Add New Video', 'beit');
                }
            }
        }
    }

    return $translation;
}
add_filter('gettext', 'beit_media_library_custom_title', 10, 3);

/**
 * Add admin notice to guide users.
 */
function beit_media_library_admin_notice(): void
{
    global $typenow, $pagenow;

    if ($typenow === 'beit_media' && $pagenow === 'post-new.php') {
        if (isset($_GET['media_type'])) {
            $media_type = sanitize_text_field($_GET['media_type']);
            $type_label = $media_type === 'image' ? __('Photo', 'beit') : __('Video', 'beit');
            ?>
            <div class="notice notice-info is-dismissible">
                <p>
                    <strong><?php echo esc_html(sprintf(__('You are adding a new %s to the Media Library.', 'beit'), $type_label)); ?></strong>
                </p>
            </div>
            <?php
        }
    }
}
add_action('admin_notices', 'beit_media_library_admin_notice');

/**
 * Lock the media type field after selection.
 */
function beit_media_library_lock_media_type(): void
{
    global $typenow, $pagenow;

    if ($typenow === 'beit_media' && $pagenow === 'post-new.php' && isset($_GET['media_type'])) {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                // Disable media type field to prevent changing
                setTimeout(function () {
                    $('input[name="acf[field_media_type]"]').prop('disabled', false).closest('.acf-button-group').css('opacity', '0.6');
                    $('input[name="acf[field_media_type]"]').on('click', function (e) {
                        // Allow click but show message
                        var mediaType = '<?php echo esc_js(sanitize_text_field($_GET['media_type'])); ?>';
                        var typeName = mediaType === 'image' ? '<?php echo esc_js(__('Photo', 'beit')); ?>' : '<?php echo esc_js(__('Video', 'beit')); ?>';

                        if ($(this).val() !== mediaType) {
                            alert('<?php echo esc_js(__('You selected to add a', 'beit')); ?> ' + typeName + '. <?php echo esc_js(__('If you want to change the media type, please go back and select the correct option.', 'beit')); ?>');
                            return false;
                        }
                    });
                }, 500);
            });
        </script>
        <?php
    }
}
add_action('admin_footer', 'beit_media_library_lock_media_type');
