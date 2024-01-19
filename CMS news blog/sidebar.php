<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
        include("common.php");
        $q = "SELECT * FROM post ORDER BY post_id DESC LIMIT 3";
        $qr = mysqli_query($conn, $q);
        $num = mysqli_num_rows($qr);
        if ($num > 0) :
            while ($row = mysqli_fetch_assoc($qr)) :
                $q1 = "SELECT * FROM category WHERE category_id='" . $row['category'] . "'";
                $qr1 = mysqli_query($conn, $q1);
                $cat_data = mysqli_fetch_assoc($qr1);
        ?>
                <div class="recent-post">
                    <a class="post-img" href="single.php?id=<?= $row['post_id'] ?>">
                        <img src="admin/upload/<?= $row['post_img'] ?>" alt="image for post" />
                    </a>
                    <div class="post-content">
                        <h5><a href="single.php?id=<?= $row['post_id'] ?>"><?= $row['title'] ?></a></h5>
                        <span>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <a href='category.php?c_id=<?= $row['category'] ?>'><?= $cat_data['category_name'] ?></a>
                        </span>
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?= $row['post_date'] ?>
                        </span>
                        <a class="read-more" href="single.php?id=<?= $row['post_id'] ?>">read more</a>
                    </div>
                </div>
        <?php
            endwhile;
        endif;
        ?>
    </div>
    <!-- /recent posts box -->
</div>