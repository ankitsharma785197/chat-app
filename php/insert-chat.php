<?php
session_start();
include_once "config.php";

$outgoing_id = mysqli_real_escape_string($conn, $_SESSION['unique_id']);
$incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

if (!empty($message) || isset($_FILES['file'])) {
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        if(!empty($fileName)){
            $img_explode = explode('.',$fileName);
            $img_ext = end($img_explode);
            $extensions = ['png','jpeg','jpg'];
            if(in_array($img_ext,$extensions) === true){
                $time = time();
                //1000053964.jpg
                //17053470941000053964.jpg
                $new_img_name = $time.$fileName;
                $fileDestination = "../../../cdn/chat-app/images/" . $new_img_name;
                move_uploaded_file($fileTmpName, $fileDestination);
                $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, img1) VALUES ('$incoming_id', '$outgoing_id', '$message', '$new_img_name')");
            }else{
            
            }
        }else{
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, img1) VALUES ('$incoming_id', '$outgoing_id', '$message', '')");
        }
        
        
    }
}
?>
