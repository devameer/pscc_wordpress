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

<section class="bg-[#282828] text-white overflow-hidden">
    <div class=" mx-auto ">
        <div class="grid gap-8 md:gap-12 md:grid-cols-2 md:items-center">
            <div class="relative overflow-hidden" data-aos="fade-right">
                <?php if (!empty($data['image'])) : ?>
                    <?php if (is_numeric($data['image'])) : ?>
                        <?php echo wp_get_attachment_image((int) $data['image'], 'large', false, ['class' => 'w-full object-cover']); ?>
                    <?php else : ?>
                        <img class="w-full object-cover" src="<?php echo esc_url((string) $data['image']); ?>" alt="" loading="lazy" decoding="async">
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (!empty($data['tagline'])) : ?>
                    <div class="absolute bottom-4  right-4 md:bottom-8  px-3 py-2 md:px-4 rounded-xl max-w-xs md:max-w-sm">
                        <h3 class="text-2xl md:text-3xl font-light leading-tight">
                            <?php echo wp_kses_post($data['tagline']); ?>
                        </h3>
                    </div>
                <?php endif; ?>
            </div>

            <div class="space-y-4 md:space-y-6 <?php echo esc_attr($content_alignment); ?> max-w-lg mx-auto" data-aos="fade-left" data-aos-delay="200">
                <?php if (!empty($data['title'])) : ?>
                    <h2 class="text-2xl md:text-3xl lg:text-6xl font-light">
                        <?php echo wp_kses_post($data['title']); ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($data['description'])) : ?>
                    <p class="text-sm md:text-base lg:text-lg text-white/90">
                        <?php echo esc_html($data['description']); ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($data['button']['title'])) : ?>
                    <div class="text-end">
                        <a class="btn-more" href="<?php echo esc_url($data['button']['url'] ?? '#'); ?>" target="<?php echo esc_attr($data['button']['target'] ?? '_self'); ?>" rel="noopener">
                            <?php echo esc_html($data['button']['title']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>