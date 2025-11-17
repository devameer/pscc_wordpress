<?php

/**
 * Donate callout / summary block.
 *
 * @package beit
 */

$args = wp_parse_args(
    $args ?? [],
    [
        'title'       => __('Donate to Beit Lahia', 'beit'),
        'description' => __('Your contribution empowers our humanitarian and development programs across Gaza.', 'beit'),
        'button_text' => __('Donate Now', 'beit'),
        'button_url'  => '#',
    ]
);

?>

<section class="bg-gradient-to-r from-red-600 via-red-500 to-amber-400 py-16 text-white">
    <div class="container mx-auto px-4 md:px-6">
        <div class="mx-auto max-w-3xl space-y-6 text-center">
            <h2 class="text-3xl font-bold md:text-4xl"><?php echo esc_html($args['title']); ?></h2>
            <p class="text-base text-white/90 md:text-lg"><?php echo esc_html($args['description']); ?></p>
            <a class="inline-flex items-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-semibold text-red-600 transition hover:bg-white/90" href="<?php echo esc_url($args['button_url']); ?>">
                <?php echo esc_html($args['button_text']); ?>
                <i class="fa fa-heart text-xs"></i>
            </a>
        </div>
    </div>
</section>
