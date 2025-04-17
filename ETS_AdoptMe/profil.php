<?php
session_start();
require 'koneksi.php'; // Koneksi ke database

// Redirect jika belum login
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$user_email = $_SESSION['email'];

// Ambil data pengguna
$sqlUser = "SELECT id, nama, email, role FROM pengguna WHERE email = ?";
$stmtUser = $conn->prepare($sqlUser);
$stmtUser->bind_param('s', $user_email);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$user = $resultUser->fetch_assoc();

// Handle form update profil
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nama'])) {
    $nama_baru = $_POST['nama'];

    // Perbarui nama pengguna
    $sqlUpdate = "UPDATE pengguna SET nama = ? WHERE email = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("ss", $nama_baru, $user_email);
    if ($stmtUpdate->execute()) {
        // Set session flash message
        $_SESSION['flash_message'] = "Profil berhasil diperbarui!";
        $_SESSION['nama'] = $nama_baru;
        header("Location: profil.php"); // Refresh halaman untuk menampilkan pesan
        exit;
    }
}

// Ambil riwayat adopsi dengan status
$sqlAdop = "SELECT id, nama_lengkap, email, alamat, status FROM adopsi WHERE email = ?";
$stmtAdop = $conn->prepare($sqlAdop);
$stmtAdop->bind_param('s', $user_email);
$stmtAdop->execute();
$resultAdop = $stmtAdop->get_result();
$riwayat = $resultAdop->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya – AdoptMe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-neutral-50 text-gray-800">

<?php include 'navbar.php'; ?>

<main class="container mx-auto px-4 py-8">
    <!-- Notifikasi Flash Message -->
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            <?= $_SESSION['flash_message']; ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?> <!-- Menghapus flash message setelah ditampilkan -->
    <?php endif; ?>

    <!-- Profil -->
    <section class="bg-white rounded-2xl shadow p-6 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-700">Profil Saya</h2>
            <button onclick="document.getElementById('editForm').classList.toggle('hidden')" class="text-blue-600 hover:underline text-sm">Edit Profil</button>
        </div>

        <!-- Info Profil -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="font-medium text-gray-600">Username:</p>
                <p class="text-gray-800"><?= htmlspecialchars($user['nama']) ?></p>
            </div>
            <div>
                <p class="font-medium text-gray-600">Email:</p>
                <p class="text-gray-800"><?= htmlspecialchars($user['email']) ?></p>
            </div>
            <div>
                <p class="font-medium text-gray-600">Role:</p>
                <p class="text-gray-800 capitalize"><?= htmlspecialchars($user['role']) ?></p>
            </div>
        </div>

        <!-- Form Ubah Profil -->
        <form id="editForm" method="POST" class="mt-6 space-y-4 hidden">
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Username Baru</label>
                <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($user['nama']) ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-200" required>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-300">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </section>

    <!-- Riwayat Adopsi -->
    <section class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Riwayat Pengajuan Adopsi</h2>
        <?php if (count($riwayat) > 0): ?>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">#</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nama Lengkap</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Email</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Alamat</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    <?php foreach ($riwayat as $idx => $row): ?>
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-700"><?= $idx + 1 ?></td>
                        <td class="px-4 py-3 text-sm text-gray-700"><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                        <td class="px-4 py-3 text-sm text-gray-700"><?= htmlspecialchars($row['email']) ?></td>
                        <td class="px-4 py-3 text-sm text-gray-700"><?= htmlspecialchars($row['alamat']) ?></td>
                        <td class="px-4 py-3 text-sm text-gray-700"><?= htmlspecialchars($row['status']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <p class="text-gray-600">Belum ada riwayat pengajuan adopsi.</p>
        <?php endif; ?>
    </section>
</main>

</body>
</html>
