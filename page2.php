<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdoptMe - Beranda</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Selamat Datang di AdoptMe</h1>
        <p>Platform adopsi hewan terlantar dengan kemudahan transaksi.</p>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="logout.php" class="btn">Logout</a>
        <?php else: ?>
            <a href="login.php" class="btn">Login</a>
            <a href="register.php" class="btn">Daftar</a>
        <?php endif; ?>
    </div>
</body>
</html>
