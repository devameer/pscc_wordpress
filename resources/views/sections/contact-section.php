<?php

/**
 * Contact section template for homepage.
 *
 * @package beit
 */

if (!defined('ABSPATH')) {
    exit;
}

$has_acf = function_exists('get_field');

// Get contact details from theme options
$contact_details = $has_acf ? (get_field('theme_contact_details', 'option') ?: []) : [];
$google_maps_api_key = $has_acf ? get_field('theme_google_maps_api_key', 'option') : '';
$map_location = $has_acf ? (get_field('theme_map_location', 'option') ?: []) : [];
$form_shortcode = $has_acf ? get_field('theme_contact_form_shortcode', 'option') : '';

$email = $contact_details['email'] ?? '';
$phone = $contact_details['phone'] ?? '';
$address = $contact_details['address'] ?? '';

// Get section settings from args (passed from front-page.php)
$section_title = $args['title'] ?? __('Get In Touch', 'beit');
$section_subtitle = $args['subtitle'] ?? __('We would love to hear from you', 'beit');
$background_image_id = $args['background_image'] ?? '';
$overlay_color = $args['overlay_color'] ?? '#1e293b';
$overlay_opacity = isset($args['overlay_opacity']) ? intval($args['overlay_opacity']) : 85;

// Get background image URL
$background_image_url = '';
if ($background_image_id) {
    $background_image_url = wp_get_attachment_image_url($background_image_id, 'full');
}

// Convert hex to rgba for overlay
$hex = ltrim($overlay_color, '#');
$r = hexdec(substr($hex, 0, 2));
$g = hexdec(substr($hex, 2, 2));
$b = hexdec(substr($hex, 4, 2));
$opacity = $overlay_opacity / 100;

?>

<section class="relative py-16 md:py-20 overflow-hidden" data-aos="fade-up">
    <?php if ($background_image_url): ?>
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="<?php echo esc_url($background_image_url); ?>" alt="" class="h-full w-full object-cover"
                loading="lazy">
        </div>
        <!-- Overlay -->
        <div class="absolute inset-0 z-10" style="background-color: rgba(<?php echo esc_attr("$r, $g, $b, $opacity"); ?>);">
        </div>
    <?php else: ?>
        <!-- Fallback Background -->
        <div class="absolute inset-0 z-0 bg-gray-50"></div>
    <?php endif; ?>

    <div class="container relative z-20 mx-auto px-4 md:px-6">
        <!-- Section Header -->
        <div class="mb-12 text-center">
            <h2
                class="text-3xl font-bold md:text-4xl <?php echo $background_image_url ? 'text-white' : 'text-gray-900'; ?>">
                <?php echo esc_html($section_title); ?>
            </h2>
            <p class="mt-4 text-lg <?php echo $background_image_url ? 'text-gray-200' : 'text-gray-600'; ?>">
                <?php echo esc_html($section_subtitle); ?>
            </p>
        </div>

        <div class="grid gap-8 lg:grid-cols-2">
            <!-- Contact Form -->
            <?php if ($form_shortcode): ?>
                <div class="rounded-lg border border-white/20 bg-white/10 backdrop-blur-sm p-6 sm:p-8 shadow-lg <?php echo $background_image_url ? '' : 'bg-white border-gray-200'; ?>"
                    data-aos="fade-right" data-aos-delay="100">
                    <h3
                        class="mb-6 text-xl font-bold <?php echo $background_image_url ? 'text-white' : 'text-gray-900'; ?>">
                        <?php echo esc_html(beit_translate('Send Us a Message', 'send_us_a_message')); ?>
                    </h3>
                    <div class="contact-form-wrapper <?php echo $background_image_url ? 'form-dark-theme' : ''; ?>">
                        <?php echo do_shortcode($form_shortcode); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Contact Information & Map -->
            <div class="space-y-6" data-aos="fade-left" data-aos-delay="200">
                <?php if ($phone || $email || $address): ?>
                    <div
                        class="rounded-lg border border-white/20 bg-white/10 backdrop-blur-sm p-6 shadow-lg <?php echo $background_image_url ? '' : 'bg-white border-gray-200'; ?>">
                        <h3
                            class="mb-4 text-xl font-bold <?php echo $background_image_url ? 'text-white' : 'text-gray-900'; ?>">
                            <?php echo esc_html(beit_translate('Contact Information', 'contact_information')); ?>
                        </h3>
                        <div class="space-y-4">
                            <?php if ($phone): ?>
                                <div class="flex items-start gap-4">
                                    <span
                                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary text-white">
                                        <i class="fa fa-phone text-xl"></i>
                                    </span>
                                    <div>
                                        <h4
                                            class="mb-1 font-bold <?php echo $background_image_url ? 'text-white' : 'text-gray-900'; ?>">
                                            <?php echo esc_html(beit_translate('Phone', 'phone')); ?>
                                        </h4>
                                        <a class="font-normal transition hover:text-primary <?php echo $background_image_url ? 'text-gray-200' : 'text-gray-700'; ?>"
                                            href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', (string) $phone)); ?>">
                                            <?php echo esc_html($phone); ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($email): ?>
                                <div class="flex items-start gap-4">
                                    <span
                                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary text-white">
                                        <i class="fa fa-envelope text-xl"></i>
                                    </span>
                                    <div>
                                        <h4
                                            class="mb-1 font-bold <?php echo $background_image_url ? 'text-white' : 'text-gray-900'; ?>">
                                            <?php echo esc_html(beit_translate('Email', 'email')); ?>
                                        </h4>
                                        <a class="font-normal transition hover:text-primary break-all <?php echo $background_image_url ? 'text-gray-200' : 'text-gray-700'; ?>"
                                            href="mailto:<?php echo esc_attr($email); ?>">
                                            <?php echo esc_html($email); ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($address): ?>
                                <div class="flex items-start gap-4">
                                    <span
                                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary text-white">
                                        <i class="fa fa-map-marker text-xl"></i>
                                    </span>
                                    <div>
                                        <h4
                                            class="mb-1 font-bold <?php echo $background_image_url ? 'text-white' : 'text-gray-900'; ?>">
                                            <?php echo esc_html(beit_translate('Address', 'address')); ?>
                                        </h4>
                                        <p
                                            class="font-normal <?php echo $background_image_url ? 'text-gray-200' : 'text-gray-700'; ?>">
                                            <?php echo esc_html($address); ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Map -->
                <?php if ($google_maps_api_key && !empty($map_location['latitude']) && !empty($map_location['longitude'])): ?>
                    <div class="overflow-hidden rounded-lg shadow-lg">
                        <div id="homepage-contact-map" style="height: 300px; width: 100%;"></div>
                    </div>

                    <?php if (!empty($map_location['name']) || !empty($map_location['address'])): ?>
                        <div
                            class="rounded-lg border border-white/20 bg-white/10 backdrop-blur-sm p-6 shadow-lg <?php echo $background_image_url ? '' : 'bg-white border-gray-200'; ?>">
                            <?php if (!empty($map_location['name'])): ?>
                                <h3
                                    class="mb-2 text-xl font-bold <?php echo $background_image_url ? 'text-white' : 'text-gray-900'; ?>">
                                    <?php echo esc_html($map_location['name']); ?>
                                </h3>
                            <?php endif; ?>
                            <?php if (!empty($map_location['address'])): ?>
                                <p class="<?php echo $background_image_url ? 'text-gray-200' : 'text-gray-600'; ?>">
                                    <?php echo esc_html($map_location['address']); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <script>
                        function initHomepageContactMap() {
                            const mapElement = document.getElementById('homepage-contact-map');
                            if (!mapElement) return;

                            const location = {
                                lat: <?php echo floatval($map_location['latitude']); ?>,
                                lng: <?php echo floatval($map_location['longitude']); ?>
                            };

                            const map = new google.maps.Map(mapElement, {
                                zoom: 15,
                                center: location,
                                mapTypeControl: false,
                                streetViewControl: false,
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

                                marker.addListener('click', function () {
                                    infoWindow.open(map, marker);
                                });
                            <?php endif; ?>
                        }

                        // Load Google Maps API if not already loaded
                        (function () {
                            if (typeof google !== 'undefined' && google.maps) {
                                initHomepageContactMap();
                            } else if (!document.querySelector('script[src*="maps.googleapis.com"]')) {
                                const script = document.createElement('script');
                                script.src = 'https://maps.googleapis.com/maps/api/js?key=<?php echo esc_js($google_maps_api_key); ?>&callback=initHomepageContactMap';
                                script.async = true;
                                script.defer = true;
                                document.head.appendChild(script);
                            }
                        })();
                    </script>
                <?php endif; ?>
            </div>
        </div>
</section>