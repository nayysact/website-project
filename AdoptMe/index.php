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
<body class="bg-white text-gray-900">

<!-- Navbar -->
<nav class="bg-[#8b5e34] text-white py-4 shadow-md relative z-50">
    <div class="container mx-auto flex justify-between items-center px-6">
        <a href="index.php" class="text-2xl font-bold">AdoptMe</a>

        <div class="space-x-6 flex items-center">
            <!-- Menu Garis Tiga -->
            <div class="relative">
                <button id="menuDropdownBtn" class="text-2xl hover:text-gray-300">&#9776;</button>

                <!-- Menu Dropdown -->
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

                <!-- Dropdown User -->
                <div class="relative">
                    <button id="userDropdown" class="bg-white text-[#8b5e34] px-3 py-1 rounded-full font-bold">
                        <?= $inisial; ?>
                    </button>

                    <!-- Menu Dropdown User -->
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

<!-- Hero Section -->
<header class="bg-[#8b5e34] text-white py-12">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-6">
        <div class="text-center md:text-left md:w-1/2">
            <h1 class="text-5xl font-bold">Selamat Datang di AdoptMe</h1>
            <p class="mt-3 text-lg">Temukan sahabat setia Anda dan berikan mereka rumah penuh kasih</p>
            <a href="hewan.php" class="mt-6 inline-block bg-[#d9a36a] text-white px-6 py-3 rounded-lg shadow-md hover:bg-[#c48950]">
                Jelajahi Hewan
            </a>
        </div>

        <div class="mt-6 md:mt-0 md:w-1/2 flex justify-center">
            <div class="relative w-96 h-72 overflow-hidden rounded-lg shadow-lg">
                <img src="img/h1.png" alt="Hewan Adopsi" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</header>

<!-- Cerita Singkat AdoptMe -->
<section class="container mx-auto px-6 py-12">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-3xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-[#8b5e34]">AdoptMe</h2>
        <p class="text-gray-600 mt-4 text-justify">
            AdoptMe adalah platform yang menghubungkan hewan peliharaan yang membutuhkan rumah dengan calon adopter yang peduli. 
            Kami berkomitmen untuk memberikan kehidupan yang lebih baik bagi hewan-hewan terlantar dengan membantu mereka menemukan 
            keluarga yang penuh kasih.
        </p>
    </div>
</section>

<!-- Daftar Hewan untuk Adopsi -->
<section class="container mx-auto py-16 text-center">
    <h2 class="text-4xl font-bold text-[#4a2c1f]">Hewan yang Tersedia untuk Adopsi</h2>
    <p class="text-gray-600 max-w-2xl mx-auto mt-4 mb-10">
        Berbagai hewan menggemaskan yang siap diadopsi dan menemukan rumah barunya.
    </p>

    <div class="grid md:grid-cols-3 gap-6">
        <?php 
        $hewan = [
            ["id" => 1, "nama" => "Camel", "gambar" => "img/ku.jpg", "deskripsi" => "Kucing ceria dan aktif yang siap diadopsi!"],
            ["id" => 2, "nama" => "Jio", "gambar" => "img/a1.jpg", "deskripsi" => "Anjing penyayang dan setia untuk keluarga."],
            ["id" => 3, "nama" => "Lili", "gambar" => "img/K1.jpg", "deskripsi" => "Kelinci aktif yang suka bermain di taman."],
        ];
        foreach ($hewan as $h) : ?>
            <div class="bg-white p-6 border border-[#8b5e34] rounded-lg shadow-md">
                <div class="w-full h-56 flex items-center justify-center bg-white">
                    <img src="<?= $h['gambar']; ?>" alt="<?= $h['nama']; ?>" class="w-full h-full object-cover rounded-md">
                </div>
                <h3 class="text-xl font-bold text-[#8b5e34] mt-3"><?= $h['nama']; ?></h3>
                <p class="mt-2 text-gray-600 text-sm"><?= $h['deskripsi']; ?></p>
                <div class="flex justify-center space-x-4 mt-4">
                    <a href="biografi.php?nama=<?= urlencode($h['nama']); ?>" class="bg-[#d9a36a] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#c48950]">Lihat Biografi</a>
                    <a href="proses_adopsi.php?hewan_id=<?= $h['id']; ?>" class="bg-[#8b5e34] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#6b3f21]">Adopsi</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-10">
        <a href="hewan.php" class="inline-block text-[#8b5e34] text-xl font-bold hover:text-[#c48950]">
            Lihat Hewan Lainnya ↓
        </a>
    </div>
</section>

<!-- Artikel Edukasi -->
<section class="container mx-auto py-16 text-center">
    <h2 class="text-4xl font-bold text-[#4a2c1f]">Artikel Edukasi</h2>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mt-10">
        <?php 
        $artikel = [
            ["judul" => "Manfaat Adopsi Hewan", "gambar" => "img/ed1.jpg", "link" => "artikel1.php"],
            ["judul" => "Persiapan Sebelum Adopsi", "gambar" => "img/ed2.jpg", "link" => "artikel2.php"],
            ["judul" => "Merawat Hewan dengan Baik", "gambar" => "img/ed3.jpg", "link" => "artikel3.php"],
            ["judul" => "Tips Adopsi yang Sukses", "gambar" => "img/ed4.jpg", "link" => "artikel4.php"],
        ];
        foreach ($artikel as $a) : ?>
            <div class="bg-white p-4 border-2 border-[#8b5e34] rounded-lg shadow-md">
                <img src="<?= $a['gambar']; ?>" alt="<?= $a['judul']; ?>" class="w-full h-40 object-cover rounded-md">
                <h3 class="text-xl font-bold text-[#8b5e34] mt-3"><?= $a['judul']; ?></h3>
                <a href="<?= $a['link']; ?>" class="mt-3 inline-block bg-[#d9a36a] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#c48950]">Baca Selengkapnya</a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Footer -->
<footer class="bg-[#4a2c1f] text-white py-6 text-center w-full">
    <p>&copy; 2025 AdoptMe - Temukan Sahabat Sejatimu</p>
    <p>Jl. Mawar No. 49, Surabaya | Email: kontak@adoptme.com</p>
</footer>

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
