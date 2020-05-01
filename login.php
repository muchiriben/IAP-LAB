<?php
include 'includes/autoloader.inc.php';

$db = new DBconnector();
$conn = $db->connect();

$null = NULL;

if(isset($_POST['btn-login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $instance = User::create($null,$null,$null,$username,$password);
    $instance->setPassword($password);
    $instance->setUsername($username);

    if($instance->isPasswordCorrect($conn)){
        $db->closeDB();
        $instance->createUserSession();
        $instance->login();
    } else {
        $db->closeDB();
        header("Location:login.php");
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <title>Login</title>
</head>
<body>
    <header>
        <h1>LOGIN</h1>
        <h1></h1>
    </header>
    <div class="form">
    <form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" name="btn-login" value="Login">
    <p><a href="lab.php">Sign Up</a></p>
    </form>
    </div>
</body>
</html>