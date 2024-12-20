<!DOCTYPE html>
<html lang="en" data-theme="bumblebee">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Event - Sponsorify</title>
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/95327fac23.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="flex justify-between items-center py-4 px-8 bg-white shadow">
        <div class="text-2xl font-bold text-orange-600">Sponsorify.</div>
        <div class="flex space-x-8">
            <a href="#" class="hover:text-orange-600">Support</a>
            <a href="#" class="hover:text-orange-600">Top sponsor</a>
            <a href="#" class="hover:text-orange-600">Steps</a>
            <a href="#" class="hover:text-orange-600">About</a>
        </div>
        <div class="flex space-x-4 ">
            <button class="btn bg-[#ea580c]"><a href="sponsorify.fly.dev" class="text-white">Login</a></button>
            <button class="btn bg-current"><a href="sponsorify.fly.dev" class="text-white">Register</a></button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="flex flex-col md:flex-row items-center py-16 px-8">
        <div class="max-w-lg">
            <h1 class="text-4xl font-bold mb-4">Kemudahan dalam membuat kesepakatan hanya di Sponsorify.</h1>
            <p class="text-gray-700 mb-6">"Sponsorify, website penghubung antar event organizer dan sponsorship, menawarkan kemudahan dalam membuat kesepakatan. Platform ini memfasilitasi proses kemitraan antara penyelenggara acara dan sponsor dengan cara yang efisien dan transparan."</p>
            <button class="bg-orange-600 text-white py-2 px-4 rounded hover:bg-orange-700">Bergabung sekarang</button>
        </div>
        <div class="mt-8 md:mt-0 ml-64">
            <img src="/image/landing4.png" alt="Event" class="w-">
        </div>
    </section>

    <!-- Support by Section -->
    <section class="py-16 px-8 text-center">
        <h2 class="text-2xl font-bold mb-8">Support by</h2>
        <div class="flex justify-center space-x-8">
            <img src="/image/poliwangi.png" alt="Berluti" class="h-12">
            <img src="/image/poliwangi.png" alt="Berluti" class="h-12">
            <img src="/image/poliwangi.png" alt="Berluti" class="h-12">
            <img src="/image/poliwangi.png" alt="Berluti" class="h-12">
            <img src="/image/poliwangi.png" alt="Berluti" class="h-12">
            <img src="/image/poliwangi.png" alt="Berluti" class="h-12">
            <img src="/image/poliwangi.png" alt="Berluti" class="h-12">
            <img src="/image/poliwangi.png" alt="Berluti" class="h-12">
        </div>
    </section>

    <!-- Top Sponsor Section -->
    <section class="py-16 px-8 bg-white">
        <h2 class="text-2xl font-bold mb-8 text-center">Top Sponsor</h2>
        <div class="flex justify-center space-x-16">
            <div class="bg-gray-100 p-4 rounded-lg shadow-lg">
                <img src="/image/s1.png" alt="BRI" class="w-48 object-cover mb-4">
                <p class="text-center">J&t</p>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg shadow-lg">
                <img src="/image/poliwangi.png" alt="Poliwangi" class="w-48 object-cover mb-4">
                <p class="text-center">Politeknik Negeri Banyuwangi</p>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg shadow-lg">
                <img src="/image/s2.png" alt="Shoes" class="w-48 object-cover mb-4">
                <p class="text-center">Butterfly</p>
            </div>
        </div>
    </section>

    <!-- Steps Section -->
    <section class="py-16 px-8 bg-orange-100">
        <h2 class="text-2xl font-bold mb-8 text-center">Cara mudah dalam membuat kesepakatan</h2>
        <div class="flex justify-center space-x-8">
            <div class="flex flex-col items-center">
                <div class="bg-white rounded-full w-10 h-10 flex items-center justify-center mb-2">1</div>
                <p>Login/Register</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="bg-white rounded-full w-10 h-10 flex items-center justify-center mb-2">2</div>
                <p>Pilih sponsor</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="bg-white rounded-full w-10 h-10 flex items-center justify-center mb-2">3</div>
                <p>Kirim proposal</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="bg-white rounded-full w-10 h-10 flex items-center justify-center mb-2">4</div>
                <p>Pencarian</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 px-8 bg-gray-800 text-white">
        <div class="flex justify-around">
            <div class="w-72">
                <h3 class="text-lg font-bold mb-2">Sponsorify</h3>
                <p class="text-sm">"Sponsorify, website penghubung antar event organizer dan sponsorship, menawarkan kemudahan dalam membuat kesepakatan. Platform ini memfasilitasi proses kemitraan antara penyelenggara acara dan sponsor dengan cara yang efisien dan transparan."</p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-2">Sponsor Category</h3>
                <ul class="text-sm">
                    <li>Elektronik</li>
                    <li>Makanan & minuman</li>
                    <li>Olahraga</li>
                    <li>Pakaian & Fashion</li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-2">Company</h3>
                <ul class="text-sm">
                    <li>About</li>
                    <li>Contact</li>
                    <li>Privacy Policy</li>
                    <li>Terms of Service</li>
                </ul>
            </div>
        </div>
    </footer>

</body>
</html>
