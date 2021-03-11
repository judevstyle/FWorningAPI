<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);



$w_topic = (isset($input['w_topic'])) ? $input['w_topic'] : ""; 
$w_desc = (isset($input['w_desc'])) ? $input['w_desc'] : ""; 
$lat = (isset($input['lat'])) ? $input['lat'] : ""; 
$lng = (isset($input['lng'])) ? $input['lng'] : ""; 
$user = (isset($input['user'])) ? $input['user'] : ""; 
$uid = $user['uid'];
$imgList =  (isset($input['img'])) ? $input['img'] : "";
$datetime = date("Y-m-d H:i:s");



    $sql = "insert into worning_tb (
        w_topic,w_desc,lat,lng,status,user_create,date_create,user_update,date_update,comp_id
        ) 
        values ('$w_topic','$w_desc',$lat,$lng,1,'$uid','$datetime','$uid','$datetime','1001')";


        // $data = array("status"=> 1 , "msg" => "".$sql);
        // echo json_encode($data);

        // exit();
    $data;
  

    if ($result=mysqli_query($conn,$sql)){

        $last_id = mysqli_insert_id($conn);
        $data = array("status"=> 1 , "msg" => "iiioo");
      
        if(isset($imgList)){
            $i = 0;
           
            foreach($imgList as $value) {
             
                // $data = array("status"=> 1 , "msg" => "errr ");
                // echo json_encode($data);
                // exit();
                $path_img = "";
                
                // $img_del = $value['img_del'];
                $base64_img = $value['base64_img'];
                $wid = 0;
             

                if($wid == 0){
                    $image_name = time().($i++)."_IMG".".JPG";
                    
                    if (strlen($base64_img) > 0){
                        $decodedImage = base64_decode($base64_img);
                        $return = file_put_contents("worning/".$image_name, $decodedImage);
                        $path = 'worning/'.$image_name;
                        $sqlPT = "insert into worning_img_tb (wid,img_path) values ($last_id,'$path')";
                       
                    
                        mysqli_query($conn,$sqlPT);
                    
                    }else {


                    }
                }
                // else if ($img_del == 1){
                //     $eid = $value['eid'];
                //     $sqlDel = "update worning_img_tb set img_del = 1  where wid = $wid";
                //     mysqli_query($conn,$sqlDel);

                // }
            }
        }
    }else  $data = array("status"=> 0 , "msg" => "fail".$sql);


    echo json_encode($data);





?>