<?php
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
}
include_once "header.php";
?>
<body>
    <div class="wrapper">
    <section class="users">
        <header>
            <?php
            include_once "php/config.php";
            $sql = mysqli_query($conn, "SELECT * From users WHERE unique_id= '{$_SESSION['unique_id']}'");
            if(mysqli_num_rows($sql) > 0){
                $row = mysqli_fetch_assoc($sql);
            }
            ?>
            <div class="content">
                <img class="uimg" onclick="viewProfile()" src="https://cdn.ankitsharma.xyz/chat-app/images/<?=$row['img']?>" alt="">
                <div class="details">
                    <span><?=$row['fname']?> <?=$row['lname']?></span>
                    <p><?=$row['status']?></p>
                </div>
            </div>
            <a href="php/logout.php" class="logout">Logout</a>
        </header>
        <div class="search">
            <span class="text">Select an user to start chat</span>
            <input type="text"  placeholder="Enter name to seach ....">
            <button><i class="fas fa-search"></i></button>
        </div>
        <div class="users-list">
        </div>
    </section>
    </div>
    <script src="js/users.js?ver=0.3"></script>
</body>
</html>