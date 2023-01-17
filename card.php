<?php include_once("functions.php"); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Pencarian Anime</title>
</head>

<body>
    <?php
    if (isset($_GET['title'])) {
        $keyword = $_GET["name"];
        if ($response = searchAnime($keyword))
    ?>
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <?php echo "<img src='" . $response['img'] . "' class='img-fluid rounded-start' >" ?>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $response['title']; ?></h5>
                        <p class="card-text"></p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <a href='index.php'>
                            <button class='btn btn-info'>Kembali</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <?php
    } else
        echo "ERROR";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>