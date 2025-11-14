<?php

/**
 * News landing page template.
 *
 * @package beit
 *
 * Template Name: News Landing
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$paged    = max(1, (int) get_query_var('paged', 1));
$per_page = 9;

$news_query = new WP_Query(
    [
        'post_type'      => 'beit_news',
        'post_status'    => 'publish',
        'posts_per_page' => $per_page,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]
);

$featured_post   = null;
$highlight_posts = [];
$grid_posts      = [];

if ($news_query->have_posts()) {
    while ($news_query->have_posts()) {
        $news_query->the_post();

        if (!$featured_post) {
            $featured_post = get_post();
            continue;
        }

        if (count($highlight_posts) < 3) {
            $highlight_posts[] = get_post();
            continue;
        }

        $grid_posts[] = get_post();
    }

    wp_reset_postdata();
}

$hero_title = get_the_title();
$hero_description = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true) ?: get_post_field('post_excerpt', get_the_ID());

get_template_part(
    'resources/views/components/page-hero',
    null,
    [
        'title'       => $hero_title,
        'description' => $hero_description,
        'eyebrow'     => __('News & Activities', 'beit'),
        'background_classes' => 'bg-gradient-to-br from-slate-900 via-red-800 to-slate-950',
    ]
);

$recent_terms = get_terms(
    [
        'taxonomy'   => 'category',
        'hide_empty' => true,
        'number'     => 8,
    ]
);

$featured_thumbnail = $featured_post ? get_post_thumbnail_id($featured_post) : 0;
$featured_image     = $featured_thumbnail ? wp_get_attachment_image_url($featured_thumbnail, 'full') : '';

?>

<main class="bg-white text-slate-900">
    <section class="container mx-auto grid gap-10 px-4 py-16 md:grid-cols-[minmax(0,2fr)_minmax(0,1fr)] md:px-6">
        <div class="space-y-10">
            <?php if ($featured_post) : ?>
                <article class="overflow-hidden rounded-3xl bg-slate-900 text-white shadow-xl">
                    <a class="relative block" href="<?php echo esc_url(get_permalink($featured_post)); ?>">
                        <?php if ($featured_image) : ?>
                            <div class="absolute inset-0">
                                <img class="h-full w-full object-cover opacity-60" src="<?php echo esc_url($featured_image); ?>" alt="">
                                <span class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/60 to-transparent"></span>
                            </div>
                        <?php endif; ?>

                        <div class="relative z-10 space-y-4 p-8 md:p-12">
                            <div class="flex flex-wrap items-center gap-3 text-xs font-semibold uppercase tracking-widest text-white/70">
                                <span><?php echo esc_html(get_the_date('', $featured_post)); ?></span>
                                <?php
                                $terms = get_the_terms($featured_post, 'category');
                                if (!is_wp_error($terms) && !empty($terms)) {
                                    echo '<span class="text-white/50">•</span><span>' . esc_html($terms[0]->name) . '</span>';
                                }
                                ?>
                            </div>

                            <h2 class="text-3xl font-bold md:text-4xl"><?php echo esc_html(get_the_title($featured_post)); ?></h2>

                         
                        </div>
                    </a>
                </article>
            <?php endif; ?>

            <?php if (!empty($grid_posts)) : ?>
                <section class="space-y-5">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <h2 class="text-xl font-semibold text-slate-900 md:text-2xl"><?php esc_html_e('Latest Updates', 'beit'); ?></h2>
                        <?php $news_archive = get_post_type_archive_link('beit_news'); ?>
                        <?php if ($news_archive) : ?>
                            <a class="text-sm font-semibold text-red-600 hover:text-red-700" href="<?php echo esc_url($news_archive); ?>">
                                <?php esc_html_e('Browse all news', 'beit'); ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        <?php foreach ($grid_posts as $post_obj) :
                            $thumb_id = get_post_thumbnail_id($post_obj);
                            ?>
                            <article class="flex h-full flex-col overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                                <?php if ($thumb_id) : ?>
                                    <a href="<?php echo esc_url(get_permalink($post_obj)); ?>" class="block overflow-hidden">
                                        <?php echo wp_get_attachment_image($thumb_id, 'large', false, ['class' => 'h-56 w-full object-cover']); ?>
                                    </a>
                                <?php endif; ?>

                                <div class="flex flex-1 flex-col gap-3 p-6">
                                    <div class="text-xs font-semibold uppercase tracking-widest text-red-500">
                                        <?php echo esc_html(get_the_date('', $post_obj)); ?>
                                    </div>
                                    <h3 class="text-lg font-semibold text-slate-900">
                                        <a class="transition hover:text-red-600" href="<?php echo esc_url(get_permalink($post_obj)); ?>">
                                            <?php echo esc_html(get_the_title($post_obj)); ?>
                                        </a>
                                    </h3>
                                  
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php if (!empty($highlight_posts)) : ?>
                <section class="space-y-5">
                    <h2 class="text-xl font-semibold text-slate-900 md:text-2xl"><?php esc_html_e('Highlighted Stories', 'beit'); ?></h2>
                    <div class="grid gap-6 md:grid-cols-3">
                        <?php foreach ($highlight_posts as $post_obj) :
                            $thumb_id = get_post_thumbnail_id($post_obj);
                            ?>
                            <article class="overflow-hidden rounded-2xl bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                                <?php if ($thumb_id) : ?>
                                    <a href="<?php echo esc_url(get_permalink($post_obj)); ?>" class="block overflow-hidden">
                                        <?php echo wp_get_attachment_image($thumb_id, 'medium_large', false, ['class' => 'h-48 w-full object-cover']); ?>
                                    </a>
                                <?php endif; ?>
                                <div class="space-y-3 p-6">
                                    <div class="text-xs font-semibold uppercase tracking-widest text-red-500">
                                        <?php echo esc_html(get_the_date('', $post_obj)); ?>
                                    </div>
                                    <h3 class="text-base font-semibold text-slate-900">
                                        <a class="transition hover:text-red-600" href="<?php echo esc_url(get_permalink($post_obj)); ?>">
                                            <?php echo esc_html(get_the_title($post_obj)); ?>
                                        </a>
                                    </h3>
                                    <p class="text-sm text-slate-600"><?php echo esc_html(wp_trim_words(get_the_excerpt($post_obj), 18, '…')); ?></p>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php if (!empty($recent_terms) && !is_wp_error($recent_terms)) : ?>
                <section class="rounded-3xl bg-slate-100 p-8 shadow-inner">
                    <h2 class="text-xl font-semibold text-slate-900 md:text-2xl"><?php esc_html_e('Browse by Category', 'beit'); ?></h2>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <?php foreach ($recent_terms as $term) : ?>
                            <a class="inline-flex items-center gap-2 rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-red-500 hover:text-red-600" href="<?php echo esc_url(get_term_link($term)); ?>">
                                <?php echo esc_html($term->name); ?>
                                <span class="text-xs text-slate-400"><?php echo esc_html($term->count); ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php
            $pagination_links = paginate_links(
                [
                    'total'   => max(1, (int) $news_query->max_num_pages),
                    'current' => $paged,
                    'type'    => 'array',
                ]
            );

            if (!empty($pagination_links)) :
                ?>
                <nav class="flex justify-center" aria-label="<?php esc_attr_e('News pagination', 'beit'); ?>">
                    <ul class="flex items-center gap-2">
                        <?php
                        foreach ($pagination_links as $link) {
                            $is_current = strpos($link, 'current') !== false;
                            $classes    = 'inline-flex items-center justify-center rounded-full px-4 py-2 text-sm font-semibold transition';
                            $classes   .= $is_current
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
                            <?php
                        }
                        ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>

        <aside class="space-y-8">
            <?php if (!empty($highlight_posts)) : ?>
                <section class="rounded-3xl bg-white p-6 shadow-lg">
                    <h2 class="text-sm font-semibold uppercase tracking-widest text-slate-500"><?php esc_html_e('Trending', 'beit'); ?></h2>
                    <ul class="mt-4 space-y-4 text-sm">
                        <?php foreach ($highlight_posts as $post_obj) : ?>
                            <li>
                                <a class="block transition hover:text-red-600" href="<?php echo esc_url(get_permalink($post_obj)); ?>">
                                    <span class="block font-semibold text-slate-900"><?php echo esc_html(get_the_title($post_obj)); ?></span>
                                    <span class="text-xs text-slate-400"><?php echo esc_html(get_the_date('', $post_obj)); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            <?php endif; ?>

            <?php if ($featured_post) : ?>
                <section class="rounded-3xl bg-gradient-to-br from-red-600 via-red-500 to-amber-400 p-6 text-white shadow-lg">
                    <h2 class="text-sm font-semibold uppercase tracking-widest text-white/80"><?php esc_html_e('Featured Story', 'beit'); ?></h2>
                    <h3 class="mt-3 text-lg font-semibold">
                        <a class="transition hover:text-white/90" href="<?php echo esc_url(get_permalink($featured_post)); ?>"><?php echo esc_html(get_the_title($featured_post)); ?></a>
                    </h3>
                    <p class="mt-3 text-sm text-white/80"><?php echo esc_html(wp_trim_words(get_the_excerpt($featured_post), 20, '…')); ?></p>
                </section>
            <?php endif; ?>

            <?php if (!empty($recent_terms) && !is_wp_error($recent_terms)) : ?>
                <section class="rounded-3xl bg-white p-6 shadow-lg">
                    <h2 class="text-sm font-semibold uppercase tracking-widest text-slate-500"><?php esc_html_e('Topics', 'beit'); ?></h2>
                    <ul class="mt-4 space-y-3 text-sm text-slate-700">
                        <?php foreach ($recent_terms as $term) : ?>
                            <li>
                                <a class="transition hover:text-red-600" href="<?php echo esc_url(get_term_link($term)); ?>">
                                    <?php echo esc_html($term->name); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            <?php endif; ?>
        </aside>
    </section>

    <?php
    get_template_part(
        'resources/views/sections/donate-callout',
        null,
        [
            'title'       => __('Support our frontline programs', 'beit'),
            'description' => __('Every contribution helps us deliver critical relief, education, and protection services to families in Gaza.', 'beit'),
            'button_text' => __('Donate Today', 'beit'),
            'button_url'  => ($donate_page = get_page_by_path('donate')) ? get_permalink($donate_page) : '#',
        ]
    );
    ?>
</main>

<?php
get_footer();
