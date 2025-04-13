<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Perlengkapan Hewan - AdoptMe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-neutral-50 text-gray-800">

<?php include 'navbar.php'; ?>

<!-- Header -->
<header class="relative bg-[url('images/toko-hewan.jpg')] bg-cover bg-center bg-no-repeat h-[400px] flex items-center justify-center">
    <div class="bg-[#8b5e34]/70 w-full h-full flex flex-col items-center justify-center text-white text-center px-4">
        <h1 class="text-4xl md:text-5xl font-bold drop-shadow-lg">Toko Perlengkapan Hewan</h1>
        <p class="text-lg md:text-xl mt-3 mb-6 drop-shadow">Dapatkan kebutuhan hewan kesayanganmu di sini!</p>
        <a href="#produk" class="bg-amber-500 hover:bg-amber-600 text-white font-semibold py-2 px-6 rounded-full transition duration-300">
            Belanja Sekarang
        </a>
    </div>
</header>

<!-- Produk -->
<section id="produk" class="py-16 px-4 md:px-12 bg-white">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-3xl font-bold text-[#8b5e34]">Produk Terlaris</h2>
        <div class="relative">
            <select class="border border-gray-300 rounded-full py-2 px-4 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-amber-500">
                <option value="newest">Terbaru</option>
                <option value="terlaris">Terlaris</option>
                <option value="termurah">Termurah</option>
            </select>
        </div>
    </div>

    <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        <!-- Produk 1 -->
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 text-center relative border">
            <button class="absolute top-3 right-3 text-gray-400 hover:text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 
                        4.42 3 7.5 3c1.74 0 3.41 0.81 
                        4.5 2.09C13.09 3.81 14.76 3 16.5 3 
                        19.58 3 22 5.42 22 8.5c0 3.78-3.4 
                        6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </button>
            <img src="images/kandang.jpg" alt="Kandang Hewan" class="h-40 w-full object-cover rounded-lg mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Kandang Hewan</h3>
            <p class="text-sm text-gray-600">Nyaman dan aman untuk peliharaan.</p>
            <p class="text-amber-600 font-bold mt-2">Rp350.000</p>
            <button class="mt-4 bg-[#8b5e34] hover:bg-[#6b4429] text-white py-2 px-4 rounded-full font-semibold">
                Beli Sekarang
            </button>
        </div>

        <!-- Produk 2 -->
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 text-center relative border">
            <button class="absolute top-3 right-3 text-gray-400 hover:text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 
                        4.42 3 7.5 3c1.74 0 3.41 0.81 
                        4.5 2.09C13.09 3.81 14.76 3 16.5 3 
                        19.58 3 22 5.42 22 8.5c0 3.78-3.4 
                        6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </button>
            <img src="images/makanan-kucing.jpg" alt="Makanan Kucing" class="h-40 w-full object-cover rounded-lg mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Makanan Kucing</h3>
            <p class="text-sm text-gray-600">Nutritious dan disukai kucing!</p>
            <p class="text-amber-600 font-bold mt-2">Rp120.000</p>
            <button class="mt-4 bg-[#8b5e34] hover:bg-[#6b4429] text-white py-2 px-4 rounded-full font-semibold">
                Beli Sekarang
            </button>
        </div>

        <!-- Produk 3 -->
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 text-center relative border">
            <button class="absolute top-3 right-3 text-gray-400 hover:text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 
                        4.42 3 7.5 3c1.74 0 3.41 0.81 
                        4.5 2.09C13.09 3.81 14.76 3 16.5 3 
                        19.58 3 22 5.42 22 8.5c0 3.78-3.4 
                        6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </button>
            <img src="images/mainan-anjing.jpg" alt="Mainan Anjing" class="h-40 w-full object-cover rounded-lg mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Mainan Anjing</h3>
            <p class="text-sm text-gray-600">Aman & menghibur untuk anjing aktif.</p>
            <p class="text-amber-600 font-bold mt-2">Rp75.000</p>
            <button class="mt-4 bg-[#8b5e34] hover:bg-[#6b4429] text-white py-2 px-4 rounded-full font-semibold">
                Beli Sekarang
            </button>
        </div>

        <!-- Produk 4 -->
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 text-center relative border">
            <button class="absolute top-3 right-3 text-gray-400 hover:text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 
                        4.42 3 7.5 3c1.74 0 3.41 0.81 
                        4.5 2.09C13.09 3.81 14.76 3 16.5 3 
                        19.58 3 22 5.42 22 8.5c0 3.78-3.4 
                        6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </button>
            <img src="images/shampo-hewan.jpg" alt="Shampo Hewan" class="h-40 w-full object-cover rounded-lg mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Shampo Hewan</h3>
            <p class="text-sm text-gray-600">Membersihkan & merawat bulu hewan.</p>
            <p class="text-amber-600 font-bold mt-2">Rp45.000</p>
            <button class="mt-4 bg-[#8b5e34] hover:bg-[#6b4429] text-white py-2 px-4 rounded-full font-semibold">
                Beli Sekarang
            </button>
        </div>
    </div>
</section>

</body>
</html>
