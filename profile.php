<?php
include("header.php");
if (!isset($_GET['username'])) {
    die("<p>No User Specified</p>");
}
if (getUser($_GET['username']) == null) {
    die("<p>User does not exist</p>");
}
$user = getUser($_GET['username']);

?>

<h1>
    <?php echo $user['username']; ?>
</h1>

<?php
if (logged_in() && $user['username'] == $_SESSION['username']) {
    ?>
    <h3><a href="edit.php">Edit</a></h3>
    <?php
}
?>

<img src="<?php echo $user['profile_picture'] ?>" alt="" width="100px">

<table border="1px">
    

    <tr>
        <th>Age: </th>
        <td><?php echo $user['age']; ?></td>
    </tr>
    <tr>
        <th>Email: </th>
        <td><?php echo $user['email']; ?></td>
    </tr>

    <tr>
        <th>Gender: </th>
        <td><?php echo $user['gender']; ?></td>
    </tr>

    <tr>
        <th>Bio: </th>
        <td><?php echo $user['bio']; ?></td>
    </tr>

    <tr>
        <th>Steam: </th>
        <td><?php echo $user['steam']; ?></td>
    </tr>
</table>

<?php include("footer.php"); ?>