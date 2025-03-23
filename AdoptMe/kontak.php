<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdoptMe - Kontak</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900">

<!-- Navbar -->
<nav class="bg-[#8b5e34] text-white py-4 shadow-md relative z-50">
    <div class="container mx-auto flex justify-between items-center px-6">
        <a href="index.php" class="text-2xl font-bold">AdoptMe</a>
        
        <div class="space-x-6 flex items-center relative">
            <!-- Menu Garis Tiga -->
            <div class="relative">
                <button id="menuDropdownBtn" class="text-2xl hover:text-gray-300">
                    &#9776;
                </button>
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
                <span class="bg-white text-[#8b5e34] px-3 py-1 rounded-full font-bold"><?= $inisial; ?></span>
            <?php else: ?>
                <a href="login.php" class="hover:text-gray-300">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Hubungi Kami Section -->
<section class="py-16">
    <div class="container mx-auto px-6">
        <div class="bg-white p-8 rounded-lg shadow-xl max-w-xl mx-auto">
            <h2 class="text-[#8b5e34] text-center font-semibold text-lg">Hubungi Kami</h2>
            <h3 class="text-3xl font-bold text-center mt-2">Kami Siap Membantu!</h3>
            <p class="text-[#6d4c41] text-center mt-4">Jika Anda memiliki pertanyaan atau ingin mengadopsi hewan, jangan ragu untuk menghubungi kami.</p>
        </div>

        <form class="mt-12 max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md border border-[#8b5e34]">
            <h4 class="text-2xl font-bold text-[#8b5e34] text-center">Kirim Pesan</h4>
            <div class="mt-4">
                <label class="block text-[#6d4c41] font-medium">Nama</label>
                <input type="text" class="w-full mt-2 p-2 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34]">
            </div>
            <div class="mt-4">
                <label class="block text-[#6d4c41] font-medium">Email</label>
                <input type="email" class="w-full mt-2 p-2 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34]">
            </div>
            <div class="mt-4">
                <label class="block text-[#6d4c41] font-medium">Pesan</label>
                <textarea class="w-full mt-2 p-2 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34]" rows="4"></textarea>
            </div>
            <button type="submit" class="mt-6 w-full bg-[#8b5e34] text-white py-2 rounded-lg hover:bg-[#6d4c41] transition duration-300">Kirim Pesan</button>
        </form>

        <!-- Info Kontak -->
        <div class="mt-12 flex flex-col md:flex-row justify-center gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md text-center border border-[#8b5e34]">
                <h4 class="text-[#8b5e34] text-2xl font-bold">Alamat</h4>
                <p class="text-gray-600 mt-2">Jl. Mawar No. 49, Surabaya</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center border border-[#8b5e34]">
                <h4 class="text-[#8b5e34] text-2xl font-bold">Email</h4>
                <p class="text-gray-600 mt-2">kontak@adoptme.com</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center border border-[#8b5e34]">
                <h4 class="text-[#8b5e34] text-2xl font-bold">Telepon</h4>
                <p class="text-gray-600 mt-2">+62 812-3456-7890</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-[#4a2c1f] text-white py-6 text-center">
    <p>&copy; 2025 AdoptMe - Temukan Sahabat Sejatimu</p>
    <p>Jl. Mawar No. 49, Surabaya | Email: kontak@adoptme.com</p>
</footer>

<!-- Script Dropdown -->
<script>
    const menuBtn = document.getElementById('menuDropdownBtn');
    const menuDropdown = document.getElementById('menuDropdown');

    menuBtn.addEventListener('click', (e) => {
        e.stopPropagation(); // Supaya ga nutup sendiri pas diklik tombol
        menuDropdown.classList.toggle('hidden');
    });

    window.addEventListener('click', (e) => {
        if (!menuBtn.contains(e.target) && !menuDropdown.contains(e.target)) {
            menuDropdown.classList.add('hidden');
        }
    });
</script>

</body>
</html>
