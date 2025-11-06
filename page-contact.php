<?php

/**
 * Contact page template with custom design.
 *
 * @package beit
 *
 * Template Name: Contact Page
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) {
    the_post();

    $has_acf = function_exists('get_field');

    $hero_data       = $has_acf ? (get_field('contact_hero') ?: []) : [];
    $hero_subtitle   = $hero_data['subtitle'] ?? __('TOGETHER, We Make Change Happen.', 'beit');
    $hero_background = $hero_data['background'] ?? '';

    if ($hero_background && is_numeric($hero_background)) {
        $hero_background = wp_get_attachment_image_url((int) $hero_background, 'full') ?: '';
    }

    $hero_overlay = "linear-gradient(rgba(0,0,0,0.6), rgba(60,0,0,0.7))";
    $default_pattern = "url('data:image/svg+xml,%3Csvg width=\"1200\" height=\"400\" xmlns=\"http://www.w3.org/2000/svg\" %3E%3Cdefs%3E%3CradialGradient id=\"grad\" %3E%3Cstop offset=\"0%25\" style=\"stop-color:rgb(139,0,0);stop-opacity:0.8\" /%3E%3Cstop offset=\"100%25\" style=\"stop-color:rgb(0,0,0);stop-opacity:1\" /%3E%3C/radialGradient%3E%3C/defs%3E%3Crect width=\"1200\" height=\"400\" fill=\"url(%23grad)\" /%3E%3C/svg%3E')";
    $hero_background_style = $hero_background ? $hero_overlay . ', url(' . esc_url($hero_background) . ')' : $hero_overlay . ', ' . $default_pattern;

    $contact_details = $has_acf ? (get_field('contact_details') ?: []) : [];
    $social_links    = $has_acf ? (get_field('contact_social_links') ?: []) : [];
    $offices         = $has_acf ? (get_field('contact_offices') ?: []) : [];
    $map_embed       = $has_acf ? get_field('contact_map_embed') : '';
    $form_shortcode  = $has_acf ? get_field('contact_form_shortcode') : '';

    $email   = $contact_details['email'] ?? '';
    $phone   = $contact_details['phone'] ?? '';
    $address = $contact_details['address'] ?? '';
    $hours   = $contact_details['hours'] ?? '';
?>

    <section class="relative h-96 bg-cover bg-center"
        style="background-image: <?php echo esc_attr($hero_background_style); ?>;">
        <div class="container mx-auto flex h-full items-center px-4">
            <div class="max-w-2xl text-white">
                <h1 class="text-4xl font-bold md:text-6xl"><?php the_title(); ?></h1>
                <?php if ($hero_subtitle) : ?>
                    <p class="mt-4 text-xl font-light md:text-2xl"><?php echo esc_html($hero_subtitle); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <main class="bg-gray-50 text-slate-900">
        <div class="container mx-auto grid gap-10 px-4 py-12 lg:grid-cols-[minmax(0,2fr)_minmax(0,1fr)]">
            <section class="rounded-lg bg-white p-8 shadow-sm">
                <h2 class="text-2xl font-bold text-gray-800">
                    <?php esc_html_e('Share Your Thoughts Here', 'beit'); ?>
                </h2>

                <div class="mt-6">
                    <?php
                    if ($form_shortcode) {
                        echo do_shortcode($form_shortcode); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    } else {
                    ?>
                        <form class="space-y-4">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <input type="text" placeholder="<?php esc_attr_e('Your name', 'beit'); ?>"
                                    class="w-full rounded border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-600"
                                    required>
                                <input type="email" placeholder="<?php esc_attr_e('Your email', 'beit'); ?>"
                                    class="w-full rounded border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-600"
                                    required>
                            </div>

                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <input type="text" placeholder="<?php esc_attr_e('Subject', 'beit'); ?>"
                                    class="w-full rounded border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-600">
                                <select
                                    class="w-full rounded border border-gray-300 px-4 py-3 text-gray-500 focus:outline-none focus:ring-2 focus:ring-red-600">
                                    <option value="">
                                        <?php esc_html_e('Reason', 'beit'); ?>
                                    </option>
                                    <option value="general"><?php esc_html_e('General Inquiry', 'beit'); ?></option>
                                    <option value="support"><?php esc_html_e('Support', 'beit'); ?></option>
                                    <option value="partnership"><?php esc_html_e('Partnership', 'beit'); ?></option>
                                </select>
                            </div>

                            <textarea placeholder="<?php esc_attr_e('Your message here...', 'beit'); ?>" rows="6"
                                class="w-full rounded border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-600"></textarea>

                            <div class="flex flex-wrap items-center gap-4">
                                <button type="submit"
                                    class="rounded bg-red-600 px-12 py-3 font-semibold text-white transition hover:bg-red-700">
                                    <?php esc_html_e('Send', 'beit'); ?>
                                </button>
                                <span class="text-gray-500"><?php esc_html_e('or', 'beit'); ?></span>
                                <button type="reset" class="font-semibold text-red-600 underline hover:text-red-700">
                                    <?php esc_html_e('Clear', 'beit'); ?>
                                </button>
                            </div>
                        </form>
                    <?php
                    }
                    ?>
                </div>
            </section>

            <aside class="space-y-6">
                <div class="space-y-4">
                    <h2 class="text-2xl font-bold text-gray-800"><?php esc_html_e('Our Offices', 'beit'); ?></h2>
                    <?php if (!empty($offices)) : ?>
                        <div class="space-y-4">
                            <?php foreach ($offices as $office) :
                                $office_name    = $office['name'] ?? '';
                                $office_address = $office['address'] ?? '';
                                $map_link       = $office['map_link'] ?? '';
                            ?>
                                <div class="rounded-lg bg-white p-4 shadow-sm">
                                    <?php if ($office_name) : ?>
                                        <h3 class="text-lg font-semibold text-gray-800"><?php echo esc_html($office_name); ?></h3>
                                    <?php endif; ?>
                                    <?php if ($office_address) : ?>
                                        <p class="mt-2 text-sm text-gray-600"><?php echo esc_html($office_address); ?></p>
                                    <?php endif; ?>
                                    <?php if ($map_link) : ?>
                                        <a class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-red-600 hover:text-red-700"
                                            href="<?php echo esc_url($map_link); ?>" target="_blank" rel="noopener">
                                            <i class="fa-solid fa-map"></i>
                                            <?php esc_html_e('View on Map', 'beit'); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="h-64 overflow-hidden rounded-lg bg-gray-200 shadow-sm">
                    <?php
                    if ($map_embed) {
                        echo wp_kses_post($map_embed);
                    } else {
                    ?>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3385.5!2d34.5!3d31.5!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzHCsDMwJzAwLjAiTiAzNMKwMzAnMDAuMCJF!5e0!3m2!1sen!2s!4v1234567890"
                            width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy"></iframe>
                    <?php
                    }
                    ?>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="flex items-start gap-3 rounded-lg border-l-4 border-red-600 bg-white p-6 shadow-sm">
                        <span class="rounded bg-red-600 p-3 text-white"><i class="fa-solid fa-globe text-xl"></i></span>
                        <div>
                            <h3 class="mb-2 font-bold text-gray-800"><?php esc_html_e('Social', 'beit'); ?></h3>
                            <div class="flex flex-wrap gap-3 text-gray-700">
                                <?php
                                if (!empty($social_links)) {
                                    foreach ($social_links as $social) {
                                        $icon = $social['icon'] ?? '';
                                        $url  = $social['url'] ?? '#';
                                        if (!$icon) {
                                            continue;
                                        }
                                ?>
                                        <a class="transition hover:text-red-600" href="<?php echo esc_url($url); ?>" target="_blank"
                                            rel="noopener">
                                            <i class="<?php echo esc_attr($icon); ?>"></i>
                                        </a>
                                <?php
                                    }
                                } else {
                                    $defaults = ['fa-brands fa-facebook-f', 'fa-brands fa-instagram', 'fa-brands fa-x-twitter', 'fa-brands fa-linkedin-in', 'fa-brands fa-youtube'];
                                    foreach ($defaults as $icon) {
                                        echo '<span class="transition hover:text-red-600"><i class="' . esc_attr($icon) . '"></i></span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php if ($phone) : ?>
                        <div class="flex items-start gap-3 rounded-lg border-l-4 border-red-600 bg-white p-6 shadow-sm">
                            <span class="rounded bg-red-600 p-3 text-white"><i class="fa-solid fa-phone text-xl"></i></span>
                            <div>
                                <h3 class="mb-2 font-bold text-gray-800"><?php esc_html_e('Phone', 'beit'); ?></h3>
                                <a class="text-gray-700"
                                    href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', (string) $phone)); ?>"><?php echo esc_html($phone); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($email) : ?>
                        <div class="flex items-start gap-3 rounded-lg border-l-4 border-red-600 bg-white p-6 shadow-sm">
                            <span class="rounded bg-red-600 p-3 text-white"><i class="fa-solid fa-envelope text-xl"></i></span>
                            <div>
                                <h3 class="mb-2 font-bold text-gray-800"><?php esc_html_e('Email', 'beit'); ?></h3>
                                <a class="text-gray-700"
                                    href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($address) : ?>
                        <div class="flex items-start gap-3 rounded-lg border-l-4 border-red-600 bg-white p-6 shadow-sm">
                            <span class="rounded bg-red-600 p-3 text-white"><i
                                    class="fa-solid fa-map-marker-alt text-xl"></i></span>
                            <div>
                                <h3 class="mb-2 font-bold text-gray-800"><?php esc_html_e('Address', 'beit'); ?></h3>
                                <p class="text-gray-700"><?php echo esc_html($address); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($hours) : ?>
                        <div class="flex items-start gap-3 rounded-lg border-l-4 border-red-600 bg-white p-6 shadow-sm">
                            <span class="rounded bg-red-600 p-3 text-white"><i class="fa-solid fa-clock text-xl"></i></span>
                            <div>
                                <h3 class="mb-2 font-bold text-gray-800"><?php esc_html_e('Working Hours', 'beit'); ?></h3>
                                <p class="text-gray-700"><?php echo esc_html($hours); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </aside>
        </div>


    </main>
<?php
}

get_footer();
