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
