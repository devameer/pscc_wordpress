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
    $hero_subtitle   = $hero_data['subtitle'] ?? __('TOGETHER, We Make Change Happen.', 'beit');
    $hero_background = $hero_data['background'] ?? '';

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
    $hours   = $contact_details['hours'] ?? '';

    get_template_part(
        'resources/views/components/page-hero',
        null,
        [
            'title'            => get_the_title(),
            'description'      => $hero_subtitle,
            'eyebrow'          => __('Contact Us', 'beit'),
            'background_image' => $hero_background,
            'background_classes' => 'bg-gradient-to-br from-red-800 via-slate-900 to-red-950',
            'overlay_gradients' => true,
        ]
    );
?>


    <main class="bg-gray-50 text-slate-900">
        <div class="container mx-auto grid gap-10 px-4 py-12 lg:grid-cols-2">
            <section class="rounded-lg bg-white p-8 shadow-sm">
                <h2 class="text-2xl font-bold text-gray-800">
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

            <aside class="space-y-6">
                <div class="space-y-4">
                    <h2 class="text-2xl font-bold text-gray-800"><?php esc_html_e('Our Offices', 'beit'); ?></h2>
                    <?php if (!empty($offices)) : ?>
                        <div class="space-y-4">
                            <?php foreach ($offices as $office) :
                                $office_name    = $office['name'] ?? '';
                                $office_address = $office['address'] ?? '';
                                $map_link       = $office['map_link'] ?? '';
                            ?>
                                <div class="rounded-lg bg-white p-4 shadow-sm">
                                    <?php if ($office_name) : ?>
                                        <h3 class="text-lg font-semibold text-gray-800"><?php echo esc_html($office_name); ?></h3>
                                    <?php endif; ?>
                                    <?php if ($office_address) : ?>
                                        <p class="mt-2 text-sm text-gray-600"><?php echo esc_html($office_address); ?></p>
                                    <?php endif; ?>
                                    <?php if ($map_link) : ?>
                                        <a class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-red-600 hover:text-red-700"
                                            href="<?php echo esc_url($map_link); ?>" target="_blank" rel="noopener">
                                            <i class="fa fa-map-marker-alt"></i>
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
                    <div class="rounded-lg bg-white shadow-sm overflow-hidden">
                        <!-- Map Tabs -->
                        <div class="flex border-b border-gray-200">
                            <button
                                class="map-tab-button flex-1 px-6 py-4 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 border-b-2 border-transparent"
                                data-tab="offices"
                                data-active="false">
                                <i class="fa fa-map-marker  mr-2"></i>
                                <?php esc_html_e('Our Offices', 'beit'); ?>
                            </button>
                            <button
                                class="map-tab-button flex-1 px-6 py-4 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 border-b-2 border-transparent"
                                data-tab="warehouses">
                                <i class="fa fa-cubes mr-2"></i>
                                <?php esc_html_e('Warehouses', 'beit'); ?>
                            </button>
                        </div>

                        <!-- Map Container -->
                        <div id="contact-map" class="h-96 w-full"></div>

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

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="flex items-start gap-3 rounded-lg border-l-4 border-red-600 bg-white p-6 shadow-sm">
                        <span class="rounded bg-red-600 p-3 text-white"><i class="fa fa-globe text-xl"></i></span>
                        <div>
                            <h3 class="mb-2 font-bold text-gray-800"><?php esc_html_e('Social', 'beit'); ?></h3>
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
                                        <a class="transition hover:text-red-600 flex justify-center items-center" href="<?php echo esc_url($url); ?>" target="_blank"
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
                        <div class="flex items-start gap-3 rounded-lg border-l-4 border-red-600 bg-white p-6 shadow-sm">
                            <span class="rounded bg-red-600 p-3 text-white"><i class="fa fa-phone text-xl"></i></span>
                            <div>
                                <h3 class="mb-2 font-bold text-gray-800"><?php esc_html_e('Phone', 'beit'); ?></h3>
                                <a class="text-gray-700"
                                    href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', (string) $phone)); ?>"><?php echo esc_html($phone); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($email) : ?>
                        <div class="flex items-start gap-3 rounded-lg border-l-4 border-red-600 bg-white p-6 shadow-sm">
                            <span class="rounded bg-red-600 p-3 text-white"><i class="fa fa-envelope text-xl"></i></span>
                            <div>
                                <h3 class="mb-2 font-bold text-gray-800"><?php esc_html_e('Email', 'beit'); ?></h3>
                                <a class="text-gray-700"
                                    href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($address) : ?>
                        <div class="flex items-start gap-3 rounded-lg border-l-4 border-red-600 bg-white p-6 shadow-sm">
                            <span class="rounded bg-red-600 p-3 text-white"><i
                                    class="fa fa-map-marker-alt text-xl"></i></span>
                            <div>
                                <h3 class="mb-2 font-bold text-gray-800"><?php esc_html_e('Address', 'beit'); ?></h3>
                                <p class="text-gray-700"><?php echo esc_html($address); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($hours) : ?>
                        <div class="flex items-start gap-3 rounded-lg border-l-4 border-red-600 bg-white p-6 shadow-sm">
                            <span class="rounded bg-red-600 p-3 text-white"><i class="fa fa-clock text-xl"></i></span>
                            <div>
                                <h3 class="mb-2 font-bold text-gray-800"><?php esc_html_e('Working Hours', 'beit'); ?></h3>
                                <p class="text-gray-700"><?php echo esc_html($hours); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </aside>
        </div>


    </main>

    <?php if ($google_maps_api_key) : ?>
        <script>
            // Google Maps initialization callback
            window.initContactMap = window.initContactMap || function() {
                const mapContainer = document.getElementById('contact-map');

                if (!mapContainer || !window.contactMapData || !window.google) {
                    return;
                }

                const data = window.contactMapData;
                let map;
                let officeMarkers = [];
                let warehouseMarkers = [];
                let currentTab = '';

                // Initialize the map
                map = new google.maps.Map(mapContainer, {
                    center: data.defaultCenter,
                    zoom: data.defaultZoom,
                    styles: [{
                        featureType: 'poi',
                        elementType: 'labels',
                        stylers: [{
                            visibility: 'off'
                        }]
                    }]
                });

                // Create custom marker icons
                const createMarkerIcon = (color) => {
                    return {
                        path: 'M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z',
                        fillColor: color,
                        fillOpacity: 1,
                        strokeColor: '#ffffff',
                        strokeWeight: 2,
                        scale: 1.5,
                        anchor: new google.maps.Point(12, 22)
                    };
                };

                // Function to create markers for a location type
                const createMarkers = (locations, type) => {
                    const markers = [];
                    const color = type === 'offices' ? '#CB0B29' : '#4E4E4E';
                    const bounds = new google.maps.LatLngBounds();

                    locations.forEach((location) => {
                        if (!location.lat || !location.lng) {
                            return;
                        }

                        const position = {
                            lat: location.lat,
                            lng: location.lng
                        };

                        // Create marker with map-marker icon
                        const marker = new google.maps.Marker({
                            position: position,
                            map: map,
                            title: location.name,
                            animation: google.maps.Animation.DROP,
                            icon: createMarkerIcon(color)
                        });

                        // Create info window
                        const infoContent = `
                            <div style="padding: 10px; max-width: 200px;">
                                <h3 style="margin: 0 0 8px 0; font-size: 16px; font-weight: bold; color: #1f2937;">
                                    ${location.name || ''}
                                </h3>
                                ${location.address ? `<p style="margin: 0; font-size: 14px; color: #6b7280;">${location.address}</p>` : ''}
                            </div>
                        `;

                        const infoWindow = new google.maps.InfoWindow({
                            content: infoContent
                        });

                        marker.addListener('click', () => {
                            // Close all other info windows
                            officeMarkers.concat(warehouseMarkers).forEach(m => {
                                if (m.infoWindow) {
                                    m.infoWindow.close();
                                }
                            });
                            infoWindow.open(map, marker);
                        });

                        marker.infoWindow = infoWindow;
                        marker.locationType = type;
                        markers.push(marker);
                        bounds.extend(position);
                    });

                    return {
                        markers,
                        bounds
                    };
                };

                // Create all markers
                const officeResult = createMarkers(data.offices || [], 'offices');
                const warehouseResult = createMarkers(data.warehouses || [], 'warehouses');

                officeMarkers = officeResult.markers;
                warehouseMarkers = warehouseResult.markers;

                // Combine bounds
                const combinedBounds = new google.maps.LatLngBounds();
                officeMarkers.concat(warehouseMarkers).forEach(marker => {
                    combinedBounds.extend(marker.getPosition());
                });

                // Fit map to show all markers
                if (officeMarkers.length > 0 || warehouseMarkers.length > 0) {
                    map.fitBounds(combinedBounds);
                }

                // Function to show/hide markers based on tab
                const updateMarkerVisibility = (tabName) => {
                    if (tabName === 'all') {
                        officeMarkers.forEach(m => m.setVisible(true));
                        warehouseMarkers.forEach(m => m.setVisible(true));
                    } else if (tabName === 'offices') {
                        officeMarkers.forEach(m => m.setVisible(true));
                        warehouseMarkers.forEach(m => m.setVisible(false));
                    } else if (tabName === 'warehouses') {
                        officeMarkers.forEach(m => m.setVisible(false));
                        warehouseMarkers.forEach(m => m.setVisible(true));
                    }
                };

                // Function to switch tabs
                const switchTab = (tabName) => {
                    if (currentTab === tabName) {
                        return;
                    }

                    currentTab = tabName;

                    // Update tab buttons
                    document.querySelectorAll('.map-tab-button').forEach(button => {
                        const isActive = button.dataset.tab === tabName;
                        button.dataset.active = isActive ? 'true' : 'false';

                        if (isActive) {
                            button.classList.add('border-red-600', 'text-red-600', 'bg-red-50');
                            button.classList.remove('border-transparent');
                        } else {
                            button.classList.remove('border-red-600', 'text-red-600', 'bg-red-50');
                            button.classList.add('border-transparent');
                        }
                    });

                    // Update marker visibility
                    updateMarkerVisibility(tabName);
                };

                // Add click listeners to tab buttons
                document.querySelectorAll('.map-tab-button').forEach(button => {
                    button.addEventListener('click', () => {
                        switchTab(button.dataset.tab);
                    });
                });

                // Initialize showing all markers
                switchTab('all');
            };
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr($google_maps_api_key); ?>&callback=initContactMap" async defer></script>
    <?php endif; ?>
<?php
}

get_footer();
