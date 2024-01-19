<?php
include("../admin/common.php");

if (isset($_POST['submit'])) {
    if (!empty($_POST['f_name']) && !empty($_POST['l_name']) && !empty($_POST['username']) && !empty($_POST['user_id']) && isset($_POST['role'])) {
        $id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
        $l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
        $userName = mysqli_real_escape_string($conn, $_POST['username']);
        $role = mysqli_real_escape_string($conn, $_POST['role']);
        $q = "SELECT username FROM user WHERE username = '$userName'";
        $qr = mysqli_query($conn, $q);
        if ($qr) {
            if (mysqli_num_rows($qr) == 0) {
                $q = "UPDATE user SET
                          first_name = '$f_name',
                          last_name = '$l_name',
                          username = '$userName',
                          role = '$role'
                          WHERE user_id = '$id'
                         ";
                $qr = mysqli_query($conn, $q);
                if ($qr) {
                    $success = "User updated successfully!";
                } else {
                    $error = "Something went wrong, Please try again!";
                }
            } else {
                $error = "Username already exist!";
            }
        } else {
            $error = "Something went wrong, Please try again!";
        }
    } else {
        $error = "Please fill all the fields!";
    }
}

if (isset($success)) {
    $_SESSION['success'] = $success;
    header("Location: " . $main_url . "admin/users.php");
}
if (isset($error)) {
    $_SESSION['error'] = $error;
    header("Location: " . $main_url . "admin/update-user.php?user_id=$id");
}
