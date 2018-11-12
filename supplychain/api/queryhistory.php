<?php


$value=$_GET["value"];


$postaction="http://supplychain-engine.herokuapp.com/history/"."$value";

$response = file_get_contents($postaction);
$response = json_decode($response, TRUE);

if (empty($response)) {
    $response = [];
}

foreach ($response as $k => $v) {

    if ($response[$k]['Location'] == 1) {
        $response[$k]['Location'] = 'Factory';
    } elseif ($response[$k]['Location'] == 2) {
        $response[$k]['Location'] = 'Distributor';
    } elseif ($response[$k]['Location'] == 3) {
        $response[$k]['Location'] = 'Warehouse';
    } elseif ($response[$k]['Location'] == 4) {
        $response[$k]['Location'] = 'Trader';
    } elseif ($response[$k]['Location'] == 5) {
        $response[$k]['Location'] = 'Merchant';
    } elseif ($response[$k]['Location'] == 6) {
        $response[$k]['Location'] = 'Customer';
    }
}


echo json_encode($response);
