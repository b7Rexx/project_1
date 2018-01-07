<?php
session_start();

if (isset($_SESSION['username']) || isset($_COOKIE['user'])) {
    header('Location: welcome.php?alreadyLoggedIn');
    die;
}
$image='null';

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/logo/<?= file_exists("img/logo/".$image)? "$image":'default.png';?>">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="anchor"><a href="login.php" type="button">Login</a></div>
<div class="login">
    <form class="loginform" action="register_action.php" method="post" enctype="multipart/form-data">
        <input name="name_register" type="text" placeholder="Username"><br>
        <input name="pass_register" type="password" placeholder="password"><br>
        <input name="confirm_register" type="password" placeholder="Confirm password"><br>
        <input id="ok" type="file" name="logo_register" style="width: 0.1px;margin-top: 15px"><label for="ok">Upload a logo</label><br>
        <button type="submit">Register</button>
    </form>
    <?php
    if (isset($_COOKIE['register_failed'])) {
        echo "<a class=\"red\">{$_COOKIE['register_failed']}</a>";
    }
    ?>
</div>
</body>
</html>
