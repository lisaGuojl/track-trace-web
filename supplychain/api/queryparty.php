<?php

include 'common.php';

$party = $_GET["field"];

$magicMapping = [
    'admin' => [Role::ROLE_ADMIN, -1],
    'producer' => [Role::ROLE_FACTORY, 1],
    'exporter' => [Role::ROLE_DISTRIBUTOR, 2],
    'carrier' => [Role::ROLE_WAREHOUSE, 3],
    'importer' => [Role::ROLE_DISTRIBUTOR, 4],
    'distributor' => [Role::ROLE_MERCHANT, 5],
    'consumer' => [Role::ROLE_CUSTOMER, 6]
];

if (!in_array(Session::getCurrentSession()->getUser()['role'], [$magicMapping['admin'][0], $magicMapping[$party][0]])) {
    $msg = 'Not authorized';
    echo json_encode(['status' => 'fail', 'message' => $msg]);
} else {

    $field = $magicMapping[$party][1];


    $postaction = "http://supplychain-engine.herokuapp.com/info/" . "$field";

    $response = file_get_contents($postaction);
    $response = json_decode($response, TRUE);

    if (empty($response)) {
        $response = [];
    }

    foreach ($response as $k => $v) {

        if ($response[$k]['Location'] == 1) {
            $response[$k]['Location'] = 'Producer';
        } elseif ($response[$k]['Location'] == 2) {
            $response[$k]['Location'] = 'Exporter';
        } elseif ($response[$k]['Location'] == 3) {
            $response[$k]['Location'] = 'Carrier';
        } elseif ($response[$k]['Location'] == 4) {
            $response[$k]['Location'] = 'Importer';
        } elseif ($response[$k]['Location'] == 5) {
            $response[$k]['Location'] = 'Distributor';
        } elseif ($response[$k]['Location'] == 6) {
            $response[$k]['Location'] = 'Consumer';
        }
    }


    echo json_encode($response);
}