<?php
include 'connection.php';
session_start();

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM tb_mail WHERE id_mail='$id'";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        header('location: comunication.php');
    } else {
        echo $query;
    }
}
?>