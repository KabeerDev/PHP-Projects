<?php require_once('partials/common.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>My Posts</title>
    <?php include('partials/_header.php'); ?>
    <style>
        .list-group>a {
            color: black;
        }

        .outer {
            min-height: 85vh;
        }

        .date {
            font-size: 13px;
            margin: 0 20px;
            font-weight: 100;
        }

        .tc {
            width: 60vw !important;
        }
    </style>
</head>

<body>
    <div class="container outer">
        <h1 class="text-center my-3 text-secondary">My Posts</h1>
        <?php
        $user_is = $_SESSION['auth']['sno'];
        $q = "SELECT * FROM threads WHERE thread_user_id = '$user_is'";
        $qr = mysqli_query($conn, $q);
        if (mysqli_num_rows($qr) > 0) :
            while ($row = mysqli_fetch_assoc($qr)) :
        ?>
                <div class="tc d-flex align-items-center my-5 mx-auto">
                    <div class="flex-shrink-0 align-self-start">
                        <img src="img/user.png" alt="image for user" width="34px">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="my-0 fs-5 pb-1 text-secondary"><?= $_SESSION['auth']['username'] ?></h6>
                        <h6 class="m-0"><a class="text-dark text-decoration-none" href="<?= $main_url ?>thread.php?threadid='<?= $row['thread_id'] ?>'"><?= $row['thread_title'] ?><small class="text-secondary date"><?= $row['date'] ?></small></a></h6>
                        <?= $row['thread_desc'] ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="container my-5">
                <div class="p-5 text-center bg-body-tertiary rounded-3">
                    <h1 class="text-body-emphasis">
                        <div class="container my-5">
                            <div class="p-5 text-center bg-body-tertiary rounded-3">
                                <h1 class="text-body-emphasis">You Dont't Have Any Posts Yet!</h1>
                                <p class="lead">
                                    Make some post and they will appear here.
                                </p>
                            </div>
                        </div>
                    </h1>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php include('partials/_footer.php'); ?>
</body>

</html>