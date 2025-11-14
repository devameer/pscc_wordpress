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

<section class="bg-[#282828] text-white">
    <div class="px-4 py-12 md:px-6 md:py-16 lg:py-20">
        <div class="grid gap-8 md:gap-12 md:grid-cols-2 md:items-center">
            <div class="relative" data-aos="fade-right">
                <?php if (!empty($data['image'])) : ?>
                    <?php if (is_numeric($data['image'])) : ?>
                        <?php echo wp_get_attachment_image((int) $data['image'], 'large', false, ['class' => 'w-full md:rounded-2xl object-cover']); ?>
                    <?php else : ?>
                        <img class="w-full md:rounded-2xl object-cover" src="<?php echo esc_url((string) $data['image']); ?>" alt="">
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (!empty($data['tagline'])) : ?>
                    <div class="absolute bottom-4 right-4 md:bottom-8 md:right-10 px-3 py-2 md:px-4 rounded-tr-xl rounded-br-xl w-full max-w-xs md:max-w-sm">
                        <h3 class="text-2xl md:text-3xl font-light leading-tight">
                            <?php echo wp_kses_post($data['tagline']); ?>
                        </h3>
                    </div>
                <?php endif; ?>
            </div>

            <div class="space-y-4 md:space-y-6 px-4 md:px-0 <?php echo esc_attr($content_alignment); ?>" data-aos="fade-left" data-aos-delay="200">
                <?php if (!empty($data['title'])) : ?>
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold">
                        <?php echo esc_html($data['title']); ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($data['description'])) : ?>
                    <p class="text-sm md:text-base lg:text-lg text-white/70">
                        <?php echo esc_html($data['description']); ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($data['button']['title'])) : ?>
                    <a class="inline-flex items-center gap-2 rounded-full bg-red-600 px-4 py-2 md:px-6 md:py-3 text-xs md:text-sm font-semibold uppercase tracking-wide text-white transition hover:bg-red-700" href="<?php echo esc_url($data['button']['url'] ?? '#'); ?>" target="<?php echo esc_attr($data['button']['target'] ?? '_self'); ?>" rel="noopener">
                        <?php echo esc_html($data['button']['title']); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>