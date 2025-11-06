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
        'autoplay'         => 5000,
        'loop'             => true,
        'show_navigation'  => true,
        'show_pagination'  => true,
        'slides'           => [
            [
                'title_prefix'     => 'Because Every',
                'title_highlight'  => 'CHILD',
                'title_suffix'     => 'Matters.',
                'description'      => __('Child Protection and Education show significant humanitarian needs. Many families struggle to meet children and youths’ needs education.', 'beit'),
                'primary_button'   => [
                    'title'  => __('DONATE', 'beit'),
                    'url'    => '#',
                    'target' => '_self',
                ],
                'secondary_button' => [
                    'title'  => __('or Learn More', 'beit'),
                    'url'    => '#',
                    'target' => '_self',
                ],
                'background_image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1920&h=1080&fit=crop',
                'video_url'        => '#',
            ],
        ],
    ];
}

function beit_front_default_initiatives(): array
{
    return [
        'title'    => __('Our <span class="font-bold">Initiatives</span>', 'beit'),
        'subtitle' => __('Building healthier futures, one program at a time.', 'beit'),
        'cta'      => [
            'title'  => __('Read More →', 'beit'),
            'url'    => '#',
            'target' => '_self',
        ],
        'items'    => [
            [
                'title' => "Cash Transfer<br>and Voucher",
                'image' => 'https://images.unsplash.com/photo-1594736797933-d0501ba2fe65?w=300&h=300&fit=crop',
                'icon'  => '',
            ],
            [
                'title' => "Child<br>Protection",
                'image' => 'https://images.unsplash.com/photo-1509099836639-18ba1795216d?w=300&h=300&fit=crop',
                'icon'  => '',
            ],
            [
                'title' => "Water<br>Sanitation",
                'image' => 'https://images.unsplash.com/photo-1491841573634-28140fc7ced7?w=300&h=300&fit=crop',
                'icon'  => '',
            ],
            [
                'title' => "Education<br>Support",
                'image' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=300&h=300&fit=crop',
                'icon'  => '',
            ],
            [
                'title' => "Food<br>Security",
                'image' => 'https://images.unsplash.com/photo-1514996937319-344454492b37?w=300&h=300&fit=crop',
                'icon'  => '',
            ],
            [
                'title' => "Rehabilitation &<br>Reconstruction",
                'image' => 'https://images.unsplash.com/photo-1451976426598-a7593bd6d0b2?w=300&h=300&fit=crop',
                'icon'  => '',
            ],
        ],
    ];
}

function beit_front_default_news(): array
{
    $archive_link = function_exists('get_post_type_archive_link') ? get_post_type_archive_link('beit_news') : '#';

    return [
        'title'    => __('Latest News', 'beit'),
        'subtitle' => __('Sharing progress, announcements and Updates that Keep you Connected.', 'beit'),
        'cta'      => [
            'title'  => __('Read More →', 'beit'),
            'url'    => $archive_link ?: '#',
            'target' => '_self',
        ],
    ];
}

function beit_front_default_programs(): array
{
    return [
        'title'    => __('Programs & Initiatives', 'beit'),
        'subtitle' => __('Comprehensive development programs empowering communities with lasting change.', 'beit'),
        'cta'      => [
            'title'  => __('View All Programs & Projects →', 'beit'),
            'url'    => '#',
            'target' => '_self',
        ],
        'items'    => [
            [
                'category'    => __('Education', 'beit'),
                'title'       => __('Digital Learning Hubs', 'beit'),
                'description' => __('Community-based technology centers bridging the digital divide for youth.', 'beit'),
                'image'       => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=800&h=600&fit=crop',
                'link'        => '#',
            ],
            [
                'category'    => __('Protection', 'beit'),
                'title'       => __('Safe Spaces for Children', 'beit'),
                'description' => __('Holistic psychosocial support and protection services for vulnerable children.', 'beit'),
                'image'       => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=800&h=600&fit=crop',
                'link'        => '#',
            ],
            [
                'category'    => __('Livelihood', 'beit'),
                'title'       => __('Women Entrepreneurs Collective', 'beit'),
                'description' => __('Micro-grants and coaching for women-led community businesses.', 'beit'),
                'image'       => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=800&h=600&fit=cro',
                'link'        => '#',
            ],
        ],
    ];
}

function beit_front_default_newsletter(): array
{
    return [
        'title'       => __('Stay Connected', 'beit'),
        'description' => __('Be the first to know about our emergency responses, campaigns and volunteer opportunities.', 'beit'),
        'placeholder' => __('Enter your email', 'beit'),
        'button'      => __('Subscribe', 'beit'),
        'privacy'     => __('We respect your privacy. Unsubscribe at any time.', 'beit'),
    ];
}

function beit_front_default_facts(): array
{
    return [
        'title'    => __('Facts & Figures', 'beit'),
        'subtitle' => __('Turning data into real community impact—because transparency builds trust.', 'beit'),
        'filters'  => [
            ['label' => '2025', 'highlighted' => true],
            ['label' => '2024', 'highlighted' => false],
            ['label' => '2023', 'highlighted' => false],
        ],
        'items'    => [
            [
                'value' => '240',
                'label' => __('Projects Reached', 'beit'),
            ],
            [
                'value' => '25,000',
                'label' => __('Beneficiaries by Sector', 'beit'),
            ],
            [
                'value' => '376',
                'label' => __('Volunteers Engaged', 'beit'),
            ],
            [
                'value' => '52',
                'label' => __('Working Hours', 'beit'),
            ],
        ],
    ];
}

function beit_front_default_partners(): array
{
    return [
        'title'    => __('Trusted Partners', 'beit'),
        'subtitle' => __('Collaboration that drives change, building hope through partnerships.', 'beit'),
        'items'    => [
            [
                'name' => __('Partner 1', 'beit'),
                'logo' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=300&h=200&fit=crop',
            ],
            [
                'name' => __('Partner 2', 'beit'),
                'logo' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=300&h=200&fit=crop',
            ],
            [
                'name' => __('Partner 3', 'beit'),
                'logo' => 'https://images.unsplash.com/photo-1523475472560-d2df97ec485c?w=300&h=200&fit=crop',
            ],
            [
                'name' => __('Partner 4', 'beit'),
                'logo' => 'https://images.unsplash.com/photo-1487058792275-0ad4aaf24ca7?w=300&h=200&fit=crop',
            ],
            [
                'name' => __('Partner 5', 'beit'),
                'logo' => 'https://images.unsplash.com/photo-1522252234503-e356532cafd5?w=300&h=200&fit=crop',
            ],
            [
                'name' => __('Partner 6', 'beit'),
                'logo' => 'https://images.unsplash.com/photo-1523475472560-d2df97ec485c?w=300&h=200&fit=crop',
            ],
        ],
    ];
}

function beit_front_default_voices(): array
{
    return [
        'title'    => __('Voices & Visions', 'beit'),
        'subtitle' => __('Real people. Real stories. Real impact.', 'beit'),
    ];
}

function beit_front_default_our_story(): array
{
    return [
        'title'       => __('Discover Our STORY!', 'beit'),
        'tagline'     => __('Serving humanity with DIGNITY, COMPASSION and HOPE', 'beit'),
        'description' => __('The Beit Lahia for Development Association is an independent charitable organization in Gaza that operates on humanitarian development principles and international standards across education, health, and human development.', 'beit'),
        'image'       => 'https://images.unsplash.com/photo-1490135900376-4b6b31f0946b?w=800&h=600&fit=crop',
        'button'      => [
            'title'  => __('Read More', 'beit'),
            'url'    => '#',
            'target' => '_self',
        ],
    ];
}
