<?php
/**
 * Primary footer markup.
 *
 * @package beit
 */
?>
    </div><!-- #content -->

    <footer class="bg-[#282828] py-10 text-sm text-gray-300">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col items-center gap-6 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center justify-center md:justify-start">
                    <?php
                    $logo_id = function_exists('get_field') ? get_field('footer_logo', 'option') : 0;
                    if ($logo_id) {
                        echo wp_get_attachment_image($logo_id, 'medium', false, [
                            'class' => 'h-20 object-contain w-auto',
                            'alt'   => esc_attr(get_bloginfo('name')),
                        ]);
                    } else {
                        echo '<span class="text-white font-semibold text-lg">' . esc_html(get_bloginfo('name')) . '</span>';
                    }
                    ?>
                </div>

                <div class="text-center text-white text-base font-medium">
                    <?php
                    printf(
                        /* translators: 1: current year, 2: site name */
                        esc_html__('© %1$s %2$s. All rights reserved.', 'beit'),
                        esc_html(gmdate('Y')),
                        esc_html(get_bloginfo('name'))
                    );
                    ?>
                </div>

                <div class="flex items-center justify-center md:justify-end">
                    <button id="back-to-top" type="button" class="w-12 h-12 inline-flex items-center justify-center bg-primary ext-white hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <span class="sr-only"><?php esc_html_e('Back to top', 'beit'); ?></span>
                        <i class="fa fa-chevron-up"></i>
                    </button>
                </div>
            </div>
        </div>

    </footer>

    </div><!-- .theme-wrapper -->

    <?php wp_footer(); ?>
</body>
</html>
