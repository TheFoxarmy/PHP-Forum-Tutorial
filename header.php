<?php
session_start();
include("connection.php");

function getUser($user) {
    global $connection;
    $sql = "SELECT * FROM `users` WHERE `username` = '$user'";
    $result = mysqli_query($connection, $sql) or die();
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}

function logged_in() {
    return isset($_SESSION['username']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dank Forumz</title>
    <style>
        
        .right{
            float: right;
        }
        
    </style>
</head>
<body>
<header>
    <nav>
        <a href="index.php">Home</a>
        <a href="users.php">Users</a>
        <div class="right">
            <?php
            if (logged_in()) {
                ?>
                <img src="<?php echo getUser($_SESSION['username'])['profile_picture']; ?>" alt="" width="40px" border="1px">
                <a href="profile.php?username=<?php echo $_SESSION['username']; ?>"><?php echo $_SESSION['username']; ?></a>
                <a href="sign_out.php">Log Out</a>
                <?php
            } else {
                ?>
                <a href="registration.php">Log In or Sign Up</a>
                <?php
            }
            ?>
        </div>
    </nav>
    <hr />
</header>