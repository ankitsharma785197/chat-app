<?php
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: ../login.php");
}
include_once "config.php";
$outgoing_id = mysqli_real_escape_string($conn, $_SESSION['unique_id']);
$incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
$output="";
$sql = mysqli_query($conn, "SELECT * FROM messages 
                            LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                            WHERE (incoming_msg_id = '{$incoming_id}' AND outgoing_msg_id = '{$outgoing_id}') or (incoming_msg_id = '{$outgoing_id}' AND outgoing_msg_id = '{$incoming_id}') ORDER BY msg_id");    
if(mysqli_num_rows($sql) > 0){
    while($row = mysqli_fetch_assoc($sql)){
        if(isset($row['msg'])){
            $nrow='<br>'.$row['msg'];
        }else{
            $nrow=$row['msg'];
        }
        
        if (!empty($row['img1'])) {
            if($row['outgoing_msg_id'] === $outgoing_id){
            $output.='<div class="chat outgoing">
                    <div class="details">
                         <p><img class="newimg" src="https://cdn.ankitsharma.xyz/chat-app/images/' . $row['img1'] . '" alt="Image">'.$nrow.'</p>
                    </div>
                    </div>';
        }else{
            $output.='<div class="chat incoming">
                    <img onclick="viewProfile('.$incoming_id.')"class="img" src="https://cdn.ankitsharma.xyz/chat-app/images/'.$row['img'].'" alt="">
                    <div class="details">
                        <p><img class="newimg" src="https://cdn.ankitsharma.xyz/chat-app/images/' . $row['img1'] . '" alt="Image">'.$nrow.'</p>
                    </div>
                    </div>';
        }
        }else{
        if($row['outgoing_msg_id'] === $outgoing_id){
            $output.='<div class="chat outgoing">
                    <div class="details">
                         <p>'.$row['msg'].'</p>
                    </div>
                    </div>';
        }else{
            $output.='<div class="chat incoming">
                    <img class="img" onclick="viewProfile('.$incoming_id.')" src="https://cdn.ankitsharma.xyz/chat-app/images/'.$row['img'].'" alt="">
                    <div class="details">
                        <p>'.$row['msg'].'</p>
                    </div>
                    </div>';
        }
        }
    }
}
echo $output;