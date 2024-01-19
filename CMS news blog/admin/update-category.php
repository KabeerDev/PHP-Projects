<?php
include "header.php";
if ($_SESSION['auth']['role'] != 1) {
    header("Location: " . $main_url . "admin/post.php");
}
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                $cat_id = $_GET['category_id'];
                $q = "SELECT * FROM category WHERE category_id='$cat_id'";
                $qr = mysqli_query($conn, $q);
                while ($row = mysqli_fetch_assoc($qr)) :
                ?>
                    <form action="<?= $main_url ?>actions/update-category.php" method="POST">
                        <?php if (isset($_SESSION['error'])) : ?>
                            <div class="error text-danger text-center" style="padding-bottom: 10px;font-size: 20px;"><?= $_SESSION['error'] ?></div>
                        <?php
                            unset($_SESSION['error']);
                        endif;
                        ?>
                        <div class="form-group">
                            <input type="hidden" name="cat_id" class="form-control" value="<?= $row['category_id'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="cat_name" class="form-control" value="<?= $row['category_name'] ?>" placeholder="" required>
                        </div>
                        <input type="submit" name="sumbit" class="btn btn-primary" value="Update" />
                    </form>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>