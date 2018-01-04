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
}elseif (isset($_GET['thirdTab_id'])){
    $_SESSION['set_tab'] = 'three';
}
else {
    $_SESSION['set_tab'] = 'one';

}

if (!(isset($_SESSION['username']) || isset($_COOKIE['user']))) {
    header('Location: login.php?loginFirst');
    die;
}
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
<div class="behind">
<body>
<div class="welcome">
    <h3>Welcome! <?= (isset($_SESSION['username'])) ? $_SESSION['username'] : $_COOKIE['user']; ?></h3>
</div>
<form method="post" action="logout.php">
    <button class="logout " type="submit" onclick="return confirm('Are you sure?')">Logout</button>
</form>

<div class="tab">
    <button class="tablinks" onclick="openTab(event, 'Admin')">Home</button>
    <button class="tablinks" onclick="openTab(event, 'Calculator')">Calculator</button>
    <button class="tablinks" onclick="openTab(event, 'image_list')">Photos</button>
</div>
<?php
//Admin list tab
include "include/firstTab.php";

//Calculator tab
include "include/secondTab.php";

//Third Tab
include "include/thirdTab.php";

// . . .. . Add more tabs here

//..
?>


<script src="js/tab.js"></script>
</body>
</div>
</html>
