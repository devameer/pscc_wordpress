<?php

/**
 * Archive template for Beit Lahia news items.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

global $wp_query;

$is_rtl     = is_rtl();
$arrow_icon = $is_rtl ? 'fa-arrow-left' : 'fa-arrow-right';

$archive_title       = post_type_archive_title('', false) ?: __('News', 'beit');
$archive_description = get_the_archive_description();

?>

<main class="bg-white text-slate-900">
    <?php
    get_template_part(
        'resources/views/components/page-hero',
        null,
        [
            'title'       => $archive_title,
            'description' => $archive_description,
            'eyebrow'     => __('Latest Updates', 'beit'),
        ]
    );
    ?>

    <section class="py-16">
        <div class="container mx-auto px-4 md:px-6">
            <?php if (have_posts()) : ?>
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <?php
                    while (have_posts()) :
                        the_post();
                        $thumbnail_id   = get_post_thumbnail_id();
                        $thumbnail_html = $thumbnail_id ? wp_get_attachment_image($thumbnail_id, 'large', false, ['class' => 'h-56 w-full object-cover']) : '';
                        ?>
                        <article class="flex h-full flex-col overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                            <?php if ($thumbnail_html) : ?>
                                <a href="<?php the_permalink(); ?>" class="block overflow-hidden">
                                    <?php echo $thumbnail_html; ?>
                                </a>
                            <?php endif; ?>

                            <div class="flex flex-1 flex-col gap-4 p-6">
                                <div class="flex items-center gap-3 text-xs font-semibold uppercase tracking-widest text-red-500">
                                    <span><?php echo esc_html(get_the_date()); ?></span>
                                    <?php
                                    $terms = get_the_terms(get_the_ID(), 'category');
                                    if (!is_wp_error($terms) && !empty($terms)) {
                                        echo '<span class="text-slate-300">•</span><span class="text-slate-500">' . esc_html($terms[0]->name) . '</span>';
                                    }
                                    ?>
                                </div>

                                <h2 class="text-lg font-semibold text-slate-900">
                                    <a class="transition hover:text-red-600" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>

                                <p class="flex-1 text-sm text-slate-600">
                                    <?php echo esc_html(wp_trim_words(get_the_excerpt(), 26, '…')); ?>
                                </p>

                                <div class="mt-auto">
                                    <a class="inline-flex items-center gap-2 text-sm font-semibold text-red-600 transition hover:text-red-700" href="<?php the_permalink(); ?>">
                                        <?php esc_html_e('Read More', 'beit'); ?>
                                        <i class="fa-solid <?php echo esc_attr($arrow_icon); ?> text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <?php
                $pagination_links = paginate_links(
                    [
                        'total'   => max(1, (int) $wp_query->max_num_pages),
                        'current' => max(1, get_query_var('paged', 1)),
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
