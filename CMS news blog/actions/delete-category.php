<?php
include("../admin/common.php");
$id = $_GET['category_id'];
$q = "DELETE FROM category WHERE category_id='$id'";
$qr = mysqli_query($conn, $q);
if ($qr) {
    $_SESSION['success'] = "The category was deleted successfully!";
    header("Location: " . $main_url . "admin/category.php");
} else {
    $error = "Could not delete the category, Please try again!";
}

mysqli_close($conn);
