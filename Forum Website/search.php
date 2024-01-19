<?php
include_once("partials/common.php");
if (empty($_GET['search'])) {
    header('Location: ' . $main_url . '');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .main_container {
            min-height: 80vh;
        }
    </style>
    <title>Code Connect | Search Result</title>
</head>

<body>
    <?php
    require_once("partials/_header.php");
    ?>

    <!-- Search results -->
    <div class="container main_container">
        <h1 class="text-center py-3 text-secondary">Search Results for "<em><?= $_GET['search'] ?></em>"</h1>
        <?php
        $query = $_GET["search"];
        $sql = "SELECT * FROM `threads` WHERE MATCH (`thread_title`, `thread_desc`) against('$query')";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $url = $main_url . "thread.php?threadid=" . $thread_id;
            echo "<div class='result'>
            <a href='" . $url . "' class='text-dark text-decoration-none'>
                <h3>" . $title . "</h3>
            </a>
            <p>" . $desc . "</p>
        </div>";
        }
        if (mysqli_num_rows($result) == 0) {
            echo '<div class="my-3 row">
                    <div class="container col-6">
                        <p class="display-4">No Matching Results Found</p>
                        <p class="lead"> Suggestions: 
                        <ul>
                            <li>Make sure that all the words all spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords.</li>
                        </ul>
                        </p>
                    </div>
                </div>';
        }
        ?>

    </div>
    <?php require_once("partials/_footer.php") ?>
</body>

</html>