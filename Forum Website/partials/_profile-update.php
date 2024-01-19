<?php
include('common.php');

if (isset($_POST['update'])) {
    if (!empty($_POST['old_pass'] && $_POST['new_pass'] && $_POST['c_pass'])) {
        $old_pass = $_POST['old_pass'];
        $sno = $_SESSION['sno'];
        $q = "SELECT * FROM users WHERE sno = '$sno'";
        $qr = mysqli_query($conn, $q);
        $row = mysqli_fetch_assoc($qr);
        if ($qr) {
            $verify_old_pass = password_verify($old_pass, $row['password']);
            if ($verify_old_pass) {
                $new_pass = $_POST['new_pass'];
                $c_pass = $_POST['c_pass'];
                if ($new_pass === $c_pass) {
                    if (strlen($new_pass) >= 8) {
                        $hash_password = password_hash($new_pass, PASSWORD_DEFAULT);
                        $q = "UPDATE `users` SET
                             `password` = '$hash_password'
                              WHERE `sno` = '$sno'";
                        $qr = mysqli_query($conn, $q);
                        if ($qr) {
                            session_unset();
                            session_destroy();
                            header('Location: ' . $main_url . 'partials/_login.php');
                        } else {
                            $error = 'Something went wrong. Please try again!';
                        }
                    } else {
                        $error = 'Password too short!';
                    }
                } else {
                    $error = 'Password do not match!';
                }
            } else {
                $error = 'You entered the wrong Password!';
            }
        } else {
            $error = 'User not exist!';
        }
    } elseif (!empty($_POST['new_username'] && $_POST['old_email'] && $_POST['new_email'])) {
        $username = $_POST['new_username'];
        $old_email = $_POST['old_email'];
        $new_email = $_POST['new_email'];
        $sno = $_SESSION['sno'];
        $q = "SELECT email FROM users WHERE email = '$old_email'";
        $qr = mysqli_query($conn, $q);
        if ($qr) {
            $q = "SELECT * FROM users WHERE username = '$username'";
            $qr = mysqli_query($conn, $q);
            if (mysqli_num_rows($qr) == 0) {
                if (strlen($username) >= 7) {
                    $q = "UPDATE `users` SET
                             `username` = '$username',
                             `email` = '$new_email'
                              WHERE `sno` = '$sno'";
                    $qr = mysqli_query($conn, $q);
                    if ($qr) {
                        $q = "SELECT * FROM users WHERE sno = '$sno'";
                        $qr = mysqli_query($conn, $q);
                        $row = mysqli_fetch_assoc($qr);
                        $_SESSION['username'] = $username;
                        $_SESSION['auth'] = $row;
                        header('Location: ' . $main_url);
                    } else {
                        $error = "Something went wrong. Please try again!";
                    }
                } else {
                    $error = "username must be upto 7 characters!";
                }
            } else {
                $error = "Username already taken!";
            }
        } else {
            $error = 'User does not exist!';
        }
    } else {
        $error = 'Please fill all the required fields!';
    }
}

if (isset($error)) {
    $_SESSION['error'] = $error;
    header('Location: ' . $main_url . 'profile-update.php');
}
