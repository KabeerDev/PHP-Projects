<?php
include("../admin/common.php");

if (isset($_POST['submit'])) {
    if (!empty($_POST['website_name']) && !empty($_POST['footer_desc'])) {
        $w_name = $_POST['website_name'];
        $w_desc = $_POST['footer_desc'];
        $img_err = [];
        if (!empty($_FILES['logo']['name'][0])) {
            $img_name = $_FILES['logo']['name'][0];
            $img_size = $_FILES['logo']['size'][0];
            $img_tmp = $_FILES['logo']['tmp_name'][0];
            $img_type = $_FILES['logo']['type'][0];
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
            $name = $_POST['old_logo'];
        }
        if (!empty($img_err[0])) {
            $_SESSION['error'] = $img_err[0];
            header("Location: " . $main_url . "admin/settings.php");
            die();
        }
        $q = "UPDATE settings SET websitename='$w_name', logo='$name', footerdesc='$w_desc' ";
        $qr = mysqli_query($conn, $q);
        if ($qr) {
            if (!empty($_FILES['logo']['name'][0])) {
                if (!move_uploaded_file($img_tmp, '../admin/images/' . $name)) {
                    die();
                }
            }
            $success = "Settings Saved!";
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
    header("Location: " . $main_url . "admin/settings.php");
}
