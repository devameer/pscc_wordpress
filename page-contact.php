<?php

/**
 * Contact page template.
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

    $hero_title = get_the_title();
    $hero_description = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true) ?: get_post_field('post_excerpt', get_the_ID());

    get_template_part(
        'resources/views/components/page-hero',
        null,
        [
            'title'       => $hero_title,
            'description' => $hero_description,
            'eyebrow'     => __('Get in touch', 'beit'),
            'background_classes' => 'bg-slate-900',
        ]
    );

    $contact_details = get_field('contact_details') ?: [];
    $offices         = get_field('contact_offices') ?: [];
    $form_shortcode  = get_field('contact_form_shortcode');
    ?>

    <main class="bg-slate-50 text-slate-900">
        <div class="container mx-auto grid gap-10 px-4 py-16 md:grid-cols-[minmax(0,2fr)_minmax(0,1fr)] md:px-6">
            <article class="space-y-10">
                <div class="rounded-3xl bg-white p-8 shadow-xl">
                    <h2 class="text-xl font-semibold text-red-700 md:text-2xl"><?php esc_html_e('Contact Information', 'beit'); ?></h2>
                    <div class="mt-6 space-y-5 text-sm text-slate-600">
                        <?php if (!empty($contact_details['email'])) : ?>
                            <div class="flex items-center gap-3">
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-red-50 text-red-600">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <a class="font-semibold text-slate-800 hover:text-red-600" href="mailto:<?php echo esc_attr($contact_details['email']); ?>">
                                    <?php echo esc_html($contact_details['email']); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($contact_details['phone'])) : ?>
                            <div class="flex items-center gap-3">
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-red-50 text-red-600">
                                    <i class="fa-solid fa-phone"></i>
                                </span>
                                <a class="font-semibold text-slate-800 hover:text-red-600" href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', (string) $contact_details['phone'])); ?>">
                                    <?php echo esc_html($contact_details['phone']); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($contact_details['address'])) : ?>
                            <div class="flex items-start gap-3">
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-red-50 text-red-600">
                                    <i class="fa-solid fa-location-dot"></i>
                                </span>
                                <span class="font-semibold text-slate-800"><?php echo esc_html($contact_details['address']); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($contact_details['hours'])) : ?>
                            <div class="flex items-start gap-3">
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-red-50 text-red-600">
                                    <i class="fa-solid fa-clock"></i>
                                </span>
                                <span class="text-slate-700"><?php echo esc_html($contact_details['hours']); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (!empty($offices)) : ?>
                    <div class="space-y-6">
                        <h2 class="text-xl font-semibold text-red-700 md:text-2xl"><?php esc_html_e('Our Offices', 'beit'); ?></h2>
                        <div class="grid gap-6 md:grid-cols-2">
                            <?php foreach ($offices as $office) : ?>
                                <div class="rounded-3xl bg-white p-6 shadow-lg">
                                    <h3 class="text-lg font-semibold text-slate-900"><?php echo esc_html($office['name'] ?? ''); ?></h3>
                                    <?php if (!empty($office['address'])) : ?>
                                        <p class="mt-2 text-sm text-slate-600"><?php echo esc_html($office['address']); ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($office['map_link'])) : ?>
                                        <a class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-red-600 hover:text-red-700" href="<?php echo esc_url($office['map_link']); ?>" target="_blank" rel="noopener">
                                            <i class="fa-solid fa-map"></i>
                                            <?php esc_html_e('View on Map', 'beit'); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="rounded-3xl bg-white p-8 shadow-xl">
                    <h2 class="text-xl font-semibold text-red-700 md:text-2xl"><?php esc_html_e('Send us a message', 'beit'); ?></h2>
                    <div class="mt-4">
                        <?php
                        if ($form_shortcode) {
                            echo do_shortcode($form_shortcode);
                        } else {
                            the_content();
                        }
                        ?>
                    </div>
                </div>
            </article>

            <?php if (have_rows('contact_cards')) : ?>
                <aside class="space-y-6">
                    <?php while (have_rows('contact_cards')) : the_row(); ?>
                        <div class="rounded-3xl bg-white p-6 shadow-lg">
                            <h3 class="text-lg font-semibold text-slate-900"><?php echo esc_html(get_sub_field('title')); ?></h3>
                            <p class="mt-2 text-sm text-slate-600"><?php echo esc_html(get_sub_field('description')); ?></p>
                            <?php if ($link = get_sub_field('link')) : ?>
                                <a class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-red-600 hover:text-red-700" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ?? '_self'); ?>" rel="noopener">
                                    <?php echo esc_html($link['title']); ?>
                                    <i class="fa-solid fa-arrow-<?php echo $is_rtl ? 'left' : 'right'; ?> text-xs"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </aside>
            <?php endif; ?>
        </div>
    </main>
    <?php
}

get_footer();
