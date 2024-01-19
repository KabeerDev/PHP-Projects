<?php
include("../admin/common.php");

if (isset($_POST['save'])) {
    if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['user']) && !empty($_POST['password']) && isset($_POST['role'])) {
        $f_name = mysqli_real_escape_string($conn, $_POST['fname']);
        $l_name = mysqli_real_escape_string($conn, $_POST['lname']);
        $userName = mysqli_real_escape_string($conn, $_POST['user']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $role = mysqli_real_escape_string($conn, $_POST['role']);
        if (strlen($_POST['password']) >= 4 && strlen($_POST['password']) <= 14) {
            $q = "SELECT username FROM user WHERE username = '$userName'";
            $qr = mysqli_query($conn, $q);
            if ($qr) {
                if (mysqli_num_rows($qr) == 0) {
                    $q = "INSERT INTO user SET
                          first_name = '$f_name',
                          last_name = '$l_name',
                          username = '$userName',
                          password = '$password',
                          role = '$role'
                         ";
                    $qr = mysqli_query($conn, $q);
                    if ($qr) {
                        $success = "User added successfully!";
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
            $error = "Password can contain atleast 4 character and maximum 14 characters!";
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
    header("Location: " . $main_url . "admin/add-user.php");
}
