<?php
include 'connection.php';
function add_data($data, $files)
{
    $fn = $data['full_name'];
    $sin = $data['student_ident_num'];
    $gender = $data['gender'];
    $clss = $data['class'];
    $subjects = $data['subjects'];

    $split = explode('.', $files['file']['name']);
    $extention = $split[count($split) - 1];

    $upload_file = $fn . '.' . $extention;
    $notes = $data['notes'];
    $user_id = $_SESSION['user_id'];

    $dir = "../admin/file_manager/";
    $tmpFile = $files['file']['tmp_name'];

    move_uploaded_file($tmpFile, $dir . $upload_file);

    $query = "INSERT INTO tb_task_collection VALUES (null, '$sin', '$fn', '$clss', '$gender', '$subjects', '$upload_file', '$notes', '$user_id')";
    $sql = mysqli_query($GLOBALS['conn'], $query);

    return true;
}

function change_data($data, $files)
{
    $student_id = $data['student_id'];
    $fn = $data['full_name'];
    $sin = $data['student_ident_num'];
    $gender = $data['gender'];
    $clss = $data['class'];
    $subjects = $data['subjects'];
    $notes = $data['notes'];

    $queryShow = "SELECT * FROM tb_task_collection WHERE id_data = '$student_id';";
    $sqlShow = mysqli_query($GLOBALS['conn'], $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    if ($files['file']['name'] == "") {
        $photo = $result['upload_file'];
    } else {
        $split = explode('.', $files['file']['name']);
        $extention = $split[count($split) - 1];

        $photo = $result['full_name'] . '.' . $extention;
        unlink("file_manager/" . $result['upload_file']);
        move_uploaded_file($files['file']['tmp_name'], 'file_manager/' . $photo);
    }

    $query = "UPDATE tb_task_collection SET student_ident_num='$sin', full_name='$fn', class='$clss', gender='$gender', subjects='$subjects', upload_file='$photo', notes='$notes' WHERE id_data='$student_id'";
    $sql = mysqli_query($GLOBALS['conn'], $query);

    return true;
}

function delete_data($data)
{
    $student_id = $data['delete'];

    $queryShow = "SELECT * FROM tb_task_collection WHERE id_data = '$student_id';";
    $sqlShow = mysqli_query($GLOBALS['conn'], $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    var_dump($result);

    unlink("file_manager/" . $result['upload_file']);

    $query = "DELETE FROM tb_task_collection WHERE id_data = '$student_id'";
    $sql = mysqli_query($GLOBALS['conn'], $query);

    return true;
}
?>