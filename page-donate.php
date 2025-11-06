<?php

/**
 * Donate page template.
 *
 * @package beit
 *
 * Template Name: Donate Page
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
            'eyebrow'     => __('Support Beit Lahia', 'beit'),
            'background_classes' => 'bg-gradient-to-r from-red-800 via-red-600 to-emerald-600',
            'overlay_gradients'  => false,
        ]
    );
    ?>

    <main class="bg-gray-50 text-slate-900">
        <div class="container mx-auto px-4 py-16 md:px-6">
            <article class="mx-auto max-w-4xl space-y-12">
                <div class="grid gap-8 md:grid-cols-2">
                    <section class="rounded-3xl bg-white p-8 shadow-xl">
                        <h2 class="text-xl font-semibold text-red-700 md:text-2xl"><?php esc_html_e('Direct Bank Transfer', 'beit'); ?></h2>
                        <p class="mt-4 text-sm text-slate-600">
                            <?php esc_html_e('Support Beit Lahia Association by transferring to any of the following accounts. Ensure you include your contact details for acknowledgement.', 'beit'); ?>
                        </p>

                        <?php if (have_rows('donation_accounts')) : ?>
                            <div class="mt-6 space-y-4">
                                <?php while (have_rows('donation_accounts')) : the_row(); ?>
                                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 shadow-sm">
                                        <h3 class="text-sm font-semibold uppercase tracking-widest text-slate-500"><?php echo esc_html(get_sub_field('bank_name')); ?></h3>
                                        <dl class="mt-3 space-y-1 text-sm">
                                            <div class="flex justify-between gap-4">
                                                <dt class="font-semibold text-slate-600"><?php esc_html_e('Account Name', 'beit'); ?>:</dt>
                                                <dd class="text-slate-800"><?php echo esc_html(get_sub_field('account_name')); ?></dd>
                                            </div>
                                            <div class="flex justify-between gap-4">
                                                <dt class="font-semibold text-slate-600"><?php esc_html_e('Account Number', 'beit'); ?>:</dt>
                                                <dd class="text-slate-800"><?php echo esc_html(get_sub_field('account_number')); ?></dd>
                                            </div>
                                            <?php $iban = get_sub_field('iban'); ?>
                                            <?php if ($iban) : ?>
                                                <div class="flex justify-between gap-4">
                                                    <dt class="font-semibold text-slate-600"><?php esc_html_e('IBAN', 'beit'); ?>:</dt>
                                                    <dd class="text-slate-800">
                                                        <span dir="ltr" class="font-mono text-xs uppercase"><?php echo esc_html($iban); ?></span>
                                                    </dd>
                                                </div>
                                            <?php endif; ?>
                                        </dl>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </section>

                    <section class="rounded-3xl bg-white p-8 shadow-xl">
                        <h2 class="text-xl font-semibold text-red-700 md:text-2xl"><?php esc_html_e('Digital Payment', 'beit'); ?></h2>
                        <p class="mt-4 text-sm text-slate-600"><?php esc_html_e('You can also donate quickly through digital wallets and online payment services listed below.', 'beit'); ?></p>

                        <?php if (have_rows('digital_payments')) : ?>
                            <ul class="mt-6 space-y-4 text-sm">
                                <?php while (have_rows('digital_payments')) : the_row(); ?>
                                    <li class="rounded-2xl border border-slate-200 bg-slate-50 p-4 shadow-sm">
                                        <strong class="text-slate-700"><?php echo esc_html(get_sub_field('service_name')); ?>:</strong>
                                        <span class="ml-2 text-slate-900"><?php echo esc_html(get_sub_field('details')); ?></span>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>
                    </section>
                </div>

                <section class="rounded-3xl bg-white p-8 shadow-xl">
                    <h2 class="text-xl font-semibold text-red-700 md:text-2xl"><?php esc_html_e('Why Your Donation Matters', 'beit'); ?></h2>
                    <div class="mt-4 text-slate-700">
                        <?php the_content(); ?>
                    </div>
                </section>
            </article>
        </div>
    </main>
    <?php
}

get_footer();
