<!DOCTYPE html>
<html lang="en" data-theme="bumblebee">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sponsorify - Platform Penghubung Event & Sponsor #1 di Indonesia</title>
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/95327fac23.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="fixed w-full top-0 z-50 bg-white shadow-md">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold text-orange-600 hover:text-orange-700 transition-colors duration-300">
                    Sponsorify.
                </div>

                <div class="hidden md:flex space-x-8">
                    <a href="#support" class="text-gray-600 hover:text-orange-600 transition-colors duration-300">Partner Kami</a>
                    <a href="#sponsors" class="text-gray-600 hover:text-orange-600 transition-colors duration-300">Sponsor Terbaik</a>
                    <a href="#steps" class="text-gray-600 hover:text-orange-600 transition-colors duration-300">Cara Kerja</a>
                    <a href="#about" class="text-gray-600 hover:text-orange-600 transition-colors duration-300">Tentang Kami</a>
                </div>

                <div class="flex space-x-4">
                    <a href="/auth/login" class="px-6 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors duration-300">
                        Masuk
                    </a>
                    <a href="/auth/register" class="px-6 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition-colors duration-300">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-28 pb-20 px-6 md:pt-32 md:pb-24">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 md:pr-12">
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                        Wujudkan Event Impian Anda Bersama
                        <span class="text-orange-600">Sponsorify</span>
                    </h1>
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                        Temukan kemudahan dalam menjalin kerjasama sponsorship untuk event Anda. Platform yang menghubungkan
                        event organizer dengan sponsor potensial secara efisien, aman, dan transparan.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/auth/register"><button class="px-8 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors duration-300 flex items-center justify-center">
                            <span>Mulai Sekarang</span></a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                    </div>
                </div>
                <div class="md:w-1/2 mt-12 md:mt-0">
                    <img src="/image/landing4.png" alt="Sponsorify Platform" class="w-full transform hover:scale-105 transition-transform duration-500">
                </div>
            </div>
        </div>
    </section>

    <!-- Support Section -->
    <section id="support" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-4">Dipercaya Oleh</h2>
            <p class="text-gray-600 text-center mb-12">Bergabung dengan 1000+ event organizer dan sponsor terpercaya</p>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 items-center">
                <img src="/image/poliwangi.png" alt="Partner" class="h-12 mx-auto">
                <img src="/image/poliwangi.png" alt="Partner" class="h-12 mx-auto">
                <img src="/image/poliwangi.png" alt="Partner" class="h-12 mx-auto">
                <img src="/image/poliwangi.png" alt="Partner" class="h-12 mx-auto">
                <img src="/image/poliwangi.png" alt="Partner" class="h-12 mx-auto">
                <!-- Repeat for other partners -->
            </div>
        </div>
    </section>

    <!-- Top Sponsors -->
    <section id="sponsors" class="py-16 bg-orange-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-4">Sponsor Terpopuler</h2>
            <p class="text-gray-600 text-center mb-12">Temukan sponsor terbaik untuk event Anda</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <img src="/image/s1.png" alt="J&T" class="w-48 mx-auto mb-4">
                    <h3 class="text-lg font-semibold text-center">J&T Express</h3>
                    <p class="text-gray-600 text-center text-sm">Logistik & Pengiriman</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <img src="/image/s1.png" alt="J&T" class="w-48 mx-auto mb-4">
                    <h3 class="text-lg font-semibold text-center">J&T Express</h3>
                    <p class="text-gray-600 text-center text-sm">Logistik & Pengiriman</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <img src="/image/s1.png" alt="J&T" class="w-48 mx-auto mb-4">
                    <h3 class="text-lg font-semibold text-center">J&T Express</h3>
                    <p class="text-gray-600 text-center text-sm">Logistik & Pengiriman</p>
                </div>
                <!-- Repeat for other sponsors -->
            </div>
        </div>
    </section>

    <!-- Steps Section -->
    <section id="steps" class="py-16 bg-orange-100">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-4">4 Langkah Mudah Mendapatkan Sponsor</h2>
            <p class="text-gray-600 text-center mb-12">Proses simple dan cepat untuk mewujudkan event impian Anda</p>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Step 1: Daftar -->
                <div class="flex flex-col items-center group">
                    <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center mb-4 shadow-lg group-hover:bg-orange-600 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-user-plus text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Daftar</h3>
                    <p class="text-gray-600 text-center text-sm px-4">
                        Buat akun sebagai event organizer dan lengkapi profil Anda
                    </p>
                </div>

                <!-- Step 2: Membuat Event -->
                <div class="flex flex-col items-center group">
                    <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center mb-4 shadow-lg group-hover:bg-orange-600 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-calendar-plus text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Membuat Event</h3>
                    <p class="text-gray-600 text-center text-sm px-4">
                        Buat detail event dan tentukan kebutuhan sponsorship Anda
                    </p>
                </div>

                <!-- Step 3: Mengajukan Event -->
                <div class="flex flex-col items-center group">
                    <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center mb-4 shadow-lg group-hover:bg-orange-600 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-paper-plane text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Ajukan ke Sponsor</h3>
                    <p class="text-gray-600 text-center text-sm px-4">
                        Pilih sponsor potensial dan ajukan proposal event Anda
                    </p>
                </div>

                <!-- Step 4: Pencairan -->
                <div class="flex flex-col items-center group">
                    <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center mb-4 shadow-lg group-hover:bg-orange-600 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-hand-holding-dollar text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Pencairan</h3>
                    <p class="text-gray-600 text-center text-sm px-4">
                        Terima dana sponsorship setelah proposal disetujui
                    </p>
                </div>
            </div>

            <!-- Optional: Add connection lines between steps -->
            <div class="hidden md:block relative">
                <div class="absolute top-20 left-1/4 right-1/4 h-0.5 bg-gray-300 -z-10"></div>
            </div>

            <!-- Optional: Add CTA button below steps -->
            <div class="text-center mt-12">
                <a href="/auth/register"><button class="px-8 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors duration-300 flex items-center mx-auto">
                    <span>Mulai Langkah Pertama</span></a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12" id="about">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">Sponsorify<span class="text-orange-600">.</span></h3>
                    <p class="text-gray-400 leading-relaxed">
                        Platform digital yang menghubungkan event organizer dengan sponsor secara efektif dan profesional.
                        Kami berkomitmen untuk memudahkan proses sponsorship di Indonesia.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Kategori Sponsor</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="hover:text-orange-600 transition-colors duration-300">Elektronik</li>
                        <li class="hover:text-orange-600 transition-colors duration-300">Makanan & Minuman</li>
                        <li class="hover:text-orange-600 transition-colors duration-300">Olahraga</li>
                        <li class="hover:text-orange-600 transition-colors duration-300">Pakaian & Fashion</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Perusahaan</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="hover:text-orange-600 transition-colors duration-300">Tentang Kami</li>
                        <li class="hover:text-orange-600 transition-colors duration-300">Hubungi Kami</li>
                        <li class="hover:text-orange-600 transition-colors duration-300">Kebijakan Privasi</li>
                        <li class="hover:text-orange-600 transition-colors duration-300">Syarat & Ketentuan</li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-gray-700 text-center text-gray-400">
                <p>&copy; 2024 Sponsorify. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</body>
</html>
