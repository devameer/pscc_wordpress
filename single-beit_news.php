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

    $is_rtl = is_rtl();
    $arrow_icon = $is_rtl ? 'fa-arrow-left' : 'fa-arrow-right';
    $thumbnail = get_post_thumbnail_id();

    $hero_title = get_the_title();
    $hero_description = sprintf(
        /* translators: %s: publish date */
        esc_html__('%s', 'beit'),
        esc_html(get_the_date())
    );

    get_template_part(
        'resources/views/components/page-hero',
        null,
        [
            'title' => $hero_title,
            'description' => $hero_description,
            'background_classes' => 'bg-gradient-to-br from-slate-950 via-red-900 to-slate-800',
        ]
    );
    ?>

    <main class="bg-white text-slate-900">
        <article class="container mx-auto grid gap-12 px-4 py-16 md:grid-cols-[minmax(0,3fr)_minmax(0,1fr)] md:px-6">
            <div class="space-y-10">
                <?php if ($thumbnail): ?>
                    <figure class="overflow-hidden  shadow-lg" data-aos="zoom-in" data-aos-duration="1000">
                        <?php echo wp_get_attachment_image($thumbnail, 'full', false, ['class' => 'w-full object-cover']); ?>
                    </figure>
                <?php endif; ?>

                <div class="wp-content prose max-w-none prose-slate prose-headings:font-bold prose-a:text-[var(--main-color)] hover:prose-a:text-red-700"
                    data-aos="fade-up" data-aos-delay="100">
                    <?php the_content(); ?>
                </div>

                <?php wp_link_pages(['before' => '<div class="text-sm text-slate-500">' . esc_html__('Pages:', 'beit'), 'after' => '</div>']); ?>

                <div class="flex flex-wrap items-center gap-3 text-sm text-slate-500" data-aos="fade-up"
                    data-aos-delay="200">
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 font-bold text-slate-700">
                        <i class="fa fa-calendar"></i>
                        <?php echo esc_html(get_the_date()); ?>
                    </span>

                </div>

                <div class="relative overflow-hidden  border border-slate-200 bg-gradient-to-br from-slate-50 via-white to-slate-50 p-8 shadow-lg"
                    data-aos="fade-up" data-aos-delay="250">
                    <div class="absolute -right-12 -top-12 h-32 w-32 rounded-full bg-red-100 opacity-20 blur-3xl"></div>
                    <div class="absolute -bottom-8 -left-8 h-24 w-24 rounded-full bg-blue-100 opacity-20 blur-2xl"></div>

                    <div class="relative space-y-6">
                        <div class="text-center">
                            <div class="mb-2 inline-flex items-center gap-2 rounded-full bg-red-50 px-4 py-2">
                                <i class="fa fa-share-alt text-[var(--main-color)]"></i>
                                <h3 class="text-sm font-bold uppercase tracking-wider text-[var(--main-color)]">
                                    <?php echo esc_html(beit_translate('Share This Article')); ?>
                                </h3>
                            </div>
                            <p class="text-xs text-slate-500">
                                <?php echo esc_html(beit_translate('Spread the word on social media')); ?>
                            </p>
                        </div>

                        <div class="flex flex-wrap items-center justify-center gap-3">
                            <?php
                            $post_url = urlencode(get_permalink());
                            $post_title = urlencode(get_the_title());

                            $social_links = [
                                [
                                    'name' => 'Facebook',
                                    'url' => 'https://www.facebook.com/sharer/sharer.php?u=' . $post_url,
                                    'icon' => 'fa-facebook',
                                    'bg' => 'from-blue-600 to-blue-700',
                                    'hover' => 'hover:from-blue-700 hover:to-blue-800',
                                    'shadow' => 'shadow-blue-500/50'
                                ],
                                [
                                    'name' => 'X (Twitter)',
                                    'url' => 'https://twitter.com/intent/tweet?url=' . $post_url . '&text=' . $post_title,
                                    'icon' => 'x-twitter',
                                    'bg' => 'from-slate-800 to-slate-900',
                                    'hover' => 'hover:from-slate-900 hover:to-black',
                                    'shadow' => 'shadow-slate-800/50'
                                ],
                                [
                                    'name' => 'WhatsApp',
                                    'url' => 'https://wa.me/?text=' . $post_title . '%20' . $post_url,
                                    'icon' => 'fa-whatsapp',
                                    'bg' => 'from-green-500 to-green-600',
                                    'hover' => 'hover:from-green-600 hover:to-green-700',
                                    'shadow' => 'shadow-green-500/50'
                                ],
                                [
                                    'name' => 'Telegram',
                                    'url' => 'https://t.me/share/url?url=' . $post_url . '&text=' . $post_title,
                                    'icon' => 'fa-telegram',
                                    'bg' => 'from-sky-500 to-sky-600',
                                    'hover' => 'hover:from-sky-600 hover:to-sky-700',
                                    'shadow' => 'shadow-sky-500/50'
                                ],
                                [
                                    'name' => 'LinkedIn',
                                    'url' => 'https://www.linkedin.com/sharing/share-offsite/?url=' . $post_url,
                                    'icon' => 'fa-linkedin',
                                    'bg' => 'from-blue-700 to-blue-800',
                                    'hover' => 'hover:from-blue-800 hover:to-blue-900',
                                    'shadow' => 'shadow-blue-700/50'
                                ],
                                [
                                    'name' => 'Email',
                                    'url' => 'mailto:?subject=' . $post_title . '&body=' . $post_url,
                                    'icon' => 'fa-envelope',
                                    'bg' => 'from-red-600 to-red-700',
                                    'hover' => 'hover:from-red-700 hover:to-red-800',
                                    'shadow' => 'shadow-red-600/50',
                                    'external' => false
                                ]
                            ];

                            foreach ($social_links as $link):
                                $is_external = !isset($link['external']) || $link['external'] !== false;
                                ?>
                                <a href="<?php echo $link['url']; ?>" <?php if ($is_external): ?> target="_blank"
                                        rel="noopener noreferrer" <?php endif; ?>
                                    class="group relative inline-flex h-14 w-14 transform items-center text-white justify-center overflow-hidden rounded-full bg-gradient-to-br <?php echo $link['bg']; ?>  shadow-lg <?php echo $link['shadow']; ?> transition-all duration-300 <?php echo $link['hover']; ?> hover:scale-110 hover:shadow-xl"
                                    aria-label="<?php echo esc_attr(sprintf(__('Share on %s', 'beit'), $link['name'])); ?>">
                                    <?php if ($link['icon'] === 'x-twitter'): ?>
                                        <span class="relative z-10 w-5 h-5">
                                            <?php echo file_get_contents(get_template_directory() . '/resources/assets/images/x.svg'); ?>
                                        </span>
                                    <?php else: ?>
                                        <i class="fa <?php echo $link['icon']; ?> relative z-10 text-xl"></i>
                                    <?php endif; ?>
                                    <div
                                        class="absolute inset-0 bg-white opacity-0 transition-opacity duration-300 group-hover:opacity-20">
                                    </div>
                                </a>
                            <?php endforeach; ?>

                            <button onclick="copyToClipboard()" id="copyLinkBtn"
                                class="group relative inline-flex h-14 w-14 transform items-center text-white justify-center overflow-hidden rounded-full bg-gradient-to-br from-slate-700 to-slate-800 shadow-lg shadow-slate-700/50 transition-all duration-300 hover:from-slate-800 hover:to-slate-900 hover:scale-110 hover:shadow-xl"
                                aria-label="<?php echo esc_attr(beit_translate('Copy Link')); ?>">
                                <i class="fa fa-link relative z-10 text-xl" id="copyIcon"></i>
                                <i class="fa fa-check absolute z-10 text-xl opacity-0 transition-opacity duration-300"
                                    id="checkIcon"></i>
                                <div
                                    class="absolute inset-0 bg-white opacity-0 transition-opacity duration-300 group-hover:opacity-20">
                                </div>
                            </button>
                        </div>

                        <div class="text-center">
                            <div class="inline-flex items-center gap-2  bg-slate-100 px-4 py-2 text-xs">
                                <i class="fa fa-link text-slate-600"></i>
                                <input type="text" readonly value="<?php echo esc_attr(get_permalink()); ?>"
                                    class="max-w-[200px] truncate border-0 bg-transparent text-slate-600 focus:outline-none sm:max-w-xs md:max-w-md"
                                    id="shareUrl">
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function copyToClipboard() {
                        const url = '<?php echo esc_js(get_permalink()); ?>';
                        const input = document.getElementById('shareUrl');
                        const copyIcon = document.getElementById('copyIcon');
                        const checkIcon = document.getElementById('checkIcon');
                        const btn = document.getElementById('copyLinkBtn');

                        if (navigator.clipboard && navigator.clipboard.writeText) {
                            navigator.clipboard.writeText(url).then(function () {
                                showCopySuccess();
                            }).catch(function () {
                                fallbackCopy();
                            });
                        } else {
                            fallbackCopy();
                        }

                        function fallbackCopy() {
                            input.select();
                            input.setSelectionRange(0, 99999);
                            try {
                                document.execCommand('copy');
                                showCopySuccess();
                            } catch (err) {
                                alert('<?php echo esc_js(beit_translate('Failed to copy the link')); ?>');
                            }
                        }

                        function showCopySuccess() {
                            copyIcon.style.opacity = '0';
                            checkIcon.style.opacity = '1';
                            btn.classList.remove('from-slate-700', 'to-slate-800');
                            btn.classList.add('from-green-600', 'to-green-700');

                            setTimeout(function () {
                                copyIcon.style.opacity = '1';
                                checkIcon.style.opacity = '0';
                                btn.classList.remove('from-green-600', 'to-green-700');
                                btn.classList.add('from-slate-700', 'to-slate-800');
                            }, 2000);
                        }
                    }
                </script>

                <nav class="mt-12 flex flex-wrap items-center justify-between gap-4 border-t border-slate-200 pt-6 text-sm font-bold text-[var(--main-color)]"
                    data-aos="fade-up" data-aos-delay="300">
                    <span>
                        <?php previous_post_link('%link', '<i class="fa' . esc_attr($is_rtl ? 'fa-arrow-right' : 'fa-arrow-left') . '"></i> ' . esc_html(beit_translate('Previous'))); ?>
                    </span>
                    <span>
                        <?php next_post_link('%link', esc_html(beit_translate('Next')) . ' <i class="fa' . esc_attr($is_rtl ? 'fa-arrow-left' : 'fa-arrow-right') . '"></i>'); ?>
                    </span>
                </nav>

                <?php
                $latest_articles = new WP_Query(
                    [
                        'post_type' => 'beit_news',
                        'posts_per_page' => 3,
                        'post_status' => 'publish',
                        'post__not_in' => [get_the_ID()],
                        'orderby' => 'date',
                        'order' => 'DESC',
                    ]
                );

                if ($latest_articles->have_posts()):
                    ?>
                    <section class="mt-16 border-t border-slate-200 pt-12" data-aos="fade-up" data-aos-delay="400">
                        <div class="mb-8 flex items-center justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-slate-900">
                                    <?php echo esc_html(beit_translate('Latest Articles')); ?>
                                </h2>
                                <p class="mt-1 text-sm text-slate-500">
                                    <?php echo esc_html(beit_translate('Stay informed with our most recent stories')); ?>
                                </p>
                            </div>
                            <a href="<?php echo esc_url(get_post_type_archive_link('beit_news')); ?>"
                                class="inline-flex items-center gap-2 text-sm font-bold text-[var(--main-color)] transition ">
                                <?php echo esc_html(beit_translate('View All')); ?>
                                <i class="fa <?php echo $is_rtl ? 'fa-arrow-left' : 'fa-arrow-right'; ?>"></i>
                            </a>
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            <?php
                            while ($latest_articles->have_posts()):
                                $latest_articles->the_post();
                                $article_thumb = get_post_thumbnail_id();
                                ?>
                                <article
                                    class="group flex h-full flex-col overflow-hidden  bg-white shadow-md transition-all duration-300 hover:shadow-xl"
                                    data-aos="fade-up" data-aos-delay="<?php echo 100 + ($latest_articles->current_post * 50); ?>">
                                    <?php if ($article_thumb): ?>
                                        <a href="<?php the_permalink(); ?>" class="block relative overflow-hidden aspect-[16/10]">
                                            <?php echo wp_get_attachment_image($article_thumb, 'large', false, [
                                                'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110'
                                            ]); ?>
                                        </a>
                                    <?php endif; ?>

                                    <div class="flex flex-1 flex-col p-5">
                                        <div class="mb-3 flex items-center gap-3 text-xs text-slate-500">
                                            <span class="inline-flex items-center gap-1">
                                                <i class="fa fa-calendar"></i>
                                                <?php echo esc_html(get_the_date()); ?>
                                            </span>
                                        </div>

                                        <h3
                                            class="mb-3 line-clamp-2 h-14 text-lg font-bold text-slate-900 transition group-hover:text-[var(--main-color)]">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>

                                        <p class="mb-4 line-clamp-3 h-[4.5rem] text-sm leading-relaxed text-slate-600">
                                            <?php echo esc_html(wp_trim_words(get_the_excerpt(), 20, '...')); ?>
                                        </p>

                                        <a href="<?php the_permalink(); ?>"
                                            class="mt-auto inline-flex items-center gap-2 text-sm font-bold text-[var(--main-color)] transition hover:gap-3 hover:[var(--second-color)]">
                                            <?php echo esc_html(beit_translate('Read More')); ?>
                                            <i class="fa <?php echo $is_rtl ? 'fa-arrow-left' : 'fa-arrow-right'; ?>"></i>
                                        </a>
                                    </div>
                                </article>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </section>
                    <?php
                endif;
                ?>
            </div>

            <aside class="space-y-8" data-aos="fade-left" data-aos-delay="200">
                <?php
                $recent = new WP_Query(
                    [
                        'post_type' => 'beit_news',
                        'posts_per_page' => 3,
                        'post_status' => 'publish',
                        'post__not_in' => [get_the_ID()],
                        'orderby' => 'date',
                    ]
                );

                if ($recent->have_posts()):
                    ?>
                    <section class=" border border-slate-200 bg-white p-6 shadow-sm" data-aos="fade-left" data-aos-delay="400">
                        <h2 class="text-sm font-bold uppercase tracking-widest text-slate-500">
                            <?php echo esc_html(beit_translate('Recent News')); ?>
                        </h2>
                        <ul class="mt-4 space-y-4 text-sm text-slate-700">
                            <?php
                            while ($recent->have_posts()):
                                $recent->the_post();
                                ?>
                                <li>
                                    <a class="flex gap-3 transition hover:text-[var(--main-color)]"
                                        href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()): ?>
                                            <span class="h-14 w-20 overflow-hidden ">
                                                <?php the_post_thumbnail('thumbnail', ['class' => 'h-full w-full object-cover']); ?>
                                            </span>
                                        <?php endif; ?>
                                        <span class="flex-1">
                                            <span
                                                class="block text-xs text-slate-400"><?php echo esc_html(get_the_date()); ?></span>
                                            <span class="block font-bold"><?php the_title(); ?></span>
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
