<?php
include("../admin/common.php");

if (isset($_POST['login'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $user = mysqli_real_escape_string($conn, $_POST['username']);
        $pass = md5($_POST['password']);

        $q = "SELECT user_id, username, role FROM user WHERE username='$user' AND password='$pass'";
        $qr = mysqli_query($conn, $q);
        if ($qr) {
            if (mysqli_num_rows($qr) > 0) {
                while ($row = mysqli_fetch_assoc($qr)) {
                    $_SESSION['auth'] = $row;
                    $success = "User logged in successfully!";
                }
            } else {
                $error = "Username or Password not match!";
            }
        } else {
            $error = "Something went wrong!";
        }
    } else {
        $error = "Please fill all the fields!";
    }
}

if (isset($success)) {
    $_SESSION['success'] = $success;
    header("Location: " . $main_url . "admin/post.php");
}
if (isset($error)) {
    $_SESSION['error'] = $error;
    header("Location: " . $main_url . "admin/index.php");
}
