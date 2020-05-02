<?php

session_start();
if(!isset($_SESSION['username'])){
    header("Location:login.php");
} else {
    $logged_user = $_SESSION['username'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="private.css">
    <title>Private Page</title>
</head>
<body>
<div class="container">
<p>Welcome <?php echo $logged_user; ?></p>
<p>This is a private page</p>
    <p>We want to protect it</p>
    <p><a href="logout.php">Logout</a></p>
</div>
</body>
</html>