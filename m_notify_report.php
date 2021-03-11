<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

$uid = (isset($input['uid'])) ? $input['uid'] : ""; 
$bid = (isset($input['bid'])) ? $input['bid'] : ""; 
$msg = (isset($input['msg'])) ? $input['msg'] : ""; 

$datetime = date("Y-m-d H:i:s");
$date = date("Y-m-d");
$msg = mysqli_real_escape_string($conn,$msg);


$sql = "insert into notify_report_blacklist_tb (bid,msg,create_user,create_datetime) 
        values ($bid,'$msg','$uid','$datetime')";
    

 
    $data;


    if ($result=mysqli_query($conn,$sql)){
        $data = array("status"=> 1 , "msg" => "ss");
    }else  $data = array("status"=> 0 , "msg" => "fail");


    echo json_encode($data);





?>