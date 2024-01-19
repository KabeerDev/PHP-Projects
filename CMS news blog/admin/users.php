<?php
include("header.php");
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
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
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

                $userQuery = "SELECT * FROM user ORDER BY user_id DESC LIMIT $offset, $limit";
                $userQueryRun = mysqli_query($conn, $userQuery);
                $userNum = mysqli_num_rows($userQueryRun);

                if ($userNum > 0) :
                ?>
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Full Name</th>
                            <th>User Name</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <?php
                        $i = $offset + 1;
                        while ($row = mysqli_fetch_assoc($userQueryRun)) :
                        ?>
                            <tbody>
                                <tr>
                                    <td class='id'><?= $i ?></td>
                                    <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td>
                                        <?php
                                        if ($row['role'] == 1) {
                                            echo "admin";
                                        } else {
                                            echo "normal user";
                                        }
                                        ?>
                                    </td>
                                    <td class='edit'><a href='<?= $main_url ?>admin/update-user.php?user_id=<?= $row['user_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='<?= $main_url ?>actions/delete-user.php?user_id=<?= $row['user_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            </tbody>
                        <?php
                            $i++;
                        endwhile;
                        ?>
                    </table>
                <?php else : ?>
                    <h1 class="text-center text-primary">No users available right now</h1>
                <?php endif; ?>
                <?php
                $q1 = "SELECT * FROM user";
                $q1r = mysqli_query($conn, $q1);
                if (mysqli_num_rows($q1r) > 0) {
                    $totalRecords = mysqli_num_rows($q1r);
                    $totalPage = ceil($totalRecords / $limit);
                    echo "<ul class='pagination admin-pagination'>";
                    if ($page > 1) {
                        echo "<li><a href='" . $main_url . "admin/users.php?page=" . ($page - 1) . "'>Prev</a></li>";
                    } else {
                        echo "<li class='disabled'><a>Prev</a></li>";
                    }
                    for ($i = 1; $i <= $totalPage; $i++) {
                        if ($i == $page) {
                            $active = "active";
                        } else {
                            $active = "";
                        }
                        echo "<li class='" . $active . "'><a href='users.php?page=$i'>" . $i . "</a></li>";
                    }
                    if ($page < $totalPage) {
                        echo "<li><a href='" . $main_url . "admin/users.php?page=" . ($page + 1) . "'>Next</a></li>";
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