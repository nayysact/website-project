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
<body class="bg-[#f4dfc8] text-gray-900">

<!-- Navbar -->
<nav class="bg-[#8b5e34] text-white py-4 shadow-md relative">
    <div class="container mx-auto flex justify-between items-center px-6">
        <a href="index.php" class="text-2xl font-bold">AdoptMe</a>
        <div class="space-x-6 flex items-center">
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
<header class="bg-[#8b5e34] shadow-md py-6 text-white text-center">
    <h1 class="text-3xl font-bold">Temukan Sahabat Barumu</h1>
    <p>Berikan mereka rumah yang penuh kasih 💕</p>
</header>

    <div class="container mx-auto mt-6 text-center">
        <h2 class="text-2xl font-semibold">Filter Hewan</h2>
        <div class="flex justify-center gap-4 mt-4">
            <button class="px-4 py-2 bg-[#8b5e34] text-white rounded-lg">Anjing</button>
            <button class="px-4 py-2 bg-[#8b5e34] text-white rounded-lg">Kucing</button>
            <button class="px-4 py-2 bg-[#8b5e34] text-white rounded-lg">Kelinci</button>
        </div>
    </div>
    
    <!-- Daftar Hewan -->
    <section class="container mx-auto mt-8 grid grid-cols-1 md:grid-cols-3 gap-6 px-6">
        <div class="bg-white p-4 rounded-lg shadow-md flex flex-col h-full">
            <img src="img/ku.jpg" alt="Kucing" class="rounded-md w-full">
            <h3 class="text-xl font-semibold mt-2">Camel</h3>
            <p class="text-gray-600 flex-grow">Kucing betina, 2 tahun, sangat ramah dan suka bermain.</p>
            <button class="mt-4 bg-[#8b5e34] text-white px-4 py-2 rounded-lg w-full" onclick="openModal('Camel', 'Kucing Betina', '2 tahun', 'Ramah & suka bermain')">Adopsi</button>
        </div>
        
        <div class="bg-white p-4 rounded-lg shadow-md flex flex-col h-full">
            <img src="img/a1.jpg" alt="Anjing" class="rounded-md w-full">
            <h3 class="text-xl font-semibold mt-2">Jio</h3>
            <p class="text-gray-600 flex-grow">Anjing jantan, 3 tahun, setia dan mudah dilatih.</p>
            <button class="mt-4 bg-[#8b5e34] text-white px-4 py-2 rounded-lg w-full" onclick="openModal('Jio', 'Anjing Jantan', '3 tahun', 'Setia dan mudah dilatih')">Adopsi</button>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-md flex flex-col h-full">
            <img src="img/K1.jpg" alt="Kelinci" class="rounded-md w-full">
            <h3 class="text-xl font-semibold mt-2">Lili</h3>
            <p class="text-gray-600 flex-grow">Kelinci betina, 1 tahun, lembut dan suka bermain.</p>
            <button class="mt-4 bg-[#8b5e34] text-white px-4 py-2 rounded-lg w-full" onclick="openModal('Lili', 'Kelinci Betina', '1 tahun', 'Lembut & suka bermain')">Adopsi</button>
        </div>
    </section>
    
    <!-- Modal Pop-up Detail Hewan -->
    <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md">
            <h3 class="text-xl font-semibold" id="modal-title">Detail Hewan</h3>
            <p class="text-gray-600 mt-2" id="modal-type"></p>
            <p class="text-gray-600" id="modal-age"></p>
            <p class="text-gray-600" id="modal-traits"></p>
            <button class="mt-4 bg-red-600 text-white px-4 py-2 rounded-lg" onclick="closeModal()">Tutup</button>
        </div>
    </div>

    <!-- Artikel Edukasi -->
    <section class="container mx-auto mt-12 px-6">
        <h2 class="text-2xl font-semibold text-center">Artikel Edukasi</h2>
        <div class="bg-white p-6 rounded-lg shadow-md mt-6">
            <h3 class="text-xl font-bold">Cara Merawat Hewan Adopsi</h3>
            <p class="text-gray-600 mt-2">Sebelum mengadopsi hewan, pastikan Anda memiliki tempat yang nyaman dan makanan yang sesuai.</p>
        </div>
    </section>
    
    <!-- Testimoni Pengadopsi -->
    <section class="container mx-auto mt-12 px-6">
        <h2 class="text-2xl font-semibold text-center">Testimoni Pengadopsi</h2>
        <div class="bg-white p-6 rounded-lg shadow-md mt-6">
            <p class="text-gray-600 italic">"Saya selalu ingin memiliki kucing, tetapi ragu karena takut tidak bisa merawatnya dengan baik. Setelah mengadopsi Momo melalui AdoptMe, saya menyadari betapa menyenangkannya memiliki teman berbulu di rumah. Dia sangat penyayang dan selalu menemani saya saat bekerja. Terima kasih kepada pengasuh sebelumnya yang telah merawatnya dengan baik sebelum saya adopsi!"</p>
            <p class="text-right text-sm font-semibold">- Naya, Pengadopsi Kucing Persia </p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md mt-6">
            <p class="text-gray-600 italic">"Mengadopsi kelinci adalah keputusan terbaik yang pernah saya buat! Bubu sangat menggemaskan dan cepat beradaptasi di rumah. Dia suka melompat-lompat di sekitar saya dan sangat aktif saat pagi hari. Awalnya saya pikir merawat kelinci sulit, tapi ternyata cukup mudah selama kita memahami kebutuhannya. Saya sangat bersyukur bisa memberikan rumah baru untuk Bubu!"</p>
            <p class="text-right text-sm font-semibold">- Balqis, Pengadopsi Kelinci Holland Lop </p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md mt-6">
            <p class="text-gray-600 italic">"Saya mengadopsi Max, seekor anjing golden retriever, melalui AdoptMe satu tahun lalu. Awalnya dia pemalu dan takut dengan lingkungan baru, tetapi dengan kasih sayang dan kesabaran, dia berubah menjadi anjing yang ceria dan setia. Mengadopsi anjing memberikan kebahagiaan luar biasa bagi saya dan keluarga!"</p>
            <p class="text-right text-sm font-semibold">- Rania, Pengadopsi Anjing Golden Retriever </p>
        </div>
    </section>

    <!-- Galeri Adopsi Berhasil -->
    <section class="container mx-auto mt-12 px-6">
        <h2 class="text-2xl font-semibold text-center">Galeri Adopsi Berhasil</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
            <img src="img/a1.jpg" class="rounded-md shadow-md">
            <img src="img/ku.jpg" class="rounded-md shadow-md">
            <img src="img/K1.jpg" class="rounded-md shadow-md">
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-[#5a3d2b] text-white text-center py-6 mt-12">
        <p>&copy; 2025 AdoptMe | Semua Dilindungi Hak Cipta</p>
    </footer>

    <!-- Tombol Chat WhatsApp -->
    <a href="https://wa.me/62812118001" class="fixed bottom-6 right-6 bg-green-500 text-white px-4 py-2 rounded-full shadow-lg">
        Chat via WhatsApp
    </a>

    <!-- Script Modal -->
    <script>
        function openModal(name, type, age, traits) {
            document.getElementById('modal-title').innerText = name;
            document.getElementById('modal-type').innerText = 'Jenis: ' + type;
            document.getElementById('modal-age').innerText = 'Usia: ' + age;
            document.getElementById('modal-traits').innerText = 'Karakteristik: ' + traits;
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>

</body>
</html>