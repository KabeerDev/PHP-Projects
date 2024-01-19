<?php
include "header.php";
if ($_SESSION['auth']['role'] != 1) {
    header("Location: " . $main_url . "admin/post.php");
}
?>
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
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
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

                $catQuery = "SELECT * FROM category ORDER BY category_id DESC LIMIT $offset, $limit";
                $catQueryRun = mysqli_query($conn, $catQuery);
                $catNum = mysqli_num_rows($catQueryRun);

                if ($catNum > 0) :
                ?>
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Category Name</th>
                            <th>No. of Posts</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <?php
                        $i = $offset + 1;
                        while ($row = mysqli_fetch_assoc($catQueryRun)) :
                        ?>
                            <tbody>
                                <tr>
                                    <td class='id'><?= $i ?></td>
                                    <td><?php echo $row['category_name']; ?></td>
                                    <td><?= $row['post'] ?></td>
                                    <td class='edit'><a href='<?= $main_url ?>admin/update-category.php?category_id=<?= $row['category_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='<?= $main_url ?>actions/delete-category.php?category_id=<?= $row['category_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            </tbody>
                        <?php
                            $i++;
                        endwhile;
                        ?>
                    </table>
                <?php else : ?>
                    <h1 class="text-center text-primary">No Categories available right now.</h1>
                <?php endif; ?>
                <?php
                $q1 = "SELECT * FROM category";
                $q1r = mysqli_query($conn, $q1);
                if (mysqli_num_rows($q1r) > 0) {
                    $totalRecords = mysqli_num_rows($q1r);
                    $totalPage = ceil($totalRecords / $limit);
                    echo "<ul class='pagination admin-pagination'>";
                    if ($page > 1) {
                        echo "<li><a href='" . $main_url . "admin/category.php?page=" . ($page - 1) . "'>Prev</a></li>";
                    } else {
                        echo "<li class='disabled'><a>Prev</a></li>";
                    }
                    for ($i = 1; $i <= $totalPage; $i++) {
                        if ($i == $page) {
                            $active = "active";
                        } else {
                            $active = "";
                        }
                        echo "<li class='" . $active . "'><a href='category.php?page=$i'>" . $i . "</a></li>";
                    }
                    if ($page < $totalPage) {
                        echo "<li><a href='" . $main_url . "admin/category.php?page=" . ($page + 1) . "'>Next</a></li>";
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