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



    $sql = "insert into blacklist_tb (
        w_topic,w_desc,lat,lng,status,user_create,date_create,user_update,date_update
        ) 
        values ('$w_topic','$w_desc',$lat,$lng,1,'$user_create','$datetime','$user_update','$datetime')";


        // $data = array("status"=> 1 , "msg" => "");
        // echo json_encode($data);

        // exit();
    $data;
  

    if ($result=mysqli_query($conn,$sql)){

        $last_id = mysqli_insert_id($conn);
        $data = array("status"=> 1 , "msg" => "iiioo");
      
        if(isset($imgList)){
            $i = 0;
           
            foreach($imgList as $value) {
              
                
                $path_img = $value['img_path'];
                $img_del = $value['img_del'];
                $base64_img = $value['base64_img'];
                $wid = $value['wid'];
             

                if($eid == 0){
                    $image_name = time().($i++)."_IMG".".JPG";
                    
                    if (strlen($base64_img) > 0){
                        $decodedImage = base64_decode($base64_img);
                        $return = file_put_contents("woring/".$image_name, $decodedImage);
                        $path = 'woring/'.$image_name;
                        $sqlPT = "insert into worning_img_tb (wid,img_path) values ($last_id,'$path')";
                       
                        // $data = array("status"=> 1 , "msg" => "errr ".sqlPT);
                        // echo json_encode($data);
                        // exit();
                        mysqli_query($conn,$sqlPT);
                    
                    }else {


                    }
                }else if ($img_del == 1){
                    $eid = $value['eid'];
                    $sqlDel = "update worning_img_tb set img_del = 1  where wid = $wid";
                    mysqli_query($conn,$sqlDel);

                }
            }
        }
    }else  $data = array("status"=> 0 , "msg" => "fail".$sql);


    echo json_encode($data);





?>