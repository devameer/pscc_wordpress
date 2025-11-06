<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get in Touch - Beit Lahia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    <!-- Hero Section -->
    <div class="relative h-96 bg-cover bg-center"
        style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(60,0,0,0.7)), url('data:image/svg+xml,%3Csvg width="
        1200" height="400" xmlns="http://www.w3.org/2000/svg" %3E%3Cdefs%3E%3CradialGradient id="grad" %3E%3Cstop
        offset="0%25" style="stop-color:rgb(139,0,0);stop-opacity:0.8" /%3E%3Cstop offset="100%25"
        style="stop-color:rgb(0,0,0);stop-opacity:1" /%3E%3C/radialGradient%3E%3C/defs%3E%3Crect width="1200"
        height="400" fill="url(%23grad)" /%3E%3C/svg%3E');">
        <div class="container mx-auto px-4 h-full flex items-center">
            <div class="text-white max-w-2xl">
                <h1 class="text-5xl md:text-6xl font-bold mb-4">
                    Get in <span class="text-white">Touch.</span>
                </h1>
                <p class="text-xl md:text-2xl font-light">TOGETHER, We Make Change Happen.</p>
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Contact Form -->
            <div class="bg-white p-8 rounded-lg shadow-sm">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Share Your Thoughts Here</h2>

                <form class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" placeholder="Your name"
                            class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-600">
                        <input type="email" placeholder="Your Email"
                            class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-600">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" placeholder="Subject"
                            class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-600">
                        <select
                            class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-600 text-gray-500">
                            <option>Reason</option>
                            <option>General Inquiry</option>
                            <option>Support</option>
                            <option>Partnership</option>
                        </select>
                    </div>

                    <textarea placeholder="Your Message Here." rows="6"
                        class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-600"></textarea>

                    <div class="flex items-center gap-4">
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold px-12 py-3 rounded transition duration-300">
                            SEND
                        </button>
                        <span class="text-gray-500">OR</span>
                        <button type="reset" class="text-red-600 hover:text-red-700 font-semibold underline">
                            Clear
                        </button>
                    </div>
                </form>
            </div>

            <!-- Map and Contact Info -->
            <div class="space-y-6">
                <h2 class="text-2xl font-bold text-gray-800">Our Offices</h2>
                <h3 class="text-xl font-semibold text-gray-700">Warehouses</h3>

                <!-- Map -->
                <div class="bg-gray-200 rounded-lg overflow-hidden shadow-sm h-64">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3385.5!2d34.5!3d31.5!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzHCsDMwJzAwLjAiTiAzNMKwMzAnMDAuMCJF!5e0!3m2!1sen!2s!4v1234567890"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>

                <!-- Contact Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Social Card -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-red-600">
                        <div class="flex items-start gap-3">
                            <div class="bg-red-600 p-3 rounded">
                                <i class="fas fa-globe text-white text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-2">SOCIAL</h4>
                                <div class="flex gap-3 text-gray-700">
                                    <i class="fab fa-facebook-f hover:text-red-600 cursor-pointer"></i>
                                    <i class="fab fa-instagram hover:text-red-600 cursor-pointer"></i>
                                    <i class="fab fa-twitter hover:text-red-600 cursor-pointer"></i>
                                    <i class="fab fa-linkedin-in hover:text-red-600 cursor-pointer"></i>
                                    <i class="fab fa-youtube hover:text-red-600 cursor-pointer"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Phone Card -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-red-600">
                        <div class="flex items-start gap-3">
                            <div class="bg-red-600 p-3 rounded">
                                <i class="fas fa-phone text-white text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-2">PHONE</h4>
                                <p class="text-gray-700">+97282479853</p>
                            </div>
                        </div>
                    </div>

                    <!-- Email Card -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-red-600">
                        <div class="flex items-start gap-3">
                            <div class="bg-red-600 p-3 rounded">
                                <i class="fas fa-envelope text-white text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-2">EMAIL</h4>
                                <p class="text-gray-700">INFO@BLDA.PS</p>
                            </div>
                        </div>
                    </div>

                    <!-- Address Card -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-red-600">
                        <div class="flex items-start gap-3">
                            <div class="bg-red-600 p-3 rounded">
                                <i class="fas fa-map-marker-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-2">ADDRESS</h4>
                                <p class="text-gray-700">Palestine, Gaza Strip,<br>Dir.Elbalah, Berka St.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>