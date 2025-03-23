<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Perlengkapan Hewan - AdoptMe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900">

<!-- Navbar -->
<nav class="bg-[#8b5e34] text-white py-4 shadow-md relative z-50">
    <div class="container mx-auto flex justify-between items-center px-6">
        <a href="index.php" class="text-2xl font-bold">AdoptMe</a>

        <div class="space-x-6 flex items-center">
            <!-- Menu Garis Tiga -->
            <div class="relative">
                <button id="menuDropdownBtn" class="text-2xl hover:text-gray-300">&#9776;</button>

                <!-- Dropdown Menu -->
                <div id="menuDropdown" class="hidden absolute left-0 mt-2 w-48 bg-white text-gray-900 rounded-lg shadow-lg z-50">
                    <a href="toko.php" class="block px-4 py-2 hover:bg-gray-100">Toko</a>
                    <a href="panduan.php" class="block px-4 py-2 hover:bg-gray-100">Panduan</a>
                </div>
            </div>

            <a href="index.php" class="hover:text-gray-300">Beranda</a>
            <a href="tentang.php" class="hover:text-gray-300">Tentang</a>
            <a href="hewan.php" class="hover:text-gray-300">Hewan</a>
            <a href="kontak.php" class="hover:text-gray-300">Kontak</a>

            <?php if (isset($_SESSION['nama'])): ?>
                <?php $inisial = strtoupper(substr($_SESSION['nama'], 0, 1)); ?>
                <div class="relative">
                    <button id="userDropdown" class="bg-white text-[#8b5e34] px-3 py-1 rounded-full font-bold"><?= $inisial; ?></button>
                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg z-50">
                        <a href="logout.php" class="block px-4 py-2 text-[#8b5e34] hover:bg-gray-100">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="login.php" class="hover:text-gray-300">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Header -->
<header class="bg-[#8b5e34] shadow-md py-6 text-white text-center">
    <h1 class="text-3xl font-bold">Toko Perlengkapan Hewan</h1>
    <p>Dapatkan kebutuhan hewan kesayanganmu di sini!</p>
</header>

<!-- Produk -->


<script>
    // Dropdown Menu Garis Tiga
    const menuBtn = document.getElementById("menuDropdownBtn");
    const menuDropdown = document.getElementById("menuDropdown");

    menuBtn.addEventListener("click", () => {
        menuDropdown.classList.toggle("hidden");
    });

    document.addEventListener("click", (event) => {
        if (!menuBtn.contains(event.target) && !menuDropdown.contains(event.target)) {
            menuDropdown.classList.add("hidden");
        }
    });

    // Dropdown User
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

</body>
</html>

