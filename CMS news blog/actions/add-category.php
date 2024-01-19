<?php
include("../admin/common.php");

if (isset($_POST['save'])) {
    if (!empty($_POST['cat'])) {
        $cat = $_POST['cat'];
        $q = "SELECT * FROM category WHERE category_name='$cat'";
        $qr = mysqli_query($conn, $q);
        if ($qr) {
            if (mysqli_num_rows($qr) == 0) {
                $q = "INSERT INTO category SET
                      category_name='$cat',
                      post='0'
                     ";
                $qr = mysqli_query($conn, $q);
                if ($qr) {
                    $success = "Category added successfully!";
                } else {
                    $error = "Something went wrong, please try again!";
                }
            } else {
                $error = "Category already exist!";
            }
        } else {
            $error = "Something went wrong, please try again!";
        }
    } else {
        $error = "Category name cannot be empty!";
    }
}

if (isset($success)) {
    $_SESSION['success'] = $success;
    header("Location: " . $main_url . "admin/category.php");
}
if (isset($error)) {
    $_SESSION['error'] = $error;
    header("Location: " . $main_url . "admin/add-category.php");
}
