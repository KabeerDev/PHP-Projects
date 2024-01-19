<div id="footer">
    <div class="container">
        <div class="row">
            <?php
            $q = "SELECT * FROM settings";
            $qr = mysqli_query($conn, $q);
            $setting_data = mysqli_fetch_assoc($qr);
            ?>
            <div class="col-md-12">
                <span><?=$setting_data ['footerdesc'] ?></span>
            </div>
        </div>
    </div>
</div>
</body>

</html>