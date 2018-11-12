<?php
include 'common.php';

$Name = $_REQUEST["name"];
$CodeNo = $_REQUEST["code"];
$Cost = $_REQUEST['cost'];

$err_messages = [];
if (Session::getCurrentSession()->checkUserPermission(Role::PERMISSION_POST)) {
    if (isset($_FILES['file']) && $_FILES['file']['error'] != UPLOAD_ERR_NO_FILE) {
        if ($_FILES["file"]["error"] > 0) {
            $err_messages [] = "Return Code: " . $_FILES["file"]["error"];
        } else {
            if (file_exists("/Users/lisagjl/Sites/front/viewsimpro/upload" . $_FILES["file"]["name"])) {
                $err_messages [] = $_FILES["file"]["name"] . " already exists. ";
            } else {
                //$username = Session::getCurrentSession()->getUser()['username'];
                $fileName = "/Users/lisagjl/Sites/front/viewsimpro/upload" . $_FILES["file"]["name"];
                move_uploaded_file($_FILES["file"]["tmp_name"], $fileName);
                $file = urlencode(urlencode($fileName));
//                $file = $_FILES["file"]["name"];
//                $file = urlencode($file);
                $postaction = "http://localhost:8080/post/" . "$CodeNo" . "/" . "$Name" . "/" . "$Cost" . "/" . "$file";
                $response = file_get_contents($postaction);
                $msg = 'You have sent the record successfully!';

                echo json_encode(['status' => 'success', "message" => $msg]);
            }

        }

    } else {
        $file="no+file";
        $postaction = "http://localhost:8080/post/" . "$CodeNo" . "/" . "$Name" . "/" . "$Cost" . "/" . "$file";
        $response = file_get_contents($postaction);
        $msg = 'You have sent the record successfully but no file uploaded!';
        echo json_encode(['status' => 'success', "message" => $msg]);
    }
} else {
    $err_messages[] = "Access deny";
//    echo json_encode(['status' => 'fail', 'message' => $msg]);
}

if (!empty($err_messages)) {
    echo json_encode(['status' => 'fail', 'message' => join("\n", $err_messages)]);
}

