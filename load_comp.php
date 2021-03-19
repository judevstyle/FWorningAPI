<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);


$comp_id = (isset($_GET['comp_id'])) ? $_GET['comp_id'] : "1001"; 

$datetime = date("Y-m-d H:i:s");
$date = date("Y-m-d");



$sql = "select *  from company_tb where comp_id = '$comp_id'";
$result = mysqli_query($conn,$sql);

$data = array();
while($row = mysqli_fetch_assoc($result)) {

    $row['distance'] = $row['distance']+0;
    $data= $row;
}


    echo json_encode($data);





?>