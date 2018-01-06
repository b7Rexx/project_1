<?php
session_start();

//echo "<pre>";
//print_r($_SESSION);
//print_r($_COOKIE);
//die;
//echo "</pre>";
if (isset($_POST['first']) && isset($_POST['second']) && isset($_POST['operator'])) {
    $_SESSION['set_tab'] = 'two';
} elseif (isset($_POST['image_name']) && isset($_FILES['image_file'])) {
    $_SESSION['set_tab'] = 'three';
} elseif (isset($_GET['thirdTab_id']) || !empty($_GET['tabThree_delete'])) {
    $_SESSION['set_tab'] = 'three';
} elseif (isset($_GET['thirdTab_download']) || !empty($_GET['tabThree_download'])) {
    $_SESSION['set_tab'] = 'three';
} elseif (isset($_POST['price_calc'])) {
    $_SESSION['set_tab'] = 'four';
} else {
    $_SESSION['set_tab'] = 'one';

}

if (!(isset($_SESSION['username']) || isset($_COOKIE['user']))) {
    header('Location: login.php?loginFirst');
    die;
}

$image = isset($_SESSION['username']) ? $_SESSION['username'] . ".png" : $_COOKIE['user'] . ".png";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="welcome">
    <h3>
        <img src="img/logo/<?= file_exists("img/logo/".$image)? "$image":'default.png';?>">
        <a href="welcome.php">Welcome! <?= (isset($_SESSION['username'])) ? $_SESSION['username'] : $_COOKIE['user']; ?></a>
    </h3>
</div>

<div class="tab">
    <button class="tablinks" onclick="openTab(event, 'Admin')">Home</button>
    <button class="tablinks" onclick="openTab(event, 'Calculator')">Calculator</button>
    <button class="tablinks" onclick="openTab(event, 'image_list')">Photos</button>
    <button class="tablinks" onclick="openTab(event, 'pendrive_price_calc')">Pendrive</button>
    <form method="post" action="logout.php">
        <button style="float: right;color:darkorange" type="submit" onclick="return confirm('Logout?')">Logout</button>
    </form>

</div>
<?php
//Admin list tab
include "include/firstTab.php";

//Calculator tab
include "include/secondTab.php";

//Third Tab
include "include/thirdTab.php";

//Fourth Tab
include "include/fourthTab.php";

// . . .. . Add more tabs here

//..
?>


<script src="js/tab.js"></script>
</body>
</html>
