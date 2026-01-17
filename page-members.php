<?php

/**
 * Members page template.
 *
 * @package beit
 *
 * Template Name: Members Page
 * Template Post Type: page
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

// Store current page info before any queries
$current_page_id = get_the_ID();
$hero_title = get_the_title($current_page_id);
$hero_description = get_post_field('post_content', $current_page_id);

// Fetch all members
$members_query = new WP_Query([
    'post_type' => 'beit_member',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'menu_order',
    'order' => 'ASC',
]);

get_template_part(
    'resources/views/components/page-hero',
    null,
    [
        'title' => $hero_title,
        'description' => $hero_description,
        'background_classes' => 'bg-gradient-to-br from-slate-900 via-red-800 to-slate-950',
    ]
);

?>
<main class="bg-[#F9F9F9] text-slate-900">
    <section class="container mx-auto px-4 py-16 md:px-6">
        <?php if ($members_query->have_posts()): ?>
            <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                <?php
                while ($members_query->have_posts()):
                    $members_query->the_post();
                    $thumbnail_id = get_post_thumbnail_id();
                ?>
                    <div class="rounded-lg flex flex-col items-center justify-center border border-gray-200 bg-white p-6 transition hover:shadow-lg"
                        data-aos="fade-up" data-aos-delay="<?php echo $members_query->current_post * 50; ?>">
                        <?php if ($thumbnail_id): ?>
                            <div class="h-32 w-full flex items-center justify-center mb-4">
                                <?php echo wp_get_attachment_image($thumbnail_id, 'medium', false, [
                                    'class' => 'max-h-full max-w-full object-contain'
                                ]); ?>
                            </div>
                        <?php endif; ?>
                        <h3 class="text-center text-sm font-medium text-slate-700">
                            <?php the_title(); ?>
                        </h3>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php else: ?>
            <div class="rounded-lg border border-slate-200 bg-white p-12 text-center shadow-sm">
                <h2 class="text-2xl font-bold text-slate-900">
                    <?php esc_html_e('No members found', 'beit'); ?>
                </h2>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php
get_footer();
