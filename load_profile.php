<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);


$uid = (isset($_GET['uid'])) ? $_GET['uid'] : ""; 

$datetime = date("Y-m-d H:i:s");
$date = date("Y-m-d");



$sql = "select *  from users_tb where uid = '$uid'";
$result = mysqli_query($conn,$sql);
// $data=mysqli_fetch_assoc($result);

$dataUser = array();
while($row = mysqli_fetch_assoc($result)) {
    $dataUser= $row;
}
    
// $dataUser = array(

//     "uid"=> $uid 
//     ,"fname" => $fname 
//     ,"lname" => $lname 
//     ,"email" => $email 
//     ,"display_name" => $display_name 
//     ,"tel" => $tel 
//     ,"avatar" => $avatar 
//     ,"gender" => $img 

// );





    if ($result=mysqli_query($conn,$sql)){
        $data = array("status"=> 1 , "msg" => "ss","user"=>$dataUser);
    }else  $data = array("status"=> 0 , "msg" => "fail". $sql,"user"=>null);


    echo json_encode($data);





?>