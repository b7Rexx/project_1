<?php
session_start();


if (isset($_SESSION['username']) || isset($_COOKIE['user'])) {
    header('Location: welcome.php?alreadyLoggedIn');
    die;
}

if (!empty($_POST)) {
    $register_name = $_POST['name_register'];
    $register_pass = $_POST['pass_register'];
    $register_confirm = $_POST['confirm_register'];
    $register_logo = isset($_FILES['logo_register']) ? 'logo set' : '';

    $file = file('files/user_pass.txt');
    foreach ($file as $data){
        $check_user = explode('=username&password=',$data);
        if($check_user[0] == $register_name){
        header('Location: register.php?failedToRegister');
        setcookie('register_failed', 'Username already exist', time() + 1);
        die;
        }
    }

    if ($register_pass === $register_confirm) {

        $handle = fopen('files/user_pass.txt', 'a');
        fwrite($handle, "$register_name=username&password=$register_pass\n");
        fclose($handle);
        $target = "img/logo/" . $register_name . ".png";
        if ($register_logo != '') {
            move_uploaded_file($_FILES['logo_register']['tmp_name'], $target);
        }
        header('Location: login.php?successfulRegister');
        setcookie('register_success', 'Successfully Registered', time() + 1);
        die;
    } else {
        header('Location: register.php?failedToRegister');
        setcookie('register_failed', 'Password did not Match', time() + 1);
        die;
    }

} else {
    header('Location: login.php?redirectedToLogin');
}
?>