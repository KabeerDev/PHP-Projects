<?php
include_once("partials/common.php");
if (!isset($_SESSION['auth'])) {
    header('Location: ' . $main_url);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php include("partials/_header.php"); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .p_update {
            width: 80vw;
            min-height: 82vh;
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

        .list-group>a {
            color: black;
        }

        .icon {
            position: absolute;
            left: 52%;
            top: 280px;
        }

        .icon:hover {
            opacity: 0.5;
            cursor: pointer;
        }

        .modal-body {
            min-height: 20rem;
            display: flex;
            flex-wrap: wrap;
            flex-wrap: wrap;
            align-items: center;
            gap: 20px 14px;
        }

        .modal-body>img:hover {
            transition: all 0.2s ease-in;
            transform: scale(1.1);
            cursor: pointer;
        }

        .selected {
            transform: scale(1.2);
            border: 5px solid green;
        }
    </style>
    <title>Update Profile | CodeConnect</title>
</head>

<body>
    <?php
    if (isset($_SESSION['error'])) {
        echo '<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger">
          <strong class="me-auto">Error</strong>
          <small>11 mins ago</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        ' . $_SESSION['error'] . '
        </div>
      </div>';
    }
    ?>
    <div class="d-flex flex-column p_update container my-3 border border-secondary px-5 py-3 mx-auto">
        <h2 class="py-2 text-secondary text-center fs-1">Update Profile</h2>
        <!-- <img width="100px" class="align-self-center mb-4" src="<?= $main_url ?>img/user.png" alt="profile image">
        <form action="">
            <i class="icon fa-regular fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#profile_pic"></i>
            <input type="file">
        </form> -->
        <form action="/projects/.23 (Online Forum Website)/partials/_profile-update.php" method="post">
            <div class="main row d-flex justify-content-evenly py-3">
                <div class="upper col-5">
                    <div class="mb-2">
                        <label for="username" class="form-label text-body-secondary">Username</label>
                        <input type="text" maxlength="25" class="form-control" placeholder="Enter username" id="username" name="new_username" value="<?= $_SESSION['auth']['username'] ?>">
                    </div>
                    <div class="mb-2">
                        <label for="pass" class="form-label text-body-secondary">Old Email</label>
                        <input type="email" class="form-control" placeholder="Enter Old Email" id="old_email" name="old_email" value="<?= $_SESSION['auth']['email'] ?>">
                    </div>
                    <div class="mb-2">
                        <label for="pass" class="form-label text-body-secondary">New Email</label>
                        <input type="email" class="form-control" placeholder="Enter New Email" id="new_email" name="new_email">
                    </div>
                </div>
                <div class="lower2 col-5">
                    <div class="mb-2">
                        <label for="username" class="form-label text-body-secondary">Old Password</label>
                        <input type="password" maxlength="25" class="form-control" placeholder="Enter Old Password" id="old_pass" name="old_pass">
                    </div>
                    <div class="mb-2">
                        <label for="pass" class="form-label text-body-secondary">New Password</label>
                        <input type="password" class="form-control" placeholder="Enter New Password" id="new_pass" name="new_pass">
                    </div>
                    <div class="mb-2">
                        <label for="pass" class="form-label text-body-secondary">Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Choose password" id="c_pass" name="c_pass">
                    </div>
                </div>
            </div>
            <div class="lower d-flex flex-column align-items-center">
                <button type="submit" name="update" class="s_btn btn btn-primary mb-3 mt-1 bg-dark border-0">Save Changes</button>
            </div>
        </form>
    </div>
    <?php require_once("partials/_footer.php") ?>
</body>

</html>