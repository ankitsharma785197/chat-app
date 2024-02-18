<?php
session_start();
include_once "config.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
if(!empty($email) && !empty($password)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $sql = mysqli_query($conn, "SELECT * From users WHERE email= '{$email}' AND password='{$password}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $status="Active Now";
            $sql = mysqli_query($conn, "UPDATE users SET status='{$status}', last_seen=NOW() WHERE unique_id='{$row['unique_id']}'");
            $_SESSION['unique_id'] = $row['unique_id'];
            echo"success";
        }else{
            echo"Email or password is incorrect!";
        }
    }else{
        echo"$email - This is not a valid email!";
    }
}else{
    echo"All input field are required!";
}