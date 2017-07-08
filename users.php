<?php include("header.php"); ?>
<h1>Users</h1>
<?php
$sql = "SELECT * FROM `users`";
$result = mysqli_query($connection, $sql) or die();
if (mysqli_num_rows($result) > 0) {
    ?>
    <ul>
    <?php
    while ($user = mysqli_fetch_assoc($result)) {
    ?>
    
    <li>
        <a href="profile.php?username=<?php echo $user['username']; ?>"><?php echo $user['username']; ?></a>
    </li>
    
    <?php
    }
    ?>
    </ul>
    <?php
} else {
    ?>
    <h3>Sorry, ther were no users found...</h3>
    <?php
}
?>
<?php include("footer.php"); ?>