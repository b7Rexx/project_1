<?php
session_start();
if (!(isset($_SESSION['username']) || isset($_COOKIE['user']))) {
    header('Location: login.php?loginFirst');
    die;
}
$image = isset($_SESSION['username']) ? $_SESSION['username'] . ".png" : $_COOKIE['user'] . ".png";
if (isset($_GET['id'])) {
$image_id = $_GET['id'];
}else{
    header('location: welcome.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/logo/<?= file_exists("img/logo/" . $image) ? "$image" : 'default.png'; ?>">
    <title>Image</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background: whitesmoke">
<div class="image_container">
    <button  onclick='window.location.href="download.php?thirdTab_download=<?=$image_id?>"'>Download</button>
    <button style="bottom:0;" onclick='window.location.href="welcome.php?back=3"'>Back</button>
    <?php
    if (file_exists('files/image.txt')) {
        $file = file('files/image.txt');
        if (isset($_GET['id'])) {
            $image_id = $_GET['id'];
            $image = explode('&', $file[$image_id]);
            echo "<img src=\"img/{$image[0]}\">";
        }
    }
    ?>
</div>
</body>
</html>
