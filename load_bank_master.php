<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');



    $sql = "select  * from bank_master"; 

        $result=mysqli_query($conn,$sql);
        $data = array();
        $i=0;
        while($row = mysqli_fetch_assoc($result)) {
        
            $data[] =   $row ;
        }
        echo json_encode($data);
    
    
    ?>