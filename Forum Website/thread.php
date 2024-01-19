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
            height: 300px;
        }

        .bg {
            background: url('https://source.unsplash.com/1550x600/?coding,python') no-repeat center center/cover;
            position: absolute;
            top: 0;
            opacity: 0.5;
            height: 300px;
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

        .tc {
            width: 45vw !important;
        }

        .cc {
            width: 35vw !important;
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
            <h1 class="mx-auto">Discussions</h1>
        </div>
    </header>
    <main>
        <div class="container d-flex flex-column justify-content-center my-3">
            <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * from threads WHERE thread_id=$id";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $thread_user_id = $row['thread_user_id'];
                $sql3 = "SELECT * FROM users where sno='$thread_user_id'";
                $result3 = mysqli_query($conn, $sql3);
                $row3 = mysqli_fetch_assoc($result3);

                echo '<div class="tc d-flex align-items-center mt-3 mx-auto">
                <div class="flex-shrink-0 align-self-start">
                    <img src="img/user.png" alt="image for user" width="34px">
                </div>
                <div class="flex-grow-1 ms-3">
                <h6 class="my-0">' . $row3['username'] . '</h6>
                    <h6 class="m-0 fs-3">' . $title . '</h6>
                    <p class="fs-5">' . $desc . '</p>
                </div>
            </div>';
            }
            ?>
            <?php
            $showAlert = '';
            if (isset($_POST['submit'])) {
                if (!empty($_POST['comment'])) {
                    $comment = $_POST['comment'];
                    $comment = str_replace(">", "&gt;", $comment);
                    $comment = str_replace("<", "&lt;", $comment);
                    $sno = $_SESSION['sno'];
                    $sql = "INSERT INTO `comments` (`comment_by`, `comment_content`, `thread_id`, `comment_time`) VALUES ('$sno', '$comment', '$id', current_timestamp());";
                    $result = mysqli_query($conn, $sql);
                    $showAlert = true;
                } else {
                    $showAlert = false;
                }
            }
            ?>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '<form class="d-flex flex-column col-6 mx-auto" action="' . $_SERVER["REQUEST_URI"] . '" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Type Your Comment Here" id="comment" aria-describedby="emailHelp" name="comment">
                </div>';
                if ($showAlert) {
                    echo '<p class="text-success">Your comment has been posted!</p>';
                }
                if ($showAlert === false) {
                    echo '<p class="text-danger">comment cannot be empty!</p>';
                }
                echo '<button type="submit" class="btn btn-primary align-self-end me-3" name="submit">Post Comment</button>
            </form>';
            } else {
                echo '<div class="container text-center fs-2">You cannot comment. Please login first!</div>';
            }
            ?>
        </div>
        <div class="container d-flex flex-column justify-content-center my-3">
            <h2 class="mx-auto mb-4 text-secondary">Comments</h2>
            <?php
            $noResult = true;
            $id = $_GET['threadid'];

            $sql2 = "SELECT * from comments WHERE thread_id=$id";
            $result2 = mysqli_query($conn, $sql2);

            while ($row2 = mysqli_fetch_assoc($result2)) {
                $noResult = false;
                $id = $row2['comment_id'];
                $content = $row2['comment_content'];
                $date = $row2['comment_time'];
                $comment_by = $row2['comment_by'];

                $sql3 = "SELECT * FROM users where sno='$comment_by'";
                $result3 = mysqli_query($conn, $sql3);
                $row3 = mysqli_fetch_assoc($result3);

                echo '<div class="cc d-flex align-items-center my-2 mx-auto">
                <div class="flex-shrink-0 align-self-start">
                    <img src="img/user.png" alt="image for user" width="34px">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="py-0 my-0">' . $row3['username'] . ' <small class="text-secondary date">' . $date . '</small></h6>
                    <p>' . $content . '</p>
                </div>
            </div>';
            }
            if ($noResult) {
                echo '<div class="mx-auto my-3">
                <div class="container">
                    <p class="display-4">No Comments Yet</p>
                    <p class="lead"> Be the first person to comment</p>
                </div>
             </div>';
            }
            ?>
        </div>
    </main>
    <?php require_once("partials/_footer.php") ?>
</body>

</html>