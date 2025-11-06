<?php

/**
 * Our Story spotlight section.
 *
 * @package beit
 */

$data = wp_parse_args(
    $args['data'] ?? [],
    [
        'title'       => '',
        'tagline'     => '',
        'description' => '',
        'image'       => '',
        'button'      => [],
    ]
);

$content_alignment = $args['content_alignment'] ?? '';

?>

<section class="bg-slate-800 py-20 text-white">
    <div class="container mx-auto px-4 md:px-6">
        <div class="grid gap-12 md:grid-cols-2 md:items-center">
            <div>
                <?php if (!empty($data['image'])) : ?>
                    <?php if (is_numeric($data['image'])) : ?>
                        <?php echo wp_get_attachment_image((int) $data['image'], 'large', false, ['class' => 'w-full rounded-2xl object-cover']); ?>
                    <?php else : ?>
                        <img class="w-full rounded-2xl object-cover" src="<?php echo esc_url((string) $data['image']); ?>" alt="">
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (!empty($data['tagline'])) : ?>
                    <div class="mt-6">
                        <h3 class="text-3xl font-bold leading-tight">
                            <?php echo wp_kses($data['tagline'], ['br' => []]); ?>
                        </h3>
                    </div>
                <?php endif; ?>
            </div>

            <div class="space-y-6 <?php echo esc_attr($content_alignment); ?>">
                <?php if (!empty($data['title'])) : ?>
                    <h2 class="text-3xl font-bold md:text-4xl">
                        <?php echo esc_html($data['title']); ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($data['description'])) : ?>
                    <p class="text-base text-white/70 md:text-lg">
                        <?php echo esc_html($data['description']); ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($data['button']['title'])) : ?>
                    <a class="inline-flex items-center gap-2 rounded-full bg-red-600 px-6 py-3 text-sm font-semibold uppercase tracking-wide text-white transition hover:bg-red-700" href="<?php echo esc_url($data['button']['url'] ?? '#'); ?>" target="<?php echo esc_attr($data['button']['target'] ?? '_self'); ?>" rel="noopener">
                        <?php echo esc_html($data['button']['title']); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
