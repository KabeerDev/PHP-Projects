<?php
include_once("partials/common.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
            width: 45vw;
        }

        .error {
            font-size: 13px;
        }
    </style>
    <title>Signup | CodeConnect</title>
</head>

<body>
    <?php include("partials/_header.php"); ?>
    <div class="container-fluid d-flex my-3 align-items-center justify-content-evenly">
        <img src="img/sign-up.avif" alt="image for signup form" class="img align-self-start">
        <div class="signup container my-3 border border-secondary px-5 py-3 mx-0">
            <h2 class="py-2 text-secondary text-center fs-1">Signup</h2>

            <form action="<?php $main_url ?>partials/handleSignup.php" method="post">
                <div class="mb-2">
                    <label for="u_name" class="form-label text-body-secondary">Username</label>
                    <input type="text" maxlength="25" class="form-control" placeholder="Enter username" id="u_name" name="u_name">
                </div>
                <div class="mb-2">
                    <label for="email" class="form-label text-body-secondary">Email address</label>
                    <input type="email" maxlength="40" class="form-control" placeholder="Enter email" id="email" name="email" aria-describedby="emailHelp">
                </div>
                <div class="mb-2">
                    <label for="password" class="form-label text-body-secondary">Password</label>
                    <input type="password" class="form-control" placeholder="Choose password" id="password" name="password">
                </div>
                <div class="mb-2">
                    <label for="cpassword" class="form-label text-body-secondary">Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Confirm password" id="cpassword" name="cpassword">
                </div>
                <div class="lower d-flex flex-column align-items-center">
                    <p>Already have an account &emsp; <a href="<?php echo $main_url; ?>_login.php">Login</a></p>
                    <button type="submit" name="signup" class="s_btn btn btn-primary mb-3 mt-1 bg-dark border-0">Signup</button>
                </div>
            </form>
        </div>
    </div>
    <?php include('partials/_footer.php'); ?>
</body>

</html>