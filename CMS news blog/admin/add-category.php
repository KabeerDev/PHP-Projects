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
                <h1 class="admin-heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?= $main_url ?>actions/add-category.php" method="POST" autocomplete="off">
                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="error text-danger text-center" style="padding-bottom: 10px;font-size: 20px;"><?= $_SESSION['error'] ?></div>
                    <?php
                        unset($_SESSION['error']);
                    endif;
                    ?>
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat" class="form-control" placeholder="Category Name">
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                </form>
                <!-- /Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>