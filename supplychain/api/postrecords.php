<?php


$previous_key = $_REQUEST["previous_key"];
$new_key = $_REQUEST["new_key"];
$generator_gln = $_REQUEST['generator_gln'];
$event_id = $_REQUEST["event_id"];
$event_type = $_REQUEST["event_type"];
$input_gtin = $_REQUEST["input_gtin"];
$output_gtin = $_REQUEST["output_gtin"];
$serial_number = $_REQUEST["serial_number"];
$event_time = $_REQUEST["event_time"];
$event_location = $_REQUEST["event_location"];
$location_name = $_REQUEST["location_name"];
$company_name = $_REQUEST["company_name"];


$postaction = "http://127.0.0.1:8000/api/event" ;
$response = file_get_contents($postaction);
$msg = 'You have posted the record successfully!';
echo json_encode(['status' => 'success', "message" => $msg]);

$err_messages = [];
//if (Session::getCurrentSession()->checkUserPermission(Role::PERMISSION_POST)) {
//    if (isset($_FILES['file']) && $_FILES['file']['error'] != UPLOAD_ERR_NO_FILE) {
//        if ($_FILES["file"]["error"] > 0) {
//            $err_messages [] = "Return Code: " . $_FILES["file"]["error"];
//        } else {
//            if (file_exists("/Users/lisagjl/Sites/front/viewsimpro/upload" . $_FILES["file"]["name"])) {
//                $err_messages [] = $_FILES["file"]["name"] . " already exists. ";
//            } else {
//                //$username = Session::getCurrentSession()->getUser()['username'];
//                $fileName = "/Users/lisagjl/Sites/front/viewsimpro/upload" . $_FILES["file"]["name"];
//                move_uploaded_file($_FILES["file"]["tmp_name"], $fileName);
//                $file = urlencode(urlencode($fileName));
////                $file = $_FILES["file"]["name"];
////                $file = urlencode($file);
//                $postaction = "http://supplychain-engine.herokuapp.com/post/" . "$CodeNo" . "/" . "$Name" . "/" . "$Cost" ;
//                $response = file_get_contents($postaction);
//                $msg = 'You have sent the record successfully!';
//
//                echo json_encode(['status' => 'success', "message" => $msg]);
//            }
//
//        }
//
//    } else {
//        $file="no+file";
//        $postaction = "http://supplychain-engine.herokuapp.com/post/" . "$CodeNo" . "/" . "$Name" . "/" . "$Cost" ;
//        $response = file_get_contents($postaction);
//        $msg = 'You have posted the record successfully!';
//        echo json_encode(['status' => 'success', "message" => $msg]);
//    }
//} else {
//    $err_messages[] = "Access deny";
////    echo json_encode(['status' => 'fail', 'message' => $msg]);
//}
//
//if (!empty($err_messages)) {
//    echo json_encode(['status' => 'fail', 'message' => join("\n", $err_messages)]);
//}

