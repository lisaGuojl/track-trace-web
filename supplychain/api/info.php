<?php

include "common.php";

if (Session::getCurrentSession()->checkUserPermission(Role::PERMISSION_VIEW_RECORDS)) {
    $postaction = "http://supplychain-engine.herokuapp.com/info";

    $response = file_get_contents($postaction);

    $response = json_decode($response, TRUE);

    foreach ($response as &$item) {
        if ($item['Location'] == 1) {
            $item['Location'] = "Producer (22.5431° N, 114.0579° E)";
        } elseif ($item['Location'] == 2) {
            $item['Location'] = "Exporter (31.2304° N, 121.4737° E)";
        } elseif ($item['Location'] == 3) {
            $item['Location'] = "Carrier (8.8567° N,, 108.0506° E)";
        } elseif ($item['Location'] == 4) {
            $item['Location'] = "Importer (1.4854° N, 103.7618° E)";
        } elseif ($item['Location'] == 5) {
            $item['Location'] = "Distributor (3.1390° N, 101.6869° E)";
        } elseif ($item['Location'] == 6) {
            $item['Location'] = "Consumer (4.5975° N, 101.0901° E)";
        }
    }
    unset($item);


    $response = json_encode($response);

    echo $response;
}