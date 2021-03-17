<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

// $text = str_replace("'", "\'", $YourContent);
$uid = (isset($_POST['uid'])) ? $_POST['uid'] : "11121"; 
$wid = (isset($_POST['wid'])) ? $_POST['wid'] : ""; 
$status = (isset($_POST['status'])) ? $_POST['status'] : "0"; 
$datetime = date("Y-m-d H:i:s");




 $sql = "update worning_tb set status=$status,user_update='$uid',date_update='$datetime'  where wid = $wid";
    

  
 
    $data;



    if ($result=mysqli_query($conn,$sql)){
        $data = array("status"=> 1 , "msg" => "ss");
    }else  $data = array("status"=> 0 , "msg" => "fail");


    echo json_encode($data);





?>