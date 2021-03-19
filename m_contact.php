<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

// $text = str_replace("'", "\'", $YourContent);
$contact_name = (isset($input['contact_name'])) ? $input['contact_name'] : "eee"; 
$contact_position = (isset($input['contact_position'])) ? $input['contact_position'] : "eee"; 
$tel = (isset($input['tel'])) ? $input['tel'] : "eee"; 
$avatar = (isset($input['avatar'])) ? $input['avatar'] : "eee"; 

$datetime = date("Y-m-d H:i:s");

$image_name = time()."_IMG".".JPG";
$img ="";
$sql = "";

    
    $decodedImage = base64_decode("$avatar");
    $return = file_put_contents("profile/".$image_name, $decodedImage);
    $img = 'profile/'.$image_name;



    $sql = "";

        $sql = "insert into contact_tb (contact_name,contact_position,tel,avatar,comp_id) 
        values ('$contact_name','$contact_position','$tel','$img','1001')";

    
 
    $data;
    if ($result=mysqli_query($conn,$sql)){
        $data = array("status"=> 1 , "msg" => "ss");
    }else  $data = array("status"=> 0 , "msg" => "fail");


    echo json_encode($data);





?>