<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

$uid = (isset($input['uid'])) ? $input['uid'] : ""; 
$bid = (isset($input['bid'])) ? $input['bid'] : ""; 

$datetime = date("Y-m-d H:i:s");
$date = date("Y-m-d");

 $sql = "delete from notify_report_blacklist_tb where bid = $bid and create_user= '$uid'";
 
    $data;

    if ($result=mysqli_query($conn,$sql)){
        $data = array("status"=> 1 , "msg" => "ss");
    }else  $data = array("status"=> 0 , "msg" => "fail");


    echo json_encode($data);





?>