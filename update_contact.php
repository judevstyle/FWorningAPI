<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

$cid = (isset($input['cid'])) ? $input['cid'] : "4"; 
$contact_name = (isset($input['contact_name'])) ? $input['contact_name'] : "ooo"; 
$contact_position = (isset($input['contact_position'])) ? $input['contact_position'] : "ooo"; 
$tel = (isset($input['tel'])) ? $input['tel'] : "ooo"; 
$avatar = (isset($input['avatar'])) ? $input['avatar'] : "ooo"; 
$status = (isset($input['status'])) ? $input['status'] : "1"; 


$image_name = time()."_IMG".".JPG";
$img ="";
$sql = "";
//  if (strlen($avatar) > 255){
//     $decodedImage = base64_decode("$avatar");
//     $return = file_put_contents("profile/".$image_name, $decodedImage);
//     $img = 'http://192.168.43.185/FWorning/profile/'.$image_name;

// }else {
//     $image_name  = $avatar;  
//     $img = $image_name;

// }


        $sql = "update contact_tb set contact_name='$contact_name',contact_position='$contact_position',tel='$tel'
        ,avatar='$avatar',status = $status  where cid = $cid";
    

  
 
    $data;




    if ($result=mysqli_query($conn,$sql)){
        $data = array("status"=> 1 , "msg" => "ss");
    }else  $data = array("status"=> 0 , "msg" => "fail");


    echo json_encode($data);





?>