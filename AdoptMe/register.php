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
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>
<body class="bg-amber-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96 text-center">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Daftar ke <span class="text-[#8b5e34]">AdoptMe</span></h2>
        
        <?php if (!empty($error)): ?>
            <p class="text-red-500 text-sm mb-2">⚠️ <?= $error; ?></p>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <script>
                showAlert("<?= $success; ?>");
                window.location.href = "login.php";
            </script>
        <?php endif; ?>

        <form method="POST" class="flex flex-col space-y-3">
            <input type="text" name="nama" placeholder="Nama Lengkap" required 
                   class="px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-[#8b5e34]">
            <input type="email" name="email" placeholder="Email" required 
                   class="px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-[#8b5e34]">
            <input type="password" name="password" placeholder="Password (min 8 karakter)" required 
                   class="px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-[#8b5e34]">
            <button type="submit" class="bg-[#8b5e34] text-white py-2 rounded hover:bg-[#71492a] transition">Daftar</button>
        </form>
        
        <p class="text-sm text-gray-600 mt-4">Sudah punya akun? <a href="login.php" class="text-[#8b5e34] font-semibold">Login di sini</a></p>
    </div>
</body>
</html>
