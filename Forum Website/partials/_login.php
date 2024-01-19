<?php
include_once("common.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .signup {
            width: 40vw;
            border-width: 1px !important;
            border-style: dashed !important;
            border-radius: 15px;
        }

        form ::placeholder {
            font-size: 14px;
        }

        .lower {
            margin: auto;
            width: fit-content;
        }

        .s_btn:hover {
            transition: transform 0.2s ease-in;
            transform: scale(1.05);
        }

        .img {
            width: 35vw;
        }

        .error {
            font-size: 13px;
        }
    </style>
    <title>Login | CodeConnect</title>
</head>

<body>
    <?php
    if (isset($_POST['login'])) {
        if (!empty($_POST['username'] && $_POST['pass'])) {
            $name = $_POST['username'];
            $password = $_POST['pass'];
            $sql = "SELECT * FROM users WHERE username = '$name'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row['password'])) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $name;
                    $_SESSION['sno'] = $row['sno'];
                    $_SESSION['auth'] = $row;
                    header('Location: /projects/.23 (Online Forum Website)/index.php');
                } else {
                    $error2 = '<div class="error mb-2 text-danger">Incorrect password!</div>';
                }
            } else {
                $error1 = '<div class="error mb-2 text-danger">Incorrect username!</div>';
            }
        }
    }
    ?>
    <?php include("_header.php"); ?>
    <div class="container-fluid d-flex my-3 align-items-center justify-content-evenly">
        <img src="../img/login.jpg" alt="image for signup form" class="img align-self-start">
        <div class="signup container my-3 border border-secondary px-5 py-3 mx-0">
            <h2 class="py-2 text-secondary text-center fs-1">Login</h2>
            <form action="/projects/.23 (Online Forum Website)/partials/_login.php" method="post">
                <div class="mb-2">
                    <label for="username" class="form-label text-body-secondary">Username</label>
                    <input type="text" maxlength="25" class="form-control" placeholder="Enter username" id="username" name="username">
                </div>
                <?php
                if (isset($_POST['login'])) {
                    if (empty($_POST['username'])) {
                        echo "<div class='error mb-2 text-danger'>Username cannot be empty!</div>";
                    }
                    if (isset($error1) && !empty($_POST['username'])) {
                        echo $error1;
                    }
                }
                ?>
                <div class="mb-2">
                    <label for="pass" class="form-label text-body-secondary">Password</label>
                    <input type="password" class="form-control" placeholder="Choose password" id="pass" name="pass">
                </div>
                <?php
                if (isset($_POST['login'])) {
                    if (empty($_POST['pass'])) {
                        echo "<div class='error mb-2 text-danger'>Password cannot be empty!</div>";
                    }
                    if (isset($error2) && !empty($_POST['pass'])) {
                        echo $error2;
                    }
                }
                ?>
                <div class="lower d-flex flex-column align-items-center">
                    <p>Don't have an account &emsp; <a href="<?php echo $main_url; ?>partials/_signup.php">Register</a></p>
                    <button type="submit" name="login" class="s_btn btn btn-primary mb-3 mt-1 bg-dark border-0">Login</button>
                </div>
            </form>
        </div>
    </div>
    <?php require_once("_footer.php") ?>
    </script>
</body>

</html>