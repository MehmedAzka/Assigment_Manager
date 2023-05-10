<?php
include 'function.php';
session_start();

if (isset($_POST['action'])) {
    if ($_POST['action'] == "add") {

        $succeed = add_data($_POST, $_FILES);

        if ($succeed) {
            $_SESSION['ex'] = "Data Added Successfully";
            header("location: page.php");
        } else {
            echo $succeed;
        }

    } else if ($_POST['action'] == "edit") {

        $succeed = change_data($_POST, $_FILES);

        if ($succeed) {
            $_SESSION['ex'] = "Data Edited Successfully";
            header("location: page.php");
        } else {
            echo $succeed;
        }
    }
}

if (isset($_GET['delete'])) {

    $succeed = delete_data($_GET);

    if ($succeed) {
        $_SESSION['ex'] = "Data Deleted Successfully";
        header("location: page.php");
    } else {
        echo $succeed;
    }
}
?>