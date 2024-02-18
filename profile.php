<?php
session_start();
include_once "php/config.php";

// Ensure the user_id parameter is set
if (!empty($_GET['user_id'])) {
$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$user_id}'");

// Ensure the user with the given ID exists
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
} else {
    header("location: users.php");
    exit();
}

include_once "header.php"; // Include your header file
?>
<body>
    <div class="wrapper">
        <section class="profile-section">
            <header>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="https://cdn.ankitsharma.xyz/chat-app/images/<?= $row['img'] ?>" alt="">
                <div class="details">
                    <span><?= $row['fname'] ?> <?= $row['lname'] ?></span>
                    <p><?= $row['status'] ?></p>
                </div>
            </header>
            <div class="profile-info">
                <p><strong>Email:</strong> <?= $row['email'] ?></p>
            </div>
        </section>
    </div>
    <script>
        setInterval(() => {
    updateLastSeen();
}, 60000);
function updateLastSeen() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/update-last-seen.php", true);
    xhr.send();
}
    </script>
</body>
</html>
<?php
}else{
$user_id = $_SESSION['unique_id'];
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$user_id}'");

// Ensure the user with the given ID exists
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
} else {
    header("location: users.php");
    exit();
}

include_once "header.php"; // Include your header file
?>
<body>
    <div class="wrapper">
        <section class="profile-section">
            <header>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="https://cdn.ankitsharma.xyz/chat-app/images/<?= $row['img'] ?>" alt="">
                <div class="details">
                    <span><?= $row['fname'] ?> <?= $row['lname'] ?></span>
                    <p><?= $row['status'] ?></p>
                </div>
            </header>
            <div class="profile-info">
                <section class="form updatedetails">
                <header>Update Profile</header>
                <form action="#" enctype="multipart/form-data">
                    <div class="error-txt"></div>
                    <div class="name-details">
                        <div class="field input">
                            <label>First Name</label>
                            <input type="text" name="fname" placeholder="First Name" autocomplete="off"value="<?= $row['fname'] ?>" required>
                        </div>
                        <div class="field input">
                            <label>Last Name</label>
                            <input type="text" name="lname" placeholder="Last Name" autocomplete="off"value="<?= $row['lname'] ?>" required>
                        </div>
                  </div>
                 <div class="field input">
                     <label>Email Address</label>
                     <input type="email" name="email" placeholder="Enter your email" autocomplete="off" value="<?= $row['email'] ?>" locked>
                  </div>
                  <div class="field input">
                     <label>Password</label>
                     <input type="password" name="password" placeholder="Enter password" value="<?= $row['password'] ?>"autocomplete="off" required>
                     <i class="fas fa-eye"></i>
                 </div>
                 <div class="field image">
                     <label>Select Image</label>
                     <input type="file"  name="image" autocomplete="off">
                 </div>
                 <div class="field button">
                     <input type="submit" value="Update now">
                 </div>
             </form>
            </section>
            </div>
        </section>
    </div>
    <script src="js/pass-show-hide.js"></script>
    <script src="js/profile.js?ver=0.3"></script>
</body>
</html>


<?php
}
?>