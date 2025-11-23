<?php

/**
 * Single template for Voices & Visions entries.
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
    $thumbnail   = get_post_thumbnail_id();

    get_template_part(
        'resources/views/components/page-hero',
        null,
        [
            'title'       => get_the_title(),
            'description' => esc_html(get_the_date()),
            'background_classes' => 'bg-gradient-to-br from-slate-800 via-amber-800 to-red-900',
        ]
    );
    ?>

    <main class="bg-white text-slate-900">
        <article class="container mx-auto grid gap-12 px-4 py-16 md:grid-cols-[minmax(0,3fr)_minmax(0,1fr)] md:px-6">
            <div class="space-y-10">
                <?php if ($thumbnail) : ?>
                    <figure class="overflow-hidden rounded-3xl shadow-lg">
                        <?php echo wp_get_attachment_image($thumbnail, 'full', false, ['class' => 'w-full object-cover']); ?>
                    </figure>
                <?php endif; ?>

                <div class="prose max-w-none prose-slate prose-headings:font-semibold prose-a:text-red-600 hover:prose-a:text-red-700">
                    <?php the_content(); ?>
                </div>

                <?php wp_link_pages(['before' => '<div class="text-sm text-slate-500">' . esc_html__('Pages:', 'beit'), 'after' => '</div>']); ?>
            </div>

            <aside class="space-y-8">
                <?php
                $related = new WP_Query(
                    [
                        'post_type'      => 'beit_voice',
                        'posts_per_page' => 3,
                        'post_status'    => 'publish',
                        'post__not_in'   => [get_the_ID()],
                        'orderby'        => 'date',
                    ]
                );

                if ($related->have_posts()) :
                    ?>
                    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-sm font-semibold uppercase tracking-widest text-slate-500">
                            <?php esc_html_e('More Voices', 'beit'); ?>
                        </h2>
                        <ul class="mt-4 space-y-4 text-sm text-slate-700">
                            <?php
                            while ($related->have_posts()) :
                                $related->the_post();
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
