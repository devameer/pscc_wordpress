<?php

/**
 * Facts & figures metrics section.
 *
 * @package beit
 */

$args = wp_parse_args(
    $args ?? [],
    [
        'facts' => [
            'title'    => '',
            'subtitle' => '',
            'filters'  => [],
            'items'    => [],
        ],
    ]
);

$facts = $args['facts'];

if (empty($facts['items'])) {
    return;
}

?>

<section class="bg-slate-700 py-20 text-white">
    <div class="container mx-auto px-4 md:px-6">
        <div class="mb-12 space-y-4 text-center">
            <?php if (!empty($facts['title'])) : ?>
                <h2 class="text-3xl font-bold md:text-4xl"><?php echo esc_html($facts['title']); ?></h2>
            <?php endif; ?>
            <?php if (!empty($facts['subtitle'])) : ?>
                <p class="text-base text-white/70 md:text-lg"><?php echo esc_html($facts['subtitle']); ?></p>
            <?php endif; ?>
        </div>

        <?php if (!empty($facts['filters']) && is_array($facts['filters'])) : ?>
            <div class="mb-12 flex flex-wrap items-center justify-center gap-3">
                <?php foreach ($facts['filters'] as $filter) :
                    $label       = $filter['label'] ?? '';
                    $highlighted = !empty($filter['highlighted']);
                    if (!$label) {
                        continue;
                    }
                    ?>
                    <button type="button" class="rounded-full px-6 py-2 text-sm font-semibold transition <?php echo $highlighted ? 'bg-red-600 text-white hover:bg-red-700' : 'bg-white/10 text-white/70 hover:bg-white/20'; ?>">
                        <?php echo esc_html($label); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            <?php foreach ($facts['items'] as $fact) :
                $value = $fact['value'] ?? '';
                $label = $fact['label'] ?? '';
                if (!$value && !$label) {
                    continue;
                }
                ?>
                <div class="rounded-2xl bg-slate-600 p-8 text-center shadow-lg">
                    <?php if ($value) : ?>
                        <div class="text-4xl font-extrabold md:text-5xl"><?php echo esc_html($value); ?></div>
                    <?php endif; ?>
                    <?php if ($label) : ?>
                        <div class="mt-3 text-xs font-semibold uppercase tracking-widest text-white/70">
                            <?php echo esc_html($label); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
