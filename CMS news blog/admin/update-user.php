<?php
include("header.php");
if ($_SESSION['auth']['role'] != 1) {
    header("Location: " . $main_url . "admin/post.php");
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <?php
            $id = $_GET['user_id'];
            $userUpdateQuery = "SELECT * FROM user WHERE user_id='$id'";
            $userUpdateQueryRun = mysqli_query($conn, $userUpdateQuery);
            ?>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <?php while ($row = mysqli_fetch_assoc($userUpdateQueryRun)) : ?>
                    <form action="<?= $main_url ?>actions/update-user.php" method="POST">
                        <?php if (isset($_SESSION['error'])) : ?>
                            <div class="error text-danger text-center" style="padding-bottom: 10px;font-size: 20px;"><?= $_SESSION['error'] ?></div>
                        <?php
                            unset($_SESSION['error']);
                        endif;
                        ?>
                        <div class="form-group">
                            <input type="hidden" name="user_id" class="form-control" value="<?= $row['user_id'] ?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="f_name" class="form-control" value="<?= $row['first_name'] ?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="l_name" class="form-control" value="<?= $row['last_name'] ?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="username" class="form-control" value="<?= $row['username'] ?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>User Role</label>
                            <select class="form-control" name="role">
                                <?php if ($row['role'] == 1) : ?>
                                    <option value="0">Normal User</option>
                                    <option value="1" selected>Admin</option>
                                <?php else : ?>
                                    <option value="0" <?php echo ($row['role'] == 0) ? 'selected' : ''; ?>>Normal User</option>
                                    <option value="1">Admin</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                    </form>
                <?php endwhile; ?>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>