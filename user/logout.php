<?php
session_start();

// Menghapus semua variabel session
session_unset();

// Menghancurkan session
session_destroy();

// Mencegah cache halaman sebelumnya
header("Cache-Control: no-cache, no-store, must-revalidate");

// Mencegah penyimpanan cache
header("Pragma: no-cache");

// Mencegah cache di proxy server
header("Expires: 0");

// Mengarahkan pengguna kembali ke halaman login
header('Location: ../index.php');
exit();
?>
