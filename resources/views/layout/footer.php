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
        <div class="flex flex-col items-center gap-6">
            <!-- Top Row: Logo, Social Media, Back to Top -->
            <div class="flex flex-col md:flex-row items-center justify-between w-full gap-6">
                <div class="flex items-center justify-center md:justify-start">
                    <?php
                    $logo_id = function_exists('get_field') ? get_field('footer_logo', 'option') : 0;
                    if ($logo_id) {
                        echo wp_get_attachment_image($logo_id, 'medium', false, [
                            'class' => 'h-20 object-contain w-auto',
                            'alt' => esc_attr(get_bloginfo('name')),
                        ]);
                    } else {
                        echo '<span class="text-white font-bold text-lg">' . esc_html(get_bloginfo('name')) . '</span>';
                    }
                    ?>
                </div>

                <?php
                $social_links = [];
                if (function_exists('get_field')) {
                    $links_option = get_field('topbar_social_links', 'option') ?: [];
                    foreach ($links_option as $item) {
                        $network = $item['network'] ?? '';
                        $url = (string) ($item['url'] ?? '');
                        $icon = 'fa fa-globe';
                        switch ($network) {
                            case 'facebook':
                                $icon = 'fa fa-facebook';
                                break;
                            case 'twitter':
                                $icon = 'fa fa-twitter';
                                break;
                            case 'instagram':
                                $icon = 'fa fa-instagram';
                                break;
                            case 'youtube':
                                $icon = 'fa fa-youtube-play';
                                break;
                            case 'linkedin':
                                $icon = 'fa fa-linkedin';
                                break;
                            default:
                                $icon = 'fa fa-globe';
                                break;
                        }
                        if ($url) {
                            $social_links[] = [
                                'icon' => $icon,
                                'url' => $url,
                                'network' => $network,
                            ];
                        }
                    }
                }
                ?>

                <?php if (!empty($social_links)): ?>
                    <div class="flex items-center justify-center gap-3">
                        <?php foreach ($social_links as $social): ?>
                            <a class="flex items-center justify-center w-10 h-10 rounded-full bg-white/10 text-white transition hover:bg-primary hover:scale-110"
                                href="<?php echo esc_url($social['url']); ?>" target="_blank" rel="noopener"
                                aria-label="<?php echo esc_attr(ucwords($social['network'])); ?>">
                                <?php if ($social['network'] === 'twitter'): ?>
                                    <span class="w-4 h-4">
                                        <?php echo file_get_contents(get_template_directory() . '/resources/assets/images/x.svg'); ?>
                                    </span>
                                <?php else: ?>
                                    <i class="<?php echo esc_attr($social['icon']); ?> text-base"></i>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="flex items-center justify-center md:justify-end">
                    <button id="back-to-top" type="button"
                        class="rounded-full w-12 h-12 inline-flex items-center justify-center bg-primary text-white hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <span class="sr-only"><?php esc_html_e('Back to top', 'beit'); ?></span>
                        <i class="fa fa-chevron-up"></i>
                    </button>
                </div>
            </div>

            <!-- Bottom Row: Copyright -->
            <div class="text-center text-white text-base font-medium w-full border-t border-white/10 pt-6">
                <?php
                printf(
                    /* translators: 1: current year, 2: site name */
                    esc_html(beit_translate('© %1$s %2$s. All rights reserved.')),
                    esc_html(gmdate('Y')),
                    esc_html(get_bloginfo('name'))
                );
                ?>
            </div>
        </div>
    </div>

</footer>

</div><!-- .theme-wrapper -->

<?php wp_footer(); ?>
</body>

</html>