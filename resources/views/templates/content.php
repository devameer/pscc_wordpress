<?php
/**
 * Generic content template.
 *
 * @package beit
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if (is_singular()) {
            the_title('<h1 class="entry-title">', '</h1>');
        } else {
            the_title(
                sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
                '</a></h2>'
            );
        }
        ?>
    </header>

    <div class="entry-content">
        <?php
        the_content(
            sprintf(
                wp_kses(
                    __('Continue reading %s <span class="meta-nav">&rarr;</span>', 'beit'),
                    ['span' => ['class' => []]]
                ),
                wp_kses_post(get_the_title())
            )
        );

        wp_link_pages(
            [
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'beit'),
                'after'  => '</div>',
            ]
        );
        ?>
    </div>

    <footer class="entry-footer">
        <?php
        edit_post_link(
            sprintf(
                wp_kses(
                    __('Edit <span class="screen-reader-text">%s</span>', 'beit'),
                    ['span' => ['class' => []]]
                ),
                wp_kses_post(get_the_title())
            ),
            '<span class="edit-link">',
            '</span>'
        );
        ?>
    </footer>
</article>

