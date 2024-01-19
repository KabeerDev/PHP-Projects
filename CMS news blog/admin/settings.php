<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Website Settings</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php if (isset($_SESSION['error'])) : ?>
                    <div class="error text-danger text-center" style="padding-bottom: 10px;font-size: 20px;"><?= $_SESSION['error'] ?></div>
                <?php
                    unset($_SESSION['error']);
                endif;
                ?>
                <?php
                $q = "SELECT * FROM settings";
                $qr = mysqli_query($conn, $q);
                $setting_data = mysqli_fetch_assoc($qr);
                ?>
                <!-- Form -->
                <form action="<?= $main_url ?>actions/save-settings.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="website_name">Website Name</label>
                        <input type="text" name="website_name" value="<?= $setting_data['websitename'] ?>" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="logo">Website Logo</label>
                        <input type="file" name="logo[]">
                        <img src="images/<?= $setting_data['logo'] ?>" width="200px">
                        <input type="hidden" name="old_logo" value="<?= $setting_data['logo'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="footer_desc">Footer Description</label>
                        <textarea name="footer_desc" class="form-control" rows="5" required>
                        <?= $setting_data['footerdesc'] ?>
                        </textarea>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                </form>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>