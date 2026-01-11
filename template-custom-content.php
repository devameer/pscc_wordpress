<?php

/**
 * Template Name: Custom Content Page
 * Template Post Type: page
 *
 * Custom page template with flexible content sections
 * that can be managed from the WordPress admin panel.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) {
    the_post();

    $has_acf = function_exists('get_field');

    // Get hero section data
    $hero_data = $has_acf ? (get_field('custom_content_hero') ?: []) : [];
    $hero_title = $hero_data['custom_title'] ?: get_the_title();
    $hero_subtitle = $hero_data['subtitle'] ?? '';
    $hero_description = $hero_data['description'] ?? '';
    $hero_background = $hero_data['background_style'] ?? 'bg-gradient-to-br from-red-800 via-slate-900 to-red-950';

    // Display hero section
    get_template_part(
        'resources/views/components/page-hero',
        null,
        [
            'title' => $hero_title,
            'subtitle' => $hero_subtitle,
            'description' => $hero_description,
            'background_classes' => $hero_background,
            'overlay_gradients' => true,
        ]
    );

    // Get content sections
    $content_sections = $has_acf ? (get_field('content_sections') ?: []) : [];
    ?>

    <main class="bg-gray-50">
        <?php if (!empty($content_sections)): ?>
            <?php foreach ($content_sections as $index => $section):
                $section_type = $section['section_type'] ?? 'text';
                $section_title = $section['title'] ?? '';
                $section_content = $section['content'] ?? '';
                $section_bg = $section['background_color'] ?? 'bg-white';
                $delay = ($index * 100);
                ?>

                <?php if ($section_type === 'text'): ?>
                    <!-- Text Content Section -->
                    <section class="py-12 <?php echo esc_attr($section_bg); ?>">
                        <div class="container mx-auto px-4 md:px-6">
                            <div class="max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay); ?>">
                                <?php if ($section_title): ?>
                                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 ltr:text-left rtl:text-right">
                                        <?php echo esc_html($section_title); ?>
                                    </h2>
                                <?php endif; ?>
                                <div class="prose prose-lg max-w-none text-gray-700 ltr:text-left rtl:text-right">
                                    <?php echo wp_kses_post($section_content); ?>
                                </div>
                            </div>
                        </div>
                    </section>

                <?php elseif ($section_type === 'text_image'): ?>
                    <!-- Text with Image Section -->
                    <?php
                    $image_id = $section['image'] ?? 0;
                    $image_position = $section['image_position'] ?? 'right';
                    $is_rtl = is_rtl();
                    $flex_direction = ($image_position === 'left' && !$is_rtl) || ($image_position === 'right' && $is_rtl)
                        ? 'lg:flex-row-reverse'
                        : 'lg:flex-row';
                    ?>
                    <section class="py-12 <?php echo esc_attr($section_bg); ?>">
                        <div class="container mx-auto px-4 md:px-6">
                            <div class="flex flex-col <?php echo esc_attr($flex_direction); ?> gap-8 items-center">
                                <div class="lg:w-1/2" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay); ?>">
                                    <?php if ($section_title): ?>
                                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 ltr:text-left rtl:text-right">
                                            <?php echo esc_html($section_title); ?>
                                        </h2>
                                    <?php endif; ?>
                                    <div class="prose max-w-none text-gray-700 ltr:text-left rtl:text-right">
                                        <?php echo wp_kses_post($section_content); ?>
                                    </div>
                                </div>
                                <?php if ($image_id): ?>
                                    <div class="lg:w-1/2" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay + 100); ?>">
                                        <?php echo wp_get_attachment_image($image_id, 'large', false, [
                                            'class' => ' shadow-lg w-full h-auto',
                                            'alt' => $section_title,
                                        ]); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>

                <?php elseif ($section_type === 'full_width'): ?>
                    <!-- Full Width Content Section -->
                    <section class="py-12 <?php echo esc_attr($section_bg); ?>">
                        <div class="container mx-auto px-4 md:px-6">
                            <div data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay); ?>">
                                <?php if ($section_title): ?>
                                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 text-center">
                                        <?php echo esc_html($section_title); ?>
                                    </h2>
                                <?php endif; ?>
                                <div class="prose prose-lg max-w-none text-gray-700 ltr:text-left rtl:text-right">
                                    <?php echo wp_kses_post($section_content); ?>
                                </div>
                            </div>
                        </div>
                    </section>

                <?php elseif ($section_type === 'two_columns'): ?>
                    <!-- Two Columns Section -->
                    <?php
                    $column_left = $section['column_left'] ?? '';
                    $column_right = $section['column_right'] ?? '';
                    ?>
                    <section class="py-12 <?php echo esc_attr($section_bg); ?>">
                        <div class="container mx-auto px-4 md:px-6">
                            <?php if ($section_title): ?>
                                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8 text-center" data-aos="fade-up">
                                    <?php echo esc_html($section_title); ?>
                                </h2>
                            <?php endif; ?>
                            <div class="grid md:grid-cols-2 gap-8">
                                <div class="prose max-w-none text-gray-700 ltr:text-left rtl:text-right" data-aos="fade-up"
                                    data-aos-delay="<?php echo esc_attr($delay); ?>">
                                    <?php echo wp_kses_post($column_left); ?>
                                </div>
                                <div class="prose max-w-none text-gray-700 ltr:text-left rtl:text-right" data-aos="fade-up"
                                    data-aos-delay="<?php echo esc_attr($delay + 100); ?>">
                                    <?php echo wp_kses_post($column_right); ?>
                                </div>
                            </div>
                        </div>
                    </section>

                <?php elseif ($section_type === 'cards'): ?>
                    <!-- Cards Grid Section -->
                    <?php $cards = $section['cards'] ?? []; ?>
                    <section class="py-12 <?php echo esc_attr($section_bg); ?>">
                        <div class="container mx-auto px-4 md:px-6">
                            <?php if ($section_title): ?>
                                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8 text-center" data-aos="fade-up">
                                    <?php echo esc_html($section_title); ?>
                                </h2>
                            <?php endif; ?>
                            <?php if ($section_content): ?>
                                <div class="prose max-w-3xl mx-auto text-center mb-12" data-aos="fade-up" data-aos-delay="100">
                                    <?php echo wp_kses_post($section_content); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($cards)): ?>
                                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    <?php foreach ($cards as $card_index => $card):
                                        $card_icon = $card['icon'] ?? 'fa fa-star';
                                        $card_title = $card['title'] ?? '';
                                        $card_description = $card['description'] ?? '';
                                        $card_delay = $delay + ($card_index * 100);
                                        ?>
                                        <div class="bg-white  shadow-md p-6 hover:shadow-xl transition-shadow duration-300" data-aos="fade-up"
                                            data-aos-delay="<?php echo esc_attr($card_delay); ?>">
                                            <?php if ($card_icon): ?>
                                                <div class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center mb-4">
                                                    <i class="<?php echo esc_attr($card_icon); ?> text-xl"></i>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($card_title): ?>
                                                <h3 class="text-xl font-bold text-gray-900 mb-3 ltr:text-left rtl:text-right">
                                                    <?php echo esc_html($card_title); ?>
                                                </h3>
                                            <?php endif; ?>
                                            <?php if ($card_description): ?>
                                                <p class="text-gray-600 ltr:text-left rtl:text-right">
                                                    <?php echo esc_html($card_description); ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </section>
                <?php endif; ?>

            <?php endforeach; ?>

        <?php else: ?>
            <!-- Fallback: Display standard WordPress content if no sections defined -->
            <section class="py-12 bg-white">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="max-w-4xl mx-auto prose prose-lg">
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </main>

    <?php
}

get_footer();
