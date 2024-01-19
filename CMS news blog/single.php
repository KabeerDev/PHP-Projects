<?php
include 'header.php';
include 'common.php';
?>
<?php
$id = $_GET['id'];

$postQuery = "SELECT * FROM post WHERE post_id='$id'";
$postQueryRun = mysqli_query($conn, $postQuery);
$post_row = mysqli_fetch_assoc($postQueryRun);

$q1 = "SELECT * FROM category WHERE category_id='{$post_row['category']}'";
$qr1 = mysqli_query($conn, $q1);
$cat_row = mysqli_fetch_assoc($qr1);

$q2 = "SELECT * FROM user WHERE user_id='{$post_row['author']}'";
$qr2 = mysqli_query($conn, $q2);
$author = mysqli_fetch_assoc($qr2);
?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <div class="post-content single-post">
                        <h3><?= $post_row['title'] ?></h3>
                        <div class="post-information">
                            <span>
                                <i class="fa fa-tags" aria-hidden="true"></i>
                                <a href="category.php?c_id=<?= $cat_row['category_id'] ?>"><?= $cat_row['category_name'] ?></a>
                            </span>
                            <span>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <a href='author.php?a_id=<?= $author['user_id'] ?>'><?= $author['username'] ?></a>
                            </span>
                            <span>
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <?= $post_row['post_date'] ?>
                            </span>
                        </div>
                        <img class="single-feature-image" src="admin/upload/<?= $post_row['post_img'] ?>" alt="image for post" />
                        <p class="description">
                            <?= $post_row['description'] ?>
                        </p>
                    </div>
                </div>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>