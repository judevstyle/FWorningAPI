<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');


$uid = (isset($_GET['uid'])) ? $_GET['uid'] : "0";


    $sql = "select  * from worning_tb wt
    where   wt.user_create = '$uid' and wt.status != 0 and wt.status != 1   "; 

    // echo $sql;
// 
        $result=mysqli_query($conn,$sql);
        $data = array();
        $i=0;
        while($row = mysqli_fetch_assoc($result)) {

                $data[] = $row;

        }


        // $data = array_values($data); 

        echo json_encode($data);
    

        
    
    ?>