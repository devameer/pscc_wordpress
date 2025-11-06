<?php

/**
 * Reusable page hero banner.
 *
 * @package beit
 */

$args = wp_parse_args(
    $args ?? [],
    [
        'title'              => get_the_title(),
        'description'        => '',
        'eyebrow'            => __('Latest Updates', 'beit'),
        'background_classes' => 'bg-slate-950',
        'overlay_gradients'  => true,
    ]
);

$title              = $args['title'];
$description        = $args['description'];
$eyebrow            = $args['eyebrow'];
$background_classes = $args['background_classes'];
$overlay_gradients  = (bool) $args['overlay_gradients'];

if (!$title) {
    return;
}

?>

<section class="relative overflow-hidden <?php echo esc_attr($background_classes); ?> py-24 text-white">
    <?php if ($overlay_gradients) : ?>
        <div class="absolute inset-0">
            <span class="absolute inset-0 bg-gradient-to-r from-red-700/60 via-slate-900/80 to-slate-950"></span>
            <span class="absolute left-[-10%] top-[-20%] h-72 w-72 rounded-full bg-red-500/40 blur-3xl"></span>
            <span class="absolute right-[-15%] bottom-[-30%] h-96 w-96 rounded-full bg-amber-400/30 blur-3xl"></span>
        </div>
    <?php endif; ?>

    <div class="relative z-10 container mx-auto px-4 md:px-6">
        <div class="max-w-3xl space-y-4">
            <?php if ($eyebrow) : ?>
                <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                    <?php echo esc_html($eyebrow); ?>
                </div>
            <?php endif; ?>

            <h1 class="text-3xl font-bold leading-tight md:text-5xl">
                <?php echo esc_html($title); ?>
            </h1>

            <?php if ($description) : ?>
                <div class="text-base text-white/75 md:text-lg">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
