<?php 
session_start(); 
$current_page = basename($_SERVER['PHP_SELF']); // Menyimpan nama file halaman yang sedang aktif
?>


<!-- navbar.php -->
<nav class="bg-[#8b5e34] text-white py-4 shadow-md relative z-50 px-6">
    <div class="flex justify-between items-center">
        <a href="index.php" class="text-2xl font-bold">AdoptMe</a>

        <div class="flex space-x-6 items-center">
            <a href="index.php" class="<?= ($current_page == 'index.php') ? 'active' : ''; ?> hover:text-gray-300">Beranda</a>
            <a href="tentang.php" class="<?= ($current_page == 'tentang.php') ? 'active' : ''; ?> hover:text-gray-300">Tentang</a>
            <a href="hewan.php" class="<?= ($current_page == 'hewan.php') ? 'active' : ''; ?> hover:text-gray-300">Hewan</a>
            <a href="kontak.php" class="<?= ($current_page == 'kontak.php') ? 'active' : ''; ?> hover:text-gray-300">Kontak</a>

            <?php if (isset($_SESSION['nama'])): ?>
                <?php $inisial = strtoupper(substr($_SESSION['nama'], 0, 1)); ?>
                
                <!-- Dropdown User -->
                <div class="relative">
                    <button id="userDropdown" class="bg-white text-[#8b5e34] px-4 py-2 rounded-full font-bold focus:outline-none">
                        <?= $inisial; ?>
                    </button>

                    <!-- Menu Dropdown User -->
                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-300">
                        <a href="toko.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Toko</a>
                        <a href="panduan.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Panduan</a>
                        <a href="logout.php" class="block px-4 py-2 text-[#8b5e34] hover:bg-gray-100 font-bold">Logout</a>
                    </div>
                </div>

            <?php else: ?>
                <a href="login.php" class="hover:text-gray-300">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Script untuk Dropdown -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdownBtn = document.getElementById("userDropdown");
        const dropdownMenu = document.getElementById("dropdownMenu");

        if (dropdownBtn && dropdownMenu) {
            dropdownBtn.addEventListener("click", function (event) {
                dropdownMenu.classList.toggle("hidden");
                event.stopPropagation();
            });

            document.addEventListener("click", function (event) {
                if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add("hidden");
                }
            });
        }
    });
</script>
