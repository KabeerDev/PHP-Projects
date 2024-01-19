<?php
include("../admin/common.php");
$id = $_GET['user_id'];
$q = "DELETE FROM user WHERE user_id='$id'";
$qr = mysqli_query($conn, $q);
if ($qr) {
    $_SESSION['success'] = "The user was deleted successfully!";
    header("Location: " . $main_url . "admin/users.php");
} else {
    $error = "Could not delete the user, Please try again!";
}

mysqli_close($conn);
