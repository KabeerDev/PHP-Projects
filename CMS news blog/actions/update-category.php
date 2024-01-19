<?php
include("../admin/common.php");

if (isset($_POST['sumbit'])) {
    $cat_id = mysqli_real_escape_string($conn,  $_POST['cat_id']);
    $cat_name = mysqli_real_escape_string($conn, $_POST['cat_name']);
    $q = "SELECT * FROM category WHERE category_name='$cat_name'";
    $qr = mysqli_query($conn, $q);
    if ($qr) {
        if (mysqli_num_rows($qr) == 0) {
            $q = "UPDATE category SET category_name='$cat_name' WHERE category_id='$id'";
            $qr = mysqli_query($conn, $q);
            if ($qr) {
                $success = "Category updated successfully!";
            } else {
                $error = "Something went wrong, please try again!";
            }
        } else {
            $error = "Category already exist!";
        }
    } else {
        $error = "Something went wrong, please try again!";
    }
}

if (isset($success)) {
    $_SESSION['success'] = $success;
    header("Location: " . $main_url . "admin/category.php");
}
if (isset($error)) {
    $_SESSION['error'] = $error;
    header("Location: " . $main_url . "admin/update-category.php?category_id=$cat_id");
}
