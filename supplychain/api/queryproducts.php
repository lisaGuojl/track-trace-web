<?php

$field=$_GET["field"];
$value=$_GET["value"];
switch($field){
    case "GTIN": $field='GTIN';break;
}

$postaction="http://127.0.0.1:8000/api/trace/"."$value";

$response = file_get_contents($postaction);
$response = json_decode($response, TRUE);

if (empty($response)) {
    $response = [];
}

// foreach ($response as $k => $v) {

//     if ($response[$k]['Location'] == 1) {
//         $response[$k]['Location'] = 'Producer';
//     } elseif ($response[$k]['Location'] == 2) {
//         $response[$k]['Location'] = 'Exporter';
//     } elseif ($response[$k]['Location'] == 3) {
//         $response[$k]['Location'] = 'Carrier';
//     } elseif ($response[$k]['Location'] == 4) {
//         $response[$k]['Location'] = 'Importer';
//     } elseif ($response[$k]['Location'] == 5) {
//         $response[$k]['Location'] = 'Distributor';
//     } elseif ($response[$k]['Location'] == 6) {
//         $response[$k]['Location'] = 'Consumer';
//     }
// }


echo json_encode($response);
