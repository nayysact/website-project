<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $usia = $_POST['usia'];
    $status = $_POST['status'];
    $deskripsi = $_POST['deskripsi'];

    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $gambar_size = $_FILES['gambar']['size'];
    $gambar_error = $_FILES['gambar']['error'];

    $upload_dir = "../uploads/";
    $gambar_ext = pathinfo($gambar, PATHINFO_EXTENSION);
    $gambar_name = uniqid('hewan_', true) . '.' . $gambar_ext;
    $upload_path = $upload_dir . $gambar_name;

    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array(strtolower($gambar_ext), $allowed_ext)) {
        $error = "Hanya file gambar dengan ekstensi JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
    }

    if ($gambar_size > 5 * 1024 * 1024) {
        $error = "Ukuran file gambar terlalu besar. Maksimal 5MB.";
    }

    if (!isset($error)) {
        if (move_uploaded_file($gambar_tmp, $upload_path)) {
            $query = "INSERT INTO hewan (nama, jenis, jenis_kelamin, usia, status, deskripsi, gambar)
                      VALUES ('$nama', '$jenis', '$jenis_kelamin', '$usia', '$status', '$deskripsi', '$gambar_name')";
            if (mysqli_query($conn, $query)) {
                $_SESSION['flash_message'] = "Hewan berhasil ditambahkan.";
                header("Location: crud_hewan.php");
                exit;
            } else {
                $error = "Gagal menambahkan hewan: " . mysqli_error($conn);
            }
        } else {
            $error = "Upload gambar gagal.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Hewan - Admin AdoptMe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-[#8b5e34] text-white py-4 shadow-md">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Tambah Hewan</h1>
        <div class="flex items-center space-x-4">
            <a href="crud_hewan.php" class="bg-white text-[#8b5e34] px-4 py-2 rounded-lg">Kembali</a>
            <a href="logout.php" class="bg-white text-[#8b5e34] px-4 py-2 rounded-lg">Logout</a>
        </div>
    </div>
</nav>

<div class="container mx-auto px-6 py-10">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-[#8b5e34] mb-6">Form Tambah Hewan</h2>

        <?php if (isset($error)): ?>
            <div class="mb-6 bg-red-100 text-red-700 border border-red-300 px-4 py-3 rounded">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data" class="space-y-5">
            <div>
                <label for="nama" class="block font-medium mb-1">Nama Hewan</label>
                <input type="text" name="nama" id="nama" class="w-full border rounded-lg p-2" required>
            </div>
            <div>
                <label for="jenis" class="block font-medium mb-1">Jenis</label>
                <input type="text" name="jenis" id="jenis" class="w-full border rounded-lg p-2" required>
            </div>
            <div>
                <label for="jenis_kelamin" class="block font-medium mb-1">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="w-full border rounded-lg p-2" required>
                    <option value="">-- Pilih --</option>
                    <option value="Jantan">Jantan</option>
                    <option value="Betina">Betina</option>
                </select>
            </div>
            <div>
                <label for="usia" class="block font-medium mb-1">Usia (dalam tahun)</label>
                <input type="number" name="usia" id="usia" class="w-full border rounded-lg p-2" required min="0">
            </div>
            <div>
                <label for="status" class="block font-medium mb-1">Status</label>
                <select name="status" id="status" class="w-full border rounded-lg p-2" required>
                    <option value="">-- Pilih --</option>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Diadopsi">Diadopsi</option>
                </select>
            </div>
            <div>
                <label for="deskripsi" class="block font-medium mb-1">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full border rounded-lg p-2" placeholder="Tulis deskripsi singkat tentang hewan..." required></textarea>
            </div>
            <div>
                <label for="gambar" class="block font-medium mb-1">Upload Gambar</label>
                <input type="file" name="gambar" id="gambar" class="w-full border rounded-lg p-2 bg-white" accept="image/*" onchange="previewImage(event)" required>
                <div class="mt-4">
                    <img id="preview" src="#" alt="Preview Gambar" class="w-40 h-40 object-cover rounded-lg shadow hidden">
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" name="submit" class="bg-[#8b5e34] text-white px-6 py-2 rounded-lg shadow hover:bg-[#6b3f21]">
                    Tambah Hewan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');
    }
}
</script>

</body>
</html>
