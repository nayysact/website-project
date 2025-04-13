<?php
session_start();
include 'koneksi.php';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($nama) || empty($email) || empty($password)) {
        $error = "Semua kolom wajib diisi!";
    } elseif (strlen($password) < 8) {
        $error = "Password minimal 8 karakter!";
    } else {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $role = "user";

        $check = $conn->query("SELECT * FROM pengguna WHERE email='$email'");
        if ($check->num_rows > 0) {
            $error = "Email sudah digunakan!";
        } else {
            $sql = "INSERT INTO pengguna (nama, email, password, role) VALUES ('$nama', '$email', '$password_hashed', '$role')";
            if ($conn->query($sql) === TRUE) {
                $success = "Registrasi berhasil! Silakan login.";
            } else {
                $error = "Terjadi kesalahan, coba lagi!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AdoptMe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#8b5e34] flex items-center justify-center h-screen">
    <div class="bg-white p-10 rounded-lg shadow-lg w-[450px] text-center relative">
        <!-- Tombol Close (X) -->
        <button onclick="window.location.href='index.php'" class="absolute top-3 right-3 text-gray-600 text-2xl font-bold hover:text-gray-800">&times;</button>
        
        <h2 class="text-3xl font-semibold text-gray-700 mb-6">Daftar <span class="text-[#8b5e34]">AdoptMe</span></h2>
        
        <?php if (!empty($error)): ?>
            <p class="text-red-500 text-sm mb-2">⚠️ <?= $error; ?></p>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <script>
                alert("<?= $success; ?>");
                window.location.href = "login.php";
            </script>
        <?php endif; ?>

        <form method="POST" class="flex flex-col space-y-4">
            <input type="text" name="nama" placeholder="Nama Lengkap" required 
            class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34]">
            <input type="email" name="email" placeholder="Masukkan Email" required 
                   class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34]">
            <input type="password" name="password" placeholder="Password (min 8 karakter)" required 
            class="px-4 py-3 border border-[#8b5e34] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b5e34]">
            <button type="submit" class="bg-[#8b5e34] text-white py-3 rounded-lg text-lg font-semibold hover:bg-[#71492a] transition">Daftar</button>
        </form>
        
        <p class="text-sm text-gray-600 mt-4">Sudah punya akun? <a href="login.php" class="text-[#8b5e34] font-semibold">Login di sini</a></p>
    </div>
</body>
</html>