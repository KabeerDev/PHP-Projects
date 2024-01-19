<?php
include("../admin/common.php");

if (isset($_POST['submit'])) {
    if (!empty($_POST['post_title']) && !empty($_POST['postdesc']) && !empty($_FILES['fileToUpload']['name'][0]) && isset($_POST['category']) && $_POST['category'] !=  "Select Category") {

        $p_title = mysqli_real_escape_string($conn, $_POST['post_title']);
        $p_desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
        $p_cat = mysqli_real_escape_string($conn, $_POST['category']);
        $date = date("d M, Y");
        $author = $_SESSION['auth']['user_id'];
        $img_name = $_FILES['fileToUpload']['name'][0];
        $img_size = $_FILES['fileToUpload']['size'][0];
        $img_tmp = $_FILES['fileToUpload']['tmp_name'][0];
        $img_type = $_FILES['fileToUpload']['type'][0];
        $img_ext = strtolower(explode(".", $img_name)[1]);
        $extensions = ['jpeg', "jpg", "png"];

        if (in_array($img_ext, $extensions)) {
            if ($img_size <= pow(10, 20)) {
                $name = date("dmy") . '-' . rand() . '-' . $img_name;
                if (move_uploaded_file($img_tmp, "../admin/upload/" . $name)) {
                    $q = "INSERT INTO post SET
                          title='$p_title',
                          description='$p_desc',
                          category='$p_cat',
                          post_date='$date',
                          author='$author',
                          post_img='$name'
                         ";
                    $qr = mysqli_query($conn, $q);
                    if ($qr) {
                        $q = "UPDATE category SET post=post + 1 WHERE category_id='$p_cat'";
                        $qr = mysqli_query($conn, $q);
                        if ($qr) {
                            $success = "Post was added successfully!";
                        } else {
                            $error = "Something went wrong please try again!";
                        }
                    } else {
                        $error = "Something went wrong please try again!";
                    }
                } else {
                    $error = "Something went wrong please try again!";
                }
            } else {
                $error = "File size must be 2MB or lower!";
            }
        } else {
            $error = "Please choose a 'jpeg','jpg'or'png' file!";
        }
    } else {
        $error = "Please select all the fields!";
    }
}

if (isset($success)) {
    $_SESSION['success'] = $success;
    header("Location: " . $main_url . "admin/post.php");
}
if (isset($error)) {
    $_SESSION['error'] = $error;
    header("Location: " . $main_url . "admin/add-post.php");
}
