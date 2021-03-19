<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);


$comp_id = (isset($input['comp_id'])) ? $input['comp_id'] : "1001"; 
$comp_name = (isset($input['comp_name'])) ? $input['comp_name'] : "ddd"; 
$distance = (isset($input['distance'])) ? $input['distance'] : "0"; 

$location_evacuate_lat = (isset($input['location_evacuate_lat'])) ? $input['location_evacuate_lat'] : "0.0"; 
$location_evacuate_lng = (isset($input['location_evacuate_lng'])) ? $input['location_evacuate_lng'] : "0.0"; 


        $sql = "update company_tb set comp_name='$comp_name',location_evacuate_lat=$location_evacuate_lat,location_evacuate_lng=$location_evacuate_lng
         ,distance = $distance where comp_id = $comp_id";
    

  
 
    $data;



    // echo  $sql;


    if ($result=mysqli_query($conn,$sql)){
        $data = array("status"=> 1 , "msg" => "ss".$sql);
    }else  $data = array("status"=> 0 , "msg" => "fail");


    echo json_encode($data);





?>