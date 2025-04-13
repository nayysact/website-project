<?php
session_start();
include '../koneksi.php';

// Cek apakah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// ================== AMBIL DATA UNTUK STATISTIK ==================

// Data Total User (role user saja)
$total_users = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pengguna WHERE role = 'user'"));

// Data Total Hewan
$total_hewan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hewan"));

// Data Total Adopsi
$total_adopsi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM adopsi"));

// Data Pie Chart: Status Adopsi
$adopsi_menunggu = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM adopsi WHERE status='Menunggu Konfirmasi'"));
$adopsi_disetujui = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM adopsi WHERE status='Disetujui'"));
$adopsi_ditolak   = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM adopsi WHERE status='Ditolak'"));

// Data Bar Chart: Adopsi per Bulan
$bulan = [];
$jumlah_adopsi = [];
for ($i = 1; $i <= 12; $i++) {
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM adopsi WHERE MONTH(created_at) = $i");
    $data = mysqli_fetch_assoc($result);
    $bulan[] = date("F", mktime(0, 0, 0, $i, 10)); // Nama bulan
    $jumlah_adopsi[] = $data['total'];
}

// Data Donut Chart: Jenis Hewan Diadopsi
$jenis = ['Kucing', 'Anjing', 'Kelinci'];
$jumlah_jenis = [];
foreach ($jenis as $j) {
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM hewan WHERE jenis='$j' AND status='Diadopsi'");
    $data = mysqli_fetch_assoc($result);
    $jumlah_jenis[] = $data['total'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - AdoptMe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">

<!-- ====== NAVBAR / HEADER ====== -->
<div class="bg-[#8b5e34] text-white py-4 shadow-md">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Dashboard Admin</h1>
        <div class="flex items-center space-x-4">
            <span>Halo, <?= $_SESSION['nama']; ?></span>
            <a href="../logout.php" class="bg-white text-[#8b5e34] px-4 py-2 rounded-lg">Logout</a>
        </div>
    </div>
</div>

<!-- ====== ISI DASHBOARD ====== -->
<div class="container mx-auto px-6 py-10">

    <!-- Ringkasan Data -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <h2 class="text-4xl font-bold text-[#8b5e34]"><?= $total_users ?></h2>
            <p class="text-gray-600">Total Pengguna</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <h2 class="text-4xl font-bold text-[#8b5e34]"><?= $total_hewan ?></h2>
            <p class="text-gray-600">Total Hewan</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <h2 class="text-4xl font-bold text-[#8b5e34]"><?= $total_adopsi ?></h2>
            <p class="text-gray-600">Total Adopsi</p>
        </div>
    </div>

    <!-- Pie Chart - Status Adopsi -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-10 text-center">
        <h2 class="text-xl font-bold text-[#8b5e34] mb-4">Statistik Status Adopsi</h2>
        <div class="flex justify-center">
            <canvas id="pieChart" class="max-w-[400px]"></canvas>
        </div>
    </div>

    <!-- Bar Chart - Adopsi per Bulan -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-10 text-center">
        <h2 class="text-xl font-bold text-[#8b5e34] mb-4">Jumlah Adopsi per Bulan</h2>
        <div class="flex justify-center">
            <canvas id="barChart" class="max-w-[600px] h-[400px]"></canvas>
        </div>
    </div>

    <!-- Donut Chart - Jenis Hewan Diadopsi -->
    <div class="bg-white p-6 rounded-lg shadow-md text-center">
        <h2 class="text-xl font-bold text-[#8b5e34] mb-4">Jenis Hewan yang Diadopsi</h2>
        <div class="flex justify-center">
            <canvas id="donutChart" class="max-w-[400px]"></canvas>
        </div>
    </div>

    <!-- CRUD Link -->
    <div class="mt-10 flex gap-4 justify-center">
        <a href="crud_hewan.php" class="bg-[#8b5e34] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#6b3f21]">Kelola Hewan</a>
        <a href="crud_adopsi.php" class="bg-[#8b5e34] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#6b3f21]">Kelola Adopsi</a>
    </div>

</div>

<!-- ====== CHART SCRIPT ====== -->
<script>
    // PIE CHART - STATUS ADOPSI
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Menunggu Konfirmasi', 'Disetujui', 'Ditolak'],
            datasets: [{
                data: [<?= $adopsi_menunggu ?>, <?= $adopsi_disetujui ?>, <?= $adopsi_ditolak ?>],
                backgroundColor: ['#facc15', '#22c55e', '#ef4444'],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // BAR CHART - ADOPSI PER BULAN
    const barCtx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($bulan) ?>,
            datasets: [{
                label: 'Jumlah Adopsi',
                data: <?= json_encode($jumlah_adopsi) ?>,
                backgroundColor: '#8b5e34'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // DONUT CHART - JENIS HEWAN DIADOPSI
    const donutCtx = document.getElementById('donutChart').getContext('2d');
    const donutChart = new Chart(donutCtx, {
        type: 'doughnut',
        data: {
            labels: <?= json_encode($jenis) ?>,
            datasets: [{
                data: <?= json_encode($jumlah_jenis) ?>,
                backgroundColor: ['#f97316', '#3b82f6', '#22c55e'],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>

</body>
</html>
