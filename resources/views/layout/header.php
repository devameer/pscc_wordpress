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
    <?php
    // Favicon from ACF
    if (function_exists('get_field')) {
        $favicon_url = get_field('site_favicon', 'option');
        if ($favicon_url) {
            echo '<link rel="icon" type="image/x-icon" href="' . esc_url($favicon_url) . '">';
        }
    }
    wp_head();
    ?>
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
$site_logo         = 0;
$site_logo_scroll  = 0;

if (function_exists('get_field')) {
    $topbar_email        = get_field('topbar_email', 'option');
    $topbar_phone        = get_field('topbar_phone', 'option');
    $topbar_search_label = get_field('topbar_search_label', 'option') ?: __('Search', 'beit');
    $donate_link         = get_field('donate_link', 'option');
    $topbar_socials_raw  = get_field('topbar_social_links', 'option');
    $topbar_socials      = is_array($topbar_socials_raw) ? $topbar_socials_raw : [];
    $site_logo           = get_field('site_logo', 'option') ?: 0;
    $site_logo_scroll    = get_field('site_logo_horizontal', 'option') ?: 0;
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
            <div class="topbar-section bg-[#4E4E4E] text-slate-200 text-[10px] sm:text-xs border-b border-white/20 transition-all duration-300">
                <div class="container mx-auto flex flex-col sm:flex-row px-3  md:px-4 lg:px-6 items-start sm:items-center sm:justify-between">
                    <?php if (!empty($topbar_socials)) : ?>
                        <div class="flex flex-wrap items-center gap-3 md:gap-2 lg:border-r border-b lg:border-b-0 lg:border-l border-white/20 sm:px-2 md:px-3 py-[0.3rem] justify-center lg:justify-start w-full sm:w-auto mb-2 sm:mb-0">
                            <?php foreach ($topbar_socials as $social) :
                                $network = $social['network'] ?? '';
                                $url     = $social['url'] ?? '';
                                if (!$network || !$url) {
                                    continue;
                                }

                                switch ($network) {
                                    case 'facebook':
                                        $icon_class = 'fa fa-facebook-f';
                                        break;
                                    case 'twitter':
                                        $icon_class = 'fa fa-twitter';
                                        break;
                                    case 'instagram':
                                        $icon_class = 'fa fa-instagram';
                                        break;
                                    case 'youtube':
                                        $icon_class = 'fa fa-youtube';
                                        break;
                                    case 'linkedin':
                                        $icon_class = 'fa fa-linkedin';
                                        break;
                                    default:
                                        $icon_class = 'fa-link';
                                        break;
                                }
                            ?>
                                <a class="flex items-center justify-center p-1 sm:p-1.5 md:p-2 text-white transition hover:bg-red-600 rounded"
                                    href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener">
                                    <span class="sr-only"><?php echo esc_html(ucwords($network)); ?></span>
                                    <?php if ($network === 'twitter'): ?>
                                        <?php echo file_get_contents(get_template_directory() . '/resources/assets/images/x.svg'); ?>
                                    <?php else: ?>
                                        <i class="<?php echo esc_attr($icon_class); ?> text-[10px] sm:text-xs md:text-sm"></i>
                                    <?php endif; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div class="flex flex-wrap items-center  mr-auto w-full sm:w-auto justify-between sm:justify-start">
                        <?php if ($topbar_email) : ?>
                            <a class="flex items-center gap-1 sm:gap-1.5 md:gap-2 transition hover:text-red-400 md:border-r border-white/20 py-3 px-3 md:px-6 font-normal flex-col md:flex-row ju"
                                href="mailto:<?php echo esc_attr($topbar_email); ?>">
                                <i class="fa fa-envelope text-[10px] sm:text-xs md:text-sm"></i>
                                <span class="text-[9px] sm:text-[10px] md:text-xs truncate max-w-[120px] sm:max-w-none"><?php echo esc_html($topbar_email); ?></span>
                            </a>
                        <?php endif; ?>

                        <?php if ($topbar_phone) :
                            $clean_phone = preg_replace('/\s+/', '', (string) $topbar_phone);
                        ?>
                            <a class="flex items-center gap-1 sm:gap-1.5 md:gap-2 transition hover:text-red-400 md:border-r border-white/20 py-3 px-3 md:px-6 font-normal flex-col md:flex-row ju"
                                href="tel:<?php echo esc_attr($clean_phone); ?>">
                                <i class="fa fa-phone text-[10px] sm:text-xs md:text-sm"></i>
                                <span class="text-[9px] sm:text-[10px] md:text-xs"><?php echo esc_html($topbar_phone); ?></span>
                            </a>
                        <?php endif; ?>
                        <a class="flex items-center gap-1 sm:gap-1.5 md:gap-2 transition hover:text-red-400 md:border-r border-white/20 py-3 px-3 md:px-6 font-normal flex-col md:flex-row ju"
                            href="#">
                            <i class="fa fa-language text-[10px] sm:text-xs md:text-sm"></i>
                            <span class="text-[9px] sm:text-[10px] md:text-xs">عربي</span>
                        </a>
                        <a class="flex items-center gap-1 sm:gap-1.5 md:gap-2 transition hover:text-red-400 md:border-r border-white/20 py-3 px-3 md:px-6 font-normal flex-col md:flex-row ju"
                            href="#">
                            <i class="fa fa-question-circle-o text-[10px] sm:text-xs md:text-sm"></i>
                            <span class="text-[9px] sm:text-[10px] md:text-xs">FAQs</span>
                        </a>
                    </div>

                    <div class="hidden lg:flex items-center ">
                        <a class="inline-flex items-center gap-2 border-l border-r border-white/20  px-3 py-1.5 lg:px-6 lg:py-[0.9rem] text-xs font-normal text-white transition hover:border-red-500 hover:text-red-400"
                            href="<?php echo esc_url(home_url('/?s=')); ?>">
                            <i class="fa fa-search text-xs"></i>
                            <span><?php echo esc_html($topbar_search_label); ?></span>
                        </a>

                        <a class="inline-flex bg-primary rounded-xs px-4 py-1.5 lg:px-10 lg:py-[0.9rem] text-xs font-normal uppercase tracking-wide text-white transition hover:bg-red-700"
                            href="<?php echo esc_url($donate_url); ?>" target="<?php echo esc_attr($donate_target); ?>"
                            rel="noopener">
                            <?php echo esc_html($donate_label); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <header class="navbar-section fixed w-full text-white transition-all duration-300 ease-in-out z-50" data-scroll-header
            data-scroll-threshold="48" style="top: var(--topbar-height, 0px);">
            <div class="container mx-auto px-3 sm:px-4 md:px-5 lg:px-6">
                <div class="flex items-center justify-between py-2 sm:py-3 md:py-4">
                    <div class="flex items-center gap-2 sm:gap-2.5 md:gap-3 w-full">
                        <?php if ($site_logo || $site_logo_scroll) : ?>
                            <div class="w-14 sm:w-16 md:w-20 lg:w-32 relative  logo-header">
                                <?php if ($site_logo) : ?>
                                    <?php echo wp_get_attachment_image($site_logo, 'medium', false, [
                                        'class' => 'logo-default transition-opacity duration-300',
                                        'alt'   => esc_attr(get_bloginfo('name')),
                                    ]); ?>
                                <?php endif; ?>
                                <?php if ($site_logo_scroll) : ?>
                                    <?php echo wp_get_attachment_image($site_logo_scroll, 'medium', false, [
                                        'class' => 'logo-scroll absolute top-0 left-0 opacity-0 transition-opacity duration-300',
                                        'alt'   => esc_attr(get_bloginfo('name')),
                                    ]); ?>
                                <?php endif; ?>
                            </div>
                        <?php elseif (has_custom_logo()) : ?>
                            <div class="w-14 sm:w-16 md:w-20 lg:w-32 relative -top-5 logo-header">
                                <?php the_custom_logo(); ?>
                            </div>
                        <?php else : ?>
                            <div
                                class="flex h-11 w-11 sm:h-12 sm:w-12 md:h-16 md:w-16 lg:h-20 lg:w-20 items-center justify-center rounded-full bg-red-600 text-base sm:text-lg md:text-xl lg:text-2xl font-bold">
                                <?php echo esc_html(wp_get_document_title()[0] ?? 'B'); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Mobile & Tablet Menu Toggle Button (Next to Logo) -->
                        <button
                            class="ml-auto inline-flex items-center justify-center rounded-md border border-white/20 p-2 sm:p-2.5 text-white transition hover:border-red-500 lg:hidden"
                            type="button" data-menu-toggle="mobile" aria-expanded="false" aria-controls="mobile-navigation">
                            <span class="sr-only"><?php esc_html_e('Toggle navigation', 'beit'); ?></span>
                            <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-16 6h16"></path>
                            </svg>
                        </button>

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

                    <nav class="hidden lg:flex items-center">
                        <?php
                        wp_nav_menu(
                            [
                                'theme_location' => 'primary',
                                'menu_id'        => 'primary-menu',
                                'menu_class'     => 'flex items-center text-xs lg:text-sm uppercase tracking-wide text-white',
                                'container'      => false,
                                'fallback_cb'    => false,
                                'depth'          => 1,
                            ]
                        );
                        ?>
                    </nav>



                </div>
            </div>

            <div id="mobile-navigation" class="hidden border-t border-white/10 bg-slate-950/98 backdrop-blur-md lg:hidden">
                <?php
                wp_nav_menu(
                    [
                        'theme_location' => 'primary',
                        'menu_id'        => 'mobile-menu',
                        'menu_class'     => 'flex flex-col gap-1 px-3 py-3 sm:px-4 sm:py-4 text-xs sm:text-sm font-semibold uppercase tracking-wide text-white',
                        'container'      => false,
                        'fallback_cb'    => false,
                        'depth'          => 1,
                    ]
                );
                ?>
                <div class="px-3 sm:px-4 pb-3 sm:pb-4 space-y-2 block md:hidden">
                    <a class="flex items-center gap-2 rounded-lg border border-white/20 px-3 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm font-semibold text-white transition hover:border-red-500 hover:bg-white/5"
                        href="<?php echo esc_url(home_url('/?s=')); ?>">
                        <i class="fa fa-magnifying-glass text-xs"></i>
                        <span><?php echo esc_html($topbar_search_label); ?></span>
                    </a>

                    <a class="flex items-center justify-center rounded-full bg-red-600 px-5 py-2.5 sm:px-6 sm:py-3 text-xs sm:text-sm font-semibold uppercase tracking-wide text-white transition hover:bg-red-700"
                        href="<?php echo esc_url($donate_url); ?>" target="<?php echo esc_attr($donate_target); ?>"
                        rel="noopener">
                        <?php echo esc_html($donate_label); ?>
                    </a>
                </div>
            </div>
        </header>

        <div id="content" class="site-content flex-1">