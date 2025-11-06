<?php

/**
 * Media Center landing page template.
 *
 * @package beit
 *
 * Template Name: Media Center
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$is_rtl     = is_rtl();
$paged      = max(1, (int) get_query_var('paged', 1));
$per_page   = 9;
$lightbox_id = 'media-center-lightbox';

$media_query = new WP_Query(
    [
        'post_type'      => 'beit_voice',
        'post_status'    => 'publish',
        'posts_per_page' => $per_page,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]
);

$media_items = [];

if ($media_query->have_posts()) {
    while ($media_query->have_posts()) {
        $media_query->the_post();

        $media_items[] = [
            'id'      => get_the_ID(),
            'title'   => get_the_title(),
            'excerpt' => get_the_excerpt(),
            'media'   => beit_get_voice_media_data(get_the_ID()),
            'date'    => get_the_date(),
        ];
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
        'eyebrow'     => __('Media Center', 'beit'),
        'background_classes' => 'bg-slate-950',
    ]
);

?>

<main class="bg-white text-slate-900">
    <section class="container mx-auto px-4 py-16">
        <?php if (!empty($media_items)) : ?>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($media_items as $item) :
                    $media = $item['media'];
                    $thumb = $media['thumbnail_url'];
                    $lightbox_src = $media['src'];
                    $lightbox_type = $media['type'];
                    $caption = $media['caption'] ?: $item['title'];
                    ?>
                    <article class="overflow-hidden rounded-3xl bg-white shadow-lg transition hover:-translate-y-1 hover:shadow-xl">
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
                                        <i class="fa-solid <?php echo esc_attr('video' === $lightbox_type ? 'fa-play' : 'fa-magnifying-glass'); ?>"></i>
                                    </span>
                                </span>
                                <img class="h-64 w-full object-cover" src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($item['title']); ?>">
                            </a>
                        <?php endif; ?>

                        <div class="space-y-3 p-6">
                            <span class="text-xs font-semibold uppercase tracking-widest text-red-500"><?php echo esc_html($item['date']); ?></span>
                            <h3 class="text-lg font-semibold text-slate-900"><?php echo esc_html($item['title']); ?></h3>
                            <p class="text-sm text-slate-600"><?php echo esc_html(wp_trim_words($item['excerpt'], 20, '…')); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="rounded-3xl bg-slate-50 p-12 text-center shadow-inner">
                <h2 class="text-2xl font-semibold text-slate-900"><?php esc_html_e('No media found', 'beit'); ?></h2>
                <p class="mt-2 text-sm text-slate-600"><?php esc_html_e('Please check back soon for new stories and media highlights.', 'beit'); ?></p>
            </div>
        <?php endif; ?>

        <?php
        $pagination_links = paginate_links(
            [
                'total'   => max(1, (int) $media_query->max_num_pages),
                'current' => $paged,
                'type'    => 'array',
            ]
        );

        if (!empty($pagination_links)) :
            ?>
            <nav class="mt-12 flex justify-center" aria-label="<?php esc_attr_e('Media pagination', 'beit'); ?>">
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
    </section>
</main>

<?php
get_footer();
