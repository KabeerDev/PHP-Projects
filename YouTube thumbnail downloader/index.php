<?php
if (isset($_POST['download'])) {
    $imgUrl = $_POST['imgurl'];
    $ch = curl_init($imgUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $download = curl_exec($ch);
    curl_close($ch);
    header("Content-type: image/jpg");
    header('Content-Disposition: attachment; filename="thumbnail.jpg"');
    echo $download;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,500;0,600;1,700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Download Youtube Thumbnail</title>
</head>

<body>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <header>Download Thumbnail</header>
        <div class="url-input">
            <span class="title">Paste Video url:</span>
            <div class="field">
                <input type="text" placeholder="https://www.youtube.com/watch?v=lqwd2ivTbM" required>
                <input type="hidden" class="hidden-input" name="imgurl">
                <div class="bottom-line"></div>
            </div>
        </div>
        <div class="preview-area">
            <img class="thumbnail" src="" alt="image for thumbnail">
            <i class="fas fa-cloud-download-alt"></i>
            <span>Paste Video url to see preview</span>
        </div>
        <button class="download-btn" type="submit" name="download">Download Thumbnail</button>
    </form>
    <script src="js/script.js"></script>
</body>

</html>