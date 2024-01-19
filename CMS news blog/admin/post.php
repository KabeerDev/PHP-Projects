<?php include "header.php"; ?>
<?php if (isset($_SESSION['success'])) : ?>
    <div class="error text-success text-center" style="padding: 10px 0;font-size: 20px;"><?= $_SESSION['success'] ?></div>
<?php
    unset($_SESSION['success']);
endif;
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
                <?php
                $limit = 3;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $offset = ($page - 1) * $limit;

                if ($_SESSION['auth']['role'] == 1) {
                    $postQuery = "SELECT * FROM post ORDER BY post_id DESC LIMIT $offset, $limit";
                    $postQueryRun = mysqli_query($conn, $postQuery);
                    $postNum = mysqli_num_rows($postQueryRun);
                } elseif ($_SESSION['auth']['role'] == 0) {
                    $postQuery = "SELECT * FROM post WHERE author='" . $_SESSION['auth']['user_id'] . "' ORDER BY post_id DESC LIMIT $offset, $limit";
                    $postQueryRun = mysqli_query($conn, $postQuery);
                    $postNum = mysqli_num_rows($postQueryRun);
                }

                if ($postNum > 0) :
                ?>
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Author</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <?php
                        $i = $offset + 1;
                        while ($row = mysqli_fetch_assoc($postQueryRun)) :
                            $q1 = "SELECT category_name FROM category WHERE category_id='{$row['category']}'";
                            $qr1 = mysqli_query($conn, $q1);
                            $cat_name = mysqli_fetch_assoc($qr1);

                            $q2 = "SELECT username FROM user WHERE user_id='{$row['author']}'";
                            $qr2 = mysqli_query($conn, $q2);
                            $author = mysqli_fetch_assoc($qr2);
                        ?>
                            <tbody>
                                <tr>
                                    <td class='id'><?= $i ?></td>
                                    <td><?= $row['title'] ?></td>
                                    <td><?= join("", $cat_name) ?></td>
                                    <td>
                                        <?= $row['post_date'] ?>
                                    </td>
                                    <td><?= join("", $author) ?></td>
                                    <td class='edit'><a href='<?= $main_url ?>admin/update-post.php?post_id=<?= $row['post_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='<?= $main_url ?>actions/delete-post.php?post_id=<?= $row['post_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            </tbody>
                        <?php
                            $i++;
                        endwhile;
                        ?>
                    </table>
                <?php else : ?>
                    <h1 class="text-center text-primary">No posts available right now</h1>
                <?php endif; ?>
                <?php
                if ($_SESSION['auth']['role'] == 1) {
                    $q1 = "SELECT * FROM post";
                    $q1r = mysqli_query($conn, $q1);
                } elseif ($_SESSION['auth']['role'] == 0) {
                    $q1 = "SELECT * FROM post WHERE author='" . $_SESSION['auth']['user_id'] . "'";
                    $q1r = mysqli_query($conn, $q1);
                }

                if (mysqli_num_rows($q1r) > 0) {
                    $totalRecords = mysqli_num_rows($q1r);
                    $totalPage = ceil($totalRecords / $limit);
                    echo "<ul class='pagination admin-pagination'>";
                    if ($page > 1) {
                        echo "<li><a href='" . $main_url . "admin/post.php?page=" . ($page - 1) . "'>Prev</a></li>";
                    } else {
                        echo "<li class='disabled'><a>Prev</a></li>";
                    }
                    for ($i = 1; $i <= $totalPage; $i++) {
                        if ($i == $page) {
                            $active = "active";
                        } else {
                            $active = "";
                        }
                        echo "<li class='" . $active . "'><a href='post.php?page=$i'>" . $i . "</a></li>";
                    }
                    if ($page < $totalPage) {
                        echo "<li><a href='" . $main_url . "admin/post.php?page=" . ($page + 1) . "'>Next</a></li>";
                    } else {
                        echo "<li class='disabled'><a>Next</a></li>";
                    }
                    echo "</ul>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>