<?php
session_start();
include_once "config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: ../login.php");
    exit();
}
include_once "header.php";
$user_id = $_SESSION['unique_id'];
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '$user_id'");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $updateQuery = "UPDATE users SET fname = '{$fname}', lname = '{$lname}', password='{$password}'";
    if (!empty($_FILES['image']['name'])) {
        // If image is selected, update it
        $img_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);
        $extensions = ['png', 'jpeg', 'jpg'];

        if (in_array($img_ext, $extensions)) {
            $time = time();
            $new_img_name = $time . $img_name;
            move_uploaded_file($tmp_name, "../../../cdn/chat-app/images/" . $new_img_name);
            $updateQuery .= ", img = '$new_img_name'";
        }else{
            echo"Please select a Image file - png, jpeg, jpg!";
        }
    }

    $updateQuery .= " WHERE unique_id = '$user_id'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo"success";
    } else {
        $error = "Error updating profile";
    }
}
?>