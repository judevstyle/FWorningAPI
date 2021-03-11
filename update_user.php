<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

// $text = str_replace("'", "\'", $YourContent);
$uid = (isset($input['uid'])) ? $input['uid'] : "11121"; 
$username = (isset($input['username'])) ? $input['username'] : "11121"; 
$password = (isset($input['password'])) ? $input['password'] : "111"; 
$gender = (isset($input['gender'])) ? $input['gender'] : ""; 
$fname = (isset($input['fname'])) ? $input['fname'] : "0"; 
$lname = (isset($input['lname'])) ? $input['lname'] : "0"; 
$tel = (isset($input['tel'])) ? $input['tel'] : "0"; 
$display_name = (isset($input['display_name'])) ? $input['display_name'] : "0";
$avatar = (isset($input['u_avatar'])) ? $input['u_avatar'] : ""; 
$type = (isset($input['type'])) ? $input['type'] : ""; 


$image_name = time()."_IMG".".JPG";
$img ="";
$sql = "";
$display_name_sql = mysqli_real_escape_string($conn,$display_name);
 if (strlen($avatar) > 255){
    $decodedImage = base64_decode("$avatar");
    $return = file_put_contents("profile/".$image_name, $decodedImage);
    $img = 'http://192.168.43.185/FWorning/profile/'.$image_name;

}else {
    $image_name  = $avatar;  
    $img = $image_name;

}


        $sql = "update user_tb set display_name='$display_name',tel='$tel',gender='$gender','$fname','$lname',u_avatar='$img',type=$type  where uid = '$uid'";
    

  
 
    $data;

    
$dataUser = array(

    "uid"=> $uid 
    ,"fname" => $fname 
    ,"lname" => $lname 
    ,"email" => $email 
    ,"display_name" => $display_name 
    ,"tel" => $tel 
    ,"avatar" => $img 
    ,"gender" => $gender 
    ,"dfb" => $dfb 

);





    if ($result=mysqli_query($conn,$sql)){
        $data = array("status"=> 1 , "msg" => "ss","user"=>$dataUser);
    }else  $data = array("status"=> 0 , "msg" => "fail". $sql,"user"=>null);


    echo json_encode($data);





?>