<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> - Coming Soon</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Cairo:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <?php
    // Load site fonts
    $fonts_path = get_template_directory_uri() . '/public/css/fonts.css';
    ?>
    <link rel="stylesheet" href="<?php echo esc_url($fonts_path); ?>">

    <?php
    // Favicon from ACF
    if (function_exists('get_field')) {
        $favicon_url = get_field('site_favicon', 'option');
        if ($favicon_url) {
            echo '<link rel="icon" type="image/x-icon" href="' . esc_url($favicon_url) . '">';
        }
    }
    ?>

    <?php
    // Get background image from settings
    $bg_image = get_option('maintenance_mode_background_image');
    $overlay_opacity = get_option('maintenance_mode_overlay_opacity', '0.7');
    ?>
    <style>
        :root {
            --primary: #CB0B29;
            --primary-dark: #A00921;
            --primary-darker: #8B0819;
            --dark: #0a0a0a;
            --light: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            min-height: 100vh;
            background: var(--dark);
            position: relative;
            overflow-x: hidden;
            color: var(--light);
        }

        /* Custom Background Image */
        <?php if ($bg_image) : ?>
        .bg-custom-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            background-image: url('<?php echo esc_url($bg_image); ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .bg-custom-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, <?php echo esc_attr($overlay_opacity); ?>);
        }
        <?php endif; ?>

        /* Animated Background */
        .bg-animated {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .bg-gradient {
            position: absolute;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at 20% 80%, rgba(203, 11, 41, 0.15) 0%, transparent 50%),
                        radial-gradient(ellipse at 80% 20%, rgba(203, 11, 41, 0.1) 0%, transparent 50%),
                        radial-gradient(ellipse at 50% 50%, rgba(139, 8, 25, 0.08) 0%, transparent 70%);
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(203, 11, 41, 0.1), rgba(203, 11, 41, 0.02));
            animation: float 20s infinite ease-in-out;
        }

        .shape:nth-child(1) { width: 400px; height: 400px; top: -100px; left: -100px; animation-delay: 0s; }
        .shape:nth-child(2) { width: 300px; height: 300px; top: 50%; right: -80px; animation-delay: -5s; }
        .shape:nth-child(3) { width: 200px; height: 200px; bottom: 10%; left: 10%; animation-delay: -10s; }
        .shape:nth-child(4) { width: 150px; height: 150px; top: 20%; right: 20%; animation-delay: -15s; }
        .shape:nth-child(5) { width: 250px; height: 250px; bottom: -50px; right: 30%; animation-delay: -7s; }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(30px, -30px) rotate(5deg); }
            50% { transform: translate(0, -50px) rotate(0deg); }
            75% { transform: translate(-30px, -30px) rotate(-5deg); }
        }

        /* Particle Lines */
        .grid-lines {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(203, 11, 41, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(203, 11, 41, 0.03) 1px, transparent 1px);
            background-size: 80px 80px;
            animation: gridMove 30s linear infinite;
        }

        @keyframes gridMove {
            0% { transform: translate(0, 0); }
            100% { transform: translate(80px, 80px); }
        }

        /* Main Container */
        .main-wrapper {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .content-box {
            max-width: 700px;
            width: 100%;
            text-align: center;
            animation: slideUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(60px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Logo */
        .logo {
            margin-bottom: 50px;
            animation: fadeInDown 1s ease-out 0.2s both;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo img {
            max-width: 200px;
            max-height: 100px;
            height: auto;
            transition: all 0.4s ease;
        }

        .logo img:hover {
            transform: scale(1.05);
        }

        .logo h2 {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--light), rgba(255,255,255,0.7));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            background: rgba(203, 11, 41, 0.15);
            border: 1px solid rgba(203, 11, 41, 0.3);
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--primary);
            margin-bottom: 30px;
            animation: fadeIn 1s ease-out 0.4s both;
        }

        .status-badge::before {
            content: '';
            width: 8px;
            height: 8px;
            background: var(--primary);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.5); }
        }

        /* Title */
        h1 {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 25px;
            background: linear-gradient(135deg, var(--light) 0%, rgba(255,255,255,0.8) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: fadeIn 1s ease-out 0.5s both;
        }

        h1 span {
            background: linear-gradient(135deg, var(--primary) 0%, #ff4d6a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Description */
        .description {
            font-size: 1.15rem;
            color: rgba(255,255,255,0.6);
            line-height: 1.8;
            margin-bottom: 50px;
            animation: fadeIn 1s ease-out 0.6s both;
            max-width: 550px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Countdown Timer */
        .countdown-wrapper {
            margin-bottom: 50px;
            animation: fadeIn 1s ease-out 0.7s both;
        }

        .countdown {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .countdown-item {
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 25px 20px;
            min-width: 100px;
            transition: all 0.3s ease;
        }

        .countdown-item:hover {
            background: rgba(203, 11, 41, 0.1);
            border-color: rgba(203, 11, 41, 0.3);
            transform: translateY(-5px);
        }

        .countdown-number {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), #ff4d6a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: block;
            line-height: 1;
        }

        .countdown-label {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.5);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 10px;
        }

        /* Progress Bar */
        .progress-section {
            margin-bottom: 50px;
            animation: fadeIn 1s ease-out 0.8s both;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 0.9rem;
            color: rgba(255,255,255,0.6);
        }

        .progress-bar {
            height: 6px;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), #ff4d6a);
            border-radius: 10px;
            width: 0%;
            animation: progressGrow 2s ease-out 1s forwards;
        }

        @keyframes progressGrow {
            to { width: var(--progress, 75%); }
        }

        /* Subscribe Form */
        .subscribe-section {
            margin-bottom: 50px;
            animation: fadeIn 1s ease-out 0.9s both;
        }

        .subscribe-title {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.8);
            margin-bottom: 20px;
        }

        .subscribe-form {
            display: flex;
            gap: 12px;
            max-width: 450px;
            margin: 0 auto;
        }

        .subscribe-input {
            flex: 1;
            padding: 16px 24px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            color: var(--light);
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .subscribe-input::placeholder {
            color: rgba(255,255,255,0.4);
        }

        .subscribe-input:focus {
            border-color: var(--primary);
            background: rgba(203, 11, 41, 0.05);
        }

        .subscribe-btn {
            padding: 16px 32px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            border-radius: 12px;
            color: var(--light);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .subscribe-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(203, 11, 41, 0.4);
        }

        /* Contact Info Card */
        .contact-card {
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 40px;
            animation: fadeIn 1s ease-out 1s both;
        }

        .contact-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--light);
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
        }

        .contact-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), #ff4d6a);
            border-radius: 2px;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            background: rgba(255,255,255,0.02);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            background: rgba(203, 11, 41, 0.1);
            transform: translateX(5px);
        }

        .contact-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .contact-icon svg {
            width: 22px;
            height: 22px;
            fill: var(--light);
        }

        .contact-text {
            text-align: left;
        }

        .contact-label {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.5);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .contact-value {
            color: var(--light);
            font-weight: 500;
        }

        .contact-value a {
            color: var(--light);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-value a:hover {
            color: var(--primary);
        }

        /* Social Links */
        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            animation: fadeIn 1s ease-out 1.1s both;
        }

        .social-link {
            width: 55px;
            height: 55px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .social-link:hover {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-color: transparent;
            transform: translateY(-5px) rotate(5deg);
            box-shadow: 0 15px 35px rgba(203, 11, 41, 0.3);
        }

        .social-link svg {
            width: 24px;
            height: 24px;
            fill: rgba(255,255,255,0.7);
            transition: all 0.3s ease;
        }

        .social-link:hover svg {
            fill: var(--light);
        }

        /* Footer Text */
        .footer-text {
            margin-top: 50px;
            font-size: 0.85rem;
            color: rgba(255,255,255,0.3);
            animation: fadeIn 1s ease-out 1.2s both;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            h1 { font-size: 2.5rem; }
            .description { font-size: 1rem; }
            .countdown-item { min-width: 80px; padding: 20px 15px; }
            .countdown-number { font-size: 2.2rem; }
            .subscribe-form { flex-direction: column; }
            .subscribe-btn { width: 100%; }
            .contact-card { padding: 30px 20px; }
            .contact-grid { grid-template-columns: 1fr; }
            .shape { display: none; }
        }

        @media (max-width: 480px) {
            h1 { font-size: 2rem; }
            .countdown-item { min-width: 70px; padding: 15px 10px; }
            .countdown-number { font-size: 1.8rem; }
            .countdown-label { font-size: 0.65rem; letter-spacing: 1px; }
            .social-link { width: 48px; height: 48px; }
        }
    </style>
</head>

<body>
    <?php if ($bg_image) : ?>
    <!-- Custom Background Image -->
    <div class="bg-custom-image">
        <div class="bg-custom-overlay"></div>
    </div>
    <?php else : ?>
    <!-- Animated Background -->
    <div class="bg-animated">
        <div class="bg-gradient"></div>
        <div class="grid-lines"></div>
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
    </div>
    <?php endif; ?>

    <div class="main-wrapper">
        <div class="content-box">
            <?php
            // Site Logo from ACF
            $logo_url = null;
            if (function_exists('get_field')) {
                $site_logo_id = get_field('site_logo', 'option');
                if ($site_logo_id) {
                    $logo_url = wp_get_attachment_image_url($site_logo_id, 'full');
                }
            }

            // Fallback to custom_logo
            if (!$logo_url) {
                $custom_logo_id = get_theme_mod('custom_logo');
                if ($custom_logo_id) {
                    $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
                }
            }

            if ($logo_url) {
            ?>
                <div class="logo">
                    <img src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?>">
                </div>
            <?php } else { ?>
                <div class="logo">
                    <h2><?php bloginfo('name'); ?></h2>
                </div>
            <?php } ?>

            <!-- Status Badge -->
            <div class="status-badge">Coming Soon</div>

            <!-- Main Title -->
            <h1><?php echo esc_html(get_option('maintenance_mode_title', 'Something Awesome is')); ?> <span>Coming</span></h1>

            <!-- Description -->
            <p class="description"><?php echo esc_html(get_option('maintenance_mode_message', 'We are working hard to bring you an amazing experience. Stay tuned for something extraordinary!')); ?></p>

            <!-- Countdown Timer -->
            <div class="countdown-wrapper">
                <div class="countdown" id="countdown">
                    <div class="countdown-item">
                        <span class="countdown-number" id="days">00</span>
                        <span class="countdown-label">Days</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-number" id="hours">00</span>
                        <span class="countdown-label">Hours</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-number" id="minutes">00</span>
                        <span class="countdown-label">Minutes</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-number" id="seconds">00</span>
                        <span class="countdown-label">Seconds</span>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="progress-section">
                <div class="progress-label">
                    <span>Development Progress</span>
                    <span id="progress-percent">75%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="--progress: 75%;"></div>
                </div>
            </div>

          

            <!-- Contact Info Card -->
            <?php
            $email = get_option('maintenance_mode_email', get_option('admin_email'));
            $phone = get_option('maintenance_mode_phone');
            $address = get_option('maintenance_mode_address');

            if ($email || $phone || $address) :
            ?>
            <div class="contact-card">
                <h3 class="contact-title"><?php echo esc_html(get_option('maintenance_mode_contact_title', 'Contact Us')); ?></h3>
                
                <div class="contact-grid">
                    <?php if ($email) : ?>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <div class="contact-label">Email</div>
                            <div class="contact-value"><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($phone) : ?>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <div class="contact-label">Phone</div>
                            <div class="contact-value"><a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a></div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($address) : ?>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <div class="contact-label">Address</div>
                            <div class="contact-value"><?php echo esc_html($address); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Social Links -->
            <?php
            $facebook = get_option('maintenance_mode_facebook');
            $twitter = get_option('maintenance_mode_twitter');
            $instagram = get_option('maintenance_mode_instagram');

            if ($facebook || $twitter || $instagram) :
            ?>
            <div class="social-links">
                <?php if ($facebook) : ?>
                <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener" class="social-link">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </a>
                <?php endif; ?>

                <?php if ($twitter) : ?>
                <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener" class="social-link">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                    </svg>
                </a>
                <?php endif; ?>

                <?php if ($instagram) : ?>
                <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener" class="social-link">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                    </svg>
                </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Footer -->
            <p class="footer-text">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
        </div>
    </div>

    <!-- Countdown Timer Script -->
    <script>
        // Set launch date (30 days from now by default)
        const launchDate = new Date();
        launchDate.setDate(launchDate.getDate() + 30);

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = launchDate.getTime() - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('days').textContent = String(days).padStart(2, '0');
            document.getElementById('hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');

            if (distance < 0) {
                document.getElementById('days').textContent = '00';
                document.getElementById('hours').textContent = '00';
                document.getElementById('minutes').textContent = '00';
                document.getElementById('seconds').textContent = '00';
            }
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);

        // Subscribe form handler
        document.getElementById('subscribe-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = this.querySelector('.subscribe-btn');
            const originalText = btn.textContent;
            btn.textContent = 'Thank you!';
            btn.style.background = 'linear-gradient(135deg, #10b981, #059669)';
            setTimeout(() => {
                btn.textContent = originalText;
                btn.style.background = '';
                this.reset();
            }, 3000);
        });
    </script>
</body>

</html>