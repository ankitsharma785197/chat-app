<?php
include_once "config.php";
$user_id = $_POST['user_id'];
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$user_id}'");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
    $currentTime = date("Y-m-d H:i:s");
    $onlineThreshold = strtotime('-30 seconds');
    $lastSeenTimestamp = strtotime($row['last_seen']);
    $statustime = $lastSeenTimestamp + 19800 ;
    $lastsssen = date('g:i A', $statustime);
    $onlineStatus = ($lastSeenTimestamp > $onlineThreshold) ? 'Online' : 'Offline';
    if($onlineStatus === "Offline"){
        $st="Last seen $lastsssen";
    }else{
        if($row['status']=="Offline now"){
            $st="Last seen $lastsssen";
        }else{
            $st="Active now";
        }
    }
}
echo $st;
?>