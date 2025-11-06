<?php

/**
 * Widget areas registration.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register widget areas.
 */
function beit_theme_widgets_init(): void
{
    register_sidebar(
        [
            'name'          => __('Sidebar', 'beit'),
            'id'            => 'sidebar-1',
            'description'   => __('Add widgets here.', 'beit'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ]
    );
}
add_action('widgets_init', 'beit_theme_widgets_init');

