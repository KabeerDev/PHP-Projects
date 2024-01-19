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
    .secondary_heading {
        color: #5B7E91;
    }
    .card-container {
        max-width: 65rem;
    }
    </style>
    <title>Code Connect | Coding Forums</title>
</head>

<body>
    <?php
    require_once("partials/_header.php");
    if (isset($_GET['signup']) && $_GET['signup'] == "true") {
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Success!</strong> You can now login.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>

    <!-- slider starts here -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/1.jfif" class="d-block w-100" alt="image for slider">
            </div>
            <div class="carousel-item">
                <img src="img/2.jfif" class="d-block w-100" alt="image for slider">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1550x600/?coding-language,programming" class="d-block w-100"
                    alt="image for slider">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- category container starts here -->
    <div class="container card-container my-3 d-flex flex-column align-items-center justify-content-center">
        <h2 class="my-5 text-center fs-1 secondary_heading">CODECONNECT - Browse Categories</h2>
        <div class="container row">
            <?php
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $sql);
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['category_id'];
                $cat = $row['category_name'];
                $desc = $row['category_description'];
                echo '
        <div class="card my-2 mx-3
        " style="width: 18rem;">
            <img class="mt-3" style="height: 200px;border-radius: 10px 10px 0 0;" src="' . $main_url . 'img/card-' . $i . '.jpg" alt="image for card-' . $i . '">
            <div class="card-body">
                <h5 class="card-title"><a class="text-dark text-decoration-none" href="' . $main_url . 'threadlist.php?catid=' . $id . '"> ' . $cat . ' </a></h5>
                <p class="card-text"> ' . substr($desc, 0, 100) . '...</p>
                <a href="' . $main_url . 'threadlist.php?catid=' . $id . '" class="btn btn-primary">View Threads</a>
            </div>
        </div>';
                $i++;
            }
            ?>
        </div>
    </div>
    <?php require_once("partials/_footer.php") ?>
</body>

</html>