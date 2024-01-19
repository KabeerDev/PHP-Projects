<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'notes';
$conn = mysqli_connect($servername, $username, $password, $database);

$run = false;
$update = false;
$sql = false;
if (isset($_POST['nt']) && !empty($_POST['title']) && !empty($_POST['desc'])) {
    if ($_POST) {
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $ins = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$desc')";
        $run = mysqli_query($conn, $ins);
        if ($run) {
            $run = true;
        } else {
            echo 'The was not created because of this error -->' . mysqli_error($con);
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iNotes - Notes making take easy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        * {
            font-family: sans-serif;
        }

        small {
            font-size: 13px;
            color: red;
        }

        .logo {
            width: 50px;
            height: 50px;
            border-radius: 7px;
        }
    </style>
</head>

<body>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit this note</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/projects/.21 (CRUD)/index.php" method="post">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div>
                            <label for="titleEdit" class="form-label">Note Title</label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
                        </div>
                        <?php
                        if (isset($_POST['change'])) {
                            if (empty($_POST['titleEdit'])) {
                                echo '<small>Please enter note title!</small>';
                            }
                        }
                        ?>
                        <div class="form-floating mb-0 my-4">
                            <textarea class="form-control" placeholder="Leave a comment here" id="descriptionEdit" name="descEdit"></textarea>
                            <label for="desc">Note Description</label>
                        </div>
                        <?php
                        if (isset($_POST['change'])) {
                            if (empty($_POST['descEdit'])) {
                                echo '<small>Please enter note description!</small>';
                            }
                        }
                        ?>
                        <div class="modal-footer">
                            <input type="submit" value="Save Changes" class="btn btn-primary m-2" name="change">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['change']) && !empty($_POST['titleEdit']) && !empty($_POST['descEdit'])) {
        $sno = $_POST['snoEdit'];
        $title = $_POST['titleEdit'];
        $desc = $_POST['descEdit'];
        $ins = "UPDATE `notes` SET `title` = '$title', `description` = '$desc' WHERE `notes`.`sno` = '$sno'";
        $update = mysqli_query($conn, $ins);
        if ($update) {
            $update = true;
        } else {
            echo 'The was not created because of this error -->' . mysqli_error($con);
        }
    }
    ?>
    <?php
    require_once('partial/_nav.php');
    ?>

    <?php
    if ($run == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your note was created.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if ($update == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your note was updated!.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $del = "DELETE FROM `notes` WHERE `notes`.`sno` = $id";
        $sql = mysqli_query($conn, $del);
        $sql = true;
    }
    if ($sql == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your note was deleted! Reload the page.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <div class="container my-4">
        <h2 class="my-3 mb-3">Add a Note</h2>
        <form action="/projects/.21 (CRUD)/index.php" method="post">
            <div>
                <label for="title" class="form-label">Note Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>
            <?php
            if (isset($_POST['nt'])) {
                if (empty($_POST['title'])) {
                    echo '<small>Please enter note title!</small>';
                }
            }
            ?>
            <div class="form-floating mb-0 my-4">
                <textarea class="form-control" placeholder="Leave a comment here" id="desc" name="desc"></textarea>
                <label for="desc">Note Description</label>
            </div>
            <?php
            if (isset($_POST['nt'])) {
                if (empty($_POST['desc'])) {
                    echo '<small>Please enter note description!</small><br>';
                }
            }
            ?>
            <button type="submit" class="btn btn-primary my-3" name='nt' id="liveAlertBtn">Add Note</button>
        </form>
    </div>
    <div class="container mb-3">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Desc</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = 'SELECT * FROM `notes`';
                $run = mysqli_query($conn, $sql);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($run)) {
                    $sno = $sno + 1;
                    echo '<tr>
                <th scope="row">' . $sno . '</th>
                <td class="tt">' . $row["title"] . '</td>
                <td class="ds">' . $row["description"] . '</td>
                <td><button class="edit btn btn-primary m-2" id=' . $row["sno"] . ' data-bs-toggle="modal" data-bs-target="#editModal">Edit</button> <a href="index.php?id=' . $row['sno'] . '" class="del btn btn-primary" name = "del">Delete</a>
                </tr>';
                }
                ?>

            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        let table = $('#myTable').DataTable();
    </script>
    <script>
        $('#myTable').on('click', '.edit', function(e) {
            let title = $(this).closest('tr').find('.tt').text();
            let description = $(this).closest('tr').find('.ds').text();
            $('#titleEdit').val(title);
            $('#descriptionEdit').val(description);
            $('#snoEdit').val(e.target.id);
        });
    </script>
</body>

</html>