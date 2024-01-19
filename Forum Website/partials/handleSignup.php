<?php
include('common.php');
if (isset($_POST['signup'])) {
    if (!empty($_POST['u_name'] && $_POST['email'] && $_POST['password'] && $_POST['cpassword'])) {
        $username = $_POST['u_name'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];
        if ($pass == $cpass) {
            if (strlen($pass) >= 8) {
                $sql = "SELECT * from users WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) == 0) {
                    $hash = password_hash($pass, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `users` (`username`, `email`, `password`, `date`) VALUES ('$username', '$email', '$hash', current_timestamp());";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        header("Location: /projects/.23 (Online Forum Website)/index.php?signup=true");
                        exit();
                    }
                } else {
                    $error = "<div class='error mb-2 text-danger'>Username already taken!</div>";
                }
            } else {
                $error = "<div class='error mb-2 text-danger'>Passwords too short!</div>";
            }
        } else {
            $error = "<div class='error mb-2 text-danger'>Password do not match!</div>";
        }
    } else {
        $error = "<div class='error mb-2 text-danger'>Please fill all the required fields!</div>";
    }
} else {
    $error = "";
}

if (isset($error)) {
    $_SESSION['error'] = $error;
    header('Location: ' . $main_url . '_signup.php');
}
