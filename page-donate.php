<?php

/**
 * Donate page template replicating legacy design with dynamic data.
 *
 * @package beit
 *
 * Template Name: Donate Page
 * Template Post Type: page
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) {
    the_post();

    $has_acf = function_exists('get_field');

    $hero_data        = $has_acf ? (get_field('donate_hero') ?: []) : [];
    $hero_title       = $hero_data['title'] ?? get_the_title();
    $hero_subtitle    = get_the_content(); // Use page content as subtitle

    $bank_accounts   = $has_acf ? (get_field('donation_accounts') ?: []) : [];
    $impact_title    = $has_acf ? (get_field('donation_story_title') ?: __('Why Your Donation Matters', 'beit')) : __('Why Your Donation Matters', 'beit');
    $impact_intro    = $has_acf ? (get_field('donation_story_intro') ?: '') : '';
    $highlight_cards = $has_acf ? (get_field('donation_highlight_cards') ?: []) : [];
    $callout_data    = $has_acf ? (get_field('donation_callout') ?: []) : [];

    get_template_part(
        'resources/views/components/page-hero',
        null,
        [
            'title'            => $hero_title,
            'description'      => $hero_subtitle,
            'background_classes' => 'bg-gradient-to-br from-red-900 via-slate-900 to-slate-950',
            'height'           => 'py-24',
            'overlay_gradients' => true,
        ]
    );
?>


    <main class="bg-white text-slate-900">
        <div class="container mx-auto grid gap-10 px-4 py-16 lg:grid-cols-[minmax(0,3fr)_minmax(0,2fr)]">
            <section class="space-y-8">
                <div class=" bg-white p-8 shadow-xl shadow-red-100 ltr:text-left rtl:text-right" data-aos="fade-up">
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
                                <div class="bank-card  border border-slate-200 bg-white p-5 shadow-sm transition">
                                    <?php if ($bank_name) : ?>
                                        <h3 class="text-sm font-semibold uppercase tracking-widest text-red-600">
                                            <?php echo esc_html($bank_name); ?></h3>
                                    <?php endif; ?>
                                    <dl class="mt-3 space-y-1 text-sm text-slate-700">
                                        <?php if ($account_name) : ?>
                                            <div class="flex justify-between gap-3">
                                                <dt class="font-semibold text-slate-500"><?php esc_html_e('Account Name', 'beit'); ?>:
                                                </dt>
                                                <dd class="ltr:text-right rtl:text-left"><?php echo esc_html($account_name); ?></dd>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($account_number) : ?>
                                            <div class="flex justify-between gap-3">
                                                <dt class="font-semibold text-slate-500"><?php esc_html_e('Account Number', 'beit'); ?>:
                                                </dt>
                                                <dd class="font-mono text-xs uppercase text-slate-800 ltr:text-right rtl:text-left">
                                                    <?php echo esc_html($account_number); ?></dd>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($iban) : ?>
                                            <div class="flex justify-between gap-3">
                                                <dt class="font-semibold text-slate-500"><?php esc_html_e('IBAN', 'beit'); ?>:</dt>
                                                <dd class="font-mono text-xs uppercase text-slate-800 ltr:text-right rtl:text-left"><?php echo esc_html($iban); ?>
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
                <div class=" bg-red-600 p-6 text-white shadow-xl ltr:text-left rtl:text-right" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="text-xl font-semibold md:text-2xl"><?php esc_html_e('Need Assistance?', 'beit'); ?></h2>
                    <p class="mt-3 text-sm text-white/80">
                        <?php esc_html_e('Our donor relations team is ready to help you process your contribution or answer any questions.', 'beit'); ?>
                    </p>
                    <div class="mt-5 space-y-3 text-sm">
                        <?php if (!empty($contact_details['phone'])) : ?>
                            <div class="flex items-center gap-3">
                                <i class="fa fa-phone"></i>
                                <a class="font-semibold text-white"
                                    href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', (string) $contact_details['phone'])); ?>"><?php echo esc_html($contact_details['phone']); ?></a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($contact_details['email'])) : ?>
                            <div class="flex items-center gap-3">
                                <i class="fa fa-envelope"></i>
                                <a class="font-semibold text-white"
                                    href="mailto:<?php echo esc_attr($contact_details['email']); ?>"><?php echo esc_html($contact_details['email']); ?></a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($contact_details['address'])) : ?>
                            <div class="flex items-start gap-3">
                                <i class="fa fa-location-dot mt-1"></i>
                                <span><?php echo esc_html($contact_details['address']); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (!empty($highlight_cards)) : ?>
                    <div class="grid gap-4" data-aos="fade-up" data-aos-delay="200">
                        <?php foreach ($highlight_cards as $card) :
                            $icon  = $card['icon'] ?? 'fa fa-hand-holding-heart';
                            $title = $card['title'] ?? '';
                            $text  = $card['description'] ?? '';
                        ?>
                            <div class="flex items-start gap-3  bg-white p-5 shadow-lg ltr:text-left rtl:text-right">
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
