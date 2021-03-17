<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');



    $sql = "select  * from contact_tb ct
    where ct.status = 0  "; 

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