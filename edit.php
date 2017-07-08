<?php

include("header.php");

if (!logged_in())
    header("Location: index.php");
    
if (isset($_POST['update_info'])) {
    $currentUser = getUser($_SESSION['username']);
    
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    $steam = $_POST['steam'];
    
    $profile_picture = $_POST['profile_picture'];
    
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $rt_new_password = $_POST['rt_new_password'];
    
    if ($old_password != "") {
        if ($old_password == $currentUser['password']) {
            if ($new_password == $rt_new_password) {
                $sql = "UPDATE `users` SET `age` = '$age', `gender` = '$gender', `email` = '$email', `steam` = '$steam', `bio` = '$bio', `profile_picture` = '$profile_picture', `password` = '$new_password' WHERE `username` = '".$currentUser['username']."'";
            } else {
                echo "<p>Passwords Don't Match!</p>";
            }
        } else {
            echo "<p>Incorrect Old Password</p>";
        }
    } else {
        $sql = "UPDATE `users` SET `age` = $age, `gender` = '$gender', `email` = '$email', `steam` = '$steam', `bio` = '$bio', `profile_picture` = '$profile_picture' WHERE `username` = '".$currentUser['username']."'";
        echo $sql;
    }
    
    $sql = "UPDATE `users` SET `age` = '$age', `gender` = '$gender', `email` = '$email', `steam` = '$steam', `bio` = '$bio', `profile_picture` = '$profile_picture' WHERE `username` = '".$currentUser['username']."'";
    mysqli_query($connection, $sql);
    header("Location: profile.php?username=". $currentUser['username']);
}
    
$user = getUser($_SESSION['username']);
?>

<h1><?php echo $user['username'] ?></h1>
<form action="" method="post">
    <table border="1px">
        <tr>
            <th>Age:</th>
            <td><input type="text" name="age" value="<?php echo $user['age']; ?>"></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><input type="email" name="email" value="<?php echo $user['email']; ?>"></td>
        </tr>
        <tr>
            <th>Bio:</th>
            <td><input type="text" name="bio" value="<?php echo $user['bio']; ?>"></td>
        </tr>
        <tr>
            <th>Steam:</th>
            <td><input type="text" name="steam" value="<?php echo $user['steam']; ?>"></td>
        </tr>
        <tr>
            <th>Gender:</th>
            <td><select name="gender" id="" c>
                <option <?php if($user['gender'] == "Male") echo "selected"; ?> value="Male">Male</option>
                <option <?php if($user['gender'] == "Female") echo "selected"; ?> value="Female">Female</option>
                <option <?php if($user['gender'] == "Other") echo "selected"; ?> value="Other">Other</option>
            </select></td>
        </tr>
        <tr>
            <th>Profile Picture:</th>
            <td><input type="text" name="profile_picture" value="<?php echo $user['profile_picture']; ?>"></td>
        </tr>
        <tr>
            <th colspan="2">Change Password</th>
        </tr>
        <tr>
            <th>Old Password</th>
            <td><input type="password" name="old_password"></td>
        </tr>
        <tr>
            <th>New Password</th>
            <td><input type="password" name="new_password"></td>
        </tr>
        <tr>
            <th>Confirm New Password</th>
            <td><input type="password" name="rt_new_password"></td>
        </tr>
    </table>
    <input type="submit" name="update_info" value="Save">
</form>

<?php include("footer.php"); ?>