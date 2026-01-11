<?php

/**
 * Custom search form template.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

$search_query = get_search_query();
$placeholder = beit_translate('Search for news, programs, stories...', 'search_placeholder');
$post_type_filter = isset($_GET['post_type']) ? sanitize_text_field($_GET['post_type']) : '';

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="relative flex items-center">
        <label for="search-field" class="sr-only">
            <?php esc_html_e('Search', 'beit'); ?>
        </label>

        <input type="search" id="search-field"
            class="w-full rounded-full border-2 border-slate-200 bg-white px-6 py-4 pl-14 pr-32 text-slate-900 placeholder-slate-400 transition focus:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-600/20 md:px-8 md:py-5"
            placeholder="<?php echo esc_attr($placeholder); ?>"
            value="<?php echo $search_query ? esc_attr($search_query) : ''; ?>" name="s" required>

        <?php if ($post_type_filter): ?>
            <input type="hidden" name="post_type" value="<?php echo esc_attr($post_type_filter); ?>">
        <?php endif; ?>

        <span class="absolute left-5 text-slate-400">
            <i class="fa fa-magnifying-glass"></i>
        </span>

        <button type="submit"
            class="absolute ltr:right-2 rtl:left-2 rounded-full bg-red-600 px-6 py-3 text-sm font-bold uppercase tracking-wide text-white transition hover:bg-primary focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 md:px-8 md:py-4">
            <?php esc_html_e('Search', 'beit'); ?>
        </button>
    </div>
</form>