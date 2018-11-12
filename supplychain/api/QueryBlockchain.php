<?php

include "common.php";

$magicMapping = [
    'admin' => [Role::ROLE_ADMIN, -1],
    'factory' => [Role::ROLE_FACTORY, 1],
    'distributor' => [Role::ROLE_DISTRIBUTOR, 2],
    'warehouse' => [Role::ROLE_WAREHOUSE, 3],
    'trader' => [Role::ROLE_DISTRIBUTOR, 4],
    'merchant' => [Role::ROLE_MERCHANT, 5],
    'customer' => [Role::ROLE_CUSTOMER, 6]
];

if (!in_array(Session::getCurrentSession()->getUser()['role'], [$magicMapping['admin'][0]])) {
    $msg = 'Not authorized';
    echo json_encode(['status' => 'fail', 'message' => $msg]);
} else {


    $postaction = "http://supplychain-engine.herokuapp.com/blockchain";

    $response = file_get_contents($postaction);

//$json = json_decode($response);
////some error handling here

    echo json_encode(['status' => 'success', 'message' => $response]);
}