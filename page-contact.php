<?php

/**
 * Contact page template with custom design.
 *
 * @package beit
 *
 * Template Name: Contact Page
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) {
    the_post();

    $has_acf = function_exists('get_field');

    $hero_data       = $has_acf ? (get_field('contact_hero') ?: []) : [];
    $hero_subtitle_acf   = $hero_data['subtitle'] ?? '';
    $hero_subtitle   = get_the_content() ; // Use page content first, then ACF field

    $contact_details = $has_acf ? (get_field('contact_details') ?: []) : [];
    $social_links    = [];
    if ($has_acf) {
        $links_option = get_field('topbar_social_links', 'option') ?: [];
        foreach ($links_option as $item) {
            $network = $item['network'] ?? '';
            $url     = (string) ($item['url'] ?? '');
            $icon    = 'fa fa-globe';
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
                    $icon = 'fa fa-youtube';
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
                    'url'  => $url,
                ];
            }
        }
    }
    $offices         = $has_acf ? (get_field('contact_offices') ?: []) : [];
    $form_shortcode  = $has_acf ? get_field('contact_form_shortcode') : '';

    // Map data
    $google_maps_api_key = $has_acf ? get_field('contact_google_maps_api_key') : '';
    $map_default_center  = $has_acf ? (get_field('contact_map_default_center') ?: []) : [];
    $map_offices         = $has_acf ? (get_field('contact_map_offices') ?: []) : [];
    $map_warehouses      = $has_acf ? (get_field('contact_map_warehouses') ?: []) : [];

    $email   = $contact_details['email'] ?? '';
    $phone   = $contact_details['phone'] ?? '';
    $address = $contact_details['address'] ?? '';
    $hero_custom_title = $hero_data['custom_title'] ?? '';
    $hero_title =  $hero_custom_title ?: get_the_title();
    get_template_part(
        'resources/views/components/page-hero',
        null,
        [
            'title'            => $hero_title,
            'description'      => $hero_subtitle,
            'background_classes' => 'bg-gradient-to-br from-red-800 via-slate-900 to-red-950',
            'overlay_gradients' => true,
        ]
    );
?>


    <main class="bg-gray-50 text-slate-900">
        <div class="container mx-auto grid gap-10 px-4 py-12 lg:grid-cols-5">
            <section class="rounded-lg bg-white p-8 shadow-sm lg:col-span-2" data-aos="fade-up">
                <h2 class="text-2xl font-bold text-gray-800 ltr:text-left rtl:text-right">
                    <?php esc_html_e('Share Your Thoughts Here', 'beit'); ?>
                </h2>

                <div class="mt-6">
                    <?php
                    if ($form_shortcode) {
                        echo do_shortcode($form_shortcode); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    } else {
                    ?>
                        <form class="space-y-4">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <input type="text" placeholder="<?php esc_attr_e('Your name', 'beit'); ?>"
                                    class="form-field"
                                    required>
                                <input type="email" placeholder="<?php esc_attr_e('Your email', 'beit'); ?>"
                                    class="form-field"
                                    required>
                            </div>

                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <input type="text" placeholder="<?php esc_attr_e('Subject', 'beit'); ?>"
                                    class="form-field">
                                <select class="form-field text-gray-500">
                                    <option value="">
                                        <?php esc_html_e('Reason', 'beit'); ?>
                                    </option>
                                    <option value="general"><?php esc_html_e('General Inquiry', 'beit'); ?></option>
                                    <option value="support"><?php esc_html_e('Support', 'beit'); ?></option>
                                    <option value="partnership"><?php esc_html_e('Partnership', 'beit'); ?></option>
                                </select>
                            </div>

                            <textarea placeholder="<?php esc_attr_e('Your message here...', 'beit'); ?>" rows="6"
                                class="form-field"></textarea>

                            <div class="flex flex-wrap items-center gap-4">
                                <button type="submit"
                                    class="button-form">
                                    <?php esc_html_e('Send', 'beit'); ?>
                                </button>
                                <span class="text-gray-500"><?php esc_html_e('or', 'beit'); ?></span>
                                <button type="reset" class="font-semibold text-red-600 underline hover:text-red-700">
                                    <?php esc_html_e('Clear', 'beit'); ?>
                                </button>
                            </div>
                        </form>
                    <?php
                    }
                    ?>
                </div>
            </section>

            <aside class="space-y-6 lg:col-span-3">
                <div class="space-y-4" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="text-2xl font-bold text-gray-800 ltr:text-left rtl:text-right"><?php esc_html_e('Our Offices', 'beit'); ?></h2>
                    <?php if (!empty($offices)) : ?>
                        <div class="space-y-4">
                            <?php foreach ($offices as $office) :
                                $office_name    = $office['name'] ?? '';
                                $office_address = $office['address'] ?? '';
                                $map_link       = $office['map_link'] ?? '';
                            ?>
                                <div class="rounded-lg bg-white p-4 shadow-sm ltr:text-left rtl:text-right">
                                    <?php if ($office_name) : ?>
                                        <h3 class="text-lg font-semibold text-gray-800"><?php echo esc_html($office_name); ?></h3>
                                    <?php endif; ?>
                                    <?php if ($office_address) : ?>
                                        <p class="mt-2 text-sm text-gray-600"><?php echo esc_html($office_address); ?></p>
                                    <?php endif; ?>
                                    <?php if ($map_link) : ?>
                                        <a class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-red-600 hover:text-red-700"
                                            href="<?php echo esc_url($map_link); ?>" target="_blank" rel="noopener">
                                            <i class="fa fa-map-marker"></i>
                                            <?php esc_html_e('View on Map', 'beit'); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($google_maps_api_key && (!empty($map_offices) || !empty($map_warehouses))) : ?>
                    <div class="rounded-lg bg-white shadow-sm" data-aos="fade-up" data-aos-delay="200">
                        <!-- Map Tabs -->
                        <div class="flex border-b border-gray-200 relative z-10">
                            <div class="map-tab-wrapper flex-1 relative">
                                <button
                                    class="map-tab-button w-full px-6 py-4 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 border-b-2 border-transparent"
                                    data-tab="offices"
                                    data-active="false">
                                    <i class="fa fa-map-marker ltr:mr-2 rtl:ml-2"></i>
                                    <?php esc_html_e('Our Offices', 'beit'); ?>
                                </button>
                                <!-- Dropdown for Offices -->
                                <div class="map-tab-dropdown hidden absolute top-full ltr:left-0 rtl:right-0 w-full bg-white shadow-lg border border-gray-200 z-50 max-h-64">
                                    <?php if (!empty($map_offices)) : ?>
                                        <?php foreach ($map_offices as $index => $office) : ?>
                                            <button
                                                class="map-location-item w-full ltr:text-start rtl:text-right px-4 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition border-b border-gray-100 last:border-0"
                                                data-tab="offices"
                                                data-location-index="<?php echo esc_attr($index); ?>">
                                                <i class="fa fa-map-marker ltr:mr-2 rtl:ml-2 text-red-600"></i>
                                                <strong><?php echo esc_html($office['name'] ?? ''); ?></strong>
                                                <?php if (!empty($office['address'])) : ?>
                                                    <br><span class="text-xs text-gray-500 ltr:ml-5 rtl:mr-5"><?php echo esc_html($office['address']); ?></span>
                                                <?php endif; ?>
                                            </button>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="map-tab-wrapper flex-1 relative">
                                <button
                                    class="map-tab-button w-full px-6 py-4 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 border-b-2 border-transparent"
                                    data-tab="warehouses">
                                    <i class="fa fa-cubes ltr:mr-2 rtl:ml-2"></i>
                                    <?php esc_html_e('Warehouses', 'beit'); ?>
                                </button>
                                <!-- Dropdown for Warehouses -->
                                <div class="map-tab-dropdown hidden absolute top-full ltr:left-0 rtl:right-0 w-full bg-white shadow-lg border border-gray-200 z-50 max-h-64">
                                    <?php if (!empty($map_warehouses)) : ?>
                                        <?php foreach ($map_warehouses as $index => $warehouse) : ?>
                                            <button
                                                class="map-location-item w-full ltr:text-left rtl:text-right px-4 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition border-b border-gray-100 last:border-0"
                                                data-tab="warehouses"
                                                data-location-index="<?php echo esc_attr($index); ?>">
                                                <i class="fa fa-cubes ltr:mr-2 rtl:ml-2 text-gray-600"></i>
                                                <strong><?php echo esc_html($warehouse['name'] ?? ''); ?></strong>
                                                <?php if (!empty($warehouse['address'])) : ?>
                                                    <br><span class="text-xs text-gray-500 ltr:ml-5 rtl:mr-5"><?php echo esc_html($warehouse['address']); ?></span>
                                                <?php endif; ?>
                                            </button>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Map Container -->
                        <div id="contact-map" class="h-96 w-full overflow-hidden"></div>

                        <!-- Map Data (Hidden) -->
                        <script>
                            window.contactMapData = {
                                apiKey: <?php echo wp_json_encode($google_maps_api_key); ?>,
                                defaultCenter: {
                                    lat: <?php echo floatval($map_default_center['latitude'] ?? 31.9522); ?>,
                                    lng: <?php echo floatval($map_default_center['longitude'] ?? 35.2332); ?>
                                },
                                defaultZoom: <?php echo intval($map_default_center['zoom'] ?? 8); ?>,
                                offices: <?php echo wp_json_encode(array_map(function ($office) {
                                                return [
                                                    'name' => $office['name'] ?? '',
                                                    'address' => $office['address'] ?? '',
                                                    'lat' => floatval($office['latitude'] ?? 0),
                                                    'lng' => floatval($office['longitude'] ?? 0),
                                                ];
                                            }, $map_offices)); ?>,
                                warehouses: <?php echo wp_json_encode(array_map(function ($warehouse) {
                                                return [
                                                    'name' => $warehouse['name'] ?? '',
                                                    'address' => $warehouse['address'] ?? '',
                                                    'lat' => floatval($warehouse['latitude'] ?? 0),
                                                    'lng' => floatval($warehouse['longitude'] ?? 0),
                                                ];
                                            }, $map_warehouses)); ?>
                            };
                        </script>
                    </div>
                <?php endif; ?>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-start gap-3 border border-black/20 bg-white p-6 ltr:text-left rtl:text-right">
                        <span class="w-12 h-12 flex justify-center items-center text-white bg-primary"><i class="fa fa-globe text-xl"></i></span>
                        <div>
                            <h3 class="mb-1 font-bold"><?php esc_html_e('Social', 'beit'); ?></h3>
                            <div class="flex flex-wrap gap-3 text-gray-700">
                                <?php
                                if (!empty($social_links)) {
                                    foreach ($social_links as $social) {
                                        $icon = $social['icon'] ?? '';
                                        $url  = $social['url'] ?? '#';
                                        if (!$icon) {
                                            continue;
                                        }
                                ?>
                                        <a class="transition hover:text-red-600 flex justify-center items-center    " href="<?php echo esc_url($url); ?>" target="_blank"
                                            rel="noopener">
                                            <?php if($social['icon'] === 'fa fa-twitter'): ?>
                                                <?php echo file_get_contents(get_template_directory() . '/resources/assets/images/x.svg'); ?>
                                            <?php else: ?>
                                            <i class="<?php echo esc_attr($icon); ?>"></i>
                                            <?php endif; ?>
                                        </a>
                                <?php
                                    }
                                } else {
                                    $defaults = ['fa fa-facebook-f', 'fa fa-instagram', 'fa fa-x-twitter', 'fa fa-linkedin-in', 'fa fa-youtube'];
                                    foreach ($defaults as $icon) {
                                        echo '<span class="transition hover:text-red-600"><i class="' . esc_attr($icon) . '"></i></span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php if ($phone) : ?>
                        <div class="flex items-start gap-3 border border-black/20 bg-white p-6 ltr:text-left rtl:text-right">
                            <span class="w-12 h-12 flex justify-center items-center text-white bg-primary"><i class="fa fa-phone text-xl"></i></span>
                            <div>
                                <h3 class="mb-1 font-bold"><?php esc_html_e('Phone', 'beit'); ?></h3>
                                <a class="text-gray-700 font-light"
                                    href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', (string) $phone)); ?>"><?php echo esc_html($phone); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($email) : ?>
                        <div class="flex items-start gap-3 border border-black/20 bg-white p-6 ltr:text-left rtl:text-right">
                            <span class="w-12 h-12 flex justify-center items-center text-white bg-primary"><i class="fa fa-envelope text-xl"></i></span>
                            <div>
                                <h3 class="mb-1 font-bold"><?php esc_html_e('Email', 'beit'); ?></h3>
                                <a class="text-gray-700 font-light"
                                    href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($address) : ?>
                        <div class="flex items-start gap-3 border border-black/20 bg-white p-6 ltr:text-left rtl:text-right">
                            <span class="w-12 h-12 flex justify-center items-center text-white bg-primary"><i
                                    class="fa fa-map-marker text-xl"></i></span>
                            <div>
                                <h3 class="mb-1 font-bold"><?php esc_html_e('Address', 'beit'); ?></h3>
                                <p class="text-gray-700 font-light"><?php echo esc_html($address); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    
                </div>
            </aside>
        </div>


    </main>

    <?php if ($google_maps_api_key) : ?>
        <script>
            // Tab hover functionality - initialize immediately
            (function() {
                const initDropdowns = () => {
                    document.querySelectorAll('.map-tab-wrapper').forEach(wrapper => {
                        const button = wrapper.querySelector('.map-tab-button');
                        const dropdown = wrapper.querySelector('.map-tab-dropdown');
                        
                        if (!button || !dropdown) return;
                        
                        let hoverTimeout;
                        
                        wrapper.addEventListener('mouseenter', () => {
                            clearTimeout(hoverTimeout);
                            dropdown.classList.remove('hidden');
                        });
                        
                        wrapper.addEventListener('mouseleave', () => {
                            hoverTimeout = setTimeout(() => {
                                dropdown.classList.add('hidden');
                            }, 200);
                        });
                    });
                };
                
                // Run immediately if DOM is ready, otherwise wait
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initDropdowns);
                } else {
                    initDropdowns();
                }
            })();
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr($google_maps_api_key); ?>&callback=initContactMap" async defer></script>
    <?php endif; ?>
<?php
}

get_footer();