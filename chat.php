<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
include_once "header.php";
?>
<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                include_once "php/config.php";
                $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$user_id}'");
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                    $status = $row['status'];
                    $currentTime = date("Y-m-d H:i:s");
                    $onlineThreshold = strtotime('-2 minutes');
                    $lastSeenTimestamp = strtotime($row['last_seen']);
                    $statustime = $lastSeenTimestamp + 19800 ;
                    $lastsssen = date('g:i A', $statustime);
                    $onlineStatus = ($lastSeenTimestamp > $onlineThreshold) ? 'Online' : 'Offline';
                    if($onlineStatus === "Offline"){
                        $st="Last seen $lastsssen";
                    }else{
                        if($status=="Offline now"){
                            $st="Last seen $lastsssen";
                        }else{
                            $st="Active now";
                        }
                    }
                }
                ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img class="uimg" onclick="viewProfile(<?=$_GET['user_id']?>)" src="https://cdn.ankitsharma.xyz/chat-app/images/<?= $row['img'] ?>" alt="">
                <div class="details">
                    <span><?= $row['fname'] ?> <?= $row['lname'] ?></span>
                    <p class="lastseen"><?= $st ?></p>
                </div>
            </header>
            <div class="chat-box">
            </div>
            <form action="#" class="typing-area">
                <input type="hidden" name="outgoing_id" value="<?= $_SESSION['unique_id'] ?>">
                <input type="hidden" name="incoming_id" value="<?= $user_id ?>">
                <input type="file" name="file" id="file" class="input-field" accept="image/*" hidden>
                <label for="file"><i class="fas fa-paperclip"></i></label>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
    <script>
    setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-last-seen.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                let lastseen = document.querySelector(".lastseen");
                lastseen.innerHTML = data;
            }
        }
    };
    xhr.send("user_id=<?=$_GET['user_id']?>");
    }, 500);
    
    </script>
    <script src="js/chat.js?ver=0.4"></script>
</body>
</html>
