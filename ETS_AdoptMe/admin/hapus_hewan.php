<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil nama file gambar untuk dihapus dari folder
    $query = "SELECT gambar FROM hewan WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $data = mysqli_fetch_assoc($result);
        $gambar = $data['gambar'];

        // Hapus data dari database
        $delete = "DELETE FROM hewan WHERE id = $id";
        if (mysqli_query($conn, $delete)) {
            // Hapus gambar dari folder jika ada
            $gambar_path = "../uploads/" . $gambar;
            if (file_exists($gambar_path)) {
                unlink($gambar_path);
            }

            $_SESSION['flash_message'] = "Hewan berhasil dihapus.";
        } else {
            $_SESSION['flash_message'] = "Gagal menghapus data: " . mysqli_error($conn);
        }
    }
}

header("Location: crud_hewan.php");
exit;
