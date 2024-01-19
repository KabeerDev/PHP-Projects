<?php
echo '<nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="' . $main_url . 'index.php"><img src="img/logo.png" alt="image for logo" class="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active mt-2 text-dark" aria-current="page" href="' . $main_url . 'index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle mt-2 text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu bg-transparent border border-light-subtle">';
$sql = "SELECT category_name, category_id FROM `categories` LIMIT 4";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo '<li><a class="dropdown-item text-light" href="' . $main_url . 'threadlist.php?catid=' . $row['category_id'] . '">' . $row['category_name'] . '</a></li>';
}
echo '</ul>
                        </li>
                    </ul>
                    <div class="d-flex mx-2">
                    <form class="d-flex" role="search" method="get" action="' . $main_url . 'search.php">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-info" type="submit" name="search_btn">Search</button>
                </form>';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo '<img src="' . $main_url . 'img/user.png" style="width: 50px;cursor: pointer;" alt="profile image" class="ms-4 me-2 img">';
} else {
    echo '<a href="' . $main_url . 'partials/_login.php"><button class="btn btn-outline-light ms-2">Login</button></a>
                            <a href="' . $main_url . '_signup.php"><button class="btn btn-outline-light ms-2">Signup</button></a>';
}
echo '</div>
                </div>
            </div>
        </nav>';
?>
<div class="list-group d_none user_menu position-absolute end-0 me-3">
    <a href="#" class="list-group-item list-group-item-action disabled fw-bold fs-5 d-flex flex-column align-items-center" aria-current="true">
        <?= $_SESSION['auth']['username'] ?>
        <small style="font-size: 13px;"><?= $_SESSION['auth']['email'] ?></small>
    </a>
    <a href="<?= $main_url ?>profile-update.php" class="list-group-item list-group-item-action">Update profile</a>
    <a href="<?= $main_url ?>my-posts.php" class="list-group-item list-group-item-action">My Posts</a>
    <a href="<?= $main_url ?>partials/_logout.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><span>Logout</span> <i class="fa-solid fa-arrow-right"></i></a>
</div>