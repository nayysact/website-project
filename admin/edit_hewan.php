<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: crud_hewan.php");
    exit;
}

$id = $_GET['id'];
$query = "SELECT * FROM hewan WHERE id = $id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) !== 1) {
    header("Location: crud_hewan.php");
    exit;
}

$hewan = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $usia = $_POST['usia'];
    $status = $_POST['status'];

    // Periksa apakah gambar baru diupload
    if ($_FILES['gambar']['error'] === 0) {
        $gambar = $_FILES['gambar']['name'];
        $gambar_tmp = $_FILES['gambar']['tmp_name'];
        $upload_path = "../uploads/" . $gambar;
        
        // Pindahkan gambar yang diupload ke folder uploads
        if (move_uploaded_file($gambar_tmp, $upload_path)) {
            // Jika berhasil, gunakan gambar baru
        } else {
            $error = "Gagal mengupload gambar.";
        }
    } else {
        // Jika tidak ada gambar baru, gunakan gambar lama
        $gambar = $hewan['gambar'];
    }

    // Update data hewan
    $update = "UPDATE hewan SET 
                nama='$nama', 
                jenis='$jenis', 
                jenis_kelamin='$jenis_kelamin', 
                usia='$usia', 
                status='$status', 
                gambar='$gambar' 
               WHERE id=$id";

    if (mysqli_query($conn, $update)) {
        $_SESSION['flash_message'] = "Data hewan berhasil diperbarui.";
        header("Location: crud_hewan.php");
        exit;
    } else {
        $error = "Gagal memperbarui data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Hewan - Admin AdoptMe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-[#8b5e34] text-white py-4 shadow-md">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Edit Hewan</h1>
        <div class="flex items-center space-x-4">
            <a href="crud_hewan.php" class="bg-white text-[#8b5e34] px-4 py-2 rounded-lg">Kembali</a>
            <a href="logout.php" class="bg-white text-[#8b5e34] px-4 py-2 rounded-lg">Logout</a>
        </div>
    </div>
</nav>

<!-- FORM EDIT -->
<div class="container mx-auto px-6 py-10">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-[#8b5e34] mb-6">Form Edit Hewan</h2>

        <?php if (isset($error)): ?>
            <div class="mb-6 bg-red-100 text-red-700 border border-red-300 px-4 py-3 rounded">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data" class="space-y-5">
            <div>
                <label for="nama" class="block font-medium mb-1">Nama Hewan</label>
                <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($hewan['nama']) ?>" class="w-full border rounded-lg p-2" required>
            </div>
            <div>
                <label for="jenis" class="block font-medium mb-1">Jenis</label>
                <input type="text" name="jenis" id="jenis" value="<?= htmlspecialchars($hewan['jenis']) ?>" class="w-full border rounded-lg p-2" required>
            </div>
            <div>
                <label for="jenis_kelamin" class="block font-medium mb-1">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="w-full border rounded-lg p-2" required>
                    <option value="Jantan" <?= $hewan['jenis_kelamin'] == 'Jantan' ? 'selected' : '' ?>>Jantan</option>
                    <option value="Betina" <?= $hewan['jenis_kelamin'] == 'Betina' ? 'selected' : '' ?>>Betina</option>
                </select>
            </div>
            <div>
                <label for="usia" class="block font-medium mb-1">Usia (dalam tahun)</label>
                <input type="number" name="usia" id="usia" value="<?= htmlspecialchars($hewan['usia']) ?>" class="w-full border rounded-lg p-2" required min="0">
            </div>
            <div>
                <label for="status" class="block font-medium mb-1">Status</label>
                <select name="status" id="status" class="w-full border rounded-lg p-2" required>
                    <option value="Tersedia" <?= $hewan['status'] == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                    <option value="Diadopsi" <?= $hewan['status'] == 'Diadopsi' ? 'selected' : '' ?>>Diadopsi</option>
                </select>
            </div>
            <div>
                <label for="gambar" class="block font-medium mb-1">Ganti Gambar (opsional)</label>
                <input type="file" name="gambar" id="gambar" class="w-full border rounded-lg p-2 bg-white" accept="image/*" onchange="previewImage(event)">
                <div class="mt-4">
                    <img id="preview" src="../uploads/<?= htmlspecialchars($hewan['gambar']) ?>" alt="Gambar Hewan" class="w-40 h-40 object-cover rounded-lg shadow">
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" name="submit" class="bg-[#8b5e34] text-white px-6 py-2 rounded-lg shadow hover:bg-[#6b3f21]">
                    Simpan Perubahan
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
    }
}
</script>

</body>
</html>
