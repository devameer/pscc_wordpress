<?php

/**
 * Helper functions for the Beit theme.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('beit_get_multilingual_title')) {
    /**
     * Get the appropriate title based on current language for media items.
     *
     * @param int|null $post_id The post ID. If null, uses current post.
     * @param string $post_type The post type ('beit_voice' or 'beit_media').
     * @return string The localized title.
     */
    function beit_get_multilingual_title(?int $post_id = null, string $post_type = ''): string
    {
        if (!$post_id) {
            $post_id = get_the_ID();
        }

        if (!$post_type) {
            $post_type = get_post_type($post_id);
        }

        // Get current language
        $current_lang = function_exists('pll_current_language') ? pll_current_language('slug') : 'en';

        // Default to post title
        $title = get_the_title($post_id);

        // If Arabic, try to get Arabic title
        if ($current_lang === 'ar' && function_exists('get_field')) {
            if ($post_type === 'beit_voice') {
                $arabic_title = get_field('voice_custom_title_ar', $post_id);
                if ($arabic_title) {
                    return $arabic_title;
                }
                // Fallback to English custom title if no Arabic
                $english_title = get_field('voice_custom_title', $post_id);
                return $english_title ?: $title;
            } elseif ($post_type === 'beit_media') {
                $arabic_title = get_field('media_custom_title_ar', $post_id);
                return $arabic_title ?: $title;
            }
        }

        // For English or if no Arabic title, return English custom title or default title
        if (function_exists('get_field') && $post_type === 'beit_voice') {
            $english_title = get_field('voice_custom_title', $post_id);
            return $english_title ?: $title;
        }

        return $title;
    }
}

if (!function_exists('beit_get_video_embed_url')) {
    /**
     * Convert a video URL into an embeddable URL for lightbox usage.
     */
    function beit_get_video_embed_url(string $url): string
    {
        $trimmed = trim($url);

        if ('' === $trimmed) {
            return '';
        }

        // YouTube watch URLs.
        if (preg_match('~(?:youtube\.com/watch\?v=|youtu\.be/)([\w-]{11})~i', $trimmed, $matches)) {
            return sprintf('https://www.youtube.com/embed/%s?rel=0&showinfo=0', $matches[1]);
        }

        // Vimeo URLs.
        if (preg_match('~vimeo\.com/(?:video/)?(\d+)~i', $trimmed, $matches)) {
            return sprintf('https://player.vimeo.com/video/%s', $matches[1]);
        }

        return esc_url_raw($trimmed);
    }
}

if (!function_exists('beit_get_voice_media_data')) {
    /**
     * Collect media information for a beit_voice post.
     */
    function beit_get_voice_media_data(int $post_id, ?int $fallback_image_id = null): array
    {
        $media_type        = 'image';
        $video_url         = '';
        $video_file        = '';
        $lightbox_caption  = '';

        if (function_exists('get_field')) {
            $type = get_field('voice_media_type', $post_id);
            if ($type) {
                $media_type = $type;
            }

            $video_file       = get_field('voice_media_video_file', $post_id);
            $video_url        = (string) get_field('voice_media_video', $post_id);
            $lightbox_caption = (string) get_field('voice_media_caption', $post_id);
        }

        $thumbnail_id = $fallback_image_id ?: get_post_thumbnail_id($post_id);
        $thumbnail_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'large') : '';

        $lightbox_type = $media_type;
        $lightbox_src  = $thumbnail_url;

        if ('video' === $media_type) {
            $video_source = '';

            if ($video_file) {
                if (is_numeric($video_file)) {
                    $video_source = wp_get_attachment_url((int) $video_file) ?: '';
                } else {
                    $video_source = is_string($video_file) ? $video_file : '';
                }

                if ($video_source) {
                    $lightbox_src  = esc_url_raw($video_source);
                    $lightbox_type = 'video';
                }
            }

            if (!$video_source && $video_url) {
                $embed = beit_get_video_embed_url($video_url);
                if ($embed) {
                    $lightbox_src  = $embed;
                    $lightbox_type = 'video';
                } else {
                    $lightbox_type = 'image';
                }
            }
        }

        if (!$lightbox_src && $thumbnail_url) {
            $lightbox_src  = $thumbnail_url;
            $lightbox_type = 'image';
        }

        return [
            'type'          => $lightbox_type,
            'src'           => $lightbox_src,
            'caption'       => $lightbox_caption,
            'thumbnail_id'  => $thumbnail_id,
            'thumbnail_url' => $thumbnail_url,
        ];
    }
}
