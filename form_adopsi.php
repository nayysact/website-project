<?php
include 'koneksi.php';
include 'navbar.php';

$hewan_id = isset($_GET['hewan_id']) ? (int)$_GET['hewan_id'] : 0;

// Ambil data hewan berdasarkan ID
$query = "SELECT * FROM hewan WHERE id = $hewan_id LIMIT 1";
$result = mysqli_query($conn, $query);
$hewan = mysqli_fetch_assoc($result);

if (!$hewan) {
    echo "<div class='text-center mt-10 text-red-600 font-semibold'>Hewan tidak ditemukan.</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Adopsi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<section class="container mx-auto px-6 py-12">
    <div class="max-w-3xl mx-auto bg-white border border-[#8b5e34] p-8 rounded-xl shadow-md">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-[#4a2c1f]">Formulir Adopsi</h2>
            <p class="text-gray-700 mt-1">Lengkapi data berikut untuk mengadopsi <span class="font-semibold text-[#8b5e34]"><?= htmlspecialchars($hewan['nama']) ?></span>.</p>
        </div>

        <div class="flex items-center gap-4 mb-6">
            <img src="uploads/<?= htmlspecialchars($hewan['gambar']) ?>" alt="<?= htmlspecialchars($hewan['nama']) ?>" class="w-28 h-28 object-cover rounded-md border">
            <div>
                <p class="text-lg font-bold text-[#8b5e34]"><?= htmlspecialchars($hewan['nama']) ?></p>
                <p class="text-gray-600 text-sm"><?= htmlspecialchars($hewan['jenis']) ?> - <?= htmlspecialchars($hewan['jenis_kelamin']) ?> - <?= htmlspecialchars($hewan['usia']) ?> tahun</p>
            </div>
        </div>

        <form action="proses_adopsi.php" method="POST" class="space-y-5" onsubmit="showPopup()">
            <input type="hidden" name="hewan_id" value="<?= $hewan_id ?>">

            <div>
                <label for="nama_lengkap" class="block font-medium">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="w-full p-2 border rounded-md" required>
            </div>

            <div>
                <label for="email" class="block font-medium">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 border rounded-md" required>
            </div>

            <div>
                <label for="alamat" class="block font-medium">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" class="w-full p-2 border rounded-md" rows="3" required></textarea>
            </div>

            <div>
                <label for="alasan" class="block font-medium">Mengapa ingin mengadopsi?</label>
                <textarea id="alasan" name="alasan" class="w-full p-2 border rounded-md" rows="4" required></textarea>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-[#8b5e34] text-white px-6 py-2 rounded-lg hover:bg-[#6b3f21] transition">Kirim</button>
            </div>
        </form>
    </div>
</section>

<!-- Popup Proses -->
<div id="popup" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-md text-center">
        <h3 class="text-xl font-semibold text-[#4a2c1f]">Proses Adopsi Sedang Diproses...</h3>
        <p class="mt-2 text-gray-600">Mohon tunggu sebentar, kami sedang memproses permintaan Anda.</p>
    </div>
</div>

</body>
</html>
