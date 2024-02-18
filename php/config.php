<?php
#error_reporting(0);
$conn = mysqli_connect("localhost","chat_app_db","password@xyz","chat_app_db");
if(!$conn){
    echo"Success".mysqli_connect_error();
}
?>
