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
    $hero_subtitle = get_the_content();

    // Get contact details from theme options
    $contact_details = $has_acf ? (get_field('theme_contact_details', 'option') ?: []) : [];
    $google_maps_api_key = $has_acf ? get_field('theme_google_maps_api_key', 'option') : '';
    $map_location = $has_acf ? (get_field('theme_map_location', 'option') ?: []) : [];


    $form_shortcode = $has_acf ? get_field('theme_contact_form_shortcode', 'option') : '';

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
        <div class="container mx-auto px-4 py-12">
            <div class="grid gap-8 lg:grid-cols-2">

                <!-- Right Column - Contact Form (appears first on mobile, right on desktop) -->
                <section class="bg-white p-6 sm:p-8 rounded-lg shadow-sm order-2 lg:order-1" data-aos="fade-up">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 ltr:text-left rtl:text-right">
                        <?php echo esc_html(beit_get_text('share_thoughts')); ?>
                    </h2>

                    <div class="mt-6">
                        <?php if ($form_shortcode): ?>
                            <?php echo do_shortcode($form_shortcode); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            <?php
                        endif; ?>
                    </div>
                </section>

                <!-- Left Column - Map and Details (appears second on mobile, left on desktop) -->
                <div class="space-y-6 order-1 lg:order-2" data-aos="fade-up" data-aos-delay="100">

                    <!-- Map -->
                    <?php if ($google_maps_api_key && !empty($map_location['latitude']) && !empty($map_location['longitude'])): ?>
                        <div class="overflow-hidden rounded-lg shadow-sm">
                            <div id="contact-map" style="height: 350px; width: 100%;"></div>
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
                                    mapTypeControl: false,
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
                                    const infoContent = '<div style="padding: 10px; max-width: 250px;">' +
                                        <?php if (!empty($map_location['name'])): ?>
                                        '<h3 style="margin: 0 0 5px 0; font-size: 14px; font-weight: bold; color: #1f2937;"><?php echo esc_js($map_location['name']); ?></h3>' +
                                        <?php endif; ?>
                                    <?php if (!empty($map_location['address'])): ?>
                                        '<p style="margin: 0; font-size: 12px; color: #6b7280;"><?php echo esc_js($map_location['address']); ?></p>' +
                                        <?php endif; ?>
                                    '</div>';

                                    const infoWindow = new google.maps.InfoWindow({
                                        content: infoContent
                                    });

                                    marker.addListener('click', function () {
                                        infoWindow.open(map, marker);
                                    });

                                    setTimeout(function () {
                                        infoWindow.open(map, marker);
                                    }, 500);
                                <?php endif; ?>
                            }

                            (function () {
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

                    <!-- Contact Details -->
                    <div class="bg-white p-6 rounded-lg shadow-sm space-y-4">
                        <h3 class="text-lg font-bold text-gray-800 ltr:text-left rtl:text-right">
                            <?php echo esc_html(beit_get_text('contact_info')); ?>
                        </h3>

                        <?php if ($phone): ?>
                            <div class="flex items-center gap-4">
                                <span
                                    class="w-10 h-10 flex justify-center items-center text-white bg-primary rounded-full shrink-0">
                                    <i class="fa fa-phone"></i>
                                </span>
                                <div class="ltr:text-left rtl:text-right">
                                    <span class="text-sm text-gray-500">
                                        <?php echo esc_html(beit_get_text('phone')); ?>
                                    </span>
                                    <a class="block text-gray-800 font-medium hover:text-[var(--main-color)] transition"
                                        href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', (string) $phone)); ?>">
                                        <?php echo esc_html($phone); ?>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($email): ?>
                            <div class="flex items-center gap-4">
                                <span
                                    class="w-10 h-10 flex justify-center items-center text-white bg-primary rounded-full shrink-0">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <div class="ltr:text-left rtl:text-right">
                                    <span class="text-sm text-gray-500">
                                        <?php echo esc_html(beit_get_text('email')); ?>
                                    </span>
                                    <a class="block text-gray-800 font-medium hover:text-[var(--main-color)] transition break-all"
                                        href="mailto:<?php echo esc_attr($email); ?>">
                                        <?php echo esc_html($email); ?>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($address): ?>
                            <div class="flex items-center gap-4">
                                <span
                                    class="w-10 h-10 flex justify-center items-center text-white bg-primary rounded-full shrink-0">
                                    <i class="fa fa-map-marker"></i>
                                </span>
                                <div class="ltr:text-left rtl:text-right">
                                    <span class="text-sm text-gray-500">
                                        <?php echo esc_html(beit_get_text('address')); ?>
                                    </span>
                                    <p class="text-gray-800 font-medium">
                                        <?php echo esc_html($address); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <?php
}

get_footer();