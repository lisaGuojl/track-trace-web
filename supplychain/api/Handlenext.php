<?php


$serialno = $_REQUEST["field"];

$postaction = "http://supplychain-engine.herokuapp.com/move/" . "$serialno";
$response = file_get_contents($postaction);

$msg = 'You have sent the record successfully!';
echo json_encode(['status' => 'success', 'message' => $msg]);
