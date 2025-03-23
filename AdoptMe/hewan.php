<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hewan untuk Adopsi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900">

<!-- Navbar -->
<nav class="bg-[#8b5e34] text-white py-4 shadow-md relative z-50">
    <div class="container mx-auto flex justify-between items-center px-6">
        <a href="index.php" class="text-2xl font-bold">AdoptMe</a>
        
        <div class="space-x-6 flex items-center relative">
            <div class="relative">
                <button id="menuDropdownBtn" class="text-2xl hover:text-gray-300">&#9776;</button>
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

<!-- Header -->
<header class="bg-white shadow-md py-10 text-[#8b5e34] text-center">
    <h1 class="text-4xl font-bold">Temukan Sahabat Barumu</h1>
    <p class="mt-2 text-lg">Berikan mereka rumah yang penuh kasih 💕</p>
</header>

<!-- Filter Hewan -->
<section class="container mx-auto mt-12 text-center px-6">
    <h2 class="text-2xl font-semibold text-[#4a2c1f]">Filter Hewan</h2>
    <div class="flex justify-center gap-4 mt-4">
        <button class="filter-btn px-4 py-2 bg-[#8b5e34] text-white rounded-lg" data-filter="Semua">Semua</button>
        <button class="filter-btn px-4 py-2 bg-[#8b5e34] text-white rounded-lg" data-filter="Anjing">Anjing</button>
        <button class="filter-btn px-4 py-2 bg-[#8b5e34] text-white rounded-lg" data-filter="Kucing">Kucing</button>
        <button class="filter-btn px-4 py-2 bg-[#8b5e34] text-white rounded-lg" data-filter="Kelinci">Kelinci</button>
    </div>
</section>

<!-- Daftar Hewan Adopsi -->
<section class="container mx-auto py-12 text-center px-6">
    <h2 class="text-4xl font-bold text-[#4a2c1f] mb-6">Hewan yang Tersedia untuk Adopsi</h2>
    
    <div class="grid md:grid-cols-3 gap-6" id="hewan-list">
        <?php 
        $hewan = [
            ["id" => 1, "nama" => "Camel", "gambar" => "img/ku.jpg", "jenis" => "Kucing", "deskripsi" => "Kucing betina, 2 tahun, ramah dan suka bermain."],
            ["id" => 2, "nama" => "Jio", "gambar" => "img/a1.jpg", "jenis" => "Anjing", "deskripsi" => "Anjing jantan, 3 tahun, setia dan mudah dilatih."],
            ["id" => 3, "nama" => "Lili", "gambar" => "img/K1.jpg", "jenis" => "Kelinci", "deskripsi" => "Kelinci betina, 1 tahun, lembut dan suka bermain."],
            ["id" => 4, "nama" => "Momo", "gambar" => "img/momo.jpg", "jenis" => "Kucing", "deskripsi" => "Kucing Persia jantan, 4 tahun, tenang dan manja."],
            ["id" => 5, "nama" => "Bubu", "gambar" => "img/bubu.jpg", "jenis" => "Kelinci", "deskripsi" => "Kelinci Holland Lop, 2 tahun, aktif dan lucu."],
            ["id" => 6, "nama" => "Max", "gambar" => "img/max.jpg", "jenis" => "Anjing", "deskripsi" => "Anjing Golden Retriever, 5 tahun, ceria dan penyayang."],
            ["id" => 7, "nama" => "Coco", "gambar" => "img/coco.jpg", "jenis" => "Kucing", "deskripsi" => "Kucing Siam jantan, 3 tahun, pintar dan aktif."],
            ["id" => 8, "nama" => "Rocky", "gambar" => "img/rocky.jpg", "jenis" => "Anjing", "deskripsi" => "Anjing Siberian Husky, 2 tahun, enerjik dan setia."],
            ["id" => 9, "nama" => "Luna", "gambar" => "img/luna.jpg", "jenis" => "Kelinci", "deskripsi" => "Kelinci Lionhead, 1 tahun, manja dan suka digendong."],
        ];
        foreach ($hewan as $h) : ?>
            <div class="hewan-item bg-white p-6 border border-[#8b5e34] rounded-lg shadow-md flex flex-col justify-between h-full" data-jenis="<?= $h['jenis']; ?>">
                <div class="w-full h-56 flex items-center justify-center bg-white">
                    <img src="<?= $h['gambar']; ?>" alt="Foto <?= $h['nama']; ?>" class="w-full h-full object-contain rounded-md">
                </div>
                <h3 class="text-xl font-bold text-[#8b5e34] mt-3"><?= $h['nama']; ?></h3>
                <p class="mt-2 text-gray-600 text-sm"><?= $h['deskripsi']; ?></p>
                <div class="flex justify-center space-x-4 mt-4">
                    <a href="biografi.php?nama=<?= urlencode($h['nama']); ?>" class="bg-[#d9a36a] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#c48950] transition duration-300">Lihat Biografi</a>
                    <a href="proses_adopsi.php?hewan_id=<?= $h['id']; ?>" class="bg-[#8b5e34] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#6b3f21] transition duration-300">Adopsi</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Testimoni Pengadopsi -->
<section class="container mx-auto mt-8 px-6">
    <h2 class="text-3xl font-bold text-center text-[#4a2c1f] mb-6">Testimoni Pengadopsi</h2>

    <div class="bg-white p-6 rounded-lg shadow-md mb-4 border border-[#8b5e34]">
        <p class="text-gray-600 italic">"Saya selalu ingin memiliki kucing, tetapi ragu karena takut tidak bisa merawatnya dengan baik. Setelah mengadopsi Momo melalui AdoptMe, saya menyadari betapa menyenangkannya memiliki teman berbulu di rumah."</p>
        <p class="text-right text-sm font-semibold">- Naya, Pengadopsi Kucing Persia</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mb-4 border border-[#8b5e34]">
        <p class="text-gray-600 italic">"Mengadopsi kelinci adalah keputusan terbaik yang pernah saya buat! Bubu sangat menggemaskan dan cepat beradaptasi di rumah."</p>
        <p class="text-right text-sm font-semibold">- Balqis, Pengadopsi Kelinci Holland Lop</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md border border-[#8b5e34]">
        <p class="text-gray-600 italic">"Saya mengadopsi Max, seekor anjing golden retriever, melalui AdoptMe satu tahun lalu. Awalnya dia pemalu dan takut dengan lingkungan baru, tetapi sekarang ceria dan setia."</p>
        <p class="text-right text-sm font-semibold">- Rania, Pengadopsi Anjing Golden Retriever</p>
    </div>
</section>

<!-- Galeri Adopsi Berhasil -->
<section class="container mx-auto mt-12 px-6">
    <h2 class="text-3xl font-bold text-center text-[#4a2c1f] mb-6">Galeri Adopsi Berhasil</h2>

    <div class="flex flex-wrap justify-center gap-6">
        <div class="shadow-lg rounded-xl overflow-hidden w-40 h-40 flex items-center justify-center bg-white">
            <img src="img/a1.jpg" alt="Adopsi 1" class="object-cover w-full h-full">
        </div>
        <div class="shadow-lg rounded-xl overflow-hidden w-40 h-40 flex items-center justify-center bg-white">
            <img src="img/ku.jpg" alt="Adopsi 2" class="object-cover w-full h-full">
        </div>
        <div class="shadow-lg rounded-xl overflow-hidden w-40 h-40 flex items-center justify-center bg-white">
            <img src="img/K1.jpg" alt="Adopsi 3" class="object-cover w-full h-full">
        </div>
        <div class="shadow-lg rounded-xl overflow-hidden w-40 h-40 flex items-center justify-center bg-white">
            <img src="img/momo.jpg" alt="Adopsi 4" class="object-cover w-full h-full">
        </div>
        <div class="shadow-lg rounded-xl overflow-hidden w-40 h-40 flex items-center justify-center bg-white">
            <img src="img/bubu.jpg" alt="Adopsi 5" class="object-cover w-full h-full">
        </div>
        <div class="shadow-lg rounded-xl overflow-hidden w-40 h-40 flex items-center justify-center bg-white">
            <img src="img/max.jpg" alt="Adopsi 6" class="object-cover w-full h-full">
        </div>
        <div class="shadow-lg rounded-xl overflow-hidden w-40 h-40 flex items-center justify-center bg-white">
            <img src="img/luna.jpg" alt="Adopsi 7" class="object-cover w-full h-full">
        </div>
        <div class="shadow-lg rounded-xl overflow-hidden w-40 h-40 flex items-center justify-center bg-white">
            <img src="img/rocky.jpg" alt="Adopsi 8" class="object-cover w-full h-full">
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-[#4a2c1f] text-white py-6 text-center mt-12">
    <p>&copy; 2025 AdoptMe | Semua Hak Cipta Dilindungi</p>
</footer>

<a href="https://wa.me/62812118001" class="fixed bottom-6 right-6 bg-green-500 text-white px-4 py-2 rounded-full shadow-lg">
    Chat via WhatsApp
</a>

<script>
    const menuBtn = document.getElementById('menuDropdownBtn');
    const menuDropdown = document.getElementById('menuDropdown');

    menuBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        menuDropdown.classList.toggle('hidden');
    });

    window.addEventListener('click', (e) => {
        if (!menuBtn.contains(e.target) && !menuDropdown.contains(e.target)) {
            menuDropdown.classList.add('hidden');
        }
    });

    const filterButtons = document.querySelectorAll('.filter-btn');
    const hewanItems = document.querySelectorAll('.hewan-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const filter = button.getAttribute('data-filter');

            hewanItems.forEach(item => {
                if (filter === 'Semua' || item.getAttribute('data-jenis') === filter) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        });
    });
</script>

</body>
</html>
