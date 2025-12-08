<?php

/**
 * Maintenance Mode Settings and Functionality
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Maintenance Mode settings to WordPress Customizer
 */
function beit_maintenance_mode_customizer($wp_customize)
{
    // إضافة قسم جديد لوضع الصيانة
    $wp_customize->add_section('beit_maintenance_mode', [
        'title'    => __('وضع الصيانة', 'beit'),
        'priority' => 30,
    ]);

    // تفعيل/إيقاف وضع الصيانة
    $wp_customize->add_setting('maintenance_mode_enabled', [
        'default'           => false,
        'type'              => 'option',
        'sanitize_callback' => 'beit_sanitize_checkbox',
    ]);

    $wp_customize->add_control('maintenance_mode_enabled', [
        'label'   => __('تفعيل وضع الصيانة', 'beit'),
        'section' => 'beit_maintenance_mode',
        'type'    => 'checkbox',
        'description' => __('عند التفعيل، سيظهر الموقع في وضع الصيانة للزوار فقط. المستخدمين الذين قاموا بتسجيل الدخول سيرون الموقع بشكل طبيعي.', 'beit'),
    ]);

    // عنوان الصفحة
    $wp_customize->add_setting('maintenance_mode_title', [
        'default'           => 'Under Construction',
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

 
    

  

    // صورة الخلفية
    $wp_customize->add_setting('maintenance_mode_background_image', [
        'default'           => '',
        'type'              => 'option',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'maintenance_mode_background_image', [
        'label'       => __('صورة خلفية الصفحة', 'beit'),
        'section'     => 'beit_maintenance_mode',
        'description' => __('اختر صورة خلفية للصفحة (اختياري). إذا لم تختر صورة، سيتم استخدام اللون الافتراضي.', 'beit'),
    ]));

    // شفافية التغطية فوق الخلفية
    $wp_customize->add_setting('maintenance_mode_overlay_opacity', [
        'default'           => '0.7',
        'type'              => 'option',
        'sanitize_callback' => 'beit_sanitize_overlay_opacity',
    ]);

    $wp_customize->add_control('maintenance_mode_overlay_opacity', [
        'label'       => __('شفافية الطبقة فوق الخلفية', 'beit'),
        'section'     => 'beit_maintenance_mode',
        'type'        => 'select',
        'description' => __('التحكم في شفافية الطبقة اللونية فوق صورة الخلفية', 'beit'),
        'choices'     => [
            '0.3' => __('خفيفة (30%)', 'beit'),
            '0.5' => __('متوسطة (50%)', 'beit'),
            '0.7' => __('عادية (70%)', 'beit'),
            '0.85' => __('قوية (85%)', 'beit'),
            '0.95' => __('جداً قوية (95%)', 'beit'),
        ],
    ]);

  

  

    // البريد الإلكتروني
    $wp_customize->add_setting('maintenance_mode_email', [
        'default'           => get_option('admin_email'),
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_email',
    ]);

    $wp_customize->add_control('maintenance_mode_email', [
        'label'   => __('البريد الإلكتروني', 'beit'),
        'section' => 'beit_maintenance_mode',
        'type'    => 'email',
    ]);

    // رقم الهاتف
    $wp_customize->add_setting('maintenance_mode_phone', [
        'default'           => '',
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('maintenance_mode_phone', [
        'label'   => __('رقم الهاتف', 'beit'),
        'section' => 'beit_maintenance_mode',
        'type'    => 'text',
    ]);

    // العنوان
    $wp_customize->add_setting('maintenance_mode_address', [
        'default'           => '',
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('maintenance_mode_address', [
        'label'   => __('العنوان', 'beit'),
        'section' => 'beit_maintenance_mode',
        'type'    => 'text',
    ]);

    // Facebook
    $wp_customize->add_setting('maintenance_mode_facebook', [
        'default'           => '',
        'type'              => 'option',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('maintenance_mode_facebook', [
        'label'   => __('رابط Facebook', 'beit'),
        'section' => 'beit_maintenance_mode',
        'type'    => 'url',
    ]);

    // Twitter
    $wp_customize->add_setting('maintenance_mode_twitter', [
        'default'           => '',
        'type'              => 'option',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('maintenance_mode_twitter', [
        'label'   => __('رابط Twitter', 'beit'),
        'section' => 'beit_maintenance_mode',
        'type'    => 'url',
    ]);

    // Instagram
    $wp_customize->add_setting('maintenance_mode_instagram', [
        'default'           => '',
        'type'              => 'option',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('maintenance_mode_instagram', [
        'label'   => __('رابط Instagram', 'beit'),
        'section' => 'beit_maintenance_mode',
        'type'    => 'url',
    ]);
}
add_action('customize_register', 'beit_maintenance_mode_customizer');

/**
 * Sanitize checkbox
 */
function beit_sanitize_checkbox($checked)
{
    return ((isset($checked) && true == $checked) ? true : false);
}

/**
 * Sanitize overlay opacity
 */
function beit_sanitize_overlay_opacity($opacity)
{
    $allowed_values = ['0.3', '0.5', '0.7', '0.85', '0.95'];
    return in_array($opacity, $allowed_values, true) ? $opacity : '0.7';
}

/**
 * Check and display maintenance mode
 */
function beit_check_maintenance_mode()
{
    // التحقق من تفعيل وضع الصيانة
    $maintenance_enabled = get_option('maintenance_mode_enabled', false);

    // إذا لم يكن وضع الصيانة مفعلاً، اخرج من الدالة
    if (!$maintenance_enabled) {
        return;
    }

    // إذا كان المستخدم قد سجل دخوله، لا تعرض صفحة الصيانة
    if (is_user_logged_in()) {
        return;
    }

    // إذا كانت الصفحة هي صفحة تسجيل الدخول، لا تعرض صفحة الصيانة
    if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'wp-login.php') !== false) {
        return;
    }

    if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'wp-admin') !== false) {
        return;
    }

    // عرض صفحة الصيانة
    include_once get_template_directory() . '/template-under-construction.php';
    exit;
}
add_action('template_redirect', 'beit_check_maintenance_mode');

/**
 * Add admin notice when maintenance mode is active
 */
function beit_maintenance_mode_admin_notice()
{
    $maintenance_enabled = get_option('maintenance_mode_enabled', false);

    if ($maintenance_enabled && current_user_can('manage_options')) {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p>
                <strong><?php _e('تنبيه:', 'beit'); ?></strong>
                <?php _e('وضع الصيانة مفعل حالياً. الزوار غير المسجلين سيشاهدون صفحة Under Construction.', 'beit'); ?>
                <a href="<?php echo admin_url('customize.php?autofocus[section]=beit_maintenance_mode'); ?>">
                    <?php _e('إدارة الإعدادات', 'beit'); ?>
                </a>
            </p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'beit_maintenance_mode_admin_notice');
