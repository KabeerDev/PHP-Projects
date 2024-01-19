<?php
include("../admin/common.php");
$id = $_GET['post_id'];
$q = "SELECT * FROM post WHERE post_id='$id'";
$qr = mysqli_query($conn, $q);
$p_data = mysqli_fetch_assoc($qr);
$p_cat = $p_data['category'];
$p_img = $p_data['post_img'];
if ($qr) {
    $q = "UPDATE category SET post=post - 1 WHERE category_id='$p_cat'";
    $qr = mysqli_query($conn, $q);
    if ($qr) {
        $q = "DELETE FROM post WHERE post_id='$id'";
        $qr = mysqli_query($conn, $q);
        if ($qr) {
            unlink("../admin/upload/" . $p_img);
            $_SESSION['success'] = "The post was deleted successfully!";
            header("Location: " . $main_url . "admin/post.php");
        } else {
            $error = "Could not delete the post, Please try again!";
        }
    } else {
        $error = "Could not delete the post, Please try again!";
    }
} else {
    $error = "Could not delete the post, Please try again!";
}

mysqli_close($conn);
