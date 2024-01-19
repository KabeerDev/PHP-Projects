<?php
include("../admin/common.php");

if (isset($_POST['submit'])) {
    if (!empty($_POST['post_title']) && !empty($_POST['postdesc']) && isset($_POST['category'])) {
        $p_id = $_POST['post_id'];
        $p_title = $_POST['post_title'];
        $p_desc = $_POST['postdesc'];
        $p_cat = $_POST['category'];
        $old_cat = $_POST['old_cat'];
        $date = date("d M, Y");
        $author = $_SESSION['auth']['user_id'];
        $img_err = [];
        if (!empty($_FILES['new-image']['name'][0])) {
            $img_name = $_FILES['new-image']['name'][0];
            $img_size = $_FILES['new-image']['size'][0];
            $img_tmp = $_FILES['new-image']['tmp_name'][0];
            $img_type = $_FILES['new-image']['type'][0];
            $img_ext = strtolower(explode(".", $img_name)[1]);
            $extensions = ['jpeg', "jpg", "png"];
            if (in_array($img_ext, $extensions)) {
                if ($img_size <= pow(10, 20)) {
                    $name = date("dmy") . '-' . rand() . '-' . $img_name;
                } else {
                    $img_err[] = "File size must be 2MB or lower!";
                }
            } else {
                $img_err[] = "Please choose a 'jpeg','jpg'or'png' file!";
            }
        } else {
            $name = $_POST['old-image'];
        }
        if (!empty($img_err[0])) {
            $_SESSION['error'] = $img_err[0];
            header("Location: " . $main_url . "admin/update-post.php");
            die();
        }
        $q = "UPDATE post SET
              title='$p_title',
              description='$p_desc',
              category='$p_cat',
              post_date='$date',
              author='$author',
              post_img='$name'
              WHERE post_id='$p_id';
             ";
        if ($old_cat != $p_cat) {
            $q .= "UPDATE category SET post=post - 1 WHERE category_id='$old_cat';";
            $q .= "UPDATE category SET post=post + 1 WHERE category_id='$p_cat';";
            $qr = mysqli_multi_query($conn, $q);
        } else {
            $qr = mysqli_query($conn, $q);
        }
        if ($qr) {
            if (!empty($_FILES['new-image']['name'][0])) {
                if (!move_uploaded_file($img_tmp, '../admin/upload/' . $name)) {
                    die();
                }
            }
            $success = "Post updated successfully!";
        } else {
            $error = "Something went wrong please try again!";
        }
    } else {
        $error = "Please fill all the fields!";
    }
}

if (isset($success)) {
    $_SESSION['success'] = $success;
    header("Location: " . $main_url . "admin/post.php");
}
if (isset($error)) {
    $_SESSION['error'] = $error;
    header("Location: " . $main_url . "admin/update-post.php");
}
