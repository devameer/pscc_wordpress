<?php

/**
 * Our Story spotlight section.
 *
 * @package beit
 */

$data = wp_parse_args(
    $args['data'] ?? [],
    [
        'title' => '',
        'tagline' => '',
        'description' => '',
        'image' => '',
        'button' => [],
    ]
);

$content_alignment = $args['content_alignment'] ?? '';

?>

<section class="bg-[#282828] text-white overflow-hidden">
    <div class="mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 md:items-stretch">
            <!-- Image Column -->
            <div class="relative aspect-[4/3] md:aspect-auto md:min-h-[400px] lg:min-h-[500px] overflow-hidden order-1 md:order-none" 
                 data-aos="<?php echo is_rtl() ? 'fade-left' : 'fade-right'; ?>">
                <?php if (!empty($data['image'])): ?>
                    <?php if (is_numeric($data['image'])): ?>
                        <?php echo wp_get_attachment_image(
                            (int) $data['image'], 
                            'large', 
                            false, 
                            ['class' => 'w-full h-full object-cover absolute inset-0']
                        ); ?>
                    <?php else: ?>
                        <img class="w-full h-full object-cover absolute inset-0" 
                             src="<?php echo esc_url((string) $data['image']); ?>" 
                             alt=""
                             loading="lazy" 
                             decoding="async">
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (!empty($data['tagline'])): ?>
                    <div class="absolute bottom-4 <?php echo is_rtl() ? 'left-4 right-auto' : 'right-4 left-auto'; ?> 
                                sm:bottom-6 md:bottom-8 
                                px-3 py-2 sm:px-4 
                                max-w-[200px] sm:max-w-xs md:max-w-sm
                                bg-black/30 backdrop-blur-sm rounded">
                        <h3 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-normal leading-tight">
                            <?php echo wp_kses_post($data['tagline']); ?>
                        </h3>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Content Column -->
            <div class="flex flex-col justify-center px-6 py-8 sm:px-8 sm:py-10 md:px-10 md:py-12 lg:px-16 lg:py-16 order-2 md:order-none"
                 data-aos="<?php echo is_rtl() ? 'fade-right' : 'fade-left'; ?>" 
                 data-aos-delay="200">
                
                <div class="space-y-4 sm:space-y-5 md:space-y-6 max-w-lg <?php echo esc_attr($content_alignment); ?> ltr:text-left rtl:text-right">
                    <?php if (!empty($data['title'])): ?>
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-normal leading-tight">
                            <?php echo wp_kses_post($data['title']); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if (!empty($data['description'])): ?>
                        <p class="text-sm sm:text-base md:text-lg text-white/90 leading-relaxed">
                            <?php echo esc_html($data['description']); ?>
                        </p>
                    <?php endif; ?>

                    <?php if (!empty($data['button']['title'])): ?>
                        <div class="pt-2 sm:pt-4 ltr:text-right rtl:text-left">
                            <a class="btn-more inline-flex items-center gap-2 text-sm sm:text-base" 
                               href="<?php echo esc_url($data['button']['url'] ?? '#'); ?>"
                               target="<?php echo esc_attr($data['button']['target'] ?? '_self'); ?>" 
                               rel="noopener">
                                <?php echo esc_html($data['button']['title']); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>