<?php

/**
 * Archive template for Voices & Visions entries.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

global $wp_query;

$archive_title = post_type_archive_title('', false) ?: __('Voices & Visions', 'beit');
$archive_description = get_the_archive_description();

get_template_part(
    'resources/views/components/page-hero',
    null,
    [
        'title' => $archive_title,
        'description' => $archive_description,
        'background_classes' => 'bg-gradient-to-br from-amber-900 via-red-900 to-slate-950',
    ]
);

$voices_posts = [];

if (have_posts()) {
    while (have_posts()) {
        the_post();

        $voices_posts[] = [
            'title' => get_the_title(),
            'excerpt' => get_the_excerpt(),
            'image' => get_post_thumbnail_id() ?: '',
            'link' => get_permalink(),
        ];
    }

    wp_reset_postdata();
}

?>

<main class="bg-white text-slate-900">
    <section class="py-16">
        <div class="container mx-auto px-4 md:px-6">
            <?php
            if (!empty($voices_posts)) {
                get_template_part(
                    'resources/views/sections/voices-list',
                    null,
                    [
                        'posts' => $voices_posts,
                    ]
                );

                $pagination_links = paginate_links(
                    [
                        'total' => max(1, (int) $wp_query->max_num_pages),
                        'current' => max(1, get_query_var('paged', 1)),
                        'type' => 'array',
                    ]
                );

                if (!empty($pagination_links)) {
                    ?>
                    <nav class="mt-12 flex justify-center" aria-label="<?php esc_attr_e('Voices pagination', 'beit'); ?>">
                        <ul class="flex items-center gap-2">
                            <?php
                            foreach ($pagination_links as $link) {
                                $is_current = strpos($link, 'current') !== false;
                                $classes = 'inline-flex items-center justify-center rounded-full px-4 py-2 text-sm font-bold transition';
                                $classes .= $is_current
                                    ? ' border border-red-600 bg-primary text-white'
                                    : ' border border-slate-200 text-slate-600 hover:border-[var(--second-color)] hover:text-[var(--main-color)]';

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
                    <?php
                }
            } else {
                ?>
                <div class=" border border-slate-200 bg-white p-12 text-center shadow-sm">
                    <h2 class="text-2xl font-bold text-slate-900"><?php esc_html_e('No entries found', 'beit'); ?></h2>
                    <p class="mt-2 text-sm text-slate-600">
                        <?php esc_html_e('Check back soon for more voices and visions from the field.', 'beit'); ?>
                    </p>
                </div>
                <?php
            }
            ?>
        </div>
    </section>
</main>

<?php
get_footer();
