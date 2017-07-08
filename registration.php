<?php include("header.php"); ?>
<table border="5px">
    <th>Register</th>
    <th>Login</th>
    <tr>
        <td>
            <form action="" method="post" style="float: right;">
                <p><label for="r_username">Username</label><input type="text" name="r_username" class="right"></p>
                <p><label for="r_email">Email</label><input type="email" name="r_email" class="right"></p>
                <p><label for="r_password">Password</label><input type="password" name="r_password" class="right"></p>
                <p><label for="r_password2">Confrm Password</label><input type="password" name="r_password2" class="right"></p>
                <p><input type="submit" name="register" value="Register"></p>
            </form>
        </td>
        <td>
            <form action="" method="post">
                <p><label for="username">Username:</label><input type="text" name="username" class="right"></p>
                <p><label for="password">Password:</label><input type="password" name="password" class="right"></p>
                <p><input type="submit" name="login" value="Login"></p>
            </form>
        </td>
    </tr>
</table>
<?php
include("footer.php");
$useOriginalPasswordValidation = true;

if (isset($_POST['register'])) {
    // Create vars
    $username = $_POST['r_username'];
    $email = $_POST['r_email'];
    $password = $_POST['r_password'];
    $password2 = $_POST['r_password2'];
    
    // Validate user data
   /*  NOTE FROM AIDAN:
    *  I improved tthe verification of data by using the built in php function: filter_var
    *  
    *  Original Code from ep24: if (!strpos($email, "@") | !strpos($email, ".") | strpos($email, " "))
    */ 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("<p>Invalid Email</p>");
    }
    
    if ($password != $password2) {
        die("<p>Password do not match</p>");
    }
    
    $username_exists = mysqli_query($connection, "SELECT * FROM `users` WHERE `username` LIKE '$username'") or die("<p>Account Creation Failed</p>");
    $email_exists = mysqli_query($connection, "SELECT * FROM `users` WHERE `email` LIKE '$email'") or die("<p>Account Creation Failed</p>");
    if (mysqli_num_rows($username_exists) > 0 | mysqli_num_rows($email_exists) > 0) {
        die("<p>Email or username taken</p>");
    }
    
    if ($useOriginalPasswordValidation) {
        $sql = "INSERT INTO `users` (`username`, `email`, `password`) VALUES ('$username', '$email', '$password')";
        mysqli_query($connection, $sql) or die("<p>Account Creation Failed</p>");
    }
    echo "<p>Account Successfully Created!</p>";
}

if (isset($_POST['login'])) {
    // Create variables
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($useOriginalPasswordValidation) {
        $sql = "SELECT * FROM `users` WHERE `username` = '$username' && `password` = '$password'";
        $result = mysqli_query($connection, $sql) or die("<p>There was an error logging you in!</p>");
        
        if (mysqli_num_rows($result) > 0) {
            while($user = mysqli_fetch_assoc($result)) {
                $_SESSION['username'] = $user['username'];
                header("Location: index.php");
            }
        } else {
            die("<p>Invalid username or password</p>");
        }
    } else {
        
    }
}
?>