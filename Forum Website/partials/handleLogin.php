<?php
include_once("common.php");
if (isset($_POST['login'])) {
    if (!empty($_POST['username'] && $_POST['pass'])) {
        $name = $_POST['username'];
        $password = $_POST['pass'];
        $sql = "SELECT * FROM users WHERE username = '$name'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $name;
                $_SESSION['sno'] = $row['sno'];
                header('Location: ' . $main_url . 'index.php');
                exit();
            } else {
                $error2 = '<div class="error mb-2 text-danger">Incorrect password!</div>';
            }
        } else {
            $error1 = '<div class="error mb-2 text-danger">Incorrect username!</div>';
        }
    }
}

?>
