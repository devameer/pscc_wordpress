<?php

/**
 * Contact page template with custom design.
 *
 * @package beit
 *
 * Template Name: Contact Page
 * Template Post Type: page
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) {
    the_post();

    $has_acf = function_exists('get_field');

    $hero_data = $has_acf ? (get_field('contact_hero') ?: []) : [];
    $hero_subtitle_acf = $hero_data['subtitle'] ?? '';
    $hero_subtitle = get_the_content(); // Use page content first, then ACF field

    // Get contact details from theme options instead of page fields
    $contact_details = $has_acf ? (get_field('theme_contact_details', 'option') ?: []) : [];
    $google_maps_api_key = $has_acf ? get_field('theme_google_maps_api_key', 'option') : '';
    $map_location = $has_acf ? (get_field('theme_map_location', 'option') ?: []) : [];
    $social_links = [];
    if ($has_acf) {
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
                ];
            }
        }
    }
    $offices = $has_acf ? (get_field('contact_offices') ?: []) : [];
    $form_shortcode = $has_acf ? get_field('contact_form_shortcode') : '';

    $email = $contact_details['email'] ?? '';
    $phone = $contact_details['phone'] ?? '';
    $address = $contact_details['address'] ?? '';
    $hero_custom_title = $hero_data['custom_title'] ?? '';
    $hero_title = $hero_custom_title ?: get_the_title();
    get_template_part(
        'resources/views/components/page-hero',
        null,
        [
            'title' => $hero_title,
            'description' => $hero_subtitle,
            'background_classes' => 'bg-gradient-to-br from-red-800 via-slate-900 to-red-950',
            'overlay_gradients' => true,
        ]
    );
    ?>


        <main class="bg-gray-50 text-slate-900">
            <div class="container mx-auto grid gap-10 px-4 py-12 lg:grid-cols-5">
                <section class=" bg-white p-8 shadow-sm lg:col-span-2" data-aos="fade-up">
                    <h2 class="text-2xl font-bold text-gray-800 ltr:text-left rtl:text-right">
                        <?php echo esc_html(beit_translate('Share Your Thoughts Here', 'share_your_thoughts')); ?>
                    </h2>

                    <div class="mt-6">
                        <?php
                        if ($form_shortcode) {
                            echo do_shortcode($form_shortcode); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        } else {
                            ?>
                                <form class="space-y-4">
                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <input type="text" placeholder="<?php esc_attr_e('Your name', 'beit'); ?>" class="form-field"
                                            required>
                                        <input type="email" placeholder="<?php esc_attr_e('Your email', 'beit'); ?>" class="form-field"
                                            required>
                                    </div>

                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <input type="text" placeholder="<?php esc_attr_e('Subject', 'beit'); ?>" class="form-field">
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
                                        <button type="submit" class="button-form rounded-full">
                                            <?php esc_html_e('Send', 'beit'); ?>
                                        </button>
                                        <span class="text-gray-500"><?php esc_html_e('or', 'beit'); ?></span>
                                        <button type="reset" class="font-bold text-red-600 underline hover:text-red-700 rounded-full">
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
                        <h2 class="text-2xl font-bold text-gray-800 ltr:text-left rtl:text-right">
                            <?php echo esc_html(beit_translate('Our Offices', 'our_offices')); ?>
                        </h2>
                        <?php if (!empty($offices)): ?>
                                <div class="space-y-4">
                                    <?php foreach ($offices as $office):
                                        $office_name = $office['name'] ?? '';
                                        $office_address = $office['address'] ?? '';
                                        $map_link = $office['map_link'] ?? '';
                                        ?>
                                            <div class=" bg-white p-4 shadow-sm ltr:text-left rtl:text-right">
                                                <?php if ($office_name): ?>
                                                        <h3 class="text-lg font-bold text-gray-800"><?php echo esc_html($office_name); ?></h3>
                                                <?php endif; ?>
                                                <?php if ($office_address): ?>
                                                        <p class="mt-2 text-sm text-gray-600"><?php echo esc_html($office_address); ?></p>
                                                <?php endif; ?>
                                                <?php if ($map_link): ?>
                                                        <a class="mt-3 inline-flex items-center gap-2 text-sm font-bold text-red-600 hover:text-red-700"
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

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2" data-aos="fade-up" data-aos-delay="200">
                        <?php if ($phone || $email): ?>
                            <div class="flex items-start gap-3 border border-black/20 bg-white p-6 ltr:text-left rtl:text-right">
                                <div class="space-y-4 w-full">
                                    <?php if ($phone): ?>
                                        <div class="flex items-start gap-3">
                                            <span class="w-12 h-12 flex justify-center items-center text-white bg-primary shrink-0"><i
                                                    class="fa fa-phone text-xl"></i></span>
                                            <div>
                                                <h3 class="mb-1 font-bold"><?php esc_html_e('Phone', 'beit'); ?></h3>
                                                <a class="text-gray-700 font-normal"
                                                    href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', (string) $phone)); ?>"><?php echo esc_html($phone); ?></a>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($email): ?>
                                        <div class="flex items-start gap-3">
                                            <span class="w-12 h-12 flex justify-center items-center text-white bg-primary shrink-0"><i
                                                    class="fa fa-envelope text-xl"></i></span>
                                            <div>
                                                <h3 class="mb-1 font-bold"><?php esc_html_e('Email', 'beit'); ?></h3>
                                                <a class="text-gray-700 font-normal"
                                                    href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($address): ?>
                            <div class="flex items-start gap-3 border border-black/20 bg-white p-6 ltr:text-left rtl:text-right">
                                <span class="w-12 h-12 flex justify-center items-center text-white bg-primary shrink-0"><i
                                        class="fa fa-map-marker text-xl"></i></span>
                                <div>
                                    <h3 class="mb-1 font-bold"><?php esc_html_e('Address', 'beit'); ?></h3>
                                    <p class="text-gray-700 font-normal"><?php echo esc_html($address); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </aside>
            </div>

            <?php if ($google_maps_api_key && !empty($map_location['latitude']) && !empty($map_location['longitude'])): ?>
                <div class="container mx-auto px-4 pb-12">
                    <div class="overflow-hidden rounded-lg shadow-lg" data-aos="fade-up">
                        <div id="contact-map" style="height: 500px; width: 100%;"></div>
                    </div>

                    <?php if (!empty($map_location['name']) || !empty($map_location['address'])): ?>
                        <div class="mt-6 bg-white p-6 rounded-lg shadow-sm" data-aos="fade-up" data-aos-delay="100">
                            <?php if (!empty($map_location['name'])): ?>
                                <h3 class="text-xl font-bold text-gray-800 mb-2"><?php echo esc_html($map_location['name']); ?></h3>
                            <?php endif; ?>
                            <?php if (!empty($map_location['address'])): ?>
                                <p class="text-gray-600"><?php echo esc_html($map_location['address']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <script>
                    function initContactMap() {
                        const mapElement = document.getElementById('contact-map');
                        if (!mapElement) return;

                        const location = {
                            lat: <?php echo floatval($map_location['latitude']); ?>,
                            lng: <?php echo floatval($map_location['longitude']); ?>
                        };

                        const map = new google.maps.Map(mapElement, {
                            zoom: 15,
                            center: location,
                            mapTypeControl: true,
                            streetViewControl: true,
                            fullscreenControl: true,
                        });

                        const marker = new google.maps.Marker({
                            position: location,
                            map: map,
                            title: <?php echo json_encode($map_location['name'] ?? ''); ?>,
                            animation: google.maps.Animation.DROP
                        });

                        <?php if (!empty($map_location['name']) || !empty($map_location['address'])): ?>
                        const infoContent = '<div style="padding: 10px; max-width: 300px;">' +
                            <?php if (!empty($map_location['name'])): ?>
                            '<h3 style="margin: 0 0 8px 0; font-size: 16px; font-weight: bold; color: #1f2937;"><?php echo esc_js($map_location['name']); ?></h3>' +
                            <?php endif; ?>
                            <?php if (!empty($map_location['address'])): ?>
                            '<p style="margin: 0; font-size: 14px; color: #6b7280;"><?php echo esc_js($map_location['address']); ?></p>' +
                            <?php endif; ?>
                            '</div>';

                        const infoWindow = new google.maps.InfoWindow({
                            content: infoContent
                        });

                        marker.addListener('click', function() {
                            infoWindow.open(map, marker);
                        });

                        // Auto-open info window
                        setTimeout(function() {
                            infoWindow.open(map, marker);
                        }, 500);
                        <?php endif; ?>
                    }

                    // Load Google Maps API
                    (function() {
                        if (typeof google !== 'undefined' && google.maps) {
                            initContactMap();
                        } else {
                            const script = document.createElement('script');
                            script.src = 'https://maps.googleapis.com/maps/api/js?key=<?php echo esc_js($google_maps_api_key); ?>&callback=initContactMap';
                            script.async = true;
                            script.defer = true;
                            document.head.appendChild(script);
                        }
                    })();
                </script>
            <?php endif; ?>

        </main>

<?php
}

get_footer();