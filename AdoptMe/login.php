<?php
session_start();
include 'koneksi.php';

$error = "";

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
                $_SESSION['role'] = $row['role'];
                $_SESSION['nama'] = $row['nama']; // Pastikan ini ada

                if ($row['role'] == 'admin') {
                    header("Location: dashboard_admin.php");
                } else {
                    header("Location: index.php");
                }
                exit();
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
<body class="bg-amber-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96 text-center">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Login ke <span class="text-[#8b5e34]">AdoptMe</span></h2>
        
        <?php if (isset($error) && $error): ?>
            <p class="text-red-500 text-sm mb-2">⚠️ <?= $error; ?></p>
        <?php endif; ?>
        
        <form method="POST" class="flex flex-col space-y-3">
            <input type="email" name="email" placeholder="Masukkan Email" required 
                   class="px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-[#8b5e34]">
            <input type="password" name="password" placeholder="Masukkan Password" required 
                   class="px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-[#8b5e34]">
            <button type="submit" class="bg-[#8b5e34] text-white py-2 rounded hover:bg-[#71492a] transition">Login</button>
        </form>
        
        <p class="text-sm text-gray-600 mt-4">Belum punya akun? <a href="register.php" class="text-[#8b5e34] font-semibold">Daftar di sini</a></p>
    </div>
</body>
</html>

