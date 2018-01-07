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
    $img = "img/{$download[0]}";

    header("Content-type: image/jpeg");
    header("Cache-Control: no-store, no-cache");
    header("Content-Disposition: attachment; filename=\"{$download[0]}\"");
    header('Content-Length: ' . filesize($img));
    readfile("$img");

}
?>