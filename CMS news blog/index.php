<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    include("common.php");
                    $limit = 3;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;

                    $postQuery = "SELECT * FROM post ORDER BY post_id DESC LIMIT $offset, $limit";
                    $postQueryRun = mysqli_query($conn, $postQuery);
                    $postNum = mysqli_num_rows($postQueryRun);
                    if ($postNum > 0) :
                        while ($row = mysqli_fetch_assoc($postQueryRun)) :
                            $q1 = "SELECT category_name FROM category WHERE category_id='{$row['category']}'";
                            $qr1 = mysqli_query($conn, $q1);
                            $cat_name = mysqli_fetch_assoc($qr1);

                            $q2 = "SELECT username FROM user WHERE user_id='{$row['author']}'";
                            $qr2 = mysqli_query($conn, $q2);
                            $author = mysqli_fetch_assoc($qr2);
                    ?>

                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?= $row['post_id'] ?>"><img src="admin/upload/<?= $row['post_img'] ?>" alt="image for post" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?= $row['post_id'] ?>'><?= $row['title'] ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?c_id=<?= $row['category'] ?>'><?= $cat_name['category_name'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?a_id=<?= $row['author'] ?>'><?= $author['username'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?= $row['post_date'] ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php
                                                $desc = substr($row['description'], 0, 135);
                                                echo $desc . " ...";
                                                ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?= $row['post_id'] ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <h1 class="text-center text-primary">No posts available right now</h1>
                    <?php endif; ?>
                    <?php
                    $q1 = "SELECT * FROM post";
                    $q1r = mysqli_query($conn, $q1);
                    if (mysqli_num_rows($q1r) > 0) {
                        $totalRecords = mysqli_num_rows($q1r);
                        $totalPage = ceil($totalRecords / $limit);
                        echo "<ul class='pagination admin-pagination'>";
                        if ($page > 1) {
                            echo "<li><a href='" . $main_url . "index.php?page=" . ($page - 1) . "'>Prev</a></li>";
                        } else {
                            echo "<li class='disabled'><a>Prev</a></li>";
                        }
                        for ($i = 1; $i <= $totalPage; $i++) {
                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = "";
                            }
                            echo "<li class='" . $active . "'><a href='index.php?page=$i'>" . $i . "</a></li>";
                        }
                        if ($page < $totalPage) {
                            echo "<li><a href='" . $main_url . "index.php?page=" . ($page + 1) . "'>Next</a></li>";
                        } else {
                            echo "<li class='disabled'><a>Next</a></li>";
                        }
                        echo "</ul>";
                    }
                    ?>
                </div>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>