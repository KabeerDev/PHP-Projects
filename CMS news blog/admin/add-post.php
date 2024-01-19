<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <form action="<?= $main_url ?>actions/add-post.php" method="POST" enctype="multipart/form-data">
                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="error text-danger text-center" style="padding-bottom: 10px;font-size: 20px;"><?= $_SESSION['error'] ?></div>
                    <?php
                        unset($_SESSION['error']);
                    endif;
                    ?>
                    <div class="form-group">
                        <label for="post_title">Title</label>
                        <input type="text" name="post_title" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Category</label>
                        <select name="category" class="form-control">
                            <option hidden> Select Category</option>
                            <?php
                            $q = "SELECT * FROM category";
                            $qr = mysqli_query($conn, $q);
                            if (mysqli_num_rows($qr) > 0) {
                                while ($row = mysqli_fetch_assoc($qr)) {
                                    echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Post image</label>
                        <input type="file" name="fileToUpload[]">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save" />
                </form>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>