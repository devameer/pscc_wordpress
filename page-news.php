<?php

/**
 * News landing page template.
 *
 * @package beit
 *
 * Template Name: News Page
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

// Store current page info before any queries
$current_page_id  = get_the_ID();
$hero_title       = get_the_title($current_page_id);
$hero_description = get_post_meta($current_page_id, '_yoast_wpseo_metadesc', true) ?: get_post_field('post_excerpt', $current_page_id);

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

?>
<main class="bg-white text-slate-900">
    <section class="container mx-auto gap-10 px-4 py-16 md:px-6">
        <div>
            <?php if ($news_query->have_posts()) : ?>
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <?php
                    while ($news_query->have_posts()) :
                        $news_query->the_post();
                        $thumbnail_id   = get_post_thumbnail_id();
                        $thumbnail_html = $thumbnail_id ? wp_get_attachment_image($thumbnail_id, 'large', false, ['class' => 'h-56 w-full object-cover', 'loading' => 'lazy', 'decoding' => 'async']) : '';
                    ?>
                        <article class="flex h-full flex-col overflow-hidden bg-white transition hover:-translate-y-1">
                            <?php if ($thumbnail_html) : ?>
                                <a href="<?php the_permalink(); ?>" class="block overflow-hidden">
                                    <?php echo $thumbnail_html; ?>
                                </a>
                            <?php endif; ?>

                            <div class="flex flex-1 flex-col gap-4 py-4">
                                <h2 class="text-lg font-semibold text-slate-900">
                                    <a class="transition hover:text-red-600" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                
                                <div class="text-sm text-slate-600">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                </div>
                                
                                
                            </div>
                        </article>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>

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
                    <nav class="mt-12 flex justify-center" aria-label="<?php esc_attr_e('News pagination', 'beit'); ?>">
                        <ul class="flex items-center gap-2">
                            <?php
                            foreach ($pagination_links as $link) :
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
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                <?php
                endif;
                ?>
            <?php else : ?>
                <div class="rounded-2xl border border-slate-200 bg-white p-12 text-center shadow-sm">
                    <h2 class="text-2xl font-semibold text-slate-900"><?php esc_html_e('No news items found', 'beit'); ?></h2>
                    <p class="mt-2 text-sm text-slate-600">
                        <?php esc_html_e('Check back soon for the latest updates from Beit Lahia.', 'beit'); ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();