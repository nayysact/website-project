<?php
session_start();
include '../koneksi.php';

// Cek apakah pengguna adalah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// Approve Adopsi
if (isset($_GET['approve'])) {
    $id = $_GET['approve'];
    mysqli_query($conn, "UPDATE adopsi SET status='Disetujui' WHERE id=$id");

    // Opsional: Update status hewan menjadi Diadopsi
    mysqli_query($conn, "UPDATE hewan SET status='Diadopsi' WHERE id=(SELECT hewan_id FROM adopsi WHERE id=$id)");

    header("Location: crud_adopsi.php");
    exit;
}

// Tolak Adopsi
if (isset($_GET['tolak'])) {
    $id = $_GET['tolak'];
    mysqli_query($conn, "UPDATE adopsi SET status='Ditolak' WHERE id=$id");

    // Opsional: Update status hewan kembali ke Tersedia
    mysqli_query($conn, "UPDATE hewan SET status='Tersedia' WHERE id=(SELECT hewan_id FROM adopsi WHERE id=$id)");

    header("Location: crud_adopsi.php");
    exit;
}

// Ambil data adopsi dan nama hewan
$query = "SELECT a.*, h.nama AS nama_hewan FROM adopsi a 
          JOIN hewan h ON a.hewan_id = h.id 
          ORDER BY a.created_at DESC";
$adopsi = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Data Adopsi - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<!-- ===== NAVBAR ADMIN ===== -->
<nav class="bg-[#8b5e34] text-white py-4 shadow-md">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Kelola Data Adopsi</h1>
        <div class="flex items-center space-x-4">
            <a href="dashboard.php" class="bg-white text-[#8b5e34] px-4 py-2 rounded-lg">Dashboard</a>
            <a href="logout.php" class="bg-white text-[#8b5e34] px-4 py-2 rounded-lg">Logout</a>
        </div>
    </div>
</nav>

<!-- Tabel Data Adopsi -->
<div class="bg-white rounded-lg shadow-md p-6 mt-6">
    <h2 class="text-xl font-bold mb-4">Daftar Pengajuan Adopsi</h2>

    <table class="w-full border text-sm">
        <thead>
            <tr class="bg-[#8b5e34] text-white">
                <th class="p-2 border">No</th>
                <th class="p-2 border">Nama Pengguna</th>
                <th class="p-2 border">Nama Hewan</th>
                <th class="p-2 border">Alamat</th>
                <th class="p-2 border">Tanggal Pengajuan</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($adopsi)) : ?>
            <tr class="border hover:bg-gray-50">
                <td class="p-2 border text-center"><?= $no++; ?></td>
                <td class="p-2 border"><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                <td class="p-2 border"><?= htmlspecialchars($row['nama_hewan']); ?></td>
                <td class="p-2 border"><?= htmlspecialchars($row['alamat']); ?></td>
                <td class="p-2 border"><?= date('d-m-Y H:i', strtotime($row['created_at'])); ?></td>
                <td class="p-2 border text-center font-semibold">
                    <?php if ($row['status'] == 'Menunggu Konfirmasi') : ?>
                        <span class="text-yellow-500"><?= $row['status']; ?></span>
                    <?php elseif ($row['status'] == 'Disetujui') : ?>
                        <span class="text-green-600"><?= $row['status']; ?></span>
                    <?php else : ?>
                        <span class="text-red-600"><?= $row['status']; ?></span>
                    <?php endif; ?>
                </td>
                <td class="p-2 border text-center space-x-2">
                    <a href="crud_adopsi.php?approve=<?= $row['id']; ?>" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">Setujui</a>
                    <a href="crud_adopsi.php?tolak=<?= $row['id']; ?>" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Tolak</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<div class="mt-8">
    <a href="dashboard.php" class="bg-[#d9a36a] text-white px-4 py-2 rounded hover:bg-[#c48950]">Kembali ke Dashboard</a>
</div>

</body>
</html>
