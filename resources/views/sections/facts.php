<?php

/**
 * Facts & figures metrics section.
 *
 * @package beit
 */

$args = wp_parse_args(
    $args ?? [],
    [
        'facts' => [
            'title'            => '',
            'subtitle'         => '',
            'years'            => [],
            'background_image' => '',
        ],
    ]
);

$facts = $args['facts'];
$background_image = $facts['background_image'] ?? '';
$background_style = '';

if ($background_image) {
    $background_style = sprintf('background-image: url(%s);', esc_url($background_image));
}

$years = $facts['years'] ?? [];
if (empty($years)) {
    return;
}

// Find default active year
$default_year_id = '';
foreach ($years as $index => $year) {
    if (!empty($year['active'])) {
        $default_year_id = 'year-' . $index;
        break;
    }
}
// If no active year set, use first one
if (!$default_year_id && !empty($years)) {
    $default_year_id = 'year-0';
}

?>

<section class="relative bg-[#7F7F7F] py-12 md:py-16 lg:py-20 text-white bg-cover bg-center bg-no-repeat bg-fixed" <?php if ($background_image) : ?>data-bg="<?php echo esc_url($background_image); ?>" <?php endif; ?>>
    <!-- Overlay -->
    <?php if ($background_image) : ?>
        <div class="absolute inset-0 bg-black/60"></div>
    <?php endif; ?>

    <!-- Content -->
    <div class="container mx-auto px-4 md:px-6 relative z-10">
        <div class="mb-8 md:mb-12 space-y-3 md:space-y-4 text-center" data-aos="fade-up">
            <?php if (!empty($facts['title'])) : ?>
                <h2 class="text-3xl font-light md:text-5xl"><?php echo wp_kses_post($facts['title']); ?></h2>
            <?php endif; ?>
            <?php if (!empty($facts['subtitle'])) : ?>
                <p class="text-base text-white  md:text-lg font-light max-w-sm mx-auto"><?php echo esc_html($facts['subtitle']); ?></p>
            <?php endif; ?>
        </div>

        <!-- Years Tabs -->
        <div class="mb-8 md:mb-12 flex flex-wrap items-center justify-center gap-2 md:gap-3" data-aos="fade-up" data-aos-delay="100">
            <?php foreach ($years as $year_index => $year) :
                $year_label = $year['label'] ?? '';
                $year_id    = 'year-' . $year_index;
                $is_active  = ($year_id === $default_year_id);
                if (!$year_label) {
                    continue;
                }
            ?>
                <button type="button"
                    class="facts-tab-button  px-4 py-1.5 md:px-6 md:py-2 text-xs md:text-sm font-semibold transition <?php echo $is_active ? 'bg-primary text-white' : 'bg-white/10 text-white/70 hover:bg-white/20'; ?>"
                    data-year="<?php echo esc_attr($year_id); ?>"
                    data-active="<?php echo $is_active ? 'true' : 'false'; ?>">
                    <?php echo esc_html($year_label); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Facts Content for Each Year -->
        <?php foreach ($years as $year_index => $year) :
            $year_id    = 'year-' . $year_index;
            $year_items = $year['items'] ?? [];
            $is_active  = ($year_id === $default_year_id);
            
            if (empty($year_items)) {
                continue;
            }
        ?>
        <div class="facts-year-content grid gap-6 md:grid-cols-2 lg:grid-cols-4 <?php echo !$is_active ? 'hidden' : ''; ?>" data-year="<?php echo esc_attr($year_id); ?>">
            <?php
            $fact_index = 0;
            foreach ($year_items as $fact) :
                $value = $fact['value'] ?? '';
                $label = $fact['label'] ?? '';
                if (!$value && !$label) {
                    continue;
                }
                $fact_delay = 200 + ($fact_index * 100);
            ?>
                <div
                    class=" bg-white/30 backdrop-blur-sm p-6 md:p-8 text-center shadow-lg h-52 md:h-60 flex flex-col justify-center items-center gap-3 md:gap-4" data-aos="flip-up" data-aos-delay="<?php echo esc_attr($fact_delay); ?>">
                    <?php if ($value) : ?>
                        <div class="text-3xl md:text-4xl lg:text-6xl font-extrabold" data-counter data-target="<?php echo esc_attr($value); ?>">0</div>
                    <?php endif; ?>
                    <?php if ($label) : ?>
                        <div class="mt-2 md:mt-3 text-xs md:text-sm font-semibold uppercase tracking-widest text-white/70">
                            <?php echo esc_html($label); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php
                $fact_index++;
            endforeach; ?>
        </div>
        <?php endforeach; ?>
    </div>
</section>