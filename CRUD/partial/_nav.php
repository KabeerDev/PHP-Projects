<?php
if (isset($_SESSION["loggedin"]) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
} else {
    $loggedin = false;
}
?>
<style>
    nav {
        background: transparent;
    }

    .me-auto {
        display: flex;
        gap: 20px;
    }

    .me-auto li a:hover {
        text-decoration: underline;
    }

    .logo {
        width: 50px;
        height: 50px;
        border-radius: 7px;
    }
</style>
<?php
echo '<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand text-light p-0" href="../.22 (Login System)/Welcome.php" style="font-size: 35px;margin: 0 20px;"><img src="logo.png" alt="image for logo" class="logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-5" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-light" aria-current="page" href="../.21 (CRUD)/index.php">Home</a>
                </li>';
if (!$loggedin) {
    echo '<li class="nav-item">
                                        <a class="nav-link text-light" href="../.21 (CRUD)/Login.php">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-light" href="../.21 (CRUD)/Signup.php">Signup</a>
                                    </li>';
}
if ($loggedin) {
    echo '<li class="nav-item">
                                        <a class="nav-link text-light" href="../.21 (CRUD)/logout.php">Logout</a>
                                    </li>';
}
echo '</ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>';
?>