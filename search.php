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
    'post'                  => __('Posts', 'beit'),
    'page'                  => __('Pages', 'beit'),
    'beit_news'             => __('News', 'beit'),
    'beit_media'            => __('Media', 'beit'),
    'beit_program'          => __('Programs & Projects', 'beit'),
    'beit_annual_report'    => __('Annual Reports', 'beit'),
    'beit_publication'      => __('Publications', 'beit'),
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
                    data-filter="all">
                    <?php esc_html_e('All', 'beit'); ?>
                </a>
                <?php foreach ($available_post_types as $type => $label) : ?>
                    <a
                        href="<?php echo esc_url(add_query_arg(['s' => $search_query, 'post_type' => $type], home_url('/'))); ?>"
                        class="rounded-full px-4 py-2 text-sm font-semibold transition <?php echo $post_type_filter === $type ? 'bg-red-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>"
                        data-filter="<?php echo esc_attr($type); ?>">
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
                        <article class="overflow-hidden  transition hover:-translate-y-1 mb-6">
                            
                            <?php if ($thumb) : ?>
                                <a
                                    class="group relative block w-full"
                                    data-fslightbox="<?php echo esc_attr($lightbox_id); ?>"
                                    data-type="<?php echo esc_attr($lightbox_type); ?>"
                                    data-caption="<?php echo esc_attr($caption); ?>"
                                    href="<?php echo esc_url($lightbox_src); ?>"
                                    aria-label="<?php esc_attr_e('Open media', 'beit'); ?>">
                                    <span class="absolute inset-0 z-10 flex items-center justify-center bg-black/40 ">
                                        <!-- <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-white/90 text-slate-900">
                                        <i class="fa<?php echo esc_attr('video' === $lightbox_type ? 'fa-play' : 'fa-magnifying-glass'); ?>"></i>
                                    </span> -->
                                        <?php
                                        if ('video' === $lightbox_type) : ?>
                                            <img class="h-20 w-20" src="<?php echo esc_url(get_template_directory_uri() . '/resources/assets/images/videoIcon.svg'); ?>" alt="<?php esc_attr_e('Play Video', 'beit'); ?>" loading="lazy" decoding="async">
                                        <?php else : ?>
                                            <img class="h-20 w-20" src="<?php echo esc_url(get_template_directory_uri() . '/resources/assets/images/galleryIcon.svg'); ?>" alt="<?php esc_attr_e('Play Video', 'beit'); ?>" loading="lazy" decoding="async">

                                        <?php endif; ?>

                                    </span>
                                    <img class="h-64 w-full object-cover" src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy" decoding="async">
                                </a>
                            <?php endif; ?>
                            <h3 class="text-base font-medium md:text-lg pt-3"><?php echo the_title(); ?></h3>



                        </article>
                    <?php
                    }
                    // beit_news (Archive style - simple)
                    elseif ('beit_news' === $post_type) {

                        $thumbnail_html = $thumbnail_id ? wp_get_attachment_image($thumbnail_id, 'large', false, ['class' => 'h-56 w-full object-cover', 'loading' => 'lazy', 'decoding' => 'async']) : '';
                    ?>
                        <article class="flex h-full flex-col overflow-hidden   transition hover:-translate-y-1" data-type="beit_news">
                            
                            <?php if ($thumbnail_html) : ?>
                                <a href="<?php the_permalink(); ?>" class="block overflow-hidden">
                                    <?php echo $thumbnail_html; ?>
                                </a>
                            <?php endif; ?>

                            <div class="flex flex-1 flex-col gap-3 py-6">
                               
                                <h2 class="text-lg font-semibold text-slate-900">
                                    <a class="transition hover:text-red-600" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                            </div>
                        </article>
                    <?php
                    }
                    // beit_program (Programs style overlay card)
                    elseif ('beit_program' === $post_type) {
                        $overlay_heading  = function_exists('get_field') ? get_field('program_overlay_heading') : '';
                        $overlay_sub      = function_exists('get_field') ? get_field('program_overlay_subheading') : '';
                        $image_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'large') : '';
                    ?>
                        <article class="overflow-hidden  transition hover:-translate-y-1" data-type="beit_program">
                            
                            <?php if ($image_url) : ?>
                                <a href="<?php the_permalink(); ?>" class="relative block overflow-hidden group">
                                    <img class="h-56 w-full object-cover transition-transform duration-500 group-hover:scale-105" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy" decoding="async">
                                    <span class="p-4 md:p-6 lg:p-8 text-black">
                                        <h3 class="text-lg md:text-xl font-bold"><?php echo esc_html($overlay_heading ?: get_the_title()); ?></h3>
                                        <?php if ($overlay_sub) : ?>
                                            <p class="text-sm md:text-base font-light"><?php echo esc_html($overlay_sub); ?></p>
                                        <?php endif; ?>
                                    </span>
                                </a>
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>" class="block overflow-hidden">
                                    <div class="h-56 w-full bg-slate-100 flex items-center justify-center text-slate-500">
                                        <?php esc_html_e('Add a featured image to display here.', 'beit'); ?>
                                    </div>
                                </a>
                            <?php endif; ?>
                        </article>
                  
                <?php
                    }
                    // Annual Reports - Special card design
                    elseif ('beit_annual_report' === $post_type) {
                        $report_year = function_exists('get_field') ? get_field('annual_report_year') : '';
                        $report_file = function_exists('get_field') ? get_field('annual_report_file') : '';
                        $image_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'large') : '';
                    ?>
                        <article class="flex h-full flex-col overflow-hidden bg-white shadow-lg transition hover:-translate-y-2 hover:shadow-xl" data-type="beit_annual_report">
                            <?php if ($image_url) : ?>
                                <div class="relative overflow-hidden">
                                    <img class="h-64 w-full object-cover transition-transform duration-500 hover:scale-105" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy" decoding="async">
                                    <?php if ($report_year) : ?>
                                        <div class="absolute top-4 right-4 bg-primary px-4 py-2 text-white font-bold text-lg shadow-lg">
                                            <?php echo esc_html($report_year); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <div class="flex flex-1 flex-col gap-4 p-6">
                                <span class="inline-flex items-center gap-2 text-xs font-semibold text-red-600 self-start">
                                    <i class="fa fa-file-text"></i>
                                    <?php esc_html_e('Annual Report', 'beit'); ?>
                                </span>

                                <h2 class="text-xl font-bold text-slate-900">
                                    <?php the_title(); ?>
                                </h2>

                                <?php if (has_excerpt()) : ?>
                                    <p class="text-sm text-slate-600 line-clamp-3"><?php echo get_the_excerpt(); ?></p>
                                <?php endif; ?>

                                <?php if ($report_file) : ?>
                                    <a href="<?php echo esc_url($report_file); ?>" class="mt-auto inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-red-700 transition" target="_blank" rel="noopener">
                                        <i class="fa fa-download"></i>
                                        <?php esc_html_e('Download Report', 'beit'); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php the_permalink(); ?>" class="mt-auto inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-red-700 transition">
                                        <?php esc_html_e('View Details', 'beit'); ?>
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php
                    }
                    // Publications - Special card design
                    elseif ('beit_publication' === $post_type) {
                        $pub_type = function_exists('get_field') ? get_field('publication_type') : '';
                        $pub_file = function_exists('get_field') ? get_field('publication_file') : '';
                        $image_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'large') : '';
                    ?>
                        <article class="flex h-full flex-col overflow-hidden bg-white shadow-lg transition hover:-translate-y-2 hover:shadow-xl" data-type="beit_publication">
                            <?php if ($image_url) : ?>
                                <div class="relative overflow-hidden">
                                    <img class="h-64 w-full object-cover transition-transform duration-500 hover:scale-105" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy" decoding="async">
                                    <?php if ($pub_type) : ?>
                                        <div class="absolute top-4 left-4 bg-slate-900 px-3 py-1 text-white text-xs font-semibold uppercase shadow-lg">
                                            <?php echo esc_html($pub_type); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <div class="flex flex-1 flex-col gap-4 p-6">
                                <span class="inline-flex items-center gap-2 text-xs font-semibold text-red-600 self-start">
                                    <i class="fa fa-book"></i>
                                    <?php esc_html_e('Publication', 'beit'); ?>
                                </span>

                                <h2 class="text-xl font-bold text-slate-900">
                                    <?php the_title(); ?>
                                </h2>

                                <?php if (has_excerpt()) : ?>
                                    <p class="text-sm text-slate-600 line-clamp-3"><?php echo get_the_excerpt(); ?></p>
                                <?php endif; ?>

                                <?php if ($pub_file) : ?>
                                    <a href="<?php echo esc_url($pub_file); ?>" class="mt-auto inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-red-700 transition" target="_blank" rel="noopener">
                                        <i class="fa fa-download"></i>
                                        <?php esc_html_e('Download Publication', 'beit'); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php the_permalink(); ?>" class="mt-auto inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-red-700 transition">
                                        <?php esc_html_e('View Details', 'beit'); ?>
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php
                    }
                    // Default style for other post types (post, page, beit_media, etc.)
                    else {
                        $thumbnail_html = $thumbnail_id ? wp_get_attachment_image($thumbnail_id, 'large', false, ['class' => 'h-56 w-full object-cover', 'loading' => 'lazy', 'decoding' => 'async']) : '';
                        $post_type_obj = get_post_type_object($post_type);
                        $post_type_name = $post_type_obj ? $post_type_obj->labels->singular_name : ucfirst($post_type);
                    ?>
                        <article class="flex h-full flex-col overflow-hidden transition hover:-translate-y-1" data-type="<?php echo esc_attr($post_type); ?>">
                            <?php if ($thumbnail_html) : ?>
                                <a href="<?php the_permalink(); ?>" class="block overflow-hidden">
                                    <?php echo $thumbnail_html; ?>
                                </a>
                            <?php endif; ?>

                            <div class="flex flex-1 flex-col gap-3 py-6">
                                <?php if ($post_type !== 'post' && $post_type !== 'page') : ?>
                                    <span class="inline-flex items-center gap-2 text-xs font-semibold text-red-600">
                                        <i class="fa fa-tag"></i>
                                        <?php echo esc_html($post_type_name); ?>
                                    </span>
                                <?php endif; ?>

                                <h2 class="text-lg font-semibold text-slate-900">
                                    <a class="transition hover:text-red-600" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>

                                <?php if (has_excerpt()) : ?>
                                    <p class="text-sm text-slate-600 line-clamp-3"><?php echo get_the_excerpt(); ?></p>
                                <?php endif; ?>
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

                <div class=" bg-slate-50 p-12 shadow-inner">
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
