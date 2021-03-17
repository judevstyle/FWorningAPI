<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');



    $sql = "select  ut.* from user_tb ut
    left join  check_in_tb ct on  ct.uid = ut.uid and ct.status = 0
    where ct.ckid is null  "; 

    // echo $sql;
// 
        $result=mysqli_query($conn,$sql);
        $data = array();
        $i=0;
        while($row = mysqli_fetch_assoc($result)) {

                $user = array(
                    "uid" => $row['uid'],
                    "fname" => $row['fname'],
                    "lname" => $row['lname'],
                    "display_name" => $row['display_name'],
                    "avatar" => $row['u_avatar'],
                    "tel" => $row['tel'],
                    "type" => $row['type']

                );
                
                $data[] = $user;

        }


        // $data = array_values($data); 

        echo json_encode($data);
    
    
    ?>