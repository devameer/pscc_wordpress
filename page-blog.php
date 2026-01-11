<?php

/**
 * Blog/Posts page template.
 *
 * @package beit
 *
 * Template Name: Blog Page
 * Template Post Type: page
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) {
    the_post();
    $hero_data = function_exists('get_field') ? (get_field('blog_hero') ?: []) : [];
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
            'background_classes' => 'bg-gradient-to-br from-slate-900 via-red-900 to-slate-950',
        ]
    );
}

$is_rtl = is_rtl();

// Get pagination
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

// Get selected category filter
$selected_category = isset($_GET['category']) ? intval($_GET['category']) : 0;

$args = [
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 9,
    'paged' => $paged,
    'orderby' => 'date',
    'order' => 'DESC',
];

if ($selected_category > 0) {
    $args['cat'] = $selected_category;
}

$posts_query = new WP_Query($args);

// Get all categories
$categories = get_categories([
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => true,
]);

if (!$posts_query->have_posts()) {
    echo '<main class="container mx-auto px-4 py-16 text-center text-slate-600">' . esc_html__('No posts found. Please add some via the dashboard.', 'beit') . '</main>';
    get_footer();
    return;
}

?>

<main class="bg-gradient-to-b from-gray-50 to-white text-slate-900">
    <section class="container mx-auto px-3 py-8 sm:px-4 sm:py-10 md:px-6 md:py-16">

        <!-- Category Filter -->
        <?php if (!empty($categories)): ?>
            <div class="mb-10 flex flex-wrap items-center justify-center gap-3" data-aos="fade-up">
                <a href="<?php echo esc_url(get_permalink()); ?>"
                    class="rounded-full px-5 py-2 text-sm font-bold transition-all duration-300 <?php echo $selected_category === 0 ? 'bg-gradient-to-r from-red-600 to-red-700 text-white shadow-lg' : 'bg-white text-slate-700 shadow-md hover:bg-slate-50'; ?>">
                    <i class="fa fa-th-large"></i>
                    <?php echo esc_html__('All', 'beit'); ?>
                </a>
                <?php foreach ($categories as $category): ?>
                    <a href="<?php echo esc_url(add_query_arg('category', $category->term_id, get_permalink())); ?>"
                        class="rounded-full px-5 py-2 text-sm font-bold transition-all duration-300 <?php echo $selected_category === $category->term_id ? 'bg-gradient-to-r from-red-600 to-red-700 text-white shadow-lg' : 'bg-white text-slate-700 shadow-md hover:bg-slate-50'; ?>">
                        <i class="fa fa-tag"></i>
                        <?php echo esc_html($category->name); ?>
                        <span class="opacity-75">(<?php echo esc_html($category->count); ?>)</span>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Posts Grid -->
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php
            $index = 0;
            while ($posts_query->have_posts()):
                $posts_query->the_post();
                $thumbnail_id = get_post_thumbnail_id();
                $thumbnail_html = $thumbnail_id
                    ? wp_get_attachment_image($thumbnail_id, 'large', false, ['class' => 'h-56 w-full object-cover transition-transform duration-500 group-hover:scale-105'])
                    : '';

                $categories = get_the_category();
                $primary_cat = !empty($categories) ? $categories[0]->name : '';

                $delay = $index * 100;
                ?>
                <article
                    class="group flex h-full flex-col overflow-hidden rounded-xl bg-white shadow-md transition-all duration-300 hover:shadow-2xl hover:-translate-y-2"
                    data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay); ?>">

                    <!-- Thumbnail -->
                    <div class="relative overflow-hidden">
                        <?php if ($thumbnail_html): ?>
                            <a href="<?php the_permalink(); ?>" class="block">
                                <?php echo $thumbnail_html; ?>
                            </a>
                        <?php else: ?>
                            <div class="flex h-56 items-center justify-center bg-gradient-to-br from-slate-100 to-gray-100">
                                <i class="fa fa-file-alt text-6xl text-slate-300"></i>
                            </div>
                        <?php endif; ?>

                        <!-- Category Badge -->
                        <?php if ($primary_cat): ?>
                            <div class="absolute top-4 ltr:left-4 rtl:right-4">
                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-primary px-3 py-1.5 text-xs font-bold text-white shadow-lg">
                                    <i class="fa fa-tag"></i>
                                    <?php echo esc_html($primary_cat); ?>
                                </span>
                            </div>
                        <?php endif; ?>

                        <!-- Gradient Overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex flex-1 flex-col gap-4 p-6">
                        <h2
                            class="text-xl font-bold leading-tight text-slate-900 transition-colors group-hover:text-red-600 ltr:text-left rtl:text-right">
                            <a class="transition hover:text-red-600" href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <?php if (has_excerpt()): ?>
                            <p class="line-clamp-3 text-sm text-slate-600 ltr:text-left rtl:text-right">
                                <?php echo esc_html(get_the_excerpt()); ?>
                            </p>
                        <?php endif; ?>

                        <!-- Meta Information -->
                        <div
                            class="mt-auto flex flex-wrap items-center gap-2 border-t border-slate-100 pt-4 text-xs text-slate-500">
                            <span class="inline-flex items-center gap-1">
                                <i class="fa fa-calendar-alt text-red-600"></i>
                                <?php echo esc_html(get_the_date()); ?>
                            </span>
                            <span class="text-slate-300">•</span>
                            <span class="inline-flex items-center gap-1">
                                <i class="fa fa-user text-red-600"></i>
                                <?php echo esc_html(get_the_author()); ?>
                            </span>
                            <?php if (get_comments_number() > 0): ?>
                                <span class="text-slate-300">•</span>
                                <span class="inline-flex items-center gap-1">
                                    <i class="fa fa-comments text-red-600"></i>
                                    <?php echo esc_html(get_comments_number()); ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- Read More Button -->
                        <a href="<?php the_permalink(); ?>"
                            class="group/btn inline-flex items-center gap-2 self-start rounded-lg bg-gradient-to-r from-red-600 to-red-700 px-5 py-2.5 text-sm font-bold text-white shadow-md transition-all duration-300 hover:from-red-700 hover:to-red-800 hover:shadow-lg">
                            <?php echo esc_html__('Read More', 'beit'); ?>
                            <i
                                class="fa <?php echo $is_rtl ? 'fa-arrow-left' : 'fa-arrow-right'; ?> text-xs transition-transform group-hover/btn:<?php echo $is_rtl ? '-translate-x-1' : 'translate-x-1'; ?>"></i>
                        </a>
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
                'total' => max(1, (int) $posts_query->max_num_pages),
                'current' => max(1, $paged),
                'type' => 'array',
            ]
        );

        if (!empty($pagination_links)):
            ?>
            <nav class="mt-12 flex justify-center" aria-label="<?php esc_attr_e('Blog pagination', 'beit'); ?>">
                <ul class="flex items-center gap-2">
                    <?php
                    foreach ($pagination_links as $link):
                        $is_current = strpos($link, 'current') !== false;
                        $classes = 'inline-flex items-center justify-center rounded-full px-4 py-2 text-sm font-bold transition';
                        $classes .= $is_current
                            ? ' border border-red-600 bg-primary text-white'
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
