<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

// $text = str_replace("'", "\'", $YourContent);
$status = (isset($_POST['status'])) ? $_POST['status'] : "1"; 
$uid = (isset($_POST['uid'])) ? $_POST['uid'] : "47c1d5e6-096c-4699-9c7e-07c264bb0e3a"; 
$datetime = date("Y-m-d H:i:s");





    $sql = "";

    $ckSqlAccept = "select count(*) as total from check_in_tb where uid  = '$uid' and status = 1";
    $resultCkAccept = mysqli_query($conn,$ckSqlAccept);
    $dataCkAccept = mysqli_fetch_assoc($resultCkAccept);

    $ckSql = "select count(*) as total from check_in_tb where uid  = '$uid'";
    $resultCk = mysqli_query($conn,$ckSql);
    $dataCk = mysqli_fetch_assoc($resultCk);
    if($dataCk['total'] > 0){
        
        if($status == 1)
            $sql = "update check_in_tb set status=$status  where uid = '$uid'";
        else{

            if($dataCkAccept['total'] > 0){
                $data = array("status"=> 0 , "msg" => "ถึงจุด Check In แล้ว");
                echo json_encode($data);
                exit();
            }else{

                $data = array("status"=> 1 , "msg" => "ข้อมูลถูกบันทึกแล้ว");
                echo json_encode($data);
                exit();
            }
            
        }
    
    }else{

        $sql = "insert into check_in_tb (status,uid,date_create) values ($status,'$uid','$datetime')";



    }
 
    $data;
    if ($result=mysqli_query($conn,$sql)){
        $data = array("status"=> 1 , "msg" => "ss");
    }else  $data = array("status"=> 0 , "msg" => "fail");


    echo json_encode($data);





?>