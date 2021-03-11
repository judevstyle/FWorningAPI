<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

// $text = str_replace("'", "\'", $YourContent);





$username = (isset($input['username'])) ? $input['username'] : "11121"; 
$password = (isset($input['password'])) ? $input['password'] : "111"; 
$gender = (isset($input['gender'])) ? $input['gender'] : ""; 
$fname = (isset($input['fname'])) ? $input['fname'] : "0"; 
$lname = (isset($input['lname'])) ? $input['lname'] : "0"; 
$tel = (isset($input['tel'])) ? $input['tel'] : "0"; 
$display_name = (isset($input['display_name'])) ? $input['display_name'] : "0";
$avatar = (isset($input['avatar'])) ? $input['avatar'] : ""; 

$image_name = time()."_IMG".".JPG";
$img ="";
$sql = "";

    
    $decodedImage = base64_decode("$avatar");
    $return = file_put_contents("profile/".$image_name, $decodedImage);
    $img = 'profile/'.$image_name;



$sqlCk = "select count(*) as total from user_tb where username = '$username' ";
$resultCk = mysqli_query($conn,$sqlCk);
$dataCk = mysqli_fetch_assoc($resultCk);
$uuid = gen_uuid();
$pass = md5($password);
    if($dataCk['total'] > 0){

        $data = array("status"=> 0 ,"msg" => "มี Username มีการใช้งานแล้ว ","user"=>null);
        echo json_encode($data);
        exit();

    }else{

        $sql = " insert into user_tb (uid,display_name,tel,gender,fname,lname,username,password,u_avatar,comp_id)  values ('$uuid','$display_name','$tel','$gender','$fname','$lname','$username','$pass','$img','1001') ";
    
    }

    $data;

$dataUser = array(
    "uid"=> $uuid 
    ,"display_name" => $display_name 
    ,"fname" => $fname 
    ,"lname" => $lname
    ,"gender" => $gender 
    ,"tel" => $tel
    ,"avatar" => $img
    ,"comp_id" => '1001'

);


    if ($result=mysqli_query($conn,$sql)){
        $data = array("status"=> 1 , "msg" => "ss","user"=>$dataUser);
    }else  $data = array("status"=> 0 , "msg" => "fail","user"=>null);


    echo json_encode($data);


    function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
    
            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),
    
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,
    
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,
    
            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }


?>