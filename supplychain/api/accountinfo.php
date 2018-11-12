<?php

include 'common.php';

$magicMapping = [
    'admin' => [Role::ROLE_ADMIN, -1],
    'factory' => [Role::ROLE_FACTORY, 1],
    'distributor' => [Role::ROLE_DISTRIBUTOR, 2],
    'warehouse' => [Role::ROLE_WAREHOUSE, 3],
    'trader' => [Role::ROLE_DISTRIBUTOR, 4],
    'merchant' => [Role::ROLE_MERCHANT, 5],
    'customer' => [Role::ROLE_CUSTOMER, 6]
];

$direction = $_GET["dir"];
switch ($direction) {
    case "Income":
        $direction = 'in';
        break;
    case "Expenditure":
        $direction = 'out';
        break;
}

if (Session::getCurrentSession()->getUser()['role'] == $magicMapping['admin'][0]) {
    $location = $_GET["loc"];


    switch ($location) {
        case "Producer":
            $location = 1;
            break;
        case "Exporter":
            $location = 2;
            break;
        case "Carrier":
            $location = 3;
            break;
        case "Importer":
            $location = 4;
            break;
        case "Distributor":
            $location = 5;
            break;
        case "Customer":
            $location = 6;
            break;
    }
} else {
    $location = Session::getCurrentSession()->getUser()['role'];
}


//$location = $_GET["loc"];


$postaction = "http://supplychain-engine.herokuapp.com/account/" . "$direction" . "/" . "$location";

$response = file_get_contents($postaction);
$response = json_decode($response, TRUE);

if (empty($response)) {
    $response = [];
}

foreach ($response as $k => $v) {

    if ($response[$k]['Party'] == 1) {
        $response[$k]['Party'] = 'Producer';
    } elseif ($response[$k]['Party'] == 2) {
        $response[$k]['Party'] = 'Exporter';
    } elseif ($response[$k]['Party'] == 3) {
        $response[$k]['Party'] = 'Carrier';
    } elseif ($response[$k]['Party'] == 4) {
        $response[$k]['Party'] = 'Importer';
    } elseif ($response[$k]['Party'] == 5) {
        $response[$k]['Party'] = 'Distributor';
    } elseif ($response[$k]['Party'] == 6) {
        $response[$k]['Party'] = 'Customer';
    }

    if ($response[$k]['Direction'] == 'in') {
        $response[$k]['Direction'] = 'Income';
    } elseif ($response[$k]['Direction'] == 'out') {
        $response[$k]['Direction'] = 'Expenditure';
    }
}


echo json_encode($response);