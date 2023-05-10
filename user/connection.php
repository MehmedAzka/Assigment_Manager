<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'db_school';
    
    $conn = mysqli_connect($host, $user, $password, $db);
    if ($conn->connect_error) {
		die("Koneksi gagal: " . $conn->connect_error);
	}

    mysqli_select_db($conn, $db);
?>