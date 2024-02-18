<?php
session_start();
include_once "config.php";

if (isset($_SESSION['unique_id'])) {
    $unique_id = mysqli_real_escape_string($conn, $_SESSION['unique_id']);
    $lastSeenUpdateQuery = "UPDATE users SET last_seen=NOW() WHERE unique_id='{$unique_id}'";
    $updateStatus = mysqli_query($conn, $lastSeenUpdateQuery);
}
?>
