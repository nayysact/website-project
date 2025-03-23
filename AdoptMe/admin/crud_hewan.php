<?php
session_start();
include '../koneksi.php';

// Cek apakah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Hewan - Admin AdoptMe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- ===== NAVBAR ===== -->
<nav class="bg-[#8b5e34] text-white py-4 shadow-md">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Kelola Hewan</h1>
        <div class="flex items-center space-x-4">
            <a href="dashboard_admin.php" class="bg-white text-[#8b5e34] px-4 py-2 rounded-lg">Dashboard</a>
            <a href="../logout.php" class="bg-white text-[#8b5e34] px-4 py-2 rounded-lg">Logout</a>
        </div>
    </div>
</nav>

<!-- ===== ISI CRUD ===== -->
<div class="container mx-auto px-6 py-10">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-[#8b5e34]">Daftar Hewan</h2>
        <a href="tambah_hewan.php" class="bg-[#8b5e34] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#6b3f21]">Tambah Hewan</a>
    </div>

    <!-- Tabel Hewan -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <table class="min-w-full border-collapse border border-gray-300">
            <thead class="bg-[#8b5e34] text-white">
                <tr>
                    <th class="border p-2">No</th>
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">Jenis</th>
                    <th class="border p-2">Kelamin</th>
                    <th class="border p-2">Usia</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = "SELECT * FROM hewan";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) :
                    while ($row = mysqli_fetch_assoc($result)) :
                ?>
                <tr class="border-t text-center">
                    <td class="p-2 border"><?= $no++; ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($row['nama']); ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($row['jenis']); ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($row['jenis_kelamin']); ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($row['usia']); ?> Tahun</td>
                    <td class="p-2 border"><?= htmlspecialchars($row['status']); ?></td>
                    <td class="p-2 border">
                        <a href="edit_hewan.php?id=<?= $row['id']; ?>" class="text-blue-500 hover:underline">Edit</a> |
                        <a href="hapus_hewan.php?id=<?= $row['id']; ?>" class="text-red-500 hover:underline" onclick="return confirm('Yakin ingin menghapus hewan ini?');">Hapus</a>
                    </td>
                </tr>
                <?php
                    endwhile;
                else :
                ?>
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">Belum ada data hewan.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Tombol Kembali -->
    <div class="mt-6">
    <a href="dashboard.php" class="inline-block bg-[#8b5e34] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#6b3f21]">
    Kembali ke Dashboard</a>
    </div>

</div>

</body>
</html>
