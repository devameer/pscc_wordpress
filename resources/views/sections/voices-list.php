<?php

/**
 * Voices & Visions listing grid.
 *
 * @package beit
 */

$args = wp_parse_args(
    $args ?? [],
    [
        'posts' => [],
    ]
);

$posts = $args['posts'];

if (empty($posts)) {
    return;
}

?>

<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    <?php foreach ($posts as $voice) :
        $image_id  = $voice['image'] ?? '';
        $permalink = $voice['link'] ?? '#';
        $title     = $voice['title'] ?? '';
        $raw_excerpt = $voice['excerpt'] ?? '';
        $excerpt  = $raw_excerpt ? wp_trim_words(wp_strip_all_tags($raw_excerpt), 26, '…') : '';
        ?>
        <article class="group overflow-hidden  bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
            <?php if ($image_id) : ?>
                <a href="<?php echo esc_url($permalink); ?>" class="block overflow-hidden">
                    <?php
                    if (is_numeric($image_id)) {
                        echo wp_get_attachment_image((int) $image_id, 'large', false, ['class' => 'h-64 w-full object-cover transition duration-500 group-hover:scale-105']);
                    } else {
                        ?>
                        <img class="h-64 w-full object-cover transition duration-500 group-hover:scale-105" src="<?php echo esc_url((string) $image_id); ?>" alt="" loading="lazy" decoding="async">
                        <?php
                    }
                    ?>
                </a>
            <?php endif; ?>

            <div class="space-y-3 p-6">
                <h3 class="text-lg font-semibold text-slate-900">
                    <a class="transition hover:text-red-600" href="<?php echo esc_url($permalink); ?>">
                        <?php echo esc_html($title); ?>
                    </a>
                </h3>
                <?php if ($excerpt) : ?>
                    <p class="text-sm text-slate-600">
                        <?php echo esc_html($excerpt); ?>
                    </p>
                <?php endif; ?>
            </div>
        </article>
    <?php endforeach; ?>
</div>
