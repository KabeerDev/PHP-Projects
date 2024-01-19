<?php
include_once("partials/common.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        header {
            height: 400px;
        }

        .bg {
            background: url('https://source.unsplash.com/1550x600/?coding,python') no-repeat center center/cover;
            position: absolute;
            top: 0;
            opacity: 0.5;
            height: 400px;
            width: 100%;
        }

        .logo {
            width: 230px;
        }

        .nav-item {
            padding: 0 10px;
        }

        .upper {
            width: 70%;
            display: flex;
            flex-direction: column;
        }

        .upper h1 {
            font-size: 80px;
            margin: 20px 0;
        }

        .upper p {
            text-transform: capitalize;
            font-size: 22px;
        }

        .tc,
        .qc {
            width: 60vw !important;
        }

        .date {
            font-size: 13px;
            margin: 0 20px;
            font-weight: 100;
        }

        .user_menu {
            width: 12rem;
            z-index: 1;
        }

        .d_none {
            display: none;
        }

        .user_menu a {
            background: transparent;
            color: black;
        }

        .user_menu a:hover {
            background: #5B7E91;
            color: white;
        }
    </style>
    <title>Code Connect | Coding Forums</title>
</head>

<body>
    <header>
        <div class="bg"></div>
        <?php include_once('navbar.php'); ?>

        <div class="upper container">
            <?php
            $id = $_GET['catid'];
            $sql = "SELECT * FROM `categories` WHERE category_id=$id";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $catname = $row['category_name'];
                $catdesc = $row['category_description'];
            }
            ?>
            <h1><?php echo $catname; ?></h1>
            <p><?php echo $catdesc; ?></p>
        </div>
    </header>
    <main>
        <?php
        $showAlert = '';
        if (isset($_POST['submit'])) {
            if (!empty($_POST['title'] && $_POST['desc'])) {
                $title = $_POST['title'];
                $title = str_replace(">", "&gt;", $title);
                $title = str_replace("<", "&lt;", $title);
                $desc = $_POST['desc'];
                $desc = str_replace(">", "&gt;", $desc);
                $desc = str_replace("<", "&lt;", $desc);
                $sno = $_SESSION['sno'];
                $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `date`) VALUES ('$title', '$desc', '$id', '$sno', current_timestamp());";
                $result = mysqli_query($conn, $sql);
                $showAlert = true;
            } else {
                $showAlert = false;
            }
        }
        ?>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<div class="container my-3 qc">
            <h1 class="text-capitalize text-center">Ask a question</h1>
            <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                <div class="mb-3">
                    <label for="title" class="form-label">Qusetion</label>
                    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title">
                    <div id="emailHelp" class="form-text">Try to keep your question short and crispy.</div>
                </div>
                <div class="mb-3">
                    <label for="floatingTextarea2" class="mb-2">Describe your question</label>
                    <textarea class="form-control" id="floatingTextarea2" style="height: 100px" name="desc"></textarea>
                </div>';
            if ($showAlert) {
                echo '<p class="text-success">Your thread has been added!</p>';
            }
            if ($showAlert === false) {
                echo '<p class="text-danger">Your thread was not added!</p>';
            }
            echo '<button type="submit" class="btn btn-primary" name="submit">Post Question</button>
            </form>
        </div>';
        } else {
            echo '<div class="container text-center fs-2 pt-4">You cannot post. Please login first!</div>';
        }
        ?>
        <h2 class="text-center my-3">Browse Questions</h2>
        <div class="container d-flex flex-column justify-content-center">
            <?php
            $noResult = true;
            $id = $_GET['catid'];
            $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $id = $row['thread_id'];
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $date = $row['date'];
                $thread_user_id = $row['thread_user_id'];

                $sql2 = "SELECT * FROM users WHERE sno='$thread_user_id'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);

                echo '<div class="tc d-flex align-items-center my-3 mx-auto">
                <div class="flex-shrink-0 align-self-start">
                    <img src="img/user.png" alt="image for user" width="34px">
                </div>
                <div class="flex-grow-1 ms-3">
                <h6 class="my-0 fs-5 pb-1 text-secondary">' . $row2['username'] . '</h6>
                <h6 class="m-0"><a class="text-dark text-decoration-none" href="' . $main_url . 'thread.php?threadid=' . $id . '">' . $title . '  <small class="text-secondary date">' . $date . '</small></a></h6>
                ' . $desc . '
                </div>
            </div>';
            }
            if ($noResult) {
                echo '<div class="mx-auto my-3">
                <div class="container">
                    <p class="display-4">No Threads Found</p>
                    <p class="lead"> Be the first person to ask a question</p>
                </div>
             </div>';
            }
            ?>
        </div>
    </main>
    <?php require_once("partials/_footer.php") ?>
</body>

</html>