<?php

/**
 * Default content scaffolding for the custom front page layout.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

function beit_front_default_hero(): array
{
    return [
        'autoplay' => 8000,
        'loop' => true,
        'show_navigation' => true,
        'show_pagination' => true,
        'slides' => [
            [
                'title' => __('Because Every', 'beit'),
                'description' => __('Child Protection and Education show significant humanitarian needs. Many families struggle to meet children and youths\' needs education.', 'beit'),
                'primary_button' => [
                    'title' => __('DONATE', 'beit'),
                    'url' => '#',
                    'target' => '_self',
                ],
             
                'background_image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1920&h=1080&fit=crop',
                'video_url' => '#',
            ],
        ],
    ];
}

function beit_front_default_news(): array
{
    $archive_link = function_exists('get_post_type_archive_link') ? get_post_type_archive_link('beit_news') : '#';

    return [
        'title' => __('Latest News', 'beit'),
        'subtitle' => __('Sharing progress, announcements and Updates that Keep you Connected.', 'beit'),
        'cta' => [
            'title' => '',
            'url' => $archive_link ?: '#',
            'target' => '_self',
        ],
    ];
}

function beit_front_default_programs(): array
{
    return [
        'title' => __('Programs & Initiatives', 'beit'),
        'subtitle' => __('Comprehensive development programs empowering communities with lasting change.', 'beit'),
        'cta' => [
            'title' => __('View All Programs & Projects →', 'beit'),
            'url' => '#',
            'target' => '_self',
        ],
        'items' => [
            [
                'category' => __('Education', 'beit'),
                'title' => __('Digital Learning Hubs', 'beit'),
                'description' => __('Community-based technology centers bridging the digital divide for youth.', 'beit'),
                'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=800&h=600&fit=crop',
                'link' => '#',
            ],
            [
                'category' => __('Protection', 'beit'),
                'title' => __('Safe Spaces for Children', 'beit'),
                'description' => __('Holistic psychosocial support and protection services for vulnerable children.', 'beit'),
                'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=800&h=600&fit=crop',
                'link' => '#',
            ],
            [
                'category' => __('Livelihood', 'beit'),
                'title' => __('Women Entrepreneurs Collective', 'beit'),
                'description' => __('Micro-grants and coaching for women-led community businesses.', 'beit'),
                'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=800&h=600&fit=cro',
                'link' => '#',
            ],
        ],
    ];
}

function beit_front_default_newsletter(): array
{
    return [
        'title' => __('Stay Connected', 'beit'),
        'description' => __('Be the first to know about our emergency responses, campaigns and volunteer opportunities.', 'beit'),
        'placeholder' => __('Enter your email', 'beit'),
        'button' => __('Subscribe', 'beit'),
        'privacy' => __('We respect your privacy. Unsubscribe at any time.', 'beit'),
    ];
}

function beit_front_default_members(): array
{
    return [
        'title' => __('Trusted Members', 'beit'),
        'subtitle' => __('Collaboration that drives change, building hope through memberships.', 'beit'),
        'items' => [
            [
                'name' => __('Member 1', 'beit'),
                'logo' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=300&h=200&fit=crop',
            ],
            [
                'name' => __('Member 2', 'beit'),
                'logo' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=300&h=200&fit=crop',
            ],
            [
                'name' => __('Member 3', 'beit'),
                'logo' => 'https://images.unsplash.com/photo-1523475472560-d2df97ec485c?w=300&h=200&fit=crop',
            ],
            [
                'name' => __('Member 4', 'beit'),
                'logo' => 'https://images.unsplash.com/photo-1487058792275-0ad4aaf24ca7?w=300&h=200&fit=crop',
            ],
            [
                'name' => __('Member 5', 'beit'),
                'logo' => 'https://images.unsplash.com/photo-1522252234503-e356532cafd5?w=300&h=200&fit=crop',
            ],
            [
                'name' => __('Member 6', 'beit'),
                'logo' => 'https://images.unsplash.com/photo-1523475472560-d2df97ec485c?w=300&h=200&fit=crop',
            ],
        ],
    ];
}

function beit_front_default_voices(): array
{
    return [
        'title' => __('Voices & Visions', 'beit'),
        'subtitle' => __('Real people. Real stories. Real impact.', 'beit'),
    ];
}

function beit_front_default_our_story(): array
{
    return [
        'title' => __('Discover Our STORY!', 'beit'),
        'tagline' => __('Serving humanity with DIGNITY, COMPASSION and HOPE', 'beit'),
        'description' => __('The Beit Lahia for Development Association is an independent charitable organization in Gaza that operates on humanitarian development principles and international standards across education, health, and human development.', 'beit'),
        'image' => 'https://images.unsplash.com/photo-1490135900376-4b6b31f0946b?w=800&h=600&fit=crop',
        'button' => [
            'title' => '',
            'url' => '#',
            'target' => '_self',
        ],
    ];
}
