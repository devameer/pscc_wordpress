<?php

/**
 * Primary site header markup.
 *
 * @package beit
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <style>
        #wpadminbar {
            display: none !important;
        }

        html {
            margin-top: 0 !important;
        }
    </style>
</head>
<?php
$topbar_socials = [];

if (function_exists('get_field')) {
    $topbar_email        = get_field('topbar_email', 'option');
    $topbar_phone        = get_field('topbar_phone', 'option');
    $topbar_search_label = get_field('topbar_search_label', 'option') ?: __('Search', 'beit');
    $donate_link         = get_field('donate_link', 'option');
    $topbar_socials_raw  = get_field('topbar_social_links', 'option');
    $topbar_socials      = is_array($topbar_socials_raw) ? $topbar_socials_raw : [];
} else {
    $topbar_email        = null;
    $topbar_phone        = null;
    $topbar_search_label = __('Search', 'beit');
    $donate_link         = null;
}

$donate_label  = $donate_link['title'] ?? __('Donate', 'beit');
$donate_url    = $donate_link['url'] ?? '#';
$donate_target = $donate_link['target'] ?? '_self';

?>

<body <?php body_class('bg-white'); ?>>
    <?php wp_body_open(); ?>
    <div class="min-h-screen flex flex-col">
        <?php if ($topbar_email || $topbar_phone || !empty($topbar_socials)) : ?>
            <div class="bg-[#4E4E4E] text-slate-200 text-xs">
                <div
                    class="container mx-auto flex flex-col gap-2 px-4 py-2 md:flex-row md:items-center md:justify-between md:px-6">
                    <?php if (!empty($topbar_socials)) : ?>
                        <div class="flex flex-wrap items-center gap-3 text-sm">
                            <?php foreach ($topbar_socials as $social) :
                                $network = $social['network'] ?? '';
                                $url     = $social['url'] ?? '';
                                if (!$network || !$url) {
                                    continue;
                                }

                                switch ($network) {
                                    case 'facebook':
                                        $icon_class = 'fa-brands fa-facebook-f';
                                        break;
                                    case 'twitter':
                                        $icon_class = 'fa-brands fa-x-twitter';
                                        break;
                                    case 'instagram':
                                        $icon_class = 'fa-brands fa-instagram';
                                        break;
                                    case 'youtube':
                                        $icon_class = 'fa-brands fa-youtube';
                                        break;
                                    case 'linkedin':
                                        $icon_class = 'fa-brands fa-linkedin-in';
                                        break;
                                    default:
                                        $icon_class = 'fa-solid fa-link';
                                        break;
                                }
                            ?>
                                <a class="flex items-center justify-center  p-2 text-white transition hover:bg-red-600"
                                    href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener">
                                    <span class="sr-only"><?php echo esc_html(ucwords($network)); ?></span>
                                    <i class="<?php echo esc_attr($icon_class); ?> text-sm"></i>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div class="flex flex-wrap items-center gap-4 md:gap-6">
                        <?php if ($topbar_email) : ?>
                            <a class="flex items-center gap-2 transition hover:text-red-400  "
                                href="mailto:<?php echo esc_attr($topbar_email); ?>">
                                <i class="fa-solid fa-envelope text-sm"></i>
                                <span><?php echo esc_html($topbar_email); ?></span>
                            </a>
                        <?php endif; ?>

                        <?php if ($topbar_phone) :
                            $clean_phone = preg_replace('/\s+/', '', (string) $topbar_phone);
                        ?>
                            <a class="flex items-center gap-2 transition hover:text-red-400"
                                href="tel:<?php echo esc_attr($clean_phone); ?>">
                                <i class="fa-solid fa-phone text-sm"></i>
                                <span><?php echo esc_html($topbar_phone); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="flex items-center ml-auto">
                        <a class="hidden items-center gap-2  border border-white/20 px-4 py-2 text-sm font-semibold text-white transition hover:border-red-500 hover:text-red-400 md:inline-flex"
                            href="<?php echo esc_url(home_url('/?s=')); ?>">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <span><?php echo esc_html($topbar_search_label); ?></span>
                        </a>

                        <a class="hidden  bg-red-600 px-5 py-2 text-sm font-semibold uppercase tracking-wide text-white transition hover:bg-red-700 md:inline-flex"
                            href="<?php echo esc_url($donate_url); ?>" target="<?php echo esc_attr($donate_target); ?>"
                            rel="noopener">
                            <?php echo esc_html($donate_label); ?>
                        </a>

                        <button
                            class="inline-flex items-center justify-center rounded-md border border-white/20 p-2 text-white transition hover:border-red-500 md:hidden"
                            type="button" data-menu-toggle="mobile" aria-expanded="false" aria-controls="mobile-navigation">
                            <span class="sr-only"><?php esc_html_e('Toggle navigation', 'beit'); ?></span>
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-16 6h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <header class="fixed top-10 z-50 w-full text-white transition-all duration-300 ease-in-out" data-scroll-header
            data-scroll-threshold="48">
            <div class="container mx-auto px-4 md:px-6">
                <div class="flex items-center justify-between py-4">
                    <div class="flex items-center gap-3">
                        <?php if (has_custom_logo()) : ?>
                            <div class="w-24">
                                <?php the_custom_logo(); ?>
                            </div>
                        <?php else : ?>
                            <div
                                class="flex h-20 w-20 items-center justify-center rounded-full bg-red-600 text-2xl font-bold">
                                <?php echo esc_html(wp_get_document_title()[0] ?? 'B'); ?>
                            </div>
                        <?php endif; ?>

                        <!-- <div class="hidden text-right md:block">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="text-lg font-semibold tracking-wide text-white transition hover:text-red-400">
                                <?php bloginfo('name'); ?>
                            </a>
                            <?php
                            $description = get_bloginfo('description', 'display');
                            if ($description || is_customize_preview()) :
                            ?>
                                <p class="text-xs text-white/60"><?php echo esc_html($description); ?></p>
                            <?php endif; ?>
                        </div> -->
                    </div>

                    <nav class="hidden items-center md:flex">
                        <?php
                        wp_nav_menu(
                            [
                                'theme_location' => 'primary',
                                'menu_id'        => 'primary-menu',
                                'menu_class'     => 'flex items-center gap-2 lg:gap-4 text-sm uppercase tracking-wide text-white',
                                'container'      => false,
                                'fallback_cb'    => false,
                                'depth'          => 1,
                            ]
                        );
                        ?>

                    </nav>


                </div>
            </div>

            <div id="mobile-navigation" class="hidden border-t border-white/10 bg-slate-950/95 md:hidden">
                <?php
                wp_nav_menu(
                    [
                        'theme_location' => 'primary',
                        'menu_id'        => 'mobile-menu',
                        'menu_class'     => 'flex flex-col gap-2 px-4 py-4 text-sm font-semibold uppercase tracking-wide text-white',
                        'container'      => false,
                        'fallback_cb'    => false,
                        'depth'          => 1,
                    ]
                );
                ?>
                <a class="mx-4 mb-3 flex items-center gap-2 rounded-lg border border-white/20 px-4 py-3 text-sm font-semibold text-white transition hover:border-red-500 hover:bg-white/5"
                    href="<?php echo esc_url(home_url('/?s=')); ?>">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span><?php echo esc_html($topbar_search_label); ?></span>
                </a>
                <div class="flex flex-col gap-3 px-4 pb-4">
                    <a class="flex items-center justify-center rounded-full bg-red-600 px-4 py-2 text-sm font-semibold uppercase tracking-wide text-white transition hover:bg-red-700"
                        href="<?php echo esc_url($donate_url); ?>" target="<?php echo esc_attr($donate_target); ?>"
                        rel="noopener">
                        <?php echo esc_html($donate_label); ?>
                    </a>
                </div>
            </div>
        </header>

        <div id="content" class="site-content flex-1">