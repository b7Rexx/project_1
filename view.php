<?php
session_start();
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
    <link rel="icon" href="img/logo/<?= file_exists("img/logo/" . $image) ? "$image" : 'default.png'; ?>">
    <title>Image</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="image_container">
    <?php if (isset($_GET['id'])): ?>
        <button style="margin-right:70px;"
                onclick='window.location.href="download.php?thirdTab_download=<?= $_GET['id'] ?>"'>Download
        </button>
    <?php endif ?>
    <button onclick='window.location.href="welcome.php?back=3"'>Back</button>
    <?php
    if (file_exists('files/image.txt')) {
        $file = file('files/image.txt');
        if (isset($_GET['id'])) {
            $image_id = $_GET['id'];
            $image = explode('&', $file[$image_id]);
            echo "<img style='height: 100vh' src=\"img/{$image[0]}\">";
//        } elseif (isset($_POST['download_zip'])) {
//            $images = $_POST['download_zip'];

//            //cURL to download zip file of images
//            $url = "http://localhost/itnclass/signup/download.php";
//
//            for ($i = 0, $j = 'a'; $i < count($images); $j++, $i++) {
//                $fields[] = array($j => $images[$i]);
//            }
//            $fields[] = array($j => 'end');
//            $zip_download = '';
//
//            foreach ($fields as $field) {
//                foreach ($field as $key => $value) {
//                    $zip_download .= $key . "=" . $value . "&";
//                }
//            }
//            rtrim($zip_download, '&');
//
//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_URL, $url);
////            curl_setopt($ch, CURLOPT_POST, 1);                //0 for a get request
////            curl_setopt($ch, CURLOPT_POSTFIELDS, $zip_download);
////            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//            curl_setopt($ch, CURLOPT_POST, true);
//            curl_setopt($ch, CURLOPT_POST, count($fields));
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $zip_download);
//
//            //            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
////            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
//            $response = curl_exec($ch);
//            print "curl response is:" . $response;
//            echo "<hr>";
//            curl_close($ch);
//
//            //end of cURL
//
//            echo "<h2>ZIP Downloads  >  [file.zip]</h2>";
//            foreach ($images as $image_id) {
//                $image = explode('&', $file[$image_id]);
//                echo "<img style='height: 300px;' src=\"img/{$image[0]}\">";
//            }

        } else {
            header('location: welcome.php?back=3');
        }
    }
    ?>
</div>
</body>
</html>
