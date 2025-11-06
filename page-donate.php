<?php

/**
 * Donate page template replicating legacy design with dynamic data.
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

    $has_acf = function_exists('get_field');

    $hero_data        = $has_acf ? (get_field('donate_hero') ?: []) : [];
    $hero_eyebrow     = $hero_data['eyebrow'] ?? __('Donate Information', 'beit');
    $hero_title       = $hero_data['title'] ?? get_the_title();
    $hero_subtitle    = $hero_data['subtitle'] ?? __('Empowering hope and resilience across Gaza.', 'beit');
    $hero_background  = $hero_data['background'] ?? '';
    if ($hero_background && is_numeric($hero_background)) {
        $hero_background = wp_get_attachment_image_url((int) $hero_background, 'full') ?: '';
    }

    $gradient_layer = 'linear-gradient(135deg, rgba(139,0,0,0.9), rgba(220,20,60,0.7), rgba(0,0,0,0.8))';
    $default_pattern = "url('data:image/svg+xml,%3Csvg xmlns=\"http://www.w3.org/2000/svg\" width=\"1200\" height=\"400\"%3E%3Cdefs%3E%3CradialGradient id=\"grad\"%3E%3Cstop offset=\"0%25\" style=\"stop-color:rgb(139,0,0);stop-opacity:0.8\"/%3E%3Cstop offset=\"100%25\" style=\"stop-color:rgb(0,0,0);stop-opacity:1\"/%3E%3C/radialGradient%3E%3C/defs%3E%3Crect width=\"1200\" height=\"400\" fill=\"url(%23grad)\"/%3E%3C/svg%3E')";
    $hero_background_style = $hero_background ? $gradient_layer . ', url(' . esc_url($hero_background) . ')' : $gradient_layer . ', ' . $default_pattern;

    $bank_accounts   = $has_acf ? (get_field('donation_accounts') ?: []) : [];
    $impact_title    = $has_acf ? (get_field('donation_story_title') ?: __('Why Your Donation Matters', 'beit')) : __('Why Your Donation Matters', 'beit');
    $impact_intro    = $has_acf ? (get_field('donation_story_intro') ?: '') : '';
    $highlight_cards = $has_acf ? (get_field('donation_highlight_cards') ?: []) : [];
    $callout_data    = $has_acf ? (get_field('donation_callout') ?: []) : [];

?>

    <section class="hero-bar relative overflow-hidden bg-cover bg-center py-20 text-white"
        style="background-image: <?php echo esc_attr($hero_background_style); ?>;">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl space-y-4">
                <span
                    class="inline-flex items-center gap-3 rounded-full bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                    <?php echo esc_html($hero_eyebrow); ?>
                </span>
                <h1 class="text-4xl font-bold md:text-6xl"><?php echo esc_html($hero_title); ?></h1>
                <?php if ($hero_subtitle) : ?>
                    <p class="text-lg font-light text-white/90 md:text-xl"><?php echo esc_html($hero_subtitle); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <main class="bg-white text-slate-900">
        <div class="container mx-auto grid gap-10 px-4 py-16 lg:grid-cols-[minmax(0,3fr)_minmax(0,2fr)]">
            <section class="space-y-8">
                <div class="rounded-3xl bg-white p-8 shadow-xl shadow-red-100">
                    <h2 class="text-2xl font-semibold text-red-700 md:text-3xl">
                        <?php esc_html_e('Direct Bank Transfer', 'beit'); ?></h2>
                    <p class="mt-4 text-sm text-slate-600">
                        <?php esc_html_e('Support Beit Lahia Association by transferring to any of the following accounts. Please include your contact details for acknowledgement.', 'beit'); ?>
                    </p>

                    <?php if (!empty($bank_accounts)) : ?>
                        <div class="mt-6 grid gap-4 md:grid-cols-2">
                            <?php foreach ($bank_accounts as $account) :
                                $bank_name      = $account['bank_name'] ?? '';
                                $account_name   = $account['account_name'] ?? '';
                                $account_number = $account['account_number'] ?? '';
                                $iban           = $account['iban'] ?? '';
                                $notes          = $account['notes'] ?? '';
                            ?>
                                <div class="bank-card rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition">
                                    <?php if ($bank_name) : ?>
                                        <h3 class="text-sm font-semibold uppercase tracking-widest text-red-600">
                                            <?php echo esc_html($bank_name); ?></h3>
                                    <?php endif; ?>
                                    <dl class="mt-3 space-y-1 text-sm text-slate-700">
                                        <?php if ($account_name) : ?>
                                            <div class="flex justify-between gap-3">
                                                <dt class="font-semibold text-slate-500"><?php esc_html_e('Account Name', 'beit'); ?>:
                                                </dt>
                                                <dd class="text-right"><?php echo esc_html($account_name); ?></dd>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($account_number) : ?>
                                            <div class="flex justify-between gap-3">
                                                <dt class="font-semibold text-slate-500"><?php esc_html_e('Account Number', 'beit'); ?>:
                                                </dt>
                                                <dd class="font-mono text-xs uppercase text-slate-800">
                                                    <?php echo esc_html($account_number); ?></dd>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($iban) : ?>
                                            <div class="flex justify-between gap-3">
                                                <dt class="font-semibold text-slate-500"><?php esc_html_e('IBAN', 'beit'); ?>:</dt>
                                                <dd class="font-mono text-xs uppercase text-slate-800"><?php echo esc_html($iban); ?>
                                                </dd>
                                            </div>
                                        <?php endif; ?>
                                    </dl>
                                    <?php if ($notes) : ?>
                                        <p class="mt-3 text-xs text-slate-500"><?php echo esc_html($notes); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    <?php else : ?>
                        <p class="mt-4 text-sm text-slate-500">
                            <?php esc_html_e('Add your bank account details in the page settings to display them here.', 'beit'); ?>
                        </p>
                    <?php endif; ?>
                </div>


            </section>

            <aside class="space-y-6">
                <div class="rounded-3xl bg-red-600 p-6 text-white shadow-xl">
                    <h2 class="text-xl font-semibold md:text-2xl"><?php esc_html_e('Need Assistance?', 'beit'); ?></h2>
                    <p class="mt-3 text-sm text-white/80">
                        <?php esc_html_e('Our donor relations team is ready to help you process your contribution or answer any questions.', 'beit'); ?>
                    </p>
                    <div class="mt-5 space-y-3 text-sm">
                        <?php if (!empty($contact_details['phone'])) : ?>
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-phone"></i>
                                <a class="font-semibold text-white"
                                    href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', (string) $contact_details['phone'])); ?>"><?php echo esc_html($contact_details['phone']); ?></a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($contact_details['email'])) : ?>
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-envelope"></i>
                                <a class="font-semibold text-white"
                                    href="mailto:<?php echo esc_attr($contact_details['email']); ?>"><?php echo esc_html($contact_details['email']); ?></a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($contact_details['address'])) : ?>
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-location-dot mt-1"></i>
                                <span><?php echo esc_html($contact_details['address']); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (!empty($highlight_cards)) : ?>
                    <div class="grid gap-4">
                        <?php foreach ($highlight_cards as $card) :
                            $icon  = $card['icon'] ?? 'fa-solid fa-hand-holding-heart';
                            $title = $card['title'] ?? '';
                            $text  = $card['description'] ?? '';
                        ?>
                            <div class="flex items-start gap-3 rounded-2xl bg-white p-5 shadow-lg">
                                <span class="rounded bg-red-600 p-3 text-white"><i
                                        class="<?php echo esc_attr($icon); ?> text-lg"></i></span>
                                <div>
                                    <?php if ($title) : ?>
                                        <h3 class="font-semibold text-slate-900"><?php echo esc_html($title); ?></h3>
                                    <?php endif; ?>
                                    <?php if ($text) : ?>
                                        <p class="text-sm text-slate-600"><?php echo esc_html($text); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                <?php endif; ?>
            </aside>
        </div>

        <section class="bg-gray-900 py-16 text-white">
            <div class="container mx-auto px-4">
                <div class="mx-auto max-w-4xl space-y-6 text-center">
                    <h2 class="text-3xl font-bold md:text-4xl"><?php echo esc_html($impact_title); ?></h2>
                    <?php if ($impact_intro) : ?>
                        <p class="text-base text-white/80 md:text-lg"><?php echo esc_html($impact_intro); ?></p>
                    <?php endif; ?>
                    <div class="prose prose-invert mx-auto max-w-none">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>

        <?php
        if (!empty($callout_data['title']) || !empty($callout_data['description'])) {
            get_template_part(
                'resources/views/sections/donate-callout',
                null,
                [
                    'title'       => $callout_data['title'] ?? __('Ready to make a difference?', 'beit'),
                    'description' => $callout_data['description'] ?? __('Every donation amplifies our impact across Gaza.', 'beit'),
                    'button_text' => $callout_data['button']['title'] ?? __('Donate Now', 'beit'),
                    'button_url'  => !empty($callout_data['button']['url']) ? $callout_data['button']['url'] : '#',
                ]
            );
        }
        ?>
    </main>
<?php
}

get_footer();
