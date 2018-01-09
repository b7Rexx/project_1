<?php
session_start();
if (!(isset($_SESSION['username']) || isset($_COOKIE['user']))) {
    header('Location: login.php?loginFirst');
    die;
}

// Download IMAGE
if (isset($_GET['thirdTab_download'])) {
    $file = file('files/image.txt');
    $download_id = $_GET['thirdTab_download'];
    $download = explode('&', $file[$download_id]);

    $downloadname = trim($download[1]) . '_' . $download[0];

    $img = "img/{$download[0]}";

    header("Content-type: image/jpeg");
    header("Cache-Control: no-store, no-cache");
    header("Content-Disposition: attachment; filename=\"{$downloadname}\"");
    header('Content-Length: ' . filesize($img));
    readfile("$img");

}


//Download multiplt image in ZIP file
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['download_zip'])) {
        $file = file('files/image.txt');
        $list = $_POST['download_zip'];

        foreach ($list as $data) {
            $image = explode('&', $file[$data]);
            $download[] = 'img/' . $image[0];
        }

        $zipname = 'file.zip';
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($download as $img) {
            $zip->addFile($img);
        }
        $zip->close();

        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipname);

        readfile($zipname);
        unlink($zipname);
    } else {
        header('location: welcome.php?back=3');
    }
}

////Download using cURL  multiple image in ZIP file
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
////    $list = [];
////    $i = 'a';
////    while ($_POST["$i"] != 'end') {
////        $list[] = $_POST["$i"];
////        $i++;
////    }
//
//    $file = file('files/image.txt');
//    foreach ($list as $data) {
//        $image = explode('&', $file[$data]);
//        $download[] = 'img/' . $image[0];
//    }
//
//    $zipname = 'file.zip';
//    $zip = new ZipArchive;
//    $zip->open($zipname, ZipArchive::CREATE);
//    foreach ($download as $img) {
//        $zip->addFile($img);
//    }
//    $zip->close();
//
//    header('Content-Type: application/zip');
//    header('Content-disposition: attachment; filename=' . $zipname);
//    readfile($zipname);
//}
?>