<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beit Lahia - Media Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-white font-sans">
    <!-- Top Bar -->
    <div class="bg-zinc-900 text-white text-sm">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-gray-300"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-gray-300"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-gray-300"><i class="fab fa-x-twitter"></i></a>
                <a href="#" class="hover:text-gray-300"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="hover:text-gray-300"><i class="fab fa-youtube"></i></a>
            </div>
            <div class="flex items-center gap-6">
                <a href="mailto:info@blda.ps" class="flex items-center gap-2 hover:text-gray-300">
                    <i class="far fa-envelope"></i>
                    <span>info@blda.ps</span>
                </a>
                <a href="tel:+97282479853" class="flex items-center gap-2 hover:text-gray-300">
                    <i class="fas fa-phone"></i>
                    <span dir="ltr">+97282479853</span>
                </a>
                <a href="#" class="flex items-center gap-2 hover:text-gray-300">
                    <i class="fas fa-language"></i>
                    <span>عربي</span>
                </a>
                <a href="#" class="flex items-center gap-2 hover:text-gray-300">
                    <i class="far fa-question-circle"></i>
                    <span>FAQs</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="bg-zinc-900 border-t border-zinc-800">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center py-4">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='80' viewBox='0 0 160 80'%3E%3Crect fill='%23222' width='160' height='80'/%3E%3Ctext x='10' y='35' fill='white' font-size='20' font-weight='bold'%3EBEIT LAHIA%3C/text%3E%3Ctext x='10' y='55' fill='white' font-size='12'%3EAssociation for Development%3C/text%3E%3Ctext x='10' y='70' fill='white' font-size='10'%3Eجمعية بيت لاهيا للتطوير%3C/text%3E%3C/svg%3E"
                        alt="Beit Lahia Logo" class="h-20">
                </div>

                <!-- Main Menu -->
                <div class="hidden lg:flex items-center gap-1">
                    <a href="#" class="text-white px-6 py-8 hover:bg-zinc-800 transition">Home</a>
                    <a href="#" class="text-white px-6 py-8 hover:bg-zinc-800 transition">Programs& Projects</a>
                    <a href="#" class="text-white px-6 py-8 hover:bg-zinc-800 transition">Latest News</a>
                    <a href="#" class="bg-red-600 text-white px-6 py-8 hover:bg-red-700 transition">Media Center</a>
                    <a href="#" class="text-white px-6 py-8 hover:bg-zinc-800 transition">Applications</a>
                    <a href="#" class="text-white px-6 py-8 hover:bg-zinc-800 transition">Contacts</a>
                    <button class="text-white px-6 py-8 hover:bg-zinc-800 transition flex items-center gap-2">
                        <i class="fas fa-bars"></i>
                        <span>More</span>
                    </button>
                </div>

                <!-- Right Side Buttons -->
                <div class="flex items-center gap-4">
                    <button class="text-white hover:text-gray-300 flex items-center gap-2">
                        <i class="fas fa-search"></i>
                        <span>Search</span>
                    </button>
                    <a href="#" class="bg-red-600 text-white px-6 py-3 font-bold hover:bg-red-700 transition">
                        DONATE
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative h-96 bg-gradient-to-br from-red-900 via-zinc-900 to-yellow-900 overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="container mx-auto px-4 h-full flex items-center relative z-10">
            <div class="text-white">
                <h1 class="text-6xl font-bold mb-4">
                    Voices& <span class="text-white">Visions.</span>
                </h1>
                <p class="text-2xl">Real people. Real STORIES. Real impact.</p>
            </div>
        </div>
    </div>

    <!-- Videos Section -->
    <div class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Video Card 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <div class="relative h-64 bg-gray-200">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300'%3E%3Crect fill='%23ddd' width='400' height='300'/%3E%3C/svg%3E"
                            alt="Video thumbnail" class="w-full h-full object-cover">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div
                                class="w-20 h-20 bg-white bg-opacity-90 rounded-full flex items-center justify-center cursor-pointer hover:bg-opacity-100 transition">
                                <i class="fas fa-play text-red-600 text-2xl ml-1"></i>
                            </div>
                        </div>
                        <div class="absolute top-4 left-4 w-16 h-16 bg-white rounded-full border-4 border-white"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Graduation ceremony for members of vocational training centers in Gaza.
                        </h3>
                    </div>
                </div>

                <!-- Video Card 2 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <div class="relative h-64 bg-gray-200">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300'%3E%3Crect fill='%23ddd' width='400' height='300'/%3E%3C/svg%3E"
                            alt="Video thumbnail" class="w-full h-full object-cover">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div
                                class="w-20 h-20 bg-white bg-opacity-90 rounded-full flex items-center justify-center cursor-pointer hover:bg-opacity-100 transition">
                                <i class="fas fa-play text-red-600 text-2xl ml-1"></i>
                            </div>
                        </div>
                        <div class="absolute top-4 left-4 w-16 h-16 bg-white rounded-full border-4 border-white"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Graduation ceremony for members of vocational training centers in Gaza.
                        </h3>
                    </div>
                </div>

                <!-- Video Card 3 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <div class="relative h-64 bg-gray-200">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300'%3E%3Crect fill='%23ddd' width='400' height='300'/%3E%3C/svg%3E"
                            alt="Video thumbnail" class="w-full h-full object-cover">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div
                                class="w-20 h-20 bg-white bg-opacity-90 rounded-full flex items-center justify-center cursor-pointer hover:bg-opacity-100 transition">
                                <i class="fas fa-play text-red-600 text-2xl ml-1"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Graduation ceremony for members of vocational training centers in Gaza.
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-zinc-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Ccircle cx='40' cy='40' r='35' fill='white'/%3E%3C/svg%3E"
                        alt="Beit Lahia Logo" class="h-16">
                    <div>
                        <h3 class="text-2xl font-bold">BEIT LAHIA</h3>
                        <p class="text-sm">For Development</p>
                    </div>
                </div>
                <div class="text-sm">
                    <p>© 2025 Beit Lahia for Development.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button
        class="fixed bottom-8 right-8 w-12 h-12 bg-red-600 text-white rounded-lg shadow-lg hover:bg-red-700 transition flex items-center justify-center">
        <i class="fas fa-arrow-up"></i>
    </button>
</body>

</html>