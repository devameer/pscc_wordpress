<?php

/**
 * Single template for blog posts.
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
    $thumbnail = get_post_thumbnail_id();
    $categories = get_the_category();
    $primary_cat = !empty($categories) ? $categories[0] : null;

    $hero_title = get_the_title();
    $hero_description = sprintf(
        '%s %s',
        esc_html(get_the_date()),
        $primary_cat ? '· ' . esc_html($primary_cat->name) : ''
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

    <main class="bg-gradient-to-b from-gray-50 to-white text-slate-900">
        <article class="container mx-auto px-4 py-12 md:px-6 md:py-16">

            <!-- Main Grid Layout -->
            <div class="mx-auto max-w-7xl">
                <div class="grid gap-8 lg:grid-cols-12">

                    <!-- Main Content Area -->
                    <div class="lg:col-span-8 space-y-8">

                        <!-- Featured Image -->
                        <?php if ($thumbnail): ?>
                            <div class="relative overflow-hidden rounded-2xl shadow-2xl group" data-aos="fade-up">
                                <?php echo wp_get_attachment_image($thumbnail, 'full', false, ['class' => 'w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105']); ?>

                                <!-- Category Badge Overlay -->
                                <?php if ($primary_cat): ?>
                                    <div class="absolute top-6 ltr:left-6 rtl:right-6">
                                        <a href="<?php echo esc_url(get_category_link($primary_cat->term_id)); ?>"
                                            class="flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 shadow-xl transition-all hover:bg-primary">
                                            <i class="fa fa-tag text-white"></i>
                                            <span class="font-bold text-white"><?php echo esc_html($primary_cat->name); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                            </div>
                        <?php endif; ?>

                        <!-- Post Meta -->
                        <div class="flex flex-wrap items-center gap-4 rounded-xl bg-white p-5 shadow-md" data-aos="fade-up"
                            data-aos-delay="50">
                            <div class="flex items-center gap-2 text-sm text-slate-600">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-100">
                                    <i class="fa fa-calendar-alt text-red-600"></i>
                                </div>
                                <div class="ltr:text-left rtl:text-right">
                                    <div class="text-xs font-bold uppercase tracking-wide text-slate-500">
                                        <?php echo esc_html__('Published', 'beit'); ?>
                                    </div>
                                    <div class="font-bold text-slate-900">
                                        <?php echo esc_html(get_the_date()); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="h-8 w-px bg-slate-200"></div>

                            <div class="flex items-center gap-2 text-sm text-slate-600">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100">
                                    <i class="fa fa-user text-blue-600"></i>
                                </div>
                                <div class="ltr:text-left rtl:text-right">
                                    <div class="text-xs font-bold uppercase tracking-wide text-slate-500">
                                        <?php echo esc_html__('Author', 'beit'); ?>
                                    </div>
                                    <div class="font-bold text-slate-900">
                                        <?php echo esc_html(get_the_author()); ?>
                                    </div>
                                </div>
                            </div>

                            <?php if (get_comments_number() > 0): ?>
                                <div class="h-8 w-px bg-slate-200"></div>
                                <div class="flex items-center gap-2 text-sm text-slate-600">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-100">
                                        <i class="fa fa-comments text-green-600"></i>
                                    </div>
                                    <div class="ltr:text-left rtl:text-right">
                                        <div class="text-xs font-bold uppercase tracking-wide text-slate-500">
                                            <?php echo esc_html__('Comments', 'beit'); ?>
                                        </div>
                                        <div class="font-bold text-slate-900">
                                            <?php echo esc_html(get_comments_number()); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Post Content -->
                        <div class="rounded-xl bg-white p-6 shadow-lg md:p-10" data-aos="fade-up" data-aos-delay="100">
                            <div
                                class="wp-content prose max-w-none prose-lg prose-slate prose-headings:font-bold prose-headings:text-slate-900 prose-p:text-slate-700 prose-p:leading-relaxed prose-a:text-red-600 hover:prose-a:text-red-700 prose-strong:text-slate-900 prose-ul:text-slate-700 prose-img:rounded-xl ltr:text-left rtl:text-right">
                                <?php the_content(); ?>
                            </div>
                            <?php wp_link_pages(['before' => '<div class="mt-8 text-sm text-slate-500">' . esc_html__('Pages:', 'beit'), 'after' => '</div>']); ?>
                        </div>

                        <!-- Tags -->
                        <?php
                        $tags = get_the_tags();
                        if ($tags):
                        ?>
                            <div class="rounded-xl bg-white p-6 shadow-md" data-aos="fade-up" data-aos-delay="150">
                                <h3 class="mb-4 flex items-center gap-2 text-lg font-bold text-slate-900">
                                    <i class="fa fa-tags text-red-600"></i>
                                    <?php echo esc_html__('Tags', 'beit'); ?>
                                </h3>
                                <div class="flex flex-wrap gap-2">
                                    <?php foreach ($tags as $tag): ?>
                                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"
                                            class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-3 py-1.5 text-sm font-medium text-slate-700 transition-all hover:bg-red-100 hover:text-red-600">
                                            <i class="fa fa-hashtag text-xs"></i>
                                            <?php echo esc_html($tag->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Social Share -->
                        <div class="relative overflow-hidden rounded-2xl border-2 border-red-100 bg-gradient-to-br from-red-50 via-white to-orange-50 p-8 shadow-xl"
                            data-aos="fade-up" data-aos-delay="200">

                            <!-- Decorative Elements -->
                            <div class="absolute -right-12 -top-12 h-32 w-32 rounded-full bg-red-100 opacity-20 blur-3xl">
                            </div>
                            <div
                                class="absolute -bottom-8 -left-8 h-24 w-24 rounded-full bg-orange-100 opacity-20 blur-2xl">
                            </div>

                            <div class="relative space-y-6">
                                <div class="text-center">
                                    <div
                                        class="mb-2 inline-flex items-center gap-2 rounded-full bg-primary px-5 py-2.5 shadow-lg">
                                        <i class="fa fa-share-alt text-white"></i>
                                        <h3 class="text-sm font-bold uppercase tracking-wider text-white">
                                            <?php echo esc_html__('Share this post', 'beit'); ?>
                                        </h3>
                                    </div>
                                    <p class="mt-2 text-sm text-slate-600">
                                        <?php echo esc_html__('Share on your favorite social media', 'beit'); ?>
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
                                            'hover' => 'hover:from-blue-700 hover:to-blue-800'
                                        ],
                                        [
                                            'name' => 'X (Twitter)',
                                            'url' => 'https://twitter.com/intent/tweet?url=' . $post_url . '&text=' . $post_title,
                                            'icon' => 'x-twitter',
                                            'bg' => 'from-slate-800 to-slate-900',
                                            'hover' => 'hover:from-slate-900 hover:to-black'
                                        ],
                                        [
                                            'name' => 'WhatsApp',
                                            'url' => 'https://wa.me/?text=' . $post_title . '%20' . $post_url,
                                            'icon' => 'fa-whatsapp',
                                            'bg' => 'from-green-500 to-green-600',
                                            'hover' => 'hover:from-green-600 hover:to-green-700'
                                        ],
                                        [
                                            'name' => 'Telegram',
                                            'url' => 'https://t.me/share/url?url=' . $post_url . '&text=' . $post_title,
                                            'icon' => 'fa-telegram',
                                            'bg' => 'from-sky-500 to-sky-600',
                                            'hover' => 'hover:from-sky-600 hover:to-sky-700'
                                        ],
                                        [
                                            'name' => 'LinkedIn',
                                            'url' => 'https://www.linkedin.com/sharing/share-offsite/?url=' . $post_url,
                                            'icon' => 'fa-linkedin',
                                            'bg' => 'from-blue-700 to-blue-800',
                                            'hover' => 'hover:from-blue-800 hover:to-blue-900'
                                        ],
                                        [
                                            'name' => 'Email',
                                            'url' => 'mailto:?subject=' . $post_title . '&body=' . $post_url,
                                            'icon' => 'fa-envelope',
                                            'bg' => 'from-red-600 to-red-700',
                                            'hover' => 'hover:from-red-700 hover:to-red-800',
                                            'external' => false
                                        ]
                                    ];

                                    foreach ($social_links as $link):
                                        $is_external = !isset($link['external']) || $link['external'] !== false;
                                    ?>
                                        <a href="<?php echo $link['url']; ?>" <?php if ($is_external): ?>target="_blank"
                                            rel="noopener noreferrer" <?php endif; ?>
                                            class="group relative inline-flex h-14 w-14 transform items-center justify-center overflow-hidden rounded-xl bg-gradient-to-br <?php echo $link['bg']; ?> text-white shadow-lg transition-all duration-300 <?php echo $link['hover']; ?> hover:scale-110 hover:shadow-xl"
                                            aria-label="<?php echo esc_attr(sprintf(__('Share on %s', 'beit'), $link['name'])); ?>">
                                            <?php if ($link['icon'] === 'x-twitter'): ?>
                                                <span class="relative z-10 h-5 w-5">
                                                    <?php
                                                    $x_svg_path = get_template_directory() . '/resources/assets/images/x.svg';
                                                    if (file_exists($x_svg_path)) {
                                                        echo file_get_contents($x_svg_path);
                                                    }
                                                    ?>
                                                </span>
                                            <?php else: ?>
                                                <i class="fa <?php echo $link['icon']; ?> relative z-10 text-xl"></i>
                                            <?php endif; ?>
                                        </a>
                                    <?php endforeach; ?>

                                    <button onclick="copyToClipboard()" id="copyLinkBtn"
                                        class="group relative inline-flex h-14 w-14 transform items-center justify-center overflow-hidden rounded-xl bg-gradient-to-br from-slate-700 to-slate-800 text-white shadow-lg transition-all duration-300 hover:from-slate-800 hover:to-slate-900 hover:scale-110 hover:shadow-xl"
                                        aria-label="<?php echo esc_attr__('Copy link', 'beit'); ?>">
                                        <i class="fa fa-link relative z-10 text-xl" id="copyIcon"></i>
                                        <i class="fa fa-check absolute z-10 text-xl opacity-0 transition-opacity duration-300"
                                            id="checkIcon"></i>
                                    </button>
                                </div>

                                <script>
                                    function copyToClipboard() {
                                        const url = window.location.href;
                                        navigator.clipboard.writeText(url).then(() => {
                                            const copyIcon = document.getElementById('copyIcon');
                                            const checkIcon = document.getElementById('checkIcon');
                                            copyIcon.classList.add('opacity-0');
                                            checkIcon.classList.remove('opacity-0');
                                            setTimeout(() => {
                                                copyIcon.classList.remove('opacity-0');
                                                checkIcon.classList.add('opacity-0');
                                            }, 2000);
                                        });
                                    }
                                </script>
                            </div>
                        </div>

                        <!-- Comments -->
                        <?php if (comments_open() || get_comments_number()): ?>
                            <div class="rounded-xl bg-white p-6 shadow-lg md:p-8" data-aos="fade-up" data-aos-delay="250">
                                <?php comments_template(); ?>
                            </div>
                        <?php endif; ?>

                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-4 space-y-6">

                        <!-- Categories Widget -->
                        <?php if (!empty($categories)): ?>
                            <div class="rounded-xl bg-white p-6 shadow-lg" data-aos="fade-up" data-aos-delay="100">
                                <h3 class="mb-4 flex items-center gap-2 text-lg font-bold text-slate-900">
                                    <i class="fa fa-folder text-red-600"></i>
                                    <?php echo esc_html__('Categories', 'beit'); ?>
                                </h3>
                                <div class="space-y-2">
                                    <?php foreach ($categories as $cat): ?>
                                        <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
                                            class="group flex items-center justify-between rounded-lg bg-slate-50 px-4 py-3 transition-all hover:bg-red-50">
                                            <span class="font-medium text-slate-700 group-hover:text-red-600">
                                                <?php echo esc_html($cat->name); ?>
                                            </span>
                                            <span class="text-xs text-slate-500">
                                                <?php echo esc_html($cat->count); ?>
                                            </span>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Recent Posts -->
                        <?php
                        $recent_posts = new WP_Query([
                            'post_type' => 'post',
                            'posts_per_page' => 5,
                            'post__not_in' => [get_the_ID()],
                        ]);

                        if ($recent_posts->have_posts()):
                        ?>
                            <div class="rounded-xl bg-white p-6 shadow-lg" data-aos="fade-up" data-aos-delay="150">
                                <h3 class="mb-4 flex items-center gap-2 text-lg font-bold text-slate-900">
                                    <i class="fa fa-clock text-red-600"></i>
                                    <?php echo esc_html__('Recent Posts', 'beit'); ?>
                                </h3>
                                <div class="space-y-4">
                                    <?php while ($recent_posts->have_posts()):
                                        $recent_posts->the_post(); ?>
                                        <a href="<?php the_permalink(); ?>"
                                            class="group flex gap-3 rounded-lg p-2 transition-all hover:bg-slate-50">
                                            <?php if (has_post_thumbnail()): ?>
                                                <div class="h-16 w-16 shrink-0 overflow-hidden rounded-lg">
                                                    <?php the_post_thumbnail('thumbnail', ['class' => 'h-full w-full object-cover transition-transform group-hover:scale-110']); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="flex-1 ltr:text-left rtl:text-right">
                                                <h4 class="line-clamp-2 text-sm font-bold text-slate-900 group-hover:text-red-600">
                                                    <?php the_title(); ?>
                                                </h4>
                                                <p class="mt-1 text-xs text-slate-500">
                                                    <i class="fa fa-calendar-alt"></i>
                                                    <?php echo esc_html(get_the_date()); ?>
                                                </p>
                                            </div>
                                        </a>
                                    <?php endwhile;
                                    wp_reset_postdata(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>

                </div>
            </div>

        </article>
    </main>

<?php
}

get_footer();
