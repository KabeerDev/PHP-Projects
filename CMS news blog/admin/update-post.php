<?php
include "header.php";

if ($_SESSION['auth']['role'] == 0) {
    $id = $_GET['post_id'];
    $q = "SELECT author FROM post WHERE post_id='$id'";
    $qr = mysqli_query($conn, $q);
    $post_data = mysqli_fetch_assoc($qr);
    if ($post_data['author'] != $_SESSION['auth']['user_id']) {
        header("Location: " . $main_url . "admin/post.php");
    }
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form for show edit-->
                <form action="<?= $main_url ?>actions/update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="error text-danger text-center" style="padding-bottom: 10px;font-size: 20px;"><?= $_SESSION['error'] ?></div>
                    <?php
                        unset($_SESSION['error']);
                    endif;
                    ?>
                    <?php
                    $id = $_GET['post_id'];
                    $q = "SELECT * FROM post WHERE post_id='$id'";
                    $qr = mysqli_query($conn, $q);
                    $post_data = mysqli_fetch_assoc($qr);

                    $q1 = "SELECT * FROM category";
                    $qr1 = mysqli_query($conn, $q1);
                    ?>
                    <div class="form-group">
                        <input type="hidden" name="post_id" class="form-control" value="<?= $id ?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputTile">Title</label>
                        <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?= $post_data['title'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" class="form-control" rows="5">
                        <?= $post_data['description'] ?>
                </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCategory">Category</label>
                        <select class="form-control" name="category">
                            <?php
                            while ($row = mysqli_fetch_assoc($qr1)) :
                                if ($row['category_id'] == $post_data['category']) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                            ?>
                                <option value="<?= $row['category_id'] ?>" <?= $selected ?>><?= $row['category_name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                        <input type="hidden" name="old_cat" value="<?= $post_data['category'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Post image</label>
                        <input type="file" name="new-image[]">
                        <img src="<?= $main_url ?>admin/upload/<?= $post_data['post_img'] ?>" height="150px">
                        <input type="hidden" name="old-image" value="<?= $post_data['post_img'] ?>">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                </form>
                <!-- Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>