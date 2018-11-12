<?php
//phpinfo();die;
$username = $_REQUEST["username"];
$password = password_hash($_REQUEST["password"], PASSWORD_DEFAULT);

$dbh = new PDO("mysql:dbname=supplychain;host=127.1", "supplyuser", "chainuser");

$stmt1 = $dbh->prepare("INSERT INTO `login` (`username`, `password`,`role`) VALUES(?,?,?)");

try {
    switch($username){
        case 'admin': $stmt1->execute([$username, $password,7]);break;
        case 'producer': $stmt1->execute([$username, $password,1]);break;
        case 'exporter': $stmt1->execute([$username, $password,2]);break;
        case 'carrier': $stmt1->execute([$username, $password,3]);break;
        case 'importer': $stmt1->execute([$username, $password,4]);break;
        case 'distributor': $stmt1->execute([$username, $password,5]);break;
        case 'consumer': $stmt1->execute([$username, $password,6]);break;
        default : $stmt1->execute([$username, $password,7]);break;

    }
    echo json_encode(['status' => 'success', 'message' => 'User registration successful!']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'fail', 'message' => $e->getMessage()]);

}
