<?php

/**
 * Search results page template.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$search_query = get_search_query();
$results_count = $GLOBALS['wp_query']->found_posts ?? 0;
$post_type_filter = isset($_GET['post_type']) ? sanitize_text_field($_GET['post_type']) : '';

// Get available post types for filtering
$available_post_types = [
    'post'         => __('Posts', 'beit'),
    'page'         => __('Pages', 'beit'),
    'beit_news'    => __('News', 'beit'),
    'beit_voice'   => __('Voices & Visions', 'beit'),
    'beit_program' => __('Programs & Projects', 'beit'),
];

$hero_title = $search_query
    ? sprintf(
        /* translators: %s: search query */
        __('Search Results for: %s', 'beit'),
        esc_html($search_query)
    )
    : __('Search', 'beit');

get_template_part(
    'resources/views/components/page-hero',
    null,
    [
        'title'       => $hero_title,
        'description' => $search_query && $results_count > 0
            ? sprintf(
                /* translators: %d: number of results */
                _n('%d result found', '%d results found', $results_count, 'beit'),
                $results_count
            )
            : __('Find what you\'re looking for', 'beit'),
        'eyebrow'     => __('Search', 'beit'),
        'background_classes' => 'bg-gradient-to-br from-red-800 via-slate-900 to-red-950',
    ]
);

?>

<main class="bg-white text-slate-900">
    <section class="container mx-auto px-4 py-16 md:px-6">
        <div class="mb-8">
            <?php get_search_form(); ?>
        </div>

        <?php if ($search_query) : ?>
            <!-- Post Type Filters -->
            <div class="mb-8 flex flex-wrap items-center gap-3">
                <span class="text-sm font-semibold text-slate-700"><?php esc_html_e('Filter by:', 'beit'); ?></span>
                <a
                    href="<?php echo esc_url(add_query_arg(['s' => $search_query], home_url('/'))); ?>"
                    class="rounded-full px-4 py-2 text-sm font-semibold transition <?php echo empty($post_type_filter) ? 'bg-red-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>"
                >
                    <?php esc_html_e('All', 'beit'); ?>
                </a>
                <?php foreach ($available_post_types as $type => $label) : ?>
                    <a
                        href="<?php echo esc_url(add_query_arg(['s' => $search_query, 'post_type' => $type], home_url('/'))); ?>"
                        class="rounded-full px-4 py-2 text-sm font-semibold transition <?php echo $post_type_filter === $type ? 'bg-red-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>"
                    >
                        <?php echo esc_html($label); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (have_posts()) : ?>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <?php
                $lightbox_id = 'search-results-lightbox';

                while (have_posts()) {
                    the_post();
                    $post_type = get_post_type();
                    $thumbnail_id = get_post_thumbnail_id();

                    // beit_voice (Media Center style with lightbox)
                    if ('beit_voice' === $post_type) {
                        $media = beit_get_voice_media_data(get_the_ID());
                        $thumb = $media['thumbnail_url'];
                        $lightbox_src = $media['src'];
                        $lightbox_type = $media['type'];
                        $caption = $media['caption'] ?: get_the_title();
                        ?>
                        <article class="overflow-hidden rounded-md bg-white shadow-lg transition hover:-translate-y-1 hover:shadow-xl">
                            <?php if ($thumb) : ?>
                                <a
                                    class="group relative block w-full"
                                    data-fslightbox="<?php echo esc_attr($lightbox_id); ?>"
                                    data-type="<?php echo esc_attr($lightbox_type); ?>"
                                    data-caption="<?php echo esc_attr($caption); ?>"
                                    href="<?php echo esc_url($lightbox_src); ?>"
                                    aria-label="<?php esc_attr_e('Open media', 'beit'); ?>"
                                >
                                    <span class="absolute inset-0 z-10 flex items-center justify-center bg-black/40 opacity-0 transition group-hover:opacity-100">
                                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-white/90 text-slate-900">
                                            <i class="fa<?php echo esc_attr('video' === $lightbox_type ? 'fa-play' : 'fa-magnifying-glass'); ?>"></i>
                                        </span>
                                    </span>
                                    <img class="h-64 w-full object-cover" src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy" decoding="async">
                                </a>
                            <?php endif; ?>
                        </article>
                        <?php
                    }
                    // beit_news (Archive style - simple)
                    elseif ('beit_news' === $post_type) {
                        $thumbnail_html = $thumbnail_id ? wp_get_attachment_image($thumbnail_id, 'large', false, ['class' => 'h-56 w-full object-cover']) : '';
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
                            </div>
                        </article>
                        <?php
                    }
                    // Default style for other post types
                    else {
                        ?>
                        <article class="group overflow-hidden rounded-2xl bg-white shadow-lg transition hover:-translate-y-1 hover:shadow-xl">
                            <?php if ($thumbnail_id) : ?>
                                <a href="<?php the_permalink(); ?>" class="block h-48 w-full overflow-hidden">
                                    <?php echo wp_get_attachment_image($thumbnail_id, 'large', false, ['class' => 'h-full w-full object-cover transition-transform duration-300 group-hover:scale-105']); ?>
                                </a>
                            <?php else : ?>
                                <div class="h-48 w-full bg-gradient-to-br from-red-500/20 to-slate-900/20"></div>
                            <?php endif; ?>

                            <div class="p-6">
                                <div class="mb-3 flex items-center gap-2 text-xs font-semibold uppercase tracking-widest text-red-600">
                                    <?php
                                    $post_type_icon = 'fa-file';
                                    $post_type_label = get_post_type_object($post_type)->labels->singular_name ?? $post_type;

                                    switch ($post_type) {
                                        case 'beit_program':
                                            $post_type_icon = 'fa-clipboard-list';
                                            break;
                                        case 'beit_feature':
                                            $post_type_icon = 'fa-star';
                                            break;
                                        case 'page':
                                            $post_type_icon = 'fa-file-alt';
                                            break;
                                        case 'post':
                                            $post_type_icon = 'fa-file-text';
                                            break;
                                    }
                                    ?>
                                    <i class="fa<?php echo esc_attr($post_type_icon); ?>"></i>
                                    <span><?php echo esc_html($post_type_label); ?></span>
                                    <span class="text-slate-300">•</span>
                                    <span class="text-slate-500"><?php echo esc_html(get_the_date()); ?></span>
                                </div>

                                <h2 class="mb-3 text-lg font-semibold text-slate-900">
                                    <a class="transition hover:text-red-600" href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <p class="mb-4 text-sm text-slate-600">
                                    <?php echo esc_html(wp_trim_words(get_the_excerpt() ?: get_the_content(), 20, '…')); ?>
                                </p>

                                <a class="inline-flex items-center gap-2 text-sm font-semibold text-red-600 transition hover:text-red-700" href="<?php the_permalink(); ?>">
                                    <?php esc_html_e('Read More', 'beit'); ?>
                                    <i class="fa fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </article>
                        <?php
                    }
                }
                ?>
            </div>

            <?php
            // Pagination
            $pagination_links = paginate_links(
                [
                    'total'   => $GLOBALS['wp_query']->max_num_pages,
                    'current' => max(1, get_query_var('paged')),
                    'type'    => 'array',
                ]
            );

            if (!empty($pagination_links)) :
                ?>
                <nav class="mt-12 flex justify-center" aria-label="<?php esc_attr_e('Search results pagination', 'beit'); ?>">
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

        <?php else : ?>
            <div class="mx-auto max-w-2xl text-center">
                <div class="mb-8">
                    <?php get_search_form(); ?>
                </div>

                <div class="rounded-3xl bg-slate-50 p-12 shadow-inner">
                    <div class="mb-6 inline-flex h-20 w-20 items-center justify-center rounded-full bg-red-100 text-red-600">
                        <i class="fa fa-magnifying-glass text-3xl"></i>
                    </div>

                    <h2 class="mb-4 text-2xl font-bold text-slate-900">
                        <?php esc_html_e('No Results Found', 'beit'); ?>
                    </h2>

                    <p class="mb-6 text-slate-600">
                        <?php
                        if ($search_query) {
                            printf(
                                /* translators: %s: search query */
                                esc_html__('Sorry, we couldn\'t find any results for "%s". Please try again with different keywords.', 'beit'),
                                esc_html($search_query)
                            );
                        } else {
                            esc_html_e('Please enter a search term to find content.', 'beit');
                        }
                        ?>
                    </p>

                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-slate-900">
                            <?php esc_html_e('Search Tips:', 'beit'); ?>
                        </h3>
                        <ul class="mx-auto max-w-md space-y-2 text-left text-sm text-slate-600">
                            <li class="flex items-start gap-2">
                                <i class="fa fa-check text-red-600 mt-1"></i>
                                <span><?php esc_html_e('Check your spelling', 'beit'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa fa-check text-red-600 mt-1"></i>
                                <span><?php esc_html_e('Try different keywords', 'beit'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa fa-check text-red-600 mt-1"></i>
                                <span><?php esc_html_e('Use more general terms', 'beit'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa fa-check text-red-600 mt-1"></i>
                                <span><?php esc_html_e('Browse our main sections', 'beit'); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php
get_footer();

