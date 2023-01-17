<?php
function searchAnime($a)
{
    $a = urlencode($a);
    // $p = urlencode($p);

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://anime-db.p.rapidapi.com/anime?page=1&size=20&genres=" . $a . "&sortOrder=asc",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: anime-db.p.rapidapi.com",
            "X-RapidAPI-Key: 007a9eb161msh2780ccde73f5f67p11ae42jsnb07aa4c3701e"
        ],
    ]);

    $result = curl_exec($curl); // format json
    if (curl_errno($curl)) {
        echo 'Error:' . curl_error($curl);
    }
    curl_close($curl);
    return json_decode($result, true); // returnkan dalam bentuk array assosiatif
}


function searchQAnime($q)
{
    $curl = curl_init($q);

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://top-anime.p.rapidapi.com/anime/" . $q . "",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: top-anime.p.rapidapi.com",
            "X-RapidAPI-Key: 007a9eb161msh2780ccde73f5f67p11ae42jsnb07aa4c3701e"
        ],
    ]);

    $result = curl_exec($curl); // format json
    if (curl_errno($curl)) {
        echo 'Error:' . curl_error($curl);
    }
    curl_close($curl);
    return json_decode($result, true);
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Pencarian Anime</title>
    <script>
        function validasidata() {
            var genre = document.frm.genres.value.trim();
            if (genre.length == 0) {
                alert("Silahkan diisi terlebih dahulu!");
                document.frm.genres.focus();
                return false;
            }
        }
    </script>
</head>


<style>
    img {
        width: 100px;
    }

    tr {
        vertical-align: middle;
        text-align: center;
    }

    .title {
        width: 250px;
    }
</style>



<body>
    <nav class="navbar bg-info">
        <div class="container-fluid">
            <a class="navbar-brand">Info Anime</a>
            <form class="d-flex" role="search" method="post" name="frm" onsubmit="return validasidata()">
                <input class="form-control me-2" type="search" placeholder="Masukan Genre" aria-label="search" name="genres">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <br>
    <div>
        <pre>Nama  : MUHAMMAD FARIZ RAHMAT AMALDI</pre>
        <pre>NIM   : 10120004</pre>
        <pre>Kelas : IF-1</pre>
    </div>

    <div>
        <table class="table">
            <thead class="table-dark">
                <th>No</th>
                <th>Nama Anime</th>
                <th>Cover</th>
                <th class="title">Genres</th>
                <th class="desc">Deskripsi</th>
            </thead>
            <?php
            if (isset($_POST["genres"])) {
                $keyword = $_POST["genres"];
            } else {
                $keyword = "";
            }
            $response = searchAnime(ucfirst($keyword));
            ?>
            <?php
            $i = 1;
            $listAnime = $response["data"]; // ambil field items dari $response
            foreach ($listAnime as $anime) {
                echo "<tr><td><b>" . $i . "</b></td>";
                echo "<td>" . $anime['title'] . "</td>";
                echo "<td><img src=\"" . $anime['image'] . "\"></td>";
                // echo "<td>" . $anime['genres'] . "</td></tr>";
                $genre = $anime["genres"];
                echo "<td>";
                foreach ($genre as $tema) {
                    echo  $tema . ", ";
                }
                echo "</td>";
                $key = $anime['title'];
                $desc = searchQAnime($key);
                $listdesc = $desc;
                echo "<td>";
                $j = 0;
                if (is_array($listdesc) || is_object($listdesc)) {
                    foreach ($listdesc as $ld) {
                        echo "<a href=" . $ld["address"] . ">" . $ld["address"] . "</a>";
                        $j++;
                        if ($j == 1) {
                            break;
                        }
                    }
                    echo "</td></tr>";
                }
                $i++;
            }

            ?>
            <?php
            ?>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>