<?php

$gln = $_GET["value"];



//$location = $_GET["loc"];

$postaction="http://127.0.0.1:5432/api/query/credits"."$gln";

$response = file_get_contents($postaction);
$response = json_decode($response, TRUE);

if (empty($response)) {
    $response = [];
}



echo json_encode($response);