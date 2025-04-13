<?php
session_start();
include '../koneksi.php';

// Cek role admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// Approve Adopsi
if (isset($_GET['approve'])) {
    $id = $_GET['approve'];
    mysqli_query($conn, "UPDATE adopsi SET status='Disetujui' WHERE id=$id");

    // Update status hewan jadi Diadopsi
    $getHewan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT hewan_id FROM adopsi WHERE id=$id"));
    $hewan_id = $getHewan['hewan_id'];
    mysqli_query($conn, "UPDATE hewan SET status='Diadopsi' WHERE id=$hewan_id");

    header("Location: crud_adopsi.php");
    exit;
}

// Tolak Adopsi
if (isset($_GET['tolak'])) {
    $id = $_GET['tolak'];
    mysqli_query($conn, "UPDATE adopsi SET status='Ditolak' WHERE id=$id");
    header("Location: crud_adopsi.php");
    exit;
}

// Hapus Adopsi (opsional)
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM adopsi WHERE id=$id");
    header("Location: crud_adopsi.php");
    exit;
}

$query = "SELECT adopsi.*, pengguna.nama AS nama_user, hewan.nama AS nama_hewan
          FROM adopsi
          JOIN pengguna ON adopsi.pengguna_id = pengguna.id
          JOIN hewan ON adopsi.hewan_id = hewan.id
          ORDER BY adopsi.created_at DESC";

$adopsi = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD Adopsi - Admin</title>
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
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-bold mb-4">Daftar Pengajuan Adopsi</h2>

    <table class="w-full border">
        <thead>
            <tr class="bg-[#8b5e34] text-white">
                <th class="p-2 border">No</th>
                <th class="p-2 border">Nama User</th>
                <th class="p-2 border">Hewan</th>
                <th class="p-2 border">Tanggal Pengajuan</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($adopsi)) : ?>
            <tr class="border">
                <td class="p-2 border"><?= $no++; ?></td>
                <td class="p-2 border"><?= $row['nama_user']; ?></td>
                <td class="p-2 border"><?= $row['nama_hewan']; ?></td>
                <td class="p-2 border"><?= date('d-m-Y H:i', strtotime($row['created_at'])); ?></td>
                <td class="p-2 border">
                    <?php if ($row['status'] == 'Menunggu Konfirmasi') : ?>
                        <span class="text-yellow-500 font-bold"><?= $row['status']; ?></span>
                    <?php elseif ($row['status'] == 'Disetujui') : ?>
                        <span class="text-green-600 font-bold"><?= $row['status']; ?></span>
                    <?php else : ?>
                        <span class="text-red-600 font-bold"><?= $row['status']; ?></span>
                    <?php endif; ?>
                </td>
                <td class="p-2 border space-x-2">
                    <?php if ($row['status'] == 'Menunggu Konfirmasi') : ?>
                        <a href="crud_adopsi.php?approve=<?= $row['id']; ?>" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">Setujui</a>
                        <a href="crud_adopsi.php?tolak=<?= $row['id']; ?>" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Tolak</a>
                    <?php endif; ?>
                    <a href="crud_adopsi.php?hapus=<?= $row['id']; ?>" onclick="return confirm('Yakin hapus adopsi ini?')" class="bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600">Hapus</a>
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
