<?php
    while($row = mysqli_fetch_assoc($sql)){
        $sql2 = mysqli_query($conn, "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']} OR outgoing_msg_id = {$row['unique_id']}) 
                AND (incoming_msg_id = {$outgoing_id} OR outgoing_msg_id = {$outgoing_id}) ORDER bY msg_id DESC LIMIT 1");
        $row1= mysqli_fetch_assoc($sql2);
        if(mysqli_num_rows($sql2) > 0){
            $result=$row1['msg'];
            $rowid=$row1['outgoing_msg_id'];
            ($outgoing_id == $rowid) ? $you = "You : " : $you=""; 
        }else{
            $result="No message available";
            $you="";
        }
        $currentTime = date("Y-m-d H:i:s");
        $onlineThreshold = strtotime('-30 seconds');
        $lastSeenTimestamp = strtotime($row['last_seen']);
        $onlineStatus = ($lastSeenTimestamp > $onlineThreshold) ? 'Online' : 'Offline';
        if($onlineStatus === "Offline"){
            $offline="offline";
        }else{
            if($row['status']=="Offline now"){
                $offline="offline";
            }else{
                $offline="";
            }
        }
        (strlen($result) > 28) ? $msg = substr($result, 0, 28).'...' : $msg = $result;
        $output.='<a href="chat.php?user_id='.$row['unique_id'].'">
        <div class="content">
            <img onclick="viewProfile('.$row['unique_id'].')" class="uimg"src="https://cdn.ankitsharma.xyz/chat-app/images/'.$row['img'].'" alt="">
            <div class="details">
                <span>'.$row['fname'].' '.$row['lname'].'</span>
                <p>'.$you.''.$msg.'</p>
            </div>
        </div>
        <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
    </a>';
    }