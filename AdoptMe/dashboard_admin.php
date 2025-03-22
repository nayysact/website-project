<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>
<h2>Selamat Datang, Admin!</h2>
<a href="logout.php">Logout</a>
