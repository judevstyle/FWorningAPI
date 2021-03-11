<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);



$fname = (isset($input['fname'])) ? $input['fname'] : ""; 
$lname = (isset($input['lname'])) ? $input['lname'] : ""; 
$citizen = (isset($input['citizen'])) ? $input['citizen'] : ""; 
$product_name = (isset($input['product_name'])) ? $input['product_name'] : ""; 
$balance = (isset($input['balance'])) ? $input['balance'] : ""; 
$social_contact = (isset($input['social_contact'])) ? $input['social_contact'] : ""; 
$date_pay = (isset($input['date_pay'])) ? $input['date_pay'] : ""; 
$b_desc = (isset($input['b_desc'])) ? $input['b_desc'] : ""; 
$avatar = (isset($input['avatar'])) ? $input['avatar'] : ""; 
$user = (isset($input['user'])) ? $input['user'] : ""; 
$uid = $user['uid'];
$imgList =  (isset($input['img'])) ? $input['img'] : "";
$bankList =  (isset($input['bankList'])) ? $input['bankList'] : "";

$datetime = date("Y-m-d H:i:s");
$date = date("Y-m-d");



// bid	fname	lname	citizen	product_name	
// balance	social_contact	date_pay	b_desc
// avatar	create_user	create_datetime	update_user	
// update_datetime	status

$image_name = time()."_IMG".".JPG";
$img ="";
$sql = "";

 if (strlen($avatar) > 255){
    $decodedImage = base64_decode("$avatar");
    $return = file_put_contents("upload_ev/".$image_name, $decodedImage);
    $img = 'upload_ev/'.$image_name;

}else {
    $image_name  = $avatar;  
    $img = $image_name;

}

    $sql = "insert into blacklist_tb (fname,lname,citizen,product_name, balance,social_contact,date_pay,b_desc,
        avatar,create_user,create_datetime,update_user,update_datetime) 
        values ( '$fname','$lname','$citizen','$product_name',$balance,'$social_contact','$date_pay','$b_desc',
        '$img','$uid','$datetime','$uid','$datetime')";


        // $data = array("status"=> 1 , "msg" => "");
        // echo json_encode($data);

        // exit();
    $data;
  

    if ($result=mysqli_query($conn,$sql)){

        $last_id = mysqli_insert_id($conn);
        bank($conn,$last_id,$bankList);
        $data = array("status"=> 1 , "msg" => "iiioo");
      
        if(isset($imgList)){
            $i = 0;
           
            foreach($imgList as $value) {
              
                
                $path_img = $value['path_img'];
                $img_del = $value['img_del'];
                $base64_img = $value['base64_img'];
                $eid = $value['eid'];
             
             


                if($eid == 0){
                    $image_name = time().($i++)."_IMG".".JPG";

                    
                    if (strlen($base64_img) > 0){
                        $decodedImage = base64_decode($base64_img);
                        $return = file_put_contents("upload_ev/".$image_name, $decodedImage);
                        $path = 'upload_ev/'.$image_name;
                        $sqlPT = "insert into evidence_img_tb (bid,path_img,date_create,user_create) values ($last_id,'$path','$datetime','$uid')";
                       
                        // $data = array("status"=> 1 , "msg" => "errr ".sqlPT);
                        // echo json_encode($data);
                        // exit();
                        mysqli_query($conn,$sqlPT);
                    
                    }else {


                //         $data = array("status"=> 4 , "msg" => "tes".$eid);
                // echo json_encode($data);
                // // eid	bid fk blacklist_tb	path_img	date_create	user_create	status
                // exit();

                        
                    }
                    // $data = array("status"=> 4 , "msg" => "te");
                    // echo json_encode($data);
                    // // eid	bid fk blacklist_tb	path_img	date_create	user_create	status
                    // exit();
                }else if ($img_del == 1){
                    $eid = $value['eid'];
                    $sqlDel = "update evidence_img_tb set img_del = 1  where eid = $eid";
                    mysqli_query($conn,$sqlDel);

                }
            }
        }
    }else  $data = array("status"=> 0 , "msg" => "fail".$sql);


    echo json_encode($data);



    function bank($conn,$bid,$bankList){

        if(isset($bankList)){
            foreach($bankList as $value) {
              
                $m_id = $value['m_id'];
                $bank_id = $value['bank_id'];
                $bank_number = $value['bank_number'];
                $bank_del = $value['bank_del'];
             
                // m_id	bid fk blacklist tb	bank_id	bank_number

                if($m_id == 0){
                        $sqlBank = "insert into report_bank_tb (bid,bank_id,bank_number,bank_del) values ($bid,$bank_id,'$bank_number',$bank_del)";
                        mysqli_query($conn,$sqlBank);
                    
             
                }else if ($bank_del == 1){
                    $eid = $value['eid'];
                    $sqlDel = "update report_bank_tb set bank_del = 1  where m_id = $m_id";
                    mysqli_query($conn,$sqlDel);

                }
            }
        }
 


    }
 



?>