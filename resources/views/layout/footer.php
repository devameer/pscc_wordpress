<?php
/**
 * Primary footer markup.
 *
 * @package beit
 */
?>
    </div><!-- #content -->

    <footer class="bg-[#0f1112] py-10 text-sm text-gray-300">
        <div class="container mx-auto flex flex-col gap-6 px-4 md:px-6 md:flex-row md:items-center md:justify-between">
            <div class="space-y-2 text-center md:text-left">
                <div class="text-xs uppercase tracking-widest text-gray-500">
                    <?php bloginfo('name'); ?>
                </div>
                <div class="text-gray-400">
                    <?php
                    printf(
                        /* translators: 1: current year, 2: site name */
                        esc_html__('© %1$s %2$s. All rights reserved.', 'beit'),
                        esc_html(gmdate('Y')),
                        esc_html(get_bloginfo('name'))
                    );
                    ?>
                </div>
            </div>

            <div class="flex items-center justify-center gap-4">
                <?php
                wp_nav_menu(
                    [
                        'theme_location' => 'footer',
                        'menu_id'        => 'footer-menu',
                        'menu_class'     => 'flex flex-wrap justify-center gap-4 text-xs uppercase tracking-wide text-gray-400',
                        'container'      => false,
                        'fallback_cb'    => false,
                        'depth'          => 1,
                    ]
                );
                ?>
            </div>
        </div>

    </footer>

    </div><!-- .theme-wrapper -->

    <?php wp_footer(); ?>
</body>
</html>
