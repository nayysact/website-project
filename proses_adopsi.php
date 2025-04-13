<?php
include 'koneksi.php';

// Ambil data dari form
$nama_lengkap = $_POST['nama_lengkap'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$alasan = $_POST['alasan'];
$hewan_id = $_POST['hewan_id'];

// Simpan data ke tabel adopsi
$query = "INSERT INTO adopsi (nama_lengkap, email, alamat, created_at, status, hewan_id)
          VALUES ('$nama_lengkap', '$email', '$alamat', NOW(), 'diproses', '$hewan_id')";

if (mysqli_query($conn, $query)) {
    // Tampilkan pop-up dan redirect
    echo '
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Proses Adopsi</title>
        <script>
            // Fungsi dijalankan saat halaman dimuat
            window.onload = function() {
                document.getElementById("popup").style.display = "flex";
                setTimeout(function() {
                    window.location.href = "hewan.php";
                }, 2000);
            }
        </script>
        <style>
            #popup {
                display: none;
                position: fixed;
                top: 0; left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                justify-content: center;
                align-items: center;
                font-family: sans-serif;
                z-index: 9999;
            }
            #popup-content {
                background-color: white;
                padding: 30px 50px;
                border-radius: 10px;
                text-align: center;
                box-shadow: 0 0 15px rgba(0,0,0,0.3);
                font-size: 1.2rem;
                color: #4a2c1f;
            }
        </style>
    </head>
    <body>
        <div id="popup">
            <div id="popup-content">Proses adopsi sedang diproses...</div>
        </div>
    </body>
    </html>';
} else {
    echo "<script>
        alert('Terjadi kesalahan saat menyimpan data.');
        window.history.back();
    </script>";
}
?>
