<?php

/**
 * Reusable page hero banner.
 *
 * @package beit
 */

$args = wp_parse_args(
    $args ?? [],
    [
        'title' => get_the_title(),
        'description' => '',
        'subtitle' => '',
        'background_image' => '',
        'background_classes' => 'bg-slate-950',
        'overlay_gradients' => true,
        'overlay_style' => 'default', // 'default', 'contact', 'donate', 'none'
        'height' => 'pb-16 pt-40', // py-20, py-24, h-96, etc.
    ]
);

$title = $args['title'];
$description = $args['description'];
$subtitle = $args['subtitle'];
$background_image = $args['background_image'];
$background_classes = $args['background_classes'];
$overlay_gradients = (bool) $args['overlay_gradients'];
$overlay_style = $args['overlay_style'];
$height = $args['height'];

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
$image_path = get_template_directory_uri() . '/resources/assets/images/page-hero.jpg';

if ($background_image) {
    $background_style = 'background-image: url(' . esc_url($background_image) . ');';
} else {
    $background_style = 'background-image: url(' . esc_url($image_path) . ');';
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
<section class="<?php echo esc_attr(implode(' ', $section_classes)); ?>"
    style="<?php echo esc_attr($background_style); ?> background-size: cover; background-position: center;">


    <div
        class="relative z-10 container mx-auto px-4 md:px-6<?php echo $height === 'h-96' ? ' flex h-full items-center' : ''; ?>">
        <div class="max-w-3xl space-y-4 ltr:text-left rtl:text-right">


            <h1 class="text-3xl font-normal !leading-normal md:text-5xl<?php echo $overlay_style === 'contact' ? ' md:text-6xl' : ''; ?>"
                data-aos="fade-up" data-aos-delay="100">
                <?php echo wp_kses_post($title); ?>
            </h1>

            <?php if ($subtitle): ?>
                <p class="mt-4 text-xl font-normal text-white/90 md:text-2xl" data-aos="fade-up" data-aos-delay="200">
                    <?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>

            <?php if ($description): ?>
                <div class="text-white md:text-3xl font-normal" data-aos="fade-up" data-aos-delay="300">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>