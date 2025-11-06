<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beit Lahia - لأن كل طفل مهم</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap');

        body {
            font-family: 'Cairo', sans-serif;
        }

        .hero-overlay {
            background: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.3));
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: white;
        }

        .initiative-card {
            transition: transform 0.3s ease;
        }

        .initiative-card:hover {
            transform: translateY(-10px);
        }
    </style>
</head>

<body class="bg-white">
    <!-- Top Bar -->
    <div class="bg-gray-800 text-white text-sm">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="#" class="flex items-center gap-2 hover:text-red-500">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="#" class="flex items-center gap-2 hover:text-red-500">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="flex items-center gap-2 hover:text-red-500">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="flex items-center gap-2 hover:text-red-500">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="#" class="flex items-center gap-2 hover:text-red-500">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-red-500">
                    <i class="fas fa-envelope ml-2"></i>
                    info@beitlahia.com
                </a>
                <a href="#" class="hover:text-red-500">
                    <i class="fas fa-phone ml-2"></i>
                    +970(0)59 XXX XXXX
                </a>
                <a href="#" class="hover:text-red-500">
                    <i class="fas fa-map-marker-alt ml-2"></i>
                    Gaza
                </a>
                <a href="#" class="hover:text-red-500">
                    <i class="fas fa-question-circle ml-2"></i>
                    FAQs
                </a>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-gray-900 shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='45' fill='%23dc2626'/%3E%3Ctext x='50' y='60' font-size='40' fill='white' text-anchor='middle' font-family='Arial'%3EBL%3C/text%3E%3C/svg%3E"
                        alt="Beit Lahia Logo" class="h-16 w-16">
                    <div class="mr-3 text-white">
                        <h1 class="text-xl font-bold">BEIT LAHIA</h1>
                        <p class="text-xs">لأن كل طفل مهم</p>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center gap-1">
                    <a href="#" class="bg-red-600 text-white px-6 py-3 rounded hover:bg-red-700 transition">Home</a>
                    <a href="#" class="text-white px-4 py-3 hover:bg-gray-800 transition rounded">Programs& Projects</a>
                    <a href="#" class="text-white px-4 py-3 hover:bg-gray-800 transition rounded">Latest News</a>
                    <a href="#" class="text-white px-4 py-3 hover:bg-gray-800 transition rounded">Media Center</a>
                    <a href="#" class="text-white px-4 py-3 hover:bg-gray-800 transition rounded">Applications</a>
                    <a href="#" class="text-white px-4 py-3 hover:bg-gray-800 transition rounded">Contact Us</a>
                </nav>

                <!-- Right Side -->
                <div class="flex items-center gap-4">
                    <button class="text-white hover:text-red-500">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <button class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition">
                        DONATE
                    </button>
                    <button class="text-white md:hidden">
                        <i class="fas fa-bars text-2xl"></i> More
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative h-screen">
        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1920 1080'%3E%3Cdefs%3E%3ClinearGradient id='grad' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' style='stop-color:%23654321;stop-opacity:1' /%3E%3Cstop offset='100%25' style='stop-color:%23987654;stop-opacity:1' /%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='1920' height='1080' fill='url(%23grad)'/%3E%3C/svg%3E"
            alt="Hero Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 hero-overlay"></div>
        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-4">
                <div class="max-w-2xl text-white">
                    <h2 class="text-5xl font-bold mb-4">Because Every<br><span class="text-6xl">CHILD</span> Matters
                    </h2>
                    <p class="text-lg mb-8 leading-relaxed">Child Protection and Education Programs in Gaza providing
                        essential humanitarian support, education, and protection measures for vulnerable children in
                        conflict-affected areas.</p>
                    <div class="flex gap-4">
                        <button
                            class="bg-red-600 text-white px-8 py-3 rounded hover:bg-red-700 transition font-semibold">
                            DONATE
                        </button>
                        <button
                            class="border-2 border-white text-white px-8 py-3 rounded hover:bg-white hover:text-gray-900 transition font-semibold flex items-center gap-2">
                            <i class="fas fa-play"></i> Learn More
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Video Button -->
        <div class="absolute bottom-20 left-20">
            <button
                class="bg-white bg-opacity-20 backdrop-blur-sm px-6 py-3 rounded flex items-center gap-3 hover:bg-opacity-30 transition">
                <i class="fas fa-play text-white text-2xl"></i>
                <div class="text-white text-right">
                    <div class="font-semibold">See the Change,</div>
                    <div class="text-sm">WATCH the Story</div>
                </div>
            </button>
        </div>

        <!-- Slider Dots -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 flex gap-2">
            <div class="w-16 h-1 bg-white"></div>
            <div class="w-16 h-1 bg-white bg-opacity-50"></div>
            <div class="w-16 h-1 bg-white bg-opacity-50"></div>
        </div>
    </section>

    <!-- Initiatives Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-white mb-2">Our <span class="font-light">Initiatives</span></h2>
                <p class="text-gray-400">Building healthier futures,<br>one program at a time.</p>
            </div>

            <!-- Initiatives Slider -->
            <div class="swiper initiativesSwiper mb-8">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="initiative-card relative rounded-lg overflow-hidden group cursor-pointer">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Crect fill='%23654321' width='400' height='300'/%3E%3C/svg%3E"
                                alt="Child Education" class="w-full h-64 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <i class="fas fa-book text-3xl mb-2"></i>
                                <h3 class="text-xl font-bold">Child Education</h3>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="initiative-card relative rounded-lg overflow-hidden group cursor-pointer">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Crect fill='%23456789' width='400' height='300'/%3E%3C/svg%3E"
                                alt="Health Services" class="w-full h-64 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <i class="fas fa-heartbeat text-3xl mb-2"></i>
                                <h3 class="text-xl font-bold">Health Services</h3>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="initiative-card relative rounded-lg overflow-hidden group cursor-pointer">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Crect fill='%2387CEEB' width='400' height='300'/%3E%3C/svg%3E"
                                alt="Water Distribution" class="w-full h-64 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <i class="fas fa-tint text-3xl mb-2"></i>
                                <h3 class="text-xl font-bold">Clean Water<br>Distribution</h3>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="initiative-card relative rounded-lg overflow-hidden group cursor-pointer">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Crect fill='%2390EE90' width='400' height='300'/%3E%3C/svg%3E"
                                alt="Food Security" class="w-full h-64 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <i class="fas fa-seedling text-3xl mb-2"></i>
                                <h3 class="text-xl font-bold">Food Security &<br>Agriculture</h3>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="initiative-card relative rounded-lg overflow-hidden group cursor-pointer">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Crect fill='%23FF6347' width='400' height='300'/%3E%3C/svg%3E"
                                alt="Emergency Response" class="w-full h-64 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <i class="fas fa-ambulance text-3xl mb-2"></i>
                                <h3 class="text-xl font-bold">Emergency<br>Response</h3>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="initiative-card relative rounded-lg overflow-hidden group cursor-pointer">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Crect fill='%23DDA0DD' width='400' height='300'/%3E%3C/svg%3E"
                                alt="Psychological Support" class="w-full h-64 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <i class="fas fa-hands-helping text-3xl mb-2"></i>
                                <h3 class="text-xl font-bold">Psychological<br>Support</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

            <div class="text-center">
                <button class="bg-red-600 text-white px-8 py-3 rounded hover:bg-red-700 transition font-semibold">
                    Read More
                </button>
            </div>
        </div>
    </section>

    <!-- Latest News Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-2">Latest <span class="font-light">News</span></h2>
                <p class="text-gray-600">Sharing progress, announcements and<br>Updates that Keep You Connected.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 250'%3E%3Crect fill='%23B0C4DE' width='400' height='250'/%3E%3C/svg%3E"
                        alt="Water Distribution" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">5,298 cups of water were distributed in the Gaza Strip.</h3>
                    </div>
                </div>
                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 250'%3E%3Crect fill='%23D3D3D3' width='400' height='250'/%3E%3C/svg%3E"
                        alt="Water Distribution North" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">110,000 liters of water distributed in northern Gaza.</h3>
                    </div>
                </div>
                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 250'%3E%3Crect fill='%23FFB6C1' width='400' height='250'/%3E%3C/svg%3E"
                        alt="Recreational Activities" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">Implementing recreational activities in shelters across the
                            Gaza Strip.</h3>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button class="bg-red-600 text-white px-8 py-3 rounded hover:bg-red-700 transition font-semibold">
                    Read More
                </button>
            </div>
        </div>
    </section>

    <!-- Voices & Visions Section -->
    <section class="py-20 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-2">Voices& <span class="font-light">Visions</span></h2>
                <p class="text-gray-600">Real people. Real stories. Real impact.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="col-span-2 row-span-2">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 800 600'%3E%3Crect fill='%23F0E68C' width='800' height='600'/%3E%3C/svg%3E"
                        alt="Interview" class="w-full h-full object-cover rounded-lg">
                </div>
                <div>
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Crect fill='%2387CEEB' width='400' height='300'/%3E%3C/svg%3E"
                        alt="Community" class="w-full h-full object-cover rounded-lg">
                </div>
                <div>
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Crect fill='%23DDA0DD' width='400' height='300'/%3E%3C/svg%3E"
                        alt="Support" class="w-full h-full object-cover rounded-lg">
                </div>
                <div>
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Crect fill='%23F5DEB3' width='400' height='300'/%3E%3C/svg%3E"
                        alt="Workshop" class="w-full h-full object-cover rounded-lg">
                </div>
                <div>
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Crect fill='%2398FB98' width='400' height='300'/%3E%3C/svg%3E"
                        alt="Meeting" class="w-full h-full object-cover rounded-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="py-20 bg-gray-800 text-white">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 600 400'%3E%3Crect fill='%23A0522D' width='600' height='400'/%3E%3C/svg%3E"
                        alt="Our Work" class="w-full rounded-lg">
                    <div class="mt-6">
                        <h3 class="text-3xl font-bold mb-4">Serving humanity<br>with DIGNITY,<br>COMPASSION<br>and HOPE
                        </h3>
                    </div>
                </div>
                <div>
                    <h2 class="text-4xl font-bold mb-6">Discover<br><span class="text-5xl">Our STORY!</span></h2>
                    <p class="text-gray-300 mb-6 leading-relaxed">The Beit Lahia for Development Association is an
                        independent charitable organization in Gaza that has adopted humanitarian development principles
                        and worked according to the standards and principles of international humanitarian work in the
                        education, health, and human development.</p>
                    <button class="bg-red-600 text-white px-8 py-3 rounded hover:bg-red-700 transition font-semibold">
                        Read More
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Facts & Figures Section -->
    <section class="py-20 bg-gray-700 text-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-2">Facts& <span class="font-light">Figures</span></h2>
                <p class="text-gray-300">Turning Data into Real Community Impact,<br>Because Transparency Builds Trust
                </p>
            </div>

            <div class="flex justify-center gap-4 mb-12">
                <button class="bg-red-600 px-6 py-2 rounded hover:bg-red-700 transition">2025</button>
                <button class="bg-gray-600 px-6 py-2 rounded hover:bg-gray-500 transition">2024</button>
                <button class="bg-gray-600 px-6 py-2 rounded hover:bg-gray-500 transition">2023</button>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <div class="bg-gray-600 p-8 rounded-lg text-center">
                    <div class="text-5xl font-bold mb-2">240</div>
                    <div class="text-gray-300 uppercase text-sm">PROJECTS<br>REACHED</div>
                </div>
                <div class="bg-gray-600 p-8 rounded-lg text-center">
                    <div class="text-5xl font-bold mb-2">25,000</div>
                    <div class="text-gray-300 uppercase text-sm">BENEFICIARIES<br>BY SECTOR</div>
                </div>
                <div class="bg-gray-600 p-8 rounded-lg text-center">
                    <div class="text-5xl font-bold mb-2">376</div>
                    <div class="text-gray-300 uppercase text-sm">VOLUNTEERS<br>ENGAGED</div>
                </div>
                <div class="bg-gray-600 p-8 rounded-lg text-center">
                    <div class="text-5xl font-bold mb-2">52</div>
                    <div class="text-gray-300 uppercase text-sm">WORKING<br>HOURS</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-2">Trusted <span class="font-light">Partners</span></h2>
                <p class="text-gray-600">Collaboration that Drives Change,<br>Building Hope Through Partnerships.</p>
            </div>

            <!-- Partners Slider -->
            <div class="swiper partnersSwiper">
                <div class="swiper-wrapper items-center">
                    <div class="swiper-slide">
                        <div class="flex justify-center items-center h-24">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 100'%3E%3Crect fill='%23E5E7EB' width='200' height='100' rx='10'/%3E%3Ctext x='100' y='55' font-size='20' fill='%236B7280' text-anchor='middle' font-family='Arial'%3EPartner 1%3C/text%3E%3C/svg%3E"
                                alt="Partner 1" class="h-16 grayscale hover:grayscale-0 transition">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="flex justify-center items-center h-24">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 100'%3E%3Crect fill='%23E5E7EB' width='200' height='100' rx='10'/%3E%3Ctext x='100' y='55' font-size='20' fill='%236B7280' text-anchor='middle' font-family='Arial'%3EPartner 2%3C/text%3E%3C/svg%3E"
                                alt="Partner 2" class="h-16 grayscale hover:grayscale-0 transition">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="flex justify-center items-center h-24">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 100'%3E%3Crect fill='%23E5E7EB' width='200' height='100' rx='10'/%3E%3Ctext x='100' y='55' font-size='20' fill='%236B7280' text-anchor='middle' font-family='Arial'%3EPartner 3%3C/text%3E%3C/svg%3E"
                                alt="Partner 3" class="h-16 grayscale hover:grayscale-0 transition">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="flex justify-center items-center h-24">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 100'%3E%3Crect fill='%23E5E7EB' width='200' height='100' rx='10'/%3E%3Ctext x='100' y='55' font-size='20' fill='%236B7280' text-anchor='middle' font-family='Arial'%3EPartner 4%3C/text%3E%3C/svg%3E"
                                alt="Partner 4" class="h-16 grayscale hover:grayscale-0 transition">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="flex justify-center items-center h-24">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 100'%3E%3Crect fill='%23E5E7EB' width='200' height='100' rx='10'/%3E%3Ctext x='100' y='55' font-size='20' fill='%236B7280' text-anchor='middle' font-family='Arial'%3EPartner 5%3C/text%3E%3C/svg%3E"
                                alt="Partner 5" class="h-16 grayscale hover:grayscale-0 transition">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="flex justify-center items-center h-24">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 100'%3E%3Crect fill='%23E5E7EB' width='200' height='100' rx='10'/%3E%3Ctext x='100' y='55' font-size='20' fill='%236B7280' text-anchor='middle' font-family='Arial'%3EPartner 6%3C/text%3E%3C/svg%3E"
                                alt="Partner 6" class="h-16 grayscale hover:grayscale-0 transition">
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='45' fill='%23dc2626'/%3E%3Ctext x='50' y='60' font-size='40' fill='white' text-anchor='middle' font-family='Arial'%3EBL%3C/text%3E%3C/svg%3E"
                        alt="Beit Lahia Logo" class="h-12 w-12">
                    <div class="mr-3">
                        <h3 class="text-lg font-bold">BEIT LAHIA</h3>
                        <p class="text-xs text-gray-400">For Development</p>
                    </div>
                </div>

                <div class="text-center text-sm text-gray-400">
                    © 2025 Beit Lahia for Development
                </div>

                <button class="bg-red-600 text-white p-3 rounded-full hover:bg-red-700 transition">
                    <i class="fas fa-arrow-up"></i>
                </button>
            </div>
        </div>
    </footer>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        // Initiatives Swiper
        const initiativesSwiper = new Swiper('.initiativesSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
                1280: {
                    slidesPerView: 5,
                    spaceBetween: 30,
                }
            }
        });

        // Partners Swiper
        const partnersSwiper = new Swiper('.partnersSwiper', {
            slidesPerView: 2,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 50,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 60,
                }
            }
        });

        // Smooth scroll to top
        document.querySelector('footer button').addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Add scroll effect to header
        let lastScroll = 0;
        const header = document.querySelector('header');

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll > 100) {
                header.classList.add('shadow-xl');
            } else {
                header.classList.remove('shadow-xl');
            }

            lastScroll = currentScroll;
        });
    </script>
</body>

</html>