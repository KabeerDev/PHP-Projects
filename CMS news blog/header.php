<?php
session_start();
include 'common.php';
$page = basename($_SERVER['PHP_SELF']);
switch ($page) {
    case "single.php":
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $aql_title = "SELECT * FROM post WHERE post_id='$id'";
            $sql_result = mysqli_query($conn, $aql_title);
            $row_title = mysqli_fetch_assoc($sql_result);
            $page_title = $row_title['title'];
        } else {
            $page_title = "No post found";
        }
        break;
    case "category.php":
        if (isset($_GET['c_id'])) {
            $id = $_GET['c_id'];
            $aql_title = "SELECT * FROM category WHERE category_id='$id'";
            $sql_result = mysqli_query($conn, $aql_title);
            $row_title = mysqli_fetch_assoc($sql_result);
            $page_title = $row_title['category_name'] . ' News';
        } else {
            $page_title = "No category found";
        }
        break;
    case "author.php":
        if (isset($_GET['a_id'])) {
            $id = $_GET['a_id'];
            $aql_title = "SELECT * FROM user WHERE user_id='$id'";
            $sql_result = mysqli_query($conn, $aql_title);
            $row_title = mysqli_fetch_assoc($sql_result);
            $page_title = 'News By ' . $row_title['first_name'] . ' ' . $row_title['last_name'];
        } else {
            $page_title = "No Author found";
        }
        break;
    case "search.php":
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $page_title = $search;
        } else {
            $page_title = "No Author found";
        }
        break;
    default:
        $page_title = "News Site";
        break;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- <title>News</title> -->
    <title><?= $page_title ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <?php
                $q = "SELECT * FROM settings";
                $qr = mysqli_query($conn, $q);
                $setting_data = mysqli_fetch_assoc($qr);
                ?>
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">
                    <?php if ($setting_data['logo'] == "") : ?>
                        <a href="index.php" id="logo">
                            <h1><?= $setting_data['websitename'] ?></h1>
                        </a>
                    <?php else : ?>
                        <a href="index.php" id="logo"><img style="max-width: 200px; max-height: 100px;" src="<?= $main_url ?>admin/images/<?= $setting_data['logo'] ?>"></a>
                    <?php endif; ?>
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class='menu'>
                        <li><a href='index.php'>HOME</a></li>
                        <?php
                        if (isset($_GET['c_id'])) {
                            $id = $_GET['c_id'];
                        }

                        $q = "SELECT * FROM category WHERE post > 0 LIMIT 8";
                        $qr = mysqli_query($conn, $q);
                        $num = mysqli_num_rows($qr);
                        if ($num > 0) :
                            while ($row = mysqli_fetch_assoc($qr)) :
                                if (isset($_GET['c_id'])) {
                                    if ($row['category_id'] == $id) {
                                        $active = "active";
                                    } else {
                                        $active = "";
                                    }
                                }
                        ?>
                                <li><a href='category.php?c_id=<?= $row['category_id'] ?>' class="<?= $active ?>"><?= $row['category_name'] ?></a></li>
                        <?php
                            endwhile;
                        endif;
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->