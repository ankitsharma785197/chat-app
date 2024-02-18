<?php
session_start();
include_once "config.php";
$outgoing_id=$_SESSION['unique_id'];
$sql = mysqli_query($conn, "SELECT * From users WHERE NOT unique_id='{$outgoing_id}'");
$output="";
if(mysqli_num_rows($sql) > 0){
    include_once "data.php";
}else{
    $output.="No users are available to chat";
}
echo $output;