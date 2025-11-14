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
        'subtitle'           => '',
        'eyebrow'            => __('Latest Updates', 'beit'),
        'background_image'   => '',
        'background_classes' => 'bg-slate-950',
        'overlay_gradients'  => true,
        'overlay_style'      => 'default', // 'default', 'contact', 'donate', 'none'
        'height'             => 'pb-24 pt-40', // py-20, py-24, h-96, etc.
    ]
);

$title              = $args['title'];
$description        = $args['description'];
$subtitle           = $args['subtitle'];
$eyebrow            = $args['eyebrow'];
$background_image   = $args['background_image'];
$background_classes = $args['background_classes'];
$overlay_gradients  = (bool) $args['overlay_gradients'];
$overlay_style      = $args['overlay_style'];
$height             = $args['height'];

// Handle background image - can be attachment ID or URL
if ($background_image) {
    if (is_numeric($background_image)) {
        $background_image = wp_get_attachment_image_url((int) $background_image, 'full') ?: '';
    }
}

if (!$title) {
    return;
}

// Build background style
$background_style = '';
if ($background_image) {
    $overlay = '';
    switch ($overlay_style) {
        case 'contact':
            $overlay = "linear-gradient(rgba(0,0,0,0.6), rgba(60,0,0,0.7))";
            $background_style = $overlay . ', url(' . esc_url($background_image) . ')';
            break;
        case 'donate':
            $overlay = 'linear-gradient(135deg, rgba(139,0,0,0.9), rgba(220,20,60,0.7), rgba(0,0,0,0.8))';
            $background_style = $overlay . ', url(' . esc_url($background_image) . ')';
            break;
        case 'none':
            $background_style = 'url(' . esc_url($background_image) . ')';
            break;
        default:
            $overlay = 'linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7))';
            $background_style = $overlay . ', url(' . esc_url($background_image) . ')';
            break;
    }
}

// Determine section classes
$section_classes = ['relative', 'overflow-hidden', 'text-white'];
if ($background_image) {
    $section_classes[] = 'bg-cover';
    $section_classes[] = 'bg-center';
} else {
    $section_classes[] = $background_classes;
}
$section_classes[] = $height;

?>

<section class="<?php echo esc_attr(implode(' ', $section_classes)); ?>"<?php if ($background_style) : ?> style="background-image: <?php echo esc_attr($background_style); ?>;"<?php endif; ?>>
    <?php if ($overlay_gradients && !$background_image) : ?>
        <div class="absolute inset-0">
            <span class="absolute inset-0 bg-gradient-to-r from-red-700/60 via-slate-900/80 to-slate-950"></span>
            <span class="absolute left-[-10%] top-[-20%] h-72 w-72 rounded-full bg-red-500/40 blur-3xl"></span>
            <span class="absolute right-[-15%] bottom-[-30%] h-96 w-96 rounded-full bg-amber-400/30 blur-3xl"></span>
        </div>
    <?php endif; ?>

    <div class="relative z-10 container mx-auto px-4 md:px-6<?php echo $height === 'h-96' ? ' flex h-full items-center' : ''; ?>">
        <div class="max-w-3xl space-y-4">
            <?php if ($eyebrow) : ?>
                <?php if ($overlay_style === 'donate') : ?>
                    <span class="inline-flex items-center gap-3 rounded-full bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                        <?php echo esc_html($eyebrow); ?>
                    </span>
                <?php else : ?>
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                        <?php echo esc_html($eyebrow); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <h1 class="text-3xl font-bold leading-tight md:text-5xl<?php echo $overlay_style === 'contact' ? ' md:text-6xl' : ''; ?>">
                <?php echo esc_html($title); ?>
            </h1>

            <?php if ($subtitle) : ?>
                <p class="mt-4 text-xl font-light text-white/90 md:text-2xl"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>

            <?php if ($description) : ?>
                <div class="text-base text-white/75 md:text-lg<?php echo $overlay_style === 'donate' ? ' text-lg font-light text-white/90 md:text-xl' : ''; ?>">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
