<?php

/**
 * Annual Reports page template.
 *
 * @package beit
 *
 * Template Name: Annual Reports Page
 * Template Post Type: page
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) {
    the_post();
    $hero_data = function_exists('get_field') ? (get_field('annual_reports_hero') ?: []) : [];
    $hero_subtitle = get_the_content();
    $hero_description = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true) ?: get_post_field('post_excerpt', get_the_ID());
    $hero_custom_title = $hero_data['custom_title'] ?? '';
    $hero_title = $hero_custom_title ?: get_the_title();

    get_template_part(
        'resources/views/components/page-hero',
        null,
        [
            'title' => $hero_title,
            'subtitle' => $hero_subtitle,
            'description' => $hero_description,
            'background_classes' => 'bg-gradient-to-br from-red-900 via-slate-900 to-slate-950',
        ]
    );
}

$is_rtl = is_rtl();
$has_acf = function_exists('get_field');

// Get pagination
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$reports_query = new WP_Query(
    [
        'post_type' => 'beit_annual_report',
        'post_status' => 'publish',
        'posts_per_page' => 9,
        'paged' => $paged,
        'orderby' => ['menu_order' => 'ASC', 'date' => 'DESC'],
    ]
);

if (!$reports_query->have_posts()) {
    echo '<main class="container mx-auto px-4 py-16 text-center text-slate-600">' . esc_html__('No annual reports found. Please add some via the dashboard.', 'beit') . '</main>';
    get_footer();
    return;
}

?>

<main class="bg-gray-50 text-slate-900">
    <section class="container mx-auto px-3 py-8 sm:px-4 sm:py-10 md:px-6 md:py-16">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php
            $index = 0;
            while ($reports_query->have_posts()):
                $reports_query->the_post();
                $thumbnail_id = get_post_thumbnail_id();
                $thumbnail_html = $thumbnail_id
                    ? wp_get_attachment_image($thumbnail_id, 'large', false, ['class' => 'h-64 w-full object-cover transition-transform duration-500 group-hover:scale-105'])
                    : '';

                // Get ACF fields
                $report_year = $has_acf ? get_field('annual_report_year') : '';
                $pdf_url = $has_acf ? get_field('annual_report_pdf_url') : '';
                $file_size = $has_acf ? get_field('annual_report_file_size') : '';
                $download_text = $has_acf ? get_field('annual_report_download_text') : __('Download Report', 'beit');

                $delay = $index * 100;
            ?>
                <article class="group relative flex h-full flex-col overflow-hidden rounded-2xl bg-white shadow-lg transition-all duration-500 hover:shadow-2xl hover:-translate-y-3 border-2 border-transparent hover:border-red-100"
                    data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay); ?>">

                    <!-- Decorative top border -->
                    <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-red-600 via-red-500 to-orange-500"></div>

                    <!-- Decorative background elements -->
                    <div class="absolute -right-20 -top-20 h-40 w-40 rounded-full bg-red-50 opacity-0 transition-opacity duration-500 group-hover:opacity-100 blur-3xl"></div>
                    <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-orange-50 opacity-0 transition-opacity duration-500 group-hover:opacity-100 blur-2xl"></div>

                    <!-- Content -->
                    <div class="relative flex flex-1 flex-col gap-6 p-7">

                        <!-- PDF Icon and Year Header -->
                        <div class="flex items-center gap-4">
                            <div class="relative flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-red-600 via-red-600 to-red-700 shadow-xl transition-all duration-300 group-hover:scale-110 group-hover:rotate-3">
                                <i class="fa fa-file-pdf-o text-4xl text-white transition-transform group-hover:scale-110"></i>
                                <!-- Shine effect -->
                                <div class="absolute inset-0 rounded-2xl bg-gradient-to-tr from-white/0 via-white/20 to-white/0 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                            </div>

                            <div class="flex-1">
                                <?php if ($report_year): ?>
                                    <div class="ltr:text-left rtl:text-right">
                                        <div class="mb-1 inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1 text-xs font-bold uppercase tracking-wider text-red-600">
                                            <i class="fa fa-calendar-alt"></i>
                                            <?php echo esc_html__('Year', 'beit'); ?>
                                        </div>
                                        <div class="text-3xl font-black text-red-600 transition-colors group-hover:text-red-700">
                                            <?php echo esc_html($report_year); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>

                        <!-- Title -->
                        <h2 class="text-xl font-bold leading-tight text-slate-900 transition-colors group-hover:text-red-600 ltr:text-left rtl:text-right">
                            <?php the_title(); ?>
                        </h2>

                        <!-- Excerpt -->
                        <?php if (has_excerpt()): ?>
                            <p class="line-clamp-3 text-sm leading-relaxed text-slate-600 ltr:text-left rtl:text-right">
                                <?php echo esc_html(get_the_excerpt()); ?>
                            </p>
                        <?php endif; ?>

                        <!-- Meta Information -->
                        <div class="flex flex-wrap items-center gap-2">
                            <div class="flex items-center gap-2 rounded-lg bg-slate-50 px-3 py-2 text-xs font-semibold text-slate-600 transition-colors group-hover:bg-slate-100">
                                <i class="fa fa-calendar-alt text-red-500"></i>
                                <span><?php echo esc_html(get_the_date()); ?></span>
                            </div>
                            <?php if ($file_size): ?>
                                <div class="flex items-center gap-2 rounded-lg bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 transition-colors group-hover:bg-blue-100">
                                    <i class="fa fa-hdd text-blue-500"></i>
                                    <span><?php echo esc_html($file_size); ?></span>
                                </div>
                            <?php endif; ?>
                            <div class="flex items-center gap-2 rounded-lg bg-green-50 px-3 py-2 text-xs font-semibold text-green-700 transition-colors group-hover:bg-green-100">
                                <i class="fa fa-file-pdf-o text-green-500"></i>
                                <span>PDF</span>
                            </div>
                        </div>

                        <!-- Download Button -->
                        <?php if ($pdf_url): ?>
                            <div class="mt-auto pt-2">
                                <a href="<?php echo esc_url($pdf_url); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="group/btn relative flex w-full items-center justify-center gap-3 overflow-hidden rounded-xl bg-gradient-to-r from-red-600 to-red-700 px-6 py-4 text-base font-bold text-white shadow-lg transition-all duration-300 hover:from-red-700 hover:to-red-800 hover:shadow-2xl hover:shadow-red-500/50 active:scale-95">
                                    <!-- Shine animation -->
                                    <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/20 to-transparent transition-transform duration-700 group-hover/btn:translate-x-full"></div>

                                    <i class="fa fa-download relative text-xl transition-transform duration-300 group-hover/btn:scale-110 group-hover/btn:animate-bounce"></i>
                                    <span class="relative"><?php echo esc_html($download_text); ?></span>
                                    <i class="fa <?php echo $is_rtl ? 'fa-arrow-left' : 'fa-arrow-right'; ?> relative text-sm transition-all duration-300 <?php echo $is_rtl ? 'group-hover/btn:-translate-x-2' : 'group-hover/btn:translate-x-2'; ?>"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>
            <?php
                $index++;
            endwhile;
            ?>
        </div>

        <?php
        // Pagination
        $pagination_links = paginate_links(
            [
                'total' => max(1, (int) $reports_query->max_num_pages),
                'current' => max(1, $paged),
                'type' => 'array',
            ]
        );

        if (!empty($pagination_links)):
        ?>
            <nav class="mt-12 flex justify-center" aria-label="<?php esc_attr_e('Reports pagination', 'beit'); ?>">
                <ul class="flex items-center gap-2">
                    <?php
                    foreach ($pagination_links as $link):
                        $is_current = strpos($link, 'current') !== false;
                        $classes = 'inline-flex items-center justify-center rounded-full px-4 py-2 text-sm font-semibold transition';
                        $classes .= $is_current
                            ? ' border border-red-600 bg-red-600 text-white'
                            : ' border border-slate-200 text-slate-600 hover:border-red-500 hover:text-red-600';

                        $link = preg_replace(
                            '/class="([^"]*)"/',
                            'class="$1 ' . esc_attr($classes) . '"',
                            $link,
                            1
                        );
                    ?>
                        <li class="inline-flex">
                            <?php echo wp_kses_post($link); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        <?php
        endif;
        wp_reset_postdata();
        ?>
    </section>
</main>

<?php
get_footer();
