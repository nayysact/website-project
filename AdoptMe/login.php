<?php
session_start();
include 'koneksi.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validasi format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "⚠️ Format email tidak valid!";
    } else {
        // Bersihkan input untuk mencegah SQL Injection
        $email = $conn->real_escape_string($email);

        // Gunakan prepared statements untuk keamanan
        $stmt = $conn->prepare("SELECT * FROM pengguna WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['nama'] = $row['nama'];

                // Daftar email yang diizinkan jadi admin
                $allowed_admins = ['admin@adoptme.com'];

                if (in_array($email, $allowed_admins)) {
                    $_SESSION['role'] = 'admin';
                    $redirect = "admin/dashboard.php"; // Admin masuk ke dashboard
                } else {
                    $_SESSION['role'] = 'pengguna';
                    $redirect = "index.php"; // Pengguna biasa ke halaman utama
                }

                $success = "✅ Login berhasil!";
                echo "<script>
                        setTimeout(function() {
                            window.location.href = '$redirect';
                        }, 2000);
                      </script>";
            } else {
                $error = "⚠️ Password salah!";
            }
        } else {
            $error = "⚠️ Email tidak ditemukan!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AdoptMe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#8b5e34] flex items-center justify-center h-screen">
    
    <div class="bg-white p-10 rounded-lg shadow-lg w-[450px] text-center relative">
        <!-- Tombol Close (X) -->
        <button onclick="window.location.href='index.php'" class="absolute top-3 right-3 text-gray-600 text-2xl font-bold hover:text-gray-800">&times;</button>
        
        <h2 class="text-3xl font-semibold text-gray-700 mb-6">Login<span class="text-[#8b5e34]"> AdoptMe</span></h2>

        <!-- Pesan Error -->
        <?php if (!empty($error)): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <!-- Pesan Sukses -->
        <?php if (!empty($success)): ?>
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
                <?= $success; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" class="flex flex-col space-y-4">
            <input type="email" name="email" placeholder="Masukkan Email" required 
                   class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34]">
            <input type="password" name="password" placeholder="Masukkan Password" required 
                   class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34]">
            <button type="submit" class="bg-[#8b5e34] text-white py-3 rounded-lg text-lg font-semibold hover:bg-[#71492a] transition">Login</button>
        </form>
        
        <p class="text-md text-gray-600 mt-5">Belum punya akun? <a href="register.php" class="text-[#8b5e34] font-semibold">Daftar di sini</a></p>
    </div>
</body>
</html>
