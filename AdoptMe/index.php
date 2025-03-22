<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdoptMe - Beranda</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f4e7d1] text-gray-900">

<!-- Navbar -->
<nav class="bg-[#8b5e34] text-white py-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center px-6">
        <a href="index.php" class="text-2xl font-bold">AdoptMe</a>
        <div class="space-x-6 flex items-center">
            <a href="index.php" class="hover:text-gray-300">Beranda</a>
            <a href="tentang.php" class="hover:text-gray-300">Tentang</a>
            <a href="hewan.php" class="hover:text-gray-300">Hewan</a>
            <a href="kontak.php" class="hover:text-gray-300">Kontak</a>

            <?php if (isset($_SESSION['nama'])): ?>
                <?php $inisial = strtoupper(substr($_SESSION['nama'], 0, 1)); ?>
                
                <!-- Dropdown -->
                <div class="relative">
                    <button id="userDropdown" class="bg-white text-[#8b5e34] px-3 py-1 rounded-full font-bold">
                        <?= $inisial; ?>
                    </button>

                    <!-- Menu Dropdown -->
                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg">
                        <a href="logout.php" class="block px-4 py-2 text-[#8b5e34] hover:bg-gray-100">Logout</a>
                    </div>
                </div>

                <script>
                    const dropdownBtn = document.getElementById('userDropdown');
                    const dropdownMenu = document.getElementById('dropdownMenu');

                    dropdownBtn.addEventListener('click', () => {
                        dropdownMenu.classList.toggle('hidden');
                    });

                    document.addEventListener('click', (event) => {
                        if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                            dropdownMenu.classList.add('hidden');
                        }
                    });
                </script>

            <?php else: ?>
                <a href="login.php" class="hover:text-gray-300">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>



    <!-- Hero Section -->
    <header class="bg-[#6d4c41] text-white py-20 text-center">
        <h1 class="text-5xl font-bold">Selamat Datang di AdoptMe</h1>
        <p class="mt-3 text-lg">Temukan sahabat setia Anda dan berikan mereka rumah penuh kasih</p>
        <a href="hewan.html" class="mt-6 inline-block bg-[#d9a36a] text-white px-6 py-3 rounded-lg shadow-md hover:bg-[#c48950]">Jelajahi Hewan</a>
    </header>

    <!-- Fitur Unggulan -->
    <section class="py-16 bg-[#e8c8a0] text-center">
        <h2 class="text-4xl font-bold text-[#4a2c1f]">Kenapa Memilih AdoptMe?</h2>
        <div class="container mx-auto grid md:grid-cols-3 gap-8 mt-10">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-bold text-[#8b5e34]">Mudah & Transparan</h3>
                <p class="mt-2 text-gray-600">Proses adopsi yang jelas, cepat, dan tanpa biaya tersembunyi.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-bold text-[#8b5e34]">Hewan Terawat</h3>
                <p class="mt-2 text-gray-600">Semua hewan mendapatkan perawatan dan vaksinasi sebelum diadopsi.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-bold text-[#8b5e34]">Dukungan Penuh</h3>
                <p class="mt-2 text-gray-600">Kami siap membantu Anda selama dan setelah proses adopsi.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#4a2c1f] text-white py-6 text-center">
        <p>&copy; 2025 AdoptMe - Temukan Sahabat Sejatimu</p>
        <p>Jl. Mawar No. 49, Surabaya | Email: kontak@adoptme.com</p>
    </footer>
</body>
</html>