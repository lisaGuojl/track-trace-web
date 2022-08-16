<?php


$value=$_GET["value"];


$postaction="http://127.0.0.1:8000/api/trace/full/"."$value";

$response = file_get_contents($postaction);
$response = json_decode($response, TRUE);

if (empty($response)) {
    $response = [];
}



echo json_encode($response);
