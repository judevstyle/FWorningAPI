<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');

    $username = (isset($_POST['username'])) ? $_POST['username'] : ""; 
    $password = (isset($_POST['password'])) ? $_POST['password'] : ""; 

    $pass = md5($password);

    $sql = "select  * from user_tb  where username = '$username' and password = '$pass'"; 

        $result=mysqli_query($conn,$sql);
        $data = array();
        $i=0;
        while($row = mysqli_fetch_assoc($result)) {

            $dataUser = array(
                "uid"=> $row['uid']
                ,"display_name" => $row['display_name'] 
                ,"fname" => $row['fname'] 
                ,"lname" => $row['lname']
                ,"gender" => $row['gender'] 
                ,"tel" => $row['tel']
                ,"username" => $row['username']
                ,"avatar" => $row['u_avatar']
                ,"comp_id" => $row['comp_id']
                ,"type_of_user" => $row['type_of_user']


            );
            
            $data = array("status"=> 1 , "msg" => "ss","user"=>$dataUser);
            echo json_encode($data);
            exit();
        }



        $data = array("status"=> 0 , "msg" => "username หรือ password ไม่ถูกต้อง","user"=>null);
        echo json_encode($data);
    
    
    ?>