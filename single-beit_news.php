<?php

/**
 * Single template for Beit Lahia news items.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) {
    the_post();

    $is_rtl      = is_rtl();
    $arrow_icon  = $is_rtl ? 'fa-arrow-left' : 'fa-arrow-right';
    $thumbnail   = get_post_thumbnail_id();
    $categories  = get_the_terms(get_the_ID(), 'category');
    $primary_cat = (!is_wp_error($categories) && !empty($categories)) ? $categories[0]->name : '';

    $hero_title = get_the_title();
    $hero_description = sprintf(
        /* translators: %1$s: publish date, %2$s: primary category */
        esc_html__('%1$s %2$s', 'beit'),
        esc_html(get_the_date()),
        $primary_cat ? '· ' . esc_html($primary_cat) : ''
    );

    get_template_part(
        'resources/views/components/page-hero',
        null,
        [
            'title'       => $hero_title,
            'description' => $hero_description,
            'eyebrow'     => __('News Insight', 'beit'),
            'background_classes' => 'bg-gradient-to-br from-slate-950 via-red-900 to-slate-800',
        ]
    );
    ?>

    <main class="bg-white text-slate-900">
        <article class="container mx-auto grid gap-12 px-4 py-16 md:grid-cols-[minmax(0,3fr)_minmax(0,1fr)] md:px-6">
            <div class="space-y-10">
                <?php if ($thumbnail) : ?>
                    <figure class="overflow-hidden rounded-3xl shadow-lg" data-aos="zoom-in" data-aos-duration="1000">
                        <?php echo wp_get_attachment_image($thumbnail, 'full', false, ['class' => 'w-full object-cover']); ?>
                    </figure>
                <?php endif; ?>

                <div class="prose max-w-none prose-slate prose-headings:font-semibold prose-a:text-red-600 hover:prose-a:text-red-700" data-aos="fade-up" data-aos-delay="100">
                    <?php the_content(); ?>
                </div>

                <?php wp_link_pages(['before' => '<div class="text-sm text-slate-500">' . esc_html__('Pages:', 'beit'), 'after' => '</div>']); ?>

                <div class="flex flex-wrap items-center gap-3 text-sm text-slate-500" data-aos="fade-up" data-aos-delay="200">
                    <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 font-semibold text-slate-700">
                        <i class="fa fa-calendar"></i>
                        <?php echo esc_html(get_the_date()); ?>
                    </span>
                    <?php if ($primary_cat) : ?>
                        <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 font-semibold text-slate-700">
                            <i class="fa fa-folder"></i>
                            <?php echo esc_html($primary_cat); ?>
                        </span>
                    <?php endif; ?>
                </div>

                <nav class="mt-12 flex flex-wrap items-center justify-between gap-4 border-t border-slate-200 pt-6 text-sm font-semibold text-red-600" data-aos="fade-up" data-aos-delay="300">
                    <span>
                        <?php previous_post_link('%link', '<i class="fa' . esc_attr($is_rtl ? 'fa-arrow-right' : 'fa-arrow-left') . '"></i> ' . esc_html__('Previous', 'beit')); ?>
                    </span>
                    <span>
                        <?php next_post_link('%link', esc_html__('Next', 'beit') . ' <i class="fa' . esc_attr($is_rtl ? 'fa-arrow-left' : 'fa-arrow-right') . '"></i>'); ?>
                    </span>
                </nav>
            </div>

            <aside class="space-y-8" data-aos="fade-left" data-aos-delay="200">
                <?php if (!empty($categories)) : ?>
                    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm" data-aos="fade-left" data-aos-delay="300">
                        <h2 class="text-sm font-semibold uppercase tracking-widest text-slate-500">
                            <?php esc_html_e('Categories', 'beit'); ?>
                        </h2>
                        <ul class="mt-4 space-y-2 text-sm text-slate-700">
                            <?php foreach ($categories as $cat) : ?>
                                <li>
                                    <a class="transition hover:text-red-600" href="<?php echo esc_url(get_term_link($cat)); ?>">
                                        <?php echo esc_html($cat->name); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </section>
                <?php endif; ?>

                <?php
                $recent = new WP_Query(
                    [
                        'post_type'      => 'beit_news',
                        'posts_per_page' => 3,
                        'post_status'    => 'publish',
                        'post__not_in'   => [get_the_ID()],
                        'orderby'        => 'date',
                    ]
                );

                if ($recent->have_posts()) :
                    ?>
                    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm" data-aos="fade-left" data-aos-delay="400">
                        <h2 class="text-sm font-semibold uppercase tracking-widest text-slate-500">
                            <?php esc_html_e('Recent News', 'beit'); ?>
                        </h2>
                        <ul class="mt-4 space-y-4 text-sm text-slate-700">
                            <?php
                            while ($recent->have_posts()) :
                                $recent->the_post();
                                ?>
                                <li>
                                    <a class="flex gap-3 transition hover:text-red-600" href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <span class="h-14 w-20 overflow-hidden rounded-md">
                                                <?php the_post_thumbnail('thumbnail', ['class' => 'h-full w-full object-cover']); ?>
                                            </span>
                                        <?php endif; ?>
                                        <span class="flex-1">
                                            <span class="block text-xs text-slate-400"><?php echo esc_html(get_the_date()); ?></span>
                                            <span class="block font-semibold"><?php the_title(); ?></span>
                                        </span>
                                    </a>
                                </li>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </ul>
                    </section>
                    <?php
                endif;
                ?>
            </aside>
        </article>
    </main>
    <?php
}

get_footer();
